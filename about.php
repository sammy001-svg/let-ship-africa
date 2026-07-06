<?php
$pageTitle = 'About Us';
$pageDescription = 'A Liberia-based logistics and trade facilitation company helping businesses and individuals trade internationally with confidence.';
require __DIR__ . '/includes/header.php';
?>

<section class="lsa-hero-photo lsa-hero-sm text-center" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/containers-sunset.jpg');">
    <div class="container">
        <p class="lsa-eyebrow mb-2">About Let Ship Africa Inc.</p>
        <h1 class="fw-bold">Building Bridges Between Liberia and Global Markets</h1>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-1">
                <div class="lsa-about-image-wrap">
                    <img src="<?= e(SITE_URL) ?>/assets/img/stock/port-cranes.jpg" class="lsa-about-image" alt="Busy shipping port with cranes and cargo containers" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6 order-lg-2">
                <p class="lsa-eyebrow mb-2">Who We Are</p>
                <h2 class="fw-bold mb-3">A Trusted Logistics Partner, Founded in Liberia</h2>
                <p>
                    International trade has the power to create jobs, strengthen businesses, and connect communities across the
                    world. At Let Ship Africa Inc., we believe every business&mdash;regardless of its size&mdash;should have access
                    to reliable logistics services and global trade opportunities.
                </p>
                <p class="mb-0">
                    We specialize in air freight, ocean freight, cargo consolidation, sourcing, procurement, and trade facilitation.
                    As global commerce evolves, our commitment stays the same: helping customers connect with international
                    markets through reliable, transparent, and professional logistics services.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-1">
                <p class="lsa-eyebrow mb-2">Our Story</p>
                <h2 class="fw-bold mb-3">Bridging Liberia and the Global Marketplace</h2>
                <p>
                    Let Ship Africa Inc. was established with a clear purpose&mdash;to bridge the gap between Liberia and the
                    global marketplace. We recognized that businesses and individuals faced real challenges importing goods,
                    exporting Liberian products, and finding trustworthy suppliers, often encountering unreliable information and
                    unnecessary complexity along the way.
                </p>
                <p class="mb-0">
                    These experiences inspired us to build a company focused on professionalism, compliance, transparency, and
                    long-term partnerships &mdash; where every shipment is an opportunity to strengthen businesses and contribute
                    to Liberia's economic development.
                </p>
            </div>
            <div class="col-lg-6 order-lg-2">
                <div class="lsa-about-image-wrap lsa-accent-right">
                    <img src="<?= e(SITE_URL) ?>/assets/img/stock/container-ship.jpg" class="lsa-about-image" alt="Container ship at sea" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="lsa-card p-4 h-100">
                    <div class="icon-badge mb-3"><i class="bi bi-bullseye"></i></div>
                    <h3 class="fw-bold">Our Mission</h3>
                    <p class="mb-0">
                        To simplify international trade by delivering reliable logistics, sourcing, procurement, and trade
                        facilitation services that connect Liberia with global markets while maintaining the highest standards of
                        professionalism, integrity, transparency, and customer service.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="lsa-card p-4 h-100">
                    <div class="icon-badge mb-3"><i class="bi bi-binoculars"></i></div>
                    <h3 class="fw-bold">Our Vision</h3>
                    <p class="mb-0">
                        To become Liberia's most trusted international logistics and trade facilitation company by connecting
                        businesses, entrepreneurs, and communities with opportunities across Africa and the world through
                        innovative logistics solutions and strategic global partnerships.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Our Core Values</h2>
        <div class="row g-4">
            <?php
            $values = [
                ['bi-hand-thumbs-up', 'Integrity', 'Trust is the foundation of every successful business relationship. We are committed to honesty, ethical conduct, and transparency in every interaction.'],
                ['bi-award', 'Professionalism', 'We strive to deliver services that reflect careful planning, clear communication, and attention to detail. Every shipment deserves our highest level of commitment.'],
                ['bi-shield-check', 'Compliance', 'International logistics requires proper documentation and adherence to applicable regulations. Our guiding principle is simple: if it is not properly documented, we do not ship it. This protects our customers, our partners, and our reputation.'],
                ['bi-people-fill', 'Customer Commitment', 'Our customers are at the center of everything we do. We listen carefully, understand their objectives, and work to provide practical logistics solutions that meet their unique needs.'],
                ['bi-diagram-3', 'Partnership', 'Strong partnerships create stronger logistics solutions. We value long-term relationships with customers, suppliers, freight forwarders, customs brokers, warehouse operators, airlines, shipping companies, and procurement specialists around the world.'],
                ['bi-graph-up-arrow', 'Continuous Improvement', 'International trade is constantly evolving. We are committed to learning, improving our processes, embracing innovation, and strengthening our capabilities to better serve our customers.'],
            ];
            foreach ($values as [$icon, $title, $desc]): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="lsa-card p-4">
                        <div class="icon-badge mb-3"><i class="bi <?= e($icon) ?>"></i></div>
                        <h5 class="fw-bold"><?= e($title) ?></h5>
                        <p class="text-muted mb-0"><?= e($desc) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">What We Do</h2>
                <p>Let Ship Africa Inc. provides integrated logistics and trade support services, including:</p>
                <div class="row row-cols-2 g-2 mb-3">
                    <?php foreach ([
                        'Air Freight', 'Ocean Freight', 'Cargo Consolidation', 'Import Coordination',
                        'Export Coordination', 'Sourcing & Procurement', 'Trade Facilitation', 'Logistics Consultation',
                    ] as $item): ?>
                        <div class="col d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-lsa-accent"></i>
                            <span class="small"><?= e($item) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="mb-0">
                    Our objective is not simply to move cargo. Our objective is to help customers overcome the challenges of
                    international trade by providing dependable logistics support and trusted guidance.
                </p>
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Building a Global Network</h2>
                <p>
                    International logistics depends on collaboration. That is why we are actively developing strategic
                    partnerships with freight forwarders, customs brokers, warehouse operators, airlines, shipping companies,
                    sourcing specialists, procurement firms, and logistics professionals across key global markets.
                </p>
                <p class="mb-0">
                    Our growing international network enables us to expand opportunities for our customers while strengthening
                    trade connections between Liberia and the rest of the world.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="container my-5">
    <div class="lsa-img-band" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/handshake.jpg');" role="img" aria-label="Business partners shaking hands"></div>
</div>

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-9">
                <p class="lsa-eyebrow mb-2">Our Impact</p>
                <h2 class="fw-bold mb-3">Supporting Liberia's Economic Growth</h2>
                <p class="text-muted mb-0">
                    We believe logistics is more than transportation. By helping businesses import quality products and export
                    locally produced goods, we aim to contribute to Liberia's long-term economic development.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <?php
            $impact = [
                ['bi-briefcase-fill', 'Job Creation', 'Efficient logistics supports entrepreneurship and creates employment.'],
                ['bi-diagram-3-fill', 'Stronger Supply Chains', 'Reliable coordination strengthens supply chains for local businesses.'],
                ['bi-globe2', 'New Markets', 'Opening new international markets for Liberian products and producers.'],
            ];
            foreach ($impact as [$icon, $title, $desc]): ?>
                <div class="col-md-4">
                    <div class="lsa-card p-4 text-center h-100">
                        <div class="icon-badge mx-auto mb-3"><i class="bi <?= e($icon) ?>"></i></div>
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
        <div class="row justify-content-center text-center mb-4">
            <div class="col-lg-9">
                <h2 class="fw-bold mb-3">Our Commitment to Customers</h2>
                <p class="text-muted mb-0">When you choose Let Ship Africa Inc., you gain more than a logistics provider. You gain a partner committed to:</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3 mb-4">
                    <?php foreach (['Professional service', 'Clear communication', 'Responsible business practices', 'Regulatory compliance', 'Long-term relationships', 'Continuous improvement'] as $item): ?>
                        <div class="col d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-lsa-accent"></i>
                            <span><?= e($item) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="text-muted text-center mb-0">
                    Every shipment entrusted to us represents a responsibility we take seriously, and we are committed to
                    providing the guidance and support our customers need throughout their logistics journey.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="lsa-hero text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Let's Build the Future of Trade Together</h2>
        <p class="lsa-text-on-dark mb-4 mx-auto" style="max-width: 760px;">
            Thank you for taking the time to learn about Let Ship Africa Inc. We invite you to explore our services, request a
            shipping quotation, or contact our team to discuss how we can support your international logistics needs.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="<?= e(SITE_URL) ?>/services.php" class="btn btn-lsa-accent btn-lg fw-semibold">Explore Our Services</a>
            <a href="<?= e(SITE_URL) ?>/contact.php" class="btn btn-lsa-outline btn-lg fw-semibold">Contact Our Team</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
