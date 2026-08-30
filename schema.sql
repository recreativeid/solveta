-- =========================================================
-- SOLVETA DATABASE SCHEMA (MySQL / MariaDB)
-- Website & CMS Dynamic Content Database
-- =========================================================

CREATE DATABASE IF NOT EXISTS `solveta_db` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `solveta_db`;

-- ---------------------------------------------------------
-- 1. Table: site_copy (Teks Headline, Subtitle, & Narasi)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_copy` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `hero_eyebrow` VARCHAR(255) DEFAULT 'SOLVE TECHNOLOGY AGENCY',
  `hero_headline` TEXT NOT NULL,
  `hero_subtitle` TEXT NOT NULL,
  `portfolio_title` VARCHAR(255) DEFAULT 'Portofolio Proyek Website Yang Telah Kami Bangun',
  `portfolio_subtitle` VARCHAR(255) DEFAULT '',
  `consultation_title` VARCHAR(255) DEFAULT 'TIDAK TAHU HARUS MULAI DARI MANA?',
  `consultation_desc` TEXT,
  `marquee_title` VARCHAR(255) DEFAULT 'DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initial data for site_copy
INSERT INTO `site_copy` (`id`, `hero_eyebrow`, `hero_headline`, `hero_subtitle`, `portfolio_title`, `portfolio_subtitle`, `consultation_title`, `consultation_desc`, `marquee_title`)
VALUES (
  1,
  'SOLVE TECHNOLOGY AGENCY',
  'Mengubah Tantangan Bisnis Menjadi Solusi Digital.',
  'Banyak bisnis terhambat oleh proses manual, informasi yang tidak terstruktur, dan kurangnya integrasi. SOLVETA hadir untuk menyederhanakan masalah kompleks melalui solusi digital dan otomasi yang efisien.',
  'Portofolio Proyek Website Yang Telah Kami Bangun',
  '',
  'TIDAK TAHU HARUS MULAI DARI MANA?',
  'Konsultasikan masalah bisnis Anda secara gratis. Kami akan merekomendasikan langkah paling efisien untuk memulainya.',
  'DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG'
) ON DUPLICATE KEY UPDATE `id`=`id`;


-- ---------------------------------------------------------
-- 2. Table: contact_info (Nomor WhatsApp & Link Kontak)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `contact_info` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `whatsapp_number` VARCHAR(50) NOT NULL DEFAULT '6285719663154',
  `whatsapp_display` VARCHAR(50) NOT NULL DEFAULT '+62 857-1966-3154',
  `website_url` VARCHAR(255) NOT NULL DEFAULT 'www.solveta.site',
  `email` VARCHAR(255) DEFAULT 'halo@solveta.site',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initial data for contact_info
INSERT INTO `contact_info` (`id`, `whatsapp_number`, `whatsapp_display`, `website_url`, `email`)
VALUES (
  1,
  '6285719663154',
  '+62 857-1966-3154',
  'www.solveta.site',
  'halo@solveta.site'
) ON DUPLICATE KEY UPDATE `id`=`id`;


-- ---------------------------------------------------------
-- 3. Table: pricing_tiers (Paket & Harga Website)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pricing_tiers` (
  `id` VARCHAR(50) PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `price_prefix` VARCHAR(50) DEFAULT NULL,
  `price` VARCHAR(100) NOT NULL,
  `popular` BOOLEAN DEFAULT FALSE,
  `features_json` JSON NOT NULL,
  `suitability` TEXT NOT NULL,
  `button_label` VARCHAR(100) NOT NULL,
  `button_variant` ENUM('red', 'outline') DEFAULT 'outline',
  `wa_message` TEXT NOT NULL,
  `sort_order` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initial data for pricing_tiers
INSERT INTO `pricing_tiers` (`id`, `name`, `price_prefix`, `price`, `popular`, `features_json`, `suitability`, `button_label`, `button_variant`, `wa_message`, `sort_order`)
VALUES
('basic', 'BASIC', NULL, 'Rp 299K', FALSE, '["Company Profile (1 Halaman)", "Desain Template Premium", "Tombol WhatsApp Langsung", "Free Domain .my.id (1 Tahun)"]', 'Freelancer, Konsultan, Bisnis Jasa Baru yang butuh online cepat.', 'Pilih Basic', 'outline', 'Halo SOLVETA, saya tertarik dengan paket Basic Rp299K', 1),
('standard', 'STANDARD', NULL, 'Rp 549K', TRUE, '["Website Multi-Halaman (Home, About, Services, Contact)", "Desain Profesional & Responsif", "Integrasi Google Maps & Media Sosial", "Free Domain .com (1 Tahun)"]', 'UMKM, Startup, Klinik, atau Agensi yang butuh kredibilitas tinggi.', 'Pilih Standard', 'red', 'Halo SOLVETA, saya tertarik dengan paket Standard Rp549K', 2),
('premium', 'PREMIUM', NULL, 'Rp 749K', FALSE, '["Katalog Produk / Portofolio Lengkap", "Fitur Pencarian & Filter Produk", "Form Order terhubung ke WhatsApp", "Free Domain .com (1 Tahun)"]', 'Toko Online (WhatsApp Based), Katalog Properti, Dealer Kendaraan.', 'Pilih Premium', 'outline', 'Halo SOLVETA, saya tertarik dengan paket Premium Rp749K', 3),
('custom', 'CUSTOM', 'Mulai', 'Rp 1,5 Juta', FALSE, '["Sistem Database Custom (Gudang, Karyawan, dll)", "Dashboard Admin & Laporan Otomatis", "Integrasi API Pihak Ketiga (Opsional)", "Keamanan Tingkat Lanjut"]', 'Perusahaan dengan kebutuhan operasional spesifik, Manajemen Stok, Sistem Absensi.', 'Hubungi Kami', 'outline', 'Halo SOLVETA, saya ingin mendiskusikan kebutuhan Custom Website & Sistem', 4)
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), `price`=VALUES(`price`), `features_json`=VALUES(`features_json`);


-- ---------------------------------------------------------
-- 4. Table: portfolio_items (Karya & Portofolio Website)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolio_items` (
  `id` VARCHAR(100) PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `image_url` LONGTEXT NOT NULL,
  `description` TEXT NOT NULL,
  `tags_json` JSON DEFAULT NULL,
  `live_url` VARCHAR(255) DEFAULT 'https://www.solveta.site',
  `sort_order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initial data for portfolio_items
INSERT INTO `portfolio_items` (`id`, `title`, `category`, `image_url`, `description`, `tags_json`, `live_url`, `sort_order`)
VALUES
('port-1', 'MedikaCare — Sistem Manajemen Klinik Terintegrasi', 'Custom System', 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&auto=format&fit=crop&q=80', 'Digitalisasi rekam medis pasien, antrean online WhatsApp, dan sistem kasir klinik terpadu.', '["Healthcare", "Database", "Automation"]', 'https://www.solveta.site', 1),
('port-2', 'Nusantara Logistics — Portal Tracking & Fleet Dashboard', 'Web Application', 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80', 'Platform pelacakan pengiriman kargo real-time dengan integrasi WhatsApp notification gateway.', '["Logistics", "Real-Time", "Dashboard"]', 'https://www.solveta.site', 2),
('port-3', 'UrbanVibe Property — Website Katalog Properti Premium', 'Website & Presence', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&auto=format&fit=crop&q=80', 'Website interaktif listing properti dengan filter radius peta, virtual tour 360, dan direct order WhatsApp.', '["Real Estate", "Search Filter", "Catalog"]', 'https://www.solveta.site', 3),
('port-4', 'Kopi Nusantara — E-Commerce & POS Inventory Sync', 'E-Commerce', 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&auto=format&fit=crop&q=80', 'Sinkronisasi otomatis antara stok toko offline dan pesanan online multi-channel.', '["E-Commerce", "Inventory", "WhatsApp Checkout"]', 'https://www.solveta.site', 4),
('port-5', 'Artha Finansial — Corporate Profile & Client Portal', 'Corporate Profile', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&auto=format&fit=crop&q=80', 'Company profile modern ultra-fast dengan portal pengajuan konsultasi keuangan otomatis.', '["Fintech", "Corporate", "SEO Friendly"]', 'https://www.solveta.site', 5)
ON DUPLICATE KEY UPDATE `title`=VALUES(`title`), `description`=VALUES(`description`);


-- ---------------------------------------------------------
-- 5. Table: client_brands (Logo Klien / Partner Slider)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `client_brands` (
  `id` VARCHAR(100) PRIMARY KEY,
  `name` VARCHAR(150) DEFAULT NULL,
  `label` VARCHAR(150) DEFAULT NULL,
  `logo_image` LONGTEXT DEFAULT NULL,
  `sort_order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initial data for client_brands
INSERT INTO `client_brands` (`id`, `name`, `label`, `logo_image`, `sort_order`)
VALUES
('brand-1', 'MedikaCare Group', 'Healthcare System', NULL, 1),
('brand-2', 'Nusantara Logistics', 'Supply Chain & Tracking', NULL, 2),
('brand-3', 'UrbanVibe Properties', 'Real Estate & Listings', NULL, 3),
('brand-4', 'Kopi Nusantara POS', 'Retail & E-Commerce', NULL, 4),
('brand-5', 'Artha Finansial', 'Fintech & Corporate', NULL, 5),
('brand-6', 'Apex Global Industri', 'Manufacturing ERP', NULL, 6),
('brand-7', 'Sinergi Media Kreatif', 'Digital Marketing', NULL, 7),
('brand-8', 'Penta Farmasi', 'Inventory Automation', NULL, 8),
('brand-9', 'Vortex Tech Labs', 'SaaS & AI', NULL, 9),
('brand-10', 'Prima Mandiri Distribusi', 'B2B Commerce', NULL, 10)
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`);
