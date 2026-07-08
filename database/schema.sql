-- Let Ship Africa Inc. website database
--
-- This file only creates tables — it deliberately does NOT run CREATE DATABASE
-- or USE, because shared-hosting DB users (e.g. on cPanel) usually don't have
-- privileges to create a database and are scoped to one already provisioned
-- via the host's control panel. Create/select the database first, then import
-- this file into it:
--   Local (XAMPP):  mysql -u root -e "CREATE DATABASE IF NOT EXISTS letshipafrica CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
--                    mysql -u root letshipafrica < schema.sql
--   cPanel:          create the DB via "MySQL Databases", then phpMyAdmin -> select it -> Import -> this file.

CREATE TABLE IF NOT EXISTS admin_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(64) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(150) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- No admin account is seeded here on purpose (this repo is public — a shipped
-- password hash would be a public, permanent target). Create your own admin
-- account after importing this schema; see README.md "Create your admin account".

-- Stage 1 of the customer journey: a lightweight first-contact inquiry.
-- Detailed shipment specifics are collected later in shipment_intake_forms,
-- once our team has made direct contact with the customer.
CREATE TABLE IF NOT EXISTS shipping_inquiries (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    company VARCHAR(150) NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'contacted', 'intake_sent', 'quoted', 'closed') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Stage 2: the detailed Customer Shipment Intake Form, sent to the customer
-- after our team has reviewed and made contact on their initial inquiry.
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

CREATE TABLE IF NOT EXISTS partnership_inquiries (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    organization_name VARCHAR(150) NOT NULL,
    contact_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    country VARCHAR(100) NOT NULL,
    partner_type VARCHAR(150) NOT NULL,
    message TEXT NULL,
    status ENUM('new', 'contacted', 'closed') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'closed') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
