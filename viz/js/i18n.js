// i18n.js - Language support system
const translations = {
  en: {
    // Header
    contact: "Contact",
    portfolio: "Portfolio",
    pricing: "Pricing",

    // About page
    about: "About",
    aboutTitle: "About limViz",
    aboutSubtitle: "We create high-end visual experiences that bridge engineering, architecture, and software.",

    aboutMissionTitle: "Our Mission",
    aboutMissionText: "To transform complex engineering and architectural ideas into clear, immersive, and interactive visual experiences through cutting-edge technology.",

    aboutWhatWeDoTitle: "What We Do",
    aboutWhat1: "High-end 3D visualization for infrastructure & architecture",
    aboutWhat2: "Real-time experiences using Unreal Engine & Cesium",
    aboutWhat3: "VR/AR-ready environments & cinematic walkthroughs",
    aboutWhat4: "Custom software, plugins, and digital twins",
    aboutWhat5: "BIM for Infrastructure (IFC 4.3 workflows)",

    aboutWhyTitle: "Why Choose Us",
    aboutWhy1: "Engineering-grade accuracy and high realism",
    aboutWhy2: "Optimized pipelines for large-scale scenes",
    aboutWhy3: "Cross-disciplinary expertise in design, engineering, and software",
    aboutWhy4: "RTX 6000 Ada powered cloud infrastructure",
    aboutWhy5: "Fast delivery and scalable production capacity",

    aboutVisionTitle: "Our Vision",
    aboutVisionText: "To become a global hub where infrastructure, design, and technology merge to create intuitive and immersive digital experiences.",

    // Contact page
    contactTitle: "Contact limViz",
    contactSubtitle: "For quotes, availability, or general enquiries — drop us a message and we'll get back within 1–2 business days.",
    quickContact: "Quick contact",
    email: "Email",
    businessHours: "Business hours",
    businessHoursTime: "Mon–Fri, 09:00–18:00 (GMT+3)",
    other: "Other",
    portfolioLink: "Link to portfolio, repo or socials",
    sendMessage: "Send us a message",
    yourName: "Your name",
    yourEmail: "Your email",
    subject: "Subject",
    subjectPlaceholder: "Project: exterior renders",
    message: "Message",
    messagePlaceholder: "Brief project description, files available, deadline...",
    sendEmail: "Send email",
    copyMessage: "Copy message",
    orEmail: "Or email:",
    privacyTitle: "Privacy & attachments",
    privacyText: "This form opens your mail client and does not upload attachments to this site. If you need to send large files, please share a link (Dropbox/Drive) in your message.",
    fillRequired: "Please fill name, email and message.",
    openingEmail: "Opening your email client…",
    copiedClipboard: "Message copied to clipboard — paste into an email.",

    // Pricing page
    pricingTitle: "3D Visualization Services Pricing",
    pricingSubtitle: "Clear, flexible pricing for architectural renders, product visuals, and animations. Choose a tier or request a custom quote.",
    showHourly: "Show hourly estimates",

    // Tiers
    basic: "Basic",
    standard: "Standard",
    premium: "Premium",

    // Basic tier
    basicFeature1: "1 high-quality still render",
    basicFeature2: "1 revision",
    basicFeature3: "Standard lighting & materials",
    basicDesc: "Good for concept visuals and single-shot renders.",
    requestBasic: "Request Basic",

    // Standard tier
    standardFeature1: "Up to 3 still renders",
    standardFeature2: "2 revisions per image",
    standardFeature3: "Enhanced materials and lighting",
    standardDesc: "Ideal for marketing assets and client presentations.",
    requestStandard: "Request Standard",

    // Premium tier
    premiumFeature1: "Up to 8 still renders or short animation",
    premiumFeature2: "Unlimited revisions within scope",
    premiumFeature3: "Advanced post-production & compositing",
    premiumDesc: "For campaigns, product launches, and showreels.",
    requestPremium: "Request Premium",

    // Add-ons
    addOnsTitle: "Add-ons & Custom Options",
    rushDelivery: "Rush delivery (48-72h): +30%",
    extraRevisions: "Extra revisions: €50 / revision",
    interactive360: "360° interactive viewer: from €400",
    aerialScene: "Drone / aerial scene photomatching: +€150",
    perRevision: "revision",

    // Calculator
    estimateTitle: "Estimate your project",
    tier: "Tier:",
    quantity: "Number of images / minutes of animation:",
    rushDeliveryLabel: "Rush delivery:",
    extraRevisionsLabel: "Extra revisions:",
    estimatedPrice: "Estimated price:",
    contactSales: "Contact Sales",
    copyEstimate: "Copy estimate",
    copied: "Copied",

    // FAQ
    faqTitle: "FAQ",
    faqQ1: "How long does a project take?",
    faqA1: "Typical delivery ranges from 3–14 working days depending on scope and revisions. Rush options available.",
    faqQ2: "What do we need to start?",
    faqA2: "Reference images, CAD/3D files, dimensions, and a short brief are enough to get started.",

    // Footer
    footerCopyright: "© IDEArcSoftware — limViz 3D Visualization Services",

    // Email templates
    emailSubjectInquiry: "limViz inquiry",
    emailSubjectRequest: "Request: limViz",
    emailBodyName: "Name:",
    emailBodyEmail: "Email:",
    emailBodyAttachment: "Please attach links to files or references if available.",
    emailInterestedIn: "I'm interested in the",
    emailQuantity: "Quantity:",
    emailRush: "Rush:",
    emailYes: "Yes",
    emailNo: "No",
    emailExtraRevisions: "Extra revisions:",
    emailEstimatedTotal: "Estimated total:",
    emailHi: "Hi,\n\nI'd like a quote for the",
    emailPackage: "package.\nPlease advise next steps and lead time.\n\nThanks.",
  },

  tr: {
    // Header
    contact: "İletişim",
    portfolio: "Portföy",
    pricing: "Fiyatlandırma",

    // About page
    about: "Hakkımızda",
    aboutTitle: "limViz Hakkında",
    aboutSubtitle: "Mühendislik, mimarlık ve yazılımı birleştiren üst düzey görsel deneyimler üretiyoruz.",

    aboutMissionTitle: "Misyonumuz",
    aboutMissionText: "Mühendislik ve mimarlık projelerini ileri teknoloji ile net, etkileyici ve etkileşimli görsel deneyimlere dönüştürmek.",

    aboutWhatWeDoTitle: "Ne Yapıyoruz",
    aboutWhat1: "Altyapı ve mimarlık için yüksek kaliteli 3D görselleştirme",
    aboutWhat2: "Unreal Engine & Cesium ile gerçek zamanlı deneyimler",
    aboutWhat3: "VR/AR uyumlu ortamlar ve sinematik yürüyüşler",
    aboutWhat4: "Özel yazılımlar, eklentiler ve dijital ikizler",
    aboutWhat5: "Altyapıda BIM (IFC 4.3 iş akışları)",

    aboutWhyTitle: "Neden Biz?",
    aboutWhy1: "Mühendislik hassasiyetinde gerçekçilik",
    aboutWhy2: "Büyük ölçekli sahneler için optimize edilmiş pipeline",
    aboutWhy3: "Tasarım, mühendislik ve yazılım arasında güçlü uzmanlık",
    aboutWhy4: "RTX 6000 Ada destekli bulut altyapısı",
    aboutWhy5: "Hızlı teslimat ve ölçeklenebilir üretim",

    aboutVisionTitle: "Vizyonumuz",
    aboutVisionText: "Altyapı, tasarım ve teknolojinin birleştiği küresel bir dijital deneyim merkezi olmak.",

    // Contact page
    contactTitle: "limViz İletişim",
    contactSubtitle: "Fiyat teklifi, müsaitlik durumu veya genel sorularınız için — bize mesaj bırakın, 1–2 iş günü içinde size dönüş yapacağız.",
    quickContact: "Hızlı iletişim",
    email: "E-posta",
    businessHours: "Çalışma saatleri",
    businessHoursTime: "Pzt–Cum, 09:00–18:00 (GMT+3)",
    other: "Diğer",
    portfolioLink: "Portföy, repo veya sosyal medya bağlantısı",
    sendMessage: "Bize mesaj gönderin",
    yourName: "Adınız",
    yourEmail: "E-posta adresiniz",
    subject: "Konu",
    subjectPlaceholder: "Proje: dış cephe görselleri",
    message: "Mesaj",
    messagePlaceholder: "Kısa proje açıklaması, mevcut dosyalar, teslim tarihi...",
    sendEmail: "E-posta gönder",
    copyMessage: "Mesajı kopyala",
    orEmail: "Veya e-posta:",
    privacyTitle: "Gizlilik & ekler",
    privacyText: "Bu form e-posta istemcinizi açar ve bu siteye herhangi bir dosya yüklemez. Büyük dosyalar göndermeniz gerekiyorsa, lütfen mesajınızda bir bağlantı (Dropbox/Drive) paylaşın.",
    fillRequired: "Lütfen ad, e-posta ve mesaj alanlarını doldurun.",
    openingEmail: "E-posta istemciniz açılıyor…",
    copiedClipboard: "Mesaj panoya kopyalandı — bir e-postaya yapıştırın.",

    // Pricing page
    pricingTitle: "3D Görselleştirme Hizmetleri Fiyatlandırma",
    pricingSubtitle: "Mimari görseller, ürün görselleri ve animasyonlar için net, esnek fiyatlandırma. Bir paket seçin veya özel fiyat teklifi isteyin.",
    showHourly: "Saatlik tahminleri göster",

    // Tiers
    basic: "Temel",
    standard: "Standart",
    premium: "Premium",

    // Basic tier
    basicFeature1: "1 yüksek kaliteli görsel",
    basicFeature2: "1 revizyon",
    basicFeature3: "Standart aydınlatma ve malzemeler",
    basicDesc: "Konsept görseller ve tek çekim görseller için uygundur.",
    requestBasic: "Temel Paket İste",

    // Standard tier
    standardFeature1: "3 adede kadar görsel",
    standardFeature2: "Görsel başına 2 revizyon",
    standardFeature3: "Gelişmiş malzemeler ve aydınlatma",
    standardDesc: "Pazarlama materyalleri ve müşteri sunumları için idealdir.",
    requestStandard: "Standart Paket İste",

    // Premium tier
    premiumFeature1: "8 adede kadar görsel veya kısa animasyon",
    premiumFeature2: "Kapsam dahilinde sınırsız revizyon",
    premiumFeature3: "İleri düzey son işleme ve kompozisyon",
    premiumDesc: "Kampanyalar, ürün lansmanları ve tanıtım filmleri için.",
    requestPremium: "Premium Paket İste",

    // Add-ons
    addOnsTitle: "Ek Hizmetler & Özel Seçenekler",
    rushDelivery: "Hızlı teslimat (48-72s): +%30",
    extraRevisions: "Ekstra revizyonlar: €50 / revizyon",
    interactive360: "360° interaktif görüntüleyici: €400'den başlayan",
    aerialScene: "Drone / havadan sahne fotoğraf eşleştirme: +€150",

    // Calculator
    estimateTitle: "Projenizi tahmin edin",
    tier: "Paket:",
    quantity: "Görsel sayısı / animasyon dakikası:",
    rushDeliveryLabel: "Hızlı teslimat:",
    extraRevisionsLabel: "Ekstra revizyonlar:",
    estimatedPrice: "Tahmini fiyat:",
    contactSales: "Satış İle İletişime Geç",
    copyEstimate: "Tahmini kopyala",
    copied: "Kopyalandı",

    // FAQ
    faqTitle: "Sık Sorulan Sorular",
    faqQ1: "Bir proje ne kadar sürer?",
    faqA1: "Kapsam ve revizyonlara bağlı olarak tipik teslimat 3–14 iş günü arasında değişir. Hızlı teslimat seçenekleri mevcuttur.",
    faqQ2: "Başlamak için nelere ihtiyacımız var?",
    faqA2: "Referans görselleri, CAD/3D dosyaları, ölçüler ve kısa bir özet başlamak için yeterlidir.",

    // Footer
    footerCopyright: "© IDEArcSoftware — limViz 3D Görselleştirme Hizmetleri",

    // Email templates
    emailSubjectInquiry: "limViz sorgusu",
    emailSubjectRequest: "Talep: limViz",
    emailBodyName: "Ad:",
    emailBodyEmail: "E-posta:",
    emailBodyAttachment: "Lütfen mevcut dosyalar veya referanslar için bağlantıları ekleyin.",
    emailInterestedIn: "İlgilendiğim paket:",
    emailQuantity: "Miktar:",
    emailRush: "Hızlı teslimat:",
    emailYes: "Evet",
    emailNo: "Hayır",
    emailExtraRevisions: "Ekstra revizyonlar:",
    emailEstimatedTotal: "Tahmini toplam:",
    emailHi: "Merhaba,\n\n",
    emailPackage: "paketi için fiyat teklifi almak istiyorum.\nLütfen sonraki adımları ve teslim süresini bildirin.\n\nTeşekkürler.",
  }
};

// Currency conversion rates (EUR to TRY)
const EUR_TO_TRY = 49.0; // Update this rate as needed

class I18n {
  constructor() {
    this.currentLang = this.detectLanguage();
    this.currentCurrency = this.detectCurrency();
    this.init();
  }

  detectLanguage() {
    let saved = null;
    try {
      saved = localStorage.getItem('limviz-lang');
    } catch (e) {
      // localStorage not available, ignore
    }
    if (saved && translations[saved]) return saved;

    const browserLang = navigator.language.toLowerCase();
    if (browserLang.startsWith('tr')) return 'tr';

    return 'en';
  }

  detectCurrency() {
    let saved = null;
    try {
      saved = localStorage.getItem('limviz-currency');
    } catch (e) { }
    if (saved && (saved === 'EUR' || saved === 'TRY')) return saved;

    if (this.currentLang === 'tr') return 'TRY';
    return 'EUR';
  }

  init() {
    this.addLanguageToggle();
    this.addCurrencyToggle();
    this.translate();
    this.updatePrices();
  }

  addLanguageToggle() {
    const nav = document.querySelector('nav');
    if (!nav) return;

    const langToggle = document.createElement('span');
    langToggle.className = 'lang-toggle';
    langToggle.innerHTML = `
      <button class="lang-btn ${this.currentLang === 'en' ? 'active' : ''}" data-lang="en">EN</button>
      <button class="lang-btn ${this.currentLang === 'tr' ? 'active' : ''}" data-lang="tr">TR</button>
    `;

    nav.appendChild(langToggle);

    langToggle.addEventListener('click', (e) => {
      if (e.target.classList.contains('lang-btn')) {
        this.setLanguage(e.target.dataset.lang);
      }
    });
  }

  addCurrencyToggle() {
    const nav = document.querySelector('nav');
    if (!nav) return;

    const currToggle = document.createElement('span');
    currToggle.className = 'currency-toggle';
    currToggle.innerHTML = `
      <button class="currency-btn ${this.currentCurrency === 'EUR' ? 'active' : ''}" data-currency="EUR">EUR (€)</button>
      <button class="currency-btn ${this.currentCurrency === 'TRY' ? 'active' : ''}" data-currency="TRY">TRY (₺)</button>
    `;

    nav.appendChild(currToggle);

    currToggle.addEventListener('click', (e) => {
      if (e.target.classList.contains('currency-btn')) {
        this.setCurrency(e.target.dataset.currency);
      }
    });
  }

  setCurrency(currency) {
    if (currency !== 'EUR' && currency !== 'TRY') return;

    this.currentCurrency = currency;
    try {
      localStorage.setItem('limviz-currency', currency);
    } catch (e) { }

    document.querySelectorAll('.currency-btn').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.currency === currency);
    });

    this.updatePrices();

    if (typeof updateEstimate === 'function') {
      updateEstimate();
    }

    // (optional) notify listeners
    window.dispatchEvent(new CustomEvent('limviz-currency-change', { detail: { currency } }));
  }


  convertPrice(eurPrice) {
    if (this.currentCurrency === 'TRY') {
      return Math.round(eurPrice * EUR_TO_TRY);
    }
    return eurPrice;
  }

  formatPrice(price) {
    if (this.currentCurrency === 'TRY') {
      return '₺' + Number(price).toLocaleString('tr-TR', { maximumFractionDigits: 0 });
    }
    return '€' + Number(price).toLocaleString('en-US', { maximumFractionDigits: 0 });
  }

  updatePrices() {
    // Update all price elements
    document.querySelectorAll('[data-price-eur]').forEach(el => {
      const eurPrice = parseFloat(el.dataset.priceEur);
      const convertedPrice = this.convertPrice(eurPrice);
      el.textContent = this.formatPrice(convertedPrice);
    });
  }

  setLanguage(lang) {
    if (!translations[lang]) return;

    this.currentLang = lang;
    try {
      localStorage.setItem('limviz-lang', lang);
    } catch (e) { }

    document.querySelectorAll('.lang-btn').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.lang === lang);
    });

    this.translate();

    // (optional) notify pricing.js
    window.dispatchEvent(new CustomEvent('limviz-lang-change', { detail: { lang } }));
  }


  t(key) {
    return translations[this.currentLang][key] || translations.en[key] || key;
  }

  translate() {
    // Translate all elements with data-i18n attribute
    document.querySelectorAll('[data-i18n]').forEach(el => {
      const key = el.dataset.i18n;
      el.textContent = this.t(key);
    });

    // Translate placeholders
    document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
      const key = el.dataset.i18nPlaceholder;
      el.placeholder = this.t(key);
    });

    // Update page title if needed
    const titleKey = document.body.dataset.i18nTitle;
    if (titleKey) {
      document.title = this.t(titleKey);
    }
  }
}

// CSS styles for language and currency toggles (add to your pricing.css)
const langStyles = `
.lang-toggle, .currency-toggle {
  display: inline-flex;
  gap: 4px;
  margin-left: 18px;
  background: rgba(255,255,255,0.03);
  padding: 4px;
  border-radius: 6px;
}

.lang-btn, .currency-btn {
  background: transparent;
  border: none;
  color: var(--muted);
  padding: 6px 12px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.85rem;
  font-weight: 600;
  transition: all 0.2s;
}

.lang-btn:hover, .currency-btn:hover {
  color: #e6eef6;
}

.lang-btn.active, .currency-btn.active {
  background: var(--accent);
  color: white;
}

@media (max-width:900px){
  nav {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }
  
  .lang-toggle, .currency-toggle {
    margin-left: 0;
    margin-top: 8px;
  }
}
`;

if (typeof window !== 'undefined') {
  window.addEventListener('DOMContentLoaded', () => {
    try {
      window.i18n = new I18n();
    } catch (e) {
      console.error('Failed to initialize i18n, falling back to defaults:', e);
      window.i18n = {
        currentLang: 'en',
        currentCurrency: 'EUR',
        t: key => (translations.en && translations.en[key]) || key,
        convertPrice: p => p,
        formatPrice: p => '€' + Number(p).toLocaleString('en-US', { maximumFractionDigits: 0 }),
        updatePrices: () => { }
      };
    }

    const styleEl = document.createElement('style');
    styleEl.textContent = langStyles;
    document.head.appendChild(styleEl);
  });
}
