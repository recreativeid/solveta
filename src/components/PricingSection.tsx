"use client";

import React, { useRef } from "react";
import { motion, useInView } from "framer-motion";
import {
  Check,
  X,
  Clock,
  Globe,
  Mail,
  ShieldCheck,
  Sparkles,
  Layers,
  FileText,
  Info,
} from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";

interface SpecRow {
  name: string;
  basic: { text: string; status?: "check" | "cross" | "neutral" };
  standard: { text: string; status?: "check" | "cross" | "neutral" };
  premium: { text: string; status?: "check" | "cross" | "neutral" };
  custom: { text: string; status?: "check" | "cross" | "neutral" };
}

interface SpecCategory {
  title: string;
  icon: React.ElementType;
  rows: SpecRow[];
}

const detailedSpecs: SpecCategory[] = [
  {
    title: "Ringkasan & Ketentuan Utama",
    icon: Clock,
    rows: [
      {
        name: "Masa Aktif Layanan",
        basic: { text: "1 Tahun (Full Garansi*)", status: "check" },
        standard: { text: "1 Tahun (Full Garansi*)", status: "check" },
        premium: { text: "1 Tahun (Full Garansi*)", status: "check" },
        custom: { text: "1 Tahun (Full Garansi*)", status: "check" },
      },
      {
        name: "Biaya Perpanjangan / Tahun",
        basic: { text: "249k/tahun*", status: "neutral" },
        standard: { text: "399k/tahun*", status: "neutral" },
        premium: { text: "399k/tahun*", status: "neutral" },
        custom: { text: "Mulai 600k/tahun*", status: "neutral" },
      },
      {
        name: "Estimasi Waktu Pengerjaan",
        basic: { text: "1–2 Hari Kerja", status: "neutral" },
        standard: { text: "3–5 Hari Kerja", status: "neutral" },
        premium: { text: "3–5 Hari Kerja", status: "neutral" },
        custom: { text: "Wajib Meet (Fleksibel)", status: "neutral" },
      },
      {
        name: "Cocok Untuk Kebutuhan",
        basic: { text: "Kebutuhan pribadi: landing page", status: "neutral" },
        standard: { text: "Kebutuhan bisnis kecil", status: "neutral" },
        premium: { text: "Company profile & bisnis produk", status: "neutral" },
        custom: { text: "Website Custom (Wajib Meet)", status: "neutral" },
      },
    ],
  },
  {
    title: "Halaman, Desain & Revisi",
    icon: Layers,
    rows: [
      {
        name: "Jumlah Maksimal Halaman",
        basic: { text: "Maks. 1 Halaman (+50k/hal)", status: "check" },
        standard: { text: "Maks. 5 Halaman (+50k/hal)", status: "check" },
        premium: { text: "Maks. 7 Halaman (+50k/hal)", status: "check" },
        custom: { text: "Custom / Sesuai Kesepakatan", status: "check" },
      },
      {
        name: "Kuota Revisi Ringan",
        basic: { text: "2x Revisi (Sesuai brief)", status: "check" },
        standard: { text: "3x Revisi (Sesuai brief)", status: "check" },
        premium: { text: "5x Revisi (Sesuai brief)", status: "check" },
        custom: { text: "Fleksibel / Sesuai Kesepakatan", status: "check" },
      },
      {
        name: "Optimasi Kecepatan (Speed)",
        basic: { text: "High Perform", status: "check" },
        standard: { text: "2x Lebih Cepat", status: "check" },
        premium: { text: "3x Lebih Cepat", status: "check" },
        custom: { text: "Super Cepat", status: "check" },
      },
      {
        name: "Free Desain Mockup",
        basic: { text: "Tidak Termasuk", status: "cross" },
        standard: { text: "Tidak Termasuk", status: "cross" },
        premium: { text: "Free Desain Mockup", status: "check" },
        custom: { text: "Free Desain Mockup", status: "check" },
      },
    ],
  },
  {
    title: "Domain, Server Hosting & Email",
    icon: Globe,
    rows: [
      {
        name: "Free Domain (1 Tahun)",
        basic: { text: ".my.id, .site, .store, .xyz, .space, .fund, .shop", status: "check" },
        standard: { text: ".com, .net, .org, dll", status: "check" },
        premium: { text: ".com, .net, .org, dll", status: "check" },
        custom: { text: ".com, .net, .org, dll", status: "check" },
      },
      {
        name: "Free Cloud Hosting",
        basic: { text: "Akses Dashboard (Tanpa cPanel)", status: "check" },
        standard: { text: "Akses Dashboard (Tanpa cPanel)", status: "check" },
        premium: { text: "Akses Dashboard (Tanpa cPanel)", status: "check" },
        custom: { text: "Akses Dashboard + Akses cPanel", status: "check" },
      },
      {
        name: "Email Bisnis (nama@domain.com)",
        basic: { text: "Tidak Termasuk (Opsi Add-on)", status: "cross" },
        standard: { text: "1 Email Bisnis", status: "check" },
        premium: { text: "2 Email Bisnis", status: "check" },
        custom: { text: "Unlimited Email Bisnis", status: "check" },
      },
    ],
  },
  {
    title: "Keamanan, SEO & Pemasaran",
    icon: Sparkles,
    rows: [
      {
        name: "Responsive Web (Mobile Friendly)",
        basic: { text: "Responsive (Mobile Friendly)", status: "check" },
        standard: { text: "Responsive (Mobile Friendly)", status: "check" },
        premium: { text: "Responsive (Mobile Friendly)", status: "check" },
        custom: { text: "Responsive (Mobile Friendly)", status: "check" },
      },
      {
        name: "Sertifikat Keamanan SSL",
        basic: { text: "SSL Security Aktif", status: "check" },
        standard: { text: "SSL Security Aktif", status: "check" },
        premium: { text: "SSL Security Aktif", status: "check" },
        custom: { text: "SSL Security Aktif", status: "check" },
      },
      {
        name: "Optimasi SEO",
        basic: { text: "Tidak Termasuk", status: "cross" },
        standard: { text: "SEO Basic", status: "check" },
        premium: { text: "SEO Friendly", status: "check" },
        custom: { text: "SEO Friendly", status: "check" },
      },
      {
        name: "Google Analytics",
        basic: { text: "Tidak Termasuk", status: "cross" },
        standard: { text: "Tidak Termasuk", status: "cross" },
        premium: { text: "Google Analytics Terpasang", status: "check" },
        custom: { text: "Google Analytics Terpasang", status: "check" },
      },
      {
        name: "Free Iklan Google Ads",
        basic: { text: "Tidak Termasuk", status: "cross" },
        standard: { text: "Tidak Termasuk", status: "cross" },
        premium: { text: "Tidak Termasuk", status: "cross" },
        custom: { text: "Free Iklan Google Ads", status: "check" },
      },
      {
        name: "Garansi Pemeliharaan",
        basic: { text: "Full Garansi*", status: "check" },
        standard: { text: "Full Garansi*", status: "check" },
        premium: { text: "Full Garansi*", status: "check" },
        custom: { text: "Full Garansi*", status: "check" },
      },
    ],
  },
];

export const PricingSection: React.FC = () => {
  const { data } = useSiteData();
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });

  const packagesMeta = [
    {
      id: "basic",
      name: "BASIC",
      price: "299K",
      renewal: "249k/tahun*",
      time: "1–2 Hari",
      target: "Kebutuhan pribadi: landing page",
    },
    {
      id: "standard",
      name: "STANDARD",
      price: "549K",
      renewal: "399k/tahun*",
      time: "3–5 Hari",
      target: "Kebutuhan bisnis kecil",
    },
    {
      id: "premium",
      name: "PREMIUM",
      price: "749K",
      renewal: "399k/tahun*",
      time: "3–5 Hari",
      target: "Company profile & bisnis produk",
    },
    {
      id: "custom",
      name: "CUSTOM",
      price: "1,5 Jt",
      renewal: "mulai dari : 600k/tahun*",
      time: "Wajib Meet",
      target: "Website Custom",
    },
  ];

  return (
    <section id="pricing" className="py-16 sm:py-20 bg-white border-t border-gray-100">
      <div className="max-w-[1180px] mx-auto px-4 sm:px-6">
        {/* Section Header */}
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 15 }}
          transition={{ duration: 0.5 }}
          className="text-center mb-12"
        >
          <span className="inline-block text-[11px] font-mono font-bold tracking-widest text-[#8B0021] bg-rose-50 border border-rose-200/60 px-3 py-1 rounded-full uppercase mb-2">
            PILIHAN PAKET & LAYANAN
          </span>
          <h2 className="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mb-2 uppercase">
            PILIH SOLUSI SESUAI KEBUTUHAN
          </h2>
          <p className="text-xs sm:text-sm text-gray-500 max-w-xl mx-auto">
            Solusi yang transparan dan dapat disesuaikan dengan skala bisnis Anda.
          </p>
        </motion.div>

        {/* 4 Cards Overview */}
        <div
          ref={ref}
          className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 items-stretch mb-16"
        >
          {data.pricing.map((tier, index) => {
            const meta = packagesMeta.find((p) => p.id === tier.id) || packagesMeta[index];

            return (
              <motion.div
                key={tier.id || tier.name}
                initial={{ opacity: 0, y: 30 }}
                animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 30 }}
                transition={{
                  duration: 0.5,
                  delay: index * 0.1,
                  ease: [0.16, 1, 0.3, 1],
                }}
                whileHover={{ y: -4 }}
                className={`bg-white rounded-xl flex flex-col justify-between relative transition-all duration-200 overflow-hidden ${
                  tier.popular
                    ? "border-2 border-[#8B0021] shadow-md shadow-rose-900/5"
                    : "border border-gray-200 hover:border-gray-300 shadow-2xs hover:shadow-xs"
                }`}
              >
                {tier.popular && (
                  <div className="bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] text-white text-center font-mono text-[10px] font-bold uppercase tracking-widest py-1">
                    PALING DIMINATI (POPULAR)
                  </div>
                )}

                <div className="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                  <div>
                    {/* Header Card */}
                    <div className="flex items-center justify-between gap-2 mb-2">
                      <span className="text-[11px] font-mono font-bold tracking-wider text-gray-400 uppercase">
                        Paket
                      </span>
                      {tier.deliveryTime && (
                        <span className="text-[10px] font-semibold text-gray-600 bg-gray-100 border border-gray-200 px-2 py-0.5 rounded">
                          ⏱ {tier.deliveryTime}
                        </span>
                      )}
                    </div>

                    <div className="text-base font-extrabold text-gray-900 tracking-tight uppercase mb-1">
                      {tier.name}
                    </div>

                    <div className="flex items-baseline gap-1 mb-3">
                      {tier.pricePrefix && (
                        <span className="text-xs font-medium text-gray-500">
                          {tier.pricePrefix}
                        </span>
                      )}
                      <span className="text-2xl sm:text-3xl font-extrabold text-gray-950 tracking-tight">
                        {tier.price}
                      </span>
                    </div>

                    {/* Masa Aktif & Perpanjangan Tag (Bordered Minimalist Box) */}
                    <div className="border border-gray-200 bg-gray-50/70 rounded-lg p-2.5 mb-3 text-[11px]">
                      <div className="text-gray-700 font-medium flex items-center gap-1.5 mb-0.5">
                        <span>⏳ Masa aktif:</span>
                        <strong className="font-semibold text-gray-900">1 Tahun</strong>
                      </div>
                      <div className="text-gray-600">
                        Perpanjangan:{" "}
                        <span className="font-bold text-gray-900">
                          {tier.renewalPrice || meta?.renewal || "249k/tahun*"}
                        </span>
                      </div>
                    </div>

                    {/* Suitability & Delivery Time Box */}
                    <div className="border border-gray-200 rounded-lg p-2.5 mb-5 text-[11px] bg-white">
                      <div className="text-gray-500 text-[10px] uppercase font-semibold tracking-wider mb-0.5">
                        Cocok untuk:
                      </div>
                      <div className="text-gray-800 font-medium leading-snug mb-1.5">
                        {tier.suitability}
                      </div>
                      <div className="text-[10px] text-gray-500 flex items-center gap-1 pt-1 border-t border-gray-100">
                        <span>Pengerjaan:</span>
                        <span className="font-semibold text-gray-800">
                          {tier.deliveryTime || meta?.time || "3–5 Hari"}
                        </span>
                      </div>
                    </div>

                    {/* Feature list preview */}
                    <div className="space-y-2 mb-6">
                      <div className="text-[11px] font-semibold text-gray-700 uppercase tracking-wider mb-2">
                        Fitur Utama:
                      </div>
                      {tier.features.slice(0, 5).map((feature, fIndex) => (
                        <div
                          key={fIndex}
                          className="flex items-start gap-2 text-xs text-gray-600 leading-snug"
                        >
                          <Check className="w-3.5 h-3.5 text-[#8B0021] flex-shrink-0 mt-0.5 stroke-[2.5]" />
                          <span>{feature}</span>
                        </div>
                      ))}
                      {tier.features.length > 5 && (
                        <div className="text-[11px] text-[#8B0021] font-medium pt-1">
                          + {tier.features.length - 5} fitur lainnya (lihat detail bawah)
                        </div>
                      )}
                    </div>
                  </div>

                  <div>
                    <motion.a
                      whileHover={{ scale: 1.02 }}
                      whileTap={{ scale: 0.98 }}
                      href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
                        tier.waMessage || `Halo SOLVETA, saya tertarik dengan paket ${tier.name}`
                      )}`}
                      target="_blank"
                      rel="noopener noreferrer"
                      className={`w-full py-2.5 text-xs font-bold rounded-lg flex items-center justify-center transition-all ${
                        tier.buttonVariant === "red" || tier.popular
                          ? "bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white shadow-xs"
                          : "bg-white hover:bg-rose-50/40 text-gray-800 border border-gray-300 hover:border-[#8B0021]/40"
                      }`}
                    >
                      {tier.buttonLabel}
                    </motion.a>
                  </div>
                </div>
              </motion.div>
            );
          })}
        </div>

        {/* DETAILED INFORMATION SECTION WITH MINIMALIST BORDERED LAYOUT */}
        <div className="pt-6 border-t border-gray-200">
          {/* Header of Details Section */}
          <div className="text-center mb-8">
            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 border border-gray-200 text-gray-700 text-xs font-mono mb-2">
              <FileText className="w-3.5 h-3.5 text-[#8B0021]" />
              INFORMASI RINCI & PERBANDINGAN FITUR
            </div>
            <h3 className="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight mb-2">
              Rincian Spesifikasi Lengkap 4 Paket
            </h3>
            <p className="text-xs sm:text-sm text-gray-500 max-w-2xl mx-auto">
              Perbandingan rinci seluruh parameter paket website secara transparan, dipisahkan dengan batas garis tepi minimalis.
            </p>
          </div>

          {/* Desktop & Tablet: Full Minimalist Bordered Table with horizontal overflow on mobile */}
          <div className="border border-gray-200 rounded-xl bg-white shadow-2xs overflow-hidden mb-10">
            <div className="overflow-x-auto">
              <div className="min-w-[680px]">
                {/* Table Header */}
                <div className="grid grid-cols-12 bg-gray-50/80 border-b border-gray-200 text-xs font-bold text-gray-900 sticky top-0 z-10 divide-x divide-gray-200">
                  <div className="col-span-4 p-4 flex items-center text-gray-600 font-mono uppercase tracking-wider text-[11px]">
                    Fitur & Spesifikasi
                  </div>
                  <div className="col-span-2 p-3 text-center">
                    <div className="font-extrabold text-gray-900">BASIC</div>
                    <div className="text-[11px] text-gray-500 font-normal">Rp 299K</div>
                  </div>
                  <div className="col-span-2 p-3 text-center bg-rose-50/50 relative">
                    <span className="absolute top-1 right-2 text-[9px] font-mono font-bold text-[#8B0021] bg-rose-100 px-1.5 py-0.2 rounded">
                      POPULAR
                    </span>
                    <div className="font-extrabold text-[#8B0021]">STANDARD</div>
                    <div className="text-[11px] text-gray-600 font-normal">Rp 549K</div>
                  </div>
                  <div className="col-span-2 p-3 text-center">
                    <div className="font-extrabold text-gray-900">PREMIUM</div>
                    <div className="text-[11px] text-gray-500 font-normal">Rp 749K</div>
                  </div>
                  <div className="col-span-2 p-3 text-center">
                    <div className="font-extrabold text-gray-900">CUSTOM</div>
                    <div className="text-[11px] text-gray-500 font-normal">Mulai 1,5 Jt</div>
                  </div>
                </div>

                {/* Table Categories and Rows */}
                <div className="divide-y divide-gray-200 text-xs">
                  {detailedSpecs.map((category, cIdx) => (
                    <div key={cIdx} className="divide-y divide-gray-100">
                      {/* Category Header Bar */}
                      <div className="bg-gray-100/70 px-4 py-2.5 text-gray-800 font-bold text-[11px] uppercase tracking-wider flex items-center gap-2 border-b border-gray-200">
                        <category.icon className="w-3.5 h-3.5 text-[#8B0021]" />
                        <span>{category.title}</span>
                      </div>

                      {/* Category Rows */}
                      {category.rows.map((row, rIdx) => (
                        <div
                          key={rIdx}
                          className="grid grid-cols-12 divide-x divide-gray-200 hover:bg-gray-50/50 transition-colors items-center text-[12px]"
                        >
                          {/* Feature Name */}
                          <div className="col-span-4 p-3.5 font-medium text-gray-800 flex items-center gap-2">
                            <span>{row.name}</span>
                          </div>

                          {/* Basic */}
                          <div className="col-span-2 p-3 text-center flex items-center justify-center gap-1.5 text-gray-700">
                            {row.basic.status === "check" && (
                              <Check className="w-4 h-4 text-emerald-600 flex-shrink-0 stroke-[2.5]" />
                            )}
                            {row.basic.status === "cross" && (
                              <X className="w-4 h-4 text-rose-500 flex-shrink-0 stroke-[2.5]" />
                            )}
                            <span className="leading-snug">{row.basic.text}</span>
                          </div>

                          {/* Standard (Popular Column) */}
                          <div className="col-span-2 p-3 text-center flex items-center justify-center gap-1.5 text-gray-900 bg-rose-50/20 font-medium">
                            {row.standard.status === "check" && (
                              <Check className="w-4 h-4 text-[#8B0021] flex-shrink-0 stroke-[2.5]" />
                            )}
                            {row.standard.status === "cross" && (
                              <X className="w-4 h-4 text-rose-500 flex-shrink-0 stroke-[2.5]" />
                            )}
                            <span className="leading-snug">{row.standard.text}</span>
                          </div>

                          {/* Premium */}
                          <div className="col-span-2 p-3 text-center flex items-center justify-center gap-1.5 text-gray-700">
                            {row.premium.status === "check" && (
                              <Check className="w-4 h-4 text-emerald-600 flex-shrink-0 stroke-[2.5]" />
                            )}
                            {row.premium.status === "cross" && (
                              <X className="w-4 h-4 text-rose-500 flex-shrink-0 stroke-[2.5]" />
                            )}
                            <span className="leading-snug">{row.premium.text}</span>
                          </div>

                          {/* Custom */}
                          <div className="col-span-2 p-3 text-center flex items-center justify-center gap-1.5 text-gray-700">
                            {row.custom.status === "check" && (
                              <Check className="w-4 h-4 text-emerald-600 flex-shrink-0 stroke-[2.5]" />
                            )}
                            {row.custom.status === "cross" && (
                              <X className="w-4 h-4 text-rose-500 flex-shrink-0 stroke-[2.5]" />
                            )}
                            <span className="leading-snug">{row.custom.text}</span>
                          </div>
                        </div>
                      ))}
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>

          {/* 3 MINIMALIST BORDERED CARDS FOR ADD-ONS & POLICIES */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">
            {/* Card 1: Domain Premium */}
            <div className="border border-gray-200 rounded-xl bg-white p-5 shadow-2xs flex flex-col justify-between">
              <div>
                <div className="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-900 mb-2">
                  <Globe className="w-4 h-4 text-[#8B0021]" />
                  <span>Domain Premium (Tambahan)</span>
                </div>
                <p className="text-[11px] text-gray-500 mb-4 leading-relaxed">
                  Pilihan ekstensi domain premium dengan biaya tambahan untuk paket Basic/Standard:
                </p>

                <div className="border border-gray-200 rounded-lg divide-y divide-gray-100 text-xs">
                  <div className="flex justify-between items-center p-2.5">
                    <span className="font-mono font-medium text-gray-700">.web.id</span>
                    <span className="font-semibold text-gray-900">+Rp 100.000</span>
                  </div>
                  <div className="flex justify-between items-center p-2.5 bg-gray-50/50">
                    <span className="font-mono font-medium text-gray-700">.blog</span>
                    <span className="font-semibold text-gray-900">+Rp 100.000</span>
                  </div>
                  <div className="flex justify-between items-center p-2.5">
                    <span className="font-mono font-medium text-gray-700">.online</span>
                    <span className="font-semibold text-gray-900">+Rp 100.000</span>
                  </div>
                  <div className="flex justify-between items-center p-2.5 bg-gray-50/50">
                    <span className="font-mono font-medium text-gray-700">.com</span>
                    <span className="font-semibold text-[#8B0021]">+Rp 200.000</span>
                  </div>
                  <div className="flex justify-between items-center p-2.5">
                    <span className="font-mono font-medium text-gray-700">.info</span>
                    <span className="font-semibold text-gray-900">+Rp 100.000</span>
                  </div>
                  <div className="flex justify-between items-center p-2.5 bg-gray-50/50">
                    <span className="font-mono font-medium text-gray-700">dll (ekstensi lain)</span>
                    <span className="text-[11px] text-gray-500 font-medium">Menyesuaikan</span>
                  </div>
                </div>
              </div>

              <div className="mt-4 pt-3 border-t border-gray-100 text-[10px] text-gray-500">
                *Domain gratis standar tetap berlaku sesuai paket yang dipilih.
              </div>
            </div>

            {/* Card 2: Layanan Email Bisnis Profesional */}
            <div className="border border-gray-200 rounded-xl bg-white p-5 shadow-2xs flex flex-col justify-between">
              <div>
                <div className="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-900 mb-2">
                  <Mail className="w-4 h-4 text-[#8B0021]" />
                  <span>Layanan Email Bisnis</span>
                </div>
                <p className="text-[11px] text-gray-500 mb-4 leading-relaxed">
                  Email profesional berdomain sendiri (contoh: <code className="text-gray-800 font-mono text-[10px]">info@bisnisanda.com</code>):
                </p>

                <div className="border border-gray-200 rounded-lg divide-y divide-gray-100 text-xs">
                  <div className="flex justify-between items-center p-3">
                    <div>
                      <div className="font-semibold text-gray-900">1 Akun Email Bisnis</div>
                      <div className="text-[10px] text-gray-500">Kapasitas penyimpanan dedicated</div>
                    </div>
                    <span className="font-bold text-gray-900">Rp 50.000</span>
                  </div>
                  <div className="flex justify-between items-center p-3 bg-gray-50/50">
                    <div>
                      <div className="font-semibold text-gray-900">5 Akun Email Bisnis</div>
                      <div className="text-[10px] text-gray-500">Cocok untuk tim operasional</div>
                    </div>
                    <span className="font-bold text-[#8B0021]">Rp 150.000</span>
                  </div>
                  <div className="flex justify-between items-center p-3">
                    <div>
                      <div className="font-semibold text-gray-900">Unlimited Email</div>
                      <div className="text-[10px] text-gray-500">Akses kontrol cPanel penuh</div>
                    </div>
                    <span className="text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200/60">
                      Gratis di Custom
                    </span>
                  </div>
                </div>
              </div>

              <div className="mt-4 pt-3 border-t border-gray-100 text-[10px] text-gray-500">
                *Dapat diakses melalui Webmail, Outlook, Gmail, atau aplikasi Mail smartphone.
              </div>
            </div>

            {/* Card 3: Ketentuan & Tarif Revisi */}
            <div className="border border-gray-200 rounded-xl bg-white p-5 shadow-2xs flex flex-col justify-between">
              <div>
                <div className="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-900 mb-2">
                  <ShieldCheck className="w-4 h-4 text-[#8B0021]" />
                  <span>Tarif & Ketentuan Revisi</span>
                </div>
                <p className="text-[11px] text-gray-500 mb-4 leading-relaxed">
                  Transparansi biaya pengerjaan revisi setelah kuota gratis selesai:
                </p>

                <div className="border border-gray-200 rounded-lg divide-y divide-gray-100 text-xs">
                  <div className="p-3">
                    <div className="flex justify-between items-center mb-1">
                      <span className="font-semibold text-gray-900">Revisi Ringan</span>
                      <span className="font-bold text-gray-900">Rp 30.000</span>
                    </div>
                    <p className="text-[10px] text-gray-500 leading-tight">
                      Ganti logo, icon, warna aksen, penyesuaian teks kecil, link WhatsApp, atau kontak.
                    </p>
                  </div>

                  <div className="p-3 bg-gray-50/50">
                    <div className="flex justify-between items-center mb-1">
                      <span className="font-semibold text-gray-900">Revisi Berat</span>
                      <span className="font-bold text-[#8B0021]">Rp 50.000</span>
                    </div>
                    <p className="text-[10px] text-gray-500 leading-tight">
                      Merubah layout halaman, menambah halaman, atau merombak struktur alur halaman.
                    </p>
                  </div>

                  <div className="p-3">
                    <div className="flex justify-between items-center mb-1">
                      <span className="font-semibold text-gray-900">Penambahan Halaman</span>
                      <span className="font-bold text-gray-900">Rp 50.000 <span className="text-[10px] font-normal text-gray-500">/halaman</span></span>
                    </div>
                    <p className="text-[10px] text-gray-500 leading-tight">
                      Biaya desain & pembuatan halaman tambahan di luar batas paket awal.
                    </p>
                  </div>
                </div>
              </div>

              <div className="mt-4 pt-3 border-t border-gray-100 text-[10px] text-gray-500">
                *Revisi tidak merubah tema/konsep dasar yang sudah disetujui saat brief awal.
              </div>
            </div>
          </div>

          {/* Bottom Disclaimer and Assurance Box with Clean Minimalist Border */}
          <div className="border border-gray-200 rounded-xl bg-gray-50/70 p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-gray-600">
            <div className="flex items-start gap-3">
              <Info className="w-5 h-5 text-[#8B0021] flex-shrink-0 mt-0.5" />
              <div>
                <strong className="text-gray-900 font-semibold block mb-0.5">
                  Ketentuan Transparansi Layanan SOLVETA:
                </strong>
                <p className="text-[11px] leading-relaxed text-gray-500">
                  Semua paket website sudah mencakup sertifikat keamanan SSL, konfigurasi DNS domain, setup server hosting, dan jaminan perbaikan bug sistem (Full Garansi). Biaya perpanjangan tahun berikutnya hanya untuk memperpanjang domain dan sewa server hosting aktif.
                </p>
              </div>
            </div>

            <motion.a
              whileHover={{ scale: 1.03 }}
              whileTap={{ scale: 0.98 }}
              href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
                "Halo SOLVETA, saya ingin konsultasi paket website yang paling tepat untuk bisnis saya."
              )}`}
              target="_blank"
              rel="noopener noreferrer"
              className="flex-shrink-0 px-4 py-2.5 bg-gray-900 hover:bg-black text-white text-xs font-bold rounded-lg transition-all flex items-center gap-2 shadow-2xs"
            >
              <span>Konsultasi Gratis via WhatsApp</span>
              <span>→</span>
            </motion.a>
          </div>
        </div>
      </div>
    </section>
  );
};
