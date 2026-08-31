"use client";

import React, { useState, useRef } from "react";
import { motion, useInView } from "framer-motion";
import {
  Check,
  X,
  Clock,
  Globe,
  Mail,
  ShieldCheck,
  Sparkles,
  ArrowRight,
  MessageCircle,
  HelpCircle,
  Zap,
  Info,
} from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";

interface ChecklistItem {
  text: string;
  included: boolean;
  note?: string;
}

interface PackageDetail {
  id: string;
  name: string;
  priceBadge: string;
  pricePrefix?: string;
  popular?: boolean;
  popularLabel?: string;
  activePeriod: string;
  renewalPrice: string;
  suitability: string;
  deliveryTime: string;
  buttonLabel: string;
  waMessage: string;
  checklist: ChecklistItem[];
  domainAddons?: { name: string; price: string }[];
  emailAddons?: { name: string; price: string; note?: string }[];
  revisionRules: {
    light: string;
    heavy: string;
    extraPage?: string;
  };
  customNote?: string;
}

const packageList: PackageDetail[] = [
  {
    id: "basic",
    name: "BASIC",
    priceBadge: "299K",
    activePeriod: "1 Tahun",
    renewalPrice: "249k/tahun*",
    suitability: "kebutuhan pribadi: landing page",
    deliveryTime: "1–2 Hari",
    buttonLabel: "Pesan Paket Basic (Rp 299K)",
    waMessage: "Halo SOLVETA, saya tertarik untuk memesan Paket BASIC Rp 299K.",
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
    priceBadge: "549K",
    popular: true,
    popularLabel: "PALING DIMINATI",
    activePeriod: "1 Tahun",
    renewalPrice: "399k/tahun*",
    suitability: "kebutuhan bisnis kecil",
    deliveryTime: "3–5 Hari",
    buttonLabel: "Pesan Paket Standard (Rp 549K)",
    waMessage: "Halo SOLVETA, saya tertarik untuk memesan Paket STANDARD Rp 549K.",
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
    priceBadge: "749K",
    activePeriod: "1 Tahun",
    renewalPrice: "399k/tahun*",
    suitability: "company profile & bisnis produk",
    deliveryTime: "3–5 Hari",
    buttonLabel: "Pesan Paket Premium (Rp 749K)",
    waMessage: "Halo SOLVETA, saya tertarik untuk memesan Paket PREMIUM Rp 749K.",
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
    priceBadge: "1,5 Jt",
    activePeriod: "1 Tahun",
    renewalPrice: "mulai dari : 600k/tahun*",
    suitability: "Website Custom & Sistem Aplikasi",
    deliveryTime: "Wajib Meet (Fleksibel)",
    buttonLabel: "Jadwalkan Konsultasi & Meet",
    waMessage: "Halo SOLVETA, saya ingin konsultasi dan menjadwalkan sesi meet untuk Paket Website Custom.",
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
];

export const PricingSection: React.FC = () => {
  const { data } = useSiteData();
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });

  const [selectedFilter, setSelectedFilter] = useState<string>("all");

  const displayedPackages =
    selectedFilter === "all"
      ? packageList
      : packageList.filter((pkg) => pkg.id === selectedFilter);

  return (
    <section id="pricing" className="py-16 sm:py-24 bg-slate-50/50 border-t border-gray-100">
      <div className="max-w-[1140px] mx-auto px-4 sm:px-6">
        {/* Section Header */}
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 15 }}
          transition={{ duration: 0.5 }}
          className="text-center mb-10"
        >
          <span className="inline-block text-[11px] font-mono font-bold tracking-widest text-[#8B0021] bg-rose-50 border border-rose-200/70 px-3.5 py-1 rounded-full uppercase mb-3">
            PILIHAN PAKET & RINCIAN LENGKAP
          </span>
          <h2 className="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-950 tracking-tight mb-3 uppercase">
            INFORMASI RINCI SETIAP PAKET
          </h2>
          <p className="text-xs sm:text-sm text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Rincian lengkap masing-masing 4 paket website dengan tata letak minimalis, batas garis tepi yang tegas, dan transparansi spesifikasi tanpa biaya tersembunyi.
          </p>
        </motion.div>

        {/* Quick Filter Navigation Buttons */}
        <div className="flex flex-wrap items-center justify-center gap-2 mb-12">
          <button
            onClick={() => setSelectedFilter("all")}
            className={`px-4 py-1.5 rounded-full text-xs font-semibold transition-all border ${
              selectedFilter === "all"
                ? "bg-[#8B0021] text-white border-[#8B0021] shadow-xs"
                : "bg-white text-gray-600 border-gray-200 hover:border-gray-300 hover:bg-gray-50"
            }`}
          >
            Semua 4 Paket (Berurutan)
          </button>
          {packageList.map((pkg) => (
            <button
              key={pkg.id}
              onClick={() => setSelectedFilter(pkg.id)}
              className={`px-4 py-1.5 rounded-full text-xs font-semibold transition-all border ${
                selectedFilter === pkg.id
                  ? "bg-[#8B0021] text-white border-[#8B0021] shadow-xs"
                  : "bg-white text-gray-600 border-gray-200 hover:border-gray-300 hover:bg-gray-50"
              }`}
            >
              Paket {pkg.name} ({pkg.priceBadge})
            </button>
          ))}
        </div>

        {/* STACKED INDIVIDUAL PACKAGE CARDS (ONE BY ONE SEQUENTIALLY) */}
        <div ref={ref} className="space-y-12 sm:space-y-16">
          {displayedPackages.map((pkg, index) => {
            const isPopular = pkg.popular;

            return (
              <motion.div
                key={pkg.id}
                initial={{ opacity: 0, y: 30 }}
                animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 30 }}
                transition={{
                  duration: 0.5,
                  delay: index * 0.1,
                  ease: [0.16, 1, 0.3, 1],
                }}
                id={`paket-${pkg.id}`}
                className={`bg-white rounded-2xl transition-all duration-300 overflow-hidden shadow-2xs ${
                  isPopular
                    ? "border-2 border-[#8B0021] shadow-md shadow-rose-950/5"
                    : "border border-gray-200 hover:border-gray-300 hover:shadow-xs"
                }`}
              >
                {/* Popular Banner (if applicable) */}
                {isPopular && (
                  <div className="bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] text-white text-center font-mono text-[11px] font-bold uppercase tracking-widest py-1.5 px-4 flex items-center justify-center gap-2">
                    <Sparkles className="w-3.5 h-3.5 text-amber-300" />
                    <span>PAKET PALING DIREKOMENDASIKAN (POPULAR)</span>
                    <Sparkles className="w-3.5 h-3.5 text-amber-300" />
                  </div>
                )}

                {/* Main Card Body (2 Columns Layout Matching Screenshot Redesign) */}
                <div className="p-6 sm:p-8 lg:p-10">
                  <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                    {/* LEFT COLUMN: Price Pill, Masa Aktif Box, Cocok Untuk Box, CTA Button */}
                    <div className="lg:col-span-5 flex flex-col justify-between space-y-4">
                      {/* Top Script Label + Large Redesigned Price Badge */}
                      <div className="border border-gray-200 rounded-2xl p-5 bg-gradient-to-b from-gray-50/80 to-white text-center relative shadow-2xs">
                        <div className="text-[11px] font-mono font-bold tracking-widest text-[#8B0021] uppercase mb-1">
                          PAKET WEBSITE
                        </div>

                        {pkg.pricePrefix && (
                          <div className="text-xs font-medium text-gray-500 mb-0.5">
                            {pkg.pricePrefix}
                          </div>
                        )}

                        <div className="text-xs font-extrabold uppercase tracking-widest text-gray-700 mb-1">
                          {pkg.name}
                        </div>

                        <div className="text-4xl sm:text-5xl font-black text-gray-950 tracking-tight">
                          {pkg.priceBadge}
                        </div>
                      </div>

                      {/* Box 1: Masa Aktif & Perpanjangan (Bordered Pill) */}
                      <div className="border border-gray-200 rounded-xl p-4 bg-white shadow-2xs">
                        <div className="flex items-center gap-2 text-xs font-semibold text-gray-700 mb-1">
                          <span className="text-base">⏳</span>
                          <span>Masa aktif {pkg.activePeriod},</span>
                        </div>
                        <div className="text-xs text-gray-500">
                          Perpanjangan :{" "}
                          <span className="text-base sm:text-lg font-bold text-gray-900 ml-1">
                            {pkg.renewalPrice}
                          </span>
                        </div>
                      </div>

                      {/* Box 2: Cocok Untuk & Waktu Pengerjaan (Bordered Pill) */}
                      <div className="border border-gray-200 rounded-xl p-4 bg-white shadow-2xs">
                        <div className="text-xs text-gray-600 mb-1.5 leading-snug">
                          Cocok untuk <strong className="text-gray-900 font-semibold">{pkg.suitability}</strong>
                        </div>
                        <div className="text-xs font-bold text-[#8B0021] flex items-center gap-1.5 pt-1.5 border-t border-gray-100">
                          <span>⚡ Pengerjaan {pkg.deliveryTime}</span>
                        </div>
                      </div>

                      {/* Action CTA Button */}
                      <motion.a
                        whileHover={{ scale: 1.02 }}
                        whileTap={{ scale: 0.98 }}
                        href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
                          pkg.waMessage
                        )}`}
                        target="_blank"
                        rel="noopener noreferrer"
                        className={`w-full py-3.5 px-5 text-xs sm:text-sm font-bold rounded-xl flex items-center justify-center gap-2 transition-all shadow-xs ${
                          isPopular
                            ? "bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white"
                            : "bg-gray-950 hover:bg-black text-white hover:shadow-sm"
                        }`}
                      >
                        <MessageCircle className="w-4 h-4" />
                        <span>{pkg.buttonLabel}</span>
                      </motion.a>
                    </div>

                    {/* RIGHT COLUMN: Feature Checklist with [✔] and [❌] */}
                    <div className="lg:col-span-7 flex flex-col justify-between">
                      <div>
                        <div className="flex items-center justify-between pb-3 mb-4 border-b border-gray-100">
                          <span className="text-xs font-mono font-bold tracking-wider text-gray-500 uppercase">
                            Spesifikasi & Fitur Termasuk
                          </span>
                          <span className="text-[11px] text-gray-400 font-mono">
                            {pkg.checklist.filter((c) => c.included).length} Fitur Aktif
                          </span>
                        </div>

                        {/* Checklist items list */}
                        <div className="border border-gray-200 rounded-xl divide-y divide-gray-100 bg-white overflow-hidden">
                          {pkg.checklist.map((item, cIndex) => (
                            <div
                              key={cIndex}
                              className={`p-3 sm:p-3.5 flex items-start gap-3 text-xs sm:text-sm transition-colors ${
                                item.included
                                  ? "text-gray-800 hover:bg-gray-50/50"
                                  : "text-gray-400 bg-gray-50/30 line-through decoration-gray-300"
                              }`}
                            >
                              {item.included ? (
                                <div className="w-5 h-5 rounded flex items-center justify-center bg-emerald-100 text-emerald-700 flex-shrink-0 mt-0.5 border border-emerald-200/80">
                                  <Check className="w-3.5 h-3.5 stroke-[3]" />
                                </div>
                              ) : (
                                <div className="w-5 h-5 rounded flex items-center justify-center bg-rose-50 text-rose-500 flex-shrink-0 mt-0.5 border border-rose-200/60">
                                  <X className="w-3.5 h-3.5 stroke-[3]" />
                                </div>
                              )}
                              <span className="leading-snug font-medium">
                                {item.text}
                              </span>
                            </div>
                          ))}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                {/* BOTTOM SUB-SECTION: Add-ons & Revisi Info (Bordered Minimalist Sub-Cards) */}
                <div className="border-t border-gray-200 bg-gray-50/60 p-6 sm:p-8">
                  <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    {/* Sub-Card 1: Domain Premium (if applicable) or General Note */}
                    {pkg.domainAddons && pkg.domainAddons.length > 0 ? (
                      <div className="border border-gray-200 rounded-xl bg-white p-4 text-xs">
                        <div className="flex items-center gap-1.5 font-bold text-gray-900 uppercase tracking-wider text-[11px] mb-2">
                          <Globe className="w-3.5 h-3.5 text-[#8B0021]" />
                          <span>Domain Premium (Biaya Tambahan):</span>
                        </div>
                        <div className="grid grid-cols-2 gap-x-2 gap-y-1.5 text-[11px] text-gray-600">
                          {pkg.domainAddons.map((dom, dIdx) => (
                            <div key={dIdx} className="flex justify-between items-center py-0.5 border-b border-gray-50">
                              <span className="font-mono text-gray-700">{dom.name}</span>
                              <span className="font-semibold text-gray-900">{dom.price}</span>
                            </div>
                          ))}
                        </div>
                      </div>
                    ) : (
                      <div className="border border-gray-200 rounded-xl bg-white p-4 text-xs flex flex-col justify-between">
                        <div>
                          <div className="flex items-center gap-1.5 font-bold text-gray-900 uppercase tracking-wider text-[11px] mb-2">
                            <Globe className="w-3.5 h-3.5 text-[#8B0021]" />
                            <span>Domain & Server Hosting:</span>
                          </div>
                          <p className="text-[11px] text-gray-500 leading-relaxed mb-2">
                            Sudah termasuk sewa domain standar (.com, .net, .org) & hosting server berkecepatan tinggi selama 1 tahun pertama.
                          </p>
                        </div>
                        <div className="text-[10px] text-emerald-700 font-semibold bg-emerald-50 border border-emerald-200/60 px-2 py-1 rounded">
                          ✓ Siap online langsung tanpa biaya setup tambahan
                        </div>
                      </div>
                    )}

                    {/* Sub-Card 2: Layanan Email Profesional */}
                    {pkg.emailAddons && pkg.emailAddons.length > 0 ? (
                      <div className="border border-gray-200 rounded-xl bg-white p-4 text-xs">
                        <div className="flex items-center gap-1.5 font-bold text-gray-900 uppercase tracking-wider text-[11px] mb-2">
                          <Mail className="w-3.5 h-3.5 text-[#8B0021]" />
                          <span>Layanan Email Profesional:</span>
                        </div>
                        <div className="space-y-2 text-[11px]">
                          {pkg.emailAddons.map((em, eIdx) => (
                            <div key={eIdx} className="flex justify-between items-center p-2 rounded bg-gray-50 border border-gray-100">
                              <span className="text-gray-700 font-medium">{em.name}</span>
                              <span className="font-bold text-gray-900">{em.price}</span>
                            </div>
                          ))}
                        </div>
                      </div>
                    ) : (
                      <div className="border border-gray-200 rounded-xl bg-white p-4 text-xs flex flex-col justify-between">
                        <div>
                          <div className="flex items-center gap-1.5 font-bold text-gray-900 uppercase tracking-wider text-[11px] mb-2">
                            <Mail className="w-3.5 h-3.5 text-[#8B0021]" />
                            <span>Alokasi Email Bisnis:</span>
                          </div>
                          <p className="text-[11px] text-gray-500 leading-relaxed">
                            {pkg.id === "standard" && "Termasuk 1 akun email bisnis (nama@domain.com) dengan webmail & setup SMTP."}
                            {pkg.id === "premium" && "Termasuk 2 akun email bisnis (nama@domain.com) terkonfigurasi penuh."}
                            {pkg.id === "custom" && "Unlimited akun email bisnis dengan hak akses cPanel penuh."}
                          </p>
                        </div>
                        <div className="text-[10px] text-gray-500 pt-2 border-t border-gray-100">
                          *Email tambahan dapat ditambahkan kapan saja (+Rp 50.000/email).
                        </div>
                      </div>
                    )}

                    {/* Sub-Card 3: Tarif Revisi & Ketentuan */}
                    <div className="border border-gray-200 rounded-xl bg-white p-4 text-xs md:col-span-2 lg:col-span-1">
                      <div className="flex items-center gap-1.5 font-bold text-gray-900 uppercase tracking-wider text-[11px] mb-2">
                        <ShieldCheck className="w-3.5 h-3.5 text-[#8B0021]" />
                        <span>Tarif & Ketentuan Revisi:</span>
                      </div>
                      <div className="space-y-1.5 text-[11px] text-gray-600">
                        <div className="flex items-start gap-1">
                          <span className="text-gray-400">•</span>
                          <div>
                            <strong className="text-gray-800">Revisi Ringan:</strong> {pkg.revisionRules.light}
                          </div>
                        </div>
                        <div className="flex items-start gap-1">
                          <span className="text-gray-400">•</span>
                          <div>
                            <strong className="text-gray-800">Revisi Berat:</strong> {pkg.revisionRules.heavy}
                          </div>
                        </div>
                        {pkg.revisionRules.extraPage && (
                          <div className="flex items-start gap-1">
                            <span className="text-gray-400">•</span>
                            <div>
                              <strong className="text-gray-800">Tambah Halaman:</strong> {pkg.revisionRules.extraPage}
                            </div>
                          </div>
                        )}
                        {pkg.customNote && (
                          <div className="text-[10px] text-[#8B0021] font-semibold pt-1 border-t border-gray-100">
                            {pkg.customNote}
                          </div>
                        )}
                      </div>
                    </div>
                  </div>
                </div>
              </motion.div>
            );
          })}
        </div>

        {/* Global Assurance Banner */}
        <div className="mt-12 border border-gray-200 rounded-2xl bg-white p-5 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-gray-600 shadow-2xs">
          <div className="flex items-start gap-3">
            <Info className="w-5 h-5 text-[#8B0021] flex-shrink-0 mt-0.5" />
            <div>
              <strong className="text-gray-900 font-semibold block mb-0.5">
                Garansi Penuh & Ketentuan Transparansi SOLVETA:
              </strong>
              <p className="text-[11px] leading-relaxed text-gray-500">
                *Biaya perpanjangan tahun berikutnya digunakan untuk sewa domain & hosting aktif. Semua paket website mendapatkan garansi pemeliharaan perbaikan error secara cuma-cuma.
              </p>
            </div>
          </div>

          <motion.a
            whileHover={{ scale: 1.03 }}
            whileTap={{ scale: 0.98 }}
            href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
              "Halo SOLVETA, saya ingin konsultasi mengenai pilihan paket website."
            )}`}
            target="_blank"
            rel="noopener noreferrer"
            className="flex-shrink-0 px-5 py-2.5 bg-[#8B0021] hover:bg-[#750019] text-white text-xs font-bold rounded-xl transition-all flex items-center gap-2 shadow-xs"
          >
            <span>Konsultasi WhatsApp</span>
            <ArrowRight className="w-3.5 h-3.5" />
          </motion.a>
        </div>
      </div>
    </section>
  );
};
