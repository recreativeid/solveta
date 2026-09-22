<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285719663154');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
    $waOrderGeneral = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo SOLVETA, saya ingin berkonsultasi dan memesan solusi website/digital.");
?>

<!-- ==============================================================================
     1. HERO SECTION & 3D LAPTOP MOCKUP WITH GLOWING EARTH HORIZON
     ============================================================================== -->
<section id="hero" class="relative pt-6 sm:pt-10 pb-16 sm:pb-24 overflow-hidden bg-white dark:bg-[#07080E] text-center transition-colors duration-200 font-sans">
    
    <!-- Atmospheric Glowing Earth Horizon 3D -->
    <div class="absolute top-0 left-0 right-0 h-[640px] pointer-events-none overflow-hidden select-none z-0">
        <!-- Glowing Earth Horizon Atmospheric Ring -->
        <div class="absolute top-0 left-0 right-0 h-44 bg-gradient-to-b from-sky-400/30 dark:from-sky-400/40 via-sky-300/10 to-transparent blur-md"></div>
        <div class="absolute top-0 left-0 right-0 h-80 bg-gradient-to-b from-sky-400/10 dark:from-rose-500/25 via-blue-800/10 dark:via-blue-900/30 to-transparent blur-2xl"></div>

        <!-- Earth Body Spherical Gradient: Pure Clean Base -->
        <div class="absolute inset-0 bg-gradient-to-b from-sky-50/30 dark:from-[#0b172a] via-white dark:via-[#070b14] to-white dark:to-[#04060a]"></div>

        <!-- Earth Continents & Ocean Texture Curved Longitude/Latitude Arcs -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[800px] opacity-35 dark:opacity-40">
            <svg class="w-full h-full" viewBox="0 0 1400 800" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Latitude Rings -->
                <ellipse cx="700" cy="40" rx="680" ry="110" stroke="url(#earthHeroNeonLight)" stroke-width="1.5" stroke-dasharray="6 8" />
                <ellipse cx="700" cy="160" rx="640" ry="160" stroke="url(#earthHeroNeonLight)" stroke-width="1.2" stroke-dasharray="5 7" />
                <ellipse cx="700" cy="300" rx="580" ry="210" stroke="url(#earthHeroNeonLight)" stroke-width="1" stroke-dasharray="4 6" />
                <ellipse cx="700" cy="460" rx="500" ry="260" stroke="url(#earthHeroNeonLight)" stroke-width="1" stroke-dasharray="4 6" />

                <!-- Longitude Curved Lines -->
                <path d="M 700 0 C 700 250, 700 550, 700 800" stroke="url(#earthHeroNeonLight)" stroke-width="1.5" stroke-dasharray="5 7" />
                <path d="M 480 0 C 540 250, 560 550, 600 800" stroke="url(#earthHeroNeonLight)" stroke-width="1.2" stroke-dasharray="5 7" />
                <path d="M 920 0 C 860 250, 840 550, 800 800" stroke="url(#earthHeroNeonLight)" stroke-width="1.2" stroke-dasharray="5 7" />
                <path d="M 280 0 C 390 250, 430 550, 500 800" stroke="url(#earthHeroNeonLight)" stroke-width="1" stroke-dasharray="4 6" />
                <path d="M 1120 0 C 1010 250, 970 550, 900 800" stroke="url(#earthHeroNeonLight)" stroke-width="1" stroke-dasharray="4 6" />

                <!-- Glowing Coordinate Intersections -->
                <circle cx="700" cy="40" r="3.5" fill="#0284c7" class="animate-ping" />
                <circle cx="480" cy="40" r="3" fill="#0284c7" />
                <circle cx="920" cy="40" r="3" fill="#0284c7" />
                <circle cx="700" cy="160" r="3" fill="#0284c7" />
                <circle cx="540" cy="160" r="3" fill="#0284c7" />
                <circle cx="860" cy="160" r="3" fill="#0284c7" />

                <defs>
                    <linearGradient id="earthHeroNeonLight" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#0284c7" stop-opacity="0" />
                        <stop offset="20%" stop-color="#0284c7" stop-opacity="0.7" />
                        <stop offset="50%" stop-color="#0284c7" stop-opacity="0.8" />
                        <stop offset="80%" stop-color="#0284c7" stop-opacity="0.7" />
                        <stop offset="100%" stop-color="#0284c7" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Smooth Bottom Horizon Blend -->
        <div class="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-white dark:from-[#07080E] via-white/80 dark:via-[#07080E]/60 to-transparent pointer-events-none z-10"></div>
    </div>

    <!-- Hero Content Container -->
    <div class="max-w-[1160px] mx-auto px-6 relative z-20">
        
        <!-- Eyebrow Pill -->
        <div class="inline-block">
            <span class="inline-flex items-center gap-1.5 font-mono text-[11px] font-bold uppercase tracking-wider text-[#7B0B1E] dark:text-rose-300 bg-rose-50/90 dark:bg-rose-950/60 backdrop-blur-md border border-rose-200/80 dark:border-rose-500/30 px-4 py-1.5 rounded-full mb-6 shadow-2xs">
                <span class="w-1.5 h-1.5 rounded-full bg-[#8B0021] dark:bg-rose-400 animate-pulse"></span>
                <?= esc($copy['hero_eyebrow'] ?? 'SOLVE TECHNOLOGY AGENCY') ?>
            </span>
        </div>

        <!-- Main Headline -->
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-gray-950 dark:text-white tracking-tight uppercase leading-[1.12] mb-6 max-w-4xl mx-auto font-sans">
            <?= esc($copy['hero_headline'] ?? 'Mengubah Tantangan Bisnis Menjadi Solusi Digital.') ?>
        </h1>

        <!-- Narrative Subtitle -->
        <p class="max-w-[740px] mx-auto text-sm sm:text-base text-gray-600 dark:text-gray-300 leading-relaxed mb-10 whitespace-pre-line font-sans">
            <?= esc($copy['hero_subtitle'] ?? 'Banyak bisnis terhambat oleh proses manual, informasi yang tidak terstruktur, dan kurangnya integrasi. SOLVETA hadir untuk menyederhanakan masalah kompleks melalui solusi digital dan otomasi yang efisien.') ?>
        </p>

        <!-- Action Buttons: "Pesan Sekarang" & "Pelajari Selengkapnya" -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5 max-w-md mx-auto mb-10">
            <!-- 1. Tombol Pesan Sekarang -->
            <a href="<?= $waOrderGeneral ?>" target="_blank" rel="noopener noreferrer"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:via-[#85001D] hover:to-[#5E0013] text-white text-sm font-bold rounded-xl shadow-md hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-300 group cursor-pointer border border-rose-800/30 font-sans">
                <i data-lucide="message-circle" class="w-4 h-4 text-rose-200 group-hover:scale-110 transition-transform"></i>
                <span>Pesan Sekarang</span>
                <i data-lucide="arrow-right" class="w-4 h-4 text-rose-200 group-hover:translate-x-1 transition-transform"></i>
            </a>

            <!-- 2. Tombol Pelajari Selengkapnya -->
            <a href="#problems" 
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white dark:bg-white/10 hover:bg-gray-50 dark:hover:bg-white/20 backdrop-blur-md border border-gray-200 dark:border-white/20 hover:border-gray-300 dark:hover:border-white/40 text-gray-800 dark:text-white text-sm font-bold rounded-xl shadow-2xs hover:shadow-xs transition-all duration-300 cursor-pointer font-sans">
                <span>Pelajari Selengkapnya</span>
                <i data-lucide="arrow-down" class="w-4 h-4 text-gray-400 dark:text-rose-300 animate-bounce"></i>
            </a>
        </div>

        <!-- 3D ROTATING LAPTOP MOCKUP & SHOWCASE VIDEO -->
        <div class="relative z-20 py-4 flex flex-col items-center">
            <!-- Ambient Behind-Laptop Glow -->
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[720px] h-[340px] bg-gradient-to-r from-[#8B0021]/50 via-rose-600/35 to-sky-500/40 blur-[90px] rounded-full pointer-events-none -z-10"></div>

            <div id="laptop-chassis-container" class="w-full max-w-[940px] px-2 sm:px-4 flex flex-col items-center relative transition-transform duration-200 ease-out" style="transform-style: preserve-3d;">
                
                <!-- Laptop Top Display Lid -->
                <div id="laptop-lid" class="w-full max-w-[880px] bg-[#1a1b24] rounded-t-[18px] sm:rounded-t-[24px] p-2.5 sm:p-3.5 border-[3px] border-[#2c2d3a] shadow-[0_35px_80px_-15px_rgba(0,0,0,0.65)] relative transition-transform duration-200 ease-out">
                    
                    <!-- Top Webcam Notch -->
                    <div class="absolute top-1.5 left-1/2 -translate-x-1/2 flex items-center gap-1.5 z-20">
                        <div class="w-1.5 h-1.5 rounded-full bg-[#3b3e52]"></div>
                        <div class="w-1 h-1 rounded-full bg-emerald-500/90 animate-pulse"></div>
                    </div>

                    <!-- Inner Display: Video Player Container -->
                    <div id="laptop-video-container" class="w-full aspect-[16/10] bg-[#0c0d12] rounded-[10px] sm:rounded-[14px] overflow-hidden flex flex-col text-left border border-[#232533] shadow-inner font-sans relative cursor-pointer group">
                        
                        <!-- Window Header Bar (Clean macOS Dots) -->
                        <div class="h-6 sm:h-7 bg-[#14151e]/90 backdrop-blur-md border-b border-[#202230] flex items-center px-3 sm:px-4 flex-shrink-0 z-20">
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#ff5f56]"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-[#ffbd2e]"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-[#27c93f]"></div>
                            </div>
                        </div>

                        <!-- Main Video Area -->
                        <div class="relative flex-grow w-full h-full bg-[#07080d] overflow-hidden flex items-center justify-center">
                            <?php 
                                $videoSrc = !empty($copy['profile_video']) ? $copy['profile_video'] : '/videos/profile.mp4';
                            ?>
                            <video id="hero-profile-video" 
                                   src="<?= esc($videoSrc) ?>"
                                   autoplay loop muted playsinline preload="auto"
                                   class="w-full h-full object-cover">
                            </video>

                            <!-- Play/Pause Center Overlay Indicator when paused -->
                            <div id="video-play-overlay" class="absolute inset-0 bg-black/45 backdrop-blur-[2px] flex items-center justify-center z-10 pointer-events-none hidden transition-opacity">
                                <div class="w-14 h-14 rounded-full bg-rose-600/90 text-white flex items-center justify-center shadow-[0_0_30px_rgba(225,29,72,0.6)] border border-rose-400/50">
                                    <i data-lucide="play" class="w-6 h-6 fill-white translate-x-0.5"></i>
                                </div>
                            </div>

                            <!-- Interactive Audio, Play/Pause, Replay & Fullscreen Control Buttons -->
                            <div class="absolute bottom-2.5 sm:bottom-3 left-2.5 sm:left-3 right-2.5 sm:right-3 flex items-center justify-between pointer-events-none z-20">
                                <!-- Left: Play/Pause and Replay -->
                                <div class="flex items-center gap-1.5 sm:gap-2">
                                    <button id="video-play-btn" type="button" class="pointer-events-auto w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-black/70 hover:bg-black/95 backdrop-blur-md text-gray-200 hover:text-white rounded-full border border-white/20 transition-all shadow-md cursor-pointer hover:scale-110 active:scale-95" title="Putar/Jeda Video">
                                        <i data-lucide="pause" id="btn-pause-icon" class="w-3.5 h-3.5 fill-white"></i>
                                        <i data-lucide="play" id="btn-play-icon" class="w-3.5 h-3.5 fill-white translate-x-0.5 hidden"></i>
                                    </button>
                                    <button id="video-restart-btn" type="button" class="pointer-events-auto w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-black/70 hover:bg-black/95 backdrop-blur-md text-gray-200 hover:text-white rounded-full border border-white/20 transition-all shadow-md cursor-pointer hover:scale-110 active:scale-95" title="Ulangi video dari awal">
                                        <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>

                                <!-- Right: Sound & Fullscreen -->
                                <div class="flex items-center gap-1.5 sm:gap-2">
                                    <button id="video-sound-btn" type="button" class="pointer-events-auto w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full backdrop-blur-md transition-all duration-300 shadow-xl border cursor-pointer hover:scale-110 active:scale-95 bg-black/70 hover:bg-black/95 text-gray-300 border-white/20 hover:border-rose-400" title="Hidupkan Suara">
                                        <i data-lucide="volume-x" id="btn-vol-mute" class="w-4 h-4 text-rose-300"></i>
                                        <i data-lucide="volume-2" id="btn-vol-unmute" class="w-4 h-4 text-white hidden"></i>
                                    </button>
                                    <button id="video-fullscreen-btn" type="button" class="pointer-events-auto w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-black/70 hover:bg-black/95 backdrop-blur-md text-gray-200 hover:text-white rounded-full border border-white/20 transition-all shadow-md cursor-pointer hover:scale-110 active:scale-95" title="Layar Penuh">
                                        <i data-lucide="maximize-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Laptop Bottom Base & Hinge -->
                <div class="w-full max-w-[960px] h-3.5 sm:h-4 bg-gradient-to-b from-[#d1d5db] via-[#9ca3af] to-[#6b7280] rounded-b-[14px] sm:rounded-b-[18px] shadow-[0_18px_35px_rgba(0,0,0,0.35)] relative flex items-center justify-center">
                    <div class="w-24 sm:w-32 h-1.5 bg-[#4b5563] rounded-b-md"></div>
                </div>

                <!-- Base Table Reflection Shadow -->
                <div class="w-[85%] h-5 bg-gradient-to-r from-transparent via-black/25 to-transparent blur-md rounded-full mt-1 pointer-events-none"></div>

            </div>
        </div>

    </div>
</section>


<!-- ==============================================================================
     2. CLIENT MARQUEE (DUAL-ROW INFINITE SMOOTH FLOWING MARQUEE)
     ============================================================================== -->
<?php if (!empty($brands)): ?>
    <?php
        $marqueeSpeed = !empty($copy['marquee_speed']) ? (int)$copy['marquee_speed'] : 35;
        $logoHeight = !empty($copy['marquee_logo_height']) ? (int)$copy['marquee_logo_height'] : 46;
        $logoSpacing = !empty($copy['marquee_logo_spacing']) ? (int)$copy['marquee_logo_spacing'] : 36;
        $logoScalePercent = (!empty($copy['marquee_logo_scale']) ? (int)$copy['marquee_logo_scale'] : 100) / 100;
        $logoMaxWidth = !empty($copy['marquee_logo_max_width']) ? (int)$copy['marquee_logo_max_width'] : 240;

        $offset = max(1, (int)floor(count($brands) / 2));
        $row1Brands = $brands;
        $row2Brands = array_merge(array_slice($brands, $offset), array_slice($brands, 0, $offset));
        // Quadruple items to make the seamless infinite loop
        $row1Quad = array_merge($row1Brands, $row1Brands, $row1Brands, $row1Brands);
        $row2Quad = array_merge($row2Brands, $row2Brands, $row2Brands, $row2Brands);
    ?>
    <section class="py-12 sm:py-16 bg-white dark:bg-[#07080E] border-y border-gray-100 dark:border-gray-800 overflow-hidden relative transition-colors duration-200 font-sans"
             style="--marquee-speed: <?= $marqueeSpeed ?>s;">
        <div class="max-w-[1160px] mx-auto px-6 mb-8 text-center">
            <p class="text-[11px] sm:text-xs font-mono font-bold tracking-widest text-gray-400 dark:text-gray-500 uppercase">
                <?= esc($copy['marquee_title'] ?? 'DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG') ?>
            </p>
        </div>

        <!-- Gradient Fades on edges -->
        <div class="absolute top-0 bottom-0 left-0 w-28 sm:w-40 bg-gradient-to-r from-white dark:from-[#07080E] to-transparent z-10 pointer-events-none"></div>
        <div class="absolute top-0 bottom-0 right-0 w-28 sm:w-40 bg-gradient-to-l from-white dark:from-[#07080E] to-transparent z-10 pointer-events-none"></div>

        <!-- Dual Row Flowing Marquee: Row 1 flows Right, Row 2 flows Left -->
        <div class="space-y-6">
            <!-- ROW 1: Geser ke Kanan -->
            <div class="flex w-max">
                <div class="marquee-row-right flex items-center pr-6">
                    <?php foreach ($row1Quad as $brand): ?>
                        <?php
                            $individualScale = isset($brand['scale']) ? (float)$brand['scale'] : 1.0;
                            $effectiveScale = $logoScalePercent * $individualScale;
                            $finalHeight = max(24, (int)round($logoHeight * $effectiveScale));
                            $finalMaxWidth = max(80, (int)round($logoMaxWidth * $effectiveScale));
                        ?>
                        <div style="padding-left: <?= $logoSpacing ?>px; padding-right: <?= $logoSpacing ?>px;" class="py-2 flex items-center justify-center flex-shrink-0 group cursor-default transition-all duration-300">
                            <?php if (!empty($brand['logo_image'])): ?>
                                <img src="<?= esc($brand['logo_image']) ?>" alt="<?= esc($brand['name'] ?: 'Client Logo') ?>" 
                                     style="height: <?= $finalHeight ?>px; max-height: <?= round($finalHeight * 1.45) ?>px; max-width: <?= $finalMaxWidth ?>px;"
                                     class="w-auto object-contain select-none pointer-events-none filter grayscale opacity-85 contrast-125 dark:invert dark:opacity-95 dark:contrast-125 group-hover:grayscale-0 group-hover:dark:invert-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300">
                            <?php else: ?>
                                <span class="font-black font-sans tracking-tight text-gray-800 dark:text-white/90 group-hover:text-black dark:group-hover:text-white group-hover:scale-105 transition-all duration-300 select-none whitespace-nowrap text-sm sm:text-base">
                                    <?= esc($brand['name'] ?: 'Partner') ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ROW 2: Geser ke Kiri -->
            <div class="flex w-max">
                <div class="marquee-row-left flex items-center pr-6">
                    <?php foreach ($row2Quad as $brand): ?>
                        <?php
                            $individualScale = isset($brand['scale']) ? (float)$brand['scale'] : 1.0;
                            $effectiveScale = $logoScalePercent * $individualScale;
                            $finalHeight = max(24, (int)round($logoHeight * $effectiveScale));
                            $finalMaxWidth = max(80, (int)round($logoMaxWidth * $effectiveScale));
                        ?>
                        <div style="padding-left: <?= $logoSpacing ?>px; padding-right: <?= $logoSpacing ?>px;" class="py-2 flex items-center justify-center flex-shrink-0 group cursor-default transition-all duration-300">
                            <?php if (!empty($brand['logo_image'])): ?>
                                <img src="<?= esc($brand['logo_image']) ?>" alt="<?= esc($brand['name'] ?: 'Client Logo') ?>" 
                                     style="height: <?= $finalHeight ?>px; max-height: <?= round($finalHeight * 1.45) ?>px; max-width: <?= $finalMaxWidth ?>px;"
                                     class="w-auto object-contain select-none pointer-events-none filter grayscale opacity-85 contrast-125 dark:invert dark:opacity-95 dark:contrast-125 group-hover:grayscale-0 group-hover:dark:invert-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300">
                            <?php else: ?>
                                <span class="font-black font-sans tracking-tight text-gray-800 dark:text-white/90 group-hover:text-black dark:group-hover:text-white group-hover:scale-105 transition-all duration-300 select-none whitespace-nowrap text-sm sm:text-base">
                                    <?= esc($brand['name'] ?: 'Partner') ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- ==============================================================================
     3. PROBLEM SECTION (Identical to Next.js ProblemSection.tsx)
     ============================================================================== -->
<section id="problems" class="py-20 bg-white dark:bg-[#07080E] border-b border-gray-100 dark:border-gray-800 transition-colors duration-200 font-sans">
    <div class="max-w-[1080px] mx-auto px-6 text-center">
        <!-- Section Header -->
        <div class="space-y-3 mb-10">
            <span class="font-mono text-[11px] font-bold tracking-widest text-[#8B0021] dark:text-rose-400 uppercase bg-rose-50 dark:bg-rose-950/60 border border-rose-100 dark:border-rose-800/60 px-4 py-1.5 rounded-full inline-block">
                TANTANGAN BISNIS &bull; SOLUSI TEPAT
            </span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-950 dark:text-white tracking-tight leading-tight">
                Setiap bisnis memiliki tantangan yang berbeda.
            </h2>
            <p class="max-w-2xl mx-auto text-xs sm:text-sm md:text-base text-gray-600 dark:text-gray-300 leading-relaxed font-normal">
                Tidak semua masalah membutuhkan solusi yang kompleks. Yang dibutuhkan adalah <strong class="text-gray-900 dark:text-white font-bold">teknologi yang tepat untuk menyelesaikan masalah yang tepat</strong>.
            </p>
        </div>

        <!-- 5 Challenge Point Cards in Responsive Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3.5 mb-12">
            <!-- Card 1 -->
            <div class="p-4 rounded-xl bg-gray-50/70 dark:bg-[#11121C] border border-gray-200/80 dark:border-gray-800 hover:border-rose-300 dark:hover:border-rose-600 hover:bg-white dark:hover:bg-[#151724] shadow-2xs hover:shadow-xs transition-all duration-300 flex flex-col items-center justify-center text-center group">
                <div class="w-10 h-10 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 group-hover:border-rose-300 dark:group-hover:border-rose-500 flex items-center justify-center text-gray-700 dark:text-gray-300 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 transition-all mb-3 shadow-2xs">
                    <i data-lucide="file-spreadsheet" class="w-5 h-5 stroke-[1.8]"></i>
                </div>
                <span class="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                    Proses yang Masih Manual
                </span>
            </div>

            <!-- Card 2 -->
            <div class="p-4 rounded-xl bg-gray-50/70 dark:bg-[#11121C] border border-gray-200/80 dark:border-gray-800 hover:border-rose-300 dark:hover:border-rose-600 hover:bg-white dark:hover:bg-[#151724] shadow-2xs hover:shadow-xs transition-all duration-300 flex flex-col items-center justify-center text-center group">
                <div class="w-10 h-10 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 group-hover:border-rose-300 dark:group-hover:border-rose-500 flex items-center justify-center text-gray-700 dark:text-gray-300 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 transition-all mb-3 shadow-2xs">
                    <i data-lucide="file-code-2" class="w-5 h-5 stroke-[1.8]"></i>
                </div>
                <span class="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                    Informasi yang Belum Terstruktur
                </span>
            </div>

            <!-- Card 3 -->
            <div class="p-4 rounded-xl bg-gray-50/70 dark:bg-[#11121C] border border-gray-200/80 dark:border-gray-800 hover:border-rose-300 dark:hover:border-rose-600 hover:bg-white dark:hover:bg-[#151724] shadow-2xs hover:shadow-xs transition-all duration-300 flex flex-col items-center justify-center text-center group">
                <div class="w-10 h-10 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 group-hover:border-rose-300 dark:group-hover:border-rose-500 flex items-center justify-center text-gray-700 dark:text-gray-300 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 transition-all mb-3 shadow-2xs">
                    <i data-lucide="repeat" class="w-5 h-5 stroke-[1.8]"></i>
                </div>
                <span class="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                    Pekerjaan yang Berulang
                </span>
            </div>

            <!-- Card 4 -->
            <div class="p-4 rounded-xl bg-gray-50/70 dark:bg-[#11121C] border border-gray-200/80 dark:border-gray-800 hover:border-rose-300 dark:hover:border-rose-600 hover:bg-white dark:hover:bg-[#151724] shadow-2xs hover:shadow-xs transition-all duration-300 flex flex-col items-center justify-center text-center group">
                <div class="w-10 h-10 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 group-hover:border-rose-300 dark:group-hover:border-rose-500 flex items-center justify-center text-gray-700 dark:text-gray-300 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 transition-all mb-3 shadow-2xs">
                    <i data-lucide="database" class="w-5 h-5 stroke-[1.8]"></i>
                </div>
                <span class="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                    Data yang Sulit Dikelola
                </span>
            </div>

            <!-- Card 5 -->
            <div class="p-4 rounded-xl bg-gray-50/70 dark:bg-[#11121C] border border-gray-200/80 dark:border-gray-800 hover:border-rose-300 dark:hover:border-rose-600 hover:bg-white dark:hover:bg-[#151724] shadow-2xs hover:shadow-xs transition-all duration-300 flex flex-col items-center justify-center text-center group">
                <div class="w-10 h-10 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 group-hover:border-rose-300 dark:group-hover:border-rose-500 flex items-center justify-center text-gray-700 dark:text-gray-300 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 transition-all mb-3 shadow-2xs">
                    <i data-lucide="globe" class="w-5 h-5 stroke-[1.8]"></i>
                </div>
                <span class="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                    Kebutuhan Kehadiran Digital Profesional
                </span>
            </div>
        </div>

        <!-- Highlight Banner -->
        <div class="max-w-2xl mx-auto p-5 sm:p-6 rounded-2xl bg-gradient-to-r from-rose-50/80 dark:from-rose-950/40 via-red-50/50 dark:via-red-950/20 to-orange-50/80 dark:to-orange-950/30 border border-rose-200/80 dark:border-rose-800/60 shadow-2xs flex items-center justify-center gap-3 text-center">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-[#8B0021] dark:text-rose-400 flex-shrink-0"></i>
            <p class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-gray-100 leading-snug">
                SOLVETA hadir untuk membantu Anda mengidentifikasi akar masalah dan membangun solusi yang benar-benar Anda butuhkan.
            </p>
        </div>
    </div>
</section>


<!-- ==============================================================================
     4. SERVICES SECTION (Identical to Next.js ServicesSection.tsx)
     ============================================================================== -->
<section id="services" class="py-16 bg-white dark:bg-[#07080E] border-t border-gray-100 dark:border-gray-800 transition-colors duration-200 font-sans">
    <div class="max-w-[1160px] mx-auto px-6">
        <div class="mb-8">
            <h2 class="text-sm sm:text-base font-bold uppercase tracking-wider text-gray-900 dark:text-white">
                APA YANG DAPAT SOLVETA BANTU?
            </h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- 1. Website & Digital Presence -->
            <div class="bg-white dark:bg-[#11121C] border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-rose-600 rounded-xl p-8 text-center flex flex-col items-center justify-center gap-4 shadow-xs hover:shadow-md transition-all duration-200 cursor-pointer group hover:-translate-y-1">
                <div class="w-10 h-10 text-gray-800 dark:text-gray-200 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 flex items-center justify-center transition-colors">
                    <i data-lucide="globe" class="w-7 h-7 stroke-[1.75]"></i>
                </div>
                <h3 class="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                    Website & Digital Presence
                </h3>
            </div>

            <!-- 2. Business Digitalization -->
            <div class="bg-white dark:bg-[#11121C] border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-rose-600 rounded-xl p-8 text-center flex flex-col items-center justify-center gap-4 shadow-xs hover:shadow-md transition-all duration-200 cursor-pointer group hover:-translate-y-1">
                <div class="w-10 h-10 text-gray-800 dark:text-gray-200 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 flex items-center justify-center transition-colors">
                    <i data-lucide="arrow-left-right" class="w-7 h-7 stroke-[1.75]"></i>
                </div>
                <h3 class="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                    Business Digitalization
                </h3>
            </div>

            <!-- 3. Custom Digital Solution -->
            <div class="bg-white dark:bg-[#11121C] border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-rose-600 rounded-xl p-8 text-center flex flex-col items-center justify-center gap-4 shadow-xs hover:shadow-md transition-all duration-200 cursor-pointer group hover:-translate-y-1">
                <div class="w-10 h-10 text-gray-800 dark:text-gray-200 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 flex items-center justify-center transition-colors">
                    <i data-lucide="monitor" class="w-7 h-7 stroke-[1.75]"></i>
                </div>
                <h3 class="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                    Custom Digital Solution
                </h3>
            </div>

            <!-- 4. Database & Integration -->
            <div class="bg-white dark:bg-[#11121C] border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-rose-600 rounded-xl p-8 text-center flex flex-col items-center justify-center gap-4 shadow-xs hover:shadow-md transition-all duration-200 cursor-pointer group hover:-translate-y-1">
                <div class="w-10 h-10 text-gray-800 dark:text-gray-200 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 flex items-center justify-center transition-colors">
                    <i data-lucide="layers" class="w-7 h-7 stroke-[1.75]"></i>
                </div>
                <h3 class="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                    Database & Integration
                </h3>
            </div>

            <!-- 5. Optimization -->
            <div class="bg-white dark:bg-[#11121C] border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-rose-600 rounded-xl p-8 text-center flex flex-col items-center justify-center gap-4 shadow-xs hover:shadow-md transition-all duration-200 cursor-pointer group hover:-translate-y-1">
                <div class="w-10 h-10 text-gray-800 dark:text-gray-200 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 flex items-center justify-center transition-colors">
                    <i data-lucide="clock" class="w-7 h-7 stroke-[1.75]"></i>
                </div>
                <h3 class="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                    Optimization
                </h3>
            </div>
        </div>
    </div>
</section>


<!-- ==============================================================================
     5. PORTFOLIO SECTION (3D COVERFLOW INTERACTIVE CAROUSEL - BISA DIGESER)
     ============================================================================== -->
<?php
    // Prepare unique categories
    $categories = [];
    foreach ($portfolios as $p) {
        $cat = trim($p['category'] ?? '');
        if (!empty($cat) && !in_array($cat, $categories)) {
            $categories[] = $cat;
        }
    }
?>
<section id="portfolio" class="py-20 bg-gradient-to-b from-white dark:from-[#07080E] via-[#FDFBF9] dark:via-[#090A12] to-white dark:to-[#07080E] relative overflow-hidden transition-colors duration-200 font-sans">
    
    <!-- Centered Header & Category Filters -->
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 mb-6">
        <div class="text-center max-w-2xl mx-auto">
            <span class="font-mono text-[11px] font-bold tracking-widest text-[#8B0021] dark:text-rose-400 uppercase bg-rose-50 dark:bg-rose-950/60 border border-rose-100 dark:border-rose-800/60 px-4 py-1.5 rounded-full inline-block mb-3">
                KARYA &amp; PORTOFOLIO NYATA
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-950 dark:text-white tracking-tight leading-tight uppercase font-sans">
                <?= esc($copy['portfolio_title'] ?? 'Portofolio Proyek Website Yang Telah Kami Bangun') ?>
            </h2>
            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-2.5 max-w-xl mx-auto leading-relaxed font-sans">
                Jelajahi karya solusi digital dan website yang telah kami bangun dalam format tampilan layar laptop 3D interaktif. Klik tombol untuk melihat rincian.
            </p>

            <!-- Category Filter Pills -->
            <?php if (!empty($categories)): ?>
                <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
                    <button type="button" class="coverflow-filter-btn text-xs font-semibold font-sans px-4 py-1.5 rounded-full transition-all duration-200 cursor-pointer border bg-gradient-to-r from-[#8B0021] to-[#50000F] text-white border-[#8B0021] shadow-xs" data-category="Semua">
                        Semua
                    </button>
                    <?php foreach ($categories as $cat): ?>
                        <button type="button" class="coverflow-filter-btn text-xs font-semibold font-sans px-4 py-1.5 rounded-full transition-all duration-200 cursor-pointer border bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 hover:bg-rose-50 dark:hover:bg-gray-800 hover:text-[#7B0B1E] dark:hover:text-rose-300 border-gray-200 dark:border-gray-800 hover:border-rose-200 dark:hover:border-rose-700" data-category="<?= esc($cat) ?>">
                            <?= esc($cat) ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- 3D Coverflow Interactive Carousel Stage -->
    <div id="coverflow-section" class="relative w-full min-h-[480px] sm:min-h-[540px] flex items-center justify-center overflow-hidden py-4 select-none font-sans">
        
        <!-- Background Subtle Ambient Glow -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <img id="coverflow-ambience-bg" src="<?= !empty($portfolios[0]['image_url']) ? esc($portfolios[0]['image_url']) : '/images/portfolio/cuango.jpg' ?>" 
                 alt="ambience background" 
                 class="w-full h-full object-cover blur-[60px] opacity-15 dark:opacity-20 scale-125 transition-all duration-1000">
            <div class="absolute inset-0 bg-radial from-transparent via-[#FDFBF9]/80 dark:via-[#07080E]/80 to-[#FDFBF9] dark:to-[#07080E]"></div>
        </div>

        <!-- 4-Way Smooth Edge Fade Masks (Top, Bottom, Left, Right) -->
        <div class="absolute top-0 left-0 right-0 h-20 sm:h-32 bg-gradient-to-b from-white dark:from-[#07080E] via-white/80 dark:via-[#07080E]/80 to-transparent pointer-events-none z-35"></div>
        <div class="absolute bottom-0 left-0 right-0 h-20 sm:h-32 bg-gradient-to-t from-white dark:from-[#07080E] via-white/80 dark:via-[#07080E]/80 to-transparent pointer-events-none z-35"></div>
        <div class="absolute top-0 bottom-0 left-0 w-12 sm:w-24 md:w-32 bg-gradient-to-r from-white dark:from-[#07080E] to-transparent pointer-events-none z-35"></div>
        <div class="absolute top-0 bottom-0 right-0 w-12 sm:w-24 md:w-32 bg-gradient-to-l from-white dark:from-[#07080E] to-transparent pointer-events-none z-35"></div>

        <div class="relative w-full z-10 flex flex-col items-center">
            
            <!-- Eyebrow Label Pill -->
            <div class="flex items-center justify-center mb-6">
                <span class="px-3.5 py-1 rounded-full bg-rose-50 dark:bg-rose-950/60 border border-rose-200/50 dark:border-rose-800/40 text-[10px] font-mono font-bold tracking-widest text-[#8B0021] dark:text-rose-300 uppercase shadow-2xs">
                    SOLVETA SHOWCASE
                </span>
            </div>

            <!-- 3D Coverflow Container with Preserved 3D & Gesture Touch Drag -->
            <div id="coverflow-frame" tabindex="0" 
                 class="coverflow-container relative w-full h-[360px] sm:h-[420px] md:h-[460px] flex justify-center items-center mb-4 overflow-visible cursor-grab active:cursor-grabbing outline-none">
                <div id="coverflow-ring" class="coverflow-ring relative w-full h-full flex items-center justify-center select-none">
                    
                    <?php foreach ($portfolios as $idx => $p): ?>
                        <?php
                            $titleFull = $p['title'];
                            $title1 = $titleFull;
                            $title2 = '';
                            if (strpos($titleFull, '—') !== false) {
                                $pts = explode('—', $titleFull);
                                $title1 = trim($pts[0]);
                                $title2 = '– ' . trim(implode('—', array_slice($pts, 1)));
                            } elseif (strpos($titleFull, '-') !== false) {
                                $pts = explode('-', $titleFull);
                                $title1 = trim($pts[0]);
                                $title2 = '– ' . trim(implode('-', array_slice($pts, 1)));
                            }

                            $hasLive = !empty($p['live_url']) && $p['live_url'] !== '#' && strpos($p['live_url'], 'wa.me') === false;
                            $ctaUrl = $hasLive 
                                ? (strpos($p['live_url'], 'http') === 0 ? $p['live_url'] : 'https://' . $p['live_url'])
                                : "https://wa.me/{$waClean}?text=" . rawurlencode("Halo SOLVETA, saya ingin melihat detail dan konsultasi mengenai portofolio: {$p['title']}");
                            $ctaText = $hasLive ? "Kunjungi Website" : "Konsultasi Proyek";
                            $tagStr = esc($p['category'] ?? 'Portofolio');
                            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $title1));
                        ?>
                        <div class="coverflow-card group font-sans" 
                             data-index="<?= $idx ?>"
                             data-category="<?= esc($p['category'] ?? '') ?>"
                             data-img="<?= esc($p['image_url']) ?>">
                            
                            <!-- 1. LAPTOP SCREEN TOP BROWSER BAR -->
                            <div class="absolute top-0 left-0 right-0 h-7 sm:h-8 bg-[#181924]/90 backdrop-blur-md px-3 sm:px-4 flex items-center justify-between z-30 pointer-events-none">
                                <!-- macOS Window Controls -->
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-red-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
                                </div>

                                <!-- Browser URL Tab Pill -->
                                <div class="flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-black/40 border border-white/10 text-[9px] sm:text-[10px] text-gray-300 font-mono">
                                    <i data-lucide="globe" class="w-2.5 h-2.5 text-rose-400"></i>
                                    <span class="truncate max-w-[130px] sm:max-w-[200px]">solveta.asia/showcase/<?= esc($slug) ?></span>
                                </div>

                                <!-- Category Pill on Right -->
                                <span class="text-[9px] sm:text-[10px] font-bold font-mono text-rose-300 uppercase tracking-wider hidden sm:inline-block">
                                    <?= $tagStr ?>
                                </span>
                            </div>

                            <!-- 2. FULL WIDESCREEN PREVIEW IMAGE -->
                            <img src="<?= esc($p['image_url']) ?>" alt="<?= esc($title1) ?>" draggable="false"
                                 class="absolute inset-0 pt-7 sm:pt-8 w-full h-full object-cover object-top select-none pointer-events-none">

                            <!-- Top & Bottom Gradient Overlay -->
                            <div class="absolute inset-0 pt-7 sm:pt-8 bg-gradient-to-t from-black/90 via-black/35 to-transparent pointer-events-none z-10"></div>

                            <!-- 3. WIDESCREEN FROSTED GLASS BOTTOM BANNER OVERLAY -->
                            <div class="coverflow-card-banner absolute bottom-0 left-0 right-0 p-3.5 sm:p-4.5 bg-gradient-to-t from-black/95 via-black/75 to-transparent z-20 flex flex-col sm:flex-row items-start sm:items-end justify-between gap-2 sm:gap-4 text-left pointer-events-auto"
                                 style="transition: opacity 350ms ease, transform 350ms ease;">
                                
                                <div class="space-y-1 max-w-md">
                                    <!-- Mobile Tag -->
                                    <div class="sm:hidden">
                                        <span class="text-[9px] font-bold font-mono px-2 py-0.5 rounded-full bg-rose-950/80 border border-rose-500/40 text-rose-300 uppercase">
                                            <?= $tagStr ?>
                                        </span>
                                    </div>

                                    <!-- Main Title -->
                                    <h4 class="text-sm sm:text-base md:text-lg font-extrabold text-white tracking-tight uppercase leading-tight font-sans drop-shadow-md">
                                        <?= esc($title1) ?>
                                        <?php if (!empty($title2)): ?>
                                            <span class="text-rose-300 font-semibold"><?= esc($title2) ?></span>
                                        <?php endif; ?>
                                    </h4>

                                    <!-- Description -->
                                    <?php if (!empty($p['description'])): ?>
                                        <p class="text-[10px] sm:text-xs text-gray-300 line-clamp-2 leading-relaxed font-sans max-w-sm">
                                            <?= esc($p['description']) ?>
                                        </p>
                                    <?php endif; ?>

                                    <!-- Tags / Tagar Pills -->
                                    <?php if (!empty($p['tags'])): ?>
                                        <div class="flex flex-wrap gap-1 pt-1">
                                            <?php foreach ($p['tags'] as $tg): ?>
                                                <span class="text-[9px] font-mono px-1.5 py-0.5 rounded bg-white/10 text-rose-200 border border-white/10 backdrop-blur-xs">
                                                    #<?= esc($tg) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- CTA Button -->
                                <a href="<?= esc($ctaUrl) ?>" target="_blank" rel="noopener noreferrer"
                                   data-interactive="true"
                                   class="flex-shrink-0 inline-flex items-center gap-1.5 px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-xl bg-gradient-to-r from-[#8B0021] via-[#a30026] to-[#50000F] hover:from-[#b8002b] hover:to-[#5E0013] text-white text-[10px] sm:text-xs font-bold font-sans tracking-wide uppercase shadow-lg shadow-rose-950/50 hover:scale-105 transition-all cursor-pointer border border-rose-500/30 relative z-30 pointer-events-auto">
                                    <span><?= $ctaText ?></span>
                                    <?php if ($hasLive): ?>
                                        <i data-lucide="external-link" class="w-3.5 h-3.5 text-rose-200"></i>
                                    <?php else: ?>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-rose-200"></i>
                                    <?php endif; ?>
                                </a>
                            </div>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- Navigation Arrows -->
            <button id="coverflow-prev-btn" type="button" aria-label="Portofolio sebelumnya"
                    class="absolute left-2 sm:left-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/90 dark:bg-gray-900/90 border border-gray-200 dark:border-gray-800 text-[#8B0021] dark:text-rose-400 hover:scale-110 flex items-center justify-center backdrop-blur-md shadow-md hover:shadow-xl cursor-pointer z-40 transition-all">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>

            <button id="coverflow-next-btn" type="button" aria-label="Portofolio berikutnya"
                    class="absolute right-2 sm:right-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/90 dark:bg-gray-900/90 border border-gray-200 dark:border-gray-800 text-[#8B0021] dark:text-rose-400 hover:scale-110 flex items-center justify-center backdrop-blur-md shadow-md hover:shadow-xl cursor-pointer z-40 transition-all">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>

            <!-- Pagination Dots -->
            <div id="coverflow-dots" class="flex items-center justify-center gap-2 z-30 mt-2">
                <!-- Populated dynamically via JS -->
            </div>

        </div>

    </div>

    <!-- Bottom Consultation Link -->
    <div class="mt-8 text-center max-w-[1240px] mx-auto px-4 sm:px-6">
        <a href="<?= $waOrderGeneral ?>" target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-2 text-xs font-bold font-sans text-[#8B0021] dark:text-rose-400 bg-rose-50 dark:bg-rose-950/60 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200/80 dark:border-rose-800/80 px-5 py-2.5 rounded-full transition-colors shadow-2xs">
            <span>Punya Kebutuhan Sistem / Website Serupa? Diskusikan dengan Kami</span>
            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </a>
    </div>

</section>


<!-- ==============================================================================
     6. PRICING SECTION (Identical to Next.js PricingSection.tsx)
     ============================================================================== -->
<section id="pricing" class="py-16 sm:py-24 bg-slate-50/60 dark:bg-[#090A12] border-t border-gray-100 dark:border-gray-800 transition-colors duration-200 font-sans">
    <div class="max-w-[1140px] mx-auto px-4 sm:px-6">
        
        <!-- Section Header -->
        <div class="text-center mb-10">
            <span class="inline-block text-[11px] font-mono font-bold tracking-widest text-[#8B0021] dark:text-rose-400 bg-rose-50 dark:bg-rose-950/60 border border-rose-200/70 dark:border-rose-800/60 px-3.5 py-1 rounded-full uppercase mb-3">
                PILIHAN PAKET &amp; RINCIAN LENGKAP
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-950 dark:text-white tracking-tight mb-3 uppercase">
                INFORMASI RINCI SETIAP PAKET
            </h2>
            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Rincian lengkap masing-masing 4 paket website dengan tata letak minimalis, batas garis tepi yang tegas, dan transparansi spesifikasi tanpa biaya tersembunyi.
            </p>
        </div>

        <!-- Quick Filter Navigation Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-12">
            <button type="button" class="pricing-filter-btn px-4 py-1.5 rounded-full text-xs font-semibold transition-all border bg-[#8B0021] text-white border-[#8B0021] shadow-xs cursor-pointer" data-target="all">
                Semua 4 Paket (Berurutan)
            </button>
            <?php foreach ($tiers as $tier): ?>
                <?php $badge = !empty($tier['price_badge']) ? $tier['price_badge'] : $tier['price']; ?>
                <button type="button" class="pricing-filter-btn px-4 py-1.5 rounded-full text-xs font-semibold transition-all border bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-850 cursor-pointer" data-target="tier-<?= esc($tier['id']) ?>">
                    Paket <?= esc($tier['name']) ?> (<?= esc($badge) ?>)
                </button>
            <?php endforeach; ?>
        </div>

        <!-- STACKED INDIVIDUAL PACKAGE CARDS (ONE BY ONE SEQUENTIALLY) -->
        <div class="space-y-12 sm:space-y-16">
            <?php foreach ($tiers as $tier): ?>
                <?php
                    $isPopular = !empty($tier['popular']);
                    $tierWaMsg = !empty($tier['wa_message']) ? $tier['wa_message'] : "Halo SOLVETA, saya tertarik untuk memesan Paket {$tier['name']} {$tier['price']}.";
                    $tierWaUrl = "https://wa.me/{$waClean}?text=" . rawurlencode($tierWaMsg);
                    $priceBadge = !empty($tier['price_badge']) ? $tier['price_badge'] : preg_replace('/Rp\s*/i', '', $tier['price']);
                    $delivery = !empty($tier['delivery_time']) ? $tier['delivery_time'] : '3–5 Hari';
                    $activePeriod = !empty($tier['active_period']) ? $tier['active_period'] : '1 Tahun';
                    $renewal = !empty($tier['renewal_price']) ? $tier['renewal_price'] : '249k/tahun*';
                    $checklist = !empty($tier['checklist']) ? $tier['checklist'] : [];
                    if (empty($checklist) && !empty($tier['features'])) {
                        foreach ($tier['features'] as $f) {
                            $isInc = stripos($f, 'tidak termasuk') === false && strpos($f, '❌') !== 0;
                            $checklist[] = ['text' => preg_replace('/^[✔❌\s]+/', '', $f), 'included' => $isInc];
                        }
                    }
                ?>
                <div id="tier-<?= esc($tier['id']) ?>" 
                     class="pricing-tier-card bg-white dark:bg-[#11121B] rounded-2xl transition-all duration-300 overflow-hidden shadow-2xs <?= $isPopular ? 'border-2 border-[#8B0021] dark:border-rose-600 shadow-md shadow-rose-950/5 dark:shadow-rose-950/20' : 'border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-700 hover:shadow-xs' ?>">
                    
                    <!-- Popular Banner -->
                    <?php if ($isPopular): ?>
                        <div class="bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] text-white text-center font-mono text-[11px] font-bold uppercase tracking-widest py-1.5 px-4 flex items-center justify-center gap-2">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-300"></i>
                            <span>PAKET PALING DIREKOMENDASIKAN (POPULAR)</span>
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-300"></i>
                        </div>
                    <?php endif; ?>

                    <!-- Main Card Body (2 Columns Layout) -->
                    <div class="p-6 sm:p-8 lg:p-10">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                            
                            <!-- LEFT COLUMN: Price Pill, Masa Aktif Box, Cocok Untuk Box, CTA Button -->
                            <div class="lg:col-span-5 flex flex-col justify-between space-y-4">
                                
                                <!-- Top Script Label + Large Price Badge -->
                                <div class="border border-gray-200 dark:border-gray-800 rounded-2xl p-5 bg-gradient-to-b from-gray-50/80 dark:from-gray-900/60 to-white dark:to-gray-900 text-center relative shadow-2xs">
                                    <div class="text-[11px] font-mono font-bold tracking-widest text-[#8B0021] dark:text-rose-400 uppercase mb-1">
                                        PAKET WEBSITE
                                    </div>

                                    <?php if (!empty($tier['price_prefix'])): ?>
                                        <span class="text-xs text-gray-500 font-semibold block mb-0.5"><?= esc($tier['price_prefix']) ?></span>
                                    <?php endif; ?>

                                    <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-950 dark:text-white tracking-tight leading-none mb-1 font-sans">
                                        <?= esc($tier['price']) ?>
                                    </div>

                                    <?php if (!empty($tier['renewal_price'])): ?>
                                        <div class="text-[11px] font-mono font-semibold text-gray-500 dark:text-gray-400 mt-1">
                                            Biaya Perpanjangan: <?= esc($renewal) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Box 2: Masa Aktif & Estimasi Pengerjaan -->
                                <div class="grid grid-cols-2 gap-3 text-center">
                                    <div class="border border-gray-200 dark:border-gray-800 rounded-xl p-3 bg-white dark:bg-gray-900/60">
                                        <span class="text-[10px] text-gray-400 font-mono uppercase block mb-0.5">Masa Aktif:</span>
                                        <span class="text-xs font-bold text-gray-900 dark:text-white"><?= esc($activePeriod) ?></span>
                                    </div>
                                    <div class="border border-gray-200 dark:border-gray-800 rounded-xl p-3 bg-white dark:bg-gray-900/60">
                                        <span class="text-[10px] text-gray-400 font-mono uppercase block mb-0.5">Estimasi Jadi:</span>
                                        <span class="text-xs font-bold text-gray-900 dark:text-white"><?= esc($delivery) ?></span>
                                    </div>
                                </div>

                                <!-- Box 3: Cocok Untuk Siapa -->
                                <div class="border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-gray-50/50 dark:bg-gray-900/40 text-xs">
                                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-[#8B0021] dark:text-rose-400 block mb-1">
                                        Cocok / Direkomendasikan Untuk:
                                    </span>
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed font-sans">
                                        <?= esc($tier['suitability']) ?>
                                    </p>
                                </div>

                                <!-- Box 4: CTA Button WhatsApp -->
                                <div>
                                    <a href="<?= $tierWaUrl ?>" target="_blank" rel="noopener noreferrer"
                                       class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl text-white text-xs sm:text-sm font-bold uppercase tracking-wider font-sans transition-all duration-300 shadow-md cursor-pointer <?= $isPopular ? 'bg-gradient-to-r from-[#8B0021] via-[#a30026] to-[#50000F] hover:from-[#b8002b] hover:to-[#5E0013] shadow-rose-950/40' : 'bg-gray-900 dark:bg-rose-900/80 hover:bg-[#8B0021] dark:hover:bg-rose-800' ?>">
                                        <i data-lucide="message-circle" class="w-4 h-4 text-rose-200"></i>
                                        <span><?= esc($tier['button_label'] ?: "Pesan Paket {$tier['name']}") ?></span>
                                        <i data-lucide="arrow-right" class="w-4 h-4 text-rose-200"></i>
                                    </a>
                                </div>

                            </div>

                            <!-- RIGHT COLUMN: Termasuk Dalam Paket (Checklist) -->
                            <div class="lg:col-span-7 space-y-4">
                                <div class="border border-gray-200 dark:border-gray-800 rounded-2xl p-5 sm:p-6 bg-white dark:bg-gray-900/30">
                                    <div class="flex items-center gap-2 text-xs font-mono font-bold uppercase tracking-wider text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-100 dark:border-gray-800">
                                        <i data-lucide="sparkles" class="w-4 h-4 text-[#8B0021] dark:text-rose-400"></i>
                                        <span>Termasuk Dalam Paket (Fitur Utama):</span>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                        <?php foreach ($checklist as $chk): ?>
                                            <div class="flex items-start gap-2.5">
                                                <?php if (!empty($chk['included'])): ?>
                                                    <div class="w-4 h-4 rounded-full bg-emerald-50 dark:bg-emerald-950/80 border border-emerald-300 dark:border-emerald-700/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                        <i data-lucide="check" class="w-2.5 h-2.5 stroke-[2.5]"></i>
                                                    </div>
                                                    <span class="text-gray-800 dark:text-gray-200 font-medium leading-relaxed font-sans">
                                                        <?= esc($chk['text']) ?>
                                                    </span>
                                                <?php else: ?>
                                                    <div class="w-4 h-4 rounded-full bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                        <i data-lucide="x" class="w-2.5 h-2.5 stroke-[2.5]"></i>
                                                    </div>
                                                    <span class="text-gray-400 dark:text-gray-500 line-through leading-relaxed font-sans">
                                                        <?= esc($chk['text']) ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- 3 SUB-CARDS SECTION AT THE BOTTOM: Domain, Email, Revisi -->
                        <div class="mt-8 pt-8 border-t border-gray-100 dark:border-gray-800 grid grid-cols-1 md:grid-cols-3 gap-4">
                            
                            <!-- Sub-Card 1: Domain & Server Hosting -->
                            <?php if (!empty($tier['domain_addons'])): ?>
                                <div class="border border-gray-200 dark:border-gray-800 rounded-xl bg-white dark:bg-gray-900 p-4 text-xs">
                                    <div class="flex items-center gap-1.5 font-bold text-gray-900 dark:text-white uppercase tracking-wider text-[11px] mb-2">
                                        <i data-lucide="globe" class="w-3.5 h-3.5 text-[#8B0021] dark:text-rose-400"></i>
                                        <span>Upgrade Ekstensi Domain:</span>
                                    </div>
                                    <div class="space-y-2 text-[11px]">
                                        <?php foreach ($tier['domain_addons'] as $dom): ?>
                                            <div class="flex justify-between items-center p-2 rounded bg-gray-50 dark:bg-gray-800/60 border border-gray-100 dark:border-gray-800">
                                                <span class="text-gray-700 dark:text-gray-300 font-medium">Domain <?= esc($dom['name']) ?></span>
                                                <span class="font-semibold text-gray-900 dark:text-white"><?= esc($dom['price']) ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="border border-gray-200 dark:border-gray-800 rounded-xl bg-white dark:bg-gray-900 p-4 text-xs flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center gap-1.5 font-bold text-gray-900 dark:text-white uppercase tracking-wider text-[11px] mb-2">
                                            <i data-lucide="globe" class="w-3.5 h-3.5 text-[#8B0021] dark:text-rose-400"></i>
                                            <span>Domain &amp; Server Hosting:</span>
                                        </div>
                                        <p class="text-[11px] text-gray-500 dark:text-gray-400 leading-relaxed mb-2 font-sans">
                                            Sudah termasuk sewa domain standar (.com, .net, .org) &amp; hosting server berkecepatan tinggi selama 1 tahun pertama.
                                        </p>
                                    </div>
                                    <div class="text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200/60 dark:border-emerald-800 px-2 py-1 rounded">
                                        ✓ Siap online langsung tanpa biaya setup tambahan
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Sub-Card 2: Layanan Email Profesional -->
                            <?php if (!empty($tier['email_addons'])): ?>
                                <div class="border border-gray-200 dark:border-gray-800 rounded-xl bg-white dark:bg-gray-900 p-4 text-xs">
                                    <div class="flex items-center gap-1.5 font-bold text-gray-900 dark:text-white uppercase tracking-wider text-[11px] mb-2">
                                        <i data-lucide="mail" class="w-3.5 h-3.5 text-[#8B0021] dark:text-rose-400"></i>
                                        <span>Layanan Email Profesional:</span>
                                    </div>
                                    <div class="space-y-2 text-[11px]">
                                        <?php foreach ($tier['email_addons'] as $em): ?>
                                            <div class="flex justify-between items-center p-2 rounded bg-gray-50 dark:bg-gray-800/60 border border-gray-100 dark:border-gray-800">
                                                <span class="text-gray-700 dark:text-gray-300 font-medium"><?= esc($em['name']) ?></span>
                                                <span class="font-bold text-gray-900 dark:text-white"><?= esc($em['price']) ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="border border-gray-200 dark:border-gray-800 rounded-xl bg-white dark:bg-gray-900 p-4 text-xs flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center gap-1.5 font-bold text-gray-900 dark:text-white uppercase tracking-wider text-[11px] mb-2">
                                            <i data-lucide="mail" class="w-3.5 h-3.5 text-[#8B0021] dark:text-rose-400"></i>
                                            <span>Alokasi Email Bisnis:</span>
                                        </div>
                                        <p class="text-[11px] text-gray-500 dark:text-gray-400 leading-relaxed font-sans">
                                            <?php if ($tier['id'] === 'standard'): ?>
                                                Termasuk 1 akun email bisnis (nama@domain.com) dengan webmail & setup SMTP.
                                            <?php elseif ($tier['id'] === 'premium'): ?>
                                                Termasuk 2 akun email bisnis (nama@domain.com) terkonfigurasi penuh.
                                            <?php elseif ($tier['id'] === 'custom'): ?>
                                                Unlimited akun email bisnis dengan hak akses cPanel penuh.
                                            <?php else: ?>
                                                Dapat ditambahkan kapan saja (+Rp 50.000/akun email bisnis).
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="text-[10px] text-gray-500 dark:text-gray-400 pt-2 border-t border-gray-100 dark:border-gray-800">
                                        *Email tambahan dapat ditambahkan kapan saja.
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Sub-Card 3: Tarif Revisi & Ketentuan -->
                            <div class="border border-gray-200 dark:border-gray-800 rounded-xl bg-white dark:bg-gray-900 p-4 text-xs">
                                <div class="flex items-center gap-1.5 font-bold text-gray-900 dark:text-white uppercase tracking-wider text-[11px] mb-2">
                                    <i data-lucide="shield-check" class="w-3.5 h-3.5 text-[#8B0021] dark:text-rose-400"></i>
                                    <span>Tarif &amp; Ketentuan Revisi:</span>
                                </div>
                                <div class="space-y-1.5 text-[11px] text-gray-600 dark:text-gray-400 font-sans">
                                    <?php 
                                        $revRules = !empty($tier['revision_rules']) ? $tier['revision_rules'] : [];
                                    ?>
                                    <div class="flex items-start gap-1">
                                        <span class="text-gray-400">•</span>
                                        <div>
                                            <strong class="text-gray-800 dark:text-gray-200">Revisi Ringan:</strong> <?= esc($revRules['light'] ?? 'Maksimal 2x perbaikan kecil') ?>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-1">
                                        <span class="text-gray-400">•</span>
                                        <div>
                                            <strong class="text-gray-800 dark:text-gray-200">Revisi Berat:</strong> <?= esc($revRules['heavy'] ?? 'Perubahan struktur dikenakan biaya') ?>
                                        </div>
                                    </div>
                                    <?php if (!empty($revRules['extraPage'])): ?>
                                        <div class="flex items-start gap-1">
                                            <span class="text-gray-400">•</span>
                                            <div>
                                                <strong class="text-gray-800 dark:text-gray-200">Tambah Halaman:</strong> <?= esc($revRules['extraPage']) ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($tier['custom_note'])): ?>
                                        <div class="text-[10px] text-[#8B0021] dark:text-rose-400 font-semibold pt-1 border-t border-gray-100 dark:border-gray-800">
                                            <?= esc($tier['custom_note']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <!-- Global Assurance Banner -->
        <div class="mt-12 border border-gray-200 dark:border-gray-800 rounded-2xl bg-white dark:bg-gray-900 p-5 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-gray-600 dark:text-gray-400 shadow-2xs font-sans">
            <div class="flex items-start gap-3">
                <i data-lucide="info" class="w-5 h-5 text-[#8B0021] dark:text-rose-400 flex-shrink-0 mt-0.5"></i>
                <div>
                    <strong class="text-gray-900 dark:text-white font-semibold block mb-0.5">
                        Garansi Penuh &amp; Ketentuan Transparansi SOLVETA:
                    </strong>
                    <p class="text-[11px] leading-relaxed text-gray-500 dark:text-gray-400 font-sans">
                        *Biaya perpanjangan tahun berikutnya digunakan untuk sewa domain &amp; hosting aktif. Semua paket website mendapatkan garansi pemeliharaan perbaikan error secara cuma-cuma.
                    </p>
                </div>
            </div>

            <a href="<?= $waOrderGeneral ?>" target="_blank" rel="noopener noreferrer"
               class="flex-shrink-0 px-5 py-2.5 bg-[#8B0021] hover:bg-[#750019] text-white text-xs font-bold rounded-xl transition-all flex items-center gap-2 shadow-xs cursor-pointer font-sans">
                <span>Konsultasi WhatsApp</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

    </div>
</section>


<!-- ==============================================================================
     7. WORKING PROCESS SECTION (Identical to Next.js ProcessSection.tsx)
     ============================================================================== -->
<section id="process" class="py-16 bg-white dark:bg-[#07080E] border-t border-gray-100 dark:border-gray-800 transition-colors duration-200 font-sans">
    <div class="max-w-[1160px] mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-base sm:text-lg font-bold uppercase tracking-wider text-gray-900 dark:text-white">
                BAGAIMANA SOLVETA BEKERJA?
            </h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 text-center">
            <?php
                $processSteps = [
                    ['num' => 1, 'title' => 'Understand', 'sub' => 'Memahami kebutuhan'],
                    ['num' => 2, 'title' => 'Analyze', 'sub' => 'Analisis masalah'],
                    ['num' => 3, 'title' => 'Design', 'sub' => 'Merancang solusi'],
                    ['num' => 4, 'title' => 'Develop', 'sub' => 'Membangun sistem'],
                    ['num' => 5, 'title' => 'Integrate', 'sub' => 'Integrasi data'],
                    ['num' => 6, 'title' => 'Launch', 'sub' => 'Implementasi akhir'],
                ];
            ?>
            <?php foreach ($processSteps as $step): ?>
                <div class="flex flex-col items-center group">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-100 dark:border-rose-800/60 text-[#8B0021] dark:text-rose-300 flex items-center justify-center font-extrabold text-base mb-3.5 shadow-xs group-hover:bg-[#8B0021] group-hover:text-white transition-colors duration-200 font-sans">
                        <?= $step['num'] ?>
                    </div>
                    <h3 class="text-xs font-bold text-gray-900 dark:text-gray-100 mb-1 font-sans">
                        <?= $step['title'] ?>
                    </h3>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400 leading-tight font-sans">
                        <?= $step['sub'] ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ==============================================================================
     8. PHILOSOPHY SECTION (Identical to Next.js PhilosophySection.tsx)
     ============================================================================== -->
<section id="philosophy" class="py-20 bg-white dark:bg-[#07080E] border-t border-gray-100 dark:border-gray-800 transition-colors duration-200 font-sans">
    <div class="max-w-[840px] mx-auto px-6 text-center">
        <div class="space-y-6">
            <!-- Slogan in Merah Maroon Premium Gradasi -->
            <div class="pt-2 pb-2">
                <div class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight leading-snug font-sans">
                    <span class="bg-gradient-to-r from-[#8B0021] via-[#c00030] dark:via-rose-400 to-[#50000F] dark:to-rose-500 bg-clip-text text-transparent">
                        Bukan sekadar membangun teknologi.
                    </span>
                    <br />
                    <span class="text-gray-950 dark:text-white">Kami membangun solusi.</span>
                </div>
            </div>

            <!-- WhatsApp CTA Button with Maroon Gradient -->
            <div class="pt-2">
                <a href="<?= $waOrderGeneral ?>" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2.5 px-8 py-3.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white text-xs sm:text-sm font-bold rounded-xl shadow-md hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-300 font-sans">
                    <span>Konsultasikan Kebutuhan Anda</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-rose-200"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
