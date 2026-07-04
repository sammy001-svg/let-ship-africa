<?php
$pageTitle = 'Partnership Opportunities';
$pageDescription = 'Freight forwarders, customs brokers, airlines, shipping lines, and logistics providers — explore partnership opportunities with Let Ship Africa Inc.';
require __DIR__ . '/includes/header.php';
?>

<section class="lsa-hero-photo lsa-hero-sm text-center" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/handshake.jpg');">
    <div class="container">
        <p class="lsa-eyebrow mb-2">Partner With Us</p>
        <h1 class="fw-bold">Building Strong Global Partnerships for Sustainable Growth</h1>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-1">
                <div class="lsa-about-image-wrap">
                    <img src="<?= e(SITE_URL) ?>/assets/img/stock/world-map.jpg" class="lsa-about-image" alt="World map showing global trade routes">
                </div>
            </div>
            <div class="col-lg-6 order-lg-2">
                <p class="lsa-eyebrow mb-2">Partner With Us</p>
                <h2 class="fw-bold mb-3">Logistics Built on Strong Relationships</h2>
                <p>
                    At Let Ship Africa Inc., we believe that international logistics is built on strong relationships. Every
                    successful shipment depends on effective collaboration between freight forwarders, customs brokers, warehouse
                    operators, airlines, shipping lines, and sourcing specialists.
                </p>
                <p class="mb-0">
                    As we continue expanding, we are actively seeking strategic partners who share our commitment to
                    professionalism, integrity, and compliance &mdash; creating a trusted logistics network that connects Liberia
                    with global markets.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section lsa-section-alt text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <i class="bi bi-quote lsa-quote-icon"></i>
                <p class="lsa-pull-quote">
                    Liberia is an emerging market with increasing opportunities in international trade &mdash; and we're looking
                    for partners to grow with us.
                </p>
                <p class="text-muted mb-0">
                    By partnering with Let Ship Africa Inc., your organization gains a reliable local partner committed to
                    supporting business growth, improving trade connections, and delivering professional logistics coordination.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <p class="lsa-eyebrow text-center mb-2">What Guides Us</p>
        <h2 class="fw-bold text-center mb-2">Our Partnership Philosophy</h2>
        <p class="text-center text-muted mb-5">Every partnership should be built on:</p>
        <div class="row row-cols-2 row-cols-md-4 g-3 justify-content-center mb-5">
            <?php
            $philosophy = [
                ['bi-shield-check', 'Trust'],
                ['bi-award', 'Professionalism'],
                ['bi-chat-dots', 'Open Communication'],
                ['bi-graph-up-arrow', 'Mutual Growth'],
                ['bi-file-earmark-check', 'Compliance'],
                ['bi-gear', 'Operational Excellence'],
                ['bi-infinity', 'Long-Term Commitment'],
            ];
            foreach ($philosophy as [$icon, $label]): ?>
                <div class="col">
                    <div class="lsa-card lsa-country-card text-center p-4">
                        <div class="icon-badge icon-badge-navy mx-auto mb-2"><i class="bi <?= e($icon) ?>"></i></div>
                        <span class="fw-semibold small"><?= e($label) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="text-center text-muted mx-auto mb-0" style="max-width: 760px;">
            Our objective is to become the preferred logistics partner for organizations seeking to establish or expand their
            presence in Liberia and West Africa.
        </p>
    </div>
</section>

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Partnership Opportunities</h2>
        <div class="row g-4">
            <?php
            $partners = [
                ['bi-truck', 'Freight Forwarders', 'Coordinate international air and ocean freight shipments while expanding service coverage between Liberia and global markets.'],
                ['bi-file-earmark-check', 'Customs Brokerage Companies', 'Support efficient customs clearance, documentation, regulatory compliance, and cargo release processes.'],
                ['bi-building', 'Warehousing & Distribution Companies', 'Provide cargo receiving, storage, inventory management, consolidation, and distribution services.'],
                ['bi-airplane', 'Airlines & Air Cargo Operators', 'Collaborate on reliable international air freight solutions for commercial and personal shipments.'],
                ['bi-water', 'Shipping Lines & Ocean Freight Companies', 'Support containerized cargo, consolidated shipments, and international ocean transportation services.'],
                ['bi-search', 'Sourcing & Procurement Companies', 'Assist customers in identifying qualified suppliers, negotiating purchases, and managing procurement activities across international markets.'],
                ['bi-geo-alt', 'Last-Mile Delivery Companies', 'Provide efficient final-mile delivery services within destination countries.'],
                ['bi-clipboard-check', 'Cargo Inspection & Quality Assurance Companies', 'Support cargo verification, quality inspections, supplier audits, and pre-shipment inspection services.'],
                ['bi-cpu', 'Technology & Logistics Service Providers', 'We are interested in collaborating with organizations offering innovative logistics technologies, shipment visibility solutions, customs technology, warehouse management systems, and supply chain software.'],
            ];
            foreach ($partners as [$icon, $title, $desc]): ?>
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

<div class="container my-5">
    <div class="lsa-img-band" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/containers-sunset.jpg');" role="img" aria-label="Shipping containers stacked at a port"></div>
</div>

<section class="lsa-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Countries Where We Are Building Partnerships</h2>
                <p>Our current international expansion strategy focuses on developing trusted partnerships in:</p>
                <div class="row row-cols-2 g-2">
                    <?php foreach (['United States', 'United Kingdom', 'China', 'Canada', 'Australia', 'Germany', 'Netherlands', 'Belgium', 'France', 'Other European Countries'] as $country): ?>
                        <div class="col"><span class="badge bg-lsa-navy p-2 w-100">&#8226; <?= e($country) ?></span></div>
                    <?php endforeach; ?>
                </div>
                <p class="mt-3 mb-0 text-muted">We also welcome partnership inquiries from organizations operating in other international markets.</p>
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">What We Offer Our Partners</h2>
                <?php
                $offers = [
                    ['bi-geo-alt', 'Access to the Liberian Market', 'Work with a dedicated logistics company focused on serving businesses, organizations, and individuals throughout Liberia.'],
                    ['bi-megaphone', 'Business Development Support', 'We actively promote our international partners while introducing customers to reliable logistics solutions.'],
                    ['bi-person-badge', 'Professional Local Representation', 'Our team understands the Liberian business environment.'],
                    ['bi-chat-dots', 'Reliable Communication', 'Prompt, professional, and transparent communication.'],
                    ['bi-graph-up-arrow', 'Long-Term Growth Opportunities', 'Additional business opportunities as our customer base and shipment volumes grow.'],
                ];
                foreach ($offers as $i => [$icon, $title, $desc]): ?>
                    <div class="d-flex align-items-start gap-3 <?= $i < count($offers) - 1 ? 'mb-3' : '' ?>">
                        <div class="icon-badge icon-badge-navy flex-shrink-0"><i class="bi <?= e($icon) ?>"></i></div>
                        <div>
                            <span class="fw-semibold d-block"><?= e($title) ?></span>
                            <span class="text-muted small"><?= e($desc) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-9">
                <h2 class="fw-bold mb-4">Our Commitment to Partners</h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3 mb-4">
                    <?php foreach (['Honest Communication', 'Professional Representation', 'Regulatory Compliance', 'Mutual Respect', 'Continuous Improvement', 'Customer-Centered Service', 'Long-Term Collaboration'] as $v): ?>
                        <div class="col d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-lsa-accent"></i>
                            <span><?= e($v) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="text-muted mb-0">Our goal is not simply to establish partnerships&mdash;it is to build relationships that deliver lasting value.</p>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-9">
                <h2 class="fw-bold mb-3">Who Should Contact Us?</h2>
                <p>We encourage inquiries from freight forwarders, customs brokers, airlines, shipping lines, warehouse operators, distribution companies, sourcing specialists, procurement firms, cargo inspection companies, last-mile delivery providers, international logistics companies, and trade facilitation organizations.</p>
                <p class="mb-0">If your organization shares our commitment to professionalism and international trade, we would be pleased to explore opportunities to work together.</p>
            </div>
        </div>
        <p class="lsa-eyebrow text-center mb-2">The Process</p>
        <h2 class="fw-bold text-center mb-5">Partnership Inquiry Process</h2>
        <div class="row g-4 position-relative lsa-timeline">
            <div class="lsa-timeline-line lsa-timeline-line-5 d-none d-lg-block"></div>
            <?php
            $steps = [
                ['bi-file-earmark-text', 'Submit Inquiry', 'Complete our Partnership Inquiry Form.'],
                ['bi-people-fill', 'Review', 'Our Business Development Team reviews your submission.'],
                ['bi-calendar-check', 'Introductory Meeting', 'We discuss our organizations, capabilities, and objectives.'],
                ['bi-diagram-3', 'Define Scope', 'Both parties identify opportunities and define the relationship.'],
                ['bi-file-earmark-check', 'Formalize', 'We formalize the partnership and begin working together.'],
            ];
            foreach ($steps as $i => [$icon, $title, $desc]): ?>
                <div class="col-md-6 col-lg text-center">
                    <div class="lsa-step-number mx-auto mb-3"><i class="bi <?= e($icon) ?>"></i></div>
                    <h6 class="fw-bold"><?= e($title) ?></h6>
                    <p class="text-muted small mb-0"><?= e($desc) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="lsa-hero text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Ready to Partner With Us?</h2>
        <p class="lsa-text-on-dark mb-4 mx-auto" style="max-width: 760px;">
            International trade is built on collaboration. Together, we can build stronger logistics solutions, connect new
            markets, and create lasting value for businesses around the world.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="<?= e(SITE_URL) ?>/partnership-inquiry.php" class="btn btn-lsa-accent btn-lg fw-semibold">Complete the Partnership Inquiry Form</a>
            <a href="<?= e(SITE_URL) ?>/contact.php" class="btn btn-lsa-outline btn-lg fw-semibold">Contact Our Business Development Team</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
