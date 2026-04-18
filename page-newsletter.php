<?php
/**
 * Template Name: Newsletter Page
 * Newsletter signup page — LocalSEO Digest
 */

get_header();
?>

<!-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     HERO
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="lsd-nl-page__hero">
	<div class="lsd-nl-page__hero-inner">
		<p class="lsd-nl-page__eyebrow">Free newsletter</p>
		<h1 class="lsd-nl-page__headline">Local SEO intel,<br>every Friday.</h1>
		<p class="lsd-nl-page__sub">The <strong>Local SEO Digest</strong> breaks down GBP changes, ranking signal updates, and practical local search strategy — written for SEO professionals and business owners who want to stay ahead.</p>
	</div>
</section>

<!-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     SIGNUP SECTION
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="lsd-nl-page__body">
	<div class="lsd-nl-page__body-inner">

		<!-- What you get -->
		<div class="lsd-nl-page__value">
			<p class="lsd-nl-page__value-label">What's inside</p>
			<ul class="lsd-nl-page__value-list">
				<li>GBP changelog — what changed, what it means for rankings</li>
				<li>Ranking signal breakdowns based on current research</li>
				<li>Local search news filtered for what actually matters</li>
				<li>Tools, templates, and resources worth your time</li>
			</ul>
		</div>

		<!-- Form -->
		<div class="lsd-nl-page__form-wrap">
			<form class="lsd-nl-page__form" method="POST"
				action="https://1c0cb842.sibforms.com/serve/MUIFACfB43trusSs2v3WjJyc3X8hMfxr031W92rOqPBY-RgYtAkikvYykYSkl2vxmAMxGF_uyJGnvJTbl3e3zThuAopZeArAR8Mv-agnDrZhKKfe7ZMKGO_OXG0V16MfdJaa6TR4tMtg9ClJrqtITc9dI87d55Doe2BEi1OBTDcmw0MezVbF0BTvojWOvu79yhSWyVrtYgy5eghj">
				<label for="lsd-nl-email" class="lsd-nl-page__form-label">Your email address</label>
				<div class="lsd-nl-page__form-row">
					<input
						id="lsd-nl-email"
						type="email"
						name="EMAIL"
						class="lsd-nl-page__input"
						placeholder="you@example.com"
						required
						aria-label="Email address"
					/>
					<button type="submit" class="lsd-btn lsd-btn--yellow">Subscribe</button>
				</div>
				<input type="text" name="email_address_check" value="" style="display:none;">
				<input type="hidden" name="locale" value="en">
			</form>
			<p class="lsd-nl-page__disclaimer">Free. Every Friday. No spam — unsubscribe any time.</p>
		</div>

	</div>
</section>

<?php get_footer(); ?>