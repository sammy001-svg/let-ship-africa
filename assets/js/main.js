// Disable submit buttons on submission to prevent duplicate form submits.
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form[data-guard-submit]').forEach(function (form) {
        form.addEventListener('submit', function () {
            var btn = form.querySelector('button[type="submit"]');
            if (btn) {
                btn.disabled = true;
                btn.dataset.originalText = btn.innerHTML;
                btn.innerHTML = 'Submitting&hellip;';
            }
        });
    });

    // Back-to-top button: show after scrolling past one viewport height.
    var backToTop = document.getElementById('lsaBackToTop');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            backToTop.classList.toggle('is-visible', window.scrollY > window.innerHeight);
        });
        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});
