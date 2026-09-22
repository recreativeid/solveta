<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="py-10 sm:py-16 font-sans">
    <div class="max-w-3xl mx-auto px-4">
        
        <!-- Header Link & Cover Card (Google-Form / Minimal Card Style from Next.js) -->
        <div class="mb-4">
            <a href="/" class="inline-flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white mb-4 transition-colors">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Website Utama</span>
            </a>

            <!-- Success Alert -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 p-6 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-center animate-fadeIn shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mx-auto mb-3">
                        <i data-lucide="check-circle-2" class="w-7 h-7"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">Brief Berhasil Diterima!</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-xs mb-5">
                        Rincian kebutuhan website Anda telah tersimpan di sistem SOLVETA. Klik tombol di bawah ini untuk konfirmasi langsung via WhatsApp:
                    </p>
                    <?php if (session()->getFlashdata('wa_url')): ?>
                        <a href="<?= session()->getFlashdata('wa_url') ?>" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gray-900 hover:bg-black text-white font-bold text-xs shadow-md">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Lanjutkan Konfirmasi ke WhatsApp</span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 text-xs flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-500 shrink-0"></i>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <!-- Title Card with Top Accent -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-2xl p-6 sm:p-8 shadow-xs border-t-4 border-t-gray-900 dark:border-t-rose-500 space-y-2">
                <div class="inline-flex items-center gap-1.5 text-[11px] font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider bg-gray-100 dark:bg-gray-800 px-2.5 py-0.5 rounded-md mb-1 font-mono">
                    <i data-lucide="file-text" class="w-3 h-3 text-[#8B0021] dark:text-rose-400"></i>
                    <span>Client Onboarding Form</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-950 dark:text-white tracking-tight">
                    Formulir Kebutuhan Pembuatan Website
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 leading-relaxed pt-1">
                    Silakan lengkapi informasi berikut agar tim teknis SOLVETA dapat menyusun arsitektur, struktur halaman, dan penawaran terbaik sesuai kebutuhan bisnis Anda.
                </p>
                <div class="pt-2 text-[11px] text-[#8B0021] dark:text-rose-400 font-medium">
                    * Menandakan pertanyaan wajib diisi
                </div>
            </div>
        </div>

        <form action="/formulir/submit" method="POST" class="space-y-4 text-xs font-sans" id="brief-order-form">
            <?= csrf_field() ?>

            <!-- 1. Nama Lengkap -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    1. Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <p class="text-[11px] text-gray-400">
                    Nama lengkap penanggung jawab / pemilik usaha yang dapat dihubungi.
                </p>
                <input type="text" name="full_name" required placeholder="Jawaban Anda..."
                       value="<?= old('full_name') ?>"
                       class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium">
            </div>

            <!-- 2. Nomor WhatsApp -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    2. Nomor WhatsApp Aktif <span class="text-red-500">*</span>
                </label>
                <p class="text-[11px] text-gray-400">
                    Nomor WhatsApp aktif untuk koordinasi dan integrasi tombol chat pemesanan.
                </p>
                <input type="text" name="whatsapp_number" required placeholder="Contoh: 081234567890"
                       value="<?= old('whatsapp_number') ?>"
                       class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium">
            </div>

            <!-- 3. Nama Brand / Bisnis -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    3. Nama Usaha / Brand / Perusahaan <span class="text-red-500">*</span>
                </label>
                <p class="text-[11px] text-gray-400">
                    Nama merek dagang, brand, klinik, institusi, atau perusahaan Anda.
                </p>
                <input type="text" name="brand_name" required placeholder="Jawaban Anda..."
                       value="<?= old('brand_name') ?>"
                       class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium">
            </div>

            <!-- 4. Rencana Nama Domain -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    4. Rencana Nama Domain Website (Opsional)
                </label>
                <p class="text-[11px] text-gray-400">
                    Contoh: namausaha.com, brandanda.id, dsb.
                </p>
                <input type="text" name="website_and_domain_name" placeholder="Contoh: brandanda.com"
                       value="<?= old('website_and_domain_name') ?>"
                       class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium">
            </div>

            <!-- 5. Deskripsi Singkat Bisnis -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    5. Deskripsi Singkat Bisnis & Target Pasar
                </label>
                <p class="text-[11px] text-gray-400">
                    Ceritakan produk/jasa yang dijual dan siapa target pelanggan utama Anda.
                </p>
                <textarea name="business_description" rows="3" placeholder="Jawaban Anda..."
                          class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium"><?= old('business_description') ?></textarea>
            </div>

            <!-- 6. Paket Yang Diminati -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    6. Paket Website Yang Diminati
                </label>
                <select name="selected_package" 
                        class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium">
                    <option value="Standard — 549k" selected>Standard — Rp 549K (Paling Populer)</option>
                    <option value="Basic — 299k">Basic — Rp 299K (Landing Page Hemat)</option>
                    <option value="Premium — 749k">Premium — Rp 749K (Katalog & WhatsApp Store)</option>
                    <option value="Custom — Mulai 1,5 Juta">Custom — Mulai Rp 1,5 Juta (Sistem Khusus / ERP)</option>
                </select>
            </div>

            <!-- 7. Jenis Website -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    7. Jenis Website Yang Diinginkan
                </label>
                <select name="website_type" 
                        class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium">
                    <option value="Company Profile Bisnis / Perusahaan">Company Profile Bisnis / Perusahaan</option>
                    <option value="Toko Online / Katalog Produk (WA Checkout)">Toko Online / Katalog Produk (WA Checkout)</option>
                    <option value="Landing Page Promosi Iklan (Single Page)">Landing Page Promosi Iklan (Single Page)</option>
                    <option value="Portofolio Personal / Fotografi / Jasa">Portofolio Personal / Fotografi / Jasa</option>
                    <option value="Sistem Web App Kustom (Gudang, Kasir, Absensi)">Sistem Web App Kustom (Gudang, Kasir, Absensi)</option>
                    <option value="Portal Berita / Blog / Yayasan">Portal Berita / Blog / Yayasan</option>
                </select>
            </div>

            <!-- 8. Halaman Yang Dibutuhkan -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-3">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    8. Rencana Halaman yang Ingin Ditampilkan
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <?php 
                        $pageOptions = [
                            "Beranda / Home",
                            "Tentang Kami",
                            "Layanan / Produk",
                            "Galeri / Portofolio",
                            "Kontak & WhatsApp",
                            "Daftar Harga / Pricelist",
                            "Testimoni Klien",
                            "Artikel / Blog",
                            "Formulir Reservasi / Order",
                        ];
                        foreach ($pageOptions as $pageOpt):
                    ?>
                        <label class="flex items-center gap-2 p-2.5 rounded-lg border border-gray-200 dark:border-gray-800 hover:border-gray-400 dark:hover:border-gray-600 bg-gray-50/50 dark:bg-gray-900/50 cursor-pointer transition-colors">
                            <input type="checkbox" name="pages_needed[]" value="<?= esc($pageOpt) ?>" checked class="rounded border-gray-300 text-[#8B0021] focus:ring-0">
                            <span class="text-xs text-gray-700 dark:text-gray-300"><?= esc($pageOpt) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- 9. Konsep Desain & Nuansa Warna -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    9. Konsep Desain & Nuansa Warna Utama
                </label>
                <select name="design_color_theme" 
                        class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium">
                    <option value="Modern Minimalist Putih & Bersih">Modern Minimalist Putih & Bersih</option>
                    <option value="Dark Cyber / Elegan Gelap (Seperti SOLVETA)">Dark Cyber / Elegan Gelap (Seperti SOLVETA)</option>
                    <option value="Biru Korporat & Terpercaya">Biru Korporat & Terpercaya</option>
                    <option value="Hijau Organik / Kesehatan / Alam">Hijau Organik / Kesehatan / Alam</option>
                    <option value="Emas / Mewah & Prestise">Emas / Mewah & Prestise</option>
                    <option value="Bebas, serahkan ke tim desainer SOLVETA">Bebas, serahkan ke tim desainer SOLVETA</option>
                </select>
            </div>

            <!-- 10. Status Kepemilikan Domain -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    10. Status Kepemilikan Domain
                </label>
                <select name="has_domain" 
                        class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium">
                    <option value="Belum punya (ingin dibantu daftarkan oleh SOLVETA)">Belum punya (ingin dibantu carikan oleh SOLVETA)</option>
                    <option value="Sudah punya nama domain sendiri">Sudah punya nama domain sendiri</option>
                </select>
            </div>

            <!-- 11. Status Logo Bisnis -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    11. Status Logo Usaha
                </label>
                <select name="has_logo" 
                        class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium">
                    <option value="Sudah punya logo (file siap kirim)">Sudah punya logo (file siap kirim)</option>
                    <option value="Belum punya (ingin dibuatkan teks logo sederhana)">Belum punya (ingin dibuatkan teks logo sederhana)</option>
                    <option value="Ingin sekalian paket pembuatan logo profesional">Ingin sekalian paket pembuatan logo profesional</option>
                </select>
            </div>

            <!-- 12. Contoh Website / Referensi -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    12. Contoh Website / Referensi Desain yang Disukai (Opsional)
                </label>
                <p class="text-[11px] text-gray-400">
                    Contoh: apple.com, stripe.com, atau tautan website kompetitor Anda.
                </p>
                <input type="text" name="example_websites" placeholder="Jawaban Anda..."
                       value="<?= old('example_websites') ?>"
                       class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium">
            </div>

            <!-- 13. Catatan Khusus -->
            <div class="bg-white dark:bg-[#11121B] border border-gray-200/80 dark:border-gray-800 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
                <label class="block text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    13. Catatan Khusus / Permintaan Tambahan
                </label>
                <p class="text-[11px] text-gray-400">
                    Sebutkan fitur khusus jika ada (misal: multi-bahasa, integrasi pembayaran, otomasi pesan WhatsApp).
                </p>
                <textarea name="special_notes" rows="3" placeholder="Jawaban Anda..."
                          class="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 dark:border-gray-700 focus:border-gray-900 dark:focus:border-rose-400 outline-none bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium"><?= old('special_notes') ?></textarea>
            </div>

            <!-- Submit Button Card -->
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-[11px] text-gray-400">
                    * Data terenkripsi aman dan direspon dalam maksimal 1x24 jam.
                </p>
                <button type="submit" 
                        class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white text-xs sm:text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 cursor-pointer font-sans">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    <span>Kirim Formulir Brief</span>
                </button>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>
