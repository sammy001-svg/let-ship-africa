<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$inquiryId = (int) ($_POST['inquiry_id'] ?? 0);
$redirectTo = SITE_URL . '/shipment-intake-form.php' . ($inquiryId > 0 ? '?inquiry_id=' . $inquiryId : '');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . SITE_URL . '/shipment-intake-form.php');
    exit;
}

if (is_spam_submission()) {
    flash_set('success', 'Thank you. Your intake form has been received. Our team will prepare your quotation.');
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
$shipmentType = $_POST['shipment_type'] ?? '';
$originCountry = clean_input($_POST['origin_country'] ?? '');
$destinationCountry = clean_input($_POST['destination_country'] ?? '');
$cargoDescription = clean_input($_POST['cargo_description'] ?? '');
$weight = clean_input($_POST['weight'] ?? '');
$dimensions = clean_input($_POST['dimensions'] ?? '');
$additionalNotes = clean_input($_POST['additional_notes'] ?? '');

$allowedShipmentTypes = ['air', 'ocean', 'consolidation', 'other'];

$errors = [];
if ($fullName === '') $errors[] = 'Full name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email address is required.';
if ($phone === '') $errors[] = 'Phone number is required.';
if (!in_array($shipmentType, $allowedShipmentTypes, true)) $errors[] = 'Please choose a valid shipment type.';
if ($originCountry === '') $errors[] = 'Origin country is required.';
if ($destinationCountry === '') $errors[] = 'Destination country is required.';
if ($cargoDescription === '') $errors[] = 'Please describe your cargo.';

if (!empty($errors)) {
    flash_set('error', implode(' ', $errors));
    header('Location: ' . $redirectTo);
    exit;
}

$db = getDb();

// Confirm the inquiry actually exists before linking to it.
$linkedInquiryId = null;
if ($inquiryId > 0) {
    $check = $db->prepare('SELECT id FROM shipping_inquiries WHERE id = :id');
    $check->execute(['id' => $inquiryId]);
    if ($check->fetch()) {
        $linkedInquiryId = $inquiryId;
    }
}

$stmt = $db->prepare(
    'INSERT INTO shipment_intake_forms
        (inquiry_id, full_name, email, phone, company, shipment_type, origin_country, destination_country, cargo_description, weight, dimensions, additional_notes)
     VALUES (:inquiry_id, :full_name, :email, :phone, :company, :shipment_type, :origin_country, :destination_country, :cargo_description, :weight, :dimensions, :additional_notes)'
);
$stmt->execute([
    'inquiry_id' => $linkedInquiryId,
    'full_name' => $fullName,
    'email' => $email,
    'phone' => $phone,
    'company' => $company !== '' ? $company : null,
    'shipment_type' => $shipmentType,
    'origin_country' => $originCountry,
    'destination_country' => $destinationCountry,
    'cargo_description' => $cargoDescription,
    'weight' => $weight !== '' ? $weight : null,
    'dimensions' => $dimensions !== '' ? $dimensions : null,
    'additional_notes' => $additionalNotes !== '' ? $additionalNotes : null,
]);

if ($linkedInquiryId !== null) {
    $db->prepare("UPDATE shipping_inquiries SET status = 'closed' WHERE id = :id AND status != 'closed'")
        ->execute(['id' => $linkedInquiryId]);
}

$staffEmailBody = sprintf(
    '<h3>New Shipment Intake Form%s</h3>
    <p><strong>Name:</strong> %s<br><strong>Email:</strong> %s<br><strong>Phone:</strong> %s<br><strong>Company:</strong> %s</p>
    <p><strong>Shipment Type:</strong> %s<br><strong>Origin:</strong> %s<br><strong>Destination:</strong> %s</p>
    <p><strong>Cargo Description:</strong><br>%s</p>
    <p><strong>Weight:</strong> %s &nbsp; <strong>Dimensions:</strong> %s</p>
    <p><strong>Additional Notes:</strong><br>%s</p>',
    $linkedInquiryId !== null ? ' (linked to inquiry #' . $linkedInquiryId . ')' : '',
    e($fullName), e($email), e($phone), e($company ?: 'N/A'),
    e($shipmentType), e($originCountry), e($destinationCountry),
    nl2br(e($cargoDescription)),
    e($weight ?: 'N/A'), e($dimensions ?: 'N/A'),
    nl2br(e($additionalNotes ?: 'N/A'))
);
send_notification_email('New Shipment Intake Form from ' . $fullName, $staffEmailBody);

$customerEmailBody = sprintf(
    '<p>Hi %s,</p>
    <p>Thank you for completing your Shipment Intake Form. Our team is now reviewing the details you provided and will
    prepare your customized quotation.</p>
    <p>If you have any questions in the meantime, reply to this email or reach us on WhatsApp at +231 88 083 5470.</p>
    <p>Best regards,<br>%s</p>',
    e($fullName), e(SITE_NAME)
);
send_customer_email($email, $fullName, 'Intake Form Received — Your Quotation Is Being Prepared — ' . SITE_NAME, $customerEmailBody);

flash_set('success', 'Thank you, ' . $fullName . '. Your intake form has been received. Our team will review it and prepare your customized quotation.');
header('Location: ' . SITE_URL . '/shipment-intake-form.php');
exit;
