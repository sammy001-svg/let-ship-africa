-- Plain-SQL catch-up migration: creates the shipment_intake_forms table
-- (the full Customer Shipment Intake Form, Doc No. LSA-FRM-001, v3.1) if
-- it doesn't already exist.
--
-- This is a simpler, stored-procedure-free version of migration_catchup.sql
-- for hosts whose phpMyAdmin doesn't parse the DELIMITER directive
-- correctly (splits routine bodies on internal semicolons and rejects them
-- as "unrecognized statement"). Every statement here is a plain top-level
-- statement phpMyAdmin's SQL tab handles natively — no DELIMITER needed.
--
-- Safe to run even if a broken procedure was left behind by a previous
-- failed attempt (the first line cleans that up). Safe to run more than
-- once — CREATE TABLE IF NOT EXISTS is a no-op if the table is already
-- there. Assumes shipping_inquiries already exists (it does, per the error
-- you shared); if for some reason it doesn't, run migration_shipping_inquiries.sql
-- first.
--
-- Run this once, in phpMyAdmin -> your database -> SQL tab -> paste and Go.

DROP PROCEDURE IF EXISTS lsa_migrate_catchup;

CREATE TABLE IF NOT EXISTS shipment_intake_forms (
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
