document.addEventListener('DOMContentLoaded', function () {

    // Mobile menu toggle
    var toggle = document.getElementById('menu-toggle');
    var nav    = document.getElementById('main-nav');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var isOpen = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen);
        });

        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Newsletter form feedback
    var newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var btn   = this.querySelector('button');
            var input = this.querySelector('input[type="email"]');
            if (input && input.value) {
                btn.textContent  = 'Thanks! You\'re in.';
                btn.disabled     = true;
                input.disabled   = true;
            }
        });
    }

});
