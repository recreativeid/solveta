<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
    $waCareerUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo Tim HR & Talent SOLVETA, saya ingin menanyakan informasi seputar kesempatan karir dan pendaftaran Talent Pool di SOLVETA.");
?>

<!-- ========================================================================= -->
<!-- 1. CAREERS HERO HEADER — Clean White & Red High Contrast (Font Inter, SaaS)-->
<!-- ========================================================================= -->
<section class="clean-hero-header pt-28 sm:pt-36 pb-16 sm:pb-24 border-b border-[#E8E9ED] dark:border-neutral-800 font-sans relative overflow-hidden">
    <!-- Subtle Dotted Grid Background -->
    <div class="absolute inset-0 bg-grid-dots opacity-35 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-6">
        
        <!-- Eyebrow Pill Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white text-xs font-semibold shadow-xs">
            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
            <span class="font-bold tracking-wider uppercase font-sans">KARIR &amp; TALENT POOL • SOLVETA</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.12] drop-shadow-none">
            Tumbuh &amp; Berkarya Bersama Ekosistem Rekayasa Teknologi
        </h1>

        <!-- Subheading -->
        <p class="text-sm sm:text-base md:text-lg text-white/90 max-w-2xl mx-auto leading-relaxed drop-shadow-none">
            SOLVETA adalah ruang kolaboratif bagi para talenta digital yang berdedikasi memecahkan masalah nyata, menjunjung standar kode bersih, dan membangun produk masa depan.
        </p>

        <!-- Prompt Search / Action Box -->
        <div class="max-w-xl mx-auto pt-2">
            <div class="flex items-center bg-white dark:bg-[#1A1C22] rounded-full p-2 pl-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-sm focus-within:ring-2 focus-within:ring-[#C4264A]/30 transition">
                <i data-lucide="users" class="w-4 h-4 text-[#C4264A] shrink-0 mr-3"></i>
                <input type="text" readonly value="Informasi status rekrutmen & kesempatan bergabung di SOLVETA:" 
                       class="w-full text-xs sm:text-sm text-[#111215] dark:text-white bg-transparent outline-none truncate">
                <a href="<?= $waCareerUrl ?>" target="_blank"
                   class="px-5 py-2.5 rounded-full bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs font-bold transition flex items-center gap-1.5 shrink-0 shadow-sm">
                    <span>Hubungi HR</span>
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 2. STATUS LOWONGAN KERJA (Dikosongi Sesuai Permintaan User)               -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-24 bg-white dark:bg-[#0E0F12] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Empty State Card (Lowongan karir saat ini masih kosong) -->
        <div class="rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] p-8 sm:p-14 text-center space-y-6 shadow-sm">
            
            <div class="w-16 h-16 rounded-3xl bg-red-50 dark:bg-neutral-800 text-[#C4264A] flex items-center justify-center mx-auto shadow-inner">
                <i data-lucide="briefcase" class="w-8 h-8"></i>
            </div>

            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-neutral-100 dark:bg-neutral-800 text-[11px] font-bold text-neutral-600 dark:text-neutral-400 uppercase font-sans">
                    STATUS REKRUTMEN SAAT INI
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#111215] dark:text-white tracking-tight">
                    Lowongan Karir Saat Ini Masih Kosong
                </h2>
                <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 max-w-lg mx-auto leading-relaxed">
                    Saat ini belum tersedia posisi lowongan pekerjaan atau rekrutmen karyawan yang dibuka. Silakan cek kembali di lain waktu atau hubungi admin kami untuk informasi selengkapnya mengenai Talent Pool di SOLVETA.
                </p>
            </div>

            <!-- CTA Actions -->
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="<?= $waCareerUrl ?>" target="_blank"
                   class="w-full sm:w-auto px-8 py-3.5 rounded-full text-xs sm:text-sm font-bold text-white bg-[#C4264A] hover:bg-[#8E1738] shadow-md transition-all flex items-center justify-center gap-2">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Hubungi Admin Untuk Info Selengkapnya</span>
                </a>
                <a href="<?= base_url() ?>" 
                   class="w-full sm:w-auto px-6 py-3.5 rounded-full text-xs sm:text-sm font-semibold text-neutral-700 dark:text-neutral-300 bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-700 hover:border-[#C4264A] transition-all">
                    Kembali ke Beranda
                </a>
            </div>

            <div class="pt-4 text-[11px] text-neutral-400 font-sans">
                Email Tim Rekrutmen: <a href="mailto:karir@solveta.asia" class="text-[#C4264A] hover:underline font-bold">karir@solveta.asia</a>
            </div>

        </div>

    </div>
</section>

<?= $this->endSection() ?>
