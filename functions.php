<?php
/**
 * Local SEO Digest - Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ============================================================
   THEME SETUP
   ============================================================ */
function lsd_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );

    add_image_size( 'lsd-featured', 1200, 630, true );
    add_image_size( 'lsd-card', 800, 450, true );
    add_image_size( 'lsd-card-sm', 400, 225, true );

    register_nav_menus( array(
        'primary'  => __( 'Primary Navigation', 'localseodigest' ),
        'footer-1' => __( 'Footer Column 1', 'localseodigest' ),
        'footer-3' => __( 'Footer Column 3', 'localseodigest' ),
    ) );
}
add_action( 'after_setup_theme', 'lsd_theme_setup' );

/* ============================================================
   ENQUEUE STYLES & SCRIPTS
   ============================================================ */
function lsd_enqueue_assets() {
    wp_enqueue_style(
        'inter-font',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'localseodigest-style',
        get_stylesheet_uri(),
        array( 'inter-font' ),
        wp_get_theme()->get( 'Version' )
    );

    wp_enqueue_script(
        'localseodigest-main',
        get_template_directory_uri() . '/js/main.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );

    if ( is_singular() && comments_open() ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'lsd_enqueue_assets' );

/* ============================================================
   WIDGET AREAS
   ============================================================ */
function lsd_register_sidebars() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'localseodigest' ),
        'id'            => 'sidebar-blog',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'localseodigest' ),
        'id'            => 'sidebar-footer',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-col__heading">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'lsd_register_sidebars' );

/* ============================================================
   EXCERPT
   ============================================================ */
function lsd_excerpt_length( $length ) {
    return 22;
}
add_filter( 'excerpt_length', 'lsd_excerpt_length' );

function lsd_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'lsd_excerpt_more' );

/* ============================================================
   READING TIME
   ============================================================ */
function lsd_reading_time( $post_id = null ) {
    $post    = get_post( $post_id );
    $content = strip_tags( $post->post_content );
    $words   = str_word_count( $content );
    $minutes = max( 1, round( $words / 200 ) );
    return $minutes . ' min read';
}

/* ============================================================
   CUSTOM BODY CLASSES
   ============================================================ */
function lsd_body_classes( $classes ) {
    if ( is_singular( 'post' ) ) $classes[] = 'single-post';
    if ( is_home() || is_front_page() ) $classes[] = 'is-home';
    return $classes;
}
add_filter( 'body_class', 'lsd_body_classes' );

/* ============================================================
   CUSTOM LOGO SUPPORT
   ============================================================ */
function lsd_custom_logo_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 48,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
}
add_action( 'after_setup_theme', 'lsd_custom_logo_setup' );

/* ============================================================
   HELPER: Post Category Badge
   ============================================================ */
function lsd_post_category_badge( $post_id = null ) {
    $categories = get_the_category( $post_id );
    if ( ! empty( $categories ) ) {
        $cat = $categories[0];
        echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="post-card__category">' . esc_html( $cat->name ) . '</a>';
    }
}

/* ============================================================
   HELPER: Post Meta Row
   ============================================================ */
function lsd_post_meta( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    ?>
    <div class="post-card__meta">
        <time datetime="<?php echo get_the_date( 'c', $post_id ); ?>">
            <?php echo get_the_date( 'M j, Y', $post_id ); ?>
        </time>
        <span class="read-time"><?php echo lsd_reading_time( $post_id ); ?></span>
    </div>
    <?php
}

/* ============================================================
   HOMEPAGE SETTINGS META BOX
   ============================================================ */
function lsd_homepage_metabox() {
    $front_page_id = get_option( 'page_on_front' );
    if ( ! $front_page_id ) return;

    add_meta_box(
        'lsd_homepage_settings',
        '🏠 Homepage Settings',
        'lsd_homepage_metabox_html',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lsd_homepage_metabox' );

function lsd_homepage_metabox_html( $post ) {
    $front_page_id = get_option( 'page_on_front' );
    if ( (int) $post->ID !== (int) $front_page_id ) {
        echo '<p style="color:#999;font-style:italic;">These settings only appear on the designated Homepage.</p>';
        return;
    }

    wp_nonce_field( 'lsd_homepage_meta', 'lsd_homepage_nonce' );

    $fields = array(
        'Hero Section' => array(
            'lsd_hero_eyebrow'   => array( 'label' => 'Eyebrow label (small text above headline)', 'default' => 'Local SEO Education' ),
            'lsd_hero_title'     => array( 'label' => 'Headline — first line', 'default' => 'Your guide to' ),
            'lsd_hero_title_em'  => array( 'label' => 'Headline — highlighted line (yellow)', 'default' => 'dominating local search' ),
            'lsd_hero_subtitle'  => array( 'label' => 'Subtitle paragraph', 'default' => 'Real strategies, honest documentation, and practical guides for business owners and marketers who want to grow their local visibility.', 'textarea' => true ),
            'lsd_hero_btn1_text' => array( 'label' => 'Primary button text', 'default' => 'Read the blog' ),
            'lsd_hero_btn1_url'  => array( 'label' => 'Primary button URL', 'default' => '/blog/' ),
            'lsd_hero_btn2_text' => array( 'label' => 'Secondary button text', 'default' => 'Get the newsletter' ),
        ),
        'Newsletter Band' => array(
            'lsd_nl_title'    => array( 'label' => 'Newsletter headline', 'default' => 'Get the Local SEO Digest' ),
            'lsd_nl_subtitle' => array( 'label' => 'Newsletter subtext', 'default' => 'Weekly insights, strategies, and real-world results delivered to your inbox.' ),
        ),
        'About Strip' => array(
            'lsd_about_name' => array( 'label' => 'Your name / greeting', 'default' => "Hi, I'm Zane Creek" ),
            'lsd_about_bio'  => array( 'label' => 'Short bio', 'default' => "SEO Specialist at Timmermann Group in St. Louis. I'm documenting everything I learn about local SEO.", 'textarea' => true ),
        ),
    );

    $style_section  = 'margin: 0 0 6px; font-weight: 600; font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; color: #1e1e1e; background: #f0f0f0; padding: 8px 12px; border-radius: 3px;';
    $style_label    = 'display:block; font-size:12px; font-weight:500; color:#555; margin: 12px 0 4px;';
    $style_input    = 'width:100%; padding:7px 10px; border:1px solid #ddd; border-radius:4px; font-size:13px; font-family:inherit;';
    $style_textarea = 'width:100%; padding:7px 10px; border:1px solid #ddd; border-radius:4px; font-size:13px; font-family:inherit; height:80px; resize:vertical;';

    foreach ( $fields as $section_label => $section_fields ) {
        echo '<p style="' . $style_section . '">' . esc_html( $section_label ) . '</p>';
        foreach ( $section_fields as $key => $config ) {
            $value = get_post_meta( $post->ID, $key, true );
            if ( $value === '' ) $value = $config['default'];
            echo '<label style="' . $style_label . '">' . esc_html( $config['label'] ) . '</label>';
            if ( ! empty( $config['textarea'] ) ) {
                echo '<textarea name="' . esc_attr( $key ) . '" style="' . $style_textarea . '">' . esc_textarea( $value ) . '</textarea>';
            } else {
                echo '<input type="text" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" style="' . $style_input . '">';
            }
        }
        echo '<div style="margin-bottom:16px;"></div>';
    }
}

function lsd_save_homepage_meta( $post_id ) {
    if ( ! isset( $_POST['lsd_homepage_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['lsd_homepage_nonce'], 'lsd_homepage_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $keys = array(
        'lsd_hero_eyebrow', 'lsd_hero_title', 'lsd_hero_title_em',
        'lsd_hero_subtitle', 'lsd_hero_btn1_text', 'lsd_hero_btn1_url',
        'lsd_hero_btn2_text', 'lsd_nl_title', 'lsd_nl_subtitle',
        'lsd_about_name', 'lsd_about_bio',
    );

    foreach ( $keys as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }
}
add_action( 'save_post', 'lsd_save_homepage_meta' );

/* ============================================================
   REMOVE EMOJI (PERFORMANCE)
   ============================================================ */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* ============================================================
   GLOSSARY CUSTOM POST TYPE
   ============================================================ */
function lsd_register_glossary_post_type() {
    $labels = array(
        'name'               => _x( 'Glossary Terms', 'post type general name', 'localseodigest' ),
        'singular_name'      => _x( 'Glossary Term', 'post type singular name', 'localseodigest' ),
        'menu_name'          => _x( 'Glossary', 'admin menu', 'localseodigest' ),
        'name_admin_bar'     => _x( 'Glossary Term', 'add new on admin bar', 'localseodigest' ),
        'add_new'            => _x( 'Add New', 'glossary term', 'localseodigest' ),
        'add_new_item'       => __( 'Add New Glossary Term', 'localseodigest' ),
        'new_item'           => __( 'New Glossary Term', 'localseodigest' ),
        'edit_item'          => __( 'Edit Glossary Term', 'localseodigest' ),
        'view_item'          => __( 'View Glossary Term', 'localseodigest' ),
        'all_items'          => __( 'All Glossary Terms', 'localseodigest' ),
        'search_items'       => __( 'Search Glossary Terms', 'localseodigest' ),
        'parent_item_colon'  => __( 'Parent Glossary Terms:', 'localseodigest' ),
        'not_found'          => __( 'No glossary terms found.', 'localseodigest' ),
        'not_found_in_trash' => __( 'No glossary terms found in Trash.', 'localseodigest' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'glossary-term' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array( 'title', 'editor', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'glossary_term', $args );
}
add_action( 'init', 'lsd_register_glossary_post_type' );
