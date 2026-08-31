import { debounce } from './utils.js';

/* Mirrors the 900px breakpoint in resources/css/responsive.css. */
const NAV_BREAKPOINT = 900;
const SOLID_AFTER = 24;

export function initNav() {
  const header = document.querySelector('.site-header');
  const nav = document.getElementById('primary-nav');
  const toggle = document.getElementById('nav-toggle');
  const toggleIcon = document.getElementById('nav-toggle-icon');

  if (!header || !nav || !toggle || !toggleIcon) {
    return;
  }

  let isSolid = null;

  // The open mobile panel has a white background, so the bar must be solid too.
  function syncHeader() {
    const solid = window.scrollY > SOLID_AFTER || nav.classList.contains('is-open');
    if (solid === isSolid) {
      return;
    }
    isSolid = solid;
    header.classList.toggle('is-solid', solid);
  }

  function setMenu(open) {
    nav.classList.toggle('is-open', open);
    document.body.classList.toggle('nav-open', open);
    toggle.setAttribute('aria-expanded', String(open));
    toggleIcon.textContent = open ? 'close' : 'menu';
    syncHeader();
  }

  window.addEventListener('scroll', syncHeader, { passive: true });
  syncHeader();

  toggle.addEventListener('click', () => {
    setMenu(!nav.classList.contains('is-open'));
  });

  nav.addEventListener('click', (event) => {
    if (event.target.closest('a')) {
      setMenu(false);
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && nav.classList.contains('is-open')) {
      setMenu(false);
      toggle.focus();
    }
  });

  // Reset the mobile menu when the layout returns to desktop widths. Debounced
  // because mobile browsers fire resize as their URL bar collapses on scroll.
  window.addEventListener(
    'resize',
    debounce(() => {
      if (window.innerWidth > NAV_BREAKPOINT && nav.classList.contains('is-open')) {
        setMenu(false);
      }
    }, 150)
  );
}

/**
 * Highlights the nav link for the section currently in view. Only the one-page
 * home layout opts in, via data-scrollspy on <body>; other pages mark the
 * active link server-side.
 */
export function initScrollSpy() {
  if (!('scrollspy' in document.body.dataset) || !('IntersectionObserver' in window)) {
    return;
  }

  const sections = document.querySelectorAll('main section[id]');
  const navLinks = document.querySelectorAll('.nav-link');

  if (!sections.length || !navLinks.length) {
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return;
        }
        navLinks.forEach((link) => {
          const href = link.getAttribute('href') || '';
          const hashAt = href.indexOf('#');
          link.classList.toggle('is-active', hashAt !== -1 && href.slice(hashAt) === `#${entry.target.id}`);
        });
      });
    },
    { rootMargin: '-45% 0px -50% 0px' }
  );

  sections.forEach((section) => observer.observe(section));
}
