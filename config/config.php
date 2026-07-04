<?php
// Site-wide configuration. Fill in real credentials before going live.

// --- Database ---
define('DB_HOST', 'localhost');
define('DB_NAME', 'letshipafrica');
define('DB_USER', 'root');
define('DB_PASS', ''); // XAMPP default: empty. Change for production.
define('DB_CHARSET', 'utf8mb4');

// --- SMTP (used by includes/functions.php -> send_notification_email) ---
// PLACEHOLDER: replace with real company mailbox credentials before relying on email delivery.
define('SMTP_HOST', 'smtp.example.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'notifications@letshipafrica.com');
define('SMTP_PASS', 'CHANGE_ME');
define('SMTP_FROM_EMAIL', 'notifications@letshipafrica.com');
define('SMTP_FROM_NAME', 'Let Ship Africa Inc. Website');
define('NOTIFY_TO_EMAIL', 'info@letshipafrica.com'); // PLACEHOLDER: where lead notifications are sent

// --- Site ---
define('SITE_NAME', 'Let Ship Africa Inc.');
define('SITE_URL', 'http://localhost/letshipafrica'); // update on deployment

// --- Sessions / security ---
define('ADMIN_SESSION_NAME', 'lsa_admin_session');

error_reporting(E_ALL);
ini_set('display_errors', '0'); // set to '1' temporarily if debugging locally
