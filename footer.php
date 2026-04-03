<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">

            <div class="footer-brand">
                <div class="footer-brand__logo">LocalSEO <span>Digest</span></div>
                <p class="footer-brand__desc">Documenting the journey of mastering local SEO — helping business owners and marketers grow their local visibility.</p>
            </div>

            <div class="footer-col">
                <div class="footer-col__heading">Learn</div>
                <ul>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-1',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'fallback_cb'    => function() {
                            $links = array(
                                'Blog'         => home_url( '/blog/' ),
                                'Resources'    => home_url( '/resources/' ),
                                'Case Studies' => home_url( '/case-studies/' ),
                                'Glossary'     => home_url( '/glossary/' ),
                            );
                            foreach ( $links as $label => $url ) {
                                echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
                            }
                        },
                    ) );
                    ?>
                </ul>
            </div>

            <div class="footer-col">
                <div class="footer-col__heading">Topics</div>
                <ul>
                    <?php
                    $categories = get_categories( array( 'number' => 5, 'orderby' => 'count', 'order' => 'DESC' ) );
                    if ( $categories ) {
                        foreach ( $categories as $cat ) {
                            echo '<li><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
                        }
                    } else {
                        $topics = array( 'Google Business Profile', 'Local Citations', 'On-Page SEO', 'Link Building', 'Reviews & Reputation' );
                        foreach ( $topics as $topic ) {
                            echo '<li><a href="#">' . esc_html( $topic ) . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="footer-col">
                <div class="footer-col__heading">Site</div>
                <ul>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-3',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'fallback_cb'    => function() {
                            $links = array(
                                'About'       => home_url( '/about/' ),
                                'Contact'     => home_url( '/contact/' ),
                                'Newsletter'  => home_url( '/newsletter/' ),
                                'Privacy'     => home_url( '/privacy-policy/' ),
                            );
                            foreach ( $links as $label => $url ) {
                                echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
                            }
                        },
                    ) );
                    ?>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <span>&copy; <?php echo date( 'Y' ); ?> LocalSEO Digest. All rights reserved.</span>
            <span>Built by <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Zane Creek</a></span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
