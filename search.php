<?php get_header(); ?>

<div class="archive-header">
    <div class="container">
        <div class="archive-header__label">Search results for</div>
        <h1 class="archive-header__title">&ldquo;<?php the_search_query(); ?>&rdquo;</h1>
    </div>
</div>

<div class="home-section">
    <div class="container--narrow">
        <?php if ( have_posts() ) : ?>
        <div style="display: flex; flex-direction: column; gap: 0;">
            <?php while ( have_posts() ) : the_post(); ?>
            <article style="padding: 28px 0; border-bottom: 1px solid var(--border);">
                <?php lsd_post_category_badge(); ?>
                <h2 style="font-size: 1.15rem; margin: 8px 0 10px;">
                    <a href="<?php the_permalink(); ?>" style="color: var(--ink);"><?php the_title(); ?></a>
                </h2>
                <p style="font-size: 0.9rem; color: var(--mid-gray); line-height: 1.6; margin-bottom: 10px;"><?php the_excerpt(); ?></p>
                <?php lsd_post_meta(); ?>
            </article>
            <?php endwhile; ?>
        </div>
        <div class="pagination"><?php echo paginate_links(); ?></div>
        <?php else : ?>
        <p style="color: var(--mid-gray); padding: 40px 0;">No results found for &ldquo;<?php the_search_query(); ?>&rdquo;. Try a different search.</p>
        <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
