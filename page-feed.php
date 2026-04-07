<?php
/*
 * Template Name: Feed Page
 */
get_header(); ?>

<div class="resources-header">
    <div class="container">
        <h1 class="resources-header__title">Latest Articles</h1>
        <p class="resources-header__subtitle">Fresh posts from the Local SEO Digest — fetched live from the RSS feed.</p>
    </div>
</div>

<div class="container">
    <div style="padding: 56px 0;">

        <div class="section-header" style="display: flex; align-items: center; justify-content: space-between;">
            <div id="feed-status" style="font-size: 0.82rem; color: var(--mid-gray);">Loading&hellip;</div>
            <input
                id="feed-search"
                type="search"
                placeholder="Search articles&hellip;"
                style="padding: 8px 14px; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.85rem; color: var(--ink); background: var(--warm-white); outline: none; width: 220px;"
            >
        </div>

        <div id="feed-rows"></div>

    </div>
</div>

<!-- JS goes here -->

<?php get_footer(); ?>
