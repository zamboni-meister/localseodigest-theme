<?php get_header(); ?>

<div class="archive-header">
    <div class="container">
        <?php if ( is_category() ) : ?>
            <div class="archive-header__label">Category</div>
            <h1 class="archive-header__title"><?php single_cat_title(); ?></h1>
        <?php elseif ( is_tag() ) : ?>
            <div class="archive-header__label">Tag</div>
            <h1 class="archive-header__title"><?php single_tag_title(); ?></h1>
        <?php elseif ( is_search() ) : ?>
            <div class="archive-header__label">Search results for</div>
            <h1 class="archive-header__title">&ldquo;<?php the_search_query(); ?>&rdquo;</h1>
        <?php else : ?>
            <div class="archive-header__label">All Articles</div>
            <h1 class="archive-header__title">Blog</h1>
        <?php endif; ?>
    </div>
</div>

<div class="home-section">
    <div class="container">
        <div class="content-sidebar">

            <main role="main">
                <?php if ( have_posts() ) : ?>
                <div class="posts-grid" style="grid-template-columns: 1fr 1fr;">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <article class="post-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-card__image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'lsd-card' ); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="post-card__body">
                            <h2 class="post-card__title" style="font-size: 1.05rem;">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="post-card__excerpt"><?php the_excerpt(); ?></p>
                            <?php lsd_post_meta(); ?>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>

                <div class="pagination">
                    <?php
                    echo paginate_links( array(
                        'prev_text' => '&larr;',
                        'next_text' => '&rarr;',
                    ) );
                    ?>
                </div>

                <?php else : ?>
                <p style="color: var(--mid-gray); padding: 40px 0;">No posts found.</p>
                <?php endif; ?>
            </main>

            <aside role="complementary">
                <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-blog' ); ?>
                <?php else : ?>

                    <!-- Default sidebar widgets -->
                    <div class="widget">
                        <h3 class="widget-title">About</h3>
                        <p style="font-size: 0.875rem; color: var(--mid-gray); line-height: 1.6; margin-bottom: 14px;">Weekly local SEO insights from Zane Creek — documenting the journey to help you grow your local business.</p>
                        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" style="font-size: 0.82rem; font-weight: 600; color: var(--yellow-dark);">Learn more &rarr;</a>
                    </div>

                    <div class="widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul>
                            <?php
                            $cats = get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'number' => 8 ) );
                            if ( $cats ) {
                                foreach ( $cats as $cat ) {
                                    echo '<li><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . ' <span style="color:var(--light-gray)">(' . $cat->count . ')</span></a></li>';
                                }
                            } else {
                                echo '<li style="color:var(--light-gray);font-size:0.875rem;">Categories will appear here.</li>';
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="widget" style="background: var(--ink); color: var(--white);">
                        <h3 class="widget-title" style="color: var(--yellow); border-bottom-color: var(--yellow);">Newsletter</h3>
                        <p style="font-size: 0.875rem; color: rgba(255,255,255,0.6); line-height: 1.6; margin-bottom: 16px;">Get weekly local SEO insights straight to your inbox.</p>
                        <a href="#newsletter" class="btn btn--primary" style="font-size: 0.8rem; padding: 10px 18px; display: inline-flex;">Subscribe free</a>
                    </div>

                <?php endif; ?>
            </aside>

        </div>
    </div>
</div>

<?php get_footer(); ?>
