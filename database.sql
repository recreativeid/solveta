-- =========================================================
-- SOLVETA DATABASE SCHEMA (MySQL 5.7+ / 8.0+ / MariaDB)
-- Production Ready for cPanel Shared Hosting (Localhost)
-- Database: solveta_db
-- =========================================================

CREATE DATABASE IF NOT EXISTS `solveta_db` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `solveta_db`;

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

-- Default login: admin / admin123
INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `display_name`)
VALUES (1, 'admin', '$2y$10$3W.Otc4LGTgwkh.3d9duq.24hwmqRmBj.6NDLwpaeaEBHvz.yRi1y', 'Administrator SOLVETA')
ON DUPLICATE KEY UPDATE `username`=VALUES(`username`);

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
) ON DUPLICATE KEY UPDATE `id`=`id`;

-- ---------------------------------------------------------
-- 3. Table: contact_info (Nomor WhatsApp & Link Kontak)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `contact_info` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `whatsapp_number` VARCHAR(50) NOT NULL DEFAULT '6285719663154',
  `whatsapp_display` VARCHAR(50) NOT NULL DEFAULT '+62 857-1966-3154',
  `website_url` VARCHAR(255) NOT NULL DEFAULT 'www.solveta.asia',
  `email` VARCHAR(255) DEFAULT 'halo@solveta.asia',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contact_info` (`id`, `whatsapp_number`, `whatsapp_display`, `website_url`, `email`)
VALUES (
  1,
  '6285719663154',
  '+62 857-1966-3154',
  'www.solveta.asia',
  'halo@solveta.asia'
) ON DUPLICATE KEY UPDATE `id`=`id`;

-- ---------------------------------------------------------
-- 4. Table: pricing_tiers (Paket & Harga Website)
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

INSERT INTO `pricing_tiers` (`id`, `name`, `price_prefix`, `price`, `price_badge`, `renewal_price`, `active_period`, `delivery_time`, `popular`, `popular_label`, `features_json`, `checklist_json`, `domain_addons_json`, `email_addons_json`, `revision_rules_json`, `custom_note`, `suitability`, `button_label`, `button_variant`, `wa_message`, `sort_order`)
VALUES
(
  'basic', 
  'BASIC', 
  NULL, 
  'Rp 299K', 
  'Paling Hemat',
  'Rp 199.000 / tahun',
  '1 Tahun Aktif',
  '2-3 Hari Kerja',
  FALSE, 
  '',
  '["Landing Page 1 Halaman (Single-Page)", "Desain Responsif Mobile & Desktop", "Tombol WhatsApp Langsung Terhubung", "Free Domain .my.id (1 Tahun)", "SSL Security & Cloud Server"]', 
  '[{"text": "Landing page 1 halaman panjang", "included": true}, {"text": "Domain .my.id 1 tahun", "included": true}, {"text": "Hosting Cloud SSD 1 tahun", "included": true}, {"text": "Tombol Chat WhatsApp", "included": true}, {"text": "Multi-halaman navigasi", "included": false}, {"text": "Email bisnis nama domain", "included": false}]',
  '[{"name": ".com", "price": "+Rp 150.000"}, {"name": ".id", "price": "+Rp 200.000"}]',
  '[{"name": "Email Bisnis 1 Akun", "price": "+Rp 50.000/thn"}]',
  '{"light": "Maksimal 2x revisi teks & foto minor", "heavy": "Revisi layout besar dikenakan biaya tambahan"}',
  'Cocok bagi pelaku usaha baru yang ingin memiliki identitas digital cepat tanpa modal besar.',
  'Freelancer, Konsultan, Usaha Jasa Baru yang butuh online cepat.', 
  'Pilih Basic', 
  'outline', 
  'Halo SOLVETA, saya tertarik dengan paket Basic Rp299K. Mohon info langkah pengerjaannya.', 
  1
),
(
  'standard', 
  'STANDARD', 
  NULL, 
  'Rp 549K', 
  'Best Seller',
  'Rp 299.000 / tahun',
  '1 Tahun Aktif',
  '3-5 Hari Kerja',
  TRUE, 
  'Paling Populer',
  '["Website Multi-Halaman (Home, About, Services, Contact)", "Desain Profesional & Responsif", "Integrasi Google Maps & Media Sosial", "Free Domain .com (1 Tahun)", "SSL Security & Cloud Hosting Cepat"]', 
  '[{"text": "Hingga 5 Halaman Konten", "included": true}, {"text": "Free Domain .com (1 Tahun)", "included": true}, {"text": "Hosting Cepat SSD NVMe", "included": true}, {"text": "Integrasi Google Maps & Medsos", "included": true}, {"text": "SEO On-Page Dasar", "included": true}, {"text": "Fitur Katalog Produk Dinamis", "included": false}]',
  '[{"name": ".id (Indonesia)", "price": "+Rp 100.000"}]',
  '[{"name": "Email Bisnis (halo@namabisnis.com)", "price": "+Rp 75.000/thn"}]',
  '{"light": "Maksimal 3x revisi konten & layout", "heavy": "Perubahan struktur total di luar brief dikenakan biaya"}',
  'Paket paling direkomendasikan untuk membangun kredibilitas dan kepercayaan calon klien di era digital.',
  'UMKM, Startup, Klinik, atau Agensi yang butuh kredibilitas tinggi.', 
  'Pilih Standard', 
  'red', 
  'Halo SOLVETA, saya tertarik dengan paket Standard Rp549K. Mohon bantu konsultasi konsep websitenya.', 
  2
),
(
  'premium', 
  'PREMIUM', 
  NULL, 
  'Rp 749K', 
  'Lengkap & Power',
  'Rp 399.000 / tahun',
  '1 Tahun Aktif',
  '5-7 Hari Kerja',
  FALSE, 
  '',
  '["Katalog Produk / Portofolio Lengkap", "Fitur Pencarian & Filter Kategori", "Form Order terhubung ke WhatsApp Otomatis", "Free Domain .com (1 Tahun)", "Gratis 1 Akun Email Bisnis Profesional"]', 
  '[{"text": "Hingga 10 Halaman / Katalog Produk", "included": true}, {"text": "Pencarian & Filter Interaktif", "included": true}, {"text": "Checkout / Order via WhatsApp Otomatis", "included": true}, {"text": "Free Domain .com & SSL", "included": true}, {"text": "1 Akun Email Bisnis Resmi", "included": true}, {"text": "Sistem Database Kompleks", "included": false}]',
  '[{"name": ".co.id (Butuh Legalitas)", "price": "+Rp 150.000"}]',
  '[{"name": "Tambahan Email Bisnis", "price": "+Rp 50.000/akun"}]',
  '{"light": "Maksimal 4x revisi materi", "heavy": "Revisi fitur sistem tambahan dihitung add-on"}',
  'Solusi terbaik bagi penjual produk fisik, katalog arsitektur, dan bisnis retail online.',
  'Toko Online (WhatsApp Based), Katalog Properti, Dealer Kendaraan.', 
  'Pilih Premium', 
  'outline', 
  'Halo SOLVETA, saya tertarik dengan paket Premium Rp749K. Bagaimana proses pengerjaan katalog produknya?', 
  3
),
(
  'custom', 
  'CUSTOM', 
  'Mulai', 
  'Rp 1,5 Juta', 
  'Enterprise Grade',
  'Sesuai Kapasitas Cloud Server',
  'Fleksibel',
  '1-3 Minggu Kerja',
  FALSE, 
  '',
  '["Sistem Database Custom (Gudang, Karyawan, Kasir)", "Dashboard Admin & Laporan Otomatis", "Integrasi API Pihak Ketiga & Notifikasi WA Gateway", "Arsitektur Keamanan Tingkat Lanjut & High Performance"]', 
  '[{"text": "Arsitektur Database Terdedikasi", "included": true}, {"text": "Dashboard Manajemen & Laporan", "included": true}, {"text": "Sistem Role & Multi-User Akses", "included": true}, {"text": "Integrasi WhatsApp API Gateway", "included": true}, {"text": "Maintenance & Backup Berkala", "included": true}, {"text": "Support Teknis Prioritas", "included": true}]',
  '[{"name": "Domain Apapun (.com / .id / .co.id)", "price": "Termasuk"}]',
  '[{"name": "Email Bisnis Unlimited", "price": "Termasuk"}]',
  '{"light": "Garansi bug & maintenance selama 3 bulan", "heavy": "Fitur baru modul tambahan dihitung change-request"}',
  'Sistem dirancang khusus sesuai alur operasional dan tantangan spesifik bisnis Anda.',
  'Perusahaan dengan kebutuhan operasional spesifik, Manajemen Stok, Sistem Absensi, ERP.', 
  'Hubungi Kami', 
  'outline', 
  'Halo SOLVETA, saya ingin mendiskusikan kebutuhan Custom Website & Sistem Khusus untuk bisnis kami.', 
  4
)
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), `price`=VALUES(`price`), `features_json`=VALUES(`features_json`);

-- ---------------------------------------------------------
-- 5. Table: portfolio_items (Karya & Portofolio Website)
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

INSERT INTO `portfolio_items` (`id`, `title`, `category`, `image_url`, `description`, `tags_json`, `live_url`, `sort_order`)
VALUES
(
  'port-1', 
  'Cuango — Premium Fashion & Apparel Showcase', 
  'E-Commerce', 
  '/images/portfolio/cuango.jpg', 
  'Platform showcase brand fashion modern dengan katalog interaktif, filter varian ukuran & warna, serta integrasi tombol direct checkout ke WhatsApp.', 
  '["Fashion", "Catalog", "WhatsApp Checkout"]', 
  'https://www.solveta.asia', 
  1
),
(
  'port-2', 
  'Haltea — Healthy Herbal Tea & Lifestyle Brand', 
  'Website & Presence', 
  '/images/portfolio/haltea.jpg', 
  'Landing page estetis dan responsif untuk produk teh herbal premium dengan visual storytelling, testimoni pelanggan, dan kalkulator estimasi pembelian.', 
  '["Branding", "Landing Page", "Health & Wellness"]', 
  'https://www.solveta.asia', 
  2
),
(
  'port-3', 
  'Konservasi Akuatik — Portal Edukasi & Donasi Lingkungan', 
  'Corporate Profile', 
  '/images/portfolio/konservasi-akuatik.jpg', 
  'Website resmi lembaga konservasi kelautan dengan sistem peta zona terumbu karang, publikasi riset berkala, dan formulir pendaftaran relawan terpadu.', 
  '["NGO", "Conservation", "Interactive Maps"]', 
  'https://www.solveta.asia', 
  3
),
(
  'port-4', 
  'Squabumin — Suplemen Kesehatan & Farmasi Herbal', 
  'Website & Presence', 
  '/images/portfolio/squabumin.jpg', 
  'Company profile dan product landing page farmasi herbal berstandar BPOM dengan fitur verifikasi keaslian produk dan integrasi distribusi klinik.', 
  '["Healthcare", "Pharma", "Product Verification"]', 
  'https://www.solveta.asia', 
  4
),
(
  'port-5', 
  'Tidur Nyenyak — Bedding & Home Living Commerce', 
  'E-Commerce', 
  '/images/portfolio/tidurnyenyak.jpg', 
  'E-commerce perlengkapan tidur mewah dengan navigasi multi-kategori, sistem ulasan bintang pelanggan, dan perhitungan ongkir otomatis.', 
  '["Home Living", "E-Commerce", "Customer Reviews"]', 
  'https://www.solveta.asia', 
  5
),
(
  'port-6', 
  'VisualGenix — Digital Creative Studio & Media Agency', 
  'Corporate Profile', 
  '/images/portfolio/visualgenix.jpg', 
  'Portofolio agensi multimedia modern dengan transisi sinematik, video hero showcase, dan portal penerimaan brief proyek kreatif otomatis.', 
  '["Creative Agency", "Portfolio Showcase", "Dark Modern"]', 
  'https://www.solveta.asia', 
  6
)
ON DUPLICATE KEY UPDATE `title`=VALUES(`title`), `description`=VALUES(`description`), `image_url`=VALUES(`image_url`);

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

INSERT INTO `client_brands` (`id`, `name`, `label`, `logo_image`, `scale`, `sort_order`)
VALUES
('brand-1', 'Cuango Official', 'Fashion & Apparel', NULL, 1.00, 1),
('brand-2', 'Haltea Herbal', 'Food & Beverage', NULL, 1.00, 2),
('brand-3', 'Yayasan Konservasi Akuatik', 'Environmental NGO', NULL, 1.00, 3),
('brand-4', 'Squabumin Indonesia', 'Pharmaceuticals', NULL, 1.00, 4),
('brand-5', 'Tidur Nyenyak Bedding', 'Home & Living', NULL, 1.00, 5),
('brand-6', 'VisualGenix Studio', 'Creative & Media', NULL, 1.00, 6),
('brand-7', 'MedikaCare Group', 'Healthcare System', NULL, 1.00, 7),
('brand-8', 'Nusantara Logistics', 'Supply Chain', NULL, 1.00, 8),
('brand-9', 'UrbanVibe Properties', 'Real Estate', NULL, 1.00, 9),
('brand-10', 'Apex Global Industri', 'Manufacturing', NULL, 1.00, 10)
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`);

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
-- 8. Table: service_profit_analyses (Analisis HPP & Profit)
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

INSERT INTO `service_profit_analyses` (`id`, `service_name`, `tier_id`, `selling_price`, `labor_fee`, `estimated_monthly_orders`, `costs_json`, `notes`)
VALUES
(
  'spa-basic', 
  'Paket Basic — 299K', 
  'basic', 
  299000, 
  100000, 
  5, 
  '[{"id": "c1", "name": "Domain .my.id (1 Tahun)", "amount": 15000, "category": "infrastruktur"}, {"id": "c2", "name": "Cloud Hosting SSD Allocation", "amount": 25000, "category": "infrastruktur"}]', 
  'Margin laba tinggi dengan waktu eksekusi singkat 1-2 hari.'
),
(
  'spa-standard', 
  'Paket Standard — 549K', 
  'standard', 
  549000, 
  200000, 
  8, 
  '[{"id": "c1", "name": "Domain .com (1 Tahun)", "amount": 135000, "category": "infrastruktur"}, {"id": "c2", "name": "Cloud Hosting NVMe Allocation", "amount": 35000, "category": "infrastruktur"}, {"id": "c3", "name": "Template License & Assets", "amount": 20000, "category": "lisensi_tools"}]', 
  'Paket terlaris dengan omset stabil dan profil klien kredibel.'
),
(
  'spa-premium', 
  'Paket Premium — 749K', 
  'premium', 
  749000, 
  300000, 
  4, 
  '[{"id": "c1", "name": "Domain .com (1 Tahun)", "amount": 135000, "category": "infrastruktur"}, {"id": "c2", "name": "Cloud Hosting NVMe High RAM", "amount": 50000, "category": "infrastruktur"}, {"id": "c3", "name": "Email Server Setup", "amount": 25000, "category": "operasional"}]', 
  'Paket katalog produk toko online.'
)
ON DUPLICATE KEY UPDATE `service_name`=VALUES(`service_name`), `selling_price`=VALUES(`selling_price`);

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
