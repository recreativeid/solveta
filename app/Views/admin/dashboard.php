<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin CMS & Portal Manajemen — SOLVETA') ?></title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    
    <style>
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .sidebar-btn.active { background-color: #dc2626; color: #ffffff; }
    </style>
</head>
<body class="bg-[#09090b] text-zinc-100 min-h-screen flex flex-col md:flex-row">

    <!-- Mobile Top Bar -->
    <div class="md:hidden flex items-center justify-between p-4 bg-[#0c0c10] border-b border-zinc-800 sticky top-0 z-40">
        <div class="flex items-center gap-2">
            <span class="font-heading font-black text-lg text-white">SOLVETA<span class="text-red-500">.</span></span>
            <span class="text-[10px] px-2 py-0.5 rounded bg-zinc-800 text-zinc-400">ADMIN</span>
        </div>
        <a href="/admin/logout" class="text-xs text-red-400 hover:text-red-300 flex items-center gap-1">
            <i data-lucide="log-out" class="w-4 h-4"></i>
            <span>Logout</span>
        </a>
    </div>

    <!-- Sidebar Navigation -->
    <aside class="w-full md:w-64 bg-[#0c0c10] border-r border-zinc-800/80 p-5 flex flex-col shrink-0 md:h-screen md:sticky md:top-0 overflow-y-auto">
        <!-- Brand -->
        <div class="hidden md:flex items-center gap-3 pb-6 border-b border-zinc-800">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-red-950 p-[1px]">
                <div class="w-full h-full bg-[#09090b] rounded-[11px] flex items-center justify-center">
                    <span class="font-heading font-black text-xl text-red-500">S</span>
                </div>
            </div>
            <div>
                <span class="font-heading font-bold text-lg text-white block leading-tight">SOLVETA<span class="text-red-500">.</span></span>
                <span class="text-[10px] text-zinc-500 font-semibold tracking-wider uppercase">CMS & Management</span>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <nav class="space-y-1 py-6 flex-grow">
            <button type="button" onclick="switchTab('overview')" id="btn-tab-overview"
                    class="sidebar-btn active w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all text-left">
                <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0"></i>
                <span>Ringkasan Dashboard</span>
            </button>

            <button type="button" onclick="switchTab('copy')" id="btn-tab-copy"
                    class="sidebar-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all text-left">
                <i data-lucide="file-text" class="w-4 h-4 shrink-0"></i>
                <span>Teks & Visual Web</span>
            </button>

            <button type="button" onclick="switchTab('pricing')" id="btn-tab-pricing"
                    class="sidebar-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all text-left">
                <i data-lucide="tag" class="w-4 h-4 shrink-0"></i>
                <span>Paket & Harga (<?= count($tiers) ?>)</span>
            </button>

            <button type="button" onclick="switchTab('portfolio')" id="btn-tab-portfolio"
                    class="sidebar-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all text-left">
                <i data-lucide="image" class="w-4 h-4 shrink-0"></i>
                <span>Portofolio Proyek (<?= count($portfolios) ?>)</span>
            </button>

            <button type="button" onclick="switchTab('brands')" id="btn-tab-brands"
                    class="sidebar-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all text-left">
                <i data-lucide="building-2" class="w-4 h-4 shrink-0"></i>
                <span>Brand Marquee (<?= count($brands) ?>)</span>
            </button>

            <button type="button" onclick="switchTab('orders')" id="btn-tab-orders"
                    class="sidebar-btn w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all text-left">
                <div class="flex items-center gap-3">
                    <i data-lucide="inbox" class="w-4 h-4 shrink-0"></i>
                    <span>Submisi Formulir</span>
                </div>
                <?php if (count($orders) > 0): ?>
                    <span class="px-2 py-0.5 rounded-full bg-red-600 text-white text-[10px] font-bold"><?= count($orders) ?></span>
                <?php endif; ?>
            </button>

            <button type="button" onclick="switchTab('profit')" id="btn-tab-profit"
                    class="sidebar-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all text-left">
                <i data-lucide="trending-up" class="w-4 h-4 shrink-0"></i>
                <span>Kalkulator Profit & HPP</span>
            </button>

            <button type="button" onclick="switchTab('transactions')" id="btn-tab-transactions"
                    class="sidebar-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all text-left">
                <i data-lucide="receipt" class="w-4 h-4 shrink-0"></i>
                <span>Transaksi & Invoice (<?= count($transactions) ?>)</span>
            </button>

            <button type="button" onclick="switchTab('settings')" id="btn-tab-settings"
                    class="sidebar-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all text-left">
                <i data-lucide="settings" class="w-4 h-4 shrink-0"></i>
                <span>Akun & Keamanan</span>
            </button>
        </nav>

        <!-- Footer / Live View & Logout -->
        <div class="pt-4 border-t border-zinc-800 space-y-2">
            <a href="/" target="_blank" 
               class="w-full flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-medium text-zinc-400 hover:text-white hover:bg-zinc-900 transition-colors">
                <span class="flex items-center gap-2">
                    <i data-lucide="globe" class="w-4 h-4 text-emerald-500"></i>
                    <span>Buka Website Publik</span>
                </span>
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
            </a>

            <a href="/admin/logout" 
               class="w-full flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-medium text-red-400 hover:text-red-300 hover:bg-red-950/30 transition-colors">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                <span>Logout Keluar</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Workspace -->
    <main class="flex-grow p-4 sm:p-8 overflow-y-auto">
        
        <!-- Alerts Notification -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-6 p-4 rounded-2xl bg-emerald-950/70 border border-emerald-700/60 text-emerald-300 text-sm flex items-center justify-between animate-fadeIn">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400 shrink-0"></i>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-6 p-4 rounded-2xl bg-red-950/70 border border-red-700/60 text-red-300 text-sm flex items-center justify-between animate-fadeIn">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 shrink-0"></i>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-white">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        <?php endif; ?>

        <!-- ============================================================== -->
        <!-- TAB 0: OVERVIEW -->
        <!-- ============================================================== -->
        <div id="tab-overview" class="tab-content active space-y-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-zinc-800">
                <div>
                    <h1 class="font-heading font-extrabold text-2xl sm:text-3xl text-white">Ringkasan Sistem</h1>
                    <p class="text-xs text-zinc-400 mt-1">Status database lokal MySQL, portofolio aktif, dan performa transaksi SOLVETA.</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 rounded-full bg-emerald-950/80 border border-emerald-800/60 text-emerald-400 text-xs font-semibold flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        CI4 & MySQL Localhost Ready
                    </span>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-2xl glass-panel border border-white/[0.08]">
                    <div class="flex items-center justify-between text-zinc-400 mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider">Portofolio Proyek</span>
                        <i data-lucide="image" class="w-4 h-4 text-red-500"></i>
                    </div>
                    <div class="font-heading font-black text-3xl text-white"><?= count($portfolios) ?></div>
                    <div class="text-[11px] text-zinc-500 mt-1">Karya aktif di halaman depan</div>
                </div>

                <div class="p-6 rounded-2xl glass-panel border border-white/[0.08]">
                    <div class="flex items-center justify-between text-zinc-400 mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider">Paket Harga</span>
                        <i data-lucide="tag" class="w-4 h-4 text-emerald-500"></i>
                    </div>
                    <div class="font-heading font-black text-3xl text-white"><?= count($tiers) ?></div>
                    <div class="text-[11px] text-zinc-500 mt-1">Paket aktif ditawarkan</div>
                </div>

                <div class="p-6 rounded-2xl glass-panel border border-white/[0.08]">
                    <div class="flex items-center justify-between text-zinc-400 mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider">Submisi Formulir</span>
                        <i data-lucide="inbox" class="w-4 h-4 text-blue-500"></i>
                    </div>
                    <div class="font-heading font-black text-3xl text-white"><?= count($orders) ?></div>
                    <div class="text-[11px] text-zinc-500 mt-1">Brief calon klien masuk</div>
                </div>

                <div class="p-6 rounded-2xl glass-panel border border-white/[0.08]">
                    <div class="flex items-center justify-between text-zinc-400 mb-3">
                        <span class="text-xs font-semibold uppercase tracking-wider">Total Transaksi</span>
                        <i data-lucide="receipt" class="w-4 h-4 text-amber-500"></i>
                    </div>
                    <div class="font-heading font-black text-3xl text-white"><?= count($transactions) ?></div>
                    <div class="text-[11px] text-zinc-500 mt-1">Invoice tercatat di sistem</div>
                </div>
            </div>

            <!-- Quick Action Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                <div class="p-6 rounded-2xl glass-panel border border-white/[0.08]">
                    <h3 class="font-heading font-bold text-lg text-white mb-2 flex items-center gap-2">
                        <i data-lucide="sparkles" class="w-5 h-5 text-red-500"></i>
                        <span>Aksi Cepat Pengelolaan</span>
                    </h3>
                    <p class="text-xs text-zinc-400 mb-6">Pilih menu untuk memperbarui konten website secara real-time:</p>
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <button type="button" onclick="switchTab('portfolio')" class="p-3 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-zinc-300 hover:text-white border border-zinc-800 text-left transition-colors flex items-center gap-2">
                            <i data-lucide="plus" class="w-4 h-4 text-red-500"></i>
                            <span>Tambah Portofolio</span>
                        </button>
                        <button type="button" onclick="switchTab('copy')" class="p-3 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-zinc-300 hover:text-white border border-zinc-800 text-left transition-colors flex items-center gap-2">
                            <i data-lucide="edit-3" class="w-4 h-4 text-red-500"></i>
                            <span>Edit Headline Hero</span>
                        </button>
                        <button type="button" onclick="switchTab('transactions')" class="p-3 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-zinc-300 hover:text-white border border-zinc-800 text-left transition-colors flex items-center gap-2">
                            <i data-lucide="plus" class="w-4 h-4 text-emerald-500"></i>
                            <span>Buat Invoice Baru</span>
                        </button>
                        <button type="button" onclick="switchTab('orders')" class="p-3 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-zinc-300 hover:text-white border border-zinc-800 text-left transition-colors flex items-center gap-2">
                            <i data-lucide="message-circle" class="w-4 h-4 text-emerald-500"></i>
                            <span>Tinjau Pesanan Masuk</span>
                        </button>
                    </div>
                </div>

                <div class="p-6 rounded-2xl glass-panel border border-white/[0.08]">
                    <h3 class="font-heading font-bold text-lg text-white mb-2 flex items-center gap-2">
                        <i data-lucide="server" class="w-5 h-5 text-emerald-500"></i>
                        <span>Informasi Server cPanel</span>
                    </h3>
                    <ul class="space-y-3 text-xs text-zinc-300">
                        <li class="flex items-center justify-between pb-2 border-b border-zinc-800">
                            <span class="text-zinc-500">Framework:</span>
                            <span class="font-mono text-zinc-200">CodeIgniter <?= \CodeIgniter\CodeIgniter::CI_VERSION ?></span>
                        </li>
                        <li class="flex items-center justify-between pb-2 border-b border-zinc-800">
                            <span class="text-zinc-500">PHP Version:</span>
                            <span class="font-mono text-zinc-200"><?= PHP_VERSION ?></span>
                        </li>
                        <li class="flex items-center justify-between pb-2 border-b border-zinc-800">
                            <span class="text-zinc-500">Database Driver:</span>
                            <span class="font-mono text-zinc-200">MySQLi (Localhost)</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-zinc-500">Domain Publik:</span>
                            <span class="font-mono text-red-400">solveta.asia</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- TAB 1: VISUAL & SITE COPY -->
        <!-- ============================================================== -->
        <div id="tab-copy" class="tab-content space-y-8">
            <div class="pb-6 border-b border-zinc-800">
                <h1 class="font-heading font-extrabold text-2xl text-white">Teks & Visual Media Website</h1>
                <p class="text-xs text-zinc-400 mt-1">Ubah headline, narasi hero, nomor WhatsApp, video profil, dan logo website.</p>
            </div>

            <!-- Site Copy Form -->
            <form action="/admin/update-copy" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-3xl glass-panel p-6 sm:p-8 border border-white/[0.08]">
                <?= csrf_field() ?>
                <h3 class="font-heading font-bold text-base text-white border-b border-zinc-800 pb-3 flex items-center gap-2">
                    <i data-lucide="type" class="w-4 h-4 text-red-500"></i>
                    <span>Teks Headline & Narasi</span>
                </h3>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Eyebrow Badge Hero</label>
                        <input type="text" name="hero_eyebrow" value="<?= esc($copy['hero_eyebrow'] ?? '') ?>"
                               class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Headline Utama Hero</label>
                        <input type="text" name="hero_headline" value="<?= esc($copy['hero_headline'] ?? '') ?>"
                               class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Subtitle / Deskripsi Hero</label>
                        <textarea name="hero_subtitle" rows="3" 
                                  class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500"><?= esc($copy['hero_subtitle'] ?? '') ?></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Judul Portofolio</label>
                            <input type="text" name="portfolio_title" value="<?= esc($copy['portfolio_title'] ?? '') ?>"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Judul Banner Konsultasi</label>
                            <input type="text" name="consultation_title" value="<?= esc($copy['consultation_title'] ?? '') ?>"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Deskripsi Banner Konsultasi</label>
                        <textarea name="consultation_desc" rows="2" 
                                  class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500"><?= esc($copy['consultation_desc'] ?? '') ?></textarea>
                    </div>
                </div>

                <h3 class="font-heading font-bold text-base text-white border-b border-zinc-800 pb-3 pt-4 flex items-center gap-2">
                    <i data-lucide="video" class="w-4 h-4 text-red-500"></i>
                    <span>Aset Media & Marquee</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Upload Video Profil (Laptop Hero)</label>
                        <input type="file" name="profile_video_file" accept="video/mp4"
                               class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700/80 text-zinc-300 text-xs focus:outline-none">
                        <span class="text-[11px] text-zinc-500 mt-1 block">Video saat ini: <?= esc($copy['profile_video'] ?? '/videos/profile.mp4') ?></span>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Upload Logo Website (Navbar)</label>
                        <input type="file" name="site_logo_file" accept="image/*"
                               class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700/80 text-zinc-300 text-xs focus:outline-none">
                        <span class="text-[11px] text-zinc-500 mt-1 block">Logo saat ini: <?= esc($copy['site_logo'] ?? '/solveta-logo.png') ?></span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Judul Marquee Slider</label>
                        <input type="text" name="marquee_title" value="<?= esc($copy['marquee_title'] ?? '') ?>"
                               class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Kecepatan Slider (Detik)</label>
                        <input type="number" name="marquee_speed" value="<?= esc($copy['marquee_speed'] ?? 35) ?>"
                               class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Tinggi Logo Marquee (px)</label>
                        <input type="number" name="marquee_logo_height" value="<?= esc($copy['marquee_logo_height'] ?? 46) ?>"
                               class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-xs flex items-center gap-2 shadow-lg">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Simpan Perubahan Teks & Media</span>
                    </button>
                </div>
            </form>

            <!-- Contact Settings Form -->
            <form action="/admin/update-contact" method="POST" class="space-y-6 rounded-3xl glass-panel p-6 sm:p-8 border border-white/[0.08]">
                <?= csrf_field() ?>
                <h3 class="font-heading font-bold text-base text-white border-b border-zinc-800 pb-3 flex items-center gap-2">
                    <i data-lucide="phone" class="w-4 h-4 text-emerald-500"></i>
                    <span>Kontak WhatsApp & Email Resmi</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Nomor WhatsApp API (Format: 628xxx)</label>
                        <input type="text" name="whatsapp_number" value="<?= esc($contact['whatsapp_number'] ?? '') ?>" required
                               class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Nomor WhatsApp Tampilan (Display)</label>
                        <input type="text" name="whatsapp_display" value="<?= esc($contact['whatsapp_display'] ?? '') ?>" required
                               class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Alamat Email Resmi</label>
                        <input type="email" name="email" value="<?= esc($contact['email'] ?? '') ?>" required
                               class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">URL Website</label>
                        <input type="text" name="website_url" value="<?= esc($contact['website_url'] ?? '') ?>" required
                               class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-2 shadow-lg">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>Simpan Kontak WhatsApp</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- ============================================================== -->
        <!-- TAB 2: PRICING TIERS -->
        <!-- ============================================================== -->
        <div id="tab-pricing" class="tab-content space-y-8">
            <div class="flex items-center justify-between pb-6 border-b border-zinc-800">
                <div>
                    <h1 class="font-heading font-extrabold text-2xl text-white">Paket & Harga Website</h1>
                    <p class="text-xs text-zinc-400 mt-1">Kelola paket penawaran, harga, fitur checklist, dan tombol WhatsApp.</p>
                </div>
                <button type="button" onclick="openTierModal()" 
                        class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-xs flex items-center gap-2 shadow-lg">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Tambah Paket Baru</span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($tiers as $tier): ?>
                    <div class="p-6 rounded-2xl glass-panel border border-white/[0.08] relative flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="font-heading font-black text-lg text-white uppercase"><?= esc($tier['name']) ?></span>
                                <span class="font-heading font-black text-2xl text-red-500"><?= esc($tier['price']) ?></span>
                            </div>
                            <div class="text-xs text-zinc-400 mb-4"><?= esc($tier['suitability']) ?></div>
                            <div class="space-y-1.5 text-xs text-zinc-300 mb-6">
                                <?php foreach ($tier['features'] as $ft): ?>
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-400"></i>
                                        <span><?= esc($ft) ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-zinc-800 flex items-center justify-between">
                            <span class="text-[11px] text-zinc-500">Urutan: <?= esc($tier['sort_order']) ?></span>
                            <div class="flex items-center gap-2">
                                <form action="/admin/pricing/delete/<?= esc($tier['id']) ?>" method="POST" onsubmit="return confirm('Hapus paket ini?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="p-2 rounded-lg bg-zinc-900 hover:bg-red-950/60 text-zinc-400 hover:text-red-400 border border-zinc-800 transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- TAB 3: PORTFOLIO CRUD -->
        <!-- ============================================================== -->
        <div id="tab-portfolio" class="tab-content space-y-8">
            <div class="flex items-center justify-between pb-6 border-b border-zinc-800">
                <div>
                    <h1 class="font-heading font-extrabold text-2xl text-white">Portofolio Proyek Website</h1>
                    <p class="text-xs text-zinc-400 mt-1">Upload gambar portofolio baru, tentukan kategori, deskripsi, dan tautan live.</p>
                </div>
                <button type="button" onclick="document.getElementById('portfolio-form-card').classList.toggle('hidden')" 
                        class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-xs flex items-center gap-2 shadow-lg">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Upload Proyek Baru</span>
                </button>
            </div>

            <!-- Add Portfolio Form Card (Toggleable) -->
            <div id="portfolio-form-card" class="rounded-3xl glass-panel p-6 sm:p-8 border border-white/[0.08]">
                <h3 class="font-heading font-bold text-base text-white mb-6 flex items-center gap-2">
                    <i data-lucide="plus-circle" class="w-4 h-4 text-red-500"></i>
                    <span>Formulir Portofolio Proyek Baru</span>
                </h3>
                <form action="/admin/portfolio/save" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <?= csrf_field() ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Judul Proyek</label>
                            <input type="text" name="title" required placeholder="Contoh: Brand X — E-Commerce"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Kategori</label>
                            <select name="category" class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                                <option value="E-Commerce">E-Commerce</option>
                                <option value="Website & Presence">Website & Presence</option>
                                <option value="Corporate Profile">Corporate Profile</option>
                                <option value="Custom System">Custom System</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Upload Foto Portofolio (JPG/PNG/WebP)</label>
                            <input type="file" name="image_file" accept="image/*"
                                   class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700/80 text-zinc-300 text-xs focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Tags (Pisahkan koma)</label>
                            <input type="text" name="tags" placeholder="E-Commerce, WhatsApp, Catalog"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Deskripsi Proyek</label>
                        <textarea name="description" rows="3" required placeholder="Jelaskan fitur dan keunggulan website ini..."
                                  class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">URL Live Proyek</label>
                            <input type="text" name="live_url" value="https://www.solveta.asia"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Urutan Tampil</label>
                            <input type="number" name="sort_order" value="1"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="submit" class="px-6 py-3 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-xs flex items-center gap-2 shadow-lg">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Simpan Portofolio</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Portfolio Table -->
            <div class="rounded-2xl glass-panel overflow-hidden border border-white/[0.08]">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-zinc-900/60 text-zinc-400 uppercase tracking-wider text-[11px]">
                            <th class="p-4">Foto</th>
                            <th class="p-4">Judul & Kategori</th>
                            <th class="p-4">Tags</th>
                            <th class="p-4">Urutan</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/60 text-zinc-300">
                        <?php foreach ($portfolios as $p): ?>
                            <tr class="hover:bg-zinc-800/30 transition-colors">
                                <td class="p-4">
                                    <img src="<?= esc($p['image_url']) ?>" alt="<?= esc($p['title']) ?>" class="w-16 h-10 object-cover rounded-lg border border-zinc-700">
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-white text-sm"><?= esc($p['title']) ?></div>
                                    <div class="text-[11px] text-red-400 mt-0.5"><?= esc($p['category']) ?></div>
                                </td>
                                <td class="p-4">
                                    <div class="flex flex-wrap gap-1">
                                        <?php foreach ($p['tags'] as $t): ?>
                                            <span class="px-2 py-0.5 rounded bg-zinc-800 text-[10px] text-zinc-400"><?= esc($t) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td class="p-4 font-mono"><?= esc($p['sort_order']) ?></td>
                                <td class="p-4 text-right">
                                    <form action="/admin/portfolio/delete/<?= esc($p['id']) ?>" method="POST" onsubmit="return confirm('Hapus portofolio ini?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="p-2 rounded-lg bg-zinc-900 hover:bg-red-950/60 text-zinc-400 hover:text-red-400 border border-zinc-800 transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- TAB 4: CLIENT BRANDS MARQUEE -->
        <!-- ============================================================== -->
        <div id="tab-brands" class="tab-content space-y-8">
            <div class="pb-6 border-b border-zinc-800">
                <h1 class="font-heading font-extrabold text-2xl text-white">Brand Klien Slider Marquee</h1>
                <p class="text-xs text-zinc-400 mt-1">Kelola logo nama instansi/klien yang muncul pada slider bergerak di beranda.</p>
            </div>

            <!-- Add Brand Form -->
            <form action="/admin/brand/save" method="POST" enctype="multipart/form-data" class="p-6 rounded-3xl glass-panel border border-white/[0.08] space-y-4">
                <?= csrf_field() ?>
                <h3 class="font-heading font-bold text-sm text-white flex items-center gap-2">
                    <i data-lucide="plus" class="w-4 h-4 text-red-500"></i>
                    <span>Tambah Brand Klien</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-zinc-400 uppercase mb-1">Nama Brand</label>
                        <input type="text" name="name" required placeholder="Contoh: Apex Global"
                               class="w-full px-3 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white text-xs">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-zinc-400 uppercase mb-1">Label Industri</label>
                        <input type="text" name="label" placeholder="Contoh: Manufacturing ERP"
                               class="w-full px-3 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white text-xs">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-zinc-400 uppercase mb-1">Upload File Logo (Opsional)</label>
                        <input type="file" name="logo_file" accept="image/*"
                               class="w-full px-3 py-2 rounded-xl bg-zinc-900 border border-zinc-700 text-zinc-300 text-xs">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-xs flex items-center justify-center gap-1.5 shadow-lg">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Simpan Brand</span>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Brands Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                <?php foreach ($brands as $b): ?>
                    <div class="p-4 rounded-xl glass-panel border border-white/[0.08] flex flex-col justify-between">
                        <div>
                            <div class="font-bold text-white text-xs mb-1"><?= esc($b['name']) ?></div>
                            <div class="text-[10px] text-zinc-500 mb-3"><?= esc($b['label']) ?></div>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-zinc-800">
                            <span class="text-[10px] text-zinc-600">Skala: <?= esc($b['scale']) ?>x</span>
                            <form action="/admin/brand/delete/<?= esc($b['id']) ?>" method="POST" onsubmit="return confirm('Hapus brand ini?')">
                                <?= csrf_field() ?>
                                <button type="submit" class="text-zinc-500 hover:text-red-400 text-xs">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- TAB 5: ORDER SUBMISSIONS -->
        <!-- ============================================================== -->
        <div id="tab-orders" class="tab-content space-y-8">
            <div class="pb-6 border-b border-zinc-800">
                <h1 class="font-heading font-extrabold text-2xl text-white">Submisi Formulir Pemesanan (<?= count($orders) ?>)</h1>
                <p class="text-xs text-zinc-400 mt-1">Daftar brief pemesanan 16 field yang dikirimkan oleh calon pelanggan.</p>
            </div>

            <?php if (empty($orders)): ?>
                <div class="p-12 rounded-3xl glass-panel text-center text-zinc-500">
                    <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-3 opacity-40"></i>
                    <p class="text-sm">Belum ada formulir pemesanan masuk. Formulir dari <a href="/formulir" class="text-red-400 underline">/formulir</a> akan tersimpan di sini.</p>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($orders as $ord): ?>
                        <?php 
                            $ordWaNum = preg_replace('/[^0-9]/', '', $ord['whatsapp_number']);
                            if (substr($ordWaNum, 0, 1) === '0') $ordWaNum = '62' . substr($ordWaNum, 1);
                            $waFollowUpUrl = "https://wa.me/{$ordWaNum}?text=" . rawurlencode("Halo {$ord['full_name']} dari {$ord['brand_name']}, kami dari SOLVETA telah menerima brief pemesanan website Anda. Kami siap membantu mewujudkan proyek ini!");
                        ?>
                        <div class="p-6 rounded-2xl glass-panel border border-white/[0.08] flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="space-y-2">
                                <div class="flex items-center gap-3">
                                    <span class="font-heading font-bold text-base text-white"><?= esc($ord['full_name']) ?></span>
                                    <span class="px-2.5 py-0.5 rounded-full bg-red-950/60 border border-red-800/40 text-red-400 font-semibold text-[11px]"><?= esc($ord['brand_name']) ?></span>
                                    <span class="text-xs text-zinc-500"><?= esc($ord['created_at']) ?></span>
                                </div>
                                <div class="text-xs text-zinc-400 flex flex-wrap gap-x-4 gap-y-1">
                                    <span><strong>Paket:</strong> <?= esc($ord['selected_package']) ?></span>
                                    <span><strong>Jenis:</strong> <?= esc($ord['website_type']) ?></span>
                                    <span><strong>WhatsApp:</strong> <?= esc($ord['whatsapp_number']) ?></span>
                                </div>
                                <div class="text-xs text-zinc-300 line-clamp-2">
                                    <strong>Kebutuhan:</strong> <?= esc($ord['business_description']) ?>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 shrink-0">
                                <a href="<?= $waFollowUpUrl ?>" target="_blank" rel="noopener noreferrer" 
                                   class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1.5 shadow-lg shadow-emerald-700/40">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    <span>Chat WhatsApp</span>
                                </a>

                                <form action="/admin/order/delete/<?= esc($ord['id']) ?>" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="p-2 rounded-xl bg-zinc-900 hover:bg-red-950/60 text-zinc-400 hover:text-red-400 border border-zinc-800">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- ============================================================== -->
        <!-- TAB 6: PROFIT & LOSS CALCULATOR -->
        <!-- ============================================================== -->
        <div id="tab-profit" class="tab-content space-y-8">
            <div class="pb-6 border-b border-zinc-800">
                <h1 class="font-heading font-extrabold text-2xl text-white">Kalkulator HPP & Estimasi Profit</h1>
                <p class="text-xs text-zinc-400 mt-1">Rincian modal domain, hosting, fee pengerjaan, dan proyeksi keuntungan bulanan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($profits as $pft): ?>
                    <?php 
                        $totalCost = 0;
                        foreach ($pft['costs'] as $c) {
                            $totalCost += (int) ($c['amount'] ?? 0);
                        }
                        $totalCostWithLabor = $totalCost + (int) ($pft['labor_fee'] ?? 0);
                        $netProfit = (int) $pft['selling_price'] - $totalCostWithLabor;
                        $monthlyEst = $netProfit * (int) ($pft['estimated_monthly_orders'] ?? 1);
                    ?>
                    <div class="p-6 rounded-2xl glass-panel border border-white/[0.08] flex flex-col justify-between">
                        <div>
                            <span class="font-heading font-bold text-base text-white block mb-1"><?= esc($pft['service_name']) ?></span>
                            <div class="font-heading font-black text-2xl text-white mb-4">
                                Rp <?= number_format($pft['selling_price'], 0, ',', '.') ?>
                            </div>

                            <div class="space-y-2 text-xs text-zinc-400 mb-6">
                                <div class="flex justify-between">
                                    <span>Biaya Infrastruktur:</span>
                                    <span class="text-zinc-200">Rp <?= number_format($totalCost, 0, ',', '.') ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Fee Tenaga Kerja:</span>
                                    <span class="text-zinc-200">Rp <?= number_format($pft['labor_fee'], 0, ',', '.') ?></span>
                                </div>
                                <div class="flex justify-between pt-2 border-t border-zinc-800 font-bold text-emerald-400">
                                    <span>Profit Bersih / Order:</span>
                                    <span>Rp <?= number_format($netProfit, 0, ',', '.') ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 rounded-xl bg-emerald-950/40 border border-emerald-800/40 text-xs">
                            <span class="text-zinc-400 block">Estimasi Profit (<?= $pft['estimated_monthly_orders'] ?> order/bln):</span>
                            <span class="font-heading font-extrabold text-emerald-400 text-lg">Rp <?= number_format($monthlyEst, 0, ',', '.') ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- TAB 7: PROJECT TRANSACTIONS & INVOICE -->
        <!-- ============================================================== -->
        <div id="tab-transactions" class="tab-content space-y-8">
            <div class="flex items-center justify-between pb-6 border-b border-zinc-800">
                <div>
                    <h1 class="font-heading font-extrabold text-2xl text-white">Transaksi & Invoice Klien</h1>
                    <p class="text-xs text-zinc-400 mt-1">Pencatatan invoice penagihan resmi klien dan cetak dokumen format A4.</p>
                </div>
                <button type="button" onclick="document.getElementById('tx-form-card').classList.toggle('hidden')"
                        class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-xs flex items-center gap-2 shadow-lg">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Buat Invoice Baru</span>
                </button>
            </div>

            <!-- Add Transaction Card (Toggleable) -->
            <div id="tx-form-card" class="rounded-3xl glass-panel p-6 sm:p-8 border border-white/[0.08]">
                <h3 class="font-heading font-bold text-base text-white mb-6 flex items-center gap-2">
                    <i data-lucide="receipt" class="w-4 h-4 text-red-500"></i>
                    <span>Formulir Pembuatan Invoice Transaksi</span>
                </h3>
                <form action="/admin/transaction/save" method="POST" class="space-y-6">
                    <?= csrf_field() ?>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Nomor Invoice</label>
                            <input type="text" name="invoice_number" placeholder="INV-2026-003"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Tanggal</label>
                            <input type="date" name="date" value="<?= date('Y-m-d') ?>"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Status Pembayaran</label>
                            <select name="status" class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                                <option value="Terlaksana">Terlaksana (Lunas)</option>
                                <option value="Progress" selected>Progress (Sedang Berjalan / DP)</option>
                                <option value="Batal">Batal</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Nama Klien</label>
                            <input type="text" name="customer_name" required placeholder="Bambang Wijaya"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Nomor Telepon / WhatsApp</label>
                            <input type="text" name="phone_number" required placeholder="081234567890"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Nama Website / Brand</label>
                            <input type="text" name="website_name" placeholder="Cuango Fashion"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Link Domain</label>
                            <input type="text" name="website_link" placeholder="https://cuango.com"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Total Biaya Jasa (Rp)</label>
                            <input type="number" name="service_price" required placeholder="749000"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Catatan Tambahan</label>
                        <textarea name="notes" rows="2" placeholder="Pembayaran via Transfer BCA, DP 50%..."
                                  class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500"></textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="submit" class="px-6 py-3 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-xs flex items-center gap-2 shadow-lg">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Simpan Transaksi & Terbitkan Invoice</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Transactions Table -->
            <div class="rounded-2xl glass-panel overflow-hidden border border-white/[0.08]">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-zinc-900/60 text-zinc-400 uppercase tracking-wider text-[11px]">
                            <th class="p-4">Invoice #</th>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Klien & Usaha</th>
                            <th class="p-4">Nominal</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/60 text-zinc-300">
                        <?php foreach ($transactions as $t): ?>
                            <tr class="hover:bg-zinc-800/30 transition-colors">
                                <td class="p-4 font-mono font-bold text-red-400"><?= esc($t['invoice_number']) ?></td>
                                <td class="p-4 text-zinc-400"><?= esc($t['date']) ?></td>
                                <td class="p-4">
                                    <div class="font-bold text-white"><?= esc($t['customer_name']) ?></div>
                                    <div class="text-[11px] text-zinc-500"><?= esc($t['website_name']) ?> (<?= esc($t['phone_number']) ?>)</div>
                                </td>
                                <td class="p-4 font-bold text-white font-mono">
                                    Rp <?= number_format($t['service_price'], 0, ',', '.') ?>
                                </td>
                                <td class="p-4">
                                    <?php if ($t['status'] === 'Terlaksana'): ?>
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-950/60 border border-emerald-800/60 text-emerald-400 text-[10px] font-bold">Lunas</span>
                                    <?php elseif ($t['status'] === 'Progress'): ?>
                                        <span class="px-2.5 py-1 rounded-full bg-amber-950/60 border border-amber-800/60 text-amber-400 text-[10px] font-bold">Progress</span>
                                    <?php else: ?>
                                        <span class="px-2.5 py-1 rounded-full bg-zinc-900 border border-zinc-800 text-zinc-400 text-[10px] font-bold">Batal</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="/admin/invoice/print/<?= esc($t['id']) ?>" target="_blank" 
                                           class="p-2 rounded-lg bg-zinc-900 hover:bg-zinc-800 text-zinc-300 hover:text-white border border-zinc-800" title="Cetak Invoice">
                                            <i data-lucide="printer" class="w-4 h-4"></i>
                                        </a>
                                        <form action="/admin/transaction/delete/<?= esc($t['id']) ?>" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="p-2 rounded-lg bg-zinc-900 hover:bg-red-950/60 text-zinc-400 hover:text-red-400 border border-zinc-800" title="Hapus">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- TAB 8: SETTINGS & ACCOUNT -->
        <!-- ============================================================== -->
        <div id="tab-settings" class="tab-content space-y-8">
            <div class="pb-6 border-b border-zinc-800">
                <h1 class="font-heading font-extrabold text-2xl text-white">Akun & Keamanan</h1>
                <p class="text-xs text-zinc-400 mt-1">Ubah password admin portal untuk menjaga keamanan dashboard.</p>
            </div>

            <form action="/admin/update-password" method="POST" class="max-w-md rounded-3xl glass-panel p-6 sm:p-8 border border-white/[0.08] space-y-6">
                <?= csrf_field() ?>
                <div>
                    <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Username Admin Saat Ini</label>
                    <input type="text" disabled value="<?= esc(session()->get('admin_username') ?? 'admin') ?>"
                           class="w-full px-4 py-3 rounded-xl bg-zinc-950 border border-zinc-800 text-zinc-500 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Password Baru</label>
                    <input type="password" name="new_password" required placeholder="Minimal 6 karakter"
                           class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-xs flex items-center justify-center gap-2 shadow-lg">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                    <span>Simpan Password Baru</span>
                </button>
            </form>
        </div>

    </main>

    <!-- Client-side Tab Switcher Script -->
    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.sidebar-btn').forEach(btn => btn.classList.remove('active'));

            const targetTab = document.getElementById('tab-' + tabId);
            const targetBtn = document.getElementById('btn-tab-' + tabId);

            if (targetTab) targetTab.classList.add('active');
            if (targetBtn) targetBtn.classList.add('active');

            window.location.hash = 'tab-' + tabId;
        }

        // Auto activate tab from URL hash on page load
        window.addEventListener('DOMContentLoaded', () => {
            const hash = window.location.hash.replace('#tab-', '');
            if (hash && document.getElementById('tab-' + hash)) {
                switchTab(hash);
            }
            lucide.createIcons();
        });
    </script>
</body>
</html>
