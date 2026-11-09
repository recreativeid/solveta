<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
    $waGeneralOrder = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo SOLVETA, saya tertarik membuat website/platform profesional seperti yang ada di portofolio.");

    // Verified Projects Dataset based on Master Prompt & Stitch Screen Showcase
    $verifiedProjects = [
        [
            'id' => 'konservasi-akuatik',
            'name' => 'Landingpage Konservasi Akuatik',
            'category' => 'landingpage',
            'category_label' => 'Landingpage & Non-Profit',
            'badge_left' => 'NON-PROFIT',
            'badge_right' => 'PAGE SPEED 99/100',
            'status' => 'Live Production',
            'tech' => 'Next.js & Tailwind',
            'desc' => 'Portal kampanye konservasi maritim non-profit dengan arsitektur headless JAMStack ultra-cepat dan sistem peta interaktif.',
            'metric_1_label' => 'BENCHMARK SPEED',
            'metric_1_value' => '0.6s FCP',
            'metric_2_label' => 'CONVERSION BUMP',
            'metric_2_value' => '+142%',
            'url' => 'https://konservasiakuatik.space',
            'url_display' => 'konservasiakuatik.space',
            'image' => '/images/portfolio/konservasi-akuatik.jpg',
            'overview' => 'Inisiatif pelestarian ekosistem terumbu karang dan edukasi kelautan berkelanjutan di Indonesia.',
            'challenge' => 'Kebutuhan menyampaikan informasi kawasan konservasi yang kompleks agar mudah dipahami masyarakat umum dengan kecepatan muat tinggi.',
            'solution' => 'Membangun landing page headless yang ringan dan cepat dengan visualisasi peta interaktif zona konservasi laut.'
        ],
        [
            'id' => 'squabumin',
            'name' => 'Squabumin.id Herbal CRM',
            'category' => 'custom-system',
            'category_label' => 'Custom System & CRM',
            'badge_left' => 'CUSTOM CRM',
            'badge_right' => 'RAJAONGKIR PRO API',
            'status' => 'Live Production',
            'tech' => 'Laravel & Vue.js',
            'desc' => 'Sistem orkestrasi pesanan distributor herbal nasional dengan fitur checkout WhatsApp dan automasi invoice.',
            'metric_1_label' => 'CS EFFICIENCY',
            'metric_1_value' => '3.2x Lipat',
            'metric_2_label' => 'MONTHLY GMV',
            'metric_2_value' => 'Rp 850M+',
            'url' => 'https://squabumin.id',
            'url_display' => 'squabumin.id',
            'image' => '/images/portfolio/squabumin.jpg',
            'overview' => 'Portal pemasaran produk herbal terpercaya untuk pasar nasional dengan fokus pada konversi penjualan dan orkestrasi tim CS.',
            'challenge' => 'Calon pelanggan membutuhkan penjelasan produk yang kredibel dan alur transaksi yang mudah tanpa harus melewati checkout yang rumit.',
            'solution' => 'Merancang website landing page responsif dengan formulir order otomatis yang langsung terhubung ke admin penjualan WhatsApp.'
        ],
        [
            'id' => 'cuango',
            'name' => 'CuanGO Digital Platform',
            'category' => 'web-application',
            'category_label' => 'Web Application & SaaS',
            'badge_left' => 'FINTECH',
            'badge_right' => '99.9% SLA',
            'status' => 'Live SaaS',
            'tech' => 'Next.js & PostgreSQL',
            'desc' => 'Platform akuntansi dan realtime digital ledger untuk UMKM modern dengan sistem audit transaksi multi-user.',
            'metric_1_label' => 'DATA SYNC RATE',
            'metric_1_value' => '< 150ms',
            'metric_2_label' => 'ACTIVE LEDGER',
            'metric_2_value' => '12,000+',
            'url' => 'https://recreativeid.github.io/haltea/',
            'url_display' => 'Live Cloud Platform',
            'image' => '/images/portfolio/cuango.jpg',
            'overview' => 'Sistem pencatatan transaksi harian dan manajemen arus kas untuk pelaku usaha mikro dan menengah.',
            'challenge' => 'Pencatatan manual di buku kas yang rentan salah hitung dan sulit direkapitulasi saat tutup buku bulanan.',
            'solution' => 'Mengembangkan dashboard pembukuan real-time dengan sinkronisasi instan dan laporan margin keuntungan otomatis.'
        ],
        [
            'id' => 'haltea',
            'name' => 'POS Haltea Multi-Outlet',
            'category' => 'custom-system',
            'category_label' => 'Custom System & POS',
            'badge_left' => 'POS RETAIL',
            'badge_right' => '10+ CABANG',
            'status' => 'Live Production',
            'tech' => 'Flutter & PWA',
            'desc' => 'Ekosistem Point-of-Sale hybrid online/offline untuk waralaba F&B, terintegrasi langsung dengan kitchen printer.',
            'metric_1_label' => 'OFFLINE BUFFER',
            'metric_1_value' => '100% Safe',
            'metric_2_label' => 'ORDER TURNAROUND',
            'metric_2_value' => '-45 Detik',
            'url' => 'https://recreativeid.github.io/haltea/',
            'url_display' => 'recreativeid.github.io/haltea',
            'image' => '/images/portfolio/haltea.jpg',
            'overview' => 'Aplikasi kasir praktis untuk operasional gerai minuman kekinian dan restoran cepat saji multi-cabang.',
            'challenge' => 'Antrean pelanggan yang panjang saat jam sibuk dan kebutuhan mencetak struk transaksi dengan cepat.',
            'solution' => 'Sistem kasir berbasis web yang sangat cepat dengan antarmuka sentuh intuitif dan integrasi printer kasir.'
        ],
        [
            'id' => 'visualgenix',
            'name' => 'Visual Genix AI Funnel',
            'category' => 'landingpage',
            'category_label' => 'Landingpage & AI Funnel',
            'badge_left' => 'AI TECH',
            'badge_right' => 'CONVERSION +180%',
            'status' => 'Global Showcase',
            'tech' => 'React & OpenAI API',
            'desc' => 'Landing page sales funnel teroptimasi dengan live dynamic demo prompt generator untuk agensi kreatif AI.',
            'metric_1_label' => 'OPT-IN VELOCITY',
            'metric_1_value' => '34.8%',
            'metric_2_label' => 'BOUNCE DROP',
            'metric_2_value' => '-38%',
            'url' => '#',
            'url_display' => 'AI Demo Showcase',
            'image' => '/images/portfolio/visualgenix.jpg',
            'overview' => 'Etalase portofolio digital studio kreatif multimedia untuk menjangkau klien korporasi dengan generator prompt interaktif.',
            'challenge' => 'Banyaknya berkas video dan gambar beresolusi tinggi yang berisiko memperlambat loading website.',
            'solution' => 'Optimasi kompresi gambar modern dan lazy-loading adaptif sehingga website tetap memuat cepat di ponsel pintar.'
        ],
        [
            'id' => 'tidurnyenyak',
            'name' => 'Tidurnyenyak.com Official',
            'category' => 'corporate-profile',
            'category_label' => 'Corporate Profile & B2B',
            'badge_left' => 'CORPORATE PROFILE',
            'badge_right' => 'TOP GOOGLE SEO',
            'status' => 'Corporate Live',
            'tech' => 'Headless CMS',
            'desc' => 'Website korporasi manufaktur springbed premium dengan kurasi portofolio B2B hotel dan katalog ritel konsumen.',
            'metric_1_label' => 'ORGANIC CLICKS',
            'metric_1_value' => '+220% YoY',
            'metric_2_label' => 'B2B LEADS INFLOW',
            'metric_2_value' => '80+/Bulan',
            'url' => 'https://tidurnyenyak.com',
            'url_display' => 'tidurnyenyak.com',
            'image' => '/images/portfolio/tidurnyenyak.jpg',
            'overview' => 'Website profil perusahaan manufaktur springbed terkemuka dengan katalog spesifikasi kasur lengkap.',
            'challenge' => 'Memperkuat citra brand premium dan mempermudah pengelola hotel memesan matras kustom dalam jumlah besar.',
            'solution' => 'Menghadirkan desain website korporat yang elegan dengan formulir permintaan penawaran B2B yang langsung direspon tim sales.'
        ],
        [
            'id' => 'tekape',
            'name' => 'TeKaPe.id Direktori Bisnis',
            'category' => 'corporate-profile',
            'category_label' => 'Corporate Profile & Direktori',
            'badge_left' => 'DIREKTORI BISNIS',
            'badge_right' => 'SEO RANK #1',
            'status' => 'Live Production',
            'tech' => 'Web Portal & Maps',
            'desc' => 'Portal direktori informasi tempat usaha dan direktori lokal untuk memudahkan pencarian titik lokasi bisnis.',
            'metric_1_label' => 'SEARCH SPEED',
            'metric_1_value' => '0.4s Index',
            'metric_2_label' => 'TOTAL LISTING',
            'metric_2_value' => '4,500+',
            'url' => 'https://tekape.id',
            'url_display' => 'tekape.id',
            'image' => '/images/portfolio/cuango.jpg',
            'overview' => 'Platform direktori usaha untuk menghubungkan penyedia jasa lokal dengan konsumen sekitar.',
            'challenge' => 'Struktur navigasi direktori yang luas membutuhkan sistem pencarian yang responsif.',
            'solution' => 'Mengembangkan arsitektur database terindeks dengan filter kategori dan pencarian instan.'
        ],
        [
            'id' => 'travel-bukittinggi',
            'name' => 'Travel Bukittinggi Pekanbaru',
            'category' => 'landingpage',
            'category_label' => 'Landingpage & Booking',
            'badge_left' => 'TRAVEL FLEET',
            'badge_right' => 'WHATSAPP DIRECT',
            'status' => 'Live Production',
            'tech' => 'Booking Engine & WhatsApp',
            'desc' => 'Website layanan transportasi antarkota dengan jadwal keberangkatan terpadu dan pemesanan tiket via WhatsApp.',
            'metric_1_label' => 'BOOKING SPEED',
            'metric_1_value' => '< 3 Menit',
            'metric_2_label' => 'FILL RATE',
            'metric_2_value' => '94% Seat',
            'url' => 'https://travelbukittkinggipekanbaru.site',
            'url_display' => 'travelbukittkinggipekanbaru.site',
            'image' => '/images/portfolio/squabumin.jpg',
            'overview' => 'Layanan tiket travel eksekutif rute Sumatera Barat ke Riau.',
            'challenge' => 'Penumpang membutuhkan kepastian jadwal dan tarif tanpa harus datang ke loket fisik.',
            'solution' => 'Website mobile-first dengan tabel jadwal jelas dan tombol pesan kursi instan ke operator WhatsApp.'
        ],
        [
            'id' => 'revo-bullion',
            'name' => 'REVO BULLION Logam Mulia',
            'category' => 'e-commerce',
            'category_label' => 'E-Commerce & Logam Mulia',
            'badge_left' => 'LOGAM MULIA',
            'badge_right' => 'LIVE SPREAD API',
            'status' => 'Live Production',
            'tech' => 'Fintech Web & Live Pricing',
            'desc' => 'Platform edukasi dan profil perdagangan logam mulia emas batangan dengan pembaruan harga berkala.',
            'metric_1_label' => 'PRICE ACCURACY',
            'metric_1_value' => '99.9%',
            'metric_2_label' => 'DAILY ORDERS',
            'metric_2_value' => '180+/Hari',
            'url' => 'https://revobullion.my.id',
            'url_display' => 'revobullion.my.id',
            'image' => '/images/portfolio/tidurnyenyak.jpg',
            'overview' => 'Pusat informasi investasi dan jual beli emas murni berstandar nasional.',
            'challenge' => 'Membangun kepercayaan publik terhadap transaksi instrumen investasi emas secara online.',
            'solution' => 'Desain berwibawa dengan sertifikasi keamanan data dan kalkulator estimasi nilai emas real-time.'
        ],
        [
            'id' => 'japakehpost',
            'name' => 'JAPAKEH POST News Portal',
            'category' => 'corporate-profile',
            'category_label' => 'Corporate Profile & Berita',
            'badge_left' => 'PORTAL BERITA',
            'badge_right' => 'CORE WEB VITALS 98',
            'status' => 'Live Production',
            'tech' => 'Editorial News CMS & RSS',
            'desc' => 'Portal media berita independen, opini publik, dan informasi perkembangan daerah dengan struktur pembaca yang nyaman.',
            'metric_1_label' => 'LOAD TIME',
            'metric_1_value' => '0.5s Ready',
            'metric_2_label' => 'PAGE VIEWS',
            'metric_2_value' => '120k+/Bln',
            'url' => 'http://www.japakehpost.com',
            'url_display' => 'japakehpost.com',
            'image' => '/images/portfolio/konservasi-akuatik.jpg',
            'overview' => 'Media siber daerah untuk menyampaikan berita aktual dan liputan komunitas.',
            'challenge' => 'Lonjakan pembaca saat ada berita viral yang memerlukan stabilitas server tinggi.',
            'solution' => 'Sistem caching konten statis yang memastikan artikel terbuka dalam waktu kurang dari satu detik.'
        ],
        [
            'id' => 'emhadonasi',
            'name' => 'EMHA Donasi Kemanusiaan',
            'category' => 'landingpage',
            'category_label' => 'Landingpage & Filantropi',
            'badge_left' => 'DONASI SOSIAL',
            'badge_right' => 'PUBLIC LEDGER',
            'status' => 'Live Production',
            'tech' => 'Donation Portal & Ledger',
            'desc' => 'Sistem penghimpunan donasi sosial dan laporan transparansi penyaluran bantuan kemanusiaan secara terbuka.',
            'metric_1_label' => 'TRANSPARENCY',
            'metric_1_value' => '100% Realtime',
            'metric_2_label' => 'DONOR TRUST',
            'metric_2_value' => '96% Index',
            'url' => 'https://emhadonasi.netlify.app',
            'url_display' => 'emhadonasi.netlify.app',
            'image' => '/images/portfolio/konservasi-akuatik.jpg',
            'overview' => 'Wadah penghubung antara donatur dan program bantuan sosial kemasyarakatan.',
            'challenge' => 'Tingkat kepercayaan donatur yang sangat bergantung pada transparansi bukti penyaluran.',
            'solution' => 'Menyediakan halaman pelaporan donasi real-time dengan status program dan galeri dokumentasi penyaluran.'
        ],
        [
            'id' => 'cliento',
            'name' => 'Cliento Project Management',
            'category' => 'web-application',
            'category_label' => 'Web Application & SaaS',
            'badge_left' => 'WORKFLOW SAAS',
            'badge_right' => 'KANBAN ENGINE',
            'status' => 'Live Production',
            'tech' => 'Single Page App & Task Board',
            'desc' => 'Aplikasi web manajemen proyek dan komunikasi klien untuk memantau status pengerjaan tugas secara terstruktur.',
            'metric_1_label' => 'COLLAB SPEED',
            'metric_1_value' => '+65% Faster',
            'metric_2_label' => 'ACTIVE TASKS',
            'metric_2_value' => '400+/Bln',
            'url' => 'https://recreativeid.github.io/cliento',
            'url_display' => 'recreativeid.github.io/cliento',
            'image' => '/images/portfolio/cuango.jpg',
            'overview' => 'Aplikasi internal untuk koordinasi alur kerja tim agensi dan pelaporan milestone ke klien.',
            'challenge' => 'Koordinasi tugas yang tercecer di berbagai grup chat pesan instan.',
            'solution' => 'Papan tugas visual (Kanban) berbasis web dengan pembagian tugas, tenggat waktu, dan catatan revisi.'
        ],
        [
            'id' => 'manajemen-mbg',
            'name' => 'Manajemen MBG Logistik',
            'category' => 'custom-system',
            'category_label' => 'Custom System & Logistik',
            'badge_left' => 'LOGISTIK MBG',
            'badge_right' => 'REALTIME BUFFER',
            'status' => 'Live Production',
            'tech' => 'Cloud Dashboard & Dispatch',
            'desc' => 'Sistem pemantauan dan pengelolaan operasional terpadu untuk pencatatan distribusi dan inventaris program makanan bergizi.',
            'metric_1_label' => 'DISTRIBUTION',
            'metric_1_value' => '15k Porsi/Hr',
            'metric_2_label' => 'DISPATCH ERROR',
            'metric_2_value' => '0% Audit',
            'url' => 'https://manajemen-mbg.vercel.app',
            'url_display' => 'manajemen-mbg.vercel.app',
            'image' => '/images/portfolio/haltea.jpg',
            'overview' => 'Platform manajemen data operasional dapur terpadu dan armada distribusi paket.',
            'challenge' => 'Kebutuhan mencatat jumlah porsi dan titik pengantaran harian dengan akurat.',
            'solution' => 'Dashboard pelaporan digital terpusat yang dapat diakses oleh penanggung jawab dapur dan koordinator lapangan.'
        ],
        [
            'id' => 'db-dawis',
            'name' => 'DB Dawis Registrasi Warga',
            'category' => 'custom-system',
            'category_label' => 'Custom System & Database',
            'badge_left' => 'DATA WARGA',
            'badge_right' => 'OFFLINE-FIRST PWA',
            'status' => 'Live Production',
            'tech' => 'PWA Form & Offline Sync',
            'desc' => 'Sistem basis data terpadu untuk pencatatan data keluarga dan pelaporan kelompok Dasawisma rukun warga.',
            'metric_1_label' => 'DATA ACCURACY',
            'metric_1_value' => '99.8%',
            'metric_2_label' => 'KK TERCATAT',
            'metric_2_value' => '1,200+ KK',
            'url' => 'https://recreativeid.github.io/db_dawis',
            'url_display' => 'recreativeid.github.io/db_dawis',
            'image' => '/images/portfolio/konservasi-akuatik.jpg',
            'overview' => 'Digitalisasi buku data keluarga untuk mendukung pendataan warga di tingkat RT/RW.',
            'challenge' => 'Proses pengisian data warga secara manual di lembaran kertas yang mudah rusak dan sulit direkap.',
            'solution' => 'Formulir input ramah ponsel yang memungkinkan kader memasukkan data warga secara mudah dari smartphone.'
        ],
        [
            'id' => 'buser-info',
            'name' => 'Buser Info Keamanan Publik',
            'category' => 'corporate-profile',
            'category_label' => 'Corporate Profile & Edukasi',
            'badge_left' => 'EDUKASI PUBLIK',
            'badge_right' => 'SOS DIRECTORY',
            'status' => 'Live Production',
            'tech' => 'Emergency Portal & Guides',
            'desc' => 'Portal edukasi hukum, informasi peringatan dini, dan panduan keamanan masyarakat umum.',
            'metric_1_label' => 'FCP SPEED',
            'metric_1_value' => '0.4s FCP',
            'metric_2_label' => 'MONTHLY REACH',
            'metric_2_value' => '50k+ Warga',
            'url' => 'https://recreativeid.github.io/buser_info',
            'url_display' => 'recreativeid.github.io/buser_info',
            'image' => '/images/portfolio/visualgenix.jpg',
            'overview' => 'Media edukasi kamtibmas dan direktori kontak darurat untuk warga.',
            'challenge' => 'Masyarakat sering kesulitan mencari panduan penanganan darurat saat menghadapi situasi krisis.',
            'solution' => 'Menyediakan direktori artikel panduan praktis dan daftar tombol panggilan darurat langsung dari layar ponsel.'
        ],
    ];
?>

<!-- ========================================================================= -->
<!-- 1. PORTFOLIO HERO HEADER — Clean White & Red High Contrast (Font Inter, SaaS)-->
<!-- ========================================================================= -->
<section class="clean-hero-header pt-28 sm:pt-36 pb-16 sm:pb-24 border-b border-[#E8E9ED] dark:border-neutral-800 font-sans relative overflow-hidden">
    <!-- Subtle Dotted Grid Background -->
    <div class="absolute inset-0 bg-grid-dots opacity-35 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 space-y-6 sm:space-y-7 text-center">
        
        <!-- Eyebrow Pill Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white text-xs font-semibold shadow-xs">
            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
            <span class="font-bold tracking-wider uppercase font-sans">PORTOFOLIO &amp; KARYA REKAYASA • SOLVETA</span>
        </div>

        <!-- Headline (Clean, Crisp Inter, High Contrast) -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.12] drop-shadow-none">
            Koleksi Portofolio &amp; <br class="hidden sm:inline">
            <span class="text-white">Karya Nyata SOLVETA</span>
        </h1>

        <!-- Subtitle -->
        <p class="text-sm sm:text-base md:text-lg text-white/90 leading-relaxed max-w-2xl mx-auto drop-shadow-none">
            Katalog karya website modern, platform bisnis terintegrasi, dan sistem digital yang dirancang untuk meningkatkan kredibilitas serta pertumbuhan omzet klien kami.
        </p>

        <!-- Centered Floating Prompt & Search Box -->
        <div class="max-w-2xl mx-auto pt-2">
            <form onsubmit="handlePortfolioSearchSubmit(event)" class="relative w-full">
                <div class="relative flex items-center bg-white dark:bg-[#1A1C22] rounded-full p-2 pl-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-sm focus-within:ring-2 focus-within:ring-[#C4264A]/30 transition-all">
                    <div class="pr-2 text-neutral-400 shrink-0">
                        <i data-lucide="search" class="w-4 h-4 text-[#C4264A]"></i>
                    </div>
                    <input type="text" id="portfolio-search-input" 
                           placeholder="Mulai sekarang. Website, sistem CRM, atau platform apa yang ingin Anda bangun?" 
                           class="w-full py-2 px-1 text-xs sm:text-sm text-[#111215] dark:text-white placeholder:text-neutral-400 outline-none bg-transparent font-medium">
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-full bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs font-bold transition flex items-center gap-1.5 shrink-0 shadow-sm cursor-pointer"
                            title="Cari portofolio">
                        <span>Cari</span>
                        <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </form>

            <div class="mt-2.5 text-[11px] text-neutral-500 dark:text-neutral-400 flex items-center justify-center gap-2">
                <span>Pencarian instan:</span>
                <span class="text-[#C4264A] dark:text-[#F05A72] underline cursor-pointer hover:font-bold" onclick="filterBySearch('crm')">CRM</span> •
                <span class="text-[#C4264A] dark:text-[#F05A72] underline cursor-pointer hover:font-bold" onclick="filterBySearch('company profile')">Company Profile</span> •
                <span class="text-[#C4264A] dark:text-[#F05A72] underline cursor-pointer hover:font-bold" onclick="filterBySearch('pos')">POS</span> •
                <span class="text-[#C4264A] dark:text-[#F05A72] underline cursor-pointer hover:font-bold" onclick="filterBySearch('landingpage')">Landingpage</span>
            </div>
        </div>

        <!-- Category Filter Pills -->
        <div class="flex flex-wrap items-center justify-center gap-2 pt-2" id="portfolio-filters">
            <button type="button" data-filter="all" 
                    class="filter-btn active px-4 py-2 rounded-full text-xs font-bold transition-all bg-[#C4264A] text-white shadow-md">
                Semua (<?= count($verifiedProjects) ?>)
            </button>
            <button type="button" data-filter="landingpage" 
                    class="filter-btn px-4 py-2 rounded-full text-xs font-medium bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-neutral-300 border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all">
                Landingpage
            </button>
            <button type="button" data-filter="custom-system" 
                    class="filter-btn px-4 py-2 rounded-full text-xs font-medium bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-neutral-300 border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all">
                Custom System &amp; CRM
            </button>
            <button type="button" data-filter="web-application" 
                    class="filter-btn px-4 py-2 rounded-full text-xs font-medium bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-neutral-300 border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all">
                Web Application &amp; SaaS
            </button>
            <button type="button" data-filter="e-commerce" 
                    class="filter-btn px-4 py-2 rounded-full text-xs font-medium bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-neutral-300 border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all">
                E-Commerce
            </button>
            <button type="button" data-filter="corporate-profile" 
                    class="filter-btn px-4 py-2 rounded-full text-xs font-medium bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-neutral-300 border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all">
                Corporate Profile &amp; Berita
            </button>
        </div>

    </div>

    <!-- Client Marquee Strip -->
    <div class="mt-12 sm:mt-16 pt-6 border-t border-[#E8E9ED] dark:border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 text-center mb-4">
            <span class="text-[11px] font-bold text-neutral-500 uppercase tracking-wider font-sans">
                Dipercaya oleh puluhan brand, korporasi, dan institusi di Indonesia:
            </span>
        </div>

        <div class="relative w-full overflow-hidden flex items-center py-2">
            <div class="pointer-events-none absolute inset-y-0 left-0 w-24 sm:w-36 bg-gradient-to-r from-white to-transparent z-10"></div>
            <div class="pointer-events-none absolute inset-y-0 right-0 w-24 sm:w-36 bg-gradient-to-l from-white to-transparent z-10"></div>

            <div class="flex items-center gap-12 sm:gap-16 whitespace-nowrap animate-marquee marquee-track">
                <?php 
                    $clientLogos = [
                        ['name' => 'PT Squabumin Herbal', 'img' => '/uploads/brands/brand-1788254260324.png'],
                        ['name' => 'CuanGO Platform', 'img' => '/uploads/brands/brand-1788254350483.png'],
                        ['name' => 'Haltea F&B Retail', 'img' => '/uploads/brands/brand-1788254406941.png'],
                        ['name' => 'Tidurnyenyak.com', 'img' => '/uploads/brands/brand-1788254482294.png'],
                        ['name' => 'Konservasi Akuatik', 'img' => '/uploads/brands/brand-1788254508761.png'],
                        ['name' => 'VisualGenix AI', 'img' => '/uploads/brands/brand-1788258571491.png'],
                    ];
                    $marqueeClients = array_merge($clientLogos, $clientLogos, $clientLogos);
                ?>
                <?php foreach ($marqueeClients as $client): ?>
                    <div class="inline-flex items-center justify-center h-9 w-28 sm:w-36 shrink-0 opacity-70 hover:opacity-100 transition-opacity">
                        <img src="<?= base_url(ltrim($client['img'], '/')) ?>" alt="<?= esc($client['name']) ?>" class="max-h-7 max-w-full object-contain filter grayscale hover:grayscale-0 transition-all">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</section>

<!-- ========================================================================= -->
<!-- 2. RESPONSIVE PROJECT SHOWCASE GRID (Pure White Background)               -->
<!-- ========================================================================= -->
<section class="py-12 sm:py-20 bg-white dark:bg-[#171717] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8" id="portfolio-grid">
            
            <?php foreach ($verifiedProjects as $project): ?>
                <div class="portfolio-card rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#171717] overflow-hidden shadow-clean hover:shadow-card-hover transition-all flex flex-col justify-between group"
                     data-category="<?= esc($project['category']) ?>" 
                     data-name="<?= esc(strtolower($project['name'] . ' ' . $project['desc'] . ' ' . $project['tech'] . ' ' . $project['badge_left'] . ' ' . $project['badge_right'])) ?>">
                    
                    <div>
                        <!-- Project Visual Mockup & Device Area -->
                        <div class="relative bg-neutral-100 dark:bg-neutral-900 h-52 sm:h-56 overflow-hidden border-b border-[#E8E9ED] dark:border-neutral-800">
                            <!-- Left Floating Badge -->
                            <div class="absolute top-3 left-3 z-10">
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-white/95 dark:bg-neutral-900/95 text-[#171717] dark:text-white uppercase tracking-wider shadow-xs border border-black/5 dark:border-white/10">
                                    <?= esc($project['badge_left']) ?>
                                </span>
                            </div>

                            <!-- Right Floating Badge -->
                            <div class="absolute top-3 right-3 z-10">
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-[#C4264A] text-white uppercase tracking-wider shadow-xs">
                                    <?= esc($project['badge_right']) ?>
                                </span>
                            </div>

                            <!-- Mockup Screenshot -->
                            <img src="<?= base_url(ltrim($project['image'], '/')) ?>" alt="<?= esc($project['name']) ?>" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Card Body Content -->
                        <div class="p-5 sm:p-6 space-y-3">
                            <!-- Status & Tech Stack Bullet -->
                            <div class="flex items-center gap-1.5 text-[11px] font-medium text-[#737780] dark:text-neutral-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span><?= esc($project['status']) ?></span>
                                <span class="text-gray-300 dark:text-neutral-700">•</span>
                                <span><?= esc($project['tech']) ?></span>
                            </div>
                            
                            <!-- Project Title -->
                            <h3 class="text-base sm:text-lg font-bold text-[#171717] dark:text-white group-hover:text-[#8E1738] dark:group-hover:text-[#F05A72] transition-colors leading-snug">
                                <?= esc($project['name']) ?>
                            </h3>

                            <!-- Project Description -->
                            <p class="text-xs text-[#737780] dark:text-neutral-400 leading-relaxed line-clamp-2">
                                <?= esc($project['desc']) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Card Actions: Dual Button Architecture -->
                    <div class="p-5 sm:p-6 pt-0 space-y-2">
                        <!-- Button 1: Live Link -->
                        <?php if ($project['url'] !== '#'): ?>
                            <a href="<?= esc($project['url']) ?>" target="_blank" rel="noopener noreferrer"
                               class="w-full py-2.5 px-3 rounded-xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-neutral-900 hover:bg-neutral-50 dark:hover:bg-neutral-800 text-[#171717] dark:text-white text-xs font-bold flex items-center justify-center gap-1.5 shadow-xs transition-all">
                                <span>Kunjungi Live Website</span>
                                <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-[#737780]"></i>
                            </a>
                        <?php else: ?>
                            <button type="button" onclick="openProjectModal('<?= esc($project['id']) ?>')"
                                    class="w-full py-2.5 px-3 rounded-xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-neutral-900 hover:bg-neutral-50 dark:hover:bg-neutral-800 text-[#171717] dark:text-white text-xs font-bold flex items-center justify-center gap-1.5 shadow-xs transition-all">
                                <span>Kunjungi Live Website</span>
                                <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-[#737780]"></i>
                            </button>
                        <?php endif; ?>

                        <!-- Button 2: WhatsApp Consultation -->
                        <a href="https://wa.me/<?= $waClean ?>?text=<?= rawurlencode('Halo SOLVETA, saya tertarik membuat solusi digital serupa dengan proyek ' . $project['name']) ?>" target="_blank" rel="noopener noreferrer"
                           class="w-full py-2.5 px-3 rounded-xl gradient-hero text-white hover:opacity-95 active:scale-98 text-xs font-bold flex items-center justify-center gap-1.5 shadow-xs transition-all">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                            <span>Konsultasi Serupa via WhatsApp</span>
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

        <!-- Empty State -->
        <div id="portfolio-empty" class="hidden text-center py-16 space-y-3">
            <i data-lucide="folder-search" class="w-10 h-10 text-gray-400 mx-auto"></i>
            <h4 class="text-base font-bold text-[#171717] dark:text-white">Tidak ada proyek yang sesuai</h4>
            <p class="text-xs text-[#737780]">Coba kata kunci lain atau pilih filter kategori yang berbeda.</p>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 3. VALUE TRUST / METRIC HIGHLIGHTS SECTION (Exact 3 Metric Cards)         -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-24 bg-white dark:bg-[#171717] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
            
            <!-- Metric 1: Avg. Traffic Boost -->
            <div class="p-6 sm:p-8 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#121214] shadow-clean space-y-4">
                <div class="w-10 h-10 rounded-xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center">
                    <i data-lucide="trending-up" class="w-5 h-5"></i>
                </div>
                <div class="space-y-1">
                    <div class="text-3xl sm:text-4xl font-black text-[#171717] dark:text-white tracking-tight">
                        +340%
                    </div>
                    <div class="text-sm font-bold text-[#171717] dark:text-white">
                        Avg. Traffic Boost
                    </div>
                </div>
                <p class="text-xs text-[#737780] dark:text-neutral-400 leading-relaxed">
                    Peningkatan kunjungan organik berkelanjutan melalui optimasi teknis Core Web Vitals dan struktur semantik SEO modern.
                </p>
                <div class="pt-4 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center gap-2 text-[11px] font-sans text-[#737780] dark:text-neutral-400">
                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-500"></i>
                    <span>Verified via Google Lighthouse</span>
                </div>
            </div>

            <!-- Metric 2: Server SLA Uptime -->
            <div class="p-6 sm:p-8 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#121214] shadow-clean space-y-4">
                <div class="w-10 h-10 rounded-xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center">
                    <i data-lucide="server" class="w-5 h-5"></i>
                </div>
                <div class="space-y-1">
                    <div class="text-3xl sm:text-4xl font-black text-[#171717] dark:text-white tracking-tight">
                        99.9%
                    </div>
                    <div class="text-sm font-bold text-[#171717] dark:text-white">
                        Server SLA Uptime
                    </div>
                </div>
                <p class="text-xs text-[#737780] dark:text-neutral-400 leading-relaxed">
                    Infrastruktur cloud berstandar industri dengan proteksi DDoS, auto-scaling, dan disaster recovery multi-zone redundan.
                </p>
                <div class="pt-4 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center gap-2 text-[11px] font-sans text-[#737780] dark:text-neutral-400">
                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-500"></i>
                    <span>Enterprise Cloud Architecture</span>
                </div>
            </div>

            <!-- Metric 3: Conversion Rate -->
            <div class="p-6 sm:p-8 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#121214] shadow-clean space-y-4">
                <div class="w-10 h-10 rounded-xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center">
                    <i data-lucide="sparkles" class="w-5 h-5"></i>
                </div>
                <div class="space-y-1">
                    <div class="text-3xl sm:text-4xl font-black text-[#171717] dark:text-white tracking-tight">
                        2.4x
                    </div>
                    <div class="text-sm font-bold text-[#171717] dark:text-white">
                        Conversion Rate
                    </div>
                </div>
                <p class="text-xs text-[#737780] dark:text-neutral-400 leading-relaxed">
                    Desain UI/UX berbasis riset psikologi konversi total yang terbukti melipatgandakan closing deal dan formulir leads.
                </p>
                <div class="pt-4 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center gap-2 text-[11px] font-sans text-[#737780] dark:text-neutral-400">
                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-500"></i>
                    <span>Field Behavioral UX</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ========================================================================= -->
<!-- 4. CTA KONSULTASI ADMIN ZAHRA (VERSI PORTOFOLIO)                         -->
<!-- ========================================================================= -->
<section id="kontak-zahra" class="py-16 sm:py-20 bg-white dark:bg-[#0E0F12] font-sans border-t border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="rounded-3xl border border-red-200 dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] p-8 sm:p-12 flex flex-col md:flex-row items-center justify-between gap-8 shadow-sm hover:shadow-editorial hover:border-red-300 transition-all">
            
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden shrink-0 border-2 border-[#C4264A] shadow-md">
                    <img src="<?= base_url('images/cs-zahra.jpg') ?>" alt="Admin Zahra" class="w-full h-full object-cover object-top">
                </div>
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-1.5 text-[10px] font-sans uppercase tracking-wider text-emerald-600 dark:text-emerald-400 font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Live Verified Support (&lt; 5 Menit)</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-[#111215] dark:text-white">
                        Konsultasi Langsung Bersama Admin Zahra
                    </h3>
                    <p class="text-xs text-neutral-500">
                        Lead Customer Service &amp; Project Coordinator Resmi SOLVETA • Jam Kerja: 08:00 – 21:00 WIB
                    </p>
                </div>
            </div>

            <div class="shrink-0 w-full md:w-auto">
                <a href="https://wa.me/<?= $waClean ?>?text=<?= rawurlencode('Halo CS Zahra & Lead Engineer SOLVETA, saya melihat portofolio proyek SOLVETA dan tertarik ingin berkonsultasi mengenai pembuatan sistem / website serupa untuk bisnis saya.') ?>" target="_blank" rel="noopener noreferrer"
                   class="w-full md:w-auto px-8 py-4 rounded-full text-xs sm:text-sm font-bold text-white bg-[#C4264A] hover:bg-[#8E1738] shadow-lg shadow-red-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Konsultasi via WhatsApp</span>
                    <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- ========================================================================= -->
<!-- 5. PROJECT DETAIL MODAL DIALOG (Interactive Deep View)                    -->
<!-- ========================================================================= -->
<div id="project-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white dark:bg-[#171717] rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-[#E8E9ED] dark:border-neutral-800 shadow-2xl p-6 sm:p-8 space-y-6">
        
        <div class="flex items-center justify-between pb-3 border-b border-[#E8E9ED] dark:border-neutral-800">
            <div>
                <span id="modal-category" class="text-[10px] font-sans font-bold text-[#8E1738] dark:text-[#F05A72] uppercase block"></span>
                <h3 id="modal-title" class="text-xl sm:text-2xl font-black text-[#171717] dark:text-white"></h3>
            </div>
            <button type="button" onclick="closeProjectModal()" class="w-8 h-8 rounded-full bg-gray-100 dark:bg-neutral-800 text-[#737780] hover:text-[#171717] flex items-center justify-center transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <div class="rounded-2xl overflow-hidden bg-gray-100 dark:bg-neutral-900 h-56 relative border border-[#E8E9ED] dark:border-neutral-800">
            <img id="modal-image" src="" alt="Screenshot Proyek" class="w-full h-full object-cover">
        </div>

        <div class="space-y-4 text-xs">
            <div>
                <h4 class="font-bold text-[#171717] dark:text-white mb-1">Project Overview</h4>
                <p id="modal-overview" class="text-[#737780] dark:text-neutral-400 leading-relaxed"></p>
            </div>

            <div>
                <h4 class="font-bold text-[#171717] dark:text-white mb-1">Tantangan yang Dihadapi</h4>
                <p id="modal-challenge" class="text-[#737780] dark:text-neutral-400 leading-relaxed"></p>
            </div>

            <div>
                <h4 class="font-bold text-[#171717] dark:text-white mb-1">Solusi yang Dikembangkan</h4>
                <p id="modal-solution" class="text-[#737780] dark:text-neutral-400 leading-relaxed"></p>
            </div>

            <div class="pt-2 border-t border-[#E8E9ED] dark:border-neutral-800 flex flex-wrap items-center justify-between gap-3">
                <div class="text-[11px] font-sans text-[#737780]">
                    <span>Teknologi: </span><b id="modal-tech" class="text-[#171717] dark:text-white"></b>
                </div>
                <div class="flex items-center gap-2">
                    <a id="modal-url-link" href="#" target="_blank" rel="noopener noreferrer"
                       class="px-4 py-2 rounded-xl bg-[#8E1738] text-white font-bold text-xs flex items-center gap-1.5 shadow-sm">
                        <span>Kunjungi Website</span>
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- ========================================================================= -->
<!-- 6. CLIENT-SIDE FILTERING & MODAL ENGINE                                   -->
<!-- ========================================================================= -->
<script>
    const projectData = <?= json_encode($verifiedProjects) ?>;

    function openProjectModal(projectId) {
        const p = projectData.find(item => item.id === projectId);
        if (!p) return;

        document.getElementById('modal-category').innerText = p.category_label;
        document.getElementById('modal-title').innerText = p.name;
        document.getElementById('modal-image').src = p.image;
        document.getElementById('modal-overview').innerText = p.overview || p.desc;
        document.getElementById('modal-challenge').innerText = p.challenge || 'Tantangan operasional dan kebutuhan digitalisasi proses bisnis.';
        document.getElementById('modal-solution').innerText = p.solution || p.desc;
        document.getElementById('modal-tech').innerText = p.tech || 'Modern Web Stack';

        const linkEl = document.getElementById('modal-url-link');
        if (p.url && p.url !== '#') {
            linkEl.href = p.url;
            linkEl.classList.remove('hidden');
        } else {
            linkEl.classList.add('hidden');
        }

        const modal = document.getElementById('project-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeProjectModal() {
        const modal = document.getElementById('project-modal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    // Modal background close
    document.getElementById('project-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeProjectModal();
        }
    });

    // Search Submit and Quick Keyword Filter
    function handlePortfolioSearchSubmit(e) {
        if (e) e.preventDefault();
        const input = document.getElementById('portfolio-search-input');
        if (!input) return;
        const val = input.value.trim();
        if (val) {
            // Scroll to grid
            const grid = document.getElementById('portfolio-grid');
            if (grid) grid.scrollIntoView({ behavior: 'smooth' });
        }
    }

    function filterBySearch(keyword) {
        const input = document.getElementById('portfolio-search-input');
        if (!input) return;
        input.value = keyword;
        input.dispatchEvent(new Event('input'));
        const grid = document.getElementById('portfolio-grid');
        if (grid) grid.scrollIntoView({ behavior: 'smooth' });
    }

    // Filtering & Searching Logic
    document.addEventListener('DOMContentLoaded', () => {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.portfolio-card');
        const searchInput = document.getElementById('portfolio-search-input');
        const emptyState = document.getElementById('portfolio-empty');

        let currentFilter = 'all';
        let searchQuery = '';

        function applyFilters() {
            let visibleCount = 0;

            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                const name = card.getAttribute('data-name');

                const matchesFilter = (currentFilter === 'all') || (category === currentFilter);
                const matchesSearch = !searchQuery || name.includes(searchQuery.toLowerCase());

                if (matchesFilter && matchesSearch) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'bg-[#8E1738]', 'text-white');
                    b.classList.add('bg-[#FFFFFF]', 'dark:bg-neutral-900', 'text-[#737780]', 'dark:text-neutral-400');
                });
                btn.classList.add('active', 'bg-[#8E1738]', 'text-white');
                btn.classList.remove('bg-[#FFFFFF]', 'dark:bg-neutral-900', 'text-[#737780]', 'dark:text-neutral-400');

                currentFilter = btn.getAttribute('data-filter');
                applyFilters();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                searchQuery = e.target.value.trim();
                applyFilters();
            });
        }
    });
</script>

<?= $this->endSection() ?>