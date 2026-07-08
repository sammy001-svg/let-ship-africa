<?php
$pageTitle = 'Freight Forwarding & Logistics in Monrovia, Liberia';
$pageDescription = 'Monrovia-based freight forwarder offering air freight, ocean freight, cargo consolidation, sourcing, and trade facilitation — connecting Liberia to global markets.';
require __DIR__ . '/includes/header.php';
?>

<div id="heroCarousel" class="carousel slide lsa-hero-carousel" data-bs-ride="carousel" data-bs-pause="hover">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/port-aerial.jpg');">
            <div class="container text-center">
                <p class="lsa-eyebrow mb-2">Liberia &bull; International Logistics</p>
                <h1 class="mb-3">Connecting Liberia to Global Markets</h1>
                <p class="lsa-hero-sub mb-4">Your trusted guide through freight, trade facilitation, and sourcing &mdash; from first inquiry to final delivery.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="<?= e(SITE_URL) ?>/request-quote.php" class="btn btn-lsa-accent btn-lg fw-semibold">Start Your Shipping Inquiry</a>
                    <a href="<?= e(SITE_URL) ?>/partnership-inquiry.php" class="btn btn-lsa-outline btn-lg fw-semibold">Become a Logistics Partner</a>
                </div>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/cargo-plane.jpg');">
            <div class="container text-center">
                <p class="lsa-eyebrow mb-2">Air &amp; Ocean Freight</p>
                <h2 class="mb-3">Fast, Reliable Freight Solutions</h2>
                <p class="lsa-hero-sub mb-4">Air, ocean, and consolidated cargo &mdash; moved with confidence.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="<?= e(SITE_URL) ?>/services.php" class="btn btn-lsa-accent btn-lg fw-semibold">Explore Our Services</a>
                </div>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/handshake.jpg');">
            <div class="container text-center">
                <p class="lsa-eyebrow mb-2">Global Partnerships</p>
                <h2 class="mb-3">Trusted Partners. Real Results.</h2>
                <p class="lsa-hero-sub mb-4">A growing network of freight forwarders, brokers, and carriers worldwide.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="<?= e(SITE_URL) ?>/partnership-inquiry.php" class="btn btn-lsa-accent btn-lg fw-semibold">Become a Logistics Partner</a>
                </div>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/containers-sunset.jpg');">
            <div class="container text-center">
                <p class="lsa-eyebrow mb-2">Compliance-First Logistics</p>
                <h2 class="mb-3">If It's Not Documented, We Don't Ship It.</h2>
                <p class="lsa-hero-sub mb-4">Professional, transparent, and compliant &mdash; every shipment, every time.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="<?= e(SITE_URL) ?>/contact.php" class="btn btn-lsa-accent btn-lg fw-semibold">Contact Our Team</a>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<section class="lsa-trust-bar py-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3 d-flex align-items-start gap-3">
                <div class="icon-badge icon-badge-navy flex-shrink-0"><i class="bi bi-geo-alt-fill"></i></div>
                <div>
                    <span class="fw-semibold d-block small">Real Office, Real Address</span>
                    <span class="text-muted small">Paynesville, Liberia</span>
                </div>
            </div>
            <div class="col-6 col-md-3 d-flex align-items-start gap-3">
                <div class="icon-badge icon-badge-navy flex-shrink-0"><i class="bi bi-shield-check"></i></div>
                <div>
                    <span class="fw-semibold d-block small">Compliance-First</span>
                    <span class="text-muted small">If it's not properly documented, we do not ship it.</span>
                </div>
            </div>
            <div class="col-6 col-md-3 d-flex align-items-start gap-3">
                <div class="icon-badge icon-badge-navy flex-shrink-0"><i class="bi bi-headset"></i></div>
                <div>
                    <span class="fw-semibold d-block small">Direct Access to Our Team</span>
                    <span class="text-muted small">Phone, WhatsApp, or email &mdash; no call centers.</span>
                </div>
            </div>
            <div class="col-6 col-md-3 d-flex align-items-start gap-3">
                <div class="icon-badge icon-badge-navy flex-shrink-0"><i class="bi bi-signpost-split"></i></div>
                <div>
                    <span class="fw-semibold d-block small">Guided, Transparent Process</span>
                    <span class="text-muted small">You'll know what's happening at every step.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-1">
                <div class="lsa-about-image-wrap">
                    <img src="<?= e(SITE_URL) ?>/assets/img/stock/warehouse-forklift.jpg" class="lsa-about-image" alt="Warehouse team coordinating cargo" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6 order-lg-2">
                <p class="lsa-eyebrow mb-2">Who We Are</p>
                <h2 class="fw-bold mb-3">About Let Ship Africa Inc.</h2>
                <p>
                    Let Ship Africa Inc. is a Liberia-based logistics and trade facilitation company that guides businesses,
                    organizations, entrepreneurs, and individuals through every step of international trade &mdash; not just the
                    shipping itself.
                </p>
                <p>
                    Importing and exporting can be complicated &mdash; documentation, supplier coordination, transportation, and
                    customs. <strong>We guide you through each step, from quotation to customs clearance</strong>, so you always
                    know what's happening with your shipment and can focus on growing your business.
                </p>
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <div class="icon-badge icon-badge-navy flex-shrink-0"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <span class="fw-semibold d-block">Liberia-Based</span>
                            <span class="text-muted small">Local expertise connecting Liberia to global markets.</span>
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-3 mb-3">
                        <div class="icon-badge icon-badge-navy flex-shrink-0"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <span class="fw-semibold d-block">Compliance-First</span>
                            <span class="text-muted small">If it's not properly documented, we do not ship it.</span>
                        </div>
                    </li>
                    <li class="d-flex align-items-start gap-3">
                        <div class="icon-badge icon-badge-navy flex-shrink-0"><i class="bi bi-globe2"></i></div>
                        <div>
                            <span class="fw-semibold d-block">Growing Global Network</span>
                            <span class="text-muted small">Trusted partners across freight, customs, and sourcing.</span>
                        </div>
                    </li>
                </ul>
                <a href="<?= e(SITE_URL) ?>/about.php" class="btn btn-lsa-accent fw-semibold">Learn More About Us</a>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <p class="lsa-eyebrow text-center mb-2">What We Do</p>
        <h2 class="fw-bold text-center mb-2">Our Services</h2>
        <p class="text-center text-muted mb-5">We provide comprehensive logistics and trade solutions designed to support businesses of all sizes.</p>
        <div class="row g-4">
            <?php
            $serviceHighlights = [
                ['air-freight', 'bi-airplane', 'Air Freight', 'Fast, secure air cargo for urgent commercial and personal shipments.'],
                ['ocean-freight', 'bi-water', 'Ocean Freight', 'Cost-effective sea freight for containerized and consolidated cargo.'],
                ['trade-facilitation', 'bi-diagram-3', 'Trade Facilitation', 'Coordinating suppliers, brokers, and carriers across a growing global network.'],
            ];
            $serviceImages = [
                'air-freight' => 'cargo-plane.jpg',
                'ocean-freight' => 'container-ship.jpg',
                'trade-facilitation' => 'world-map.jpg',
            ];
            foreach ($serviceHighlights as [$key, $icon, $title, $desc]): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="lsa-card lsa-service-card h-100">
                        <div class="lsa-service-card-img" style="background-image: url('<?= e(SITE_URL . '/assets/img/stock/' . $serviceImages[$key]) ?>');">
                            <div class="icon-badge"><i class="bi <?= e($icon) ?>"></i></div>
                        </div>
                        <div class="p-4">
                            <h5 class="fw-bold"><?= e($title) ?></h5>
                            <p class="text-muted mb-0"><?= e($desc) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <p class="text-muted small mb-3">Also available: Cargo Consolidation &bull; Import Services &bull; Export Services &bull; Sourcing &amp; Procurement</p>
            <a href="<?= e(SITE_URL) ?>/services.php" class="btn btn-lsa-accent btn-lg fw-semibold">View All Services</a>
        </div>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-1">
                <p class="lsa-eyebrow mb-2">Our Difference</p>
                <h2 class="fw-bold mb-3">Why Choose Let Ship Africa Inc.?</h2>
                <p class="text-muted mb-4">
                    Choosing a logistics company is about more than transporting cargo &mdash; it's about selecting a partner who
                    communicates clearly, values compliance, and is committed to helping your shipment succeed.
                </p>
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                    <?php
                    $whyChoose = [
                        ['bi-award', 'Professionalism', 'Careful planning and clear communication on every shipment.'],
                        ['bi-shield-check', 'Compliance', "If it's not properly documented, we do not ship it."],
                        ['bi-eye', 'Transparency', 'Honest communication on requirements, timelines, and process.'],
                        ['bi-people-fill', 'Customer-Focused', 'Every solution is tailored to your specific shipment.'],
                        ['bi-infinity', 'Long-Term Relationships', 'Building lasting partnerships, not one-off shipments.'],
                    ];
                    foreach ($whyChoose as [$icon, $title, $desc]): ?>
                        <div class="col d-flex align-items-start gap-3">
                            <div class="icon-badge icon-badge-navy flex-shrink-0"><i class="bi <?= e($icon) ?>"></i></div>
                            <div>
                                <span class="fw-semibold d-block"><?= e($title) ?></span>
                                <span class="text-muted small"><?= e($desc) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-6 order-lg-2">
                <div class="lsa-about-image-wrap lsa-accent-right">
                    <img src="<?= e(SITE_URL) ?>/assets/img/stock/handshake.jpg" class="lsa-about-image" alt="Let Ship Africa team building a trusted partnership" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lsa-section lsa-section-alt">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <p class="lsa-eyebrow mb-2">Global Reach</p>
                <h2 class="fw-bold mb-3">Building Global Partnerships</h2>
                <p class="text-muted mb-0">
                    International logistics depends on strong relationships. We're actively growing our network of freight
                    forwarders, customs brokers, warehouse operators, and carriers across key international markets.
                </p>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-3 g-4 justify-content-center mb-5">
            <?php
            $countries = ['United States', 'United Kingdom', 'China', 'Canada', 'Australia', 'Europe'];
            foreach ($countries as $name): ?>
                <div class="col">
                    <div class="lsa-card lsa-country-card text-center p-4">
                        <div class="icon-badge icon-badge-navy mx-auto mb-2"><i class="bi bi-geo-alt-fill"></i></div>
                        <span class="fw-semibold"><?= e($name) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="<?= e(SITE_URL) ?>/partnerships.php" class="btn btn-lsa-accent btn-lg fw-semibold">Explore Partnership Opportunities</a>
        </div>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <p class="lsa-eyebrow text-center mb-2">Our Process</p>
        <h2 class="fw-bold text-center mb-2">We Guide You, Step by Step</h2>
        <p class="text-center text-muted mb-5">From your first inquiry to final delivery, you'll always know what's happening and what comes next.</p>
        <div class="row g-4">
            <?php
            $steps = [
                ['bi-chat-left-text', 'Submit a Shipping Inquiry', 'Tell us what you\'d like to ship &mdash; quick and simple, with no obligation.'],
                ['bi-envelope-check', 'Instant Acknowledgement', 'You\'ll receive an automatic email confirming we\'ve received your inquiry.'],
                ['bi-search', 'We Review Your Inquiry', 'Our team looks over the details you\'ve shared.'],
                ['bi-telephone', 'We Contact You', 'A member of our team reaches out directly to discuss your shipment.'],
                ['bi-file-earmark-text', 'Complete the Intake Form', 'We send you our Shipment Intake Form to capture the full details.'],
                ['bi-clipboard-check', 'We Review Your Intake Form', 'Our team checks everything needed to prepare an accurate quote.'],
                ['bi-receipt', 'Receive Your Quotation', 'We prepare and send your customized shipping quote.'],
            ];
            foreach ($steps as $i => [$icon, $title, $desc]): ?>
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <div class="lsa-step-number mx-auto mb-3"><i class="bi <?= e($icon) ?>"></i></div>
                    <p class="lsa-eyebrow mb-1">Step <?= $i + 1 ?></p>
                    <h5 class="fw-bold"><?= $title ?></h5>
                    <p class="text-muted small mb-0"><?= $desc ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="text-center text-muted mt-5 mb-0">Throughout the process, our team stays in direct contact &mdash; answering questions and providing updates until your cargo arrives.</p>
    </div>
</section>

<section class="lsa-section lsa-section-alt text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <i class="bi bi-quote lsa-quote-icon"></i>
                <p class="lsa-pull-quote">
                    Every shipment represents more than cargo &mdash; it's a business opportunity, an investment, and someone's
                    trust in us.
                </p>
                <p class="text-muted mb-0">
                    That responsibility guides every decision we make. We are committed to delivering professional service,
                    maintaining high standards of integrity, and building long-term relationships based on trust, transparency,
                    and reliability.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="container my-5">
    <div class="lsa-img-band" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/cargo-plane.jpg');" role="img" aria-label="Cargo aircraft in flight"></div>
</div>

<section class="lsa-hero">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Ready to Move Your Business Forward?</h2>
        <p class="lsa-text-on-dark mb-4 mx-auto" style="max-width: 760px;">
            Whether you are importing products, exporting Liberian goods, sourcing internationally, or seeking a dependable
            logistics partner, Let Ship Africa Inc. is ready to guide you from your first inquiry through to final delivery
            &mdash; with clear communication at every step.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="<?= e(SITE_URL) ?>/request-quote.php" class="btn btn-lsa-accent btn-lg fw-semibold">Start Your Shipping Inquiry</a>
            <a href="<?= e(SITE_URL) ?>/contact.php" class="btn btn-lsa-outline btn-lg fw-semibold">Contact Our Team</a>
        </div>
        <div class="mt-4">
            <a href="<?= e(SITE_URL) ?>/partnership-inquiry.php" class="link-light small">Explore Partnership Opportunities</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
