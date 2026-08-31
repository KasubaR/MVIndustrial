import { createModal } from './modal.js';
import { buildEnquiryUrl, debounce } from './utils.js';

const PAGE_SIZE = 15;
const SEARCH_DEBOUNCE = 180;
/* Page buttons rendered either side of the current page before an ellipsis. */
const PAGE_WINDOW = 1;

export function initProducts() {
  const grid = document.getElementById('product-grid');
  const pagination = document.getElementById('product-pagination');
  const paginationPages = document.getElementById('pagination-pages');
  const paginationPrev = document.getElementById('pagination-prev');
  const paginationNext = document.getElementById('pagination-next');

  // The grid and its pager are the parts this module cannot work without;
  // everything below is optional and guarded individually.
  if (!grid || !pagination || !paginationPages || !paginationPrev || !paginationNext) {
    return;
  }

  const searchInput = document.getElementById('product-search');
  const categorySelect = document.getElementById('product-category');
  const emptyState = document.getElementById('product-empty');

  const tiles = Array.from(grid.querySelectorAll('.product-tile-cell')).map((cell) => ({
    cell,
    category: cell.dataset.category,
    haystack: `${cell.dataset.name} ${(cell.dataset.categoryTitle || '').toLowerCase()}`,
  }));

  const state = { query: '', category: 'all', page: 1 };

  /* URL state, so a filtered view can be shared and the back button works. */

  function readUrl() {
    const params = new URLSearchParams(window.location.search);
    state.query = params.get('q') || '';
    state.category = params.get('category') || 'all';
    state.page = Math.max(1, Number.parseInt(params.get('page'), 10) || 1);

    if (searchInput) {
      searchInput.value = state.query;
    }
    if (categorySelect) {
      const known = Array.from(categorySelect.options).some((option) => option.value === state.category);
      state.category = known ? state.category : 'all';
      categorySelect.value = state.category;
      categorySelect.dispatchEvent(new Event('listbox:sync'));
    }
  }

  function writeUrl(push) {
    const params = new URLSearchParams();
    if (state.query) {
      params.set('q', state.query);
    }
    if (state.category !== 'all') {
      params.set('category', state.category);
    }
    if (state.page > 1) {
      params.set('page', String(state.page));
    }

    const query = params.toString();
    const url = `${window.location.pathname}${query ? `?${query}` : ''}${window.location.hash}`;
    window.history[push ? 'pushState' : 'replaceState']({}, '', url);
  }

  /* Filtering and rendering */

  function matchingTiles() {
    const query = state.query.trim().toLowerCase();
    return tiles.filter(
      (tile) =>
        (state.category === 'all' || tile.category === state.category) &&
        (query === '' || tile.haystack.includes(query))
    );
  }

  /** First page, last page and a window around the current one. */
  function pageList(totalPages) {
    const pages = new Set([1, totalPages]);
    for (let page = state.page - PAGE_WINDOW; page <= state.page + PAGE_WINDOW; page += 1) {
      if (page >= 1 && page <= totalPages) {
        pages.add(page);
      }
    }

    const sorted = Array.from(pages).sort((a, b) => a - b);
    const withGaps = [];
    sorted.forEach((page, index) => {
      if (index > 0 && page - sorted[index - 1] > 1) {
        withGaps.push('gap');
      }
      withGaps.push(page);
    });
    return withGaps;
  }

  function renderPagination(totalPages) {
    if (totalPages <= 1) {
      pagination.hidden = true;
      paginationPages.replaceChildren();
      return;
    }

    pagination.hidden = false;
    paginationPrev.disabled = state.page === 1;
    paginationNext.disabled = state.page === totalPages;

    paginationPages.replaceChildren(
      ...pageList(totalPages).map((entry) => {
        if (entry === 'gap') {
          const gap = document.createElement('span');
          gap.className = 'pagination-gap';
          gap.textContent = '\u2026';
          gap.setAttribute('aria-hidden', 'true');
          return gap;
        }

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'pagination-btn surface';
        button.dataset.page = String(entry);
        button.textContent = String(entry);
        if (entry === state.page) {
          button.classList.add('is-active');
          button.setAttribute('aria-current', 'page');
        }
        return button;
      })
    );
  }

  function render() {
    const matches = matchingTiles();
    const totalPages = Math.max(1, Math.ceil(matches.length / PAGE_SIZE));
    state.page = Math.min(state.page, totalPages);

    const start = (state.page - 1) * PAGE_SIZE;
    const pageSet = new Set(matches.slice(start, start + PAGE_SIZE).map((tile) => tile.cell));

    tiles.forEach((tile) => {
      tile.cell.hidden = !pageSet.has(tile.cell);
    });

    if (emptyState) {
      emptyState.hidden = matches.length !== 0;
    }

    const focusWasInPages = paginationPages.contains(document.activeElement);
    renderPagination(totalPages);

    // Page buttons are rebuilt on every render, so a keyboard user who just
    // activated one would otherwise lose focus to the document.
    if (focusWasInPages || document.activeElement?.disabled) {
      paginationPages.querySelector('.is-active')?.focus();
    }
  }

  function goToPage(page, push = true) {
    state.page = page;
    writeUrl(push);
    render();
  }

  /* Controls */

  if (searchInput) {
    searchInput.addEventListener(
      'input',
      debounce(() => {
        state.query = searchInput.value;
        state.page = 1;
        writeUrl(false);
        render();
      }, SEARCH_DEBOUNCE)
    );
  }

  if (categorySelect) {
    categorySelect.addEventListener('change', () => {
      state.category = categorySelect.value;
      state.page = 1;
      writeUrl(true);
      render();
    });
  }

  paginationPages.addEventListener('click', (event) => {
    const button = event.target.closest('[data-page]');
    if (button) {
      goToPage(Number(button.dataset.page));
    }
  });

  paginationPrev.addEventListener('click', () => {
    if (state.page > 1) {
      goToPage(state.page - 1);
    }
  });

  paginationNext.addEventListener('click', () => {
    goToPage(state.page + 1);
  });

  window.addEventListener('popstate', () => {
    readUrl();
    render();
  });

  /* Multi-select: check any number of tiles, then send them all as one
     enquiry. Selection is independent of the current search, filter and page,
     so a checked tile stays selected once it scrolls out of view. */

  const selectionBar = document.getElementById('product-selection-bar');
  const selectionCount = document.getElementById('product-selection-count');
  const selectionClear = document.getElementById('product-selection-clear');
  const selectionEnquire = document.getElementById('product-selection-enquire');
  let selected = [];

  function setTileChecked(box, checked) {
    const label = box.closest('.product-tile-checkbox');
    if (!label) {
      return;
    }
    box.checked = checked;
    label.classList.toggle('is-checked', checked);
    const icon = label.querySelector('.product-tile-checkbox-icon');
    if (icon) {
      icon.textContent = checked ? 'check' : 'add';
    }
  }

  function updateSelectionBar() {
    if (!selectionBar || !selectionCount) {
      return;
    }
    const count = selected.length;
    selectionCount.textContent = count === 1 ? '1 product selected' : `${count} products selected`;
    selectionBar.classList.toggle('is-visible', count > 0);
    document.body.classList.toggle('has-selection-bar', count > 0);

    if (selectionEnquire) {
      selectionEnquire.href = buildEnquiryUrl(selectionEnquire, { items: selected.join('|') });
    }
  }

  grid.addEventListener('change', (event) => {
    const box = event.target.closest('.product-tile-select');
    if (!box) {
      return;
    }
    const title = box.closest('.product-tile-cell').dataset.title;

    setTileChecked(box, box.checked);
    selected = box.checked
      ? selected.concat(selected.includes(title) ? [] : [title])
      : selected.filter((item) => item !== title);

    updateSelectionBar();
  });

  if (selectionClear) {
    selectionClear.addEventListener('click', () => {
      selected = [];
      grid.querySelectorAll('.product-tile-select:checked').forEach((box) => setTileChecked(box, false));
      updateSelectionBar();
    });
  }

  /* Lightbox: since there are no product photos yet, this gives a larger,
     uncluttered look at one product — icon, name, category and context. */

  const modalRoot = document.getElementById('product-modal');
  const modal = modalRoot ? createModal(modalRoot) : null;

  if (modal) {
    const modalIcon = document.getElementById('product-modal-icon-glyph');
    const modalTag = document.getElementById('product-modal-tag');
    const modalTitle = document.getElementById('product-modal-title');
    const modalSummary = document.getElementById('product-modal-summary');
    const modalEnquire = document.getElementById('product-modal-enquire');

    grid.addEventListener('click', (event) => {
      const tile = event.target.closest('.product-tile');
      if (!tile) {
        return;
      }

      const { icon, categoryTitle, title, categorySummary } = tile.closest('.product-tile-cell').dataset;
      modalIcon.textContent = icon;
      modalTag.textContent = categoryTitle;
      modalTitle.textContent = title;
      modalSummary.textContent = categorySummary;
      if (modalEnquire) {
        modalEnquire.href = buildEnquiryUrl(modalEnquire, { subject: title });
      }

      modal.open(tile);
    });
  }

  readUrl();
  render();
  updateSelectionBar();
}
