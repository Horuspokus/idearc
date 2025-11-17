const SUPPORT_EMAIL = 'info@idearc.com.tr';
const DEFAULT_LANG = 'tr';

const translations = {
  tr: {
    metaTitle: 'IDEArc – Infrastructure Design Engineering & Architecture',
    metaDescription: 'IDEArc, 2015\'ten bu yana altyapı tasarımı, BIM, yol projeleri ve büyük ölçekli danışmanlık hizmetleri sunan mühendislik ve müşavirlik şirketidir.',
    brandName: 'IDEArc',
    menuLabel: 'Menü',
    navHome: 'Anasayfa',
    navMetrics: 'Metrikler',
    navAbout: 'Hakkında',
    navPortfolio: 'Portföy',
    navReferences: 'Referanslar',
    navExpertise: 'Uzmanlıklar',
    navContact: 'İletişim',
    heroTicker: 'IDEArc Uluslararası Mühendislik ve Müşavirlik Limited Şirketi',
    heroHeading: 'Infrastructure Design Engineering & Architecture',
    heroDescription: '2015’ten bu yana mega ulaştırma projeleri, lojistik sahaları ve kentsel dönüşüm programları için BIM tabanlı mühendislik üretiyoruz. İnsanları değil makineleri koştururuz.',
    metricsTitle: 'Projelerin ölçeğini konuşalım',
    metricsLead: 'Mega ulaştırma ve karma kullanım yatırımlarında ölçülebilir çıktılar.',
    metricCompaniesValue: '130+',
    metricCompaniesLabel: 'Kurumsal müşteri',
    metricCompaniesDesc: 'Kamu kurumları ve geliştiricilerle 130’dan fazla iş birliği.',
    metricProjectsValue: '700+',
    metricProjectsLabel: 'Tamamlanan proje',
    metricProjectsDesc: 'Ulaşım, lojistik ve danışmanlıkta 700’den fazla teslim.',
    metricYearsValue: '10+',
    metricYearsLabel: 'Yıllık deneyim',
    metricYearsDesc: 'BIM tabanlı teslimlerle altyapı mühendisliği ve danışmanlık.',
    metricTeamValue: '20+',
    metricTeamLabel: 'Uzman ekip',
    metricTeamDesc: 'IFC 4.3, Civil 3D ve otomasyon uzmanlarından oluşan ağ.',
    heroCTAProjects: 'Projelerimizi keşfedin',
    heroCTAContact: 'Bize ulaşın',
    pillTeamTitle: 'Uzman Ekip',
    pillTeamDesc: 'Civil 3D, InfraWorks ve IFC 4.3 uzmanlarıyla disiplinler arası tasarım.',
    pillBimTitle: 'BIM & Otomasyon',
    pillBimDesc: 'Büyük ölçekli koordinasyon için otomatik keşif, maliyet ve raporlama.',
    pillGlobalTitle: 'Küresel Deneyim',
    pillGlobalDesc: 'Türkiye başta olmak üzere Avrupa ve Orta Doğu’da farklı büyüklükte projeler.',
    aboutTitle: 'IDEArc hakkında',
    aboutLead: 'IDEArc Uluslararası Mühendislik ve Müşavirlik Şirketi 2015 yılında, klasik karayolu mühendisliğinin ötesine geçip BIM ve sivil mühendislik alanlarında uzmanlaşmak amacıyla kuruldu.',
    aboutMissionTitle: 'Misyonumuz',
    aboutMissionDesc: 'Altyapı ve üstyapı projelerini mühendislik hassasiyetinde, dijital ikiz yaklaşımıyla geleceğe taşıyan çözümler geliştirmek.',
    aboutWhatTitle: 'Ne yapıyoruz?',
    aboutWhat1: 'Yol, kavşak, bulvar ve bağlantı yolları geometrik tasarımı',
    aboutWhat2: 'OSB, liman, lojistik ve sanayi alanları için toprak işleri ve altyapı',
    aboutWhat3: 'Kentsel tasarım, meydan, sahil ve kamusal alan projeleri',
    aboutWhat4: 'UTK / UKOME süreçleri için rapor ve plan hazırlığı',
    aboutWhyTitle: 'Neden IDEArc?',
    aboutWhyDesc: 'Çapraz disiplinli ekip, hızlı teslim, optimize edilmiş maliyetler ve maksimum sürdürülebilirlik için veri odaklı süreçleri tek çatı altında topluyoruz.',
    portfolioTitle: 'Öne çıkan projeler',
    portfolioLead: 'Danışmanlık, kentsel tasarım, lojistik, sanayi ve yol projelerinden seçilen çalışmalar.',
    badgeLogistics: 'Lojistik',
    badgeIndustry: 'Sanayi Alanları',
    badgeEarthworks: 'Toprak İşleri',
    badgeConsulting: 'Danışmanlık',
    badgeRoads: 'Yol Projeleri',
    badgeUrban: 'Kentsel Tasarım',
    projectYalovaTitle: 'Yalova Avrasya OSB',
    projectYalovaDesc: '300 hektarlık entegre sanayi bölgesi için yol, altyapı ve lojistik planlama.',
    projectAskoopTitle: 'İstanbul Askoop Sanayi Bölgesi',
    projectAskoopDesc: '100 hektarlık sanayi master planında ulaşım ve galeri altyapısı danışmanlığı.',
    projectElazigTitle: 'Elazığ Kent Meydanı',
    projectElazigDesc: 'Birincilik ödüllü yarışma projesinde şehir içi ulaşım kurgusu ve raporu.',
    projectIbbTitle: 'İstanbul Geneli Cadde & Meydan',
    projectIbbDesc: '40\'tan fazla cadde ve meydanda uygulama projeleri, UTK süreçleri ve danışmanlık.',
    projectKoyTitle: 'Zekeriyaköy KÖY',
    projectKoyDesc: '467 bin m² yerleşimde yol planlaması, ağaç röleveleri ve otopark optimizasyonu.',
    projectDesbTitle: 'Deliklikaya Sanayi Bölgesi',
    projectDesbDesc: '2,6 milyon m²’lik sahada toprak işleri optimizasyonu ve yol uygulama projeleri.',
    projectManisaTitle: 'Manisa E.A. Hastanesi',
    projectManisaDesc: 'Şehir hastanesi erişim planlaması, ulaşım raporu ve otopark senaryoları.',
    projectIgtodTitle: 'Resneli Gıda Toptancıları Sitesi',
    projectIgtodDesc: '400 bin m²’lik lojistik alanında etap etap yol ve toprak işleri tasarımı.',
    ctaPortfolioTr: 'Portföy (TR)',
    ctaPortfolioEn: 'Portfolio (EN)',
    ctaPdfArchive: 'PDF arşivini aç',
    ctaAllProjects: 'Videolar',
    referencesTitle: 'Güvenen kurumlar',
    referencesLead: 'Tüpraş’tan belediyelere, OSB’lerden özel geliştiricilere kadar geniş bir referans listesi.',
    expertiseTitle: 'Uzmanlık alanlarımız',
    expertiseLead: 'Ulaştırma, altyapı ve sivil mühendislik disiplinlerini tek çatı altında topluyoruz.',
    expertiseRoadsTitle: 'Yol Tasarımı & BIM',
    expertiseRoadsDesc: 'Otoyol, bulvar ve bağlantı yollarını BIM süreçleriyle tasarlıyor, revizyonları dijital olarak izliyoruz.',
    expertiseEarthTitle: 'Toprak İşleri',
    expertiseEarthDesc: 'Havalimanı, OSB ve lojistik sahaları için hızlı keşif, maliyet ve optimizasyon raporları.',
    expertiseUtkTitle: 'UTK / UKOME',
    expertiseUtkDesc: 'Geçici sirkülasyon, otopark ve karma kullanım projeleri için karar dosyaları hazırlıyoruz.',
    expertiseCivilTitle: 'Sivil Mühendislik',
    expertiseCivilDesc: 'Vaziyet planı, ulaşım planlaması, yağmur/atıksu ağları ve dere ıslahları için uçtan uca danışmanlık.',
    contactTitle: 'Bize ulaşın',
    contactLead: 'Fikirleriniz bizim için önemli. 1–2 iş günü içinde dönüş sağlıyoruz.',
    contactPhoneLabel: 'Telefon',
    contactPhoneValue: '+90 212 823 1234',
    contactEmailLabel: 'E-posta',
    contactEmailValue: 'info@idearc.com.tr',
    contactAddressLabel: 'Adres',
    contactAddressValue: 'Merkez Mah. Abide-i Hürriyet Cd. No:211/C Bolkan Center K:3 D:96, Şişli / İstanbul',
    contactHoursLabel: 'Çalışma saatleri',
    contactHoursValue: 'Pzt–Cum, 09:00–18:00 (GMT+3)',
    formTitle: 'Mesaj gönderin',
    formNameLabel: 'Adınız Soyadınız*',
    formNamePlaceholder: 'Adınız',
    formEmailLabel: 'E-posta*',
    formEmailPlaceholder: 'ornek@firma.com',
    formSubjectLabel: 'Konu',
    formSubjectPlaceholder: 'Proje / ihtiyaç',
    formMessageLabel: 'Mesaj*',
    formMessagePlaceholder: 'Kısa proje tarifi, teslim tarihi, dosyalar...',
    formSendBtn: 'E-posta gönder',
    formCopyBtn: 'Mesajı kopyala',
    formHumanLabel: 'Robot olmadığımı onaylıyorum',
    footerNote: '© IDEArc Uluslararası Mühendislik ve Müşavirlik Ltd. Şti. – 2025',
    statusRequired: 'Lütfen ad, e-posta ve mesaj alanlarını doldurun.',
    statusOpeningMail: 'E-posta istemciniz açılıyor…',
    statusCopySuccess: 'Mesaj panonuza kopyalandı.',
    statusCopyError: 'Kopyalama başarısız oldu, manuel olarak seçip kopyalayın.',
    statusCopyEmpty: 'Kopyalamak için mesaj alanını doldurun.',
    statusCopyUnsupported: 'Tarayıcınız otomatik kopyalamayı desteklemiyor.',
    statusHumanValidation: 'Lütfen insan doğrulamasını işaretleyin.',
    mailLabelName: 'Ad Soyad',
    mailLabelEmail: 'E-posta',
    mailLabelSubject: 'Konu',
    mailLabelMessage: 'Mesaj'
  },
  en: {
    metaTitle: 'IDEArc – Infrastructure Design Engineering & Architecture',
    metaDescription: 'Since 2015 IDEArc has delivered infrastructure design, BIM, roadway engineering and large-scale consulting assignments.',
    brandName: 'IDEArc',
    menuLabel: 'Menu',
    navHome: 'Home',
    navMetrics: 'Metrics',
    navAbout: 'About',
    navPortfolio: 'Portfolio',
    navReferences: 'References',
    navExpertise: 'Expertise',
    navContact: 'Contact',
    heroTicker: 'IDEArc International Engineering & Consulting Limited Company',
    heroHeading: 'Infrastructure Design Engineering & Architecture',
    heroDescription: 'Since 2015 we have been building BIM-driven solutions for mega mobility projects, logistics campuses, and urban realm upgrades.',
    metricsTitle: 'Scale with measurable impact',
    metricsLead: 'Data-backed output across mega transport and mixed-use programs.',
    metricCompaniesValue: '130+',
    metricCompaniesLabel: 'Enterprise clients',
    metricCompaniesDesc: 'More than 130 ongoing collaborations with public agencies and developers.',
    metricProjectsValue: '700+',
    metricProjectsLabel: 'Completed projects',
    metricProjectsDesc: 'Over 700 transport, logistics and consulting deliveries.',
    metricYearsValue: '10+',
    metricYearsLabel: 'Years of experience',
    metricYearsDesc: 'Infrastructure engineering and consulting powered by BIM deliveries.',
    metricTeamValue: '20+',
    metricTeamLabel: 'Specialist team',
    metricTeamDesc: 'Network of IFC 4.3, Civil 3D and automation experts.',
    heroCTAProjects: 'Explore our projects',
    heroCTAContact: 'Contact us',
    pillTeamTitle: 'Specialist Team',
    pillTeamDesc: 'Civil 3D, InfraWorks and IFC 4.3 experts working across disciplines.',
    pillBimTitle: 'BIM & Automation',
    pillBimDesc: 'Automated takeoffs, budgeting and reporting for complex coordination.',
    pillGlobalTitle: 'Global Experience',
    pillGlobalDesc: 'Projects across Türkiye, Europe and the Middle East in varied scales.',
    aboutTitle: 'About IDEArc',
    aboutLead: 'Founded in 2015, IDEArc set out to go beyond traditional highway design with a focus on BIM and civil engineering innovation.',
    aboutMissionTitle: 'Our mission',
    aboutMissionDesc: 'Deliver infrastructure and architectural solutions with digital-twin accuracy and engineering-grade clarity.',
    aboutWhatTitle: 'What we do',
    aboutWhat1: 'Geometry design for roads, junctions, boulevards and connectors',
    aboutWhat2: 'Earthworks and infrastructure for industrial zones, ports and logistics hubs',
    aboutWhat3: 'Urban design for plazas, waterfronts and public realm upgrades',
    aboutWhat4: 'UTK / UKOME packages and mobility advisory for complex developments',
    aboutWhyTitle: 'Why IDEArc?',
    aboutWhyDesc: 'Cross-disciplinary teams, fast delivery, optimized costs and data-driven sustainability in one place.',
    portfolioTitle: 'Highlighted work',
    portfolioLead: 'Selected consulting, urban design, logistics, industrial and roadway assignments.',
    badgeLogistics: 'Logistics',
    badgeIndustry: 'Industrial',
    badgeEarthworks: 'Earthworks',
    badgeConsulting: 'Consulting',
    badgeRoads: 'Roadways',
    badgeUrban: 'Urban Design',
    projectYalovaTitle: 'Yalova Avrasya OIZ',
    projectYalovaDesc: 'Roads, utilities and logistics planning for the 300 ha industrial campus.',
    projectAskoopTitle: 'İstanbul Askoop Industrial Zone',
    projectAskoopDesc: 'Mobility and gallery infrastructure advisory for a 100 ha masterplan.',
    projectElazigTitle: 'Elazığ City Square',
    projectElazigDesc: 'City-center mobility concept for the award-winning competition.',
    projectIbbTitle: 'İstanbul Citywide Streets & Plazas',
    projectIbbDesc: '40+ streets and plazas with execution drawings and UTK submissions.',
    projectKoyTitle: 'Zekeriyaköy KÖY Development',
    projectKoyDesc: 'Street planning, tree surveys and parking optimization across 467k m².',
    projectDesbTitle: 'Deliklikaya Industrial Zone',
    projectDesbDesc: 'Earthworks optimization and roadway execution for 2.6 million m².',
    projectManisaTitle: 'Manisa Training & Research Hospital',
    projectManisaDesc: 'Access planning, transport report and parking scenarios for the city hospital.',
    projectIgtodTitle: 'Resneli Food Wholesalers',
    projectIgtodDesc: 'Phased roadway and earthworks design for a 400k m² logistics site.',
    ctaPortfolioTr: 'Portfolio (TR)',
    ctaPortfolioEn: 'Portfolio (EN)',
    ctaPdfArchive: 'Open PDF archive',
    ctaAllProjects: 'Videos',
    referencesTitle: 'Trusted by',
    referencesLead: 'From energy majors to municipalities, OIZs and private developers.',
    expertiseTitle: 'Areas of expertise',
    expertiseLead: 'We unite transportation, infrastructure and civil engineering disciplines.',
    expertiseRoadsTitle: 'Roadway design & BIM',
    expertiseRoadsDesc: 'Highways, boulevards and connectors tracked through BIM-driven workflows.',
    expertiseEarthTitle: 'Earthworks',
    expertiseEarthDesc: 'Rapid takeoffs, budgeting and optimization for airports, OIZs and logistics hubs.',
    expertiseUtkTitle: 'UTK / UKOME',
    expertiseUtkDesc: 'Submission-ready packages for temporary circulation and mixed-use developments.',
    expertiseCivilTitle: 'Civil engineering',
    expertiseCivilDesc: 'Site planning, mobility strategies, stormwater/sanitary networks and watercourses.',
    contactTitle: 'Get in touch',
    contactLead: 'We respond within 1–2 business days.',
    contactPhoneLabel: 'Phone',
    contactPhoneValue: '+90 212 823 1234',
    contactEmailLabel: 'Email',
    contactEmailValue: 'info@idearc.com.tr',
    contactAddressLabel: 'Address',
    contactAddressValue: 'Merkez Mah. Abide-i Hürriyet Cd. No:211/C Bolkan Center K:3 D:96, Şişli / İstanbul',
    contactHoursLabel: 'Business hours',
    contactHoursValue: 'Mon–Fri, 09:00–18:00 (GMT+3)',
    formTitle: 'Send a message',
    formNameLabel: 'Full name*',
    formNamePlaceholder: 'Your name',
    formEmailLabel: 'Email*',
    formEmailPlaceholder: 'you@company.com',
    formSubjectLabel: 'Subject',
    formSubjectPlaceholder: 'Project / need',
    formMessageLabel: 'Message*',
    formMessagePlaceholder: 'Brief scope, deadline, files…',
    formSendBtn: 'Send email',
    formCopyBtn: 'Copy message',
    formHumanLabel: 'I confirm I am human',
    footerNote: '© IDEArc International Engineering & Consulting Ltd. 2025',
    statusRequired: 'Please fill in name, email and message.',
    statusOpeningMail: 'Opening your email client…',
    statusCopySuccess: 'Message copied to clipboard.',
    statusCopyError: 'Copy failed, please select and copy manually.',
    statusCopyEmpty: 'Please enter a message before copying.',
    statusCopyUnsupported: 'Your browser does not support automatic copy.',
    statusHumanValidation: 'Please confirm you are human.',
    mailLabelName: 'Name',
    mailLabelEmail: 'Email',
    mailLabelSubject: 'Subject',
    mailLabelMessage: 'Message'
  },
  ar: {
    metaTitle: 'ايدياك – هندسة تصميم البنية التحتية والعمارة',
    metaDescription: 'منذ عام 2015 تقدّم IDEArc خدمات الهندسة والاستشارات في تصميم البنية التحتية وBIM والطرق والمشاريع واسعة النطاق.',
    brandName: 'IDEArc',
    menuLabel: 'القائمة',
    navHome: 'الرئيسية',
    navMetrics: 'المؤشرات',
    navAbout: 'من نحن',
    navPortfolio: 'المشاريع',
    navReferences: 'العملاء',
    navExpertise: 'الخبرات',
    navContact: 'اتصل بنا',
    heroTicker: 'شركة IDEArc الدولية للهندسة والاستشارات المحدودة',
    heroHeading: 'هندسة تصميم البنية التحتية والعمارة',
    heroDescription: 'منذ عام 2015 نطوّر حلولاً معتمدة على BIM لمشاريع النقل الكبرى، ومجمعات الخدمات اللوجستية، وتحسين المشهد الحضري.',
    metricsTitle: 'أرقامنا في المشاريع الكبرى',
    metricsLead: 'نتائج قابلة للقياس في مشاريع النقل والمجمعات متعددة الاستخدام.',
    metricCompaniesValue: '130+',
    metricCompaniesLabel: 'عملاء شركات',
    metricCompaniesDesc: 'أكثر من 130 شريكاً من الهيئات العامة والمطورين.',
    metricProjectsValue: '700+',
    metricProjectsLabel: 'مشاريع منجزة',
    metricProjectsDesc: 'أكثر من 700 مهمة في النقل واللوجستيات والاستشارات.',
    metricYearsValue: '10+',
    metricYearsLabel: 'سنوات الخبرة',
    metricYearsDesc: 'هندسة واستشارات بنية تحتية بتسليمات BIM.',
    metricTeamValue: '20+',
    metricTeamLabel: 'فريق متخصص',
    metricTeamDesc: 'شبكة خبراء IFC 4.3 وCivil 3D والأتمتة.',
    heroCTAProjects: 'استعرض مشاريعنا',
    heroCTAContact: 'تواصل معنا',
    pillTeamTitle: 'فريق متخصص',
    pillTeamDesc: 'خبراء Civil 3D وInfraWorks وIFC 4.3 يعملون عبر التخصصات.',
    pillBimTitle: 'BIM والأتمتة',
    pillBimDesc: 'كشوفات وكلف وتقارير آلية لمواءمة المشاريع المعقدة.',
    pillGlobalTitle: 'خبرة عالمية',
    pillGlobalDesc: 'مشاريع في تركيا وأوروبا والشرق الأوسط بأحجام مختلفة.',
    aboutTitle: 'حول IDEArc',
    aboutLead: 'تأسست IDEArc عام 2015 لتتجاوز التصميم الطرقي التقليدي مع تركيز على الابتكار في BIM والهندسة المدنية.',
    aboutMissionTitle: 'مهمتنا',
    aboutMissionDesc: 'تقديم حلول بنية تحتية وعمارة بدقة التوأم الرقمي ووضوح هندسي.',
    aboutWhatTitle: 'ماذا نفعل؟',
    aboutWhat1: 'تصميم الهندسة الهندسية للطرق والتقاطعات والشوارع الرئيسة والفرعية',
    aboutWhat2: 'أعمال ترابية وبنى تحتية لمناطق صناعية وموانئ ومراكز لوجستية',
    aboutWhat3: 'تصاميم حضرية للميادين والواجهات البحرية والمساحات العامة',
    aboutWhat4: 'ملفات UTK / UKOME للاستشارات المرورية والمشاريع المركبة',
    aboutWhyTitle: 'لماذا IDEArc؟',
    aboutWhyDesc: 'فرق متعددة الاختصاصات، تسليم سريع، كلف محسّنة واستدامة قائمة على البيانات في مكان واحد.',
    portfolioTitle: 'مشاريع مختارة',
    portfolioLead: 'أعمال في الاستشارات والتصميم الحضري واللوجستيات والصناعة والطرق.',
    badgeLogistics: 'لوجستيات',
    badgeIndustry: 'صناعي',
    badgeEarthworks: 'أعمال ترابية',
    badgeConsulting: 'استشارات',
    badgeRoads: 'طرق',
    badgeUrban: 'تصميم حضري',
    projectYalovaTitle: 'منطقة يالوفا أوراسيا الصناعية',
    projectYalovaDesc: 'تخطيط طرق ومرافق ولوجستيات لمجمع صناعي بمساحة 300 هكتار.',
    projectAskoopTitle: 'منطقة أسكوب الصناعية في إسطنبول',
    projectAskoopDesc: 'استشارات الحركة والبنى التحتية لشبكات الخدمات في مخطط 100 هكتار.',
    projectElazigTitle: 'ميدان إلازيغ',
    projectElazigDesc: 'مفهوم حركة داخلية للمشروع الفائز في المسابقة.',
    projectIbbTitle: 'شوارع وميادين إسطنبول',
    projectIbbDesc: 'أكثر من 40 شارعاً وميداناً مع مخططات تنفيذ وملفات UTK.',
    projectKoyTitle: 'مشروع كوي في زكرياكوي',
    projectKoyDesc: 'تخطيط شوارع وجرد أشجار وتحسين مواقف عبر مساحة 467 ألف م².',
    projectDesbTitle: 'منطقة ديليكليكيا الصناعية',
    projectDesbDesc: 'تحسين الأعمال الترابية وطرق التنفيذ على مساحة 2.6 مليون م².',
    projectManisaTitle: 'مستشفى مانيسا التعليمي',
    projectManisaDesc: 'تخطيط الوصول، تقرير النقل وسيناريوهات المواقف لمستشفى المدينة.',
    projectIgtodTitle: 'سوق الجملة الغذائي في رشنلي',
    projectIgtodDesc: 'تصميم طرق وأعمال ترابية على مراحل لموقع لوجستي بمساحة 400 ألف م².',
    ctaPortfolioTr: 'الملف (TR)',
    ctaPortfolioEn: 'الملف (EN)',
    ctaPdfArchive: 'افتح أرشيف PDF',
    ctaAllProjects: 'الفيديوهات',
    referencesTitle: 'عملاؤنا',
    referencesLead: 'من شركات الطاقة إلى البلديات والمطورين والـ OIZ.',
    expertiseTitle: 'مجالات الخبرة',
    expertiseLead: 'نمزج النقل والبنية التحتية والهندسة المدنية في منظومة واحدة.',
    expertiseRoadsTitle: 'تصميم الطرق وBIM',
    expertiseRoadsDesc: 'تصميم طرق سريعة وشوارع رئيسة مع متابعة رقمية كاملة.',
    expertiseEarthTitle: 'الأعمال الترابية',
    expertiseEarthDesc: 'كشوفات وكلف سريعة للمطارات والمناطق الصناعية والمراكز اللوجستية.',
    expertiseUtkTitle: 'UTK / UKOME',
    expertiseUtkDesc: 'ملفات جاهزة للتقديم لحركة مؤقتة ومشاريع الاستخدام المختلط.',
    expertiseCivilTitle: 'الهندسة المدنية',
    expertiseCivilDesc: 'مخططات الموقع، إستراتيجيات التنقل، وشبكات صرف الأمطار والمياه.',
    contactTitle: 'تواصل معنا',
    contactLead: 'نرد خلال يوم إلى يومين عمل.',
    contactPhoneLabel: 'الهاتف',
    contactPhoneValue: '+90 212 823 1234',
    contactEmailLabel: 'البريد الإلكتروني',
    contactEmailValue: 'info@idearc.com.tr',
    contactAddressLabel: 'العنوان',
    contactAddressValue: 'Merkez Mah. Abide-i Hürriyet Cd. No:211/C Bolkan Center K:3 D:96, Şişli / İstanbul',
    contactHoursLabel: 'ساعات العمل',
    contactHoursValue: 'الاثنين–الجمعة، 09:00–18:00 (GMT+3)',
    formTitle: 'أرسل رسالة',
    formNameLabel: 'الاسم الكامل*',
    formNamePlaceholder: 'اسمك',
    formEmailLabel: 'البريد الإلكتروني*',
    formEmailPlaceholder: 'you@company.com',
    formSubjectLabel: 'الموضوع',
    formSubjectPlaceholder: 'المشروع / الحاجة',
    formMessageLabel: 'الرسالة*',
    formMessagePlaceholder: 'وصف موجز، موعد التسليم، الملفات…',
    formSendBtn: 'إرسال بريد',
    formCopyBtn: 'نسخ الرسالة',
    formHumanLabel: 'أؤكد أنني لست روبوتاً',
    footerNote: '© شركة IDEArc للهندسة والاستشارات الدولية 2025',
    statusRequired: 'يرجى تعبئة الاسم والبريد والرسالة.',
    statusOpeningMail: 'يتم فتح برنامج البريد…',
    statusCopySuccess: 'تم نسخ الرسالة إلى الحافظة.',
    statusCopyError: 'فشل النسخ، يرجى النسخ يدوياً.',
    statusCopyEmpty: 'يرجى كتابة الرسالة قبل النسخ.',
    statusCopyUnsupported: 'المتصفح لا يدعم النسخ التلقائي.',
    statusHumanValidation: 'يرجى تأكيد التحقق البشري.',
    mailLabelName: 'الاسم',
    mailLabelEmail: 'البريد',
    mailLabelSubject: 'الموضوع',
    mailLabelMessage: 'الرسالة'
  }
};

let currentLang = DEFAULT_LANG;

function t(key, fallback = '') {
  const dict = translations[currentLang] || {};
  return dict[key] || translations.tr[key] || fallback || key;
}

function updateTextContent() {
  document.querySelectorAll('[data-i18n]').forEach((el) => {
    const key = el.dataset.i18n;
    if (!key) return;
    el.textContent = t(key, el.textContent);
  });

  document.querySelectorAll('[data-i18n-placeholder]').forEach((el) => {
    const key = el.dataset.i18nPlaceholder;
    if (!key) return;
    el.placeholder = t(key, el.placeholder);
  });

  document.querySelectorAll('[data-i18n-meta]').forEach((el) => {
    const key = el.dataset.i18nMeta;
    if (!key) return;
    el.setAttribute('content', t(key, el.getAttribute('content')));
  });

  const titleEl = document.querySelector('title[data-i18n="metaTitle"]');
  if (titleEl) {
    titleEl.textContent = t('metaTitle', titleEl.textContent);
  }
}

function setLanguage(lang) {
  if (!translations[lang]) lang = DEFAULT_LANG;
  currentLang = lang;
  document.documentElement.lang = lang;
  document.body.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
  localStorage.setItem('idearc-lang', lang);

  document.querySelectorAll('[data-lang-btn]').forEach((btn) => {
    btn.classList.toggle('active', btn.dataset.lang === lang);
  });

  updateTextContent();
  setStatusKey('', false);
}

function smoothScrollTo(targetId) {
  if (!targetId) return;

  if (targetId === '#anasayfa') {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    return;
  }

  const el = document.querySelector(targetId);
  if (!el) return;
  el.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function setStatusKey(key, isError) {
  const statusEl = document.getElementById('formStatus');
  if (!statusEl) return;
  if (!key) {
    statusEl.textContent = '';
    return;
  }
  statusEl.textContent = t(key, key);
  statusEl.style.color = isError ? '#ff6b6b' : 'var(--muted)';
}

function decodeValue(value) {
  if (!value) return '';
  try {
    return atob(value);
  } catch {
    return value;
  }
}

function initProtectedContacts() {
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

function initPage() {
  const nav = document.getElementById('primaryNav');
  const toggleBtn = document.querySelector('[data-nav-toggle]');
  const homeUrl = document.body.dataset.home || 'index.html';

  function toggleNav() {
    if (!nav) return;
    const isOpen = nav.classList.toggle('open');
    toggleBtn?.setAttribute('aria-expanded', String(isOpen));
    document.body.classList.toggle('nav-open', isOpen);
  }

  function closeNav() {
    if (!nav) return;
    nav.classList.remove('open');
    toggleBtn?.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('nav-open');
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
      const isHome = document.body.dataset.page === 'home';
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

  const form = document.getElementById('contactForm');
  const copyBtn = document.querySelector('[data-copy]');

  function getFieldValue(name) {
    return form?.querySelector(`[name="${name}"]`)?.value?.trim() || '';
  }

  form?.addEventListener('submit', (event) => {
    event.preventDefault();
    const name = getFieldValue('name');
    const email = getFieldValue('email');
    const subject = getFieldValue('subject');
    const message = getFieldValue('message');

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
    ].join('\n');

    const mailto = `mailto:${encodeURIComponent(SUPPORT_EMAIL)}?subject=${encodeURIComponent(subjectLine)}&body=${encodeURIComponent(body)}`;
    window.location.href = mailto;
    setStatusKey('statusOpeningMail', false);
  });

  copyBtn?.addEventListener('click', () => {
    const message = getFieldValue('message');
    if (!message) {
      setStatusKey('statusCopyEmpty', true);
      return;
    }
    const name = getFieldValue('name');
    const email = getFieldValue('email');
    const subject = getFieldValue('subject');
    const text = [
      `${t('mailLabelName')}: ${name || '-'}`,
      `${t('mailLabelEmail')}: ${email || '-'}`,
      `${t('mailLabelSubject')}: ${subject || '-'}`,
      '',
      message,
    ].join('\n');

    if (navigator.clipboard?.writeText) {
      navigator.clipboard
        .writeText(text)
        .then(() => setStatusKey('statusCopySuccess', false))
        .catch(() => setStatusKey('statusCopyError', true));
    } else {
      setStatusKey('statusCopyUnsupported', true);
    }
  });

  document.querySelectorAll('[data-lang-btn]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const lang = btn.dataset.lang;
      setLanguage(lang);
    });
  });

  const savedLang = localStorage.getItem('idearc-lang') || DEFAULT_LANG;
  setLanguage(savedLang);
  initProtectedContacts();
}

document.addEventListener('DOMContentLoaded', initPage);
