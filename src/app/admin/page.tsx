"use client";

import React, { useState, useRef } from "react";
import Link from "next/link";
import { motion, AnimatePresence } from "framer-motion";
import {
  Lock,
  Eye,
  Save,
  RotateCcw,
  CheckCircle2,
  ArrowLeft,
  Plus,
  Trash2,
  Upload,
  Phone,
  Edit3,
  X,
  Layers,
  Image as ImageIcon,
  DollarSign,
  Sparkles,
  Building2,
} from "lucide-react";
import {
  SiteDataProvider,
  useSiteData,
  PricingTierData,
  PortfolioItemData,
  ClientBrandItem,
} from "@/context/SiteDataContext";

function AdminPortalVisual() {
  const {
    data,
    updatePricing,
    updatePortfolio,
    addPortfolioItem,
    deletePortfolioItem,
    updateClientBrands,
    addClientBrand,
    deleteClientBrand,
    updateContact,
    updateSiteCopy,
    resetToDefaults,
  } = useSiteData();

  // Authentication: username 'developer', password 'developer123'
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [loginError, setLoginError] = useState(false);

  // Active View Mode: 'visual' | 'portfolio' | 'brands' | 'contact'
  const [activeMode, setActiveMode] = useState<"visual" | "portfolio" | "brands" | "contact">("visual");
  const [toastMessage, setToastMessage] = useState("");

  // Edit Modal State for Live Visual Editor
  const [editingTarget, setEditingTarget] = useState<{
    type: "heroHeadline" | "heroSubtitle" | "portfolioTitle" | "consultation" | "pricing";
    tierIndex?: number;
  } | null>(null);

  // Quick edit temp values
  const [editHeadline, setEditHeadline] = useState(data.siteCopy.heroHeadline);
  const [editSubtitle, setEditSubtitle] = useState(data.siteCopy.heroSubtitle);
  const [editPortfolioTitle, setEditPortfolioTitle] = useState(data.siteCopy.portfolioTitle);
  const [editConsultationTitle, setEditConsultationTitle] = useState(data.siteCopy.consultationTitle);
  const [editConsultationDesc, setEditConsultationDesc] = useState(data.siteCopy.consultationDesc);
  const [editPricingList, setEditPricingList] = useState<PricingTierData[]>(data.pricing);

  // WhatsApp Form
  const [editWaNumber, setEditWaNumber] = useState(data.contact.whatsappNumber);
  const [editWaDisplay, setEditWaDisplay] = useState(data.contact.whatsappDisplay);

  // New Portfolio Form State with File Upload
  const [newPortTitle, setNewPortTitle] = useState("");
  const [newPortCategory, setNewPortCategory] = useState("");
  const [newPortDesc, setNewPortDesc] = useState("");
  const [newPortImage, setNewPortImage] = useState("");
  const [newPortTags, setNewPortTags] = useState("");
  const fileInputRef = useRef<HTMLInputElement>(null);

  // New Client Brand / Logo Form State
  const [newBrandName, setNewBrandName] = useState("");
  const [newBrandLabel, setNewBrandLabel] = useState("");
  const [newBrandLogo, setNewBrandLogo] = useState("");
  const brandLogoInputRef = useRef<HTMLInputElement>(null);

  const showToast = (msg: string) => {
    setToastMessage(msg);
    setTimeout(() => setToastMessage(""), 3500);
  };

  const handleLogin = (e: React.FormEvent) => {
    e.preventDefault();
    if (
      username.trim().toLowerCase() === "developer" &&
      password.trim() === "developer123"
    ) {
      setIsAuthenticated(true);
      setLoginError(false);
    } else {
      setLoginError(true);
    }
  };

  // Handle local portfolio image file upload
  const handleImageFileUpload = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0];
    if (!file) return;

    if (file.size > 5 * 1024 * 1024) {
      alert("Ukuran gambar maksimal 5MB");
      return;
    }

    const reader = new FileReader();
    reader.onload = (event) => {
      const result = event.target?.result as string;
      setNewPortImage(result);
    };
    reader.readAsDataURL(file);
  };

  // Handle client logo file upload
  const handleBrandLogoUpload = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0];
    if (!file) return;

    if (file.size > 3 * 1024 * 1024) {
      alert("Ukuran logo maksimal 3MB");
      return;
    }

    const reader = new FileReader();
    reader.onload = (event) => {
      const result = event.target?.result as string;
      setNewBrandLogo(result);
    };
    reader.readAsDataURL(file);
  };

  const handleCreatePortfolio = (e: React.FormEvent) => {
    e.preventDefault();
    if (!newPortTitle.trim() || !newPortDesc.trim()) {
      alert("Mohon isi judul dan deskripsi portofolio.");
      return;
    }

    addPortfolioItem({
      title: newPortTitle.trim(),
      category: newPortCategory.trim() || undefined,
      image:
        newPortImage ||
        "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&auto=format&fit=crop&q=80",
      description: newPortDesc.trim(),
      tags: newPortTags
        .split(",")
        .map((t) => t.trim())
        .filter(Boolean),
    });

    setNewPortTitle("");
    setNewPortCategory("");
    setNewPortDesc("");
    setNewPortImage("");
    setNewPortTags("");
    if (fileInputRef.current) fileInputRef.current.value = "";
    showToast("Portofolio baru berhasil ditambahkan!");
  };

  const handleCreateBrand = (e: React.FormEvent) => {
    e.preventDefault();
    if (!newBrandLogo && !newBrandName.trim()) {
      alert("Mohon upload logo gambar atau isi nama brand.");
      return;
    }

    addClientBrand({
      name: newBrandName.trim() || undefined,
      label: newBrandLabel.trim() || undefined,
      logoImage: newBrandLogo || undefined,
    });

    setNewBrandName("");
    setNewBrandLabel("");
    setNewBrandLogo("");
    if (brandLogoInputRef.current) brandLogoInputRef.current.value = "";
    showToast("Logo brand berhasil ditambahkan ke animasi slider!");
  };

  const saveVisualChanges = () => {
    updateSiteCopy({
      heroHeadline: editHeadline,
      heroSubtitle: editSubtitle,
      portfolioTitle: editPortfolioTitle,
      consultationTitle: editConsultationTitle,
      consultationDesc: editConsultationDesc,
    });
    updatePricing(editPricingList);
    showToast("Semua perubahan teks dan harga berhasil disimpan!");
  };

  const saveWhatsApp = () => {
    updateContact({
      whatsappNumber: editWaNumber.replace(/[^0-9]/g, ""),
      whatsappDisplay: editWaDisplay,
    });
    showToast("Nomor WhatsApp berhasil diperbarui di seluruh website!");
  };

  if (!isAuthenticated) {
    return (
      <div className="min-h-screen bg-white flex items-center justify-center p-4">
        <motion.div
          initial={{ opacity: 0, scale: 0.95 }}
          animate={{ opacity: 1, scale: 1 }}
          className="bg-white border border-gray-200 rounded-2xl p-8 max-w-sm w-full shadow-lg text-center"
        >
          <div className="w-12 h-12 rounded-xl bg-brand-50 border border-brand-100 text-brand-800 flex items-center justify-center mx-auto mb-4">
            <Lock className="w-6 h-6" />
          </div>
          <h1 className="text-lg font-bold text-gray-900 mb-1">
            SOLVETA Developer Portal
          </h1>
          <p className="text-xs text-gray-500 mb-6">
            Silakan masukkan akun developer untuk mengedit isi website secara visual.
          </p>

          <form onSubmit={handleLogin} className="space-y-3.5 text-left">
            <div>
              <label className="block text-[11px] font-semibold text-gray-600 mb-1">
                Username
              </label>
              <input
                type="text"
                required
                value={username}
                onChange={(e) => setUsername(e.target.value)}
                placeholder="developer"
                className="w-full text-xs px-3.5 py-2.5 rounded-lg border border-gray-300 focus:border-brand-600 outline-none bg-white"
                autoFocus
              />
            </div>

            <div>
              <label className="block text-[11px] font-semibold text-gray-600 mb-1">
                Password
              </label>
              <input
                type="password"
                required
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                placeholder="developer123"
                className="w-full text-xs px-3.5 py-2.5 rounded-lg border border-gray-300 focus:border-brand-600 outline-none bg-white"
              />
            </div>

            {loginError && (
              <p className="text-[11px] text-red-600 font-medium">
                Username atau password salah. (Gunakan: developer / developer123)
              </p>
            )}

            <button
              type="submit"
              className="w-full mt-2 py-2.5 bg-brand-800 hover:bg-brand-900 text-white font-semibold text-xs rounded-lg transition-colors shadow-xs"
            >
              Masuk Portal Developer
            </button>
          </form>

          <div className="mt-6 pt-4 border-t border-gray-100">
            <Link
              href="/"
              className="text-xs text-gray-400 hover:text-gray-600 inline-flex items-center gap-1"
            >
              <ArrowLeft className="w-3 h-3" />
              <span>Kembali ke Website Utama</span>
            </Link>
          </div>
        </motion.div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-white flex flex-col">
      {/* Toast Notification */}
      {toastMessage && (
        <div className="fixed top-5 right-5 z-50 bg-gray-900 text-white text-xs px-4 py-3 rounded-xl shadow-xl flex items-center gap-2 animate-bounce">
          <CheckCircle2 className="w-4 h-4 text-emerald-400" />
          <span>{toastMessage}</span>
        </div>
      )}

      {/* Top Floating Control Bar */}
      <header className="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-200 px-6 py-3 shadow-xs">
        <div className="max-w-[1240px] mx-auto flex items-center justify-between gap-4">
          <div className="flex items-center gap-3">
            <div className="w-7 h-7 rounded-lg bg-brand-800 text-white flex items-center justify-center font-bold text-xs">
              S
            </div>
            <div>
              <div className="font-extrabold text-xs text-gray-900 flex items-center gap-1.5">
                <span>Visual Developer Editor</span>
                <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" />
              </div>
              <div className="text-[10px] text-gray-400">
                Klik langsung bagian web untuk mengubah teks/harga
              </div>
            </div>
          </div>

          {/* Mode Switcher with Short Concise Labels */}
          <div className="flex items-center gap-1.5 bg-gray-50 border border-gray-200 p-1 rounded-lg">
            <button
              onClick={() => setActiveMode("visual")}
              className={`text-xs font-semibold px-3 py-1.5 rounded-md transition-all ${
                activeMode === "visual"
                  ? "bg-white text-brand-900 border border-gray-200 shadow-2xs"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              <span className="flex items-center gap-1.5">
                <Edit3 className="w-3.5 h-3.5 text-brand-800" />
                <span>Edit Visual</span>
              </span>
            </button>

            <button
              onClick={() => setActiveMode("portfolio")}
              className={`text-xs font-semibold px-3 py-1.5 rounded-md transition-all ${
                activeMode === "portfolio"
                  ? "bg-white text-brand-900 border border-gray-200 shadow-2xs"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              <span className="flex items-center gap-1.5">
                <ImageIcon className="w-3.5 h-3.5 text-brand-800" />
                <span>Portofolio</span>
              </span>
            </button>

            <button
              onClick={() => setActiveMode("brands")}
              className={`text-xs font-semibold px-3 py-1.5 rounded-md transition-all ${
                activeMode === "brands"
                  ? "bg-white text-brand-900 border border-gray-200 shadow-2xs"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              <span className="flex items-center gap-1.5">
                <Building2 className="w-3.5 h-3.5 text-brand-800" />
                <span>Logo Klien</span>
              </span>
            </button>

            <button
              onClick={() => setActiveMode("contact")}
              className={`text-xs font-semibold px-3 py-1.5 rounded-md transition-all ${
                activeMode === "contact"
                  ? "bg-white text-brand-900 border border-gray-200 shadow-2xs"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              <span className="flex items-center gap-1.5">
                <Phone className="w-3.5 h-3.5 text-brand-800" />
                <span>Kontak WhatsApp</span>
              </span>
            </button>
          </div>

          {/* Action Buttons */}
          <div className="flex items-center gap-2">
            <button
              onClick={saveVisualChanges}
              className="inline-flex items-center gap-1.5 px-4 py-1.5 bg-brand-800 hover:bg-brand-900 text-white text-xs font-semibold rounded-md shadow-xs transition-colors"
            >
              <Save className="w-3.5 h-3.5" />
              <span>Simpan Perubahan</span>
            </button>

            <Link
              href="/"
              target="_blank"
              className="inline-flex items-center gap-1 text-xs font-medium text-gray-600 hover:text-gray-900 bg-white border border-gray-200 hover:bg-gray-50 px-3 py-1.5 rounded-md transition-colors"
            >
              <Eye className="w-3.5 h-3.5" />
              <span>Buka Live Web</span>
            </Link>

            <button
              onClick={() => {
                if (confirm("Kembalikan semua teks & harga ke setelan awal?")) {
                  resetToDefaults();
                  showToast("Data dikembalikan ke setelan awal!");
                  setTimeout(() => window.location.reload(), 600);
                }
              }}
              className="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
              title="Reset Default"
            >
              <RotateCcw className="w-4 h-4" />
            </button>
          </div>
        </div>
      </header>

      {/* Main Content Area */}
      <div className="flex-grow p-4 sm:p-6 max-w-[1240px] mx-auto w-full bg-white">
        {/* MODE 1: VISUAL LIVE PREVIEW WITH CLICK-TO-EDIT */}
        {activeMode === "visual" && (
          <div className="bg-white border border-gray-200 rounded-2xl shadow-xs overflow-hidden">
            <div className="p-6 sm:p-12 space-y-16">
              {/* 1. Hero Live Section */}
              <div className="text-center relative group p-6 rounded-2xl border border-dashed border-gray-200 hover:border-brand-300 transition-colors">
                <span className="absolute top-2 right-2 opacity-0 group-hover:opacity-100 text-[10px] font-semibold text-brand-800 bg-brand-50 px-2 py-0.5 rounded transition-opacity">
                  Klik untuk edit Hero
                </span>

                <div className="inline-block font-mono text-[11px] font-semibold uppercase tracking-wider text-gray-700 bg-white border border-gray-200 px-3.5 py-1 rounded-full mb-4">
                  {data.siteCopy.heroEyebrow}
                </div>

                <div
                  onClick={() => setEditingTarget({ type: "heroHeadline" })}
                  className="cursor-pointer hover:bg-brand-50/50 p-2 rounded-lg transition-colors"
                  title="Klik untuk ubah judul"
                >
                  <h1 className="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-950 tracking-tight leading-tight whitespace-pre-line">
                    {editHeadline}
                  </h1>
                </div>

                <div
                  onClick={() => setEditingTarget({ type: "heroSubtitle" })}
                  className="cursor-pointer hover:bg-brand-50/50 p-2 rounded-lg transition-colors mt-3 max-w-2xl mx-auto"
                  title="Klik untuk ubah deskripsi"
                >
                  <p className="text-xs sm:text-sm text-gray-600 leading-relaxed whitespace-pre-line">
                    {editSubtitle}
                  </p>
                </div>
              </div>

              {/* 2. Client Marquee Quick Action */}
              <div className="text-center p-4 bg-white border border-gray-200 rounded-xl flex items-center justify-between">
                <div className="text-left">
                  <div className="text-xs font-bold text-gray-800">
                    Slider Logo Klien &amp; Partner ({data.clientBrands.length} Brand Aktif &bull; Format Oval Padat)
                  </div>
                  <div className="text-[11px] text-gray-500">
                    Gambar logo otomatis pas di dalam bentuk oval tumpul tanpa tepi sisa berlebih.
                  </div>
                </div>
                <button
                  onClick={() => setActiveMode("brands")}
                  className="text-xs font-semibold text-brand-800 bg-white border border-gray-300 hover:border-brand-600 px-3 py-1.5 rounded-lg shadow-2xs"
                >
                  + Kelola Logo Klien
                </button>
              </div>

              {/* 3. Portfolio Header Live */}
              <div className="text-center relative group p-6 rounded-2xl border border-dashed border-gray-200 hover:border-brand-300 transition-colors">
                <span className="absolute top-2 right-2 opacity-0 group-hover:opacity-100 text-[10px] font-semibold text-brand-800 bg-brand-50 px-2 py-0.5 rounded transition-opacity">
                  Klik untuk edit Judul Portofolio
                </span>

                <span className="font-mono text-[11px] font-bold tracking-widest text-brand-700 uppercase bg-white border border-brand-100 px-3.5 py-1 rounded-full inline-block mb-3">
                  KARYA &amp; PORTOFOLIO
                </span>

                <div
                  onClick={() => setEditingTarget({ type: "portfolioTitle" })}
                  className="cursor-pointer hover:bg-brand-50/50 p-2 rounded-lg transition-colors max-w-xl mx-auto"
                >
                  <h2 className="text-2xl sm:text-3xl font-extrabold text-gray-950 tracking-tight">
                    {editPortfolioTitle}
                  </h2>
                </div>

                <div className="mt-4 flex items-center justify-center gap-2">
                  <button
                    onClick={() => setActiveMode("portfolio")}
                    className="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-800 bg-white border border-brand-200 hover:bg-brand-50 px-3.5 py-1.5 rounded-full transition-colors"
                  >
                    <Plus className="w-3.5 h-3.5" />
                    <span>Upload &amp; Kelola Portofolio ({data.portfolio.length} Karya)</span>
                  </button>
                </div>
              </div>

              {/* 4. Pricing Live Section */}
              <div>
                <div className="text-center mb-8">
                  <h2 className="text-base font-bold uppercase tracking-wider text-gray-900 mb-1">
                    PILIH SOLUSI SESUAI KEBUTUHAN
                  </h2>
                  <p className="text-xs text-gray-500">
                    Klik kartu mana saja untuk mengubah harga atau fiturnya secara instan.
                  </p>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                  {editPricingList.map((tier, idx) => (
                    <div
                      key={tier.id}
                      onClick={() => setEditingTarget({ type: "pricing", tierIndex: idx })}
                      className={`p-5 rounded-xl border bg-white cursor-pointer hover:border-brand-600 hover:shadow-md transition-all relative group ${
                        tier.popular ? "border-2 border-brand-600" : "border-gray-200"
                      }`}
                    >
                      <div className="absolute top-2 right-2 opacity-0 group-hover:opacity-100 bg-brand-50 text-brand-800 p-1 rounded transition-opacity">
                        <Edit3 className="w-3.5 h-3.5" />
                      </div>

                      {tier.popular && (
                        <span className="absolute -top-2.5 left-1/2 -translate-x-1/2 bg-brand-800 text-white font-mono text-[9px] font-bold uppercase px-2 py-0.5 rounded-full">
                          POPULAR
                        </span>
                      )}

                      <div className="text-xs font-bold text-gray-800 uppercase mb-1">
                        {tier.name}
                      </div>
                      <div className="text-xl font-extrabold text-gray-950 mb-3">
                        {tier.price}
                      </div>

                      <div className="space-y-1.5 text-[11px] text-gray-600 mb-4">
                        {tier.features.slice(0, 3).map((f, i) => (
                          <div key={i} className="line-clamp-1">
                            &bull; {f}
                          </div>
                        ))}
                        {tier.features.length > 3 && (
                          <div className="text-[10px] text-gray-400 italic">
                            +{tier.features.length - 3} fitur lainnya
                          </div>
                        )}
                      </div>

                      <div className="text-[10px] text-gray-500 border-t pt-2">
                        <strong>Cocok:</strong> {tier.suitability}
                      </div>
                    </div>
                  ))}
                </div>
              </div>

              {/* 5. Consultation CTA Live Section */}
              <div
                onClick={() => setEditingTarget({ type: "consultation" })}
                className="bg-white border border-gray-200 hover:border-brand-300 rounded-2xl p-8 text-center cursor-pointer transition-colors"
              >
                <h3 className="text-xl sm:text-2xl font-extrabold text-gray-950 mb-2">
                  {editConsultationTitle}
                </h3>
                <p className="text-xs text-gray-600 max-w-lg mx-auto mb-4">
                  {editConsultationDesc}
                </p>
                <span className="inline-block px-4 py-2 bg-brand-800 text-white text-xs font-semibold rounded-lg">
                  Konsultasi Gratis Sekarang
                </span>
              </div>
            </div>
          </div>
        )}

        {/* MODE 2: PORTFOLIO MANAGER WITH IMAGE UPLOAD */}
        {activeMode === "portfolio" && (
          <div className="space-y-6 bg-white">
            <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
              <h2 className="text-sm font-bold text-gray-900 mb-1 flex items-center gap-2">
                <Upload className="w-4 h-4 text-brand-800" />
                <span>Tambah Karya Portofolio</span>
              </h2>
              <p className="text-xs text-gray-500 mb-5">
                Upload file screenshot atau foto web dari laptop/HP Anda. Kategori opsional.
              </p>

              <form onSubmit={handleCreatePortfolio} className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div className="md:col-span-2">
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Nama / Judul Portofolio *
                    </label>
                    <input
                      type="text"
                      required
                      value={newPortTitle}
                      onChange={(e) => setNewPortTitle(e.target.value)}
                      placeholder="Contoh: Apotek Sehat — POS & Rekam Medis"
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-brand-600 outline-none bg-white"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Kategori (Opsional)
                    </label>
                    <input
                      type="text"
                      value={newPortCategory}
                      onChange={(e) => setNewPortCategory(e.target.value)}
                      placeholder="Contoh: E-Commerce / Kosongkan"
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-brand-600 outline-none bg-white"
                    />
                  </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Upload Gambar Pratinjau Web
                    </label>
                    <div
                      onClick={() => fileInputRef.current?.click()}
                      className="border-2 border-dashed border-gray-300 hover:border-brand-600 rounded-xl p-4 text-center cursor-pointer bg-white hover:bg-gray-50/50 transition-all flex flex-col items-center justify-center gap-1.5 min-h-[110px]"
                    >
                      <Upload className="w-5 h-5 text-gray-400" />
                      <span className="text-xs font-semibold text-brand-800">
                        Pilih File Gambar Web
                      </span>
                      <span className="text-[10px] text-gray-400">
                        PNG, JPG, WebP (Maksimal 5MB)
                      </span>
                    </div>
                    <input
                      ref={fileInputRef}
                      type="file"
                      accept="image/*"
                      onChange={handleImageFileUpload}
                      className="hidden"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Pratinjau Gambar Terpilih
                    </label>
                    <div className="aspect-[16/10] bg-white rounded-xl overflow-hidden border border-gray-200 flex items-center justify-center relative">
                      {newPortImage ? (
                        <>
                          <img
                            src={newPortImage}
                            alt="Preview"
                            className="w-full h-full object-cover"
                          />
                          <button
                            type="button"
                            onClick={() => {
                              setNewPortImage("");
                              if (fileInputRef.current) fileInputRef.current.value = "";
                            }}
                            className="absolute top-2 right-2 bg-black/60 text-white p-1 rounded-md text-xs hover:bg-black"
                          >
                            <X className="w-3.5 h-3.5" />
                          </button>
                        </>
                      ) : (
                        <span className="text-xs text-gray-400 flex items-center gap-1">
                          <ImageIcon className="w-4 h-4" /> Belum ada gambar dipilih
                        </span>
                      )}
                    </div>
                  </div>
                </div>

                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Deskripsi Ringkas Solusi *
                  </label>
                  <textarea
                    rows={2}
                    required
                    value={newPortDesc}
                    onChange={(e) => setNewPortDesc(e.target.value)}
                    placeholder="Contoh: Membangun sistem kasir terintegrasi WhatsApp checkout dan laporan stok real-time."
                    className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-brand-600 outline-none bg-white"
                  />
                </div>

                <button
                  type="submit"
                  className="px-6 py-2.5 bg-brand-800 hover:bg-brand-900 text-white text-xs font-semibold rounded-lg shadow-xs transition-colors"
                >
                  + Tambah ke Portofolio
                </button>
              </form>
            </div>

            {/* List Existing Projects */}
            <div>
              <h3 className="text-sm font-bold text-gray-900 mb-3">
                Karya Portofolio Saat Ini ({data.portfolio.length} Item)
              </h3>

              <div className="grid grid-cols-1 md:grid-cols-3 gap-5">
                {data.portfolio.map((p) => (
                  <div
                    key={p.id}
                    className="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-2xs flex flex-col justify-between"
                  >
                    <div className="aspect-[16/10] bg-white relative">
                      <img
                        src={p.image}
                        alt={p.title}
                        className="w-full h-full object-cover"
                      />
                      {p.category && (
                        <span className="absolute top-2 left-2 bg-white/95 px-2 py-0.5 rounded text-[10px] font-bold border border-gray-200">
                          {p.category}
                        </span>
                      )}
                    </div>

                    <div className="p-4 flex-grow flex flex-col justify-between">
                      <div>
                        <div className="font-bold text-xs text-gray-900 mb-1">
                          {p.title}
                        </div>
                        <p className="text-[11px] text-gray-500 line-clamp-2 mb-3">
                          {p.description}
                        </p>
                      </div>

                      <div className="flex items-center justify-between pt-3 border-t border-gray-100">
                        <span className="text-[10px] text-gray-400 font-mono">
                          {p.tags.join(", ")}
                        </span>
                        <button
                          onClick={() => {
                            if (confirm(`Hapus portofolio "${p.title}"?`)) {
                              deletePortfolioItem(p.id);
                              showToast("Portofolio berhasil dihapus!");
                            }
                          }}
                          className="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors"
                          title="Hapus portofolio"
                        >
                          <Trash2 className="w-4 h-4" />
                        </button>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        )}

        {/* MODE 3: CLIENT LOGO & BRAND MARQUEE MANAGER */}
        {activeMode === "brands" && (
          <div className="space-y-6 bg-white">
            <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
              <h2 className="text-sm font-bold text-gray-900 mb-1 flex items-center gap-2">
                <Building2 className="w-4 h-4 text-brand-800" />
                <span>Tambah Logo / Brand Klien Baru</span>
              </h2>
              <p className="text-xs text-gray-500 mb-5">
                Gambar logo akan dipress pas dan ujungnya otomatis berbentuk oval halus tanpa tepi sisa.
              </p>

              <form onSubmit={handleCreateBrand} className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Upload Logo Gambar (Otomatis Bentuk Oval)
                    </label>
                    <div
                      onClick={() => brandLogoInputRef.current?.click()}
                      className="border-2 border-dashed border-gray-300 hover:border-brand-600 rounded-xl p-4 text-center cursor-pointer bg-white hover:bg-gray-50/50 transition-all flex flex-col items-center justify-center gap-1.5 min-h-[95px]"
                    >
                      <Upload className="w-5 h-5 text-gray-400" />
                      <span className="text-xs font-semibold text-brand-800">
                        Pilih File Logo Brand
                      </span>
                      <span className="text-[10px] text-gray-400">
                        PNG, JPG, SVG, WebP (Maksimal 3MB)
                      </span>
                    </div>
                    <input
                      ref={brandLogoInputRef}
                      type="file"
                      accept="image/*"
                      onChange={handleBrandLogoUpload}
                      className="hidden"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Pratinjau Logo Kapsul Oval (Tanpa Tepi Sisa)
                    </label>
                    <div className="h-[95px] bg-white rounded-xl border border-gray-200 flex items-center justify-center p-3 relative">
                      {newBrandLogo ? (
                        <>
                          <div className="border border-gray-200 rounded-full overflow-hidden h-11 flex items-center justify-center bg-white shadow-2xs">
                            <img
                              src={newBrandLogo}
                              alt="Brand Logo"
                              className="h-full w-auto max-w-[150px] object-cover rounded-full"
                            />
                          </div>
                          <button
                            type="button"
                            onClick={() => {
                              setNewBrandLogo("");
                              if (brandLogoInputRef.current) brandLogoInputRef.current.value = "";
                            }}
                            className="absolute top-2 right-2 bg-black/60 text-white p-1 rounded-md text-xs hover:bg-black"
                          >
                            <X className="w-3.5 h-3.5" />
                          </button>
                        </>
                      ) : (
                        <span className="text-xs text-gray-400 flex items-center gap-1">
                          <Building2 className="w-4 h-4" /> (Tanpa logo gambar, dapat gunakan nama teks di bawah)
                        </span>
                      )}
                    </div>
                  </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Nama Brand / Bisnis (Opsional jika sudah upload logo)
                    </label>
                    <input
                      type="text"
                      value={newBrandName}
                      onChange={(e) => setNewBrandName(e.target.value)}
                      placeholder="Contoh: PT Surya Global Indonesia"
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-brand-600 outline-none bg-white"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Kategori / Industri Singkat (Opsional)
                    </label>
                    <input
                      type="text"
                      value={newBrandLabel}
                      onChange={(e) => setNewBrandLabel(e.target.value)}
                      placeholder="Contoh: Healthcare / Retail"
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-brand-600 outline-none bg-white"
                    />
                  </div>
                </div>

                <button
                  type="submit"
                  className="px-6 py-2.5 bg-brand-800 hover:bg-brand-900 text-white text-xs font-semibold rounded-lg shadow-xs transition-colors"
                >
                  + Tambah Brand ke Animasi Slider
                </button>
              </form>
            </div>

            {/* List Existing Client Brands */}
            <div>
              <h3 className="text-sm font-bold text-gray-900 mb-3">
                Daftar Brand / Klien di Slider ({data.clientBrands.length} Item)
              </h3>

              <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3.5">
                {data.clientBrands.map((b) => (
                  <div
                    key={b.id}
                    className="bg-white border border-gray-200 rounded-full overflow-hidden shadow-2xs flex items-center justify-between gap-2 p-1 pl-1 pr-3"
                  >
                    <div className="flex items-center gap-2 overflow-hidden">
                      {b.logoImage ? (
                        <div className="h-9 w-14 rounded-full overflow-hidden flex-shrink-0 flex items-center justify-center bg-white border border-gray-100">
                          <img
                            src={b.logoImage}
                            alt={b.name || "Brand Logo"}
                            className="h-full w-full object-cover rounded-full"
                          />
                        </div>
                      ) : (
                        <div className="w-2.5 h-2.5 rounded-full bg-brand-700 flex-shrink-0 ml-2" />
                      )}
                      <div className="truncate">
                        <div className="font-bold text-xs text-gray-900 truncate">
                          {b.name || "Logo Client"}
                        </div>
                        {b.label && (
                          <div className="text-[10px] text-gray-400 truncate">
                            {b.label}
                          </div>
                        )}
                      </div>
                    </div>

                    <button
                      onClick={() => {
                        if (confirm(`Hapus brand "${b.name || "item"}" dari slider?`)) {
                          deleteClientBrand(b.id);
                          showToast("Brand dihapus dari slider!");
                        }
                      }}
                      className="p-1 text-red-600 hover:bg-red-50 rounded-full transition-colors flex-shrink-0"
                      title="Hapus brand"
                    >
                      <Trash2 className="w-3.5 h-3.5" />
                    </button>
                  </div>
                ))}
              </div>
            </div>
          </div>
        )}

        {/* MODE 4: WHATSAPP SETTINGS */}
        {activeMode === "contact" && (
          <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs max-w-lg mx-auto">
            <h2 className="text-sm font-bold text-gray-900 mb-1 flex items-center gap-2">
              <Phone className="w-4 h-4 text-brand-800" />
              <span>Ganti Nomor WhatsApp Tujuan Order</span>
            </h2>
            <p className="text-xs text-gray-500 mb-5">
              Nomor ini akan otomatis digunakan di semua tombol &quot;Hubungi Kami&quot;, &quot;Pilih Paket&quot;, dan tombol &quot;Konsultasikan Kebutuhan Anda&quot; di seluruh website.
            </p>

            <div className="space-y-4">
              <div>
                <label className="block text-xs font-semibold text-gray-700 mb-1">
                  Nomor WhatsApp (Angka internasional, contoh: 6285719663154)
                </label>
                <input
                  type="text"
                  value={editWaNumber}
                  onChange={(e) => setEditWaNumber(e.target.value.replace(/[^0-9]/g, ""))}
                  placeholder="6285719663154"
                  className="w-full text-xs p-2.5 rounded-lg border border-gray-300 font-mono font-bold bg-white"
                />
              </div>

              <div>
                <label className="block text-xs font-semibold text-gray-700 mb-1">
                  Tampilan Nomor di Web (Teks yang dilihat pengunjung)
                </label>
                <input
                  type="text"
                  value={editWaDisplay}
                  onChange={(e) => setEditWaDisplay(e.target.value)}
                  placeholder="+62 857-1966-3154"
                  className="w-full text-xs p-2.5 rounded-lg border border-gray-300 bg-white"
                />
              </div>

              <button
                onClick={saveWhatsApp}
                className="w-full py-2.5 bg-brand-800 hover:bg-brand-900 text-white text-xs font-semibold rounded-lg shadow-xs transition-colors"
              >
                Simpan Nomor WhatsApp
              </button>
            </div>
          </div>
        )}
      </div>

      {/* QUICK INLINE EDIT MODAL */}
      <AnimatePresence>
        {editingTarget && (
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              exit={{ opacity: 0 }}
              onClick={() => setEditingTarget(null)}
              className="fixed inset-0 bg-black/40 backdrop-blur-xs"
            />

            <motion.div
              initial={{ scale: 0.95, opacity: 0 }}
              animate={{ scale: 1, opacity: 1 }}
              exit={{ scale: 0.95, opacity: 0 }}
              className="bg-white rounded-2xl p-6 shadow-2xl border border-gray-200 max-w-lg w-full relative z-10 space-y-4"
            >
              <div className="flex items-center justify-between border-b pb-3">
                <span className="text-xs font-bold text-gray-900 uppercase">
                  Edit Bagian Website
                </span>
                <button
                  onClick={() => setEditingTarget(null)}
                  className="text-gray-400 hover:text-gray-600 p-1 rounded-md"
                >
                  <X className="w-4 h-4" />
                </button>
              </div>

              {editingTarget.type === "heroHeadline" && (
                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Headline Utama Hero
                  </label>
                  <textarea
                    rows={3}
                    value={editHeadline}
                    onChange={(e) => setEditHeadline(e.target.value)}
                    className="w-full text-xs p-2.5 rounded-lg border border-gray-300 font-bold bg-white"
                  />
                </div>
              )}

              {editingTarget.type === "heroSubtitle" && (
                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Deskripsi Paragraf Hero
                  </label>
                  <textarea
                    rows={4}
                    value={editSubtitle}
                    onChange={(e) => setEditSubtitle(e.target.value)}
                    className="w-full text-xs p-2.5 rounded-lg border border-gray-300 bg-white"
                  />
                </div>
              )}

              {editingTarget.type === "portfolioTitle" && (
                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Judul Bagian Portofolio
                  </label>
                  <input
                    type="text"
                    value={editPortfolioTitle}
                    onChange={(e) => setEditPortfolioTitle(e.target.value)}
                    className="w-full text-xs p-2.5 rounded-lg border border-gray-300 font-bold bg-white"
                  />
                </div>
              )}

              {editingTarget.type === "consultation" && (
                <div className="space-y-3">
                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Judul Banner Konsultasi
                    </label>
                    <input
                      type="text"
                      value={editConsultationTitle}
                      onChange={(e) => setEditConsultationTitle(e.target.value)}
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 font-bold bg-white"
                    />
                  </div>
                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Deskripsi Banner Konsultasi
                    </label>
                    <textarea
                      rows={3}
                      value={editConsultationDesc}
                      onChange={(e) => setEditConsultationDesc(e.target.value)}
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 bg-white"
                    />
                  </div>
                </div>
              )}

              {editingTarget.type === "pricing" && editingTarget.tierIndex !== undefined && (
                <div className="space-y-3">
                  <div className="grid grid-cols-2 gap-3">
                    <div>
                      <label className="block text-[11px] font-semibold text-gray-700 mb-1">
                        Nama Paket
                      </label>
                      <input
                        type="text"
                        value={editPricingList[editingTarget.tierIndex].name}
                        onChange={(e) => {
                          const list = [...editPricingList];
                          list[editingTarget.tierIndex!].name = e.target.value;
                          setEditPricingList(list);
                        }}
                        className="w-full text-xs p-2 rounded border border-gray-300 bg-white"
                      />
                    </div>
                    <div>
                      <label className="block text-[11px] font-semibold text-gray-700 mb-1">
                        Harga Display
                      </label>
                      <input
                        type="text"
                        value={editPricingList[editingTarget.tierIndex].price}
                        onChange={(e) => {
                          const list = [...editPricingList];
                          list[editingTarget.tierIndex!].price = e.target.value;
                          setEditPricingList(list);
                        }}
                        className="w-full text-xs p-2 rounded border border-gray-300 font-bold bg-white"
                      />
                    </div>
                  </div>

                  <div>
                    <label className="block text-[11px] font-semibold text-gray-700 mb-1">
                      Deskripsi &quot;Cocok Untuk&quot;
                    </label>
                    <input
                      type="text"
                      value={editPricingList[editingTarget.tierIndex].suitability}
                      onChange={(e) => {
                        const list = [...editPricingList];
                        list[editingTarget.tierIndex!].suitability = e.target.value;
                        setEditPricingList(list);
                      }}
                      className="w-full text-xs p-2 rounded border border-gray-300 bg-white"
                    />
                  </div>

                  <div>
                    <label className="block text-[11px] font-semibold text-gray-700 mb-1">
                      Daftar Fitur (1 baris per fitur)
                    </label>
                    <textarea
                      rows={4}
                      value={editPricingList[editingTarget.tierIndex].features.join("\n")}
                      onChange={(e) => {
                        const list = [...editPricingList];
                        list[editingTarget.tierIndex!].features = e.target.value.split("\n");
                        setEditPricingList(list);
                      }}
                      className="w-full text-xs p-2 rounded border border-gray-300 font-mono bg-white"
                    />
                  </div>
                </div>
              )}

              <button
                onClick={() => {
                  saveVisualChanges();
                  setEditingTarget(null);
                }}
                className="w-full py-2.5 bg-brand-800 hover:bg-brand-900 text-white font-semibold text-xs rounded-lg transition-colors shadow-xs"
              >
                Terapkan &amp; Simpan
              </button>
            </motion.div>
          </div>
        )}
      </AnimatePresence>
    </div>
  );
}

export default function AdminPage() {
  return (
    <SiteDataProvider>
      <AdminPortalVisual />
    </SiteDataProvider>
  );
}
