function prefersReducedMotion() {
  return window.matchMedia?.('(prefers-reduced-motion: reduce)').matches ?? false;
}

function prefersSaveData() {
  return navigator.connection?.saveData ?? false;
}

function applyMediaPreferences() {
  const reduceMotion = prefersReducedMotion();
  const saveData = prefersSaveData();

  if (!reduceMotion && !saveData) return;

  const root = document.documentElement;
  root?.classList.toggle('reduce-motion', reduceMotion);
  root?.classList.toggle('save-data', saveData);

  const heroVideo = document.querySelector('[data-hero-video]');
  if (!heroVideo) return;

  heroVideo.pause();
  heroVideo.removeAttribute('autoplay');
  heroVideo.removeAttribute('loop');
  heroVideo.setAttribute('preload', 'none');
  heroVideo.querySelectorAll('source').forEach((source) => {
    source.removeAttribute('src');
  });
  heroVideo.load();
}

function smoothScrollTo(targetId) {
  if (!targetId) return;
  const behavior = prefersReducedMotion() ? 'auto' : 'smooth';

  if (targetId === '#anasayfa') {
    window.scrollTo({ top: 0, behavior });
    return;
  }

  const el = document.querySelector(targetId);
  if (el) {
    el.scrollIntoView({ behavior, block: 'start' });
  }
}

export function initNavigation() {
  applyMediaPreferences();
  const nav = document.getElementById('primaryNav');
  const toggleBtn = document.querySelector('[data-nav-toggle]');
  const homeUrl = document.body?.dataset.home || 'index.html';

  function toggleNav() {
    if (!nav) return;
    const isOpen = nav.classList.toggle('open');
    toggleBtn?.setAttribute('aria-expanded', String(isOpen));
    document.body?.classList.toggle('nav-open', isOpen);
  }

  function closeNav() {
    if (!nav) return;
    nav.classList.remove('open');
    toggleBtn?.setAttribute('aria-expanded', 'false');
    document.body?.classList.remove('nav-open');
  }

  toggleBtn?.addEventListener('click', () => toggleNav());

  document.addEventListener('click', (event) => {
    if (!nav || !nav.classList.contains('open')) return;
    if (event.target === toggleBtn || nav.contains(event.target)) return;
    closeNav();
  });

  document.querySelectorAll('[data-scroll]').forEach((link) => {
    link.addEventListener('click', (event) => {
      const href = link.getAttribute('href') || link.getAttribute('data-scroll-target');
      if (!href || !href.startsWith('#')) return;
      const isHome = document.body?.dataset.page === 'home';
      if (!isHome) {
        event.preventDefault();
        closeNav();
        window.location.href = `${homeUrl}${href}`;
        return;
      }
      event.preventDefault();
      smoothScrollTo(href);
      closeNav();
      document.querySelectorAll('nav a').forEach((navLink) => navLink.classList.remove('active'));
      if (link.closest('nav')) {
        link.classList.add('active');
      }
    });
  });
}
