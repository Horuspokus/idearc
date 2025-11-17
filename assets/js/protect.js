function decodeValue(value) {
  if (!value) return '';
  try {
    return atob(value);
  } catch {
    return value;
  }
}

export function initProtectedContacts() {
  document.querySelectorAll('[data-protect="phone"]').forEach((el) => {
    const text = decodeValue(el.dataset.display);
    const link = decodeValue(el.dataset.link);
    if (text) el.textContent = text;
    if (link && el.tagName === 'A') {
      el.setAttribute('href', `tel:${link}`);
    }
  });

  document.querySelectorAll('[data-protect="email"]').forEach((el) => {
    const text = decodeValue(el.dataset.display);
    const link = decodeValue(el.dataset.link) || text;
    if (text) el.textContent = text;
    if (link && el.tagName === 'A') {
      el.setAttribute('href', `mailto:${link}`);
    }
  });
}
