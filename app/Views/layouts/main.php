<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'SOLVETA — Solve Technology Agency | Mengubah Tantangan Bisnis Menjadi Solusi Digital') ?></title>
    <meta name="description" content="SOLVETA — Solve Technology Agency. Mengubah Tantangan Bisnis Menjadi Solusi Digital melalui website, otomasi, sistem digital, dan integrasi data.">
    <meta name="keywords" content="technology agency, digital solution, website development, otomasi bisnis, solveta">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link rel="icon" type="image/png" href="/solveta-logo.png">
    <link rel="apple-touch-icon" href="/solveta-logo.png">

    <!-- Google Fonts: Poppins & JetBrains Mono (Identical to Next.js) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Early Theme Detection (Prevents FOUC) -->
    <script>
        (function() {
            try {
                const savedTheme = localStorage.getItem("solveta_theme");
                if (savedTheme === "dark") {
                    document.documentElement.classList.add("dark");
                } else {
                    document.documentElement.classList.remove("dark");
                }
            } catch (e) {}
        })();
    </script>

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: "#FEF2F2",
                            100: "#FEE2E2",
                            200: "#FECACA",
                            300: "#FCA5A5",
                            400: "#F87171",
                            500: "#EF4444",
                            600: "#DC2626",
                            700: "#B91C1C",
                            800: "#991B1B",
                            900: "#7F1D1D",
                            950: "#450A0A",
                        },
                    },
                    fontFamily: {
                        sans: ["Poppins", "sans-serif"],
                        mono: ["JetBrains Mono", "monospace"],
                    },
                    boxShadow: {
                        "glass": "0 8px 32px 0 rgba(0, 0, 0, 0.04)",
                        "glass-hover": "0 16px 40px 0 rgba(220, 38, 38, 0.08)",
                        "red-glow": "0 0 20px rgba(220, 38, 38, 0.35)",
                        "2xs": "0 1px 2px 0 rgba(0, 0, 0, 0.05)",
                    },
                    animation: {
                        "pulse-slow": "pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite",
                        "float": "float 6s ease-in-out infinite",
                        "spin-slow": "spin 8s linear infinite",
                    },
                    keyframes: {
                        float: {
                            "0%, 100%": { transform: "translateY(0px)" },
                            "50%": { transform: "translateY(-8px)" },
                        },
                    },
                }
            }
        };
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css?v=<?= file_exists(FCPATH . 'assets/css/style.css') ? filemtime(FCPATH . 'assets/css/style.css') : '2.0' ?>">
</head>
<body class="font-sans antialiased bg-[#FDFBF9] dark:bg-[#07080E] text-gray-700 dark:text-gray-200 min-h-screen relative overflow-x-hidden selection:bg-rose-100 dark:selection:bg-rose-950 selection:text-rose-900 dark:selection:text-rose-200 transition-colors duration-200">

    <?php 
        $siteLogo = !empty($copy['site_logo']) ? $copy['site_logo'] : '/solveta-logo.png';
        $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285719663154');
        if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
        $waHomeUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo SOLVETA, saya ingin berkonsultasi mengenai solusi digital dan pembuatan website.");
    ?>

    <!-- ========================================================================= -->
    <!-- 1. OPENING SCREEN (Identical to Next.js OpeningScreen.tsx)               -->
    <!-- ========================================================================= -->
    <div id="opening-screen" class="fixed inset-0 z-[100] bg-white flex flex-col items-center justify-center p-6 select-none overflow-hidden font-sans transition-all duration-1000 ease-[cubic-bezier(0.22,1,0.36,1)]">
        <div id="opening-content" class="flex flex-col items-center max-w-lg w-full text-center relative z-10 transition-all duration-700">
            <!-- Logo Image - 100% Pure White Seamless Blend without Box -->
            <div class="mb-4 flex items-center justify-center bg-transparent">
                <img src="<?= esc($siteLogo) ?>" alt="SOLVETA" class="w-64 sm:w-80 md:w-96 h-auto object-contain bg-transparent">
            </div>

            <!-- Loading Progress Bar -->
            <div class="w-full max-w-[280px] sm:max-w-[340px] space-y-2.5 font-sans mt-2">
                <div class="h-1.5 sm:h-2 w-full bg-gray-100 rounded-full overflow-hidden p-0.5 border border-gray-200 shadow-inner">
                    <div id="opening-progress-bar" class="h-full bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] rounded-full shadow-sm transition-all duration-75" style="width: 0%;"></div>
                </div>

                <!-- Status and Percentage -->
                <div class="flex items-center justify-between text-xs font-semibold text-gray-500 px-1">
                    <span class="tracking-wider uppercase text-[10px] sm:text-[11px] text-gray-400 font-medium flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#8B0021] animate-ping"></span>
                        <span>MEMUAT SISTEM</span>
                    </span>
                    <span id="opening-percentage" class="font-bold text-[#8B0021] text-xs font-mono">0%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 2. STICKY GLASS NAVBAR (Identical to Next.js Navbar.tsx)                 -->
    <!-- ========================================================================= -->
    <header id="main-navbar" class="sticky top-0 left-0 right-0 z-50 transition-all duration-300 py-4 bg-white/80 dark:bg-[#07080E]/80 backdrop-blur-sm border-b border-gray-200/40 dark:border-gray-800/60 font-sans">
        <div class="max-w-[1160px] mx-auto px-6 flex items-center justify-between gap-4">
            
            <!-- Brand Logo in Top-Left Navbar -->
            <a href="/#hero" class="flex items-center gap-2.5 group">
                <div class="h-9 w-9 rounded-xl overflow-hidden flex items-center justify-center bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xs group-hover:border-rose-300 dark:group-hover:border-rose-500 transition-all">
                    <img src="<?= esc($siteLogo) ?>" alt="SOLVETA Logo" class="h-full w-full object-cover">
                </div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-base tracking-tight text-gray-950 dark:text-white group-hover:text-[#7B0B1E] dark:group-hover:text-rose-400 transition-colors leading-none">
                        SOLVETA
                    </span>
                    <span class="text-[9px] font-mono text-gray-400 dark:text-gray-500 font-semibold tracking-wider uppercase mt-0.5">
                        SOLUTIONS
                    </span>
                </div>
            </a>

            <!-- Center Search Bar with keyboard shortcut -->
            <div id="nav-search-trigger" class="hidden md:flex items-center gap-2.5 bg-gray-50/80 dark:bg-gray-900/80 hover:bg-gray-100 dark:hover:bg-gray-850 border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-700 rounded-full px-3.5 py-1.5 w-full max-w-[300px] cursor-pointer transition-all duration-200">
                <i data-lucide="search" class="w-3.5 h-3.5 text-gray-400"></i>
                <span class="text-xs text-gray-400 dark:text-gray-500 font-normal flex-grow">
                    Search solutions...
                </span>
                <span class="font-mono text-[10px] font-semibold text-gray-400 dark:text-gray-500 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 px-1.5 py-0.5 rounded">
                    ⌘ K
                </span>
            </div>

            <!-- Right Links & Actions -->
            <div class="flex items-center gap-3 sm:gap-4">
                <nav class="hidden lg:flex items-center gap-5 text-xs font-semibold text-gray-600 dark:text-gray-300">
                    <a href="/#services" class="hover:text-[#7B0B1E] dark:hover:text-rose-400 transition-colors">Services</a>
                    <a href="/#pricing" class="hover:text-[#7B0B1E] dark:hover:text-rose-400 transition-colors">Pricing</a>
                    <a href="/#portfolio" class="hover:text-[#7B0B1E] dark:hover:text-rose-400 transition-colors">Portofolio</a>
                </nav>

                <!-- Theme Toggle Button (Light / Dark Mode Switcher) -->
                <button id="theme-toggle-btn" type="button" aria-label="Ganti Tema" title="Ganti Mode Terang / Gelap"
                        class="p-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 text-gray-700 dark:text-amber-300 hover:bg-rose-50/50 dark:hover:bg-gray-800 shadow-2xs transition-all flex items-center justify-center cursor-pointer">
                    <i data-lucide="sun" id="theme-sun-icon" class="w-4 h-4 text-amber-400 hidden animate-spin-slow"></i>
                    <i data-lucide="moon" id="theme-moon-icon" class="w-4 h-4 text-gray-700 dark:text-gray-300 hover:text-[#7B0B1E]"></i>
                </button>

                <!-- Direct CTA WhatsApp Button -->
                <a href="<?= $waHomeUrl ?>" target="_blank" rel="noopener noreferrer" 
                   class="px-3.5 sm:px-4 py-2 text-xs font-bold text-white bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] rounded-lg transition-all shadow-xs flex items-center justify-center">
                    Hubungi Kami
                </a>

                <!-- Developer Portal Icon -->
                <a href="/admin" title="Portal Developer"
                   class="w-8 h-8 rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 hover:bg-rose-50/50 dark:hover:bg-gray-800 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-[#7B0B1E] dark:hover:text-rose-400 transition-colors">
                    <i data-lucide="user" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- ========================================================================= -->
    <!-- 3. SEARCH MODAL (Identical to Next.js SearchModal.tsx)                   -->
    <!-- ========================================================================= -->
    <div id="search-modal" class="fixed inset-0 z-50 flex items-start justify-center pt-24 px-4 hidden font-sans">
        <!-- Backdrop -->
        <div id="search-modal-backdrop" class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity"></div>

        <!-- Dialog Box -->
        <div class="bg-white dark:bg-[#11121B] border border-gray-200 dark:border-gray-800 rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden relative z-10">
            <!-- Input Header -->
            <div class="flex items-center gap-3 px-4 py-3.5 border-b border-gray-100 dark:border-gray-800">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                <input id="search-modal-input" type="text" placeholder="Cari solusi, paket, atau layanan..." 
                       class="w-full text-sm text-gray-900 dark:text-white placeholder-gray-400 outline-none bg-transparent">
                <button id="search-modal-close" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 p-1 rounded-md" aria-label="Tutup pencarian">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Results List -->
            <div id="search-results-list" class="max-h-72 overflow-y-auto p-2">
                <!-- Dynamically filtered via JS -->
            </div>

            <!-- Footer -->
            <div class="px-4 py-2 bg-gray-50 dark:bg-gray-900/60 border-t border-gray-100 dark:border-gray-800 text-[10px] text-gray-400 flex items-center justify-between">
                <span>Navigasi instan SOLVETA</span>
                <span class="font-mono">ESC untuk tutup</span>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 4. MAIN CONTENT AREA                                                     -->
    <!-- ========================================================================= -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- ========================================================================= -->
    <!-- 5. FOOTER (Identical to Next.js Footer.tsx)                              -->
    <!-- ========================================================================= -->
    <footer class="border-t border-gray-200 dark:border-gray-800 pt-16 pb-10 bg-white dark:bg-[#07080E] text-gray-700 dark:text-gray-300 relative transition-colors duration-200 font-sans">
        <div class="max-w-[1160px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-14">
                
                <!-- Col 1: Brand & Contact -->
                <div class="flex flex-col gap-2.5">
                    <div class="flex items-center gap-2.5">
                        <div class="h-9 w-9 rounded-xl overflow-hidden flex items-center justify-center bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xs flex-shrink-0">
                            <img src="<?= esc($siteLogo) ?>" alt="SOLVETA Logo" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <span class="font-extrabold text-base tracking-tight text-gray-900 dark:text-white block">
                                SOLVETA
                            </span>
                            <span class="text-[10px] text-gray-400 font-mono block">
                                Solve Technology Agency
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5 text-xs text-gray-600 dark:text-gray-400 mt-2">
                        <a href="<?= $waHomeUrl ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 hover:text-[#8B0021] dark:hover:text-rose-400 transition-colors">
                            <i data-lucide="phone" class="w-3.5 h-3.5 text-rose-600"></i>
                            <span><?= esc($contact['whatsapp_display'] ?? $contact['whatsapp_number'] ?? '+62 857-1966-3154') ?></span>
                        </a>
                        <a href="https://<?= esc($contact['website_url'] ?? 'solveta.asia') ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 hover:text-[#8B0021] dark:hover:text-rose-400 transition-colors">
                            <i data-lucide="globe" class="w-3.5 h-3.5 text-gray-400"></i>
                            <span><?= esc($contact['website_url'] ?? 'solveta.asia') ?></span>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Services -->
                <div>
                    <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-3.5">
                        Services
                    </h4>
                    <ul class="flex flex-col gap-2 text-xs text-gray-500 dark:text-gray-400">
                        <li>
                            <a href="/#services" class="hover:text-gray-900 dark:hover:text-white transition-colors">Process Development</a>
                        </li>
                        <li>
                            <a href="/#services" class="hover:text-gray-900 dark:hover:text-white transition-colors">Business Digitalization</a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Company -->
                <div>
                    <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-3.5">
                        Company
                    </h4>
                    <ul class="flex flex-col gap-2 text-xs text-gray-500 dark:text-gray-400">
                        <li>
                            <a href="/#hero" class="hover:text-gray-900 dark:hover:text-white transition-colors">About</a>
                        </li>
                        <li>
                            <a href="/#hero" class="hover:text-gray-900 dark:hover:text-white transition-colors">Careers</a>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Legal -->
                <div>
                    <h4 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-3.5">
                        Legal
                    </h4>
                    <ul class="flex flex-col gap-2 text-xs text-gray-500 dark:text-gray-400">
                        <li>
                            <a href="#" class="hover:text-gray-900 dark:hover:text-white transition-colors">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-gray-900 dark:hover:text-white transition-colors">Terms of Service</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar with Hidden Developer Portal Trigger -->
            <div class="border-t border-gray-100 dark:border-gray-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-gray-400 dark:text-gray-500">
                <span id="footer-secret-click" class="cursor-pointer hover:text-gray-600 dark:hover:text-gray-300 transition-colors select-none" title="Klik 3x untuk Developer Portal">
                    &copy; <?= date('Y') ?> SOLVETA. All rights reserved.
                </span>

                <a href="/admin" class="opacity-40 hover:opacity-100 transition-opacity flex items-center gap-1 text-[10px] text-gray-400 hover:text-[#8B0021] dark:hover:text-rose-400" title="Developer Portal Access">
                    <i data-lucide="lock" class="w-2.5 h-2.5"></i>
                    <span>Dev Access</span>
                </a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        lucide.createIcons();
    </script>
    <script src="/assets/js/main.js?v=<?= file_exists(FCPATH . 'assets/js/main.js') ? filemtime(FCPATH . 'assets/js/main.js') : '2.0' ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
