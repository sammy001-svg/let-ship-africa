<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$redirectTo = SITE_URL . '/request-quote.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $redirectTo);
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

function intake_text(string $key, int $maxLength = 255): ?string
{
    $value = clean_input($_POST[$key] ?? '');
    if ($value === '') {
        return null;
    }
    return mb_substr($value, 0, $maxLength);
}

function intake_choice(string $key, array $allowed, ?string $default = null): ?string
{
    $value = $_POST[$key] ?? $default;
    return in_array($value, $allowed, true) ? $value : null;
}

function intake_checkbox_list(string $key, array $allowedOptions): array
{
    $values = $_POST[$key] ?? [];
    if (!is_array($values)) {
        return [];
    }
    return array_values(array_intersect($values, array_keys($allowedOptions)));
}

$options = intake_form_options();

$data = [
    'shipment_mode' => intake_choice('shipment_mode', ['air', 'sea']),
    'direction' => intake_choice('direction', ['export', 'import']),
    'origin_country' => intake_text('origin_country', 100),
    'origin_city' => intake_text('origin_city', 100),
    'purpose' => intake_choice('purpose', array_keys($options['purpose'])),
    'purpose_other' => intake_text('purpose_other'),
    'destination_country' => intake_text('destination_country', 100),
    'destination_city' => intake_text('destination_city', 100),
    'cargo_ready_date' => intake_text('cargo_ready_date', 20),
    'requested_shipment_date' => intake_text('requested_shipment_date', 20),
    'referral_source' => intake_choice('referral_source', array_keys($options['referral_source'])),
    'referral_source_other' => intake_text('referral_source_other'),

    'shipper_full_name' => intake_text('shipper_full_name', 150),
    'shipper_business_name' => intake_text('shipper_business_name', 150),
    'shipper_phone' => intake_text('shipper_phone', 50),
    'shipper_whatsapp' => intake_text('shipper_whatsapp', 50),
    'shipper_email' => trim($_POST['shipper_email'] ?? ''),
    'shipper_address' => intake_text('shipper_address'),
    'shipper_city' => intake_text('shipper_city', 100),
    'shipper_postal_code' => intake_text('shipper_postal_code', 30),
    'shipper_country' => intake_text('shipper_country', 100),
    'shipper_id_number' => intake_text('shipper_id_number', 100),

    'consignee_full_name' => intake_text('consignee_full_name', 150),
    'consignee_business_name' => intake_text('consignee_business_name', 150),
    'consignee_phone' => intake_text('consignee_phone', 50),
    'consignee_whatsapp' => intake_text('consignee_whatsapp', 50),
    'consignee_email' => intake_text('consignee_email', 150),
    'consignee_address' => intake_text('consignee_address'),
    'consignee_city' => intake_text('consignee_city', 100),
    'consignee_state' => intake_text('consignee_state', 100),
    'consignee_postal_code' => intake_text('consignee_postal_code', 30),
    'consignee_country' => intake_text('consignee_country', 100),

    'consignee_is_importer' => intake_choice('consignee_is_importer', ['yes', 'no'], 'yes'),
    'importer_full_name' => intake_text('importer_full_name', 150),
    'importer_business_name' => intake_text('importer_business_name', 150),
    'importer_phone' => intake_text('importer_phone', 50),
    'importer_email' => intake_text('importer_email', 150),
    'importer_tax_id' => intake_text('importer_tax_id', 100),
    'importer_country' => intake_text('importer_country', 100),

    'cargo_types' => intake_checkbox_list('cargo_types', $options['cargo_types']),
    'cargo_type_other' => intake_text('cargo_type_other'),
    'package_count' => intake_text('package_count', 10),
    'estimated_weight_kg' => intake_text('estimated_weight_kg', 50),
    'estimated_dimensions' => intake_text('estimated_dimensions', 150),
    'estimated_value_usd' => intake_text('estimated_value_usd', 50),
    'has_dangerous_goods' => intake_choice('has_dangerous_goods', ['yes', 'no'], 'no'),
    'dangerous_goods_details' => intake_text('dangerous_goods_details', 2000),

    'documents_available' => intake_checkbox_list('documents_available', $options['documents_available']),
    'documents_other' => intake_text('documents_other'),

    'services_requested' => intake_checkbox_list('services_requested', $options['services_requested']),
    'services_other' => intake_text('services_other'),

    'special_instructions' => intake_text('special_instructions', 2000),

    'preferred_contact_method' => intake_choice('preferred_contact_method', ['whatsapp', 'phone', 'email'], 'whatsapp'),
    'preferred_contact_time' => intake_text('preferred_contact_time', 150),

    'customer_signature_name' => intake_text('customer_signature_name', 150),
];

$acknowledgementKeys = [
    'ack_accurate_declaration', 'ack_additional_docs', 'ack_inspections', 'ack_export_import_regs',
    'ack_false_declaration_penalty', 'ack_additional_info_request', 'ack_destination_requirements_vary',
];
foreach ($acknowledgementKeys as $key) {
    $data[$key] = !empty($_POST[$key]) ? 1 : 0;
}
$data['declaration_ack'] = !empty($_POST['declaration_ack']) ? 1 : 0;

$errors = [];
if (!$data['shipment_mode']) $errors[] = 'Please choose a shipment type.';
if (!$data['direction']) $errors[] = 'Please choose the direction of shipment.';
if (!$data['origin_country'] || !$data['origin_city']) $errors[] = 'Origin country and city are required.';
if (!$data['purpose']) $errors[] = 'Please choose the purpose of shipment.';
if (!$data['destination_country'] || !$data['destination_city']) $errors[] = 'Destination country and city are required.';
if (!$data['shipper_full_name']) $errors[] = 'Shipper full name is required.';
if (!$data['shipper_phone']) $errors[] = 'Shipper phone number is required.';
if (!filter_var($data['shipper_email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid shipper email address is required.';
if (!$data['shipper_address'] || !$data['shipper_city'] || !$data['shipper_country']) $errors[] = 'Shipper address, city, and country are required.';
if (!$data['consignee_full_name']) $errors[] = 'Consignee full name is required.';
if (!$data['consignee_phone']) $errors[] = 'Consignee phone number is required.';
if (!$data['consignee_address'] || !$data['consignee_city'] || !$data['consignee_country']) $errors[] = 'Consignee address, city, and country are required.';
if (empty($data['cargo_types'])) $errors[] = 'Please select at least one cargo type.';
if (!$data['has_dangerous_goods']) $errors[] = 'Please indicate whether the shipment contains dangerous goods.';
foreach ($acknowledgementKeys as $key) {
    if (!$data[$key]) $errors[] = 'Please confirm all items in the Compliance Checklist.';
}
if (!$data['declaration_ack']) $errors[] = 'Please confirm the Customer Declaration.';
if (!$data['customer_signature_name']) $errors[] = 'Please type your name to sign the declaration.';
$errors = array_values(array_unique($errors));

if (!empty($errors)) {
    flash_set('error', implode(' ', $errors));
    header('Location: ' . $redirectTo);
    exit;
}

$db = getDb();

$cargoTypesStored = implode(',', $data['cargo_types']);
$documentsStored = implode(',', $data['documents_available']);
$servicesStored = implode(',', $data['services_requested']);

$stmt = $db->prepare(
    'INSERT INTO shipment_intake_forms (
        shipment_mode, direction, origin_country, origin_city, purpose, purpose_other,
        destination_country, destination_city, cargo_ready_date, requested_shipment_date,
        referral_source, referral_source_other,
        shipper_full_name, shipper_business_name, shipper_phone, shipper_whatsapp, shipper_email,
        shipper_address, shipper_city, shipper_postal_code, shipper_country, shipper_id_number,
        consignee_full_name, consignee_business_name, consignee_phone, consignee_whatsapp, consignee_email,
        consignee_address, consignee_city, consignee_state, consignee_postal_code, consignee_country,
        consignee_is_importer, importer_full_name, importer_business_name, importer_phone, importer_email,
        importer_tax_id, importer_country,
        cargo_types, cargo_type_other, package_count, estimated_weight_kg, estimated_dimensions,
        estimated_value_usd, has_dangerous_goods, dangerous_goods_details,
        documents_available, documents_other, services_requested, services_other, special_instructions,
        ack_accurate_declaration, ack_additional_docs, ack_inspections, ack_export_import_regs,
        ack_false_declaration_penalty, ack_additional_info_request, ack_destination_requirements_vary,
        preferred_contact_method, preferred_contact_time, declaration_ack, customer_signature_name
    ) VALUES (
        :shipment_mode, :direction, :origin_country, :origin_city, :purpose, :purpose_other,
        :destination_country, :destination_city, :cargo_ready_date, :requested_shipment_date,
        :referral_source, :referral_source_other,
        :shipper_full_name, :shipper_business_name, :shipper_phone, :shipper_whatsapp, :shipper_email,
        :shipper_address, :shipper_city, :shipper_postal_code, :shipper_country, :shipper_id_number,
        :consignee_full_name, :consignee_business_name, :consignee_phone, :consignee_whatsapp, :consignee_email,
        :consignee_address, :consignee_city, :consignee_state, :consignee_postal_code, :consignee_country,
        :consignee_is_importer, :importer_full_name, :importer_business_name, :importer_phone, :importer_email,
        :importer_tax_id, :importer_country,
        :cargo_types, :cargo_type_other, :package_count, :estimated_weight_kg, :estimated_dimensions,
        :estimated_value_usd, :has_dangerous_goods, :dangerous_goods_details,
        :documents_available, :documents_other, :services_requested, :services_other, :special_instructions,
        :ack_accurate_declaration, :ack_additional_docs, :ack_inspections, :ack_export_import_regs,
        :ack_false_declaration_penalty, :ack_additional_info_request, :ack_destination_requirements_vary,
        :preferred_contact_method, :preferred_contact_time, :declaration_ack, :customer_signature_name
    )'
);
$stmt->execute([
    'shipment_mode' => $data['shipment_mode'],
    'direction' => $data['direction'],
    'origin_country' => $data['origin_country'],
    'origin_city' => $data['origin_city'],
    'purpose' => $data['purpose'],
    'purpose_other' => $data['purpose_other'],
    'destination_country' => $data['destination_country'],
    'destination_city' => $data['destination_city'],
    'cargo_ready_date' => $data['cargo_ready_date'],
    'requested_shipment_date' => $data['requested_shipment_date'],
    'referral_source' => $data['referral_source'],
    'referral_source_other' => $data['referral_source_other'],
    'shipper_full_name' => $data['shipper_full_name'],
    'shipper_business_name' => $data['shipper_business_name'],
    'shipper_phone' => $data['shipper_phone'],
    'shipper_whatsapp' => $data['shipper_whatsapp'],
    'shipper_email' => $data['shipper_email'],
    'shipper_address' => $data['shipper_address'],
    'shipper_city' => $data['shipper_city'],
    'shipper_postal_code' => $data['shipper_postal_code'],
    'shipper_country' => $data['shipper_country'],
    'shipper_id_number' => $data['shipper_id_number'],
    'consignee_full_name' => $data['consignee_full_name'],
    'consignee_business_name' => $data['consignee_business_name'],
    'consignee_phone' => $data['consignee_phone'],
    'consignee_whatsapp' => $data['consignee_whatsapp'],
    'consignee_email' => $data['consignee_email'],
    'consignee_address' => $data['consignee_address'],
    'consignee_city' => $data['consignee_city'],
    'consignee_state' => $data['consignee_state'],
    'consignee_postal_code' => $data['consignee_postal_code'],
    'consignee_country' => $data['consignee_country'],
    'consignee_is_importer' => $data['consignee_is_importer'],
    'importer_full_name' => $data['importer_full_name'],
    'importer_business_name' => $data['importer_business_name'],
    'importer_phone' => $data['importer_phone'],
    'importer_email' => $data['importer_email'],
    'importer_tax_id' => $data['importer_tax_id'],
    'importer_country' => $data['importer_country'],
    'cargo_types' => $cargoTypesStored,
    'cargo_type_other' => $data['cargo_type_other'],
    'package_count' => $data['package_count'],
    'estimated_weight_kg' => $data['estimated_weight_kg'],
    'estimated_dimensions' => $data['estimated_dimensions'],
    'estimated_value_usd' => $data['estimated_value_usd'],
    'has_dangerous_goods' => $data['has_dangerous_goods'],
    'dangerous_goods_details' => $data['dangerous_goods_details'],
    'documents_available' => $documentsStored,
    'documents_other' => $data['documents_other'],
    'services_requested' => $servicesStored,
    'services_other' => $data['services_other'],
    'special_instructions' => $data['special_instructions'],
    'ack_accurate_declaration' => $data['ack_accurate_declaration'],
    'ack_additional_docs' => $data['ack_additional_docs'],
    'ack_inspections' => $data['ack_inspections'],
    'ack_export_import_regs' => $data['ack_export_import_regs'],
    'ack_false_declaration_penalty' => $data['ack_false_declaration_penalty'],
    'ack_additional_info_request' => $data['ack_additional_info_request'],
    'ack_destination_requirements_vary' => $data['ack_destination_requirements_vary'],
    'preferred_contact_method' => $data['preferred_contact_method'],
    'preferred_contact_time' => $data['preferred_contact_time'],
    'declaration_ack' => $data['declaration_ack'],
    'customer_signature_name' => $data['customer_signature_name'],
]);

$cargoTypeLabels = implode(', ', intake_form_labels('cargo_types', $data['cargo_types']));
$documentLabels = implode(', ', intake_form_labels('documents_available', $data['documents_available']));
$serviceLabels = implode(', ', intake_form_labels('services_requested', $data['services_requested']));

$staffEmailBody = sprintf(
    '<h3>New Shipment Intake Form</h3>
    <p><strong>Shipment:</strong> %s freight, %s &mdash; %s, %s &rarr; %s, %s</p>
    <p><strong>Shipper:</strong> %s (%s) &bull; %s &bull; %s</p>
    <p><strong>Consignee:</strong> %s &bull; %s &bull; %s, %s, %s</p>
    <p><strong>Cargo Types:</strong> %s<br><strong>Packages:</strong> %s &nbsp; <strong>Weight:</strong> %s kg &nbsp; <strong>Value:</strong> $%s</p>
    <p><strong>Dangerous Goods:</strong> %s</p>
    <p><strong>Documents Available:</strong> %s</p>
    <p><strong>Services Requested:</strong> %s</p>
    <p><strong>Special Instructions:</strong><br>%s</p>
    <p>Full details are in the admin panel under Shipment Intake Forms.</p>',
    e(ucfirst($data['shipment_mode'])), e($data['direction']), e($data['origin_city']), e($data['origin_country']), e($data['destination_city']), e($data['destination_country']),
    e($data['shipper_full_name']), e($data['shipper_business_name'] ?: 'Individual'), e($data['shipper_email']), e($data['shipper_phone']),
    e($data['consignee_full_name']), e($data['consignee_phone']), e($data['consignee_city']), e($data['consignee_state'] ?: ''), e($data['consignee_country']),
    e($cargoTypeLabels ?: 'N/A'), e($data['package_count'] ?: 'N/A'), e($data['estimated_weight_kg'] ?: 'N/A'), e($data['estimated_value_usd'] ?: 'N/A'),
    $data['has_dangerous_goods'] === 'yes' ? 'YES &mdash; ' . nl2br(e($data['dangerous_goods_details'] ?: 'no details given')) : 'No',
    e($documentLabels ?: 'None indicated'),
    e($serviceLabels ?: 'None requested'),
    nl2br(e($data['special_instructions'] ?: 'N/A'))
);
send_notification_email('New Shipment Intake Form from ' . $data['shipper_full_name'], $staffEmailBody);

$customerEmailBody = sprintf(
    '<p>Hi %s,</p>
    <p>Thank you for completing your Shipment Intake Form (Document No. LSA-FRM-001). Our team is now reviewing the
    details you provided and will prepare your customized quotation.</p>
    <p>If you have any questions in the meantime, reply to this email or reach us on WhatsApp at +231 880 835 470.</p>
    <p>Best regards,<br>%s</p>',
    e($data['shipper_full_name']), e(SITE_NAME)
);
send_customer_email($data['shipper_email'], $data['shipper_full_name'], 'Intake Form Received — Your Quotation Is Being Prepared — ' . SITE_NAME, $customerEmailBody);

flash_set('success', 'Thank you, ' . $data['shipper_full_name'] . '. Your shipping inquiry has been received. Our team will review it and prepare your customized quotation.');
header('Location: ' . $redirectTo);
exit;
