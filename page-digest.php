<?php
/*
 * Template Name: Digest Page
 */
get_header(); ?>

<div class="resources-header">
    <div class="container">
        <h1 class="resources-header__title">Latest Articles</h1>
        <p class="resources-header__subtitle">Fresh posts from across the local SEO web — updated automatically.</p>
    </div>
</div>

<div class="container">
    <div style="padding: 56px 0;">

        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <div id="feed-status" style="font-size: 0.82rem; color: var(--mid-gray);">Loading&hellip;</div>
            <input
                id="feed-search"
                type="search"
                placeholder="Search articles&hellip;"
                style="padding: 8px 14px; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.85rem; color: var(--ink); background: var(--warm-white); outline: none; width: 220px;"
            >
        </div>

        <div id="feed-rows"></div>

        <div id="feed-empty" style="display: none; padding: 48px; text-align: center; color: var(--mid-gray); font-size: 0.9rem;">
            No articles match your search.
        </div>

    </div>
</div>

<!-- JS goes here -->
<script>
(function () {
    const FEED_URL = 'https://doytr55.app.n8n.cloud/webhook/feed-data';
    const rowsEl   = document.getElementById('feed-rows');
    const statusEl = document.getElementById('feed-status');
    const searchEl = document.getElementById('feed-search');
    const emptyEl  = document.getElementById('feed-empty');

    let allItems = [];

    function formatDate(dateStr) {
        const d = new Date(dateStr);
        if (isNaN(d)) return dateStr;
        return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }

    function buildRow(item, index) {
        const isEven = index % 2 === 0;
        const bg = isEven ? 'var(--warm-white)' : '#fff';
        return `
            <div class="feed-row"
                 data-title="${item.title.toLowerCase()}"
                 data-source="${item.source.toLowerCase()}"
                 style="display: grid; grid-template-columns: 160px 1fr 160px; align-items: center; padding: 14px 20px; background: ${bg}; border-top: 1px solid var(--border); transition: background 0.15s ease;"
                 onmouseover="this.style.background='var(--yellow-tint)'" onmouseout="this.style.background='${bg}'">
                <span style="font-size: 0.78rem; font-weight: 700; color: var(--yellow-dark); background: var(--yellow-tint); border: 1px solid rgba(255,240,31,0.35); border-radius: 20px; padding: 3px 10px; display: inline-block; max-width: 130px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    ${item.source}
                </span>
                <a href="${item.link}" target="_blank" rel="noopener"
                   style="font-size: 0.88rem; color: var(--ink); text-decoration: none; font-weight: 500; line-height: 1.4; padding: 0 16px;"
                   onmouseover="this.style.color='var(--yellow-dark)'" onmouseout="this.style.color='var(--ink)'">
                    ${item.title}
                </a>
                <span style="font-size: 0.78rem; color: var(--mid-gray); text-align: right; white-space: nowrap;">
                    ${formatDate(item.date)}
                </span>
            </div>`;
    }

    function renderRows(items) {
        if (items.length === 0) {
            rowsEl.innerHTML = '';
            emptyEl.style.display = 'block';
            return;
        }

        emptyEl.style.display = 'none';
        rowsEl.innerHTML = items.map((item, i) => buildRow(item, i)).join('');
    }

    fetch(FEED_URL)
        .then(res => {
            if (!res.ok) throw new Error('Feed fetch failed: ' + res.status);
            return res.json();
        })
        .then(data => {
            allItems = Array.isArray(data) ? data : data.items || [];

            if (allItems.length === 0) {
                statusEl.textContent = 'No articles found.';
                renderRows([]);
                return;
            }

            statusEl.textContent = `${allItems.length} article${allItems.length !== 1 ? 's' : ''} loaded`;
            renderRows(allItems);
        })
        .catch(err => {
            statusEl.textContent = 'Could not load feed.';
            rowsEl.innerHTML = `<div style="padding: 32px; text-align: center; color: var(--mid-gray); font-size: 0.875rem;">Unable to fetch feed. Try again later.</div>`;
            console.error(err);
        });

    searchEl.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase();
        const filtered = q
            ? allItems.filter(item => item.title.toLowerCase().includes(q) || item.source.toLowerCase().includes(q))
            : allItems;
        statusEl.textContent = q
            ? `${filtered.length} result${filtered.length !== 1 ? 's' : ''} for "${this.value.trim()}"`
            : `${allItems.length} articles loaded`;
        renderRows(filtered);
    });
}());
</script>

<?php get_footer(); ?>
