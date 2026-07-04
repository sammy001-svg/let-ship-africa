# Let Ship Africa Inc. — Website

Plain PHP 8 + MySQL marketing site with lead-capture forms (quote requests, partnership
inquiries, contact messages) and a basic admin panel to review submissions. No framework,
no build step — built to run on any shared/cPanel hosting that supports PHP + MySQL.

## Local setup (XAMPP)

1. Start **Apache** and **MySQL** from the XAMPP Control Panel.
2. Import the schema:
   ```
   C:\xampp\mysql\bin\mysql.exe -u root < "database\schema.sql"
   ```
   (or use phpMyAdmin → Import → select `database/schema.sql`).
3. This project lives outside `htdocs`. A junction was created so Apache can serve it:
   `C:\xampp\htdocs\letshipafrica` → `C:\LET SHIP AFRICA INC`.
4. Browse to **http://localhost/letshipafrica/**
5. **Create your admin account** (none is seeded, on purpose — this repo is public):
   ```
   C:\xampp\php\php.exe -r "echo password_hash('YourStrongPassword', PASSWORD_DEFAULT), PHP_EOL;"
   ```
   Then insert it:
   ```sql
   INSERT INTO admin_users (username, password_hash, full_name)
   VALUES ('admin', '<paste the hash from above>', 'Site Administrator');
   ```
   Log in at **http://localhost/letshipafrica/admin/login.php**. There's no self-service
   "change password" screen yet — to change it later, generate a new hash the same way and
   `UPDATE admin_users SET password_hash = '...' WHERE username = 'admin'`.

## Before going live

Edit `config/config.php`:
- `DB_*` — production database credentials.
- `SMTP_*` / `NOTIFY_TO_EMAIL` — real company mailbox so lead notification emails send.
  Submissions are always saved to the database regardless of whether email sending
  succeeds, so nothing is lost if SMTP isn't configured yet.
- `SITE_URL` — the production domain.

Replace placeholder content:
- `includes/footer.php` and `contact.php` — real office address, phone, email, hours.
- `assets/img/` — real logo (currently text-based placeholder in the nav).
- `assets/css/style.css` (`:root` variables) — brand colors once a brand guide exists.

## Structure

- `index.php`, `about.php`, `services.php`, `partnerships.php`, `faq.php`, `contact.php` —
  public content pages.
- `request-quote.php`, `partnership-inquiry.php` — lead-capture forms.
- `process/` — form handlers (CSRF + honeypot check, validation, DB insert, email notify).
- `includes/` — shared header/footer/nav, DB connection, helper functions.
- `admin/` — login-protected dashboard to view and triage submissions.
- `vendor/phpmailer/` — PHPMailer, vendored manually (no Composer available locally).
- `database/schema.sql` — run this to create the database and tables.

## Roadmap

This is Phase 1 (public site + lead capture + basic admin) of Let Ship Africa's longer-term
plan for a Customer Portal, Staff Portal, CRM, Shipment Tracking, Mobile App, AI Customer
Assistant, Partner Portal, Operations Dashboard, and CEO Dashboard. The plain-PHP/MySQL
foundation here (PDO throughout, CSRF-protected forms, session-based admin auth) is meant
to be extended, not replaced, as those systems come online.
