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

    <!-- Tools Section -->
    <div style="padding: 56px 0 0;">
        <div class="section-header">
            <h2>Essential Tools</h2>
        </div>
        <div class="resources-grid">
            <?php
            $tools = array(
                array( 'icon' => '📍', 'title' => 'Google Business Profile', 'desc' => 'The foundation of local SEO. Claim, verify, and optimize your GBP listing.', 'link' => 'https://business.google.com', 'label' => 'Visit tool' ),
                array( 'icon' => '🔍', 'title' => 'BrightLocal', 'desc' => 'Local SEO platform for rank tracking, citation building, and reputation management.', 'link' => 'https://brightlocal.com', 'label' => 'Visit tool' ),
                array( 'icon' => '📊', 'title' => 'Google Search Console', 'desc' => 'Monitor your site\'s performance in Google Search and fix issues.', 'link' => 'https://search.google.com/search-console', 'label' => 'Visit tool' ),
                array( 'icon' => '🗺️', 'title' => 'Whitespark', 'desc' => 'Citation finder, local rank tracker, and reputation builder for local businesses.', 'link' => 'https://whitespark.ca', 'label' => 'Visit tool' ),
                array( 'icon' => '⚡', 'title' => 'PageSpeed Insights', 'desc' => 'Test your site\'s Core Web Vitals and get actionable performance recommendations.', 'link' => 'https://pagespeed.web.dev', 'label' => 'Visit tool' ),
                array( 'icon' => '🔗', 'title' => 'Ahrefs Webmaster Tools', 'desc' => 'Free site audit, backlink analysis, and keyword research for your domain.', 'link' => 'https://ahrefs.com/webmaster-tools', 'label' => 'Visit tool' ),
            );
            foreach ( $tools as $tool ) :
            ?>
            <div class="resource-card">
                <div class="resource-card__icon"><?php echo $tool['icon']; ?></div>
                <h3 class="resource-card__title"><?php echo esc_html( $tool['title'] ); ?></h3>
                <p class="resource-card__desc"><?php echo esc_html( $tool['desc'] ); ?></p>
                <a href="<?php echo esc_url( $tool['link'] ); ?>" class="resource-card__link" target="_blank" rel="noopener"><?php echo esc_html( $tool['label'] ); ?> &rarr;</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Guides Section -->
    <div style="padding: 0 0 56px;">
        <div class="section-header">
            <h2>Recommended Reading</h2>
        </div>
        <div class="resources-grid">
            <?php
            $guides = array(
                array( 'icon' => '📖', 'title' => 'Google\'s Local SEO Guide', 'desc' => 'Official documentation on how to improve your local ranking on Google.', 'link' => 'https://support.google.com/business/answer/7091', 'label' => 'Read guide' ),
                array( 'icon' => '🏆', 'title' => 'Moz Local Search Ranking Factors', 'desc' => 'Annual survey of the most important local ranking signals according to top SEOs.', 'link' => 'https://moz.com/local-search-ranking-factors', 'label' => 'Read guide' ),
                array( 'icon' => '📝', 'title' => 'Local SEO Digest Blog', 'desc' => 'My own articles, experiments, and findings — updated weekly.', 'link' => home_url( '/blog/' ), 'label' => 'Read articles' ),
            );
            foreach ( $guides as $guide ) :
            ?>
            <div class="resource-card">
                <div class="resource-card__icon"><?php echo $guide['icon']; ?></div>
                <h3 class="resource-card__title"><?php echo esc_html( $guide['title'] ); ?></h3>
                <p class="resource-card__desc"><?php echo esc_html( $guide['desc'] ); ?></p>
                <a href="<?php echo esc_url( $guide['link'] ); ?>" class="resource-card__link" target="_blank" rel="noopener"><?php echo esc_html( $guide['label'] ); ?> &rarr;</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php endif; ?>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
