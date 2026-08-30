-- ==============================================================================
-- SOLVETA AGENCY — SUPABASE CLOUD DATABASE SCHEMA
-- Jalankan skrip ini di: Supabase Dashboard -> SQL Editor -> New Query -> Run
-- ==============================================================================

-- 1. Buat Tabel Penyimpanan Data CMS SOLVETA
CREATE TABLE IF NOT EXISTS site_content (
  id TEXT PRIMARY KEY,
  data JSONB NOT NULL,
  updated_at TIMESTAMP WITH TIME ZONE DEFAULT timezone('utc'::text, now()) NOT NULL
);

-- 2. Aktifkan Row Level Security (RLS)
ALTER TABLE site_content ENABLE ROW LEVEL SECURITY;

-- 3. Kebijakan Akses Baca (Siapa saja / Pengunjung Web dapat membaca data)
CREATE POLICY "Allow public read access" 
ON site_content FOR SELECT 
USING (true);

-- 4. Kebijakan Akses Tulis (Developer dapat memperbarui data secara langsung)
CREATE POLICY "Allow public insert and update access" 
ON site_content FOR ALL 
USING (true) 
WITH CHECK (true);

-- 5. Masukkan Data Bawaan Awal SOLVETA (Jika belum ada)
INSERT INTO site_content (id, data)
VALUES (
  'solveta_cms_main',
  '{
    "contact": {
      "whatsappNumber": "6285719663154",
      "whatsappDisplay": "+62 857-1966-3154",
      "websiteUrl": "www.solveta.site",
      "email": "halo@solveta.site"
    },
    "siteCopy": {
      "siteLogo": "",
      "heroEyebrow": "SOLVE TECHNOLOGY AGENCY",
      "heroHeadline": "Mengubah Tantangan Bisnis Menjadi Solusi Digital.",
      "heroSubtitle": "Banyak bisnis terhambat oleh proses manual, informasi yang tidak terstruktur, dan kurangnya integrasi. SOLVETA hadir untuk menyederhanakan masalah kompleks melalui solusi digital dan otomasi yang efisien.",
      "portfolioTitle": "Portofolio Proyek Website Yang Telah Kami Bangun",
      "portfolioSubtitle": "",
      "marqueeTitle": "DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG",
      "marqueeSpeed": 35
    },
    "categories": [
      "Custom System",
      "Web Application",
      "Website & Presence",
      "E-Commerce",
      "Corporate Profile"
    ]
  }'::jsonb
)
ON CONFLICT (id) DO NOTHING;
