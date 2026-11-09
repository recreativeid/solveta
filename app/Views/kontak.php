<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $waClean = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285876603826');
    if (substr($waClean, 0, 1) === '0') $waClean = '62' . substr($waClean, 1);
    $waGeneralUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo CS Zahra & Tim SOLVETA, saya ingin berkonsultasi mengenai solusi teknologi dan pengembangan website untuk bisnis kami.");
    $waZahraUrl = "https://wa.me/{$waClean}?text=" . rawurlencode("Halo Admin Zahra & Tim SOLVETA, saya ingin berkonsultasi mengenai pembuatan website & solusi teknologi untuk perusahaan kami.");
?>

<!-- ========================================================================= -->
<!-- 1. CONTACT HERO HEADER — Clean White & Red High Contrast (Font Inter, SaaS)-->
<!-- ========================================================================= -->
<section class="clean-hero-header pt-28 sm:pt-36 pb-16 sm:pb-24 border-b border-[#E8E9ED] dark:border-neutral-800 font-sans relative overflow-hidden">
    <!-- Subtle Dotted Grid Background -->
    <div class="absolute inset-0 bg-grid-dots opacity-35 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center space-y-6">
        
        <!-- Eyebrow Pill Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white text-xs font-semibold shadow-xs">
            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
            <span class="font-bold tracking-wider uppercase font-sans">PUSAT KOMUNIKASI &amp; KONSULTASI RESMI</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.12] drop-shadow-none">
            Mari Ceritakan Apa yang Bisnis Anda Butuhkan
        </h1>

        <!-- Subheading -->
        <p class="text-sm sm:text-base md:text-lg text-white/90 max-w-2xl mx-auto leading-relaxed drop-shadow-none">
            Setiap bisnis memiliki tantangan dan kebutuhan sistem yang unik. Tim konsultan dan dedicated customer service SOLVETA siap mendampingi Anda menemukan pendekatan teknologi yang paling tepat dan efisien.
        </p>

        <!-- Prompt Search / Action Box -->
        <div class="max-w-xl mx-auto pt-2">
            <div class="flex items-center bg-white dark:bg-[#1A1C22] rounded-full p-2 pl-5 border border-[#E8E9ED] dark:border-neutral-800 shadow-sm focus-within:ring-2 focus-within:ring-[#C4264A]/30 transition">
                <i data-lucide="message-circle" class="w-4 h-4 text-[#C4264A] shrink-0 mr-3"></i>
                <input type="text" readonly value="Terhubung langsung dengan Lead CS Admin Zahra via WhatsApp:" 
                       class="w-full text-xs sm:text-sm text-[#111215] dark:text-white bg-transparent outline-none truncate">
                <a href="<?= $waZahraUrl ?>" target="_blank"
                   class="px-5 py-2.5 rounded-full bg-[#C4264A] hover:bg-[#8E1738] text-white text-xs font-bold transition flex items-center gap-1.5 shrink-0 shadow-sm">
                    <span>Chat Admin Zahra</span>
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- 2. EXECUTIVE CS SHOWCASE (ADMIN ZAHRA) & CONSULTATION FORM                -->
<!-- ========================================================================= -->
<section class="py-16 sm:py-24 bg-white dark:bg-[#0E0F12] font-sans border-b border-[#E8E9ED] dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            
            <!-- Left Column: ADMIN ZAHRA OFFICIAL CS CARD (5 Cols) -->
            <div class="lg:col-span-5 space-y-6">
                
                <div class="rounded-3xl border border-red-200/80 dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] overflow-hidden shadow-editorial transition-all">
                    
                    <!-- Card Top Header Status -->
                    <div class="p-4 sm:p-5 bg-gradient-to-r from-red-50 to-rose-50/50 dark:from-neutral-900 dark:to-neutral-800 border-b border-red-100 dark:border-neutral-800 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-[11px] font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-wider font-sans">
                                Live Verified Support
                            </span>
                        </div>
                        <span class="text-[10px] text-neutral-500 font-sans">Respon &lt; 5 Menit</span>
                    </div>

                    <!-- CS Poster Image -->
                    <div class="relative w-full aspect-square sm:h-[400px] overflow-hidden bg-neutral-950">
                        <img src="<?= base_url('images/cs-zahra.jpg') ?>" 
                             alt="Admin Zahra - Customer Service SOLVETA" 
                             class="w-full h-full object-cover object-top">
                    </div>

                    <!-- Details Body -->
                    <div class="p-6 sm:p-7 space-y-5">
                        <div>
                            <div class="text-[10px] font-sans tracking-widest text-[#C4264A] dark:text-[#F05A72] uppercase font-bold">SOLVETA CLIENT RELATIONS</div>
                            <h3 class="text-xl font-extrabold text-[#111215] dark:text-white mt-0.5">Admin Zahra</h3>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">Lead Customer Service &amp; Project Coordinator Resmi SOLVETA</p>
                        </div>

                        <div class="space-y-2 border-t border-[#E8E9ED] dark:border-neutral-800 pt-4">
                            <span class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider block font-sans">Siap Membantu Kebutuhan Anda:</span>
                            <ul class="space-y-2 text-xs text-neutral-600 dark:text-neutral-400">
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
                                    <span>Konsultasi pemilihan paket website (Starter, Standard, Premium, Platinum)</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
                                    <span>Estimasi biaya pembuatan sistem khusus &amp; penawaran proposal resmi</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check" class="w-3.5 h-3.5 text-[#C4264A] shrink-0 mt-0.5"></i>
                                    <span>Penjadwalan sesi diskusi teknis via Google Meet dengan Lead Engineer</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Direct WhatsApp Button -->
                        <div class="pt-2">
                            <a href="<?= $waZahraUrl ?>" target="_blank"
                               class="w-full py-3.5 px-4 rounded-2xl text-xs font-bold text-white bg-[#C4264A] hover:bg-[#8E1738] shadow-md flex items-center justify-center gap-2 transition-all">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                                <span>Hubungi Admin Zahra (WhatsApp Langsung)</span>
                            </a>
                        </div>

                        <!-- Operating Hours & Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-[11px] border-t border-[#E8E9ED] dark:border-neutral-800">
                            <div>
                                <span class="text-neutral-400 uppercase font-sans block">Jam Operasional Layanan:</span>
                                <span class="font-bold text-[#111215] dark:text-white">Senin – Sabtu (08:00 – 21:00 WIB)</span>
                            </div>
                            <div>
                                <span class="text-neutral-400 uppercase font-sans block">Email Resmi Perusahaan:</span>
                                <a href="mailto:kontak@solveta.asia" class="font-bold text-[#C4264A] hover:underline">kontak@solveta.asia</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Right Column: FORMULIR KONSULTASI PROYEK (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">
                
                <div class="rounded-3xl border border-[#E8E9ED] dark:border-neutral-800 bg-[#FAFAFC] dark:bg-[#14151B] p-6 sm:p-10 shadow-sm space-y-8">
                    
                    <div class="space-y-2">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-red-50 dark:bg-neutral-900 border border-red-200 dark:border-neutral-800 text-[11px] font-bold text-[#C4264A] dark:text-[#F05A72] uppercase font-sans">
                            FORMULIR KONSULTASI PROYEK
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-[#111215] dark:text-white tracking-tight">
                            Kirimkan Rincian Kebutuhan Digital Anda
                        </h2>
                        <p class="text-xs sm:text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">
                            Silakan isi formulir di bawah ini. Tim analis teknologi SOLVETA akan mempelajari kebutuhan bisnis Anda dan menyiapkan rekomendasi solusi serta estimasi timeline pengerjaan dalam 1x24 jam.
                        </p>
                    </div>

                    <!-- Consultation Form -->
                    <form id="consultation-form" onsubmit="handleFormConsultation(event)" class="space-y-5">
                        
                        <!-- Nama Lengkap -->
                        <div class="space-y-1.5">
                            <label for="nama" class="block text-xs font-bold text-[#111215] dark:text-white uppercase font-sans">
                                Nama Lengkap <span class="text-[#C4264A]">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" required placeholder="Contoh: Budi Santoso"
                                   class="w-full px-4 py-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-xs sm:text-sm text-[#111215] dark:text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#C4264A]/30 transition">
                        </div>

                        <!-- Nama Perusahaan / Usaha -->
                        <div class="space-y-1.5">
                            <label for="perusahaan" class="block text-xs font-bold text-[#111215] dark:text-white uppercase font-sans">
                                Nama Perusahaan / Usaha
                            </label>
                            <input type="text" id="perusahaan" name="perusahaan" placeholder="Contoh: PT Sumber Rezeki / Toko Sejahtera"
                                   class="w-full px-4 py-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-xs sm:text-sm text-[#111215] dark:text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#C4264A]/30 transition">
                        </div>

                        <!-- WhatsApp & Email Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- WhatsApp -->
                            <div class="space-y-1.5">
                                <label for="whatsapp" class="block text-xs font-bold text-[#111215] dark:text-white uppercase font-sans">
                                    Nomor WhatsApp Aktif <span class="text-[#C4264A]">*</span>
                                </label>
                                <input type="tel" id="whatsapp" name="whatsapp" required placeholder="08xxxxxxxxxx"
                                       class="w-full px-4 py-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-xs sm:text-sm text-[#111215] dark:text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#C4264A]/30 transition">
                            </div>

                            <!-- Email -->
                            <div class="space-y-1.5">
                                <label for="email" class="block text-xs font-bold text-[#111215] dark:text-white uppercase font-sans">
                                    Alamat Email Bisnis <span class="text-[#C4264A]">*</span>
                                </label>
                                <input type="email" id="email" name="email" required placeholder="nama@perusahaan.com"
                                       class="w-full px-4 py-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-xs sm:text-sm text-[#111215] dark:text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#C4264A]/30 transition">
                            </div>
                        </div>

                        <!-- Kebutuhan Solusi Teknologi -->
                        <div class="space-y-1.5">
                            <label for="paket" class="block text-xs font-bold text-[#111215] dark:text-white uppercase font-sans">
                                Kebutuhan Solusi Teknologi <span class="text-[#C4264A]">*</span>
                            </label>
                            <select id="paket" name="paket" required
                                    class="w-full px-4 py-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-xs sm:text-sm text-[#111215] dark:text-white focus:outline-none focus:ring-2 focus:ring-[#C4264A]/30 transition">
                                <option value="Paket Starter — Landing Page UMKM (Rp 249K)">Paket Starter — Landing Page UMKM (Rp 249K)</option>
                                <option value="Paket Bisnis — Company Profile & Portal Berita (Rp 599K)" selected>Paket Bisnis — Company Profile &amp; Portal Berita (Rp 599K)</option>
                                <option value="Paket Custom — Enterprise Cloud Platform & API (Menyesuaikan Kebutuhan)">Paket Custom — Enterprise Cloud Platform &amp; API (Menyesuaikan Kebutuhan)</option>
                                <option value="Aplikasi Mobile & Desktop Instalasi Lokal (Harga Mengikuti Kebutuhan)">Aplikasi Mobile &amp; Desktop Instalasi Lokal (Harga Mengikuti Kebutuhan)</option>
                                <option value="Kebutuhan Custom / Redesign Website Lama">Kebutuhan Custom / Redesign Website Lama</option>
                            </select>
                        </div>

                        <!-- Ceritakan Tantangan atau Fitur yang Ingin Dibuat -->
                        <div class="space-y-1.5">
                            <label for="pesan" class="block text-xs font-bold text-[#111215] dark:text-white uppercase font-sans">
                                Ceritakan Tantangan atau Fitur yang Ingin Dibuat <span class="text-[#C4264A]">*</span>
                            </label>
                            <textarea id="pesan" name="pesan" rows="4" required placeholder="Contoh: Kami membutuhkan website company profile 4 halaman dengan fitur katalog produk dan formulir konsultasi terhubung ke WhatsApp..."
                                      class="w-full px-4 py-3 rounded-2xl bg-white dark:bg-[#1A1C22] border border-[#E8E9ED] dark:border-neutral-800 text-xs sm:text-sm text-[#111215] dark:text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#C4264A]/30 transition"></textarea>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="pt-2">
                            <button type="submit"
                                    class="w-full py-4 px-6 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#C4264A] hover:bg-[#8E1738] shadow-lg shadow-red-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                                <span>Kirim Permintaan Konsultasi</span>
                                <i data-lucide="send" class="w-4 h-4"></i>
                            </button>
                        </div>

                    </form>

                </div>

                <!-- Info Kantor & Jaminan NDA -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <div class="p-5 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#14151B] space-y-1.5">
                        <div class="flex items-center gap-2">
                            <i data-lucide="building" class="w-4 h-4 text-[#C4264A]"></i>
                            <span class="text-xs font-bold text-[#111215] dark:text-white font-sans uppercase">Kantor Rekayasa SOLVETA</span>
                        </div>
                        <p class="text-xs text-neutral-500 leading-relaxed">
                            Jakarta &amp; Surakarta Tech Hub, Indonesia. Melayani klien di seluruh Indonesia &amp; Regional Asia.
                        </p>
                    </div>

                    <div class="p-5 rounded-2xl border border-[#E8E9ED] dark:border-neutral-800 bg-white dark:bg-[#14151B] space-y-1.5">
                        <div class="flex items-center gap-2">
                            <i data-lucide="lock" class="w-4 h-4 text-[#C4264A]"></i>
                            <span class="text-xs font-bold text-[#111215] dark:text-white font-sans uppercase">Jaminan Kerahasiaan Data (NDA)</span>
                        </div>
                        <p class="text-xs text-neutral-500 leading-relaxed">
                            Seluruh informasi rencana bisnis dan kontak yang Anda kirimkan dijamin kerahasiaannya secara hukum.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<!-- Direct WhatsApp Form Script -->
<script>
    function handleFormConsultation(e) {
        e.preventDefault();
        const nama = document.getElementById('nama').value.trim();
        const perusahaan = document.getElementById('perusahaan').value.trim();
        const wa = document.getElementById('whatsapp').value.trim();
        const email = document.getElementById('email').value.trim();
        const paket = document.getElementById('paket').value;
        const pesan = document.getElementById('pesan').value.trim();

        const waText = 
            `*FORMULIR KONSULTASI PROYEK SOLVETA*\n` +
            `━━━━━━━━━━━━━━━━━━━━\n` +
            `• *Nama Lengkap:* ${nama}\n` +
            `• *Perusahaan / Usaha:* ${perusahaan || '-'}\n` +
            `• *Nomor WhatsApp:* ${wa}\n` +
            `• *Alamat Email:* ${email}\n` +
            `• *Kebutuhan Solusi:* ${paket}\n` +
            `━━━━━━━━━━━━━━━━━━━━\n` +
            `*Rincian Tantangan & Fitur:*\n${pesan}\n\n` +
            `_Dikirim via Form Kontak Resmi solveta.asia_`;

        const waUrl = `https://wa.me/<?= $waClean ?>?text=` + encodeURIComponent(waText);
        window.open(waUrl, '_blank');
    }
</script>

<?= $this->endSection() ?>
