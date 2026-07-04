<?php
$pageTitle = 'Request a Shipping Quote';
$pageDescription = 'Request a free, no-obligation shipping quote for air freight, ocean freight, or cargo consolidation.';
require __DIR__ . '/includes/header.php';
?>

<section class="lsa-hero-photo lsa-hero-sm text-center" style="background-image: url('<?= e(SITE_URL) ?>/assets/img/stock/warehouse-forklift.jpg');">
    <div class="container">
        <p class="lsa-eyebrow mb-2">Get a Quote</p>
        <h1 class="fw-bold">Request a Shipping Quote</h1>
        <p class="lsa-text-on-dark mb-0">Tell us about your shipment and our logistics team will prepare a customized quotation.</p>
    </div>
</section>

<section class="lsa-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="lsa-card lsa-form-card p-4 p-md-5">
                    <form action="<?= e(SITE_URL) ?>/process/process-quote.php" method="post" data-guard-submit novalidate>
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
                            <div class="col-md-4">
                                <label class="form-label" for="shipment_type">Shipment Type *</label>
                                <select class="form-select" id="shipment_type" name="shipment_type" required>
                                    <option value="" selected disabled>Choose...</option>
                                    <option value="air">Air Freight</option>
                                    <option value="ocean">Ocean Freight</option>
                                    <option value="consolidation">Cargo Consolidation</option>
                                    <option value="other">Other / Not Sure</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="origin_country">Origin Country *</label>
                                <input type="text" class="form-control" id="origin_country" name="origin_country" required maxlength="100">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="destination_country">Destination Country *</label>
                                <input type="text" class="form-control" id="destination_country" name="destination_country" required maxlength="100" value="Liberia">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="cargo_description">Description of Goods *</label>
                                <textarea class="form-control" id="cargo_description" name="cargo_description" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="weight">Estimated Weight</label>
                                <input type="text" class="form-control" id="weight" name="weight" maxlength="50" placeholder="e.g. 250 kg">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="dimensions">Estimated Dimensions</label>
                                <input type="text" class="form-control" id="dimensions" name="dimensions" maxlength="100" placeholder="e.g. 2 pallets, 1.2m x 1m x 1m">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="additional_notes">Additional Notes</label>
                                <textarea class="form-control" id="additional_notes" name="additional_notes" rows="3" placeholder="Timeline, special handling requirements, etc."></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-lsa-accent btn-lg fw-semibold w-100">Submit Quote Request</button>
                                <p class="text-muted small mt-2 mb-0">Submitting a quotation request is free and does not obligate you to book a shipment.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
