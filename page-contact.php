<?php
/*
 * Template Name: Contact Page
 */
get_header(); ?>

<div class="archive-header">
    <div class="container">
        <h1 class="archive-header__title">Get in Touch</h1>
    </div>
</div>

<div class="contact-section">
    <div class="container">
        <div class="contact-grid">

            <div class="contact-info">
                <h2>Let's talk local SEO</h2>
                <p>Have a question, want to collaborate, or have a topic you'd like me to cover? I'd love to hear from
                    you. I read every message and respond to most within a few days.</p>

                <div class="contact-detail">
                    <div class="contact-detail__icon">✉️</div>
                    <div>
                        <div class="contact-detail__label">Email</div>
                        <div class="contact-detail__text" style="display:flex; align-items:center; gap:8px;">
                            <a href="mailto:info@localseodigest.com">info@localseodigest.com</a>
                            <button
                                onclick="navigator.clipboard.writeText('info@localseodigest.com').then(() => { this.textContent='Copied!'; setTimeout(() => this.textContent='Copy', 2000); })"
                                style="font-size:0.75rem; padding:2px 8px; cursor:pointer;">Copy</button>
                        </div>
                    </div>
                </div>

                <div class="contact-detail">
                    <div class="contact-detail__icon">📍</div>
                    <div>
                        <div class="contact-detail__label">Based in</div>
                        <div class="contact-detail__text">St. Louis, Missouri</div>
                    </div>
                </div>

                <div style="margin-top: 32px;">
                    <div
                        style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--light-gray); margin-bottom: 14px;">
                        Also find me on</div>
                    <div style="display: flex; gap: 10px;">
                        <a href="https://www.linkedin.com/in/zane-creek/"
                            style="background: var(--warm-white); border: 1px solid var(--border); padding: 8px 16px; border-radius: var(--radius); font-size: 0.82rem; font-weight: 500; color: var(--charcoal); transition: border-color 0.18s ease;">LinkedIn</a>
                    </div>
                </div>
            </div>

            <div>
                <?php while (have_posts()):
                    the_post(); ?>
                    <?php if (get_the_content()): ?>
                        <div class="entry-content"><?php the_content(); ?></div>
                    <?php else: ?>
                        <div style="background: var(--warm-white); border-radius: var(--radius-lg); padding: 36px;">
                            <h3 style="margin-bottom: 24px; font-size: 1.1rem;">Send a message</h3>
                            <form method="post" action="#">
                                <?php wp_nonce_field('lsd_contact', 'lsd_contact_nonce'); ?>
                                <div style="margin-bottom: 20px;">
                                    <label
                                        style="display: block; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--ink); margin-bottom: 7px;">Your
                                        Name</label>
                                    <input type="text" name="contact_name" placeholder="Jordan Doe"
                                        style="width: 100%; padding: 11px 14px; border: 1.5px solid var(--border); border-radius: var(--radius); font-family: var(--font); font-size: 0.95rem; outline: none; background: var(--white);">
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label
                                        style="display: block; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--ink); margin-bottom: 7px;">Email
                                        Address</label>
                                    <input type="email" name="contact_email" placeholder="example@email.com"
                                        style="width: 100%; padding: 11px 14px; border: 1.5px solid var(--border); border-radius: var(--radius); font-family: var(--font); font-size: 0.95rem; outline: none; background: var(--white);">
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label
                                        style="display: block; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--ink); margin-bottom: 7px;">Message</label>
                                    <textarea name="contact_message" rows="5" placeholder="What's on your mind?"
                                        style="width: 100%; padding: 11px 14px; border: 1.5px solid var(--border); border-radius: var(--radius); font-family: var(--font); font-size: 0.95rem; outline: none; background: var(--white); resize: vertical;"></textarea>
                                </div>
                                <button type="submit"
                                    style="background: var(--ink); color: var(--white); border: none; padding: 13px 28px; border-radius: var(--radius); font-family: var(--font); font-size: 0.875rem; font-weight: 600; cursor: pointer;">Send
                                    message</button>
                            </form>
                        </div>
                    <?php endif; endwhile; ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>