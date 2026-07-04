<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$redirectTo = SITE_URL . '/partnership-inquiry.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $redirectTo);
    exit;
}

if (is_spam_submission()) {
    flash_set('success', 'Thank you. Your partnership inquiry has been received. Our Business Development Team will follow up with you.');
    header('Location: ' . $redirectTo);
    exit;
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    flash_set('error', 'Your session expired. Please try submitting the form again.');
    header('Location: ' . $redirectTo);
    exit;
}

$organizationName = clean_input($_POST['organization_name'] ?? '');
$contactName = clean_input($_POST['contact_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = clean_input($_POST['phone'] ?? '');
$country = clean_input($_POST['country'] ?? '');
$partnerType = clean_input($_POST['partner_type'] ?? '');
$message = clean_input($_POST['message'] ?? '');

$errors = [];
if ($organizationName === '') $errors[] = 'Organization name is required.';
if ($contactName === '') $errors[] = 'Contact person is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email address is required.';
if ($phone === '') $errors[] = 'Phone number is required.';
if ($country === '') $errors[] = 'Country is required.';
if ($partnerType === '') $errors[] = 'Please choose an organization type.';
if ($message === '') $errors[] = 'Please tell us about your organization.';

if (!empty($errors)) {
    flash_set('error', implode(' ', $errors));
    header('Location: ' . $redirectTo);
    exit;
}

$db = getDb();
$stmt = $db->prepare(
    'INSERT INTO partnership_inquiries
        (organization_name, contact_name, email, phone, country, partner_type, message)
     VALUES (:organization_name, :contact_name, :email, :phone, :country, :partner_type, :message)'
);
$stmt->execute([
    'organization_name' => $organizationName,
    'contact_name' => $contactName,
    'email' => $email,
    'phone' => $phone,
    'country' => $country,
    'partner_type' => $partnerType,
    'message' => $message,
]);

$emailBody = sprintf(
    '<h3>New Partnership Inquiry</h3>
    <p><strong>Organization:</strong> %s<br><strong>Contact:</strong> %s<br><strong>Email:</strong> %s<br><strong>Phone:</strong> %s</p>
    <p><strong>Country:</strong> %s<br><strong>Organization Type:</strong> %s</p>
    <p><strong>Message:</strong><br>%s</p>',
    e($organizationName), e($contactName), e($email), e($phone),
    e($country), e($partnerType),
    nl2br(e($message))
);
send_notification_email('New Partnership Inquiry from ' . $organizationName, $emailBody);

flash_set('success', 'Thank you, ' . $contactName . '. Your partnership inquiry has been received. Our Business Development Team will follow up with you.');
header('Location: ' . $redirectTo);
exit;
