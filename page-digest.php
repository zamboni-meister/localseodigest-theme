<?php
/*
 * Template Name: Digest Page
 */


// Fetch and cache feed data
$items = get_transient('digest_feed');

if ($items === false) {
    $response = wp_remote_get('https://doytr55.app.n8n.cloud/webhook/feed-data', [
        'timeout' => 15,
    ]);

    if (!is_wp_error($response)) {
        $body   = wp_remote_retrieve_body($response);
        $parsed = json_decode($body, true);

        // Handle both flat array and wrapped {"items": [...]}
        if (isset($parsed['items']) && is_array($parsed['items'])) {
            $items = $parsed['items'];
        } elseif (isset($parsed[0]) && is_array($parsed[0])) {
            $items = $parsed;
        } elseif (is_array($parsed)) {
            $items = array_values($parsed);
        } else {
            $items = [];
        }

        if (!empty($items)) {
            usort($items, function($a, $b) {
                return strtotime($b['date'] ?? '') - strtotime($a['date'] ?? '');
            });
            set_transient('digest_feed', $items, HOUR_IN_SECONDS);
        }
    }
}

if (!is_array($items)) {
    $items = [];
}

get_header(); ?>

<div class="resources-header">
    <div class="container">
        <div class="archive-header__label">RSS Feed</div>
        <h1 class="resources-header__title">Digest</h1>
        <p class="resources-header__subtitle">Fresh posts from across the local SEO web — updated automatically.</p>
    </div>
</div>

<div class="container">
    <div style="padding: 56px 0;">

        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <div id="feed-status" style="font-size: 0.82rem; color: var(--mid-gray);">
                <?php echo count($items); ?> article<?php echo count($items) !== 1 ? 's' : ''; ?> loaded
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="display: flex; align-items: center; gap: 6px; font-size: 0.82rem; color: var(--mid-gray);">
                    Show
                    <select id="per-page-top" style="padding: 4px 8px; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.82rem; color: var(--ink); background: var(--warm-white); outline: none;">
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
                    style="padding: 8px 14px; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.85rem; color: var(--ink); background: var(--warm-white); outline: none; width: 220px;"
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
                 style="display: grid; grid-template-columns: auto 1fr 200px; align-items: center; padding: 14px 20px; background: <?php echo $bg; ?>; border-top: 1px solid var(--border); transition: background 0.15s ease;"
                 onmouseover="this.style.background='var(--yellow-tint)'" onmouseout="this.style.background='<?php echo $bg; ?>'">
                <span class="source-badge" data-source="<?php echo strtolower($source); ?>"
                      style="font-size: 0.78rem; font-weight: 700; border-radius: 20px; padding: 3px 10px; display: inline-block; white-space: nowrap;">
                    <?php echo $source; ?>
                </span>
                <a href="<?php echo $link; ?>" target="_blank" rel="noopener"
                   style="font-size: 0.88rem; color: var(--ink); text-decoration: none; font-weight: 500; line-height: 1.4; padding: 0 16px;"
                   onmouseover="this.style.color='var(--yellow-dark)'" onmouseout="this.style.color='var(--ink)'">
                    <?php echo $title; ?>
                </a>
                <span style="font-size: 0.78rem; color: var(--mid-gray); text-align: right; white-space: nowrap;">
                    <?php echo $formatted_date ?: $date; ?>
                </span>
            </div>
            <?php endforeach; ?>
        </div>

        <div id="feed-empty" style="display: none; padding: 48px; text-align: center; color: var(--mid-gray); font-size: 0.9rem;">
            No articles match your search.
        </div>

        <div id="pagination-bottom" style="display: flex; align-items: center; justify-content: space-between; margin-top: 20px; flex-wrap: wrap; gap: 12px;">
            <div id="page-info-bottom" style="font-size: 0.82rem; color: var(--mid-gray);"></div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <div id="page-buttons-bottom" style="display: flex; gap: 6px;"></div>
                <div style="display: flex; align-items: center; gap: 6px; font-size: 0.82rem; color: var(--mid-gray);">
                    Show
                    <select id="per-page-bottom" style="padding: 4px 8px; border: 1px solid var(--border); border-radius: var(--radius); font-size: 0.82rem; color: var(--ink); background: var(--warm-white); outline: none;">
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
.source-badge[data-source="google search central"] { background: #4285F4; color: #fff; border: 1px solid #000; }
.source-badge[data-source="semrush"]               { background: #E0C7FF; color: #181E15; border: 1px solid #000; }
.source-badge[data-source="nathan gotch"]           { background: #2952CC; color: #fff; border: 1px solid #000; }
.source-badge[data-source="search engine journal"]  { background: #5DC82A; color: #fff; border: 1px solid #000; }
.source-badge                                       { background: var(--yellow-tint); color: var(--yellow-dark); border: 1px solid #000; }
</style>

<script>
(function () {
    const allRows     = Array.from(document.querySelectorAll('.feed-row'));
    const rowsEl      = document.getElementById('feed-rows');
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

        filteredRows.slice(start, end).forEach(r => r.style.display = 'grid');

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