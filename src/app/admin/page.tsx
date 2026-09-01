"use client";

import React, { useState, useRef, useEffect, useCallback } from "react";
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
  Gauge,
  Image as ImageIcon,
  Building2,
  Tag,
  Check,
  Camera,
  Clock,
  Globe,
  Mail,
  ShieldCheck,
  Sparkles,
  Layers,
  MessageCircle,
  Film,
  Play,
  Pause,
  Volume2,
  VolumeX,
  Video,
  UploadCloud,
  RefreshCw,
  ExternalLink,
  ZoomIn,
  ZoomOut,
  Crop,
  Wand2,
  Sun,
  Moon,
  Settings,
  Sliders,
} from "lucide-react";
import {
  SiteDataProvider,
  useSiteData,
  SiteDataState,
  PricingTierData,
  PortfolioItemData,
  ClientBrandItem,
  ChecklistItemData,
  DomainAddonData,
  EmailAddonData,
} from "@/context/SiteDataContext";

function AdminPortalVisual() {
  const {
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
    updateContact,
    updateSiteCopy,
    updateSiteLogo,
    updateProfileVideo,
    syncWithSupabase,
    resetToDefaults,
  } = useSiteData();

  // Authentication: username 'developer', password 'developer123'
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [loginError, setLoginError] = useState(false);

  // Active View Mode: 'visual' | 'pricing' | 'portfolio' | 'brands' | 'contact' | 'video'
  const [activeMode, setActiveMode] = useState<
    "visual" | "pricing" | "portfolio" | "brands" | "contact" | "video"
  >("visual");
  const [toastMessage, setToastMessage] = useState("");

  // Edit Modal State for Live Visual Editor
  const [editingTarget, setEditingTarget] = useState<{
    type: "heroHeadline" | "heroSubtitle" | "portfolioTitle" | "consultation" | "pricing" | "siteLogo";
    tierIndex?: number;
  } | null>(null);

  // Edit Modal State for Portfolio Item
  const [editingPortfolio, setEditingPortfolio] = useState<PortfolioItemData | null>(null);
  const [editPortTags, setEditPortTags] = useState("");
  const [editPortLiveUrl, setEditPortLiveUrl] = useState("");

  // Edit Modal State for Client Brand
  const [editingBrand, setEditingBrand] = useState<ClientBrandItem | null>(null);

  // Quick edit temp values
  const [editHeadline, setEditHeadline] = useState(data.siteCopy.heroHeadline);
  const [editSubtitle, setEditSubtitle] = useState(data.siteCopy.heroSubtitle);
  const [editPortfolioTitle, setEditPortfolioTitle] = useState(data.siteCopy.portfolioTitle);
  const [editConsultationTitle, setEditConsultationTitle] = useState(data.siteCopy.consultationTitle || "");
  const [editConsultationDesc, setEditConsultationDesc] = useState(data.siteCopy.consultationDesc || "");
  const [editPricingList, setEditPricingList] = useState<PricingTierData[]>(data.pricing);
  const [editMarqueeSpeed, setEditMarqueeSpeed] = useState<number>(data.siteCopy.marqueeSpeed || 35);
  const [editMarqueeLogoHeight, setEditMarqueeLogoHeight] = useState<number>(
    data.siteCopy.marqueeLogoHeight || 46
  );
  const [editMarqueeLogoSpacing, setEditMarqueeLogoSpacing] = useState<number>(
    data.siteCopy.marqueeLogoSpacing || 36
  );
  const [editMarqueeLogoScale, setEditMarqueeLogoScale] = useState<number>(
    data.siteCopy.marqueeLogoScale || 100
  );
  const [editMarqueeLogoMaxWidth, setEditMarqueeLogoMaxWidth] = useState<number>(
    data.siteCopy.marqueeLogoMaxWidth || 240
  );
  const [tempLogo, setTempLogo] = useState<string>(data.siteCopy.siteLogo || "");

  // Video Profile Management State
  const [editVideoUrl, setEditVideoUrl] = useState<string>(
    data.siteCopy.profileVideo || "/videos/profile.mp4"
  );
  const [inputVideoLink, setInputVideoLink] = useState<string>("");
  const [isVideoLoading, setIsVideoLoading] = useState<boolean>(false);
  const videoFileInputRef = useRef<HTMLInputElement>(null);

  // Synchronize when data loads
  useEffect(() => {
    setEditPricingList(data.pricing);
    setEditHeadline(data.siteCopy.heroHeadline);
    setEditSubtitle(data.siteCopy.heroSubtitle);
    setEditPortfolioTitle(data.siteCopy.portfolioTitle);
    setTempLogo(data.siteCopy.siteLogo || "");
    setEditVideoUrl(data.siteCopy.profileVideo || "/videos/profile.mp4");
    setEditMarqueeSpeed(data.siteCopy.marqueeSpeed || 35);
    setEditMarqueeLogoHeight(data.siteCopy.marqueeLogoHeight || 46);
    setEditMarqueeLogoSpacing(data.siteCopy.marqueeLogoSpacing || 36);
    setEditMarqueeLogoScale(data.siteCopy.marqueeLogoScale || 100);
    setEditMarqueeLogoMaxWidth(data.siteCopy.marqueeLogoMaxWidth || 240);
  }, [data]);

  // WhatsApp Form
  const [editWaNumber, setEditWaNumber] = useState(data.contact.whatsappNumber);
  const [editWaDisplay, setEditWaDisplay] = useState(data.contact.whatsappDisplay);

  // New Portfolio Form State with File Upload & Live URL
  const [newPortTitle, setNewPortTitle] = useState("");
  const [newPortCategory, setNewPortCategory] = useState("");
  const [newPortDesc, setNewPortDesc] = useState("");
  const [newPortImage, setNewPortImage] = useState("");
  const [newPortTags, setNewPortTags] = useState("");
  const [newPortLiveUrl, setNewPortLiveUrl] = useState("");
  const [newCategoryInput, setNewCategoryInput] = useState("");
  const fileInputRef = useRef<HTMLInputElement>(null);
  const editFileInputRef = useRef<HTMLInputElement>(null);

  // New Client Brand / Logo Form State
  const [newBrandName, setNewBrandName] = useState("");
  const [newBrandLabel, setNewBrandLabel] = useState("");
  const [newBrandLogo, setNewBrandLogo] = useState("");
  const brandLogoInputRef = useRef<HTMLInputElement>(null);
  const editBrandLogoInputRef = useRef<HTMLInputElement>(null);
  const siteLogoInputRef = useRef<HTMLInputElement>(null);

  // Interactive Logo Studio (Crop, Zoom In/Out, Auto-Remove Background)
  const [cropModalOpen, setCropModalOpen] = useState(false);
  const [rawLogoToCrop, setRawLogoToCrop] = useState<string | null>(null);
  const [cropZoom, setCropZoom] = useState<number>(1.0);
  const [cropOffsetX, setCropOffsetX] = useState<number>(0);
  const [cropOffsetY, setCropOffsetY] = useState<number>(0);
  const [autoRemoveBg, setAutoRemoveBg] = useState<boolean>(true);
  const [bgThreshold, setBgThreshold] = useState<number>(35);
  const [previewDarkTheme, setPreviewDarkTheme] = useState<boolean>(true);
  const [isEditModeForBrand, setIsEditModeForBrand] = useState<boolean>(false);
  const logoCanvasRef = useRef<HTMLCanvasElement>(null);

  const showToast = (msg: string) => {
    setToastMessage(msg);
    setTimeout(() => setToastMessage(""), 3500);
  };

  // Redraw canvas whenever zoom, offset, autoRemoveBg, threshold or raw image changes
  const redrawLogoCanvas = useCallback(() => {
    const canvas = logoCanvasRef.current;
    if (!canvas || !rawLogoToCrop) return;
    const ctx = canvas.getContext("2d", { willReadFrequently: true });
    if (!ctx) return;

    const img = new window.Image();
    img.crossOrigin = "anonymous";
    img.onload = () => {
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      const cw = canvas.width;
      const ch = canvas.height;

      // Calculate aspect ratio fit for 1:1 square ratio
      const aspect = img.width / img.height;
      let baseW = cw * 0.82;
      let baseH = baseW / aspect;

      if (baseH > ch * 0.82) {
        baseH = ch * 0.82;
        baseW = baseH * aspect;
      }

      const drawW = baseW * cropZoom;
      const drawH = baseH * cropZoom;

      const drawX = (cw - drawW) / 2 + cropOffsetX;
      const drawY = (ch - drawH) / 2 + cropOffsetY;

      ctx.drawImage(img, drawX, drawY, drawW, drawH);

      if (autoRemoveBg) {
        const imgData = ctx.getImageData(0, 0, cw, ch);
        const data = imgData.data;

        // Sample top-left and top-right corner pixel colors
        const sampleR = (data[0] + data[(cw - 1) * 4]) / 2;
        const sampleG = (data[1] + data[(cw - 1) * 4 + 1]) / 2;
        const sampleB = (data[2] + data[(cw - 1) * 4 + 2]) / 2;

        const maxDiff = bgThreshold * 2.5;

        for (let i = 0; i < data.length; i += 4) {
          const r = data[i];
          const g = data[i + 1];
          const b = data[i + 2];
          const a = data[i + 3];
          if (a === 0) continue;

          // Check if pixel is white/near-white or matches sampled background
          const isNearWhite = r > 255 - maxDiff && g > 255 - maxDiff && b > 255 - maxDiff;
          const isCornerBgMatch =
            Math.abs(r - sampleR) < bgThreshold * 1.5 &&
            Math.abs(g - sampleG) < bgThreshold * 1.5 &&
            Math.abs(b - sampleB) < bgThreshold * 1.5;

          if (isNearWhite || (sampleR > 200 && isCornerBgMatch)) {
            data[i + 3] = 0; // Make transparent!
          }
        }
        ctx.putImageData(imgData, 0, 0);
      }
    };
    img.src = rawLogoToCrop;
  }, [rawLogoToCrop, cropZoom, cropOffsetX, cropOffsetY, autoRemoveBg, bgThreshold]);

  useEffect(() => {
    if (cropModalOpen && rawLogoToCrop) {
      redrawLogoCanvas();
    }
  }, [cropModalOpen, rawLogoToCrop, redrawLogoCanvas]);

  const applyCroppedLogo = () => {
    const canvas = logoCanvasRef.current;
    if (!canvas) return;
    const finalPng = canvas.toDataURL("image/png");
    if (isEditModeForBrand && editingBrand) {
      setEditingBrand({ ...editingBrand, logoImage: finalPng });
      editClientBrand(editingBrand.id, { logoImage: finalPng });
    } else {
      setNewBrandLogo(finalPng);
    }
    setCropModalOpen(false);
    showToast("Logo berhasil diproses & langsung diperbarui!");
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
  const handleImageFileUpload = (e: React.ChangeEvent<HTMLInputElement>, isEdit = false) => {
    const file = e.target.files?.[0];
    if (!file) return;

    if (file.size > 5 * 1024 * 1024) {
      alert("Ukuran gambar maksimal 5MB");
      return;
    }

    const reader = new FileReader();
    reader.onload = (event) => {
      const result = event.target?.result as string;
      if (isEdit && editingPortfolio) {
        setEditingPortfolio({ ...editingPortfolio, image: result });
      } else {
        setNewPortImage(result);
      }
    };
    reader.readAsDataURL(file);
  };

  // Handle client logo file upload - opens interactive Logo Studio
  const handleBrandLogoUpload = (e: React.ChangeEvent<HTMLInputElement>, isEdit = false) => {
    const file = e.target.files?.[0];
    if (!file) return;

    if (file.size > 5 * 1024 * 1024) {
      alert("Ukuran logo maksimal 5MB");
      return;
    }

    setIsEditModeForBrand(isEdit);
    const reader = new FileReader();
    reader.onload = (event) => {
      const result = event.target?.result as string;
      setRawLogoToCrop(result);
      setCropZoom(1.0);
      setCropOffsetX(0);
      setCropOffsetY(0);
      setAutoRemoveBg(true);
      setBgThreshold(35);
      setCropModalOpen(true);
    };
    reader.readAsDataURL(file);
    e.target.value = "";
  };

  // Handle site main logo upload
  const handleSiteLogoUpload = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0];
    if (!file) return;

    if (file.size > 2 * 1024 * 1024) {
      alert("Ukuran foto logo maksimal 2MB");
      return;
    }

    const reader = new FileReader();
    reader.onload = (event) => {
      const result = event.target?.result as string;
      setTempLogo(result);
      updateSiteLogo(result);
      showToast("Foto Profil / Logo Brand berhasil diperbarui!");
    };
    reader.readAsDataURL(file);
  };

  // Handle profile video file upload (.mp4, .webm, etc.)
  const handleVideoFileUpload = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0];
    if (!file) return;

    if (file.size > 30 * 1024 * 1024) {
      alert(
        "Ukuran file video maksimal 30MB untuk upload langsung via browser. Untuk file berukuran lebih besar, Anda bisa meletakkannya langsung di folder: solveta/public/videos/profile.mp4 atau menggunakan link URL CDN."
      );
      return;
    }

    setIsVideoLoading(true);
    const reader = new FileReader();
    reader.onload = (event) => {
      const result = event.target?.result as string;
      setEditVideoUrl(result);
      updateProfileVideo(result);
      setIsVideoLoading(false);
      showToast("Video profil berhasil diunggah & disimpan ke website!");
    };
    reader.onerror = () => {
      setIsVideoLoading(false);
      alert("Gagal membaca file video. Silakan coba lagi.");
    };
    reader.readAsDataURL(file);
  };

  // Handle custom video URL input
  const handleSaveVideoUrl = (e: React.FormEvent) => {
    e.preventDefault();
    if (!inputVideoLink.trim()) return;
    setEditVideoUrl(inputVideoLink.trim());
    updateProfileVideo(inputVideoLink.trim());
    setInputVideoLink("");
    showToast("Link video profil berhasil diperbarui!");
  };

  // Reset video to default
  const handleResetVideo = () => {
    setEditVideoUrl("/videos/profile.mp4");
    updateProfileVideo("/videos/profile.mp4");
    showToast("Video profil dikembalikan ke default (/videos/profile.mp4)");
  };

  // Portfolio actions
  const handleCreatePortfolio = (e: React.FormEvent) => {
    e.preventDefault();
    if (!newPortTitle.trim()) return;

    const tagsArray = newPortTags
      .split(",")
      .map((t) => t.trim().replace(/^#/, ""))
      .filter((t) => t.length > 0);

    const formattedLiveUrl = newPortLiveUrl.trim()
      ? newPortLiveUrl.trim().startsWith("http")
        ? newPortLiveUrl.trim()
        : `https://${newPortLiveUrl.trim()}`
      : "https://www.solveta.site";

    addPortfolioItem({
      title: newPortTitle,
      category: newPortCategory.trim() || "Website & Presence",
      image:
        newPortImage.trim() ||
        "https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=800&auto=format&fit=crop&q=80",
      description: newPortDesc,
      tags: tagsArray.length > 0 ? tagsArray : ["Custom", "SOLVETA"],
      liveUrl: formattedLiveUrl,
    });

    if (newPortCategory.trim()) {
      addCategory(newPortCategory.trim());
    }

    setNewPortTitle("");
    setNewPortDesc("");
    setNewPortImage("");
    setNewPortTags("");
    setNewPortLiveUrl("");
    setNewPortCategory("");
    if (fileInputRef.current) fileInputRef.current.value = "";
    showToast("Portofolio baru berhasil ditambahkan!");
  };

  const handleUpdatePortfolio = (e: React.FormEvent) => {
    e.preventDefault();
    if (!editingPortfolio) return;

    const tagsArray = editPortTags
      .split(",")
      .map((t) => t.trim().replace(/^#/, ""))
      .filter((t) => t.length > 0);

    const formattedLiveUrl = editPortLiveUrl.trim()
      ? editPortLiveUrl.trim().startsWith("http")
        ? editPortLiveUrl.trim()
        : `https://${editPortLiveUrl.trim()}`
      : editingPortfolio.liveUrl || "https://www.solveta.site";

    editPortfolioItem(editingPortfolio.id, {
      title: editingPortfolio.title,
      category: editingPortfolio.category,
      description: editingPortfolio.description,
      image: editingPortfolio.image,
      tags: tagsArray.length > 0 ? tagsArray : editingPortfolio.tags,
      liveUrl: formattedLiveUrl,
    });

    if (editingPortfolio.category) {
      addCategory(editingPortfolio.category);
    }

    setEditingPortfolio(null);
    showToast("Portofolio & Tagar berhasil diperbarui!");
  };

  const handleDeletePortfolio = (id: string, title: string) => {
    if (confirm(`Hapus portofolio "${title}"?`)) {
      deletePortfolioItem(id);
      showToast("Portofolio berhasil dihapus!");
    }
  };

  // Client Brand actions
  const handleCreateBrand = (e: React.FormEvent) => {
    e.preventDefault();
    if (!newBrandName.trim() && !newBrandLogo.trim()) {
      showToast("Harap upload logo gambar atau masukkan nama brand!");
      return;
    }

    addClientBrand({
      name: newBrandName.trim() || undefined,
      label: newBrandLabel.trim() || undefined,
      logoImage: newBrandLogo.trim() || undefined,
    });

    setNewBrandName("");
    setNewBrandLabel("");
    setNewBrandLogo("");
    if (brandLogoInputRef.current) brandLogoInputRef.current.value = "";
    showToast("Logo / Brand baru berhasil ditambahkan ke Marquee!");
  };

  const handleUpdateBrand = (e: React.FormEvent) => {
    e.preventDefault();
    if (!editingBrand) return;

    editClientBrand(editingBrand.id, {
      name: editingBrand.name,
      label: editingBrand.label,
      logoImage: editingBrand.logoImage,
      scale: editingBrand.scale || 1.0,
    });

    setEditingBrand(null);
    showToast("Data & ukuran brand berhasil diperbarui!");
  };

  const handleDeleteBrand = (id: string, name?: string) => {
    if (confirm(`Hapus brand "${name || "Klien"}"?`)) {
      deleteClientBrand(id);
      showToast("Brand berhasil dihapus dari Marquee!");
    }
  };

  const handleAddNewCategory = (e: React.FormEvent) => {
    e.preventDefault();
    if (!newCategoryInput.trim()) return;
    addCategory(newCategoryInput.trim());
    setNewCategoryInput("");
    showToast("Kategori baru berhasil ditambahkan!");
  };

  const saveVisualChanges = async () => {
    const updatedState: SiteDataState = {
      ...data,
      siteCopy: {
        ...data.siteCopy,
        heroHeadline: editHeadline,
        heroSubtitle: editSubtitle,
        portfolioTitle: editPortfolioTitle,
        consultationTitle: editConsultationTitle,
        consultationDesc: editConsultationDesc,
        marqueeSpeed: editMarqueeSpeed,
        marqueeLogoHeight: editMarqueeLogoHeight,
        marqueeLogoSpacing: editMarqueeLogoSpacing,
        marqueeLogoScale: editMarqueeLogoScale,
        marqueeLogoMaxWidth: editMarqueeLogoMaxWidth,
      },
      pricing: editPricingList,
    };
    saveData(updatedState);
    showToast("Semua perubahan teks, harga & ukuran logo berhasil disimpan!");
  };

  const saveWhatsApp = async () => {
    let cleanNumber = editWaNumber.replace(/[^0-9]/g, "");
    if (cleanNumber.startsWith("0")) {
      cleanNumber = "62" + cleanNumber.substring(1);
    } else if (cleanNumber.startsWith("8")) {
      cleanNumber = "62" + cleanNumber;
    }

    const display = editWaDisplay.trim() || (
      cleanNumber.startsWith("62")
        ? `+62 ${cleanNumber.substring(2, 5)}-${cleanNumber.substring(5, 9)}-${cleanNumber.substring(9)}`
        : editWaNumber
    );

    const updatedState: SiteDataState = {
      ...data,
      contact: {
        ...data.contact,
        whatsappNumber: cleanNumber || "6285719663154",
        whatsappDisplay: display,
      },
    };
    saveData(updatedState);
    showToast("Nomor WhatsApp berhasil diperbarui & disimpan di website!");
  };

  if (!isAuthenticated) {
    return (
      <div className="min-h-screen bg-white flex items-center justify-center p-4">
        <motion.div
          initial={{ opacity: 0, scale: 0.95 }}
          animate={{ opacity: 1, scale: 1 }}
          className="bg-white border border-gray-200 rounded-2xl p-8 max-w-sm w-full shadow-lg text-center"
        >
          <div className="w-12 h-12 rounded-xl bg-rose-50 border border-rose-100 text-[#7B0B1E] flex items-center justify-center mx-auto mb-4">
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
                placeholder="Masukkan username..."
                className="w-full text-xs px-3.5 py-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none bg-white"
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
                placeholder="Masukkan password..."
                className="w-full text-xs px-3.5 py-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none bg-white"
              />
            </div>

            {loginError && (
              <p className="text-[11px] text-red-600 font-medium">
                Username atau password tidak sesuai. Silakan coba lagi.
              </p>
            )}

            <button
              type="submit"
              className="w-full mt-2 py-2.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white font-semibold text-xs rounded-lg transition-all shadow-xs"
            >
              Masuk Portal Developer
            </button>
          </form>

          <div className="mt-6 pt-4 border-t border-gray-100">
            <Link
              href="/"
              className="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-gray-900 transition-colors"
            >
              <ArrowLeft className="w-3.5 h-3.5" />
              <span>Kembali ke Website Utama</span>
            </Link>
          </div>
        </motion.div>
      </div>
    );
  }

  const currentLogoSrc =
    tempLogo ||
    data.siteCopy.siteLogo ||
    "/solveta-logo.jpg";

  return (
    <div className="min-h-screen bg-[#FDFBF9] flex flex-col font-sans">
      {/* Toast Notification */}
      <AnimatePresence>
        {toastMessage && (
          <motion.div
            initial={{ opacity: 0, y: -20 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -20 }}
            className="fixed top-4 right-4 z-50 bg-gray-900 text-white px-4 py-2.5 rounded-xl shadow-lg text-xs font-semibold flex items-center gap-2 border border-gray-700"
          >
            <CheckCircle2 className="w-4 h-4 text-emerald-400" />
            <span>{toastMessage}</span>
          </motion.div>
        )}
      </AnimatePresence>

      {/* Top Navbar */}
      <header className="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-200 px-4 sm:px-6 py-3 shadow-2xs">
        <div className="max-w-[1240px] mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
          <div className="flex items-center gap-3">
            <Link
              href="/"
              className="flex items-center gap-2.5 group"
              title="Kembali ke Beranda"
            >
              <div className="w-8 h-8 rounded-lg overflow-hidden border border-rose-200 bg-white shadow-2xs flex items-center justify-center">
                <img
                  src={currentLogoSrc}
                  alt="SOLVETA Logo"
                  className="w-full h-full object-cover"
                />
              </div>
              <div className="text-left">
                <div className="text-xs font-extrabold tracking-tight text-gray-900 flex items-center gap-1">
                  <span>SOLVETA</span>
                  <span className="font-mono text-[9px] px-1.5 py-0.2 bg-rose-50 text-[#8B0021] border border-rose-200 rounded font-semibold">
                    DEV CMS
                  </span>
                </div>
                <div className="text-[10px] text-gray-400">
                  Visual Live Editor &amp; Pricing Manager
                </div>
              </div>
            </Link>
          </div>

          {/* Mode Switcher Tabs */}
          <div className="flex items-center gap-1 bg-gray-100/80 p-1 rounded-lg border border-gray-200/80">
            <button
              onClick={() => setActiveMode("visual")}
              className={`text-xs font-semibold px-3 py-1.5 rounded-md transition-all ${
                activeMode === "visual"
                  ? "bg-white text-[#7B0B1E] border border-gray-200 shadow-2xs"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              <span className="flex items-center gap-1.5">
                <Edit3 className="w-3.5 h-3.5 text-[#7B0B1E]" />
                <span>Edit Visual</span>
              </span>
            </button>

            <button
              onClick={() => setActiveMode("pricing")}
              className={`text-xs font-semibold px-3 py-1.5 rounded-md transition-all ${
                activeMode === "pricing"
                  ? "bg-white text-[#7B0B1E] border border-gray-200 shadow-2xs"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              <span className="flex items-center gap-1.5">
                <Tag className="w-3.5 h-3.5 text-[#7B0B1E]" />
                <span>Paket &amp; Harga</span>
              </span>
            </button>

            <button
              onClick={() => setActiveMode("portfolio")}
              className={`text-xs font-semibold px-3 py-1.5 rounded-md transition-all ${
                activeMode === "portfolio"
                  ? "bg-white text-[#7B0B1E] border border-gray-200 shadow-2xs"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              <span className="flex items-center gap-1.5">
                <ImageIcon className="w-3.5 h-3.5 text-[#7B0B1E]" />
                <span>Portofolio</span>
              </span>
            </button>

            <button
              onClick={() => setActiveMode("brands")}
              className={`text-xs font-semibold px-3 py-1.5 rounded-md transition-all ${
                activeMode === "brands"
                  ? "bg-white text-[#7B0B1E] border border-gray-200 shadow-2xs"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              <span className="flex items-center gap-1.5">
                <Building2 className="w-3.5 h-3.5 text-[#7B0B1E]" />
                <span>Logo Klien</span>
              </span>
            </button>

            <button
              onClick={() => setActiveMode("contact")}
              className={`text-xs font-semibold px-3 py-1.5 rounded-md transition-all ${
                activeMode === "contact"
                  ? "bg-white text-[#7B0B1E] border border-gray-200 shadow-2xs"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              <span className="flex items-center gap-1.5">
                <Phone className="w-3.5 h-3.5 text-[#7B0B1E]" />
                <span>Kontak WA</span>
              </span>
            </button>

            <button
              onClick={() => setActiveMode("video")}
              className={`text-xs font-semibold px-3 py-1.5 rounded-md transition-all ${
                activeMode === "video"
                  ? "bg-white text-[#7B0B1E] border border-gray-200 shadow-2xs"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              <span className="flex items-center gap-1.5">
                <Film className="w-3.5 h-3.5 text-[#7B0B1E]" />
                <span>Video Profil</span>
              </span>
            </button>
          </div>

          {/* Action Buttons */}
          <div className="flex items-center gap-2">
            <button
              onClick={saveVisualChanges}
              className="inline-flex items-center gap-1.5 px-4 py-1.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white text-xs font-semibold rounded-md shadow-xs transition-all"
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
                if (confirm("Kembalikan semua teks & harga ke setelan awal bawaan?")) {
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
            <div className="p-6 sm:p-12 space-y-12">
              {/* BRAND LOGO CHANGER */}
              <div className="p-5 bg-rose-50/40 rounded-2xl border border-rose-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div className="flex items-center gap-4">
                  <div className="w-16 h-16 rounded-2xl overflow-hidden border border-rose-200 bg-white shadow-xs flex-shrink-0 flex items-center justify-center">
                    <img
                      src={currentLogoSrc}
                      alt="Brand Logo"
                      className="w-full h-full object-cover"
                    />
                  </div>
                  <div>
                    <h3 className="text-xs font-bold text-gray-900">
                      Foto Profil / Logo Brand (Kiri Atas Web &amp; Opening Screen)
                    </h3>
                    <p className="text-[11px] text-gray-500">
                      Ganti logo utama SOLVETA yang tampil di Navbar kiri atas dan saat animasi pembuka website.
                    </p>
                  </div>
                </div>

                <div className="flex items-center gap-2">
                  <button
                    type="button"
                    onClick={() => siteLogoInputRef.current?.click()}
                    className="inline-flex items-center gap-1.5 px-4 py-2 bg-white hover:bg-rose-50 border border-rose-200 hover:border-[#7B0B1E] text-xs font-bold text-[#7B0B1E] rounded-xl shadow-2xs transition-all cursor-pointer"
                  >
                    <Camera className="w-3.5 h-3.5" />
                    <span>Upload Foto / Logo Baru</span>
                  </button>
                  <input
                    ref={siteLogoInputRef}
                    type="file"
                    accept="image/*"
                    onChange={handleSiteLogoUpload}
                    className="hidden"
                  />
                </div>
              </div>

              {/* VIDEO PROFIL LAPTOP 3D MANAGER CARD */}
              <div className="p-5 bg-gradient-to-r from-gray-900 to-[#181926] text-white rounded-2xl border border-gray-800 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                <div className="flex items-center gap-4">
                  <div className="w-16 h-12 rounded-xl overflow-hidden border border-rose-500/30 bg-black shadow-xs flex-shrink-0 flex items-center justify-center relative">
                    <video
                      src={editVideoUrl}
                      muted
                      loop
                      autoPlay
                      playsInline
                      className="w-full h-full object-cover"
                    />
                    <div className="absolute inset-0 bg-black/30 flex items-center justify-center">
                      <Play className="w-4 h-4 text-white/90" />
                    </div>
                  </div>
                  <div>
                    <div className="flex items-center gap-2">
                      <h3 className="text-xs font-bold text-white">
                        Video Profil Web (Layar Laptop 3D Hero)
                      </h3>
                      <span className="text-[9px] bg-rose-500/20 text-rose-300 px-2 py-0.5 rounded-full border border-rose-500/30 font-mono">
                        Autoplay + Audio
                      </span>
                    </div>
                    <p className="text-[11px] text-gray-400 mt-0.5">
                      Upload file MP4/WebM atau link URL CDN untuk diputar di dalam layar laptop 3D.
                    </p>
                  </div>
                </div>

                <div className="flex items-center gap-2">
                  <button
                    type="button"
                    onClick={() => setActiveMode("video")}
                    className="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-xs font-bold text-white rounded-xl shadow-xs transition-all cursor-pointer"
                  >
                    <Film className="w-3.5 h-3.5" />
                    <span>Buka Pengaturan Video</span>
                  </button>
                </div>
              </div>

              {/* 1. Hero Live Section */}
              <div className="text-center relative group p-6 rounded-2xl border border-dashed border-gray-200 hover:border-[#7B0B1E]/40 transition-colors">
                <span className="absolute top-2 right-2 opacity-0 group-hover:opacity-100 text-[10px] font-semibold text-[#7B0B1E] bg-rose-50 px-2 py-0.5 rounded transition-opacity">
                  Klik untuk edit Hero
                </span>

                <div className="inline-block font-mono text-[11px] font-semibold uppercase tracking-wider text-gray-700 bg-white border border-gray-200 px-3.5 py-1 rounded-full mb-4">
                  {data.siteCopy.heroEyebrow}
                </div>

                <div
                  onClick={() => setEditingTarget({ type: "heroHeadline" })}
                  className="cursor-pointer hover:bg-rose-50/50 p-2 rounded-lg transition-colors max-w-3xl mx-auto mb-3"
                >
                  <h1 className="text-2xl sm:text-4xl font-extrabold text-gray-950 tracking-tight leading-tight">
                    {editHeadline}
                  </h1>
                </div>

                <div
                  onClick={() => setEditingTarget({ type: "heroSubtitle" })}
                  className="cursor-pointer hover:bg-rose-50/50 p-2 rounded-lg transition-colors max-w-2xl mx-auto"
                >
                  <p className="text-xs sm:text-sm text-gray-600 leading-relaxed">
                    {editSubtitle}
                  </p>
                </div>
              </div>

              {/* 2. Marquee Live Section */}
              <div className="p-6 bg-gray-50/70 rounded-2xl border border-gray-200">
                <div className="flex flex-col sm:flex-row items-center justify-between gap-4 mb-4">
                  <div>
                    <h3 className="text-xs font-bold text-gray-900 uppercase tracking-wider">
                      Kecepatan Logo Berjalan (Marquee)
                    </h3>
                    <p className="text-[11px] text-gray-500">
                      Geser slider untuk mempercepat atau memperlambat logo klien.
                    </p>
                  </div>
                  <div className="flex items-center gap-3">
                    <span className="text-xs font-mono font-bold text-[#7B0B1E] bg-white border border-gray-200 px-2.5 py-1 rounded-lg">
                      {editMarqueeSpeed} detik / putaran
                    </span>
                    <button
                      onClick={() => setActiveMode("brands")}
                      className="text-xs font-semibold text-[#7B0B1E] hover:underline"
                    >
                      Kelola Logo Klien ({data.clientBrands.length}) &rarr;
                    </button>
                  </div>
                </div>
                <div className="flex items-center gap-3">
                  <span className="text-[11px] text-gray-500 font-medium">Cepat (15s)</span>
                  <input
                    type="range"
                    min={15}
                    max={60}
                    step={5}
                    value={editMarqueeSpeed}
                    onChange={(e) => setEditMarqueeSpeed(Number(e.target.value))}
                    className="flex-grow accent-[#7B0B1E] cursor-pointer"
                  />
                  <span className="text-[11px] text-gray-500 font-medium">Lambat (60s)</span>
                </div>
              </div>

              {/* 3. Portfolio Live Section Header */}
              <div className="text-center relative group p-6 rounded-2xl border border-dashed border-gray-200 hover:border-[#7B0B1E]/40 transition-colors">
                <span className="absolute top-2 right-2 opacity-0 group-hover:opacity-100 text-[10px] font-semibold text-[#7B0B1E] bg-rose-50 px-2 py-0.5 rounded transition-opacity">
                  Klik untuk edit Judul Portofolio
                </span>

                <div
                  onClick={() => setEditingTarget({ type: "portfolioTitle" })}
                  className="cursor-pointer hover:bg-rose-50/50 p-2 rounded-lg transition-colors max-w-xl mx-auto"
                >
                  <h2 className="text-2xl sm:text-3xl font-extrabold text-gray-950 tracking-tight">
                    {editPortfolioTitle}
                  </h2>
                </div>

                <div className="mt-4 flex items-center justify-center gap-2">
                  <button
                    onClick={() => setActiveMode("portfolio")}
                    className="inline-flex items-center gap-1.5 text-xs font-semibold text-[#7B0B1E] bg-white border border-rose-200 hover:bg-rose-50 px-3.5 py-1.5 rounded-full transition-colors"
                  >
                    <Plus className="w-3.5 h-3.5" />
                    <span>Upload, Edit &amp; Kelola Portofolio ({data.portfolio.length} Karya)</span>
                  </button>
                </div>
              </div>

              {/* 4. Pricing Live Section */}
              <div>
                <div className="text-center mb-6">
                  <h2 className="text-base font-bold uppercase tracking-wider text-gray-900 mb-1">
                    PILIH SOLUSI SESUAI KEBUTUHAN
                  </h2>
                  <p className="text-xs text-gray-500">
                    Klik kartu mana saja untuk mengubah harga, perpanjangan, checklist fitur, add-on, atau pesan WA secara instan.
                  </p>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                  {editPricingList.map((tier, idx) => (
                    <div
                      key={tier.id}
                      onClick={() => setEditingTarget({ type: "pricing", tierIndex: idx })}
                      className={`p-5 rounded-xl border bg-white cursor-pointer hover:border-[#7B0B1E] hover:shadow-md transition-all relative group ${
                        tier.popular ? "border-2 border-[#8B0021]" : "border-gray-200"
                      }`}
                    >
                      <div className="absolute top-2 right-2 opacity-0 group-hover:opacity-100 bg-rose-50 text-[#7B0B1E] p-1 rounded transition-opacity">
                        <Edit3 className="w-3.5 h-3.5" />
                      </div>

                      {tier.popular && (
                        <span className="absolute -top-2.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] text-white font-mono text-[9px] font-bold uppercase px-2.5 py-0.5 rounded-full">
                          POPULAR
                        </span>
                      )}

                      <div className="text-xs font-bold text-gray-800 uppercase mb-1">
                        {tier.name}
                      </div>
                      <div className="text-xl font-extrabold text-gray-950 mb-2">
                        {tier.price}
                      </div>

                      <div className="text-[11px] text-gray-600 bg-gray-50 p-2 rounded mb-3 border border-gray-100">
                        <div>⏳ Masa aktif: <strong>{tier.activePeriod || "1 Tahun"}</strong></div>
                        <div>Perpanjangan: <strong>{tier.renewalPrice || "249k/th"}</strong></div>
                      </div>

                      <div className="text-[10px] text-gray-500 border-t pt-2">
                        <strong>Cocok:</strong> {tier.suitability}
                      </div>

                      <div className="mt-3 pt-2 border-t border-gray-100 flex items-center justify-between text-[11px] text-[#8B0021] font-semibold">
                        <span>Edit Rincian &amp; Fitur</span>
                        <span>&rarr;</span>
                      </div>
                    </div>
                  ))}
                </div>
              </div>

              {/* 5. Supabase Cloud Database Status & Sync Card */}
              <div className="bg-white border-2 border-dashed border-gray-200 rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                <div className="space-y-1.5 text-left">
                  <div className="flex items-center gap-2">
                    <span className="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse" />
                    <h3 className="text-xs font-bold text-gray-900 uppercase tracking-wider">
                      Database Cloud Supabase (Online 24/7)
                    </h3>
                  </div>
                  <p className="text-xs text-gray-500 max-w-xl">
                    Data portofolio, logo, teks, dan harga tersimpan di cloud database Supabase sehingga selalu hidup 24 jam nonstop tanpa bergantung pada laptop atau server lokal.
                  </p>
                </div>

                <button
                  type="button"
                  onClick={async () => {
                    const ok = await syncWithSupabase();
                    if (ok) {
                      showToast("Berhasil disinkronkan ke Supabase Cloud 24/7!");
                    } else {
                      showToast("Data tersimpan aman di browser & siap sync ke Supabase!");
                    }
                  }}
                  className="px-5 py-2.5 bg-gray-900 hover:bg-black text-white text-xs font-semibold rounded-xl shadow-xs transition-all flex-shrink-0"
                >
                  Sinkronkan ke Supabase
                </button>
              </div>
            </div>
          </div>
        )}

        {/* MODE: PRICING MANAGER (Dedicated Full Section) */}
        {activeMode === "pricing" && (
          <div className="space-y-6 bg-white">
            <div className="bg-white border border-gray-200 rounded-2xl p-6 sm:p-8 shadow-xs">
              <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-6 border-b border-gray-100">
                <div>
                  <h2 className="text-base sm:text-lg font-bold text-gray-950 flex items-center gap-2">
                    <Tag className="w-4 h-4 text-[#8B0021]" />
                    <span>Kelola 4 Paket Website &amp; Spesifikasi Detail</span>
                  </h2>
                  <p className="text-xs text-gray-500 mt-1">
                    Ubah nominal harga, biaya perpanjangan, estimasi waktu, checklist fitur termasuk/tidak, domain premium, email, dan tarif revisi untuk setiap paket.
                  </p>
                </div>

                <button
                  onClick={saveVisualChanges}
                  className="px-4 py-2 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] text-white text-xs font-bold rounded-xl shadow-xs hover:from-[#9E0026] hover:to-[#5E0013] transition-all flex items-center gap-1.5"
                >
                  <Save className="w-3.5 h-3.5" />
                  <span>Simpan Semua Perubahan</span>
                </button>
              </div>

              {/* Grid of 4 Packages */}
              <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {editPricingList.map((tier, idx) => (
                  <div
                    key={tier.id}
                    className={`border rounded-2xl p-6 bg-white shadow-2xs transition-all flex flex-col justify-between relative ${
                      tier.popular ? "border-2 border-[#8B0021]" : "border-gray-200"
                    }`}
                  >
                    {tier.popular && (
                      <span className="absolute -top-3 left-6 bg-gradient-to-r from-[#8B0021] to-[#50000F] text-white font-mono text-[10px] font-bold uppercase tracking-wider px-3 py-0.5 rounded-full shadow-2xs">
                        POPULAR
                      </span>
                    )}

                    <div>
                      <div className="flex items-center justify-between mb-2">
                        <span className="text-[11px] font-mono font-bold tracking-widest text-[#8B0021] uppercase">
                          PAKET {tier.name}
                        </span>
                        <span className="text-xs font-extrabold text-gray-950">
                          {tier.price}
                        </span>
                      </div>

                      <div className="grid grid-cols-2 gap-2 text-xs bg-gray-50 p-3 rounded-xl border border-gray-100 mb-4">
                        <div>
                          <div className="text-[10px] text-gray-400 uppercase font-semibold">Masa Aktif:</div>
                          <div className="font-semibold text-gray-800">{tier.activePeriod || "1 Tahun"}</div>
                        </div>
                        <div>
                          <div className="text-[10px] text-gray-400 uppercase font-semibold">Perpanjangan:</div>
                          <div className="font-semibold text-[#8B0021]">{tier.renewalPrice || "249k/th"}</div>
                        </div>
                        <div>
                          <div className="text-[10px] text-gray-400 uppercase font-semibold">Pengerjaan:</div>
                          <div className="font-medium text-gray-700">{tier.deliveryTime || "3–5 Hari"}</div>
                        </div>
                        <div>
                          <div className="text-[10px] text-gray-400 uppercase font-semibold">Cocok Untuk:</div>
                          <div className="font-medium text-gray-700 truncate">{tier.suitability}</div>
                        </div>
                      </div>

                      <div className="space-y-1.5 text-xs text-gray-700 mb-4">
                        <div className="font-bold text-[11px] text-gray-500 uppercase tracking-wider mb-1">
                          Pratinjau Checklist Fitur ({(tier.checklist || []).length} Fitur):
                        </div>
                        {(tier.checklist || []).slice(0, 4).map((c, cIdx) => (
                          <div key={cIdx} className="flex items-center gap-2 text-[11px]">
                            {c.included ? (
                              <Check className="w-3.5 h-3.5 text-emerald-600 stroke-[2.5]" />
                            ) : (
                              <X className="w-3.5 h-3.5 text-rose-500 stroke-[2.5]" />
                            )}
                            <span className={c.included ? "text-gray-800" : "text-gray-400 line-through"}>
                              {c.text}
                            </span>
                          </div>
                        ))}
                        {(tier.checklist || []).length > 4 && (
                          <div className="text-[10px] text-gray-400 italic">
                            + {(tier.checklist || []).length - 4} fitur checklist lainnya
                          </div>
                        )}
                      </div>
                    </div>

                    <div className="pt-4 border-t border-gray-100">
                      <button
                        type="button"
                        onClick={() => setEditingTarget({ type: "pricing", tierIndex: idx })}
                        className="w-full py-2.5 bg-gray-900 hover:bg-black text-white text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-1.5 shadow-2xs"
                      >
                        <Edit3 className="w-3.5 h-3.5" />
                        <span>Edit Rincian Lengkap Paket {tier.name}</span>
                      </button>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        )}

        {/* MODE 2: PORTFOLIO MANAGER */}
        {activeMode === "portfolio" && (
          <div className="space-y-6 bg-white">
            {/* Form Add Portfolio */}
            <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
              <h2 className="text-sm font-bold text-gray-900 mb-1 flex items-center gap-2">
                <Upload className="w-4 h-4 text-[#7B0B1E]" />
                <span>Tambah Karya Portofolio Baru</span>
              </h2>
              <p className="text-xs text-gray-500 mb-5">
                Pilih kategori yang sudah ada dengan 1 klik atau tambahkan kategori baru. Gambar langsung dipotong rapi.
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
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none bg-white"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Kategori Terpilih
                    </label>
                    <input
                      type="text"
                      value={newPortCategory}
                      onChange={(e) => setNewPortCategory(e.target.value)}
                      placeholder="Pilih dari tombol di bawah atau ketik"
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none bg-white font-medium text-[#7B0B1E]"
                    />
                  </div>
                </div>

                {/* Clickable Category Chips */}
                <div className="p-3 bg-gray-50/60 rounded-xl border border-gray-100">
                  <div className="text-[11px] font-semibold text-gray-600 mb-2 flex items-center gap-1.5">
                    <Tag className="w-3 h-3 text-[#7B0B1E]" />
                    <span>Klik Kategori untuk Memilih:</span>
                  </div>
                  <div className="flex flex-wrap items-center gap-2">
                    {data.categories.map((cat) => (
                      <button
                        type="button"
                        key={cat}
                        onClick={() => setNewPortCategory(cat)}
                        className={`text-xs px-3 py-1 rounded-full font-medium transition-all flex items-center gap-1 ${
                          newPortCategory === cat
                            ? "bg-gradient-to-r from-[#8B0021] to-[#50000F] text-white shadow-xs"
                            : "bg-white text-gray-700 border border-gray-200 hover:border-[#7B0B1E]"
                        }`}
                      >
                        {newPortCategory === cat && <Check className="w-3 h-3" />}
                        <span>{cat}</span>
                      </button>
                    ))}

                    <button
                      type="button"
                      onClick={() => setNewPortCategory("")}
                      className={`text-xs px-2.5 py-1 rounded-full border border-dashed text-gray-400 hover:text-gray-600 hover:border-gray-400 ${
                        newPortCategory === "" ? "border-[#7B0B1E] text-[#7B0B1E]" : "border-gray-200"
                      }`}
                    >
                      Kosongkan Kategori
                    </button>
                  </div>

                  {/* Inline Add Category */}
                  <div className="mt-3 pt-3 border-t border-gray-200/60 flex items-center gap-2 max-w-sm">
                    <input
                      type="text"
                      value={newCategoryInput}
                      onChange={(e) => setNewCategoryInput(e.target.value)}
                      placeholder="+ Tambah Kategori Baru"
                      className="text-xs p-1.5 px-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none bg-white flex-grow"
                    />
                    <button
                      type="button"
                      onClick={handleAddNewCategory}
                      className="text-xs font-semibold px-3 py-1.5 bg-gray-900 hover:bg-black text-white rounded-lg transition-colors"
                    >
                      Tambah
                    </button>
                  </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  {/* Image Upload Box */}
                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Upload File Gambar Portofolio
                    </label>
                    <div className="flex items-center gap-2">
                      <button
                        type="button"
                        onClick={() => fileInputRef.current?.click()}
                        className="w-full py-2 px-3 border border-dashed border-gray-300 rounded-lg hover:border-[#7B0B1E] bg-gray-50/50 hover:bg-rose-50/30 text-xs font-medium text-gray-600 hover:text-[#7B0B1E] flex items-center justify-center gap-2 transition-all cursor-pointer"
                      >
                        <ImageIcon className="w-4 h-4" />
                        <span>Pilih Gambar dari Laptop</span>
                      </button>
                      <input
                        ref={fileInputRef}
                        type="file"
                        accept="image/*"
                        onChange={(e) => handleImageFileUpload(e, false)}
                        className="hidden"
                      />
                    </div>
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Tags / Kata Kunci (Pisahkan dengan koma)
                    </label>
                    <input
                      type="text"
                      value={newPortTags}
                      onChange={(e) => setNewPortTags(e.target.value)}
                      placeholder="Contoh: Real Estate, Search Filter, Direct WA"
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none bg-white"
                    />
                  </div>
                </div>

                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Link URL Website Asli / Live (Tujuan saat diklik)
                  </label>
                  <input
                    type="text"
                    value={newPortLiveUrl}
                    onChange={(e) => setNewPortLiveUrl(e.target.value)}
                    placeholder="Contoh: https://medikacare.com atau www.nusantaralogistics.co.id"
                    className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none bg-white font-mono"
                  />
                  <p className="text-[10px] text-gray-400 mt-1">
                    Masukkan URL website klien/asli agar pengunjung dapat mengklik dan mengunjungi langsung proyek ini.
                  </p>
                </div>

                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Deskripsi Singkat Karya
                  </label>
                  <textarea
                    rows={2}
                    value={newPortDesc}
                    onChange={(e) => setNewPortDesc(e.target.value)}
                    placeholder="Contoh: Website katalog properti premium dengan integrasi peta dan checkout WhatsApp..."
                    className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none bg-white"
                  />
                </div>

                {newPortImage && (
                  <div className="p-3 bg-gray-50 rounded-xl border border-gray-200 flex items-center gap-3">
                    <img
                      src={newPortImage}
                      alt="Preview"
                      className="w-16 h-12 object-cover rounded-lg border border-gray-300"
                    />
                    <div className="text-[11px] text-emerald-700 font-medium">
                      ✓ Gambar siap diunggah
                    </div>
                  </div>
                )}

                <button
                  type="submit"
                  className="px-5 py-2.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white text-xs font-semibold rounded-lg transition-all shadow-xs"
                >
                  Tambahkan ke Portofolio
                </button>
              </form>
            </div>

            {/* List of Portfolios */}
            <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
              <h2 className="text-sm font-bold text-gray-900 mb-4">
                Daftar Portofolio Aktif ({data.portfolio.length} Karya)
              </h2>

              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {data.portfolio.map((item) => (
                  <div
                    key={item.id}
                    className="border border-gray-200 rounded-xl overflow-hidden bg-white hover:shadow-md transition-shadow group flex flex-col justify-between"
                  >
                    <div>
                      <div className="h-36 bg-gray-100 overflow-hidden relative">
                        <img
                          src={item.image}
                          alt={item.title}
                          className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        />
                        {item.category && (
                          <span className="absolute top-2 left-2 bg-white/90 backdrop-blur-md text-[#7B0B1E] text-[10px] font-bold px-2 py-0.5 rounded shadow-xs">
                            {item.category}
                          </span>
                        )}
                      </div>

                      <div className="p-3.5">
                        <h3 className="text-xs font-bold text-gray-900 mb-1 line-clamp-1">
                          {item.title}
                        </h3>
                        <p className="text-[11px] text-gray-500 line-clamp-2 mb-2">
                          {item.description}
                        </p>
                        <div className="flex flex-wrap gap-1">
                          {item.tags.map((t, idx) => (
                            <span
                              key={idx}
                              className="text-[9px] bg-rose-50 text-[#8B0021] border border-rose-100 font-semibold px-1.5 py-0.5 rounded"
                            >
                              #{t}
                            </span>
                          ))}
                        </div>

                        {item.liveUrl && item.liveUrl !== "#" && (
                          <div className="mt-2.5 pt-2 border-t border-gray-100 flex items-center gap-1 text-[10px] text-gray-500 font-mono">
                            <Globe className="w-3 h-3 text-rose-500 flex-shrink-0" />
                            <a
                              href={item.liveUrl.startsWith("http") ? item.liveUrl : `https://${item.liveUrl}`}
                              target="_blank"
                              rel="noopener noreferrer"
                              className="truncate text-[#8B0021] hover:underline inline-flex items-center gap-1"
                            >
                              <span>{item.liveUrl.replace(/^https?:\/\//, "")}</span>
                              <ExternalLink className="w-2.5 h-2.5 flex-shrink-0" />
                            </a>
                          </div>
                        )}
                      </div>
                    </div>

                    <div className="p-3 bg-gray-50/80 border-t border-gray-100 flex items-center justify-end gap-2">
                      <button
                        onClick={() => {
                          setEditingPortfolio(item);
                          setEditPortTags((item.tags || []).join(", "));
                          setEditPortLiveUrl(item.liveUrl || "");
                        }}
                        className="px-2.5 py-1 text-xs font-medium text-gray-700 hover:text-gray-900 bg-white border border-gray-300 hover:border-gray-400 rounded-md transition-colors"
                      >
                        Edit
                      </button>
                      <button
                        onClick={() => handleDeletePortfolio(item.id, item.title)}
                        className="p-1 text-gray-400 hover:text-red-600 rounded-md transition-colors"
                      >
                        <Trash2 className="w-3.5 h-3.5" />
                      </button>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        )}

        {/* MODE 3: BRANDS / LOGO MANAGER */}
        {activeMode === "brands" && (
          <div className="space-y-6 bg-white">
            {/* 1. MARQUEE DISPLAY & SIZE CUSTOMIZATION SETTINGS */}
            <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs space-y-5">
              <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-gray-100 pb-4">
                <div>
                  <h2 className="text-sm font-bold text-gray-900 flex items-center gap-2">
                    <Sliders className="w-4 h-4 text-[#7B0B1E]" />
                    <span>Kustomisasi Ukuran &amp; Jarak Logo Marquee</span>
                  </h2>
                  <p className="text-xs text-gray-500 mt-0.5">
                    Sesuaikan tinggi logo dan jarak spasi antar-logo agar tampil pas dan proporsional di landing page.
                  </p>
                </div>
                <button
                  type="button"
                  onClick={() => {
                    updateSiteCopy({
                      marqueeLogoHeight: editMarqueeLogoHeight,
                      marqueeLogoSpacing: editMarqueeLogoSpacing,
                      marqueeSpeed: editMarqueeSpeed,
                    });
                    showToast("Pengaturan ukuran & jarak logo berhasil disimpan & aktif di landing page!");
                  }}
                  className="px-4 py-2 bg-[#8B0021] hover:bg-[#a30026] text-white text-xs font-bold rounded-xl shadow-xs transition-colors flex items-center justify-center gap-1.5 cursor-pointer flex-shrink-0"
                >
                  <Check className="w-3.5 h-3.5" />
                  <span>Simpan Ukuran &amp; Jarak</span>
                </button>
              </div>

              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {/* 1. Slider Tinggi Logo */}
                <div className="p-4 bg-gray-50/80 rounded-xl border border-gray-200/80 space-y-2">
                  <div className="flex items-center justify-between">
                    <label className="text-xs font-bold text-gray-800">
                      📏 Tinggi Logo
                    </label>
                    <span className="text-xs font-mono font-bold text-[#8B0021] bg-rose-50 px-2 py-0.5 rounded border border-rose-200">
                      {editMarqueeLogoHeight}px
                    </span>
                  </div>
                  <input
                    type="range"
                    min="24"
                    max="96"
                    step="2"
                    value={editMarqueeLogoHeight}
                    onChange={(e) => {
                      const val = Number(e.target.value);
                      setEditMarqueeLogoHeight(val);
                      updateSiteCopy({ marqueeLogoHeight: val });
                    }}
                    className="w-full accent-[#8B0021] h-1.5 bg-gray-200 rounded-lg cursor-pointer"
                  />
                  <div className="flex justify-between text-[10px] text-gray-400 font-mono">
                    <span>24px (Kecil)</span>
                    <span>46px (Ideal)</span>
                    <span>96px (Tinggi)</span>
                  </div>
                </div>

                {/* 2. Slider Skala / Pembesaran Logo Global */}
                <div className="p-4 bg-gray-50/80 rounded-xl border border-gray-200/80 space-y-2">
                  <div className="flex items-center justify-between">
                    <label className="text-xs font-bold text-gray-800">
                      🔍 Skala Ukuran Logo
                    </label>
                    <span className="text-xs font-mono font-bold text-[#8B0021] bg-rose-50 px-2 py-0.5 rounded border border-rose-200">
                      {editMarqueeLogoScale}%
                    </span>
                  </div>
                  <input
                    type="range"
                    min="50"
                    max="250"
                    step="5"
                    value={editMarqueeLogoScale}
                    onChange={(e) => {
                      const val = Number(e.target.value);
                      setEditMarqueeLogoScale(val);
                      updateSiteCopy({ marqueeLogoScale: val });
                    }}
                    className="w-full accent-[#8B0021] h-1.5 bg-gray-200 rounded-lg cursor-pointer"
                  />
                  <div className="flex justify-between text-[10px] text-gray-400 font-mono">
                    <span>50%</span>
                    <span>100% (Normal)</span>
                    <span>250% (Besar)</span>
                  </div>
                </div>

                {/* 3. Slider Jarak / Spacing Antar Logo */}
                <div className="p-4 bg-gray-50/80 rounded-xl border border-gray-200/80 space-y-2">
                  <div className="flex items-center justify-between">
                    <label className="text-xs font-bold text-gray-800">
                      ↔️ Jarak Spasi Antar Logo
                    </label>
                    <span className="text-xs font-mono font-bold text-[#8B0021] bg-rose-50 px-2 py-0.5 rounded border border-rose-200">
                      {editMarqueeLogoSpacing}px
                    </span>
                  </div>
                  <input
                    type="range"
                    min="12"
                    max="80"
                    step="2"
                    value={editMarqueeLogoSpacing}
                    onChange={(e) => {
                      const val = Number(e.target.value);
                      setEditMarqueeLogoSpacing(val);
                      updateSiteCopy({ marqueeLogoSpacing: val });
                    }}
                    className="w-full accent-[#8B0021] h-1.5 bg-gray-200 rounded-lg cursor-pointer"
                  />
                  <div className="flex justify-between text-[10px] text-gray-400 font-mono">
                    <span>12px (Rapat)</span>
                    <span>36px (Ideal)</span>
                    <span>80px (Renggang)</span>
                  </div>
                </div>

                {/* 4. Slider Kecepatan Marquee */}
                <div className="p-4 bg-gray-50/80 rounded-xl border border-gray-200/80 space-y-2">
                  <div className="flex items-center justify-between">
                    <label className="text-xs font-bold text-gray-800">
                      ⚡ Kecepatan Berjalan
                    </label>
                    <span className="text-xs font-mono font-bold text-[#8B0021] bg-rose-50 px-2 py-0.5 rounded border border-rose-200">
                      {editMarqueeSpeed}s
                    </span>
                  </div>
                  <input
                    type="range"
                    min="15"
                    max="65"
                    step="5"
                    value={editMarqueeSpeed}
                    onChange={(e) => {
                      const val = Number(e.target.value);
                      setEditMarqueeSpeed(val);
                      updateSiteCopy({ marqueeSpeed: val });
                    }}
                    className="w-full accent-[#8B0021] h-1.5 bg-gray-200 rounded-lg cursor-pointer"
                  />
                  <div className="flex justify-between text-[10px] text-gray-400 font-mono">
                    <span>15s (Cepat)</span>
                    <span>35s (Sedang)</span>
                    <span>65s (Pelan)</span>
                  </div>
                </div>
              </div>
            </div>

            {/* 2. ADD NEW LOGO FORM */}
            <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
              <h2 className="text-sm font-bold text-gray-900 mb-1 flex items-center gap-2">
                <Building2 className="w-4 h-4 text-[#7B0B1E]" />
                <span>Tambah Logo / Nama Klien Baru (Marquee)</span>
              </h2>
              <p className="text-xs text-gray-500 mb-5">
                Tambahkan nama brand atau upload logo ikon bisnis untuk tampil di baris marquee yang berjalan.
              </p>

              <form onSubmit={handleCreateBrand} className="space-y-4">
                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Upload File Logo Gambar (Format PNG Transparan / SVG direkomendasikan)
                  </label>
                  <div className="flex items-center gap-2">
                    <button
                      type="button"
                      onClick={() => brandLogoInputRef.current?.click()}
                      className="w-full py-2.5 px-3 border border-dashed border-gray-300 rounded-lg hover:border-[#7B0B1E] bg-gray-50/50 hover:bg-rose-50/30 text-xs font-medium text-gray-600 hover:text-[#7B0B1E] flex items-center justify-center gap-2 transition-all cursor-pointer"
                    >
                      <Upload className="w-4 h-4" />
                      <span>{newBrandLogo ? "✓ Logo Terpilih (Klik untuk ganti)" : "Upload Ikon Logo Brand dari Laptop"}</span>
                    </button>
                    <input
                      ref={brandLogoInputRef}
                      type="file"
                      accept="image/*"
                      onChange={(e) => handleBrandLogoUpload(e, false)}
                      className="hidden"
                    />
                  </div>
                  {newBrandLogo && (
                    <div className="mt-2 p-2 bg-gray-50 rounded-lg border border-gray-200 flex items-center gap-2.5">
                      <img
                        src={newBrandLogo}
                        alt="Preview Logo"
                        className="h-8 w-auto max-w-[120px] object-contain rounded filter grayscale"
                      />
                      <span className="text-[11px] text-emerald-700 font-medium">
                        ✓ Logo siap ditambahkan (mode logos3 murni jika nama dikosongkan)
                      </span>
                    </div>
                  )}
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-xs font-bold text-gray-800 mb-1.5">
                      Nama Brand / Klien <span className="text-gray-400 font-normal">(Opsional)</span>
                    </label>
                    <input
                      type="text"
                      value={newBrandName}
                      onChange={(e) => setNewBrandName(e.target.value)}
                      placeholder="Kosongkan jika hanya ingin menampilkan logo saja"
                      className="w-full text-sm font-bold text-gray-950 placeholder:text-gray-400 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] focus:ring-2 focus:ring-[#7B0B1E]/10 outline-none bg-white shadow-xs"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-gray-800 mb-1.5">
                      Sektor / Label Bisnis <span className="text-gray-400 font-normal">(Opsional)</span>
                    </label>
                    <input
                      type="text"
                      value={newBrandLabel}
                      onChange={(e) => setNewBrandLabel(e.target.value)}
                      placeholder="Contoh: Supply Chain & Tracking"
                      className="w-full text-sm font-bold text-gray-950 placeholder:text-gray-400 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] focus:ring-2 focus:ring-[#7B0B1E]/10 outline-none bg-white shadow-xs"
                    />
                  </div>
                </div>

                <button
                  type="submit"
                  className="px-6 py-3 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white text-xs font-bold rounded-xl transition-all shadow-xs cursor-pointer flex items-center gap-2"
                >
                  <Plus className="w-4 h-4" />
                  <span>Tambahkan ke Marquee</span>
                </button>
              </form>
            </div>

            {/* List Brands */}
            <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs">
              <h2 className="text-sm font-bold text-gray-900 mb-4">
                Daftar Brand di Marquee ({data.clientBrands.length} Klien)
              </h2>

              <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                {data.clientBrands.map((brand) => (
                  <div
                    key={brand.id}
                    className="p-3 border border-gray-200 rounded-xl bg-white hover:border-gray-300 flex items-center justify-between gap-2"
                  >
                    <div className="flex items-center gap-2.5 min-w-0">
                      {brand.logoImage ? (
                        <img
                          src={brand.logoImage}
                          alt={brand.name || "Brand"}
                          className="h-7 w-auto max-w-[80px] object-contain rounded filter grayscale flex-shrink-0"
                        />
                      ) : (
                        <div className="w-7 h-7 rounded bg-rose-50 text-[#7B0B1E] font-bold text-xs flex items-center justify-center flex-shrink-0">
                          {brand.name?.charAt(0) || "B"}
                        </div>
                      )}
                      <div className="min-w-0">
                        <div className="text-xs font-bold text-gray-900 truncate">
                          {brand.name || "Logo Murni"}
                        </div>
                        {brand.label && (
                          <div className="text-[10px] text-gray-400 truncate">
                            {brand.label}
                          </div>
                        )}
                      </div>
                    </div>

                    <div className="flex items-center gap-1 flex-shrink-0">
                      <button
                        type="button"
                        onClick={() => setEditingBrand(brand)}
                        className="p-1.5 text-gray-500 hover:text-[#8B0021] hover:bg-rose-50 rounded-lg transition-colors cursor-pointer"
                        title="Edit Logo & Data Brand"
                      >
                        <Edit3 className="w-3.5 h-3.5" />
                      </button>
                      <button
                        type="button"
                        onClick={() => handleDeleteBrand(brand.id, brand.name || "Logo")}
                        className="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer"
                        title="Hapus"
                      >
                        <Trash2 className="w-3.5 h-3.5" />
                      </button>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        )}

        {/* MODE 4: WHATSAPP & CONTACT */}
        {activeMode === "contact" && (
          <div className="max-w-xl mx-auto bg-white border border-gray-200 rounded-2xl p-6 sm:p-8 shadow-xs">
            <h2 className="text-sm font-bold text-gray-900 mb-1 flex items-center gap-2">
              <Phone className="w-4 h-4 text-[#7B0B1E]" />
              <span>Pengaturan Kontak WhatsApp Resmi</span>
            </h2>
            <p className="text-xs text-gray-500 mb-6">
              Nomor ini akan otomatis digunakan di seluruh tombol &quot;Konsultasi&quot; dan &quot;Pesan Paket&quot; di website.
            </p>

            <div className="space-y-4">
              <div>
                <label className="block text-xs font-bold text-gray-800 mb-1.5">
                  Nomor WhatsApp (Format Internasional Tanpa +)
                </label>
                <input
                  type="text"
                  value={editWaNumber}
                  onChange={(e) => setEditWaNumber(e.target.value)}
                  placeholder="Contoh: 6285719663154"
                  className="w-full text-sm font-bold text-gray-950 placeholder:text-gray-400 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] focus:ring-2 focus:ring-[#7B0B1E]/10 outline-none font-mono bg-white shadow-xs"
                />
                <p className="text-[11px] text-gray-500 mt-1">
                  Gunakan kode negara 62 di depan (misal: 6285719663154).
                </p>
              </div>

              <div>
                <label className="block text-xs font-bold text-gray-800 mb-1.5">
                  Teks Tampilan WhatsApp di Footer / Kontak
                </label>
                <input
                  type="text"
                  value={editWaDisplay}
                  onChange={(e) => setEditWaDisplay(e.target.value)}
                  placeholder="Contoh: +62 857-1966-3154"
                  className="w-full text-sm font-bold text-gray-950 placeholder:text-gray-400 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] focus:ring-2 focus:ring-[#7B0B1E]/10 outline-none bg-white shadow-xs"
                />
              </div>

              <button
                type="button"
                onClick={saveWhatsApp}
                className="w-full py-3 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white font-bold text-xs rounded-xl transition-all shadow-sm cursor-pointer flex items-center justify-center gap-2"
              >
                <Save className="w-4 h-4" />
                <span>Simpan Nomor WhatsApp</span>
              </button>
            </div>
          </div>
        )}

        {/* MODE 5: VIDEO PROFIL (3D LAPTOP SCREEN) */}
        {activeMode === "video" && (
          <div className="max-w-4xl mx-auto space-y-6">
            {/* Header Card */}
            <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
              <div className="flex items-center gap-3.5">
                <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-[#8B0021] to-[#50000F] text-white flex items-center justify-center shadow-sm flex-shrink-0">
                  <Film className="w-6 h-6" />
                </div>
                <div>
                  <h2 className="text-base font-bold text-gray-900">
                    Kelola Video Profil (Layar Laptop 3D)
                  </h2>
                  <p className="text-xs text-gray-500 mt-0.5">
                    Upload file video atau masukkan link URL untuk diputar otomatis di layar laptop 3D Hero Section.
                  </p>
                </div>
              </div>

              <div className="flex items-center gap-2">
                <button
                  type="button"
                  onClick={handleResetVideo}
                  className="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-colors cursor-pointer"
                  title="Kembalikan ke file default /videos/profile.mp4"
                >
                  <RefreshCw className="w-3.5 h-3.5" />
                  <span>Reset ke Default</span>
                </button>
              </div>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
              {/* Left Column: Upload Methods */}
              <div className="lg:col-span-7 space-y-6">
                {/* Method 1: Upload File Video */}
                <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs space-y-4">
                  <div className="flex items-center justify-between pb-3 border-b border-gray-100">
                    <div className="flex items-center gap-2">
                      <UploadCloud className="w-4 h-4 text-[#8B0021]" />
                      <h3 className="text-xs font-bold uppercase tracking-wider text-gray-900">
                        Metode 1: Upload File Video Langsung
                      </h3>
                    </div>
                    <span className="text-[10px] font-semibold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-100">
                      MP4 / WebM (Maks 30MB)
                    </span>
                  </div>

                  <p className="text-xs text-gray-600 leading-relaxed">
                    Pilih file video dari komputer/laptop Anda. File akan otomatis tersimpan dan aktif di website.
                  </p>

                  <div
                    onClick={() => videoFileInputRef.current?.click()}
                    className="border-2 border-dashed border-gray-300 hover:border-[#8B0021] bg-gray-50/50 hover:bg-rose-50/30 rounded-xl p-6 text-center cursor-pointer transition-all flex flex-col items-center justify-center space-y-2 group"
                  >
                    <div className="w-10 h-10 rounded-full bg-white border border-gray-200 group-hover:border-rose-300 text-gray-400 group-hover:text-[#8B0021] flex items-center justify-center transition-colors shadow-2xs">
                      {isVideoLoading ? (
                        <RefreshCw className="w-5 h-5 animate-spin text-[#8B0021]" />
                      ) : (
                        <Upload className="w-5 h-5" />
                      )}
                    </div>

                    <div className="text-xs font-bold text-gray-800 group-hover:text-[#8B0021]">
                      {isVideoLoading
                        ? "Sedang memproses video..."
                        : "Klik untuk Pilih Video dari Laptop / HP"}
                    </div>
                    <div className="text-[10px] text-gray-400">
                      Mendukung format .mp4, .webm, .mov (Ukuran ideal: 2MB – 15MB)
                    </div>
                  </div>

                  <input
                    ref={videoFileInputRef}
                    type="file"
                    accept="video/mp4,video/webm,video/ogg,video/quicktime"
                    onChange={handleVideoFileUpload}
                    className="hidden"
                  />
                </div>

                {/* Method 2: Insert Video URL */}
                <div className="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs space-y-4">
                  <div className="flex items-center justify-between pb-3 border-b border-gray-100">
                    <div className="flex items-center gap-2">
                      <Globe className="w-4 h-4 text-[#8B0021]" />
                      <h3 className="text-xs font-bold uppercase tracking-wider text-gray-900">
                        Metode 2: Gunakan Link URL Video (CDN / Cloud)
                      </h3>
                    </div>
                  </div>

                  <p className="text-xs text-gray-600 leading-relaxed">
                    Jika video disimpan di CDN (Cloudinary, Supabase Storage, AWS S3, atau link hosting langsung):
                  </p>

                  <form onSubmit={handleSaveVideoUrl} className="space-y-3">
                    <div>
                      <label className="block text-[11px] font-semibold text-gray-700 mb-1">
                        URL Link File Video (.mp4 / .webm)
                      </label>
                      <input
                        type="text"
                        value={inputVideoLink}
                        onChange={(e) => setInputVideoLink(e.target.value)}
                        placeholder="https://domain.com/videos/profil-solveta.mp4"
                        className="w-full text-xs p-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none bg-white font-mono"
                      />
                    </div>

                    <div className="flex items-center justify-between gap-2">
                      <button
                        type="submit"
                        disabled={!inputVideoLink.trim()}
                        className="px-4 py-2 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] disabled:opacity-50 text-white text-xs font-bold rounded-lg shadow-xs transition-all cursor-pointer"
                      >
                        Terapkan Link Video
                      </button>

                      <button
                        type="button"
                        onClick={() => {
                          setInputVideoLink("/videos/profile.mp4");
                        }}
                        className="text-[11px] text-[#8B0021] hover:underline font-medium cursor-pointer"
                      >
                        Pakai /videos/profile.mp4
                      </button>
                    </div>
                  </form>
                </div>

                {/* Developer Instructions Card */}
                <div className="bg-amber-50/60 border border-amber-200/80 rounded-2xl p-5 space-y-2 text-left">
                  <div className="flex items-center gap-2 text-xs font-bold text-amber-900">
                    <Sparkles className="w-4 h-4 text-amber-600" />
                    <span>Panduan Penempatan File Manual di Coding</span>
                  </div>
                  <p className="text-[11px] text-amber-800/90 leading-relaxed">
                    Anda juga bisa langsung meng-copy file video ke folder proyek berikut:
                  </p>
                  <div className="p-2 bg-white/90 rounded-lg border border-amber-200 text-[10px] font-mono text-gray-800 break-all select-all">
                    solveta/public/videos/profile.mp4
                  </div>
                  <p className="text-[10px] text-amber-700/80">
                    * Browser akan otomatis memutar video tersebut saat dibuka (muted) dan pengunjung bisa klik tombol <b>&quot;Nyalakan Suara&quot;</b> kapan saja.
                  </p>
                </div>
              </div>

              {/* Right Column: Live Interactive Preview Player */}
              <div className="lg:col-span-5 space-y-4">
                <div className="bg-white border border-gray-200 rounded-2xl p-5 shadow-xs sticky top-20 space-y-4">
                  <div className="flex items-center justify-between pb-3 border-b border-gray-100">
                    <div className="flex items-center gap-2">
                      <Video className="w-4 h-4 text-[#8B0021]" />
                      <h3 className="text-xs font-bold uppercase tracking-wider text-gray-900">
                        Live Preview Player
                      </h3>
                    </div>
                    <span className="text-[10px] font-mono font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200 flex items-center gap-1">
                      <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse" />
                      <span>Aktif di Web</span>
                    </span>
                  </div>

                  {/* Video Player Display Container */}
                  <div className="aspect-[16/10] bg-[#0c0d12] rounded-xl overflow-hidden border border-gray-800 shadow-md relative group flex items-center justify-center">
                    <video
                      key={editVideoUrl}
                      src={editVideoUrl}
                      controls
                      autoPlay
                      muted
                      loop
                      playsInline
                      className="w-full h-full object-cover"
                    />
                  </div>

                  {/* Video Info Metadata */}
                  <div className="p-3 bg-gray-50 rounded-xl border border-gray-200 space-y-1.5 text-left">
                    <div className="text-[11px] font-bold text-gray-800 flex items-center justify-between">
                      <span>Sumber Video Saat Ini:</span>
                      <span className="text-[10px] font-mono text-gray-500">
                        {editVideoUrl.startsWith("data:")
                          ? "File Upload (Base64)"
                          : editVideoUrl.startsWith("http")
                          ? "Link External (CDN)"
                          : "File Lokal"}
                      </span>
                    </div>
                    <div className="text-[10px] text-gray-500 font-mono break-all truncate">
                      {editVideoUrl.startsWith("data:")
                        ? `${editVideoUrl.substring(0, 45)}... (Tersimpan di Data Web)`
                        : editVideoUrl}
                    </div>
                  </div>

                  <div className="pt-2 border-t border-gray-100 flex items-center justify-between">
                    <Link
                      href="/"
                      target="_blank"
                      className="inline-flex items-center gap-1.5 text-xs font-bold text-[#8B0021] hover:underline"
                    >
                      <Eye className="w-3.5 h-3.5" />
                      <span>Lihat Tampilan di Beranda Utama</span>
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        )}
      </div>

      {/* MODAL: EDIT VISUAL & PRICING TARGET */}
      <AnimatePresence>
        {editingTarget && (
          <div className="fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.95 }}
              animate={{ opacity: 1, scale: 1 }}
              exit={{ opacity: 0, scale: 0.95 }}
              className="bg-white border border-gray-200 rounded-2xl p-6 max-w-2xl w-full shadow-2xl relative max-h-[90vh] flex flex-col"
            >
              <div className="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
                <div className="text-xs font-extrabold uppercase tracking-wider text-gray-900 flex items-center gap-1.5">
                  <Edit3 className="w-3.5 h-3.5 text-[#7B0B1E]" />
                  <span>
                    {editingTarget.type === "pricing"
                      ? `Edit Detail Paket: ${editPricingList[editingTarget.tierIndex!]?.name}`
                      : "Edit Konten Langsung"}
                  </span>
                </div>
                <button
                  onClick={() => setEditingTarget(null)}
                  className="p-1 text-gray-400 hover:text-gray-700 rounded-md"
                >
                  <X className="w-4 h-4" />
                </button>
              </div>

              {/* Modal Body for Text fields */}
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

              {/* Modal Body for Full Pricing Tier Management */}
              {editingTarget.type === "pricing" && editingTarget.tierIndex !== undefined && (() => {
                const currentTier = editPricingList[editingTarget.tierIndex];
                if (!currentTier) return null;

                const updateCurrentTier = (updater: (prev: PricingTierData) => PricingTierData) => {
                  const list = [...editPricingList];
                  list[editingTarget.tierIndex!] = updater({ ...list[editingTarget.tierIndex!] });
                  setEditPricingList(list);
                };

                return (
                  <div className="space-y-4 max-h-[65vh] overflow-y-auto pr-1">
                    {/* 1. Informasi Dasar & Harga */}
                    <div className="border border-gray-200 rounded-xl p-4 bg-gray-50/50 space-y-3">
                      <h4 className="text-xs font-bold text-gray-900 uppercase tracking-wider flex items-center gap-1.5">
                        <Tag className="w-3.5 h-3.5 text-[#8B0021]" />
                        <span>Informasi Paket &amp; Harga</span>
                      </h4>

                      <div className="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                          <label className="block text-[11px] font-semibold text-gray-700 mb-1">Nama Paket</label>
                          <input
                            type="text"
                            value={currentTier.name}
                            onChange={(e) => updateCurrentTier((t) => ({ ...t, name: e.target.value }))}
                            className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white font-bold"
                          />
                        </div>

                        <div>
                          <label className="block text-[11px] font-semibold text-gray-700 mb-1">Harga Display (Badge)</label>
                          <input
                            type="text"
                            value={currentTier.priceBadge || currentTier.price.replace(/Rp\s*/i, "").trim()}
                            onChange={(e) =>
                              updateCurrentTier((t) => ({
                                ...t,
                                priceBadge: e.target.value,
                                price: `Rp ${e.target.value}`,
                              }))
                            }
                            placeholder="Contoh: 299K"
                            className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white font-extrabold text-[#8B0021]"
                          />
                        </div>

                        <div>
                          <label className="block text-[11px] font-semibold text-gray-700 mb-1">Prefix Harga (Opsional)</label>
                          <input
                            type="text"
                            value={currentTier.pricePrefix || ""}
                            onChange={(e) => updateCurrentTier((t) => ({ ...t, pricePrefix: e.target.value }))}
                            placeholder="Contoh: mulai dari :"
                            className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white"
                          />
                        </div>
                      </div>

                      <div className="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                        <div>
                          <label className="block text-[11px] font-semibold text-gray-700 mb-1">Masa Aktif</label>
                          <input
                            type="text"
                            value={currentTier.activePeriod || "1 Tahun"}
                            onChange={(e) => updateCurrentTier((t) => ({ ...t, activePeriod: e.target.value }))}
                            placeholder="1 Tahun"
                            className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white"
                          />
                        </div>

                        <div>
                          <label className="block text-[11px] font-semibold text-gray-700 mb-1">Biaya Perpanjangan</label>
                          <input
                            type="text"
                            value={currentTier.renewalPrice || "249k/tahun*"}
                            onChange={(e) => updateCurrentTier((t) => ({ ...t, renewalPrice: e.target.value }))}
                            placeholder="249k/tahun*"
                            className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white font-semibold text-gray-900"
                          />
                        </div>
                      </div>

                      <div className="flex items-center gap-2 pt-1">
                        <input
                          type="checkbox"
                          id={`pop-${editingTarget.tierIndex}`}
                          checked={!!currentTier.popular}
                          onChange={(e) => updateCurrentTier((t) => ({ ...t, popular: e.target.checked }))}
                          className="w-4 h-4 text-[#8B0021] rounded border-gray-300"
                        />
                        <label htmlFor={`pop-${editingTarget.tierIndex}`} className="text-xs font-semibold text-gray-800 cursor-pointer">
                          Tandai sebagai Paket &quot;Popular (Paling Diminati)&quot;
                        </label>
                      </div>
                    </div>

                    {/* 2. Kesesuaian Kebutuhan & Tombol WhatsApp */}
                    <div className="border border-gray-200 rounded-xl p-4 bg-gray-50/50 space-y-3">
                      <h4 className="text-xs font-bold text-gray-900 uppercase tracking-wider flex items-center gap-1.5">
                        <Clock className="w-3.5 h-3.5 text-[#8B0021]" />
                        <span>Kebutuhan, Pengerjaan &amp; Tombol</span>
                      </h4>

                      <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                          <label className="block text-[11px] font-semibold text-gray-700 mb-1">Cocok Untuk</label>
                          <input
                            type="text"
                            value={currentTier.suitability}
                            onChange={(e) => updateCurrentTier((t) => ({ ...t, suitability: e.target.value }))}
                            className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white"
                          />
                        </div>

                        <div>
                          <label className="block text-[11px] font-semibold text-gray-700 mb-1">Estimasi Waktu Pengerjaan</label>
                          <input
                            type="text"
                            value={currentTier.deliveryTime || "1–2 Hari"}
                            onChange={(e) => updateCurrentTier((t) => ({ ...t, deliveryTime: e.target.value }))}
                            className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white font-medium"
                          />
                        </div>
                      </div>

                      <div>
                        <label className="block text-[11px] font-semibold text-gray-700 mb-1">Label Tombol Pesan</label>
                        <input
                          type="text"
                          value={currentTier.buttonLabel}
                          onChange={(e) => updateCurrentTier((t) => ({ ...t, buttonLabel: e.target.value }))}
                          className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white"
                        />
                      </div>

                      <div>
                        <label className="block text-[11px] font-semibold text-gray-700 mb-1">Template Pesan WhatsApp Otomatis</label>
                        <textarea
                          rows={2}
                          value={currentTier.waMessage}
                          onChange={(e) => updateCurrentTier((t) => ({ ...t, waMessage: e.target.value }))}
                          className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white font-mono"
                        />
                      </div>
                    </div>

                    {/* 3. Daftar Checklist Fitur Interaktif */}
                    <div className="border border-gray-200 rounded-xl p-4 bg-gray-50/50 space-y-3">
                      <div className="flex items-center justify-between">
                        <h4 className="text-xs font-bold text-gray-900 uppercase tracking-wider flex items-center gap-1.5">
                          <CheckCircle2 className="w-3.5 h-3.5 text-emerald-600" />
                          <span>Checklist Fitur ({(currentTier.checklist || []).length} Poin)</span>
                        </h4>
                        <button
                          type="button"
                          onClick={() => {
                            updateCurrentTier((t) => {
                              const curCheck = t.checklist || [];
                              return {
                                ...t,
                                checklist: [...curCheck, { text: "Fitur baru...", included: true }],
                              };
                            });
                          }}
                          className="inline-flex items-center gap-1 text-[11px] font-bold text-[#8B0021] bg-rose-50 hover:bg-rose-100 border border-rose-200 px-2.5 py-1 rounded-md transition-colors"
                        >
                          <Plus className="w-3 h-3" />
                          <span>Tambah Fitur</span>
                        </button>
                      </div>

                      <div className="space-y-2 max-h-56 overflow-y-auto pr-1">
                        {(currentTier.checklist || []).map((item, cIdx) => (
                          <div
                            key={cIdx}
                            className="flex items-center gap-2 p-2 rounded-lg bg-white border border-gray-200 shadow-2xs"
                          >
                            <button
                              type="button"
                              onClick={() => {
                                updateCurrentTier((t) => {
                                  const nextCheck = [...(t.checklist || [])];
                                  nextCheck[cIdx] = { ...nextCheck[cIdx], included: !nextCheck[cIdx].included };
                                  return { ...t, checklist: nextCheck };
                                });
                              }}
                              className={`px-2 py-1 rounded text-[10px] font-bold flex items-center gap-1 transition-colors ${
                                item.included
                                  ? "bg-emerald-100 text-emerald-800 border border-emerald-300"
                                  : "bg-rose-100 text-rose-800 border border-rose-300"
                              }`}
                              title="Klik untuk ubah status Termasuk / Tidak Termasuk"
                            >
                              {item.included ? <Check className="w-3 h-3" /> : <X className="w-3 h-3" />}
                              <span>{item.included ? "Termasuk" : "Tidak"}</span>
                            </button>

                            <input
                              type="text"
                              value={item.text}
                              onChange={(e) => {
                                updateCurrentTier((t) => {
                                  const nextCheck = [...(t.checklist || [])];
                                  nextCheck[cIdx] = { ...nextCheck[cIdx], text: e.target.value };
                                  return { ...t, checklist: nextCheck };
                                });
                              }}
                              className="flex-1 text-xs p-1.5 rounded border border-gray-200 bg-white"
                            />

                            <button
                              type="button"
                              onClick={() => {
                                updateCurrentTier((t) => ({
                                  ...t,
                                  checklist: (t.checklist || []).filter((_, i) => i !== cIdx),
                                }));
                              }}
                              className="p-1 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded"
                            >
                              <Trash2 className="w-3.5 h-3.5" />
                            </button>
                          </div>
                        ))}
                      </div>
                    </div>

                    {/* 4. Domain Add-ons */}
                    <div className="border border-gray-200 rounded-xl p-4 bg-gray-50/50 space-y-3">
                      <div className="flex items-center justify-between">
                        <h4 className="text-xs font-bold text-gray-900 uppercase tracking-wider flex items-center gap-1.5">
                          <Globe className="w-3.5 h-3.5 text-[#8B0021]" />
                          <span>Domain Premium Add-ons</span>
                        </h4>
                        <button
                          type="button"
                          onClick={() => {
                            updateCurrentTier((t) => ({
                              ...t,
                              domainAddons: [
                                ...(t.domainAddons || []),
                                { name: ".domain", price: "+Rp100.000" },
                              ],
                            }));
                          }}
                          className="inline-flex items-center gap-1 text-[11px] font-bold text-[#8B0021] bg-rose-50 hover:bg-rose-100 border border-rose-200 px-2 py-0.5 rounded-md"
                        >
                          <Plus className="w-3 h-3" />
                          <span>Tambah</span>
                        </button>
                      </div>

                      <div className="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        {(currentTier.domainAddons || []).map((dom, dIdx) => (
                          <div
                            key={dIdx}
                            className="flex items-center gap-1.5 p-1.5 rounded bg-white border border-gray-200 text-xs"
                          >
                            <input
                              type="text"
                              value={dom.name}
                              onChange={(e) => {
                                updateCurrentTier((t) => {
                                  const list = [...(t.domainAddons || [])];
                                  list[dIdx] = { ...list[dIdx], name: e.target.value };
                                  return { ...t, domainAddons: list };
                                });
                              }}
                              className="w-1/2 p-1 border rounded font-mono text-[11px]"
                            />
                            <input
                              type="text"
                              value={dom.price}
                              onChange={(e) => {
                                updateCurrentTier((t) => {
                                  const list = [...(t.domainAddons || [])];
                                  list[dIdx] = { ...list[dIdx], price: e.target.value };
                                  return { ...t, domainAddons: list };
                                });
                              }}
                              className="w-1/2 p-1 border rounded text-[11px] font-semibold"
                            />
                            <button
                              type="button"
                              onClick={() => {
                                updateCurrentTier((t) => ({
                                  ...t,
                                  domainAddons: (t.domainAddons || []).filter((_, i) => i !== dIdx),
                                }));
                              }}
                              className="text-gray-400 hover:text-rose-600"
                            >
                              <Trash2 className="w-3.5 h-3.5" />
                            </button>
                          </div>
                        ))}
                      </div>
                    </div>

                    {/* 5. Tarif Revisi & Ketentuan */}
                    <div className="border border-gray-200 rounded-xl p-4 bg-gray-50/50 space-y-3">
                      <h4 className="text-xs font-bold text-gray-900 uppercase tracking-wider flex items-center gap-1.5">
                        <ShieldCheck className="w-3.5 h-3.5 text-[#8B0021]" />
                        <span>Tarif &amp; Ketentuan Revisi</span>
                      </h4>

                      <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                          <label className="block text-[11px] font-semibold text-gray-700 mb-1">Revisi Ringan</label>
                          <input
                            type="text"
                            value={currentTier.revisionRules?.light || ""}
                            onChange={(e) => {
                              updateCurrentTier((t) => ({
                                ...t,
                                revisionRules: {
                                  ...(t.revisionRules || { light: "", heavy: "" }),
                                  light: e.target.value,
                                },
                              }));
                            }}
                            className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white"
                          />
                        </div>

                        <div>
                          <label className="block text-[11px] font-semibold text-gray-700 mb-1">Revisi Berat</label>
                          <input
                            type="text"
                            value={currentTier.revisionRules?.heavy || ""}
                            onChange={(e) => {
                              updateCurrentTier((t) => ({
                                ...t,
                                revisionRules: {
                                  ...(t.revisionRules || { light: "", heavy: "" }),
                                  heavy: e.target.value,
                                },
                              }));
                            }}
                            className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white"
                          />
                        </div>
                      </div>

                      <div>
                        <label className="block text-[11px] font-semibold text-gray-700 mb-1">Penambahan Halaman</label>
                        <input
                          type="text"
                          value={currentTier.revisionRules?.extraPage || ""}
                          onChange={(e) => {
                            updateCurrentTier((t) => ({
                              ...t,
                              revisionRules: {
                                ...(t.revisionRules || { light: "", heavy: "" }),
                                extraPage: e.target.value,
                              },
                            }));
                          }}
                          placeholder="Contoh: Rp 50.000 / halaman"
                          className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white"
                        />
                      </div>

                      <div>
                        <label className="block text-[11px] font-semibold text-gray-700 mb-1">Catatan Kustom (Opsional)</label>
                        <input
                          type="text"
                          value={currentTier.customNote || ""}
                          onChange={(e) => updateCurrentTier((t) => ({ ...t, customNote: e.target.value }))}
                          placeholder="Contoh: Wajib Meet Online / Offline..."
                          className="w-full text-xs p-2 rounded-lg border border-gray-300 bg-white"
                        />
                      </div>
                    </div>
                  </div>
                );
              })()}

              <div className="mt-4 pt-3 border-t border-gray-100 flex items-center gap-2">
                <button
                  type="button"
                  onClick={() => {
                    saveVisualChanges();
                    setEditingTarget(null);
                  }}
                  className="w-full py-2.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white font-semibold text-xs rounded-lg transition-all shadow-xs flex items-center justify-center gap-1.5"
                >
                  <Save className="w-3.5 h-3.5" />
                  <span>Terapkan &amp; Simpan Perubahan</span>
                </button>
              </div>
            </motion.div>
          </div>
        )}
      </AnimatePresence>

      {/* MODAL: EDIT PORTFOLIO */}
      <AnimatePresence>
        {editingPortfolio && (
          <div className="fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.95 }}
              animate={{ opacity: 1, scale: 1 }}
              exit={{ opacity: 0, scale: 0.95 }}
              className="bg-white border border-gray-200 rounded-2xl p-6 max-w-lg w-full shadow-2xl relative"
            >
              <div className="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
                <h3 className="text-xs font-extrabold uppercase tracking-wider text-gray-900">
                  Edit Portofolio: {editingPortfolio.title}
                </h3>
                <button
                  onClick={() => setEditingPortfolio(null)}
                  className="p-1 text-gray-400 hover:text-gray-700 rounded-md"
                >
                  <X className="w-4 h-4" />
                </button>
              </div>

              <form onSubmit={handleUpdatePortfolio} className="space-y-4">
                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Nama / Judul Portofolio
                  </label>
                  <input
                    type="text"
                    required
                    value={editingPortfolio.title}
                    onChange={(e) =>
                      setEditingPortfolio({
                        ...editingPortfolio,
                        title: e.target.value,
                      })
                    }
                    className="w-full text-xs p-2.5 rounded-lg border border-gray-300 bg-white"
                  />
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Kategori
                    </label>
                    <input
                      type="text"
                      value={editingPortfolio.category || ""}
                      onChange={(e) =>
                        setEditingPortfolio({
                          ...editingPortfolio,
                          category: e.target.value,
                        })
                      }
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 bg-white"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-semibold text-gray-700 mb-1">
                      Tags / Tagar (Pisahkan dengan koma)
                    </label>
                    <input
                      type="text"
                      value={editPortTags}
                      onChange={(e) => setEditPortTags(e.target.value)}
                      placeholder="Contoh: Real Estate, Search Filter, Direct WA"
                      className="w-full text-xs p-2.5 rounded-lg border border-gray-300 bg-white"
                    />
                  </div>
                </div>

                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Link URL Website Asli / Live (Tujuan saat diklik)
                  </label>
                  <input
                    type="text"
                    value={editPortLiveUrl}
                    onChange={(e) => setEditPortLiveUrl(e.target.value)}
                    placeholder="Contoh: https://klienanda.com atau https://tokokopi.id"
                    className="w-full text-xs p-2.5 rounded-lg border border-gray-300 bg-white font-mono"
                  />
                  <p className="text-[10px] text-gray-400 mt-1">
                    Ketika pengunjung mengklik portofolio ini, mereka akan langsung diarahkan ke website asli ini.
                  </p>
                </div>

                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Ganti File Gambar (Opsional)
                  </label>
                  <div className="flex items-center gap-2">
                    <button
                      type="button"
                      onClick={() => editFileInputRef.current?.click()}
                      className="w-full py-2 px-3 border border-dashed border-gray-300 rounded-lg hover:border-[#7B0B1E] bg-gray-50/50 hover:bg-rose-50/30 text-xs font-medium text-gray-600 hover:text-[#7B0B1E] flex items-center justify-center gap-2 transition-all cursor-pointer"
                    >
                      <ImageIcon className="w-4 h-4" />
                      <span>Pilih Gambar Pengganti dari Laptop</span>
                    </button>
                    <input
                      ref={editFileInputRef}
                      type="file"
                      accept="image/*"
                      onChange={(e) => handleImageFileUpload(e, true)}
                      className="hidden"
                    />
                  </div>
                </div>

                <div>
                  <label className="block text-xs font-semibold text-gray-700 mb-1">
                    Deskripsi Portofolio
                  </label>
                  <textarea
                    rows={2}
                    value={editingPortfolio.description}
                    onChange={(e) =>
                      setEditingPortfolio({
                        ...editingPortfolio,
                        description: e.target.value,
                      })
                    }
                    className="w-full text-xs p-2.5 rounded-lg border border-gray-300 bg-white"
                  />
                </div>

                <div className="flex items-center gap-2 pt-2">
                  <button
                    type="submit"
                    className="flex-1 py-2.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white font-semibold text-xs rounded-lg transition-all shadow-xs"
                  >
                    Simpan Perubahan &amp; Tagar
                  </button>
                  <button
                    type="button"
                    onClick={() => setEditingPortfolio(null)}
                    className="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-colors"
                  >
                    Batal
                  </button>
                </div>
              </form>
            </motion.div>
          </div>
        )}

        {/* MODAL: EDIT CLIENT BRAND / LOGO */}
        {editingBrand && (
          <div className="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.95, y: 15 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.95, y: 15 }}
              className="bg-white border border-gray-200 rounded-3xl p-6 max-w-lg w-full shadow-2xl relative font-sans max-h-[90vh] overflow-y-auto"
            >
              <div className="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
                <div className="flex items-center gap-2">
                  <div className="p-1.5 rounded-lg bg-rose-50 text-[#8B0021]">
                    <Edit3 className="w-4 h-4" />
                  </div>
                  <div>
                    <h3 className="text-xs font-extrabold uppercase tracking-wider text-gray-900">
                      Edit Logo &amp; Data Klien
                    </h3>
                    <p className="text-[10px] text-gray-400">
                      Perbarui file logo, atur ulang crop/zoom, atau ubah nama brand.
                    </p>
                  </div>
                </div>
                <button
                  type="button"
                  onClick={() => setEditingBrand(null)}
                  className="p-1.5 text-gray-400 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer"
                >
                  <X className="w-4 h-4" />
                </button>
              </div>

              <form onSubmit={handleUpdateBrand} className="space-y-4">
                {/* Logo Image Preview & Studio Actions */}
                <div className="space-y-2">
                  <label className="block text-xs font-semibold text-gray-700">
                    Logo Klien Saat Ini:
                  </label>
                  <div className="p-4 bg-[#07080E] rounded-2xl border border-gray-800 flex items-center justify-center min-h-[100px]">
                    {editingBrand.logoImage ? (
                      <img
                        src={editingBrand.logoImage}
                        alt="Logo Preview"
                        className="h-10 sm:h-12 w-auto max-w-[200px] object-contain invert"
                      />
                    ) : (
                      <span className="text-xs text-gray-500 font-medium">Belum ada logo gambar (hanya teks)</span>
                    )}
                  </div>

                  <div className="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1">
                    {editingBrand.logoImage && (
                      <button
                        type="button"
                        onClick={() => {
                          setRawLogoToCrop(editingBrand.logoImage || "");
                          setCropZoom(1.0);
                          setCropOffsetX(0);
                          setCropOffsetY(0);
                          setAutoRemoveBg(true);
                          setBgThreshold(35);
                          setIsEditModeForBrand(true);
                          setCropModalOpen(true);
                        }}
                        className="py-2 px-3 bg-rose-50 hover:bg-rose-100 text-[#8B0021] text-xs font-bold rounded-xl border border-rose-200 flex items-center justify-center gap-1.5 transition-colors cursor-pointer"
                      >
                        <Crop className="w-3.5 h-3.5" />
                        <span>Buka Logo Studio (Crop/Zoom)</span>
                      </button>
                    )}

                    <button
                      type="button"
                      onClick={() => editBrandLogoInputRef.current?.click()}
                      className="py-2 px-3 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl border border-gray-200 flex items-center justify-center gap-1.5 transition-colors cursor-pointer"
                    >
                      <Upload className="w-3.5 h-3.5" />
                      <span>Ganti File Logo Baru</span>
                    </button>
                    <input
                      ref={editBrandLogoInputRef}
                      type="file"
                      accept="image/*"
                      onChange={(e) => handleBrandLogoUpload(e, true)}
                      className="hidden"
                    />
                  </div>
                </div>

                <div className="grid grid-cols-1 gap-3 pt-2">
                  <div>
                    <label className="block text-xs font-bold text-gray-800 mb-1.5">
                      Nama Brand / Klien <span className="text-gray-400 font-normal">(Opsional jika hanya ingin logo)</span>
                    </label>
                    <input
                      type="text"
                      value={editingBrand.name || ""}
                      onChange={(e) =>
                        setEditingBrand({ ...editingBrand, name: e.target.value })
                      }
                      placeholder="Kosongkan jika hanya logo"
                      className="w-full text-sm font-bold text-gray-950 placeholder:text-gray-400 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] focus:ring-2 focus:ring-[#7B0B1E]/10 outline-none bg-white shadow-xs"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-gray-800 mb-1.5">
                      Sektor / Label Bisnis <span className="text-gray-400 font-normal">(Opsional)</span>
                    </label>
                    <input
                      type="text"
                      value={editingBrand.label || ""}
                      onChange={(e) =>
                        setEditingBrand({ ...editingBrand, label: e.target.value })
                      }
                      placeholder="Contoh: Supply Chain & Tracking"
                      className="w-full text-sm font-bold text-gray-950 placeholder:text-gray-400 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] focus:ring-2 focus:ring-[#7B0B1E]/10 outline-none bg-white shadow-xs"
                    />
                  </div>

                  {/* Individual Scale / Size Multiplier for this Logo */}
                  <div className="p-3 bg-gray-50 rounded-xl border border-gray-200 space-y-1.5">
                    <div className="flex items-center justify-between">
                      <label className="text-xs font-bold text-gray-800">
                        🔍 Ukuran / Skala Khusus Logo Ini
                      </label>
                      <span className="text-xs font-mono font-bold text-[#8B0021] bg-rose-50 px-2 py-0.5 rounded border border-rose-200">
                        {Math.round((editingBrand.scale || 1.0) * 100)}%
                      </span>
                    </div>
                    <input
                      type="range"
                      min="0.5"
                      max="2.5"
                      step="0.05"
                      value={editingBrand.scale || 1.0}
                      onChange={(e) =>
                        setEditingBrand({ ...editingBrand, scale: Number(e.target.value) })
                      }
                      className="w-full accent-[#8B0021] h-1.5 bg-gray-200 rounded-lg cursor-pointer"
                    />
                    <div className="flex justify-between text-[10px] text-gray-400 font-mono">
                      <span>50% (Kecil)</span>
                      <span>100% (Normal)</span>
                      <span>250% (Besar)</span>
                    </div>
                  </div>
                </div>

                <div className="flex items-center gap-2 pt-3 border-t border-gray-100">
                  <button
                    type="submit"
                    className="flex-1 py-2.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white font-semibold text-xs rounded-xl transition-all shadow-xs flex items-center justify-center gap-1.5 cursor-pointer"
                  >
                    <Check className="w-4 h-4" />
                    <span>Simpan Perubahan</span>
                  </button>
                  <button
                    type="button"
                    onClick={() => setEditingBrand(null)}
                    className="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-xl transition-colors cursor-pointer"
                  >
                    Batal
                  </button>
                </div>
              </form>
            </motion.div>
          </div>
        )}

        {/* MODAL: INTERACTIVE LOGO STUDIO (CROP, ZOOM & AUTO-REMOVE BACKGROUND) */}
        {cropModalOpen && rawLogoToCrop && (
          <div className="fixed inset-0 z-50 bg-black/75 backdrop-blur-sm flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.95, y: 15 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.95, y: 15 }}
              className="bg-white border border-gray-200 rounded-3xl p-5 sm:p-6 max-w-xl w-full shadow-2xl relative font-sans max-h-[92vh] overflow-y-auto"
            >
              <div className="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
                <div className="flex items-center gap-2">
                  <div className="p-1.5 rounded-lg bg-rose-50 text-[#8B0021]">
                    <Crop className="w-4 h-4" />
                  </div>
                  <div>
                    <h3 className="text-xs font-extrabold uppercase tracking-wider text-gray-900">
                      Studio Penyesuaian Logo &amp; Latar Belakang
                    </h3>
                    <p className="text-[10px] text-gray-400">
                      Zoom, geser posisi, dan hapus background putih logo secara otomatis.
                    </p>
                  </div>
                </div>
                <button
                  type="button"
                  onClick={() => setCropModalOpen(false)}
                  className="p-1.5 text-gray-400 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition-colors"
                >
                  <X className="w-4 h-4" />
                </button>
              </div>

              {/* LIVE CANVAS PREVIEW STAGE WITH OVAL CAPSULE GUIDE */}
              <div className="space-y-2">
                <div className="flex items-center justify-between text-xs font-semibold text-gray-700 px-1">
                  <span>Pratinjau Kapsul Oval Marquee:</span>
                  <div className="flex items-center gap-1.5">
                    <span className="text-[10px] text-gray-400 font-normal">Tes Tema:</span>
                    <button
                      type="button"
                      onClick={() => setPreviewDarkTheme(false)}
                      className={`px-2.5 py-1 rounded-md text-[10px] font-bold transition-all flex items-center gap-1 cursor-pointer ${
                        !previewDarkTheme
                          ? "bg-rose-50 text-[#8B0021] border border-rose-200"
                          : "bg-gray-100 text-gray-600 border border-gray-200"
                      }`}
                    >
                      <Sun className="w-3 h-3" />
                      <span>Terang</span>
                    </button>
                    <button
                      type="button"
                      onClick={() => setPreviewDarkTheme(true)}
                      className={`px-2.5 py-1 rounded-md text-[10px] font-bold transition-all flex items-center gap-1 cursor-pointer ${
                        previewDarkTheme
                          ? "bg-gray-900 text-white border border-gray-800"
                          : "bg-gray-100 text-gray-600 border border-gray-200"
                      }`}
                    >
                      <Moon className="w-3 h-3" />
                      <span>Gelap</span>
                    </button>
                  </div>
                </div>

                {/* Canvas Container with Theme Simulation */}
                <div
                  className={`p-6 sm:p-8 rounded-2xl flex items-center justify-center transition-colors border ${
                    previewDarkTheme
                      ? "bg-[#07080E] border-gray-800"
                      : "bg-gray-100 border-gray-200"
                  }`}
                >
                  {/* Simulated 1:1 Square Card in Marquee */}
                  <div
                    className={`w-36 h-36 sm:w-44 sm:h-44 rounded-2xl border flex items-center justify-center p-3 shadow-sm relative overflow-hidden transition-colors ${
                      previewDarkTheme
                        ? "bg-[#11121C] border-gray-800"
                        : "bg-white border-gray-200"
                    }`}
                  >
                    <canvas
                      ref={logoCanvasRef}
                      width={260}
                      height={260}
                      className={`w-full h-full object-contain filter grayscale transition-all ${
                        previewDarkTheme ? "invert opacity-90 contrast-125" : "opacity-80"
                      }`}
                    />
                  </div>
                </div>
              </div>

              {/* CONTROLS */}
              <div className="mt-4 space-y-3.5 pt-3 border-t border-gray-100">
                {/* 1. Auto Remove Background Switch & Threshold */}
                <div className="p-3 bg-rose-50/70 rounded-xl border border-rose-100 space-y-2">
                  <div className="flex items-center justify-between">
                    <label className="flex items-center gap-2 text-xs font-bold text-gray-900 cursor-pointer">
                      <input
                        type="checkbox"
                        checked={autoRemoveBg}
                        onChange={(e) => setAutoRemoveBg(e.target.checked)}
                        className="w-4 h-4 rounded text-[#8B0021] focus:ring-[#8B0021] accent-[#8B0021] cursor-pointer"
                      />
                      <span className="flex items-center gap-1.5 text-[#8B0021]">
                        <Wand2 className="w-3.5 h-3.5" />
                        <span>Hapus Latar Belakang Putih Otomatis (Transparan)</span>
                      </span>
                    </label>
                    <span className="text-[10px] px-2 py-0.5 rounded-full bg-white text-rose-800 font-mono font-bold border border-rose-200">
                      {autoRemoveBg ? "AKTIF" : "NONAKTIF"}
                    </span>
                  </div>

                  {autoRemoveBg && (
                    <div className="pt-1 flex items-center gap-3">
                      <span className="text-[10px] text-gray-500 font-semibold whitespace-nowrap">
                        Sensitivitas Transparansi:
                      </span>
                      <input
                        type="range"
                        min="10"
                        max="80"
                        value={bgThreshold}
                        onChange={(e) => setBgThreshold(Number(e.target.value))}
                        className="flex-1 accent-[#8B0021] h-1.5 bg-gray-200 rounded-lg cursor-pointer"
                      />
                      <span className="text-[10px] font-mono text-gray-600 w-6 text-right">
                        {bgThreshold}
                      </span>
                    </div>
                  )}
                </div>

                {/* 2. Zoom In / Out Controls (Up to 1000%) */}
                <div className="space-y-2">
                  <div className="flex items-center justify-between text-xs font-semibold text-gray-700">
                    <span className="flex items-center gap-1.5">
                      <ZoomIn className="w-3.5 h-3.5 text-[#8B0021]" />
                      <span>Zoom Logo (Hingga 1000%)</span>
                    </span>
                    <span className="text-xs font-mono font-extrabold text-[#8B0021] bg-rose-50 px-2.5 py-0.5 rounded-full border border-rose-200">
                      {Math.round(cropZoom * 100)}%
                    </span>
                  </div>

                  <div className="flex items-center gap-2">
                    <button
                      type="button"
                      onClick={() => setCropZoom((prev) => Math.max(0.2, Number((prev - (prev > 2 ? 0.5 : 0.2)).toFixed(2))))}
                      className="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 transition-colors cursor-pointer"
                      title="Perkecil"
                    >
                      <ZoomOut className="w-3.5 h-3.5" />
                    </button>
                    <input
                      type="range"
                      min="0.2"
                      max="10.0"
                      step="0.05"
                      value={cropZoom}
                      onChange={(e) => setCropZoom(Number(e.target.value))}
                      className="flex-1 accent-[#8B0021] h-1.5 bg-gray-200 rounded-lg cursor-pointer"
                    />
                    <button
                      type="button"
                      onClick={() => setCropZoom((prev) => Math.min(10.0, Number((prev + (prev >= 2 ? 0.5 : 0.2)).toFixed(2))))}
                      className="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 transition-colors cursor-pointer"
                      title="Perbesar"
                    >
                      <ZoomIn className="w-3.5 h-3.5" />
                    </button>
                  </div>

                  {/* Quick Zoom Presets */}
                  <div className="flex items-center gap-1.5 pt-0.5">
                    <span className="text-[10px] text-gray-400 font-semibold mr-1">Preset Cepat:</span>
                    {[0.5, 1.0, 2.0, 3.5, 5.0, 7.5, 10.0].map((preset) => (
                      <button
                        key={preset}
                        type="button"
                        onClick={() => setCropZoom(preset)}
                        className={`px-2 py-0.5 rounded text-[10px] font-bold font-mono transition-all cursor-pointer ${
                          cropZoom === preset
                            ? "bg-[#8B0021] text-white shadow-xs"
                            : "bg-gray-100 hover:bg-gray-200 text-gray-700"
                        }`}
                      >
                        {preset * 100}%
                      </button>
                    ))}
                    <button
                      type="button"
                      onClick={() => {
                        setCropZoom(1.0);
                        setCropOffsetX(0);
                        setCropOffsetY(0);
                      }}
                      className="ml-auto px-2 py-0.5 text-[10px] font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded transition-colors flex items-center gap-1 cursor-pointer"
                      title="Reset Posisi & Zoom"
                    >
                      <RotateCcw className="w-3 h-3" />
                      <span>Reset</span>
                    </button>
                  </div>
                </div>

                {/* 3. Position Adjustment (Pan X & Y) */}
                <div className="grid grid-cols-2 gap-3 pt-1">
                  <div>
                    <label className="block text-[11px] font-semibold text-gray-600 mb-1">
                      Geser Horizontal (X): {cropOffsetX}px
                    </label>
                    <input
                      type="range"
                      min="-500"
                      max="500"
                      value={cropOffsetX}
                      onChange={(e) => setCropOffsetX(Number(e.target.value))}
                      className="w-full accent-[#8B0021] h-1.5 bg-gray-200 rounded-lg cursor-pointer"
                    />
                  </div>
                  <div>
                    <label className="block text-[11px] font-semibold text-gray-600 mb-1">
                      Geser Vertikal (Y): {cropOffsetY}px
                    </label>
                    <input
                      type="range"
                      min="-350"
                      max="350"
                      value={cropOffsetY}
                      onChange={(e) => setCropOffsetY(Number(e.target.value))}
                      className="w-full accent-[#8B0021] h-1.5 bg-gray-200 rounded-lg cursor-pointer"
                    />
                  </div>
                </div>
              </div>

              {/* ACTION BUTTONS */}
              <div className="flex items-center gap-2 pt-4 border-t border-gray-100 mt-4">
                <button
                  type="button"
                  onClick={applyCroppedLogo}
                  className="flex-1 py-2.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white font-semibold text-xs rounded-xl transition-all shadow-xs flex items-center justify-center gap-1.5 cursor-pointer"
                >
                  <Check className="w-4 h-4" />
                  <span>Terapkan &amp; Simpan Logo</span>
                </button>
                <button
                  type="button"
                  onClick={() => setCropModalOpen(false)}
                  className="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-xl transition-colors cursor-pointer"
                >
                  Batal
                </button>
              </div>
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
