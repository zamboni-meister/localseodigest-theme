<?php
/**
 * Homepage template — content editable via the Home page in wp-admin.
 * Edit text under Pages → Home → Homepage Settings meta box.
 */

get_header();

// Get the static front page ID
$home_id = get_option( 'page_on_front' );

// Pull custom fields with fallback defaults
$hero_eyebrow    = get_post_meta( $home_id, 'lsd_hero_eyebrow', true )    ?: 'Local SEO Education';
$hero_title      = get_post_meta( $home_id, 'lsd_hero_title', true )      ?: 'Your guide to';
$hero_title_em   = get_post_meta( $home_id, 'lsd_hero_title_em', true )   ?: 'dominating local search';
$hero_subtitle   = get_post_meta( $home_id, 'lsd_hero_subtitle', true )   ?: 'Real strategies, honest documentation, and practical guides for business owners and marketers who want to grow their local visibility.';
$hero_btn1_text  = get_post_meta( $home_id, 'lsd_hero_btn1_text', true )  ?: 'Read the blog';
$hero_btn1_url   = get_post_meta( $home_id, 'lsd_hero_btn1_url', true )   ?: home_url( '/blog/' );
$hero_btn2_text  = get_post_meta( $home_id, 'lsd_hero_btn2_text', true )  ?: 'Get the newsletter';

$nl_title        = get_post_meta( $home_id, 'lsd_nl_title', true )        ?: 'Get the Local SEO Digest';
$nl_subtitle     = get_post_meta( $home_id, 'lsd_nl_subtitle', true )     ?: 'Weekly insights, strategies, and real-world results delivered to your inbox.';

$about_name      = get_post_meta( $home_id, 'lsd_about_name', true )      ?: "Hi, I'm Zane Creek";
$about_bio       = get_post_meta( $home_id, 'lsd_about_bio', true )       ?: "SEO Specialist at Timmermann Group in St. Louis. I'm documenting everything I learn about local SEO — the wins, the experiments, and the mistakes — so you can grow your local business faster.";
?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <span class="hero__eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></span>
        <h1 class="hero__title">
            <?php echo esc_html( $hero_title ); ?><br>
            <em><?php echo esc_html( $hero_title_em ); ?></em>
        </h1>
        <p class="hero__subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
        <div class="hero__actions">
            <a href="<?php echo esc_url( $hero_btn1_url ); ?>" class="btn btn--primary"><?php echo esc_html( $hero_btn1_text ); ?></a>
            <a href="#newsletter" class="btn btn--outline"><?php echo esc_html( $hero_btn2_text ); ?></a>
        </div>
    </div>
</section>

<!-- LATEST POSTS -->
<section class="home-section">
    <div class="container">
        <div class="section-header">
            <h2>Latest Articles</h2>
            <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">View all &rarr;</a>
        </div>
        <?php
        $latest = new WP_Query( array( 'posts_per_page' => 3, 'post_status' => 'publish' ) );
        ?>
        <?php if ( $latest->have_posts() ) : ?>
        <div class="posts-grid">
            <?php while ( $latest->have_posts() ) : $latest->the_post(); ?>
            <article class="post-card">
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-card__image">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'lsd-card' ); ?></a>
                </div>
                <?php endif; ?>
                <div class="post-card__body">
                    <?php lsd_post_category_badge(); ?>
                    <h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="post-card__excerpt"><?php the_excerpt(); ?></p>
                    <?php lsd_post_meta(); ?>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <p style="color: var(--mid-gray); padding: 40px 0;">No posts yet — check back soon!</p>
        <?php endif; ?>
    </div>
</section>

<!-- NEWSLETTER SIGNUP -->
<section class="newsletter-band" id="newsletter">
    <div class="container">
        <div class="newsletter-band__inner">
            <div class="newsletter-band__text">
                <h2><?php echo esc_html( $nl_title ); ?></h2>
                <p><?php echo esc_html( $nl_subtitle ); ?></p>
            </div>
            <form class="newsletter-form" action="#" method="post">
                <?php wp_nonce_field( 'lsd_newsletter', 'lsd_nonce' ); ?>
                <input type="email" name="email" placeholder="Your email address" required>
                <button type="submit">Subscribe free</button>
            </form>
        </div>
    </div>
</section>

<!-- POPULAR POSTS -->
<?php
$popular = new WP_Query( array(
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'orderby'        => 'comment_count',
    'offset'         => 3,
) );
?>
<?php if ( $popular->have_posts() ) : ?>
<section class="home-section--alt">
    <div class="container">
        <div class="section-header">
            <h2>Popular Reads</h2>
            <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">View all &rarr;</a>
        </div>
        <div class="post-list">
            <?php $i = 1; while ( $popular->have_posts() ) : $popular->the_post(); ?>
            <article class="post-list-item">
                <span class="post-list-item__num">0<?php echo $i; ?></span>
                <div class="post-list-item__content">
                    <h3 class="post-list-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="post-list-item__meta"><?php echo get_the_date( 'M j, Y' ); ?> &nbsp;·&nbsp; <?php echo lsd_reading_time(); ?></div>
                </div>
            </article>
            <?php $i++; endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ABOUT STRIP -->
<section class="home-section">
    <div class="container">
        <div style="background: var(--ink); border-radius: var(--radius-lg); padding: 48px; display: flex; gap: 40px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 260px;">
                <div style="font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--yellow); margin-bottom: 14px;">About the Author</div>
                <h2 style="color: var(--white); margin-bottom: 14px; font-size: 1.5rem;"><?php echo esc_html( $about_name ); ?></h2>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.95rem; line-height: 1.7; margin-bottom: 24px;"><?php echo esc_html( $about_bio ); ?></p>
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn--primary">Read my story</a>
            </div>
            <div style="width: 180px; height: 180px; border-radius: 50%; background: var(--yellow-tint); display: flex; align-items: center; justify-content: center; font-size: 4rem; flex-shrink: 0;">👤</div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
