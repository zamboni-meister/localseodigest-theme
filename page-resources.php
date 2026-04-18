<?php
/*
 * Template Name: Resources Page
 */
get_header(); ?>

<div class="resources-header">
    <div class="container">
        <div class="archive-header__label">Learn</div>
        <h1 class="resources-header__title">Resources</h1>
        <p class="resources-header__subtitle">The best tools, guides, and references for local SEO — curated and updated
            regularly.</p>
    </div>
</div>

<div class="container">
    <?php while (have_posts()):
        the_post(); ?>
        <?php if (get_the_content()): ?>
            <div class="entry-content" style="padding: 56px 0;">
                <?php the_content(); ?>
            </div>
        <?php else: ?>

            <!-- Guides Section -->
            <div id="guides" style="padding: 56px 0 0;">
                <div class="section-header">
                    <h2>Guides</h2>
                </div>
                <div class="resources-grid">
                    <?php
                    $lsd_guides = array(
                        array('title' => 'What is Local SEO?', 'desc' => 'BrightLocal\'s beginner-friendly breakdown of local SEO — what it is, why it matters, and how it differs from traditional SEO.', 'link' => 'https://www.brightlocal.com/learn/what-is-local-seo/', 'cat' => 'fundamentals', 'cat_label' => 'Fundamentals'),
                        array('title' => 'How to do Local SEO', 'desc' => 'A practical, step-by-step guide to optimizing your local search presence — from GBP setup to citations and beyond.', 'link' => 'https://www.brightlocal.com/learn/local-seo/local-search-optimization/', 'cat' => 'fundamentals', 'cat_label' => 'Fundamentals'),
                        array('title' => 'How to Improve Local SEO Rankings', 'desc' => 'Backlinko\'s definitive guide to ranking higher in local search — covering every major ranking factor with actionable tactics.', 'link' => 'https://backlinko.com/local-seo-guide', 'cat' => 'fundamentals', 'cat_label' => 'Fundamentals'),
                    );
                    foreach ($lsd_guides as $guide):
                        ?>
                        <a href="<?php echo esc_url($guide['link']); ?>" class="resource-card resource-card--linked"
                            target="_blank" rel="noopener">
                            <span
                                class="resource-card__cat resource-card__cat--<?php echo esc_attr($guide['cat']); ?>"><?php echo esc_html($guide['cat_label']); ?></span>
                            <h3 class="resource-card__title"><?php echo esc_html($guide['title']); ?></h3>
                            <p class="resource-card__desc"><?php echo esc_html($guide['desc']); ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Tools Section -->
            <div id="tools" style="padding: 56px 0 0;">
                <div class="section-header">
                    <h2>Essential Tools</h2>
                </div>
                <div class="resources-grid">
                    <?php
                    $tools = array(
                        array('title' => 'Google Business Profile', 'desc' => 'The foundation of local SEO. Claim, verify, and optimize your GBP listing.', 'link' => 'https://business.google.com', 'cat' => 'tool', 'cat_label' => 'Tool'),
                        array('title' => 'Google Search Console', 'desc' => 'Monitor your site\'s performance in Google Search and fix issues.', 'link' => 'https://search.google.com/search-console', 'cat' => 'tool', 'cat_label' => 'Tool'),
                        array('title' => 'Google Analytics', 'desc' => 'Track website traffic, user behavior, and conversions from local search.', 'link' => 'https://analytics.google.com', 'cat' => 'tool', 'cat_label' => 'Tool'),
                    );
                    foreach ($tools as $tool):
                        ?>
                        <a href="<?php echo esc_url($tool['link']); ?>" class="resource-card resource-card--linked"
                            target="_blank" rel="noopener">
                            <span
                                class="resource-card__cat resource-card__cat--<?php echo esc_attr($tool['cat']); ?>"><?php echo esc_html($tool['cat_label']); ?></span>
                            <h3 class="resource-card__title"><?php echo esc_html($tool['title']); ?></h3>
                            <p class="resource-card__desc"><?php echo esc_html($tool['desc']); ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Recommended Reading Section -->
            <div id="recommended-reading" style="padding: 56px 0 56px;">
                <div class="section-header">
                    <h2>Recommended Reading</h2>
                </div>
                <div class="resources-grid">
                    <?php
                    $reading = array(
                        array('title' => 'How Google Organizes Information', 'desc' => 'How Google\'s crawlers discover, render, and index content across hundreds of billions of pages before any ranking occurs.', 'link' => 'https://www.google.com/intl/en_us/search/howsearchworks/how-search-works/organizing-information/', 'cat' => 'fundamentals', 'cat_label' => 'Fundamentals'),
                        array('title' => 'How Google Ranks Results', 'desc' => 'Google\'s breakdown of the five core ranking signals: query meaning, content relevance, quality, usability, and context.', 'link' => 'https://www.google.com/intl/en_us/search/howsearchworks/how-search-works/ranking-results/', 'cat' => 'fundamentals', 'cat_label' => 'Fundamentals'),
                        array('title' => 'How Google Ranks Local Results', 'desc' => 'Google\'s official explanation of the three local ranking factors: relevance, distance, and prominence.', 'link' => 'https://support.google.com/business/answer/7091', 'cat' => 'fundamentals', 'cat_label' => 'Fundamentals'),
                    );
                    foreach ($reading as $item):
                        ?>
                        <a href="<?php echo esc_url($item['link']); ?>" class="resource-card resource-card--linked"
                            target="_blank" rel="noopener">
                            <span
                                class="resource-card__cat resource-card__cat--<?php echo esc_attr($item['cat']); ?>"><?php echo esc_html($item['cat_label']); ?></span>
                            <h3 class="resource-card__title"><?php echo esc_html($item['title']); ?></h3>
                            <p class="resource-card__desc"><?php echo esc_html($item['desc']); ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endif; ?>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>