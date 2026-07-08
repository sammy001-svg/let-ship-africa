<?php
$pageTitle = 'Start Your Shipping Inquiry';
$pageDescription = 'Start a free, no-obligation shipping inquiry. Tell us what you need to ship and our team will reach out to guide you through the rest.';
require __DIR__ . '/includes/header.php';
?>

<section class="lsa-hero-photo lsa-hero-sm text-center" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/warehouse-forklift.jpg');">
    <div class="container">
        <p class="lsa-eyebrow mb-2">Get Started</p>
        <h1 class="fw-bold">Start Your Shipping Inquiry</h1>
        <p class="lsa-text-on-dark mb-0">Tell us what you'd like to ship. Our team will review your inquiry and reach out to guide you through the next steps.</p>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="lsa-card lsa-form-card p-4 p-md-5">
                    <form action="<?= e(SITE_URL) ?>/process/process-inquiry.php" method="post" data-guard-submit novalidate>
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
                                <label class="form-label" for="phone">Phone Number *</label>
                                <input type="text" class="form-control" id="phone" name="phone" required maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="company">Company Name (if applicable)</label>
                                <input type="text" class="form-control" id="company" name="company" maxlength="150">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="message">What would you like to ship? *</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required placeholder="A brief description is fine — e.g. what you're shipping, roughly where from/to, and when. We'll follow up to get the rest of the details."></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-lsa-accent btn-lg fw-semibold w-100">Submit Inquiry</button>
                                <p class="text-muted small mt-2 mb-0">Submitting an inquiry is free and does not obligate you to book a shipment. You'll receive an email confirmation, and our team will follow up with next steps.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
