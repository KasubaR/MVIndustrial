import { initListboxes } from './listbox.js';
import { initNav, initScrollSpy } from './nav.js';
import { initProducts } from './products.js';

initNav();
initScrollSpy();

// Products runs first so it can restore search, category and page from the
// URL; the listboxes are then built from selects that already hold the
// restored values.
initProducts();
initListboxes();
