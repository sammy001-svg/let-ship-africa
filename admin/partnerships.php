<?php
require_once __DIR__ . '/includes/auth-check.php';

$db = getDb();
$allowedStatuses = ['new', 'contacted', 'closed'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_status') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        flash_set('error', 'Your session expired. Please try again.');
    } else {
        $id = (int) ($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? '';
        if ($id > 0 && in_array($status, $allowedStatuses, true)) {
            $stmt = $db->prepare('UPDATE partnership_inquiries SET status = :status WHERE id = :id');
            $stmt->execute(['status' => $status, 'id' => $id]);
            flash_set('success', 'Status updated.');
        } else {
            flash_set('error', 'Invalid status update request.');
        }
    }
    header('Location: ' . SITE_URL . '/admin/partnerships.php');
    exit;
}

$inquiries = $db->query('SELECT * FROM partnership_inquiries ORDER BY created_at DESC')->fetchAll();

$pageTitle = 'Partnership Inquiries';
$activeNav = 'partnerships';
require __DIR__ . '/includes/admin-header.php';
?>

<h1 class="h3 fw-bold mb-4">Partnership Inquiries</h1>

<?php if (!$inquiries): ?>
    <p class="text-muted">No partnership inquiries have been submitted yet.</p>
<?php endif; ?>

<?php foreach ($inquiries as $p): ?>
    <div class="lsa-card p-4 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h5 class="fw-bold mb-1"><?= e($p['organization_name']) ?></h5>
                <p class="mb-1 small text-muted">
                    Contact: <?= e($p['contact_name']) ?> &bull; <?= e($p['email']) ?> &bull; <?= e($p['phone']) ?>
                </p>
                <p class="mb-0">
                    <span class="badge bg-lsa-navy"><?= e($p['partner_type']) ?></span>
                    <span class="small ms-2"><?= e($p['country']) ?></span>
                    <span class="small text-muted ms-2">Submitted <?= e(date('M j, Y g:ia', strtotime($p['created_at']))) ?></span>
                </p>
            </div>
            <form method="post" class="d-flex align-items-center gap-2">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="update_status">
                <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <?php foreach ($allowedStatuses as $s): ?>
                        <option value="<?= e($s) ?>" <?= $p['status'] === $s ? 'selected' : '' ?>><?= e(ucfirst($s)) ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
        <?php if ($p['message']): ?>
            <details class="mt-3">
                <summary class="small text-muted">View message</summary>
                <p class="mt-2 small mb-0"><?= nl2br(e($p['message'])) ?></p>
            </details>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
