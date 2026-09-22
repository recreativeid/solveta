<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="py-12 sm:py-20 relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 text-center">
            <a href="/" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-400 hover:text-white mb-6 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4 text-red-500"></i>
                <span>Kembali ke Beranda</span>
            </a>
            <span class="text-xs uppercase tracking-widest text-red-500 font-bold block mb-2">Formulir Klien</span>
            <h1 class="font-heading font-black text-3xl sm:text-5xl text-white tracking-tight">
                Brief Pemesanan Website
            </h1>
            <p class="text-zinc-400 text-sm sm:text-base max-w-xl mx-auto mt-3">
                Lengkapi 16 detail kebutuhan di bawah ini agar tim developer SOLVETA dapat menyusun konsep, arsitektur, dan penawaran terbaik untuk bisnis Anda.
            </p>
        </div>

        <!-- Success Alert / Modal Trigger -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-8 p-6 rounded-2xl bg-emerald-950/70 border border-emerald-700/60 text-center animate-fadeIn shadow-2xl">
                <div class="w-12 h-12 rounded-full bg-emerald-600/30 text-emerald-400 flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="check-circle-2" class="w-7 h-7"></i>
                </div>
                <h3 class="font-heading font-bold text-xl text-white mb-1">Brief Berhasil Diterima!</h3>
                <p class="text-zinc-300 text-sm mb-5">
                    Data Anda telah tersimpan di sistem kami. Klik tombol di bawah ini untuk mengirimkan rincian brief langsung ke WhatsApp Tim SOLVETA:
                </p>
                <?php if (session()->getFlashdata('wa_url')): ?>
                    <a href="<?= session()->getFlashdata('wa_url') ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-xl shadow-emerald-800/40">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        <span>Lanjutkan Konfirmasi ke WhatsApp</span>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-8 p-4 rounded-xl bg-red-950/70 border border-red-700/60 text-red-300 text-sm flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 shrink-0"></i>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <!-- Form Container -->
        <div class="rounded-3xl glass-panel p-6 sm:p-10 border border-white/[0.08] shadow-2xl">
            <form action="/formulir/submit" method="POST" class="space-y-8" id="brief-order-form">
                <?= csrf_field() ?>

                <!-- SECTION 1: IDENTITAS PEMESAN -->
                <div>
                    <h3 class="font-heading font-bold text-lg text-white border-b border-white/[0.08] pb-3 mb-6 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-red-950/60 border border-red-800/40 text-red-500 text-xs flex items-center justify-center font-bold">1</span>
                        <span>Identitas Pemesan & Kontak</span>
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="full_name" required placeholder="Contoh: Budi Prasetyo"
                                   value="<?= old('full_name') ?>"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                Nomor WhatsApp Aktif <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="whatsapp_number" required placeholder="Contoh: 081234567890"
                                   value="<?= old('whatsapp_number') ?>"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: PROFIL USAHA -->
                <div>
                    <h3 class="font-heading font-bold text-lg text-white border-b border-white/[0.08] pb-3 mb-6 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-red-950/60 border border-red-800/40 text-red-500 text-xs flex items-center justify-center font-bold">2</span>
                        <span>Profil Usaha / Brand</span>
                    </h3>
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                    Nama Brand / Bisnis <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="brand_name" required placeholder="Contoh: Kopi Nusantara POS"
                                       value="<?= old('brand_name') ?>"
                                       class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                    Rencana Nama Domain Website
                                </label>
                                <input type="text" name="website_and_domain_name" placeholder="Contoh: kopinusantara.com"
                                       value="<?= old('website_and_domain_name') ?>"
                                       class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                Deskripsi Singkat Bisnis & Target Pasar
                            </label>
                            <textarea name="business_description" rows="3" placeholder="Ceritakan produk/jasa yang dijual dan siapa target pelanggan utama Anda..."
                                      class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500"><?= old('business_description') ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: PILIHAN PAKET & SPESIFIKASI -->
                <div>
                    <h3 class="font-heading font-bold text-lg text-white border-b border-white/[0.08] pb-3 mb-6 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-red-950/60 border border-red-800/40 text-red-500 text-xs flex items-center justify-center font-bold">3</span>
                        <span>Paket & Spesifikasi Website</span>
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                Paket Yang Diminati
                            </label>
                            <select name="selected_package" 
                                    class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                                <option value="Standard — 549k" selected>Standard — Rp 549K (Paling Populer)</option>
                                <option value="Basic — 299k">Basic — Rp 299K (Landing Page Hemat)</option>
                                <option value="Premium — 749k">Premium — Rp 749K (Katalog & WhatsApp Store)</option>
                                <option value="Custom — Mulai 1,5 Juta">Custom — Mulai Rp 1,5 Juta (Sistem Khusus / ERP)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                Jenis Website
                            </label>
                            <select name="website_type" 
                                    class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                                <option value="Company Profile Bisnis / Perusahaan">Company Profile Bisnis / Perusahaan</option>
                                <option value="Toko Online / Katalog Produk (WA Checkout)">Toko Online / Katalog Produk (WA Checkout)</option>
                                <option value="Landing Page Promosi Iklan (Single Page)">Landing Page Promosi Iklan (Single Page)</option>
                                <option value="Portofolio Personal / Fotografi / Jasa">Portofolio Personal / Fotografi / Jasa</option>
                                <option value="Sistem Web App Kustom (Gudang, Kasir, Absensi)">Sistem Web App Kustom (Gudang, Kasir, Absensi)</option>
                                <option value="Portal Berita / Blog / Yayasan">Portal Berita / Blog / Yayasan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Checklist Halaman yang Dibutuhkan -->
                    <div class="mb-6">
                        <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-3">
                            Halaman yang Ingin Ditampilkan di Website:
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
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
                                <label class="flex items-center gap-2.5 p-3 rounded-xl bg-zinc-900/60 border border-zinc-800 text-xs text-zinc-300 hover:border-zinc-700 cursor-pointer transition-all">
                                    <input type="checkbox" name="pages_needed[]" value="<?= esc($pageOpt) ?>" checked class="rounded bg-zinc-800 border-zinc-700 text-red-600 focus:ring-0">
                                    <span><?= esc($pageOpt) ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                Konsep Desain & Nuansa Warna
                            </label>
                            <select name="design_color_theme" 
                                    class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                                <option value="Modern Minimalist Putih & Bersih">Modern Minimalist Putih & Bersih</option>
                                <option value="Dark Cyber / Elegan Gelap (Seperti SOLVETA)">Dark Cyber / Elegan Gelap (Seperti SOLVETA)</option>
                                <option value="Biru Korporat & Terpercaya">Biru Korporat & Terpercaya</option>
                                <option value="Hijau Organik / Kesehatan / Alam">Hijau Organik / Kesehatan / Alam</option>
                                <option value="Emas / Mewah & Prestise">Emas / Mewah & Prestise</option>
                                <option value="Bebas, serahkan ke tim desainer SOLVETA">Bebas, serahkan ke tim desainer SOLVETA</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                Status Kepemilikan Domain
                            </label>
                            <select name="has_domain" 
                                    class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                                <option value="Belum punya (ingin dibantu daftarkan oleh SOLVETA)">Belum punya (ingin dibantu carikan oleh SOLVETA)</option>
                                <option value="Sudah punya nama domain sendiri">Sudah punya nama domain sendiri</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                Status Logo Bisnis
                            </label>
                            <select name="has_logo" 
                                    class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white text-sm focus:outline-none focus:border-red-500">
                                <option value="Sudah punya logo (file siap kirim)">Sudah punya logo (file siap kirim)</option>
                                <option value="Belum punya (ingin dibuatkan teks logo sederhana)">Belum punya (ingin dibuatkan teks logo sederhana)</option>
                                <option value="Ingin sekalian paket pembuatan logo profesional">Ingin sekalian paket pembuatan logo profesional</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SECTION 4: MATERI & REFERENSI -->
                <div>
                    <h3 class="font-heading font-bold text-lg text-white border-b border-white/[0.08] pb-3 mb-6 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-red-950/60 border border-red-800/40 text-red-500 text-xs flex items-center justify-center font-bold">4</span>
                        <span>Materi & Referensi Website</span>
                    </h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                Contoh Website / Link Referensi yang Disukai (Opsional)
                            </label>
                            <input type="text" name="example_websites" placeholder="Contoh: apple.com, stripe.com, atau kompetitor Anda"
                                   value="<?= old('example_websites') ?>"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-red-500">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">
                                Catatan Khusus / Permintaan Tambahan
                            </label>
                            <textarea name="special_notes" rows="3" placeholder="Tuliskan jika ada fitur tertentu yang wajib ada (misal: hitung ongkir JNE, integrasi payment gateway, multi-bahasa, dll)..."
                                      class="w-full px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-red-500"><?= old('special_notes') ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT BUTTON -->
                <div class="pt-6 border-t border-white/[0.08] flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-zinc-400">
                        * Data Anda tersimpan aman dan terenkripsi. Tim SOLVETA akan merespon dalam waktu maksimal 1x24 jam.
                    </p>
                    <button type="submit" 
                            class="w-full sm:w-auto px-10 py-4 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white font-bold text-sm shadow-xl shadow-red-700/30 flex items-center justify-center gap-2">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span>Kirim Brief & Dapatkan Estimasi</span>
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
