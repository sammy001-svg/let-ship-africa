-- Migration: split the old quote_requests table into a two-stage journey
-- (shipping_inquiries -> shipment_intake_forms), matching the new customer
-- journey: a simple first-contact inquiry, followed by a detailed intake
-- form sent after our team has made contact.
--
-- Safe to run on a live database with existing submissions: no columns or
-- rows are dropped. The old detailed shipment columns on quote_requests
-- become nullable (so the new, simpler inquiry form can insert without
-- them) but keep any historical data already stored in them.
--
-- Run this once, in phpMyAdmin -> your database -> SQL tab -> paste and Go.

RENAME TABLE quote_requests TO shipping_inquiries;

ALTER TABLE shipping_inquiries
    ADD COLUMN message TEXT NULL AFTER company,
    MODIFY COLUMN shipment_type ENUM('air', 'ocean', 'consolidation', 'other') NULL,
    MODIFY COLUMN origin_country VARCHAR(100) NULL,
    MODIFY COLUMN destination_country VARCHAR(100) NULL,
    MODIFY COLUMN cargo_description TEXT NULL,
    MODIFY COLUMN status ENUM('new', 'contacted', 'intake_sent', 'quoted', 'closed') NOT NULL DEFAULT 'new';

-- Backfill message for any existing rows so nothing shows blank in the
-- admin panel (old rows had no "message" field — cargo_description was the
-- closest equivalent).
UPDATE shipping_inquiries
   SET message = CONCAT('(Submitted via the old quote request form.) ', COALESCE(cargo_description, ''))
 WHERE message IS NULL;

ALTER TABLE shipping_inquiries
    MODIFY COLUMN message TEXT NOT NULL;

CREATE TABLE IF NOT EXISTS shipment_intake_forms (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    inquiry_id INT UNSIGNED NULL,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    company VARCHAR(150) NULL,
    shipment_type ENUM('air', 'ocean', 'consolidation', 'other') NOT NULL,
    origin_country VARCHAR(100) NOT NULL,
    destination_country VARCHAR(100) NOT NULL,
    cargo_description TEXT NOT NULL,
    weight VARCHAR(50) NULL,
    dimensions VARCHAR(100) NULL,
    additional_notes TEXT NULL,
    status ENUM('new', 'reviewed', 'quoted', 'closed') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_intake_inquiry FOREIGN KEY (inquiry_id) REFERENCES shipping_inquiries(id) ON DELETE SET NULL
) ENGINE=InnoDB;
