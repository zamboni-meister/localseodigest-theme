<?php
/**
 * Homepage template — LocalSEO Digest
 * Layout: Hero → Latest Articles → Newsletter Strip → Top Resources → Footer
 */

get_header();

// Homepage meta box fields
$post_id = get_option('page_on_front');
$hero_headline1 = get_post_meta($post_id, '_lsd_hero_headline1', true) ?: 'Master';
$hero_headline2 = get_post_meta($post_id, '_lsd_hero_headline2', true) ?: 'local search.';
$hero_sub = get_post_meta($post_id, '_lsd_hero_sub', true) ?: 'Home base for SEO professionals and business owners who want to dominate Google\'s local results.';
$btn1_text = get_post_meta($post_id, '_lsd_btn1_text', true) ?: 'Learn Local SEO';
$btn1_url = get_post_meta($post_id, '_lsd_btn1_url', true) ?: home_url('/resources/');
$btn2_text = get_post_meta($post_id, '_lsd_btn2_text', true) ?: 'Digest';
$btn2_url = get_post_meta($post_id, '_lsd_btn2_url', true) ?: home_url('/digest/');
$nl_headline = get_post_meta($post_id, '_lsd_nl_headline', true) ?: 'Insights to your <span>Inbox</span></span>';
$nl_sub = get_post_meta($post_id, '_lsd_nl_sub', true) ?: 'Industry-leading updates and deep Local SEO learning — Free.';
?>

<!-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
	 HERO
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="lsd-hero">
	<div class="lsd-hero__bg-text" aria-hidden="true">LOCAL</div>
	<div class="lsd-hero__inner">
		<h1 class="lsd-hero__headline">
			<?php echo esc_html($hero_headline1); ?><br>
			<?php echo esc_html($hero_headline2); ?>
		</h1>
		<p class="lsd-hero__sub"><?php echo esc_html($hero_sub); ?></p>
		<div class="lsd-hero__btns">
			<a href="<?php echo esc_url($btn1_url); ?>" class="lsd-btn lsd-btn--primary">
				<?php echo esc_html($btn1_text); ?>
			</a>
			<a href="<?php echo esc_url($btn2_url); ?>" class="lsd-btn lsd-btn--outline-dark">
				<?php echo esc_html($btn2_text); ?>
			</a>
		</div>
	</div>
</section>

<!-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
	 LATEST ARTICLES
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="lsd-section lsd-section--white">
	<div class="lsd-section__header">
		<h2 class="lsd-section__title">Latest articles</h2>
		<a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
			class="lsd-section__link">View all →</a>
	</div>

	<div class="lsd-articles-grid">
		<?php
		$latest = new WP_Query(array(
			'post_type' => 'post',
			'posts_per_page' => 3,
			'post_status' => 'publish',
		));

		if ($latest->have_posts()):
			while ($latest->have_posts()):
				$latest->the_post();
				$reading_time = lsd_reading_time(get_the_ID());
				?>
				<a href="<?php the_permalink(); ?>" class="lsd-article-card">
					<h3 class="lsd-article-card__title"><?php the_title(); ?></h3>
					<p class="lsd-article-card__excerpt">
						<?php echo wp_trim_words(get_the_excerpt(), 45, '…'); ?>
					</p>
					<div class="lsd-article-card__meta">
						<span><?php echo get_the_date('M j, Y'); ?></span>
						<span class="lsd-article-card__dot" aria-hidden="true"></span>
						<span><?php echo esc_html($reading_time); ?> min read</span>
					</div>
				</a>
				<?php
			endwhile;
			wp_reset_postdata();
		else:
			?>
			<p class="lsd-no-posts">No posts published yet. <a
					href="<?php echo esc_url(admin_url('post-new.php')); ?>">Write your first post →</a></p>
		<?php endif; ?>
	</div>
</section>

<!-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
	 NEWSLETTER STRIP
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="lsd-nl-strip">
	<div class="lsd-nl-strip__inner">
		<div class="lsd-nl-strip__text">
			<h2 class="lsd-nl-strip__headline"><?php echo wp_kses($nl_headline, array('span' => array())); ?></h2>
			<p class="lsd-nl-strip__sub"><?php echo esc_html($nl_sub); ?></p>
		</div>
		<form class="lsd-nl-strip__form" method="POST"
			action="https://1c0cb842.sibforms.com/serve/MUIFACfB43trusSs2v3WjJyc3X8hMfxr031W92rOqPBY-RgYtAkikvYykYSkl2vxmAMxGF_uyJGnvJTbl3e3zThuAopZeArAR8Mv-agnDrZhKKfe7ZMKGO_OXG0V16MfdJaa6TR4tMtg9ClJrqtITc9dI87d55Doe2BEi1OBTDcmw0MezVbF0BTvojWOvu79yhSWyVrtYgy5eghj">
			<input type="email" name="EMAIL" class="lsd-nl-strip__input" placeholder="your@email.com" required
				aria-label="Email address" />
			<button type="submit" class="lsd-btn lsd-btn--yellow">Subscribe</button>
			<input type="text" name="email_address_check" value="" style="display:none;">
			<input type="hidden" name="locale" value="en">
		</form>
	</div>
</section>

<!-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
	 RESOURCES
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="lsd-section lsd-section--gray">
	<div class="lsd-section__header">
		<h2 class="lsd-section__title">Resources</h2>
		<a href="<?php echo esc_url(home_url('/resources/')); ?>" class="lsd-section__link">View all →</a>
	</div>

	<div class="lsd-resources-grid">
		<?php
		// Pull up to 3 posts from the 'resource' category (or custom post type if you add one later)
		$resources = new WP_Query(array(
			'post_type' => 'post',
			'posts_per_page' => 3,
			'post_status' => 'publish',
			'category_name' => 'resources',
		));

		// If no resource posts yet, show placeholder cards
		if ($resources->have_posts()):
			while ($resources->have_posts()):
				$resources->the_post();
				$res_type = get_post_meta(get_the_ID(), '_lsd_resource_type', true) ?: 'Guide';
				$res_free = get_post_meta(get_the_ID(), '_lsd_resource_free', true);
				$res_link_label = get_post_meta(get_the_ID(), '_lsd_resource_link_label', true) ?: 'Read the guide →';
				?>
				<a href="<?php the_permalink(); ?>" class="lsd-resource-card">
					<div class="lsd-resource-card__type">
						<?php echo esc_html($res_type); ?>
						<?php if ($res_free): ?>
							<span class="lsd-resource-card__free">FREE</span>
						<?php endif; ?>
					</div>
					<h3 class="lsd-resource-card__title"><?php the_title(); ?></h3>
					<p class="lsd-resource-card__desc">
						<?php echo wp_trim_words(get_the_excerpt(), 24, '…'); ?>
					</p>
					<span class="lsd-resource-card__link"><?php echo esc_html($res_link_label); ?></span>
				</a>
				<?php
			endwhile;
			wp_reset_postdata();
		else:
			// Hardcoded placeholders — each links directly to its section on the Resources page
			$placeholders = array(
				array(
					'cat' => 'guide',
					'cat_label' => 'Guides',
					'title' => 'Local SEO Guides',
					'desc' => 'Step-by-step guides covering GBP optimization, citation building, review generation, and local pack rankings.',
					'link' => home_url('/resources/#guides'),
					'label' => 'Browse guides →',
				),
				array(
					'cat' => 'tool',
					'cat_label' => 'Tools',
					'title' => 'Essential Tools',
					'desc' => 'The core tools every local SEO practitioner needs — from Google Business Profile to Search Console and Analytics.',
					'link' => home_url('/resources/#tools'),
					'label' => 'See the tools →',
				),
				array(
					'cat' => 'fundamentals',
					'cat_label' => 'Fundamentals',
					'title' => 'Recommended Reading',
					'desc' => 'Google\'s own documentation on how search works, how results are ranked, and how local results are determined.',
					'link' => home_url('/resources/#recommended-reading'),
					'label' => 'Start reading →',
				),
			);
			foreach ($placeholders as $p):
				?>
				<a href="<?php echo esc_url($p['link']); ?>" class="lsd-resource-card">
					<span class="resource-card__cat resource-card__cat--<?php echo esc_attr($p['cat']); ?>">
						<?php echo esc_html($p['cat_label']); ?>
					</span>
					<h3 class="lsd-resource-card__title"><?php echo esc_html($p['title']); ?></h3>
					<p class="lsd-resource-card__desc"><?php echo esc_html($p['desc']); ?></p>
					<span class="lsd-resource-card__link"><?php echo esc_html($p['label']); ?></span>
				</a>
				<?php
			endforeach;
		endif;
		?>
	</div>
</section>

<?php get_footer(); ?>