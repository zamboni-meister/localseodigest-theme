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
		<h1 class="lsd-nl-page__headline">Local SEO Newsletter</h1>
		<p class="lsd-nl-page__sub">News that actually matters + tools, guides, and resources worth your time.</p>
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
				<li>Curated Local SEO news and insights</li>
				<li>Tools, tips, and reading recommendations from the fundametals-upwards</li>
                <li>Grounded research and timely updates</li>
			</ul>
		</div>

		<!-- Form -->
		<div class="lsd-nl-page__form-wrap">
			<form class="lsd-nl-page__form" method="POST" target="_blank"
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
                <input type="hidden" name="redirectionUrl" value="https://sibforms.com/confirmation/success/subscription/double?locale=en">
			</form>
			<p class="lsd-nl-page__disclaimer">We'll never sell or misuse your info. Unsubscribe any time.</p>
		</div>

	</div>
</section>

<?php get_footer(); ?>