<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'SOLVETA — Developer Console') ?></title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Google Fonts: Poppins (Identical to Next.js Developer Console) -->
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
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        /* Hide scrollbar for IE, Edge and Firefox */
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

    <!-- LEFT SIDEBAR (CLEAN MINIMALIST SAAS - 1:1 REPLICATION FROM NEXT.JS) -->
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
                <div class="flex items-center gap-1.5 text-xs text-gray-500 font-medium">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Database Aktif (MySQL)</span>
                </div>
            </div>
        </header>

        <!-- Dynamic Main Body Content -->
        <div class="flex-grow p-4 sm:p-6 lg:p-8 max-w-5xl w-full mx-auto space-y-6">

            <!-- =========================================================================
                 TAB 1: EDIT VISUAL & BRANDING
                 ========================================================================= -->
            <div id="tab-visual" class="tab-pane active space-y-6">
                <form action="/admin/update-copy" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <?= csrf_field() ?>

                    <!-- Brand Logo Changer -->
                    <div class="p-5 bg-white rounded-xl border border-gray-200/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3.5">
                            <div class="w-12 h-12 rounded-lg overflow-hidden border border-gray-200 bg-white flex-shrink-0 flex items-center justify-center">
                                <img src="<?= esc($copy['site_logo'] ?? '/solveta-logo.png') ?>" alt="Brand Logo" class="w-full h-full object-contain p-1">
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-gray-900">Logo Resmi SOLVETA</h3>
                                <p class="text-[11px] text-gray-400">Tampil pada Navbar kiri atas, Footer, dan Opening Screen.</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <input type="file" name="site_logo_file" id="site_logo_file" accept="image/*" class="text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-gray-100 file:text-gray-800 hover:file:bg-gray-200 cursor-pointer">
                        </div>
                    </div>

                    <!-- Hero Section Card -->
                    <div class="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Hero Section</h2>
                            <span class="text-[11px] text-gray-400">Bagian Pembuka Halaman Utama</span>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <label class="block text-[11px] font-medium text-gray-600 mb-1">Eyebrow Badge (Teks Atas)</label>
                                <input type="text" name="hero_eyebrow" value="<?= esc($copy['hero_eyebrow'] ?? 'SOLVE TECHNOLOGY AGENCY') ?>"
                                       class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900">
                            </div>

                            <div>
                                <label class="block text-[11px] font-medium text-gray-600 mb-1">Headline Utama</label>
                                <textarea name="hero_headline" rows="2"
                                          class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900"><?= esc($copy['hero_headline'] ?? 'Mengubah Tantangan Bisnis Menjadi Solusi Digital.') ?></textarea>
                            </div>

                            <div>
                                <label class="block text-[11px] font-medium text-gray-600 mb-1">Subheadline / Deskripsi Pengantar</label>
                                <textarea name="hero_subtitle" rows="3"
                                          class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900"><?= esc($copy['hero_subtitle'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Marquee Slider Controls Card -->
                    <div class="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <div>
                                <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Pengaturan Marquee Logo Klien</h2>
                                <p class="text-[11px] text-gray-400">Sesuaikan kecepatan, ukuran logo, jarak spasi, dan lebar maksimal slider logo.</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-[11px] font-medium text-gray-600 mb-1">Judul / Caption Marquee</label>
                                <input type="text" name="marquee_title" value="<?= esc($copy['marquee_title'] ?? 'DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG') ?>"
                                       class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                <!-- Kecepatan Slider -->
                                <div>
                                    <div class="flex justify-between text-[11px] text-gray-600 mb-1">
                                        <span>Kecepatan Marquee</span>
                                        <span id="lbl-speed" class="font-mono font-semibold text-gray-900"><?= esc($copy['marquee_speed'] ?? 35) ?>s</span>
                                    </div>
                                    <input type="range" name="marquee_speed" min="10" max="60" value="<?= esc($copy['marquee_speed'] ?? 35) ?>"
                                           oninput="document.getElementById('lbl-speed').innerText = this.value + 's'"
                                           class="w-full accent-gray-900 cursor-pointer">
                                </div>

                                <!-- Tinggi Logo -->
                                <div>
                                    <div class="flex justify-between text-[11px] text-gray-600 mb-1">
                                        <span>Tinggi Logo (Height)</span>
                                        <span id="lbl-height" class="font-mono font-semibold text-gray-900"><?= esc($copy['marquee_logo_height'] ?? 46) ?>px</span>
                                    </div>
                                    <input type="range" name="marquee_logo_height" min="24" max="80" value="<?= esc($copy['marquee_logo_height'] ?? 46) ?>"
                                           oninput="document.getElementById('lbl-height').innerText = this.value + 'px'"
                                           class="w-full accent-gray-900 cursor-pointer">
                                </div>

                                <!-- Jarak Spasi Antar Logo -->
                                <div>
                                    <div class="flex justify-between text-[11px] text-gray-600 mb-1">
                                        <span>Jarak Spasi Antar Logo</span>
                                        <span id="lbl-spacing" class="font-mono font-semibold text-gray-900"><?= esc($copy['marquee_logo_spacing'] ?? 36) ?>px</span>
                                    </div>
                                    <input type="range" name="marquee_logo_spacing" min="16" max="64" value="<?= esc($copy['marquee_logo_spacing'] ?? 36) ?>"
                                           oninput="document.getElementById('lbl-spacing').innerText = this.value + 'px'"
                                           class="w-full accent-gray-900 cursor-pointer">
                                </div>

                                <!-- Skala Global Logo -->
                                <div>
                                    <div class="flex justify-between text-[11px] text-gray-600 mb-1">
                                        <span>Skala Global Logo</span>
                                        <span id="lbl-scale" class="font-mono font-semibold text-gray-900"><?= esc($copy['marquee_logo_scale'] ?? 100) ?>%</span>
                                    </div>
                                    <input type="range" name="marquee_logo_scale" min="50" max="200" value="<?= esc($copy['marquee_logo_scale'] ?? 100) ?>"
                                           oninput="document.getElementById('lbl-scale').innerText = this.value + '%'"
                                           class="w-full accent-gray-900 cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Consultation CTA Card -->
                    <div class="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Banner Konsultasi CTA</h2>
                            <span class="text-[11px] text-gray-400">Bagian Bawah Halaman</span>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <label class="block text-[11px] font-medium text-gray-600 mb-1">Judul Banner Konsultasi</label>
                                <input type="text" name="consultation_title" value="<?= esc($copy['consultation_title'] ?? 'TIDAK TAHU HARUS MULAI DARI MANA?') ?>"
                                       class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900">
                            </div>

                            <div>
                                <label class="block text-[11px] font-medium text-gray-600 mb-1">Deskripsi Banner</label>
                                <textarea name="consultation_desc" rows="2"
                                          class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none text-gray-900"><?= esc($copy['consultation_desc'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="py-2.5 px-6 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Simpan Perubahan Visual</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- =========================================================================
                 TAB 2: PAKET & HARGA
                 ========================================================================= -->
            <div id="tab-pricing" class="tab-pane space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Manajemen 4 Paket Harga</h2>
                        <p class="text-[11px] text-gray-400">Kelola spesifikasi, harga baru (STARTER 349K, STANDARD 699K, PREMIUM 964K, PLATINUM 1.5jt), checklist fitur & WhatsApp template.</p>
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
                                        class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-800 text-[11px] font-medium rounded-lg transition-colors flex items-center gap-1">
                                    <i data-lucide="edit" class="w-3 h-3"></i>
                                    <span>Edit Paket</span>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- =========================================================================
                 TAB 3: KELOLA HPP & MARGIN (PROFIT & LOSS MANAGER)
                 ========================================================================= -->
            <div id="tab-profit" class="tab-pane space-y-6">
                <!-- Summary Metrics Banner -->
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
                        <button type="button" onclick="exportProfitCSV()" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg flex items-center gap-1.5 transition-colors">
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
                 TAB 4: PORTOFOLIO
                 ========================================================================= -->
            <div id="tab-portfolio" class="tab-pane space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Portofolio Karya Digital (<?= count($portfolios) ?>)</h2>
                        <p class="text-[11px] text-gray-400">Tampil dalam Carousel 3D Coverflow interaktif pada halaman utama.</p>
                    </div>
                    <button type="button" onclick="openAddPortfolioModal()" class="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5">
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
                                            class="text-gray-500 hover:text-gray-900 text-xs p-1" title="Edit">
                                        <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                                    </button>
                                    <form action="/admin/portfolio/delete/<?= esc($port['id']) ?>" method="POST" onsubmit="return confirm('Hapus portofolio ini?');" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="text-red-400 hover:text-red-600 text-xs p-1" title="Hapus">
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
                 TAB 5: LOGO KLIEN (CLIENT MARQUEE & LOGO STUDIO)
                 ========================================================================= -->
            <div id="tab-brands" class="tab-pane space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Logo Klien &amp; Partner Marquee (<?= count($brands) ?>)</h2>
                        <p class="text-[11px] text-gray-400">Logo resmi klien yang tampil pada dual-row infinite marquee. Menggunakan skala individu dan transparansi otomatis.</p>
                    </div>
                    <button type="button" onclick="openAddBrandModal()" class="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                        <span>Upload Logo Klien</span>
                    </button>
                </div>

                <!-- Brands Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                    <?php foreach ($brands as $b): ?>
                        <div class="bg-white border border-gray-200/80 rounded-xl p-3 flex flex-col items-center justify-between space-y-3 hover:border-gray-300 transition-colors">
                            <div class="w-full aspect-[4/3] bg-gray-50 rounded-lg border border-gray-100 p-2 flex items-center justify-center overflow-hidden">
                                <?php if (!empty($b['logo_image'])): ?>
                                    <img src="<?= esc($b['logo_image']) ?>" alt="Client Logo" class="max-h-full max-w-full object-contain filter grayscale contrast-125">
                                <?php else: ?>
                                    <span class="text-xs font-bold text-gray-400"><?= esc($b['name'] ?: 'Brand') ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="w-full text-center space-y-1">
                                <div class="text-[10px] font-mono text-gray-400">Skala: <?= esc($b['scale'] ?? 1.0) ?>x</div>
                                <div class="flex items-center justify-center gap-2 pt-1 border-t border-gray-100">
                                    <button type="button" onclick="openEditBrandModal(<?= htmlspecialchars(json_encode($b), ENT_QUOTES, 'UTF-8') ?>)"
                                            class="p-1 text-gray-400 hover:text-gray-900 text-xs" title="Edit Skala & Logo">
                                        <i data-lucide="sliders" class="w-3.5 h-3.5"></i>
                                    </button>
                                    <form action="/admin/brand/delete/<?= esc($b['id']) ?>" method="POST" onsubmit="return confirm('Hapus logo ini dari marquee?');" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="p-1 text-red-400 hover:text-red-600 text-xs" title="Hapus">
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
                 TAB 6: KONTAK WA & SOCIAL
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
                 TAB 7: VIDEO PROFIL
                 ========================================================================= -->
            <div id="tab-video" class="tab-pane space-y-6">
                <form action="/admin/update-copy" method="POST" enctype="multipart/form-data" class="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 space-y-5">
                    <?= csrf_field() ?>
                    <!-- Hidden preserve copy fields -->
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
                 TAB 8: REKAP FORMULIR ORDER (ORDER SUBMISSIONS)
                 ========================================================================= -->
            <div id="tab-orders" class="tab-pane space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Rekap 16 Data Formulir Order Masuk (<?= count($orders) ?>)</h2>
                        <p class="text-[11px] text-gray-400">Semua data brief kebutuhan website yang dikirimkan calon klien via formulir online.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="exportOrdersCSV()" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg flex items-center gap-1.5 transition-colors">
                            <i data-lucide="download" class="w-3.5 h-3.5"></i>
                            <span>Ekspor Excel/CSV</span>
                        </button>
                    </div>
                </div>

                <!-- Orders Filter & Search -->
                <div class="flex items-center gap-2">
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

                <!-- Submissions Table -->
                <div class="bg-white border border-gray-200/80 rounded-xl overflow-hidden shadow-none">
                    <div class="overflow-x-auto">
                        <table class="w-full text-[11px] text-left">
                            <thead class="bg-gray-50 text-gray-400 uppercase text-[9px] border-b border-gray-100">
                                <tr>
                                    <th class="px-4 py-2.5 font-medium">Tanggal</th>
                                    <th class="px-4 py-2.5 font-medium">Klien &amp; Brand</th>
                                    <th class="px-4 py-2.5 font-medium">Paket &amp; Tipe</th>
                                    <th class="px-4 py-2.5 font-medium">Kontak WA</th>
                                    <th class="px-4 py-2.5 font-medium">Status</th>
                                    <th class="px-4 py-2.5 text-right font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="orders-tbody" class="divide-y divide-gray-100">
                                <?php if (empty($orders)): ?>
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">Belum ada data formulir order masuk.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($orders as $ord): ?>
                                        <tr class="order-row hover:bg-gray-50/60 transition-colors"
                                            data-search="<?= strtolower(esc(($ord['full_name'] ?? '') . ' ' . ($ord['brand_name'] ?? '') . ' ' . ($ord['whatsapp_number'] ?? '') . ' ' . ($ord['selected_package'] ?? ''))) ?>"
                                            data-status="<?= esc($ord['status'] ?? 'Baru') ?>">
                                            <td class="px-4 py-3 font-mono text-gray-500 whitespace-nowrap">
                                                <?= esc(substr($ord['timestamp'] ?? $ord['created_at'] ?? '-', 0, 16)) ?>
                                            </td>
                                            <td class="px-4 py-3 font-medium text-gray-900">
                                                <div class="font-bold text-gray-950"><?= esc($ord['full_name']) ?></div>
                                                <div class="text-[10px] text-gray-400"><?= esc($ord['brand_name'] ?: '-') ?></div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="inline-block px-2 py-0.5 rounded bg-gray-100 font-semibold text-gray-800 text-[10px]">
                                                    <?= esc($ord['selected_package']) ?>
                                                </span>
                                                <div class="text-[10px] text-gray-400 mt-0.5 truncate max-w-[150px]"><?= esc($ord['website_type']) ?></div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $ord['whatsapp_number']) ?>?text=Halo%20<?= urlencode($ord['full_name']) ?>,%20kami%20dari%20SOLVETA" target="_blank"
                                                   class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 font-mono font-medium">
                                                    <i data-lucide="message-circle" class="w-3 h-3"></i>
                                                    <span><?= esc($ord['whatsapp_number']) ?></span>
                                                </a>
                                            </td>
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
                                            <td class="px-4 py-3 text-right whitespace-nowrap space-x-1">
                                                <button type="button" onclick="openOrderDetailModal(<?= htmlspecialchars(json_encode($ord), ENT_QUOTES, 'UTF-8') ?>)"
                                                        class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-[10px] font-medium rounded transition-colors" title="Lihat 16 Data Lengkap">
                                                    Detail
                                                </button>
                                                <form action="/admin/order/delete/<?= esc($ord['id']) ?>" method="POST" onsubmit="return confirm('Hapus formulir order ini?');" class="inline">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="p-1 text-red-400 hover:text-red-600 text-xs" title="Hapus">
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
                 TAB 9: PENCATATAN PROYEK & INVOICE GENERATOR
                 ========================================================================= -->
            <div id="tab-projects" class="tab-pane space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h2 class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Pencatatan Transaksi Proyek &amp; Invoice Resmi (<?= count($transactions) ?>)</h2>
                        <p class="text-[11px] text-gray-400">Generate invoice penagihan resmi otomatis dengan nomor invoice, status, komponen beban, dan cetak PDF.</p>
                    </div>
                    <button type="button" onclick="openAddTransactionModal()" class="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5">
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
                                    <th class="px-4 py-2.5 font-medium">No. Invoice</th>
                                    <th class="px-4 py-2.5 font-medium">Tanggal</th>
                                    <th class="px-4 py-2.5 font-medium">Klien &amp; Website</th>
                                    <th class="px-4 py-2.5 font-medium">Nilai Jasa</th>
                                    <th class="px-4 py-2.5 font-medium">Status</th>
                                    <th class="px-4 py-2.5 text-right font-medium">Aksi Invoice</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php if (empty($transactions)): ?>
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">Belum ada pencatatan transaksi proyek.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($transactions as $tx): ?>
                                        <tr class="hover:bg-gray-50/60 transition-colors">
                                            <td class="px-4 py-3 font-mono font-bold text-gray-900">
                                                <?= esc($tx['invoice_number']) ?>
                                            </td>
                                            <td class="px-4 py-3 font-mono text-gray-500 whitespace-nowrap">
                                                <?= esc($tx['date']) ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="font-bold text-gray-950"><?= esc($tx['customer_name']) ?></div>
                                                <div class="text-[10px] text-gray-400"><?= esc($tx['website_name'] ?: '-') ?></div>
                                            </td>
                                            <td class="px-4 py-3 font-mono font-bold text-gray-900">
                                                Rp <?= number_format((int)$tx['service_price'], 0, ',', '.') ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-semibold <?= $tx['status'] === 'Terlaksana' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' ?>">
                                                    <?= esc($tx['status']) ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap space-x-1.5">
                                                <a href="/admin/invoice/print/<?= esc($tx['id']) ?>" target="_blank"
                                                   class="px-2.5 py-1 bg-gray-900 hover:bg-black text-white text-[10px] font-medium rounded transition-colors inline-flex items-center gap-1">
                                                    <i data-lucide="printer" class="w-3 h-3"></i>
                                                    <span>Cetak Invoice</span>
                                                </a>
                                                <form action="/admin/transaction/delete/<?= esc($tx['id']) ?>" method="POST" onsubmit="return confirm('Hapus transaksi invoice ini?');" class="inline">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="p-1 text-red-400 hover:text-red-600 text-xs" title="Hapus">
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
         MODALS (CLEAN MINIMALIST SAAS POPUPS)
         ========================================================================= -->

    <!-- 1. Detail Modal Formulir Order (16 Fields) -->
    <div id="modal-order-detail" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 max-w-lg w-full max-h-[85vh] flex flex-col overflow-hidden shadow-2xl">
            <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-xs font-bold text-gray-900">Rincian Lengkap Formulir Klien (16 Field)</h3>
                <button type="button" onclick="closeModal('modal-order-detail')" class="text-gray-400 hover:text-gray-700"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <div id="order-detail-content" class="p-5 overflow-y-auto space-y-3 text-xs text-gray-700">
                <!-- Injected via JavaScript -->
            </div>
            <div class="p-3 border-t border-gray-100 bg-gray-50 flex justify-end">
                <button type="button" onclick="closeModal('modal-order-detail')" class="px-4 py-1.5 bg-gray-900 text-white text-xs font-medium rounded-lg">Tutup</button>
            </div>
        </div>
    </div>

    <!-- 2. Tambah/Edit Brand Modal -->
    <div id="modal-brand" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 max-w-sm w-full p-5 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 id="modal-brand-title" class="text-xs font-bold text-gray-900">Upload Logo Klien</h3>
                <button type="button" onclick="closeModal('modal-brand')" class="text-gray-400 hover:text-gray-700"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <form action="/admin/brand/save" method="POST" enctype="multipart/form-data" class="space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="brand-input-id">
                <input type="hidden" name="existing_logo" id="brand-input-existing">

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Nama Brand / Usaha (Opsional)</label>
                    <input type="text" name="name" id="brand-input-name" placeholder="Biarkan kosong untuk pure logo" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">File Logo (PNG Transparan Disarankan)</label>
                    <input type="file" name="logo_file" accept="image/*" class="w-full text-xs file:mr-2 file:py-1 file:px-2.5 file:rounded file:border-0 file:bg-gray-100 file:text-xs">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Skala Ukuran Individu (0.5 - 2.5)</label>
                    <input type="number" step="0.05" min="0.5" max="2.5" name="scale" id="brand-input-scale" value="1.0" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modal-brand')" class="px-3 py-1.5 text-xs text-gray-500">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-gray-900 text-white text-xs font-medium rounded-lg">Simpan Logo</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Tambah/Edit Portofolio Modal -->
    <div id="modal-portfolio" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 max-w-md w-full p-5 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 id="modal-portfolio-title" class="text-xs font-bold text-gray-900">Tambah Portofolio</h3>
                <button type="button" onclick="closeModal('modal-portfolio')" class="text-gray-400 hover:text-gray-700"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <form action="/admin/portfolio/save" method="POST" enctype="multipart/form-data" class="space-y-3">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="port-input-id">
                <input type="hidden" name="existing_image" id="port-input-existing">

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Judul Portofolio</label>
                    <input type="text" name="title" id="port-input-title" required class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Kategori</label>
                    <input type="text" name="category" id="port-input-category" placeholder="E-Commerce, Company Profile, F&B, dll" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">URL Website Live</label>
                    <input type="url" name="live_url" id="port-input-url" placeholder="https://..." class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none">
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" id="port-input-desc" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-gray-200 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-gray-600 mb-1">Gambar Thumbnail</label>
                    <input type="file" name="image_file" accept="image/*" class="w-full text-xs file:mr-2 file:py-1 file:px-2.5 file:rounded file:border-0 file:bg-gray-100 file:text-xs">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal('modal-portfolio')" class="px-3 py-1.5 text-xs text-gray-500">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-gray-900 text-white text-xs font-medium rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 4. Tambah/Edit Transaksi Proyek Modal -->
    <div id="modal-transaction" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 max-w-md w-full p-5 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-xs font-bold text-gray-900">Buat / Edit Transaksi Invoice</h3>
                <button type="button" onclick="closeModal('modal-transaction')" class="text-gray-400 hover:text-gray-700"><i data-lucide="x" class="w-4 h-4"></i></button>
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
                    <button type="button" onclick="closeModal('modal-transaction')" class="px-3 py-1.5 text-xs text-gray-500">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-gray-900 text-white text-xs font-medium rounded-lg">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Controllers -->
    <script>
        lucide.createIcons();

        // 1. Tab Switcher
        const tabTitles = {
            'visual': 'Edit Visual & Branding',
            'pricing': 'Paket & Harga Layanan',
            'profit': 'Kelola HPP & Margin Laba Rugi',
            'portfolio': 'Portofolio Proyek',
            'brands': 'Logo Klien & Marquee',
            'contact': 'Kontak WhatsApp & Social',
            'video': 'Video Profil Showcase',
            'orders': 'Rekap Formulir Order Klien',
            'projects': 'Pencatatan Proyek & Invoice Generator'
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

        // Brand Modals
        function openAddBrandModal() {
            document.getElementById('modal-brand-title').innerText = 'Upload Logo Klien Baru';
            document.getElementById('brand-input-id').value = '';
            document.getElementById('brand-input-existing').value = '';
            document.getElementById('brand-input-name').value = '';
            document.getElementById('brand-input-scale').value = '1.0';
            openModal('modal-brand');
        }
        function openEditBrandModal(b) {
            document.getElementById('modal-brand-title').innerText = 'Edit Skala Logo Klien';
            document.getElementById('brand-input-id').value = b.id || '';
            document.getElementById('brand-input-existing').value = b.logo_image || '';
            document.getElementById('brand-input-name').value = b.name || '';
            document.getElementById('brand-input-scale').value = b.scale || 1.0;
            openModal('modal-brand');
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

        // Order Detail Modal
        function openOrderDetailModal(ord) {
            const container = document.getElementById('order-detail-content');
            container.innerHTML = `
                <div class="grid grid-cols-2 gap-2 pb-3 border-b border-gray-100">
                    <div><span class="text-gray-400 block text-[10px]">Nama Lengkap</span><strong>${ord.full_name || '-'}</strong></div>
                    <div><span class="text-gray-400 block text-[10px]">Nama Brand</span><strong>${ord.brand_name || '-'}</strong></div>
                    <div><span class="text-gray-400 block text-[10px]">WhatsApp</span><a href="https://wa.me/${(ord.whatsapp_number||'').replace(/[^0-9]/g, '')}" target="_blank" class="text-emerald-600 underline">${ord.whatsapp_number || '-'}</a></div>
                    <div><span class="text-gray-400 block text-[10px]">Paket Dipilih</span><span class="bg-gray-100 px-1.5 py-0.5 rounded font-bold">${ord.selected_package || '-'}</span></div>
                </div>
                <div class="space-y-2 pt-1">
                    <div><span class="text-gray-400 block text-[10px]">Jenis Website:</span><p class="font-medium">${ord.website_type || '-'}</p></div>
                    <div><span class="text-gray-400 block text-[10px]">Halaman Dibutuhkan:</span><p class="text-gray-600">${ord.pages_needed || '-'}</p></div>
                    <div><span class="text-gray-400 block text-[10px]">Tema Desain & Warna:</span><p class="text-gray-600">${ord.design_color_theme || '-'}</p></div>
                    <div><span class="text-gray-400 block text-[10px]">Deskripsi Usaha:</span><p class="text-gray-600">${ord.business_description || '-'}</p></div>
                    <div><span class="text-gray-400 block text-[10px]">Status Domain:</span><p class="text-gray-600">${ord.has_domain || '-'}</p></div>
                    <div><span class="text-gray-400 block text-[10px]">Status Logo:</span><p class="text-gray-600">${ord.has_logo || '-'}</p></div>
                    <div><span class="text-gray-400 block text-[10px]">Catatan Khusus:</span><p class="text-gray-600">${ord.special_notes || '-'}</p></div>
                </div>
            `;
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

        // CSV Exporters
        function exportOrdersCSV() {
            let csv = "ID,Tanggal,Nama,Brand,WhatsApp,Paket,Jenis_Website,Status\n";
            document.querySelectorAll('.order-row').forEach((row, i) => {
                const cols = row.querySelectorAll('td');
                if (cols.length >= 5) {
                    csv += `"${i+1}","${cols[0].innerText.trim()}","${cols[1].querySelector('div').innerText.trim()}","","${cols[3].innerText.trim()}","${cols[2].querySelector('span').innerText.trim()}","","${cols[4].querySelector('select').value}"\n`;
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
