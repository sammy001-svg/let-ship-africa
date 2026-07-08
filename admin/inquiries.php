<?php
require_once __DIR__ . '/includes/auth-check.php';

$db = getDb();
$allowedStatuses = ['new', 'contacted', 'intake_sent', 'quoted', 'closed'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_status') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        flash_set('error', 'Your session expired. Please try again.');
    } else {
        $id = (int) ($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? '';
        if ($id > 0 && in_array($status, $allowedStatuses, true)) {
            $stmt = $db->prepare('UPDATE shipping_inquiries SET status = :status WHERE id = :id');
            $stmt->execute(['status' => $status, 'id' => $id]);
            flash_set('success', 'Status updated.');
        } else {
            flash_set('error', 'Invalid status update request.');
        }
    }
    header('Location: ' . SITE_URL . '/admin/inquiries.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'send_intake_form') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        flash_set('error', 'Your session expired. Please try again.');
    } else {
        $id = (int) ($_POST['id'] ?? 0);
        $stmt = $db->prepare('SELECT * FROM shipping_inquiries WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $inquiry = $stmt->fetch();

        if (!$inquiry) {
            flash_set('error', 'Inquiry not found.');
        } else {
            $intakeUrl = SITE_URL . '/shipment-intake-form.php?inquiry_id=' . $inquiry['id'];
            $body = sprintf(
                '<p>Hi %s,</p>
                <p>Thanks for speaking with our team. To prepare your customized shipping quotation, please complete our
                Shipment Intake Form using the link below:</p>
                <p><a href="%s">%s</a></p>
                <p>It only takes a couple of minutes, and your contact details are already filled in for you.</p>
                <p>Best regards,<br>%s</p>',
                e($inquiry['full_name']), e($intakeUrl), e($intakeUrl), e(SITE_NAME)
            );
            $sent = send_customer_email($inquiry['email'], $inquiry['full_name'], 'Please Complete Your Shipment Intake Form — ' . SITE_NAME, $body);

            if ($sent) {
                $db->prepare("UPDATE shipping_inquiries SET status = 'intake_sent' WHERE id = :id")->execute(['id' => $id]);
                flash_set('success', 'Intake form link emailed to ' . $inquiry['full_name'] . '.');
            } else {
                flash_set('error', 'Could not send the email. Check the SMTP settings in config.php.');
            }
        }
    }
    header('Location: ' . SITE_URL . '/admin/inquiries.php');
    exit;
}

$inquiries = $db->query('SELECT * FROM shipping_inquiries ORDER BY created_at DESC')->fetchAll();

$pageTitle = 'Shipping Inquiries';
$activeNav = 'inquiries';
require __DIR__ . '/includes/admin-header.php';
?>

<h1 class="h3 fw-bold mb-4">Shipping Inquiries</h1>

<?php if (!$inquiries): ?>
    <p class="text-muted">No shipping inquiries have been submitted yet.</p>
<?php endif; ?>

<?php foreach ($inquiries as $q): ?>
    <div class="lsa-card p-4 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h5 class="fw-bold mb-1"><?= e($q['full_name']) ?> <span class="text-muted small fw-normal">&mdash; <?= e($q['company'] ?: 'Individual') ?></span></h5>
                <p class="mb-1 small text-muted">
                    <?= e($q['email']) ?> &bull; <?= e($q['phone']) ?> &bull;
                    Submitted <?= e(date('M j, Y g:ia', strtotime($q['created_at']))) ?>
                </p>
                <p class="mb-0"><?= nl2br(e($q['message'])) ?></p>
            </div>
            <div class="d-flex flex-column align-items-stretch gap-2" style="min-width: 220px;">
                <form method="post" class="d-flex align-items-center gap-2">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="update_status">
                    <input type="hidden" name="id" value="<?= (int) $q['id'] ?>">
                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                        <?php foreach ($allowedStatuses as $s): ?>
                            <option value="<?= e($s) ?>" <?= $q['status'] === $s ? 'selected' : '' ?>><?= e(ucfirst(str_replace('_', ' ', $s))) ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
                <form method="post" onsubmit="return confirm('Email the Shipment Intake Form link to this customer?');">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="send_intake_form">
                    <input type="hidden" name="id" value="<?= (int) $q['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-lsa-accent w-100">Send Intake Form</button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
