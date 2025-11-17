import { SUPPORT_EMAIL } from './config.js';
import { t, onLanguageChange } from './i18n.js';

function setStatusKey(key, isError = false) {
  const statusEl = document.getElementById('formStatus');
  if (!statusEl) return;
  if (!key) {
    statusEl.textContent = '';
    return;
  }
  statusEl.textContent = t(key, key);
  statusEl.style.color = isError ? '#ff6b6b' : 'var(--muted)';
}

function getFieldValue(form, name) {
  return form?.querySelector(`[name=\"${name}\"]`)?.value?.trim() || '';
}

export function initForms() {
  const form = document.getElementById('contactForm');
  const copyBtn = document.querySelector('[data-copy]');

  if (!form && !copyBtn) return;

  const clearStatus = () => setStatusKey('', false);
  onLanguageChange(clearStatus);

  form?.addEventListener('submit', (event) => {
    event.preventDefault();
    const name = getFieldValue(form, 'name');
    const email = getFieldValue(form, 'email');
    const subject = getFieldValue(form, 'subject');
    const message = getFieldValue(form, 'message');

    if (!name || !email || !message) {
      setStatusKey('statusRequired', true);
      return;
    }

    const humanCheck = document.getElementById('humanCheck');
    if (humanCheck && !humanCheck.checked) {
      setStatusKey('statusHumanValidation', true);
      return;
    }

    const subjectLine = subject || t('heroHeading');
    const body = [
      `${t('mailLabelName')}: ${name}`,
      `${t('mailLabelEmail')}: ${email}`,
      `${t('mailLabelSubject')}: ${subjectLine}`,
      '',
      `${t('mailLabelMessage')}:`,
      message,
    ].join('\\n');

    const mailto = `mailto:${encodeURIComponent(SUPPORT_EMAIL)}?subject=${encodeURIComponent(subjectLine)}&body=${encodeURIComponent(body)}`;
    window.location.href = mailto;
    setStatusKey('statusOpeningMail', false);
  });

  copyBtn?.addEventListener('click', () => {
    if (!form) return;
    const name = getFieldValue(form, 'name') || '-';
    const email = getFieldValue(form, 'email') || '-';
    const subject = getFieldValue(form, 'subject') || '-';
    const message = getFieldValue(form, 'message');

    if (!message) {
      setStatusKey('statusCopyEmpty', true);
      return;
    }

    const text = [
      `${t('mailLabelName')}: ${name}`,
      `${t('mailLabelEmail')}: ${email}`,
      `${t('mailLabelSubject')}: ${subject}`,
      '',
      message,
    ].join('\\n');

    if (navigator.clipboard?.writeText) {
      navigator.clipboard
        .writeText(text)
        .then(() => setStatusKey('statusCopySuccess', false))
        .catch(() => setStatusKey('statusCopyError', true));
    } else {
      setStatusKey('statusCopyUnsupported', true);
    }
  });
}
