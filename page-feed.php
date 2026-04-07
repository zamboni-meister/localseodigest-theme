<?php
/*
 * Template Name: Feed Page
 */
get_header();

$feed_url = esc_url( get_bloginfo( 'rss2_url' ) );
?>

<div class="resources-header">
    <div class="container">
        <h1 class="resources-header__title">Latest Articles</h1>
        <p class="resources-header__subtitle">Fresh posts from the Local SEO Digest — updated automatically.</p>
    </div>
</div>

<div style="padding: 56px 0;">
    <div class="container">

        <!-- Controls row -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 28px;">
            <div id="feed-status" style="font-size: 0.82rem; color: var(--mid-gray);">Loading feed&hellip;</div>
            <input
                id="feed-search"
                type="search"
                placeholder="Search articles&hellip;"
                style="padding: 8px 14px; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.85rem; color: var(--ink); background: var(--warm-white); outline: none; width: 220px;"
            >
        </div>

        <!-- Article table -->
        <div style="border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden;">
            <div style="display: grid; grid-template-columns: 160px 1fr 160px; background: var(--ink); padding: 12px 20px; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.07em; text-transform: uppercase; color: rgba(255,255,255,0.5);">
                <span>Source</span>
                <span>Article</span>
                <span style="text-align: right;">Date</span>
            </div>
            <div id="feed-rows">
                <!-- JS populates rows here -->
                <div id="feed-loading" style="padding: 48px; text-align: center; color: var(--mid-gray); font-size: 0.9rem;">
                    Fetching latest articles&hellip;
                </div>
            </div>
        </div>

        <div id="feed-empty" style="display: none; padding: 48px; text-align: center; color: var(--mid-gray); font-size: 0.9rem;">
            No articles match your search.
        </div>

    </div>
</div>

<script>
(function () {
    const FEED_URL = '<?php echo $feed_url; ?>';
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

    function stripCdata(str) {
        return str ? str.replace(/<!\[CDATA\[([\s\S]*?)\]\]>/g, '$1').trim() : '';
    }

    function extractSource(item) {
        // Try <source> element, fall back to first category, then site title
        const sourceEl = item.querySelector('source');
        if (sourceEl) return sourceEl.textContent.trim();
        const catEl = item.querySelector('category');
        if (catEl) return stripCdata(catEl.textContent);
        return 'LocalSEO Digest';
    }

    function buildRow(item, index) {
        const title   = stripCdata(item.querySelector('title')?.textContent || '');
        const link    = item.querySelector('link')?.textContent?.trim()
                        || item.querySelector('link')?.getAttribute('href') || '#';
        const pubDate = item.querySelector('pubDate')?.textContent || '';
        const source  = extractSource(item);

        const isEven = index % 2 === 0;
        const bg = isEven ? 'var(--warm-white)' : '#fff';

        return `
            <div class="feed-row" data-title="${title.toLowerCase()}" data-source="${source.toLowerCase()}"
                 style="display: grid; grid-template-columns: 160px 1fr 160px; align-items: center; padding: 14px 20px; background: ${bg}; border-top: 1px solid var(--border); transition: background 0.15s ease;"
                 onmouseover="this.style.background='var(--yellow-tint)'" onmouseout="this.style.background='${bg}'">
                <span style="font-size: 0.78rem; font-weight: 700; color: var(--yellow-dark); background: var(--yellow-tint); border: 1px solid rgba(255,240,31,0.35); border-radius: 20px; padding: 3px 10px; display: inline-block; max-width: 130px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    ${source}
                </span>
                <a href="${link}" target="_blank" rel="noopener"
                   style="font-size: 0.88rem; color: var(--ink); text-decoration: none; font-weight: 500; line-height: 1.4; padding: 0 16px;"
                   onmouseover="this.style.color='var(--yellow-dark)'" onmouseout="this.style.color='var(--ink)'">
                    ${title}
                </a>
                <span style="font-size: 0.78rem; color: var(--mid-gray); text-align: right; white-space: nowrap;">
                    ${formatDate(pubDate)}
                </span>
            </div>`;
    }

    function renderRows(items) {
        const loading = document.getElementById('feed-loading');
        if (loading) loading.remove();

        if (items.length === 0) {
            rowsEl.innerHTML = '';
            emptyEl.style.display = 'block';
            return;
        }

        emptyEl.style.display = 'none';
        rowsEl.innerHTML = items.map((item, i) => buildRow(item, i)).join('');
    }

    function filterItems(query) {
        if (!query) return allItems;
        const q = query.toLowerCase();
        return allItems.filter(item => {
            const row = rowsEl.querySelector(`[data-title="${item._title}"]`);
            return item._title.includes(q) || item._source.includes(q);
        });
    }

    // Fetch & parse
    fetch(FEED_URL)
        .then(res => {
            if (!res.ok) throw new Error('Feed fetch failed: ' + res.status);
            return res.text();
        })
        .then(xml => {
            const parser = new DOMParser();
            const doc    = parser.parseFromString(xml, 'application/xml');
            const items  = Array.from(doc.querySelectorAll('item'));

            if (items.length === 0) {
                statusEl.textContent = 'No articles found in feed.';
                renderRows([]);
                return;
            }

            // Attach searchable props
            allItems = items.map(item => {
                item._title  = (item.querySelector('title')?.textContent || '').toLowerCase();
                item._source = extractSource(item).toLowerCase();
                return item;
            });

            statusEl.textContent = `${items.length} article${items.length !== 1 ? 's' : ''} loaded`;
            renderRows(allItems);
        })
        .catch(err => {
            statusEl.textContent = 'Could not load feed.';
            rowsEl.innerHTML = `<div style="padding: 32px; text-align: center; color: var(--mid-gray); font-size: 0.875rem;">Unable to fetch feed. Check the feed URL or try again later.</div>`;
            console.error(err);
        });

    // Search
    searchEl.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase();
        const filtered = q
            ? allItems.filter(item => item._title.includes(q) || item._source.includes(q))
            : allItems;
        statusEl.textContent = q
            ? `${filtered.length} result${filtered.length !== 1 ? 's' : ''} for "${this.value.trim()}"`
            : `${allItems.length} articles loaded`;
        renderRows(filtered);
    });
}());
</script>

<?php get_footer(); ?>
