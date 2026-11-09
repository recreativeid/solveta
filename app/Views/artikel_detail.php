<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);

    $articleUrl = base_url('artikel/' . $article['slug']);
    $waShareUrl = "https://wa.me/?text=" . rawurlencode($article['title'] . " " . $articleUrl);
    $linkedinShareUrl = "https://www.linkedin.com/sharing/share-offsite/?url=" . urlencode($articleUrl);
    $waDiscussUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo SOLVETA, saya membaca artikel '{$article['title']}' dan ingin berkonsultasi mengenai solusi serupa untuk bisnis kami.");
?>

<!-- JSON-LD SEO Structured Data for Google Indexing -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": <?= json_encode($article['title']) ?>,
  "description": <?= json_encode($article['summary'] ?? '') ?>,
  "image": [
    <?= json_encode($article['image_url'] ?? '') ?>
  ],
  "datePublished": <?= json_encode(date('c', strtotime($article['created_at'] ?? 'now'))) ?>,
  "dateModified": <?= json_encode(date('c', strtotime($article['created_at'] ?? 'now'))) ?>,
  "author": [{
      "@type": "Organization",
      "name": <?= json_encode($article['author'] ?? 'SOLVETA — Solve Technology Agency') ?>,
      "url": "https://solveta.asia"
  }],
  "publisher": {
      "@type": "Organization",
      "name": "SOLVETA — Solve Technology Agency",
      "logo": {
        "@type": "ImageObject",
        "url": "https://solveta.asia/solveta-logo.png"
      }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": <?= json_encode($articleUrl) ?>
  }
}
</script>

<!-- ========================================================================= -->
<!-- ARTICLE HEADER & BREADCRUMBS                                              -->
<!-- ========================================================================= -->
<header class="relative pt-16 sm:pt-24 pb-12 sm:pb-16 font-sans overflow-hidden border-b border-[#E8E9ED] dark:border-neutral-800"
        style="background: radial-gradient(135% 85% at 50% 0%, #030816 0%, #081738 28%, #113375 50%, #1D56B3 72%, #3B82F6 88%, #FFFFFF 100%);">
    
    <!-- Subtle Tech Glow -->
    <div class="absolute inset-0 pointer-events-none opacity-20"
         style="background-image: radial-gradient(circle at 1px 1px, rgba(255, 255, 255, 0.4) 1px, transparent 0); background-size: 36px 36px;"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 space-y-5">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs text-white/70 mb-4">
            <a href="<?= base_url() ?>" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="<?= base_url('artikel') ?>" class="hover:text-white transition-colors">Artikel</a>
            <span>/</span>
            <span class="text-white font-medium truncate max-w-[200px] sm:max-w-none">
                <?= esc($article['category'] ?? 'Wawasan') ?>
            </span>
        </nav>

        <!-- Category & Read time -->
        <div class="flex items-center gap-2 text-xs font-semibold">
            <span class="px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-[11px] font-bold uppercase tracking-wider font-sans">
                <?= esc($article['category'] ?? 'Wawasan') ?>
            </span>
            <span class="text-white/40">•</span>
            <span class="text-white/80"><?= esc($article['read_time'] ?? '5 min baca') ?></span>
            <span class="text-white/40">•</span>
            <span class="text-white/80"><?= date('d F Y', strtotime($article['created_at'] ?? 'now')) ?></span>
        </div>

        <!-- Article Title -->
        <h1 class="text-2xl sm:text-4xl md:text-5xl font-black text-white tracking-tight leading-tight text-balance">
            <?= esc($article['title']) ?>
        </h1>

        <!-- Article Summary Excerpt -->
        <p class="text-sm sm:text-base text-white/85 leading-relaxed font-normal text-balance">
            <?= esc($article['summary']) ?>
        </p>

        <!-- Author & Social Share Bar -->
        <div class="pt-6 border-t border-white/15 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white text-[#8E1738] font-bold text-xs flex items-center justify-center shadow-md">
                    SV
                </div>
                <div>
                    <div class="text-xs font-bold text-white">
                        <?= esc($article['author'] ?? 'Tim Riset & Rekayasa SOLVETA') ?>
                    </div>
                    <div class="text-[11px] text-white/70">
                        Solve Technology Agency
                    </div>
                </div>
            </div>

            <!-- Share Buttons -->
            <div class="flex items-center gap-2">
                <span class="text-xs text-white/80 mr-1 font-medium">Bagikan:</span>
                <a href="<?= $waShareUrl ?>" target="_blank" rel="noopener noreferrer" title="Bagikan ke WhatsApp"
                   class="w-8 h-8 rounded-full bg-white/20 text-white hover:bg-emerald-600 flex items-center justify-center transition-colors">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                </a>
                <a href="<?= $linkedinShareUrl ?>" target="_blank" rel="noopener noreferrer" title="Bagikan ke LinkedIn"
                   class="w-8 h-8 rounded-full bg-white/20 text-white hover:bg-blue-600 flex items-center justify-center transition-colors">
                    <i data-lucide="share-2" class="w-4 h-4"></i>
                </a>
                <button type="button" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan artikel berhasil disalin!');" title="Salin Tautan"
                        class="w-8 h-8 rounded-full bg-white/20 text-white hover:bg-white hover:text-gray-900 flex items-center justify-center transition-colors">
                    <i data-lucide="link" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

    </div>
</header>

<!-- ========================================================================= -->
<!-- ARTICLE BODY CONTENT                                                      -->
<!-- ========================================================================= -->
<main class="py-12 sm:py-16 bg-white dark:bg-[#121214] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        
        <article class="bg-white dark:bg-[#171717] rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 p-6 sm:p-12 shadow-clean space-y-8">
            
            <!-- Featured Image -->
            <?php if (!empty($article['image_url'])): ?>
                <div class="rounded-2xl overflow-hidden border border-[#E8E9ED] dark:border-neutral-800 max-h-[460px] bg-neutral-100 dark:bg-neutral-900">
                    <img src="<?= esc($article['image_url']) ?>" alt="<?= esc($article['title']) ?>" class="w-full h-full object-cover">
                </div>
            <?php endif; ?>

            <!-- Article Typography Content -->
            <div class="article-prose text-sm sm:text-base text-[#171717] dark:text-neutral-200 leading-relaxed space-y-5">
                <?= $article['content'] ?>
            </div>

            <!-- Author Bio Card -->
            <div class="p-6 rounded-2xl bg-neutral-50 dark:bg-neutral-900/60 border border-[#E8E9ED] dark:border-neutral-800 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-[#8E1738] text-white flex items-center justify-center font-bold text-sm shrink-0">
                    SOL
                </div>
                <div class="space-y-1">
                    <div class="text-xs font-bold uppercase tracking-wider text-[#8E1738] dark:text-[#F05A72]">
                        TENTANG PENULIS
                    </div>
                    <div class="text-sm font-bold text-[#171717] dark:text-white">
                        <?= esc($article['author'] ?? 'Tim SOLVETA') ?>
                    </div>
                    <p class="text-xs text-[#737780] dark:text-neutral-400 leading-relaxed">
                        SOLVETA (Solve Technology Agency) adalah mitra digitalisasi bisnis yang membantu merancang website profesional, sistem manajemen kustom, dan aplikasi modern tanpa beban teknis.
                    </p>
                </div>
            </div>

            <!-- Inline Discussion Button -->
            <div class="pt-6 border-t border-[#E8E9ED] dark:border-neutral-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="<?= base_url('artikel') ?>" 
                   class="inline-flex items-center gap-2 text-xs font-bold text-[#737780] hover:text-[#171717] dark:hover:text-white transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>Kembali ke Semua Artikel</span>
                </a>

                <a href="<?= $waDiscussUrl ?>" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#8E1738] hover:bg-[#76152F] text-white text-xs font-bold shadow-xs transition-all">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Diskusi Topik Ini via WhatsApp</span>
                </a>
            </div>

        </article>

    </div>
</main>

<!-- ========================================================================= -->
<!-- RELATED ARTICLES SECTION                                                  -->
<!-- ========================================================================= -->
<?php if (!empty($related)): ?>
<section class="py-12 sm:py-16 bg-white dark:bg-[#171717] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-lg sm:text-xl font-bold text-[#171717] dark:text-white tracking-tight">
                Artikel Terkait Lainnya
            </h3>
            <a href="<?= base_url('artikel') ?>" class="text-xs font-bold text-[#8E1738] dark:text-[#F05A72] hover:underline flex items-center gap-1">
                <span>Lihat Semua</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
            <?php foreach ($related as $rel): ?>
                <div class="rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#171717] overflow-hidden shadow-clean hover:shadow-card-hover transition-all flex flex-col justify-between group">
                    <div>
                        <div class="h-44 overflow-hidden relative bg-neutral-100 dark:bg-neutral-900 border-b border-[#E8E9ED] dark:border-neutral-800">
                            <img src="<?= esc($rel['image_url'] ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80') ?>" 
                                 alt="<?= esc($rel['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-3 left-3 px-2 py-0.5 rounded text-[10px] font-bold bg-white text-[#171717] uppercase tracking-wider shadow-xs">
                                <?= esc($rel['category'] ?? 'Wawasan') ?>
                            </span>
                        </div>
                        <div class="p-5 space-y-2.5">
                            <h4 class="text-sm font-bold text-[#171717] dark:text-white group-hover:text-[#8E1738] dark:group-hover:text-[#F05A72] transition-colors leading-snug">
                                <a href="<?= base_url('artikel/' . $rel['slug']) ?>">
                                    <?= esc($rel['title']) ?>
                                </a>
                            </h4>
                            <p class="text-xs text-[#737780] dark:text-neutral-400 line-clamp-2 leading-relaxed">
                                <?= esc($rel['summary']) ?>
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
                        <a href="<?= base_url('artikel/' . $rel['slug']) ?>" class="text-xs font-bold text-[#8E1738] dark:text-[#F05A72] hover:underline flex items-center gap-1">
                            <span>Baca Artikel</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<?php endif; ?>

<!-- Typography styling for article-prose -->
<style>
    .article-prose h2 {
        font-size: 1.4rem;
        font-weight: 800;
        color: #171717;
        margin-top: 1.75rem;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }
    .dark .article-prose h2 { color: #ffffff; }

    .article-prose h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #171717;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        line-height: 1.35;
    }
    .dark .article-prose h3 { color: #ffffff; }

    .article-prose p {
        margin-bottom: 1rem;
        line-height: 1.75;
    }

    .article-prose ul, .article-prose ol {
        margin-left: 1.25rem;
        margin-bottom: 1.25rem;
        list-style-type: disc;
        space-y: 0.5rem;
    }
    .article-prose ol { list-style-type: decimal; }
    .article-prose li { margin-bottom: 0.35rem; }

    .article-prose blockquote {
        border-left: 4px solid #8E1738;
        padding-left: 1rem;
        font-style: italic;
        color: #737780;
        margin: 1.25rem 0;
    }
</style>

<?= $this->endSection() ?>

