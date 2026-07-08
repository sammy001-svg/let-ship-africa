<?php
$pageTitle = 'Contact Us';
$pageDescription = 'Get in touch with the Let Ship Africa Inc. team to plan your next shipment or ask a question.';
require __DIR__ . '/includes/header.php';
?>

<section class="lsa-hero-photo lsa-hero-sm text-center" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/port-aerial.jpg');">
    <div class="container">
        <p class="lsa-eyebrow mb-2">Get In Touch</p>
        <h1 class="fw-bold">Contact Our Team</h1>
        <p class="lsa-text-on-dark mb-0">We're ready to answer your questions and help plan your next shipment.</p>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="lsa-contact-panel h-100 p-4 p-lg-5">
                    <div class="lsa-contact-panel-img mb-4" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/port-cranes.jpg');"></div>
                    <h2 class="fw-bold text-white mb-4">Get in Touch</h2>
                    <div class="d-flex gap-3 mb-4">
                        <div class="icon-badge icon-badge-light flex-shrink-0"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <h6 class="fw-semibold text-white mb-1">Office Address</h6>
                            <p class="lsa-text-on-dark small mb-0">Neezoe Road, Opposite James David Hospital, Paynesville, Liberia</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-4">
                        <div class="icon-badge icon-badge-light flex-shrink-0"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <h6 class="fw-semibold text-white mb-1">Phone</h6>
                            <p class="lsa-text-on-dark small mb-0"><a class="link-light" href="tel:+231880835470">+231 88 083 5470</a></p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-4">
                        <div class="icon-badge icon-badge-light flex-shrink-0"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <h6 class="fw-semibold text-white mb-1">Email</h6>
                            <p class="lsa-text-on-dark small mb-0"><a class="link-light" href="mailto:info@letshipafrica.com">info@letshipafrica.com</a></p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-4">
                        <div class="icon-badge icon-badge-light flex-shrink-0"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <h6 class="fw-semibold text-white mb-1">Business Hours</h6>
                            <p class="lsa-text-on-dark small mb-0">Monday &ndash; Friday, 9:00 AM &ndash; 5:00 PM GMT</p>
                        </div>
                    </div>
                    <hr class="border-secondary my-4">
                    <p class="mb-2 fw-semibold text-white">Looking for something specific?</p>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a class="link-light" href="<?= e(SITE_URL) ?>/request-quote.php">Start Your Shipping Inquiry &rarr;</a></li>
                        <li class="mb-2"><a class="link-light" href="<?= e(SITE_URL) ?>/partnership-inquiry.php">Become a Logistics Partner &rarr;</a></li>
                        <li><a class="link-light" href="<?= e(SITE_URL) ?>/faq.php">Read our FAQ &rarr;</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="lsa-card lsa-form-card p-4 p-md-5 h-100">
                    <h2 class="fw-bold mb-4">Send Us a Message</h2>
                    <form action="<?= e(SITE_URL) ?>/process/process-contact.php" method="post" data-guard-submit novalidate>
                        <?= csrf_field() ?>
                        <?= honeypot_field() ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="full_name">Full Name *</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" required maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="subject">Subject *</label>
                                <input type="text" class="form-control" id="subject" name="subject" required maxlength="200">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="message">Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-lsa-accent btn-lg fw-semibold w-100">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
