<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- Post header — full width dark band -->
<div class="post-header">
    <div class="container">
        <?php
        $categories = get_the_category();
        if ( $categories ) :
        ?>
        <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="post-header__category">
            <?php echo esc_html( $categories[0]->name ); ?>
        </a>
        <?php endif; ?>

        <h1 class="post-header__title"><?php the_title(); ?></h1>

        <div class="post-header__meta">
            <strong><?php the_author(); ?></strong>
            <span class="sep">/</span>
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

                <!-- Author box -->
                <div class="author-box">
                    <div class="author-box__avatar">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
                    </div>
                    <div class="author-box__info">
                        <div class="author-box__name"><?php the_author(); ?></div>
                        <div class="author-box__bio"><?php the_author_meta( 'description' ); ?></div>
                        <div class="author-box__site">
                            Building a self-managed website documenting the local SEO journey to help business owners and marketers grow their local visibility.
                        </div>
                    </div>
                </div>

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