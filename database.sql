-- =========================================================
-- SOLVETA DATABASE SCHEMA (MySQL 5.7+ / 8.0+ / MariaDB)
-- Production Ready for cPanel Shared Hosting (Localhost)
-- Target Database: kond2433_solveta
-- Synced from Supabase Data — 2026-09-23
-- =========================================================

-- Migration: Add instagram column if not exists
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'contact_info' AND COLUMN_NAME = 'instagram');
SET @sql = IF(@col_exists = 0, 'ALTER TABLE `contact_info` ADD COLUMN `instagram` VARCHAR(255) DEFAULT NULL AFTER `email`', 'SELECT 1');
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
-- =========================================================

-- ---------------------------------------------------------
-- 1. Table: admin_users (Autentikasi CMS Admin)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `display_name` VARCHAR(100) DEFAULT 'Admin Solveta',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Login: developer / developer123
INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `display_name`)
VALUES (1, 'developer', '$2y$10$6n.mJZAy4HQwHWWldDBBeuGSXamUh7xo0bOTHtHuYqKvVizEd.CTK', 'Developer SOLVETA')
ON DUPLICATE KEY UPDATE `username`='developer', `password_hash`='$2y$10$6n.mJZAy4HQwHWWldDBBeuGSXamUh7xo0bOTHtHuYqKvVizEd.CTK', `display_name`='Developer SOLVETA';

-- ---------------------------------------------------------
-- 2. Table: site_copy (Teks Headline, Subtitle, & Visual Media)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_copy` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `hero_eyebrow` VARCHAR(255) DEFAULT 'SOLVE TECHNOLOGY AGENCY',
  `hero_headline` TEXT NOT NULL,
  `hero_subtitle` TEXT NOT NULL,
  `portfolio_title` VARCHAR(255) DEFAULT 'Portofolio Proyek Website Yang Telah Kami Bangun',
  `portfolio_subtitle` VARCHAR(255) DEFAULT 'Koleksi karya digital terbaik yang memadukan desain visual kelas dunia dengan performa teknologi tanpa kompromi.',
  `consultation_title` VARCHAR(255) DEFAULT 'TIDAK TAHU HARUS MULAI DARI MANA?',
  `consultation_desc` TEXT,
  `marquee_title` VARCHAR(255) DEFAULT 'DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG',
  `marquee_speed` INT DEFAULT 35,
  `marquee_logo_height` INT DEFAULT 46,
  `marquee_logo_spacing` INT DEFAULT 36,
  `marquee_logo_scale` INT DEFAULT 100,
  `marquee_logo_max_width` INT DEFAULT 240,
  `site_logo` VARCHAR(255) DEFAULT '/solveta-logo.png',
  `profile_video` VARCHAR(255) DEFAULT '/videos/profile.mp4',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `site_copy` (`id`, `hero_eyebrow`, `hero_headline`, `hero_subtitle`, `portfolio_title`, `portfolio_subtitle`, `consultation_title`, `consultation_desc`, `marquee_title`, `site_logo`, `profile_video`)
VALUES (
  1,
  'SOLVE TECHNOLOGY AGENCY',
  'Mengubah Tantangan Bisnis Menjadi Solusi Digital.',
  'Banyak bisnis terhambat oleh proses manual, informasi yang tidak terstruktur, dan kurangnya integrasi. SOLVETA hadir untuk menyederhanakan masalah kompleks melalui solusi digital dan otomasi yang efisien.',
  'Portofolio Proyek Website Yang Telah Kami Bangun',
  'Koleksi karya digital terbaik yang memadukan desain visual kelas dunia dengan performa teknologi tanpa kompromi.',
  'TIDAK TAHU HARUS MULAI DARI MANA?',
  'Konsultasikan masalah bisnis Anda secara gratis. Kami akan merekomendasikan langkah paling efisien untuk memulainya.',
  'DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG',
  '/solveta-logo.png',
  '/videos/profile.mp4'
) ON DUPLICATE KEY UPDATE `hero_eyebrow`=VALUES(`hero_eyebrow`), `hero_headline`=VALUES(`hero_headline`), `hero_subtitle`=VALUES(`hero_subtitle`), `portfolio_title`=VALUES(`portfolio_title`), `portfolio_subtitle`=VALUES(`portfolio_subtitle`);

-- ---------------------------------------------------------
-- 3. Table: contact_info (Nomor WhatsApp, Instagram & Link Kontak)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `contact_info` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `whatsapp_number` VARCHAR(50) NOT NULL DEFAULT '6285876603826',
  `whatsapp_display` VARCHAR(50) NOT NULL DEFAULT '+6285876603826',
  `website_url` VARCHAR(255) NOT NULL DEFAULT 'www.solveta.asia',
  `email` VARCHAR(255) DEFAULT 'halo@solveta.asia',
  `instagram` VARCHAR(255) DEFAULT 'solveta.asia',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contact_info` (`id`, `whatsapp_number`, `whatsapp_display`, `website_url`, `email`, `instagram`)
VALUES (
  1,
  '6285876603826',
  '+6285876603826',
  'www.solveta.asia',
  'halo@solveta.asia',
  'solveta.asia'
) ON DUPLICATE KEY UPDATE `whatsapp_number`='6285876603826', `whatsapp_display`='+6285876603826', `email`='halo@solveta.asia', `instagram`='solveta.asia';

-- ---------------------------------------------------------
-- 4. Table: pricing_tiers (Paket & Harga Website — Synced from Supabase)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pricing_tiers` (
  `id` VARCHAR(50) PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `price_prefix` VARCHAR(50) DEFAULT NULL,
  `price` VARCHAR(100) NOT NULL,
  `price_badge` VARCHAR(100) DEFAULT NULL,
  `renewal_price` VARCHAR(100) DEFAULT NULL,
  `active_period` VARCHAR(100) DEFAULT '1 Tahun',
  `delivery_time` VARCHAR(100) DEFAULT '3-7 Hari Kerja',
  `popular` BOOLEAN DEFAULT FALSE,
  `popular_label` VARCHAR(100) DEFAULT 'Paling Populer',
  `features_json` JSON NOT NULL,
  `checklist_json` JSON DEFAULT NULL,
  `domain_addons_json` JSON DEFAULT NULL,
  `email_addons_json` JSON DEFAULT NULL,
  `revision_rules_json` JSON DEFAULT NULL,
  `custom_note` TEXT DEFAULT NULL,
  `suitability` TEXT NOT NULL,
  `button_label` VARCHAR(100) NOT NULL,
  `button_variant` ENUM('red', 'outline') DEFAULT 'outline',
  `wa_message` TEXT NOT NULL,
  `sort_order` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Delete old pricing data first for clean sync
DELETE FROM `pricing_tiers`;

INSERT INTO `pricing_tiers` (`id`, `name`, `price_prefix`, `price`, `price_badge`, `renewal_price`, `active_period`, `delivery_time`, `popular`, `popular_label`, `features_json`, `checklist_json`, `domain_addons_json`, `email_addons_json`, `revision_rules_json`, `custom_note`, `suitability`, `button_label`, `button_variant`, `wa_message`, `sort_order`)
VALUES
(
  'basic', 
  'STARTER', 
  'mulai dari', 
  'Rp 349K', 
  '349K',
  '249k/tahun*',
  '1 Tahun',
  '1–2 Hari',
  FALSE, 
  '',
  '["Maksimal 1 Halaman (tambah Rp 50k/Halaman)", "Revisi ringan 2x (Tidak berubah dari brief awal)", "Optimasi Speed (High Perform)", "Free Domain (.my.id, .site, .store, .xyz, .space, .fund, .shop)", "Free Hosting (Akses Dashboard, Tanpa login cPanel)", "Responsive Web (mobile friendly)", "SSL Security", "Full Garansi*"]', 
  '[{"text": "Maksimal 1 Halaman (tambah Rp 50k/Halaman)", "included": true}, {"text": "Revisi ringan 2x (Tidak berubah dari brief awal)", "included": true}, {"text": "Optimasi Speed (High Perform)", "included": true}, {"text": "Free Domain (my.id .site .cloud .online ..shop .blog)", "included": true}, {"text": "Free Hosting (Akses Dashboard, Tanpa login cPanel)", "included": true}, {"text": "Email Bisnis (nama@domain.com)", "included": false}, {"text": "Responsive Web (mobile friendly)", "included": true}, {"text": "SSL Security", "included": true}, {"text": "SEO Basic", "included": false}, {"text": "Google Analytics", "included": false}, {"text": "Full Garansi*", "included": true}, {"text": "Akses API (Integrasi Aplikasi)", "included": false}]',
  '[]',
  '[{"name": "1 Akun Email Bisnis", "price": "Rp 50.000"}, {"name": "5 Akun Email Bisnis", "price": "Rp 150.000"}]',
  '{"light": "Rp 30.000 (ganti logo, icon, warna, teks kecil, dsb)", "heavy": "Rp 50.000 (merubah halaman, menambah halaman, atau struktur)", "extraPage": "Rp 50.000 / halaman"}',
  NULL,
  'kebutuhan pribadi: landing page, portofolio online, blog pribadi, CV digital, dan halaman profil.', 
  'Pesan Paket Basic (Rp 349K)', 
  'outline', 
  'Halo SOLVETA, saya tertarik untuk memesan Paket BASIC Rp 349K.', 
  1
),
(
  'standard', 
  'STANDARD', 
  NULL, 
  'Rp 699K', 
  '699K',
  '399k/tahun*',
  '1 Tahun',
  '3–5 Hari',
  FALSE, 
  '',
  '["Maksimal 4 Halaman, 3 Halaman Utama 1 Dashboard (tambah Rp 50k/Halaman)", "Revisi ringan 2x (Tidak berubah dari brief awal)", "Optimasi Speed (2x lebih cepat)", "Free Domain (my.id .site .cloud .online .shop .blog .store .org .digital)", "Free Hosting (Akses Dashboard, Tanpa login cPanel)", "Responsive Web (mobile friendly)", "SSL Security", "SEO Basic", "Full Garansi"]', 
  '[{"text": "Maksimal 4 Halaman, 3 Halaman Utama 1 Dashboard (tambah Rp 50k/Halaman)", "included": true}, {"text": "Revisi ringan 2x (Tidak berubah dari brief awal)", "included": true}, {"text": "Optimasi Speed (2x lebih cepat)", "included": true}, {"text": "Free Domain (my.id .site .cloud .online .shop .blog .store .org .digital)", "included": true}, {"text": "Free Hosting (Akses Dashboard, Tanpa login cPanel)", "included": true}, {"text": "Responsive Web (mobile friendly)", "included": true}, {"text": "SSL Security", "included": true}, {"text": "SEO Basic", "included": true}, {"text": "Full Garansi", "included": true}, {"text": "Akses API (Integrasi Aplikasi)", "included": false}]',
  '[]',
  '[]',
  '{"light": "Rp 30.000 (ganti logo, icon, warna, teks kecil, dsb)", "heavy": "Rp 50.000 (merubah halaman, menambah halaman, atau struktur)", "extraPage": "Rp 50.000 / halaman"}',
  NULL,
  'kebutuhan bisnis kecil, umkm, home industry', 
  'Pilih Standard', 
  'outline', 
  'Halo SOLVETA, saya tertarik dengan paket Standard Rp 699K. Mohon bantu konsultasi konsep websitenya.', 
  2
),
(
  'premium', 
  'PREMIUM', 
  NULL, 
  'Rp 964K', 
  '964K',
  '399k/tahun*',
  '1 Tahun',
  '+-5 Hari',
  FALSE, 
  '',
  '["Maksimal 7 Halaman (tambah Rp 50k/Halaman)", "Revisi ringan 2x (Tidak berubah dari brief awal)", "Optimasi Speed (3x lebih cepat)", "Free Desain Mockup", "Free Domain (.store .org .net .digital .it.com .media .agency .company)", "Free Hosting (Akses Dashboard, Tanpa login cPanel)", "2 Email Bisnis (nama@domain.com)", "Responsive Web (mobile friendly)", "SSL Security", "SEO Friendly", "Full Garansi*"]', 
  '[{"text": "Maksimal 7 Halaman (tambah Rp 50k/Halaman)", "included": true}, {"text": "Revisi ringan 2x (Tidak berubah dari brief awal)", "included": true}, {"text": "Optimasi Speed (3x lebih cepat)", "included": true}, {"text": "Free Desain Mockup", "included": true}, {"text": "Free Domain (.store .org .net .digital .it.com .media .agency .company)", "included": true}, {"text": "Free Hosting (Akses Dashboard, Tanpa login cPanel)", "included": true}, {"text": "2 Email Bisnis (nama@domain.com)", "included": true}, {"text": "Responsive Web (mobile friendly)", "included": true}, {"text": "SSL Security", "included": true}, {"text": "SEO Friendly", "included": true}, {"text": "Full Garansi*", "included": true}]',
  '[]',
  '[]',
  '{"light": "Rp 30.000 (ganti logo, icon, warna, teks kecil, dsb)", "heavy": "Rp 50.000 (merubah halaman, menambah halaman, atau struktur)", "extraPage": "Rp 50.000 / halaman"}',
  NULL,
  'company profile & bisnis produk', 
  'Pilih Premium', 
  'outline', 
  'Halo SOLVETA, saya tertarik dengan paket Premium Rp 964K. Bagaimana proses pengerjaannya?', 
  3
),
(
  'custom', 
  'PLATINUM', 
  'Mulai', 
  'Rp 1.5 jt', 
  '1.5 jt',
  'Harga mengikuti biaya dibutuhkan',
  '1 Tahun',
  'Wajib Meet (Fleksibel)',
  TRUE, 
  'Paling Populer',
  '["Free Iklan Google Ads", "Optimasi Speed (Super Cepat)", "Free Desain Mockup", "Free Domain (.id .co.id .tech .dev .com)", "Free Hosting (Akses Dashboard, Akses login cPanel)", "Unlimited Email Bisnis (nama@domain.com)", "Responsive Web (mobile friendly)", "SSL Security", "SEO Friendly", "Google Analytics", "Full Garansi*", "Akses API (Integrasi aplikasi)"]', 
  '[{"text": "Free Iklan Google Ads", "included": true}, {"text": "Optimasi Speed (Super Cepat)", "included": true}, {"text": "Free Desain Mockup", "included": true}, {"text": "Free Domain (.id .co.id .tech .dev .com)", "included": true}, {"text": "Free Hosting (Akses Dashboard, Akses login cPanel)", "included": true}, {"text": "Unlimited Email Bisnis (nama@domain.com)", "included": true}, {"text": "Responsive Web (mobile friendly)", "included": true}, {"text": "SSL Security", "included": true}, {"text": "SEO Friendly", "included": true}, {"text": "Google Analytics", "included": true}, {"text": "Full Garansi*", "included": true}, {"text": "Akses API (Integrasi aplikasi)", "included": true}]',
  '[]',
  '[]',
  '{"light": "Rp 30.000 (ganti logo, icon, warna, teks kecil, dsb)", "heavy": "Rp 50.000 (merubah halaman, menambah halaman, atau struktur)", "extraPage": "Rp 50.000 / halaman"}',
  NULL,
  'Start up, UMKM, CV, PT, Organisasi/Yayasan, Professional (siapa pun yang mempunyai kebutuhan layanan khusus yang tidak sesuai dengan 3 paket sebelumnya)', 
  'Hubungi Kami', 
  'red', 
  'Halo SOLVETA, saya ingin mendiskusikan kebutuhan Custom Website & Sistem Khusus untuk bisnis kami.', 
  4
);

-- ---------------------------------------------------------
-- 5. Table: portfolio_items (Karya & Portofolio — Synced from Supabase)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolio_items` (
  `id` VARCHAR(100) PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `image_url` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `tags_json` JSON DEFAULT NULL,
  `live_url` VARCHAR(255) DEFAULT 'https://www.solveta.asia',
  `sort_order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Delete old portfolio data for clean sync
DELETE FROM `portfolio_items`;

INSERT INTO `portfolio_items` (`id`, `title`, `category`, `image_url`, `description`, `tags_json`, `live_url`, `sort_order`)
VALUES
(
  'port-1', 
  'Landingpage Konservasi Akuatik', 
  'Landingpage', 
  '/images/portfolio/konservasi-akuatik.jpg', 
  'Landingpage untuk yayasan konservasi akuatik — desain modern, responsif, dan informatif.',
  '["Landingpage", "Yayasan", "Responsif"]', 
  'https://www.solveta.asia', 
  1
),
(
  'port-2', 
  'Squabumin.id', 
  'Custom System', 
  '/images/portfolio/squabumin.jpg', 
  'Website lengkap dengan custom system untuk Squabumin — suplemen kesehatan berbasis herbal.',
  '["Custom System", "Healthcare", "Product Verification"]', 
  'https://www.solveta.asia', 
  2
),
(
  'port-3', 
  'CuanGO', 
  'Web Application', 
  '/images/portfolio/cuango.jpg', 
  'Aplikasi web modern CuanGO — platform digital untuk kebutuhan finansial dan e-commerce.',
  '["Web App", "Fintech", "E-Commerce"]', 
  'https://www.solveta.asia', 
  3
),
(
  'port-4', 
  'POS Haltea Indonesia', 
  'Website & Presence', 
  '/images/portfolio/haltea.jpg', 
  'Website POS (Point of Sale) dan brand presence untuk Haltea Indonesia — produk teh herbal premium.',
  '["POS", "F&B", "Branding"]', 
  'https://www.solveta.asia', 
  4
),
(
  'port-5', 
  'Landing page Visual Genix', 
  'E-Commerce', 
  '/images/portfolio/visualgenix.jpg', 
  'Landingpage company profile Visual Genix | AI Affiliate Generator — desain kreatif dan modern.',
  '["E-Commerce", "Inventory", "WhatsApp Checkout"]', 
  'https://www.solveta.asia', 
  5
),
(
  'port-6', 
  'Tidurnyenyak.com', 
  'Corporate Profile', 
  '/images/portfolio/tidurnyenyak.jpg', 
  'Website company profile produk HerbaTDR dari CV Herbal Indo Utama — profesional dan SEO-friendly.',
  '["Fintech", "Corporate", "SEO Friendly"]', 
  'https://tidurnyenyak.com', 
  6
);

-- ---------------------------------------------------------
-- 6. Table: client_brands (Logo Klien / Partner Slider)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `client_brands` (
  `id` VARCHAR(100) PRIMARY KEY,
  `name` VARCHAR(150) DEFAULT NULL,
  `label` VARCHAR(150) DEFAULT NULL,
  `logo_image` VARCHAR(255) DEFAULT NULL,
  `scale` DECIMAL(3,2) DEFAULT 1.00,
  `sort_order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `client_brands` WHERE `id` LIKE 'brand-%' AND (`logo_image` IS NULL OR `logo_image` = '');

INSERT INTO `client_brands` (`id`, `name`, `label`, `logo_image`, `scale`, `sort_order`)
VALUES
('brand-1788254260324', '', '', '/uploads/brands/brand-1788254260324.png', 1.00, 1),
('brand-1788254350483', '', '', '/uploads/brands/brand-1788254350483.png', 1.00, 2),
('brand-1788254406941', '', '', '/uploads/brands/brand-1788254406941.png', 1.00, 3),
('brand-1788254482294', '', '', '/uploads/brands/brand-1788254482294.png', 1.00, 4),
('brand-1788254508761', '', '', '/uploads/brands/brand-1788254508761.png', 1.00, 5),
('brand-1788258571491', '', '', '/uploads/brands/brand-1788258571491.png', 1.00, 6),
('brand-1790081984303', '', '', '/uploads/brands/brand-1790081984303.png', 1.00, 7),
('brand-1790082015511', '', '', '/uploads/brands/brand-1790082015511.png', 1.00, 8),
('brand-1790082034279', '', '', '/uploads/brands/brand-1790082034279.png', 1.00, 9),
('brand-1790082051828', '', '', '/uploads/brands/brand-1790082051828.png', 1.00, 10)
ON DUPLICATE KEY UPDATE `logo_image`=VALUES(`logo_image`), `scale`=VALUES(`scale`);

-- ---------------------------------------------------------
-- 7. Table: customer_orders (Formulir Pemesanan 16 Field)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `customer_orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(150) NOT NULL,
  `whatsapp_number` VARCHAR(50) NOT NULL,
  `brand_name` VARCHAR(150) NOT NULL,
  `business_description` TEXT,
  `selected_package` VARCHAR(100),
  `website_type` VARCHAR(100),
  `pages_needed` TEXT,
  `design_color_theme` VARCHAR(150),
  `has_domain` VARCHAR(150),
  `has_logo` VARCHAR(150),
  `product_photos` TEXT,
  `example_websites` TEXT,
  `special_notes` TEXT,
  `website_and_domain_name` VARCHAR(150),
  `business_profile` TEXT,
  `status` ENUM('Baru', 'Dihubungi', 'Selesai') DEFAULT 'Baru',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 8. Table: service_profit_analyses (Analisis HPP & Profit — Updated prices)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `service_profit_analyses` (
  `id` VARCHAR(50) PRIMARY KEY,
  `service_name` VARCHAR(150) NOT NULL,
  `tier_id` VARCHAR(50) DEFAULT NULL,
  `selling_price` BIGINT NOT NULL DEFAULT 0,
  `labor_fee` BIGINT NOT NULL DEFAULT 0,
  `estimated_monthly_orders` INT NOT NULL DEFAULT 1,
  `costs_json` JSON DEFAULT NULL,
  `notes` TEXT DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `service_profit_analyses`;

INSERT INTO `service_profit_analyses` (`id`, `service_name`, `tier_id`, `selling_price`, `labor_fee`, `estimated_monthly_orders`, `costs_json`, `notes`)
VALUES
(
  'spa-basic', 
  'Paket Starter — 349K', 
  'basic', 
  349000, 
  100000, 
  5, 
  '[{"id": "c1", "name": "Domain .my.id (1 Tahun)", "amount": 15000, "category": "infrastruktur"}, {"id": "c2", "name": "Cloud Hosting SSD Allocation", "amount": 25000, "category": "infrastruktur"}]', 
  'Margin laba tinggi dengan waktu eksekusi singkat 1-2 hari.'
),
(
  'spa-standard', 
  'Paket Standard — 699K', 
  'standard', 
  699000, 
  200000, 
  8, 
  '[{"id": "c1", "name": "Domain .com (1 Tahun)", "amount": 135000, "category": "infrastruktur"}, {"id": "c2", "name": "Cloud Hosting NVMe Allocation", "amount": 35000, "category": "infrastruktur"}, {"id": "c3", "name": "Template License & Assets", "amount": 20000, "category": "lisensi_tools"}]', 
  'Paket terlaris dengan omset stabil dan profil klien kredibel.'
),
(
  'spa-premium', 
  'Paket Premium — 964K', 
  'premium', 
  964000, 
  300000, 
  4, 
  '[{"id": "c1", "name": "Domain .com (1 Tahun)", "amount": 135000, "category": "infrastruktur"}, {"id": "c2", "name": "Cloud Hosting NVMe High RAM", "amount": 50000, "category": "infrastruktur"}, {"id": "c3", "name": "Email Server Setup", "amount": 25000, "category": "operasional"}]', 
  'Paket company profile dan bisnis produk.'
),
(
  'spa-custom',
  'Paket Platinum — 1.5jt',
  'custom',
  1500000,
  500000,
  2,
  '[{"id": "c1", "name": "Domain .id/.co.id (1 Tahun)", "amount": 250000, "category": "infrastruktur"}, {"id": "c2", "name": "Cloud Hosting Dedicated", "amount": 100000, "category": "infrastruktur"}, {"id": "c3", "name": "Google Ads Setup", "amount": 150000, "category": "marketing"}]',
  'Paket enterprise untuk kebutuhan khusus, termasuk iklan dan API.'
);

-- ---------------------------------------------------------
-- 9. Table: project_transactions (Manajemen Invoice Klien)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `project_transactions` (
  `id` VARCHAR(50) PRIMARY KEY,
  `invoice_number` VARCHAR(100) NOT NULL UNIQUE,
  `date` DATE NOT NULL,
  `customer_name` VARCHAR(150) NOT NULL,
  `phone_number` VARCHAR(50) NOT NULL,
  `website_name` VARCHAR(150) DEFAULT NULL,
  `website_link` VARCHAR(255) DEFAULT NULL,
  `service_price` BIGINT NOT NULL DEFAULT 0,
  `status` ENUM('Terlaksana', 'Progress', 'Batal') DEFAULT 'Progress',
  `cost_components_json` JSON DEFAULT NULL,
  `notes` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `project_transactions` (`id`, `invoice_number`, `date`, `customer_name`, `phone_number`, `website_name`, `website_link`, `service_price`, `status`, `cost_components_json`, `notes`)
VALUES
(
  'tx-1', 
  'INV-2026-001', 
  '2026-09-01', 
  'Bambang Wijaya', 
  '081234567890', 
  'Cuango Fashion Official', 
  'https://cuango.com', 
  749000, 
  'Terlaksana', 
  '[{"id": "comp-1", "name": "Pembuatan Website Premium 10 Halaman", "cost": 749000, "note": "Termasuk Domain .com & SSL"}, {"id": "comp-2", "name": "Setup Akun WhatsApp Direct Checkout", "cost": 0, "note": "Gratis Bonus"}]', 
  'Pembayaran lunas via transfer BCA.'
),
(
  'tx-2', 
  'INV-2026-002', 
  '2026-09-15', 
  'Siti Rahmawati', 
  '085678901234', 
  'Haltea Herbal Wellness', 
  'https://haltea.com', 
  549000, 
  'Terlaksana', 
  '[{"id": "comp-1", "name": "Pembuatan Website Standard Multi-Page", "cost": 549000, "note": "Termasuk Domain .com"}]', 
  'Proyek selesai tepat waktu 4 hari kerja.'
)
ON DUPLICATE KEY UPDATE `invoice_number`=VALUES(`invoice_number`);

-- ---------------------------------------------------------
-- 10. Table: addon_services (Layanan Tambahan — from Supabase)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `addon_services` (
  `id` VARCHAR(100) PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `base_price` BIGINT NOT NULL DEFAULT 0,
  `third_party_cost` BIGINT DEFAULT 0,
  `price_description` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `addon_services`;

INSERT INTO `addon_services` (`id`, `name`, `category`, `base_price`, `price_description`, `sort_order`)
VALUES
('addon-1', 'Revisi ringan tambahan', 'revision', 30000, 'Rp30K / revisi', 1),
('addon-2', 'Revisi berat tambahan', 'revision', 50000, 'Rp50K / revisi', 2),
('addon-3', 'Tambah 1 halaman', 'page', 50000, 'Rp50K / halaman', 3),
('addon-4', 'WhatsApp Business API', 'api', 150000, 'Mulai Rp150K', 4),
('addon-5', 'Google Maps API / Places / Routes', 'api', 150000, 'Mulai Rp150K', 5),
('addon-6', 'API sederhana', 'api', 150000, 'Mulai Rp150K', 6),
('addon-7', 'API kompleks', 'api', 250000, 'Mulai Rp250K', 7),
('addon-8', 'Payment Gateway', 'api', 250000, 'Mulai Rp250K', 8),
('addon-9', 'Email / SMTP', 'email', 50000, 'Mulai Rp50K', 9),
('addon-10', 'AI API', 'api', 250000, 'Mulai Rp250K', 10);
