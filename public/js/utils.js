export function debounce(fn, wait) {
  let timer = null;
  return function debounced(...args) {
    window.clearTimeout(timer);
    timer = window.setTimeout(() => fn.apply(this, args), wait);
  };
}

const FOCUSABLE = [
  'a[href]',
  'button:not([disabled])',
  'input:not([disabled])',
  'select:not([disabled])',
  'textarea:not([disabled])',
  '[tabindex]:not([tabindex="-1"])',
].join(',');

/** Focusable descendants, skipping anything hidden from layout. */
export function focusableWithin(root) {
  return Array.from(root.querySelectorAll(FOCUSABLE)).filter(
    (el) => el.offsetWidth > 0 || el.offsetHeight > 0 || el === document.activeElement
  );
}

/**
 * Builds a contact-page enquiry link from data attributes on the link itself,
 * so the route and default topic stay in Blade rather than being hardcoded.
 */
export function buildEnquiryUrl(link, params) {
  const query = new URLSearchParams({ topic: link.dataset.topic, ...params });
  return `${link.dataset.contactUrl}?${query.toString()}#enquiry`;
}
