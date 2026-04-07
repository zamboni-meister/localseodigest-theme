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

        <div id="feed-rows"></div>

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

<script>
(function () {
    const FEED_URL      = 'https://doytr55.app.n8n.cloud/webhook/feed-data';
    const rowsEl        = document.getElementById('feed-rows');
    const statusEl      = document.getElementById('feed-status');
    const searchEl      = document.getElementById('feed-search');
    const emptyEl       = document.getElementById('feed-empty');
    const perPageTop    = document.getElementById('per-page-top');
    const perPageBot    = document.getElementById('per-page-bottom');
    const pageInfoBot   = document.getElementById('page-info-bottom');
    const pageBtnsBot   = document.getElementById('page-buttons-bottom');

    let allItems      = [];
    let filteredItems = [];
    let currentPage   = 1;
    let perPage       = 25;

    const SOURCE_STYLES = {
        'google search central': 'background:#4285F4; color:#fff; border-color:#FFF5D7;',
        'semrush':               'background:#E0C7FF; color:#181E15; border-color:#FFF5D7;',
        'nathan gotch':          'background:#2952CC; color:#fff; border-color:#FFF5D7;',
    };

    function getBadgeStyle(source) {
        const key = source.toLowerCase();
        return SOURCE_STYLES[key] || 'background:var(--yellow-tint); color:var(--yellow-dark); border-color:rgba(255,240,31,0.35);';
    }

    function formatDate(dateStr) {
        const d = new Date(dateStr);
        if (isNaN(d)) return dateStr;
        const date = d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        const time = d.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
        return `${date} ${time}`;
    }

    function buildRow(item, index) {
        const isEven = index % 2 === 0;
        const bg = isEven ? 'var(--warm-white)' : '#fff';
        const badgeStyle = getBadgeStyle(item.source);
        return `
            <div class="feed-row"
                 style="display: grid; grid-template-columns: auto 1fr 160px; align-items: center; padding: 14px 20px; background: ${bg}; border-top: 1px solid var(--border); transition: background 0.15s ease;"
                 onmouseover="this.style.background='var(--yellow-tint)'" onmouseout="this.style.background='${bg}'">
                <span style="font-size: 0.78rem; font-weight: 700; ${badgeStyle} border: 1px solid; border-radius: 20px; padding: 3px 10px; display: inline-block; white-space: nowrap;">
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

    function renderPage() {
        if (filteredItems.length === 0) {
            rowsEl.innerHTML = '';
            emptyEl.style.display = 'block';
            pageInfoBot.textContent = '';
            pageBtnsBot.innerHTML = '';
            return;
        }

        emptyEl.style.display = 'none';

        const totalPages = Math.ceil(filteredItems.length / perPage);
        if (currentPage > totalPages) currentPage = 1;

        const start     = (currentPage - 1) * perPage;
        const end       = Math.min(start + perPage, filteredItems.length);
        const pageItems = filteredItems.slice(start, end);

        rowsEl.innerHTML = pageItems.map((item, i) => buildRow(item, i)).join('');

        pageInfoBot.textContent = `Showing ${start + 1}–${end} of ${filteredItems.length} articles`;

        buildPageButtons(pageBtnsBot, totalPages);
        syncPerPageSelectors();
    }

    function applyFilter() {
        const q = searchEl.value.trim().toLowerCase();
        filteredItems = q
            ? allItems.filter(item => item.title.toLowerCase().includes(q) || item.source.toLowerCase().includes(q))
            : allItems.slice();
        currentPage = 1;
        statusEl.textContent = q
            ? `${filteredItems.length} result${filteredItems.length !== 1 ? 's' : ''} for "${searchEl.value.trim()}"`
            : `${allItems.length} article${allItems.length !== 1 ? 's' : ''} loaded`;
        renderPage();
    }

    fetch(FEED_URL)
        .then(res => {
            if (!res.ok) throw new Error('Feed fetch failed: ' + res.status);
            return res.json();
        })
        .then(data => {
            allItems = Array.isArray(data) ? data : data.items || [];
            allItems.sort((a, b) => new Date(b.date) - new Date(a.date));

            if (allItems.length === 0) {
                statusEl.textContent = 'No articles found.';
                renderPage();
                return;
            }

            statusEl.textContent = `${allItems.length} article${allItems.length !== 1 ? 's' : ''} loaded`;
            filteredItems = allItems.slice();
            renderPage();
        })
        .catch(err => {
            statusEl.textContent = 'Could not load feed.';
            rowsEl.innerHTML = `<div style="padding: 32px; text-align: center; color: var(--mid-gray); font-size: 0.875rem;">Unable to fetch feed. Try again later.</div>`;
            console.error(err);
        });

    searchEl.addEventListener('input', applyFilter);

    perPageTop.addEventListener('change', function () {
        perPage = parseInt(this.value);
        currentPage = 1;
        renderPage();
    });

    perPageBot.addEventListener('change', function () {
        perPage = parseInt(this.value);
        currentPage = 1;
        renderPage();
    });
}());
</script>

<?php get_footer(); ?>