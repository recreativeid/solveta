<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
    $waAboutUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin berkonsultasi mengenai profil perusahaan dan kemitraan solusi teknologi untuk bisnis kami.");
?>

<!-- ========================================================================= -->
<!-- 1. ABOUT HERO HEADER — Clean White & Red High Contrast (Font Inter, SaaS)  -->
<!-- ========================================================================= -->
<section class="clean-hero-header pt-28 sm:pt-36 pb-16 sm:pb-24 border-b border-[#E8E9ED] dark:border-neutral-800 font-sans relative overflow-hidden">
    <!-- Subtle Dotted Grid Background -->
    <div class="absolute inset-0 bg-grid-dots opacity-35 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-6">
        
        <!-- Eyebrow Pill Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white text-xs font-semibold shadow-xs">
            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
            <span class="font-bold tracking-wider uppercase font-mono">TENTANG KAMI • SOLVETA AGENCY</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.12] drop-shadow-none">
            Mitra Strategis Rekayasa Solusi Teknologi &amp; Pertumbuhan Bisnis
        </h1>

        <!-- Subheading -->
        <p class="text-sm sm:text-base md:text-lg text-white/90 max-w-2xl mx-auto leading-relaxed drop-shadow-none">
            SOLVETA hadir untuk membantu bisnis, organisasi, dan perusahaan menyelesaikan problem operasional nyata melalui perangkat lunak terintegrasi, arsitektur modern, dan ekosistem digital berkinerja tinggi.
        </p>

        <!-- Prompt Search / Action Box -->
        <div class="max-w-xl mx-auto pt-2">
            <div class="flex items-center bg-white dark:bg-[#1A1C22] rounded-full p-2 pl-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-sm focus-within:ring-2 focus-within:ring-[#C4264A]/30 transition">
                <i data-lucide="compass" class="w-4 h-4 text-[#C4264A] shrink-0 mr-3"></i>
                <input type="text" readonly value="Kenali profil korporasi, visi, misi, & jangkauan SOLVETA:" 
                       class="w-full text-xs sm:text-sm text-[#111215] dark:text-white bg-transparent outline-none truncate">
                <a href="<?= $waAboutUrl ?>" target="_blank"
                   class="px-5 py-2.5 rounded-full bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs font-bold transition flex items-center gap-1.5 shrink-0 shadow-sm">
                    <span>Hubungi Kami</span>
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 2. CORPORATE OFFICE WALL SHOWCASE (Logo SOLVETA di Dinding Kantor)        -->
<!-- Bersih tanpa shape dan tanpa teks bertumpuk di atas gambar                -->
<!-- ========================================================================= -->
<section class="py-12 sm:py-16 bg-white dark:bg-[#0E0F12] border-b border-[#E8E9ED] dark:border-neutral-800 font-sans">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Corporate Headquarters & Office Building Photo -->
        <div class="rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 overflow-hidden shadow-editorial bg-neutral-950">
            <div class="relative h-72 sm:h-[440px] lg:h-[520px] w-full overflow-hidden">
                <img src="<?= base_url('images/office-wall-solveta.jpg') ?>" 
                     alt="Gedung Pusat & Kantor Perusahaan SOLVETA — Solve Technology Agency" 
                     class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Clean Caption Below Image -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 px-2 text-xs text-neutral-500">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-[#C4264A]"></span>
                <span class="font-bold text-[#111215] dark:text-white uppercase font-mono">SOLVETA Headquarters &amp; Engineering Center</span>
                <span>— Gedung Pusat Rekayasa Solusi Teknologi</span>
            </div>
            <div class="font-mono text-[11px] text-neutral-400">
                Jakarta &amp; Surakarta Tech Hub, Indonesia
            </div>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 3. PROFIL PERUSAHAAN (Apa itu, Bergerak Bagaimana, Tujuannya Apa)         -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-24 bg-white dark:bg-[#0E0F12] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-14">
        
        <!-- Header Profil -->
        <div class="space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-red-50 dark:bg-neutral-900 border border-red-200 dark:border-neutral-800 text-[11px] font-bold text-[#C4264A] dark:text-[#F05A72] uppercase font-mono">
                PROFIL PERUSAHAAN
            </div>
            
            <h2 class="text-2xl sm:text-4xl font-extrabold text-[#111215] dark:text-white tracking-tight leading-tight">
                PT SOLVETA TEKNOLOGI ASIA <br class="hidden sm:inline">
                <span class="text-[#C4264A] dark:text-[#F05A72]">(Solve Technology Agency)</span>
            </h2>

            <p class="text-sm sm:text-base text-neutral-600 dark:text-neutral-300 leading-relaxed">
                Mitra rekayasa solusi teknologi terdepan yang membantu bisnis, organisasi, UMKM rintisan, hingga korporasi menyelesaikan hambatan operasional dan bertumbuh melalui solusi perangkat lunak terintegrasi — melayani klien di seluruh pelosok Indonesia dan kancah regional global.
            </p>
        </div>

        <!-- 3 Pilar: Apa itu, Bergerak Bagaimana, Tujuannya Apa -->
        <div class="space-y-6">
            
            <!-- Pilar 1: Apa itu SOLVETA -->
            <div class="p-6 sm:p-8 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center font-black text-sm">
                        01
                    </div>
                    <h3 class="text-lg font-bold text-[#111215] dark:text-white">Apa Itu SOLVETA?</h3>
                </div>
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed pl-12">
                    SOLVETA (Solve Technology Agency) adalah agensi rekayasa teknologi digital yang berakar dari prinsip pemecahan masalah (problem solving). Kami bukan sekadar pembuat tampilan web, melainkan mitra strategis yang merancang dan membangun ekosistem digital: dari landing page berkonversi tinggi, company profile profesional, hingga sistem manajemen bisnis kompleks seperti ERP, CRM, POS, dan otomatisasi berbasis kecerdasan buatan (AI).
                </p>
            </div>

            <!-- Pilar 2: Bergerak Bagaimana -->
            <div class="p-6 sm:p-8 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center font-black text-sm">
                        02
                    </div>
                    <h3 class="text-lg font-bold text-[#111215] dark:text-white">Bagaimana SOLVETA Bergerak?</h3>
                </div>
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed pl-12">
                    Kami bekerja dengan metodologi agile sprint cepat, transparan, dan terukur. Dimulai dari diagnosa mendalam terhadap alur kerja bisnis klien, perancangan blueprint arsitektur sistem, penulisan kode bersih (clean code) berstandar tinggi, pengujian menyeluruh (QA), hingga pelatihan operasional tim klien. Kami menjamin setiap sistem yang kami bangun siap pakai, berkecepatan tinggi, aman dengan SSL &amp; enkripsi data, serta mudah dirawat dalam jangka panjang.
                </p>
            </div>

            <!-- Pilar 3: Tujuannya Apa -->
            <div class="p-6 sm:p-8 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center font-black text-sm">
                        03
                    </div>
                    <h3 class="text-lg font-bold text-[#111215] dark:text-white">Apa Tujuan Kami?</h3>
                </div>
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed pl-12">
                    Tujuan utama SOLVETA adalah memangkas hambatan manual dan inefisiensi yang menahan pertumbuhan bisnis Anda. Kami bertujuan menghasilkan Return on Investment (ROI) konkret: mengeliminasi selisih kasir dan stok, mempercepat waktu rilis produk digital (time-to-market), memperluas jangkauan pasar secara global, dan memastikan bisnis Anda memiliki fondasi teknologi yang tangguh untuk bersaing di era AI.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 4. VISI & MISI PERUSAHAAN (Poin-poin Terstruktur Sesuai Permintaan)       -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-24 bg-[#FAFAFC] dark:bg-[#12131A] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="space-y-2">
            <span class="text-[11px] font-bold text-[#C4264A] uppercase tracking-wider font-mono">ARAH &amp; KOMITMEN</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#111215] dark:text-white tracking-tight">
                Visi &amp; Misi Perusahaan
            </h2>
            <p class="text-xs sm:text-sm text-neutral-500">Kompas strategis yang mengarahkan setiap baris kode dan solusi yang kami hadirkan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            
            <!-- Visi -->
            <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 shadow-sm space-y-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center">
                        <i data-lucide="eye" class="w-4 h-4"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[#111215] dark:text-white">Visi SOLVETA</h3>
                </div>
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                    Menjadi agensi solusi teknologi digital terpercaya nomor satu yang menjadi katalisator pertumbuhan bisnis modern di Indonesia dan kancah global melalui inovasi perangkat lunak berkinerja tinggi, berdaya saing, dan humanis.
                </p>
            </div>

            <!-- Misi -->
            <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 shadow-sm space-y-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center">
                        <i data-lucide="target" class="w-4 h-4"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[#111215] dark:text-white">Misi SOLVETA</h3>
                </div>
                <ul class="space-y-2.5 text-xs text-neutral-600 dark:text-neutral-400">
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
                        <span>Mengembangkan website dan aplikasi bisnis dengan standar kode bersih, arsitektur cloud teruji, dan performa tinggi.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
                        <span>Menyediakan layanan konsultasi teknologi yang transparan, tanpa biaya terselubung, dan berorientasi pada ROI bisnis nyata.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
                        <span>Membantu digitalisasi UMKM hingga enterprise agar memiliki daya saing kokoh menghadapi revolusi otomatisasi dan AI.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
                        <span>Memberikan dukungan teknis dan garansi berkesinambungan bagi mitra bisnis di Indonesia maupun mancanegara.</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 5. JANGKAUAN LAYANAN: INDONESIA & GLOBAL                                  -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-24 bg-white dark:bg-[#0E0F12] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <div class="space-y-2">
            <span class="text-[11px] font-bold text-[#C4264A] uppercase tracking-wider font-mono">CAKUPAN OPERASIONAL</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#111215] dark:text-white tracking-tight">
                Jangkauan Kemitraan: Indonesia &amp; Global
            </h2>
            <p class="text-xs sm:text-sm text-neutral-500">Kami melayani kolaborasi lintas wilayah dengan standar komunikasi remote profesional.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            
            <!-- Domestik -->
            <div class="p-6 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-[#C4264A]"></i>
                    <h3 class="text-base font-bold text-[#111215] dark:text-white">Seluruh Wilayah Indonesia</h3>
                </div>
                <p class="text-xs text-neutral-600 dark:text-neutral-400 leading-relaxed">
                    Dari Sabang sampai Merauke, kami mendampingi ratusan UMKM, yayasan, korporasi PT/CV, distributor, instansi swasta, dan brand lokal di Pulau Jawa, Sumatera, Kalimantan, Sulawesi, hingga Bali-Nusa Tenggara.
                </p>
                <div class="text-[11px] font-mono text-[#C4264A] dark:text-[#F05A72] font-semibold pt-1">
                    ✓ Integrasi Payment Gateway QRIS, Virtual Account, &amp; Ekspedisi Nasional
                </div>
            </div>

            <!-- Global -->
            <div class="p-6 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] space-y-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="globe" class="w-4 h-4 text-[#C4264A]"></i>
                    <h3 class="text-base font-bold text-[#111215] dark:text-white">Skala Regional &amp; Global</h3>
                </div>
                <p class="text-xs text-neutral-600 dark:text-neutral-400 leading-relaxed">
                    SOLVETA juga dipercaya oleh mitra internasional di Malaysia, Singapura, dan regional Asia Tenggara untuk pengembangan sistem web multilingual, arsitektur cloud global, dan integrasi API skala luas.
                </p>
                <div class="text-[11px] font-mono text-[#C4264A] dark:text-[#F05A72] font-semibold pt-1">
                    ✓ Multi-Currency, CDN Global Cloudflare, &amp; SLA Uptime 99.98%
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 6. BOTTOM CTA                                                             -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-20 bg-white dark:bg-[#0E0F12] font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <h3 class="text-2xl sm:text-3xl font-extrabold text-[#111215] dark:text-white">
            Siap Bertumbuh Bersama SOLVETA?
        </h3>
        <p class="text-xs sm:text-sm text-neutral-500 max-w-xl mx-auto">
            Diskusikan kebutuhan teknologi bisnis Anda bersama konsultan ahli kami hari ini. Dapatkan konsultasi gratis dan rekomendasi arsitektur terbaik.
        </p>
        <div class="pt-2">
            <a href="<?= $waAboutUrl ?>" target="_blank"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-xs sm:text-sm font-bold text-white bg-[#C4264A] hover:bg-[#8E1738] shadow-lg shadow-red-500/20 transition-all cursor-pointer">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Konsultasikan Kebutuhan Proyek Anda</span>
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
