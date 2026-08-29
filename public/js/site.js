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
    document.body.classList.toggle("nav-open", open);
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

  // Shared custom-select behaviour (trigger button + listbox) used by both
  // the products page category filter and the contact form's "What do you
  // need?" field, so the two look and behave identically.
  function initListboxSelect(wrap, trigger, list, onSelect) {
    var options = list.querySelectorAll("li");
    var focusedIndex = -1;

    function setFocusedOption(index) {
      options.forEach(function (option, i) {
        option.classList.toggle("is-focused", i === index);
      });
      focusedIndex = index;
      if (index >= 0) {
        options[index].scrollIntoView({ block: "nearest" });
      }
    }

    function isOpen() {
      return !list.hidden;
    }

    function open() {
      list.hidden = false;
      trigger.setAttribute("aria-expanded", "true");
      var selectedIndex = Array.prototype.findIndex.call(options, function (option) {
        return option.classList.contains("is-selected");
      });
      setFocusedOption(selectedIndex === -1 ? 0 : selectedIndex);
    }

    function close(focusTrigger) {
      list.hidden = true;
      trigger.setAttribute("aria-expanded", "false");
      setFocusedOption(-1);
      if (focusTrigger) {
        trigger.focus();
      }
    }

    function select(option) {
      options.forEach(function (o) {
        var selected = o === option;
        o.classList.toggle("is-selected", selected);
        o.setAttribute("aria-selected", String(selected));
      });
      onSelect(option);
    }

    trigger.addEventListener("click", function () {
      if (isOpen()) {
        close(false);
      } else {
        open();
      }
    });

    list.addEventListener("click", function (event) {
      var option = event.target.closest("li");
      if (!option) {
        return;
      }
      select(option);
      close(true);
    });

    // Keyboard interaction on the trigger only opens the list and hands focus
    // to it (tabindex="-1") — otherwise the list's own keydown handler below
    // never fires, since focus never actually left the trigger.
    trigger.addEventListener("keydown", function (event) {
      if (event.key === "ArrowDown" || event.key === "Enter" || event.key === " ") {
        event.preventDefault();
        if (!isOpen()) {
          open();
        }
        list.focus();
      }
    });

    list.addEventListener("keydown", function (event) {
      if (event.key === "ArrowDown") {
        event.preventDefault();
        setFocusedOption(Math.min(focusedIndex + 1, options.length - 1));
      } else if (event.key === "ArrowUp") {
        event.preventDefault();
        setFocusedOption(Math.max(focusedIndex - 1, 0));
      } else if (event.key === "Enter" || event.key === " ") {
        event.preventDefault();
        if (focusedIndex >= 0) {
          select(options[focusedIndex]);
        }
        close(true);
      } else if (event.key === "Escape") {
        event.preventDefault();
        close(true);
      }
    });

    // Covers Tab-away and any other focus loss, mobile included.
    wrap.addEventListener("focusout", function () {
      window.requestAnimationFrame(function () {
        if (!wrap.contains(document.activeElement)) {
          close(false);
        }
      });
    });

    document.addEventListener("click", function (event) {
      if (isOpen() && !wrap.contains(event.target)) {
        close(false);
      }
    });

    return { open: open, close: close, isOpen: isOpen };
  }

  // Contact form: "What do you need?" uses the same custom dropdown as the
  // products page category filter, backed by a hidden input for submission.
  var topicSelect = document.getElementById("topic-select");
  if (topicSelect) {
    var topicTrigger = document.getElementById("topic-trigger");
    var topicList = document.getElementById("topic-list");
    var topicLabel = document.getElementById("topic-select-label");
    var topicInput = document.getElementById("topic");

    initListboxSelect(topicSelect, topicTrigger, topicList, function (option) {
      topicLabel.textContent = option.dataset.label;
      topicInput.value = option.dataset.value;
    });
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
    var tiles = Array.prototype.slice.call(productGrid.querySelectorAll(".product-tile-cell"));
    var emptyState = document.getElementById("product-empty");
    var pagination = document.getElementById("product-pagination");
    var paginationPages = document.getElementById("pagination-pages");
    var paginationPrev = document.getElementById("pagination-prev");
    var paginationNext = document.getElementById("pagination-next");

    var activeFilter = "all";
    var currentPage = 1;

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

    initListboxSelect(filterWrap, filterTrigger, filterList, function (option) {
      activeFilter = option.dataset.filter;
      filterLabel.textContent = option.dataset.label;
      applyProductFilters();
    });

    searchInput.addEventListener("input", applyProductFilters);

    renderProducts();

    // Multi-select: check any number of tiles, then send them all as one
    // enquiry. Selection is independent of the current search/filter/page,
    // so a checked tile stays selected even once it's scrolled out of view.
    var selectionBar = document.getElementById("product-selection-bar");
    var selectionCount = document.getElementById("product-selection-count");
    var selectionClear = document.getElementById("product-selection-clear");
    var selectionEnquire = document.getElementById("product-selection-enquire");
    var selectedProducts = [];

    function updateSelectionBar() {
      var count = selectedProducts.length;
      selectionCount.textContent = count === 1 ? "1 product selected" : count + " products selected";
      selectionBar.classList.toggle("is-visible", count > 0);
      document.body.classList.toggle("has-selection-bar", count > 0);

      if (selectionEnquire) {
        var params = new URLSearchParams({
          topic: selectionEnquire.dataset.topic,
          items: selectedProducts.join("|")
        });
        selectionEnquire.href = selectionEnquire.dataset.contactUrl + "?" + params.toString() + "#enquiry";
      }
    }

    productGrid.addEventListener("change", function (event) {
      var checkbox = event.target.closest(".product-tile-select");
      if (!checkbox) {
        return;
      }
      var cell = checkbox.closest(".product-tile-cell");
      var label = checkbox.closest(".product-tile-checkbox");
      var icon = label ? label.querySelector(".product-tile-checkbox-icon") : null;
      var title = cell.dataset.title;

      if (checkbox.checked) {
        if (selectedProducts.indexOf(title) === -1) {
          selectedProducts.push(title);
        }
        if (label) {
          label.classList.add("is-checked");
        }
        if (icon) {
          icon.textContent = "check";
        }
      } else {
        selectedProducts = selectedProducts.filter(function (selected) {
          return selected !== title;
        });
        if (label) {
          label.classList.remove("is-checked");
        }
        if (icon) {
          icon.textContent = "add";
        }
      }

      updateSelectionBar();
    });

    if (selectionClear) {
      selectionClear.addEventListener("click", function () {
        selectedProducts = [];
        Array.prototype.forEach.call(productGrid.querySelectorAll(".product-tile-select:checked"), function (checkbox) {
          checkbox.checked = false;
        });
        Array.prototype.forEach.call(productGrid.querySelectorAll(".product-tile-checkbox.is-checked"), function (label) {
          label.classList.remove("is-checked");
          var icon = label.querySelector(".product-tile-checkbox-icon");
          if (icon) {
            icon.textContent = "add";
          }
        });
        updateSelectionBar();
      });
    }

    // Lightbox: since there are no product photos yet, this gives a larger,
    // uncluttered look at one product — icon, name, category and context.
    var modal = document.getElementById("product-modal");
    var modalDialog = modal.querySelector(".product-modal-dialog");
    var modalIconGlyph = document.getElementById("product-modal-icon-glyph");
    var modalTag = document.getElementById("product-modal-tag");
    var modalTitle = document.getElementById("product-modal-title");
    var modalSummary = document.getElementById("product-modal-summary");
    var modalCloseBtn = document.getElementById("product-modal-close");
    var modalEnquireLink = document.getElementById("product-modal-enquire");
    var modalTrigger = null;

    function openModal(triggerButton) {
      var cell = triggerButton.closest(".product-tile-cell");
      modalTrigger = triggerButton;
      modalIconGlyph.textContent = cell.dataset.icon;
      modalTag.textContent = cell.dataset.categoryTitle;
      modalTitle.textContent = cell.dataset.title;
      modalSummary.textContent = cell.dataset.categorySummary;
      if (modalEnquireLink) {
        var params = new URLSearchParams({
          topic: modalEnquireLink.dataset.topic,
          subject: cell.dataset.title
        });
        modalEnquireLink.href = modalEnquireLink.dataset.contactUrl + "?" + params.toString() + "#enquiry";
      }
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
