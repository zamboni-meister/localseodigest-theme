<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="archive-header">
    <div class="container">
        <h1 class="archive-header__title"><?php the_title(); ?></h1>
    </div>
</div>

<div class="home-section">
    <div class="container--narrow">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
