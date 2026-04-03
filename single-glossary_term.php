<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="post-header">
    <div class="container--narrow">
        <h1 class="post-header__title"><?php the_title(); ?></h1>
        <div class="post-header__meta">
            <a href="<?php echo esc_url( home_url( '/glossary/' ) ); ?>" class="glossary-back-link">&larr; Back to Glossary</a>
        </div>
    </div>
</div>

<div class="post-content">
    <div class="container--narrow">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <!-- Related terms or navigation could go here -->
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>