-- Catch-up migration: safely brings any database state up to the current
-- schema, whether it still has the original quote_requests table, the
-- intermediate shipping_inquiries + simple shipment_intake_forms tables, a
-- partially-applied migration, or is already fully up to date.
--
-- Every step checks information_schema first, so it's safe to run more than
-- once and safe to run no matter which of the earlier migration files (if
-- any) already ran on this database. No data is ever dropped — anything
-- that can't be cleanly carried forward is preserved under a *_legacy_v1
-- table name instead.
--
-- Run this once, in phpMyAdmin -> your database -> SQL tab -> paste and Go.
-- Replace migration_shipping_inquiries.sql and migration_intake_form_v2.sql
-- with this single script going forward.

DELIMITER $$

CREATE PROCEDURE lsa_migrate_catchup()
BEGIN
    -- Step 1: quote_requests -> shipping_inquiries (only if the old table
    -- is still there and the new one isn't).
    IF EXISTS (SELECT 1 FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'quote_requests')
       AND NOT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'shipping_inquiries') THEN

        RENAME TABLE quote_requests TO shipping_inquiries;

        ALTER TABLE shipping_inquiries
            ADD COLUMN message TEXT NULL AFTER company,
            MODIFY COLUMN shipment_type ENUM('air', 'ocean', 'consolidation', 'other') NULL,
            MODIFY COLUMN origin_country VARCHAR(100) NULL,
            MODIFY COLUMN destination_country VARCHAR(100) NULL,
            MODIFY COLUMN cargo_description TEXT NULL,
            MODIFY COLUMN status ENUM('new', 'contacted', 'intake_sent', 'quoted', 'closed') NOT NULL DEFAULT 'new';

        UPDATE shipping_inquiries
           SET message = CONCAT('(Submitted via the old quote request form.) ', COALESCE(cargo_description, ''))
         WHERE message IS NULL;

        ALTER TABLE shipping_inquiries MODIFY COLUMN message TEXT NOT NULL;
    END IF;

    -- Step 2: if neither quote_requests nor shipping_inquiries exist (a
    -- brand new database), create shipping_inquiries fresh.
    IF NOT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'shipping_inquiries') THEN
        CREATE TABLE shipping_inquiries (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(150) NOT NULL,
            email VARCHAR(150) NOT NULL,
            phone VARCHAR(50) NOT NULL,
            company VARCHAR(150) NULL,
            message TEXT NOT NULL,
            status ENUM('new', 'contacted', 'intake_sent', 'quoted', 'closed') NOT NULL DEFAULT 'new',
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    END IF;

    -- Step 3: if a shipment_intake_forms table exists but hasn't already
    -- been renamed aside, preserve it as legacy data (its old columns don't
    -- map cleanly onto the new, much more detailed structure).
    IF EXISTS (SELECT 1 FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'shipment_intake_forms')
       AND NOT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'shipment_intake_forms_legacy_v1')
       AND NOT EXISTS (
            SELECT 1 FROM information_schema.columns
            WHERE table_schema = DATABASE() AND table_name = 'shipment_intake_forms' AND column_name = 'shipper_full_name'
       ) THEN
        RENAME TABLE shipment_intake_forms TO shipment_intake_forms_legacy_v1;
    END IF;

    -- Step 4: create the current, full shipment_intake_forms table if it
    -- isn't already there (covers both the brand-new-database case and the
    -- just-renamed-to-legacy case above).
    IF NOT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'shipment_intake_forms') THEN
        CREATE TABLE shipment_intake_forms (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            inquiry_id INT UNSIGNED NULL,

            shipment_mode ENUM('air', 'sea') NOT NULL,
            direction ENUM('export', 'import') NOT NULL,
            origin_country VARCHAR(100) NOT NULL,
            origin_city VARCHAR(100) NOT NULL,
            purpose ENUM('personal', 'commercial', 'gift', 'humanitarian', 'other') NOT NULL,
            purpose_other VARCHAR(255) NULL,
            destination_country VARCHAR(100) NOT NULL,
            destination_city VARCHAR(100) NOT NULL,
            cargo_ready_date DATE NULL,
            requested_shipment_date DATE NULL,
            referral_source ENUM('facebook', 'whatsapp', 'referral', 'google', 'website', 'existing_customer', 'other') NULL,
            referral_source_other VARCHAR(255) NULL,

            shipper_full_name VARCHAR(150) NOT NULL,
            shipper_business_name VARCHAR(150) NULL,
            shipper_phone VARCHAR(50) NOT NULL,
            shipper_whatsapp VARCHAR(50) NULL,
            shipper_email VARCHAR(150) NOT NULL,
            shipper_address VARCHAR(255) NOT NULL,
            shipper_city VARCHAR(100) NOT NULL,
            shipper_postal_code VARCHAR(30) NULL,
            shipper_country VARCHAR(100) NOT NULL,
            shipper_id_number VARCHAR(100) NULL,

            consignee_full_name VARCHAR(150) NOT NULL,
            consignee_business_name VARCHAR(150) NULL,
            consignee_phone VARCHAR(50) NOT NULL,
            consignee_whatsapp VARCHAR(50) NULL,
            consignee_email VARCHAR(150) NULL,
            consignee_address VARCHAR(255) NOT NULL,
            consignee_city VARCHAR(100) NOT NULL,
            consignee_state VARCHAR(100) NULL,
            consignee_postal_code VARCHAR(30) NULL,
            consignee_country VARCHAR(100) NOT NULL,

            consignee_is_importer ENUM('yes', 'no') NOT NULL DEFAULT 'yes',
            importer_full_name VARCHAR(150) NULL,
            importer_business_name VARCHAR(150) NULL,
            importer_phone VARCHAR(50) NULL,
            importer_email VARCHAR(150) NULL,
            importer_tax_id VARCHAR(100) NULL,
            importer_country VARCHAR(100) NULL,

            cargo_types TEXT NOT NULL,
            cargo_type_other VARCHAR(255) NULL,
            package_count INT UNSIGNED NULL,
            estimated_weight_kg VARCHAR(50) NULL,
            estimated_dimensions VARCHAR(150) NULL,
            estimated_value_usd VARCHAR(50) NULL,
            has_dangerous_goods ENUM('yes', 'no') NOT NULL DEFAULT 'no',
            dangerous_goods_details TEXT NULL,

            documents_available TEXT NULL,
            documents_other VARCHAR(255) NULL,

            services_requested TEXT NULL,
            services_other VARCHAR(255) NULL,

            special_instructions TEXT NULL,

            ack_accurate_declaration TINYINT(1) NOT NULL DEFAULT 0,
            ack_additional_docs TINYINT(1) NOT NULL DEFAULT 0,
            ack_inspections TINYINT(1) NOT NULL DEFAULT 0,
            ack_export_import_regs TINYINT(1) NOT NULL DEFAULT 0,
            ack_false_declaration_penalty TINYINT(1) NOT NULL DEFAULT 0,
            ack_additional_info_request TINYINT(1) NOT NULL DEFAULT 0,
            ack_destination_requirements_vary TINYINT(1) NOT NULL DEFAULT 0,
            preferred_contact_method ENUM('whatsapp', 'phone', 'email') NOT NULL DEFAULT 'whatsapp',
            preferred_contact_time VARCHAR(150) NULL,

            declaration_ack TINYINT(1) NOT NULL DEFAULT 0,
            customer_signature_name VARCHAR(150) NOT NULL,

            customer_number VARCHAR(50) NULL,
            shipment_reference VARCHAR(50) NULL,
            received_by VARCHAR(150) NULL,
            cargo_inspection_completed ENUM('yes', 'no') NULL,
            weight_verified ENUM('yes', 'no') NULL,
            compliance_review_completed ENUM('yes', 'no') NULL,
            broker_referral_required ENUM('yes', 'no') NULL,
            payment_status ENUM('paid', 'partial', 'pending') NOT NULL DEFAULT 'pending',
            internal_remarks TEXT NULL,
            authorized_by_name VARCHAR(150) NULL,
            authorized_by_date DATE NULL,

            status ENUM('new', 'reviewed', 'quoted', 'closed') NOT NULL DEFAULT 'new',
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            CONSTRAINT fk_intake_inquiry FOREIGN KEY (inquiry_id) REFERENCES shipping_inquiries(id) ON DELETE SET NULL
        ) ENGINE=InnoDB;
    END IF;
END$$

DELIMITER ;

CALL lsa_migrate_catchup();
DROP PROCEDURE lsa_migrate_catchup;
