"use client";

import React, { useState } from "react";
import Link from "next/link";
import {
  CheckCircle,
  Send,
  ArrowLeft,
  FileText,
  Phone,
  Upload,
} from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";
import { getWhatsAppUrl } from "@/utils/whatsapp";

export default function CustomerBriefFormPage() {
  const { data, addOrderSubmission } = useSiteData();
  const [submitted, setSubmitted] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);

  // Form State for 16 Fields
  const [fullName, setFullName] = useState("");
  const [whatsappNumber, setWhatsappNumber] = useState("");
  const [brandName, setBrandName] = useState("");
  const [businessDescription, setBusinessDescription] = useState("");
  const [selectedPackage, setSelectedPackage] = useState("Standard — 549k");
  const [websiteType, setWebsiteType] = useState("Company Profile Bisnis / Perusahaan");
  const [customWebsiteType, setCustomWebsiteType] = useState("");
  const [pagesNeeded, setPagesNeeded] = useState<string[]>([
    "Beranda / Home",
    "Tentang Kami",
    "Layanan / Produk",
    "Kontak & WhatsApp",
  ]);
  const [customPage, setCustomPage] = useState("");
  const [designColorTheme, setDesignColorTheme] = useState(
    "Modern Minimalist Putih & Bersih"
  );
  const [hasDomain, setHasDomain] = useState("Belum punya (ingin dibantu carikan oleh SOLVETA)");
  const [hasLogo, setHasLogo] = useState("Sudah punya logo (file siap dikirim)");
  const [productPhotos, setProductPhotos] = useState("");
  const [exampleWebsites, setExampleWebsites] = useState("");
  const [specialNotes, setSpecialNotes] = useState("");
  const [websiteAndDomainName, setWebsiteAndDomainName] = useState("");
  const [businessProfile, setBusinessProfile] = useState("");

  const pageOptions = [
    "Beranda / Home",
    "Tentang Kami",
    "Layanan / Produk",
    "Galeri / Portofolio",
    "Kontak & WhatsApp",
    "Daftar Harga / Pricelist",
    "Testimoni Klien",
    "Artikel / Blog",
    "Formulir Reservasi / Pemesanan",
  ];

  const handleTogglePage = (pageName: string) => {
    if (pagesNeeded.includes(pageName)) {
      setPagesNeeded(pagesNeeded.filter((p) => p !== pageName));
    } else {
      setPagesNeeded([...pagesNeeded, pageName]);
    }
  };

  const handleFileUpload = (e: React.ChangeEvent<HTMLInputElement>) => {
    const files = e.target.files;
    if (files && files.length > 0) {
      const fileNames = Array.from(files)
        .map((f) => f.name)
        .join(", ");
      setProductPhotos(`File terunggah (${files.length} file): ${fileNames}`);
    }
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!fullName.trim() || !whatsappNumber.trim() || !brandName.trim()) {
      alert("Mohon lengkapi Nama Lengkap, Nomor WhatsApp, dan Nama Usaha/Brand Anda.");
      return;
    }

    setIsSubmitting(true);

    const finalPages = [...pagesNeeded];
    if (customPage.trim()) {
      finalPages.push(customPage.trim());
    }

    const finalWebsiteType =
      websiteType === "Lainnya" && customWebsiteType.trim()
        ? customWebsiteType.trim()
        : websiteType;

    // Add submission to context & storage
    addOrderSubmission({
      fullName: fullName.trim(),
      whatsappNumber: whatsappNumber.trim(),
      brandName: brandName.trim(),
      businessDescription: businessDescription.trim(),
      selectedPackage,
      websiteType: finalWebsiteType,
      pagesNeeded: finalPages.join(", "),
      designColorTheme: designColorTheme.trim(),
      hasDomain,
      hasLogo,
      productPhotos: productPhotos.trim() || "Tidak ada foto khusus (gunakan ilustrasi/stok foto profesional)",
      exampleWebsites: exampleWebsites.trim() || "-",
      specialNotes: specialNotes.trim() || "-",
      websiteAndDomainName: websiteAndDomainName.trim() || `${brandName.toLowerCase().replace(/\s+/g, "")}.com`,
      businessProfile: businessProfile.trim() || "-",
      status: "Baru",
    });

    setTimeout(() => {
      setIsSubmitting(false);
      setSubmitted(true);
      window.scrollTo({ top: 0, behavior: "smooth" });
    }, 600);
  };

  const logoSrc = data.siteCopy.siteLogo || "/images/logo.png";
  const contactWa = data.contact.whatsappNumber || "6285719663154";

  const waConfirmationMsg = `Halo SOLVETA, saya ${fullName} (${brandName}) telah mengirimkan formulir kebutuhan website untuk paket *${selectedPackage}*. Mohon konfirmasi dan tindak lanjutnya. Terima kasih!`;

  if (submitted) {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center p-4 font-sans">
        <div className="max-w-lg w-full bg-white rounded-2xl border border-gray-200/80 p-8 shadow-sm text-center space-y-5">
          <div className="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto">
            <CheckCircle className="w-8 h-8" />
          </div>

          <div>
            <h1 className="text-xl font-semibold text-gray-900">
              Formulir Berhasil Terkirim!
            </h1>
            <p className="text-xs text-gray-500 mt-1.5 leading-relaxed">
              Terima kasih, <strong>{fullName}</strong>. Rincian kebutuhan website untuk usaha{" "}
              <strong>{brandName}</strong> telah tersimpan di sistem SOLVETA.
            </p>
          </div>

          <div className="p-4 bg-gray-50 rounded-xl text-left text-xs space-y-2 border border-gray-100">
            <div className="flex justify-between">
              <span className="text-gray-400">Paket Dipilih:</span>
              <span className="font-semibold text-gray-900">{selectedPackage}</span>
            </div>
            <div className="flex justify-between">
              <span className="text-gray-400">Nomor WhatsApp:</span>
              <span className="font-semibold text-gray-900">{whatsappNumber}</span>
            </div>
            <div className="flex justify-between">
              <span className="text-gray-400">Estimasi Domain:</span>
              <span className="font-semibold text-gray-900">{websiteAndDomainName || "-"}</span>
            </div>
          </div>

          <div className="space-y-2.5 pt-2">
            <a
              href={getWhatsAppUrl(contactWa, waConfirmationMsg)}
              target="_blank"
              rel="noopener noreferrer"
              className="w-full py-2.5 px-4 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-xl transition-colors flex items-center justify-center gap-2 cursor-pointer"
            >
              <Phone className="w-4 h-4" />
              <span>Konfirmasi Sekarang via WhatsApp</span>
            </a>

            <button
              type="button"
              onClick={() => {
                setSubmitted(false);
                setFullName("");
                setBrandName("");
                setWhatsappNumber("");
                setBusinessDescription("");
              }}
              className="w-full py-2 text-xs text-gray-500 hover:text-gray-800 transition-colors cursor-pointer"
            >
              Isi Formulir Baru
            </button>
          </div>

          <div className="pt-4 border-t border-gray-100">
            <Link
              href="/"
              className="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-gray-900 transition-colors"
            >
              <ArrowLeft className="w-3.5 h-3.5" />
              <span>Kembali ke Website Utama</span>
            </Link>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-gray-50/60 font-sans text-gray-900 pb-16">
      {/* Top Header Card */}
      <header className="bg-white border-b border-gray-200/80 sticky top-0 z-30">
        <div className="max-w-3xl mx-auto px-4 py-3.5 flex items-center justify-between">
          <Link href="/" className="flex items-center gap-2.5">
            <div className="w-7 h-7 rounded-lg overflow-hidden border border-gray-200 bg-white flex items-center justify-center">
              <img
                src={logoSrc}
                alt="SOLVETA Logo"
                className="w-full h-full object-contain p-0.5"
              />
            </div>
            <div>
              <div className="text-xs font-bold tracking-tight text-gray-950">SOLVETA</div>
              <div className="text-[10px] text-gray-400 -mt-0.5">Solve Technology Agency</div>
            </div>
          </Link>

          <Link
            href="/"
            className="inline-flex items-center gap-1 text-xs text-gray-500 hover:text-gray-900 transition-colors"
          >
            <ArrowLeft className="w-3.5 h-3.5" />
            <span className="hidden sm:inline">Website Utama</span>
          </Link>
        </div>
      </header>

      {/* Main Form Container */}
      <main className="max-w-3xl mx-auto px-4 pt-8">
        <form onSubmit={handleSubmit} className="space-y-4 text-xs">
          {/* Cover / Title Card */}
          <div className="bg-white border border-gray-200/80 rounded-2xl p-6 sm:p-8 shadow-xs border-t-4 border-t-gray-900 space-y-2">
            <div className="inline-flex items-center gap-1.5 text-[11px] font-medium text-gray-500 uppercase tracking-wider bg-gray-100 px-2.5 py-0.5 rounded-md mb-1">
              <FileText className="w-3 h-3 text-gray-700" />
              <span>Client Onboarding Form</span>
            </div>
            <h1 className="text-lg sm:text-2xl font-bold text-gray-950 tracking-tight">
              Formulir Kebutuhan Pembuatan Website
            </h1>
            <p className="text-xs sm:text-sm text-gray-500 leading-relaxed pt-1">
              Silakan lengkapi informasi berikut agar tim teknis SOLVETA dapat menyusun arsitektur,
              struktur halaman, dan penawaran terbaik sesuai kebutuhan bisnis Anda.
            </p>
            <div className="pt-2 text-[11px] text-red-600 font-medium">
              * Menandakan pertanyaan wajib diisi
            </div>
          </div>

          {/* 1. Nama Lengkap */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              1. Nama Lengkap <span className="text-red-500">*</span>
            </label>
            <p className="text-[11px] text-gray-400">
              Nama lengkap penanggung jawab / pemilik usaha yang dapat dihubungi.
            </p>
            <input
              type="text"
              required
              value={fullName}
              onChange={(e) => setFullName(e.target.value)}
              placeholder="Jawaban Anda..."
              className="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium"
            />
          </div>

          {/* 2. Nomor WhatsApp yang akan ditampilkan (jika ada) */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              2. Nomor WhatsApp yang akan ditampilkan (jika ada) <span className="text-red-500">*</span>
            </label>
            <p className="text-[11px] text-gray-400">
              Nomor WhatsApp aktif yang akan dihubungkan ke tombol chat konsultasi &amp; pemesanan di website.
            </p>
            <input
              type="text"
              required
              value={whatsappNumber}
              onChange={(e) => setWhatsappNumber(e.target.value)}
              placeholder="Contoh: 081234567890"
              className="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium"
            />
          </div>

          {/* 3. Nama Usaha / Brand */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              3. Nama Usaha / Brand <span className="text-red-500">*</span>
            </label>
            <p className="text-[11px] text-gray-400">
              Nama merek atau brand yang akan menjadi identitas utama di website.
            </p>
            <input
              type="text"
              required
              value={brandName}
              onChange={(e) => setBrandName(e.target.value)}
              placeholder="Contoh: Kopi Senja Nusantara"
              className="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium"
            />
          </div>

          {/* 4. Deskripsi Singkat Usaha / Kegiatan */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              4. Deskripsi Singkat Usaha / Kegiatan <span className="text-red-500">*</span>
            </label>
            <p className="text-[11px] text-gray-400">
              Ceritakan bidang usaha, produk utama, target pelanggan, atau keunggulan bisnis Anda.
            </p>
            <textarea
              required
              rows={3}
              value={businessDescription}
              onChange={(e) => setBusinessDescription(e.target.value)}
              placeholder="Jawaban Anda..."
              className="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium"
            />
          </div>

          {/* 5. Jenis Website yang diinginkan: */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-3">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              5. Jenis Website yang diinginkan:
            </label>
            <div className="space-y-2">
              {[
                "Company Profile Bisnis / Perusahaan",
                "Landing Page Promosi Produk / Jasa",
                "Website Katalog & Menu Pemesanan WhatsApp",
                "Portofolio Personal / Kreator",
                "Website Toko Online (E-Commerce)",
                "Lainnya",
              ].map((type) => (
                <label
                  key={type}
                  className={`flex items-center gap-3 p-2.5 rounded-lg border cursor-pointer transition-colors ${
                    websiteType === type
                      ? "border-gray-900 bg-gray-50/80"
                      : "border-gray-200 hover:bg-gray-50/40"
                  }`}
                >
                  <input
                    type="radio"
                    name="websiteType"
                    checked={websiteType === type}
                    onChange={() => setWebsiteType(type)}
                  />
                  <span className="font-medium text-gray-900">{type}</span>
                </label>
              ))}
            </div>
            {websiteType === "Lainnya" && (
              <input
                type="text"
                value={customWebsiteType}
                onChange={(e) => setCustomWebsiteType(e.target.value)}
                placeholder="Sebutkan jenis website lainnya..."
                className="w-full text-xs p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
              />
            )}
          </div>

          {/* 6. Halaman yang ingin ditampilkan */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-3">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              6. Halaman yang ingin ditampilkan
            </label>
            <p className="text-[11px] text-gray-400">
              Pilih semua halaman yang diperlukan di website Anda.
            </p>
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-2">
              {pageOptions.map((opt) => (
                <label
                  key={opt}
                  className={`flex items-center gap-2.5 p-2.5 rounded-lg border cursor-pointer transition-colors ${
                    pagesNeeded.includes(opt)
                      ? "border-gray-900 bg-gray-50"
                      : "border-gray-200 hover:bg-gray-50/40"
                  }`}
                >
                  <input
                    type="checkbox"
                    checked={pagesNeeded.includes(opt)}
                    onChange={() => handleTogglePage(opt)}
                  />
                  <span className="font-medium text-gray-900">{opt}</span>
                </label>
              ))}
            </div>
            <input
              type="text"
              value={customPage}
              onChange={(e) => setCustomPage(e.target.value)}
              placeholder="Tambahan halaman lain (pisahkan dengan koma jika lebih dari satu)..."
              className="w-full text-xs p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white mt-2"
            />
          </div>

          {/* 7. Warna / Nuansa Desain yang Diinginkan */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              7. Warna / Nuansa Desain yang Diinginkan
            </label>
            <p className="text-[11px] text-gray-400">
              Misal: Clean White &amp; Biru Laut, Hitam Elegan (Dark Mode), Earth Tone Hangat, atau sesuai warna logo.
            </p>
            <input
              type="text"
              value={designColorTheme}
              onChange={(e) => setDesignColorTheme(e.target.value)}
              placeholder="Jawaban Anda..."
              className="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium"
            />
          </div>

          {/* 8. Apakah sudah punya domain? */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-3">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              8. Apakah sudah punya domain?
            </label>
            <div className="space-y-2">
              {[
                "Belum punya (ingin dibantu carikan oleh SOLVETA)",
                "Sudah punya domain sendiri (siap dihubungkan)",
                "Ingin gunakan domain gratis bawaan paket (.site, .xyz, .my.id)",
              ].map((opt) => (
                <label
                  key={opt}
                  className={`flex items-center gap-3 p-2.5 rounded-lg border cursor-pointer transition-colors ${
                    hasDomain === opt
                      ? "border-gray-900 bg-gray-50/80"
                      : "border-gray-200 hover:bg-gray-50/40"
                  }`}
                >
                  <input
                    type="radio"
                    name="hasDomain"
                    checked={hasDomain === opt}
                    onChange={() => setHasDomain(opt)}
                  />
                  <span className="font-medium text-gray-900">{opt}</span>
                </label>
              ))}
            </div>
          </div>

          {/* 9. Apakah sudah punya logo? */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-3">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              9. Apakah sudah punya logo?
            </label>
            <div className="space-y-2">
              {[
                "Sudah punya logo (file siap dikirim)",
                "Belum punya (ingin dibuatkan teks tipografi logo simpel secara gratis)",
                "Belum punya (ingin sekalian memesan desain logo profesional)",
              ].map((opt) => (
                <label
                  key={opt}
                  className={`flex items-center gap-3 p-2.5 rounded-lg border cursor-pointer transition-colors ${
                    hasLogo === opt
                      ? "border-gray-900 bg-gray-50/80"
                      : "border-gray-200 hover:bg-gray-50/40"
                  }`}
                >
                  <input
                    type="radio"
                    name="hasLogo"
                    checked={hasLogo === opt}
                    onChange={() => setHasLogo(opt)}
                  />
                  <span className="font-medium text-gray-900">{opt}</span>
                </label>
              ))}
            </div>
          </div>

          {/* 10. Foto produk / usaha (jika ada) */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              10. Foto produk / usaha (jika ada)
            </label>
            <p className="text-[11px] text-gray-400">
              Unggah file foto produk Anda atau cantumkan link Google Drive / Dropbox jika banyak.
            </p>
            <div className="space-y-2">
              <input
                type="text"
                value={productPhotos}
                onChange={(e) => setProductPhotos(e.target.value)}
                placeholder="Tempel link Google Drive atau ketik keterangan foto..."
                className="w-full text-xs p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium"
              />
              <div className="flex items-center gap-2">
                <label className="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg cursor-pointer transition-colors">
                  <Upload className="w-3.5 h-3.5 text-gray-500" />
                  <span>Pilih File dari Komputer / HP</span>
                  <input
                    type="file"
                    multiple
                    accept="image/*"
                    onChange={handleFileUpload}
                    className="hidden"
                  />
                </label>
              </div>
            </div>
          </div>

          {/* 11. Apakah ada contoh website yang disukai? */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              11. Apakah ada contoh website yang disukai?
            </label>
            <p className="text-[11px] text-gray-400">
              Boleh berupa URL website kompetitor atau website dengan gaya visual yang Anda kagumi.
            </p>
            <input
              type="text"
              value={exampleWebsites}
              onChange={(e) => setExampleWebsites(e.target.value)}
              placeholder="Contoh: https://apple.com atau https://tokopedia.com"
              className="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium"
            />
          </div>

          {/* 12. Catatan Tambahan / Permintaan Khusus */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              12. Catatan Tambahan / Permintaan Khusus
            </label>
            <p className="text-[11px] text-gray-400">
              Sampaikan fitur spesifik, integrasi khusus, atau batas waktu peluncuran jika ada.
            </p>
            <textarea
              rows={3}
              value={specialNotes}
              onChange={(e) => setSpecialNotes(e.target.value)}
              placeholder="Jawaban Anda..."
              className="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium"
            />
          </div>

          {/* 13. Nama Website Dan Domain */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              13. Nama Website Dan Domain
            </label>
            <p className="text-[11px] text-gray-400">
              Contoh: namausaha.com, brandanda.id, atau tokokamu.site.
            </p>
            <input
              type="text"
              value={websiteAndDomainName}
              onChange={(e) => setWebsiteAndDomainName(e.target.value)}
              placeholder="Contoh: usahaanda.com"
              className="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium font-mono"
            />
          </div>

          {/* 14. Paket Yang Dipilih */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-3">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              14. Paket Yang Dipilih <span className="text-red-500">*</span>
            </label>
            <p className="text-[11px] text-gray-400">
              Pilih salah satu paket layanan yang paling sesuai dengan kebutuhan Anda.
            </p>
            <div className="space-y-2">
              {[
                { label: "Basic — 299k", desc: "Landing page personal / UMKM hemat (1 Halaman, Free Domain)" },
                { label: "Standard — 549k", desc: "Bisnis berkembang & profile produk (Hingga 5 Halaman, Paling Diminati)" },
                { label: "Premium — 849k", desc: "Company profile profesional & produk lengkap (Hingga 7 Halaman, Speed 3x)" },
                { label: "Platinum — Custom", desc: "Sistem aplikasi web, database & fitur kustom sesuai kebutuhan" },
                { label: "Belum Yakin (Ingin Konsultasi Dulu)", desc: "Tim SOLVETA akan memberikan rekomendasi terbaik" },
              ].map((pkt) => (
                <label
                  key={pkt.label}
                  className={`flex items-start gap-3 p-3 rounded-lg border cursor-pointer transition-colors ${
                    selectedPackage === pkt.label
                      ? "border-gray-900 bg-gray-50/80"
                      : "border-gray-200 hover:bg-gray-50/40"
                  }`}
                >
                  <input
                    type="radio"
                    name="selectedPackage"
                    checked={selectedPackage === pkt.label}
                    onChange={() => setSelectedPackage(pkt.label)}
                    className="mt-0.5"
                  />
                  <div>
                    <div className="font-semibold text-gray-900">{pkt.label}</div>
                    <div className="text-[11px] text-gray-400">{pkt.desc}</div>
                  </div>
                </label>
              ))}
            </div>
          </div>

          {/* 15. Profil Usaha Jika ada. */}
          <div className="bg-white border border-gray-200/80 rounded-xl p-5 sm:p-6 shadow-xs space-y-2">
            <label className="block text-xs sm:text-sm font-semibold text-gray-900">
              15. Profil Usaha Jika ada.
            </label>
            <p className="text-[11px] text-gray-400">
              Masukkan ringkasan latar belakang usaha (Visi, Misi, Sejarah Singkat) untuk ditampilkan pada halaman &quot;Tentang Kami&quot;.
            </p>
            <textarea
              rows={3}
              value={businessProfile}
              onChange={(e) => setBusinessProfile(e.target.value)}
              placeholder="Jawaban Anda..."
              className="w-full text-xs sm:text-sm p-3 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium"
            />
          </div>

          {/* Submit Action Card */}
          <div className="p-6 bg-white border border-gray-200/80 rounded-2xl shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
            <div className="text-xs text-gray-500">
              Pastikan seluruh isian sudah benar sebelum mengirimkan brief ini.
            </div>

            <button
              type="submit"
              disabled={isSubmitting}
              className="w-full sm:w-auto px-6 py-2.5 bg-gray-900 hover:bg-black disabled:opacity-50 text-white font-medium text-xs rounded-xl transition-all shadow-xs flex items-center justify-center gap-2 cursor-pointer"
            >
              <Send className="w-3.5 h-3.5" />
              <span>{isSubmitting ? "Mengirimkan Brief..." : "Kirim Formulir Brief"}</span>
            </button>
          </div>
        </form>
      </main>
    </div>
  );
}
