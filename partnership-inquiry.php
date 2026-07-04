<?php
$pageTitle = 'Partnership Inquiry';
$pageDescription = 'Freight forwarders, customs brokers, and logistics providers: submit a partnership inquiry to work with Let Ship Africa Inc.';
require __DIR__ . '/includes/header.php';
?>

<section class="lsa-hero-photo lsa-hero-sm text-center" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/port-aerial.jpg');">
    <div class="container">
        <p class="lsa-eyebrow mb-2">Partner With Us</p>
        <h1 class="fw-bold">Partnership Inquiry Form</h1>
        <p class="lsa-text-on-dark mb-0">Tell us about your organization and how we might work together.</p>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="lsa-card lsa-form-card p-4 p-md-5">
                    <form action="<?= e(SITE_URL) ?>/process/process-partnership.php" method="post" data-guard-submit novalidate>
                        <?= csrf_field() ?>
                        <?= honeypot_field() ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="organization_name">Organization Name *</label>
                                <input type="text" class="form-control" id="organization_name" name="organization_name" required maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="contact_name">Contact Person *</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name" required maxlength="150">
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
                                <label class="form-label" for="country">Country *</label>
                                <input type="text" class="form-control" id="country" name="country" required maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="partner_type">Organization Type *</label>
                                <select class="form-select" id="partner_type" name="partner_type" required>
                                    <option value="" selected disabled>Choose...</option>
                                    <option>Freight Forwarder</option>
                                    <option>Customs Brokerage Company</option>
                                    <option>Warehousing & Distribution Company</option>
                                    <option>Airline / Air Cargo Operator</option>
                                    <option>Shipping Line / Ocean Freight Company</option>
                                    <option>Sourcing & Procurement Company</option>
                                    <option>Last-Mile Delivery Company</option>
                                    <option>Cargo Inspection & Quality Assurance Company</option>
                                    <option>Technology & Logistics Service Provider</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="message">Tell Us About Your Organization *</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Services offered, markets covered, and why you'd like to partner with Let Ship Africa Inc."></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-lsa-accent btn-lg fw-semibold w-100">Submit Partnership Inquiry</button>
                                <p class="text-muted small mt-2 mb-0">Our Business Development Team will review your submission and follow up to schedule an introductory meeting.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
