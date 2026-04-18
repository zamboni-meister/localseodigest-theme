    <?php
    /**
     * Template Name: About Page
     * About page for Local SEO Digest — publication-first layout.
     * All text is editable via Pages → About → About Page Settings in wp-admin.
     */

    get_header();

    $id = get_the_ID();

    $hero_eyebrow  = get_post_meta( $id, 'lsd_ab_hero_eyebrow', true )  ?: 'About';
    $hero_headline = get_post_meta( $id, 'lsd_ab_hero_headline', true ) ?: 'Local SEO knowledge, organized and on demand.';
    $hero_sub      = get_post_meta( $id, 'lsd_ab_hero_sub', true )      ?: 'Local SEO Digest is a knowledge hub for local search ~ built to cut through the noise and give practitioners, agencies, and business owners something actually useful.';

    $digest_heading = get_post_meta( $id, 'lsd_ab_digest_heading', true ) ?: 'The Digest';
    $digest_body    = get_post_meta( $id, 'lsd_ab_digest_body', true )    ?: 'A curated RSS feed pulling the latest from across the local SEO space. One place to stay current without chasing a dozen tabs.';

    $blog_heading = get_post_meta( $id, 'lsd_ab_blog_heading', true ) ?: 'The Blog';
    $blog_body    = get_post_meta( $id, 'lsd_ab_blog_body', true )    ?: 'In-depth posts covering Google Business Profile optimization, local citations, on-page SEO, review management, and more. No fluff — just practical content grounded in real experience.';

    $nl_heading = get_post_meta( $id, 'lsd_ab_nl_heading', true ) ?: 'The Newsletter';
    $nl_body    = get_post_meta( $id, 'lsd_ab_nl_body', true )    ?: 'A weekly email with the most useful updates, experiments, and insights from local search. Subscribe once, stay informed.';

    $res_heading = get_post_meta( $id, 'lsd_ab_res_heading', true ) ?: 'Resources';
    $res_body    = get_post_meta( $id, 'lsd_ab_res_body', true )    ?: 'A handpicked collection of tools and recommended reading for local SEO professionals. The stuff worth bookmarking.';

    $gloss_heading = get_post_meta( $id, 'lsd_ab_gloss_heading', true ) ?: 'The Glossary';
    $gloss_body    = get_post_meta( $id, 'lsd_ab_gloss_body', true )    ?: 'Plain-language definitions for the terminology that comes up constantly in local SEO. A good place to get grounded before going deeper.';

    $who_p1 = get_post_meta( $id, 'lsd_ab_who_p1', true ) ?: 'Local SEO Digest is built for anyone serious about local search — SEO specialists, agency teams managing local clients, and business owners who want to understand why their competitors outrank them and what to do about it.';
    $who_p2 = get_post_meta( $id, 'lsd_ab_who_p2', true ) ?: "If you're early in your local SEO journey or deep in the weeds, there's something here for you.";

    $step1_heading = get_post_meta( $id, 'lsd_ab_step1_heading', true ) ?: 'Start with the foundations';
    $step1_body    = get_post_meta( $id, 'lsd_ab_step1_body', true )    ?: 'New to local SEO? The <a href="' . esc_url( home_url( '/glossary/' ) ) . '">Glossary</a> will get you up to speed on the core terminology. Then head to <a href="' . esc_url( home_url( '/resources/' ) ) . '">Resources</a> for the recommended reading and tools worth knowing before going further.';

    $step2_heading = get_post_meta( $id, 'lsd_ab_step2_heading', true ) ?: 'Learn the fundamentals';
    $step2_body    = get_post_meta( $id, 'lsd_ab_step2_body', true )    ?: 'The <a href="' . esc_url( home_url( '/blog/' ) ) . '">Blog</a> is where the core concepts live — GBP optimization, citation building, ranking signals, and everything else that makes local search work. Read what\'s relevant to where you are.';

    $step3_heading = get_post_meta( $id, 'lsd_ab_step3_heading', true ) ?: 'Stay current';
    $step3_body    = get_post_meta( $id, 'lsd_ab_step3_body', true )    ?: 'Subscribe to the <a href="' . esc_url( home_url( '/newsletter/' ) ) . '">Newsletter</a> for weekly updates, and check the <a href="' . esc_url( home_url( '/digest/' ) ) . '">Digest</a> to follow the broader local SEO conversation as it happens.';

    $creator_para   = get_post_meta( $id, 'lsd_ab_creator_para', true )   ?: 'Local SEO Digest is built and maintained by Zane Creek, an SEO practitioner based in St. Louis. Local search is where I spend most of my time — and this site is how I document what I\'m learning as I go. If it\'s useful to you, that\'s the point.';
    $linkedin_url   = get_post_meta( $id, 'lsd_ab_linkedin_url', true )   ?: 'https://www.linkedin.com/in/zane-creek/';
    $linkedin_label = get_post_meta( $id, 'lsd_ab_linkedin_label', true ) ?: 'Connect on LinkedIn';

    ?>

    <main id="main-content" class="about-page">

        <section class="about-hero">
            <div class="about-hero__inner container">
                <div class="archive-header__label"><?php echo esc_html( $hero_eyebrow ); ?></div>
                <h1 class="about-hero__headline"><?php echo esc_html( $hero_headline ); ?></h1>
                <p class="about-hero__sub"><?php echo esc_html( $hero_sub ); ?></p>
            </div>
        </section>

        <section class="about-section about-section--alt">
            <div class="container about-section__inner">
                <h2 class="about-section__title">What's inside</h2>
                <div class="about-cards">

                    <div class="about-card">
                        <h3 class="about-card__heading"><?php echo esc_html( $digest_heading ); ?></h3>
                        <p class="about-card__body"><?php echo esc_html( $digest_body ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/digest/' ) ); ?>" class="about-card__link">Explore the Digest &rarr;</a>
                    </div>

                    <div class="about-card">
                        <h3 class="about-card__heading"><?php echo esc_html( $blog_heading ); ?></h3>
                        <p class="about-card__body"><?php echo esc_html( $blog_body ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="about-card__link">Read the blog &rarr;</a>
                    </div>

                    <div class="about-card">
                        <h3 class="about-card__heading"><?php echo esc_html( $nl_heading ); ?></h3>
                        <p class="about-card__body"><?php echo esc_html( $nl_body ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/newsletter/' ) ); ?>" class="about-card__link">Subscribe &rarr;</a>
                    </div>

                    <div class="about-card">
                        <h3 class="about-card__heading"><?php echo esc_html( $res_heading ); ?></h3>
                        <p class="about-card__body"><?php echo esc_html( $res_body ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>" class="about-card__link">See resources &rarr;</a>
                    </div>

                    <div class="about-card">
                        <h3 class="about-card__heading"><?php echo esc_html( $gloss_heading ); ?></h3>
                        <p class="about-card__body"><?php echo esc_html( $gloss_body ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/glossary/' ) ); ?>" class="about-card__link">Browse the glossary &rarr;</a>
                    </div>

                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="container about-section__inner about-section__inner--narrow">
                <h2 class="about-section__title">Who it's for</h2>
                <p><?php echo esc_html( $who_p1 ); ?></p>
                <p><?php echo esc_html( $who_p2 ); ?></p>
            </div>
        </section>

        <section class="about-section about-section--alt">
            <div class="container about-section__inner">
                <h2 class="about-section__title">How to use it</h2>
                <div class="about-steps">

                    <div class="about-step">
                        <span class="about-step__num">01</span>
                        <div class="about-step__content">
                            <h3 class="about-step__heading"><?php echo esc_html( $step1_heading ); ?></h3>
                            <p><?php echo wp_kses( $step1_body, array( 'a' => array( 'href' => array(), 'title' => array() ) ) ); ?></p>
                        </div>
                    </div>

                    <div class="about-step">
                        <span class="about-step__num">02</span>
                        <div class="about-step__content">
                            <h3 class="about-step__heading"><?php echo esc_html( $step2_heading ); ?></h3>
                            <p><?php echo wp_kses( $step2_body, array( 'a' => array( 'href' => array(), 'title' => array() ) ) ); ?></p>
                        </div>
                    </div>

                    <div class="about-step">
                        <span class="about-step__num">03</span>
                        <div class="about-step__content">
                            <h3 class="about-step__heading"><?php echo esc_html( $step3_heading ); ?></h3>
                            <p><?php echo wp_kses( $step3_body, array( 'a' => array( 'href' => array(), 'title' => array() ) ) ); ?></p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="about-section about-creator">
            <div class="container about-section__inner about-section__inner--narrow">
                <h2 class="about-section__title">The creator</h2>
                <p><?php echo esc_html( $creator_para ); ?></p>
                <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer" class="about-linkedin">
                    <span class="about-linkedin__logo" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </span>
                    <span><?php echo esc_html( $linkedin_label ); ?></span>
                </a>
            </div>
        </section>

    </main>

    <?php get_footer(); ?>