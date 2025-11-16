document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.getElementById('billingToggle');
  const priceEls = document.querySelectorAll('.price span');
  const tierSelect = document.getElementById('tierSelect');
  const qtyInput = document.getElementById('qty');
  const rushInput = document.getElementById('rush');
  const revsInput = document.getElementById('revs');
  const estimateAmount = document.getElementById('estimateAmount');
  const mailtoLink = document.getElementById('mailtoLink');
  const copyBtn = document.getElementById('copyBtn');

  // helper: is i18n ready?
  function hasI18n() {
    return window.i18n && typeof window.i18n.t === 'function';
  }

  // Make updateEstimate global so i18n can call it
  window.updateEstimate = updateEstimate;

  function formatPrice(n) {
    if (hasI18n()) {
      return window.i18n.formatPrice(n);
    }
    // fallback: plain EUR
    return '€' + Number(n).toFixed(0);
  }

  // Toggle display between base price and hourly
  toggle.addEventListener('change', () => {
    priceEls.forEach(el=>{
      const basePrice = toggle.checked ? 
        Number(el.dataset.priceHourly) : 
        Number(el.dataset.priceMonthly);
      const convertedPrice = window.i18n.convertPrice(basePrice);
      el.textContent = formatPrice(convertedPrice);
    });
    updateEstimate();
  });

    function t(key, fallback) {
    if (hasI18n()) return window.i18n.t(key);
    return fallback || key;
  }

  function getBaseForTier(tier) {
    const el = [...priceEls].find(e => {
      const card = e.closest('.card');
      const h2 = card.querySelector('h2');
      const h2Text = h2.textContent.trim();
      return h2Text === tier ||
             (tier === 'Basic'   && h2Text === t('basic', 'Basic')) ||
             (tier === 'Standard'&& h2Text === t('standard', 'Standard')) ||
             (tier === 'Premium' && h2Text === t('premium', 'Premium'));
    });
    if (!el) return 0;

    const basePrice = toggle.checked
      ? Number(el.dataset.priceHourly)
      : Number(el.dataset.priceMonthly);

    if (hasI18n()) {
      return window.i18n.convertPrice(basePrice);
    }
    return basePrice; // fallback
  }

  function updateEstimate() {
    const tier = tierSelect.value;
    const qty = Math.max(1, Number(qtyInput.value) || 1);
    const base = getBaseForTier(tier);

    let subtotal = base * Math.min(qty, 1) + (base * 0.6 * (qty - 1));
    if (qty > 3) {
      subtotal = base * 0.9 * qty;
    }

    const extraRevBase = 50; // EUR
    const extraRevCost = hasI18n()
      ? window.i18n.convertPrice(extraRevBase)
      : extraRevBase;

    subtotal += Number(revsInput.value || 0) * extraRevCost;

    if (rushInput.checked) subtotal *= 1.3;

    subtotal = Math.round(subtotal);
    estimateAmount.textContent = formatPrice(subtotal);

    const tierName = hasI18n()
      ? window.i18n.t(tier.toLowerCase())
      : tier;

    const currencySymbol = hasI18n() && window.i18n.currentCurrency === 'TRY'
      ? '₺'
      : '€';

    const emailInterested = hasI18n()
      ? window.i18n.t('emailInterestedIn')
      : 'I am interested in';

    const emailEstimatedTotal = hasI18n()
      ? window.i18n.t('emailEstimatedTotal')
      : 'Estimated total';

    const emailSubject = hasI18n()
      ? window.i18n.t('emailSubjectRequest')
      : 'Project request';

    const emailBody =
      `${emailInterested} ${tierName} – ${emailEstimatedTotal} ` +
      `${currencySymbol}${subtotal.toLocaleString()}`;

    mailtoLink.href =
      `mailto:software@idearc.com.tr?subject=${encodeURIComponent(emailSubject)}` +
      `&body=${encodeURIComponent(emailBody)}`;
  }

  // initial run
  updateEstimate();

  // events
  [tierSelect, qtyInput, rushInput, revsInput].forEach(el => el.addEventListener('input', updateEstimate));

  // CTA buttons open mailto with tier prefilled
  document.querySelectorAll('.cta').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const tier = btn.dataset.tier || 'Standard';
      const tierName = window.i18n.t(tier.toLowerCase());
      const subject = encodeURIComponent(`${window.i18n.t('emailSubjectRequest')} limViz ${tierName}`);
      const body = encodeURIComponent(`${window.i18n.t('emailHi')}${tierName} ${window.i18n.t('emailPackage')}`);
      window.location.href = `mailto:software@idearc.com.tr?subject=${subject}&body=${body}`;
    });
  });

  copyBtn.addEventListener('click', (e)=>{
    e.preventDefault();
    const text = `${window.i18n.t('estimatedPrice')} ${estimateAmount.textContent}\n${window.i18n.t('contact')}: software@idearc.com.tr`;
    navigator.clipboard?.writeText(text).then(()=> {
      const originalText = copyBtn.textContent;
      copyBtn.textContent = window.i18n.t('copied');
      setTimeout(()=> copyBtn.textContent = originalText, 1800);
    }).catch(()=>{
      alert(text);
    });
  });

  // Update select options when language changes
  function updateSelectOptions() {
    const options = tierSelect.querySelectorAll('option');
    options.forEach(opt => {
      const key = opt.value.toLowerCase();
      opt.textContent = window.i18n.t(key);
    });
  }

// When language changes, refresh option labels + estimate
  window.addEventListener('limviz-lang-change', () => {
    updateSelectOptions();
    updateEstimate();
  });

  // If you care about currency change for the estimate (optional, since setCurrency already calls updateEstimate)
  window.addEventListener('limviz-currency-change', () => {
    updateEstimate();
  });
  updateSelectOptions();
});