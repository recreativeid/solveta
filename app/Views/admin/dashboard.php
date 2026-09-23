<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'SOLVETA — Developer Console') ?></title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Google Fonts: Poppins & JetBrains Mono (Identical to Next.js Developer Console) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        brand: {
                            maroon: '#8B0021',
                            darkMaroon: '#50000F',
                            accent: '#7B0B1E',
                        }
                    }
                }
            }
        };
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .tab-pane { display: none; }
        .tab-pane.active { display: block; }
        .sidebar-btn.active {
            background-color: #f3f4f6;
            color: #030712;
            font-weight: 600;
        }
        .sidebar-btn.active svg {
            color: #111827;
        }
        /* Hide scrollbars */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="min-h-screen bg-white flex flex-col md:flex-row font-sans text-left text-gray-900 antialiased">

    <!-- Toast Notification -->
    <?php if (session()->getFlashdata('success')): ?>
        <div id="toast-notif" class="fixed top-4 right-4 z-50 bg-gray-900 text-white px-3.5 py-2.5 rounded-lg shadow-lg text-xs font-medium flex items-center gap-2 border border-gray-800 transition-all duration-300">
            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400"></i>
            <span><?= session()->getFlashdata('success') ?></span>
        </div>
        <script>
            setTimeout(() => {
                const t = document.getElementById('toast-notif');
                if (t) { t.style.opacity = '0'; setTimeout(() => t.remove(), 300); }
            }, 3500);
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div id="toast-notif-err" class="fixed top-4 right-4 z-50 bg-red-900 text-white px-3.5 py-2.5 rounded-lg shadow-lg text-xs font-medium flex items-center gap-2 border border-red-800 transition-all duration-300">
            <i data-lucide="alert-circle" class="w-4 h-4 text-red-300"></i>
            <span><?= session()->getFlashdata('error') ?></span>
        </div>
        <script>
            setTimeout(() => {
                const t = document.getElementById('toast-notif-err');
                if (t) { t.style.opacity = '0'; setTimeout(() => t.remove(), 300); }
            }, 4500);
        </script>
    <?php endif; ?>

    <!-- Mobile Top Header Bar -->
    <div class="md:hidden flex items-center justify-between p-4 bg-white border-b border-gray-100 sticky top-0 z-40">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg overflow-hidden border border-gray-200 bg-white flex items-center justify-center flex-shrink-0">
                <img src="<?= esc($copy['site_logo'] ?? '/solveta-logo.png') ?>" alt="SOLVETA Logo" class="w-full h-full object-contain p-0.5">
            </div>
            <div>
                <div class="text-xs font-bold tracking-tight text-gray-900">SOLVETA</div>
                <div class="text-[10px] text-gray-400 font-normal">Developer Console</div>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="/" target="_blank" class="p-1.5 text-gray-500 hover:text-gray-900 border border-gray-200 rounded-lg text-xs" title="Buka Website">
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
            </a>
            <a href="/admin/logout" class="p-1.5 text-red-500 hover:text-red-700 border border-red-100 rounded-lg text-xs" title="Logout">
                <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
            </a>
        </div>
    </div>

    <!-- LEFT SIDEBAR (CLEAN MINIMALIST SAAS - 1:1 EXACT FROM NEXT.JS) -->
    <aside class="w-full md:w-60 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col justify-between sticky top-0 md:h-screen z-40">
        <div class="p-4 flex flex-col h-full overflow-y-auto no-scrollbar">
            <!-- Brand Header -->
            <a href="/" target="_blank" class="hidden md:flex items-center gap-2.5 pb-4 border-b border-gray-100 group" title="Buka Website SOLVETA">
                <div class="w-8 h-8 rounded-lg overflow-hidden border border-gray-200 bg-white flex items-center justify-center flex-shrink-0">
                    <img src="<?= esc($copy['site_logo'] ?? '/solveta-logo.png') ?>" alt="SOLVETA Logo" class="w-full h-full object-contain p-0.5">
                </div>
                <div>
                    <div class="text-xs font-bold tracking-tight text-gray-900 group-hover:text-black transition-colors">
                        SOLVETA
                    </div>
                    <div class="text-[10px] text-gray-400 font-normal">
                        Developer Console
                    </div>
                </div>
            </a>

            <!-- Navigation Menu (Left Sidebar) -->
            <div class="py-4 space-y-1 flex-1">
                <div class="text-[10px] font-medium tracking-wider text-gray-400 uppercase px-2 mb-2">
                    Menu
                </div>

                <!-- 1. Edit Visual -->
                <button type="button" onclick="switchTab('visual')" id="nav-btn-visual"
                        class="sidebar-btn active w-full text-left px-3 py-2 rounded-lg text-xs transition-colors flex items-center gap-2.5 cursor-pointer text-gray-500 hover:text-gray-900 hover:bg-gray-50 font-medium">
                    <i data-lucide="edit-3" class="w-3.5 h-3.5 text-gray-400"></i>
                    <span>Edit Visual</span>
                </button>

                <!-- 2. Paket & Harga -->
                <button type="button" onclick="switchTab('pricing')" id="nav-btn-pricing"
                        class="sidebar-btn w-full text-left px-3 py-2 rounded-lg text-xs transition-colors flex items-center gap-2.5 cursor-pointer text-gray-500 hover:text-gray-900 hover:bg-gray-50 font-medium">
                    <i data-lucide="tag" class="w-3.5 h-3.5 text-gray-400"></i>
                    <span>Paket &amp; Harga</span>
                </button>

                <!-- 3. Kelola HPP & Margin -->
                <button type="button" onclick="switchTab('profit')" id="nav-btn-profit"
                        class="sidebar-btn w-full text-left px-3 py-2 rounded-lg text-xs transition-colors flex items-center gap-2.5 cursor-pointer text-gray-500 hover:text-gray-900 hover:bg-gray-50 font-medium">
                    <i data-lucide="dollar-sign" class="w-3.5 h-3.5 text-gray-400"></i>
                    <span>Kelola HPP &amp; Margin</span>
                </button>

                <!-- 4. Portofolio -->
                <button type="button" onclick="switchTab('portfolio')" id="nav-btn-portfolio"
                        class="sidebar-btn w-full text-left px-3 py-2 rounded-lg text-xs transition-colors flex items-center gap-2.5 cursor-pointer text-gray-500 hover:text-gray-900 hover:bg-gray-50 font-medium">
                    <i data-lucide="image" class="w-3.5 h-3.5 text-gray-400"></i>
                    <span>Portofolio</span>
                </button>

                <!-- 5. Logo Klien -->
                <button type="button" onclick="switchTab('brands')" id="nav-btn-brands"
                        class="sidebar-btn w-full text-left px-3 py-2 rounded-lg text-xs transition-colors flex items-center gap-2.5 cursor-pointer text-gray-500 hover:text-gray-900 hover:bg-gray-50 font-medium">
                    <i data-lucide="building-2" class="w-3.5 h-3.5 text-gray-400"></i>
                    <span>Logo Klien</span>
                </button>

                <!-- 6. Kontak WA -->
                <button type="button" onclick="switchTab('contact')" id="nav-btn-contact"
                        class="sidebar-btn w-full text-left px-3 py-2 rounded-lg text-xs transition-colors flex items-center gap-2.5 cursor-pointer text-gray-500 hover:text-gray-900 hover:bg-gray-50 font-medium">
                    <i data-lucide="phone" class="w-3.5 h-3.5 text-gray-400"></i>
                    <span>Kontak WA</span>
                </button>

                <!-- 7. Video Profil -->
                <button type="button" onclick="switchTab('video')" id="nav-btn-video"
                        class="sidebar-btn w-full text-left px-3 py-2 rounded-lg text-xs transition-colors flex items-center gap-2.5 cursor-pointer text-gray-500 hover:text-gray-900 hover:bg-gray-50 font-medium">
                    <i data-lucide="film" class="w-3.5 h-3.5 text-gray-400"></i>
                    <span>Video Profil</span>
                </button>

                <!-- 8. Rekap Formulir Order -->
                <button type="button" onclick="switchTab('orders')" id="nav-btn-orders"
                        class="sidebar-btn w-full text-left px-3 py-2 rounded-lg text-xs transition-colors flex items-center justify-between cursor-pointer text-gray-500 hover:text-gray-900 hover:bg-gray-50 font-medium">
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="clipboard-list" class="w-3.5 h-3.5 text-gray-400"></i>
                        <span>Rekap Formulir Order</span>
                    </div>
                    <?php if (!empty($orders)): ?>
                        <span class="px-1.5 py-0.5 rounded-full bg-gray-900 text-white text-[9px] font-bold"><?= count($orders) ?></span>
                    <?php endif; ?>
                </button>

                <!-- 9. Pencatatan Proyek & Invoice -->
                <button type="button" onclick="switchTab('projects')" id="nav-btn-projects"
                        class="sidebar-btn w-full text-left px-3 py-2 rounded-lg text-xs transition-colors flex items-center gap-2.5 cursor-pointer text-gray-500 hover:text-gray-900 hover:bg-gray-50 font-medium">
                    <i data-lucide="receipt" class="w-3.5 h-3.5 text-gray-400"></i>
                    <span>Pencatatan Proyek &amp; Invoice</span>
                </button>

                <!-- Link to Customer Form -->
                <div class="pt-3 mt-2 border-t border-gray-100">
                    <a href="/formulir" target="_blank"
                       class="w-full text-left px-3 py-1.5 rounded-lg text-xs text-gray-400 hover:text-gray-800 hover:bg-gray-50 transition-colors flex items-center gap-2.5"
                       title="Buka Formulir Kebutuhan Customer di Tab Baru">
                        <i data-lucide="file-text" class="w-3.5 h-3.5 text-gray-400"></i>
                        <span>Buka Form Customer</span>
                    </a>
                </div>
            </div>

            <!-- Sidebar Bottom Action Buttons -->
            <div class="pt-3 border-t border-gray-100 space-y-2">
                <a href="/" target="_blank"
                   class="w-full py-2 px-3 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 hover:text-gray-900 text-xs font-medium rounded-lg transition-colors flex items-center justify-center gap-1.5">
                    <i data-lucide="eye" class="w-3.5 h-3.5 text-gray-500"></i>
                    <span>Buka Web Live</span>
                </a>

                <a href="/admin/logout"
                   class="w-full py-1.5 px-3 text-center text-xs font-medium text-red-500 hover:text-red-700 hover:bg-red-50 border border-red-100 rounded-lg transition-colors flex items-center justify-center gap-1.5">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    <span>Keluar / Logout</span>
                </a>
            </div>
        </div>
    </aside>

    <!-- RIGHT MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col min-w-0 bg-white overflow-y-auto">
        <!-- Top Header Bar (Clean Minimalist Breadcrumb & Status) -->
        <header class="sticky top-0 z-30 bg-white/95 backdrop-blur-xs border-b border-gray-100 px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-400 font-medium">Developer</span>
                <span class="text-gray-300">/</span>
                <h1 id="header-tab-title" class="text-xs font-semibold text-gray-900">
                    Edit Visual
                </h1>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-1.5 text-xs text-gray-500 font-medium">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Database Aktif (MySQL 24/7)</span>
                </div>

                <button type="button" onclick="triggerMainSave()"
                        class="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer shadow-xs">
                    <i data-lucide="save" class="w-3.5 h-3.5"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </header>

        <!-- Dynamic Main Body Content -->
        <div class="flex-grow p-4 sm:p-6 lg:p-8 max-w-5xl w-full mx-auto space-y-6">

            <!-- =========================================================================
                 MODE 1: VISUAL LIVE PREVIEW WITH CLICK-TO-EDIT (1:1 FROM NEXT.JS)
                 ========================================================================= -->
            <div id="tab-visual" class="tab-pane active space-y-6">
                <div class="bg-white border border-gray-200/80 rounded-xl overflow-hidden font-sans">
                    <div class="p-5 sm:p-8 space-y-8">
                        
                        <!-- BRAND LOGO CHANGER -->
                        <div class="p-4 bg-white rounded-xl border border-gray-200/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-12 h-12 rounded-lg overflow-hidden border border-gray-200 bg-white flex-shrink-0 flex items-center justify-center">
                                    <img src="<?= esc($copy['site_logo'] ?? '/solveta-logo.png') ?>" alt="Brand Logo" class="w-full h-full object-contain p-1" id="visual-current-logo">
                                </div>
                                <div>
                                    <h3 class="text-xs font-semibold text-gray-900">
                                        Logo Brand (Header &amp; Opening)
                                    </h3>
                                    <p class="text-[11px] text-gray-400 mt-0.5">
                                        Logo utama SOLVETA yang tampil di pojok kiri atas dan animasi pembuka.
                                    </p>
                                </div>
                            </div>

                            <form action="/admin/update-copy" method="POST" enctype="multipart/form-data" id="form-quick-logo" class="flex items-center gap-2">
                                <?= csrf_field() ?>
                                <input type="hidden" name="hero_eyebrow" value="<?= esc($copy['hero_eyebrow'] ?? '') ?>">
                                <input type="hidden" name="hero_headline" value="<?= esc($copy['hero_headline'] ?? '') ?>">
                                <input type="hidden" name="hero_subtitle" value="<?= esc($copy['hero_subtitle'] ?? '') ?>">
                                <input type="hidden" name="portfolio_title" value="<?= esc($copy['portfolio_title'] ?? '') ?>">
                                <input type="hidden" name="consultation_title" value="<?= esc($copy['consultation_title'] ?? '') ?>">
                                <input type="hidden" name="consultation_desc" value="<?= esc($copy['consultation_desc'] ?? '') ?>">
                                <input type="hidden" name="marquee_speed" value="<?= esc($copy['marquee_speed'] ?? 35) ?>">
                                <input type="hidden" name="marquee_logo_height" value="<?= esc($copy['marquee_logo_height'] ?? 46) ?>">
                                <input type="hidden" name="marquee_logo_spacing" value="<?= esc($copy['marquee_logo_spacing'] ?? 36) ?>">
                                <input type="hidden" name="marquee_logo_scale" value="<?= esc($copy['marquee_logo_scale'] ?? 100) ?>">

                                <button type="button" onclick="document.getElementById('site_logo_input_quick').click()"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white hover:bg-gray-50 border border-gray-200 text-xs font-medium text-gray-700 rounded-lg transition-colors cursor-pointer">
                                    <i data-lucide="camera" class="w-3.5 h-3.5 text-gray-400"></i>
                                    <span>Ganti Logo</span>
                                </button>
                                <input type="file" name="site_logo_file" id="site_logo_input_quick" accept="image/*" class="hidden" onchange="document.getElementById('form-quick-logo').submit()">
                            </form>
                        </div>

                        <!-- VIDEO PROFIL LAPTOP 3D MANAGER CARD -->
                        <div class="p-4 bg-white rounded-xl border border-gray-200/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-14 h-10 rounded-lg overflow-hidden border border-gray-200 bg-black flex-shrink-0 flex items-center justify-center relative">
                                    <video src="<?= esc($copy['profile_video'] ?? '/videos/profile.mp4') ?>" muted loop autoplay playsinline class="w-full h-full object-cover"></video>
                                    <div class="absolute inset-0 bg-black/20 flex items-center justify-center">
                                        <i data-lucide="play" class="w-3.5 h-3.5 text-white/90"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xs font-semibold text-gray-900">
                                        Video Profil (Layar Laptop 3D)
                                    </h3>
                                    <p class="text-[11px] text-gray-400 mt-0.5">
                                        Video hero yang diputar di dalam layar interaktif laptop 3D.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <button type="button" onclick="switchTab('video')"
                                        class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors cursor-pointer">
                                    <i data-lucide="film" class="w-3.5 h-3.5"></i>
                                    <span>Kelola Video</span>
                                </button>
                            </div>
                        </div>

                        <!-- 1. Hero Live Section (Interactive Click-to-Edit Landing Page Preview) -->
                        <div class="text-center relative group p-6 rounded-2xl border border-dashed border-gray-200 hover:border-[#7B0B1E]/40 transition-colors">
                            <span class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 text-[10px] font-semibold text-[#7B0B1E] bg-rose-50 px-2 py-0.5 rounded transition-opacity">
                                Klik untuk edit Hero
                            </span>

                            <div onclick="openEditHeroModal()" class="cursor-pointer inline-block font-mono text-[11px] font-semibold uppercase tracking-wider text-gray-700 bg-white border border-gray-200 px-3.5 py-1 rounded-full mb-4 hover:border-[#7B0B1E]">
                                <?= esc($copy['hero_eyebrow'] ?? 'SOLVE TECHNOLOGY AGENCY') ?>
                            </div>

                            <div onclick="openEditHeroModal()" class="cursor-pointer hover:bg-rose-50/50 p-2 rounded-lg transition-colors max-w-3xl mx-auto mb-3">
                                <h1 class="text-2xl sm:text-4xl font-extrabold text-gray-950 tracking-tight leading-tight">
                                    <?= esc($copy['hero_headline'] ?? 'Mengubah Tantangan Bisnis Menjadi Solusi Digital.') ?>
                                </h1>
                            </div>

                            <div onclick="openEditHeroModal()" class="cursor-pointer hover:bg-rose-50/50 p-2 rounded-lg transition-colors max-w-2xl mx-auto">
                                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                                    <?= esc($copy['hero_subtitle'] ?? 'Banyak bisnis terhambat oleh proses manual, informasi yang tidak terstruktur, dan kurangnya integrasi. SOLVETA hadir untuk menyederhanakan masalah kompleks melalui solusi digital dan otomasi yang efisien.') ?>
                                </p>
                            </div>
                        </div>

                        <!-- 2. Marquee Live Section -->
                        <div class="p-6 bg-gray-50/70 rounded-2xl border border-gray-200">
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-4">
                                <div>
                                    <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider">
                                        Kecepatan Logo Berjalan (Marquee)
                                    </h3>
                                    <p class="text-[11px] text-gray-500">
                                        Geser slider untuk mempercepat atau memperlambat logo klien.
                                    </p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span id="visual-speed-display" class="text-xs font-mono font-bold text-[#7B0B1E] bg-white border border-gray-200 px-2.5 py-1 rounded-lg">
                                        <?= esc($copy['marquee_speed'] ?? 35) ?> detik / putaran
                                    </span>
                                    <button type="button" onclick="switchTab('brands')"
                                            class="text-xs font-semibold text-[#7B0B1E] hover:underline cursor-pointer">
                                        Kelola Logo Klien (<?= count($brands) ?>) &rarr;
                                    </button>
                                </div>
                            </div>
                            <form action="/admin/update-copy" method="POST" id="form-quick-speed">
                                <?= csrf_field() ?>
                                <input type="hidden" name="hero_eyebrow" value="<?= esc($copy['hero_eyebrow'] ?? '') ?>">
                                <input type="hidden" name="hero_headline" value="<?= esc($copy['hero_headline'] ?? '') ?>">
                                <input type="hidden" name="hero_subtitle" value="<?= esc($copy['hero_subtitle'] ?? '') ?>">
                                <input type="hidden" name="portfolio_title" value="<?= esc($copy['portfolio_title'] ?? '') ?>">
                                <input type="hidden" name="consultation_title" value="<?= esc($copy['consultation_title'] ?? '') ?>">
                                <input type="hidden" name="consultation_desc" value="<?= esc($copy['consultation_desc'] ?? '') ?>">
                                <input type="hidden" name="marquee_logo_height" value="<?= esc($copy['marquee_logo_height'] ?? 46) ?>">
                                <input type="hidden" name="marquee_logo_spacing" value="<?= esc($copy['marquee_logo_spacing'] ?? 36) ?>">
                                <input type="hidden" name="marquee_logo_scale" value="<?= esc($copy['marquee_logo_scale'] ?? 100) ?>">

                                <div class="flex items-center gap-3">
                                    <span class="text-[11px] text-gray-500 font-medium">Cepat (15s)</span>
                                    <input type="range" name="marquee_speed" min="15" max="60" step="5"
                                           value="<?= esc($copy['marquee_speed'] ?? 35) ?>"
                                           oninput="document.getElementById('visual-speed-display').innerText = this.value + ' detik / putaran'"
                                           onchange="document.getElementById('form-quick-speed').submit()"
                                           class="flex-grow accent-[#7B0B1E] cursor-pointer">
                                    <span class="text-[11px] text-gray-500 font-medium">Lambat (60s)</span>
                                </div>
                            </form>
                        </div>

                        <!-- 3. Portfolio Live Section Header -->
                        <div class="text-center relative group p-6 rounded-2xl border border-dashed border-gray-200 hover:border-[#7B0B1E]/40 transition-colors">
                            <span class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 text-[10px] font-semibold text-[#7B0B1E] bg-rose-50 px-2 py-0.5 rounded transition-opacity">
                                Klik untuk edit Judul Portofolio
                            </span>

                            <div onclick="openEditPortfolioTitleModal()" class="cursor-pointer hover:bg-rose-50/50 p-2 rounded-lg transition-colors max-w-xl mx-auto">
                                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-950 tracking-tight">
                                    <?= esc($copy['portfolio_title'] ?? 'Portofolio Proyek Website Yang Telah Kami Bangun') ?>
                                </h2>
                            </div>

                            <div class="mt-4 flex items-center justify-center gap-2">
                                <button type="button" onclick="switchTab('portfolio')"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#7B0B1E] bg-white border border-rose-200 hover:bg-rose-50 px-3.5 py-1.5 rounded-full transition-colors cursor-pointer">
                                    <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                                    <span>Upload, Edit &amp; Kelola Portofolio (<?= count($portfolios) ?> Karya)</span>
                                </button>
                            </div>
                        </div>

                        <!-- 4. Pricing Live Section -->
                        <div>
                            <div class="text-center mb-6">
                                <h2 class="text-base font-bold uppercase tracking-wider text-gray-900 mb-1">
                                    PILIH SOLUSI SESUAI KEBUTUHAN
                                </h2>
                                <p class="text-xs text-gray-500">
                                    Klik kartu mana saja untuk mengubah harga, perpanjangan, checklist fitur, add-on, atau pesan WA secara instan.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <?php foreach ($tiers as $tier): ?>
                                    <div onclick="openEditPricingModal(<?= htmlspecialchars(json_encode($tier), ENT_QUOTES, 'UTF-8') ?>)"
                                         class="p-5 rounded-xl border bg-white cursor-pointer hover:border-[#7B0B1E] hover:shadow-md transition-all relative group <?= !empty($tier['popular']) ? 'border-2 border-[#8B0021]' : 'border-gray-200' ?>">
                                        
                                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 bg-rose-50 text-[#7B0B1E] p-1 rounded transition-opacity">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </div>

                                        <?php if (!empty($tier['popular'])): ?>
                                            <span class="absolute -top-2.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] text-white font-mono text-[9px] font-bold uppercase px-2.5 py-0.5 rounded-full">
                                                POPULAR
                                            </span>
                                        <?php endif; ?>

                                        <div class="text-xs font-bold text-gray-800 uppercase mb-1">
                                            <?= esc($tier['name']) ?>
                                        </div>
                                        <div class="text-xl font-extrabold text-gray-950 mb-2">
                                            <?= esc($tier['price']) ?>
                                        </div>

                                        <div class="text-[11px] text-gray-600 bg-gray-50 p-2 rounded mb-3 border border-gray-100">
                                            <div>⏳ Masa aktif: <strong><?= esc($tier['active_period'] ?? '1 Tahun') ?></strong></div>
                                            <div>Perpanjangan: <strong><?= esc($tier['renewal_price'] ?? '249k/th') ?></strong></div>
                                        </div>

                                        <div class="text-[10px] text-gray-500 border-t pt-2">
                                            <strong>Cocok:</strong> <?= esc($tier['suitability'] ?? 'Bisnis berkembang') ?>
                                        </div>

                                        <div class="mt-3 pt-2 border-t border-gray-100 flex items-center justify-between text-[11px] text-[#8B0021] font-semibold">
                                            <span>Edit Rincian &amp; Fitur</span>
                                            <span>&rarr;</span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 5. Cloud Database Status & Sync Card -->
                        <div class="bg-white border-2 border-dashed border-gray-200 rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="space-y-1.5 text-left">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider">
                                        Database Cloud MySQL Production (Online 24/7)
                                    </h3>
                                </div>
                                <p class="text-xs text-gray-500 max-w-xl">
                                    Data portofolio, logo, teks, dan harga tersimpan di database MySQL server cloud sehingga selalu hidup 24 jam nonstop tanpa bergantung pada laptop atau server lokal.
                                </p>
                            </div>

                            <button type="button" onclick="triggerMainSave()"
                                    class="px-5 py-2.5 bg-gray-900 hover:bg-black text-white text-xs font-semibold rounded-xl shadow-xs transition-all flex-shrink-0 cursor-pointer">
                                Simpan &amp; Sinkronkan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================================
                 MODE 2: PAKET & HARGA (DEDICATED SECTION)
                 ========================================================================= -->
            <div id="tab-pricing" class="tab-pane space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Manajemen 4 Paket Harga</h2>
                        <p class="text-[11px] text-gray-400">Kelola spesifikasi, harga baru, checklist fitur, addon layanan & pesan template WhatsApp.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($tiers as $tier): ?>
                        <div class="bg-white border border-gray-200/80 rounded-xl p-5 flex flex-col justify-between space-y-4 hover:border-gray-300 transition-colors">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-gray-900 uppercase"><?= esc($tier['name']) ?></span>
                                        <?php if (!empty($tier['popular'])): ?>
                                            <span class="text-[9px] px-2 py-0.5 rounded-full bg-red-50 text-red-600 font-bold border border-red-100">POPULAR</span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-xs font-bold font-mono text-gray-900"><?= esc($tier['price']) ?></span>
                                </div>

                                <p class="text-[11px] text-gray-500 leading-relaxed">
                                    <?= esc($tier['suitability'] ?? 'Solusi website profesional.') ?>
                                </p>

                                <div class="pt-2 border-t border-gray-100 space-y-1">
                                    <div class="text-[10px] font-medium text-gray-400 uppercase">Fitur Termasuk:</div>
                                    <?php 
                                        $feats = is_array($tier['features']) ? $tier['features'] : json_decode($tier['features_json'] ?? '[]', true);
                                        if (!empty($feats)):
                                            foreach (array_slice($feats, 0, 4) as $f):
                                    ?>
                                        <div class="text-[11px] text-gray-600 flex items-center gap-1.5">
                                            <i data-lucide="check" class="w-3 h-3 text-emerald-500 shrink-0"></i>
                                            <span class="truncate"><?= esc($f) ?></span>
                                        </div>
                                    <?php 
                                            endforeach;
                                            if (count($feats) > 4):
                                                echo "<div class='text-[10px] text-gray-400'>+" . (count($feats) - 4) . " fitur lainnya...</div>";
                                            endif;
                                        endif; 
                                    ?>
                                </div>
                            </div>

                            <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-[10px] text-gray-400 font-mono">Perpanjangan: <?= esc($tier['renewal_price'] ?? '-') ?></span>
                                <button type="button" onclick="openEditPricingModal(<?= htmlspecialchars(json_encode($tier), ENT_QUOTES, 'UTF-8') ?>)"
                                        class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-800 text-[11px] font-medium rounded-lg transition-colors flex items-center gap-1 cursor-pointer">
                                    <i data-lucide="edit" class="w-3 h-3"></i>
                                    <span>Edit Paket</span>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- =========================================================================
                 MODE 3: KELOLA HPP & MARGIN (PROFIT & LOSS MANAGER - 1:1 REPLICATION)
                 ========================================================================= -->
            <div id="tab-profit" class="tab-pane space-y-6">
                <!-- Summary Metrics Banner (4 KPI Cards) -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <?php
                        $totOmset = 0;
                        $totHpp = 0;
                        $totLaba = 0;
                        foreach ($profits as $p) {
                            $sp = (int)($p['selling_price'] ?? 0);
                            $ords = (int)($p['estimated_monthly_orders'] ?? 1);
                            $costs = is_array($p['costs']) ? $p['costs'] : json_decode($p['costs_json'] ?? '[]', true);
                            $costSum = 0;
                            foreach ($costs as $c) { $costSum += (int)($c['amount'] ?? 0); }
                            $totOmset += ($sp * $ords);
                            $totHpp += ($costSum * $ords);
                        }
                        $totLaba = $totOmset - $totHpp;
                        $avgMargin = $totOmset > 0 ? round(($totLaba / $totOmset) * 100, 1) : 0;
                    ?>
                    <div class="p-4 bg-white rounded-xl border border-gray-200/80">
                        <div class="text-[10px] text-gray-400 font-medium uppercase">Proyeksi Omset / Bln</div>
                        <div class="text-sm font-bold font-mono text-gray-900 mt-1">Rp <?= number_format($totOmset, 0, ',', '.') ?></div>
                    </div>
                    <div class="p-4 bg-white rounded-xl border border-gray-200/80">
                        <div class="text-[10px] text-gray-400 font-medium uppercase">Total Beban HPP / Bln</div>
                        <div class="text-sm font-bold font-mono text-gray-600 mt-1">Rp <?= number_format($totHpp, 0, ',', '.') ?></div>
                    </div>
                    <div class="p-4 bg-white rounded-xl border border-gray-200/80">
                        <div class="text-[10px] text-emerald-600 font-medium uppercase">Laba Bersih / Bln</div>
                        <div class="text-sm font-bold font-mono text-emerald-600 mt-1">Rp <?= number_format($totLaba, 0, ',', '.') ?></div>
                    </div>
                    <div class="p-4 bg-white rounded-xl border border-gray-200/80">
                        <div class="text-[10px] text-gray-400 font-medium uppercase">Rata-rata Margin</div>
                        <div class="text-sm font-bold font-mono text-gray-900 mt-1"><?= $avgMargin ?>%</div>
                    </div>
                </div>

                <!-- Analysis Cards -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Rincian Komponen Biaya HPP Per Layanan</h2>
                            <p class="text-[11px] text-gray-400">Analisis beban domain, server/CDN, lisensi tools, fee tenaga kerja, dan margin laba bersih.</p>
                        </div>
                        <button type="button" onclick="exportProfitCSV()" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg flex items-center gap-1.5 transition-colors cursor-pointer">
                            <i data-lucide="download" class="w-3.5 h-3.5"></i>
                            <span>Ekspor CSV</span>
                        </button>
                    </div>

                    <?php foreach ($profits as $prof): ?>
                        <?php
                            $sp = (int)($prof['selling_price'] ?? 0);
                            $ords = (int)($prof['estimated_monthly_orders'] ?? 1);
                            $costs = is_array($prof['costs']) ? $prof['costs'] : json_decode($prof['costs_json'] ?? '[]', true);
                            $costSum = 0;
                            foreach ($costs as $c) { $costSum += (int)($c['amount'] ?? 0); }
                            $unitProfit = $sp - $costSum;
                            $marginPct = $sp > 0 ? round(($unitProfit / $sp) * 100, 1) : 0;
                            $monthlyNet = $unitProfit * $ords;
                        ?>
                        <div class="bg-white border border-gray-200/80 rounded-xl p-5 space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-gray-100 gap-2">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-xs font-bold text-gray-900"><?= esc($prof['service_name']) ?></h3>
                                        <span class="text-[10px] px-2 py-0.5 rounded bg-gray-100 font-mono text-gray-600">Harga: Rp <?= number_format($sp, 0, ',', '.') ?></span>
                                    </div>
                                    <p class="text-[11px] text-gray-400 mt-0.5"><?= esc($prof['notes'] ?? '-') ?></p>
                                </div>

                                <div class="flex items-center gap-4 text-xs font-mono">
                                    <div>
                                        <span class="text-[10px] text-gray-400 block font-sans">Laba/Unit:</span>
                                        <span class="font-bold text-emerald-600">Rp <?= number_format($unitProfit, 0, ',', '.') ?> (<?= $marginPct ?>%)</span>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-gray-400 block font-sans">Omset/Bln (<?= $ords ?>x):</span>
                                        <span class="font-bold text-gray-900">Rp <?= number_format($monthlyNet, 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Cost Items Table -->
                            <div class="overflow-x-auto">
                                <table class="w-full text-[11px] text-left">
                                    <thead class="bg-gray-50 text-gray-400 uppercase text-[9px]">
                                        <tr>
                                            <th class="px-3 py-1.5 rounded-l-md font-medium">Komponen Beban</th>
                                            <th class="px-3 py-1.5 font-medium">Kategori</th>
                                            <th class="px-3 py-1.5 text-right rounded-r-md font-medium">Biaya (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        <?php foreach ($costs as $c): ?>
                                            <tr>
                                                <td class="px-3 py-2 text-gray-700 font-medium"><?= esc($c['name'] ?? '-') ?></td>
                                                <td class="px-3 py-2 text-gray-400"><?= esc(ucwords(str_replace('_', ' ', $c['category'] ?? '-'))) ?></td>
                                                <td class="px-3 py-2 text-right font-mono text-gray-800">Rp <?= number_format((int)($c['amount'] ?? 0), 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="border-t border-gray-100 font-bold">
                                        <tr>
                                            <td colspan="2" class="px-3 py-2 text-gray-600">Total HPP per Unit</td>
                                            <td class="px-3 py-2 text-right font-mono text-gray-900">Rp <?= number_format($costSum, 0, ',', '.') ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- =========================================================================
                 MODE 4: PORTOFOLIO (1:1 REPLICATION)
                 ========================================================================= -->
            <div id="tab-portfolio" class="tab-pane space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Portofolio Karya Digital (<?= count($portfolios) ?>)</h2>
                        <p class="text-[11px] text-gray-400">Tampil dalam Carousel 3D Coverflow interaktif pada halaman utama.</p>
                    </div>
                    <button type="button" onclick="openAddPortfolioModal()" class="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                        <span>Tambah Proyek</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <?php foreach ($portfolios as $port): ?>
                        <div class="bg-white border border-gray-200/80 rounded-xl overflow-hidden flex flex-col justify-between hover:border-gray-300 transition-colors group">
                            <div>
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden relative border-b border-gray-100">
                                    <img src="<?= esc($port['image_url']) ?>" alt="<?= esc($port['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded bg-black/70 backdrop-blur-xs text-white text-[9px] font-medium">
                                        <?= esc($port['category'] ?? 'Website') ?>
                                    </span>
                                </div>
                                <div class="p-4 space-y-1.5">
                                    <h3 class="text-xs font-bold text-gray-900 truncate"><?= esc($port['title']) ?></h3>
                                    <p class="text-[11px] text-gray-500 line-clamp-2 leading-relaxed"><?= esc($port['description']) ?></p>
                                    <?php if (!empty($port['live_url'])): ?>
                                        <a href="<?= esc($port['live_url']) ?>" target="_blank" class="inline-flex items-center gap-1 text-[10px] text-blue-600 hover:underline pt-1">
                                            <i data-lucide="external-link" class="w-3 h-3"></i>
                                            <span><?= esc($port['live_url']) ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="p-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-[10px] font-mono text-gray-400">Urutan: <?= esc($port['sort_order']) ?></span>
                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="openEditPortfolioModal(<?= htmlspecialchars(json_encode($port), ENT_QUOTES, 'UTF-8') ?>)"
                                            class="text-gray-500 hover:text-gray-900 text-xs p-1 cursor-pointer" title="Edit">
                                        <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                                    </button>
                                    <form action="/admin/portfolio/delete/<?= esc($port['id']) ?>" method="POST" onsubmit="return confirm('Hapus portofolio ini?');" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="text-red-400 hover:text-red-600 text-xs p-1 cursor-pointer" title="Hapus">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- =========================================================================
                 MODE 5: LOGO KLIEN (1:1 REPLICATION FROM NEXT.JS MODE_BRANDS)
                 ========================================================================= -->
            <div id="tab-brands" class="tab-pane space-y-6">
                <!-- 1. MARQUEE DISPLAY & SIZE CUSTOMIZATION SETTINGS -->
                <form action="/admin/update-copy" method="POST" id="form-brands-size" class="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 space-y-5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="hero_eyebrow" value="<?= esc($copy['hero_eyebrow'] ?? '') ?>">
                    <input type="hidden" name="hero_headline" value="<?= esc($copy['hero_headline'] ?? '') ?>">
                    <input type="hidden" name="hero_subtitle" value="<?= esc($copy['hero_subtitle'] ?? '') ?>">
                    <input type="hidden" name="portfolio_title" value="<?= esc($copy['portfolio_title'] ?? '') ?>">
                    <input type="hidden" name="consultation_title" value="<?= esc($copy['consultation_title'] ?? '') ?>">
                    <input type="hidden" name="consultation_desc" value="<?= esc($copy['consultation_desc'] ?? '') ?>">

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100 pb-4">
                        <div>
                            <h2 class="text-sm sm:text-base font-semibold text-gray-900">
                                Kustomisasi Ukuran Logo Klien (Marquee)
                            </h2>
                            <p class="text-xs text-gray-400 mt-0.5">
                                Atur tinggi, jarak, dan skala logo klien yang berjalan di landing page.
                            </p>
                        </div>
                        <button type="submit"
                                class="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center justify-center gap-1.5 cursor-pointer flex-shrink-0">
                            <i data-lucide="save" class="w-3.5 h-3.5"></i>
                            <span>Simpan Ukuran</span>
                        </button>
                    </div>

                    <!-- A. TOMBOL CEPAT PILIHAN UKURAN LOGO -->
                    <div class="p-3.5 bg-gray-50/80 rounded-xl border border-gray-200/80 space-y-2.5">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span class="text-xs font-medium text-gray-700">
                                Pilihan Ukuran Cepat
                            </span>
                            <div class="flex items-center gap-1.5">
                                <button type="button" onclick="adjustLogoHeight(-5)"
                                        class="px-2.5 py-1 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors cursor-pointer">
                                    -5px
                                </button>
                                <button type="button" onclick="adjustLogoHeight(5)"
                                        class="px-2.5 py-1 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors cursor-pointer">
                                    +5px
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2">
                            <button type="button" onclick="setPresetSize(45, 100)"
                                    id="preset-btn-45"
                                    class="preset-btn py-1.5 px-3 rounded-lg border text-xs font-medium transition-colors text-center cursor-pointer <?= ($copy['marquee_logo_height'] ?? 46) <= 48 ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' ?>">
                                Kecil (45px)
                            </button>

                            <button type="button" onclick="setPresetSize(60, 100)"
                                    id="preset-btn-60"
                                    class="preset-btn py-1.5 px-3 rounded-lg border text-xs font-medium transition-colors text-center cursor-pointer <?= (($copy['marquee_logo_height'] ?? 46) > 48 && ($copy['marquee_logo_height'] ?? 46) <= 68) ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' ?>">
                                Sedang (60px)
                            </button>

                            <button type="button" onclick="setPresetSize(78, 115)"
                                    id="preset-btn-78"
                                    class="preset-btn py-1.5 px-3 rounded-lg border text-xs font-medium transition-colors text-center cursor-pointer <?= (($copy['marquee_logo_height'] ?? 46) > 68 && ($copy['marquee_logo_height'] ?? 46) <= 85) ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' ?>">
                                Besar (78px)
                            </button>

                            <button type="button" onclick="setPresetSize(98, 130)"
                                    id="preset-btn-98"
                                    class="preset-btn py-1.5 px-3 rounded-lg border text-xs font-medium transition-colors text-center cursor-pointer <?= (($copy['marquee_logo_height'] ?? 46) > 85 && ($copy['marquee_logo_height'] ?? 46) <= 108) ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' ?>">
                                Ekstra (98px)
                            </button>

                            <button type="button" onclick="setPresetSize(125, 150)"
                                    id="preset-btn-125"
                                    class="preset-btn py-1.5 px-3 rounded-lg border text-xs font-medium transition-colors text-center cursor-pointer <?= ($copy['marquee_logo_height'] ?? 46) > 108 ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' ?>">
                                Maksimal (125px)
                            </button>
                        </div>
                    </div>

                    <!-- B. 4 SLIDER DETAIL KONTROL -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- 1. Slider Tinggi Logo -->
                        <div class="p-4 bg-gray-50/90 rounded-xl border border-gray-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-bold text-gray-900">
                                    📏 Tinggi Logo
                                </label>
                                <span id="brand-badge-height" class="text-xs font-mono font-bold text-[#8B0021] bg-rose-50 px-2.5 py-0.5 rounded-md border border-rose-200">
                                    <?= esc($copy['marquee_logo_height'] ?? 46) ?>px
                                </span>
                            </div>
                            <input type="range" name="marquee_logo_height" id="range-logo-height"
                                   min="28" max="150" step="2"
                                   value="<?= esc($copy['marquee_logo_height'] ?? 46) ?>"
                                   oninput="updateMarqueeLiveSettings()"
                                   class="w-full accent-[#8B0021] h-2 bg-gray-200 rounded-lg cursor-pointer">
                            <div class="flex justify-between text-[10px] text-gray-400 font-mono">
                                <span>28px (Mini)</span>
                                <span>75px (Besar)</span>
                                <span>150px (Maks)</span>
                            </div>
                        </div>

                        <!-- 2. Slider Skala / Pembesaran Logo Global -->
                        <div class="p-4 bg-gray-50/90 rounded-xl border border-gray-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-bold text-gray-900">
                                    🔍 Skala Pembesaran
                                </label>
                                <span id="brand-badge-scale" class="text-xs font-mono font-bold text-[#8B0021] bg-rose-50 px-2.5 py-0.5 rounded-md border border-rose-200">
                                    <?= esc($copy['marquee_logo_scale'] ?? 100) ?>%
                                </span>
                            </div>
                            <input type="range" name="marquee_logo_scale" id="range-logo-scale"
                                   min="50" max="250" step="5"
                                   value="<?= esc($copy['marquee_logo_scale'] ?? 100) ?>"
                                   oninput="updateMarqueeLiveSettings()"
                                   class="w-full accent-[#8B0021] h-2 bg-gray-200 rounded-lg cursor-pointer">
                            <div class="flex justify-between text-[10px] text-gray-400 font-mono">
                                <span>50%</span>
                                <span>100% (Normal)</span>
                                <span>250% (Zoom 2.5x)</span>
                            </div>
                        </div>

                        <!-- 3. Slider Jarak / Spacing Antar Logo -->
                        <div class="p-4 bg-gray-50/90 rounded-xl border border-gray-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-bold text-gray-900">
                                    ↔️ Jarak Antar Logo
                                </label>
                                <span id="brand-badge-spacing" class="text-xs font-mono font-bold text-[#8B0021] bg-rose-50 px-2.5 py-0.5 rounded-md border border-rose-200">
                                    <?= esc($copy['marquee_logo_spacing'] ?? 36) ?>px
                                </span>
                            </div>
                            <input type="range" name="marquee_logo_spacing" id="range-logo-spacing"
                                   min="10" max="90" step="2"
                                   value="<?= esc($copy['marquee_logo_spacing'] ?? 36) ?>"
                                   oninput="updateMarqueeLiveSettings()"
                                   class="w-full accent-[#8B0021] h-2 bg-gray-200 rounded-lg cursor-pointer">
                            <div class="flex justify-between text-[10px] text-gray-400 font-mono">
                                <span>10px (Rapat)</span>
                                <span>40px (Ideal)</span>
                                <span>90px (Renggang)</span>
                            </div>
                        </div>

                        <!-- 4. Slider Kecepatan Marquee -->
                        <div class="p-4 bg-gray-50/90 rounded-xl border border-gray-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-bold text-gray-900">
                                    ⚡ Kecepatan Berjalan
                                </label>
                                <span id="brand-badge-speed" class="text-xs font-mono font-bold text-[#8B0021] bg-rose-50 px-2.5 py-0.5 rounded-md border border-rose-200">
                                    <?= esc($copy['marquee_speed'] ?? 35) ?>s
                                </span>
                            </div>
                            <input type="range" name="marquee_speed" id="range-logo-speed"
                                   min="12" max="65" step="3"
                                   value="<?= esc($copy['marquee_speed'] ?? 35) ?>"
                                   oninput="updateMarqueeLiveSettings()"
                                   class="w-full accent-[#8B0021] h-2 bg-gray-200 rounded-lg cursor-pointer">
                            <div class="flex justify-between text-[10px] text-gray-400 font-mono">
                                <span>12s (Cepat)</span>
                                <span>35s (Sedang)</span>
                                <span>65s (Pelan)</span>
                            </div>
                        </div>
                    </div>

                    <!-- C. LIVE PREVIEW STRIP (SIMULASI LANGSUNG REAL-TIME) -->
                    <div class="p-4 bg-gray-900 text-white rounded-xl space-y-2 border border-gray-800">
                        <div class="flex items-center justify-between text-xs text-gray-400">
                            <span class="font-bold text-white flex items-center gap-1.5">
                                <span>📺 Pratinjau Langsung (Live Visual):</span>
                                <span class="text-[10px] font-mono text-emerald-400">● Real-time</span>
                            </span>
                            <span class="font-mono text-[11px] text-gray-300">
                                Tinggi: <strong id="preview-calc-height" class="text-white"><?= round(($copy['marquee_logo_height'] ?? 46) * (($copy['marquee_logo_scale'] ?? 100) / 100)) ?>px</strong> | Spasi: <strong id="preview-calc-spacing" class="text-white"><?= esc($copy['marquee_logo_spacing'] ?? 36) ?>px</strong>
                            </span>
                        </div>
                        <div id="live-marquee-strip" class="overflow-x-auto py-4 px-2 bg-white rounded-lg flex items-center justify-center gap-6 min-h-[90px]">
                            <?php foreach (array_slice($brands, 0, 5) as $b): ?>
                                <div class="live-brand-item flex items-center justify-center flex-shrink-0"
                                     style="padding-left: <?= round(($copy['marquee_logo_spacing'] ?? 36) / 2) ?>px; padding-right: <?= round(($copy['marquee_logo_spacing'] ?? 36) / 2) ?>px;">
                                    <?php if (!empty($b['logo_image'])): ?>
                                        <img src="<?= esc($b['logo_image']) ?>" alt="<?= esc($b['name'] ?? 'Logo') ?>"
                                             style="height: <?= max(28, round(($copy['marquee_logo_height'] ?? 46) * (($copy['marquee_logo_scale'] ?? 100) / 100) * ($b['scale'] ?? 1.0))) ?>px; max-height: <?= round(($copy['marquee_logo_height'] ?? 46) * (($copy['marquee_logo_scale'] ?? 100) / 100) * 1.45) ?>px; max-width: 280px;"
                                             class="w-auto object-contain filter grayscale opacity-90 contrast-125 transition-all">
                                    <?php else: ?>
                                        <span class="text-xs font-black text-gray-800"><?= esc($b['name'] ?? 'Brand') ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </form>

                <!-- 2. ADD NEW LOGO FORM -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
                    <h2 class="text-sm font-bold text-gray-900 mb-1 flex items-center gap-2">
                        <i data-lucide="building-2" class="w-4 h-4 text-[#7B0B1E]"></i>
                        <span>Tambah Logo / Nama Klien Baru (Marquee)</span>
                    </h2>
                    <p class="text-xs text-gray-500 mb-5">
                        Tambahkan nama brand atau upload logo ikon bisnis untuk tampil di baris marquee yang berjalan.
                    </p>

                    <form action="/admin/brand/save" method="POST" enctype="multipart/form-data" class="space-y-4">
                        <?= csrf_field() ?>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">
                                Upload File Logo Gambar (Format PNG Transparan / SVG direkomendasikan)
                            </label>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="document.getElementById('new-brand-logo-file').click()"
                                        class="w-full py-2.5 px-3 border border-dashed border-gray-300 rounded-lg hover:border-[#7B0B1E] bg-gray-50/50 hover:bg-rose-50/30 text-xs font-medium text-gray-600 hover:text-[#7B0B1E] flex items-center justify-center gap-2 transition-all cursor-pointer">
                                    <i data-lucide="upload" class="w-4 h-4"></i>
                                    <span id="new-brand-upload-text">Upload Ikon Logo Brand dari Laptop</span>
                                </button>
                                <input type="file" name="logo_file" id="new-brand-logo-file" accept="image/*" class="hidden"
                                       onchange="if(this.files[0]) { document.getElementById('new-brand-upload-text').innerText = '✓ ' + this.files[0].name; }">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-800 mb-1.5">
                                    Nama Brand / Klien <span class="text-gray-400 font-normal">(Opsional)</span>
                                </label>
                                <input type="text" name="name" placeholder="Kosongkan jika hanya ingin menampilkan logo saja"
                                       class="w-full text-sm font-bold text-gray-950 placeholder:text-gray-400 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] focus:ring-2 focus:ring-[#7B0B1E]/10 outline-none bg-white shadow-xs">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-800 mb-1.5">
                                    Sektor / Label Bisnis <span class="text-gray-400 font-normal">(Opsional)</span>
                                </label>
                                <input type="text" name="label" placeholder="Contoh: Supply Chain & Tracking"
                                       class="w-full text-sm font-bold text-gray-950 placeholder:text-gray-400 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] focus:ring-2 focus:ring-[#7B0B1E]/10 outline-none bg-white shadow-xs">
                            </div>
                        </div>

                        <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white text-xs font-bold rounded-xl transition-all shadow-xs cursor-pointer flex items-center gap-2">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Tambahkan ke Marquee</span>
                        </button>
                    </form>
                </div>

                <!-- 3. LIST BRANDS (4-COLUMN GRID FROM NEXT.JS) -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
                    <h2 class="text-sm font-bold text-gray-900 mb-4">
                        Daftar Brand di Marquee (<?= count($brands) ?> Klien)
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        <?php foreach ($brands as $brand): ?>
                            <div class="p-3 border border-gray-200 rounded-xl bg-white hover:border-gray-300 flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <?php if (!empty($brand['logo_image'])): ?>
                                        <img src="<?= esc($brand['logo_image']) ?>" alt="<?= esc($brand['name'] ?? 'Brand') ?>"
                                             class="h-7 w-auto max-w-[80px] object-contain rounded filter grayscale flex-shrink-0">
                                    <?php else: ?>
                                        <div class="w-7 h-7 rounded bg-rose-50 text-[#7B0B1E] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                            <?= esc(substr($brand['name'] ?? 'B', 0, 1)) ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="min-w-0">
                                        <div class="text-xs font-bold text-gray-900 truncate">
                                            <?= esc($brand['name'] ?: 'Logo Murni') ?>
                                        </div>
                                        <?php if (!empty($brand['label'])): ?>
                                            <div class="text-[10px] text-gray-400 truncate">
                                                <?= esc($brand['label']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="flex items-center gap-1 flex-shrink-0">
                                    <button type="button" onclick="openEditBrandModal(<?= htmlspecialchars(json_encode($brand), ENT_QUOTES, 'UTF-8') ?>)"
                                            class="p-1.5 text-gray-500 hover:text-[#8B0021] hover:bg-rose-50 rounded-lg transition-colors cursor-pointer"
                                            title="Edit Logo & Data Brand">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                    </button>
                                    <form action="/admin/brand/delete/<?= esc($brand['id']) ?>" method="POST" onsubmit="return confirm('Hapus logo ini dari marquee?');" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" title="Hapus">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- =========================================================================
                 MODE 6: KONTAK WHATSAPP & MEDIA SOSIAL
                 ========================================================================= -->
            <div id="tab-contact" class="tab-pane space-y-6">
                <form action="/admin/update-contact" method="POST" class="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 space-y-4">
                    <?= csrf_field() ?>
                    <div class="border-b border-gray-100 pb-3">
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Integrasi Kontak WhatsApp &amp; Media Sosial</h2>
                        <p class="text-[11px] text-gray-400">Semua tombol pemesanan paket, formulir konsultasi, dan footer terhubung langsung ke nomor ini.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-medium text-gray-600 mb-1">Nomor WhatsApp API (Format Internasional)</label>
                            <input type="text" name="whatsapp_number" value="<?= esc($contact['whatsapp_number'] ?? '6285876603826') ?>" placeholder="6285876603826"
                                   class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900 font-mono">
                            <span class="text-[10px] text-gray-400">Gunakan angka saja tanpa tanda +, contoh: 6285876603826</span>
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium text-gray-600 mb-1">Tampilan Nomor WhatsApp (Display)</label>
                            <input type="text" name="whatsapp_display" value="<?= esc($contact['whatsapp_display'] ?? '+62 858-7660-3826') ?>" placeholder="+62 858-7660-3826"
                                   class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900 font-mono">
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium text-gray-600 mb-1">Akun Instagram</label>
                            <div class="flex items-center">
                                <span class="px-2.5 py-2 bg-gray-100 border border-r-0 border-gray-200 rounded-l-lg text-xs text-gray-500">@</span>
                                <input type="text" name="instagram" value="<?= esc($contact['instagram'] ?? 'solveta.asia') ?>" placeholder="solveta.asia"
                                       class="w-full text-xs px-3 py-2 rounded-r-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium text-gray-600 mb-1">Email Resmi</label>
                            <input type="email" name="email" value="<?= esc($contact['email'] ?? 'halo@solveta.asia') ?>" placeholder="halo@solveta.asia"
                                   class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-medium text-gray-600 mb-1">Website URL Resmi</label>
                            <input type="url" name="website_url" value="<?= esc($contact['website_url'] ?? 'https://solveta.asia') ?>" placeholder="https://solveta.asia"
                                   class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <a href="https://wa.me/<?= esc($contact['whatsapp_number'] ?? '6285876603826') ?>?text=Halo%20SOLVETA" target="_blank"
                           class="text-xs text-emerald-600 hover:text-emerald-700 font-medium inline-flex items-center gap-1.5">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Tes Kirim Pesan WA</span>
                        </a>

                        <button type="submit" class="py-2 px-5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-2 cursor-pointer">
                            <i data-lucide="save" class="w-3.5 h-3.5"></i>
                            <span>Simpan Kontak</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- =========================================================================
                 MODE 7: VIDEO PROFIL (LAPTOP 3D HERO SCREEN)
                 ========================================================================= -->
            <div id="tab-video" class="tab-pane space-y-6">
                <form action="/admin/update-copy" method="POST" enctype="multipart/form-data" class="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 space-y-5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="hero_eyebrow" value="<?= esc($copy['hero_eyebrow'] ?? '') ?>">
                    <input type="hidden" name="hero_headline" value="<?= esc($copy['hero_headline'] ?? '') ?>">
                    <input type="hidden" name="hero_subtitle" value="<?= esc($copy['hero_subtitle'] ?? '') ?>">
                    <input type="hidden" name="consultation_title" value="<?= esc($copy['consultation_title'] ?? '') ?>">
                    <input type="hidden" name="consultation_desc" value="<?= esc($copy['consultation_desc'] ?? '') ?>">
                    <input type="hidden" name="marquee_title" value="<?= esc($copy['marquee_title'] ?? '') ?>">

                    <div class="border-b border-gray-100 pb-3">
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Video Showcase Layar Laptop 3D</h2>
                        <p class="text-[11px] text-gray-400">Video profil resmi yang diputar secara otomatis di dalam layar mockup laptop 3D interaktif.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <div class="aspect-[16/10] bg-black rounded-xl overflow-hidden border border-gray-800 shadow-md">
                            <video id="preview-admin-video" src="<?= esc($copy['profile_video'] ?? '/videos/profile.mp4') ?>" controls autoplay muted loop playsinline class="w-full h-full object-cover"></video>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-[11px] font-medium text-gray-700 mb-1">Unggah File Video Baru (.mp4)</label>
                                <input type="file" name="profile_video_file" accept="video/mp4,video/*"
                                       class="w-full text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-gray-100 file:text-gray-800 hover:file:bg-gray-200 cursor-pointer">
                                <span class="text-[10px] text-gray-400 block mt-1">Format rekomendasi: MP4 1080p / 720p, rasio 16:9 atau 16:10.</span>
                            </div>

                            <button type="submit" class="py-2.5 px-6 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                                <i data-lucide="upload" class="w-4 h-4"></i>
                                <span>Simpan &amp; Terapkan Video</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- =========================================================================
                 MODE 8: REKAP FORMULIR ORDER (ORDER SUBMISSIONS MANAGER - 1:1 REPLICATION)
                 ========================================================================= -->
            <div id="tab-orders" class="tab-pane space-y-6">
                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Rekap 16 Data Formulir Order Masuk (<?= count($orders) ?>)</h2>
                        <p class="text-[11px] text-gray-400">Semua data brief kebutuhan website yang dikirimkan calon klien via formulir online.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="exportOrdersCSV()" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg flex items-center gap-1.5 transition-colors cursor-pointer">
                            <i data-lucide="download" class="w-3.5 h-3.5"></i>
                            <span>Ekspor Excel/CSV</span>
                        </button>
                    </div>
                </div>

                <!-- 4 KPI SUMMARY CARDS (MATCHING NEXT.JS) -->
                <?php
                    $countTotal = count($orders);
                    $countDone = 0;
                    $countPending = 0;
                    $potensiNilai = 0;
                    foreach ($orders as $o) {
                        $st = $o['status'] ?? 'Baru';
                        if ($st === 'Selesai') $countDone++;
                        if ($st === 'Baru' || $st === 'Dihubungi') $countPending++;
                        
                        // Parse package price
                        $pkg = strtolower($o['selected_package'] ?? '');
                        if (strpos($pkg, 'platinum') !== false || strpos($pkg, '1.5') !== false) {
                            $potensiNilai += 1500000;
                        } elseif (strpos($pkg, 'premium') !== false || strpos($pkg, '849') !== false || strpos($pkg, '964') !== false) {
                            $potensiNilai += 849000;
                        } elseif (strpos($pkg, 'standard') !== false || strpos($pkg, '549') !== false || strpos($pkg, '699') !== false) {
                            $potensiNilai += 549000;
                        } elseif (strpos($pkg, 'basic') !== false || strpos($pkg, '299') !== false || strpos($pkg, '349') !== false) {
                            $potensiNilai += 299000;
                        }
                    }
                ?>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="p-4 bg-white rounded-xl border border-gray-200/80">
                        <div class="text-[10px] text-gray-400 font-medium uppercase">Total Order Masuk</div>
                        <div class="text-xl font-bold font-mono text-gray-900 mt-1"><?= $countTotal ?> Submisi</div>
                    </div>
                    <div class="p-4 bg-white rounded-xl border border-gray-200/80">
                        <div class="text-[10px] text-emerald-600 font-medium uppercase">Pembayaran Selesai</div>
                        <div class="text-xl font-bold font-mono text-emerald-600 mt-1"><?= $countDone ?> Selesai</div>
                    </div>
                    <div class="p-4 bg-white rounded-xl border border-gray-200/80">
                        <div class="text-[10px] text-amber-600 font-medium uppercase">Menunggu Pembayaran</div>
                        <div class="text-xl font-bold font-mono text-amber-600 mt-1"><?= $countPending ?> Klien</div>
                    </div>
                    <div class="p-4 bg-white rounded-xl border border-gray-200/80">
                        <div class="text-[10px] text-gray-400 font-medium uppercase">Estimasi Nilai Order</div>
                        <div class="text-xl font-bold font-mono text-gray-900 mt-1">Rp <?= number_format($potensiNilai, 0, ',', '.') ?></div>
                    </div>
                </div>

                <!-- Orders Filter & Search Bar -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                    <div class="relative flex-1">
                        <i data-lucide="search" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="order-search-input" oninput="filterOrders()" placeholder="Cari nama klien, brand, paket, atau no WA..."
                               class="w-full text-xs pl-8 pr-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900">
                    </div>
                    <select id="order-status-select" onchange="filterOrders()" class="text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-700 bg-white">
                        <option value="all">Semua Status</option>
                        <option value="Baru">Baru</option>
                        <option value="Dihubungi">Dihubungi</option>
                        <option value="Selesai">Selesai / Deal</option>
                    </select>
                </div>

                <!-- Submissions Table (8-Column Matching Next.js) -->
                <div class="bg-white border border-gray-200/80 rounded-xl overflow-hidden shadow-none">
                    <div class="overflow-x-auto">
                        <table class="w-full text-[11px] text-left">
                            <thead class="bg-gray-50 text-gray-400 uppercase text-[9px] border-b border-gray-100">
                                <tr>
                                    <th class="px-4 py-2.5 font-medium">ID &amp; Tanggal</th>
                                    <th class="px-4 py-2.5 font-medium">Pelanggan</th>
                                    <th class="px-4 py-2.5 font-medium">Kontak WhatsApp</th>
                                    <th class="px-4 py-2.5 font-medium">Brand &amp; Bisnis</th>
                                    <th class="px-4 py-2.5 font-medium">Paket Layanan</th>
                                    <th class="px-4 py-2.5 font-medium">Status</th>
                                    <th class="px-4 py-2.5 text-right font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="orders-tbody" class="divide-y divide-gray-100">
                                <?php if (empty($orders)): ?>
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-gray-400">Belum ada data formulir order masuk.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($orders as $ord): ?>
                                        <tr class="order-row hover:bg-gray-50/60 transition-colors"
                                            data-search="<?= strtolower(esc(($ord['full_name'] ?? '') . ' ' . ($ord['brand_name'] ?? '') . ' ' . ($ord['whatsapp_number'] ?? '') . ' ' . ($ord['selected_package'] ?? '') . ' ' . ($ord['id'] ?? ''))) ?>"
                                            data-status="<?= esc($ord['status'] ?? 'Baru') ?>">
                                            
                                            <!-- ID & Tanggal -->
                                            <td class="px-4 py-3 font-mono text-gray-500 whitespace-nowrap">
                                                <div class="font-bold text-gray-900"><?= esc(substr($ord['id'] ?? '-', -6)) ?></div>
                                                <div class="text-[10px] text-gray-400"><?= esc(substr($ord['created_at'] ?? '-', 0, 16)) ?></div>
                                            </td>

                                            <!-- Pelanggan -->
                                            <td class="px-4 py-3 font-medium text-gray-900">
                                                <div class="font-bold text-gray-950"><?= esc($ord['full_name']) ?></div>
                                                <div class="text-[10px] text-gray-400 truncate max-w-[140px]"><?= esc($ord['business_description'] ?: '-') ?></div>
                                            </td>

                                            <!-- Kontak WA -->
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $ord['whatsapp_number']) ?>?text=Halo%20<?= urlencode($ord['full_name']) ?>,%20kami%20dari%20SOLVETA" target="_blank"
                                                   class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 font-mono font-medium">
                                                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                                    <span><?= esc($ord['whatsapp_number']) ?></span>
                                                </a>
                                            </td>

                                            <!-- Brand & Bisnis -->
                                            <td class="px-4 py-3">
                                                <div class="font-semibold text-gray-900"><?= esc($ord['brand_name'] ?: '-') ?></div>
                                                <div class="text-[10px] text-gray-400 truncate max-w-[150px]"><?= esc($ord['website_type']) ?></div>
                                            </td>

                                            <!-- Paket Layanan -->
                                            <td class="px-4 py-3">
                                                <span class="inline-block px-2 py-0.5 rounded bg-gray-100 font-semibold text-gray-800 text-[10px]">
                                                    <?= esc($ord['selected_package']) ?>
                                                </span>
                                            </td>

                                            <!-- Status -->
                                            <td class="px-4 py-3">
                                                <form action="/admin/order/status" method="POST" class="inline">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id" value="<?= esc($ord['id']) ?>">
                                                    <select name="status" onchange="this.form.submit()"
                                                            class="text-[10px] font-semibold px-2 py-1 rounded-md border border-gray-200 outline-none cursor-pointer <?= $ord['status'] === 'Baru' ? 'bg-amber-50 text-amber-700 border-amber-200' : ($ord['status'] === 'Dihubungi' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-emerald-50 text-emerald-700 border-emerald-200') ?>">
                                                        <option value="Baru" <?= ($ord['status'] ?? '') === 'Baru' ? 'selected' : '' ?>>Baru</option>
                                                        <option value="Dihubungi" <?= ($ord['status'] ?? '') === 'Dihubungi' ? 'selected' : '' ?>>Dihubungi</option>
                                                        <option value="Selesai" <?= ($ord['status'] ?? '') === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                                    </select>
                                                </form>
                                            </td>

                                            <!-- Aksi -->
                                            <td class="px-4 py-3 text-right whitespace-nowrap space-x-1">
                                                <button type="button" onclick="openOrderDetailModal(<?= htmlspecialchars(json_encode($ord), ENT_QUOTES, 'UTF-8') ?>)"
                                                        class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-[10px] font-medium rounded transition-colors cursor-pointer" title="Lihat 16 Data Lengkap">
                                                    Detail
                                                </button>
                                                <form action="/admin/order/delete/<?= esc($ord['id']) ?>" method="POST" onsubmit="return confirm('Hapus formulir order ini?');" class="inline">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="p-1 text-red-400 hover:text-red-600 text-xs cursor-pointer" title="Hapus">
                                                        <i data-lucide="trash-2" class="w-3.5 h-3.5 inline"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- =========================================================================
                 MODE 9: PENCATATAN PROYEK & INVOICE GENERATOR (1:1 REPLICATION)
                 ========================================================================= -->
            <div id="tab-projects" class="tab-pane space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Pencatatan Transaksi Proyek &amp; Invoice Resmi (<?= count($transactions) ?>)</h2>
                        <p class="text-[11px] text-gray-400">Generate invoice penagihan resmi otomatis dengan nomor invoice, status, komponen beban, dan cetak PDF.</p>
                    </div>
                    <button type="button" onclick="openAddTransactionModal()" class="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                        <span>Buat Invoice Baru</span>
                    </button>
                </div>

                <!-- Projects Ledger Table -->
                <div class="bg-white border border-gray-200/80 rounded-xl overflow-hidden shadow-none">
                    <div class="overflow-x-auto">
                        <table class="w-full text-[11px] text-left">
                            <thead class="bg-gray-50 text-gray-400 uppercase text-[9px] border-b border-gray-100">
                                <tr>
                                    <th class="px-4 py-2.5 font-medium">No. Invoice &amp; Tgl</th>
                                    <th class="px-4 py-2.5 font-medium">Customer</th>
                                    <th class="px-4 py-2.5 font-medium">Kontak HP</th>
                                    <th class="px-4 py-2.5 font-medium">Website Proyek</th>
                                    <th class="px-4 py-2.5 font-medium">Nilai Jasa</th>
                                    <th class="px-4 py-2.5 font-medium">Status</th>
                                    <th class="px-4 py-2.5 text-right font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php if (empty($transactions)): ?>
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-gray-400">Belum ada transaksi invoice proyek dicatat.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($transactions as $tx): ?>
                                        <tr class="hover:bg-gray-50/60 transition-colors">
                                            <td class="px-4 py-3 font-mono">
                                                <div class="font-bold text-gray-900"><?= esc($tx['invoice_number']) ?></div>
                                                <div class="text-[10px] text-gray-400"><?= esc($tx['date']) ?></div>
                                            </td>
                                            <td class="px-4 py-3 font-medium text-gray-900"><?= esc($tx['customer_name']) ?></td>
                                            <td class="px-4 py-3 font-mono text-gray-600"><?= esc($tx['phone_number']) ?></td>
                                            <td class="px-4 py-3">
                                                <div class="font-medium text-gray-900"><?= esc($tx['website_name'] ?: '-') ?></div>
                                                <?php if (!empty($tx['website_link'])): ?>
                                                    <a href="<?= esc($tx['website_link']) ?>" target="_blank" class="text-[10px] text-blue-600 hover:underline"><?= esc($tx['website_link']) ?></a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-3 font-mono font-bold text-gray-900">
                                                Rp <?= number_format((int)($tx['service_price'] ?? 0), 0, ',', '.') ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-semibold <?= $tx['status'] === 'Terlaksana' ? 'bg-emerald-50 text-emerald-700' : ($tx['status'] === 'Progress' ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700') ?>">
                                                    <?= esc($tx['status']) ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap space-x-1">
                                                <a href="/admin/transaction/print/<?= esc($tx['id']) ?>" target="_blank"
                                                   class="px-2.5 py-1 bg-gray-900 hover:bg-black text-white text-[10px] font-medium rounded transition-colors inline-flex items-center gap-1 cursor-pointer">
                                                    <i data-lucide="printer" class="w-3 h-3"></i>
                                                    <span>Cetak Invoice</span>
                                                </a>
                                                <form action="/admin/transaction/delete/<?= esc($tx['id']) ?>" method="POST" onsubmit="return confirm('Hapus transaksi ini?');" class="inline">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="p-1 text-red-400 hover:text-red-600 text-xs cursor-pointer" title="Hapus">
                                                        <i data-lucide="trash-2" class="w-3.5 h-3.5 inline"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- =========================================================================
         MODALS (INTERACTIVE POPUPS IDENTICAL TO NEXT.JS)
         ========================================================================= -->

    <!-- Modal 1: Edit Hero Headline & Subtitle -->
    <div id="modal-hero-edit" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 max-w-lg w-full p-5 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-xs font-bold text-gray-900">Edit Teks Hero Section</h3>
                <button type="button" onclick="closeModal('modal-hero-edit')" class="text-gray-400 hover:text-gray-700 cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <form action="/admin/update-copy" method="POST" class="space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="portfolio_title" value="<?= esc($copy['portfolio_title'] ?? '') ?>">
                <input type="hidden" name="consultation_title" value="<?= esc($copy['consultation_title'] ?? '') ?>">
                <input type="hidden" name="consultation_desc" value="<?= esc($copy['consultation_desc'] ?? '') ?>">
                <input type="hidden" name="marquee_speed" value="<?= esc($copy['marquee_speed'] ?? 35) ?>">
                <input type="hidden" name="marquee_logo_height" value="<?= esc($copy['marquee_logo_height'] ?? 46) ?>">
                <input type="hidden" name="marquee_logo_spacing" value="<?= esc($copy['marquee_logo_spacing'] ?? 36) ?>">
                <input type="hidden" name="marquee_logo_scale" value="<?= esc($copy['marquee_logo_scale'] ?? 100) ?>">

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Eyebrow (Badge Teks Kecil)</label>
                    <input type="text" name="hero_eyebrow" value="<?= esc($copy['hero_eyebrow'] ?? 'SOLVE TECHNOLOGY AGENCY') ?>"
                           class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Headline Utama</label>
                    <textarea name="hero_headline" rows="2" required
                              class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900 font-bold"><?= esc($copy['hero_headline'] ?? '') ?></textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Subtitle / Paragraf Pengantar</label>
                    <textarea name="hero_subtitle" rows="3" required
                              class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900 leading-relaxed"><?= esc($copy['hero_subtitle'] ?? '') ?></textarea>
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modal-hero-edit')" class="px-3 py-1.5 text-xs text-gray-500 cursor-pointer">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-gray-900 text-white text-xs font-medium rounded-lg cursor-pointer">Simpan Teks</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 2: Edit Portfolio Section Title -->
    <div id="modal-port-title-edit" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 max-w-md w-full p-5 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-xs font-bold text-gray-900">Edit Judul Portofolio</h3>
                <button type="button" onclick="closeModal('modal-port-title-edit')" class="text-gray-400 hover:text-gray-700 cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <form action="/admin/update-copy" method="POST" class="space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="hero_eyebrow" value="<?= esc($copy['hero_eyebrow'] ?? '') ?>">
                <input type="hidden" name="hero_headline" value="<?= esc($copy['hero_headline'] ?? '') ?>">
                <input type="hidden" name="hero_subtitle" value="<?= esc($copy['hero_subtitle'] ?? '') ?>">
                <input type="hidden" name="consultation_title" value="<?= esc($copy['consultation_title'] ?? '') ?>">
                <input type="hidden" name="consultation_desc" value="<?= esc($copy['consultation_desc'] ?? '') ?>">
                <input type="hidden" name="marquee_speed" value="<?= esc($copy['marquee_speed'] ?? 35) ?>">
                <input type="hidden" name="marquee_logo_height" value="<?= esc($copy['marquee_logo_height'] ?? 46) ?>">
                <input type="hidden" name="marquee_logo_spacing" value="<?= esc($copy['marquee_logo_spacing'] ?? 36) ?>">
                <input type="hidden" name="marquee_logo_scale" value="<?= esc($copy['marquee_logo_scale'] ?? 100) ?>">

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Judul Bagian Portofolio</label>
                    <textarea name="portfolio_title" rows="2" required
                              class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900 font-bold"><?= esc($copy['portfolio_title'] ?? 'Portofolio Proyek Website Yang Telah Kami Bangun') ?></textarea>
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modal-port-title-edit')" class="px-3 py-1.5 text-xs text-gray-500 cursor-pointer">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-gray-900 text-white text-xs font-medium rounded-lg cursor-pointer">Simpan Judul</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 3: Edit Pricing Tier -->
    <div id="modal-pricing" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 max-w-lg w-full p-5 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-xs font-bold text-gray-900" id="pricing-modal-title">Edit Paket Harga</h3>
                <button type="button" onclick="closeModal('modal-pricing')" class="text-gray-400 hover:text-gray-700 cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <form action="/admin/pricing/save" method="POST" class="space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="price-input-id">

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-medium text-gray-600 mb-1">Nama Paket</label>
                        <input type="text" name="name" id="price-input-name" required class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none font-bold">
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-gray-600 mb-1">Harga Tampilan (Display)</label>
                        <input type="text" name="price" id="price-input-price" required class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none font-mono font-bold text-[#8B0021]">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-medium text-gray-600 mb-1">Biaya Perpanjangan</label>
                        <input type="text" name="renewal_price" id="price-input-renewal" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-gray-600 mb-1">Masa Aktif Layanan</label>
                        <input type="text" name="active_period" id="price-input-period" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Target Kesesuaian (Cocok Untuk)</label>
                    <input type="text" name="suitability" id="price-input-suitability" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Daftar Fitur (1 baris per fitur)</label>
                    <textarea name="features" id="price-input-features" rows="5" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none font-mono"></textarea>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="popular" id="price-input-popular" value="1" class="rounded accent-[#8B0021]">
                    <label for="price-input-popular" class="text-xs font-semibold text-gray-800">Tandai sebagai Paket Paling Diminati (POPULAR)</label>
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modal-pricing')" class="px-3 py-1.5 text-xs text-gray-500 cursor-pointer">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-gray-900 text-white text-xs font-medium rounded-lg cursor-pointer">Simpan Paket</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 4: Edit Skala & Data Brand -->
    <div id="modal-brand" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 max-w-sm w-full p-5 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-xs font-bold text-gray-900" id="modal-brand-title">Edit Logo Klien</h3>
                <button type="button" onclick="closeModal('modal-brand')" class="text-gray-400 hover:text-gray-700 cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <form action="/admin/brand/save" method="POST" enctype="multipart/form-data" class="space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="brand-input-id">
                <input type="hidden" name="existing_logo" id="brand-input-existing">

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Nama Brand / Klien</label>
                    <input type="text" name="name" id="brand-input-name" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Label / Sektor Bisnis</label>
                    <input type="text" name="label" id="brand-input-label" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Skala Gambar Individual</label>
                    <input type="number" step="0.1" min="0.5" max="2.5" name="scale" id="brand-input-scale" value="1.0" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none font-mono">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Ganti File Logo (Opsional)</label>
                    <input type="file" name="logo_file" accept="image/*" class="w-full text-xs file:mr-2 file:py-1 file:px-2.5 file:rounded file:border-0 file:bg-gray-100 file:text-xs">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modal-brand')" class="px-3 py-1.5 text-xs text-gray-500 cursor-pointer">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-gray-900 text-white text-xs font-medium rounded-lg cursor-pointer">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 5: Tambah/Edit Portofolio -->
    <div id="modal-portfolio" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 max-w-md w-full p-5 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-xs font-bold text-gray-900" id="modal-portfolio-title">Tambah Portofolio</h3>
                <button type="button" onclick="closeModal('modal-portfolio')" class="text-gray-400 hover:text-gray-700 cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <form action="/admin/portfolio/save" method="POST" enctype="multipart/form-data" class="space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="port-input-id">
                <input type="hidden" name="existing_image" id="port-input-existing">

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Judul Proyek</label>
                    <input type="text" name="title" id="port-input-title" required class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-medium text-gray-600 mb-1">Kategori</label>
                        <input type="text" name="category" id="port-input-category" required class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-gray-600 mb-1">Link Website Live</label>
                        <input type="url" name="live_url" id="port-input-url" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Deskripsi Singkat Proyek</label>
                    <textarea name="description" id="port-input-desc" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Gambar Thumbnail</label>
                    <input type="file" name="image_file" accept="image/*" class="w-full text-xs file:mr-2 file:py-1 file:px-2.5 file:rounded file:border-0 file:bg-gray-100 file:text-xs">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modal-portfolio')" class="px-3 py-1.5 text-xs text-gray-500 cursor-pointer">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-gray-900 text-white text-xs font-medium rounded-lg cursor-pointer">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 6: Tambah/Edit Transaksi Proyek -->
    <div id="modal-transaction" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 max-w-md w-full p-5 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-xs font-bold text-gray-900">Buat / Edit Transaksi Invoice</h3>
                <button type="button" onclick="closeModal('modal-transaction')" class="text-gray-400 hover:text-gray-700 cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <form action="/admin/transaction/save" method="POST" class="space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="tx-input-id">

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">No. Invoice Resmi</label>
                    <input type="text" name="invoice_number" id="tx-input-inv" value="INV-<?= date('Ymd') ?>-<?= rand(100, 999) ?>" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none font-mono font-bold">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Nama Customer</label>
                    <input type="text" name="customer_name" id="tx-input-customer" required class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-medium text-gray-600 mb-1">No. WhatsApp</label>
                        <input type="text" name="phone_number" id="tx-input-phone" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none font-mono">
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-gray-600 mb-1">Nilai Jasa (Rp)</label>
                        <input type="number" name="service_price" id="tx-input-price" required class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none font-mono font-bold">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Nama Website / Domain Proyek</label>
                    <input type="text" name="website_name" id="tx-input-webname" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Status Proyek</label>
                    <select name="status" id="tx-input-status" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                        <option value="Progress">Progress</option>
                        <option value="Terlaksana">Terlaksana / Selesai</option>
                        <option value="Batal">Batal</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modal-transaction')" class="px-3 py-1.5 text-xs text-gray-500 cursor-pointer">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-gray-900 text-white text-xs font-medium rounded-lg cursor-pointer">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 7: 16 Data Formulir Order Detail (Matching Next.js OrderSubmissionsManager) -->
    <div id="modal-order-detail" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border border-gray-200 max-w-2xl w-full p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="clipboard-list" class="w-4 h-4 text-[#8B0021]"></i>
                    <h3 class="text-xs font-bold text-gray-900">Rincian Lengkap Formulir Brief Pelanggan</h3>
                </div>
                <button type="button" onclick="closeModal('modal-order-detail')" class="text-gray-400 hover:text-gray-700 cursor-pointer"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>

            <div id="order-detail-content" class="space-y-4 text-xs">
                <!-- Dynamically populated via JS -->
            </div>

            <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                <div id="order-quick-wa-btn">
                    <!-- WhatsApp quick contact button -->
                </div>
                <button type="button" onclick="closeModal('modal-order-detail')" class="px-4 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden Master Form for Header "Simpan" Button -->
    <form action="/admin/update-copy" method="POST" id="form-master-save" class="hidden">
        <?= csrf_field() ?>
        <input type="hidden" name="hero_eyebrow" id="master-hero-eyebrow" value="<?= esc($copy['hero_eyebrow'] ?? '') ?>">
        <input type="hidden" name="hero_headline" id="master-hero-headline" value="<?= esc($copy['hero_headline'] ?? '') ?>">
        <input type="hidden" name="hero_subtitle" id="master-hero-subtitle" value="<?= esc($copy['hero_subtitle'] ?? '') ?>">
        <input type="hidden" name="portfolio_title" id="master-portfolio-title" value="<?= esc($copy['portfolio_title'] ?? '') ?>">
        <input type="hidden" name="consultation_title" id="master-consultation-title" value="<?= esc($copy['consultation_title'] ?? '') ?>">
        <input type="hidden" name="consultation_desc" id="master-consultation-desc" value="<?= esc($copy['consultation_desc'] ?? '') ?>">
        <input type="hidden" name="marquee_speed" id="master-marquee-speed" value="<?= esc($copy['marquee_speed'] ?? 35) ?>">
        <input type="hidden" name="marquee_logo_height" id="master-marquee-logo-height" value="<?= esc($copy['marquee_logo_height'] ?? 46) ?>">
        <input type="hidden" name="marquee_logo_spacing" id="master-marquee-logo-spacing" value="<?= esc($copy['marquee_logo_spacing'] ?? 36) ?>">
        <input type="hidden" name="marquee_logo_scale" id="master-marquee-logo-scale" value="<?= esc($copy['marquee_logo_scale'] ?? 100) ?>">
    </form>

    <!-- JavaScript Controllers -->
    <script>
        lucide.createIcons();

        // 1. Tab Switcher (Matching 9 Next.js Modes)
        const tabTitles = {
            'visual': 'Edit Visual',
            'pricing': 'Paket & Harga',
            'profit': 'Kelola HPP & Margin',
            'portfolio': 'Portofolio',
            'brands': 'Logo Klien',
            'contact': 'Kontak WhatsApp',
            'video': 'Video Profil',
            'orders': 'Rekap Formulir Order',
            'projects': 'Pencatatan Proyek & Invoice'
        };

        function switchTab(tabId) {
            document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.sidebar-btn').forEach(el => el.classList.remove('active'));

            const targetPane = document.getElementById('tab-' + tabId);
            const targetBtn = document.getElementById('nav-btn-' + tabId);
            const headerTitle = document.getElementById('header-tab-title');

            if (targetPane) targetPane.classList.add('active');
            if (targetBtn) targetBtn.classList.add('active');
            if (headerTitle && tabTitles[tabId]) headerTitle.innerText = tabTitles[tabId];

            window.location.hash = 'tab-' + tabId;
            lucide.createIcons();
        }

        // Initialize Tab from URL Hash
        window.addEventListener('DOMContentLoaded', () => {
            const hash = window.location.hash.replace('#tab-', '').replace('#', '');
            if (hash && tabTitles[hash]) {
                switchTab(hash);
            }
        });

        // Modals Management
        function openModal(id) {
            const m = document.getElementById(id);
            if (m) m.classList.remove('hidden');
        }
        function closeModal(id) {
            const m = document.getElementById(id);
            if (m) m.classList.add('hidden');
        }

        // Hero Modals
        function openEditHeroModal() {
            openModal('modal-hero-edit');
        }
        function openEditPortfolioTitleModal() {
            openModal('modal-port-title-edit');
        }

        // Pricing Modals
        function openEditPricingModal(tier) {
            document.getElementById('pricing-modal-title').innerText = 'Edit ' + (tier.name || 'Paket');
            document.getElementById('price-input-id').value = tier.id || '';
            document.getElementById('price-input-name').value = tier.name || '';
            document.getElementById('price-input-price').value = tier.price || '';
            document.getElementById('price-input-renewal').value = tier.renewal_price || '';
            document.getElementById('price-input-period').value = tier.active_period || '1 Tahun';
            document.getElementById('price-input-suitability').value = tier.suitability || '';
            
            let feats = [];
            if (Array.isArray(tier.features)) {
                feats = tier.features;
            } else if (tier.features_json) {
                try { feats = JSON.parse(tier.features_json); } catch(e){}
            }
            document.getElementById('price-input-features').value = feats.join('\n');
            document.getElementById('price-input-popular').checked = !!(tier.popular == 1);
            openModal('modal-pricing');
        }

        // Brand Modals & Live Marquee Preview
        function openAddBrandModal() {
            document.getElementById('modal-brand-title').innerText = 'Upload Logo Klien Baru';
            document.getElementById('brand-input-id').value = '';
            document.getElementById('brand-input-existing').value = '';
            document.getElementById('brand-input-name').value = '';
            document.getElementById('brand-input-label').value = '';
            document.getElementById('brand-input-scale').value = '1.0';
            openModal('modal-brand');
        }

        function openEditBrandModal(b) {
            document.getElementById('modal-brand-title').innerText = 'Edit Skala Logo Klien';
            document.getElementById('brand-input-id').value = b.id || '';
            document.getElementById('brand-input-existing').value = b.logo_image || '';
            document.getElementById('brand-input-name').value = b.name || '';
            document.getElementById('brand-input-label').value = b.label || '';
            document.getElementById('brand-input-scale').value = b.scale || 1.0;
            openModal('modal-brand');
        }

        function setPresetSize(h, s) {
            document.getElementById('range-logo-height').value = h;
            document.getElementById('range-logo-scale').value = s;
            updateMarqueeLiveSettings();

            // Update button styles
            document.querySelectorAll('.preset-btn').forEach(btn => {
                btn.className = 'preset-btn py-1.5 px-3 rounded-lg border text-xs font-medium transition-colors text-center cursor-pointer bg-white text-gray-700 border-gray-200 hover:bg-gray-50';
            });
            const activePreset = document.getElementById('preset-btn-' + h);
            if (activePreset) {
                activePreset.className = 'preset-btn py-1.5 px-3 rounded-lg border text-xs font-medium transition-colors text-center cursor-pointer bg-gray-900 text-white border-gray-900';
            }
        }

        function adjustLogoHeight(delta) {
            const range = document.getElementById('range-logo-height');
            let cur = parseInt(range.value, 10);
            cur = Math.max(28, Math.min(150, cur + delta));
            range.value = cur;
            updateMarqueeLiveSettings();
        }

        function updateMarqueeLiveSettings() {
            const h = parseInt(document.getElementById('range-logo-height').value, 10);
            const scale = parseInt(document.getElementById('range-logo-scale').value, 10);
            const spacing = parseInt(document.getElementById('range-logo-spacing').value, 10);
            const speed = parseInt(document.getElementById('range-logo-speed').value, 10);

            // Update badges
            document.getElementById('brand-badge-height').innerText = h + 'px';
            document.getElementById('brand-badge-scale').innerText = scale + '%';
            document.getElementById('brand-badge-spacing').innerText = spacing + 'px';
            document.getElementById('brand-badge-speed').innerText = speed + 's';

            // Update calculated info
            const calcH = Math.round(h * (scale / 100));
            document.getElementById('preview-calc-height').innerText = calcH + 'px';
            document.getElementById('preview-calc-spacing').innerText = spacing + 'px';

            // Update live simulation strip
            document.querySelectorAll('.live-brand-item').forEach(item => {
                item.style.paddingLeft = Math.round(spacing / 2) + 'px';
                item.style.paddingRight = Math.round(spacing / 2) + 'px';
                const img = item.querySelector('img');
                if (img) {
                    img.style.height = calcH + 'px';
                    img.style.maxHeight = Math.round(calcH * 1.45) + 'px';
                }
            });
        }

        // Portfolio Modals
        function openAddPortfolioModal() {
            document.getElementById('modal-portfolio-title').innerText = 'Tambah Portofolio Baru';
            document.getElementById('port-input-id').value = '';
            document.getElementById('port-input-existing').value = '';
            document.getElementById('port-input-title').value = '';
            document.getElementById('port-input-category').value = '';
            document.getElementById('port-input-url').value = '';
            document.getElementById('port-input-desc').value = '';
            openModal('modal-portfolio');
        }

        function openEditPortfolioModal(p) {
            document.getElementById('modal-portfolio-title').innerText = 'Edit Portofolio';
            document.getElementById('port-input-id').value = p.id || '';
            document.getElementById('port-input-existing').value = p.image_url || '';
            document.getElementById('port-input-title').value = p.title || '';
            document.getElementById('port-input-category').value = p.category || '';
            document.getElementById('port-input-url').value = p.live_url || '';
            document.getElementById('port-input-desc').value = p.description || '';
            openModal('modal-portfolio');
        }

        // Transaction Modals
        function openAddTransactionModal() {
            document.getElementById('tx-input-id').value = '';
            document.getElementById('tx-input-customer').value = '';
            document.getElementById('tx-input-phone').value = '';
            document.getElementById('tx-input-webname').value = '';
            document.getElementById('tx-input-price').value = '';
            openModal('modal-transaction');
        }

        // Order Detail Modal (16 Fields from Next.js Form)
        function openOrderDetailModal(ord) {
            const container = document.getElementById('order-detail-content');
            const cleanPhone = (ord.whatsapp_number || '').replace(/[^0-9]/g, '');
            
            container.innerHTML = `
                <!-- Top Summary Pill Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 p-3.5 bg-gray-50 rounded-xl border border-gray-100">
                    <div>
                        <span class="text-gray-400 block text-[9px] uppercase font-bold">Nama Klien</span>
                        <strong class="text-gray-950 font-bold text-xs">${ord.full_name || '-'}</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[9px] uppercase font-bold">Nama Brand / Usaha</span>
                        <strong class="text-gray-950 font-bold text-xs">${ord.brand_name || '-'}</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[9px] uppercase font-bold">Nomor WhatsApp</span>
                        <a href="https://wa.me/${cleanPhone}" target="_blank" class="text-emerald-700 font-bold font-mono text-xs hover:underline flex items-center gap-1">
                            <span>${ord.whatsapp_number || '-'}</span>
                        </a>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[9px] uppercase font-bold">Paket Pilihan</span>
                        <span class="inline-block mt-0.5 px-2 py-0.5 rounded bg-gray-900 text-white font-mono font-bold text-[10px]">${ord.selected_package || '-'}</span>
                    </div>
                </div>

                <!-- 16 Data Fields Table Grid -->
                <div class="divide-y divide-gray-100 border border-gray-100 rounded-xl overflow-hidden">
                    <div class="p-3 bg-white flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">1. Jenis Website:</span>
                        <span class="font-bold text-gray-900 sm:w-2/3 text-[11px]">${ord.website_type || '-'}</span>
                    </div>
                    <div class="p-3 bg-gray-50/50 flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">2. Halaman Yang Dibutuhkan:</span>
                        <span class="text-gray-800 sm:w-2/3 text-[11px]">${ord.pages_needed || '-'}</span>
                    </div>
                    <div class="p-3 bg-white flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">3. Deskripsi Singkat Usaha:</span>
                        <span class="text-gray-800 sm:w-2/3 text-[11px]">${ord.business_description || '-'}</span>
                    </div>
                    <div class="p-3 bg-gray-50/50 flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">4. Profil Bisnis / Sejarah:</span>
                        <span class="text-gray-800 sm:w-2/3 text-[11px]">${ord.business_profile || '-'}</span>
                    </div>
                    <div class="p-3 bg-white flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">5. Rencana Nama Domain:</span>
                        <span class="font-mono text-gray-900 font-semibold sm:w-2/3 text-[11px]">${ord.website_and_domain_name || '-'}</span>
                    </div>
                    <div class="p-3 bg-gray-50/50 flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">6. Kepemilikan Domain:</span>
                        <span class="text-gray-800 sm:w-2/3 text-[11px]">${ord.has_domain || '-'}</span>
                    </div>
                    <div class="p-3 bg-white flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">7. Status Logo Brand:</span>
                        <span class="text-gray-800 sm:w-2/3 text-[11px]">${ord.has_logo || '-'}</span>
                    </div>
                    <div class="p-3 bg-gray-50/50 flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">8. Tema Warna &amp; Konsep Desain:</span>
                        <span class="text-gray-800 sm:w-2/3 text-[11px] font-semibold text-[#8B0021]">${ord.design_color_theme || '-'}</span>
                    </div>
                    <div class="p-3 bg-white flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">9. Foto Produk / Layanan:</span>
                        <span class="text-gray-800 sm:w-2/3 text-[11px]">${ord.product_photos || '-'}</span>
                    </div>
                    <div class="p-3 bg-gray-50/50 flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">10. Contoh Website Referensi:</span>
                        <span class="text-blue-600 sm:w-2/3 text-[11px] font-mono break-all">${ord.example_websites || '-'}</span>
                    </div>
                    <div class="p-3 bg-white flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">11. Catatan Khusus / Fitur Tambahan:</span>
                        <span class="text-gray-800 sm:w-2/3 text-[11px]">${ord.special_notes || '-'}</span>
                    </div>
                    <div class="p-3 bg-gray-50/50 flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                        <span class="text-gray-500 font-medium sm:w-1/3 text-[11px]">12. Waktu Pengiriman Brief:</span>
                        <span class="text-gray-700 sm:w-2/3 text-[11px] font-mono">${ord.created_at || ord.timestamp || '-'}</span>
                    </div>
                </div>
            `;

            // Setup direct WhatsApp reply button
            const waGreeting = encodeURIComponent(`Halo ${ord.full_name || 'Kak'}, kami dari SOLVETA telah menerima formulir brief pemesanan website Anda untuk brand *${ord.brand_name || 'Bisnis Anda'}* (Paket ${ord.selected_package || 'Website'}). Kami siap membantu merealisasikannya!`);
            document.getElementById('order-quick-wa-btn').innerHTML = `
                <a href="https://wa.me/${cleanPhone}?text=${waGreeting}" target="_blank"
                   class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg flex items-center gap-1.5 cursor-pointer">
                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                    <span>Hubungi via WhatsApp</span>
                </a>
            `;
            lucide.createIcons();
            openModal('modal-order-detail');
        }

        // Filter Orders Table
        function filterOrders() {
            const q = document.getElementById('order-search-input').value.toLowerCase();
            const s = document.getElementById('order-status-select').value;
            document.querySelectorAll('.order-row').forEach(row => {
                const searchTxt = row.getAttribute('data-search') || '';
                const statusTxt = row.getAttribute('data-status') || '';
                const matchQ = !q || searchTxt.includes(q);
                const matchS = s === 'all' || statusTxt === s;
                row.style.display = (matchQ && matchS) ? '' : 'none';
            });
        }

        // Master Save Trigger
        function triggerMainSave() {
            const form = document.getElementById('form-master-save');
            if (form) form.submit();
        }

        // CSV Exporters
        function exportOrdersCSV() {
            let csv = "ID,Tanggal,Nama,Brand,WhatsApp,Paket,Jenis_Website,Status\n";
            document.querySelectorAll('.order-row').forEach((row, i) => {
                const cols = row.querySelectorAll('td');
                if (cols.length >= 6) {
                    csv += `"${cols[0].querySelector('div').innerText.trim()}","${cols[0].querySelectorAll('div')[1].innerText.trim()}","${cols[1].querySelector('div').innerText.trim()}","${cols[3].querySelector('div').innerText.trim()}","${cols[2].innerText.trim()}","${cols[4].innerText.trim()}","${cols[3].querySelectorAll('div')[1].innerText.trim()}","${cols[5].querySelector('select').value}"\n`;
                }
            });
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `rekap-order-solveta-${new Date().toISOString().slice(0,10)}.csv`;
            a.click();
        }

        function exportProfitCSV() {
            let csv = "Layanan,Harga_Jual,Total_HPP,Laba_Bersih,Estimasi_Order_Bulan\n";
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `hpp-margin-solveta-${new Date().toISOString().slice(0,10)}.csv`;
            a.click();
        }
    </script>
</body>
</html>
