<?php get_header(); ?>

<div class="archive-header">
    <div class="container">
        <div class="archive-header__label">Search results for</div>
        <h1 class="archive-header__title">&ldquo;<?php the_search_query(); ?>&rdquo;</h1>
    </div>
</div>

<div class="home-section">
    <div class="container">
        <?php if ( have_posts() ) : ?>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <?php while ( have_posts() ) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="post-card lsd-article-card">
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-card__image">
                    <?php the_post_thumbnail( 'lsd-card' ); ?>
                </div>
                <?php endif; ?>
                <div class="post-card__body">
                    <h2 class="post-card__title" style="font-size: 1.05rem;">
                        <?php the_title(); ?>
                    </h2>
                    <p class="post-card__excerpt"><?php the_excerpt(); ?></p>
                    <?php lsd_post_meta(); ?>
                </div>
            </a>
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