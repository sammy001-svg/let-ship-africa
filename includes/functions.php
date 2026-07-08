<?php
require_once __DIR__ . '/../config/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/** Escape a value for safe HTML output. */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/** Trim + strip tags from raw POST input. */
function clean_input(?string $value): string
{
    return trim(strip_tags($value ?? ''));
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_verify(?string $token): bool
{
    return !empty($_SESSION['csrf_token']) && !empty($token) && hash_equals($_SESSION['csrf_token'], $token);
}

/** Hidden honeypot field for basic bot filtering. Real users never fill it in. */
function honeypot_field(): string
{
    return '<div class="d-none" aria-hidden="true"><label>Leave this field blank: <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>';
}

function is_spam_submission(): bool
{
    return !empty($_POST['website']);
}

function flash_set(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function flash_get(): ?array
{
    if (empty($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

/**
 * Sends an HTML email via PHPMailer/SMTP using the site's configured mailbox.
 * Returns true on success; failures are logged, not fatal (the DB record is what matters).
 */
function send_email(string $toEmail, string $toName, string $subject, string $bodyHtml): bool
{
    require_once __DIR__ . '/../vendor/phpmailer/src/Exception.php';
    require_once __DIR__ . '/../vendor/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/../vendor/phpmailer/src/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = SMTP_SECURE === 'ssl'
            ? PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS
            : PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = SMTP_PORT;

        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $bodyHtml;

        $mail->send();
        return true;
    } catch (Throwable $e) {
        error_log('Email send failed: ' . $e->getMessage());
        return false;
    }
}

/** Sends a lead-notification email to the staff inbox. */
function send_notification_email(string $subject, string $bodyHtml): bool
{
    return send_email(NOTIFY_TO_EMAIL, SITE_NAME, $subject, $bodyHtml);
}

/** Sends an automatic acknowledgement/confirmation email to a customer. */
function send_customer_email(string $toEmail, string $toName, string $subject, string $bodyHtml): bool
{
    return send_email($toEmail, $toName, $subject, $bodyHtml);
}
