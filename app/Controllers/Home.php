<?php

namespace App\Controllers;

use App\Models\SiteCopyModel;
use App\Models\ContactModel;
use App\Models\PricingModel;
use App\Models\PortfolioModel;
use App\Models\BrandModel;
use App\Models\AddonModel;
use App\Models\ArticleModel;

class Home extends BaseController
{
    /**
     * 1. Beranda (Home) — SOLVETA Company Profile
     */
    public function index()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $portfolioModel = new PortfolioModel();
        $brandModel = new BrandModel();
        $pricingModel = new PricingModel();
        $articleModel = new ArticleModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'portfolios' => $portfolioModel->getItems(),
            'brands' => $brandModel->getBrands(),
            'tiers' => $pricingModel->getTiers('id'),
            'articles' => array_slice($articleModel->getArticles(), 0, 3),
            'title' => 'SOLVETA — Solve Technology Agency | We Solve. You Grow.',
            'meta_description' => 'Membantu bisnis berkembang melalui website, aplikasi, sistem digital, dan solusi teknologi yang dirancang sesuai kebutuhan.',
            'current_page' => 'home',
        ];

        return view('home_company', $data);
    }

    /**
     * 2. Layanan (Services Directory & Overview)
     */
    public function layanan()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $pricingModel = new PricingModel();
        $addonModel = new AddonModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'tiers' => $pricingModel->getTiers('id'),
            'addons' => $addonModel->getAddons(),
            'title' => 'Katalog Layanan Teknologi & Solusi Digital | SOLVETA',
            'meta_description' => 'Temukan solusi teknologi SOLVETA: Paket Starter, Standard (Company Profile & Web Berita), Premium (E-Commerce), hingga Platinum (Enterprise SaaS & AI).',
            'current_page' => 'layanan',
            'tier_active' => 'all',
        ];

        return view('layanan', $data);
    }

    /**
     * 2a. Layanan Starter (Landing Page & Web Promosi UMKM)
     */
    public function layananStarter()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'title' => 'Layanan Starter — Landing Page & Web Promosi UMKM | SOLVETA',
            'meta_description' => 'Paket website Starter SOLVETA: landing page 1 halaman berkonversi tinggi, loading cepat, integrasi WhatsApp direct, domain & hosting gratis untuk UMKM rintisan.',
            'current_page' => 'layanan',
            'tier_active' => 'starter',
        ];

        return view('layanan/starter', $data);
    }

    /**
     * 2b. Layanan Standard (Company Profile Korporasi & Portal Berita)
     */
    public function layananStandard()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'title' => 'Layanan Standard — Company Profile Korporasi & Web Berita | SOLVETA',
            'meta_description' => 'Paket website Standard SOLVETA: company profile perusahaan (PT/CV), portal media siber & berita, web jasa profesional, katalog B2B, CMS admin mandiri & SEO Google.',
            'current_page' => 'layanan',
            'tier_active' => 'standard',
        ];

        return view('layanan/standard', $data);
    }

    /**
     * 2c. Layanan Premium (E-Commerce Toko Online & Custom Booking)
     */
    public function layananPremium()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'title' => 'Layanan Premium — E-Commerce, Booking Platform & Custom CRM | SOLVETA',
            'meta_description' => 'Paket website Premium SOLVETA: toko online terintegrasi RajaOngkir otomatis, payment gateway QRIS/Virtual Account, booking reservasi jadwal, dan otomasi order WhatsApp.',
            'current_page' => 'layanan',
            'tier_active' => 'premium',
        ];

        return view('layanan/premium', $data);
    }

    /**
     * 2d. Layanan Platinum (Enterprise Cloud SaaS, ERP & AI Automation)
     */
    public function layananPlatinum()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'title' => 'Layanan Platinum — Enterprise SaaS, Custom ERP & AI Automation | SOLVETA',
            'meta_description' => 'Paket teknologi Platinum SOLVETA: arsitektur web application skala besar, sistem ERP multi-cabang, POS hybrid offline-first, dan kecerdasan buatan (AI workflow automation).',
            'current_page' => 'layanan',
            'tier_active' => 'platinum',
        ];

        return view('layanan/platinum', $data);
    }

    /**
     * 3. Portofolio (Portfolio)
     */
    public function portfolio()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $portfolioModel = new PortfolioModel();
        $brandModel = new BrandModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'portfolios' => $portfolioModel->getItems(),
            'brands' => $brandModel->getBrands(),
            'title' => 'Portofolio Website, Aplikasi & Proyek Digital | SOLVETA',
            'meta_description' => 'Jelajahi portofolio SOLVETA dalam pengembangan website bisnis, aplikasi, sistem informasi, platform digital, dan berbagai solusi teknologi.',
            'current_page' => 'portfolio',
        ];

        return view('portfolio', $data);
    }

    /**
     * 4. Tentang Kami (About Us)
     */
    public function tentang()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $brandModel = new BrandModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'brands' => $brandModel->getBrands(),
            'title' => 'Tentang SOLVETA — Digital Technology Agency',
            'meta_description' => 'Kenali SOLVETA, digital technology agency yang membantu bisnis dan organisasi berkembang melalui website, aplikasi, dan solusi teknologi digital.',
            'current_page' => 'tentang',
        ];

        return view('tentang', $data);
    }

    /**
     * 5. Karir (Careers & Collaboration)
     */
    public function karir()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $careerModel = new \App\Models\CareerModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'career_data' => $careerModel->getCareerData(),
            'jobs' => $careerModel->getJobs(),
            'title' => 'Karir & Peluang Kolaborasi — SOLVETA',
            'meta_description' => 'Informasi lowongan karir, magang, dan peluang kolaborasi proyek teknologi di SOLVETA.',
            'current_page' => 'karir',
        ];

        return view('karir', $data);
    }

    /**
     * 6. Kontak (Contact & Consultation)
     */
    public function kontak()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'title' => 'Kontak SOLVETA — Konsultasi Solusi Digital Bisnis',
            'meta_description' => 'Hubungi SOLVETA untuk konsultasi pembuatan website, aplikasi bisnis, sistem informasi, AI automation, dan kebutuhan pengembangan digital lainnya.',
            'current_page' => 'kontak',
        ];

        return view('kontak', $data);
    }

    /**
     * Landing Page Regional Indonesia (solveta.asia/indonesia)
     */
    public function indonesia()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $pricingModel = new PricingModel();
        $portfolioModel = new PortfolioModel();
        $brandModel = new BrandModel();
        $addonModel = new AddonModel();

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'tiers' => $pricingModel->getTiers('id'),
            'portfolios' => $portfolioModel->getItems(),
            'brands' => $brandModel->getBrands(),
            'addons' => $addonModel->getAddons(),
            'title' => 'SOLVETA Indonesia — Jasa Pembuatan Website & Solusi Digital',
            'current_page' => 'indonesia',
        ];

        return view('home', $data);
    }

    /**
     * 7. Artikel & Wawasan Rekayasa Teknologi (Public Articles Index)
     */
    public function artikel()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $articleModel = new \App\Models\ArticleModel();

        $category = (string) ($this->request->getGet('kategori') ?? 'all');
        $search = (string) ($this->request->getGet('q') ?? '');

        $articles = $articleModel->getArticles($category, $search);

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'articles' => $articles,
            'current_category' => $category,
            'search_query' => $search,
            'title' => 'Artikel & Wawasan Rekayasa Teknologi | SOLVETA',
            'meta_description' => 'Kumpulan panduan praktis dan wawasan seputar website modern, aplikasi web, sistem ERP & POS, optimasi Core Web Vitals, dan transformasi digital bisnis.',
            'current_page' => 'artikel',
        ];

        return view('artikel', $data);
    }

    /**
     * Detail Baca Artikel (Single Article with Full SEO & OpenGraph)
     */
    public function artikelDetail(string $slug)
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $articleModel = new \App\Models\ArticleModel();

        $article = $articleModel->getArticleBySlug($slug);
        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Artikel dengan tautan '{$slug}' tidak ditemukan.");
        }

        $all = $articleModel->getArticles();
        $related = array_filter($all, fn($a) => ($a['slug'] ?? '') !== $slug);
        $related = array_slice($related, 0, 3);

        $data = [
            'copy' => $copyModel->getCopy('id'),
            'contact' => $contactModel->getContact(),
            'article' => $article,
            'related' => $related,
            'title' => esc($article['title']) . ' — SOLVETA Wawasan Teknologi',
            'meta_description' => esc($article['summary'] ?? 'Baca artikel wawasan teknologi dari SOLVETA.'),
            'current_page' => 'artikel',
        ];

        return view('artikel_detail', $data);
    }

    /**
     * Landing Page Regional Malaysia (solveta.asia/malaysia)
     */
    public function malaysia()
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $pricingModel = new PricingModel();
        $portfolioModel = new PortfolioModel();
        $brandModel = new BrandModel();
        $addonModel = new AddonModel();

        $data = [
            'copy' => $copyModel->getCopy('my'),
            'contact' => $contactModel->getContact(),
            'tiers' => $pricingModel->getTiers('my'),
            'portfolios' => $portfolioModel->getItems(),
            'brands' => $brandModel->getBrands(),
            'addons' => $addonModel->getAddons(),
            'title' => 'SOLVETA Malaysia — Perkhidmatan Bina Laman Web & Solusi Digital',
            'current_page' => 'malaysia',
        ];

        return view('home_malaysia', $data);
    }
}
