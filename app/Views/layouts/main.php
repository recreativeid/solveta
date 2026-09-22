<!DOCTYPE html>
<html lang="id" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'SOLVETA — Mengubah Tantangan Bisnis Menjadi Solusi Digital') ?></title>
    <meta name="description" content="Jasa pembuatan website profesional, sistem kustom, web app, dan otomasi digital bisnis. Solusi teknologi efisien oleh SOLVETA Agency.">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/solveta-logo.png">

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            900: '#7f1d1d',
                            950: '#450a0a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-[#09090b] text-zinc-100 min-h-screen flex flex-col relative selection:bg-red-600 selection:text-white">

    <!-- Ambient Grid & Radial Background -->
    <div class="fixed inset-0 bg-grid-pattern opacity-40 pointer-events-none z-0"></div>
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[500px] hero-radial-glow pointer-events-none z-0"></div>

    <!-- Top Sticky Glass Navbar -->
    <header class="sticky top-0 z-50 w-full backdrop-blur-xl bg-[#09090b]/80 border-b border-white/[0.08] transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-red-950 p-[1px] shadow-lg shadow-red-900/30 group-hover:shadow-red-600/40 transition-all duration-300">
                    <div class="w-full h-full bg-[#09090b] rounded-[11px] flex items-center justify-center overflow-hidden">
                        <?php if (!empty($copy['site_logo'])): ?>
                            <img src="<?= esc($copy['site_logo']) ?>" alt="SOLVETA Logo" class="w-7 h-7 object-contain">
                        <?php else: ?>
                            <span class="font-heading font-black text-xl text-red-500">S</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="font-heading font-bold text-xl tracking-tight text-white flex items-center gap-1">
                        SOLVETA<span class="text-red-500">.</span>
                    </span>
                    <span class="text-[10px] tracking-widest text-zinc-400 font-semibold uppercase -mt-1">
                        Technology Agency
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-zinc-300">
                <a href="/#services" class="hover:text-red-400 transition-colors">Layanan</a>
                <a href="/#pricing" class="hover:text-red-400 transition-colors">Paket & Harga</a>
                <a href="/#portfolio" class="hover:text-red-400 transition-colors">Portofolio</a>
                <a href="/#process" class="hover:text-red-400 transition-colors">Alur Kerja</a>
                <a href="/formulir" class="text-zinc-200 hover:text-white flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-zinc-800/50 hover:bg-zinc-800 border border-zinc-700/50 transition-all">
                    <i data-lucide="file-text" class="w-4 h-4 text-red-500"></i>
                    <span>Formulir Brief</span>
                </a>
            </nav>

            <!-- Right CTA & Mobile Toggle -->
            <div class="flex items-center gap-4">
                <?php 
                    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285719663154');
                    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
                    $waHomeUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo SOLVETA, saya ingin berkonsultasi mengenai pembuatan website untuk bisnis saya.");
                ?>
                <a href="<?= $waHomeUrl ?>" target="_blank" rel="noopener noreferrer" 
                   class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white text-sm font-semibold shadow-lg shadow-red-700/30 hover:shadow-red-600/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Konsultasi Gratis</span>
                </a>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg bg-zinc-900 border border-zinc-800 text-zinc-300 hover:text-white" aria-label="Buka Menu">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-50 bg-[#09090b]/95 backdrop-blur-2xl hidden flex flex-col p-6 animate-fadeIn">
        <div class="flex items-center justify-between pb-6 border-b border-zinc-800">
            <span class="font-heading font-bold text-xl text-white">SOLVETA<span class="text-red-500">.</span></span>
            <button id="close-mobile-menu" class="p-2 rounded-lg bg-zinc-900 text-zinc-400 hover:text-white" aria-label="Tutup Menu">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        <div class="flex flex-col gap-6 py-8 text-lg font-semibold">
            <a href="/#services" class="hover:text-red-500 py-2 border-b border-zinc-900" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Layanan</a>
            <a href="/#pricing" class="hover:text-red-500 py-2 border-b border-zinc-900" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Paket & Harga</a>
            <a href="/#portfolio" class="hover:text-red-500 py-2 border-b border-zinc-900" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Portofolio</a>
            <a href="/#process" class="hover:text-red-500 py-2 border-b border-zinc-900" onclick="document.getElementById('mobile-menu').classList.add('hidden')">Alur Kerja</a>
            <a href="/formulir" class="text-red-400 py-2 border-b border-zinc-900 flex items-center justify-between">
                <span>Isi Formulir Brief Pemesanan</span>
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </a>
            <a href="/admin/login" class="text-zinc-500 text-sm py-2">
                <span>Admin Login Portal</span>
            </a>
        </div>
        <div class="mt-auto">
            <a href="<?= $waHomeUrl ?>" target="_blank" rel="noopener noreferrer" 
               class="w-full py-3.5 rounded-xl bg-red-600 text-white text-center font-bold flex items-center justify-center gap-2 shadow-lg shadow-red-600/30">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
                <span>Hubungi via WhatsApp</span>
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow z-10">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-[#060608] border-t border-white/[0.08] relative z-10 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pb-12 border-b border-white/[0.08]">
                <!-- Brand Info -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-red-600 to-red-950 p-[1px] flex items-center justify-center">
                            <span class="font-heading font-black text-lg text-white">S</span>
                        </div>
                        <span class="font-heading font-bold text-2xl text-white">SOLVETA<span class="text-red-500">.</span></span>
                    </div>
                    <p class="text-zinc-400 text-sm leading-relaxed max-w-md">
                        <?= esc($copy['hero_subtitle'] ?? 'Mengubah tantangan bisnis menjadi solusi digital dan otomasi efisien yang siap pakai.') ?>
                    </p>
                    <div class="flex items-center gap-3 text-xs text-zinc-500 pt-2">
                        <span class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-zinc-900 border border-zinc-800 text-zinc-400">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Online & Melayani Seluruh Indonesia
                        </span>
                    </div>
                </div>

                <!-- Quick Navigation -->
                <div>
                    <h4 class="font-heading font-bold text-white text-sm uppercase tracking-wider mb-4">Navigasi Cepat</h4>
                    <ul class="space-y-2.5 text-sm text-zinc-400">
                        <li><a href="/#services" class="hover:text-red-400 transition-colors">Layanan Kami</a></li>
                        <li><a href="/#pricing" class="hover:text-red-400 transition-colors">Paket & Harga</a></li>
                        <li><a href="/#portfolio" class="hover:text-red-400 transition-colors">Katalog Portofolio</a></li>
                        <li><a href="/#process" class="hover:text-red-400 transition-colors">Alur Pengerjaan</a></li>
                        <li><a href="/formulir" class="hover:text-red-400 transition-colors">Formulir Pemesanan</a></li>
                    </ul>
                </div>

                <!-- Contact & Legal -->
                <div>
                    <h4 class="font-heading font-bold text-white text-sm uppercase tracking-wider mb-4">Hubungi Kami</h4>
                    <ul class="space-y-3 text-sm text-zinc-400">
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="message-circle" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                            <a href="<?= $waHomeUrl ?>" target="_blank" class="hover:text-white transition-colors">
                                <?= esc($contact['whatsapp_display'] ?? '+62 857-1966-3154') ?>
                            </a>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="mail" class="w-4 h-4 text-red-500 shrink-0"></i>
                            <a href="mailto:<?= esc($contact['email'] ?? 'halo@solveta.asia') ?>" class="hover:text-white transition-colors">
                                <?= esc($contact['email'] ?? 'halo@solveta.asia') ?>
                            </a>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="globe" class="w-4 h-4 text-blue-500 shrink-0"></i>
                            <span><?= esc($contact['website_url'] ?? 'www.solveta.asia') ?></span>
                        </li>
                        <li class="pt-2">
                            <a href="/admin/login" class="text-xs text-zinc-600 hover:text-zinc-400 transition-colors flex items-center gap-1">
                                <i data-lucide="lock" class="w-3 h-3"></i>
                                <span>Portal Admin & Developer</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-zinc-500 gap-4">
                <p>&copy; <?= date('Y') ?> SOLVETA Technology Agency. Hak Cipta Dilindungi.</p>
                <p class="text-zinc-600">Built with CodeIgniter 4 & Native MySQL for High-Performance cPanel Hosting.</p>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Action Button -->
    <a href="<?= $waHomeUrl ?>" target="_blank" rel="noopener noreferrer" 
       class="wa-float-btn flex items-center gap-2.5 bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-3 rounded-full shadow-2xl shadow-emerald-900/50 group" 
       aria-label="Konsultasi via WhatsApp">
        <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
        </span>
        <i data-lucide="message-circle" class="w-5 h-5 text-white"></i>
        <span class="font-semibold text-xs tracking-wide pr-1 hidden sm:inline-block">Tanya Tim SOLVETA</span>
    </a>

    <!-- Scripts -->
    <script>
        lucide.createIcons();
    </script>
    <script src="/assets/js/main.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
