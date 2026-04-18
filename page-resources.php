<?php
/*
 * Template Name: Resources Page
 */
get_header(); ?>

<div class="resources-header">
    <div class="container">
        <h1 class="resources-header__title">Resources</h1>
        <p class="resources-header__subtitle">The best tools, guides, and references for local SEO — curated and updated regularly.</p>
    </div>
</div>

<div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
    <?php if ( get_the_content() ) : ?>
        <div class="entry-content" style="padding: 56px 0;">
            <?php the_content(); ?>
        </div>
    <?php else : ?>

    <!-- Guides Section -->
    <div style="padding: 56px 0 0;">
        <div class="section-header">
            <h2>Guides</h2>
        </div>
        <div class="resources-grid">
            <?php
            $lsd_guides = array(
                array( 'title' => 'GBP Optimization Guide', 'desc' => 'A step-by-step guide to claiming, verifying, and fully optimizing your Google Business Profile.', 'link' => home_url( '/blog/' ) ),
                array( 'title' => 'Local Citation Guide', 'desc' => 'How to build consistent citations across directories to strengthen your local rankings.', 'link' => home_url( '/blog/' ) ),
                array( 'title' => 'Review Generation Guide', 'desc' => 'Proven strategies for earning more Google reviews and managing your online reputation.', 'link' => home_url( '/blog/' ) ),
                array( 'title' => 'Local Pack Ranking Guide', 'desc' => 'What actually drives local pack rankings — and how to improve your position.', 'link' => home_url( '/blog/' ) ),
            );
            foreach ( $lsd_guides as $guide ) :
            ?>
            <a href="<?php echo esc_url( $guide['link'] ); ?>" class="resource-card resource-card--linked" target="_blank" rel="noopener">
                <span class="resource-card__cat">Guide</span>
                <h3 class="resource-card__title"><?php echo esc_html( $guide['title'] ); ?></h3>
                <p class="resource-card__desc"><?php echo esc_html( $guide['desc'] ); ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Tools Section -->
    <div style="padding: 56px 0 0;">
        <div class="section-header">
            <h2>Essential Tools</h2>
        </div>
        <div class="resources-grid">
            <?php
            $tools = array(
                array( 'title' => 'Google Business Profile', 'desc' => 'The foundation of local SEO. Claim, verify, and optimize your GBP listing.', 'link' => 'https://business.google.com' ),
                array( 'title' => 'Google Search Console', 'desc' => 'Monitor your site\'s performance in Google Search and fix issues.', 'link' => 'https://search.google.com/search-console' ),
                array( 'title' => 'Google Analytics', 'desc' => 'Track website traffic, user behavior, and conversions from local search.', 'link' => 'https://analytics.google.com' ),
            );
            foreach ( $tools as $tool ) :
            ?>
            <a href="<?php echo esc_url( $tool['link'] ); ?>" class="resource-card resource-card--linked" target="_blank" rel="noopener">
                <span class="resource-card__cat">Tool</span>
                <h3 class="resource-card__title"><?php echo esc_html( $tool['title'] ); ?></h3>
                <p class="resource-card__desc"><?php echo esc_html( $tool['desc'] ); ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Recommended Reading Section -->
    <div style="padding: 56px 0 56px;">
        <div class="section-header">
            <h2>Recommended Reading</h2>
        </div>
        <div class="resources-grid">
            <?php
            $reading = array(
                array( 'title' => 'How Google Organizes Information', 'desc' => 'How Google Organizes Information', 'desc' => 'How Google\'s crawlers discover, render, and index content across hundreds of billions of pages before any ranking occurs.', 'link' => 'https://www.google.com/intl/en_us/search/howsearchworks/how-search-works/organizing-information/' ),
                array( 'title' => 'How Google Ranks Results', 'desc' => 'Google\'s breakdown of the five core ranking signals: query meaning, content relevance, quality, usability, and context.', 'link' => 'https://www.google.com/intl/en_us/search/howsearchworks/how-search-works/ranking-results/' ),
                array( 'title' => 'How Google Ranks Local Results', 'desc' => 'Google\'s official explanation of the three local ranking factors: relevance, distance, and prominence.', 'link' => 'https://support.google.com/business/answer/7091' ),
            );
            foreach ( $reading as $item ) :
            ?>
            <a href="<?php echo esc_url( $item['link'] ); ?>" class="resource-card resource-card--linked" target="_blank" rel="noopener">
                <span class="resource-card__cat resource-card__cat--fundamentals">Fundamentals</span>
                <h3 class="resource-card__title"><?php echo esc_html( $item['title'] ); ?></h3>
                <p class="resource-card__desc"><?php echo esc_html( $item['desc'] ); ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php endif; ?>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>