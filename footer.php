<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">

            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-brand__logo">
                    <img src="https://localseodigest.com/wp-content/uploads/2026/04/Local-SEO-Digest-Logo-1.webp"
                        alt="Local SEO Digest logo"
                        style="height: 28px; width: auto; display: inline-block; vertical-align: middle; margin-right: 8px;">Local
                    SEO <span>Digest</span>
                </a>
                <p class="footer-brand__desc">Documenting the journey of mastering local SEO — helping business owners
                    and marketers grow their local visibility.</p>
            </div>

            <div class="footer-col">
                <div class="footer-col__heading">Learn</div>
                <ul>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-1',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'fallback_cb' => function () {
                            $links = array(
                                'Blog' => home_url('/blog/'),
                                'Resources' => home_url('/resources/'),
                                'Case Studies' => home_url('/case-studies/'),
                                'Glossary' => home_url('/glossary/'),
                            );
                            foreach ($links as $label => $url) {
                                echo '<li><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
                            }
                        },
                    ));
                    ?>
                </ul>
            </div>

            <div class="footer-col">
                <div class="footer-col__heading">Site</div>
                <ul>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-2',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'fallback_cb' => function () {
                            $links = array(
                                'About' => home_url('/about/'),
                                'Contact' => home_url('/contact/'),
                                'Newsletter' => home_url('/newsletter/'),
                                'Digest' => home_url('/digest/'),
                                'Privacy' => home_url('/privacy-policy/'),
                            );
                            foreach ($links as $label => $url) {
                                echo '<li><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
                            }
                        },
                    ));
                    ?>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <span>&copy; <?php echo date('Y'); ?> Local SEO Digest. All rights reserved.</span>
            <span>Built by <a href="https://www.linkedin.com/in/zane-creek/" target="_blank"
                    rel="noopener noreferrer">Zane Creek</a></span>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>