<?php
$pageTitle = 'Start Your Shipping Inquiry';
$pageDescription = 'Complete our Customer Shipment Intake Form so our team can prepare your customized quotation for air freight, ocean freight, import, or export.';
require __DIR__ . '/includes/header.php';

/** Renders a required-looking radio button group. */
function lsa_radio_group(string $name, array $options, ?string $selected = null): void
{
    foreach ($options as $value => $label) {
        $id = $name . '_' . $value;
        $checked = $selected === $value ? 'checked' : '';
        echo '<div class="form-check form-check-inline">'
            . '<input class="form-check-input" type="radio" name="' . e($name) . '" id="' . e($id) . '" value="' . e($value) . '" ' . $checked . ' required>'
            . '<label class="form-check-label" for="' . e($id) . '">' . e($label) . '</label>'
            . '</div>';
    }
}

/** Renders a checkbox group (multi-select). */
function lsa_checkbox_group(string $name, array $options): void
{
    foreach ($options as $value => $label) {
        $id = $name . '_' . $value;
        echo '<div class="form-check form-check-inline">'
            . '<input class="form-check-input" type="checkbox" name="' . e($name) . '[]" id="' . e($id) . '" value="' . e($value) . '">'
            . '<label class="form-check-label" for="' . e($id) . '">' . e($label) . '</label>'
            . '</div>';
    }
}

$intakeOptions = intake_form_options();
?>

<section class="lsa-hero-photo lsa-hero-sm text-center" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/port-cranes.jpg');">
    <div class="container">
        <p class="lsa-eyebrow mb-2">Get Started</p>
        <h1 class="fw-bold">Start Your Shipping Inquiry</h1>
        <p class="lsa-text-on-dark mb-0">Complete the Customer Shipment Intake Form below and our team will review it and prepare your customized quotation.</p>
        <p class="lsa-text-on-dark small mb-0 mt-2">Document No.: LSA-FRM-001 &bull; Version 3.1</p>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <form action="<?= e(SITE_URL) ?>/process/process-intake.php" method="post" data-guard-submit novalidate>
                    <?= csrf_field() ?>
                    <?= honeypot_field() ?>

                    <div class="lsa-card p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mb-4">Section 1 &mdash; Shipment Information</h4>
                        <div class="mb-3">
                            <label class="form-label d-block">Shipment Type *</label>
                            <?php lsa_radio_group('shipment_mode', ['air' => 'Air Freight', 'sea' => 'Sea Freight']); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Direction of Shipment *</label>
                            <?php lsa_radio_group('direction', ['export' => 'Export (From Liberia)', 'import' => 'Import (Into Liberia)']); ?>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="origin_country">Origin Country *</label>
                                <input type="text" class="form-control" id="origin_country" name="origin_country" required maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="origin_city">Origin City *</label>
                                <input type="text" class="form-control" id="origin_city" name="origin_city" required maxlength="100">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Purpose of Shipment *</label>
                            <?php lsa_radio_group('purpose', $intakeOptions['purpose']); ?>
                            <input type="text" class="form-control mt-2" name="purpose_other" maxlength="255" placeholder="If Other, please specify">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="destination_country">Destination Country *</label>
                                <input type="text" class="form-control" id="destination_country" name="destination_country" required maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="destination_city">Destination City *</label>
                                <input type="text" class="form-control" id="destination_city" name="destination_city" required maxlength="100">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="cargo_ready_date">Estimated Cargo Ready Date</label>
                                <input type="date" class="form-control" id="cargo_ready_date" name="cargo_ready_date">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="requested_shipment_date">Requested Shipment Date</label>
                                <input type="date" class="form-control" id="requested_shipment_date" name="requested_shipment_date">
                            </div>
                        </div>
                        <div>
                            <label class="form-label d-block">How did you hear about Let Ship Africa?</label>
                            <?php lsa_radio_group('referral_source', $intakeOptions['referral_source']); ?>
                            <input type="text" class="form-control mt-2" name="referral_source_other" maxlength="255" placeholder="If Other, please specify">
                        </div>
                    </div>

                    <div class="lsa-card p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mb-4">Section 2 &mdash; Customer / Shipper Information</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="shipper_full_name">Full Name *</label>
                                <input type="text" class="form-control" id="shipper_full_name" name="shipper_full_name" required maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="shipper_business_name">Business Name (if applicable)</label>
                                <input type="text" class="form-control" id="shipper_business_name" name="shipper_business_name" maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="shipper_phone">Phone Number *</label>
                                <input type="text" class="form-control" id="shipper_phone" name="shipper_phone" required maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="shipper_whatsapp">WhatsApp Number</label>
                                <input type="text" class="form-control" id="shipper_whatsapp" name="shipper_whatsapp" maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="shipper_email">Email Address *</label>
                                <input type="email" class="form-control" id="shipper_email" name="shipper_email" required maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="shipper_id_number">Government ID / Passport Number</label>
                                <input type="text" class="form-control" id="shipper_id_number" name="shipper_id_number" maxlength="100">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="shipper_address">Street Address *</label>
                                <input type="text" class="form-control" id="shipper_address" name="shipper_address" required maxlength="255">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="shipper_city">City *</label>
                                <input type="text" class="form-control" id="shipper_city" name="shipper_city" required maxlength="100">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="shipper_postal_code">Postal Code</label>
                                <input type="text" class="form-control" id="shipper_postal_code" name="shipper_postal_code" maxlength="30">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="shipper_country">Country *</label>
                                <input type="text" class="form-control" id="shipper_country" name="shipper_country" required maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="lsa-card p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mb-4">Section 3 &mdash; Consignee Information (Receiver)</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="consignee_full_name">Full Name *</label>
                                <input type="text" class="form-control" id="consignee_full_name" name="consignee_full_name" required maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="consignee_business_name">Business Name (if applicable)</label>
                                <input type="text" class="form-control" id="consignee_business_name" name="consignee_business_name" maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="consignee_phone">Phone Number *</label>
                                <input type="text" class="form-control" id="consignee_phone" name="consignee_phone" required maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="consignee_whatsapp">WhatsApp Number</label>
                                <input type="text" class="form-control" id="consignee_whatsapp" name="consignee_whatsapp" maxlength="50">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="consignee_email">Email Address</label>
                                <input type="email" class="form-control" id="consignee_email" name="consignee_email" maxlength="150">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="consignee_address">Street Address *</label>
                                <input type="text" class="form-control" id="consignee_address" name="consignee_address" required maxlength="255">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="consignee_city">City *</label>
                                <input type="text" class="form-control" id="consignee_city" name="consignee_city" required maxlength="100">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="consignee_state">State / Province</label>
                                <input type="text" class="form-control" id="consignee_state" name="consignee_state" maxlength="100">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="consignee_postal_code">Postal Code</label>
                                <input type="text" class="form-control" id="consignee_postal_code" name="consignee_postal_code" maxlength="30">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="consignee_country">Country *</label>
                                <input type="text" class="form-control" id="consignee_country" name="consignee_country" required maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="lsa-card p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mb-4">Section 4 &mdash; Importer of Record Information</h4>
                        <div class="mb-3">
                            <label class="form-label d-block">Is the Consignee also the Importer of Record? *</label>
                            <?php lsa_radio_group('consignee_is_importer', ['yes' => 'Yes', 'no' => 'No'], 'yes'); ?>
                        </div>
                        <p class="text-muted small">If No, please complete the importer's details below:</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="importer_full_name">Full Name</label>
                                <input type="text" class="form-control" id="importer_full_name" name="importer_full_name" maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="importer_business_name">Business Name</label>
                                <input type="text" class="form-control" id="importer_business_name" name="importer_business_name" maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="importer_phone">Phone Number</label>
                                <input type="text" class="form-control" id="importer_phone" name="importer_phone" maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="importer_email">Email Address</label>
                                <input type="email" class="form-control" id="importer_email" name="importer_email" maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="importer_tax_id">Importer Tax ID / EIN / ABN / VAT Number</label>
                                <input type="text" class="form-control" id="importer_tax_id" name="importer_tax_id" maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="importer_country">Country</label>
                                <input type="text" class="form-control" id="importer_country" name="importer_country" maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="lsa-card p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mb-4">Section 5 &mdash; Cargo Information</h4>
                        <div class="mb-3">
                            <label class="form-label d-block">Cargo Type *</label>
                            <?php lsa_checkbox_group('cargo_types', $intakeOptions['cargo_types']); ?>
                            <input type="text" class="form-control mt-2" name="cargo_type_other" maxlength="255" placeholder="If Other, please specify">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label" for="package_count">Number of Packages</label>
                                <input type="number" min="1" class="form-control" id="package_count" name="package_count">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="estimated_weight_kg">Estimated Weight (KG)</label>
                                <input type="text" class="form-control" id="estimated_weight_kg" name="estimated_weight_kg" maxlength="50">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="estimated_dimensions">Estimated Dimensions (Optional)</label>
                                <input type="text" class="form-control" id="estimated_dimensions" name="estimated_dimensions" maxlength="150" placeholder="e.g. 2 pallets, 1.2m x 1m x 1m">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="estimated_value_usd">Estimated Cargo Value (USD)</label>
                                <input type="text" class="form-control" id="estimated_value_usd" name="estimated_value_usd" maxlength="50">
                            </div>
                        </div>
                        <div>
                            <label class="form-label d-block">Does your shipment contain dangerous or hazardous goods? *</label>
                            <?php lsa_radio_group('has_dangerous_goods', ['no' => 'No', 'yes' => 'Yes'], 'no'); ?>
                            <textarea class="form-control mt-2" name="dangerous_goods_details" rows="2" placeholder="If yes, please explain"></textarea>
                        </div>
                    </div>

                    <div class="lsa-card p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mb-4">Section 6 &mdash; Documentation Available</h4>
                        <p class="text-muted small">Please indicate available documents:</p>
                        <?php lsa_checkbox_group('documents_available', $intakeOptions['documents_available']); ?>
                        <input type="text" class="form-control mt-2" name="documents_other" maxlength="255" placeholder="If Other, please specify">
                    </div>

                    <div class="lsa-card p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mb-4">Section 7 &mdash; Optional Services Requested</h4>
                        <?php lsa_checkbox_group('services_requested', $intakeOptions['services_requested']); ?>
                        <input type="text" class="form-control mt-2" name="services_other" maxlength="255" placeholder="If Other, please specify">
                    </div>

                    <div class="lsa-card p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mb-4">Section 8 &mdash; Special Instructions</h4>
                        <textarea class="form-control" name="special_instructions" rows="4"></textarea>
                    </div>

                    <div class="lsa-card p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mb-4">Section 9 &mdash; Customer Compliance Checklist</h4>
                        <p class="text-muted small">Please confirm the following:</p>
                        <?php
                        $acknowledgements = [
                            'ack_accurate_declaration' => 'I have accurately declared all items in this shipment.',
                            'ack_additional_docs' => 'I understand additional documentation may be required.',
                            'ack_inspections' => 'I understand customs and regulatory inspections may occur.',
                            'ack_export_import_regs' => 'I understand shipment acceptance is subject to export and import regulations.',
                            'ack_false_declaration_penalty' => 'I understand false declarations may result in delays, penalties, seizure, rejection, or destruction of cargo.',
                            'ack_additional_info_request' => 'I understand that Let Ship Africa Inc. may request additional information before accepting cargo.',
                            'ack_destination_requirements_vary' => 'I understand that destination-country requirements may vary.',
                        ];
                        foreach ($acknowledgements as $name => $label): ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="<?= e($name) ?>" id="<?= e($name) ?>" value="1" required>
                                <label class="form-check-label small" for="<?= e($name) ?>"><?= e($label) ?></label>
                            </div>
                        <?php endforeach; ?>
                        <hr class="my-4">
                        <div class="mb-3">
                            <label class="form-label d-block">Preferred Communication Method &mdash; How would you like us to contact you? *</label>
                            <?php lsa_radio_group('preferred_contact_method', ['whatsapp' => 'WhatsApp', 'phone' => 'Phone Call', 'email' => 'Email'], 'whatsapp'); ?>
                        </div>
                        <div>
                            <label class="form-label" for="preferred_contact_time">Preferred Contact Time</label>
                            <input type="text" class="form-control" id="preferred_contact_time" name="preferred_contact_time" maxlength="150" placeholder="e.g. weekday mornings, after 3pm">
                        </div>
                    </div>

                    <div class="lsa-card p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mb-4">Section 10 &mdash; Customer Declaration</h4>
                        <p class="small">
                            I certify that all information provided in this form is true, accurate, and complete. I confirm that
                            the shipment does not contain prohibited, restricted, illegal, counterfeit, hazardous, dangerous,
                            undeclared, or misrepresented goods. I acknowledge that customs authorities, regulatory agencies,
                            airlines, shipping lines, warehouses, brokers, and other parties may inspect the shipment. I
                            understand that shipment acceptance remains subject to compliance review and applicable
                            regulations.
                        </p>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="declaration_ack" id="declaration_ack" value="1" required>
                            <label class="form-check-label" for="declaration_ack">I have read, understood, and agree to the declaration above. *</label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="customer_signature_name">Customer Name (typed as signature) *</label>
                            <input type="text" class="form-control" id="customer_signature_name" name="customer_signature_name" required maxlength="150">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-lsa-accent btn-lg fw-semibold px-5">Submit Shipping Inquiry</button>
                        <p class="text-muted small mt-2 mb-0">Once we've reviewed your completed form, we'll prepare and send your customized quotation.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
