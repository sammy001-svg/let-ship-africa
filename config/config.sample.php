<?php
// Site-wide configuration template.
// Copy this file to config.php and fill in real values — config.php itself is
// gitignored so production credentials never get committed to this public repo.

// --- Database ---
// On cPanel, create these via "MySQL Databases" first — names/users are
// typically prefixed with your cPanel account username, e.g. cpaneluser_letshipafrica.
define('DB_HOST', 'localhost');
define('DB_NAME', 'letshipafrica');
define('DB_USER', 'root');
define('DB_PASS', ''); // XAMPP default: empty. Set your real DB password for production.
define('DB_CHARSET', 'utf8mb4');

// --- SMTP (used by includes/functions.php -> send_notification_email) ---
// If using cPanel's built-in email hosting, create a mailbox (e.g. notifications@yourdomain.com)
// in cPanel first, then use that mailbox's SMTP settings (visible in cPanel's "Email Accounts" ->
// "Connect Devices"). Common cPanel values: host mail.yourdomain.com, port 465 with 'ssl', or
// port 587 with 'tls'.
define('SMTP_HOST', 'smtp.example.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls'); // 'tls' (port 587) or 'ssl' (port 465)
define('SMTP_USER', 'notifications@letshipafrica.com');
define('SMTP_PASS', 'CHANGE_ME');
define('SMTP_FROM_EMAIL', 'notifications@letshipafrica.com');
define('SMTP_FROM_NAME', 'Let Ship Africa Inc. Website');
define('NOTIFY_TO_EMAIL', 'info@letshipafrica.com'); // where lead notifications are sent

// --- Site ---
define('SITE_NAME', 'Let Ship Africa Inc.');
define('SITE_URL', 'http://localhost/letshipafrica'); // e.g. https://yourdomain.com in production

// --- Sessions / security ---
define('ADMIN_SESSION_NAME', 'lsa_admin_session');

error_reporting(E_ALL);
ini_set('display_errors', '0'); // set to '1' temporarily if debugging locally
