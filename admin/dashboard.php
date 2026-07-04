<?php
require_once __DIR__ . '/includes/auth-check.php';

$db = getDb();
$quoteCount = (int) $db->query("SELECT COUNT(*) FROM quote_requests")->fetchColumn();
$partnershipCount = (int) $db->query("SELECT COUNT(*) FROM partnership_inquiries")->fetchColumn();
$messageCount = (int) $db->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
$newQuoteCount = (int) $db->query("SELECT COUNT(*) FROM quote_requests WHERE status = 'new'")->fetchColumn();
$newPartnershipCount = (int) $db->query("SELECT COUNT(*) FROM partnership_inquiries WHERE status = 'new'")->fetchColumn();
$newMessageCount = (int) $db->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'")->fetchColumn();

$recentQuotes = $db->query("SELECT id, full_name, shipment_type, status, created_at FROM quote_requests ORDER BY created_at DESC LIMIT 5")->fetchAll();
$recentPartnerships = $db->query("SELECT id, organization_name, status, created_at FROM partnership_inquiries ORDER BY created_at DESC LIMIT 5")->fetchAll();
$recentMessages = $db->query("SELECT id, full_name, subject, status, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 5")->fetchAll();

$pageTitle = 'Dashboard';
$activeNav = 'dashboard';
require __DIR__ . '/includes/admin-header.php';
?>

<h1 class="h3 fw-bold mb-4">Dashboard</h1>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="lsa-card p-4">
            <p class="text-muted mb-1">Quote Requests</p>
            <h2 class="fw-bold mb-0"><?= $quoteCount ?></h2>
            <span class="badge bg-lsa-navy mt-2"><?= $newQuoteCount ?> new</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="lsa-card p-4">
            <p class="text-muted mb-1">Partnership Inquiries</p>
            <h2 class="fw-bold mb-0"><?= $partnershipCount ?></h2>
            <span class="badge bg-lsa-navy mt-2"><?= $newPartnershipCount ?> new</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="lsa-card p-4">
            <p class="text-muted mb-1">Contact Messages</p>
            <h2 class="fw-bold mb-0"><?= $messageCount ?></h2>
            <span class="badge bg-lsa-navy mt-2"><?= $newMessageCount ?> new</span>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="lsa-card p-4">
            <h6 class="fw-bold mb-3">Recent Quote Requests</h6>
            <?php if (!$recentQuotes): ?><p class="text-muted small mb-0">No quote requests yet.</p><?php endif; ?>
            <?php foreach ($recentQuotes as $q): ?>
                <div class="d-flex justify-content-between border-bottom py-2 small">
                    <span><?= e($q['full_name']) ?> &mdash; <?= e($q['shipment_type']) ?></span>
                    <span class="badge bg-secondary"><?= e($q['status']) ?></span>
                </div>
            <?php endforeach; ?>
            <a href="<?= e(SITE_URL) ?>/admin/quotes.php" class="small d-block mt-3">View all &rarr;</a>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="lsa-card p-4">
            <h6 class="fw-bold mb-3">Recent Partnership Inquiries</h6>
            <?php if (!$recentPartnerships): ?><p class="text-muted small mb-0">No partnership inquiries yet.</p><?php endif; ?>
            <?php foreach ($recentPartnerships as $p): ?>
                <div class="d-flex justify-content-between border-bottom py-2 small">
                    <span><?= e($p['organization_name']) ?></span>
                    <span class="badge bg-secondary"><?= e($p['status']) ?></span>
                </div>
            <?php endforeach; ?>
            <a href="<?= e(SITE_URL) ?>/admin/partnerships.php" class="small d-block mt-3">View all &rarr;</a>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="lsa-card p-4">
            <h6 class="fw-bold mb-3">Recent Contact Messages</h6>
            <?php if (!$recentMessages): ?><p class="text-muted small mb-0">No messages yet.</p><?php endif; ?>
            <?php foreach ($recentMessages as $m): ?>
                <div class="d-flex justify-content-between border-bottom py-2 small">
                    <span><?= e($m['full_name']) ?> &mdash; <?= e($m['subject']) ?></span>
                    <span class="badge bg-secondary"><?= e($m['status']) ?></span>
                </div>
            <?php endforeach; ?>
            <a href="<?= e(SITE_URL) ?>/admin/messages.php" class="small d-block mt-3">View all &rarr;</a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
