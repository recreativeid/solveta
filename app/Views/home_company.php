<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
    
    $waHeroUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin berkonsultasi mengenai solusi teknologi dan pengembangan sistem digital untuk bisnis kami.");
    $waStarterUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin memesan Paket Layanan Website STARTER (Rp 249K).");
    $waBisnisUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin memesan Paket Layanan Website BISNIS (Rp 599K).");
    $waCustomUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin berkonsultasi mengenai Paket Layanan CUSTOM / Kebutuhan Khusus.");
    $waAppLokalUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin berkonsultasi mengenai Layanan Pembuatan Aplikasi Mobile/Desktop Instalasi Lokal (On-Premise).");
?>

<!-- ========================================================================= -->
<!-- 1. FULL-WIDTH HERO SECTION (MindCloud Style — Dark to Glowing Red to White)-->
<!-- Lebar Penuh 100% Full-Screen Tanpa Shape Pembatas di Bagian Atas           -->
<!-- ========================================================================= -->
<section id="beranda" class="relative w-full clean-hero-header pt-36 sm:pt-40 md:pt-44 pb-16 sm:pb-24 overflow-hidden font-sans flex flex-col items-center justify-center text-center">
  
  <!-- Full-Width Linear Color Enricher (Pendar Merah Menyala di Tengah Persis MindCloud) -->
  <div class="absolute inset-0 hero-linear-enricher pointer-events-none"></div>

  <!-- Subtle SVG 3D Silk Contour Lines (Estetika gelombang halus) -->
  <svg class="absolute inset-0 w-full h-full object-cover opacity-15 dark:opacity-10 pointer-events-none" viewBox="0 0 1440 800" fill="none">
    <path d="M-100 200 C 380 320, 780 180, 1280 340 C 1420 390, 1520 420, 1600 450" stroke="url(#gradSilkHome)" stroke-width="2"/>
    <path d="M-80 260 C 400 380, 820 230, 1320 390 C 1460 440, 1560 470, 1650 500" stroke="url(#gradSilkHome)" stroke-width="1.2" stroke-dasharray="6 6"/>
    <defs>
      <linearGradient id="gradSilkHome" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.1"/>
        <stop offset="45%" stop-color="#FF4D6D" stop-opacity="0.5"/>
        <stop offset="70%" stop-color="#C4264A" stop-opacity="0.4"/>
        <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0.1"/>
      </linearGradient>
    </defs>
  </svg>

  <!-- Bottom Crisp White Gradation (Menyatu tanpa batas ke section berikutnya) -->
  <div class="absolute bottom-0 inset-x-0 h-32 bg-gradient-to-t from-white dark:from-[#0E0F12] via-white/80 dark:via-[#0E0F12]/80 to-transparent pointer-events-none"></div>

  <!-- Main Hero Content (Full-Screen Layout, Clean Centered Typography) -->
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 flex flex-col items-center space-y-6">
    
    <!-- Eyebrow Pill Badge (Background Shape Putih Solid, Bukan Glassmorphism) -->
    <div class="inline-flex items-center gap-2 bg-white px-4 py-1.5 rounded-full text-xs font-semibold text-[#111215] shadow-md border border-white">
      <span class="text-[#C4264A] font-sans text-[11px] font-bold">&gt;_</span>
      <span>Mitra Rekayasa Sistem Digital, Web &amp; Otomasi AI</span>
      <span class="w-2 h-2 rounded-full bg-[#C4264A] animate-pulse"></span>
    </div>

    <!-- Display Headline (Maksimal 2 Baris, Ringkas, Profesional, Tanpa Titik & Tidak Terlalu Tebal) -->
    <h1 class="text-3xl sm:text-5xl md:text-6xl lg:text-[3.9rem] font-bold tracking-tight leading-[1.18] text-white max-w-3xl drop-shadow-none">
      <span class="block">Solusi Cerdas Teknologi</span>
      <span class="block mt-1 sm:mt-2">Akselerasi Pertumbuhan Bisnis</span>
    </h1>

    <!-- Subtitle Copy (Putih Terang Tanpa Shadow, Jelas Terbaca di Atas Gradasi Merah) -->
    <p class="text-sm sm:text-base md:text-lg text-white/95 max-w-2xl mx-auto leading-relaxed font-normal drop-shadow-none">
      Ubah operasional manual yang tidak teratur menjadi sistem digital otomatis — mulai dari <strong class="text-white font-semibold">CRM, ERP, HRIS, POS Kasir, Gudang WMS</strong>, hingga <strong class="text-white font-semibold">Website &amp; Aplikasi Kustom</strong>.
    </p>

    <!-- Interactive Solution Search Bar (Floating White Card Persis Sesuai MindCloud) -->
    <div class="w-full max-w-xl bg-white p-2 pl-4 sm:pl-5 rounded-full shadow-2xl border border-white/90 flex items-center justify-between gap-2 focus-within:ring-2 focus-within:ring-[#C4264A]/30 transition text-left">
      <div class="flex items-center gap-2.5 flex-1 min-w-0">
        <i data-lucide="search" class="w-4 h-4 text-neutral-400 shrink-0"></i>
        <input 
          id="hero-solution-input" 
          type="text" 
          placeholder="Cari sistem: ERP, CRM, POS Kasir, HRIS, Landing Page..." 
          class="w-full bg-transparent text-xs sm:text-sm text-[#111215] placeholder-neutral-400 focus:outline-none truncate"
          onkeydown="if(event.key === 'Enter') handleHeroSearch()"
        />
      </div>
      <button onclick="handleHeroSearch()" class="px-5 py-2.5 rounded-full bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs font-semibold shrink-0 flex items-center gap-1.5 shadow-sm transition cursor-pointer">
        <span>Konsultasi</span>
        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
      </button>
    </div>

    <!-- 4 Quick Filter Pills (Tatanan Persis Sesuai Gambar Referensi) -->
    <div class="flex items-center justify-center gap-2 sm:gap-3 flex-wrap pt-0.5">
      <button type="button" onclick="setHeroSearch('ERP & CRM')" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/90 hover:bg-white text-neutral-800 border border-white/60 shadow-sm backdrop-blur-md text-xs font-medium transition cursor-pointer">
        <i data-lucide="layers" class="w-3.5 h-3.5 text-neutral-500"></i>
        <span>ERP &amp; CRM</span>
      </button>
      <button type="button" onclick="setHeroSearch('POS & WMS Gudang')" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/90 hover:bg-white text-neutral-800 border border-white/60 shadow-sm backdrop-blur-md text-xs font-medium transition cursor-pointer">
        <i data-lucide="archive" class="w-3.5 h-3.5 text-neutral-500"></i>
        <span>POS &amp; WMS Gudang</span>
      </button>
      <button type="button" onclick="setHeroSearch('HRIS & PMS')" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/90 hover:bg-white text-neutral-800 border border-white/60 shadow-sm backdrop-blur-md text-xs font-medium transition cursor-pointer">
        <i data-lucide="users" class="w-3.5 h-3.5 text-neutral-500"></i>
        <span>HRIS &amp; PMS</span>
      </button>
      <button type="button" onclick="setHeroSearch('Web, Berita & LMS')" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/90 hover:bg-white text-neutral-800 border border-white/60 shadow-sm backdrop-blur-md text-xs font-medium transition cursor-pointer">
        <i data-lucide="globe" class="w-3.5 h-3.5 text-neutral-500"></i>
        <span>Web, Berita &amp; LMS</span>
      </button>
    </div>

  </div>
</section>

<!-- ========================================================================= -->
<!-- 2. ANIMATED RUNNING LOGO MARQUEE ("animasi bergerak logo yang berjalan")  -->
<!-- ========================================================================= -->
<section id="partner-marquee" class="py-8 bg-white dark:bg-[#0E0F12] border-b border-[#E8E9ED] dark:border-neutral-800 overflow-hidden font-sans">
  <div class="max-w-6xl mx-auto px-4 text-center mb-5">
    <div class="inline-flex items-center gap-2 text-[11px] font-bold text-neutral-500 uppercase tracking-widest font-sans">
      <span class="w-1.5 h-1.5 rounded-full bg-[#C4264A]"></span>
      <span>DIPERCAYA OLEH EKOSISTEM BISNIS, INSTANSI &amp; TEKNOLOGI MODERN</span>
    </div>
  </div>

  <!-- Infinite Running Marquee Track (Uniform Standardized Large Logos) -->
  <div class="relative w-full overflow-hidden flex items-center py-4 mask-radial-fade">
    <div class="marquee-track flex gap-6 sm:gap-8 items-center whitespace-nowrap animate-marquee">
      
      <!-- Set 1 of Logos (Uniform & Synchronized) -->
      <div class="flex items-center gap-4 sm:gap-6 shrink-0">
        <?php if (!empty($brands)): ?>
          <?php foreach ($brands as $brand): ?>
            <div class="h-16 sm:h-20 min-w-[170px] sm:min-w-[210px] px-6 sm:px-8 py-3 rounded-2xl bg-white dark:bg-[#14151B] border border-neutral-200/90 dark:border-white/10 shadow-xs flex items-center justify-center shrink-0 group hover:border-[#C4264A] hover:shadow-md transition-all duration-300">
              <?php if (!empty($brand['logo_image'])): ?>
                <img src="<?= esc($brand['logo_image']) ?>" alt="<?= esc($brand['name'] ?: 'Klien SOLVETA') ?>" class="h-10 sm:h-12 w-auto max-w-[170px] max-h-12 sm:max-h-14 object-contain filter grayscale opacity-80 dark:opacity-85 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300">
              <?php else: ?>
                <span class="text-xs sm:text-sm font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider font-sans"><?= esc($brand['name'] ?: 'Klien SOLVETA') ?></span>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <?php
            $defaultClients = [
              ['name' => 'TEKAPE.ID', 'icon' => 'layers'],
              ['name' => 'SQUABUMIN', 'icon' => 'shield-check'],
              ['name' => 'KONSERVASI AKUATIK', 'icon' => 'compass'],
              ['name' => 'JAPAKEH POST', 'icon' => 'newspaper'],
              ['name' => 'MANAJEMEN MBG', 'icon' => 'box'],
              ['name' => 'TIDURNYENYAK', 'icon' => 'moon'],
              ['name' => 'HALTEA POS', 'icon' => 'shopping-cart'],
              ['name' => 'EMHA DONASI', 'icon' => 'heart-handshake'],
            ];
            foreach ($defaultClients as $cl):
          ?>
            <div class="h-16 sm:h-20 min-w-[170px] sm:min-w-[210px] px-6 sm:px-8 py-3 rounded-2xl bg-white dark:bg-[#14151B] border border-neutral-200/90 dark:border-white/10 shadow-xs flex items-center justify-center gap-3 shrink-0 group hover:border-[#C4264A] hover:shadow-md transition-all duration-300">
              <i data-lucide="<?= $cl['icon'] ?>" class="w-6 h-6 text-[#C4264A]"></i>
              <span class="text-sm sm:text-base font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider font-sans"><?= $cl['name'] ?></span>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- Set 2 (Exact Duplicate for Seamless Loop) -->
      <div class="flex items-center gap-4 sm:gap-6 shrink-0" aria-hidden="true">
        <?php if (!empty($brands)): ?>
          <?php foreach ($brands as $brand): ?>
            <div class="h-16 sm:h-20 min-w-[170px] sm:min-w-[210px] px-6 sm:px-8 py-3 rounded-2xl bg-white dark:bg-[#14151B] border border-neutral-200/90 dark:border-white/10 shadow-xs flex items-center justify-center shrink-0 group hover:border-[#C4264A] hover:shadow-md transition-all duration-300">
              <?php if (!empty($brand['logo_image'])): ?>
                <img src="<?= esc($brand['logo_image']) ?>" alt="<?= esc($brand['name'] ?: 'Klien SOLVETA') ?>" class="h-10 sm:h-12 w-auto max-w-[170px] max-h-12 sm:max-h-14 object-contain filter grayscale opacity-80 dark:opacity-85 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300">
              <?php else: ?>
                <span class="text-xs sm:text-sm font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider font-sans"><?= esc($brand['name'] ?: 'Klien SOLVETA') ?></span>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <?php foreach ($defaultClients as $cl): ?>
            <div class="h-16 sm:h-20 min-w-[170px] sm:min-w-[210px] px-6 sm:px-8 py-3 rounded-2xl bg-white dark:bg-[#14151B] border border-neutral-200/90 dark:border-white/10 shadow-xs flex items-center justify-center gap-3 shrink-0 group hover:border-[#C4264A] hover:shadow-md transition-all duration-300">
              <i data-lucide="<?= $cl['icon'] ?>" class="w-6 h-6 text-[#C4264A]"></i>
              <span class="text-sm sm:text-base font-bold text-neutral-800 dark:text-neutral-200 uppercase tracking-wider font-sans"><?= $cl['name'] ?></span>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<!-- ========================================================================= -->
<!-- 3. TENTANG KAMI & VIDEO PROFILE RESMI SOLVETA (Bento Box Video Player)    -->
<!-- Bagian kotakan tulisan diganti dengan Video Profil Resmi SOLVETA           -->
<!-- ========================================================================= -->
<section id="tentang-kami" class="py-14 sm:py-20 bg-white dark:bg-[#0E0F12] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-8">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
      <div>
        <div class="inline-flex items-center gap-2 bg-red-50 dark:bg-neutral-900 border border-red-200 dark:border-neutral-800 px-3.5 py-1.5 rounded-full text-xs font-bold text-[#C4264A] dark:text-[#F05A72] font-sans mb-3">
          <i data-lucide="building-2" class="w-3.5 h-3.5"></i>
          <span>TENTANG KAMI — MENGENAL LEBIH DEKAT SOLVETA</span>
        </div>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#111215] dark:text-white tracking-tight leading-tight">
          Teknologi Tepat Guna, <br class="hidden sm:inline" />
          <span class="text-neutral-400">Solusi Nyata Operasional Anda.</span>
        </h2>
      </div>
      <div class="flex items-center gap-2">
        <a href="<?= base_url('tentang') ?>" class="px-5 py-2.5 rounded-full bg-white dark:bg-[#1A1C22] hover:border-[#C4264A] text-[#111215] dark:text-white text-xs font-semibold border border-black/10 dark:border-neutral-800 shadow-xs flex items-center gap-2 transition">
          <span>Profil Lengkap Perusahaan</span>
          <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-[#C4264A]"></i>
        </a>
      </div>
    </div>

    <!-- FULL-WIDTH LANDSCAPE VIDEO PLAYER (Rasio Landscape 16:9 Sesuai Ukuran Video) -->
    <div class="w-full bg-[#111215] text-white rounded-[24px] md:rounded-[32px] overflow-hidden border border-black/10 dark:border-white/10 shadow-lg relative">
      <div class="relative w-full aspect-video bg-black overflow-hidden flex items-center justify-center">
        <video 
          id="solveta-company-video" 
          class="w-full h-full object-cover" 
          controls 
          playsinline 
          preload="metadata"
          <?= !empty($copy['video_thumbnail']) ? 'poster="' . base_url($copy['video_thumbnail']) . '"' : '' ?>
        >
          <source src="<?= base_url('videos/profile.mp4') ?>" type="video/mp4">
          Browser Anda tidak mendukung pemutar video HTML5.
        </video>

        <!-- Top Video Overlay Badge -->
        <div class="absolute top-4 left-4 z-10 pointer-events-none flex items-center gap-2 bg-[#111215]/85 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/10 text-white text-[11px] font-semibold">
          <span class="w-2 h-2 rounded-full bg-[#C4264A] animate-pulse"></span>
          <span>Video Profil Resmi SOLVETA</span>
        </div>

        <!-- Bottom Telemetry Node Strip -->
        <div class="absolute bottom-3 left-4 right-4 z-10 pointer-events-none flex items-center justify-between text-[10px] font-sans text-white/80 bg-black/60 backdrop-blur-sm px-3.5 py-1.5 rounded-xl border border-white/10">
          <span class="flex items-center gap-1.5"><i data-lucide="check" class="w-3 h-3 text-emerald-400"></i>Standar Rekayasa Global</span>
          <span class="hidden sm:inline">Jakarta &amp; Surakarta Tech Hub</span>
        </div>
      </div>
    </div>

    <!-- 2 KOTAK SEJAJAR KIRI & KANAN DI BAWAH VIDEO -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
      
      <!-- KOTAK KIRI: PROFIL PERUSAHAAN TEKNOLOGI (Naratif Singkat, Tanpa Poin-Poin) -->
      <div class="bg-white dark:bg-[#1A1C22] rounded-[24px] md:rounded-[28px] p-6 sm:p-8 border border-[#E8E9ED] dark:border-neutral-800 shadow-sm flex flex-col justify-between">
        <div class="space-y-4">
          <div class="inline-flex items-center gap-2 text-[11px] font-sans uppercase tracking-wider text-[#C4264A] font-bold">
            <i data-lucide="building-2" class="w-3.5 h-3.5"></i>
            <span>TENTANG KAMI &amp; PERAN PERUSAHAAN</span>
          </div>
          
          <h3 class="text-lg sm:text-xl font-bold text-[#111215] dark:text-white leading-snug">
            Perusahaan Rekayasa Teknologi &amp; Solusi Digital Bisnis
          </h3>
          
          <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed font-sans">
            SOLVETA (Solve Technology Agency) adalah perusahaan teknologi yang berfokus membantu bisnis, instansi, UMKM, dan perusahaan bertransformasi dari sistem manual menjadi serba digital dan otomatis. Kami merekayasa solusi perangkat lunak terpadu — mulai dari website profesional, aplikasi bisnis kustom, CRM, ERP, hingga integrasi kecerdasan buatan (AI) — yang dirancang kokoh, cepat, dan menjadi aset permanen bisnis Anda tanpa biaya sewa bulanan.
          </p>
        </div>

        <div class="pt-5 mt-5 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between">
          <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span class="text-[11px] font-sans text-neutral-500 dark:text-neutral-400">Mitra Teknologi Skala Nasional &amp; Global</span>
          </div>
          <a href="<?= base_url('tentang') ?>" class="text-xs font-bold text-[#C4264A] hover:underline flex items-center gap-1">
            <span>Profil Lengkap</span>
            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
          </a>
        </div>
      </div>

      <!-- KOTAK KANAN: MANFAAT LAYANAN SOLVETA DIBANDING PESAING (Poin-Poin Singkat, Tanpa Paragraf, Tanpa Emot/Stiker) -->
      <div class="bg-white dark:bg-[#1A1C22] rounded-[24px] md:rounded-[28px] p-6 sm:p-8 border border-[#E8E9ED] dark:border-neutral-800 shadow-sm flex flex-col justify-between">
        <div class="space-y-4">
          <div class="inline-flex items-center gap-2 text-[11px] font-sans uppercase tracking-wider text-[#C4264A] font-bold">
            <i data-lucide="check-check" class="w-3.5 h-3.5"></i>
            <span>NILAI TAMBAH &amp; KEUNGGULAN KOMPETITIF</span>
          </div>

          <h3 class="text-lg sm:text-xl font-bold text-[#111215] dark:text-white leading-snug">
            Manfaat Layanan SOLVETA Dibanding Pesaing Lainnya
          </h3>

          <ul class="space-y-3 text-xs sm:text-[13px] text-neutral-700 dark:text-neutral-300">
            <li class="flex items-start gap-2.5">
              <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span><strong>100% Hak Milik Permanen:</strong> Seluruh source code dan database milik Anda tanpa biaya lisensi bulanan.</span>
            </li>
            <li class="flex items-start gap-2.5">
              <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span><strong>Sprint Rilis Lebih Cepat:</strong> Delivery proyek terukur dalam 4–8 minggu sprint tanpa mengorbankan kualitas.</span>
            </li>
            <li class="flex items-start gap-2.5">
              <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span><strong>Arsitektur Kustom Presisi:</strong> Dirancang spesifik sesuai alur kerja bisnis nyata Anda, bukan template kaku.</span>
            </li>
            <li class="flex items-start gap-2.5">
              <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span><strong>Integrasi Multi-Platform Lengkap:</strong> Terhubung otomatis ke WhatsApp API, payment gateway, dan cloud modern.</span>
            </li>
            <li class="flex items-start gap-2.5">
              <i data-lucide="check" class="w-4 h-4 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span><strong>Pelatihan Tim &amp; Garansi Purna Jual:</strong> Pendampingan teknis langsung staf operasional dan garansi sistem.</span>
            </li>
          </ul>
        </div>

        <div class="pt-5 mt-5 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between">
          <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-[#C4264A]"></span>
            <span class="text-[11px] font-sans text-neutral-500 dark:text-neutral-400">Efisiensi Maksimal, Bebas Ketergantungan Vendor</span>
          </div>
          <a href="<?= base_url('layanan') ?>" class="text-xs font-bold text-[#C4264A] hover:underline flex items-center gap-1">
            <span>Lihat Paket Layanan</span>
            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
          </a>
        </div>
      </div>

    </div>

    <!-- 4 Visual Highlight Mini Bento Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 pt-2">
      <div class="bg-white dark:bg-[#1A1C22] rounded-2xl p-3 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs group overflow-hidden">
        <div class="h-28 sm:h-32 rounded-xl overflow-hidden relative bg-[#111215]">
          <img src="https://images.unsplash.com/photo-1617802690992-15d93263d3a9?auto=format&fit=crop&w=600&q=80" alt="AI & Automation" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
          <span class="absolute top-2 left-2 bg-white/95 text-[#111215] text-[9px] font-bold px-2 py-0.5 rounded-full">Otomasi AI</span>
        </div>
        <div class="mt-2 px-1 flex items-center justify-between">
          <span class="text-xs font-bold text-[#111215] dark:text-white">Asisten Cerdas</span>
          <i data-lucide="cpu" class="w-3.5 h-3.5 text-[#C4264A]"></i>
        </div>
      </div>

      <div class="bg-white dark:bg-[#1A1C22] rounded-2xl p-3 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs group overflow-hidden">
        <div class="h-28 sm:h-32 rounded-xl overflow-hidden relative bg-[#111215]">
          <img src="https://images.unsplash.com/photo-1508614589041-895b88991e3e?auto=format&fit=crop&w=600&q=80" alt="Real-time Monitoring" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
          <span class="absolute top-2 left-2 bg-[#C4264A] text-white text-[9px] font-bold px-2 py-0.5 rounded-full">Real-Time 24/7</span>
        </div>
        <div class="mt-2 px-1 flex items-center justify-between">
          <span class="text-xs font-bold text-[#111215] dark:text-white">Pantau Kapan Saja</span>
          <i data-lucide="clock" class="w-3.5 h-3.5 text-[#111215] dark:text-white"></i>
        </div>
      </div>

      <div class="bg-white dark:bg-[#1A1C22] rounded-2xl p-3 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs group overflow-hidden">
        <div class="h-28 sm:h-32 rounded-xl overflow-hidden relative bg-[#111215]">
          <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=600&q=80" alt="Mobile Friendly System" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
          <span class="absolute top-2 left-2 bg-white/95 text-[#111215] text-[9px] font-bold px-2 py-0.5 rounded-full">Akses HP &amp; Tablet</span>
        </div>
        <div class="mt-2 px-1 flex items-center justify-between">
          <span class="text-xs font-bold text-[#111215] dark:text-white">Responsif Layar</span>
          <i data-lucide="smartphone" class="w-3.5 h-3.5 text-[#C4264A]"></i>
        </div>
      </div>

      <div class="bg-white dark:bg-[#1A1C22] rounded-2xl p-3 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs group overflow-hidden">
        <div class="h-28 sm:h-32 rounded-xl overflow-hidden relative bg-[#111215]">
          <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=600&q=80" alt="Cloud Infrastructure" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
          <span class="absolute top-2 left-2 bg-[#111215] text-white text-[9px] font-bold px-2 py-0.5 rounded-full">Cloud Terenkripsi</span>
        </div>
        <div class="mt-2 px-1 flex items-center justify-between">
          <span class="text-xs font-bold text-[#111215] dark:text-white">Data Aman Terpusat</span>
          <i data-lucide="lock" class="w-3.5 h-3.5 text-[#111215] dark:text-white"></i>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ========================================================================= -->
<!-- 4. KENDALA BISNIS & MASALAH OPERASIONAL (SESUAI GAMBAR REFERENSI USER)     -->
<!-- ========================================================================= -->
<section id="kendala" class="py-16 sm:py-24 bg-[#FAFAFC] dark:bg-[#12131A] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-10">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
      <div>
        <!-- Heading 2 Baris Persis Sesuai Gambar Referensi -->
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#111215] dark:text-white tracking-tight leading-tight">
          Masih Mengalami Kendala Ini<br class="hidden sm:inline" />
          <span class="text-neutral-400">di Bisnis atau Organisasi Anda?</span>
        </h2>
      </div>

      <!-- Interactive Switcher: Kondisi Sebelum vs Solusi SOLVETA -->
      <div class="inline-flex bg-white dark:bg-[#1A1C22] p-1.5 rounded-full border border-[#E8E9ED] dark:border-neutral-800 shadow-xs self-start md:self-auto">
        <button id="tab-problem-btn" onclick="toggleProblemView('problem')" class="px-4 py-2 rounded-full bg-[#111215] text-white text-xs font-semibold transition flex items-center gap-1.5 cursor-pointer">
          <i data-lucide="x-circle" class="w-3.5 h-3.5"></i>
          <span>Kondisi Sebelum</span>
        </button>
        <button id="tab-solution-btn" onclick="toggleProblemView('solution')" class="px-4 py-2 rounded-full text-neutral-600 dark:text-neutral-400 hover:text-[#111215] text-xs font-semibold transition flex items-center gap-1.5 cursor-pointer">
          <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
          <span>Solusi SOLVETA</span>
        </button>
      </div>
    </div>

    <!-- 4 Visual Problem Cards with Realistic High-Res SaaS Images -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
      
      <!-- Card 1: 01 · Transaksi & Kasir -->
      <div class="bg-white dark:bg-[#1A1C22] rounded-[24px] p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between">
        <div>
          <div class="h-36 rounded-2xl overflow-hidden relative mb-4 bg-[#111215]">
            <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=600&q=80" alt="Penjualan & Pembukuan" class="w-full h-full object-cover">
            <span class="absolute top-2.5 left-2.5 px-2.5 py-1 rounded-full bg-[#C4264A] text-white text-[10px] font-bold font-sans">
              01 · Transaksi &amp; Kasir
            </span>
          </div>
          <h3 class="text-base font-bold text-[#111215] dark:text-white mb-3">
            Penjualan &amp; Keuangan Masih Dicatat Manual?
          </h3>

          <!-- Problem Bullets (Kondisi Sebelum) -->
          <ul class="problem-list space-y-2.5 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Nota penjualan masih tulis tangan atau ketik ulang di Excel</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Rekap omzet &amp; laba rugi bulanan lama dan rawan salah hitung</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Piutang pelanggan sering lupa ditagih karena tanpa pengingat</span>
            </li>
          </ul>

          <!-- Solution Bullets (Tanpa kotak pink, latar putih bersih, poin-poin rapi & deskripsi tidak tebal) -->
          <ul class="solution-list hidden space-y-2.5 text-xs text-neutral-600 dark:text-neutral-300">
            <li class="flex items-start gap-2">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal"><strong class="font-medium text-[#111215] dark:text-white">Kasir POS &amp; ERP:</strong> Transaksi otomatis masuk laporan laba-rugi real-time</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal"><strong class="font-medium text-[#111215] dark:text-white">QRIS &amp; Invoicing:</strong> Tagihan otomatis terkirim ke WhatsApp klien</span>
            </li>
          </ul>
        </div>

        <div class="mt-5 pt-3.5 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between text-[11px] font-sans text-neutral-500">
          <span>Solusi: <strong class="text-[#111215] dark:text-white font-medium">POS, CRM &amp; ERP</strong></span>
          <a href="<?= base_url('layanan') ?>" class="text-[#C4264A] font-semibold inline-flex items-center gap-1 hover:underline">
            <span>Detail</span>
            <i data-lucide="arrow-right" class="w-3 h-3"></i>
          </a>
        </div>
      </div>

      <!-- Card 2: 02 · Organisasi & SDM -->
      <div class="bg-white dark:bg-[#1A1C22] rounded-[24px] p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between">
        <div>
          <div class="h-36 rounded-2xl overflow-hidden relative mb-4 bg-[#111215]">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80" alt="Manajemen Organisasi" class="w-full h-full object-cover">
            <span class="absolute top-2.5 left-2.5 px-2.5 py-1 rounded-full bg-[#111215] text-white text-[10px] font-bold font-sans">
              02 · Organisasi &amp; SDM
            </span>
          </div>
          <h3 class="text-base font-bold text-[#111215] dark:text-white mb-3">
            Punya Organisasi Tapi Sistem Belum Teratur?
          </h3>

          <!-- Problem Bullets (Kondisi Sebelum) -->
          <ul class="problem-list space-y-2.5 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Pembagian tugas tim berantakan &amp; tercecer di chat grup WA</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Absensi, lembur, cuti, &amp; gaji (payroll) masih direkap manual</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Dokumen penting organisasi tersebar di banyak perangkat</span>
            </li>
          </ul>

          <!-- Solution Bullets (Tanpa kotak pink, latar putih bersih, poin-poin rapi & deskripsi tidak tebal) -->
          <ul class="solution-list hidden space-y-2.5 text-xs text-neutral-600 dark:text-neutral-300">
            <li class="flex items-start gap-2">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal"><strong class="font-medium text-[#111215] dark:text-white">HRIS &amp; PMS:</strong> Absensi GPS/wajah, slip gaji otomatis, &amp; pantau KPI</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal"><strong class="font-medium text-[#111215] dark:text-white">Portal Organisasi:</strong> Alur persetujuan &amp; arsip digital satu pintu</span>
            </li>
          </ul>
        </div>

        <div class="mt-5 pt-3.5 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between text-[11px] font-sans text-neutral-500">
          <span>Solusi: <strong class="text-[#111215] dark:text-white font-medium">HRIS &amp; PMS</strong></span>
          <a href="<?= base_url('layanan') ?>" class="text-[#C4264A] font-semibold inline-flex items-center gap-1 hover:underline">
            <span>Detail</span>
            <i data-lucide="arrow-right" class="w-3 h-3"></i>
          </a>
        </div>
      </div>

      <!-- Card 3: 03 · Gudang & Supplier -->
      <div class="bg-white dark:bg-[#1A1C22] rounded-[24px] p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between">
        <div>
          <div class="h-36 rounded-2xl overflow-hidden relative mb-4 bg-[#111215]">
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=600&q=80" alt="Gudang & Logistik" class="w-full h-full object-cover">
            <span class="absolute top-2.5 left-2.5 px-2.5 py-1 rounded-full bg-[#C4264A] text-white text-[10px] font-bold font-sans">
              03 · Gudang &amp; Supplier
            </span>
          </div>
          <h3 class="text-base font-bold text-[#111215] dark:text-white mb-3">
            Stok Barang Sering Selisih &amp; Habis Mendadak?
          </h3>

          <!-- Problem Bullets (Kondisi Sebelum) -->
          <ul class="problem-list space-y-2.5 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Jumlah barang di catatan tidak sama dengan fisik di gudang</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Barang laris habis tanpa peringatan, barang lama menumpuk</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Pesanan ke supplier &amp; pengiriman antar cabang sulit dilacak</span>
            </li>
          </ul>

          <!-- Solution Bullets (Tanpa kotak pink, latar putih bersih, poin-poin rapi & deskripsi tidak tebal) -->
          <ul class="solution-list hidden space-y-2.5 text-xs text-neutral-600 dark:text-neutral-300">
            <li class="flex items-start gap-2">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal"><strong class="font-medium text-[#111215] dark:text-white">WMS Barcode:</strong> Stok keluar-masuk akurat per detik di semua cabang</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal"><strong class="font-medium text-[#111215] dark:text-white">SCM Otomatis:</strong> Peringatan stok tipis &amp; lacak PO supplier real-time</span>
            </li>
          </ul>
        </div>

        <div class="mt-5 pt-3.5 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between text-[11px] font-sans text-neutral-500">
          <span>Solusi: <strong class="text-[#111215] dark:text-white font-medium">WMS &amp; SCM</strong></span>
          <a href="<?= base_url('layanan') ?>" class="text-[#C4264A] font-semibold inline-flex items-center gap-1 hover:underline">
            <span>Detail</span>
            <i data-lucide="arrow-right" class="w-3 h-3"></i>
          </a>
        </div>
      </div>

      <!-- Card 4: 04 · Citra & Promosi -->
      <div class="bg-white dark:bg-[#1A1C22] rounded-[24px] p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between">
        <div>
          <div class="h-36 rounded-2xl overflow-hidden relative mb-4 bg-[#111215]">
            <img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&q=80" alt="Website & Citra Bisnis" class="w-full h-full object-cover">
            <span class="absolute top-2.5 left-2.5 px-2.5 py-1 rounded-full bg-[#111215] text-white text-[10px] font-bold font-sans">
              04 · Citra &amp; Promosi
            </span>
          </div>
          <h3 class="text-base font-bold text-[#111215] dark:text-white mb-3">
            Belum Punya Website Resmi atau Tampilan Kuno?
          </h3>

          <!-- Problem Bullets (Kondisi Sebelum) -->
          <ul class="problem-list space-y-2.5 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Calon klien ragu bekerja sama karena bisnis sulit dicari di Google</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Iklan jalan terus tapi sepi pembeli karena tanpa Landing Page</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="minus-circle" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal">Website lama lambat dibuka di HP &amp; sulit update berita/katalog</span>
            </li>
          </ul>

          <!-- Solution Bullets (Tanpa kotak pink, latar putih bersih, poin-poin rapi & deskripsi tidak tebal) -->
          <ul class="solution-list hidden space-y-2.5 text-xs text-neutral-600 dark:text-neutral-300">
            <li class="flex items-start gap-2">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal"><strong class="font-medium text-[#111215] dark:text-white">Company Profile &amp; Landing Page:</strong> Desain modern, cepat, &amp; siap SEO</span>
            </li>
            <li class="flex items-start gap-2">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
              <span class="font-normal"><strong class="font-medium text-[#111215] dark:text-white">CMS Mudah:</strong> Admin bisa tambah berita, artikel, &amp; produk sendiri</span>
            </li>
          </ul>
        </div>

        <div class="mt-5 pt-3.5 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between text-[11px] font-sans text-neutral-500">
          <span>Solusi: <strong class="text-[#111215] dark:text-white font-medium">Web, Berita &amp; LMS</strong></span>
          <a href="<?= base_url('layanan') ?>" class="text-[#C4264A] font-semibold inline-flex items-center gap-1 hover:underline">
            <span>Detail</span>
            <i data-lucide="arrow-right" class="w-3 h-3"></i>
          </a>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ========================================================================= -->
<!-- 5. 12 SISTEM & ARSITEKTUR DIGITAL (SESUAI GAMBAR REFERENSI USER)           -->
<!-- ========================================================================= -->
<section id="sistem" class="py-16 sm:py-24 bg-white dark:bg-[#0E0F12] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-10">
    
    <!-- Section Header Persis Sesuai Gambar Referensi -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-2 bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 px-3.5 py-1.5 rounded-full text-xs font-semibold text-[#111215] dark:text-white shadow-xs">
        <i data-lucide="layout-grid" class="w-3.5 h-3.5 text-[#C4264A]"></i>
        <span>Layanan &amp; Katalog Produk Digital</span>
      </div>
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#111215] dark:text-white tracking-tight leading-tight">
        Aplikasi &amp; Sistem Apa Saja <br class="hidden sm:inline" />
        <span class="text-neutral-400 dark:text-neutral-500">yang Kami Bangun?</span>
      </h2>
      <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed font-sans max-w-2xl mx-auto">
        Pilih sistem yang paling dibutuhkan bisnis atau organisasi Anda — lengkap dengan kepanjangan &amp; fungsi utamanya.
      </p>
    </div>

    <!-- Category Filter Tabs Persis Sesuai Gambar Referensi -->
    <div class="flex items-center justify-start sm:justify-center gap-2 overflow-x-auto no-scrollbar pb-2">
      <button onclick="filterSystems('all')" data-filter="all" class="sys-filter-btn shrink-0 px-4 py-2 rounded-full bg-[#C4264A] text-white text-xs font-semibold shadow-xs transition flex items-center gap-1.5 cursor-pointer">
        <i data-lucide="layers" class="w-3.5 h-3.5"></i>
        <span>Semua Sistem (12)</span>
      </button>
      <button onclick="filterSystems('enterprise')" data-filter="enterprise" class="sys-filter-btn shrink-0 px-4 py-2 rounded-full bg-white dark:bg-[#1A1C22] hover:bg-neutral-100 text-[#111215] dark:text-white text-xs font-semibold border border-[#E8E9ED] dark:border-neutral-800 transition flex items-center gap-1.5 cursor-pointer">
        <i data-lucide="building-2" class="w-3.5 h-3.5"></i>
        <span>Manajemen &amp; Organisasi (ERP, HRIS, PMS)</span>
      </button>
      <button onclick="filterSystems('commerce')" data-filter="commerce" class="sys-filter-btn shrink-0 px-4 py-2 rounded-full bg-white dark:bg-[#1A1C22] hover:bg-neutral-100 text-[#111215] dark:text-white text-xs font-semibold border border-[#E8E9ED] dark:border-neutral-800 transition flex items-center gap-1.5 cursor-pointer">
        <i data-lucide="package" class="w-3.5 h-3.5"></i>
        <span>Penjualan &amp; Gudang (CRM, POS, WMS, SCM)</span>
      </button>
      <button onclick="filterSystems('web')" data-filter="web" class="sys-filter-btn shrink-0 px-4 py-2 rounded-full bg-white dark:bg-[#1A1C22] hover:bg-neutral-100 text-[#111215] dark:text-white text-xs font-semibold border border-[#E8E9ED] dark:border-neutral-800 transition flex items-center gap-1.5 cursor-pointer">
        <i data-lucide="globe" class="w-3.5 h-3.5"></i>
        <span>Website, Media Berita &amp; Edukasi LMS</span>
      </button>
    </div>

    <!-- 12 Visual System Cards Grid (Format Warna & Teks Persis Sesuai Gambar) -->
    <div id="systems-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      
      <!-- 1. CRM -->
      <div data-category="commerce" id="sys-crm" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=600&q=80" alt="CRM Pipeline" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#C4264A] text-white text-xs font-sans font-bold">CRM</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="contact" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">Customer Relationship Management</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            CRM <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Customer Relationship Management)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Database pelanggan &amp; riwayat transaksi terpusat</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Pelacakan prospek (leads pipeline) &amp; target sales</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Pengingat follow-up otomatis via WhatsApp &amp; Email</span></li>
          </ul>
        </div>
        <button onclick="openConsultModal('Pemesanan Sistem CRM (Customer Relationship Management)')" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">
          <span>Konsultasi Sistem CRM</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </button>
      </div>

      <!-- 2. ERP -->
      <div data-category="enterprise" id="sys-erp" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80" alt="ERP Master Hub" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#111215] text-white text-xs font-sans font-bold border border-white/15">ERP</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="network" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">Enterprise Resource Planning</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            ERP <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Enterprise Resource Planning)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Integrasi keuangan, akuntansi, &amp; operasional</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Semua divisi terhubung dalam 1 dashboard</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Laporan laba rugi, neraca, &amp; pajak otomatis</span></li>
          </ul>
        </div>
        <button onclick="openConsultModal('Pemesanan Sistem ERP (Enterprise Resource Planning)')" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">
          <span>Konsultasi Sistem ERP</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </button>
      </div>

      <!-- 3. HRIS -->
      <div data-category="enterprise" id="sys-hris" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80" alt="HRIS Attendance" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#C4264A] text-white text-xs font-sans font-bold">HRIS</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="user-check" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">Human Resource Information System</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            HRIS <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Human Resource Information System)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Absensi selfie/GPS dari HP &amp; manajemen shift</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Hitung gaji (payroll), lembur, &amp; BPJS otomatis</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Pengajuan cuti online &amp; penilaian KPI karyawan</span></li>
          </ul>
        </div>
        <button onclick="openConsultModal('Pemesanan Sistem HRIS (Human Resource Information System)')" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">
          <span>Konsultasi Sistem HRIS</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </button>
      </div>

      <!-- 4. POS -->
      <div data-category="commerce" id="sys-pos" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=600&q=80" alt="POS Kasir Pintar" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#C4264A] text-white text-xs font-sans font-bold">POS</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="credit-card" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">Point of Sale (Kasir Digital)</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            POS <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Point of Sale / Kasir Pintar)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Transaksi cepat (&lt;3 detik), scan barcode &amp; nota instan</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Integrasi pembayaran QRIS dinamis, kartu EDC, &amp; tunai</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Laporan pergantian shift kasir &amp; deteksi selisih otomatis</span></li>
          </ul>
        </div>
        <button onclick="openConsultModal('Pemesanan Sistem POS (Point of Sale / Kasir Pintar)')" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">
          <span>Konsultasi Sistem POS</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </button>
      </div>

      <!-- 5. WMS -->
      <div data-category="commerce" id="sys-wms" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=600&q=80" alt="WMS Warehouse" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#111215] text-white text-xs font-sans font-bold border border-white/15">WMS</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="boxes" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">Warehouse Management System</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            WMS <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Warehouse Management System)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Scan barcode keluar-masuk barang &amp; alur FIFO presisi</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Peringatan otomatis ketika stok barang batas menipis</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Stock opname cepat via HP tanpa menghentikan toko</span></li>
          </ul>
        </div>
        <button onclick="openConsultModal('Pemesanan Sistem WMS (Warehouse Management System)')" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">
          <span>Konsultasi Sistem WMS</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </button>
      </div>

      <!-- 6. SCM -->
      <div data-category="commerce" id="sys-scm" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=600&q=80" alt="SCM Supply Chain" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#111215] text-white text-xs font-sans font-bold border border-white/15">SCM</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="truck" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">Supply Chain Management</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            SCM <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Supply Chain Management)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Pelacakan pengadaan PO &amp; evaluasi mutu supplier</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Live GPS tracking posisi logistik armada pengiriman</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Peramalan kebutuhan restock berkala berbasis data</span></li>
          </ul>
        </div>
        <button onclick="openConsultModal('Pemesanan Sistem SCM (Supply Chain Management)')" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">
          <span>Konsultasi Sistem SCM</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </button>
      </div>

      <!-- 7. PMS -->
      <div data-category="enterprise" id="sys-pms" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=600&q=80" alt="PMS Project Timeline" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#C4264A] text-white text-xs font-sans font-bold">PMS</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="kanban" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">Project &amp; Property Management</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            PMS <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Project &amp; Property Management)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Papan tugas Kanban interaktif, Gantt chart, &amp; deadline</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Monitoring utilisasi jam kerja staf &amp; anggaran proyek</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Manajemen booking sewa aset, kamar, &amp; properti</span></li>
          </ul>
        </div>
        <button onclick="openConsultModal('Pemesanan Sistem PMS (Project / Property Management)')" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">
          <span>Konsultasi Sistem PMS</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </button>
      </div>

      <!-- 8. Landing Page -->
      <div data-category="web" id="sys-web" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&w=600&q=80" alt="Landing Page Konversi" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#111215] text-white text-xs font-sans font-bold border border-white/15">LANDING PAGE</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="mouse-pointer-click" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">&lt; 0.8s High-Converting Speed</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            Landing Page <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Kecepatan Kilat &amp; Konversi)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Kecepatan loading kilat (&lt;0.8s) siap iklan digital</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Tombol pesan langsung WhatsApp draft otomatis rapi</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Integrasi Meta Pixel, Google Tag Manager &amp; TikTok Ads</span></li>
          </ul>
        </div>
        <a href="<?= base_url('layanan/starter') ?>" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5">
          <span>Pilih Paket Starter (Rp 249K)</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </a>
      </div>

      <!-- 9. Portal Media Berita -->
      <div data-category="web" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=600&q=80" alt="Portal Media Berita" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#C4264A] text-white text-xs font-sans font-bold">MEDIA CMS</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="newspaper" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">Google News &amp; AdSense Ready</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            Portal Media <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Media Berita &amp; Google News)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Alur redaksi: wartawan submit &amp; editor rilis berita</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Terindeks cepat di Google News &amp; Google Discover</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Manajemen banner sponsor &amp; iklan Google AdSense</span></li>
          </ul>
        </div>
        <a href="<?= base_url('layanan/bisnis') ?>" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5">
          <span>Pilih Paket Bisnis (Rp 599K)</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </a>
      </div>

      <!-- 10. Company Profile Korporasi -->
      <div data-category="web" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=600&q=80" alt="Company Profile Korporasi" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#111215] text-white text-xs font-sans font-bold border border-white/15">COMPRO B2B</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="building" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">Kredibilitas Tender &amp; Investor</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            Company Profile <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Kredibilitas B2B &amp; Tender)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Desain representatif citra wibawa korporasi berkarakter</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Portofolio interaktif &amp; bukti legalitas perusahaan</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Enkripsi SSL tingkat tinggi &amp; form kontak penawaran</span></li>
          </ul>
        </div>
        <a href="<?= base_url('layanan/bisnis') ?>" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5">
          <span>Pilih Paket Bisnis (Rp 599K)</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </a>
      </div>

      <!-- 11. Edukasi LMS -->
      <div data-category="web" class="system-card bg-[#FAFAFC] dark:bg-[#14151B] rounded-[24px] p-4 sm:p-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-[#111215] mb-4">
            <img src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?auto=format&fit=crop&w=600&q=80" alt="LMS Course Hub" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#C4264A] text-white text-xs font-sans font-bold">LMS</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="graduation-cap" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">E-Learning &amp; Sertifikat Digital</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">
            LMS <span class="text-xs font-normal text-neutral-500 dark:text-neutral-400">(Learning Management System)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Proteksi materi video kursus anti-unduh ilegal</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Ujian online acak dengan penilaian &amp; timer otomatis</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Penerbitan e-sertifikat resmi otomatis dengan kode QR</span></li>
          </ul>
        </div>
        <button onclick="openConsultModal('Pemesanan Platform Edukasi & LMS')" class="mt-4 w-full py-2.5 rounded-xl bg-white dark:bg-[#1A1C22] hover:bg-[#C4264A] hover:text-white text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-800 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">
          <span>Konsultasi Sistem LMS</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </button>
      </div>

      <!-- 12. Custom App & AI -->
      <div data-category="enterprise" class="system-card bg-[#111215] text-white rounded-[24px] p-4 sm:p-5 border border-black/10 shadow-xl flex flex-col justify-between group">
        <div>
          <div class="h-40 rounded-2xl overflow-hidden relative bg-neutral-900 mb-4">
            <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&q=80" alt="Custom Web App & AI" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent"></div>
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#C4264A] text-white text-xs font-sans font-bold">CUSTOM AI</span>
            <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white text-[#111215] flex items-center justify-center shadow-xs">
              <i data-lucide="bot" class="w-4 h-4"></i>
            </span>
            <span class="absolute bottom-2.5 left-3 right-3 text-[11px] font-sans text-white/90 truncate">AI Workflow &amp; 100% Hak Milik</span>
          </div>
          <h3 class="text-base sm:text-lg font-bold text-white">
            Custom App <span class="text-xs font-normal text-neutral-400">(Web Kustom &amp; AI Workflow)</span>
          </h3>
          <ul class="mt-3 space-y-2 text-xs text-neutral-300">
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>100% hak milik penuh tanpa biaya lisensi bulanan</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Otomasi AI chatbot khusus dilatih SOP perusahaan</span></li>
            <li class="flex items-start gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i><span>Integrasi API bebas ke sistem perbankan &amp; kurir</span></li>
          </ul>
        </div>
        <a href="<?= base_url('layanan/custom') ?>" class="mt-4 w-full py-2.5 rounded-xl bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs font-semibold transition flex items-center justify-center gap-1.5">
          <span>Pilih Paket Custom (Menyesuaikan Kebutuhan)</span>
          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
        </a>
      </div>

    </div>

    <!-- Bottom Consultation Callout -->
    <div class="p-6 sm:p-8 rounded-3xl bg-neutral-50 dark:bg-[#14151B] border border-[#E8E9ED] dark:border-neutral-800 flex flex-col sm:flex-row items-center justify-between gap-5">
      <div>
        <h4 class="text-base sm:text-lg font-bold text-[#111215] dark:text-white">Tidak Menemukan Sistem yang Sesuai dengan Kebutuhan Anda?</h4>
        <p class="text-xs sm:text-sm text-neutral-500 mt-1">Kami siap merancang sistem khusus yang dipersonalisasi penuh dengan alur operasional bisnis Anda.</p>
      </div>
      <button onclick="openConsultModal('Konsultasi Sistem Kustom Sesuai Request')" class="shrink-0 px-6 py-3 rounded-full bg-[#111215] hover:bg-[#C4264A] text-white text-xs font-semibold transition flex items-center gap-2 cursor-pointer shadow-sm">
        <span>Diskusikan Kebutuhan Khusus Anda</span>
        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
      </button>
    </div>

  </div>
</section>

<!-- ========================================================================= -->
<!-- 6. ALUR PROSES PERANCANGAN (21st.dev / shadcn Responsive Timeline)        -->
<!-- ========================================================================= -->
<section id="alur" class="py-16 sm:py-24 bg-[#FAFAFC] dark:bg-[#12131A] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-12">
    
    <div class="space-y-3 text-center max-w-2xl mx-auto">
      <div class="inline-flex items-center gap-2 bg-red-50 dark:bg-neutral-900 border border-red-200 dark:border-neutral-800 px-3.5 py-1.5 rounded-full text-xs font-bold text-[#C4264A] dark:text-[#F05A72] font-sans">
        <i data-lucide="git-commit" class="w-3.5 h-3.5"></i>
        <span>METODOLOGI &amp; PROSES PERANCANGAN SISTEM</span>
      </div>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-[#111215] dark:text-white tracking-tight">
        Alur Proses Perancangan &amp; Rekayasa Solusi
      </h2>
      <p class="text-xs sm:text-sm text-neutral-500 max-w-lg mx-auto leading-relaxed">
        Dari pemetaan kebutuhan awal hingga serah terima produksi teruji tanpa friksi atau birokrasi rumit.
      </p>
    </div>

    <!-- 21st.dev Interactive Timeline Component (Horizontal on Desktop, Vertical on Mobile) -->
    <div class="relative bg-white dark:bg-[#14151B] p-6 sm:p-10 rounded-3xl border border-neutral-200/90 dark:border-white/10 shadow-sm overflow-hidden">
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 lg:gap-6 relative">
        
        <!-- Step 1: Pemetaan & Analisis (Completed) -->
        <div class="relative flex flex-col group">
          <!-- Mobile vertical connecting line -->
          <div class="lg:hidden absolute left-4 top-8 bottom-0 w-0.5 bg-[#C4264A] -translate-x-1/2"></div>
          
          <!-- Top Row: Indicator & Desktop Connector Line -->
          <div class="flex items-center mb-5 relative">
            <div class="z-10 flex items-center justify-center size-8 rounded-full border-2 border-[#C4264A] bg-[#C4264A] text-white shadow-sm shadow-[#C4264A]/30 shrink-0">
              <i data-lucide="check" class="w-4 h-4 stroke-[3]"></i>
            </div>
            <!-- Line connecting Step 1 to Step 2 (Desktop only) -->
            <div class="hidden lg:block absolute left-8 right-0 top-1/2 -translate-y-1/2 h-0.5 bg-[#C4264A] -mr-6"></div>
          </div>
          
          <!-- Text Body -->
          <div class="space-y-1.5 pl-10 lg:pl-0">
            <time class="text-neutral-400 dark:text-neutral-500 mb-1 block text-xs font-sans font-semibold uppercase tracking-wider tabular-nums">FASE 01 &bull; MINGGU 1</time>
            <h3 class="text-base font-bold text-[#111215] dark:text-white leading-tight">Pemetaan &amp; Analisis Kebutuhan</h3>
            <p class="text-neutral-600 dark:text-neutral-400 text-xs sm:text-sm leading-relaxed mt-1">
              Audit mendalam terhadap alur proses bisnis Anda, identifikasi hambatan sistem lama, dan penyusunan KPI sistem.
            </p>
            <div class="pt-2">
              <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-neutral-100 dark:bg-white/5 text-[11px] font-sans text-neutral-700 dark:text-neutral-300 font-medium">
                <span class="w-1.5 h-1.5 rounded-full bg-[#C4264A]"></span>
                Output: System Blueprint &amp; Scope
              </div>
            </div>
          </div>
        </div>

        <!-- Step 2: Perancangan Arsitektur & UI/UX (Completed) -->
        <div class="relative flex flex-col group">
          <!-- Mobile vertical connecting line -->
          <div class="lg:hidden absolute left-4 top-8 bottom-0 w-0.5 bg-[#C4264A] -translate-x-1/2"></div>
          
          <!-- Top Row: Indicator & Desktop Connector Line -->
          <div class="flex items-center mb-5 relative">
            <div class="z-10 flex items-center justify-center size-8 rounded-full border-2 border-[#C4264A] bg-[#C4264A] text-white shadow-sm shadow-[#C4264A]/30 shrink-0">
              <i data-lucide="check" class="w-4 h-4 stroke-[3]"></i>
            </div>
            <!-- Line connecting Step 2 to Step 3 (Desktop only) -->
            <div class="hidden lg:block absolute left-8 right-0 top-1/2 -translate-y-1/2 h-0.5 bg-neutral-200 dark:bg-neutral-800 -mr-6"></div>
          </div>
          
          <!-- Text Body -->
          <div class="space-y-1.5 pl-10 lg:pl-0">
            <time class="text-neutral-400 dark:text-neutral-500 mb-1 block text-xs font-sans font-semibold uppercase tracking-wider tabular-nums">FASE 02 &bull; MINGGU 2&ndash;3</time>
            <h3 class="text-base font-bold text-[#111215] dark:text-white leading-tight">Perancangan Arsitektur &amp; UI/UX</h3>
            <p class="text-neutral-600 dark:text-neutral-400 text-xs sm:text-sm leading-relaxed mt-1">
              Perancangan skema relasi database PostgreSQL, blueprint API, dan wireframe antarmuka interaktif yang divalidasi langsung.
            </p>
            <div class="pt-2">
              <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-neutral-100 dark:bg-white/5 text-[11px] font-sans text-neutral-700 dark:text-neutral-300 font-medium">
                <span class="w-1.5 h-1.5 rounded-full bg-[#C4264A]"></span>
                Output: UI Prototype &amp; Database Schema
              </div>
            </div>
          </div>
        </div>

        <!-- Step 3: Rekayasa Kode & Integrasi API (Current / Active) -->
        <div class="relative flex flex-col group">
          <!-- Mobile vertical connecting line -->
          <div class="lg:hidden absolute left-4 top-8 bottom-0 w-0.5 bg-neutral-200 dark:bg-neutral-800 -translate-x-1/2"></div>
          
          <!-- Top Row: Indicator & Desktop Connector Line -->
          <div class="flex items-center mb-5 relative">
            <div class="z-10 flex items-center justify-center size-8 rounded-full border-2 border-[#C4264A] bg-[#C4264A]/10 ring-4 ring-[#C4264A]/25 text-[#C4264A] shadow-sm shrink-0">
              <span class="w-2.5 h-2.5 rounded-full bg-[#C4264A] animate-pulse"></span>
            </div>
            <!-- Line connecting Step 3 to Step 4 (Desktop only) -->
            <div class="hidden lg:block absolute left-8 right-0 top-1/2 -translate-y-1/2 h-0.5 bg-neutral-200 dark:bg-neutral-800 -mr-6"></div>
          </div>
          
          <!-- Text Body -->
          <div class="space-y-1.5 pl-10 lg:pl-0">
            <time class="text-[#C4264A] dark:text-[#F05A72] mb-1 block text-xs font-sans font-bold uppercase tracking-wider tabular-nums">FASE 03 &bull; MINGGU 4&ndash;6 (PROSES)</time>
            <h3 class="text-base font-bold text-[#111215] dark:text-white leading-tight">Rekayasa Kode &amp; Integrasi API</h3>
            <p class="text-neutral-600 dark:text-neutral-400 text-xs sm:text-sm leading-relaxed mt-1">
              Eksekusi pengkodean clean architecture, integrasi payment gateway / WhatsApp bot, kecerdasan buatan, dan demo sprint berkala.
            </p>
            <div class="pt-2">
              <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-red-50 dark:bg-red-950/40 text-[11px] font-sans text-[#C4264A] dark:text-red-300 font-semibold border border-red-200 dark:border-red-900/50">
                <span class="w-1.5 h-1.5 rounded-full bg-[#C4264A] animate-ping"></span>
                Output: Production Source Code
              </div>
            </div>
          </div>
        </div>

        <!-- Step 4: Pengujian Ketat & Garansi SLA (Pending) -->
        <div class="relative flex flex-col group">
          <!-- Top Row: Indicator (Last step, no outgoing line) -->
          <div class="flex items-center mb-5 relative">
            <div class="z-10 flex items-center justify-center size-8 rounded-full border-2 border-neutral-300 dark:border-neutral-700 bg-neutral-100 dark:bg-neutral-800 text-neutral-400 shrink-0 font-sans font-bold text-xs">
              04
            </div>
          </div>
          
          <!-- Text Body -->
          <div class="space-y-1.5 pl-10 lg:pl-0">
            <time class="text-neutral-400 dark:text-neutral-500 mb-1 block text-xs font-sans font-semibold uppercase tracking-wider tabular-nums">FASE 04 &bull; MINGGU 7+</time>
            <h3 class="text-base font-bold text-[#111215] dark:text-white leading-tight">Pengujian Ketat &amp; Garansi SLA</h3>
            <p class="text-neutral-600 dark:text-neutral-400 text-xs sm:text-sm leading-relaxed mt-1">
              Stress-test performa sistem, audit celah keamanan OWASP, migrasi server zero-downtime, serta garansi pemeliharaan 12 bulan penuh.
            </p>
            <div class="pt-2">
              <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-neutral-100 dark:bg-white/5 text-[11px] font-sans text-neutral-700 dark:text-neutral-300 font-medium">
                <span class="w-1.5 h-1.5 rounded-full bg-neutral-400"></span>
                Output: 0-Downtime Go-Live &amp; Garansi
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>

<!-- ========================================================================= -->
<!-- 7. TESTIMONI & KEPERCAYAAN MITRA (Model 3D Perspective Marquee 21st.dev)  -->
<!-- ========================================================================= -->
<section id="testimoni" class="py-16 sm:py-24 bg-white dark:bg-[#0E0F12] font-sans border-b border-[#E8E9ED] dark:border-neutral-800 relative overflow-hidden">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-8">
    
    <!-- 1 Kalimat Simpel & Kecil Sesuai Permintaan User -->
    <div class="text-center space-y-1">
      <p class="text-xs font-sans font-bold uppercase tracking-wider text-neutral-400 dark:text-neutral-500">
        Testimoni &amp; cerita nyata dari para mitra yang telah bertumbuh bersama SOLVETA.
      </p>
    </div>

    <!-- 3D Perspective Container (Tilted Wall Perspective 300-450px) -->
    <div class="border border-[#E8E9ED] dark:border-neutral-800 rounded-3xl relative flex h-[480px] sm:h-[520px] w-full flex-row items-center justify-center overflow-hidden bg-[#FAFAFC] dark:bg-[#111215] [perspective:420px] shadow-sm marquee-3d-wrap">
      
      <!-- 3D Tilted Inner Grid (4 Isometric Vertical Columns) -->
      <div 
        class="flex flex-row items-center gap-4 sm:gap-5 transition-transform duration-700 pointer-events-auto shrink-0"
        style="transform: translateX(-50px) translateY(0px) translateZ(-60px) rotateX(18deg) rotateY(-10deg) rotateZ(18deg);"
      >

        <!-- Column 1: Vertical Marquee (Downwards) -->
        <div class="marquee-column flex flex-col overflow-hidden w-56 sm:w-64 h-[840px] shrink-0">
          <div class="flex flex-col gap-3.5 shrink-0 animate-marquee-v" style="--duration: 42s;">
            <!-- Card 1: Mba Zuhro -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Mba Zuhro" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Mba Zuhro <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@zuhro_official</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Maa syaa Allah BAGUS BANGETTT makasih bantuannya gercep banget mas! Nanti kalau launching kami buat video promosi juga ya kak."
              </blockquote>
            </div>

            <!-- Card 2: Bapak Rian -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=120&q=80" alt="Bapak Rian" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Bapak Rian <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@rian_retail</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Aplikasi kasir POS dan stok multi-cabang sangat stabil. Selisih kasir sekarang nol persen. Mantap tim SOLVETA."
              </blockquote>
            </div>

            <!-- Card 3: Sarah M. -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=120&q=80" alt="Sarah Maharani" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Sarah M. <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@sarah.agency</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Landing page dan WhatsApp otomatisasi konversinya naik +300%. Desainnya bener-bener clean & kelas dunia!"
              </blockquote>
            </div>

            <!-- Duplicate Set for Seamless Loop -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Mba Zuhro" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Mba Zuhro <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@zuhro_official</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Maa syaa Allah BAGUS BANGETTT makasih bantuannya gercep banget mas! Nanti kalau launching kami buat video promosi juga ya kak."
              </blockquote>
            </div>
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=120&q=80" alt="Bapak Rian" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Bapak Rian <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@rian_retail</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Aplikasi kasir POS dan stok multi-cabang sangat stabil. Selisih kasir sekarang nol persen. Mantap tim SOLVETA."
              </blockquote>
            </div>
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=120&q=80" alt="Sarah Maharani" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Sarah M. <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@sarah.agency</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Landing page dan WhatsApp otomatisasi konversinya naik +300%. Desainnya bener-bener clean & kelas dunia!"
              </blockquote>
            </div>
          </div>
        </div>

        <!-- Column 2: Vertical Marquee (Upwards / Reverse) -->
        <div class="marquee-column flex flex-col overflow-hidden w-56 sm:w-64 h-[840px] shrink-0">
          <div class="flex flex-col gap-3.5 shrink-0 animate-marquee-v-reverse" style="--duration: 38s;">
            <!-- Card 4: dr. Hendra -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=120&q=80" alt="dr. Hendra" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    dr. Hendra <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@hendra.klinik</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Sistem rekam medis & reservasi klinik kami sekarang otomatis 100%. Pasien tidak perlu antre manual lagi. Terima kasih SOLVETA!"
              </blockquote>
            </div>

            <!-- Card 5: Dewi Anggraeni -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=120&q=80" alt="Dewi A." class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Dewi A. <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@dewi_hijab</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Website e-commerce kami cepet banget loadingnya, pas promo live flash sale ribuan pengunjung tetep lancar tanpa down!"
              </blockquote>
            </div>

            <!-- Card 6: Ahmad Fauzi -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=120&q=80" alt="Ahmad Fauzi" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Ahmad Fauzi <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@fauzi_logistik</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "WMS Pergudangan yang dibuat SOLVETA sangat rapi. Laporan keluar masuk barang real-time dan barcode scanner-nya responsif."
              </blockquote>
            </div>

            <!-- Duplicate Set -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=120&q=80" alt="dr. Hendra" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    dr. Hendra <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@hendra.klinik</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Sistem rekam medis & reservasi klinik kami sekarang otomatis 100%. Pasien tidak perlu antre manual lagi. Terima kasih SOLVETA!"
              </blockquote>
            </div>
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=120&q=80" alt="Dewi A." class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Dewi A. <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@dewi_hijab</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Website e-commerce kami cepet banget loadingnya, pas promo live flash sale ribuan pengunjung tetep lancar tanpa down!"
              </blockquote>
            </div>
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=120&q=80" alt="Ahmad Fauzi" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Ahmad Fauzi <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@fauzi_logistik</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "WMS Pergudangan yang dibuat SOLVETA sangat rapi. Laporan keluar masuk barang real-time dan barcode scanner-nya responsif."
              </blockquote>
            </div>
          </div>
        </div>

        <!-- Column 3: Vertical Marquee (Downwards - Visible on md & up) -->
        <div class="marquee-column hidden md:flex flex-col overflow-hidden w-56 sm:w-64 h-[840px] shrink-0">
          <div class="flex flex-col gap-3.5 shrink-0 animate-marquee-v" style="--duration: 45s;">
            <!-- Card 7: Ir. Bambang -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=120&q=80" alt="Ir. Bambang" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Ir. Bambang W. <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@bambang_corp</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Implementasi ERP terpadu untuk keuangan dan pengadaan PO proyek selesai tepat waktu. Tim SOLVETA sangat profesional."
              </blockquote>
            </div>

            <!-- Card 8: Mba Zuhro (Komentar Gercep) -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Mba Zuhro" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Mba Zuhro <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@zuhro_official</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Okey siap mass. Maa syaa Allah BAGUS BANGETTT makasih bantuannya gercep banget! Nanti kami rekomendasikan terus ke mitra lain ya kak."
              </blockquote>
            </div>

            <!-- Card 9: Nadia Putri -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=120&q=80" alt="Nadia Putri" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Nadia Putri <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@nadiaputri_edu</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Platform LMS dan sertifikat otomatis untuk lembaga kursus kami berjalan mulus. Siswa dan tutor puas banget menggunakannya."
              </blockquote>
            </div>

            <!-- Duplicate Set -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=120&q=80" alt="Ir. Bambang" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Ir. Bambang W. <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@bambang_corp</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Implementasi ERP terpadu untuk keuangan dan pengadaan PO proyek selesai tepat waktu. Tim SOLVETA sangat profesional."
              </blockquote>
            </div>
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Mba Zuhro" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Mba Zuhro <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@zuhro_official</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Okey siap mass. Maa syaa Allah BAGUS BANGETTT makasih bantuannya gercep banget! Nanti kami rekomendasikan terus ke mitra lain ya kak."
              </blockquote>
            </div>
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=120&q=80" alt="Nadia Putri" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Nadia Putri <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@nadiaputri_edu</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Platform LMS dan sertifikat otomatis untuk lembaga kursus kami berjalan mulus. Siswa dan tutor puas banget menggunakannya."
              </blockquote>
            </div>
          </div>
        </div>

        <!-- Column 4: Vertical Marquee (Upwards / Reverse - Visible on lg & up) -->
        <div class="marquee-column hidden lg:flex flex-col overflow-hidden w-56 sm:w-64 h-[840px] shrink-0">
          <div class="flex flex-col gap-3.5 shrink-0 animate-marquee-v-reverse" style="--duration: 40s;">
            <!-- Card 10: Kevin Tan -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=120&q=80" alt="Kevin Tan" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Kevin Tan <span class="text-[10px]">🇸🇬</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@kevintan_tech</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Outstanding code quality, modern UI/UX and super communicative development team. Delivered our SaaS portal ahead of schedule."
              </blockquote>
            </div>

            <!-- Card 11: Mba Zuhro (Video Promosi) -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Mba Zuhro" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Mba Zuhro <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@zuhro_official</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Nanti kalau sah launching kami buat video promosi juga ya kak. Sukses terus buat seluruh tim rekayasa SOLVETA!"
              </blockquote>
            </div>

            <!-- Card 12: Mitra HIU Group -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=120&q=80" alt="Mitra HIU Group" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Mitra HIU Group <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@hiu_partner</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Digitalisasi katalog produk dan integrasi database mitra sangat memudahkan distribusi di seluruh Indonesia. Layanan jempolan!"
              </blockquote>
            </div>

            <!-- Duplicate Set -->
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=120&q=80" alt="Kevin Tan" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Kevin Tan <span class="text-[10px]">🇸🇬</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@kevintan_tech</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Outstanding code quality, modern UI/UX and super communicative development team. Delivered our SaaS portal ahead of schedule."
              </blockquote>
            </div>
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Mba Zuhro" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Mba Zuhro <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@zuhro_official</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Nanti kalau sah launching kami buat video promosi juga ya kak. Sukses terus buat seluruh tim rekayasa SOLVETA!"
              </blockquote>
            </div>
            <div class="p-4 rounded-2xl border border-black/[0.07] dark:border-white/10 bg-white dark:bg-[#1A1C22] shadow-sm hover:shadow-md transition">
              <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=120&q=80" alt="Mitra HIU Group" class="w-9 h-9 rounded-full object-cover border border-black/5">
                <div class="flex flex-col min-w-0">
                  <span class="text-xs font-bold text-[#111215] dark:text-white flex items-center gap-1">
                    Mitra HIU Group <span class="text-[10px]">🇮🇩</span>
                  </span>
                  <span class="text-[10px] text-neutral-400 font-sans">@hiu_partner</span>
                </div>
              </div>
              <blockquote class="mt-2.5 text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">
                "Digitalisasi katalog produk dan integrasi database mitra sangat memudahkan distribusi di seluruh Indonesia. Layanan jempolan!"
              </blockquote>
            </div>
          </div>
        </div>

      </div>

      <!-- Edge Gradient Overlays (4 directions: Top, Bottom, Left, Right — Seamless 3D Fade Illusion) -->
      <div class="pointer-events-none absolute inset-x-0 top-0 h-1/4 bg-gradient-to-b from-[#FAFAFC] dark:from-[#111215] to-transparent z-10"></div>
      <div class="pointer-events-none absolute inset-x-0 bottom-0 h-1/4 bg-gradient-to-t from-[#FAFAFC] dark:from-[#111215] to-transparent z-10"></div>
      <div class="pointer-events-none absolute inset-y-0 left-0 w-1/4 bg-gradient-to-r from-[#FAFAFC] dark:from-[#111215] to-transparent z-10"></div>
      <div class="pointer-events-none absolute inset-y-0 right-0 w-1/4 bg-gradient-to-l from-[#FAFAFC] dark:from-[#111215] to-transparent z-10"></div>

    </div>

  </div>
</section>

<!-- ========================================================================= -->
<!-- 8. PILIHAN PAKET & RINCIAN LENGKAP (Ringkasan 4 Paket Menuju /layanan)      -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-24 bg-[#FAFAFC] dark:bg-[#12131A] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-12">
    
    <div class="text-center max-w-2xl mx-auto space-y-2">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-red-50 dark:bg-neutral-900 border border-red-200 dark:border-neutral-800 text-[11px] font-bold text-[#C4264A] dark:text-[#F05A72] uppercase font-sans">
        PILIHAN PAKET &amp; RINCIAN LENGKAP
      </div>
      <h2 class="text-2xl sm:text-4xl font-extrabold text-[#111215] dark:text-white tracking-tight">
        PILIHAN PAKET LAYANAN WEBSITE
      </h2>
      <p class="text-xs sm:text-sm text-neutral-500">
        Solusi website lengkap dari profil pribadi hingga platform enterprise, transparan tanpa biaya tersembunyi.
      </p>
    </div>

    <?php
      $tierMap = [];
      if (!empty($tiers)) {
          foreach ($tiers as $t) {
              $tierMap[$t['id']] = $t;
          }
      }
      $starterPrice = !empty($tierMap['basic']['price']) ? $tierMap['basic']['price'] : 'Rp 249K';
      $starterRenewal = !empty($tierMap['basic']['renewal_price']) ? $tierMap['basic']['renewal_price'] : '199k/tahun*';

      $bisnisPrice = !empty($tierMap['standard']['price']) ? $tierMap['standard']['price'] : (!empty($tierMap['bisnis']['price']) ? $tierMap['bisnis']['price'] : 'Rp 599K');
      $bisnisRenewal = !empty($tierMap['standard']['renewal_price']) ? $tierMap['standard']['renewal_price'] : (!empty($tierMap['bisnis']['renewal_price']) ? $tierMap['bisnis']['renewal_price'] : '349k/tahun*');

      $rawCustomPrice = !empty($tierMap['custom']['price']) ? $tierMap['custom']['price'] : 'Menyesuaikan Kebutuhan';
      if (strpos($rawCustomPrice, '1.5') !== false) {
          $customPrice = 'Menyesuaikan Kebutuhan';
      } else {
          $customPrice = $rawCustomPrice;
      }

      $rawCustomRenewal = !empty($tierMap['custom']['renewal_price']) ? $tierMap['custom']['renewal_price'] : 'Mengikuti kompleksitas konsep & permintaan website yang dibutuhkan';
      if (strpos($rawCustomRenewal, '1.5') !== false) {
          $customRenewal = 'Mengikuti kompleksitas konsep & permintaan website yang dibutuhkan';
      } else {
          $customRenewal = $rawCustomRenewal;
      }
    ?>

    <!-- 3 Tiers Grid Summary (Starter, Bisnis, Custom) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 items-stretch">
      
      <!-- 1. Starter -->
      <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 shadow-sm flex flex-col justify-between hover:shadow-editorial hover:border-red-200 transition-all">
        <div class="space-y-4">
          <div>
            <span class="text-[10px] font-sans uppercase text-neutral-400 font-bold block">Landing Page &amp; Portofolio</span>
            <h3 class="text-xl font-bold text-[#111215] dark:text-white">Paket STARTER</h3>
            <div class="text-3xl font-black text-[#111215] dark:text-white mt-1"><?= esc($starterPrice) ?></div>
            <span class="text-[11px] text-neutral-400 font-sans block mt-0.5">Perpanjangan: <?= esc($starterRenewal) ?></span>
          </div>
          <p class="text-xs text-neutral-500 leading-relaxed">
            Cocok untuk kebutuhan pribadi, promosi UMKM, landing page produk tunggal, CV digital, &amp; portofolio profil.
          </p>
          <ul class="text-xs text-neutral-600 dark:text-neutral-400 space-y-2 pt-3 border-t border-[#E8E9ED] dark:border-neutral-800">
            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Free Domain &amp; Cloud Hosting 1 Tahun</li>
            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Tampilan Responsif Smartphone &amp; PC</li>
            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Integrasi Tombol Pesan WhatsApp Langsung</li>
            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Estimasi Pengerjaan Cepat 1-2 Hari</li>
          </ul>
        </div>
        <div class="pt-6">
          <a href="<?= base_url('layanan/starter') ?>" class="w-full py-3 px-4 rounded-xl text-xs font-bold text-center block bg-neutral-100 hover:bg-[#C4264A] hover:text-white dark:bg-neutral-800 dark:hover:bg-[#C4264A] transition shadow-xs">
            Lihat Rincian Starter &rarr;
          </a>
        </div>
      </div>

      <!-- 2. Bisnis (Sebelumnya Standard) - POPULAR -->
      <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-[#1A1C22] border-2 border-[#C4264A] shadow-editorial flex flex-col justify-between relative overflow-hidden">
        <div class="absolute top-0 right-0 bg-[#C4264A] text-white text-[9px] font-black uppercase tracking-wider px-3.5 py-1 rounded-bl-xl font-sans">
          POPULAR &bull; PALING DIPILIH ★
        </div>
        <div class="space-y-4">
          <div>
            <span class="text-[10px] font-sans uppercase text-[#C4264A] font-bold block">Company Profile &amp; Bisnis</span>
            <h3 class="text-xl font-bold text-[#111215] dark:text-white">Paket BISNIS</h3>
            <div class="text-3xl font-black text-[#C4264A] dark:text-[#F05A72] mt-1"><?= esc($bisnisPrice) ?></div>
            <span class="text-[11px] text-neutral-400 font-sans block mt-0.5">Perpanjangan: <?= esc($bisnisRenewal) ?></span>
          </div>
          <p class="text-xs text-neutral-500 leading-relaxed">
            Solusi terlengkap untuk profil perusahaan, CV, PT, instansi, home industry, portal berita, dan katalog produk modern.
          </p>
          <ul class="text-xs text-neutral-600 dark:text-neutral-400 space-y-2 pt-3 border-t border-[#E8E9ED] dark:border-neutral-800">
            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> 4 Halaman Lengkap (Beranda, Layanan, Portofolio, Kontak)</li>
            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Free Domain (.com / .id) &amp; Cloud Hosting Cepat</li>
            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> 1 Akun Email Bisnis Resmi (nama@domain.com)</li>
            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Optimasi SEO On-Page &amp; Integrasi Google Maps</li>
            <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#C4264A]"></i> Full Garansi Pemeliharaan Sistem</li>
          </ul>
        </div>
        <div class="pt-6">
          <a href="<?= base_url('layanan/bisnis') ?>" class="w-full py-3 px-4 rounded-xl text-xs font-bold text-center block bg-[#C4264A] hover:bg-[#8E1738] text-white shadow-md transition">
            Lihat Rincian Bisnis &rarr;
          </a>
        </div>
      </div>

      <!-- 3. Custom (Sebelumnya Platinum) -->
      <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 shadow-sm flex flex-col justify-between hover:shadow-editorial hover:border-red-200 transition-all">
        <div class="space-y-4">
          <div>
            <span class="text-[10px] font-sans uppercase text-neutral-400 font-bold block">Sistem Web &amp; Database Khusus</span>
            <h3 class="text-xl font-bold text-[#111215] dark:text-white">Paket CUSTOM</h3>
            <div class="text-2xl sm:text-3xl font-black text-[#111215] dark:text-white mt-1"><?= esc($customPrice) ?></div>
            <span class="text-[11px] text-neutral-500 dark:text-neutral-400 font-sans block mt-1 leading-snug"><?= esc($customRenewal) ?></span>
          </div>
          <p class="text-xs text-neutral-500 leading-relaxed">
            Untuk start-up, korporasi, toko online (e-commerce), booking jadwal, platform SaaS, dan otomasi alur kerja AI.
          </p>
          <ul class="text-xs text-neutral-600 dark:text-neutral-400 space-y-2 pt-3 border-t border-[#E8E9ED] dark:border-neutral-800">
            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Arsitektur Database &amp; API Kustom (Bebas Request)</li>
            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Integrasi Payment Gateway (QRIS, VA) &amp; Kurir</li>
            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Unlimited Akun Email Bisnis &amp; cPanel Penuh</li>
            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A]"></i> Hak Milik Source Code 100% Permanen Tanpa Sewa</li>
          </ul>
        </div>
        <div class="pt-6">
          <a href="<?= base_url('layanan/custom') ?>" class="w-full py-3 px-4 rounded-xl text-xs font-bold text-center block bg-neutral-100 hover:bg-[#C4264A] hover:text-white dark:bg-neutral-800 dark:hover:bg-[#C4264A] transition shadow-xs">
            Lihat Rincian Custom &rarr;
          </a>
        </div>
      </div>

    </div>

    <!-- Tambahan Layanan: Aplikasi Mobile & Desktop Instalasi Lokal (Harga Mengikuti Kebutuhan) -->
    <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-neutral-50 via-white to-red-50/40 dark:from-[#14151B] dark:via-[#161720] dark:to-[#1A151C] border border-[#E8E9ED] dark:border-neutral-800 shadow-sm relative overflow-hidden">
      <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 relative z-10">
        <div class="space-y-3 max-w-2xl">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-100 dark:bg-red-950/60 border border-red-200 dark:border-red-900/40 text-[11px] font-bold text-[#C4264A] dark:text-[#F05A72] font-sans">
            <i data-lucide="hard-drive" class="w-3.5 h-3.5"></i>
            <span>LAYANAN INSTALASI LOKAL &bull; ON-PREMISE &amp; OFFLINE-FIRST</span>
          </div>
          <h3 class="text-xl sm:text-2xl font-extrabold text-[#111215] dark:text-white tracking-tight">
            Pembuatan Aplikasi Mobile &amp; Desktop (Instalasi Lokal)
          </h3>
          <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
            Pengembangan software khusus untuk komputer desktop (Windows, macOS, Linux) dan perangkat mobile (Android &amp; iOS) yang dapat dipasang di server/jaringan lokal (LAN) kantor atau toko Anda. Tetap beroperasi optimal secara offline tanpa ketergantungan internet, dengan opsi sinkronisasi otomatis ke cloud.
          </p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pt-1 text-xs text-neutral-700 dark:text-neutral-300">
            <div class="flex items-center gap-2">
              <i data-lucide="check-circle" class="w-4 h-4 text-[#C4264A] shrink-0"></i>
              <span>Software Kasir (POS), Gudang &amp; Manajemen Internal</span>
            </div>
            <div class="flex items-center gap-2">
              <i data-lucide="check-circle" class="w-4 h-4 text-[#C4264A] shrink-0"></i>
              <span>Database Server Lokal (PostgreSQL / SQLite / MySQL)</span>
            </div>
            <div class="flex items-center gap-2">
              <i data-lucide="check-circle" class="w-4 h-4 text-[#C4264A] shrink-0"></i>
              <span>Hak Milik 100% Permanen Tanpa Sewa Bulanan</span>
            </div>
            <div class="flex items-center gap-2">
              <i data-lucide="check-circle" class="w-4 h-4 text-[#C4264A] shrink-0"></i>
              <span>Instalasi &amp; Pendampingan Training Sampai Siap Pakai</span>
            </div>
          </div>
        </div>

        <div class="w-full lg:w-auto shrink-0 flex flex-col items-start lg:items-end justify-center gap-3 pt-4 lg:pt-0 border-t lg:border-t-0 lg:border-l border-[#E8E9ED] dark:border-neutral-800 lg:pl-8">
          <div>
            <span class="text-[10px] uppercase font-bold text-neutral-400 font-sans block text-left lg:text-right">Estimasi Biaya</span>
            <div class="text-2xl sm:text-3xl font-black text-[#111215] dark:text-white">Harga Mengikuti Kebutuhan</div>
            <span class="text-[11px] text-neutral-500 block text-left lg:text-right font-sans">Sesuai skala sistem &amp; jumlah perangkat</span>
          </div>
          <div class="flex flex-col sm:flex-row gap-2.5 w-full sm:w-auto">
            <a href="<?= $waAppLokalUrl ?>" target="_blank" class="px-6 py-3 rounded-xl bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs font-bold transition flex items-center justify-center gap-2 shadow-md">
              <i data-lucide="message-circle" class="w-4 h-4"></i>
              <span>Konsultasi Aplikasi Lokal</span>
            </a>
            <button onclick="openConsultModal('Konsultasi Aplikasi Mobile/Desktop Instalasi Lokal')" class="px-5 py-3 rounded-xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-700 hover:border-[#C4264A] text-[#111215] dark:text-white text-xs font-semibold transition flex items-center justify-center gap-2">
              <span>Rinci Kebutuhan</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center pt-2">
      <a href="<?= base_url('layanan') ?>" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-[#C4264A] dark:text-[#F05A72] hover:underline">
        <span>Buka Katalog Layanan Lengkap, Paket Custom &amp; Add-ons</span>
        <i data-lucide="arrow-right" class="w-4 h-4"></i>
      </a>
    </div>

  </div>
</section>

<!-- ========================================================================= -->
<!-- 9. PERSPECTIVE TUNNEL EXPERIENCE (Soft-Selling Deep Psychological Journey) -->
<!-- Terinspirasi dari 21st.dev Perspective Tunnel Hero, Disesuaikan untuk SOLVETA -->
<!-- ========================================================================= -->
<section id="perspective-tunnel" class="py-16 sm:py-24 bg-[#FAFAFC] dark:bg-[#101116] font-sans border-b border-[#E8E9ED] dark:border-neutral-800 overflow-hidden relative">
  
  <!-- Subtle Tunnel Ambient Glow & Backdrop -->
  <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[720px] h-[360px] bg-[#C4264A]/10 blur-[90px] rounded-full pointer-events-none"></div>

  <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10 space-y-10">
    
    <!-- Section Header -->
    <div class="text-center max-w-3xl mx-auto space-y-3">
      <div class="inline-flex items-center gap-2 bg-white dark:bg-[#1A1C22] border border-red-200 dark:border-neutral-800 px-3.5 py-1.5 rounded-full text-xs font-semibold text-[#111215] dark:text-white shadow-xs">
        <span class="w-2 h-2 rounded-full bg-[#C4264A] animate-pulse"></span>
        <span class="font-sans text-[#C4264A] dark:text-[#F05A72] font-bold">PERSPECTIVE TUNNEL</span>
        <span class="text-neutral-300 dark:text-neutral-700">•</span>
        <span>Refleksi Kritis Operasional Bisnis</span>
      </div>

      <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#111215] dark:text-white tracking-tight leading-tight">
        Mungkin Hari Ini Bisnis Anda Berjalan Lancar. <br class="hidden sm:inline" />
        <span class="text-[#C4264A] dark:text-[#F05A72]">Tapi Pernahkah Anda Bertanya Diam-diam?</span>
      </h2>

      <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed font-sans max-w-2xl mx-auto">
        Jelajahi 5 sudut pandang operasional yang sering kali luput dari perhatian pemilik bisnis — hingga mereka menyadari betapa banyaknya potensi &amp; waktu yang diam-diam terbuang setiap harinya.
      </p>
    </div>

    <!-- 3D Spatial Perspective Tunnel Container -->
    <div id="tunnel-container" class="relative max-w-4xl mx-auto min-h-[580px] sm:min-h-[620px] flex flex-col items-center justify-center select-none">
      
      <!-- 3D Perspective Concentric Rings & Radial Glow in Background -->
      <div class="absolute inset-0 perspective-tunnel-stage flex items-center justify-center pointer-events-none overflow-hidden">
        <div class="absolute top-1/2 left-1/2 tunnel-ring-1"></div>
        <div class="absolute top-1/2 left-1/2 tunnel-ring-2"></div>
        <div class="absolute top-1/2 left-1/2 tunnel-ring-3"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-[#C4264A]/12 blur-3xl rounded-full"></div>
      </div>

      <!-- Perspective 3D Viewport -->
      <div id="tunnel-stage" class="perspective-tunnel-stage w-full relative z-10 flex items-center justify-center min-h-[460px]">
        <div id="tunnel-world" class="tunnel-world relative w-full max-w-2xl px-2 sm:px-4 flex items-center justify-center">

          <!-- CARD 01: WAKTU & EFISIENSI TIM -->
          <div class="tunnel-card absolute inset-x-2 sm:inset-x-4 bg-white/95 dark:bg-[#14151B]/95 backdrop-blur-xl rounded-[28px] p-6 sm:p-9 border border-black/10 dark:border-white/10 shadow-2xl text-left" data-index="0">
            <div class="flex items-center justify-between pb-4 border-b border-[#E8E9ED] dark:border-neutral-800">
              <div class="inline-flex items-center gap-2 text-xs font-sans font-bold text-[#C4264A] dark:text-[#F05A72]">
                <i data-lucide="clock" class="w-4 h-4"></i>
                <span>FASE 01 · WAKTU &amp; EFISIENSI TIM</span>
              </div>
              <span class="text-[11px] font-sans text-neutral-400">01 / 05</span>
            </div>

            <div class="mt-5 space-y-3.5">
              <h3 class="text-xl sm:text-2xl font-bold text-[#111215] dark:text-white leading-snug">
                Pernahkah Anda menghitung berapa jam waktu terbaik tim Anda habis hanya untuk mencocokkan laporan manual?
              </h3>
              <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed font-sans">
                Bisnis Anda mungkin terasa baik-baik saja hari ini karena tim Anda selalu sibuk. Staf mencatat, kasir melayani, dan penjualan tetap berjalan. Namun jika Anda perhatikan lebih dekat: ada jam-jam produktif yang hilang setiap sore hanya untuk mengetik ulang nota ke spreadsheet Excel, memeriksa bukti transfer bank satu per satu, dan mengejar rekonsiliasi stok gudang yang selisih beberapa angka.
              </p>
              <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed font-sans">
                Tim Anda tidak kurang rajin. Mereka hanya kekurangan sistem terintegrasi yang mampu menuntaskannya secara otomatis dalam 0.4 detik.
              </p>
            </div>

            <div class="mt-6 pt-4 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between">
              <div class="flex items-center gap-2 text-[11px] font-sans text-[#C4264A] dark:text-[#F05A72] font-semibold">
                <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                <span>Rata-rata 84 Jam/Bulan Habis untuk Input Manual Berulang</span>
              </div>
              <button onclick="nextTunnelCard()" class="text-xs font-bold text-neutral-500 hover:text-[#C4264A] flex items-center gap-1 transition cursor-pointer">
                <span>Lanjut</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
              </button>
            </div>
          </div>

          <!-- CARD 02: KECEPATAN KONVERSI WHATSAPP -->
          <div class="tunnel-card absolute inset-x-2 sm:inset-x-4 bg-white/95 dark:bg-[#14151B]/95 backdrop-blur-xl rounded-[28px] p-6 sm:p-9 border border-black/10 dark:border-white/10 shadow-2xl text-left" data-index="1">
            <div class="flex items-center justify-between pb-4 border-b border-[#E8E9ED] dark:border-neutral-800">
              <div class="inline-flex items-center gap-2 text-xs font-sans font-bold text-[#C4264A] dark:text-[#F05A72]">
                <i data-lucide="message-square" class="w-4 h-4"></i>
                <span>FASE 02 · KECEPATAN KONVERSI PROSPEK</span>
              </div>
              <span class="text-[11px] font-sans text-neutral-400">02 / 05</span>
            </div>

            <div class="mt-5 space-y-3.5">
              <h3 class="text-xl sm:text-2xl font-bold text-[#111215] dark:text-white leading-snug">
                Berapa banyak calon pembeli yang bertanya jam 9 malam, lalu diam-diam hilang saat dibalas besok pagi?
              </h3>
              <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed font-sans">
                Ketika calon pelanggan mengirim chat di luar jam kantor, mereka sedang berada di puncak minat beli dan siap bertransaksi. Menunggu balasan 8 hingga 12 jam kemudian sering kali membuat mereka sudah menyelesaikan pesanan di tempat kompetitor yang merespons dalam 30 detik.
              </p>
              <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed font-sans">
                Sistem follow-up dan otomasi WhatsApp pintar bukan untuk menggantikan keramahan interaksi manusia, melainkan mengamankan prospek panas sebelum minat beli mereka mendingin.
              </p>
            </div>

            <div class="mt-6 pt-4 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between">
              <div class="flex items-center gap-2 text-[11px] font-sans text-[#C4264A] dark:text-[#F05A72] font-semibold">
                <i data-lucide="zap" class="w-3.5 h-3.5"></i>
                <span>73% Pelanggan Memilih Bisnis yang Merespons Pertama</span>
              </div>
              <button onclick="nextTunnelCard()" class="text-xs font-bold text-neutral-500 hover:text-[#C4264A] flex items-center gap-1 transition cursor-pointer">
                <span>Lanjut</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
              </button>
            </div>
          </div>

          <!-- CARD 03: KEDAULATAN ASET DIGITAL -->
          <div class="tunnel-card absolute inset-x-2 sm:inset-x-4 bg-white/95 dark:bg-[#14151B]/95 backdrop-blur-xl rounded-[28px] p-6 sm:p-9 border border-black/10 dark:border-white/10 shadow-2xl text-left" data-index="2">
            <div class="flex items-center justify-between pb-4 border-b border-[#E8E9ED] dark:border-neutral-800">
              <div class="inline-flex items-center gap-2 text-xs font-sans font-bold text-[#C4264A] dark:text-[#F05A72]">
                <i data-lucide="shield" class="w-4 h-4"></i>
                <span>FASE 03 · KEDAULATAN ASET DIGITAL</span>
              </div>
              <span class="text-[11px] font-sans text-neutral-400">03 / 05</span>
            </div>

            <div class="mt-5 space-y-3.5">
              <h3 class="text-xl sm:text-2xl font-bold text-[#111215] dark:text-white leading-snug">
                Mengapa harus terus membayar sewa software bulanan yang fiturnya tidak pernah sesuai alur unik Anda?
              </h3>
              <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed font-sans">
                Awalnya berlangganan aplikasi terasa murah: beberapa ratus ribu per bulan. Lalu bertambah jumlah staf, bertambah cabang, dan bisnis Anda terkunci jutaan rupiah setiap bulan hanya untuk menyewa sistem milik orang lain. Saat Anda butuh fitur spesifik, vendor menolaknya karena template mereka kaku.
              </p>
              <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed font-sans">
                Membangun sistem dan aplikasi sendiri bukan soal gengsi — melainkan memastikan seluruh database, kode sumber, dan alur rahasia bisnis Anda 100% menjadi aset permanen milik Anda selamanya.
              </p>
            </div>

            <div class="mt-6 pt-4 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between">
              <div class="flex items-center gap-2 text-[11px] font-sans text-[#C4264A] dark:text-[#F05A72] font-semibold">
                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                <span>100% Hak Milik Permanen Tanpa Sewa Bulanan Pihak Ketiga</span>
              </div>
              <button onclick="nextTunnelCard()" class="text-xs font-bold text-neutral-500 hover:text-[#C4264A] flex items-center gap-1 transition cursor-pointer">
                <span>Lanjut</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
              </button>
            </div>
          </div>

          <!-- CARD 04: BEBAN MENTAL PEMILIK BISNIS -->
          <div class="tunnel-card absolute inset-x-2 sm:inset-x-4 bg-white/95 dark:bg-[#14151B]/95 backdrop-blur-xl rounded-[28px] p-6 sm:p-9 border border-black/10 dark:border-white/10 shadow-2xl text-left" data-index="3">
            <div class="flex items-center justify-between pb-4 border-b border-[#E8E9ED] dark:border-neutral-800">
              <div class="inline-flex items-center gap-2 text-xs font-sans font-bold text-[#C4264A] dark:text-[#F05A72]">
                <i data-lucide="user-check" class="w-4 h-4"></i>
                <span>FASE 04 · KEMANDIRIAN SISTEM OPERASIONAL</span>
              </div>
              <span class="text-[11px] font-sans text-neutral-400">04 / 05</span>
            </div>

            <div class="mt-5 space-y-3.5">
              <h3 class="text-xl sm:text-2xl font-bold text-[#111215] dark:text-white leading-snug">
                Apakah Anda mendirikan bisnis untuk menjadi orang yang paling tidak bisa beristirahat di dalamnya?
              </h3>
              <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed font-sans">
                Ketika setiap persetujuan harus menunggu Anda, ketika selisih kasir &amp; stok gudang membuat Anda tidak bisa tidur tenang, dan ketika Anda merasa cemas meninggalkan kantor bahkan untuk berlibur sejenak — bisnis Anda sebenarnya belum memiliki sistem; bisnis Anda sedang menyandera waktu Anda.
              </p>
              <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed font-sans">
                Teknologi rekayasa SOLVETA dibangun agar operasional berjalan rapi, transparan, dan terukur — dengan atau tanpa kehadiran fisik Anda setiap saat.
              </p>
            </div>

            <div class="mt-6 pt-4 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between">
              <div class="flex items-center gap-2 text-[11px] font-sans text-[#C4264A] dark:text-[#F05A72] font-semibold">
                <i data-lucide="activity" class="w-3.5 h-3.5"></i>
                <span>Sistem Otomatis = Ketenangan Pikiran &amp; Waktu Luang Anda</span>
              </div>
              <button onclick="nextTunnelCard()" class="text-xs font-bold text-neutral-500 hover:text-[#C4264A] flex items-center gap-1 transition cursor-pointer">
                <span>Lanjut</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
              </button>
            </div>
          </div>

          <!-- CARD 05: TITIK BALIK (THE REVELATION & INVITATION) -->
          <div class="tunnel-card absolute inset-x-2 sm:inset-x-4 bg-gradient-to-br from-white via-white to-red-50/70 dark:from-[#14151B] dark:via-[#14151B] dark:to-[#220B13] backdrop-blur-xl rounded-[28px] p-6 sm:p-9 border-2 border-[#C4264A]/60 shadow-2xl text-left" data-index="4">
            <div class="flex items-center justify-between pb-4 border-b border-[#E8E9ED] dark:border-neutral-800">
              <div class="inline-flex items-center gap-2 text-xs font-sans font-bold text-[#C4264A] dark:text-[#F05A72]">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                <span>FASE 05 · TITIK BALIK REKAYASA DIGITAL</span>
              </div>
              <span class="text-[11px] font-sans text-[#C4264A] dark:text-[#F05A72] font-bold">05 / 05 ★</span>
            </div>

            <div class="mt-5 space-y-3.5">
              <h3 class="text-xl sm:text-2xl font-bold text-[#111215] dark:text-white leading-snug">
                Anda mungkin belum merasa butuh sistem baru hari ini. <br class="hidden sm:inline" />
                <span class="text-[#C4264A] dark:text-[#F05A72]">Sampai Anda melihat bagaimana kompetitor diam-diam bergerak jauh lebih ringan.</span>
              </h3>
              <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed font-sans">
                Transformasi tidak pernah harus dimulai dari proyek raksasa yang membingungkan. Ia bisa dimulai dari hal paling sederhana: landing page yang membuat klien percaya, integrasi WhatsApp agar tidak ada prospek yang tercecer, atau kasir POS yang meniadakan selisih kas harian.
              </p>
              <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 leading-relaxed font-sans">
                Anda tidak harus memutuskan atau membeli apa pun sekarang. Mari duduk bersama dan memetakan di mana letak kebocoran operasional bisnis Anda — santai, gratis, rahasia, dan tanpa komitmen pembelian.
              </p>
            </div>

            <div class="mt-6 pt-5 border-t border-[#E8E9ED] dark:border-neutral-800 flex flex-col sm:flex-row items-center justify-between gap-3">
              <a href="<?= $waHeroUrl ?>" target="_blank" class="w-full sm:w-auto px-6 py-3 rounded-full bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs font-bold shadow-md transition flex items-center justify-center gap-2 cursor-pointer">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Diskusi Santai Kebutuhan Bisnis via WhatsApp</span>
                <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
              </a>
              <button onclick="setTunnelCard(0)" class="text-xs font-semibold text-neutral-500 hover:text-[#C4264A] transition cursor-pointer flex items-center gap-1">
                <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                <span>Ulangi dari Awal</span>
              </button>
            </div>
          </div>

        </div>
      </div>

      <!-- Perspective Tunnel Controller & Milestones -->
      <div class="relative z-20 mt-8 w-full max-w-xl mx-auto flex flex-col items-center gap-4 px-4">
        
        <!-- Milestone Pills -->
        <div class="flex items-center justify-center gap-1.5 sm:gap-2 w-full">
          <button onclick="setTunnelCard(0)" class="tunnel-step-btn px-3 py-1.5 rounded-full text-xs font-sans font-bold transition flex items-center gap-1.5 cursor-pointer bg-[#C4264A] text-white shadow-xs" data-step="0">
            <span>01</span>
            <span class="hidden sm:inline font-sans text-[11px] font-normal">Waktu</span>
          </button>
          <button onclick="setTunnelCard(1)" class="tunnel-step-btn px-3 py-1.5 rounded-full text-xs font-sans font-bold transition flex items-center gap-1.5 cursor-pointer bg-white dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 border border-[#E8E9ED] dark:border-neutral-700" data-step="1">
            <span>02</span>
            <span class="hidden sm:inline font-sans text-[11px] font-normal">Peluang</span>
          </button>
          <button onclick="setTunnelCard(2)" class="tunnel-step-btn px-3 py-1.5 rounded-full text-xs font-sans font-bold transition flex items-center gap-1.5 cursor-pointer bg-white dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 border border-[#E8E9ED] dark:border-neutral-700" data-step="2">
            <span>03</span>
            <span class="hidden sm:inline font-sans text-[11px] font-normal">Kedaulatan</span>
          </button>
          <button onclick="setTunnelCard(3)" class="tunnel-step-btn px-3 py-1.5 rounded-full text-xs font-sans font-bold transition flex items-center gap-1.5 cursor-pointer bg-white dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 border border-[#E8E9ED] dark:border-neutral-700" data-step="3">
            <span>04</span>
            <span class="hidden sm:inline font-sans text-[11px] font-normal">Beban</span>
          </button>
          <button onclick="setTunnelCard(4)" class="tunnel-step-btn px-3 py-1.5 rounded-full text-xs font-sans font-bold transition flex items-center gap-1.5 cursor-pointer bg-white dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 border border-[#E8E9ED] dark:border-neutral-700" data-step="4">
            <span>05</span>
            <span class="hidden sm:inline font-sans text-[11px] font-normal">Solusi</span>
          </button>
        </div>

        <!-- Navigation Arrows & Controls -->
        <div class="flex items-center justify-between w-full pt-2">
          <button onclick="prevTunnelCard()" class="px-4 py-2 rounded-full bg-white dark:bg-neutral-800 hover:bg-neutral-100 dark:hover:bg-neutral-700 text-xs font-semibold text-[#111215] dark:text-white border border-[#E8E9ED] dark:border-neutral-700 flex items-center gap-1.5 transition cursor-pointer shadow-xs">
            <i data-lucide="chevron-left" class="w-4 h-4 text-[#C4264A]"></i>
            <span>Sebelumnya</span>
          </button>

          <div class="flex items-center gap-2 text-xs font-sans text-neutral-500">
            <span id="tunnel-current-num" class="text-[#111215] dark:text-white font-bold">1</span>
            <span>/</span>
            <span>5</span>
          </div>

          <button onclick="nextTunnelCard()" class="px-4 py-2 rounded-full bg-[#C4264A] hover:bg-[#8E1738] text-xs font-semibold text-white flex items-center gap-1.5 transition cursor-pointer shadow-xs">
            <span>Selanjutnya</span>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
          </button>
        </div>

      </div>

    </div>

  </div>
</section>

<!-- ========================================================================= -->
<!-- 10. CTA KONSULTASI ADMIN ZAHRA                                            -->
<!-- ========================================================================= -->
<section id="kontak" class="py-16 sm:py-20 bg-white dark:bg-[#0E0F12] font-sans">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <div class="rounded-3xl border border-red-200 dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] p-8 sm:p-12 flex flex-col md:flex-row items-center justify-between gap-8 shadow-sm">
      
      <div class="flex items-center gap-5">
        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden shrink-0 border-2 border-[#C4264A] shadow-md">
          <img src="<?= base_url('images/cs-zahra.jpg') ?>" alt="Admin Zahra" class="w-full h-full object-cover object-top">
        </div>
        <div class="space-y-1">
          <div class="inline-flex items-center gap-1.5 text-[10px] font-sans uppercase tracking-wider text-emerald-600 dark:text-emerald-400 font-bold">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Live Verified Support (&lt; 5 Menit)</span>
          </div>
          <h3 class="text-xl sm:text-2xl font-extrabold text-[#111215] dark:text-white">
            Konsultasi Langsung Bersama Admin Zahra
          </h3>
          <p class="text-xs text-neutral-500">
            Lead Customer Service &amp; Project Coordinator Resmi SOLVETA • Jam Kerja: 08:00 – 21:00 WIB
          </p>
        </div>
      </div>

      <div class="shrink-0 w-full md:w-auto">
        <a href="<?= $waHeroUrl ?>" target="_blank"
           class="w-full md:w-auto px-8 py-4 rounded-full text-xs sm:text-sm font-bold text-white bg-[#C4264A] hover:bg-[#8E1738] shadow-lg shadow-red-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
          <i data-lucide="message-circle" class="w-4 h-4"></i>
          <span>Konsultasi via WhatsApp</span>
          <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
        </a>
      </div>

    </div>
  </div>
</section>

<!-- ========================================================================= -->
<!-- MODAL: KONSULTASI CEPAT                                                   -->
<!-- ========================================================================= -->
<div id="consult-modal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
  <div class="bg-white dark:bg-[#1A1C22] rounded-3xl max-w-md w-full p-6 sm:p-8 space-y-6 shadow-2xl border border-black/10 dark:border-white/10 relative">
    
    <button onclick="closeConsultModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-white flex items-center justify-center hover:bg-neutral-200 transition">
      <i data-lucide="x" class="w-4 h-4"></i>
    </button>

    <div class="space-y-1">
      <span class="text-[10px] font-sans text-[#C4264A] font-bold uppercase">KONSULTASI PRIORITAS</span>
      <h3 class="text-xl font-bold text-[#111215] dark:text-white">Mulai Diskusi Proyek</h3>
      <p class="text-xs text-neutral-500">Isi singkat di bawah untuk terhubung ke WhatsApp CS Zahra:</p>
    </div>

    <form onsubmit="submitConsultForm(event)" class="space-y-4">
      <div class="space-y-1">
        <label class="text-[11px] font-bold text-neutral-700 dark:text-neutral-300 font-sans">Nama / Perusahaan</label>
        <input type="text" id="consult-name-input" required placeholder="Nama Anda atau PT/CV" class="w-full px-3.5 py-2.5 rounded-xl border border-black/10 dark:border-white/10 bg-transparent text-xs text-[#111215] dark:text-white focus:outline-none focus:ring-2 focus:ring-[#C4264A]">
      </div>
      <div class="space-y-1">
        <label class="text-[11px] font-bold text-neutral-700 dark:text-neutral-300 font-sans">Nomor WhatsApp</label>
        <input type="tel" id="consult-contact-input" required placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-black/10 dark:border-white/10 bg-transparent text-xs text-[#111215] dark:text-white focus:outline-none focus:ring-2 focus:ring-[#C4264A]">
      </div>
      <div class="space-y-1">
        <label class="text-[11px] font-bold text-neutral-700 dark:text-neutral-300 font-sans">Kebutuhan Solusi</label>
        <input type="text" id="consult-topic-input" required placeholder="Contoh: Website Paket Standard / Sistem POS" class="w-full px-3.5 py-2.5 rounded-xl border border-black/10 dark:border-white/10 bg-transparent text-xs text-[#111215] dark:text-white focus:outline-none focus:ring-2 focus:ring-[#C4264A]">
      </div>
      
      <div id="consult-success-msg" class="hidden text-xs text-emerald-600 bg-emerald-50 dark:bg-emerald-950/40 p-2.5 rounded-xl font-medium">
        Menghubungkan ke WhatsApp CS Zahra...
      </div>

      <button type="submit" class="w-full py-3 rounded-xl bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs font-bold transition flex items-center justify-center gap-2 cursor-pointer shadow-sm">
        <i data-lucide="send" class="w-3.5 h-3.5"></i>
        <span>Kirim via WhatsApp</span>
      </button>
    </form>

  </div>
</div>

<!-- ========================================================================= -->
<!-- JAVASCRIPT LOGIC                                                          -->
<!-- ========================================================================= -->
<script>
  function handleHeroSearch() {
    const input = document.getElementById('hero-solution-input');
    const val = input.value.trim();
    if (val) {
      openConsultModal(val);
    } else {
      input.focus();
    }
  }

  function setHeroSearch(val) {
    const input = document.getElementById('hero-solution-input');
    if (input) {
      input.value = val;
      handleHeroSearch();
    }
  }

  function toggleProblemView(mode) {
    const probLists = document.querySelectorAll('.problem-list');
    const solLists = document.querySelectorAll('.solution-list');
    const btnProb = document.getElementById('tab-problem-btn');
    const btnSol = document.getElementById('tab-solution-btn');

    if (mode === 'solution') {
      probLists.forEach(el => el.classList.add('hidden'));
      solLists.forEach(el => el.classList.remove('hidden'));
      btnSol.className = 'px-4 py-2 rounded-full bg-[#C4264A] text-white text-xs font-semibold transition flex items-center gap-1.5 cursor-pointer';
      btnProb.className = 'px-4 py-2 rounded-full text-neutral-600 dark:text-neutral-400 hover:text-[#111215] text-xs font-semibold transition flex items-center gap-1.5 cursor-pointer';
    } else {
      solLists.forEach(el => el.classList.add('hidden'));
      probLists.forEach(el => el.classList.remove('hidden'));
      btnProb.className = 'px-4 py-2 rounded-full bg-[#111215] text-white text-xs font-semibold transition flex items-center gap-1.5 cursor-pointer';
      btnSol.className = 'px-4 py-2 rounded-full text-neutral-600 dark:text-neutral-400 hover:text-[#111215] text-xs font-semibold transition flex items-center gap-1.5 cursor-pointer';
    }
  }

  function filterSystems(category) {
    const cards = document.querySelectorAll('.system-card');
    const buttons = document.querySelectorAll('.sys-filter-btn');

    buttons.forEach(btn => {
      if (btn.getAttribute('data-filter') === category) {
        btn.className = 'sys-filter-btn shrink-0 px-4 py-2 rounded-full bg-[#C4264A] text-white text-xs font-semibold shadow-xs transition flex items-center gap-1.5 cursor-pointer';
      } else {
        btn.className = 'sys-filter-btn shrink-0 px-4 py-2 rounded-full bg-white dark:bg-[#1A1C22] hover:bg-neutral-100 text-[#111215] dark:text-white text-xs font-semibold border border-[#E8E9ED] dark:border-neutral-800 transition flex items-center gap-1.5 cursor-pointer';
      }
    });

    cards.forEach(card => {
      const cardCat = card.getAttribute('data-category');
      if (category === 'all' || cardCat === category) {
        card.classList.remove('hidden');
      } else {
        card.classList.add('hidden');
      }
    });
  }

  function openConsultModal(topic) {
    document.getElementById('consult-modal').classList.remove('hidden');
    document.getElementById('consult-success-msg').classList.add('hidden');
    if (topic) {
      document.getElementById('consult-topic-input').value = topic;
    }
  }

  function closeConsultModal() {
    document.getElementById('consult-modal').classList.add('hidden');
  }

  function submitConsultForm(e) {
    e.preventDefault();
    const name = document.getElementById('consult-name-input').value.trim();
    const contact = document.getElementById('consult-contact-input').value.trim();
    const topic = document.getElementById('consult-topic-input').value.trim();
    
    document.getElementById('consult-success-msg').classList.remove('hidden');
    
    const waNumber = '<?= $waClean ?>';
    const msg = "*KONSULTASI PRIORITAS SOLVETA*\n" +
                "━━━━━━━━━━━━━━━━━━━━\n" +
                "• *Nama/Perusahaan:* " + name + "\n" +
                "• *Nomor Kontak:* " + contact + "\n" +
                "• *Kebutuhan Solusi:* " + topic + "\n" +
                "━━━━━━━━━━━━━━━━━━━━\n" +
                "_Dikirim dari Beranda solveta.asia_";
    
    setTimeout(() => {
      window.open("https://wa.me/" + waNumber + "?text=" + encodeURIComponent(msg), "_blank");
      closeConsultModal();
    }, 800);
  }

  /* ========================================================================= */
  /* 3D PERSPECTIVE TUNNEL LOGIC (Spatial Z-Axis Fly-Through & Soft Selling)   */
  /* ========================================================================= */
  let currentTunnelIndex = 0;
  const totalTunnelCards = 5;

  function updateTunnelView() {
    const cards = document.querySelectorAll('.tunnel-card');
    const stepBtns = document.querySelectorAll('.tunnel-step-btn');
    const numDisplay = document.getElementById('tunnel-current-num');

    cards.forEach((card, idx) => {
      const diff = idx - currentTunnelIndex;

      if (diff === 0) {
        // Active in focus
        card.style.transform = 'translate3d(0, 0, 0px) scale(1) rotateX(0deg)';
        card.style.opacity = '1';
        card.style.zIndex = '30';
        card.style.pointerEvents = 'auto';
        card.style.filter = 'blur(0px)';
      } else if (diff === 1) {
        // One step behind in tunnel
        card.style.transform = 'translate3d(0, 35px, -220px) scale(0.9) rotateX(4deg)';
        card.style.opacity = '0.55';
        card.style.zIndex = '20';
        card.style.pointerEvents = 'none';
        card.style.filter = 'blur(1.5px)';
      } else if (diff === 2) {
        // Two steps behind in tunnel
        card.style.transform = 'translate3d(0, 65px, -440px) scale(0.8) rotateX(7deg)';
        card.style.opacity = '0.25';
        card.style.zIndex = '10';
        card.style.pointerEvents = 'none';
        card.style.filter = 'blur(3px)';
      } else if (diff > 2) {
        // Deep in horizon
        card.style.transform = 'translate3d(0, 90px, -660px) scale(0.7) rotateX(10deg)';
        card.style.opacity = '0';
        card.style.zIndex = '5';
        card.style.pointerEvents = 'none';
        card.style.filter = 'blur(5px)';
      } else if (diff === -1) {
        // Just flew past camera
        card.style.transform = 'translate3d(0, -60px, 200px) scale(1.15) rotateX(-5deg)';
        card.style.opacity = '0';
        card.style.zIndex = '40';
        card.style.pointerEvents = 'none';
        card.style.filter = 'blur(4px)';
      } else {
        // Far past
        card.style.transform = 'translate3d(0, -120px, 400px) scale(1.3) rotateX(-10deg)';
        card.style.opacity = '0';
        card.style.zIndex = '50';
        card.style.pointerEvents = 'none';
        card.style.filter = 'blur(8px)';
      }
    });

    stepBtns.forEach((btn, idx) => {
      if (idx === currentTunnelIndex) {
        btn.className = 'tunnel-step-btn px-3 py-1.5 rounded-full text-xs font-sans font-bold transition flex items-center gap-1.5 cursor-pointer bg-[#C4264A] text-white shadow-xs';
      } else {
        btn.className = 'tunnel-step-btn px-3 py-1.5 rounded-full text-xs font-sans font-bold transition flex items-center gap-1.5 cursor-pointer bg-white dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 border border-[#E8E9ED] dark:border-neutral-700';
      }
    });

    if (numDisplay) {
      numDisplay.textContent = currentTunnelIndex + 1;
    }
  }

  function setTunnelCard(idx) {
    if (idx >= 0 && idx < totalTunnelCards) {
      currentTunnelIndex = idx;
      updateTunnelView();
    }
  }

  function nextTunnelCard() {
    if (currentTunnelIndex < totalTunnelCards - 1) {
      currentTunnelIndex++;
    } else {
      currentTunnelIndex = 0;
    }
    updateTunnelView();
  }

  function prevTunnelCard() {
    if (currentTunnelIndex > 0) {
      currentTunnelIndex--;
    } else {
      currentTunnelIndex = totalTunnelCards - 1;
    }
    updateTunnelView();
  }

  // Interactive 3D Cursor Tilt & Touch Swipes
  document.addEventListener('DOMContentLoaded', () => {
    updateTunnelView();

    const tContainer = document.getElementById('tunnel-container');
    const tWorld = document.getElementById('tunnel-world');

    if (tContainer && tWorld) {
      tContainer.addEventListener('mousemove', (e) => {
        const rect = tContainer.getBoundingClientRect();
        const x = (e.clientX - rect.left - rect.width / 2) / (rect.width / 2);
        const y = (e.clientY - rect.top - rect.height / 2) / (rect.height / 2);
        tWorld.style.transform = `rotateY(${x * 6}deg) rotateX(${-y * 5}deg)`;
      });

      tContainer.addEventListener('mouseleave', () => {
        tWorld.style.transform = 'rotateY(0deg) rotateX(0deg)';
      });

      // Mobile Touch Swipes
      let touchStartX = 0;
      tContainer.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
      }, { passive: true });

      tContainer.addEventListener('touchend', (e) => {
        const touchEndX = e.changedTouches[0].clientX;
        const diffX = touchEndX - touchStartX;
        if (Math.abs(diffX) > 40) {
          if (diffX < 0) {
            nextTunnelCard();
          } else {
            prevTunnelCard();
          }
        }
      }, { passive: true });
    }
  });
</script>

<?= $this->endSection() ?>
