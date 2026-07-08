-- Migration: replace the simplified shipment_intake_forms table with the
-- full Customer Shipment Intake Form (Doc No. LSA-FRM-001, v3.1).
--
-- The old table's columns (shipment_type, cargo_description, weight, ...)
-- don't map cleanly onto the new, much more detailed structure (separate
-- shipper/consignee/importer sections, compliance checklist, etc.), so
-- rather than forcing a lossy column-by-column conversion, this migration
-- preserves any existing submissions untouched under a renamed table and
-- creates the new one fresh. No data is dropped.
--
-- Run this once, in phpMyAdmin -> your database -> SQL tab -> paste and Go.

RENAME TABLE shipment_intake_forms TO shipment_intake_forms_legacy_v1;

CREATE TABLE IF NOT EXISTS shipment_intake_forms (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    inquiry_id INT UNSIGNED NULL,

    -- Section 1 - Shipment Information
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

    -- Section 2 - Customer / Shipper Information
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

    -- Section 3 - Consignee Information (Receiver)
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

    -- Section 4 - Importer of Record Information
    consignee_is_importer ENUM('yes', 'no') NOT NULL DEFAULT 'yes',
    importer_full_name VARCHAR(150) NULL,
    importer_business_name VARCHAR(150) NULL,
    importer_phone VARCHAR(50) NULL,
    importer_email VARCHAR(150) NULL,
    importer_tax_id VARCHAR(100) NULL,
    importer_country VARCHAR(100) NULL,

    -- Section 5 - Cargo Information
    cargo_types TEXT NOT NULL,
    cargo_type_other VARCHAR(255) NULL,
    package_count INT UNSIGNED NULL,
    estimated_weight_kg VARCHAR(50) NULL,
    estimated_dimensions VARCHAR(150) NULL,
    estimated_value_usd VARCHAR(50) NULL,
    has_dangerous_goods ENUM('yes', 'no') NOT NULL DEFAULT 'no',
    dangerous_goods_details TEXT NULL,

    -- Section 6 - Documentation Available
    documents_available TEXT NULL,
    documents_other VARCHAR(255) NULL,

    -- Section 7 - Optional Services Requested
    services_requested TEXT NULL,
    services_other VARCHAR(255) NULL,

    -- Section 8 - Special Instructions
    special_instructions TEXT NULL,

    -- Section 9 - Customer Compliance Checklist + contact preference
    ack_accurate_declaration TINYINT(1) NOT NULL DEFAULT 0,
    ack_additional_docs TINYINT(1) NOT NULL DEFAULT 0,
    ack_inspections TINYINT(1) NOT NULL DEFAULT 0,
    ack_export_import_regs TINYINT(1) NOT NULL DEFAULT 0,
    ack_false_declaration_penalty TINYINT(1) NOT NULL DEFAULT 0,
    ack_additional_info_request TINYINT(1) NOT NULL DEFAULT 0,
    ack_destination_requirements_vary TINYINT(1) NOT NULL DEFAULT 0,
    preferred_contact_method ENUM('whatsapp', 'phone', 'email') NOT NULL DEFAULT 'whatsapp',
    preferred_contact_time VARCHAR(150) NULL,

    -- Section 10 - Customer Declaration
    declaration_ack TINYINT(1) NOT NULL DEFAULT 0,
    customer_signature_name VARCHAR(150) NOT NULL,

    -- Section 11 - Let Ship Africa Inc. Internal Use Only (staff-editable)
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
