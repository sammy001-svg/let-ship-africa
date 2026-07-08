<?php
$pageTitle = 'Logistics Services in Monrovia, Liberia';
$pageDescription = 'Air freight, ocean freight, cargo consolidation, import/export coordination, sourcing, procurement, and trade facilitation services from our Monrovia, Liberia office.';
require __DIR__ . '/includes/header.php';
?>

<section class="lsa-hero-photo lsa-hero-sm text-center" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/cargo-plane.jpg');">
    <div class="container">
        <p class="lsa-eyebrow mb-2">What We Offer</p>
        <h1 class="fw-bold">Comprehensive Logistics and Trade Solutions</h1>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row justify-content-center text-center mb-4">
            <div class="col-lg-9">
                <p>
                    At Let Ship Africa Inc., we provide integrated logistics and trade solutions designed to help businesses,
                    organizations, and individuals move goods across international borders with confidence. Whether you are
                    importing products, exporting Liberian goods, sourcing from international suppliers, or expanding into new
                    markets, our experienced team is committed to delivering reliable, professional, and customer-focused solutions.
                </p>
                <p class="mb-0">
                    Our goal is to simplify international trade by coordinating every stage of the logistics process while
                    maintaining transparency, compliance, and excellent customer service.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <p class="lsa-eyebrow text-center mb-2">Core Freight Services</p>
        <h2 class="fw-bold text-center mb-5">Moving Your Cargo</h2>
        <div class="row g-4">
            <?php
            $coreServices = [
                ['cargo-plane.jpg', 'bi-airplane', 'Air Freight',
                    'Fast, secure air cargo for urgent commercial and personal shipments, coordinated with trusted airline partners from origin to destination.',
                    ['Urgent Cargo', 'High-Value Goods', 'Time-Sensitive']],
                ['container-ship.jpg', 'bi-water', 'Ocean Freight',
                    'Cost-effective sea freight for full container loads (FCL) and less-than-container loads (LCL), balancing cost, efficiency, and reliability.',
                    ['FCL & LCL', 'Commercial Cargo', 'Import & Export']],
                ['containers-sunset.jpg', 'bi-boxes', 'Cargo Consolidation',
                    'Combine shipments with other customers to reduce transportation costs while maintaining professional cargo management and documentation.',
                    ['Small Businesses', 'Entrepreneurs', 'Online Sellers']],
            ];
            foreach ($coreServices as [$img, $icon, $title, $desc, $tags]): ?>
                <div class="col-lg-4">
                    <div class="lsa-card lsa-service-card h-100">
                        <div class="lsa-service-card-img" style="background-image: url('<?= e(SITE_URL . '/assets/img/stock/' . $img) ?>');">
                            <div class="icon-badge"><i class="bi <?= e($icon) ?>"></i></div>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h3 class="fw-bold"><?= e($title) ?></h3>
                            <p class="text-muted"><?= e($desc) ?></p>
                            <div class="d-flex flex-wrap gap-2 mt-auto">
                                <?php foreach ($tags as $tag): ?>
                                    <span class="badge bg-lsa-navy"><?= e($tag) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="container my-5">
    <div class="lsa-img-band" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/warehouse-forklift.jpg');" role="img" aria-label="Warehouse forklift moving pallets"></div>
</div>

<section class="lsa-section">
    <div class="container">
        <p class="lsa-eyebrow text-center mb-2">Trade Support Services</p>
        <h2 class="fw-bold text-center mb-5">Coordinating Every Step</h2>
        <div class="row g-4">
            <?php
            $supportServices = [
                ['bi-box-arrow-in-down', 'Import Services', 'Coordinating with suppliers, freight providers, and customs authorities so importing consumer goods, machinery, or commercial products is as smooth as possible.'],
                ['bi-box-arrow-up', 'Export Services', 'Helping Liberian businesses prepare agricultural, food, and manufactured products for export by coordinating transportation, documentation, and shipment planning.'],
                ['bi-search', 'Sourcing & Procurement', 'Identifying reliable suppliers, coordinating purchases, and supporting international buying activities without the need to maintain overseas offices.'],
                ['bi-diagram-3', 'Trade Facilitation', 'Coordinating communication and logistics between suppliers, freight forwarders, customs brokers, warehouses, and transportation providers.'],
                ['bi-clipboard-check', 'Logistics Consultation', 'Practical, tailored guidance whether you are shipping for the first time or managing ongoing international trade operations.'],
            ];
            foreach ($supportServices as [$icon, $title, $desc]): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="lsa-card p-4 h-100">
                        <div class="icon-badge icon-badge-navy mb-3"><i class="bi <?= e($icon) ?>"></i></div>
                        <h5 class="fw-bold"><?= e($title) ?></h5>
                        <p class="text-muted mb-0 small"><?= e($desc) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Industries We Support</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 justify-content-center">
            <?php foreach ([
                'Retail and Wholesale', 'Agriculture', 'Manufacturing', 'Construction', 'Healthcare',
                'Education', 'Government Institutions', 'Non-Governmental Organizations (NGOs)',
                'E-commerce Businesses', 'Small and Medium Enterprises (SMEs)',
            ] as $industry): ?>
                <div class="col text-center">
                    <span class="badge bg-lsa-navy p-2 w-100"><?= e($industry) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <div class="row justify-content-center text-center mb-4">
            <div class="col-lg-9">
                <h2 class="fw-bold mb-3">Why Choose Our Services?</h2>
                <p class="text-muted mb-0">When you choose Let Ship Africa Inc., you benefit from:</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3 mb-4">
                    <?php foreach ([
                        'Professional logistics coordination', 'Customer-focused service', 'Reliable communication',
                        'Compliance-driven operations', 'Growing international partnerships', 'Practical shipping solutions',
                        'Long-term business support',
                    ] as $item): ?>
                        <div class="col d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-lsa-accent"></i>
                            <span><?= e($item) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="text-muted text-center mb-0">We are committed to helping every customer move goods efficiently, responsibly, and with confidence.</p>
            </div>
        </div>
    </div>
</section>

<section class="lsa-hero text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Ready to Ship?</h2>
        <p class="lsa-text-on-dark mb-4 mx-auto" style="max-width: 760px;">
            Whether you need air freight, ocean freight, cargo consolidation, import support, export coordination, sourcing,
            procurement, or trade facilitation, Let Ship Africa Inc. is ready to help.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="<?= e(SITE_URL) ?>/request-quote.php" class="btn btn-lsa-accent btn-lg fw-semibold">Start Your Shipping Inquiry</a>
            <a href="<?= e(SITE_URL) ?>/contact.php" class="btn btn-lsa-outline btn-lg fw-semibold">Speak With Our Logistics Team</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
