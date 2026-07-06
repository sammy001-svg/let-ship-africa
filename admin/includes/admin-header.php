<?php
// Expects $pageTitle and $activeNav to be set by the including page.
$activeNav = $activeNav ?? '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? 'Admin') ?> | <?= e(SITE_NAME) ?> Admin</title>
    <link rel="icon" type="image/png" href="<?= e(SITE_URL) ?>/assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(SITE_URL) ?>/assets/css/style.css">
</head>
<body class="bg-lsa-light">

<nav class="navbar navbar-dark lsa-navbar">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold mb-0">Let Ship Africa <span class="text-lsa-accent">Admin</span></span>
        <div class="d-flex align-items-center gap-3">
            <span class="text-light small"><?= e($_SESSION['admin_name'] ?? '') ?></span>
            <a href="<?= e(SITE_URL) ?>/admin/logout.php" class="btn btn-sm btn-lsa-outline">Log Out</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 bg-lsa-navy min-vh-100 py-4 d-none d-lg-block">
            <ul class="nav flex-column">
                <li class="nav-item mb-1">
                    <a class="nav-link text-light<?= $activeNav === 'dashboard' ? ' fw-bold text-lsa-accent' : '' ?>" href="<?= e(SITE_URL) ?>/admin/dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-light<?= $activeNav === 'quotes' ? ' fw-bold text-lsa-accent' : '' ?>" href="<?= e(SITE_URL) ?>/admin/quotes.php">Quote Requests</a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-light<?= $activeNav === 'partnerships' ? ' fw-bold text-lsa-accent' : '' ?>" href="<?= e(SITE_URL) ?>/admin/partnerships.php">Partnership Inquiries</a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link text-light<?= $activeNav === 'messages' ? ' fw-bold text-lsa-accent' : '' ?>" href="<?= e(SITE_URL) ?>/admin/messages.php">Contact Messages</a>
                </li>
                <li class="nav-item mt-3 border-top border-secondary pt-3">
                    <a class="nav-link text-light" href="<?= e(SITE_URL) ?>/index.php" target="_blank">View Public Site &#8599;</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 py-4">
            <?php $flash = flash_get(); if ($flash): ?>
                <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : 'success' ?> alert-dismissible fade show" role="alert">
                    <?= e($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
