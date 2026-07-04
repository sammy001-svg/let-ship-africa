<?php
require_once __DIR__ . '/includes/auth-check.php';

$db = getDb();
$allowedStatuses = ['new', 'read', 'closed'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_status') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        flash_set('error', 'Your session expired. Please try again.');
    } else {
        $id = (int) ($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? '';
        if ($id > 0 && in_array($status, $allowedStatuses, true)) {
            $stmt = $db->prepare('UPDATE contact_messages SET status = :status WHERE id = :id');
            $stmt->execute(['status' => $status, 'id' => $id]);
            flash_set('success', 'Status updated.');
        } else {
            flash_set('error', 'Invalid status update request.');
        }
    }
    header('Location: ' . SITE_URL . '/admin/messages.php');
    exit;
}

$messages = $db->query('SELECT * FROM contact_messages ORDER BY created_at DESC')->fetchAll();

$pageTitle = 'Contact Messages';
$activeNav = 'messages';
require __DIR__ . '/includes/admin-header.php';
?>

<h1 class="h3 fw-bold mb-4">Contact Messages</h1>

<?php if (!$messages): ?>
    <p class="text-muted">No messages have been submitted yet.</p>
<?php endif; ?>

<?php foreach ($messages as $m): ?>
    <div class="lsa-card p-4 mb-3">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h5 class="fw-bold mb-1"><?= e($m['subject']) ?></h5>
                <p class="mb-1 small text-muted">
                    <?= e($m['full_name']) ?> &bull; <?= e($m['email']) ?><?= $m['phone'] ? ' &bull; ' . e($m['phone']) : '' ?>
                </p>
                <p class="mb-0 small text-muted">Submitted <?= e(date('M j, Y g:ia', strtotime($m['created_at']))) ?></p>
            </div>
            <form method="post" class="d-flex align-items-center gap-2">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="update_status">
                <input type="hidden" name="id" value="<?= (int) $m['id'] ?>">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <?php foreach ($allowedStatuses as $s): ?>
                        <option value="<?= e($s) ?>" <?= $m['status'] === $s ? 'selected' : '' ?>><?= e(ucfirst($s)) ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
        <details class="mt-3">
            <summary class="small text-muted">View message</summary>
            <p class="mt-2 small mb-0"><?= nl2br(e($m['message'])) ?></p>
        </details>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
