<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="post-header">
    <div class="container--narrow">
        <h1 class="post-header__title"><?php the_title(); ?></h1>
        <div class="post-header__meta">
            <strong><?php the_author(); ?></strong>
            <span class="sep">/</span>
            <time datetime="<?php the_date( 'c' ); ?>"><?php the_date( 'F j, Y' ); ?></time>
            <span class="sep">/</span>
            <span><?php echo lsd_reading_time(); ?></span>
        </div>
    </div>
</div>

<?php if ( has_post_thumbnail() ) : ?>
<div class="post-featured-image">
    <?php the_post_thumbnail( 'lsd-featured' ); ?>
</div>
<?php endif; ?>

<div class="post-content">
    <div class="container--narrow">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <?php
        $tags = get_the_tags();
        if ( $tags ) :
        ?>
        <div class="post-tags">
            <?php foreach ( $tags as $tag ) : ?>
            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="post-tag"><?php echo esc_html( $tag->name ); ?></a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>


        <!-- Post navigation -->
        <div style="display: flex; justify-content: space-between; gap: 24px; padding: 32px 0; border-top: 1px solid var(--border); flex-wrap: wrap;">
            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            if ( $prev ) :
            ?>
            <a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>" style="font-size: 0.875rem; color: var(--mid-gray); max-width: 48%;">
                <div style="font-size: 0.72rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 6px; color: var(--light-gray);">&larr; Previous</div>
                <span style="color: var(--ink); font-weight: 500;"><?php echo esc_html( $prev->post_title ); ?></span>
            </a>
            <?php endif; if ( $next ) : ?>
            <a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" style="font-size: 0.875rem; color: var(--mid-gray); max-width: 48%; text-align: right; margin-left: auto;">
                <div style="font-size: 0.72rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 6px; color: var(--light-gray);">Next &rarr;</div>
                <span style="color: var(--ink); font-weight: 500;"><?php echo esc_html( $next->post_title ); ?></span>
            </a>
            <?php endif; ?>
        </div>

        <!-- Comments -->
        <?php if ( comments_open() || get_comments_number() ) : ?>
        <div style="padding-top: 24px;">
            <?php comments_template(); ?>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
