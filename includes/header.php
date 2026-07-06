<?php
require_once __DIR__ . '/functions.php';

$pageTitle = $pageTitle ?? SITE_NAME;
$pageDescription = $pageDescription ?? 'Let Ship Africa Inc. — Connecting Liberia to Global Markets Through Reliable Logistics and Trade Solutions.';
$ogImage = $ogImage ?? SITE_URL . '/assets/img/stock/port-aerial.jpg';
$currentPage = basename($_SERVER['SCRIPT_NAME']);
$canonicalUrl = SITE_URL . '/' . $currentPage;

function nav_active(string $page, string $current): string
{
    return $page === $current ? ' active' : '';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?> | <?= e(SITE_NAME) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <link rel="canonical" href="<?= e($canonicalUrl) ?>">

    <link rel="icon" type="image/png" href="<?= e(SITE_URL) ?>/assets/img/favicon.png">
    <link rel="apple-touch-icon" href="<?= e(SITE_URL) ?>/assets/img/favicon.png">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
    <meta property="og:title" content="<?= e($pageTitle) ?> | <?= e(SITE_NAME) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:url" content="<?= e($canonicalUrl) ?>">
    <meta property="og:image" content="<?= e($ogImage) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($pageTitle) ?> | <?= e(SITE_NAME) ?>">
    <meta name="twitter:description" content="<?= e($pageDescription) ?>">
    <meta name="twitter:image" content="<?= e($ogImage) ?>">

    <script type="application/ld+json">
    <?= json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => SITE_NAME,
        'description' => $pageDescription,
        'url' => SITE_URL . '/index.php',
        'image' => $ogImage,
        'logo' => SITE_URL . '/assets/img/logo.png',
        'telephone' => '+231880835470',
        'email' => 'info@letshipafrica.com',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Neezoe Road, Opposite James David Hospital',
            'addressLocality' => 'Paynesville',
            'addressCountry' => 'LR',
        ],
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens' => '09:00',
            'closes' => '17:00',
        ],
    ], JSON_UNESCAPED_SLASHES) ?>
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(SITE_URL) ?>/assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark lsa-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= e(SITE_URL) ?>/index.php">
            <img src="<?= e(SITE_URL) ?>/assets/img/logo.png" alt="Let Ship Africa Inc." class="lsa-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#lsaNav" aria-controls="lsaNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="lsaNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link<?= nav_active('index.php', $currentPage) ?>" href="<?= e(SITE_URL) ?>/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link<?= nav_active('about.php', $currentPage) ?>" href="<?= e(SITE_URL) ?>/about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link<?= nav_active('services.php', $currentPage) ?>" href="<?= e(SITE_URL) ?>/services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link<?= nav_active('partnerships.php', $currentPage) ?>" href="<?= e(SITE_URL) ?>/partnerships.php">Partnerships</a></li>
                <li class="nav-item"><a class="nav-link<?= nav_active('faq.php', $currentPage) ?>" href="<?= e(SITE_URL) ?>/faq.php">FAQ</a></li>
                <li class="nav-item"><a class="nav-link<?= nav_active('contact.php', $currentPage) ?>" href="<?= e(SITE_URL) ?>/contact.php">Contact</a></li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn btn-lsa-accent fw-semibold" href="<?= e(SITE_URL) ?>/request-quote.php">Request a Quote</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php $flash = flash_get(); if ($flash): ?>
    <div class="container mt-3">
        <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : 'success' ?> alert-dismissible fade show" role="alert">
            <?= e($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>
