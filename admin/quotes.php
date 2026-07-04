<?php
require_once __DIR__ . '/includes/auth-check.php';

$db = getDb();
$allowedStatuses = ['new', 'contacted', 'quoted', 'closed'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_status') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        flash_set('error', 'Your session expired. Please try again.');
    } else {
        $id = (int) ($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? '';
        if ($id > 0 && in_array($status, $allowedStatuses, true)) {
            $stmt = $db->prepare('UPDATE quote_requests SET status = :status WHERE id = :id');
            $stmt->execute(['status' => $status, 'id' => $id]);
            flash_set('success', 'Status updated.');
        } else {
            flash_set('error', 'Invalid status update request.');
        }
    }
    header('Location: ' . SITE_URL . '/admin/quotes.php');
    exit;
}

$quotes = $db->query('SELECT * FROM quote_requests ORDER BY created_at DESC')->fetchAll();

$pageTitle = 'Quote Requests';
$activeNav = 'quotes';
require __DIR__ . '/includes/admin-header.php';
?>

<h1 class="h3 fw-bold mb-4">Quote Requests</h1>

<?php if (!$quotes): ?>
    <p class="text-muted">No quote requests have been submitted yet.</p>
<?php endif; ?>

<?php foreach ($quotes as $q): ?>
    <div class="lsa-card p-4 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h5 class="fw-bold mb-1"><?= e($q['full_name']) ?> <span class="text-muted small fw-normal">&mdash; <?= e($q['company'] ?: 'Individual') ?></span></h5>
                <p class="mb-1 small text-muted">
                    <?= e($q['email']) ?> &bull; <?= e($q['phone']) ?> &bull;
                    Submitted <?= e(date('M j, Y g:ia', strtotime($q['created_at']))) ?>
                </p>
                <p class="mb-0">
                    <span class="badge bg-lsa-navy"><?= e(ucfirst($q['shipment_type'])) ?></span>
                    <span class="small ms-2"><?= e($q['origin_country']) ?> &rarr; <?= e($q['destination_country']) ?></span>
                </p>
            </div>
            <form method="post" class="d-flex align-items-center gap-2">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="update_status">
                <input type="hidden" name="id" value="<?= (int) $q['id'] ?>">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <?php foreach ($allowedStatuses as $s): ?>
                        <option value="<?= e($s) ?>" <?= $q['status'] === $s ? 'selected' : '' ?>><?= e(ucfirst($s)) ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
        <details class="mt-3">
            <summary class="small text-muted">View full details</summary>
            <div class="mt-2 small">
                <p><strong>Cargo Description:</strong><br><?= nl2br(e($q['cargo_description'])) ?></p>
                <?php if ($q['weight']): ?><p class="mb-1"><strong>Weight:</strong> <?= e($q['weight']) ?></p><?php endif; ?>
                <?php if ($q['dimensions']): ?><p class="mb-1"><strong>Dimensions:</strong> <?= e($q['dimensions']) ?></p><?php endif; ?>
                <?php if ($q['additional_notes']): ?><p class="mb-0"><strong>Additional Notes:</strong><br><?= nl2br(e($q['additional_notes'])) ?></p><?php endif; ?>
            </div>
        </details>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
