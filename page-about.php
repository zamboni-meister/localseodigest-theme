/* ============================================================
   ABOUT PAGE SETTINGS META BOX
   Add this block to functions.php alongside the Homepage meta box.
   ============================================================ */

function lsd_about_page_metabox() {
    add_meta_box(
        'lsd_about_page_settings',
        '📄 About Page Settings',
        'lsd_about_page_metabox_html',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lsd_about_page_metabox' );

function lsd_about_page_metabox_html( $post ) {
    // Only show on the About page template
    $template = get_post_meta( $post->ID, '_wp_page_template', true );
    if ( $template !== 'page-about.php' ) {
        echo '<p style="color:#999;font-style:italic;">These settings only appear on the About page.</p>';
        return;
    }

    wp_nonce_field( 'lsd_about_page_meta', 'lsd_about_page_nonce' );

    $fields = array(
        'Hero' => array(
            'lsd_ab_hero_eyebrow'  => array( 'label' => 'Eyebrow label', 'default' => 'About' ),
            'lsd_ab_hero_headline' => array( 'label' => 'Headline', 'default' => 'Local SEO knowledge, organized and on demand.' ),
            'lsd_ab_hero_sub'      => array( 'label' => 'Subheadline paragraph', 'default' => 'Local SEO Digest is a knowledge hub for local search — built to cut through the noise and give practitioners, agencies, and business owners something actually useful.', 'textarea' => true ),
        ),
        "What's Inside — The Digest" => array(
            'lsd_ab_digest_heading' => array( 'label' => 'Card heading', 'default' => 'The Digest' ),
            'lsd_ab_digest_body'    => array( 'label' => 'Card body', 'default' => 'A curated RSS feed pulling the latest from across the local SEO space. One place to stay current without chasing a dozen tabs.', 'textarea' => true ),
        ),
        "What's Inside — The Blog" => array(
            'lsd_ab_blog_heading' => array( 'label' => 'Card heading', 'default' => 'The Blog' ),
            'lsd_ab_blog_body'    => array( 'label' => 'Card body', 'default' => 'In-depth posts covering Google Business Profile optimization, local citations, on-page SEO, review management, and more. No fluff — just practical content grounded in real experience.', 'textarea' => true ),
        ),
        "What's Inside — The Newsletter" => array(
            'lsd_ab_nl_heading' => array( 'label' => 'Card heading', 'default' => 'The Newsletter' ),
            'lsd_ab_nl_body'    => array( 'label' => 'Card body', 'default' => 'A weekly email with the most useful updates, experiments, and insights from local search. Subscribe once, stay informed.', 'textarea' => true ),
        ),
        "What's Inside — Resources" => array(
            'lsd_ab_res_heading' => array( 'label' => 'Card heading', 'default' => 'Resources' ),
            'lsd_ab_res_body'    => array( 'label' => 'Card body', 'default' => 'A handpicked collection of tools and recommended reading for local SEO professionals. The stuff worth bookmarking.', 'textarea' => true ),
        ),
        "What's Inside — The Glossary" => array(
            'lsd_ab_gloss_heading' => array( 'label' => 'Card heading', 'default' => 'The Glossary' ),
            'lsd_ab_gloss_body'    => array( 'label' => 'Card body', 'default' => 'Plain-language definitions for the terminology that comes up constantly in local SEO. A good place to get grounded before going deeper.', 'textarea' => true ),
        ),
        'Who It\'s For' => array(
            'lsd_ab_who_p1' => array( 'label' => 'First paragraph', 'default' => 'Local SEO Digest is built for anyone serious about local search — SEO specialists, agency teams managing local clients, and business owners who want to understand why their competitors outrank them and what to do about it.', 'textarea' => true ),
            'lsd_ab_who_p2' => array( 'label' => 'Second paragraph', 'default' => "If you're early in your local SEO journey or deep in the weeds, there's something here for you.", 'textarea' => true ),
        ),
        'How to Use It — Step 1' => array(
            'lsd_ab_step1_heading' => array( 'label' => 'Step heading', 'default' => 'Start with the foundations' ),
            'lsd_ab_step1_body'    => array( 'label' => 'Step body (HTML links are fine)', 'default' => "New to local SEO? The Glossary will get you up to speed on the core terminology. Then head to Resources for the recommended reading and tools worth knowing before going further.", 'textarea' => true ),
        ),
        'How to Use It — Step 2' => array(
            'lsd_ab_step2_heading' => array( 'label' => 'Step heading', 'default' => 'Learn the fundamentals' ),
            'lsd_ab_step2_body'    => array( 'label' => 'Step body', 'default' => "The Blog is where the core concepts live — GBP optimization, citation building, ranking signals, and everything else that makes local search work. Read what's relevant to where you are.", 'textarea' => true ),
        ),
        'How to Use It — Step 3' => array(
            'lsd_ab_step3_heading' => array( 'label' => 'Step heading', 'default' => 'Stay current' ),
            'lsd_ab_step3_body'    => array( 'label' => 'Step body', 'default' => 'Subscribe to the Newsletter for weekly updates, and check the Digest to follow the broader local SEO conversation as it happens.', 'textarea' => true ),
        ),
        'The Creator' => array(
            'lsd_ab_creator_para' => array( 'label' => 'Creator paragraph', 'default' => 'Local SEO Digest is built and maintained by Zane Creek, an SEO practitioner based in St. Louis. Local search is where I spend most of my time — and this site is how I document what I\'m learning as I go. If it\'s useful to you, that\'s the point.', 'textarea' => true ),
            'lsd_ab_linkedin_url' => array( 'label' => 'LinkedIn URL', 'default' => 'https://www.linkedin.com/in/zane-creek/' ),
            'lsd_ab_linkedin_label' => array( 'label' => 'LinkedIn button label', 'default' => 'Connect on LinkedIn' ),
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

function lsd_save_about_page_meta( $post_id ) {
    if ( ! isset( $_POST['lsd_about_page_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['lsd_about_page_nonce'], 'lsd_about_page_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $keys = array(
        'lsd_ab_hero_eyebrow', 'lsd_ab_hero_headline', 'lsd_ab_hero_sub',
        'lsd_ab_digest_heading', 'lsd_ab_digest_body',
        'lsd_ab_blog_heading', 'lsd_ab_blog_body',
        'lsd_ab_nl_heading', 'lsd_ab_nl_body',
        'lsd_ab_res_heading', 'lsd_ab_res_body',
        'lsd_ab_gloss_heading', 'lsd_ab_gloss_body',
        'lsd_ab_who_p1', 'lsd_ab_who_p2',
        'lsd_ab_step1_heading', 'lsd_ab_step1_body',
        'lsd_ab_step2_heading', 'lsd_ab_step2_body',
        'lsd_ab_step3_heading', 'lsd_ab_step3_body',
        'lsd_ab_creator_para', 'lsd_ab_linkedin_url', 'lsd_ab_linkedin_label',
    );

    foreach ( $keys as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }
}
add_action( 'save_post', 'lsd_save_about_page_meta' );