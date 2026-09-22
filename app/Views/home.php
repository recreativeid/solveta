<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285719663154');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
?>

<!-- ==============================================================================
     1. HERO SECTION & 3D LAPTOP SHOWCASE
     ============================================================================== -->
<section class="relative pt-16 pb-20 md:pt-24 md:pb-28 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        
        <!-- Eyebrow Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-950/50 border border-red-800/40 text-red-400 text-xs font-semibold tracking-wider uppercase mb-8 shadow-inner animate-pulse-subtle">
            <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
            <?= esc($copy['hero_eyebrow'] ?? 'SOLVE TECHNOLOGY AGENCY') ?>
        </div>

        <!-- Headline -->
        <h1 class="font-heading font-black text-4xl sm:text-6xl lg:text-7xl tracking-tight text-white max-w-5xl mx-auto leading-[1.1] mb-6">
            <?php 
                $headline = esc($copy['hero_headline'] ?? 'Mengubah Tantangan Bisnis Menjadi Solusi Digital.');
                $headlineParts = explode('Solusi Digital', $headline);
                if (count($headlineParts) > 1) {
                    echo $headlineParts[0] . '<span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-red-600 to-rose-400 glow-text">Solusi Digital</span>' . $headlineParts[1];
                } else {
                    echo $headline;
                }
            ?>
        </h1>

        <!-- Subtitle -->
        <p class="text-zinc-400 text-base sm:text-xl max-w-3xl mx-auto leading-relaxed mb-10">
            <?= esc($copy['hero_subtitle'] ?? 'Banyak bisnis terhambat oleh proses manual, informasi yang tidak terstruktur, dan kurangnya integrasi. SOLVETA hadir untuk menyederhanakan masalah kompleks melalui solusi digital dan otomasi yang efisien.') ?>
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 max-w-md mx-auto mb-16">
            <a href="#pricing" 
               class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white font-bold text-base shadow-xl shadow-red-700/30 hover:shadow-red-600/50 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <span>Pilih Paket & Estimasi</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>

            <?php 
                $waHeroUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo SOLVETA, saya ingin berkonsultasi mengenai pembuatan website untuk bisnis saya.");
            ?>
            <a href="<?= $waHeroUrl ?>" target="_blank" rel="noopener noreferrer" 
               class="w-full sm:w-auto px-8 py-4 rounded-xl bg-zinc-900/90 hover:bg-zinc-800 text-zinc-200 hover:text-white font-semibold text-base border border-white/10 hover:border-zinc-700 transition-all flex items-center justify-center gap-2">
                <i data-lucide="message-circle" class="w-4 h-4 text-emerald-400"></i>
                <span>Tanya via WhatsApp</span>
            </a>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto pt-6 border-t border-white/[0.08] text-center mb-16">
            <div class="p-4 rounded-xl bg-white/[0.02] border border-white/[0.04]">
                <div class="font-heading font-extrabold text-2xl sm:text-3xl text-white">100+</div>
                <div class="text-xs text-zinc-400 mt-1">Proyek Digital Sukses</div>
            </div>
            <div class="p-4 rounded-xl bg-white/[0.02] border border-white/[0.04]">
                <div class="font-heading font-extrabold text-2xl sm:text-3xl text-emerald-400">99.8%</div>
                <div class="text-xs text-zinc-400 mt-1">Tingkat Kepuasan Klien</div>
            </div>
            <div class="p-4 rounded-xl bg-white/[0.02] border border-white/[0.04]">
                <div class="font-heading font-extrabold text-2xl sm:text-3xl text-white">3-7 Hari</div>
                <div class="text-xs text-zinc-400 mt-1">Rata-rata Waktu Launching</div>
            </div>
            <div class="p-4 rounded-xl bg-white/[0.02] border border-white/[0.04]">
                <div class="font-heading font-extrabold text-2xl sm:text-3xl text-red-500">100%</div>
                <div class="text-xs text-zinc-400 mt-1">Garansi Purna Jual</div>
            </div>
        </div>

        <!-- 3D LAPTOP MOCKUP & SHOWCASE VIDEO -->
        <div class="laptop-perspective max-w-4xl mx-auto relative pt-4">
            <div class="laptop-chassis relative rounded-t-2xl p-3 sm:p-4 bg-gradient-to-b from-zinc-700 via-zinc-800 to-zinc-950 border border-zinc-600/40">
                <!-- Screen Bezel -->
                <div class="relative rounded-xl overflow-hidden bg-black aspect-video border border-zinc-900 shadow-2xl flex items-center justify-center">
                    
                    <!-- WebCam Notch -->
                    <div class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-4 bg-zinc-950 rounded-b-lg z-30 flex items-center justify-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-zinc-800 border border-zinc-700"></span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500/80 animate-pulse"></span>
                    </div>

                    <!-- Video / Interactive Content -->
                    <?php 
                        $videoSrc = !empty($copy['profile_video']) ? $copy['profile_video'] : '/videos/profile.mp4';
                    ?>
                    <video id="hero-profile-video" 
                           class="w-full h-full object-cover" 
                           autoplay loop muted playsinline>
                        <source src="<?= esc($videoSrc) ?>" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video.
                    </video>

                    <!-- Overlay Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20 pointer-events-none"></div>

                    <!-- Floating Badge on Screen -->
                    <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between pointer-events-none z-20">
                        <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-black/70 backdrop-blur-md border border-white/10 text-xs text-white">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                            <span class="font-medium">SOLVETA System & Portfolio Preview</span>
                        </div>
                        <div class="hidden sm:flex items-center gap-1.5 text-[11px] text-zinc-400 bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-md border border-white/10">
                            <i data-lucide="play" class="w-3 h-3 text-red-500"></i>
                            <span>Klik video untuk jeda/putar</span>
                        </div>
                    </div>
                </div>

                <!-- Laptop Base / Keyboard Deck -->
                <div class="h-4 sm:h-5 bg-gradient-to-b from-zinc-700 to-zinc-900 rounded-b-xl border-t border-zinc-600/30 relative flex items-center justify-center">
                    <div class="w-24 h-1.5 bg-zinc-800 rounded-full border-t border-zinc-950/50"></div>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- ==============================================================================
     2. CLIENT BRAND MARQUEE SLIDER
     ============================================================================== -->
<section class="py-12 border-y border-white/[0.08] bg-[#0c0c10] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-center">
        <h3 class="text-xs uppercase tracking-widest text-zinc-400 font-bold">
            <?= esc($copy['marquee_title'] ?? 'DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG') ?>
        </h3>
    </div>

    <!-- Marquee Ticker -->
    <div class="relative w-full overflow-hidden" style="--marquee-speed: <?= (int) ($copy['marquee_speed'] ?? 35) ?>s;">
        <!-- Left & Right Fade Shadows -->
        <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r from-[#0c0c10] to-transparent z-10 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l from-[#0c0c10] to-transparent z-10 pointer-events-none"></div>

        <div class="animate-marquee flex items-center gap-12 sm:gap-16 py-3">
            <!-- Duplicate twice for smooth continuous infinite loop -->
            <?php for ($i = 0; $i < 2; $i++): ?>
                <?php foreach ($brands as $brand): ?>
                    <div class="flex items-center gap-3 shrink-0 px-4 py-2 rounded-xl bg-white/[0.03] border border-white/[0.05] hover:border-red-500/30 transition-all cursor-default">
                        <?php if (!empty($brand['logo_image'])): ?>
                            <img src="<?= esc($brand['logo_image']) ?>" alt="<?= esc($brand['name']) ?>" 
                                 class="object-contain" 
                                 style="height: <?= (int) ($copy['marquee_logo_height'] ?? 46) * (float) ($brand['scale'] ?? 1.0) ?>px;">
                        <?php else: ?>
                            <div class="w-8 h-8 rounded-lg bg-zinc-800 border border-zinc-700 flex items-center justify-center font-bold text-red-500 text-sm">
                                <?= substr(esc($brand['name']), 0, 1) ?>
                            </div>
                        <?php endif; ?>
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-zinc-200 tracking-tight whitespace-nowrap"><?= esc($brand['name']) ?></span>
                            <?php if (!empty($brand['label'])): ?>
                                <span class="text-[10px] text-zinc-500 uppercase tracking-wider"><?= esc($brand['label']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>


<!-- ==============================================================================
     3. PROBLEM & SOLUTION SECTION
     ============================================================================== -->
<section class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs uppercase tracking-widest text-red-500 font-bold">Tantangan vs Solusi</span>
            <h2 class="font-heading font-extrabold text-3xl sm:text-5xl text-white tracking-tight mt-2 mb-4">
                Mengapa Website Standar Saja Tidak Cukup?
            </h2>
            <p class="text-zinc-400 text-sm sm:text-base leading-relaxed">
                Website tanpa strategi hanya menjadi brosur digital yang sepi pengunjung. SOLVETA membangun aset digital yang aktif mengonversi calon pelanggan menjadi penjualan nyata.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left: Masalah Bisnis Konvensional -->
            <div class="p-8 rounded-2xl bg-zinc-950/60 border border-red-950/40 relative">
                <div class="flex items-center gap-3 text-red-400 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-red-950/60 border border-red-800/40 flex items-center justify-center">
                        <i data-lucide="x-circle" class="w-5 h-5 text-red-500"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-white">Kendala Bisnis Konvensional</h3>
                </div>
                <ul class="space-y-4 text-sm text-zinc-400">
                    <li class="flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-red-500 shrink-0 mt-0.5"></i>
                        <span>Pencatatan pesanan manual yang berantakan dan rentan salah hitung.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-red-500 shrink-0 mt-0.5"></i>
                        <span>Calon klien ragu membeli karena bisnis tidak memiliki website resmi berdomain sendiri.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-red-500 shrink-0 mt-0.5"></i>
                        <span>Website lama lambat dimuat, tata letak rusak di layar smartphone, dan minim konversi.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-red-500 shrink-0 mt-0.5"></i>
                        <span>Biaya pembuatan software custom yang seringkali mahal dan proses pengerjaan berbulan-bulan.</span>
                    </li>
                </ul>
            </div>

            <!-- Right: Solusi SOLVETA -->
            <div class="p-8 rounded-2xl bg-gradient-to-br from-zinc-900/90 via-zinc-900/60 to-red-950/30 border border-red-600/30 relative glow-red">
                <div class="flex items-center gap-3 text-emerald-400 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-emerald-950/60 border border-emerald-800/40 flex items-center justify-center">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-white">Solusi Cerdas SOLVETA</h3>
                </div>
                <ul class="space-y-4 text-sm text-zinc-300">
                    <li class="flex items-start gap-3">
                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                        <span>Website ultra-cepat, mobile-first, dan dioptimasi penuh untuk ranking mesin pencari Google.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                        <span>Integrasi tombol pemesanan WhatsApp cerdas yang langsung memuat rincian pesanan pelanggan.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                        <span>Domain resmi (.com / .id / .my.id), hosting SSD NVMe cepat, dan sertifikat keamanan SSL gratis.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                        <span>Proses transparan mulai dari Rp 299K dengan pengerjaan kilat 3-7 hari kerja bergaransi penuh.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>


<!-- ==============================================================================
     4. SERVICES SECTION
     ============================================================================== -->
<section id="services" class="py-24 bg-[#07070a] border-y border-white/[0.08] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs uppercase tracking-widest text-red-500 font-bold">Kapabilitas Kami</span>
            <h2 class="font-heading font-extrabold text-3xl sm:text-5xl text-white tracking-tight mt-2 mb-4">
                Layanan Digital Terpadu untuk Pertumbuhan Bisnis
            </h2>
            <p class="text-zinc-400 text-sm sm:text-base">
                Kami merancang arsitektur website dan sistem modern yang disesuaikan secara presisi dengan kebutuhan operasional usaha Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Service 1 -->
            <div class="p-6 rounded-2xl glass-panel glass-panel-hover flex flex-col">
                <div class="w-12 h-12 rounded-xl bg-red-950/60 border border-red-800/40 text-red-500 flex items-center justify-center mb-6">
                    <i data-lucide="globe" class="w-6 h-6"></i>
                </div>
                <h3 class="font-heading font-bold text-lg text-white mb-2">Website & Company Profile</h3>
                <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed mb-6 flex-grow">
                    Membangun citra kredibilitas tinggi bagi perusahaan, klinik, kantor hukum, konsultan, dan penyedia jasa profesional.
                </p>
                <div class="pt-4 border-t border-white/[0.06] text-xs font-semibold text-red-400 flex items-center gap-1.5">
                    <span>Mulai Rp 299K</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="p-6 rounded-2xl glass-panel glass-panel-hover flex flex-col">
                <div class="w-12 h-12 rounded-xl bg-red-950/60 border border-red-800/40 text-red-500 flex items-center justify-center mb-6">
                    <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                </div>
                <h3 class="font-heading font-bold text-lg text-white mb-2">E-Commerce & Katalog Produk</h3>
                <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed mb-6 flex-grow">
                    Katalog online interaktif dengan filter kategori, varian produk, dan direct WhatsApp checkout otomatis tanpa potongan komisi marketplace.
                </p>
                <div class="pt-4 border-t border-white/[0.06] text-xs font-semibold text-red-400 flex items-center gap-1.5">
                    <span>Mulai Rp 749K</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="p-6 rounded-2xl glass-panel glass-panel-hover flex flex-col">
                <div class="w-12 h-12 rounded-xl bg-red-950/60 border border-red-800/40 text-red-500 flex items-center justify-center mb-6">
                    <i data-lucide="database" class="w-6 h-6"></i>
                </div>
                <h3 class="font-heading font-bold text-lg text-white mb-2">Custom System & Web App</h3>
                <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed mb-6 flex-grow">
                    Pengembangan aplikasi sistem terintegrasi: database inventaris gudang, manajemen absensi staf, kasir POS, dan portal klien khusus.
                </p>
                <div class="pt-4 border-t border-white/[0.06] text-xs font-semibold text-red-400 flex items-center gap-1.5">
                    <span>Mulai Rp 1,5 Juta</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="p-6 rounded-2xl glass-panel glass-panel-hover flex flex-col">
                <div class="w-12 h-12 rounded-xl bg-red-950/60 border border-red-800/40 text-red-500 flex items-center justify-center mb-6">
                    <i data-lucide="sparkles" class="w-6 h-6"></i>
                </div>
                <h3 class="font-heading font-bold text-lg text-white mb-2">Otomasi & Redesign UI/UX</h3>
                <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed mb-6 flex-grow">
                    Memperbarui tampilan website lama agar terlihat modern, mempercepat loading time hingga skor 95+, dan integrasi bot notifikasi WhatsApp.
                </p>
                <div class="pt-4 border-t border-white/[0.06] text-xs font-semibold text-red-400 flex items-center gap-1.5">
                    <span>Konsultasi Bebas</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ==============================================================================
     5. PRICING PACKAGES SECTION
     ============================================================================== -->
<section id="pricing" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs uppercase tracking-widest text-red-500 font-bold">Investasi Transparan</span>
            <h2 class="font-heading font-extrabold text-3xl sm:text-5xl text-white tracking-tight mt-2 mb-4">
                Pilihan Paket Pembuatan Website
            </h2>
            <p class="text-zinc-400 text-sm sm:text-base">
                Biaya jelas tanpa ada biaya tersembunyi. Termasuk domain resmi, hosting cloud berkecepatan tinggi, dan garansi teknis.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 items-stretch">
            <?php foreach ($tiers as $tier): ?>
                <?php 
                    $isPopular = !empty($tier['popular']);
                    $borderClass = $isPopular ? 'border-red-600/60 glow-red bg-zinc-900/90' : 'border-white/[0.08] glass-panel';
                    
                    // Format WhatsApp link for this tier
                    $tierWaMsg = !empty($tier['wa_message']) ? $tier['wa_message'] : "Halo SOLVETA, saya tertarik dengan paket {$tier['name']}";
                    $tierWaUrl = "https://wa.me/{$waClean}?text=" . rawurlencode($tierWaMsg);
                ?>
                <div class="rounded-3xl p-6 sm:p-8 flex flex-col justify-between relative transition-all duration-300 hover:border-red-500/50 <?= $borderClass ?>">
                    
                    <!-- Popular Tag Badge -->
                    <?php if ($isPopular): ?>
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-red-600 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-red-700/50 flex items-center gap-1">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span><?= esc($tier['popular_label'] ?: 'Paling Populer') ?></span>
                        </div>
                    <?php elseif (!empty($tier['price_badge'])): ?>
                        <div class="absolute -top-3 left-6 px-3 py-0.5 rounded-full bg-zinc-800 border border-zinc-700 text-zinc-300 font-semibold text-[11px]">
                            <?= esc($tier['price_badge']) ?>
                        </div>
                    <?php endif; ?>

                    <div>
                        <!-- Header -->
                        <div class="mb-6">
                            <span class="font-heading font-black text-sm text-zinc-400 tracking-wider uppercase"><?= esc($tier['name']) ?></span>
                            <div class="mt-2 flex items-baseline gap-1">
                                <?php if (!empty($tier['price_prefix'])): ?>
                                    <span class="text-xs text-zinc-400 font-medium"><?= esc($tier['price_prefix']) ?></span>
                                <?php endif; ?>
                                <span class="font-heading font-black text-3xl sm:text-4xl text-white"><?= esc($tier['price']) ?></span>
                            </div>
                            <?php if (!empty($tier['renewal_price'])): ?>
                                <div class="text-[11px] text-zinc-500 mt-1">Perpanjangan: <?= esc($tier['renewal_price']) ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Suitability Target -->
                        <div class="p-3 rounded-xl bg-white/[0.02] border border-white/[0.04] text-xs text-zinc-400 mb-6 leading-relaxed">
                            <span class="text-zinc-300 font-semibold">Cocok untuk:</span> <?= esc($tier['suitability']) ?>
                        </div>

                        <!-- Features Checklist -->
                        <ul class="space-y-3 text-xs sm:text-sm text-zinc-300 mb-6">
                            <?php if (!empty($tier['checklist'])): ?>
                                <?php foreach ($tier['checklist'] as $chk): ?>
                                    <li class="flex items-start gap-2.5">
                                        <?php if (!empty($chk['included'])): ?>
                                            <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                            <span><?= esc($chk['text']) ?></span>
                                        <?php else: ?>
                                            <i data-lucide="x" class="w-4 h-4 text-zinc-600 shrink-0 mt-0.5"></i>
                                            <span class="text-zinc-500 line-through"><?= esc($chk['text']) ?></span>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php elseif (!empty($tier['features'])): ?>
                                <?php foreach ($tier['features'] as $ft): ?>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                        <span><?= esc($ft) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>

                        <!-- Expandable Addons -->
                        <?php if (!empty($tier['domain_addons']) || !empty($tier['email_addons'])): ?>
                            <div class="mb-6 pt-4 border-t border-white/[0.06]">
                                <button type="button" 
                                        class="toggle-addons-btn w-full flex items-center justify-between text-xs text-zinc-400 hover:text-white transition-colors"
                                        data-target="addon-<?= esc($tier['id']) ?>">
                                    <span class="font-semibold flex items-center gap-1">
                                        <i data-lucide="layers" class="w-3.5 h-3.5 text-red-500"></i>
                                        Opsi Tambahan (Addon)
                                    </span>
                                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 arrow-icon transition-transform"></i>
                                </button>
                                
                                <div id="addon-<?= esc($tier['id']) ?>" class="hidden mt-3 p-3 rounded-xl bg-black/40 border border-white/[0.04] space-y-2 text-xs text-zinc-400">
                                    <?php if (!empty($tier['domain_addons'])): ?>
                                        <div class="font-semibold text-zinc-300">Upgrade Domain:</div>
                                        <?php foreach ($tier['domain_addons'] as $dom): ?>
                                            <div class="flex items-center justify-between">
                                                <span>Domain <?= esc($dom['name']) ?></span>
                                                <span class="text-zinc-200"><?= esc($dom['price']) ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($tier['email_addons'])): ?>
                                        <div class="font-semibold text-zinc-300 pt-1">Email Bisnis:</div>
                                        <?php foreach ($tier['email_addons'] as $em): ?>
                                            <div class="flex items-center justify-between">
                                                <span><?= esc($em['name']) ?></span>
                                                <span class="text-zinc-200"><?= esc($em['price']) ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Button Action -->
                    <div class="pt-4 border-t border-white/[0.08]">
                        <?php if ($tier['button_variant'] === 'red'): ?>
                            <a href="<?= $tierWaUrl ?>" target="_blank" rel="noopener noreferrer" 
                               class="w-full py-3 px-4 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-center text-sm shadow-lg shadow-red-700/40 hover:shadow-red-600/60 block transition-all">
                                <?= esc($tier['button_label'] ?: 'Pilih Standard') ?>
                            </a>
                        <?php else: ?>
                            <a href="<?= $tierWaUrl ?>" target="_blank" rel="noopener noreferrer" 
                               class="w-full py-3 px-4 rounded-xl bg-zinc-800/80 hover:bg-zinc-700 text-zinc-200 hover:text-white font-semibold text-center text-sm border border-zinc-700 hover:border-zinc-500 block transition-all">
                                <?= esc($tier['button_label'] ?: 'Pilih Paket') ?>
                            </a>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ==============================================================================
     6. PORTFOLIO SHOWCASE SECTION
     ============================================================================== -->
<section id="portfolio" class="py-24 bg-[#07070a] border-t border-white/[0.08] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs uppercase tracking-widest text-red-500 font-bold">Karya Nyata Kami</span>
            <h2 class="font-heading font-extrabold text-3xl sm:text-5xl text-white tracking-tight mt-2 mb-4">
                <?= esc($copy['portfolio_title'] ?? 'Portofolio Proyek Website Yang Telah Kami Bangun') ?>
            </h2>
            <p class="text-zinc-400 text-sm sm:text-base">
                <?= esc($copy['portfolio_subtitle'] ?? 'Koleksi karya digital terbaik yang memadukan desain visual kelas dunia dengan performa teknologi tanpa kompromi.') ?>
            </p>
        </div>

        <!-- Filter Category Tabs -->
        <div class="flex items-center justify-center flex-wrap gap-2.5 mb-12">
            <button type="button" class="portfolio-filter-tab px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold bg-red-600 text-white shadow-lg transition-all" data-category="all">
                Semua Proyek (<?= count($portfolios) ?>)
            </button>
            <button type="button" class="portfolio-filter-tab px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all" data-category="E-Commerce">
                E-Commerce
            </button>
            <button type="button" class="portfolio-filter-tab px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all" data-category="Website & Presence">
                Website & Presence
            </button>
            <button type="button" class="portfolio-filter-tab px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all" data-category="Corporate Profile">
                Corporate Profile
            </button>
            <button type="button" class="portfolio-filter-tab px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-all" data-category="Custom System">
                Custom System
            </button>
        </div>

        <!-- Portfolio Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($portfolios as $item): ?>
                <?php 
                    $tagsStr = json_encode($item['tags'] ?? []);
                    $waPortfolioInquiry = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo SOLVETA, saya tertarik membuat website dengan konsep & fitur serupa dengan proyek: {$item['title']}");
                ?>
                <div class="portfolio-card-item rounded-2xl glass-panel overflow-hidden border border-white/[0.08] hover:border-red-500/50 transition-all duration-300 hover:-translate-y-2 group" 
                     data-category="<?= esc($item['category'] ?? '') ?>">
                    
                    <!-- Thumbnail with Zoom on Hover -->
                    <div class="relative aspect-video overflow-hidden bg-zinc-950 cursor-pointer"
                         onclick="openPortfolioModal('<?= addslashes(esc($item['title'])) ?>', '<?= addslashes(esc($item['category'])) ?>', '<?= addslashes(esc($item['image_url'])) ?>', '<?= addslashes(esc($item['description'])) ?>', '<?= addslashes($tagsStr) ?>', '<?= addslashes($waPortfolioInquiry) ?>')">
                        <img src="<?= esc($item['image_url']) ?>" alt="<?= esc($item['title']) ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#09090b] via-transparent to-transparent opacity-80"></div>
                        
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-black/70 backdrop-blur-md border border-white/10 text-[11px] font-semibold text-zinc-300">
                            <?= esc($item['category']) ?>
                        </div>

                        <!-- Hover Icon View -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/40">
                            <span class="px-4 py-2 rounded-xl bg-red-600 text-white text-xs font-bold flex items-center gap-1.5 shadow-lg">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                                <span>Lihat Detail Proyek</span>
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="font-heading font-bold text-lg text-white group-hover:text-red-400 transition-colors mb-2">
                            <?= esc($item['title']) ?>
                        </h3>
                        <p class="text-zinc-400 text-xs sm:text-sm line-clamp-2 mb-4 leading-relaxed">
                            <?= esc($item['description']) ?>
                        </p>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-1.5 mb-6">
                            <?php foreach ($item['tags'] as $tag): ?>
                                <span class="px-2 py-0.5 rounded-md bg-white/[0.04] border border-white/[0.06] text-[10px] text-zinc-400 font-medium">
                                    <?= esc($tag) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-4 border-t border-white/[0.08] flex items-center justify-between">
                            <a href="<?= $waPortfolioInquiry ?>" target="_blank" rel="noopener noreferrer" 
                               class="text-xs font-semibold text-emerald-400 hover:text-emerald-300 flex items-center gap-1">
                                <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                <span>Tanya Proyek Serupa</span>
                            </a>
                            <button type="button" 
                                    onclick="openPortfolioModal('<?= addslashes(esc($item['title'])) ?>', '<?= addslashes(esc($item['category'])) ?>', '<?= addslashes(esc($item['image_url'])) ?>', '<?= addslashes(esc($item['description'])) ?>', '<?= addslashes($tagsStr) ?>', '<?= addslashes($waPortfolioInquiry) ?>')"
                                    class="text-xs font-medium text-zinc-400 hover:text-white flex items-center gap-1">
                                <span>Preview</span>
                                <i data-lucide="external-link" class="w-3 h-3"></i>
                            </button>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Portfolio Modal Detail -->
<div id="portfolio-modal" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden flex items-center justify-center p-4">
    <div class="relative w-full max-w-3xl rounded-3xl bg-[#0f0f14] border border-zinc-700 overflow-hidden shadow-2xl animate-scaleUp">
        <button id="modal-close-btn" class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-black/70 border border-white/20 text-white flex items-center justify-center hover:bg-red-600 transition-colors">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>

        <div class="max-h-[85vh] overflow-y-auto">
            <img id="modal-image" src="" alt="Portfolio Showcase" class="w-full max-h-[420px] object-cover border-b border-zinc-800">
            <div class="p-6 sm:p-8">
                <span id="modal-category" class="px-3 py-1 rounded-full bg-red-950/60 border border-red-800/40 text-red-400 text-xs font-semibold uppercase tracking-wider"></span>
                <h3 id="modal-title" class="font-heading font-black text-2xl sm:text-3xl text-white mt-3 mb-3"></h3>
                <p id="modal-description" class="text-zinc-300 text-sm leading-relaxed mb-6"></p>
                
                <div class="mb-8">
                    <span class="text-xs font-semibold text-zinc-400 block mb-2 uppercase tracking-wider">Teknologi & Fitur Kunci:</span>
                    <div id="modal-tags" class="flex flex-wrap gap-2"></div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-zinc-800">
                    <a id="modal-wa-link" href="#" target="_blank" rel="noopener noreferrer" 
                       class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm flex items-center gap-2 shadow-lg shadow-emerald-700/40">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Diskusi Proyek Serupa via WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ==============================================================================
     7. WORKING PROCESS SECTION
     ============================================================================== -->
<section id="process" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs uppercase tracking-widest text-red-500 font-bold">Alur Kerja Efisien</span>
            <h2 class="font-heading font-extrabold text-3xl sm:text-5xl text-white tracking-tight mt-2 mb-4">
                4 Langkah Mudah Mewujudkan Website Impian Anda
            </h2>
            <p class="text-zinc-400 text-sm sm:text-base">
                Kami memastikan seluruh alur pembuatan berjalan transparan, cepat, dan sesuai dengan tujuan bisnis Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
            <!-- Step 1 -->
            <div class="p-6 rounded-2xl glass-panel relative flex flex-col">
                <div class="w-12 h-12 rounded-xl bg-zinc-900 border border-zinc-800 text-red-500 font-heading font-black text-xl flex items-center justify-center mb-6">
                    01
                </div>
                <h3 class="font-heading font-bold text-lg text-white mb-2">Konsultasi & Brief</h3>
                <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                    Diskusikan ide Anda atau isi <a href="/formulir" class="text-red-400 underline">Formulir Brief 16 Field</a> kami untuk menentukan paket, halaman, dan referensi desain.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="p-6 rounded-2xl glass-panel relative flex flex-col">
                <div class="w-12 h-12 rounded-xl bg-zinc-900 border border-zinc-800 text-red-500 font-heading font-black text-xl flex items-center justify-center mb-6">
                    02
                </div>
                <h3 class="font-heading font-bold text-lg text-white mb-2">Perancangan & Desain</h3>
                <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                    Tim desainer menyusun tata letak visual, kombinasi tipografi, serta integrasi tombol direct WhatsApp yang siap konversi.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="p-6 rounded-2xl glass-panel relative flex flex-col">
                <div class="w-12 h-12 rounded-xl bg-zinc-900 border border-zinc-800 text-red-500 font-heading font-black text-xl flex items-center justify-center mb-6">
                    03
                </div>
                <h3 class="font-heading font-bold text-lg text-white mb-2">Coding & Server Setup</h3>
                <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                    Penerapan kode performa tinggi, setup nama domain resmi, SSL HTTPS, konfigurasi database, dan optimasi kecepatan seluler.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="p-6 rounded-2xl glass-panel relative flex flex-col">
                <div class="w-12 h-12 rounded-xl bg-red-950/60 border border-red-800/40 text-red-500 font-heading font-black text-xl flex items-center justify-center mb-6">
                    04
                </div>
                <h3 class="font-heading font-bold text-lg text-white mb-2">Review & Serah Terima</h3>
                <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">
                    Pemeriksaan bersama, perbaikan revisi akhir, penyerahan akses akun pengelola, serta panduan operasional gratis.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- ==============================================================================
     8. CONSULTATION CTA BANNER
     ============================================================================== -->
<section class="py-20 relative">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl p-8 sm:p-12 bg-gradient-to-r from-red-950/70 via-zinc-900/90 to-red-950/70 border border-red-600/40 text-center relative overflow-hidden glow-red-lg">
            
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-900/50 border border-red-700/50 text-red-300 text-xs font-semibold uppercase tracking-wider mb-6">
                <i data-lucide="help-circle" class="w-4 h-4"></i>
                <?= esc($copy['consultation_title'] ?? 'TIDAK TAHU HARUS MULAI DARI MANA?') ?>
            </div>

            <h2 class="font-heading font-black text-2xl sm:text-4xl text-white tracking-tight mb-4">
                Siap Membawa Bisnis Anda ke Tingkat Berikutnya?
            </h2>

            <p class="text-zinc-300 text-sm sm:text-base max-w-2xl mx-auto mb-8 leading-relaxed">
                <?= esc($copy['consultation_desc'] ?? 'Konsultasikan masalah bisnis Anda secara gratis. Kami akan merekomendasikan langkah paling efisien untuk memulainya.') ?>
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?= $waHeroUrl ?>" target="_blank" rel="noopener noreferrer" 
                   class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white hover:bg-zinc-100 text-zinc-950 font-bold text-sm shadow-xl flex items-center justify-center gap-2 transition-all">
                    <i data-lucide="message-circle" class="w-4 h-4 text-emerald-600"></i>
                    <span>Mulai Konsultasi Gratis Sekarang</span>
                </a>
                <a href="/formulir" 
                   class="w-full sm:w-auto px-8 py-4 rounded-xl bg-black/50 hover:bg-black/80 text-white font-semibold text-sm border border-white/20 flex items-center justify-center gap-2 transition-all">
                    <i data-lucide="file-text" class="w-4 h-4 text-red-500"></i>
                    <span>Isi Formulir Brief Pemesanan</span>
                </a>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>
