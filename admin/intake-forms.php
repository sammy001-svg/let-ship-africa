<?php
require_once __DIR__ . '/includes/auth-check.php';

$db = getDb();
$allowedStatuses = ['new', 'reviewed', 'quoted', 'closed'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_status') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        flash_set('error', 'Your session expired. Please try again.');
    } else {
        $id = (int) ($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? '';
        if ($id > 0 && in_array($status, $allowedStatuses, true)) {
            $stmt = $db->prepare('UPDATE shipment_intake_forms SET status = :status WHERE id = :id');
            $stmt->execute(['status' => $status, 'id' => $id]);
            flash_set('success', 'Status updated.');
        } else {
            flash_set('error', 'Invalid status update request.');
        }
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

<?php foreach ($forms as $f): ?>
    <div class="lsa-card p-4 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h5 class="fw-bold mb-1">
                    <?= e($f['full_name']) ?> <span class="text-muted small fw-normal">&mdash; <?= e($f['company'] ?: 'Individual') ?></span>
                </h5>
                <p class="mb-1 small text-muted">
                    <?= e($f['email']) ?> &bull; <?= e($f['phone']) ?> &bull;
                    Submitted <?= e(date('M j, Y g:ia', strtotime($f['created_at']))) ?>
                    <?php if ($f['inquiry_id']): ?>&bull; Linked to inquiry #<?= (int) $f['inquiry_id'] ?><?php endif; ?>
                </p>
                <p class="mb-0">
                    <span class="badge bg-lsa-navy"><?= e(ucfirst($f['shipment_type'])) ?></span>
                    <span class="small ms-2"><?= e($f['origin_country']) ?> &rarr; <?= e($f['destination_country']) ?></span>
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
            <summary class="small text-muted">View full details</summary>
            <div class="mt-2 small">
                <p><strong>Cargo Description:</strong><br><?= nl2br(e($f['cargo_description'])) ?></p>
                <?php if ($f['weight']): ?><p class="mb-1"><strong>Weight:</strong> <?= e($f['weight']) ?></p><?php endif; ?>
                <?php if ($f['dimensions']): ?><p class="mb-1"><strong>Dimensions:</strong> <?= e($f['dimensions']) ?></p><?php endif; ?>
                <?php if ($f['additional_notes']): ?><p class="mb-0"><strong>Additional Notes:</strong><br><?= nl2br(e($f['additional_notes'])) ?></p><?php endif; ?>
            </div>
        </details>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
