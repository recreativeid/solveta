<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
    $waGeneral = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo SOLVETA, saya membaca artikel di website Anda dan ingin berdiskusi mengenai solusi teknologi untuk bisnis kami.");
?>

<!-- ========================================================================= -->
<!-- 1. HERO HEADER — Clean White & Red High Contrast (Font Inter, SaaS)        -->
<!-- ========================================================================= -->
<section class="clean-hero-header pt-28 sm:pt-36 pb-16 sm:pb-24 border-b border-[#E8E9ED] dark:border-neutral-800 font-sans relative overflow-hidden">
    <!-- Subtle Dotted Grid Background -->
    <div class="absolute inset-0 bg-grid-dots opacity-35 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 space-y-6 text-center">
        
        <!-- Eyebrow Pill Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white text-xs font-semibold shadow-xs">
            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
            <span class="font-bold tracking-wider uppercase font-sans">WAWASAN &amp; ARTIKEL RESMI • SOLVETA</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.12] drop-shadow-none">
            Wawasan Teknologi &amp; <br class="hidden sm:inline">
            <span class="text-white">Strategi Pertumbuhan Bisnis</span>
        </h1>

        <!-- Subtitle -->
        <p class="text-sm sm:text-base md:text-lg text-white/90 leading-relaxed max-w-2xl mx-auto drop-shadow-none">
            Panduan praktis, analisis arsitektur sistem, dan wawasan industri digital yang dirancang untuk membantu bisnis berkembang tanpa kerumitan teknis.
        </p>

        <!-- Search Form -->
        <form action="<?= base_url('artikel') ?>" method="GET" class="max-w-xl mx-auto relative pt-2">
            <div class="relative flex items-center bg-white dark:bg-[#1A1C22] rounded-full p-2 pl-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-sm focus-within:ring-2 focus-within:ring-[#C4264A]/30 transition-all">
                <div class="pr-2 text-neutral-400 shrink-0">
                    <i data-lucide="search" class="w-4 h-4 text-[#C4264A]"></i>
                </div>
                <input type="text" name="q" value="<?= esc($search_query ?? '') ?>" 
                       placeholder="Cari artikel, topik sistem, atau kata kunci..." 
                       class="w-full py-2 px-1 text-xs sm:text-sm text-[#111215] dark:text-white placeholder:text-neutral-400 outline-none bg-transparent font-medium">
                <button type="submit" 
                        class="px-5 py-2.5 rounded-full bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs font-bold transition flex items-center gap-1.5 shrink-0 shadow-sm cursor-pointer"
                        title="Cari Artikel">
                    <span>Cari</span>
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                </button>
            </div>
            <?php if (!empty($current_category) && $current_category !== 'all'): ?>
                <input type="hidden" name="kategori" value="<?= esc($current_category) ?>">
            <?php endif; ?>
        </form>
        </form>

        <!-- Category Filter Pills -->
        <?php
            $categories = [
                'all' => 'Semua Topik',
                'website-saas' => 'Website & SaaS',
                'tips-teknologi' => 'Tips Teknologi',
                'transformasi-digital' => 'Transformasi Digital',
                'ui-ux-architecture' => 'UI/UX Architecture',
            ];
        ?>
        <div class="flex flex-wrap items-center justify-center gap-2 pt-2">
            <?php foreach ($categories as $catSlug => $catLabel): ?>
                <?php $isActive = ($current_category ?? 'all') === $catSlug; ?>
                <a href="<?= base_url('artikel' . ($catSlug === 'all' ? '' : '?kategori=' . $catSlug)) ?>" 
                   class="px-4 py-2 rounded-full text-xs font-semibold transition-all <?= $isActive ? 'bg-[#8E1738] text-white shadow-md' : 'bg-white/90 text-gray-800 border border-gray-200 hover:border-[#8E1738] hover:text-[#8E1738] shadow-xs' ?>">
                    <?= esc($catLabel) ?>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>
        ?>
        <div class="flex flex-wrap items-center justify-center gap-2">
            <?php foreach ($categories as $catKey => $catLabel): ?>
                <?php 
                    $isActive = ($current_category === $catKey) || (empty($current_category) && $catKey === 'all');
                    $filterUrl = $catKey === 'all' ? base_url('artikel') : base_url('artikel?kategori=' . $catKey);
                    if (!empty($search_query)) {
                        $filterUrl .= ($catKey === 'all' ? '?q=' : '&q=') . urlencode($search_query);
                    }
                ?>
                <a href="<?= $filterUrl ?>" 
                   class="px-4 py-1.5 rounded-full text-xs transition-all <?= $isActive ? 'bg-[#8E1738] text-white font-bold shadow-xs' : 'bg-white dark:bg-neutral-900 text-[#737780] dark:text-neutral-400 border border-[#E8E9ED] dark:border-neutral-800 hover:border-[#8E1738] hover:text-[#171717]' ?>">
                    <?= esc($catLabel) ?>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 2. ARTICLES LISTING GRID — Clean & Spacious                              -->
<!-- ========================================================================= -->
<section class="py-12 sm:py-20 bg-white dark:bg-[#121214] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php if (!empty($articles)): ?>
            
            <!-- Featured Top Article (If on first page with no search) -->
            <?php if (empty($search_query) && ($current_category === 'all' || empty($current_category)) && count($articles) > 0): ?>
                <?php $featured = $articles[0]; ?>
                <div class="mb-12 rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#171717] overflow-hidden shadow-clean hover:shadow-card-hover transition-all group">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
                        <div class="lg:col-span-7 h-64 sm:h-80 lg:h-auto overflow-hidden relative bg-neutral-100 dark:bg-neutral-900">
                            <img src="<?= esc($featured['image_url'] ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80') ?>" 
                                 alt="<?= esc($featured['title']) ?>" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#8E1738] text-white uppercase tracking-wider shadow-xs">
                                    ARTIKEL UTAMA
                                </span>
                            </div>
                        </div>
                        <div class="lg:col-span-5 p-6 sm:p-10 flex flex-col justify-between space-y-6">
                            <div class="space-y-3">
                                <div class="flex items-center gap-2 text-[11px] font-medium text-[#737780] dark:text-neutral-400">
                                    <span class="text-[#8E1738] dark:text-[#F05A72] font-bold uppercase tracking-wider"><?= esc($featured['category'] ?? 'Wawasan') ?></span>
                                    <span>•</span>
                                    <span><?= esc($featured['read_time'] ?? '5 min baca') ?></span>
                                    <span>•</span>
                                    <span><?= date('d M Y', strtotime($featured['created_at'] ?? 'now')) ?></span>
                                </div>
                                <h2 class="text-xl sm:text-2xl font-bold text-[#171717] dark:text-white group-hover:text-[#8E1738] dark:group-hover:text-[#F05A72] transition-colors leading-snug">
                                    <a href="<?= base_url('artikel/' . $featured['slug']) ?>">
                                        <?= esc($featured['title']) ?>
                                    </a>
                                </h2>
                                <p class="text-xs sm:text-sm text-[#737780] dark:text-neutral-400 leading-relaxed line-clamp-3">
                                    <?= esc($featured['summary']) ?>
                                </p>
                            </div>
                            <div class="pt-4 border-t border-[#E8E9ED] dark:border-neutral-800 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-red-100 text-[#8E1738] font-bold text-xs flex items-center justify-center">
                                        ST
                                    </div>
                                    <span class="text-xs font-semibold text-[#171717] dark:text-white">
                                        <?= esc($featured['author'] ?? 'Tim SOLVETA') ?>
                                    </span>
                                </div>
                                <a href="<?= base_url('artikel/' . $featured['slug']) ?>" 
                                   class="inline-flex items-center gap-1.5 text-xs font-bold text-[#8E1738] dark:text-[#F05A72] hover:underline">
                                    <span>Baca Artikel</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Grid Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <?php 
                    $gridItems = (empty($search_query) && ($current_category === 'all' || empty($current_category))) 
                        ? array_slice($articles, 1) 
                        : $articles;
                ?>

                <?php foreach ($gridItems as $item): ?>
                    <article class="rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#171717] overflow-hidden shadow-clean hover:shadow-card-hover transition-all flex flex-col justify-between group">
                        <div>
                            <!-- Article Thumbnail -->
                            <a href="<?= base_url('artikel/' . $item['slug']) ?>" class="block h-48 sm:h-52 overflow-hidden relative bg-neutral-100 dark:bg-neutral-900 border-b border-[#E8E9ED] dark:border-neutral-800">
                                <img src="<?= esc($item['image_url'] ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80') ?>" 
                                     alt="<?= esc($item['title']) ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-white/95 dark:bg-neutral-900/95 text-[#171717] dark:text-white uppercase tracking-wider shadow-xs border border-black/5 dark:border-white/10">
                                        <?= esc($item['category'] ?? 'Wawasan') ?>
                                    </span>
                                </div>
                            </a>

                            <!-- Article Content -->
                            <div class="p-5 sm:p-6 space-y-3">
                                <div class="flex items-center gap-2 text-[11px] text-[#737780] dark:text-neutral-400 font-medium">
                                    <span><?= esc($item['read_time'] ?? '4 min baca') ?></span>
                                    <span>•</span>
                                    <span><?= date('d M Y', strtotime($item['created_at'] ?? 'now')) ?></span>
                                </div>

                                <h3 class="text-base font-bold text-[#171717] dark:text-white group-hover:text-[#8E1738] dark:group-hover:text-[#F05A72] transition-colors leading-snug">
                                    <a href="<?= base_url('artikel/' . $item['slug']) ?>">
                                        <?= esc($item['title']) ?>
                                    </a>
                                </h3>

                                <p class="text-xs text-[#737780] dark:text-neutral-400 leading-relaxed line-clamp-2">
                                    <?= esc($item['summary']) ?>
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="p-5 sm:p-6 pt-0 border-t border-transparent flex items-center justify-between text-xs">
                            <span class="text-[11px] text-[#737780] dark:text-neutral-400">
                                Oleh <b><?= esc($item['author'] ?? 'Tim SOLVETA') ?></b>
                            </span>
                            <a href="<?= base_url('artikel/' . $item['slug']) ?>" 
                               class="font-bold text-[#8E1738] dark:text-[#F05A72] hover:underline flex items-center gap-1">
                                <span>Baca</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <!-- Empty State -->
            <div class="text-center py-20 space-y-4">
                <div class="w-12 h-12 rounded-full bg-red-50 text-[#8E1738] flex items-center justify-center mx-auto">
                    <i data-lucide="file-search" class="w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-bold text-[#171717] dark:text-white">Tidak ada artikel yang sesuai</h3>
                <p class="text-xs text-[#737780] max-w-sm mx-auto">
                    Coba ubah kata kunci pencarian atau pilih kategori topik yang berbeda.
                </p>
                <div class="pt-2">
                    <a href="<?= base_url('artikel') ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-white bg-[#8E1738]">
                        Lihat Semua Artikel
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 3. BOTTOM CTA BANNER — Minimalist Red-Maroon Gradient                      -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-24 bg-white dark:bg-[#171717] font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl gradient-hero text-white p-8 sm:p-14 shadow-editorial">
            <div class="relative z-10 space-y-4 max-w-2xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-white text-[11px] font-bold tracking-wider uppercase">
                    KONSULTASI SOLUSI DIGITAL
                </span>
                <h2 class="text-2xl sm:text-4xl font-black tracking-tight leading-tight text-white">
                    Punya Ide atau Masalah Teknologi yang Ingin Didiskusikan?
                </h2>
                <p class="text-xs sm:text-sm text-white/90 leading-relaxed">
                    Diskusikan rancangan arsitektur web, sistem operasional bisnis, atau otomatisasi langsung bersama tim konsultan teknologi SOLVETA.
                </p>
                <div class="pt-4 flex flex-col sm:flex-row items-center gap-3">
                    <a href="<?= $waGeneral ?>" target="_blank" rel="noopener noreferrer"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white hover:bg-neutral-50 text-[#171717] font-bold text-xs sm:text-sm shadow-md transition-all active:scale-95">
                        <i data-lucide="message-circle" class="w-4 h-4 text-[#C4264A]"></i>
                        <span>Diskusi via WhatsApp</span>
                    </a>
                    <a href="<?= base_url('kontak') ?>"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#76152F]/70 hover:bg-[#76152F] border border-white/25 text-white font-bold text-xs sm:text-sm transition-all active:scale-95">
                        <span>Isi Form Brief Proyek</span>
                        <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

