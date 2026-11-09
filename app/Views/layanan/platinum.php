<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
    
    $waOrderPlatinum = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Lead Engineer SOLVETA, saya ingin berkonsultasi mengenai Paket Website PLATINUM (Rp 1.5 jt - Popular).");
?>

<!-- ========================================================================= -->
<!-- 1. HERO HEADER — Clean White & Red High Contrast (Font Inter, SaaS)        -->
<!-- ========================================================================= -->
<section class="clean-hero-header pt-28 sm:pt-36 pb-16 sm:pb-24 border-b border-[#E8E9ED] dark:border-neutral-800 font-sans relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-dots opacity-35 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-6">
        
        <!-- Eyebrow Pill Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white dark:bg-[#1A1C22] border border-red-200 dark:border-red-900/40 text-[#C4264A] dark:text-[#F05A72] text-xs font-semibold shadow-xs">
            <span class="w-2 h-2 rounded-full bg-[#C4264A] animate-pulse"></span>
            <span class="font-bold tracking-wider uppercase font-mono">PAKET LAYANAN 04 • PLATINUM (POPULAR)</span>
            <span class="text-neutral-400">•</span>
            <span>Rp 1.5 jt</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-[#111215] dark:text-white tracking-tight leading-[1.12]">
            Arsitektur Sistem Khusus &amp; <br class="hidden sm:inline">
            <span class="text-[#C4264A] dark:text-[#F05A72]">Enterprise Scale Platform</span>
        </h1>

        <!-- Subheading -->
        <p class="text-sm sm:text-base md:text-lg text-neutral-600 dark:text-neutral-300 max-w-2xl mx-auto leading-relaxed">
            Paket paling direkomendasikan untuk Start up, UMKM, CV, PT, Organisasi/Yayasan, &amp; Professional yang membutuhkan layanan khusus, akses API, serta integrasi sistem tingkat lanjut.
        </p>

        <!-- Navigation Sub-Tabs Switcher -->
        <div class="flex flex-wrap items-center justify-center gap-2 pt-4">
            <a href="<?= base_url('layanan/starter') ?>" 
               class="px-4 py-2 rounded-full text-xs font-semibold bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all flex items-center gap-1.5">
                <i data-lucide="zap" class="w-3.5 h-3.5 text-neutral-400"></i>
                <span>1. Starter (Rp 349K)</span>
            </a>
            <a href="<?= base_url('layanan/standard') ?>" 
               class="px-4 py-2 rounded-full text-xs font-semibold bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all flex items-center gap-1.5">
                <i data-lucide="building-2" class="w-3.5 h-3.5 text-neutral-400"></i>
                <span>2. Standard (Rp 699K)</span>
            </a>
            <a href="<?= base_url('layanan/premium') ?>" 
               class="px-4 py-2 rounded-full text-xs font-semibold bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all flex items-center gap-1.5">
                <i data-lucide="shopping-bag" class="w-3.5 h-3.5 text-neutral-400"></i>
                <span>3. Premium (Rp 964K)</span>
            </a>
            <a href="<?= base_url('layanan/platinum') ?>" 
               class="px-4 py-2 rounded-full text-xs font-bold transition-all bg-[#C4264A] text-white shadow-md flex items-center gap-1.5">
                <i data-lucide="cpu" class="w-3.5 h-3.5"></i>
                <span>4. Platinum (Rp 1.5 jt)</span>
                <span class="px-1.5 py-0.2 rounded text-[8.5px] font-black bg-white text-[#C4264A] uppercase">Popular</span>
            </a>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 2. MAIN SHOWCASE: JUDUL -> GAMBAR -> DESKRIPSI                           -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-20 bg-white dark:bg-[#0E0F12] border-b border-[#E8E9ED] dark:border-neutral-800 font-sans">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="rounded-3xl border-2 border-[#C4264A] bg-[#FAFAFC] dark:bg-[#14151B] shadow-editorial overflow-hidden p-6 sm:p-10 space-y-8 relative">
            <div class="absolute top-0 right-0 bg-[#C4264A] text-white text-[9px] font-black uppercase tracking-wider px-4 py-1 rounded-bl-xl font-mono">
                PALING DIREKOMENDASIKAN (POPULAR) ★
            </div>

            <!-- STEP 1: JUDUL -->
            <div class="space-y-2 border-b border-[#E8E9ED] dark:border-neutral-800 pb-5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-red-50 dark:bg-neutral-800 text-[11px] font-bold text-[#C4264A] uppercase font-mono tracking-wider">
                    <span>SPESIFIKASI VISUAL &amp; ARSITEKTUR</span>
                </div>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-[#111215] dark:text-white tracking-tight leading-tight">
                    Showcase Desain &amp; Realistis Mockup Paket Platinum
                </h2>
                <p class="text-xs sm:text-sm text-neutral-500 font-normal">
                    Contoh implementasi nyata platform sistem terintegrasi, akses API, dashboard manajemen data, dan infrastruktur cloud performa tinggi.
                </p>
            </div>

            <!-- STEP 2: GAMBAR REALISTIS SAAS MOCKUP -->
            <div class="rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 overflow-hidden bg-neutral-950 shadow-editorial">
                <div class="relative h-64 sm:h-[420px] w-full overflow-hidden">
                    <img src="<?= base_url('images/portfolio/cuango.jpg') ?>" 
                         alt="Mockup Platform Paket Platinum SOLVETA" 
                         class="w-full h-full object-cover object-top">
                </div>
            </div>

            <!-- STEP 3: DESKRIPSI & MANFAAT -->
            <div class="space-y-8 pt-2">
                
                <!-- Rekomendasi -->
                <div class="space-y-3">
                    <h3 class="text-lg sm:text-xl font-bold text-[#111215] dark:text-white">
                        Fungsi &amp; Mengapa Bisnis Anda Membutuhkan Paket Ini?
                    </h3>
                    
                    <div class="p-4 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#1A1C22] space-y-2">
                        <ul class="space-y-2 text-xs sm:text-sm text-neutral-600 dark:text-neutral-300">
                            <li class="flex items-start gap-2">
                                <span class="font-bold text-[#C4264A]">•</span>
                                <span>Dirancang bagi siapa pun yang mempunyai kebutuhan layanan khusus yang tidak sesuai dengan 3 paket sebelumnya: integrasi API aplikasi pihak ketiga, dashboard multi-user, dan alur operasional kompleks.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="font-bold text-[#C4264A]">•</span>
                                <span>Mendapatkan alokasi unlimited akun email bisnis dengan hak akses cPanel penuh dan dukungan asistensi langsung dari tim developer.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Manfaat Finansial & Operasional -->
                <div class="space-y-3">
                    <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
                        Manfaat Operasional &amp; Skalabilitas Enterprise:
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="p-4 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#1A1C22] space-y-1">
                            <div class="text-xs sm:text-sm font-bold text-[#C4264A]">Akses API &amp; Integrasi</div>
                            <p class="text-xs text-neutral-500 leading-relaxed">
                                Dukungan RESTful API untuk menghubungkan database ke aplikasi mobile, sistem kasir, atau ERP.
                            </p>
                        </div>

                        <div class="p-4 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#1A1C22] space-y-1">
                            <div class="text-xs sm:text-sm font-bold text-[#C4264A]">Estimasi Fleksibel (Wajib Meet)</div>
                            <p class="text-xs text-neutral-500 leading-relaxed">
                                Dilakukan sesi discovery meeting via Google Meet untuk pemetaan ruang lingkup &amp; arsitektur sistem.
                            </p>
                        </div>

                        <div class="p-4 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#1A1C22] space-y-1">
                            <div class="text-xs sm:text-sm font-bold text-[#C4264A]">Investasi Rp 1.5 jt</div>
                            <p class="text-xs text-neutral-500 leading-relaxed">
                                Skema proporsional, transparan, dan bergaransi penuh dengan jaminan NDA kerahasiaan data.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Fitur Lengkap & Box Investasi -->
                <div class="pt-6 border-t border-[#E8E9ED] dark:border-neutral-800 grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                    
                    <div class="md:col-span-7 space-y-2.5">
                        <div class="text-xs font-bold text-[#111215] dark:text-white uppercase font-mono tracking-wider">FITUR TEKNOLOGI PAKET PLATINUM:</div>
                        <ul class="text-xs text-neutral-600 dark:text-neutral-400 space-y-1.5">
                            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Free Domain (.id, .co.id, .tech, .dev, .com)</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Free Hosting (Akses Dashboard, Tanpa login cPanel)</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Responsive Web (mobile friendly) &amp; SEO Friendly</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Full Garansi Pemeliharaan</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Akses API (Integrasi aplikasi sistem luar)</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Free Website Copywriting, Free Jasa Hosting &amp; SSL</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Unlimited Akun Email Bisnis dengan Hak Akses cPanel Penuh</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Free konsultasi, free akses &amp; special price untuk member/reseller</li>
                        </ul>
                    </div>

                    <div class="md:col-span-5 p-6 rounded-3xl bg-red-50/70 dark:bg-neutral-800/80 border border-red-200 dark:border-neutral-700 text-center space-y-3">
                        <div class="text-[10px] font-bold text-[#C4264A] uppercase font-mono">BIAYA INVESTASI RESMI</div>
                        <div class="space-y-0.5">
                            <div class="text-3xl font-black text-[#C4264A] dark:text-[#F05A72]">
                                Rp 1.5 jt
                            </div>
                            <span class="text-[10px] text-neutral-500 block font-mono">Biaya perpanjangan: Harga mengikuti biaya dibutuhkan</span>
                            <span class="text-[10px] text-neutral-400">Masa Aktif 1 Tahun | Estimasi Jadi: Wajib Meet</span>
                        </div>
                        <a href="<?= $waOrderPlatinum ?>" target="_blank"
                           class="w-full py-3.5 px-4 rounded-2xl text-white bg-[#C4264A] hover:bg-[#8E1738] text-xs font-bold flex items-center justify-center gap-2 shadow-sm transition-all">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>KONSULTASI PLATINUM</span>
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 3. KONSULTASI CS ZAHRA & LEAD ENGINEER                                    -->
<!-- ========================================================================= -->
<section class="py-12 bg-white dark:bg-[#0E0F12] font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-4">
        <h3 class="text-xl font-bold text-[#111215] dark:text-white">
            Perlu Penandatanganan NDA (Non-Disclosure Agreement) Sebelum Memulai?
        </h3>
        <p class="text-xs sm:text-sm text-neutral-500 max-w-xl mx-auto font-normal">
            Kami menghormati kerahasiaan ide bisnis dan data operasional perusahaan Anda. Tim legal dan teknis SOLVETA siap menandatangani dokumen kerahasiaan sebelum proses rekayasa dimulai.
        </p>
        <div class="pt-2">
            <a href="<?= $waOrderPlatinum ?>" target="_blank" 
               class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-[#C4264A] text-[#C4264A] hover:bg-red-50 text-xs font-bold transition-all">
                <i data-lucide="file-text" class="w-4 h-4"></i>
                <span>Minta Draft NDA &amp; Jadwalkan Konsultasi</span>
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
