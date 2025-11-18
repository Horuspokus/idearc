import { initI18n } from './i18n.js';
import { initNavigation } from './navigation.js';
import { initForms } from './forms.js';
import { initProtectedContacts } from './protect.js';
import { initMetrics } from './metrics.js';
import { initWordCloud } from './word-cloud.js';

function initApp() {
  initI18n();
  initNavigation();
  initForms();
  initProtectedContacts();
  initMetrics();
  initWordCloud();
}

document.addEventListener('DOMContentLoaded', initApp);
