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
  serviceName: string; // e.g. "Paket Website BASIC"
  tierId?: string; // e.g. "basic", "standard", "premium", "custom"
  sellingPrice: number; // in IDR
  laborFee?: number; // Fee tenaga kerja / kompensasi pembuat
  estimatedMonthlyOrders?: number; // Estimasi jumlah order per bulan
  costs: ServiceCostItem[];
  notes?: string;
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
      serviceName: "Paket Website BASIC",
      tierId: "basic",
      sellingPrice: 299000,
      laborFee: 75000,
      estimatedMonthlyOrders: 6,
      costs: [
        { id: "c-1", name: "Domain .my.id / Subdomain 1 Tahun", category: "infrastruktur", amount: 25000 },
        { id: "c-2", name: "Hosting Cloud & SSL Deployment", category: "infrastruktur", amount: 30000 },
        { id: "c-3", name: "Asset & Template Base", category: "lisensi_tools", amount: 20000 },
        { id: "c-4", name: "Biaya Tenaga Kerja / Setup Dev", category: "tenaga_kerja", amount: 75000 },
      ],
      notes: "Paket ekonomis untuk landing page personal & UMKM.",
    },
    {
      id: "profit-standard",
      serviceName: "Paket Website STANDARD (Popular)",
      tierId: "standard",
      sellingPrice: 599000,
      laborFee: 150000,
      estimatedMonthlyOrders: 10,
      costs: [
        { id: "c-5", name: "Domain .com Resmi 1 Tahun", category: "infrastruktur", amount: 135000 },
        { id: "c-6", name: "High-Speed Cloud Server & CDN", category: "infrastruktur", amount: 60000 },
        { id: "c-7", name: "Icon, Font & Graphics Pack", category: "lisensi_tools", amount: 50000 },
        { id: "c-8", name: "Biaya Tenaga Kerja Frontend Dev", category: "tenaga_kerja", amount: 150000 },
        { id: "c-9", name: "Buffer Revisi & CS Handling", category: "operasional", amount: 40000 },
      ],
      notes: "Paket paling diminati bisnis dan profil perusahaan.",
    },
    {
      id: "profit-premium",
      serviceName: "Paket Website PREMIUM (Bisnis)",
      tierId: "premium",
      sellingPrice: 1499000,
      laborFee: 450000,
      estimatedMonthlyOrders: 4,
      costs: [
        { id: "c-10", name: "Domain .com Premium + Private DNS", category: "infrastruktur", amount: 175000 },
        { id: "c-11", name: "Dedicated Cloud Server + DB Setup", category: "infrastruktur", amount: 150000 },
        { id: "c-12", name: "3D Visual Assets & Animation Suite", category: "lisensi_tools", amount: 120000 },
        { id: "c-13", name: "Biaya Tenaga Kerja Fullstack Developer", category: "tenaga_kerja", amount: 450000 },
        { id: "c-14", name: "QA Testing, SEO & Security Hardening", category: "operasional", amount: 100000 },
        { id: "c-15", name: "Buffer Support 30 Hari", category: "operasional", amount: 100000 },
      ],
      notes: "Paket komprehensif dengan animasi 3D dan optimasi performa tinggi.",
    },
    {
      id: "profit-custom",
      serviceName: "Paket CUSTOM / Enterprise System",
      tierId: "custom",
      sellingPrice: 3500000,
      laborFee: 1200000,
      estimatedMonthlyOrders: 2,
      costs: [
        { id: "c-16", name: "Custom Cloud Architecture & Scalability", category: "infrastruktur", amount: 350000 },
        { id: "c-17", name: "Database Design & Third-party APIs", category: "infrastruktur", amount: 300000 },
        { id: "c-18", name: "Tailored UI/UX Design System", category: "lisensi_tools", amount: 400000 },
        { id: "c-19", name: "Biaya Tenaga Senior Software Engineer", category: "tenaga_kerja", amount: 1200000 },
        { id: "c-20", name: "End-to-End QA Testing & Deployment", category: "operasional", amount: 250000 },
      ],
      notes: "Solusi sistem web & database kustom dengan arsitektur modular.",
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
  saveData: (newState: SiteDataState) => void;
  syncWithSupabase: (stateToSync?: SiteDataState) => Promise<boolean>;
  resetToDefaults: () => void;
}

const SiteContext = createContext<SiteContextType | undefined>(undefined);

// Persistent Storage Key
const STORAGE_KEY = "solveta_site_cms_data_v10";

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
