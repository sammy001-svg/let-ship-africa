# Deploying to cPanel

This site is plain PHP + MySQL with no build step, which maps directly onto how cPanel
shared hosting works: upload the files, create a database, import the schema, fill in
config values. No Composer, no Node, no compilation.

Checklist at the bottom if you just want the short version.

## 1. Get the files onto the server

Pick whichever of these you have available — they all end with the same result (the
project files sitting in your domain's document root, usually `public_html/`, or
`public_html/yourdomain.com/` for an addon domain).

**Option A — cPanel's Git Version Control feature (cleanest, if available)**
1. cPanel → *Git™ Version Control* → *Create*.
2. Clone URL: `https://github.com/sammy001-svg/let-ship-africa.git`
3. Repository Path: your document root (e.g. `public_html`, or a subfolder if this site
   isn't the primary domain on the account).
4. Create. cPanel pulls the repo directly — no zip, no FTP client needed.

**Option B — File Manager upload**
1. On your machine: zip the project folder's *contents* (not the folder itself — you
   want `index.php` at the top level of the zip, not `let-ship-africa/index.php`).
2. cPanel → *File Manager* → navigate to `public_html` (or the target folder) → *Upload*
   → upload the zip → select it → *Extract*.

**Option C — FTP/SFTP**
Use FileZilla or similar with the FTP credentials from cPanel (*FTP Accounts*), and
upload the project contents into `public_html`.

## 2. Create the database

cPanel → *MySQL® Databases*:
1. Under **Create New Database**, name it e.g. `letshipafrica` — cPanel will prefix it
   with your account username, giving you something like `cpaneluser_letshipafrica`.
2. Under **MySQL Users** → **Add New User**, create a DB user with a strong password —
   this becomes `cpaneluser_dbuser`.
3. Under **Add User To Database**, add that user to the database with **ALL
   PRIVILEGES**.
4. Write down all three values (`cpaneluser_letshipafrica`, `cpaneluser_dbuser`, the
   password) — you'll need them in step 4.

## 3. Import the schema

cPanel → *phpMyAdmin* → select your new database in the left sidebar → **Import** tab →
choose `database/schema.sql` from the uploaded files → **Go**.

This only creates tables (no `CREATE DATABASE`/`USE` statements — shared-hosting DB users
usually can't create databases, only use ones already provisioned above).

**Already deployed before?** Don't re-import `schema.sql` — it won't touch existing tables.
Instead run **`database/migration_catchup_plain.sql`** once via phpMyAdmin's **SQL** tab.
It's plain, no-DELIMITER SQL (safe on every phpMyAdmin build — some hosts' SQL tabs don't
parse the `DELIMITER` directive correctly and will reject a stored-procedure-based migration
with "unrecognized statement" errors) that creates the `shipment_intake_forms` table if it's
missing. Safe to run more than once. If your database still has the original `quote_requests`
table (never migrated at all), run `database/migration_shipping_inquiries.sql` first, then
`migration_catchup_plain.sql`.

(`migration_catchup.sql` and `migration_intake_form_v2.sql` are earlier, stored-procedure- or
DELIMITER-based versions of this same migration — kept for history, but use
`migration_catchup_plain.sql` instead; it does the same thing without relying on phpMyAdmin
delimiter handling.)

(`migration_shipping_inquiries.sql` and `migration_intake_form_v2.sql` are the two migrations
`migration_catchup.sql` replaces — kept in the repo for history, but use the catch-up script
instead of running them individually.)

**Upgrading from the two-stage journey?** The site was later simplified from a two-stage
Shipping Inquiry → Shipment Intake Form flow down to a single form — "Start Your Shipping
Inquiry" now goes straight to the full intake form. If your database still has a
`shipping_inquiries` table, run **`database/migration_consolidate_intake.sql`** once via
phpMyAdmin's **SQL** tab. It only renames `shipping_inquiries` to
`shipping_inquiries_archived` (preserving any real submissions) — nothing else needs to
change, since `shipment_intake_forms` already stands on its own.

No admin account is seeded (this repo is public — a shipped password hash would be a
permanent public target). Create your own:

1. cPanel → *Setup PHP Version* (or *MultiPHP Manager*) → note the PHP version, then use
   cPanel's **Terminal** feature (if enabled) or your local machine to generate a hash:
   ```
   php -r "echo password_hash('YourStrongPassword', PASSWORD_DEFAULT), PHP_EOL;"
   ```
   No terminal access? Any local PHP install works for this one command — it doesn't
   need to touch the live database.
2. In phpMyAdmin, on the `admin_users` table → **Insert** tab → fill in `username`
   (e.g. `admin`), paste the generated string into `password_hash`, and a `full_name`.

## 4. Configure the app

In File Manager (or via FTP), duplicate `config/config.sample.php` as `config/config.php`
and fill in:

- `DB_HOST` — almost always stays `localhost` on cPanel.
- `DB_NAME` / `DB_USER` / `DB_PASS` — the values from step 2.
- `SITE_URL` — your real domain, with `https://` (e.g. `https://letshipafrica.com`),
  once SSL is active (step 6).
- `SMTP_*` — see step 5.

`config.php` is gitignored on purpose — it holds real secrets and should never be
committed back to the repo. If you deployed via the Git Version Control feature (Option
A), this file won't come from Git at all; create it directly on the server.

## 5. Set up email

cPanel → *Email Accounts* → create a mailbox, e.g. `notifications@yourdomain.com`.
Click **Connect Devices** on that mailbox for the exact SMTP host/port cPanel assigns
you (commonly `mail.yourdomain.com`, port `465` with SSL, or `587` with TLS). Put those
into `config.php`:

```php
define('SMTP_HOST', 'mail.yourdomain.com');
define('SMTP_PORT', 465);
define('SMTP_SECURE', 'ssl'); // or 'tls' if using port 587
define('SMTP_USER', 'notifications@yourdomain.com');
define('SMTP_PASS', 'the mailbox password');
define('NOTIFY_TO_EMAIL', 'info@yourdomain.com'); // where lead notifications land
```

Form submissions always save to the database regardless of whether email sends
successfully, so nothing is lost if this step is skipped or misconfigured initially.

## 6. SSL

Most cPanel hosts run **AutoSSL**, which automatically issues a free Let's Encrypt
certificate once your domain's DNS points at the server — usually within minutes to a
few hours, no action needed. Check cPanel → *SSL/TLS Status* to confirm.

The root `.htaccess` already includes a rule that forces HTTPS on any real domain (it
specifically skips `localhost`/`127.0.0.1` so local development is unaffected). If you
visit the site before AutoSSL has finished issuing the certificate and it fails to load,
that's why — wait for AutoSSL, or temporarily comment out that `RewriteCond`/`RewriteRule`
block in `.htaccess` until it's ready.

## 7. Verify

- [ ] Home page loads at `https://yourdomain.com` with images and the hero carousel
- [ ] Nav links (About, Services, Partnerships, FAQ, Contact) all load
- [ ] Submit the Contact form, the "Start Your Shipping Inquiry" form (the full intake
      form at `request-quote.php`), and the Partnership Inquiry form — confirm each
      shows a success message
- [ ] Check phpMyAdmin — confirm the 3 submissions landed in `shipment_intake_forms`,
      `partnership_inquiries`, `contact_messages`
- [ ] Confirm both the staff notification email and the customer acknowledgement email
      arrived (once SMTP is configured)
- [ ] Log into `/admin/login.php` with the account created in step 3, confirm the
      dashboard shows the test submissions, and that the intake form appears under
      *Shipment Intake Forms*
- [ ] Visit `https://yourdomain.com/config/config.php` directly — should be blocked
      (403), same for `/database/schema.sql`, `/includes/db.php`, `/vendor/...`
- [ ] Confirm `http://yourdomain.com` (no `s`) redirects to `https://`

## Updating the live site later

If you deployed via the Git Version Control feature, cPanel can pull new commits with
one click (*Git Version Control* → *Manage* → **Update from Remote**, then **Deploy**).
Otherwise, re-upload changed files via File Manager/FTP. Either way, `config/config.php`
is never touched by this, since it isn't part of the repo.
