const TYPEAHEAD_RESET = 600;

/**
 * Replaces a native <select> with the custom listbox the design calls for.
 *
 * The select stays in the DOM as the single source of truth and still carries
 * the form value, so the field submits normally when this never runs. Every
 * selection writes back to the select and dispatches `change`, letting callers
 * listen to the element rather than this widget.
 */
export function enhanceSelect(select) {
  if (!select || select.dataset.enhanced === 'true') {
    return;
  }
  select.dataset.enhanced = 'true';

  const variant = select.dataset.listbox === 'field' ? 'listbox-field' : 'listbox-pill';
  const baseId = select.id || `listbox-${Math.random().toString(36).slice(2, 8)}`;
  const options = Array.from(select.options);

  const wrap = document.createElement('div');
  wrap.className = `listbox ${variant}`;

  const trigger = document.createElement('button');
  trigger.type = 'button';
  trigger.className = 'listbox-trigger';
  trigger.id = `${baseId}-trigger`;
  trigger.setAttribute('aria-haspopup', 'listbox');
  trigger.setAttribute('aria-expanded', 'false');
  trigger.setAttribute('aria-controls', `${baseId}-list`);

  if (select.dataset.listboxIcon) {
    const icon = document.createElement('span');
    icon.className = 'material-symbols-outlined';
    icon.setAttribute('aria-hidden', 'true');
    icon.textContent = select.dataset.listboxIcon;
    trigger.appendChild(icon);
  }

  const value = document.createElement('span');
  value.className = 'listbox-value';
  value.id = `${baseId}-value`;
  value.textContent = select.selectedOptions[0] ? select.selectedOptions[0].text : '';
  trigger.appendChild(value);

  const chevron = document.createElement('span');
  chevron.className = 'material-symbols-outlined listbox-chevron';
  chevron.setAttribute('aria-hidden', 'true');
  chevron.textContent = 'expand_more';
  trigger.appendChild(chevron);

  // Carry the select's labelling and validation state onto the widget that
  // now receives focus in its place.
  const label = document.querySelector(`label[for="${select.id}"]`);
  if (label) {
    if (!label.id) {
      label.id = `${baseId}-label`;
    }
    trigger.setAttribute('aria-labelledby', `${label.id} ${value.id}`);
  } else if (select.getAttribute('aria-label')) {
    trigger.setAttribute('aria-label', select.getAttribute('aria-label'));
  }
  if (select.getAttribute('aria-invalid')) {
    trigger.setAttribute('aria-invalid', select.getAttribute('aria-invalid'));
  }
  if (select.getAttribute('aria-describedby')) {
    trigger.setAttribute('aria-describedby', select.getAttribute('aria-describedby'));
  }

  const list = document.createElement('ul');
  list.className = 'listbox-list surface';
  list.id = `${baseId}-list`;
  list.setAttribute('role', 'listbox');
  list.tabIndex = -1;
  list.hidden = true;

  const items = options.map((option, index) => {
    const item = document.createElement('li');
    item.className = 'listbox-option';
    item.id = `${baseId}-option-${index}`;
    item.setAttribute('role', 'option');
    item.setAttribute('aria-selected', String(option.selected));
    item.classList.toggle('is-selected', option.selected);
    item.textContent = option.text;
    list.appendChild(item);
    return item;
  });

  wrap.append(trigger, list);
  select.after(wrap);
  select.hidden = true;

  let focusedIndex = -1;
  let typeahead = '';
  let typeaheadTimer = null;

  function setFocusedOption(index) {
    focusedIndex = index;
    items.forEach((item, i) => item.classList.toggle('is-focused', i === index));
    if (index >= 0) {
      list.setAttribute('aria-activedescendant', items[index].id);
      items[index].scrollIntoView({ block: 'nearest' });
    } else {
      list.removeAttribute('aria-activedescendant');
    }
  }

  function isOpen() {
    return !list.hidden;
  }

  function onOutsideClick(event) {
    if (!wrap.contains(event.target)) {
      close(false);
    }
  }

  function open() {
    if (isOpen()) {
      return;
    }
    list.hidden = false;
    trigger.setAttribute('aria-expanded', 'true');
    setFocusedOption(select.selectedIndex === -1 ? 0 : select.selectedIndex);
    document.addEventListener('click', onOutsideClick);
  }

  function close(focusTrigger) {
    if (!isOpen()) {
      return;
    }
    list.hidden = true;
    trigger.setAttribute('aria-expanded', 'false');
    setFocusedOption(-1);
    document.removeEventListener('click', onOutsideClick);
    if (focusTrigger) {
      trigger.focus();
    }
  }

  /* Mirrors whatever the select currently holds onto the widget, so code that
     changes the value programmatically only has to dispatch `listbox:sync`. */
  function syncFromSelect() {
    items.forEach((item, i) => {
      const selected = i === select.selectedIndex;
      item.classList.toggle('is-selected', selected);
      item.setAttribute('aria-selected', String(selected));
    });
    value.textContent = select.selectedOptions[0] ? select.selectedOptions[0].text : '';
  }

  function selectIndex(index) {
    if (index < 0 || index >= items.length || index === select.selectedIndex) {
      return;
    }
    select.selectedIndex = index;
    syncFromSelect();
    select.dispatchEvent(new Event('change', { bubbles: true }));
  }

  select.addEventListener('listbox:sync', syncFromSelect);

  function jumpToTypeahead(key) {
    window.clearTimeout(typeaheadTimer);
    typeahead += key.toLowerCase();
    typeaheadTimer = window.setTimeout(() => {
      typeahead = '';
    }, TYPEAHEAD_RESET);

    const match = options.findIndex((option) => option.text.toLowerCase().startsWith(typeahead));
    if (match !== -1) {
      setFocusedOption(match);
    }
  }

  trigger.addEventListener('click', () => {
    if (isOpen()) {
      close(false);
    } else {
      open();
      list.focus();
    }
  });

  // Keyboard interaction on the trigger opens the list and hands focus to it
  // (tabindex="-1") — otherwise the list's own keydown handler never fires,
  // since focus would never actually leave the trigger.
  trigger.addEventListener('keydown', (event) => {
    if (event.key === 'ArrowDown' || event.key === 'ArrowUp' || event.key === 'Enter' || event.key === ' ') {
      event.preventDefault();
      open();
      list.focus();
    }
  });

  list.addEventListener('click', (event) => {
    const item = event.target.closest('.listbox-option');
    if (!item) {
      return;
    }
    selectIndex(items.indexOf(item));
    close(true);
  });

  list.addEventListener('keydown', (event) => {
    switch (event.key) {
      case 'ArrowDown':
        event.preventDefault();
        setFocusedOption(Math.min(focusedIndex + 1, items.length - 1));
        break;
      case 'ArrowUp':
        event.preventDefault();
        setFocusedOption(Math.max(focusedIndex - 1, 0));
        break;
      case 'Home':
        event.preventDefault();
        setFocusedOption(0);
        break;
      case 'End':
        event.preventDefault();
        setFocusedOption(items.length - 1);
        break;
      case 'Enter':
      case ' ':
        event.preventDefault();
        selectIndex(focusedIndex);
        close(true);
        break;
      case 'Escape':
        event.preventDefault();
        close(true);
        break;
      case 'Tab':
        close(false);
        break;
      default:
        if (event.key.length === 1) {
          jumpToTypeahead(event.key);
        }
    }
  });

  // Covers focus loss that no other handler sees, mobile included.
  wrap.addEventListener('focusout', () => {
    window.requestAnimationFrame(() => {
      if (!wrap.contains(document.activeElement)) {
        close(false);
      }
    });
  });
}

export function initListboxes() {
  document.querySelectorAll('select[data-listbox]').forEach(enhanceSelect);
}
