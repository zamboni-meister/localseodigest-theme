<?php
/*
 * Template Name: Feed Page
 */
get_header(); ?>

<div class="resources-header">
    <div class="container">
        <h1 class="resources-header__title">RSS Feed</h1>
        <p class="resources-header__subtitle">Subscribe to the Local SEO Digest feed to get the latest articles delivered to your reader.</p>
    </div>
</div>

<div style="padding: 56px 0;">
    <div class="container--narrow">

        <div style="background: var(--ink); border-radius: var(--radius-lg); padding: 8px; overflow: hidden;">
            <div style="display: flex; align-items: center; gap: 8px; padding: 10px 16px; border-bottom: 1px solid rgba(255,255,255,0.08);">
                <span style="width: 12px; height: 12px; border-radius: 50%; background: #ff5f57;"></span>
                <span style="width: 12px; height: 12px; border-radius: 50%; background: #ffbd2e;"></span>
                <span style="width: 12px; height: 12px; border-radius: 50%; background: #28c840;"></span>
                <span style="margin-left: 8px; font-size: 0.75rem; color: rgba(255,255,255,0.4); font-family: monospace;">feed.xml</span>
            </div>
            <pre style="margin: 0; padding: 28px; overflow-x: auto; font-family: 'Courier New', Courier, monospace; font-size: 0.82rem; line-height: 1.7; color: rgba(255,255,255,0.85); white-space: pre-wrap; word-break: break-word;"><?php
                $content = get_the_content();
                // Strip any wrapping <p> tags WordPress adds around code blocks
                $content = preg_replace( '/^<p>(.*)<\/p>$/s', '$1', trim( $content ) );
                echo $content;
            ?></pre>
        </div>

    </div>
</div>

<?php get_footer(); ?>
