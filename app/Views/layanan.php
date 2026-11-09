<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
    
    $waStarterUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin memesan Paket Layanan Website STARTER (Rp 349K).");
    $waStandardUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin memesan Paket Layanan Website STANDARD (Rp 699K).");
    $waPremiumUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin memesan Paket Layanan Website PREMIUM (Rp 964K).");
    $waPlatinumUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin berkonsultasi mengenai Paket Layanan Website PLATINUM (Rp 1.5 jt - Popular).");
    $waCustomUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo Lead Engineer & CS Zahra SOLVETA, saya ingin konsultasi kebutuhan Paket Custom Website / Layanan Khusus & Enterprise.");
?>

<!-- ========================================================================= -->
<!-- 1. HERO HEADER — Clean White & Red High Contrast (Font Inter, SaaS)        -->
<!-- ========================================================================= -->
<section class="clean-hero-header pt-28 sm:pt-36 pb-16 sm:pb-24 border-b border-[#E8E9ED] dark:border-neutral-800 font-sans relative overflow-hidden">
    <!-- Subtle Dotted Grid Background -->
    <div class="absolute inset-0 bg-grid-dots opacity-35 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-6">
        
        <!-- Eyebrow Pill Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white text-xs font-semibold shadow-xs">
            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
            <span class="font-bold tracking-wider uppercase font-mono">PILIHAN PAKET &amp; RINCIAN LENGKAP</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.12] drop-shadow-none">
            PILIHAN PAKET LAYANAN WEBSITE
        </h1>

        <!-- Subheading -->
        <p class="text-sm sm:text-base md:text-lg text-white/90 max-w-2xl mx-auto leading-relaxed drop-shadow-none">
            Solusi website lengkap dari profil pribadi hingga platform enterprise, transparan tanpa biaya tersembunyi.
        </p>

        <!-- Quick Jump Navigation Pills -->
        <div class="flex flex-wrap items-center justify-center gap-2 pt-4">
            <a href="#starter" class="px-4 py-2 rounded-full text-xs font-semibold bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all flex items-center gap-1.5">
                <i data-lucide="zap" class="w-3.5 h-3.5 text-neutral-400"></i>
                <span>1. Starter (Rp 349K)</span>
            </a>
            <a href="#standard" class="px-4 py-2 rounded-full text-xs font-semibold bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all flex items-center gap-1.5">
                <i data-lucide="building-2" class="w-3.5 h-3.5 text-neutral-400"></i>
                <span>2. Standard (Rp 699K)</span>
            </a>
            <a href="#premium" class="px-4 py-2 rounded-full text-xs font-semibold bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all flex items-center gap-1.5">
                <i data-lucide="shopping-bag" class="w-3.5 h-3.5 text-neutral-400"></i>
                <span>3. Premium (Rp 964K)</span>
            </a>
            <a href="#platinum" class="px-4 py-2 rounded-full text-xs font-bold bg-[#C4264A] text-white shadow-md hover:bg-[#8E1738] transition-all flex items-center gap-1.5">
                <i data-lucide="cpu" class="w-3.5 h-3.5"></i>
                <span>4. Platinum (Rp 1.5 jt)</span>
                <span class="px-1.5 py-0.2 rounded text-[8.5px] font-black bg-white text-[#C4264A] uppercase">Popular</span>
            </a>
            <a href="#custom" class="px-4 py-2 rounded-full text-xs font-semibold bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:text-[#C4264A] transition-all flex items-center gap-1.5">
                <i data-lucide="sliders" class="w-3.5 h-3.5"></i>
                <span>Custom Enterprise</span>
            </a>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 2. SEMUA 4 PAKET BERURUTAN (Starter, Standard, Premium, Platinum)         -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-24 bg-white dark:bg-[#0E0F12] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-red-50 dark:bg-neutral-900 border border-red-200 dark:border-neutral-800 text-[11px] font-bold text-[#C4264A] dark:text-[#F05A72] uppercase font-mono">
                Semua 4 Paket (Berurutan)
            </div>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-[#111215] dark:text-white tracking-tight">
                Pilihan Spesifikasi &amp; Detail Transparan
            </h2>
            <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400">
                Pilih paket yang paling tepat untuk skala usaha Anda. Seluruh pengerjaan bergaransi penuh dan siap online tanpa kerumitan.
            </p>
        </div>

        <!-- 4 PRICING CARDS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 items-stretch">
            
            <!-- ============================================================= -->
            <!-- 1. PAKET STARTER (Rp 349K)                                    -->
            <!-- ============================================================= -->
            <div id="starter" class="rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] p-6 sm:p-7 flex flex-col justify-between hover:shadow-editorial hover:border-red-200 transition-all">
                <div class="space-y-6">
                    <!-- Header -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-neutral-500 uppercase tracking-wider font-mono">PAKET WEBSITE</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-neutral-200/70 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300">1 Halaman</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#111215] dark:text-white">Paket STARTER</h3>
                        <div class="pt-2">
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl sm:text-4xl font-black text-[#111215] dark:text-white">Rp 349K</span>
                            </div>
                            <div class="text-[11px] text-neutral-500 mt-1 font-mono">Biaya Perpanjangan: 249k/tahun*</div>
                        </div>
                    </div>

                    <!-- Meta Badges -->
                    <div class="grid grid-cols-2 gap-2 p-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-xs">
                        <div>
                            <span class="text-[10px] text-neutral-400 uppercase block font-mono">Masa Aktif</span>
                            <span class="font-bold text-[#111215] dark:text-white">1 Tahun</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-neutral-400 uppercase block font-mono">Estimasi Jadi</span>
                            <span class="font-bold text-[#C4264A] dark:text-[#F05A72]">1-2 Hari</span>
                        </div>
                    </div>

                    <!-- Recommendation -->
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider block font-mono">Cocok / Direkomendasikan Untuk:</span>
                        <p class="text-xs text-neutral-600 dark:text-neutral-400 leading-relaxed">
                            kebutuhan pribadi: landing page, portofolio online, blog pribadi, CV digital, dan halaman profil.
                        </p>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-[#E8E9ED] dark:border-neutral-800 pt-4 space-y-3">
                        <span class="text-[10px] font-bold text-[#111215] dark:text-white uppercase tracking-wider block font-mono">Termasuk Dalam Paket (Fitur Utama):</span>
                        <ul class="space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span><b>Maksimal 1 Halaman</b> (tambah 50k/Halaman)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Revisi ringan 2x (Tidak berubah dari brief awal)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Domain (.my.id, .site, .store, .xyz, .space, .fund, .shop, dll)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Hosting (Akses Dashboard, Tanpa login cPanel)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Responsive Web (mobile friendly)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>SSL Security</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Full Garansi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>SEO Friendly</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Website Copywriting</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free konsultasi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free akses &amp; special price untuk member</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Domain & Hosting Note -->
                    <div class="p-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-[11px] space-y-1">
                        <span class="font-bold text-[#111215] dark:text-white block font-mono">Domain &amp; Server Hosting:</span>
                        <p class="text-neutral-500 leading-snug">Sudah termasuk sewa domain standar &amp; hosting server kecepatan tinggi 1 tahun pertama. Siap online langsung tanpa biaya setup tambahan.</p>
                        <div class="pt-1 text-neutral-500">
                            <b>Email Bisnis:</b> Dapat ditambahkan kapan saja (+Rp 50.000/akun email bisnis).
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="pt-6">
                    <a href="<?= $waStarterUrl ?>" target="_blank"
                       class="w-full py-3 px-4 rounded-2xl text-xs font-bold text-center block bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-700 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs hover:shadow-md transition-all">
                        PESAN PAKET STARTER (RP 349K)
                    </a>
                </div>
            </div>

            <!-- ============================================================= -->
            <!-- 2. PAKET STANDARD (Rp 699K)                                   -->
            <!-- ============================================================= -->
            <div id="standard" class="rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] p-6 sm:p-7 flex flex-col justify-between hover:shadow-editorial hover:border-red-200 transition-all">
                <div class="space-y-6">
                    <!-- Header -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-neutral-500 uppercase tracking-wider font-mono">PAKET WEBSITE</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-neutral-200/70 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300">4 Halaman</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#111215] dark:text-white">Paket STANDARD</h3>
                        <div class="pt-2">
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl sm:text-4xl font-black text-[#111215] dark:text-white">Rp 699K</span>
                            </div>
                            <div class="text-[11px] text-neutral-500 mt-1 font-mono">Biaya Perpanjangan: 399k/tahun*</div>
                        </div>
                    </div>

                    <!-- Meta Badges -->
                    <div class="grid grid-cols-2 gap-2 p-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-xs">
                        <div>
                            <span class="text-[10px] text-neutral-400 uppercase block font-mono">Masa Aktif</span>
                            <span class="font-bold text-[#111215] dark:text-white">1 Tahun</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-neutral-400 uppercase block font-mono">Estimasi Jadi</span>
                            <span class="font-bold text-[#C4264A] dark:text-[#F05A72]">3-5 Hari</span>
                        </div>
                    </div>

                    <!-- Recommendation -->
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider block font-mono">Cocok / Direkomendasikan Untuk:</span>
                        <p class="text-xs text-neutral-600 dark:text-neutral-400 leading-relaxed">
                            kebutuhan bisnis kecil, umkm, home industry.
                        </p>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-[#E8E9ED] dark:border-neutral-800 pt-4 space-y-3">
                        <span class="text-[10px] font-bold text-[#111215] dark:text-white uppercase tracking-wider block font-mono">Termasuk Dalam Paket (Fitur Utama):</span>
                        <ul class="space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span><b>Maksimal 4 Halaman</b> (3 Halaman Utama 1 Dashboard)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Revisi ringan 2x (Tidak berubah dari brief awal)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Domain (.com, my.id, .site, .cloud, .online, .shop, .blog, .store, .org, .digital, dll)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Hosting (Akses Dashboard, Tanpa login cPanel)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Responsive Web (mobile friendly)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>SSL Security</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>SEO Basic</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Full Garansi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Website Copywriting</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free konsultasi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free akses &amp; special price untuk member</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free akses &amp; fasilitas reseller</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Domain & Hosting Note -->
                    <div class="p-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-[11px] space-y-1">
                        <span class="font-bold text-[#111215] dark:text-white block font-mono">Domain &amp; Server Hosting:</span>
                        <p class="text-neutral-500 leading-snug">Sudah termasuk sewa domain standar (.com, .net, .org) &amp; hosting server berkecepatan tinggi selama 1 tahun pertama. Siap online langsung tanpa biaya setup tambahan.</p>
                        <div class="pt-1 text-neutral-500">
                            <b>Email Bisnis:</b> Termasuk 1 akun email bisnis (nama@domain.com) dengan webmail &amp; setup SMTP. *Email tambahan dapat ditambahkan kapan saja.
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="pt-6">
                    <a href="<?= $waStandardUrl ?>" target="_blank"
                       class="w-full py-3 px-4 rounded-2xl text-xs font-bold text-center block bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-700 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs hover:shadow-md transition-all">
                        PESAN PAKET STANDARD (RP 699K)
                    </a>
                </div>
            </div>

            <!-- ============================================================= -->
            <!-- 3. PAKET PREMIUM (Rp 964K)                                    -->
            <!-- ============================================================= -->
            <div id="premium" class="rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] p-6 sm:p-7 flex flex-col justify-between hover:shadow-editorial hover:border-red-200 transition-all">
                <div class="space-y-6">
                    <!-- Header -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-neutral-500 uppercase tracking-wider font-mono">PAKET WEBSITE</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-neutral-200/70 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300">7 Halaman</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#111215] dark:text-white">Paket PREMIUM</h3>
                        <div class="pt-2">
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl sm:text-4xl font-black text-[#111215] dark:text-white">Rp 964K</span>
                            </div>
                            <div class="text-[11px] text-neutral-500 mt-1 font-mono">Biaya Perpanjangan: 399k/tahun*</div>
                        </div>
                    </div>

                    <!-- Meta Badges -->
                    <div class="grid grid-cols-2 gap-2 p-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-xs">
                        <div>
                            <span class="text-[10px] text-neutral-400 uppercase block font-mono">Masa Aktif</span>
                            <span class="font-bold text-[#111215] dark:text-white">1 Tahun</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-neutral-400 uppercase block font-mono">Estimasi Jadi</span>
                            <span class="font-bold text-[#C4264A] dark:text-[#F05A72]">3-5 Hari</span>
                        </div>
                    </div>

                    <!-- Recommendation -->
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider block font-mono">Cocok / Direkomendasikan Untuk:</span>
                        <p class="text-xs text-neutral-600 dark:text-neutral-400 leading-relaxed">
                            company profile &amp; bisnis produk.
                        </p>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-[#E8E9ED] dark:border-neutral-800 pt-4 space-y-3">
                        <span class="text-[10px] font-bold text-[#111215] dark:text-white uppercase tracking-wider block font-mono">Termasuk Dalam Paket (Fitur Utama):</span>
                        <ul class="space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span><b>Maksimal 7 Halaman</b> (6 halaman utama + 1 Halaman dashboard)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Revisi ringan 2x (Tidak berubah dari brief awal)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Domain (.store, .org, .net, .digital, .it.com, .media, .agency, .company, dll)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Hosting (Akses Dashboard, Tanpa login cPanel)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Responsive Web (mobile friendly)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free SEO Friendly</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Full Garansi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Website Copywriting</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free konsultasi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free akses &amp; special price untuk member</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free akses &amp; fasilitas reseller</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Domain & Hosting Note -->
                    <div class="p-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-[11px] space-y-1">
                        <span class="font-bold text-[#111215] dark:text-white block font-mono">Domain &amp; Server Hosting:</span>
                        <p class="text-neutral-500 leading-snug">Sudah termasuk sewa domain standar (.com, .net, .org) &amp; hosting server berkecepatan tinggi selama 1 tahun pertama. Siap online langsung tanpa biaya setup tambahan.</p>
                        <div class="pt-1 text-neutral-500">
                            <b>Email Bisnis:</b> Termasuk 2 akun email bisnis (nama@domain.com) terkonfigurasi penuh. *Email tambahan dapat ditambahkan kapan saja.
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="pt-6">
                    <a href="<?= $waPremiumUrl ?>" target="_blank"
                       class="w-full py-3 px-4 rounded-2xl text-xs font-bold text-center block bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-700 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs hover:shadow-md transition-all">
                        PESAN PAKET PREMIUM (RP 964K)
                    </a>
                </div>
            </div>

            <!-- ============================================================= -->
            <!-- 4. PAKET PLATINUM (Rp 1.5 jt) - POPULAR & PALING DIREKOMENDASI-->
            <!-- ============================================================= -->
            <div id="platinum" class="rounded-3xl border-2 border-[#C4264A] bg-white dark:bg-[#171821] p-6 sm:p-7 flex flex-col justify-between shadow-editorial relative overflow-hidden">
                <!-- Popular Badge Pill -->
                <div class="absolute top-0 right-0 bg-[#C4264A] text-white text-[10px] font-black uppercase tracking-wider px-4 py-1 rounded-bl-2xl">
                    POPULAR ★
                </div>

                <div class="space-y-6">
                    <!-- Header -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-[#C4264A] uppercase tracking-wider font-mono">PAKET PALING DIREKOMENDASIKAN</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#111215] dark:text-white">Paket PLATINUM</h3>
                        <div class="pt-2">
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl sm:text-4xl font-black text-[#C4264A] dark:text-[#F05A72]">Rp 1.5 jt</span>
                            </div>
                            <div class="text-[11px] text-neutral-500 mt-1 font-mono">Biaya Perpanjangan: Harga mengikuti biaya dibutuhkan</div>
                        </div>
                    </div>

                    <!-- Meta Badges -->
                    <div class="grid grid-cols-2 gap-2 p-3 rounded-2xl bg-red-50/50 dark:bg-neutral-900 border border-red-100 dark:border-neutral-800 text-xs">
                        <div>
                            <span class="text-[10px] text-neutral-400 uppercase block font-mono">Masa Aktif</span>
                            <span class="font-bold text-[#111215] dark:text-white">1 Tahun</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-neutral-400 uppercase block font-mono">Estimasi Jadi</span>
                            <span class="font-bold text-[#C4264A] dark:text-[#F05A72]">Wajib Meet (Fleksibel)</span>
                        </div>
                    </div>

                    <!-- Recommendation -->
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider block font-mono">Cocok / Direkomendasikan Untuk:</span>
                        <p class="text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                            Start up, UMKM, CV, PT, Organisasi/Yayasan, Professional (siapa pun yang mempunyai kebutuhan layanan khusus yang tidak sesuai dengan 3 paket sebelumnya).
                        </p>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-[#E8E9ED] dark:border-neutral-800 pt-4 space-y-3">
                        <span class="text-[10px] font-bold text-[#111215] dark:text-white uppercase tracking-wider block font-mono">Termasuk Dalam Paket (Fitur Utama):</span>
                        <ul class="space-y-2 text-xs text-neutral-600 dark:text-neutral-300">
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span><b>Free Domain</b> (.id, .co.id, .tech, .dev, .com)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Hosting (Akses Dashboard, Tanpa login cPanel)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Responsive Web (mobile friendly)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>SEO Friendly</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Full Garansi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span><b>Akses API</b> (Integrasi aplikasi)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free Website Copywriting</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free jasa hosting</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free jasa SSL</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free konsultasi</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free akses &amp; special price untuk member</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
                                <span>Free akses &amp; fasilitas reseller</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Domain & Hosting Note -->
                    <div class="p-3 rounded-2xl bg-red-50/50 dark:bg-neutral-900 border border-red-100 dark:border-neutral-800 text-[11px] space-y-1">
                        <span class="font-bold text-[#111215] dark:text-white block font-mono">Domain &amp; Server Hosting:</span>
                        <p class="text-neutral-500 leading-snug">Sudah termasuk sewa domain standar (.com, .net, .org) &amp; hosting server berkecepatan tinggi selama 1 tahun pertama. Siap online langsung tanpa biaya setup tambahan.</p>
                        <div class="pt-1 text-[#C4264A] dark:text-[#F05A72] font-semibold">
                            <b>Email Bisnis:</b> Unlimited akun email bisnis dengan hak akses cPanel penuh.
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="pt-6">
                    <a href="<?= $waPlatinumUrl ?>" target="_blank"
                       class="w-full py-3.5 px-4 rounded-2xl text-xs font-bold text-center block bg-[#C4264A] hover:bg-[#8E1738] text-white shadow-md hover:shadow-lg transition-all">
                        KONSULTASI PLATINUM
                    </a>
                </div>
            </div>

        </div>

        <!-- TARIF & KETENTUAN REVISI SUMMARY BOX -->
        <div class="rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] p-6 sm:p-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div>
                    <span class="text-[11px] font-bold text-[#C4264A] uppercase tracking-wider font-mono block">STANDAR TRANSPARANSI</span>
                    <h3 class="text-lg sm:text-xl font-bold text-[#111215] dark:text-white">Tarif &amp; Ketentuan Revisi</h3>
                    <p class="text-xs sm:text-sm text-neutral-500 mt-1">Berlaku adil dan transparan untuk seluruh paket website SOLVETA:</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 w-full md:w-auto">
                    <div class="p-3.5 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800">
                        <span class="text-[10px] text-neutral-400 uppercase font-mono block">Revisi Ringan</span>
                        <div class="text-sm font-black text-[#111215] dark:text-white">Rp 30.000</div>
                        <span class="text-[10px] text-neutral-500">Ganti logo, icon, warna, teks kecil</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800">
                        <span class="text-[10px] text-neutral-400 uppercase font-mono block">Revisi Berat</span>
                        <div class="text-sm font-black text-[#111215] dark:text-white">Rp 50.000</div>
                        <span class="text-[10px] text-neutral-500">Ubah halaman, tambah halaman / struktur</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800">
                        <span class="text-[10px] text-neutral-400 uppercase font-mono block">Tambah Halaman</span>
                        <div class="text-sm font-black text-[#C4264A] dark:text-[#F05A72]">+ Rp 50.000</div>
                        <span class="text-[10px] text-neutral-500">Per halaman tambahan</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 3. LAYANAN KHUSUS & ENTERPRISE (Custom Website)                          -->
<!-- ========================================================================= -->
<section id="custom" class="py-16 sm:py-24 bg-[#FAFAFC] dark:bg-[#12131A] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-red-50 dark:bg-neutral-900 border border-red-200 dark:border-neutral-800 text-[11px] font-bold text-[#C4264A] dark:text-[#F05A72] uppercase font-mono">
                LAYANAN KHUSUS &amp; ENTERPRISE
            </div>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-[#111215] dark:text-white tracking-tight">
                Menerima Layanan Paket Custom Website
            </h2>
            <p class="text-sm sm:text-base text-neutral-600 dark:text-neutral-400 leading-relaxed">
                Solusi website tanpa batasan halaman dengan kustomisasi fitur penuh, integrasi sistem, dan penyesuaian khusus. Biaya investasi fleksibel dan transparan mengikuti konsep dan spesifikasi website yang ingin Anda bangun.
            </p>
        </div>

        <!-- 3 Pilar Custom -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center">
                    <i data-lucide="infinity" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-bold text-[#111215] dark:text-white">Tanpa Batasan</h3>
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                    Bebas tentukan jumlah halaman &amp; struktur sesuai skala bisnis Anda tanpa terikat template kaku.
                </p>
            </div>

            <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center">
                    <i data-lucide="cpu" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-bold text-[#111215] dark:text-white">Custom Kebutuhan</h3>
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                    Fitur sistem spesifik, integrasi API pihak ketiga, multi-database, dan otomatisasi alur kerja tingkat lanjut.
                </p>
            </div>

            <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center">
                    <i data-lucide="calculator" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-bold text-[#111215] dark:text-white">Biaya Sesuai Konsep</h3>
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                    Perhitungan biaya proporsional mengikuti konsep yang dibuat, transparan dan berlandaskan estimasi man-hour engineering.
                </p>
            </div>
        </div>

        <!-- CTA Custom Banner -->
        <div class="rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#1A1C22] p-8 sm:p-10 flex flex-col md:flex-row items-center justify-between gap-6 shadow-sm">
            <div class="space-y-2 text-center md:text-left">
                <h3 class="text-xl sm:text-2xl font-black text-[#111215] dark:text-white">Punya Konsep Sendiri?</h3>
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 max-w-xl">
                    Konsultasikan kebutuhan teknis &amp; rancangan Anda langsung dengan developer kami untuk mendapatkan blueprint dan proposal arsitektur resmi.
                </p>
            </div>
            <a href="<?= $waCustomUrl ?>" target="_blank"
               class="px-8 py-3.5 rounded-2xl text-xs font-bold text-white bg-[#111215] hover:bg-[#C4264A] dark:bg-white dark:text-[#111215] dark:hover:bg-[#C4264A] dark:hover:text-white shadow-md transition-all shrink-0">
                Konsultasikan Paket Custom &rarr;
            </a>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 4. LAYANAN BIAYA TAMBAHAN (ADD-ONS)                                       -->
<!-- ========================================================================= -->
<section id="addons" class="py-16 sm:py-24 bg-white dark:bg-[#0E0F12] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-[11px] font-bold text-[#C4264A] uppercase tracking-wider font-mono">OPSIONAL &amp; FLEKSIBEL</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-[#111215] dark:text-white tracking-tight">
                Layanan Biaya Tambahan
            </h2>
            <p class="text-xs sm:text-sm text-neutral-500">Transparan &amp; fleksibel untuk upgrade fitur kapan pun dibutuhkan.</p>
        </div>

        <!-- 6 Addons Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="p-6 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <span class="text-xs font-mono font-bold text-[#C4264A]">01.</span>
                <h3 class="text-base font-bold text-[#111215] dark:text-white">Biaya Tambah 1 Halaman</h3>
                <div class="text-xl font-black text-[#111215] dark:text-white">+ Rp 50.000 <span class="text-xs font-normal text-neutral-500">/ halaman</span></div>
                <p class="text-xs text-neutral-500">Penambahan halaman konten baru lengkap dengan integrasi navigasi.</p>
            </div>

            <div class="p-6 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <span class="text-xs font-mono font-bold text-[#C4264A]">02.</span>
                <h3 class="text-base font-bold text-[#111215] dark:text-white">Biaya Revisi Ringan</h3>
                <div class="text-xl font-black text-[#111215] dark:text-white">Rp 30.000 <span class="text-xs font-normal text-neutral-500">/ revisi</span></div>
                <p class="text-xs text-neutral-500">Di luar brief awal: ganti logo, icon, penyesuaian teks minor, dan palet warna.</p>
            </div>

            <div class="p-6 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <span class="text-xs font-mono font-bold text-[#C4264A]">03.</span>
                <h3 class="text-base font-bold text-[#111215] dark:text-white">Biaya Revisi Berat</h3>
                <div class="text-xl font-black text-[#111215] dark:text-white">Rp 50.000 <span class="text-xs font-normal text-neutral-500">/ revisi</span></div>
                <p class="text-xs text-neutral-500">Di luar brief awal: perombakan struktur tata letak halaman atau perubahan alur.</p>
            </div>

            <div class="p-6 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <span class="text-xs font-mono font-bold text-[#C4264A]">04.</span>
                <h3 class="text-base font-bold text-[#111215] dark:text-white">Biaya Custom Domain</h3>
                <div class="text-xl font-black text-[#111215] dark:text-white">Sesuai domain <span class="text-xs font-normal text-neutral-500">yang dibutuhkan</span></div>
                <p class="text-xs text-neutral-500">Ekstensi khusus seperti .id, .co.id, .edu, .io, atau domain unik lainnya.</p>
            </div>

            <div class="p-6 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <span class="text-xs font-mono font-bold text-[#C4264A]">05.</span>
                <h3 class="text-base font-bold text-[#111215] dark:text-white">Akun Email Bisnis (1 Akun)</h3>
                <div class="text-xl font-black text-[#111215] dark:text-white">Rp 50.000 <span class="text-xs font-normal text-neutral-500">/ akun</span></div>
                <p class="text-xs text-neutral-500">nama@domain.com profesional lengkap dengan akses webmail &amp; SMTP.</p>
            </div>

            <div class="p-6 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <span class="text-xs font-mono font-bold text-[#C4264A]">06.</span>
                <h3 class="text-base font-bold text-[#111215] dark:text-white">Optimasi Kecepatan Ekstra</h3>
                <div class="text-xl font-black text-[#C4264A] dark:text-[#F05A72]">Rp 100.000 <span class="text-xs font-normal text-neutral-500">(One-time)</span></div>
                <p class="text-xs text-neutral-500">High performance caching, image lossless compression, &amp; CDN Cloudflare setup.</p>
            </div>

        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 5. GARANSI PENUH & KETENTUAN TRANSPARANSI SOLVETA                         -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-20 bg-white dark:bg-[#0E0F12] font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-red-200 dark:border-neutral-800 bg-red-50/40 dark:bg-neutral-900/40 p-8 sm:p-10 space-y-6 text-center">
            <div class="w-12 h-12 rounded-2xl bg-[#C4264A] text-white flex items-center justify-center mx-auto shadow-md">
                <i data-lucide="shield-check" class="w-6 h-6"></i>
            </div>
            
            <div class="space-y-2">
                <h3 class="text-xl sm:text-2xl font-black text-[#111215] dark:text-white">
                    Garansi Penuh &amp; Ketentuan Transparansi SOLVETA
                </h3>
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto leading-relaxed">
                    *Biaya perpanjangan tahun berikutnya digunakan untuk sewa domain &amp; hosting aktif. Semua paket website mendapatkan garansi pemeliharaan perbaikan error secara cuma-cuma.
                </p>
            </div>

            <div class="pt-2">
                <a href="<?= $waStandardUrl ?>" target="_blank"
                   class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-xs sm:text-sm font-bold text-white bg-[#C4264A] hover:bg-[#8E1738] shadow-lg shadow-red-500/20 transition-all cursor-pointer">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Konsultasi WhatsApp Sekarang</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
