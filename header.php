<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" role="banner">
    <div class="container">
        <div class="site-header__inner">

            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
                    LocalSEO <span>Digest</span>
                </a>
            <?php endif; ?>

            <nav class="main-nav" id="main-nav" role="navigation" aria-label="Primary navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => '',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => 'lsd_default_nav',
                ) );
                ?>
                <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'newsletter' ) ) ?: '#newsletter' ); ?>" class="nav-cta">Subscribe</a>
            </nav>

            <button class="menu-toggle" id="menu-toggle" aria-label="Toggle navigation" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>
</header>

<?php
function lsd_default_nav() {
    $pages = array(
        'Blog'      => home_url( '/blog/' ),
        'About'     => home_url( '/about/' ),
        'Resources' => home_url( '/resources/' ),
        'Contact'   => home_url( '/contact/' ),
        'Digest'    => home_url( '/digest/' ),
    );
    foreach ( $pages as $label => $url ) {
        echo '<a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
    }
}
