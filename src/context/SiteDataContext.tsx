"use client";

import React, { createContext, useContext, useState, useEffect } from "react";
import { getSupabaseClient, isSupabaseConfigured } from "@/lib/supabase";

export interface PricingTierData {
  id: string;
  name: string;
  pricePrefix?: string;
  price: string;
  renewalPrice?: string;
  activePeriod?: string;
  deliveryTime?: string;
  popular?: boolean;
  features: string[];
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
}

export interface SiteCopyData {
  siteLogo?: string; // Base64 data URL or image path for top-left navbar logo
  heroEyebrow: string;
  heroHeadline: string;
  heroSubtitle: string;
  portfolioTitle: string;
  portfolioSubtitle: string;
  consultationTitle?: string;
  consultationDesc?: string;
  marqueeTitle: string;
  marqueeSpeed?: number; // Duration in seconds
}

export interface ContactData {
  whatsappNumber: string; // e.g. "6285719663154"
  whatsappDisplay: string; // e.g. "+62 857-1966-3154"
  websiteUrl: string; // e.g. "www.solveta.site"
  email?: string;
}

export interface SiteDataState {
  pricing: PricingTierData[];
  portfolio: PortfolioItemData[];
  clientBrands: ClientBrandItem[];
  contact: ContactData;
  siteCopy: SiteCopyData;
  categories: string[];
  geminiApiKey?: string;
}

const defaultState: SiteDataState = {
  pricing: [
    {
      id: "basic",
      name: "BASIC",
      price: "Rp 299K",
      renewalPrice: "249k/tahun*",
      activePeriod: "1 Tahun",
      deliveryTime: "1–2 Hari",
      suitability: "Kebutuhan pribadi: landing page",
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
      buttonLabel: "Pilih Basic",
      buttonVariant: "outline",
      waMessage: "Halo SOLVETA, saya tertarik dengan paket Basic Rp299K",
    },
    {
      id: "standard",
      name: "STANDARD",
      price: "Rp 549K",
      renewalPrice: "399k/tahun*",
      activePeriod: "1 Tahun",
      deliveryTime: "3–5 Hari",
      popular: true,
      suitability: "Kebutuhan bisnis kecil",
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
      buttonLabel: "Pilih Standard",
      buttonVariant: "red",
      waMessage: "Halo SOLVETA, saya tertarik dengan paket Standard Rp549K",
    },
    {
      id: "premium",
      name: "PREMIUM",
      price: "Rp 749K",
      renewalPrice: "399k/tahun*",
      activePeriod: "1 Tahun",
      deliveryTime: "3–5 Hari",
      suitability: "Company profile & bisnis produk",
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
      buttonLabel: "Pilih Premium",
      buttonVariant: "outline",
      waMessage: "Halo SOLVETA, saya tertarik dengan paket Premium Rp749K",
    },
    {
      id: "custom",
      name: "CUSTOM",
      pricePrefix: "Mulai",
      price: "Rp 1,5 Juta",
      renewalPrice: "Mulai 600k/tahun*",
      activePeriod: "1 Tahun",
      deliveryTime: "Wajib Meet",
      suitability: "Website Custom",
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
      buttonLabel: "Hubungi Kami",
      buttonVariant: "outline",
      waMessage: "Halo SOLVETA, saya ingin mendiskusikan kebutuhan Custom Website & Sistem",
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
  clientBrands: [
    {
      id: "brand-1",
      name: "MedikaCare Group",
      label: "Healthcare System",
    },
    {
      id: "brand-2",
      name: "Nusantara Logistics",
      label: "Supply Chain & Tracking",
    },
    {
      id: "brand-3",
      name: "UrbanVibe Properties",
      label: "Real Estate & Listings",
    },
    {
      id: "brand-4",
      name: "Kopi Nusantara POS",
      label: "Retail & E-Commerce",
    },
    {
      id: "brand-5",
      name: "Artha Finansial",
      label: "Fintech & Corporate",
    },
    {
      id: "brand-6",
      name: "Apex Global Industri",
      label: "Manufacturing ERP",
    },
    {
      id: "brand-7",
      name: "Sinergi Media Kreatif",
      label: "Digital Marketing",
    },
    {
      id: "brand-8",
      name: "Penta Farmasi",
      label: "Inventory Automation",
    },
    {
      id: "brand-9",
      name: "Vortex Tech Labs",
      label: "SaaS & AI",
    },
    {
      id: "brand-10",
      name: "Prima Mandiri Distribusi",
      label: "B2B Commerce",
    },
  ],
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
    heroEyebrow: "SOLVE TECHNOLOGY AGENCY",
    heroHeadline: "Mengubah Tantangan Bisnis Menjadi Solusi Digital.",
    heroSubtitle: "Banyak bisnis terhambat oleh proses manual, informasi yang tidak terstruktur, dan kurangnya integrasi. SOLVETA hadir untuk menyederhanakan masalah kompleks melalui solusi digital dan otomasi yang efisien.",
    portfolioTitle: "Portofolio Proyek Website Yang Telah Kami Bangun",
    portfolioSubtitle: "",
    marqueeTitle: "DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG",
    marqueeSpeed: 35,
  },
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
  syncWithSupabase: () => Promise<boolean>;
  resetToDefaults: () => void;
}

const SiteContext = createContext<SiteContextType | undefined>(undefined);

// Persistent Storage Key
const STORAGE_KEY = "solveta_site_cms_data_v8";

export const SiteDataProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [data, setData] = useState<SiteDataState>(defaultState);
  const [isLoaded, setIsLoaded] = useState(false);

  // Load from LocalStorage
  useEffect(() => {
    try {
      const saved =
        localStorage.getItem(STORAGE_KEY) ||
        localStorage.getItem("solveta_site_cms_data_v7") ||
        localStorage.getItem("solveta_site_cms_data_v6");

      if (saved) {
        const parsed = JSON.parse(saved);
        setData((prev) => ({
          ...defaultState,
          ...parsed,
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

          if (!error && sbData?.data) {
            const cloudPayload = sbData.data as Partial<SiteDataState>;
            setData((prev) => {
              const merged: SiteDataState = {
                ...prev,
                ...cloudPayload,
                siteCopy: { ...prev.siteCopy, ...(cloudPayload.siteCopy || {}) },
                contact: { ...prev.contact, ...(cloudPayload.contact || {}) },
              };
              try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(merged));
              } catch (e) {}
              return merged;
            });
          }
        } catch (err) {
          console.warn("Supabase fetch skipped or offline", err);
        }
      })();
    }
  }, []);

  const saveData = (newState: SiteDataState) => {
    setData(newState);
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(newState));
    } catch (e) {
      console.error("Failed to save CMS data to localStorage", e);
    }

    // Push changes to Supabase Cloud 24/7 in background
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
          console.warn("Supabase background upsert skipped", err);
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
      id: "port-" + Date.now(),
    };
    saveData({ ...data, portfolio: [newItem, ...data.portfolio] });
  };

  const editPortfolioItem = (id: string, updated: Partial<PortfolioItemData>) => {
    saveData({
      ...data,
      portfolio: data.portfolio.map((p) => (p.id === id ? { ...p, ...updated } : p)),
    });
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
    const newItem: ClientBrandItem = {
      ...brand,
      id: "brand-" + Date.now(),
    };
    saveData({ ...data, clientBrands: [...data.clientBrands, newItem] });
  };

  const editClientBrand = (id: string, updated: Partial<ClientBrandItem>) => {
    saveData({
      ...data,
      clientBrands: data.clientBrands.map((b) => (b.id === id ? { ...b, ...updated } : b)),
    });
  };

  const deleteClientBrand = (id: string) => {
    saveData({
      ...data,
      clientBrands: data.clientBrands.filter((b) => b.id !== id),
    });
  };

  const addCategory = (category: string) => {
    const trimmed = category.trim();
    if (!trimmed || data.categories.includes(trimmed)) return;
    saveData({
      ...data,
      categories: [...data.categories, trimmed],
    });
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

  const updateContact = (contact: Partial<ContactData>) => {
    saveData({
      ...data,
      contact: { ...data.contact, ...contact },
    });
  };

  const updateSiteCopy = (copy: Partial<SiteCopyData>) => {
    saveData({
      ...data,
      siteCopy: { ...data.siteCopy, ...copy },
    });
  };

  const updateSiteLogo = (logoBase64: string) => {
    saveData({
      ...data,
      siteCopy: { ...data.siteCopy, siteLogo: logoBase64 },
    });
  };

  const syncWithSupabase = async (): Promise<boolean> => {
    if (!isSupabaseConfigured()) return false;
    try {
      const client = getSupabaseClient();
      const { error } = await client.from("site_content").upsert({
        id: "solveta_cms_main",
        data,
        updated_at: new Date().toISOString(),
      });
      return !error;
    } catch {
      return false;
    }
  };

  const resetToDefaults = () => {
    saveData(defaultState);
  };

  if (!isLoaded) {
    return null;
  }

  return (
    <SiteContext.Provider
      value={{
        data,
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
