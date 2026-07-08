<?php
$pageTitle = 'Logistics Services in Monrovia, Liberia';
$pageDescription = 'Ocean freight, air freight coordination, cargo consolidation, documentation support, and trade facilitation from our Monrovia, Liberia office.';
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
                    Many customers do not have enough cargo to fill an entire shipping container, or need professional
                    assistance navigating international shipping requirements. Our role is to simplify that process through
                    logistics coordination, documentation support, and trusted partnerships &mdash; coordinating the movement
                    of goods from origin to destination while ensuring proper documentation, regulatory compliance, and clear
                    communication throughout.
                </p>
                <p class="mb-0">
                    Our goal is not simply to move cargo. It is to reduce the barriers that stand between our customers and
                    international trade.
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
                    'For customers who need faster transit times, we coordinate air freight through our airline and logistics partners &mdash; suitable for urgent shipments, business samples, documents, and time-sensitive or high-value cargo.',
                    ['Urgent Cargo', 'High-Value Goods', 'Time-Sensitive']],
                ['container-ship.jpg', 'bi-water', 'Ocean Freight',
                    'We coordinate reliable ocean freight through trusted logistics partners for commercial cargo, personal effects, and export shipments &mdash; including Full Container Load (FCL), Less than Container Load (LCL), and shipment planning.',
                    ['FCL & LCL', 'Commercial Cargo', 'Import & Export']],
                ['containers-sunset.jpg', 'bi-boxes', 'Cargo Consolidation',
                    'Customers who do not have enough cargo to fill an entire container can combine their shipment with cargo from other customers &mdash; lowering shipping costs while keeping professional cargo handling and documentation.',
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

<section class="lsa-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2">
                <div class="lsa-about-image-wrap lsa-accent-right">
                    <img src="<?= e(SITE_URL) ?>/assets/img/stock/port-cranes.jpg" class="lsa-about-image" alt="Shipping documents and cargo being reviewed at port" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <p class="lsa-eyebrow mb-2">Why It Matters</p>
                <h2 class="fw-bold mb-3">Documentation Support</h2>
                <p>
                    International shipping depends on accurate documentation. Our guiding principle is simple:
                    <strong>if it is not declared, documented, and compliant, we do not ship it.</strong> We assist customers
                    in preparing and organizing the shipping documents that support compliant international trade, including:
                </p>
                <div class="row row-cols-1 row-cols-sm-2 g-2 mb-3">
                    <?php foreach (['Commercial Invoices', 'Packing Lists', 'Export Documentation', 'Shipping Instructions', 'Supporting Documents'] as $item): ?>
                        <div class="col d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-lsa-accent"></i>
                            <span class="small"><?= e($item) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="mb-0">
                    Proper documentation reduces delays, minimizes risk, and protects our customers, our partners, and our
                    reputation &mdash; on every shipment, every time.
                </p>
            </div>
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
                ['bi-truck', 'Cargo Collection', 'We arrange cargo collection within Liberia through trusted transport partners, for customers who are unable to deliver their cargo to our receiving location.'],
                ['bi-box-seam', 'Export Preparation', 'Preparing cargo for export requires careful planning. We coordinate shipment preparation, documentation review, cargo inspection guidance, and export readiness.'],
                ['bi-box-arrow-in-down', 'Import Coordination', 'Coordinating with suppliers, freight providers, and customs authorities so importing consumer goods, machinery, or commercial products is as smooth as possible.'],
                ['bi-box-arrow-up', 'Export Coordination', 'Helping Liberian businesses prepare agricultural, food, and manufactured products for export by coordinating transportation, documentation, and shipment planning.'],
                ['bi-diagram-3', 'Trade Facilitation', 'Trade facilitation is at the heart of our business &mdash; helping customers understand international trade processes, documentation requirements, and shipment planning.'],
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

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-9">
                <p class="lsa-eyebrow mb-2">Growing With You</p>
                <h2 class="fw-bold mb-3">Expanding Our Services</h2>
                <p class="text-muted mb-0">
                    As Let Ship Africa Inc. grows, we are expanding our capabilities through strategic partnerships. These
                    services are not yet active &mdash; they will be introduced as our operational network continues to
                    expand.
                </p>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-4 g-3 justify-content-center">
            <?php
            $developing = [
                ['bi-bank', 'Customs Brokerage Coordination'],
                ['bi-building', 'Warehousing Partnerships'],
                ['bi-search', 'Product Sourcing'],
                ['bi-cart-check', 'Procurement Support'],
                ['bi-clipboard2-pulse', 'FDA Compliance Guidance'],
                ['bi-geo-alt', 'Last-Mile Delivery Coordination'],
                ['bi-shield-plus', 'Cargo Insurance Coordination'],
                ['bi-lightbulb', 'Import &amp; Export Advisory'],
            ];
            foreach ($developing as [$icon, $title]): ?>
                <div class="col">
                    <div class="lsa-card p-3 text-center h-100 d-flex flex-column align-items-center justify-content-center">
                        <div class="icon-badge icon-badge-navy mb-2"><i class="bi <?= e($icon) ?>"></i></div>
                        <span class="small fw-semibold"><?= $title ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Industries We Serve</h2>
        <div class="row row-cols-2 row-cols-md-3 g-3 justify-content-center">
            <?php foreach ([
                'Agriculture', 'Food Processing', 'Retail &amp; Wholesale', 'Manufacturing',
                'Humanitarian &amp; Non-Profit Organizations', 'Small &amp; Medium Enterprises (SMEs)',
            ] as $industry): ?>
                <div class="col text-center">
                    <span class="badge bg-lsa-navy p-2 w-100"><?= $industry ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-9">
                <p class="lsa-eyebrow mb-2">From Farm to Family</p>
                <h2 class="fw-bold mb-3">Products We Support</h2>
                <p class="text-muted mb-0">
                    Our company began with a shipment of authentic Liberian products bound for the diaspora. We continue to
                    support a wide range of legal agricultural, food, and commercial goods, subject to applicable laws,
                    regulations, and company acceptance policies.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <?php
            $products = [
                ['bi-flower2', 'Agricultural Products', 'Red palm oil, country rice, cocoa, coffee, cassava products, ginger, peppers, sesame, and other legal agricultural products.'],
                ['bi-egg-fried', 'Food Products', 'Dry fish, spices, traditional foods, and processed foods.'],
                ['bi-bag-heart', 'Consumer Goods', 'Clothing, household goods, personal effects, and general merchandise.'],
                ['bi-gear-wide-connected', 'Commercial Cargo', 'Machinery, equipment, auto parts, and business inventory.'],
            ];
            foreach ($products as [$icon, $title, $desc]): ?>
                <div class="col-md-6 col-lg-3 text-center">
                    <div class="icon-badge icon-badge-navy mx-auto mb-3"><i class="bi <?= e($icon) ?>"></i></div>
                    <h5 class="fw-bold"><?= e($title) ?></h5>
                    <p class="text-muted small mb-0"><?= e($desc) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="lsa-section">
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
                        'Compliance-driven operations', 'Professional documentation support', 'Transparent communication',
                        'Customer-focused guidance', 'Growing international partnerships', 'Long-term business support',
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
            Whether you need air freight, ocean freight, cargo consolidation, documentation support, or trade facilitation,
            Let Ship Africa Inc. is ready to guide you through the process.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="<?= e(SITE_URL) ?>/request-quote.php" class="btn btn-lsa-accent btn-lg fw-semibold">Start Your Shipping Inquiry</a>
            <a href="<?= e(SITE_URL) ?>/contact.php" class="btn btn-lsa-outline btn-lg fw-semibold">Speak With Our Logistics Team</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
