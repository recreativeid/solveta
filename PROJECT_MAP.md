# SOLVETA — Master Project Architecture & Blueprint (PROJECT_MAP.md)

> **Dokumen ini adalah ringkasan arsitektur 100% lengkap dari seluruh project SOLVETA (CodeIgniter 4 + MySQL + Frontend Engine).**
> Cukup baca file ini saat memulai sesi baru atau ketika merencanakan perubahan fitur untuk menghemat token secara maksimal tanpa perlu membaca ulang seluruh file project.

---

## 1. Ringkasan Eksekutif & Tech Stack

- **Framework**: CodeIgniter 4.4+ (PHP 8.1 / 8.2)
- **Database**: MySQL 5.7+ / MariaDB / cPanel localhost (`solveta_db` lokal / `kond2433_solveta` produksi)
- **Frontend**: Vanilla JavaScript (ES6+), Tailwind CSS (CDN), Lucide Icons, Google Fonts (Poppins & JetBrains Mono)
- **Desain & Tema**: 
  - **Landing Page & Formulir**: Dual mode (Light & Dark), Glassmorphism, 3D Coverflow Carousel, 3D Container Scroll Vertical Tilt Laptop Mockup, Dual-Row Infinite Client Marquee.
  - **Developer Portal (Admin Login & Dashboard)**: Clean Minimalist SaaS, Pure White (`#ffffff`), border halus (`border-gray-200/80`), aksen gelap (`bg-gray-900`), font Poppins.
- **Kredensial Developer**:
  - **URL Login**: `/admin/login`
  - **Username**: `developer`
  - **Password**: `developer123`
- **Domain Produksi**: `https://solveta.asia`

---

## 2. Struktur Direktori & File Project

```text
c:\Users\user\Downloads\solveta/
├── PROJECT_MAP.md                  # Master blueprint & context file (FILE INI)
├── database.sql                    # SQL Dump skema & data default lengkap (10 tabel)
├── index.php                       # Root bridge untuk cPanel shared hosting
├── .htaccess                       # Apache rewrite rules (mod_rewrite, Gzip, HTTPS)
├── .env / env                      # Environment configuration (CI_ENVIRONMENT, DB credentials)
│
├── app/
│   ├── Config/
│   │   ├── App.php                 # Base URL (https://solveta.asia), locale 'id'
│   │   ├── Database.php            # Koneksi MySQL (DBGroup 'default')
│   │   ├── Routes.php              # Definisi seluruh routing URL sistem
│   │   └── Filters.php             # Filter autentikasi 'auth' untuk route group admin
│   │
│   ├── Controllers/
│   │   ├── BaseController.php      # Controller induk CI4
│   │   ├── Home.php                # Landing page utama (mengambil copy, portfolio, tiers, brands, contact)
│   │   ├── Formulir.php            # Halaman formulir order klien (16 field) & handler POST submit
│   │   ├── Auth.php                # Login developer, validasi session, logout
│   │   └── Admin.php               # Developer console: CRUD copy, pricing, profit, portfolio, brands, orders, invoices
│   │
│   ├── Filters/
│   │   └── AuthFilter.php          # Middleware proteksi session admin ('isLoggedIn')
│   │
│   ├── Models/
│   │   ├── SiteCopyModel.php       # Model tabel `site_copy` (headline, subtitle, marquee speed/height/scale)
│   │   ├── ContactModel.php        # Model tabel `contact_info` (whatsapp_number, display, website, email, instagram)
│   │   ├── PricingModel.php        # Model tabel `pricing_tiers` (4 paket: Starter, Standard, Premium, Platinum)
│   │   ├── AddonModel.php          # Model tabel `addon_services` (poin biaya layanan tambahan dinamis)
│   │   ├── PortfolioModel.php      # Model tabel `portfolio_items` (karya digital, kategori, link live, gambar)
│   │   ├── BrandModel.php          # Model tabel `client_brands` (10 logo klien tersimpan, skala, sort order)
│   │   ├── OrderModel.php          # Model tabel `customer_orders` (submisi formulir brief 16 field)
│   │   ├── ProfitModel.php         # Model tabel `service_profit_analyses` (analisis HPP, fee, margin laba)
│   │   ├── TransactionModel.php    # Model tabel `project_transactions` (buku proyek, generator no. invoice, status)
│   │   └── UserModel.php           # Model tabel `admin_users` (developer/developer123 bcrypt hash)
│   │
│   └── Views/
│       ├── home.php                # Landing page utama (10 section lengkap termasuk 3D Mockup & Marquee)
│       ├── formulir.php            # Formulir online 16 field brief kebutuhan calon klien
│       ├── layouts/
│       │   └── main.php            # Master HTML layout pembungkus (Navbar, Opening Screen, Theme Switcher, Footer)
│       └── admin/
│           ├── login.php           # Halaman login developer (Clean Minimalist SaaS, Pure White, Poppins)
│           ├── dashboard.php       # Developer console lengkap dengan 9 navigasi menu vertikal kiri
│           └── invoice_print.php   # Layout cetak invoice resmi PDF (standar A4 siap cetak)
│
├── public/
│   ├── favicon.ico                 # Browser tab favicon
│   ├── solveta-logo.png            # Official circular brand logo
│   ├── assets/
│   │   ├── css/style.css           # Styling kustom (glassmorphism, anim marquee, 3D stage)
│   │   └── js/main.js              # Interaktivitas JS (3D Coverflow carousel, 3D Container Scroll tilt, theme switch)
│   ├── uploads/
│   │   ├── brands/                 # 10 File PNG logo klien yang telah diekstrak & disimpan
│   │   │   ├── brand-1788254260324.png
│   │   │   ├── brand-1788254350483.png
│   │   │   ├── brand-1788254406941.png
│   │   │   ├── brand-1788254482294.png
│   │   │   ├── brand-1788254508761.png
│   │   │   ├── brand-1788258571491.png
│   │   │   ├── brand-1790081984303.png
│   │   │   ├── brand-1790082015511.png
│   │   │   ├── brand-1790082034279.png
│   │   │   └── brand-1790082051828.png
│   │   ├── portfolio/              # Gambar thumbnail portofolio proyek
│   │   ├── logos/                  # Upload logo brand kustom
│   │   └── videos/                 # Upload file video profil mp4
│   └── videos/
│       └── profile.mp4             # Default showcase video untuk layar laptop 3D
│
└── scratch/                        # Script deployment cPanel, verifikasi, dan sinkronisasi
```

---

## 3. Skema & Struktur Database MySQL (`database.sql`)

### 3.1. Tabel `admin_users`
- **Fungsi**: Akun kredensial akses developer portal.
- **Kolom**: `id`, `username`, `password_hash`, `display_name`, `email`, `created_at`.
- **Default Seed**: `username = 'developer'`, `password_hash = BCRYPT('developer123')`.

### 3.2. Tabel `site_copy`
- **Fungsi**: Teks headline, subheadline, CTA buttons, banner konsultasi, quotes filosofi, dan pengaturan dinamis marquee logo.
- **Kolom**:
  - `hero_eyebrow`, `hero_headline`, `hero_subtitle`
  - `hero_cta_primary` (default: 'Pesan Sekarang'), `hero_cta_secondary` (default: 'Pelajari Selengkapnya')
  - `portfolio_title`, `portfolio_subtitle`
  - `pricing_title` (default: 'PILIHAN PAKET LAYANAN WEBSITE'), `pricing_subtitle`
  - `consultation_title`, `consultation_desc`, `consultation_button` (default: 'Konsultasikan Kebutuhan Anda')
  - `philosophy_quote_1` (default: 'Bukan sekadar membangun teknologi.'), `philosophy_quote_2` (default: 'Kami membangun solusi.')
  - `marquee_title` (default: 'DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG')
  - `marquee_speed` (default: 35s), `marquee_logo_height` (default: 46px), `marquee_logo_spacing` (default: 36px), `marquee_logo_scale` (default: 100%), `marquee_logo_max_width` (default: 240px)
  - `site_logo` (default: '/solveta-logo.png')
  - `profile_video` (default: '/videos/profile.mp4')

### 3.3. Tabel `contact_info`
- **Fungsi**: Nomor WhatsApp, format display, email, instagram, dan link kontak global.
- **Kolom**: `whatsapp_number` ('6285876603826'), `whatsapp_display` ('+6285876603826'), `website_url` ('www.solveta.asia'), `email` ('halo@solveta.asia'), `instagram` ('solveta.asia').

### 3.4. Tabel `pricing_tiers`
- **Fungsi**: 4 Paket harga layanan SOLVETA (STARTER, STANDARD, PREMIUM, PLATINUM).
- **Daftar Paket**:
  1. `basic`: **STARTER** — Rp 349K. Delivery: 1-2 Hari. Button CTA: `PESAN PAKET STARTER (RP 349K)`. Renewal: 249k/tahun*.
  2. `standard`: **STANDARD** — Rp 699K. Delivery: 3-5 Hari. Button CTA: `PESAN PAKET STANDARD (RP 699K)`. Renewal: 399k/tahun*.
  3. `premium`: **PREMIUM** — Rp 964K. Delivery: 4-7 Hari. Button CTA: `PESAN PAKET PREMIUM (RP 964K)`. Renewal: 499k/tahun*.
  4. `custom`: **PLATINUM** — Hubungi Kami. Delivery: 7-14 Hari. Button CTA: `KONSULTASI PAKET PLATINUM`.
- **Kolom**: `id`, `name`, `price_prefix`, `price`, `price_badge`, `renewal_price`, `active_period`, `delivery_time`, `popular`, `popular_label`, `features_json`, `checklist_json`, `domain_addons_json`, `email_addons_json`, `revision_rules_json`, `custom_note`, `suitability`, `button_label`, `button_variant`, `wa_message`, `sort_order`.

### 3.5. Tabel `portfolio_items`
- **Fungsi**: Daftar karya proyek dalam 3D Coverflow Carousel.
- **Kolom**: `id`, `title`, `client_name`, `year`, `category`, `description`, `image_url`, `live_url`, `tags_json`, `sort_order`.

### 3.6. Tabel `client_brands`
- **Fungsi**: Logo klien untuk dual-row marquee slider.
- **Kolom**: `id`, `name`, `label`, `logo_image`, `scale`, `sort_order`.
- **Data Tersimpan**: 10 Brand resmi hasil upload user (`brand-1788254260324` s.d. `brand-1790082051828`) dengan gambar tersimpan di `/uploads/brands/{id}.png`.

### 3.7. Tabel `customer_orders`
- **Fungsi**: Rekap data 16 field formulir pemesanan masuk.
- **Kolom**: `id`, `full_name`, `whatsapp_number`, `brand_name`, `business_description`, `selected_package`, `website_type`, `pages_needed`, `design_color_theme`, `has_domain`, `has_logo`, `product_photos`, `example_websites`, `special_notes`, `website_and_domain_name`, `business_profile`, `status` ('Baru'|'Dihubungi'|'Selesai'), `timestamp`.

### 3.8. Tabel `service_profit_analyses`
- **Fungsi**: Analisis HPP, fee tenaga kerja, dan margin keuntungan per paket layanan (ProfitLossManager).
- **Kolom**: `id`, `service_name`, `tier_id`, `selling_price`, `labor_fee`, `estimated_monthly_orders`, `costs_json`, `notes`.

### 3.9. Tabel `project_transactions`
- **Fungsi**: Pembukuan transaksi proyek dan generator nomor invoice resmi.
- **Kolom**: `id`, `invoice_number` (`INV-YYYYMMDD-XXX`), `date`, `customer_name`, `phone_number`, `website_name`, `website_link`, `service_price`, `status` ('Progress'|'Terlaksana'|'Batal'), `cost_components_json`, `notes`.

### 3.10. Tabel `addon_services`
- **Fungsi**: Layanan add-on opsional (domain tambahan, email bisnis, maintenance berkala).

---

## 4. Rute URL & Endpoint API (`app/Config/Routes.php`)

| Metode | URL | Controller & Method | Deskripsi |
|---|---|---|---|
| **GET** | `/` | `Home::index` | Halaman landing page utama |
| **GET** | `/formulir` | `Formulir::index` | Halaman formulir order 16 field calon klien |
| **POST** | `/formulir/submit` | `Formulir::submit` | Menyimpan formulir & redirect ke WA |
| **GET** | `/admin/login` | `Auth::login` | Form login developer portal |
| **POST** | `/admin/login` | `Auth::attemptLogin` | Validasi kredensial developer |
| **GET** | `/admin/logout` | `Auth::logout` | Menghapus session admin & logout |
| **GET** | `/admin` | `Admin::index` | Dashboard developer console |
| **POST** | `/admin/update-copy` | `Admin::updateCopy` | Simpan teks visual, logo, & slider marquee |
| **POST** | `/admin/update-contact` | `Admin::updateContact` | Simpan nomor WA, Instagram, email |
| **POST** | `/admin/portfolio/save` | `Admin::savePortfolio` | Tambah / perbarui item portofolio |
| **POST** | `/admin/portfolio/delete/{id}` | `Admin::deletePortfolio` | Hapus item portofolio |
| **POST** | `/admin/pricing/save` | `Admin::savePricing` | Tambah / perbarui paket harga |
| **POST** | `/admin/brand/save` | `Admin::saveBrand` | Tambah / perbarui logo klien marquee |
| **POST** | `/admin/brand/delete/{id}` | `Admin::deleteBrand` | Hapus logo klien marquee |
| **POST** | `/admin/order/status` | `Admin::updateOrderStatus` | Update status order (Baru/Dihubungi/Selesai) |
| **POST** | `/admin/order/delete/{id}` | `Admin::deleteOrder` | Hapus data formulir order |
| **POST** | `/admin/profit/save` | `Admin::saveProfit` | Simpan analisis HPP & kalkulator margin |
| **POST** | `/admin/transaction/save` | `Admin::saveTransaction` | Simpan pencatatan proyek & invoice |
| **POST** | `/admin/transaction/delete/{id}` | `Admin::deleteTransaction` | Hapus transaksi proyek |
| **GET** | `/admin/invoice/print/{id}` | `Admin::printInvoice` | Halaman tampilan cetak PDF invoice A4 |

---

## 5. Fitur Visual Unggulan & Implementasi Kunci

### 5.1. 3D Container Scroll Vertical Tilt (Tablet / Laptop Mockup)
- **File**: `public/assets/js/main.js` & `app/Views/home.php`
- **Konsep**: Terinspirasi dari Aceternity UI `ContainerScroll`. Saat pengguna melakukan scroll pada halaman, container mockup laptop (`#laptop-chassis-container`) miring secara vertikal (`rotateX` dari 22 derajat melayang ke belakang perlahan tegak lurus menjadi 0 derajat, scale naik dari 0.94 ke 1.02, translateY dari 50px ke 0px) secara proporsional dengan posisi scroll viewport.
- **Interaktivitas Desktop**: Pergerakan kursor mouse menggerakkan sudut tutup laptop (`#laptop-lid`) secara 3D dengan spring damping halus.

### 5.2. Dual-Row Flowing Client Marquee
- **File**: `app/Views/home.php` & `public/assets/css/style.css`
- **Konsep**: Baris 1 mengalir ke Kanan, Baris 2 mengalir ke Kiri secara seamless infinite loop.
- **Dukungan Logo Asli**: Menampilkan 10 file PNG logo klien yang telah disimpan di `/uploads/brands/`. Pada mode gelap, logo otomatis menerapkan filter invert kontras tinggi agar tampak jelas dan elegan.
- **Kontrol Dinamis**: Kecepatan (speed), tinggi logo, spasi jarak, skala global, dan lebar maksimal dapat disetel langsung dari menu Developer "Edit Visual".

### 5.3. 3D Coverflow Portfolio Carousel
- **File**: `public/assets/js/main.js` & `app/Views/home.php`
- **Konsep**: Tampilan landscape laptop widescreen dengan physics drag/swipe gesture, rotasi Y 3D, depth z-index, dan gradient fade mask pada tepi kiri-kanan.

### 5.4. Developer Portal (Admin Console) 9 Menu Vertikal
- **File**: `app/Views/admin/dashboard.php`
- **Konsep Desain**: 100% Mengadopsi Clean Minimalist SaaS Next.js dengan background pure white (`#ffffff`), font Poppins, sidebar vertikal kiri, dan navigasi 9 menu:
  1. `visual`: Edit Visual (Headline, Subtitle, Logo Brand, Marquee Sliders).
  2. `pricing`: Paket & Harga (4 Tiers dengan spesifikasi lengkap).
  3. `profit`: Kelola HPP & Margin (`ProfitLossManager` dengan analisis beban biaya, laba bersih unit & proyeksi bulanan).
  4. `portfolio`: Portofolio (Karya proyek, kategori, live URL, upload gambar).
  5. `brands`: Logo Klien (10 Logo klien, kontrol slider skala per brand, hapus/tambah).
  6. `contact`: Kontak WA (Nomor WA, akun Instagram `solveta.asia`, email, direct test link).
  7. `video`: Video Profil (Player preview, upload MP4 hingga 100MB).
  8. `orders`: Rekap Formulir Order (`OrderSubmissionsManager` dengan filter status, modal detail 16 field, ekspor CSV).
  9. `projects`: Pencatatan Proyek & Invoice (`ProjectTransactionsManager` dengan generator nomor invoice, margin proyek, cetak invoice A4).

---

## 6. Prosedur Deployment ke cPanel (Solveta.asia)

1. **Localhost Testing**:
   Jalankan server lokal dengan XAMPP PHP:
   `& "C:\xampp\php\php.exe" spark serve --port 8080`
2. **Packaging Script**:
   Jalankan `scratch/package_update.php` untuk memaketkan file yang dimodifikasi ke `solveta-update.zip`.
3. **Deploy ke cPanel**:
   Jalankan `scratch/deploy_now.php` untuk mengunggah dan mengekstrak file ke `public_html` di cPanel secara instan.
4. **Deploy Database Migration**:
   Jalankan `scratch/deploy_db2.php` untuk mengeksekusi migrasi tabel dan data seed ke MySQL produksi di cPanel.

---
*Dibuat otomatis sebagai Single Source of Truth arsitektur SOLVETA.*
