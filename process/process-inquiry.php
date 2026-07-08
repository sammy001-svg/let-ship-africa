<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$redirectTo = SITE_URL . '/request-quote.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $redirectTo);
    exit;
}

if (is_spam_submission()) {
    // Silently "succeed" so bots gain no signal, without writing anything.
    flash_set('success', 'Thank you. Your inquiry has been received. Our team will contact you shortly.');
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
$company = clean_input($_POST['company'] ?? '');
$message = clean_input($_POST['message'] ?? '');

$errors = [];
if ($fullName === '') $errors[] = 'Full name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email address is required.';
if ($phone === '') $errors[] = 'Phone number is required.';
if ($message === '') $errors[] = 'Please tell us what you would like to ship.';

if (!empty($errors)) {
    flash_set('error', implode(' ', $errors));
    header('Location: ' . $redirectTo);
    exit;
}

$db = getDb();
$stmt = $db->prepare(
    'INSERT INTO shipping_inquiries (full_name, email, phone, company, message)
     VALUES (:full_name, :email, :phone, :company, :message)'
);
$stmt->execute([
    'full_name' => $fullName,
    'email' => $email,
    'phone' => $phone,
    'company' => $company !== '' ? $company : null,
    'message' => $message,
]);

$staffEmailBody = sprintf(
    '<h3>New Shipping Inquiry</h3>
    <p><strong>Name:</strong> %s<br><strong>Email:</strong> %s<br><strong>Phone:</strong> %s<br><strong>Company:</strong> %s</p>
    <p><strong>Message:</strong><br>%s</p>',
    e($fullName), e($email), e($phone), e($company ?: 'N/A'),
    nl2br(e($message))
);
send_notification_email('New Shipping Inquiry from ' . $fullName, $staffEmailBody);

$customerEmailBody = sprintf(
    '<p>Hi %s,</p>
    <p>Thank you for reaching out to %s. We\'ve received your shipping inquiry and our team is reviewing it now.</p>
    <p>Here\'s what happens next:</p>
    <ol>
        <li>Our team reviews your inquiry.</li>
        <li>We contact you directly to discuss your shipment.</li>
        <li>We send you our Shipment Intake Form to capture the full details.</li>
        <li>Once we\'ve reviewed your completed intake form, we prepare your customized quotation.</li>
    </ol>
    <p>If you have any questions in the meantime, reply to this email or reach us on WhatsApp at +231 880 835 470.</p>
    <p>Best regards,<br>%s</p>',
    e($fullName), e(SITE_NAME), e(SITE_NAME)
);
send_customer_email($email, $fullName, 'We\'ve Received Your Shipping Inquiry — ' . SITE_NAME, $customerEmailBody);

flash_set('success', 'Thank you, ' . $fullName . '. Your inquiry has been received and a confirmation email is on its way. Our team will contact you shortly.');
header('Location: ' . $redirectTo);
exit;
