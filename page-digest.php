<?php
/*
 * Template Name: Digest Page
 */

$items = get_option('lsd_digest_feed', []);
if (!is_array($items)) {
    $items = [];
}

get_header(); ?>

<div class="resources-header">
    <div class="container">
        <div class="archive-header__label">RSS Feed</div>
        <h1 class="resources-header__title">Digest</h1>
        <p class="resources-header__subtitle">Fresh posts from across the local SEO web — updated hourly.</p>
    </div>
</div>

<div class="container">
    <div style="padding: 56px 0;">

        <!-- Controls bar -->
        <div class="digest-controls">
            <div id="feed-status" class="digest-controls__status">
                <?php echo count($items); ?> article<?php echo count($items) !== 1 ? 's' : ''; ?> loaded
            </div>
            <div class="digest-controls__right">
                <div class="digest-per-page">
                    Show
                    <select id="per-page-top" class="digest-select">
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    per page
                </div>
                <input
                    id="feed-search"
                    type="search"
                    placeholder="Search articles&hellip;"
                    class="digest-search"
                >
            </div>
        </div>

        <div id="feed-rows">
            <?php foreach ($items as $index => $item) :
                $source    = esc_html($item['source'] ?? '');
                $title     = esc_html($item['title'] ?? '');
                $link      = esc_url($item['link'] ?? '#');
                $date      = esc_html($item['date'] ?? '');
                $bg        = $index % 2 === 0 ? 'var(--warm-white)' : '#fff';

                $formatted_date = '';
                if ($date) {
                    $timestamp = strtotime($date);
                    if ($timestamp) {
                        $formatted_date = date('M j, Y g:i A', $timestamp);
                    }
                }
            ?>
            <div class="feed-row"
                 data-title="<?php echo strtolower($title); ?>"
                 data-source="<?php echo strtolower($source); ?>"
                 data-bg="<?php echo $bg; ?>"
                 style="background: <?php echo $bg; ?>;"
                 onmouseover="this.style.background='var(--yellow-tint)'" onmouseout="this.style.background=this.dataset.bg">
                <div class="feed-row__badge-col">
                    <span class="source-badge" data-source="<?php echo strtolower($source); ?>">
                        <?php echo $source; ?>
                    </span>
                </div>
                <a href="<?php echo $link; ?>" target="_blank" rel="noopener" class="feed-row__title"
                   onmouseover="this.style.color='var(--yellow-dark)'" onmouseout="this.style.color='var(--ink)'">
                    <?php echo $title; ?>
                </a>
                <span class="feed-row__date">
                    <?php echo $formatted_date ?: $date; ?>
                </span>
            </div>
            <?php endforeach; ?>
        </div>

        <div id="feed-empty" style="display: none; padding: 48px; text-align: center; color: var(--mid-gray); font-size: 0.9rem;">
            No articles match your search.
        </div>

        <div id="pagination-bottom" class="digest-pagination">
            <div id="page-info-bottom" style="font-size: 0.82rem; color: var(--mid-gray);"></div>
            <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                <div id="page-buttons-bottom" style="display: flex; gap: 6px; flex-wrap: wrap;"></div>
                <div class="digest-per-page">
                    Show
                    <select id="per-page-bottom" class="digest-select">
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    per page
                </div>
            </div>
        </div>

    </div>
</div>

<style>
/* ── Source badges ─────────────────────────────────────── */
.source-badge[data-source="google search central"] { background: #4285F4; color: #fff; border: 1px solid #000; }
.source-badge[data-source="semrush"]               { background: #E0C7FF; color: #181E15; border: 1px solid #000; }
.source-badge[data-source="nathan gotch"]           { background: #2952CC; color: #fff; border: 1px solid #000; }
.source-badge[data-source="search engine journal"]  { background: #5DC82A; color: #fff; border: 1px solid #000; }
.source-badge                                       { background: var(--yellow-tint); color: var(--yellow-dark); border: 1px solid #000; }

.source-badge {
    font-size: 0.78rem;
    font-weight: 700;
    border-radius: 20px;
    padding: 3px 10px;
    display: inline-block;
    white-space: nowrap;
}

/* ── Controls bar ──────────────────────────────────────── */
.digest-controls {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.digest-controls__status {
    font-size: 0.82rem;
    color: var(--mid-gray);
    white-space: nowrap;
}

.digest-controls__right {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.digest-per-page {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.82rem;
    color: var(--mid-gray);
    white-space: nowrap;
}

.digest-select {
    padding: 4px 8px;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.82rem;
    color: var(--ink);
    background: var(--warm-white);
    outline: none;
}

.digest-search {
    padding: 8px 14px;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.85rem;
    color: var(--ink);
    background: var(--warm-white);
    outline: none;
    width: 220px;
}

/* ── Feed rows ─────────────────────────────────────────── */
.feed-row {
    display: grid;
    grid-template-columns: auto 1fr 200px;
    align-items: center;
    padding: 14px 20px;
    border-top: 1px solid var(--border);
    transition: background 0.15s ease;
    gap: 0;
}

.feed-row__badge-col {
    padding-right: 16px;
}

.feed-row__title {
    font-size: 0.88rem;
    color: var(--ink);
    text-decoration: none;
    font-weight: 500;
    line-height: 1.4;
    padding: 0 16px 0 0;
}

.feed-row__date {
    font-size: 0.78rem;
    color: var(--mid-gray);
    text-align: right;
    white-space: nowrap;
}

/* ── Pagination bar ────────────────────────────────────── */
.digest-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 20px;
    flex-wrap: wrap;
    gap: 12px;
}

/* ── Mobile ────────────────────────────────────────────── */
@media (max-width: 640px) {

    /* Stack controls vertically */
    .digest-controls {
        flex-direction: column;
        align-items: flex-start;
    }

    .digest-controls__right {
        width: 100%;
    }

    .digest-search {
        width: 100%;
        flex: 1;
    }

    /* Stack each row: badge top, title middle, date bottom */
    .feed-row {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
        padding: 12px 16px;
    }

    .feed-row__badge-col {
        padding-right: 0;
    }

    .feed-row__title {
        padding: 0;
        font-size: 0.875rem;
    }

    .feed-row__date {
        text-align: left;
        font-size: 0.75rem;
    }
}
</style>

<script>
(function () {
    const allRows     = Array.from(document.querySelectorAll('.feed-row'));
    const statusEl    = document.getElementById('feed-status');
    const searchEl    = document.getElementById('feed-search');
    const emptyEl     = document.getElementById('feed-empty');
    const perPageTop  = document.getElementById('per-page-top');
    const perPageBot  = document.getElementById('per-page-bottom');
    const pageInfoBot = document.getElementById('page-info-bottom');
    const pageBtnsBot = document.getElementById('page-buttons-bottom');

    let filteredRows = allRows.slice();
    let currentPage  = 1;
    let perPage      = 25;

    function renderPage() {
        allRows.forEach(r => r.style.display = 'none');

        if (filteredRows.length === 0) {
            emptyEl.style.display = 'block';
            pageInfoBot.textContent = '';
            pageBtnsBot.innerHTML = '';
            return;
        }

        emptyEl.style.display = 'none';

        const totalPages = Math.ceil(filteredRows.length / perPage);
        if (currentPage > totalPages) currentPage = 1;

        const start = (currentPage - 1) * perPage;
        const end   = Math.min(start + perPage, filteredRows.length);

        filteredRows.slice(start, end).forEach(r => r.style.display = '');

        pageInfoBot.textContent = `Showing ${start + 1}–${end} of ${filteredRows.length} articles`;
        buildPageButtons(pageBtnsBot, totalPages);
        syncPerPageSelectors();
    }

    function buildPageButtons(container, totalPages) {
        container.innerHTML = '';

        const btnStyle = (active) =>
            `padding: 5px 10px; font-size: 0.78rem; border: 1px solid var(--border); border-radius: var(--radius); background: ${active ? 'var(--ink)' : 'var(--warm-white)'}; color: ${active ? '#fff' : 'var(--ink)'}; cursor: pointer;`;

        const prev = document.createElement('button');
        prev.textContent = '←';
        prev.style.cssText = btnStyle(false);
        prev.disabled = currentPage === 1;
        prev.onclick = () => { currentPage--; renderPage(); window.scrollTo(0, 0); };
        container.appendChild(prev);

        for (let p = 1; p <= totalPages; p++) {
            if (totalPages > 7 && p > 2 && p < totalPages - 1 && Math.abs(p - currentPage) > 1) {
                if (p === 3 || p === totalPages - 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.textContent = '…';
                    ellipsis.style.cssText = 'padding: 5px 6px; font-size: 0.78rem; color: var(--mid-gray);';
                    container.appendChild(ellipsis);
                }
                continue;
            }
            const btn = document.createElement('button');
            btn.textContent = p;
            btn.style.cssText = btnStyle(p === currentPage);
            btn.onclick = ((page) => () => { currentPage = page; renderPage(); window.scrollTo(0, 0); })(p);
            container.appendChild(btn);
        }

        const next = document.createElement('button');
        next.textContent = '→';
        next.style.cssText = btnStyle(false);
        next.disabled = currentPage === totalPages;
        next.onclick = () => { currentPage++; renderPage(); window.scrollTo(0, 0); };
        container.appendChild(next);
    }

    function syncPerPageSelectors() {
        perPageTop.value = perPage;
        perPageBot.value = perPage;
    }

    function applyFilter() {
        const q = searchEl.value.trim().toLowerCase();
        filteredRows = q
            ? allRows.filter(r =>
                r.dataset.title.includes(q) || r.dataset.source.includes(q))
            : allRows.slice();
        currentPage = 1;
        statusEl.textContent = q
            ? `${filteredRows.length} result${filteredRows.length !== 1 ? 's' : ''} for "${searchEl.value.trim()}"`
            : `${allRows.length} article${allRows.length !== 1 ? 's' : ''} loaded`;
        renderPage();
    }

    searchEl.addEventListener('input', applyFilter);
    perPageTop.addEventListener('change', function () { perPage = parseInt(this.value); currentPage = 1; renderPage(); });
    perPageBot.addEventListener('change', function () { perPage = parseInt(this.value); currentPage = 1; renderPage(); });

    renderPage();
}());
</script>

<?php get_footer(); ?>