(function () {
  "use strict";

  var toggle = document.getElementById("nav-toggle");
  var toggleIcon = document.getElementById("nav-toggle-icon");
  var nav = document.getElementById("primary-nav");
  var navLinks = document.querySelectorAll(".nav-link");
  var sections = document.querySelectorAll("main section[id]");
  var header = document.querySelector(".site-header");
  var yearSlot = document.getElementById("year");

  // The open mobile panel has a white background, so the bar must be solid too.
  function syncHeader() {
    var solid = window.scrollY > 24 || nav.classList.contains("is-open");
    header.classList.toggle("is-solid", solid);
  }

  function setMenu(open) {
    nav.classList.toggle("is-open", open);
    toggle.setAttribute("aria-expanded", String(open));
    toggleIcon.textContent = open ? "close" : "menu";
    syncHeader();
  }

  window.addEventListener("scroll", syncHeader, { passive: true });
  syncHeader();

  toggle.addEventListener("click", function () {
    setMenu(!nav.classList.contains("is-open"));
  });

  nav.addEventListener("click", function (event) {
    if (event.target.closest("a")) {
      setMenu(false);
    }
  });

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape" && nav.classList.contains("is-open")) {
      setMenu(false);
      toggle.focus();
    }
  });

  // Reset the mobile menu state when the layout returns to desktop widths.
  window.addEventListener("resize", function () {
    if (window.innerWidth > 900) {
      setMenu(false);
    }
  });

  // Scroll spy only applies to the one-page home layout; other pages mark the
  // active link server-side.
  var isHome = window.location.pathname === "/";

  if (isHome && sections.length && "IntersectionObserver" in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) {
          return;
        }
        navLinks.forEach(function (link) {
          var href = link.getAttribute("href") || "";
          var hash = href.slice(href.indexOf("#"));
          link.classList.toggle(
            "is-active",
            href.indexOf("#") !== -1 && hash === "#" + entry.target.id
          );
        });
      });
    }, { rootMargin: "-45% 0px -50% 0px" });

    sections.forEach(function (section) {
      observer.observe(section);
    });
  }

  if (yearSlot) {
    yearSlot.textContent = String(new Date().getFullYear());
  }

  // Products page: client-side search + a custom (non-native) category
  // dropdown, paginated tile grid (max 5 per row, set in CSS) and a lightbox
  // for viewing one product at a time.
  var productGrid = document.getElementById("product-grid");
  if (productGrid) {
    var PAGE_SIZE = 15;

    var searchInput = document.getElementById("product-search");
    var filterWrap = document.getElementById("product-filter");
    var filterTrigger = document.getElementById("product-filter-trigger");
    var filterLabel = document.getElementById("product-filter-label");
    var filterList = document.getElementById("product-filter-list");
    var filterOptions = filterList.querySelectorAll("li");
    var tiles = Array.prototype.slice.call(productGrid.querySelectorAll(".product-tile"));
    var emptyState = document.getElementById("product-empty");
    var pagination = document.getElementById("product-pagination");
    var paginationPages = document.getElementById("pagination-pages");
    var paginationPrev = document.getElementById("pagination-prev");
    var paginationNext = document.getElementById("pagination-next");

    var activeFilter = "all";
    var currentPage = 1;
    var focusedIndex = -1;

    function matchingTiles() {
      var query = (searchInput.value || "").trim().toLowerCase();
      return tiles.filter(function (tile) {
        var matchesCategory = activeFilter === "all" || tile.dataset.category === activeFilter;
        var matchesSearch = query === "" || tile.dataset.name.indexOf(query) !== -1;
        return matchesCategory && matchesSearch;
      });
    }

    function renderPagination(totalPages) {
      paginationPages.innerHTML = "";

      if (totalPages <= 1) {
        pagination.hidden = true;
        return;
      }

      pagination.hidden = false;
      paginationPrev.disabled = currentPage === 1;
      paginationNext.disabled = currentPage === totalPages;

      for (var page = 1; page <= totalPages; page += 1) {
        var button = document.createElement("button");
        button.type = "button";
        button.className = "pagination-btn";
        button.textContent = String(page);
        if (page === currentPage) {
          button.classList.add("is-active");
          button.setAttribute("aria-current", "page");
        }
        button.addEventListener("click", (function (targetPage) {
          return function () {
            currentPage = targetPage;
            renderProducts();
          };
        }(page)));
        paginationPages.appendChild(button);
      }
    }

    function renderProducts() {
      var matches = matchingTiles();
      var totalPages = Math.max(1, Math.ceil(matches.length / PAGE_SIZE));
      currentPage = Math.min(currentPage, totalPages);

      var start = (currentPage - 1) * PAGE_SIZE;
      var pageSet = matches.slice(start, start + PAGE_SIZE);

      tiles.forEach(function (tile) {
        tile.hidden = pageSet.indexOf(tile) === -1;
      });

      if (emptyState) {
        emptyState.hidden = matches.length !== 0;
      }

      renderPagination(totalPages);
    }

    function applyProductFilters() {
      currentPage = 1;
      renderProducts();
    }

    paginationPrev.addEventListener("click", function () {
      if (currentPage > 1) {
        currentPage -= 1;
        renderProducts();
      }
    });

    paginationNext.addEventListener("click", function () {
      currentPage += 1;
      renderProducts();
    });

    function setFocusedOption(index) {
      filterOptions.forEach(function (option, i) {
        option.classList.toggle("is-focused", i === index);
      });
      focusedIndex = index;
      if (index >= 0) {
        filterOptions[index].scrollIntoView({ block: "nearest" });
      }
    }

    function openFilter() {
      filterList.hidden = false;
      filterTrigger.setAttribute("aria-expanded", "true");
      var selectedIndex = Array.prototype.findIndex.call(filterOptions, function (option) {
        return option.dataset.filter === activeFilter;
      });
      setFocusedOption(selectedIndex === -1 ? 0 : selectedIndex);
    }

    function closeFilter(focusTrigger) {
      filterList.hidden = true;
      filterTrigger.setAttribute("aria-expanded", "false");
      setFocusedOption(-1);
      if (focusTrigger) {
        filterTrigger.focus();
      }
    }

    function isFilterOpen() {
      return !filterList.hidden;
    }

    function selectOption(option) {
      activeFilter = option.dataset.filter;
      filterLabel.textContent = option.dataset.label;
      filterOptions.forEach(function (o) {
        var selected = o === option;
        o.classList.toggle("is-selected", selected);
        o.setAttribute("aria-selected", String(selected));
      });
      applyProductFilters();
    }

    filterTrigger.addEventListener("click", function () {
      if (isFilterOpen()) {
        closeFilter(false);
      } else {
        openFilter();
      }
    });

    filterList.addEventListener("click", function (event) {
      var option = event.target.closest("li");
      if (!option) {
        return;
      }
      selectOption(option);
      closeFilter(true);
    });

    // Keyboard interaction on the trigger only opens the list and hands focus
    // to it (tabindex="-1") — otherwise the list's own keydown handler below
    // never fires, since focus never actually left the trigger.
    filterTrigger.addEventListener("keydown", function (event) {
      if (event.key === "ArrowDown" || event.key === "Enter" || event.key === " ") {
        event.preventDefault();
        if (!isFilterOpen()) {
          openFilter();
        }
        filterList.focus();
      }
    });

    filterList.addEventListener("keydown", function (event) {
      if (event.key === "ArrowDown") {
        event.preventDefault();
        setFocusedOption(Math.min(focusedIndex + 1, filterOptions.length - 1));
      } else if (event.key === "ArrowUp") {
        event.preventDefault();
        setFocusedOption(Math.max(focusedIndex - 1, 0));
      } else if (event.key === "Enter" || event.key === " ") {
        event.preventDefault();
        if (focusedIndex >= 0) {
          selectOption(filterOptions[focusedIndex]);
        }
        closeFilter(true);
      } else if (event.key === "Escape") {
        event.preventDefault();
        closeFilter(true);
      }
    });

    // Covers Tab-away and any other focus loss, mobile included.
    filterWrap.addEventListener("focusout", function () {
      window.requestAnimationFrame(function () {
        if (!filterWrap.contains(document.activeElement)) {
          closeFilter(false);
        }
      });
    });

    document.addEventListener("click", function (event) {
      if (isFilterOpen() && !filterWrap.contains(event.target)) {
        closeFilter(false);
      }
    });

    searchInput.addEventListener("input", applyProductFilters);

    renderProducts();

    // Lightbox: since there are no product photos yet, this gives a larger,
    // uncluttered look at one product — icon, name, category and context.
    var modal = document.getElementById("product-modal");
    var modalDialog = modal.querySelector(".product-modal-dialog");
    var modalIconGlyph = document.getElementById("product-modal-icon-glyph");
    var modalTag = document.getElementById("product-modal-tag");
    var modalTitle = document.getElementById("product-modal-title");
    var modalSummary = document.getElementById("product-modal-summary");
    var modalCloseBtn = document.getElementById("product-modal-close");
    var modalTrigger = null;

    function openModal(tile) {
      modalTrigger = tile;
      modalIconGlyph.textContent = tile.dataset.icon;
      modalTag.textContent = tile.dataset.categoryTitle;
      modalTitle.textContent = tile.dataset.title;
      modalSummary.textContent = tile.dataset.categorySummary;
      modal.hidden = false;
      document.body.classList.add("modal-open");
      modalCloseBtn.focus();
    }

    function closeModal() {
      modal.hidden = true;
      document.body.classList.remove("modal-open");
      if (modalTrigger) {
        modalTrigger.focus();
        modalTrigger = null;
      }
    }

    productGrid.addEventListener("click", function (event) {
      var tile = event.target.closest(".product-tile");
      if (tile) {
        openModal(tile);
      }
    });

    modal.addEventListener("click", function (event) {
      if (event.target.hasAttribute("data-modal-dismiss")) {
        closeModal();
      }
    });

    modalCloseBtn.addEventListener("click", closeModal);

    modal.addEventListener("keydown", function (event) {
      if (modal.hidden) {
        return;
      }
      if (event.key === "Escape") {
        closeModal();
        return;
      }
      if (event.key !== "Tab") {
        return;
      }
      var focusable = modalDialog.querySelectorAll("button, a[href]");
      var first = focusable[0];
      var last = focusable[focusable.length - 1];
      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
      }
    });
  }
})();
