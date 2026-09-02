"use client";

import React, { createContext, useContext, useState, useEffect } from "react";
import { getSupabaseClient, isSupabaseConfigured } from "@/lib/supabase";
import { cleanWhatsAppNumber } from "@/utils/whatsapp";

export interface ChecklistItemData {
  text: string;
  included: boolean;
}

export interface DomainAddonData {
  name: string;
  price: string;
}

export interface EmailAddonData {
  name: string;
  price: string;
}

export interface RevisionRulesData {
  light: string;
  heavy: string;
  extraPage?: string;
}

export interface PricingTierData {
  id: string;
  name: string;
  pricePrefix?: string;
  price: string;
  priceBadge?: string;
  renewalPrice?: string;
  activePeriod?: string;
  deliveryTime?: string;
  popular?: boolean;
  popularLabel?: string;
  features: string[];
  checklist?: ChecklistItemData[];
  domainAddons?: DomainAddonData[];
  emailAddons?: EmailAddonData[];
  revisionRules?: RevisionRulesData;
  customNote?: string;
  suitability: string;
  buttonLabel: string;
  buttonVariant: "red" | "outline";
  waMessage: string;
}

export interface PortfolioItemData {
  id: string;
  title: string;
  category?: string;
  image: string; // Base64 data URL or external URL
  description: string;
  tags: string[];
  liveUrl?: string;
}

export interface ClientBrandItem {
  id: string;
  name?: string;
  label?: string;
  logoImage?: string; // Base64 data URL or external URL (optional)
  scale?: number; // Custom scale multiplier for this logo (e.g. 0.5 to 2.5, default 1.0)
}

export interface SiteCopyData {
  siteLogo?: string; // Base64 data URL or image path for top-left navbar logo
  profileVideo?: string; // Video URL or Base64 / public path for 3D Laptop Hero
  heroEyebrow: string;
  heroHeadline: string;
  heroSubtitle: string;
  portfolioTitle: string;
  portfolioSubtitle: string;
  consultationTitle?: string;
  consultationDesc?: string;
  marqueeTitle: string;
  marqueeSpeed?: number; // Duration in seconds
  marqueeLogoHeight?: number; // Logo height in px (default 46)
  marqueeLogoSpacing?: number; // Spacing between logos in px (default 36)
  marqueeLogoScale?: number; // Global Logo scale percentage (default 100%, range 50% - 250%)
  marqueeLogoMaxWidth?: number; // Global Max width in px (default 240)
}

export interface ServiceCostItem {
  id: string;
  name: string; // e.g. "Domain .com 1 Tahun", "Hosting & Cloud Server", "Fee Developer"
  category: "infrastruktur" | "tenaga_kerja" | "lisensi_tools" | "operasional" | "lainnya";
  amount: number; // in IDR
  notes?: string;
}

export interface ServiceProfitAnalysis {
  id: string;
  serviceName: string; // e.g. "1. Basic — 299k"
  tierId?: string; // e.g. "basic", "standard", "premium", "platinum", "custom"
  sellingPrice: number; // in IDR
  laborFee?: number; // Fee tenaga kerja / kompensasi pembuat
  estimatedMonthlyOrders?: number; // Estimasi jumlah order per bulan
  costs: ServiceCostItem[];
  notes?: string;
}

export interface AddonServiceItem {
  id: string;
  name: string;
  priceDescription: string;
  thirdPartyCost: string;
  basePrice?: number;
  category?: string;
}

export interface CustomerOrderSubmission {
  id: string;
  timestamp: string;
  fullName: string;
  whatsappNumber: string;
  brandName: string;
  businessDescription: string;
  websiteType: string;
  pagesNeeded: string;
  designColorTheme: string;
  hasDomain: string;
  hasLogo: string;
  productPhotos: string;
  exampleWebsites: string;
  specialNotes: string;
  websiteAndDomainName: string;
  selectedPackage: string;
  businessProfile: string;
  status?: "Baru" | "Dihubungi" | "Selesai";
}

export interface ProjectCostComponent {
  id: string;
  name: string; // misal: "Hosting Cloud NVMe 1 Tahun", "Domain .com", "Setup UI/UX & Coding"
  amount?: number; // nominal jika ada, atau 0/undefined jika include
  notes?: string; // keterangan opsional
}

export interface ProjectTransactionRecord {
  id: string;
  date: string; // YYYY-MM-DD
  customerName: string;
  phoneNumber: string;
  servicePrice: number;
  websiteName: string;
  websiteLink: string;
  status: "Terlaksana" | "Progress" | "Batal";
  notes: string;
  invoiceNumber: string;
  submissionId?: string; // id formulir customer yang bersangkutan (jika ada)
  costComponents?: ProjectCostComponent[]; // Rincian Komponen Biaya (Opsional untuk nota)
}

export interface ContactData {
  whatsappNumber: string;
  whatsappDisplay: string;
  websiteUrl: string;
  email?: string;
  address?: string;
}

export interface SiteDataState {
  pricing: PricingTierData[];
  portfolio: PortfolioItemData[];
  clientBrands: ClientBrandItem[];
  contact: ContactData;
  siteCopy: SiteCopyData;
  categories: string[];
  geminiApiKey?: string;
  profitAnalysis?: ServiceProfitAnalysis[];
  addonServices?: AddonServiceItem[];
  orderSubmissions?: CustomerOrderSubmission[];
  projectTransactions?: ProjectTransactionRecord[];
}

const defaultState: SiteDataState = {
  pricing: [
    {
      id: "basic",
      name: "BASIC",
      price: "Rp 299K",
      priceBadge: "299K",
      renewalPrice: "249k/tahun*",
      activePeriod: "1 Tahun",
      deliveryTime: "1–2 Hari",
      suitability: "kebutuhan pribadi: landing page",
      buttonLabel: "Pesan Paket Basic (Rp 299K)",
      buttonVariant: "outline",
      waMessage: "Halo SOLVETA, saya tertarik untuk memesan Paket BASIC Rp 299K.",
      features: [
        "Maksimal 1 Halaman (tambah Rp 50k/Halaman)",
        "Revisi ringan 2x (Tidak berubah dari brief awal)",
        "Optimasi Speed (High Perform)",
        "Free Domain (.my.id, .site, .store, .xyz, .space, .fund, .shop)",
        "Free Hosting (Akses Dashboard, Tanpa login cPanel)",
        "Responsive Web (mobile friendly)",
        "SSL Security",
        "Full Garansi*",
      ],
      checklist: [
        { text: "Maksimal 1 Halaman (tambah Rp 50k/Halaman)", included: true },
        { text: "Revisi ringan 2x (Tidak berubah dari brief awal)", included: true },
        { text: "Optimasi Speed (High Perform)", included: true },
        { text: "Free Domain (.my.id, .site, .store, .xyz, .space, .fund, .shop)", included: true },
        { text: "Free Hosting (Akses Dashboard, Tanpa login cPanel)", included: true },
        { text: "Email Bisnis (nama@domain.com)", included: false },
        { text: "Responsive Web (mobile friendly)", included: true },
        { text: "SSL Security", included: true },
        { text: "SEO Basic", included: false },
        { text: "Google Analytics", included: false },
        { text: "Full Garansi*", included: true },
      ],
      domainAddons: [
        { name: ".web.id", price: "+Rp100.000" },
        { name: ".blog", price: "+Rp100.000" },
        { name: ".online", price: "+Rp100.000" },
        { name: ".com", price: "+Rp200.000" },
        { name: ".info", price: "+Rp100.000" },
        { name: "dll (ekstensi lain)", price: "Menyesuaikan" },
      ],
      emailAddons: [
        { name: "1 Akun Email Bisnis", price: "Rp 50.000" },
        { name: "5 Akun Email Bisnis", price: "Rp 150.000" },
      ],
      revisionRules: {
        light: "Rp 30.000 (ganti logo, icon, warna, teks kecil, dsb)",
        heavy: "Rp 50.000 (merubah halaman, menambah halaman, atau struktur)",
        extraPage: "Rp 50.000 / halaman",
      },
    },
    {
      id: "standard",
      name: "STANDARD",
      price: "Rp 549K",
      priceBadge: "549K",
      popular: true,
      popularLabel: "PALING DIMINATI",
      renewalPrice: "399k/tahun*",
      activePeriod: "1 Tahun",
      deliveryTime: "3–5 Hari",
      suitability: "kebutuhan bisnis kecil",
      buttonLabel: "Pesan Paket Standard (Rp 549K)",
      buttonVariant: "red",
      waMessage: "Halo SOLVETA, saya tertarik untuk memesan Paket STANDARD Rp 549K.",
      features: [
        "Maksimal 5 Halaman (tambah Rp 50k/Halaman)",
        "Revisi ringan 3x (Tidak berubah dari brief awal)",
        "Optimasi Speed (2x lebih cepat)",
        "Free Domain (.com, .net, .org, dll)",
        "Free Hosting (Akses Dashboard, Tanpa login cPanel)",
        "1 Email Bisnis (nama@domain.com)",
        "Responsive Web (mobile friendly)",
        "SSL Security",
        "SEO Basic",
        "Full Garansi*",
      ],
      checklist: [
        { text: "Maksimal 5 Halaman (tambah Rp 50k/Halaman)", included: true },
        { text: "Free Iklan Google Ads", included: false },
        { text: "Revisi ringan 3x (Tidak berubah dari brief awal)", included: true },
        { text: "Optimasi Speed (2x lebih cepat)", included: true },
        { text: "Free Desain Mockup", included: false },
        { text: "Free Domain (.com, .net, .org, dll)", included: true },
        { text: "Free Hosting (Akses Dashboard, Tanpa login cPanel)", included: true },
        { text: "1 Email Bisnis (nama@domain.com)", included: true },
        { text: "Responsive Web (mobile friendly)", included: true },
        { text: "SSL Security", included: true },
        { text: "SEO Basic", included: true },
        { text: "Google Analytics", included: false },
        { text: "Full Garansi*", included: true },
      ],
      revisionRules: {
        light: "Rp 30.000 (ganti logo, icon, warna, teks kecil, dsb)",
        heavy: "Rp 50.000 (merubah halaman, menambah halaman, atau struktur)",
        extraPage: "Rp 50.000 / halaman",
      },
    },
    {
      id: "premium",
      name: "PREMIUM",
      price: "Rp 749K",
      priceBadge: "749K",
      renewalPrice: "399k/tahun*",
      activePeriod: "1 Tahun",
      deliveryTime: "3–5 Hari",
      suitability: "company profile & bisnis produk",
      buttonLabel: "Pesan Paket Premium (Rp 749K)",
      buttonVariant: "outline",
      waMessage: "Halo SOLVETA, saya tertarik untuk memesan Paket PREMIUM Rp 749K.",
      features: [
        "Maksimal 7 Halaman (tambah Rp 50k/Halaman)",
        "Revisi ringan 5x (Tidak berubah dari brief awal)",
        "Optimasi Speed (3x lebih cepat)",
        "Free Desain Mockup",
        "Free Domain (.com, .net, .org, dll)",
        "Free Hosting (Akses Dashboard, Tanpa login cPanel)",
        "2 Email Bisnis (nama@domain.com)",
        "Responsive Web (mobile friendly)",
        "SSL Security",
        "SEO Friendly",
        "Google Analytics",
        "Full Garansi*",
      ],
      checklist: [
        { text: "Maksimal 7 Halaman (tambah Rp 50k/Halaman)", included: true },
        { text: "Free Iklan Google Ads", included: false },
        { text: "Revisi ringan 5x (Tidak berubah dari brief awal)", included: true },
        { text: "Optimasi Speed (3x lebih cepat)", included: true },
        { text: "Free Desain Mockup", included: true },
        { text: "Free Domain (.com, .net, .org, dll)", included: true },
        { text: "Free Hosting (Akses Dashboard, Tanpa login cPanel)", included: true },
        { text: "2 Email Bisnis (nama@domain.com)", included: true },
        { text: "Responsive Web (mobile friendly)", included: true },
        { text: "SSL Security", included: true },
        { text: "SEO Friendly", included: true },
        { text: "Google Analytics", included: true },
        { text: "Full Garansi*", included: true },
      ],
      revisionRules: {
        light: "Rp 30.000 (ganti logo, icon, warna, teks kecil, dsb)",
        heavy: "Rp 50.000 (merubah halaman, menambah halaman, atau struktur)",
        extraPage: "Rp 50.000 / halaman",
      },
    },
    {
      id: "custom",
      name: "CUSTOM",
      pricePrefix: "mulai dari :",
      price: "Rp 1,5 Juta",
      priceBadge: "1,5 Jt",
      renewalPrice: "mulai dari : 600k/tahun*",
      activePeriod: "1 Tahun",
      deliveryTime: "Wajib Meet (Fleksibel)",
      suitability: "Website Custom & Sistem Aplikasi",
      buttonLabel: "Jadwalkan Konsultasi & Meet",
      buttonVariant: "outline",
      waMessage: "Halo SOLVETA, saya ingin konsultasi dan menjadwalkan sesi meet untuk Paket Website Custom.",
      features: [
        "Free Iklan Google Ads",
        "Optimasi Speed (Super Cepat)",
        "Free Desain Mockup",
        "Free Domain (.com, .net, .org, dll)",
        "Free Hosting (Akses Dashboard, Akses login cPanel)",
        "Unlimited Email Bisnis (nama@domain.com)",
        "Responsive Web (mobile friendly)",
        "SSL Security",
        "SEO Friendly",
        "Google Analytics",
        "Full Garansi*",
      ],
      checklist: [
        { text: "Free Iklan Google Ads", included: true },
        { text: "Optimasi Speed (Super Cepat)", included: true },
        { text: "Free Desain Mockup", included: true },
        { text: "Free Domain (.com, .net, .org, dll)", included: true },
        { text: "Free Hosting (Akses Dashboard, Akses login cPanel)", included: true },
        { text: "Unlimited Email Bisnis (nama@domain.com)", included: true },
        { text: "Responsive Web (mobile friendly)", included: true },
        { text: "SSL Security", included: true },
        { text: "SEO Friendly", included: true },
        { text: "Google Analytics", included: true },
        { text: "Full Garansi*", included: true },
      ],
      revisionRules: {
        light: "Sesuai kesepakatan scope of work",
        heavy: "Penambahan fitur di luar brief awal disesuaikan dengan sesi meet",
      },
      customNote: "Wajib Meet Online / Offline untuk finalisasi arsitektur sistem, database, dan alur kerja aplikasi.",
    },
  ],
  portfolio: [
    {
      id: "port-1",
      title: "MedikaCare — Sistem Manajemen Klinik Terintegrasi",
      category: "Custom System",
      image: "https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&auto=format&fit=crop&q=80",
      description: "Digitalisasi rekam medis pasien, antrean online WhatsApp, dan sistem kasir klinik terpadu.",
      tags: ["Healthcare", "Database", "Automation"],
      liveUrl: "https://www.solveta.site",
    },
    {
      id: "port-2",
      title: "Nusantara Logistics — Portal Tracking & Fleet Dashboard",
      category: "Web Application",
      image: "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80",
      description: "Platform pelacakan pengiriman kargo real-time dengan integrasi WhatsApp notification gateway.",
      tags: ["Logistics", "Real-Time", "Dashboard"],
      liveUrl: "https://www.solveta.site",
    },
    {
      id: "port-3",
      title: "UrbanVibe Property — Website Katalog Properti Premium",
      category: "Website & Presence",
      image: "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&auto=format&fit=crop&q=80",
      description: "Website interaktif listing properti dengan filter radius peta, virtual tour 360, dan direct order WhatsApp.",
      tags: ["Real Estate", "Search Filter", "Catalog"],
      liveUrl: "https://www.solveta.site",
    },
    {
      id: "port-4",
      title: "Kopi Nusantara — E-Commerce & POS Inventory Sync",
      category: "E-Commerce",
      image: "https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&auto=format&fit=crop&q=80",
      description: "Sinkronisasi otomatis antara stok toko offline dan pesanan online multi-channel.",
      tags: ["E-Commerce", "Inventory", "WhatsApp Checkout"],
      liveUrl: "https://www.solveta.site",
    },
    {
      id: "port-5",
      title: "Artha Finansial — Corporate Profile & Client Portal",
      category: "Corporate Profile",
      image: "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&auto=format&fit=crop&q=80",
      description: "Company profile modern ultra-fast dengan portal pengajuan konsultasi keuangan otomatis.",
      tags: ["Fintech", "Corporate", "SEO Friendly"],
      liveUrl: "https://www.solveta.site",
    },
  ],
  clientBrands: [],
  categories: [
    "Custom System",
    "Web Application",
    "Website & Presence",
    "E-Commerce",
    "Corporate Profile",
  ],
  contact: {
    whatsappNumber: "6285719663154",
    whatsappDisplay: "+62 857-1966-3154",
    websiteUrl: "www.solveta.site",
    email: "halo@solveta.site",
  },
  siteCopy: {
    siteLogo: "",
    profileVideo: "/videos/profile.mp4",
    heroEyebrow: "SOLVE TECHNOLOGY AGENCY",
    heroHeadline: "Mengubah Tantangan Bisnis Menjadi Solusi Digital.",
    heroSubtitle: "Banyak bisnis terhambat oleh proses manual, informasi yang tidak terstruktur, dan kurangnya integrasi. SOLVETA hadir untuk menyederhanakan masalah kompleks melalui solusi digital dan otomasi yang efisien.",
    portfolioTitle: "Portofolio Proyek Website Yang Telah Kami Bangun",
    portfolioSubtitle: "",
    marqueeTitle: "DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG",
    marqueeSpeed: 35,
    marqueeLogoHeight: 65,
    marqueeLogoSpacing: 40,
    marqueeLogoScale: 100,
    marqueeLogoMaxWidth: 350,
  },
  profitAnalysis: [
    {
      id: "profit-basic",
      serviceName: "1. Basic — 299k",
      tierId: "basic",
      sellingPrice: 299000,
      laborFee: 75000,
      estimatedMonthlyOrders: 6,
      costs: [
        { id: "c-1", name: "Hosting / Tahun", category: "infrastruktur", amount: 60000 },
        { id: "c-2", name: "Domain", category: "infrastruktur", amount: 30000 },
        { id: "c-3", name: "Customer Service", category: "operasional", amount: 15000 },
        { id: "c-4", name: "Development", category: "tenaga_kerja", amount: 75000 },
        { id: "c-5", name: "Iklan", category: "operasional", amount: 50000 },
      ],
      notes: "Total Beban: 230K, Estimasi Margin: 69K (atau 58K setelah pajak/buffer).",
    },
    {
      id: "profit-standard",
      serviceName: "2. Standard — 549k",
      tierId: "standard",
      sellingPrice: 549000,
      laborFee: 199000,
      estimatedMonthlyOrders: 10,
      costs: [
        { id: "c-6", name: "Hosting / Tahun", category: "infrastruktur", amount: 100000 },
        { id: "c-7", name: "Domain", category: "infrastruktur", amount: 50000 },
        { id: "c-8", name: "Customer Service", category: "operasional", amount: 20000 },
        { id: "c-9", name: "Development", category: "tenaga_kerja", amount: 199000 },
        { id: "c-10", name: "Iklan", category: "operasional", amount: 50000 },
        { id: "c-11", name: "Buffer Operasional & Tools", category: "operasional", amount: 41000 },
      ],
      notes: "Total Beban: 460K, Estimasi Margin: 89K (atau 139K sebelum buffer operasional).",
    },
    {
      id: "profit-premium",
      serviceName: "3. Premium — 849k",
      tierId: "premium",
      sellingPrice: 849000,
      laborFee: 405000,
      estimatedMonthlyOrders: 5,
      costs: [
        { id: "c-12", name: "Hosting / Tahun", category: "infrastruktur", amount: 150000 },
        { id: "c-13", name: "Domain", category: "infrastruktur", amount: 50000 },
        { id: "c-14", name: "Customer Service", category: "operasional", amount: 25000 },
        { id: "c-15", name: "Development", category: "tenaga_kerja", amount: 405000 },
        { id: "c-16", name: "Iklan", category: "operasional", amount: 50000 },
      ],
      notes: "Total Beban: 680K, Estimasi Margin: 169K.",
    },
    {
      id: "profit-platinum",
      serviceName: "4. Platinum — Custom",
      tierId: "platinum",
      sellingPrice: 2500000,
      laborFee: 1200000,
      estimatedMonthlyOrders: 2,
      costs: [
        { id: "c-17", name: "Hosting / VPS / Cloud", category: "infrastruktur", amount: 350000, notes: "By Requirement" },
        { id: "c-18", name: "Domain", category: "infrastruktur", amount: 150000, notes: "By Requirement" },
        { id: "c-19", name: "Customer Service", category: "operasional", amount: 30000 },
        { id: "c-20", name: "Development", category: "tenaga_kerja", amount: 1200000, notes: "By Complexity" },
        { id: "c-21", name: "Iklan / Marketing", category: "operasional", amount: 50000 },
      ],
      notes: "Total Beban: Custom (By Requirement & Complexity), Margin: Custom.",
    },
  ],
  addonServices: [
    { id: "add-1", name: "Revisi ringan tambahan", priceDescription: "Rp30K / revisi", thirdPartyCost: "-", basePrice: 30000, category: "Revisi" },
    { id: "add-2", name: "Revisi berat tambahan", priceDescription: "Rp50K / revisi", thirdPartyCost: "-", basePrice: 50000, category: "Revisi" },
    { id: "add-3", name: "Tambah 1 halaman", priceDescription: "Rp50K / halaman", thirdPartyCost: "-", basePrice: 50000, category: "Halaman" },
    { id: "add-4", name: "WhatsApp Business API", priceDescription: "Mulai Rp150K", thirdPartyCost: "Sesuai tarif Meta/provider & penggunaan", basePrice: 150000, category: "Integrasi API" },
    { id: "add-5", name: "Google Maps API / Places / Routes", priceDescription: "Mulai Rp150K", thirdPartyCost: "Sesuai tarif Meta/provider & penggunaan", basePrice: 150000, category: "Integrasi API" },
    { id: "add-6", name: "API sederhana", priceDescription: "Mulai Rp150K", thirdPartyCost: "Sesuai API pihak ketiga", basePrice: 150000, category: "Integrasi API" },
    { id: "add-7", name: "API kompleks", priceDescription: "Mulai Rp250K", thirdPartyCost: "Sesuai API pihak ketiga", basePrice: 250000, category: "Integrasi API" },
    { id: "add-8", name: "Payment Gateway", priceDescription: "Mulai Rp250K", thirdPartyCost: "Fee transaksi/provider", basePrice: 250000, category: "Payment" },
    { id: "add-9", name: "Email / SMTP", priceDescription: "Mulai Rp50K", thirdPartyCost: "Sesuai provider", basePrice: 50000, category: "Email" },
    { id: "add-10", name: "AI API", priceDescription: "Mulai Rp250K", thirdPartyCost: "Pay-as-you-go / token sesuai provider", basePrice: 250000, category: "AI & Otomasi" },
  ],
  orderSubmissions: [
    {
      id: "sub-1",
      timestamp: "2026-09-02 10:24",
      fullName: "Budi Santoso",
      whatsappNumber: "081234567890",
      brandName: "Kopi Senja Nusantara",
      businessDescription: "Kedai kopi artisan dan penjualan biji kopi sangrai online.",
      websiteType: "Website E-Commerce & Menu Digital",
      pagesNeeded: "Home, Menu, Tentang Kami, Galeri, Checkout WhatsApp",
      designColorTheme: "Warm Espresso, Krem Natural, dan Aksen Emas",
      hasDomain: "Belum punya (ingin dibantu carikan)",
      hasLogo: "Sudah punya (format vector PNG transparan)",
      productPhotos: "Ada 15 foto produk resolusi tinggi siap pakai",
      exampleWebsites: "https://bluebottlecoffee.com",
      specialNotes: "Mohon integrasikan tombol pesan langsung ke WhatsApp kasir.",
      websiteAndDomainName: "kopisenjanusantara.com",
      selectedPackage: "Standard (549k)",
      businessProfile: "UMKM kopi lokal berpusat di Bandung berdiri sejak 2021.",
      status: "Baru",
    },
    {
      id: "sub-2",
      timestamp: "2026-09-01 16:45",
      fullName: "Siti Rahmawati",
      whatsappNumber: "085798765432",
      brandName: "Glow & Co Beauty",
      businessDescription: "Klinik estetika medis dan skincare organik terdaftar BPOM.",
      websiteType: "Company Profile & Reservasi Treatment",
      pagesNeeded: "Beranda, Layanan Dokter, Treatment & Biaya, Testimoni, Kontak",
      designColorTheme: "Clean White, Pastel Pink, dan Sage Green",
      hasDomain: "Sudah punya (glowandco.id)",
      hasLogo: "Sudah punya",
      productPhotos: "Tersedia di Google Drive klinik",
      exampleWebsites: "https://erha.co.id",
      specialNotes: "Perlu form booking jadwal dokter dengan notifikasi WA otomatis.",
      websiteAndDomainName: "glowandco.id",
      selectedPackage: "Premium (849k)",
      businessProfile: "Klinik perawatan kulit dengan 2 cabang di Jakarta Selatan.",
      status: "Dihubungi",
    },
  ],
  projectTransactions: [
    {
      id: "proj-1",
      date: "2026-09-02",
      customerName: "Budi Santoso",
      phoneNumber: "081234567890",
      servicePrice: 549000,
      websiteName: "Kopi Senja Nusantara",
      websiteLink: "https://kopisenja.solveta.site",
      status: "Progress",
      notes: "Tahap perakitan katalog produk dan integrasi tombol checkout WA.",
      invoiceNumber: "INV-20260902-001",
      costComponents: [
        { id: "c-1", name: "Hosting NVMe Cloud 1 Tahun", amount: 100000, notes: "Akses dashboard lancar" },
        { id: "c-2", name: "Domain .com Resmi 1 Tahun", amount: 50000, notes: "Aktivasi DNS instan" },
        { id: "c-3", name: "Setup UI/UX Katalog & WA Checkout", amount: 199000, notes: "Responsive mobile" },
        { id: "c-4", name: "Customer Service & Support Teknis", amount: 20000, notes: "Pendampingan 1 tahun" },
      ],
    },
    {
      id: "proj-2",
      date: "2026-08-28",
      customerName: "Dr. Hendra Wijaya",
      phoneNumber: "081987654321",
      servicePrice: 849000,
      websiteName: "Klinik Medika Utama",
      websiteLink: "https://medikautama.id",
      status: "Terlaksana",
      notes: "Website selesai 100%, domain aktif, serah terima akun selesai.",
      invoiceNumber: "INV-20260828-002",
      costComponents: [
        { id: "c-5", name: "Cloud Server Enterprise 1 Tahun", amount: 150000 },
        { id: "c-6", name: "Domain .id Resmi", amount: 50000 },
        { id: "c-7", name: "Pengembangan Sistem Reservasi & UI/UX Dokter", amount: 405000 },
        { id: "c-8", name: "SSL Certificate & Keamanan Data Pasien", amount: 25000 },
      ],
    },
    {
      id: "proj-3",
      date: "2026-08-20",
      customerName: "Ahmad Fauzi",
      phoneNumber: "087711223344",
      servicePrice: 299000,
      websiteName: "Fauzi Portfolio & CV",
      websiteLink: "https://fauzi.my.id",
      status: "Terlaksana",
      notes: "Landing page personal selesai, revisi minor font selesai.",
      invoiceNumber: "INV-20260820-003",
    },
  ],
};

interface SiteContextType {
  data: SiteDataState;
  updatePricing: (pricing: PricingTierData[]) => void;
  updatePortfolio: (portfolio: PortfolioItemData[]) => void;
  addPortfolioItem: (item: Omit<PortfolioItemData, "id">) => void;
  editPortfolioItem: (id: string, updated: Partial<PortfolioItemData>) => void;
  deletePortfolioItem: (id: string) => void;
  updateClientBrands: (brands: ClientBrandItem[]) => void;
  addClientBrand: (brand: Omit<ClientBrandItem, "id">) => void;
  editClientBrand: (id: string, updated: Partial<ClientBrandItem>) => void;
  deleteClientBrand: (id: string) => void;
  addCategory: (category: string) => void;
  deleteCategory: (category: string) => void;
  updateCategories: (categories: string[]) => void;
  updateContact: (contact: Partial<ContactData>) => void;
  updateSiteCopy: (copy: Partial<SiteCopyData>) => void;
  updateSiteLogo: (logoBase64: string) => void;
  updateProfileVideo: (videoSrc: string) => void;
  updateProfitAnalysis: (analyses: ServiceProfitAnalysis[]) => void;
  addServiceProfitItem: (item: Omit<ServiceProfitAnalysis, "id">) => void;
  editServiceProfitItem: (id: string, updated: Partial<ServiceProfitAnalysis>) => void;
  deleteServiceProfitItem: (id: string) => void;
  addCostToService: (serviceId: string, cost: Omit<ServiceCostItem, "id">) => void;
  removeCostFromService: (serviceId: string, costId: string) => void;
  editCostInService: (serviceId: string, costId: string, updated: Partial<ServiceCostItem>) => void;
  // Addon services
  updateAddonServices: (addons: AddonServiceItem[]) => void;
  addAddonService: (addon: Omit<AddonServiceItem, "id">) => void;
  editAddonService: (id: string, updated: Partial<AddonServiceItem>) => void;
  deleteAddonService: (id: string) => void;
  // Customer order submissions
  addOrderSubmission: (submission: Omit<CustomerOrderSubmission, "id" | "timestamp">) => void;
  deleteOrderSubmission: (id: string) => void;
  updateOrderSubmissionStatus: (id: string, status: "Baru" | "Dihubungi" | "Selesai") => void;
  // Project transactions
  addProjectTransaction: (transaction: Omit<ProjectTransactionRecord, "id">) => void;
  editProjectTransaction: (id: string, updated: Partial<ProjectTransactionRecord>) => void;
  deleteProjectTransaction: (id: string) => void;
  saveData: (newState: SiteDataState) => void;
  syncWithSupabase: (stateToSync?: SiteDataState) => Promise<boolean>;
  resetToDefaults: () => void;
}

const SiteContext = createContext<SiteContextType | undefined>(undefined);

// Persistent Storage Key
const STORAGE_KEY = "solveta_site_cms_data_v11";

export const SiteDataProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [data, setData] = useState<SiteDataState>(defaultState);
  const [isLoaded, setIsLoaded] = useState(false);

  // Load from LocalStorage
  useEffect(() => {
    try {
      // Clean up obsolete legacy cache keys
      ["solveta_site_cms_data_v7", "solveta_site_cms_data_v8", "solveta_site_cms_data_v9"].forEach(
        (oldKey) => localStorage.removeItem(oldKey)
      );

      const saved = localStorage.getItem(STORAGE_KEY);

      if (saved) {
        const parsed = JSON.parse(saved);
        
        // Merge pricing carefully with default rich attributes
        const mergedPricing = defaultState.pricing.map((defaultTier) => {
          const savedTier = (parsed.pricing || []).find(
            (p: PricingTierData) => p.id === defaultTier.id || p.name === defaultTier.name
          );
          if (!savedTier) return defaultTier;
          return {
            ...defaultTier,
            ...savedTier,
            checklist: savedTier.checklist || defaultTier.checklist,
            domainAddons: savedTier.domainAddons || defaultTier.domainAddons,
            emailAddons: savedTier.emailAddons || defaultTier.emailAddons,
            revisionRules: savedTier.revisionRules || defaultTier.revisionRules,
          };
        });

        // Filter out legacy dummy brand placeholders (brand-1 to brand-8)
        const cleanedBrands = (parsed.clientBrands || []).filter(
          (b: ClientBrandItem) =>
            b.logoImage ||
            (!b.id?.startsWith("brand-") &&
              b.name !== "MedikaCare Group" &&
              b.name !== "Nusantara Logistics" &&
              b.name !== "UrbanVibe Properties" &&
              b.name !== "Kopi Nusantara POS" &&
              b.name !== "Artha Finansial" &&
              b.name !== "Apex Global Industri" &&
              b.name !== "Samudra Retail" &&
              b.name !== "Garda Security Tech")
        );

        setData((prev) => ({
          ...defaultState,
          ...parsed,
          clientBrands: cleanedBrands,
          pricing: mergedPricing.length > 0 ? mergedPricing : defaultState.pricing,
          siteCopy: { ...defaultState.siteCopy, ...(parsed.siteCopy || {}) },
          contact: { ...defaultState.contact, ...(parsed.contact || {}) },
          categories: Array.from(
            new Set([...(parsed.categories || defaultState.categories)])
          ),
        }));
      }
    } catch (e) {
      console.error("Failed to load CMS data from localStorage", e);
    }
    setIsLoaded(true);

    // Sync from Supabase Cloud 24/7 (if configured)
    if (isSupabaseConfigured()) {
      (async () => {
        try {
          const client = getSupabaseClient();
          const { data: sbData, error } = await client
            .from("site_content")
            .select("data")
            .eq("id", "solveta_cms_main")
            .single();

          if (sbData && sbData.data) {
            const sbBrands = (sbData.data.clientBrands || []).filter(
              (b: ClientBrandItem) =>
                b.logoImage ||
                (!b.id?.startsWith("brand-") &&
                  b.name !== "MedikaCare Group" &&
                  b.name !== "Nusantara Logistics" &&
                  b.name !== "UrbanVibe Properties" &&
                  b.name !== "Kopi Nusantara POS" &&
                  b.name !== "Artha Finansial" &&
                  b.name !== "Apex Global Industri" &&
                  b.name !== "Samudra Retail" &&
                  b.name !== "Garda Security Tech")
            );
            setData((prev) => ({
              ...defaultState,
              ...sbData.data,
              clientBrands: sbBrands,
            }));
            localStorage.setItem(STORAGE_KEY, JSON.stringify({ ...sbData.data, clientBrands: sbBrands }));
          }
        } catch (err) {
          console.log("Supabase fetch fallback:", err);
        }
      })();
    }

    const handleStorageChange = () => {
      try {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved) {
          setData(JSON.parse(saved));
        }
      } catch (e) {}
    };

    if (typeof window !== "undefined") {
      window.addEventListener("storage", handleStorageChange);
    }

    return () => {
      if (typeof window !== "undefined") {
        window.removeEventListener("storage", handleStorageChange);
      }
    };
  }, []);

  // Save to LocalStorage & Supabase
  const saveData = (newState: SiteDataState) => {
    setData(newState);
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(newState));
      if (typeof window !== "undefined") {
        window.dispatchEvent(new Event("storage"));
      }
    } catch (e) {
      console.error("Failed to save to localStorage", e);
    }

    if (isSupabaseConfigured()) {
      (async () => {
        try {
          const client = getSupabaseClient();
          await client.from("site_content").upsert({
            id: "solveta_cms_main",
            data: newState,
            updated_at: new Date().toISOString(),
          });
        } catch (err) {
          console.error("Failed auto-sync with Supabase:", err);
        }
      })();
    }
  };

  const updatePricing = (pricing: PricingTierData[]) => {
    saveData({ ...data, pricing });
  };

  const updatePortfolio = (portfolio: PortfolioItemData[]) => {
    saveData({ ...data, portfolio });
  };

  const addPortfolioItem = (item: Omit<PortfolioItemData, "id">) => {
    const newItem: PortfolioItemData = {
      ...item,
      id: `port-${Date.now()}`,
    };
    saveData({ ...data, portfolio: [newItem, ...data.portfolio] });
  };

  const editPortfolioItem = (id: string, updated: Partial<PortfolioItemData>) => {
    const newPort = data.portfolio.map((p) =>
      p.id === id ? { ...p, ...updated } : p
    );
    saveData({ ...data, portfolio: newPort });
  };

  const deletePortfolioItem = (id: string) => {
    saveData({
      ...data,
      portfolio: data.portfolio.filter((p) => p.id !== id),
    });
  };

  const updateClientBrands = (clientBrands: ClientBrandItem[]) => {
    saveData({ ...data, clientBrands });
  };

  const addClientBrand = (brand: Omit<ClientBrandItem, "id">) => {
    const newBrand: ClientBrandItem = {
      ...brand,
      id: `brand-${Date.now()}`,
    };
    saveData({ ...data, clientBrands: [...data.clientBrands, newBrand] });
  };

  const editClientBrand = (id: string, updated: Partial<ClientBrandItem>) => {
    const newBrands = data.clientBrands.map((b) =>
      b.id === id ? { ...b, ...updated } : b
    );
    saveData({ ...data, clientBrands: newBrands });
  };

  const deleteClientBrand = (id: string) => {
    saveData({
      ...data,
      clientBrands: data.clientBrands.filter((b) => b.id !== id),
    });
  };

  const addCategory = (category: string) => {
    if (!category.trim()) return;
    const clean = category.trim();
    if (!data.categories.includes(clean)) {
      saveData({ ...data, categories: [...data.categories, clean] });
    }
  };

  const deleteCategory = (category: string) => {
    saveData({
      ...data,
      categories: data.categories.filter((c) => c !== category),
    });
  };

  const updateCategories = (categories: string[]) => {
    saveData({ ...data, categories });
  };

  const updateContact = (contactUpdate: Partial<ContactData>) => {
    let cleanNum = contactUpdate.whatsappNumber;
    if (cleanNum) {
      cleanNum = cleanWhatsAppNumber(cleanNum);
    }
    saveData({
      ...data,
      contact: {
        ...data.contact,
        ...contactUpdate,
        ...(cleanNum ? { whatsappNumber: cleanNum } : {}),
      },
    });
  };

  const updateSiteCopy = (copyUpdate: Partial<SiteCopyData>) => {
    saveData({
      ...data,
      siteCopy: { ...data.siteCopy, ...copyUpdate },
    });
  };

  const updateSiteLogo = (logoBase64: string) => {
    saveData({
      ...data,
      siteCopy: { ...data.siteCopy, siteLogo: logoBase64 },
    });
  };

  const updateProfileVideo = (videoSrc: string) => {
    saveData({
      ...data,
      siteCopy: { ...data.siteCopy, profileVideo: videoSrc },
    });
  };

  const updateProfitAnalysis = (analyses: ServiceProfitAnalysis[]) => {
    saveData({ ...data, profitAnalysis: analyses });
  };

  const addServiceProfitItem = (item: Omit<ServiceProfitAnalysis, "id">) => {
    const newItem: ServiceProfitAnalysis = {
      ...item,
      id: `profit-${Date.now()}`,
    };
    const current = data.profitAnalysis || defaultState.profitAnalysis || [];
    saveData({ ...data, profitAnalysis: [...current, newItem] });
  };

  const editServiceProfitItem = (id: string, updated: Partial<ServiceProfitAnalysis>) => {
    const current = data.profitAnalysis || defaultState.profitAnalysis || [];
    const newItems = current.map((p) =>
      p.id === id ? { ...p, ...updated } : p
    );
    saveData({ ...data, profitAnalysis: newItems });
  };

  const deleteServiceProfitItem = (id: string) => {
    const current = data.profitAnalysis || defaultState.profitAnalysis || [];
    saveData({
      ...data,
      profitAnalysis: current.filter((p) => p.id !== id),
    });
  };

  const addCostToService = (serviceId: string, cost: Omit<ServiceCostItem, "id">) => {
    const current = data.profitAnalysis || defaultState.profitAnalysis || [];
    const newCost: ServiceCostItem = {
      ...cost,
      id: `c-${Date.now()}`,
    };
    const newItems = current.map((p) => {
      if (p.id === serviceId) {
        return {
          ...p,
          costs: [...(p.costs || []), newCost],
        };
      }
      return p;
    });
    saveData({ ...data, profitAnalysis: newItems });
  };

  const removeCostFromService = (serviceId: string, costId: string) => {
    const current = data.profitAnalysis || defaultState.profitAnalysis || [];
    const newItems = current.map((p) => {
      if (p.id === serviceId) {
        return {
          ...p,
          costs: (p.costs || []).filter((c) => c.id !== costId),
        };
      }
      return p;
    });
    saveData({ ...data, profitAnalysis: newItems });
  };

  const editCostInService = (serviceId: string, costId: string, updated: Partial<ServiceCostItem>) => {
    const current = data.profitAnalysis || defaultState.profitAnalysis || [];
    const newItems = current.map((p) => {
      if (p.id === serviceId) {
        return {
          ...p,
          costs: (p.costs || []).map((c) => (c.id === costId ? { ...c, ...updated } : c)),
        };
      }
      return p;
    });
    saveData({ ...data, profitAnalysis: newItems });
  };

  // Addon services actions
  const updateAddonServices = (addons: AddonServiceItem[]) => {
    saveData({ ...data, addonServices: addons });
  };

  const addAddonService = (addon: Omit<AddonServiceItem, "id">) => {
    const current = data.addonServices || defaultState.addonServices || [];
    const newItem: AddonServiceItem = {
      ...addon,
      id: `add-${Date.now()}`,
    };
    saveData({ ...data, addonServices: [...current, newItem] });
  };

  const editAddonService = (id: string, updated: Partial<AddonServiceItem>) => {
    const current = data.addonServices || defaultState.addonServices || [];
    const newItems = current.map((a) => (a.id === id ? { ...a, ...updated } : a));
    saveData({ ...data, addonServices: newItems });
  };

  const deleteAddonService = (id: string) => {
    const current = data.addonServices || defaultState.addonServices || [];
    saveData({
      ...data,
      addonServices: current.filter((a) => a.id !== id),
    });
  };

  // Customer order submissions actions
  const addOrderSubmission = (submission: Omit<CustomerOrderSubmission, "id" | "timestamp">) => {
    const current = data.orderSubmissions || defaultState.orderSubmissions || [];
    const now = new Date();
    const formattedDate = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, "0")}-${String(now.getDate()).padStart(2, "0")} ${String(now.getHours()).padStart(2, "0")}:${String(now.getMinutes()).padStart(2, "0")}`;
    const newSubmission: CustomerOrderSubmission = {
      ...submission,
      id: `sub-${Date.now()}`,
      timestamp: formattedDate,
      status: submission.status || "Baru",
    };
    saveData({ ...data, orderSubmissions: [newSubmission, ...current] });
  };

  const deleteOrderSubmission = (id: string) => {
    const current = data.orderSubmissions || defaultState.orderSubmissions || [];
    saveData({
      ...data,
      orderSubmissions: current.filter((s) => s.id !== id),
    });
  };

  const updateOrderSubmissionStatus = (id: string, status: "Baru" | "Dihubungi" | "Selesai") => {
    const current = data.orderSubmissions || defaultState.orderSubmissions || [];
    const updated = current.map((s) => (s.id === id ? { ...s, status } : s));
    saveData({ ...data, orderSubmissions: updated });
  };

  // Project transactions actions
  const addProjectTransaction = (transaction: Omit<ProjectTransactionRecord, "id">) => {
    const current = data.projectTransactions || defaultState.projectTransactions || [];
    const newRecord: ProjectTransactionRecord = {
      ...transaction,
      id: `proj-${Date.now()}`,
    };
    saveData({ ...data, projectTransactions: [newRecord, ...current] });
  };

  const editProjectTransaction = (id: string, updated: Partial<ProjectTransactionRecord>) => {
    const current = data.projectTransactions || defaultState.projectTransactions || [];
    const updatedRecords = current.map((p) => (p.id === id ? { ...p, ...updated } : p));
    saveData({ ...data, projectTransactions: updatedRecords });
  };

  const deleteProjectTransaction = (id: string) => {
    const current = data.projectTransactions || defaultState.projectTransactions || [];
    saveData({
      ...data,
      projectTransactions: current.filter((p) => p.id !== id),
    });
  };

  const syncWithSupabase = async (stateToSync?: SiteDataState): Promise<boolean> => {
    if (!isSupabaseConfigured()) return false;
    try {
      const client = getSupabaseClient();
      const payload = stateToSync || data;
      const { error } = await client.from("site_content").upsert({
        id: "solveta_cms_main",
        data: payload,
        updated_at: new Date().toISOString(),
      });
      return !error;
    } catch (e) {
      console.error("Manual Supabase sync failed:", e);
      return false;
    }
  };

  const resetToDefaults = () => {
    localStorage.removeItem(STORAGE_KEY);
    setData(defaultState);
  };

  return (
    <SiteContext.Provider
      value={{
        data,
        saveData,
        updatePricing,
        updatePortfolio,
        addPortfolioItem,
        editPortfolioItem,
        deletePortfolioItem,
        updateClientBrands,
        addClientBrand,
        editClientBrand,
        deleteClientBrand,
        addCategory,
        deleteCategory,
        updateCategories,
        updateContact,
        updateSiteCopy,
        updateSiteLogo,
        updateProfileVideo,
        updateProfitAnalysis,
        addServiceProfitItem,
        editServiceProfitItem,
        deleteServiceProfitItem,
        addCostToService,
        removeCostFromService,
        editCostInService,
        updateAddonServices,
        addAddonService,
        editAddonService,
        deleteAddonService,
        addOrderSubmission,
        deleteOrderSubmission,
        updateOrderSubmissionStatus,
        addProjectTransaction,
        editProjectTransaction,
        deleteProjectTransaction,
        syncWithSupabase,
        resetToDefaults,
      }}
    >
      {children}
    </SiteContext.Provider>
  );
};

export const useSiteData = () => {
  const context = useContext(SiteContext);
  if (!context) {
    throw new Error("useSiteData must be used within a SiteDataProvider");
  }
  return context;
};
