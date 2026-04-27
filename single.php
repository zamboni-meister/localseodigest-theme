<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- Post header — full width dark band -->
<div class="post-header">
    <div class="container">
        <h1 class="post-header__title"><?php the_title(); ?></h1>

        <div class="post-header__meta">
            <span><?php echo get_the_date(); ?></span>
        </div>
    </div>
</div>

<?php if ( has_post_thumbnail() ) : ?>
<div class="post-featured-image">
    <?php the_post_thumbnail( 'full' ); ?>
</div>
<?php endif; ?>

<!-- Wide post body -->
<div class="post-content">
    <div class="container">
        <div class="post-layout">

            <!-- Main content column -->
            <article class="post-layout__content">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <!-- Tags -->
                <?php $tags = get_the_tags(); if ( $tags ) : ?>
                <div class="post-tags">
                    <?php foreach ( $tags as $tag ) : ?>
                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="post-tag">
                        #<?php echo esc_html( $tag->name ); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Post navigation -->
                <div class="post-nav">
                    <?php
                    $prev = get_previous_post();
                    $next = get_next_post();
                    if ( $prev ) :
                    ?>
                    <a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>" class="post-nav__item post-nav__item--prev">
                        <div class="post-nav__label">&larr; Previous</div>
                        <span class="post-nav__title"><?php echo esc_html( $prev->post_title ); ?></span>
                    </a>
                    <?php endif; if ( $next ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" class="post-nav__item post-nav__item--next">
                        <div class="post-nav__label">Next &rarr;</div>
                        <span class="post-nav__title"><?php echo esc_html( $next->post_title ); ?></span>
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Comments -->
                <?php if ( comments_open() || get_comments_number() ) : ?>
                <div class="post-comments">
                    <?php comments_template(); ?>
                </div>
                <?php endif; ?>
            </article>

            <!-- Sticky sidebar -->
            <aside class="post-layout__sidebar">
                <div class="toc-widget" id="toc-widget">
                    <div class="toc-widget__label">On this page</div>
                    <nav class="toc-widget__nav" id="toc-nav">
                        <!-- Populated by JS from h2s in entry-content -->
                    </nav>
                </div>
            </aside>

        </div><!-- .post-layout -->
    </div><!-- .container -->
</div><!-- .post-content -->

<?php endwhile; ?>

<?php get_footer(); ?>