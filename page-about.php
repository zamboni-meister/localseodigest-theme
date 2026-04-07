<?php
/*
 * Template Name: About Page
 */
get_header(); ?>

<div class="about-hero">
    <div class="container">
        <span class="hero__eyebrow">The Story</span>
        <h1 class="about-hero__title">Hi, I'm Zane Creek</h1>
        <p class="about-hero__subtitle">SEO Specialist, local search nerd, and the person behind Local SEO Digest.</p>
    </div>
</div>

<div class="about-content">
    <div class="container">
        <div class="about-grid">
            <div class="about-grid__text">
                <?php while ( have_posts() ) : the_post(); ?>
                <?php if ( get_the_content() ) : ?>
                    <div class="entry-content"><?php the_content(); ?></div>
                <?php else : ?>
                    <h2>Why I started this</h2>
                    <p>I'm an SEO Specialist at Timmermann Group in St. Louis with a background in business and entrepreneurship. When I started focusing on local SEO, I noticed there was a gap — most content either oversimplified things or went so deep into theory that it wasn't actionable.</p>
                    <p>Local SEO Digest is my answer to that. I document everything I learn, test, and discover about local search — the strategies that work, the ones that don't, and the nuances that actually move the needle for real businesses.</p>
                    <h2>What you'll find here</h2>
                    <p>Real strategies for Google Business Profile optimization, local citations, on-page SEO, review management, and everything else that affects how businesses show up in local search. No fluff, no generic advice — just what I've actually learned works.</p>
                    <p>I also send a weekly newsletter with the most useful insights, updates, and experiments. <a href="<?php echo esc_url( home_url( '/#newsletter' ) ); ?>">Subscribe here</a>.</p>
                    <h2>Connect</h2>
                    <p>Have a question, topic suggestion, or just want to talk local SEO? <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Reach out</a> — I read every message.</p>
                <?php endif; ?>
                <?php endwhile; ?>

                <div style="margin-top: 36px; display: flex; gap: 12px; flex-wrap: wrap;">
                    <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn btn--primary">Read the blog</a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline" style="color: var(--ink); border-color: var(--border);">Get in touch</a>
                </div>
            </div>

            <div>
                <div class="about-grid__image">👤</div>

                <div style="margin-top: 24px; background: var(--warm-white); border-radius: var(--radius-lg); padding: 24px;">
                    <div style="font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--light-gray); margin-bottom: 16px;">Quick Facts</div>
                    <?php
                    $facts = array(
                        '📍' => 'St. Louis, Missouri',
                        '💼' => 'SEO Specialist, Timmermann Group',
                        '🎓' => 'BBA International Business, UMSL',
                        '🌍' => 'International experience & German speaker',
                        '🎵' => 'Rap & hip hop musician',
                    );
                    foreach ( $facts as $icon => $fact ) :
                    ?>
                    <div style="display: flex; gap: 10px; align-items: center; padding: 8px 0; border-bottom: 1px solid var(--border); font-size: 0.875rem; color: var(--charcoal);">
                        <span style="font-size: 1rem;"><?php echo $icon; ?></span>
                        <span><?php echo esc_html( $fact ); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
