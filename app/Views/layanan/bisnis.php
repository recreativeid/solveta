<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
    
    $waOrderBisnis = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin berkonsultasi dan memesan Paket Website BISNIS (Rp 599K).");
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
            <span class="font-bold tracking-wider uppercase font-sans">PAKET LAYANAN 02 • BISNIS</span>
            <span class="text-neutral-400">•</span>
            <span>Rp 599K</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-[#111215] dark:text-white tracking-tight leading-[1.12]">
            Membangun Legitimasi Bisnis &amp; <br class="hidden sm:inline">
            <span class="text-[#C4264A] dark:text-[#F05A72]">Website Perusahaan Terpercaya</span>
        </h1>

        <!-- Subheading -->
        <p class="text-sm sm:text-base md:text-lg text-neutral-600 dark:text-neutral-300 max-w-2xl mx-auto leading-relaxed">
            Pilihan ideal untuk kebutuhan bisnis berkembang, UKM, CV, PT, kantor profesional, dan profil usaha resmi. Dilengkapi 4 halaman terstruktur dan 1 akun email bisnis domain sendiri.
        </p>

        <!-- Navigation Sub-Tabs Switcher -->
        <div class="flex flex-wrap items-center justify-center gap-2 pt-4">
            <a href="<?= base_url('layanan/starter') ?>" 
               class="px-4 py-2 rounded-full text-xs font-semibold bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all flex items-center gap-1.5">
                <i data-lucide="zap" class="w-3.5 h-3.5 text-neutral-400"></i>
                <span>1. Starter (Rp 249K)</span>
            </a>
            <a href="<?= base_url('layanan/bisnis') ?>" 
               class="px-4 py-2 rounded-full text-xs font-bold transition-all bg-[#C4264A] text-white shadow-md flex items-center gap-1.5">
                <i data-lucide="building-2" class="w-3.5 h-3.5"></i>
                <span>2. Bisnis (Rp 599K)</span>
            </a>
            <a href="<?= base_url('layanan/custom') ?>" 
               class="px-4 py-2 rounded-full text-xs font-semibold bg-white dark:bg-[#1A1C22] text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#C4264A] hover:text-[#C4264A] shadow-xs transition-all flex items-center gap-1.5">
                <i data-lucide="sliders" class="w-3.5 h-3.5 text-neutral-400"></i>
                <span>3. Custom (Mulai Rp 1.5 jt)</span>
            </a>
            <a href="<?= base_url('layanan#aplikasi-lokal') ?>" 
               class="px-4 py-2 rounded-full text-xs font-semibold bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:text-[#C4264A] transition-all flex items-center gap-1.5">
                <i data-lucide="hard-drive" class="w-3.5 h-3.5 text-[#C4264A]"></i>
                <span>4. Aplikasi Mobile &amp; Desktop Lokal</span>
            </a>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 2. MAIN SHOWCASE: JUDUL -> GAMBAR -> DESKRIPSI                           -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-20 bg-white dark:bg-[#0E0F12] border-b border-[#E8E9ED] dark:border-neutral-800 font-sans">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] shadow-sm overflow-hidden p-6 sm:p-10 space-y-8">
            
            <!-- STEP 1: JUDUL -->
            <div class="space-y-2 border-b border-[#E8E9ED] dark:border-neutral-800 pb-5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-red-50 dark:bg-neutral-800 text-[11px] font-bold text-[#C4264A] uppercase font-sans tracking-wider">
                    <span>SPESIFIKASI VISUAL &amp; ARSITEKTUR</span>
                </div>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-[#111215] dark:text-white tracking-tight leading-tight">
                    Showcase Desain &amp; Realistis Mockup Paket Bisnis
                </h2>
                <p class="text-xs sm:text-sm text-neutral-500 font-normal">
                    Contoh implementasi nyata company profile korporasi &amp; portal media siber resmi dengan navigasi multi-halaman dan CMS terkelola.
                </p>
            </div>

            <!-- STEP 2: GAMBAR REALISTIS SAAS MOCKUP -->
            <div class="rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 overflow-hidden bg-neutral-950 shadow-editorial">
                <div class="relative h-64 sm:h-[420px] w-full overflow-hidden">
                    <img src="<?= base_url('images/portfolio/tidurnyenyak.jpg') ?>" 
                         alt="Mockup Company Profile Paket Bisnis SOLVETA" 
                         class="w-full h-full object-cover object-top">
                </div>
            </div>

            <!-- STEP 3: DESKRIPSI & MANFAAT -->
            <div class="space-y-8 pt-2">
                
                <!-- Fungsi & Mengapa Bisnis Butuh Paket Ini -->
                <div class="space-y-3">
                    <h3 class="text-lg sm:text-xl font-bold text-[#111215] dark:text-white">
                        Fungsi &amp; Mengapa Bisnis Anda Membutuhkan Paket Ini?
                    </h3>
                    
                    <div class="p-4 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#1A1C22] space-y-2">
                        <ul class="space-y-2 text-xs sm:text-sm text-neutral-600 dark:text-neutral-300">
                            <li class="flex items-start gap-2">
                                <span class="font-bold text-[#C4264A]">•</span>
                                <span>Meningkatkan kredibilitas di hadapan calon klien, investor, dan instansi saat proses verifikasi kerja sama atau tender resmi.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="font-bold text-[#C4264A]">•</span>
                                <span>Menyediakan 4 halaman terstruktur (3 Halaman Utama + 1 Dashboard) untuk memuat profil perusahaan, katalog layanan/produk, artikel wawasan, dan formulir kontak resmi.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="font-bold text-[#C4264A]">•</span>
                                <span>Mendapatkan alamat email profesional nama@perusahaan.com yang memperkuat citra dan kepercayaan korespondensi bisnis.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Manfaat Finansial & Operasional -->
                <div class="space-y-3">
                    <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
                        Manfaat Operasional &amp; Reputasi Bisnis:
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="p-4 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#1A1C22] space-y-1">
                            <div class="text-xs sm:text-sm font-bold text-[#C4264A]">Email Bisnis Resmi</div>
                            <p class="text-xs text-neutral-500 leading-relaxed">
                                Termasuk 1 akun email bisnis (nama@domain.com) dengan webmail &amp; setup SMTP terpercaya.
                            </p>
                        </div>

                        <div class="p-4 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#1A1C22] space-y-1">
                            <div class="text-xs sm:text-sm font-bold text-[#C4264A]">Estimasi Jadi 3–5 Hari</div>
                            <p class="text-xs text-neutral-500 leading-relaxed">
                                Selesai cepat 3-5 hari kerja dengan standar mutu rekayasa tinggi dan bebas kendala.
                            </p>
                        </div>

                        <div class="p-4 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#1A1C22] space-y-1">
                            <div class="text-xs sm:text-sm font-bold text-[#C4264A]">Investasi Rp 599K</div>
                            <p class="text-xs text-neutral-500 leading-relaxed">
                                Perpanjangan 349k/tahun* untuk domain &amp; hosting aktif tahun berikutnya.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Fitur Lengkap & Box Investasi -->
                <div class="pt-6 border-t border-[#E8E9ED] dark:border-neutral-800 grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                    
                    <div class="md:col-span-7 space-y-2.5">
                        <div class="text-xs font-bold text-[#111215] dark:text-white uppercase font-sans tracking-wider">PAKET BISNIS MENCAKUP SEMUA INI:</div>
                        <ul class="text-xs text-neutral-600 dark:text-neutral-400 space-y-1.5">
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Maksimal 4 Halaman (3 Halaman Utama 1 Dashboard)</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Revisi ringan 2x (Tidak berubah dari brief awal)</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Free Domain (.com, .my.id, .site, .cloud, .online, .shop, dll)</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Free Hosting (Akses Dashboard, Tanpa login cPanel)</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> 1 Akun Email Bisnis (nama@domain.com) Webmail &amp; SMTP</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Responsive Web, SSL Security, SEO Basic, Full Garansi</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Free Website Copywriting &amp; Free Konsultasi</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Free akses &amp; special price untuk member &amp; reseller</li>
                        </ul>
                    </div>

                    <div class="md:col-span-5 p-6 rounded-3xl bg-red-50/70 dark:bg-neutral-800/80 border border-red-200 dark:border-neutral-700 text-center space-y-3">
                        <div class="text-[10px] font-bold text-[#C4264A] uppercase font-sans">BIAYA INVESTASI RESMI</div>
                        <div class="space-y-0.5">
                            <div class="text-3xl font-black text-[#C4264A] dark:text-[#F05A72]">
                                Rp 599K
                            </div>
                            <span class="text-[10px] text-neutral-500 block font-sans">Perpanjangan: 349k/tahun*</span>
                            <span class="text-[10px] text-neutral-400">Masa Aktif 1 Tahun | Estimasi Jadi 3-5 Hari</span>
                        </div>
                        <a href="<?= $waOrderBisnis ?>" target="_blank"
                           class="w-full py-3.5 px-4 rounded-2xl text-white bg-[#C4264A] hover:bg-[#8E1738] text-xs font-bold flex items-center justify-center gap-2 shadow-sm transition-all">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Pesan Paket Bisnis (Rp 599K)</span>
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 3. KONSULTASI CS ZAHRA                                                    -->
<!-- ========================================================================= -->
<section class="py-12 bg-white dark:bg-[#0E0F12] font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-4">
        <h3 class="text-xl font-bold text-[#111215] dark:text-white">
            Butuh Arsitektur Sistem Khusus atau Aplikasi Offline Lokal?
        </h3>
        <p class="text-xs sm:text-sm text-neutral-500 max-w-xl mx-auto font-normal">
            Bila bisnis Anda memerlukan sistem khusus, platform multi-user, akses API, atau aplikasi mobile/desktop instalasi lokal, pelajari <a href="<?= base_url('layanan/custom') ?>" class="text-[#C4264A] font-bold underline">Paket Custom</a> kami.
        </p>
        <div class="pt-2">
            <a href="<?= $waOrderBisnis ?>" target="_blank" 
               class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-[#C4264A] text-[#C4264A] hover:bg-red-50 text-xs font-bold transition-all">
                <i data-lucide="message-square" class="w-4 h-4"></i>
                <span>Tanya CS Zahra via WhatsApp</span>
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

