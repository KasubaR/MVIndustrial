import { focusableWithin } from './utils.js';

/**
 * Wires up a dialog built from the .modal markup. Key handling lives on
 * document while the dialog is open, so Escape and the focus trap keep working
 * even if focus ends up outside the dialog.
 */
export function createModal(root) {
  const dialog = root.querySelector('.modal-dialog');
  if (!dialog) {
    return null;
  }

  let opener = null;

  function onKeydown(event) {
    if (event.key === 'Escape') {
      event.preventDefault();
      close();
      return;
    }

    if (event.key !== 'Tab') {
      return;
    }

    const focusable = focusableWithin(dialog);
    if (!focusable.length) {
      return;
    }

    const first = focusable[0];
    const last = focusable[focusable.length - 1];
    const active = document.activeElement;

    if (!dialog.contains(active)) {
      event.preventDefault();
      (event.shiftKey ? last : first).focus();
    } else if (event.shiftKey && active === first) {
      event.preventDefault();
      last.focus();
    } else if (!event.shiftKey && active === last) {
      event.preventDefault();
      first.focus();
    }
  }

  function open(trigger) {
    opener = trigger || null;
    root.hidden = false;
    document.body.classList.add('modal-open');
    document.addEventListener('keydown', onKeydown);

    const focusable = focusableWithin(dialog);
    if (focusable.length) {
      focusable[0].focus();
    }
  }

  function close() {
    if (root.hidden) {
      return;
    }
    root.hidden = true;
    document.body.classList.remove('modal-open');
    document.removeEventListener('keydown', onKeydown);
    if (opener) {
      opener.focus();
      opener = null;
    }
  }

  root.addEventListener('click', (event) => {
    if (event.target.closest('[data-modal-dismiss]')) {
      close();
    }
  });

  return { open, close };
}
