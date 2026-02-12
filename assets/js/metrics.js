import { getCurrentLang, onLanguageChange } from './i18n.js';

let metricObserver;

function shouldSkipMetricAnimation() {
  const reduceMotion = window.matchMedia?.('(prefers-reduced-motion: reduce)').matches ?? false;
  const saveData = navigator.connection?.saveData ?? false;
  return reduceMotion || saveData;
}

function getMetricLocale() {
  switch (getCurrentLang()) {
    case 'en':
      return 'en-US';
    case 'ar':
      return 'ar';
    case 'bg':
      return 'bg-BG';
    default:
      return 'tr-TR';
  }
}

function cancelMetricAnimation(el) {
  if (!el?.dataset) return;
  const frameId = Number(el.dataset.animationFrame);
  if (frameId) {
    cancelAnimationFrame(frameId);
    el.dataset.animationFrame = '';
  }
}

function prepareMetricTargets(metricElements, forceReset = false) {
  if (!metricElements.length) return;
  const zeroFormatter = forceReset ? new Intl.NumberFormat(getMetricLocale()) : null;

  metricElements.forEach((el) => {
    const baseText = forceReset && el.dataset.targetText ? el.dataset.targetText : el.textContent || '';
    const targetText = baseText.trim();
    if (!targetText) return;

    el.dataset.targetText = targetText;
    const match = targetText.match(/[\d]+(?:[.,]\d+)?/);
    if (!match) {
      el.dataset.targetNumber = '';
      if (forceReset) {
        el.dataset.animated = 'true';
        el.textContent = targetText;
      }
      return;
    }

    const prefix = targetText.slice(0, match.index);
    const suffix = targetText.slice(match.index + match[0].length);
    el.dataset.prefix = prefix;
    el.dataset.suffix = suffix;

    const normalized = match[0].replace(/[^\d]/g, '');
    const targetNumber = parseInt(normalized, 10);
    el.dataset.targetNumber = Number.isFinite(targetNumber) ? String(targetNumber) : '';

    if (forceReset) {
      el.dataset.animated = 'false';
      cancelMetricAnimation(el);
      const zeroText = zeroFormatter ? zeroFormatter.format(0) : '0';
      el.textContent = `${prefix}${zeroText}${suffix}`;
    }
  });
}

function animateMetricValue(el) {
  if (!el || el.dataset.animated === 'true') return;

  const targetNumber = Number(el.dataset.targetNumber || '');
  if (!Number.isFinite(targetNumber) || targetNumber <= 0) {
    el.textContent = el.dataset.targetText || el.textContent;
    el.dataset.animated = 'true';
    metricObserver?.unobserve(el);
    return;
  }

  const prefix = el.dataset.prefix || '';
  const suffix = el.dataset.suffix || '';
  const formatter = new Intl.NumberFormat(getMetricLocale());
  const duration = 1200;
  const start = performance.now();
  let animationFrameId = null;

  const frame = (now) => {
    const progress = Math.min((now - start) / duration, 1);
    const eased = 1 - Math.pow(1 - progress, 3);
    const value = Math.round(targetNumber * eased);
    el.textContent = `${prefix}${formatter.format(value)}${suffix}`;

    if (progress < 1) {
      animationFrameId = requestAnimationFrame(frame);
      el.dataset.animationFrame = String(animationFrameId);
    } else {
      el.textContent = el.dataset.targetText || `${prefix}${formatter.format(targetNumber)}${suffix}`;
      el.dataset.animated = 'true';
      el.dataset.animationFrame = '';
      metricObserver?.unobserve(el);
    }
  };

  animationFrameId = requestAnimationFrame(frame);
  el.dataset.animationFrame = String(animationFrameId);
}

function initMetricCounters() {
  const metricElements = Array.from(document.querySelectorAll('.metric-value'));
  if (!metricElements.length) return;

  metricElements.forEach(cancelMetricAnimation);
  prepareMetricTargets(metricElements, false);

  if (shouldSkipMetricAnimation()) {
    if (metricObserver) {
      metricObserver.disconnect();
    }
    metricElements.forEach((el) => {
      el.textContent = el.dataset.targetText || el.textContent;
      el.dataset.animated = 'true';
    });
    return;
  }

  if (!('IntersectionObserver' in window)) {
    metricElements.forEach((el) => {
      el.textContent = el.dataset.targetText || el.textContent;
      el.dataset.animated = 'true';
    });
    return;
  }

  prepareMetricTargets(metricElements, true);

  if (metricObserver) {
    metricObserver.disconnect();
  }

  metricObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        animateMetricValue(entry.target);
      }
    });
  }, { threshold: 0.4 });

  metricElements.forEach((el) => metricObserver.observe(el));
}

export function initMetrics() {
  initMetricCounters();
  onLanguageChange(() => initMetricCounters());
}
