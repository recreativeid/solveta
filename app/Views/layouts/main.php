<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'SOLVETA — Solve Technology Agency | We Solve. You Grow.') ?></title>
    <meta name="description" content="<?= esc($meta_description ?? 'SOLVETA (Solve Technology Agency) adalah mitra solusi teknologi digital yang membantu bisnis bertransformasi dari proses manual menjadi lebih modern, efisien, dan terintegrasi melalui website profesional, aplikasi bisnis, dan sistem digital.') ?>">
    <meta name="keywords" content="Jasa pembuatan website, Jasa website profesional, Jasa pembuatan website bisnis, Digital agency Indonesia, Digital technology agency, Jasa pembuatan aplikasi bisnis, Jasa pembuatan sistem informasi, Jasa web developer, Jasa UI UX design, Jasa AI automation, Pengembangan website dan aplikasi, SOLVETA">
    <meta name="author" content="SOLVETA — Solve Technology Agency">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://solveta.asia<?= current_url(true)->getPath() ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://solveta.asia<?= current_url(true)->getPath() ?>">
    <meta property="og:title" content="<?= esc($title ?? 'SOLVETA — Solve Technology Agency | We Solve. You Grow.') ?>">
    <meta property="og:description" content="<?= esc($meta_description ?? 'Membantu bisnis berkembang melalui website, aplikasi, sistem digital, dan solusi teknologi yang dirancang sesuai kebutuhan.') ?>">
    <meta property="og:image" content="<?= base_url('solveta-logo.png') ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($title ?? 'SOLVETA — Solve Technology Agency') ?>">
    <meta name="twitter:description" content="We Solve. You Grow. Mitra solusi teknologi digital untuk pertumbuhan bisnis Anda.">
    <meta name="twitter:image" content="<?= base_url('solveta-logo.png') ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('solveta-logo.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('solveta-logo.png') ?>">

    <!-- Typography: Inter (Mandatory Font for Whole Website per Master Prompt) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Early Theme Detection -->
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

    <!-- Tailwind CSS (CDN) with Dominant White & Red Design Tokens -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        solveta: {
                            maroon: "#8E1738",       // Deep Corporate Maroon
                            red: "#C4264A",          // Primary Crimson Red
                            vibrant: "#FF4D2D",      // Active Accent Red
                            accent: "#F05A72",       // Soft Coral Accent
                            dark: "#111215",         // Pure Deep Text
                            charcoal: "#171717",     // Secondary Dark Text
                            muted: "#6B7280",        // Balanced Gray Text
                            bg: "#FFFFFF",           // Main Background Pure White
                            surface: "#FAFAFC",      // Clean Card Surface
                            border: "#E8E9ED",       // Light Gray Border
                        },
                        brand: {
                            50: "#FFF5F7",
                            100: "#FEE9ED",
                            200: "#FCD6DC",
                            300: "#F8AAB7",
                            400: "#F05A72",
                            500: "#C4264A",
                            600: "#8E1738",
                            700: "#76152F",
                            800: "#5B0F24",
                            900: "#3E0A18",
                        }
                    },
                    fontFamily: {
                        sans: ["'Inter'", "-apple-system", "BlinkMacSystemFont", "'Segoe UI'", "Roboto", "sans-serif"],
                        inter: ["'Inter'", "sans-serif"],
                        mono: ["'Inter'", "-apple-system", "sans-serif"],
                    },
                    boxShadow: {
                        "clean": "0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px -1px rgba(0, 0, 0, 0.03)",
                        "subtle": "0 4px 20px -2px rgba(17, 18, 21, 0.05)",
                        "editorial": "0 10px 30px -4px rgba(196, 38, 74, 0.08)",
                        "card-hover": "0 20px 40px -10px rgba(196, 38, 74, 0.12)",
                        "pill": "0 10px 30px -8px rgba(17, 18, 21, 0.08), 0 1px 3px rgba(17, 18, 21, 0.04)",
                        "glass": "0 8px 32px 0 rgba(196, 38, 74, 0.08)",
                    },
                    animation: {
                        "marquee": "marquee 32s linear infinite",
                        "marquee-reverse": "marquee 32s linear infinite reverse",
                        "pulse-slow": "pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite",
                    },
                    keyframes: {
                        marquee: {
                            "0%": { transform: "translateX(0%)" },
                            "100%": { transform: "translateX(-50%)" },
                        },
                    },
                }
            }
        };
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #FFFFFF;
            color: #111215;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .dark body, body.dark {
            background-color: #0E0F12;
            color: #F7F8FA;
        }
        
        /* Wajib Menggunakan Font Inter untuk Seluruh Elemen & Teks Keterangan */
        *, html, body, button, input, select, textarea, .font-mono, .font-sans, time, code, pre, span, p, h1, h2, h3, h4, h5, h6, a, div {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }

        .text-balance { text-wrap: balance; }
        
        /* Master Hero Background — Sesuai Arahan Presisi:
           Dari atas maroon agak gelap -> lalu merah -> lalu kebawah putih smooth (Zero Black) */
        .clean-hero-header {
            position: relative;
            background: linear-gradient(
                180deg,
                #4A0815 0%,              /* Top: Maroon agak gelap (warm deep burgundy/maroon) */
                #5C0A1B 10%,             /* Maroon transition halus */
                #780F25 22%,             /* Rich maroon velvet */
                #9B1331 34%,             /* Crimson maroon */
                #BE183D 46%,             /* Merah pekat menyala */
                #D81E46 56%,             /* Merah cerah (vibrant red core) */
                #E83359 66%,             /* Merah mulai membuka lembut */
                #F45B7A 74%,             /* Rose red lembut */
                #F994A7 82%,             /* Soft pink rose mist */
                #FDCFD8 90%,             /* Pinkish blush */
                #FEEFF2 96%,             /* Sangat halus menuju putih */
                #FFFFFF 100%             /* Bawah: Putih bersih murni 100% menyatu sempurna */
            );
        }
        .dark .clean-hero-header {
            position: relative;
            background: linear-gradient(
                180deg,
                #2D050D 0%,
                #3B0711 12%,
                #4D0A18 24%,
                #680D21 38%,
                #85122B 52%,
                #680D21 68%,
                #3B0711 82%,
                #14151B 95%,
                #14151B 100%
            );
        }

        /* Ambient Center Glow (Memperkaya Pendar Merah di Tengah Secara Halus) */
        .hero-linear-enricher {
            background: radial-gradient(
                85% 50% at 50% 52%,
                rgba(232, 51, 89, 0.28) 0%,
                rgba(196, 38, 74, 0.16) 42%,
                rgba(244, 91, 122, 0.06) 65%,
                transparent 80%
            );
        }
        .dark .hero-linear-enricher {
            background: radial-gradient(
                85% 50% at 50% 52%,
                rgba(232, 51, 89, 0.22) 0%,
                rgba(142, 23, 56, 0.14) 42%,
                transparent 80%
            );
        }

        /* Dotted Grid Overlay */
        .bg-grid-dots {
            background-image: radial-gradient(rgba(17, 18, 21, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .dark .bg-grid-dots {
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
        }

        /* Marquee pause on hover */
        .marquee-track:hover {
            animation-play-state: paused;
        }

        /* 3D Vertical Testimonial Marquee Keyframes & Smooth Pause */
        @keyframes marquee-vertical {
            0% { transform: translateY(0%); }
            100% { transform: translateY(-50%); }
        }
        @keyframes marquee-vertical-reverse {
            0% { transform: translateY(-50%); }
            100% { transform: translateY(0%); }
        }

        .animate-marquee-v {
            animation: marquee-vertical var(--duration, 38s) linear infinite;
        }
        .animate-marquee-v-reverse {
            animation: marquee-vertical-reverse var(--duration, 38s) linear infinite;
        }

        .marquee-3d-wrap:hover .animate-marquee-v,
        .marquee-3d-wrap:hover .animate-marquee-v-reverse,
        .marquee-column:hover .animate-marquee-v,
        .marquee-column:hover .animate-marquee-v-reverse {
            animation-play-state: paused;
        }

        /* 3D Perspective Tunnel Component Styles (Adapted from 21st.dev Perspective Tunnel Hero) */
        .perspective-tunnel-stage {
            perspective: 1200px;
            perspective-origin: 50% 45%;
            transform-style: preserve-3d;
        }
        .tunnel-world {
            transform-style: preserve-3d;
            transition: transform 0.25s ease-out;
        }
        .tunnel-card {
            transition: transform 0.65s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.5s ease, filter 0.5s ease;
            transform-style: preserve-3d;
            backface-visibility: hidden;
        }
        .tunnel-ring-1 {
            width: 320px; height: 320px;
            border: 1px dashed rgba(196, 38, 74, 0.35);
            border-radius: 9999px;
            transform: translate(-50%, -50%) translateZ(-400px);
        }
        .tunnel-ring-2 {
            width: 580px; height: 580px;
            border: 1px dashed rgba(196, 38, 74, 0.2);
            border-radius: 9999px;
            transform: translate(-50%, -50%) translateZ(-200px);
        }
        .tunnel-ring-3 {
            width: 860px; height: 860px;
            border: 1px solid rgba(196, 38, 74, 0.12);
            border-radius: 9999px;
            transform: translate(-50%, -50%) translateZ(0px);
        }

        /* ========================================================================= */
        /* LIQUID GLASS LOGO REVEAL COMPONENT (Background Putih Polos + Smooth Blur)   */
        /* ========================================================================= */
        #liquid-glass-intro {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: #FFFFFF;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transform: scale(1);
            filter: blur(0px);
            transition: opacity 1.1s cubic-bezier(0.16, 1, 0.3, 1), 
                        transform 1.1s cubic-bezier(0.16, 1, 0.3, 1), 
                        filter 1.1s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform, filter;
        }
        #liquid-glass-intro.dismissed {
            opacity: 0;
            transform: scale(1.06);
            filter: blur(28px);
            pointer-events: none;
        }

        .glass-tile-wrapper {
            position: relative;
            width: 280px;
            height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes dropletSwellLight {
            0% {
                width: 36px;
                height: 36px;
                border-radius: 9999px;
                opacity: 0;
                transform: scale(0.6);
                filter: blur(4px);
                box-shadow: 0 0 25px rgba(196, 38, 74, 0.3), inset 0 0 15px rgba(255, 255, 255, 0.9);
            }
            15% {
                width: 64px;
                height: 64px;
                border-radius: 9999px;
                opacity: 1;
                transform: scale(1);
                filter: blur(0px);
                box-shadow: 0 10px 30px rgba(196, 38, 74, 0.25), inset 0 0 25px rgba(255, 255, 255, 0.95);
            }
            45% {
                width: 260px;
                height: 260px;
                border-radius: 64px;
                box-shadow: 
                    0 25px 60px -15px rgba(196, 38, 74, 0.18),
                    0 10px 25px -5px rgba(0, 0, 0, 0.06),
                    inset 0 0 0 1.5px rgba(255, 255, 255, 0.95),
                    inset 0 20px 35px rgba(255, 255, 255, 0.95),
                    inset 0 -15px 30px rgba(196, 38, 74, 0.1);
            }
            100% {
                width: 250px;
                height: 250px;
                border-radius: 56px;
                box-shadow: 
                    0 22px 55px -15px rgba(196, 38, 74, 0.16),
                    0 8px 20px -4px rgba(0, 0, 0, 0.05),
                    inset 0 0 0 1.5px rgba(255, 255, 255, 0.95),
                    inset 0 18px 30px rgba(255, 255, 255, 0.95),
                    inset 0 -12px 25px rgba(196, 38, 74, 0.08);
            }
        }

        .liquid-glass-tile {
            position: relative;
            width: 250px;
            height: 250px;
            border-radius: 56px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(28px) saturate(180%);
            -webkit-backdrop-filter: blur(28px) saturate(180%);
            border: 1.5px solid rgba(255, 255, 255, 0.95);
            animation: dropletSwellLight 1.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .chromatic-bevel {
            position: absolute;
            inset: -2px;
            border-radius: 58px;
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.95) 0%, 
                rgba(0, 200, 255, 0.3) 25%, 
                rgba(196, 38, 74, 0.4) 50%, 
                rgba(255, 120, 80, 0.35) 75%, 
                rgba(255, 255, 255, 0.95) 100%
            );
            opacity: 0.8;
            mix-blend-mode: overlay;
            pointer-events: none;
        }

        @keyframes lightSweep {
            0% { transform: translateX(-150%) rotate(35deg); opacity: 0; }
            30% { opacity: 0.85; }
            70% { opacity: 0.85; }
            100% { transform: translateX(180%) rotate(35deg); opacity: 0; }
        }

        .specular-shine {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                90deg, 
                transparent 0%, 
                rgba(255, 255, 255, 0.3) 45%, 
                rgba(255, 255, 255, 0.95) 50%, 
                rgba(0, 200, 255, 0.25) 53%, 
                transparent 60%
            );
            pointer-events: none;
            animation: lightSweep 1.6s cubic-bezier(0.16, 1, 0.3, 1) 0.9s forwards;
        }

        @keyframes logoEmerge {
            0% { opacity: 0; transform: scale(0.7); filter: blur(6px); }
            40% { opacity: 0.4; transform: scale(0.88); }
            100% { opacity: 1; transform: scale(1); filter: blur(0px); }
        }

        .logo-inner-reveal {
            animation: logoEmerge 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.5s forwards;
            opacity: 0;
        }

        @keyframes textReveal {
            0% { opacity: 0; transform: translateY(12px); filter: blur(4px); }
            100% { opacity: 1; transform: translateY(0); filter: blur(0px); }
        }

        .reveal-caption {
            animation: textReveal 0.9s cubic-bezier(0.16, 1, 0.3, 1) 1s forwards;
            opacity: 0;
        }

        /* Minimalist Glassmorphism Footer Effect */
        .glass-footer {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid rgba(17, 18, 21, 0.06);
            position: relative;
        }
        .dark .glass-footer {
            background: rgba(14, 15, 18, 0.92);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }
        .glass-footer-glow {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(196, 38, 74, 0.5) 50%, transparent 100%);
            filter: blur(0.5px);
        }

        /* ========================================================================= */
        /* SCROLL REVEAL BLUR-IN ANIMATION ENGINE                                    */
        /* Hanya elemen baru dari bawah atau atas yang muncul dgn animasi blur halus */
        /* Bukan mem-blur seluruh layar, menjaga elemen yang sudah tampil tetap tajam*/
        /* ========================================================================= */
        .scroll-blur-reveal {
            opacity: 0;
            filter: blur(14px);
            transform: translateY(28px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        filter 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, filter, transform;
        }

        .scroll-blur-reveal.is-revealed {
            opacity: 1;
            filter: blur(0px);
            transform: translateY(0);
        }

        @media (prefers-reduced-motion: reduce) {
            .scroll-blur-reveal {
                opacity: 1 !important;
                filter: none !important;
                transform: none !important;
                transition: none !important;
            }
            .marquee-track {
                animation: none !important;
            }
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>

    <!-- Structured Data JSON-LD (Organization) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "SOLVETA",
      "alternateName": "Solve Technology Agency",
      "url": "https://solveta.asia",
      "logo": "https://solveta.asia/solveta-logo.png",
      "description": "Digital technology agency yang membantu bisnis, organisasi, UMKM, startup, dan perusahaan melalui solusi teknologi digital: website profesional, aplikasi bisnis, sistem manajemen, UI/UX design, dan AI automation.",
      "slogan": "We Solve. You Grow.",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+6285876603826",
        "contactType": "customer service",
        "availableLanguage": ["Indonesian", "English"]
      },
      "sameAs": [
        "https://www.instagram.com/solveta.asia"
      ]
    }
    </script>
</head>
<body class="font-sans antialiased bg-white dark:bg-[#0E0F12] text-[#111215] dark:text-[#F7F8FA] min-h-screen relative overflow-x-hidden selection:bg-[#C4264A] selection:text-white transition-colors duration-200">

    <?php 
        $siteLogo = !empty($copy['site_logo']) ? $copy['site_logo'] : '/solveta-logo.png';
        $currentPage = $current_page ?? 'home';

        $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
        if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
        $waNavUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin berkonsultasi mengenai solusi teknologi dan pengembangan website/aplikasi untuk bisnis kami.");
    ?>

    <?php if ($currentPage === 'home'): ?>
    <!-- ========================================================================= -->
    <!-- OPENING: LOGO REVEAL (Hapus Latar Belakang / Clean Transparent Logo)       -->
    <!-- Menampilkan logo resmi SOLVETA tanpa latar belakang & transisi blur halus -->
    <!-- ========================================================================= -->
    <div id="liquid-glass-intro" class="fixed inset-0 z-[99999] flex flex-col items-center justify-center select-none bg-white">
        
        <!-- Skip Intro Button (Clean Light Styling) -->
        <button id="skip-intro-btn" onclick="dismissIntro()" class="absolute top-5 right-5 sm:top-7 sm:right-7 text-[11px] font-sans text-neutral-500 hover:text-neutral-900 bg-neutral-100/90 hover:bg-neutral-200 border border-neutral-200/90 shadow-xs px-3.5 py-1.5 rounded-full transition flex items-center gap-1.5 cursor-pointer z-50">
            <span>Lewati Intro</span>
            <span class="text-neutral-400 font-sans">&rarr;</span>
        </button>

        <!-- Subtle Ambient Rose Glow behind logo on pure white background -->
        <div class="absolute w-[440px] h-[440px] rounded-full bg-[#C4264A]/8 blur-[90px] pointer-events-none"></div>

        <!-- Center Stage: Liquid Glass Logo Reveal (Denis Shepovalov Style - Transparent Mark) -->
        <div class="relative z-10 flex flex-col items-center justify-center px-4">
            <div class="glass-tile-wrapper">
                <div class="liquid-glass-tile">
                    <div class="chromatic-bevel"></div>
                    <div class="specular-shine"></div>
                    <div class="logo-inner-reveal flex items-center justify-center p-6 relative z-10">
                        <img src="<?= base_url('solveta-mark-transparent.png') ?>" alt="SOLVETA Concentric Mark" class="w-24 sm:w-28 h-24 sm:h-28 object-contain select-none drop-shadow-md">
                    </div>
                </div>
            </div>
            
            <!-- Sleek Typography below Glass Tile -->
            <div class="reveal-caption mt-6 flex flex-col items-center text-center">
                <span class="text-2xl sm:text-3xl font-black tracking-tight text-neutral-900 font-sans">SOLVETA</span>
                <span class="text-[10px] sm:text-[11px] tracking-[0.25em] text-[#C4264A] uppercase font-bold mt-1 font-sans">Solve Technology Agency</span>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ========================================================================= -->
    <!-- FLOATING NAVBAR (Shape Putih Murni Persis Sesuai Gambar Referensi)         -->
    <!-- 1. Beranda | 2. Layanan | 3. Portofolio | 4. Artikel | 5. Tentang Kami |  -->
    <!-- 6. Karir | 7. Kontak                                                      -->
    <!-- ========================================================================= -->
    <header id="floating-nav-container" class="fixed top-3 md:top-5 inset-x-3 md:inset-x-0 z-50 flex flex-col items-center pointer-events-none">
        <nav id="main-header" class="pointer-events-auto w-full max-w-5xl bg-white border border-neutral-200/80 shadow-lg shadow-black/5 rounded-full px-4 py-2 md:px-6 md:py-2.5 flex items-center justify-between transition-all duration-300">
            
            <!-- Left: Official SOLVETA Logo (Pakai Logo Resmi yang Diberikan) -->
            <a href="<?= base_url() ?>" class="flex items-center gap-2.5 group shrink-0">
                <div class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center group-hover:scale-105 transition-transform shrink-0 p-0.5">
                    <img src="<?= base_url('solveta-mark-transparent.png') ?>" alt="SOLVETA Logo" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <div class="flex items-baseline gap-1">
                        <span class="font-extrabold text-base md:text-lg tracking-tight leading-none text-[#111215]">
                            SOLVETA
                        </span>
                    </div>
                    <span class="text-[8.5px] font-bold tracking-wider uppercase text-[#C4264A] leading-none mt-0.5 font-sans">
                        SOLVE TECHNOLOGY AGENCY
                    </span>
                </div>
            </a>

            <!-- Center: Desktop Navigation Links (Disamakan Persis Sesuai Gambar Referensi) -->
            <div class="hidden md:flex items-center gap-5 lg:gap-6 text-[13px] font-semibold text-neutral-600">
                
                <!-- 1. Beranda -->
                <a href="<?= base_url() ?>" 
                   class="hover:text-[#C4264A] transition <?= $currentPage === 'home' ? 'text-[#C4264A] font-bold' : 'text-neutral-600' ?>">
                    Beranda
                </a>

                <!-- 2. Layanan -->
                <a href="<?= base_url('layanan') ?>" 
                   class="hover:text-[#C4264A] transition <?= $currentPage === 'layanan' ? 'text-[#C4264A] font-bold' : 'text-neutral-600' ?>">
                    Layanan
                </a>

                <!-- 3. Portofolio -->
                <a href="<?= base_url('portofolio') ?>" 
                   class="hover:text-[#C4264A] transition <?= $currentPage === 'portfolio' ? 'text-[#C4264A] font-bold' : 'text-neutral-600' ?>">
                    Portofolio
                </a>

                <!-- 4. Artikel -->
                <a href="<?= base_url('artikel') ?>" 
                   class="hover:text-[#C4264A] transition <?= $currentPage === 'artikel' ? 'text-[#C4264A] font-bold' : 'text-neutral-600' ?>">
                    Artikel
                </a>

                <!-- 5. Tentang Kami -->
                <a href="<?= base_url('tentang') ?>" 
                   class="hover:text-[#C4264A] transition <?= $currentPage === 'tentang' ? 'text-[#C4264A] font-bold' : 'text-neutral-600' ?>">
                    Tentang Kami
                </a>

                <!-- 6. Karir -->
                <a href="<?= base_url('karir') ?>" 
                   class="hover:text-[#C4264A] transition <?= $currentPage === 'karir' ? 'text-[#C4264A] font-bold' : 'text-neutral-600' ?>">
                    Karir
                </a>

                <!-- 7. Kontak -->
                <a href="<?= base_url('kontak') ?>" 
                   class="hover:text-[#C4264A] transition <?= $currentPage === 'kontak' ? 'text-[#C4264A] font-bold' : 'text-neutral-600' ?>">
                    Kontak
                </a>
            </div>

            <!-- Right: Action Buttons (Sesuai Gambar Referensi) -->
            <div class="flex items-center gap-2">
                <!-- Dark / Light Mode Switcher -->
                <button id="theme-toggle-btn" type="button" aria-label="Ganti Mode Tema" title="Mode Terang / Gelap"
                        class="w-8 h-8 rounded-full border border-neutral-200/80 bg-neutral-100 text-neutral-800 flex items-center justify-center transition-all cursor-pointer hover:bg-neutral-200 shadow-xs">
                    <i data-lucide="sun" id="theme-sun-icon" class="w-3.5 h-3.5 text-amber-500 hidden"></i>
                    <i data-lucide="moon" id="theme-moon-icon" class="w-3.5 h-3.5 text-neutral-800"></i>
                </button>

                <!-- Primary Navbar CTA: WhatsApp (Konsultasi Merah Persis Gambar Referensi) -->
                <a href="<?= $waNavUrl ?>" target="_blank" rel="noopener noreferrer" 
                   class="bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs md:text-[13px] font-semibold px-4 py-2 md:px-5 md:py-2 rounded-full transition-all shadow-sm flex items-center gap-1.5 cursor-pointer">
                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                    <span>Konsultasi</span>
                    <i data-lucide="arrow-up-right" class="w-3 h-3 hidden sm:inline-block"></i>
                </a>

                <!-- Mobile Hamburger Button -->
                <button id="mobile-menu-toggle" type="button" aria-label="Buka Menu Navigasi" 
                        class="md:hidden w-8 h-8 rounded-full border border-neutral-200/80 bg-neutral-100 text-neutral-800 flex items-center justify-center transition-all cursor-pointer">
                    <i data-lucide="menu" id="mobile-menu-open-icon" class="w-4 h-4 text-neutral-800"></i>
                    <i data-lucide="x" id="mobile-menu-close-icon" class="w-4 h-4 text-neutral-800 hidden"></i>
                </button>
            </div>
        </nav>

        <!-- Mobile Drawer Sheet (Clean 7 Items: Beranda, Tentang, Layanan, Karya, Artikel, Karir, Kontak) -->
        <div id="mobile-drawer" class="pointer-events-auto hidden w-full max-w-md mt-2 bg-white/98 dark:bg-[#111215]/98 backdrop-blur-xl border border-black/10 dark:border-white/10 rounded-[24px] p-4 shadow-2xl transition-all">
            <div class="flex flex-col gap-1.5 text-sm font-semibold text-neutral-700 dark:text-neutral-200">
                <!-- 1. Beranda -->
                <a href="<?= base_url() ?>" class="flex items-center justify-between py-2.5 px-3 rounded-xl <?= $currentPage === 'home' ? 'bg-red-50 dark:bg-neutral-800 text-[#C4264A] font-bold' : 'hover:bg-neutral-50 dark:hover:bg-neutral-800/60' ?>">
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="home" class="w-4 h-4 text-neutral-400"></i>
                        <span>Beranda</span>
                    </div>
                    <span class="text-xs font-sans text-neutral-400">(01)</span>
                </a>

                <!-- 2. Layanan -->
                <a href="<?= base_url('layanan') ?>" class="flex items-center justify-between py-2.5 px-3 rounded-xl <?= $currentPage === 'layanan' ? 'bg-red-50 dark:bg-neutral-800 text-[#C4264A] font-bold' : 'hover:bg-neutral-50 dark:hover:bg-neutral-800/60' ?>">
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="layers" class="w-4 h-4 text-neutral-400"></i>
                        <span>Layanan</span>
                    </div>
                    <span class="text-xs font-sans text-neutral-400">(02)</span>
                </a>

                <!-- 3. Portofolio -->
                <a href="<?= base_url('portofolio') ?>" class="flex items-center justify-between py-2.5 px-3 rounded-xl <?= $currentPage === 'portfolio' ? 'bg-red-50 dark:bg-neutral-800 text-[#C4264A] font-bold' : 'hover:bg-neutral-50 dark:hover:bg-neutral-800/60' ?>">
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="briefcase" class="w-4 h-4 text-neutral-400"></i>
                        <span>Portofolio</span>
                    </div>
                    <span class="text-xs font-sans text-neutral-400">(03)</span>
                </a>

                <!-- 4. Artikel -->
                <a href="<?= base_url('artikel') ?>" class="flex items-center justify-between py-2.5 px-3 rounded-xl <?= $currentPage === 'artikel' ? 'bg-red-50 dark:bg-neutral-800 text-[#C4264A] font-bold' : 'hover:bg-neutral-50 dark:hover:bg-neutral-800/60' ?>">
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="file-text" class="w-4 h-4 text-neutral-400"></i>
                        <span>Artikel</span>
                    </div>
                    <span class="text-xs font-sans text-neutral-400">(04)</span>
                </a>

                <!-- 5. Tentang Kami -->
                <a href="<?= base_url('tentang') ?>" class="flex items-center justify-between py-2.5 px-3 rounded-xl <?= $currentPage === 'tentang' ? 'bg-red-50 dark:bg-neutral-800 text-[#C4264A] font-bold' : 'hover:bg-neutral-50 dark:hover:bg-neutral-800/60' ?>">
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="building-2" class="w-4 h-4 text-neutral-400"></i>
                        <span>Tentang Kami</span>
                    </div>
                    <span class="text-xs font-sans text-neutral-400">(05)</span>
                </a>

                <!-- 6. Karir -->
                <a href="<?= base_url('karir') ?>" class="flex items-center justify-between py-2.5 px-3 rounded-xl <?= $currentPage === 'karir' ? 'bg-red-50 dark:bg-neutral-800 text-[#C4264A] font-bold' : 'hover:bg-neutral-50 dark:hover:bg-neutral-800/60' ?>">
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="users" class="w-4 h-4 text-neutral-400"></i>
                        <span>Karir</span>
                    </div>
                    <span class="text-xs font-sans text-neutral-400">(06)</span>
                </a>

                <!-- 7. Kontak -->
                <a href="<?= base_url('kontak') ?>" class="flex items-center justify-between py-2.5 px-3 rounded-xl <?= $currentPage === 'kontak' ? 'bg-red-50 dark:bg-neutral-800 text-[#C4264A] font-bold' : 'hover:bg-neutral-50 dark:hover:bg-neutral-800/60' ?>">
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="phone-call" class="w-4 h-4 text-neutral-400"></i>
                        <span>Kontak</span>
                    </div>
                    <span class="text-xs font-sans text-neutral-400">(07)</span>
                </a>

                <!-- WhatsApp CTA inside Mobile Menu -->
                <div class="pt-3 border-t border-black/[0.08] dark:border-white/10 mt-1">
                    <a href="<?= $waNavUrl ?>" target="_blank" rel="noopener noreferrer"
                       class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-xs font-bold text-white bg-[#C4264A] hover:bg-[#8E1738] transition-colors shadow-sm">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Konsultasi WhatsApp (CS Zahra)</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ========================================================================= -->
    <!-- MAIN CONTENT VIEW                                                         -->
    <!-- ========================================================================= -->
    <main class="min-h-[calc(100vh-140px)]">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- ========================================================================= -->
    <!-- MINIMALIST GLASSMORPHISM FOOTER WITH SUBTLE LIGHTING GLOW EFFECT          -->
    <!-- ========================================================================= -->
    <footer class="glass-footer font-sans mt-16 pt-16 pb-12 transition-colors duration-200">
        <!-- Subtle Top Glow Bar -->
        <div class="glass-footer-glow"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12 mb-14">
                
                <!-- Col 1: Brand Logo & Mission (5 Cols) -->
                <div class="lg:col-span-5 space-y-4">
                    <a href="<?= base_url() ?>" class="inline-flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-xl p-1 bg-white dark:bg-[#1A1C22] shadow-sm border border-[#E8E9ED] dark:border-white/10 flex items-center justify-center">
                            <img src="<?= base_url('solveta-logo.png') ?>" alt="SOLVETA Logo" class="h-full w-full object-contain">
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-lg tracking-tight text-[#111215] dark:text-white leading-tight">
                                SOLVETA
                            </span>
                            <span class="text-[10px] font-semibold text-[#C4264A] dark:text-[#F05A72] uppercase tracking-wider">
                                Solve Technology Agency
                            </span>
                        </div>
                    </a>
                    
                    <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed max-w-md">
                        Membantu bisnis, organisasi, dan perusahaan berkembang melalui website profesional, aplikasi bisnis, arsitektur cloud teruji, dan sistem teknologi yang dirancang sesuai kebutuhan nyata.
                    </p>

                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 dark:bg-neutral-900 border border-red-200 dark:border-neutral-800 text-[11px] font-bold text-[#C4264A] dark:text-[#F05A72]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#C4264A] animate-pulse"></span>
                        <span class="tracking-wider uppercase">We Solve. You Grow.</span>
                    </div>
                </div>

                <!-- Col 2: 7 Dedicated Pages (2 Cols) -->
                <div class="lg:col-span-2">
                    <h4 class="text-xs font-bold text-[#111215] dark:text-white uppercase tracking-wider mb-4">
                        Halaman Utama
                    </h4>
                    <ul class="space-y-2.5 text-xs text-neutral-600 dark:text-neutral-400">
                        <li><a href="<?= base_url() ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="<?= base_url('tentang') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Tentang</a></li>
                        <li><a href="<?= base_url('layanan') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Layanan</a></li>
                        <li><a href="<?= base_url('portofolio') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Karya</a></li>
                        <li><a href="<?= base_url('artikel') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Artikel</a></li>
                        <li><a href="<?= base_url('karir') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Karir</a></li>
                        <li><a href="<?= base_url('kontak') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <!-- Col 3: 4 Pilihan Paket Layanan (3 Cols) -->
                <div class="lg:col-span-3">
                    <h4 class="text-xs font-bold text-[#111215] dark:text-white uppercase tracking-wider mb-4">
                        Paket Layanan
                    </h4>
                    <ul class="space-y-2.5 text-xs text-neutral-600 dark:text-neutral-400">
                        <li><a href="<?= base_url('layanan/starter') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Paket Starter (Rp 349K)</a></li>
                        <li><a href="<?= base_url('layanan/standard') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Paket Standard (Rp 699K)</a></li>
                        <li><a href="<?= base_url('layanan/premium') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Paket Premium (Rp 964K)</a></li>
                        <li><a href="<?= base_url('layanan/platinum') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors font-semibold text-[#C4264A] dark:text-[#F05A72]">Paket Platinum (Rp 1.5 jt) ★</a></li>
                        <li><a href="<?= base_url('layanan#custom') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Paket Custom &amp; Enterprise</a></li>
                        <li><a href="<?= base_url('layanan#addons') ?>" class="hover:text-[#C4264A] dark:hover:text-white transition-colors">Layanan Biaya Tambahan (Add-ons)</a></li>
                    </ul>
                </div>

                <!-- Col 4: Informasi & Kontak Resmi (2 Cols) -->
                <div class="lg:col-span-2">
                    <h4 class="text-xs font-bold text-[#111215] dark:text-white uppercase tracking-wider mb-4">
                        Kontak Resmi
                    </h4>
                    <ul class="space-y-3 text-xs text-neutral-600 dark:text-neutral-400">
                        <li class="flex items-center gap-2">
                            <i data-lucide="globe" class="w-4 h-4 text-[#C4264A] shrink-0"></i>
                            <a href="https://solveta.asia" target="_blank" class="hover:text-[#111215] dark:hover:text-white transition-colors font-medium">solveta.asia</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="message-circle" class="w-4 h-4 text-[#C4264A] shrink-0"></i>
                            <a href="<?= $waNavUrl ?>" target="_blank" class="hover:text-[#111215] dark:hover:text-white transition-colors">+62 858-7660-3826</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4 text-[#C4264A] shrink-0"></i>
                            <a href="mailto:kontak@solveta.asia" class="hover:text-[#111215] dark:hover:text-white transition-colors">kontak@solveta.asia</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="instagram" class="w-4 h-4 text-[#C4264A] shrink-0"></i>
                            <a href="https://www.instagram.com/solveta.asia" target="_blank" class="hover:text-[#111215] dark:hover:text-white transition-colors">@solveta.asia</a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Copyright & Legal -->
            <div class="pt-8 border-t border-black/[0.06] dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-neutral-500 dark:text-neutral-400">
                <p>© 2026 <b>SOLVETA</b> — Solve Technology Agency. All Rights Reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="<?= base_url('tentang') ?>" class="hover:text-[#111215] dark:hover:text-white transition-colors">Tentang Kami</a>
                    <a href="<?= base_url('layanan') ?>" class="hover:text-[#111215] dark:hover:text-white transition-colors">Layanan</a>
                    <a href="<?= base_url('kontak') ?>" class="hover:text-[#111215] dark:hover:text-white transition-colors">Pusat Bantuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts: Mobile Drawer Toggle, Sticky Navbar Scroll, & Dark Mode Engine -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // =========================================================================
        // SCROLL REVEAL BLUR ENGINE (Elemen baru muncul dgn animasi blur naik/turun)
        // Bagian yang belum terlihat di viewport muncul dengan efek animasi blur
        // Elemen yang sudah di layar tetap tajam (bukan seluruh layar di-blur)
        // =========================================================================
        (function() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

            // Target elemen section, card, dan timeline untuk animasi blur reveal
            const targets = document.querySelectorAll('main section:not(#beranda):not(.clean-hero-header), footer, .timeline-item, .bento-card');
            
            targets.forEach(el => {
                const rect = el.getBoundingClientRect();
                // Jika elemen sudah masuk viewport saat pertama kali render, tampilkan tajam
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    el.classList.add('scroll-blur-reveal', 'is-revealed');
                } else {
                    el.classList.add('scroll-blur-reveal');
                }
            });

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                    } else {
                        // Reset saat elemen terlewati ke atas atau bawah, sehingga saat discroll kembali
                        // (baik naik maupun turun), elemen muncul kembali dengan animasi blur yang memukau
                        const rect = entry.target.getBoundingClientRect();
                        if (rect.top > window.innerHeight || rect.bottom < 0) {
                            entry.target.classList.remove('is-revealed');
                        }
                    }
                });
            }, {
                threshold: 0.05,
                rootMargin: "30px 0px -40px 0px"
            });

            document.querySelectorAll('.scroll-blur-reveal').forEach(el => observer.observe(el));
        })();

        // Sticky Navbar Transition on Scroll
        const header = document.getElementById('main-header');
        function handleNavbarScroll() {
            if (!header) return;
            if (window.scrollY > 20) {
                header.classList.add('shadow-md', 'bg-white/98', 'dark:bg-[#111215]/98');
            } else {
                header.classList.remove('shadow-md');
            }
        }
        window.addEventListener('scroll', handleNavbarScroll, { passive: true });
        handleNavbarScroll();

        // Theme Switcher Engine
        const themeBtn = document.getElementById('theme-toggle-btn');
        const sunIcon = document.getElementById('theme-sun-icon');
        const moonIcon = document.getElementById('theme-moon-icon');

        function updateThemeIcons() {
            if (document.documentElement.classList.contains('dark')) {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        }
        updateThemeIcons();

        if (themeBtn) {
            themeBtn.addEventListener('click', () => {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('solveta_theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('solveta_theme', 'dark');
                }
                updateThemeIcons();
            });
        }

        // Mobile Menu Drawer Engine
        const mobileToggle = document.getElementById('mobile-menu-toggle');
        const mobileDrawer = document.getElementById('mobile-drawer');
        const openIcon = document.getElementById('mobile-menu-open-icon');
        const closeIcon = document.getElementById('mobile-menu-close-icon');

        if (mobileToggle && mobileDrawer) {
            mobileToggle.addEventListener('click', () => {
                const isOpen = !mobileDrawer.classList.contains('hidden');
                if (isOpen) {
                    mobileDrawer.classList.add('hidden');
                    openIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                } else {
                    mobileDrawer.classList.remove('hidden');
                    openIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                }
            });
        }

        // Liquid Glass Logo Reveal Engine (Background Putih Polos + Smooth Blur Reveal)
        let introTimer;
        function dismissIntro() {
            clearTimeout(introTimer);
            const intro = document.getElementById('liquid-glass-intro');
            if (intro && !intro.classList.contains('dismissed')) {
                // Pastikan posisi scroll tepat di puncak beranda paling atas
                window.scrollTo({ top: 0, left: 0, behavior: 'instant' });
                intro.classList.add('dismissed');
                setTimeout(() => {
                    intro.style.display = 'none';
                    document.body.style.overflow = '';
                    if (window.lucide) {
                        lucide.createIcons();
                    }
                }, 1150);
            }
        }

        const introEl = document.getElementById('liquid-glass-intro');
        if (introEl) {
            // Kunci scroll di puncak halaman selama animasi intro
            window.scrollTo({ top: 0, left: 0, behavior: 'instant' });
            document.body.style.overflow = 'hidden';

            // Auto dismiss setelah 3.2 detik dengan transisi blur mulus
            introTimer = setTimeout(dismissIntro, 3200);

            // Dismiss on Esc or Space
            window.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' || e.key === ' ') {
                    dismissIntro();
                }
            });

            // Also dismiss on clicking anywhere on the overlay
            introEl.addEventListener('click', (e) => {
                if (e.target !== document.getElementById('skip-intro-btn')) {
                    dismissIntro();
                }
            });
        }
    </script>
</body>
</html>