<?php
require_once __DIR__ . '/includes/auth-check.php';

$db = getDb();
$allowedStatuses = ['new', 'reviewed', 'quoted', 'closed'];
$yesNo = ['yes' => 'Yes', 'no' => 'No'];
$paymentStatuses = ['paid' => 'Paid', 'partial' => 'Partial', 'pending' => 'Pending'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_status') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        flash_set('error', 'Your session expired. Please try again.');
    } else {
        $id = (int) ($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? '';
        if ($id > 0 && in_array($status, $allowedStatuses, true)) {
            $db->prepare('UPDATE shipment_intake_forms SET status = :status WHERE id = :id')->execute(['status' => $status, 'id' => $id]);
            flash_set('success', 'Status updated.');
        } else {
            flash_set('error', 'Invalid status update request.');
        }
    }
    header('Location: ' . SITE_URL . '/admin/intake-forms.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_internal') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        flash_set('error', 'Your session expired. Please try again.');
    } else {
        $id = (int) ($_POST['id'] ?? 0);
        $payment = $_POST['payment_status'] ?? 'pending';
        $stmt = $db->prepare(
            'UPDATE shipment_intake_forms SET
                customer_number = :customer_number, shipment_reference = :shipment_reference, received_by = :received_by,
                cargo_inspection_completed = :cargo_inspection_completed, weight_verified = :weight_verified,
                compliance_review_completed = :compliance_review_completed, broker_referral_required = :broker_referral_required,
                payment_status = :payment_status, internal_remarks = :internal_remarks,
                authorized_by_name = :authorized_by_name, authorized_by_date = :authorized_by_date
             WHERE id = :id'
        );
        $stmt->execute([
            'customer_number' => clean_input($_POST['customer_number'] ?? '') ?: null,
            'shipment_reference' => clean_input($_POST['shipment_reference'] ?? '') ?: null,
            'received_by' => clean_input($_POST['received_by'] ?? '') ?: null,
            'cargo_inspection_completed' => in_array($_POST['cargo_inspection_completed'] ?? '', ['yes', 'no'], true) ? $_POST['cargo_inspection_completed'] : null,
            'weight_verified' => in_array($_POST['weight_verified'] ?? '', ['yes', 'no'], true) ? $_POST['weight_verified'] : null,
            'compliance_review_completed' => in_array($_POST['compliance_review_completed'] ?? '', ['yes', 'no'], true) ? $_POST['compliance_review_completed'] : null,
            'broker_referral_required' => in_array($_POST['broker_referral_required'] ?? '', ['yes', 'no'], true) ? $_POST['broker_referral_required'] : null,
            'payment_status' => in_array($payment, array_keys($paymentStatuses), true) ? $payment : 'pending',
            'internal_remarks' => clean_input($_POST['internal_remarks'] ?? '') ?: null,
            'authorized_by_name' => clean_input($_POST['authorized_by_name'] ?? '') ?: null,
            'authorized_by_date' => clean_input($_POST['authorized_by_date'] ?? '') ?: null,
            'id' => $id,
        ]);
        flash_set('success', 'Internal record updated.');
    }
    header('Location: ' . SITE_URL . '/admin/intake-forms.php');
    exit;
}

$forms = $db->query('SELECT * FROM shipment_intake_forms ORDER BY created_at DESC')->fetchAll();

$pageTitle = 'Shipment Intake Forms';
$activeNav = 'intake-forms';
require __DIR__ . '/includes/admin-header.php';
?>

<h1 class="h3 fw-bold mb-4">Shipment Intake Forms</h1>

<?php if (!$forms): ?>
    <p class="text-muted">No intake forms have been submitted yet. Send one from the <a href="<?= e(SITE_URL) ?>/admin/inquiries.php">Shipping Inquiries</a> page.</p>
<?php endif; ?>

<?php foreach ($forms as $f):
    $cargoTypes = $f['cargo_types'] ? explode(',', $f['cargo_types']) : [];
    $documents = $f['documents_available'] ? explode(',', $f['documents_available']) : [];
    $services = $f['services_requested'] ? explode(',', $f['services_requested']) : [];
?>
    <div class="lsa-card p-4 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h5 class="fw-bold mb-1">
                    <?= e($f['shipper_full_name']) ?> <span class="text-muted small fw-normal">&mdash; <?= e($f['shipper_business_name'] ?: 'Individual') ?></span>
                </h5>
                <p class="mb-1 small text-muted">
                    <?= e($f['shipper_email']) ?> &bull; <?= e($f['shipper_phone']) ?> &bull;
                    Submitted <?= e(date('M j, Y g:ia', strtotime($f['created_at']))) ?>
                    <?php if ($f['inquiry_id']): ?>&bull; Linked to inquiry #<?= (int) $f['inquiry_id'] ?><?php endif; ?>
                </p>
                <p class="mb-0">
                    <span class="badge bg-lsa-navy"><?= e(ucfirst($f['shipment_mode'])) ?> &bull; <?= e(ucfirst($f['direction'])) ?></span>
                    <span class="small ms-2"><?= e($f['origin_city']) ?>, <?= e($f['origin_country']) ?> &rarr; <?= e($f['destination_city']) ?>, <?= e($f['destination_country']) ?></span>
                    <?php if ($f['has_dangerous_goods'] === 'yes'): ?><span class="badge bg-danger ms-2">Dangerous Goods</span><?php endif; ?>
                </p>
            </div>
            <form method="post" class="d-flex align-items-center gap-2">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="update_status">
                <input type="hidden" name="id" value="<?= (int) $f['id'] ?>">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <?php foreach ($allowedStatuses as $s): ?>
                        <option value="<?= e($s) ?>" <?= $f['status'] === $s ? 'selected' : '' ?>><?= e(ucfirst($s)) ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <details class="mt-3">
            <summary class="small text-muted">View full intake form</summary>
            <div class="mt-3 small">
                <h6 class="fw-bold">Section 1 &mdash; Shipment</h6>
                <p>
                    Purpose: <?= e(intake_form_labels('purpose', [$f['purpose']])[0] ?? $f['purpose']) ?><?= $f['purpose_other'] ? ' (' . e($f['purpose_other']) . ')' : '' ?><br>
                    Cargo ready: <?= e($f['cargo_ready_date'] ?: 'Not given') ?> &bull; Requested ship date: <?= e($f['requested_shipment_date'] ?: 'Not given') ?><br>
                    Referral source: <?= e($f['referral_source'] ? (intake_form_labels('referral_source', [$f['referral_source']])[0] ?? $f['referral_source']) : 'Not given') ?><?= $f['referral_source_other'] ? ' (' . e($f['referral_source_other']) . ')' : '' ?>
                </p>

                <h6 class="fw-bold mt-3">Section 2 &mdash; Shipper</h6>
                <p>
                    <?= e($f['shipper_full_name']) ?><?= $f['shipper_business_name'] ? ' &mdash; ' . e($f['shipper_business_name']) : '' ?><br>
                    <?= e($f['shipper_address']) ?>, <?= e($f['shipper_city']) ?><?= $f['shipper_postal_code'] ? ' ' . e($f['shipper_postal_code']) : '' ?>, <?= e($f['shipper_country']) ?><br>
                    Phone: <?= e($f['shipper_phone']) ?><?= $f['shipper_whatsapp'] ? ' &bull; WhatsApp: ' . e($f['shipper_whatsapp']) : '' ?> &bull; <?= e($f['shipper_email']) ?><br>
                    <?= $f['shipper_id_number'] ? 'ID/Passport: ' . e($f['shipper_id_number']) : '' ?>
                </p>

                <h6 class="fw-bold mt-3">Section 3 &mdash; Consignee (Receiver)</h6>
                <p>
                    <?= e($f['consignee_full_name']) ?><?= $f['consignee_business_name'] ? ' &mdash; ' . e($f['consignee_business_name']) : '' ?><br>
                    <?= e($f['consignee_address']) ?>, <?= e($f['consignee_city']) ?><?= $f['consignee_state'] ? ', ' . e($f['consignee_state']) : '' ?><?= $f['consignee_postal_code'] ? ' ' . e($f['consignee_postal_code']) : '' ?>, <?= e($f['consignee_country']) ?><br>
                    Phone: <?= e($f['consignee_phone']) ?><?= $f['consignee_whatsapp'] ? ' &bull; WhatsApp: ' . e($f['consignee_whatsapp']) : '' ?><?= $f['consignee_email'] ? ' &bull; ' . e($f['consignee_email']) : '' ?>
                </p>

                <h6 class="fw-bold mt-3">Section 4 &mdash; Importer of Record</h6>
                <p>
                    Consignee is importer of record: <?= e(ucfirst($f['consignee_is_importer'])) ?>
                    <?php if ($f['consignee_is_importer'] === 'no'): ?>
                        <br><?= e($f['importer_full_name'] ?: 'Not given') ?><?= $f['importer_business_name'] ? ' &mdash; ' . e($f['importer_business_name']) : '' ?><br>
                        <?= $f['importer_phone'] ? 'Phone: ' . e($f['importer_phone']) . ' &bull; ' : '' ?><?= e($f['importer_email'] ?: '') ?><br>
                        <?= $f['importer_tax_id'] ? 'Tax ID: ' . e($f['importer_tax_id']) . ' &bull; ' : '' ?><?= e($f['importer_country'] ?: '') ?>
                    <?php endif; ?>
                </p>

                <h6 class="fw-bold mt-3">Section 5 &mdash; Cargo</h6>
                <p>
                    Types: <?= e(implode(', ', intake_form_labels('cargo_types', $cargoTypes)) ?: 'None') ?><?= $f['cargo_type_other'] ? ' (' . e($f['cargo_type_other']) . ')' : '' ?><br>
                    Packages: <?= e($f['package_count'] ?: 'N/A') ?> &bull; Weight: <?= e($f['estimated_weight_kg'] ?: 'N/A') ?> kg &bull;
                    Dimensions: <?= e($f['estimated_dimensions'] ?: 'N/A') ?> &bull; Value: $<?= e($f['estimated_value_usd'] ?: 'N/A') ?><br>
                    Dangerous goods: <?= e(ucfirst($f['has_dangerous_goods'])) ?><?= $f['dangerous_goods_details'] ? ' &mdash; ' . nl2br(e($f['dangerous_goods_details'])) : '' ?>
                </p>

                <h6 class="fw-bold mt-3">Section 6 &amp; 7 &mdash; Documentation &amp; Services</h6>
                <p>
                    Documents available: <?= e(implode(', ', intake_form_labels('documents_available', $documents)) ?: 'None indicated') ?><?= $f['documents_other'] ? ' (' . e($f['documents_other']) . ')' : '' ?><br>
                    Services requested: <?= e(implode(', ', intake_form_labels('services_requested', $services)) ?: 'None') ?><?= $f['services_other'] ? ' (' . e($f['services_other']) . ')' : '' ?>
                </p>

                <?php if ($f['special_instructions']): ?>
                    <h6 class="fw-bold mt-3">Section 8 &mdash; Special Instructions</h6>
                    <p><?= nl2br(e($f['special_instructions'])) ?></p>
                <?php endif; ?>

                <h6 class="fw-bold mt-3">Section 9 &amp; 10 &mdash; Compliance &amp; Declaration</h6>
                <p>
                    All 7 compliance items acknowledged: <?= ($f['ack_accurate_declaration'] && $f['ack_additional_docs'] && $f['ack_inspections'] && $f['ack_export_import_regs'] && $f['ack_false_declaration_penalty'] && $f['ack_additional_info_request'] && $f['ack_destination_requirements_vary']) ? 'Yes' : 'Incomplete' ?><br>
                    Preferred contact: <?= e(ucfirst($f['preferred_contact_method'])) ?><?= $f['preferred_contact_time'] ? ' &mdash; ' . e($f['preferred_contact_time']) : '' ?><br>
                    Declaration agreed: <?= $f['declaration_ack'] ? 'Yes' : 'No' ?> &bull; Signed: <strong><?= e($f['customer_signature_name']) ?></strong> on <?= e(date('M j, Y', strtotime($f['created_at']))) ?>
                </p>

                <h6 class="fw-bold mt-4">Section 11 &mdash; Internal Use Only</h6>
                <form method="post" class="row g-2 align-items-end">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="update_internal">
                    <input type="hidden" name="id" value="<?= (int) $f['id'] ?>">
                    <div class="col-md-3">
                        <label class="form-label mb-1">Customer Number</label>
                        <input type="text" class="form-control form-control-sm" name="customer_number" value="<?= e($f['customer_number'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label mb-1">Shipment Reference</label>
                        <input type="text" class="form-control form-control-sm" name="shipment_reference" value="<?= e($f['shipment_reference'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label mb-1">Received By</label>
                        <input type="text" class="form-control form-control-sm" name="received_by" value="<?= e($f['received_by'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label mb-1">Payment Status</label>
                        <select class="form-select form-select-sm" name="payment_status">
                            <?php foreach ($paymentStatuses as $val => $label): ?>
                                <option value="<?= e($val) ?>" <?= ($f['payment_status'] ?? 'pending') === $val ? 'selected' : '' ?>><?= e($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label mb-1">Cargo Inspection Completed</label>
                        <select class="form-select form-select-sm" name="cargo_inspection_completed">
                            <option value="">&mdash;</option>
                            <?php foreach ($yesNo as $val => $label): ?>
                                <option value="<?= e($val) ?>" <?= ($f['cargo_inspection_completed'] ?? '') === $val ? 'selected' : '' ?>><?= e($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label mb-1">Weight Verified</label>
                        <select class="form-select form-select-sm" name="weight_verified">
                            <option value="">&mdash;</option>
                            <?php foreach ($yesNo as $val => $label): ?>
                                <option value="<?= e($val) ?>" <?= ($f['weight_verified'] ?? '') === $val ? 'selected' : '' ?>><?= e($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label mb-1">Compliance Review Completed</label>
                        <select class="form-select form-select-sm" name="compliance_review_completed">
                            <option value="">&mdash;</option>
                            <?php foreach ($yesNo as $val => $label): ?>
                                <option value="<?= e($val) ?>" <?= ($f['compliance_review_completed'] ?? '') === $val ? 'selected' : '' ?>><?= e($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label mb-1">Broker Referral Required</label>
                        <select class="form-select form-select-sm" name="broker_referral_required">
                            <option value="">&mdash;</option>
                            <?php foreach ($yesNo as $val => $label): ?>
                                <option value="<?= e($val) ?>" <?= ($f['broker_referral_required'] ?? '') === $val ? 'selected' : '' ?>><?= e($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label mb-1">Remarks</label>
                        <textarea class="form-control form-control-sm" name="internal_remarks" rows="2"><?= e($f['internal_remarks'] ?? '') ?></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label mb-1">Authorized By</label>
                        <input type="text" class="form-control form-control-sm" name="authorized_by_name" value="<?= e($f['authorized_by_name'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label mb-1">Authorization Date</label>
                        <input type="date" class="form-control form-control-sm" name="authorized_by_date" value="<?= e($f['authorized_by_date'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-sm btn-lsa-accent w-100">Save Internal Record</button>
                    </div>
                </form>
            </div>
        </details>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
