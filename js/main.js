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

    // Table of Contents — auto-generate from h2s + active tracking
    var tocNav    = document.getElementById('toc-nav');
    var tocWidget = document.getElementById('toc-widget');

    if (tocNav && tocWidget) {
        var headings = document.querySelectorAll('.entry-content h2');

        // Hide TOC if fewer than 2 headings
        if (headings.length < 2) {
            tocWidget.style.display = 'none';
        } else {
            // Build links, ensure each heading has an id
            headings.forEach(function (h, i) {
                if (!h.id) {
                    h.id = 'section-' + i + '-' + h.textContent.trim()
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/(^-|-$)/g, '');
                }
                var link = document.createElement('a');
                link.href      = '#' + h.id;
                link.className = 'toc-link';
                link.textContent = h.textContent.replace(/^#+\s*/, '');
                tocNav.appendChild(link);
            });

            // Active link tracking via IntersectionObserver
            var links = tocNav.querySelectorAll('.toc-link');

            if ('IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            links.forEach(function (l) { l.classList.remove('is-active'); });
                            var active = tocNav.querySelector('a[href="#' + entry.target.id + '"]');
                            if (active) active.classList.add('is-active');
                        }
                    });
                }, { rootMargin: '-10% 0px -80% 0px' });

                headings.forEach(function (h) { observer.observe(h); });
            }
        }
    }

});