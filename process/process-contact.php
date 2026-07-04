<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$redirectTo = SITE_URL . '/contact.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $redirectTo);
    exit;
}

if (is_spam_submission()) {
    flash_set('success', 'Thank you. Your message has been received. Our team will respond soon.');
    header('Location: ' . $redirectTo);
    exit;
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    flash_set('error', 'Your session expired. Please try submitting the form again.');
    header('Location: ' . $redirectTo);
    exit;
}

$fullName = clean_input($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = clean_input($_POST['phone'] ?? '');
$subject = clean_input($_POST['subject'] ?? '');
$message = clean_input($_POST['message'] ?? '');

$errors = [];
if ($fullName === '') $errors[] = 'Full name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email address is required.';
if ($subject === '') $errors[] = 'Subject is required.';
if ($message === '') $errors[] = 'Message is required.';

if (!empty($errors)) {
    flash_set('error', implode(' ', $errors));
    header('Location: ' . $redirectTo);
    exit;
}

$db = getDb();
$stmt = $db->prepare(
    'INSERT INTO contact_messages (full_name, email, phone, subject, message)
     VALUES (:full_name, :email, :phone, :subject, :message)'
);
$stmt->execute([
    'full_name' => $fullName,
    'email' => $email,
    'phone' => $phone !== '' ? $phone : null,
    'subject' => $subject,
    'message' => $message,
]);

$emailBody = sprintf(
    '<h3>New Contact Message</h3>
    <p><strong>Name:</strong> %s<br><strong>Email:</strong> %s<br><strong>Phone:</strong> %s</p>
    <p><strong>Subject:</strong> %s</p>
    <p><strong>Message:</strong><br>%s</p>',
    e($fullName), e($email), e($phone ?: 'N/A'), e($subject), nl2br(e($message))
);
send_notification_email('New Contact Message: ' . $subject, $emailBody);

flash_set('success', 'Thank you, ' . $fullName . '. Your message has been received. Our team will respond soon.');
header('Location: ' . $redirectTo);
exit;
