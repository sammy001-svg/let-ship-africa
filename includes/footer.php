<footer class="lsa-footer mt-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <img src="<?= e(SITE_URL) ?>/assets/img/logo.png" alt="Let Ship Africa Inc." class="lsa-logo lsa-logo-footer mb-2">
                <p class="lsa-text-on-dark">Connecting Liberia to Global Markets Through Reliable Logistics and Trade Solutions.</p>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="text-white fw-semibold mb-3">Quick Links</h6>
                <ul class="list-unstyled lsa-footer-links">
                    <li><a href="<?= e(SITE_URL) ?>/about.php">About Us</a></li>
                    <li><a href="<?= e(SITE_URL) ?>/services.php">Services</a></li>
                    <li><a href="<?= e(SITE_URL) ?>/faq.php">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="text-white fw-semibold mb-3">Get Started</h6>
                <ul class="list-unstyled lsa-footer-links">
                    <li><a href="<?= e(SITE_URL) ?>/request-quote.php">Start Your Shipping Inquiry</a></li>
                    <li><a href="<?= e(SITE_URL) ?>/partnership-inquiry.php">Become a Partner</a></li>
                    <li><a href="<?= e(SITE_URL) ?>/contact.php">Contact Our Team</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="text-white fw-semibold mb-3">Contact</h6>
                <ul class="list-unstyled lsa-footer-links">
                    <li><i class="bi bi-geo-alt-fill me-2"></i>Neezoe Road, Opposite James David Hospital, Paynesville, Liberia</li>
                    <li><i class="bi bi-telephone-fill me-2"></i><a href="tel:+231880835470">+231 88 083 5470</a></li>
                    <li><i class="bi bi-envelope-fill me-2"></i><a href="mailto:info@letshipafrica.com">info@letshipafrica.com</a></li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary my-4">
        <p class="text-center lsa-text-on-dark small mb-0">&copy; <?= date('Y') ?> Let Ship Africa Inc. All rights reserved.</p>
    </div>
</footer>

<a href="https://wa.me/231880835470?text=<?= rawurlencode('Hello Let Ship Africa, I\'d like to ask about a shipment.') ?>" class="lsa-whatsapp-float" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<button type="button" id="lsaBackToTop" class="lsa-back-to-top" aria-label="Back to top">
    <i class="bi bi-arrow-up"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= e(SITE_URL) ?>/assets/js/main.js"></script>
</body>
</html>
