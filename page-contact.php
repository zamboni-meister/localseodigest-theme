<?php
/*
 * Template Name: Contact Page
 */

$lsd_success = false;
$lsd_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lsd_contact_nonce'])) {
    if (!wp_verify_nonce($_POST['lsd_contact_nonce'], 'lsd_contact')) {
        $lsd_error = 'Security check failed. Please try again.';
    } else {
        $name = sanitize_text_field($_POST['contact_name'] ?? '');
        $email = sanitize_email($_POST['contact_email'] ?? '');
        $message = sanitize_textarea_field($_POST['contact_message'] ?? '');

        if (empty($name) || empty($email) || empty($message)) {
            $lsd_error = 'Please fill out all fields before submitting.';
        } elseif (!is_email($email)) {
            $lsd_error = 'Please enter a valid email address.';
        } else {
            $to = 'info@localseodigest.com';
            $subject = '[Local SEO Digest] Message from ' . $name;
            $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
            $headers = [
                'Content-Type: text/plain; charset=UTF-8',
                'From: LocalSEO Digest <info@localseodigest.com>',
                'Reply-To: ' . $name . ' <' . $email . '>',
            ];

            if (wp_mail($to, $subject, $body, $headers)) {
                $lsd_success = true;

                // Push contact to Brevo
                require_once get_template_directory() . '/lsd-secrets.php';
                $brevo_api_key = LSD_BREVO_API_KEY;
                $brevo_payload = json_encode([
                    'email' => $email,
                    'attributes' => [
                        'FIRSTNAME' => $name,
                        'MESSAGE' => $message,
                        'DATE' => date('Y-m-d H:i:s'),
                    ],
                    'listIds' => [4],
                    'updateEnabled' => true,
                ]);

                $brevo_response = wp_remote_post('https://api.brevo.com/v3/contacts', [
                    'headers' => [
                        'api-key' => $brevo_api_key,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'body' => $brevo_payload,
                    'timeout' => 10,
                ]);
            } else {
                $lsd_error = 'Something went wrong sending your message. Please email us directly.';
            }
        }
    }
}

get_header(); ?>

<div class="archive-header">
    <div class="container">
        <div class="archive-header__label">Contact</div>
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
                        <div class="contact-detail__text" style="display:flex; align-items:center; gap:10px;">
                            <a href="mailto:info@localseodigest.com">info@localseodigest.com</a>
                            <button
                                onclick="navigator.clipboard.writeText('info@localseodigest.com').then(() => { this.textContent='Copied!'; this.style.background='var(--yellow)'; this.style.color='var(--ink)'; setTimeout(() => { this.textContent='Copy'; this.style.background='transparent'; this.style.color='var(--light-gray)'; }, 2000); })"
                                style="font-size:0.7rem; font-weight:700; letter-spacing:0.06em; text-transform:uppercase; font-family:var(--font); padding:3px 9px; border:1.5px solid var(--border); border-radius:var(--radius); background:transparent; color:var(--light-gray); cursor:pointer; transition:all 0.18s ease;">Copy</button>
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
                        <a href="https://www.linkedin.com/in/zane-creek/" target="_blank" rel="noopener noreferrer"
                            style="background: var(--warm-white); border: 1px solid var(--border); padding: 8px 16px; border-radius: var(--radius); font-size: 0.82rem; font-weight: 500; color: var(--charcoal); transition: border-color 0.18s ease; display:inline-flex; align-items:center; gap:7px; text-decoration:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15" height="15">
                                <path fill="#0A66C2"
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                            LinkedIn
                        </a>
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

                            <?php if ($lsd_success): ?>
                                <div style="text-align: center; padding: 16px 0;">
                                    <div style="font-size: 2rem; margin-bottom: 16px;">✅</div>
                                    <h3 style="margin-bottom: 10px; font-size: 1.1rem;">Message received!</h3>
                                    <p style="color: var(--light-gray); font-size: 0.92rem; margin: 0;">Thanks for reaching out.
                                        I'll get back to you within a few days.</p>
                                </div>

                            <?php else: ?>
                                <h3 style="margin-bottom: 24px; font-size: 1.1rem;">Send a message</h3>

                                <?php if ($lsd_error): ?>
                                    <div
                                        style="background: #fff3f3; border: 1.5px solid #f5c2c2; border-radius: var(--radius); padding: 12px 16px; margin-bottom: 20px; font-size: 0.88rem; color: #c0392b;">
                                        <?php echo esc_html($lsd_error); ?>
                                    </div>
                                <?php endif; ?>

                                <form method="post" action="">
                                    <?php wp_nonce_field('lsd_contact', 'lsd_contact_nonce'); ?>
                                    <div style="margin-bottom: 20px;">
                                        <label
                                            style="display: block; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--ink); margin-bottom: 7px;">Your
                                            Name</label>
                                        <input type="text" name="contact_name" placeholder="Jordan Doe"
                                            value="<?php echo esc_attr($_POST['contact_name'] ?? ''); ?>"
                                            style="width: 100%; padding: 11px 14px; border: 1.5px solid var(--border); border-radius: var(--radius); font-family: var(--font); font-size: 0.95rem; outline: none; background: var(--white);">
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                        <label
                                            style="display: block; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--ink); margin-bottom: 7px;">Email
                                            Address</label>
                                        <input type="email" name="contact_email" placeholder="example@email.com"
                                            value="<?php echo esc_attr($_POST['contact_email'] ?? ''); ?>"
                                            style="width: 100%; padding: 11px 14px; border: 1.5px solid var(--border); border-radius: var(--radius); font-family: var(--font); font-size: 0.95rem; outline: none; background: var(--white);">
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                        <label
                                            style="display: block; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--ink); margin-bottom: 7px;">Message</label>
                                        <textarea name="contact_message" rows="5" placeholder="What's on your mind?"
                                            style="width: 100%; padding: 11px 14px; border: 1.5px solid var(--border); border-radius: var(--radius); font-family: var(--font); font-size: 0.95rem; outline: none; background: var(--white); resize: vertical;"><?php echo esc_textarea($_POST['contact_message'] ?? ''); ?></textarea>
                                    </div>

                                    <button type="submit"
                                        style="background: var(--ink); color: var(--white); border: none; padding: 13px 28px; border-radius: var(--radius); font-family: var(--font); font-size: 0.875rem; font-weight: 600; cursor: pointer;">Send
                                        message</button>
                                </form>
                            <?php endif; ?>

                        </div>
                    <?php endif; endwhile; ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>