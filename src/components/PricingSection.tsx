"use client";

import React, { useState, useRef } from "react";
import { motion, useInView } from "framer-motion";
import {
  Check,
  X,
  Globe,
  Mail,
  ShieldCheck,
  Sparkles,
  ArrowRight,
  MessageCircle,
  Info,
} from "lucide-react";
import { useSiteData, ChecklistItemData } from "@/context/SiteDataContext";

export const PricingSection: React.FC = () => {
  const { data } = useSiteData();
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });

  const [selectedFilter, setSelectedFilter] = useState<string>("all");

  const packages = data.pricing.map((tier) => {
    const checklist: ChecklistItemData[] =
      tier.checklist && tier.checklist.length > 0
        ? tier.checklist
        : (tier.features || []).map((f) => ({
            text: f.replace(/^[✔❌\s]+/, "").trim(),
            included: !f.toLowerCase().includes("tidak termasuk") && !f.startsWith("❌"),
          }));

    const priceBadge =
      tier.priceBadge || tier.price.replace(/Rp\s*/i, "").trim();

    return {
      id: tier.id,
      name: tier.name,
      priceBadge,
      pricePrefix: tier.pricePrefix,
      popular: tier.popular,
      popularLabel: tier.popularLabel || (tier.popular ? "PALING DIMINATI" : undefined),
      activePeriod: tier.activePeriod || "1 Tahun",
      renewalPrice: tier.renewalPrice || "249k/tahun*",
      suitability: tier.suitability,
      deliveryTime: tier.deliveryTime || "3–5 Hari",
      buttonLabel: tier.buttonLabel || `Pesan Paket ${tier.name}`,
      waMessage:
        tier.waMessage ||
        `Halo SOLVETA, saya tertarik untuk memesan Paket ${tier.name} ${tier.price}.`,
      checklist,
      domainAddons: tier.domainAddons,
      emailAddons: tier.emailAddons,
      revisionRules: tier.revisionRules || {
        light: "Rp 30.000 (ganti logo, icon, warna, teks kecil, dsb)",
        heavy: "Rp 50.000 (merubah halaman, menambah halaman, atau struktur)",
        extraPage: "Rp 50.000 / halaman",
      },
      customNote: tier.customNote,
    };
  });

  const displayedPackages =
    selectedFilter === "all"
      ? packages
      : packages.filter((pkg) => pkg.id === selectedFilter);

  return (
    <section id="pricing" className="py-16 sm:py-24 bg-slate-50/60 dark:bg-[#090A12] border-t border-gray-100 dark:border-gray-800 transition-colors duration-200">
      <div className="max-w-[1140px] mx-auto px-4 sm:px-6">
        {/* Section Header */}
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 15 }}
          transition={{ duration: 0.5 }}
          className="text-center mb-10"
        >
          <span className="inline-block text-[11px] font-mono font-bold tracking-widest text-[#8B0021] dark:text-rose-400 bg-rose-50 dark:bg-rose-950/60 border border-rose-200/70 dark:border-rose-800/60 px-3.5 py-1 rounded-full uppercase mb-3">
            PILIHAN PAKET &amp; RINCIAN LENGKAP
          </span>
          <h2 className="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-950 dark:text-white tracking-tight mb-3 uppercase">
            INFORMASI RINCI SETIAP PAKET
          </h2>
          <p className="text-xs sm:text-sm text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
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
                : "bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-850"
            }`}
          >
            Semua 4 Paket (Berurutan)
          </button>
          {packages.map((pkg) => (
            <button
              key={pkg.id}
              onClick={() => setSelectedFilter(pkg.id)}
              className={`px-4 py-1.5 rounded-full text-xs font-semibold transition-all border ${
                selectedFilter === pkg.id
                  ? "bg-[#8B0021] text-white border-[#8B0021] shadow-xs"
                  : "bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-850"
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
                className={`bg-white dark:bg-[#11121B] rounded-2xl transition-all duration-300 overflow-hidden shadow-2xs ${
                  isPopular
                    ? "border-2 border-[#8B0021] dark:border-rose-600 shadow-md shadow-rose-950/5 dark:shadow-rose-950/20"
                    : "border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-700 hover:shadow-xs"
                }`}
              >
                {/* Popular Banner */}
                {isPopular && (
                  <div className="bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] text-white text-center font-mono text-[11px] font-bold uppercase tracking-widest py-1.5 px-4 flex items-center justify-center gap-2">
                    <Sparkles className="w-3.5 h-3.5 text-amber-300" />
                    <span>PAKET PALING DIREKOMENDASIKAN (POPULAR)</span>
                    <Sparkles className="w-3.5 h-3.5 text-amber-300" />
                  </div>
                )}

                {/* Main Card Body (2 Columns Layout) */}
                <div className="p-6 sm:p-8 lg:p-10">
                  <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                    {/* LEFT COLUMN: Price Pill, Masa Aktif Box, Cocok Untuk Box, CTA Button */}
                    <div className="lg:col-span-5 flex flex-col justify-between space-y-4">
                      {/* Top Script Label + Large Price Badge */}
                      <div className="border border-gray-200 dark:border-gray-800 rounded-2xl p-5 bg-gradient-to-b from-gray-50/80 dark:from-gray-900/60 to-white dark:to-gray-900 text-center relative shadow-2xs">
                        <div className="text-[11px] font-mono font-bold tracking-widest text-[#8B0021] dark:text-rose-400 uppercase mb-1">
                          PAKET WEBSITE
                        </div>

                        {pkg.pricePrefix && (
                          <div className="text-xs font-medium text-gray-500 dark:text-gray-400 mb-0.5">
                            {pkg.pricePrefix}
                          </div>
                        )}

                        <div className="text-xs font-extrabold uppercase tracking-widest text-gray-700 dark:text-gray-300 mb-1">
                          {pkg.name}
                        </div>

                        <div className="text-4xl sm:text-5xl font-black text-gray-950 dark:text-white tracking-tight">
                          {pkg.priceBadge}
                        </div>
                      </div>

                      {/* Box 1: Masa Aktif & Perpanjangan */}
                      <div className="border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-white dark:bg-gray-900 shadow-2xs">
                        <div className="flex items-center gap-2 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">
                          <span className="text-base">⏳</span>
                          <span>Masa aktif {pkg.activePeriod},</span>
                        </div>
                        <div className="text-xs text-gray-500 dark:text-gray-400">
                          Perpanjangan :{" "}
                          <span className="text-base sm:text-lg font-bold text-gray-900 dark:text-white ml-1">
                            {pkg.renewalPrice}
                          </span>
                        </div>
                      </div>

                      {/* Box 2: Cocok Untuk & Waktu Pengerjaan */}
                      <div className="border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-white dark:bg-gray-900 shadow-2xs">
                        <div className="text-xs text-gray-600 dark:text-gray-300 mb-1.5 leading-snug">
                          Cocok untuk <strong className="text-gray-900 dark:text-white font-semibold">{pkg.suitability}</strong>
                        </div>
                        <div className="text-xs font-bold text-[#8B0021] dark:text-rose-400 flex items-center gap-1.5 pt-1.5 border-t border-gray-100 dark:border-gray-800">
                          <span>⚡ Pengerjaan {pkg.deliveryTime}</span>
                        </div>
                      </div>

                      {/* Action CTA Button */}
                      <motion.a
                        whileHover={{ scale: 1.02 }}
                        whileTap={{ scale: 0.98 }}
                        href={`https://wa.me/${data.contact?.whatsappNumber || "6285719663154"}?text=${encodeURIComponent(
                          pkg.waMessage
                        )}`}
                        target="_blank"
                        rel="noopener noreferrer"
                        className={`w-full py-3.5 px-5 text-xs sm:text-sm font-bold rounded-xl flex items-center justify-center gap-2 transition-all shadow-xs ${
                          isPopular
                            ? "bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white"
                            : "bg-gray-950 dark:bg-white hover:bg-black dark:hover:bg-gray-100 text-white dark:text-gray-950 hover:shadow-sm"
                        }`}
                      >
                        <MessageCircle className="w-4 h-4" />
                        <span>{pkg.buttonLabel}</span>
                      </motion.a>
                    </div>

                    {/* RIGHT COLUMN: Feature Checklist */}
                    <div className="lg:col-span-7 flex flex-col justify-between">
                      <div>
                        <div className="flex items-center justify-between pb-3 mb-4 border-b border-gray-100 dark:border-gray-800">
                          <span className="text-xs font-mono font-bold tracking-wider text-gray-500 dark:text-gray-400 uppercase">
                            Spesifikasi &amp; Fitur Termasuk
                          </span>
                          <span className="text-[11px] text-gray-400 dark:text-gray-500 font-mono">
                            {pkg.checklist.filter((c) => c.included).length} Fitur Aktif
                          </span>
                        </div>

                        {/* Checklist items list */}
                        <div className="border border-gray-200 dark:border-gray-800 rounded-xl divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-gray-900 overflow-hidden">
                          {pkg.checklist.map((item, cIndex) => (
                            <div
                              key={cIndex}
                              className={`p-3 sm:p-3.5 flex items-start gap-3 text-xs sm:text-sm transition-colors ${
                                item.included
                                  ? "text-gray-800 dark:text-gray-200 hover:bg-gray-50/50 dark:hover:bg-gray-850"
                                  : "text-gray-400 dark:text-gray-600 bg-gray-50/30 dark:bg-gray-950/40 line-through decoration-gray-300 dark:decoration-gray-700"
                              }`}
                            >
                              {item.included ? (
                                <div className="w-5 h-5 rounded flex items-center justify-center bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-400 flex-shrink-0 mt-0.5 border border-emerald-200/80 dark:border-emerald-800">
                                  <Check className="w-3.5 h-3.5 stroke-[3]" />
                                </div>
                              ) : (
                                <div className="w-5 h-5 rounded flex items-center justify-center bg-rose-50 dark:bg-rose-950/80 text-rose-500 dark:text-rose-400 flex-shrink-0 mt-0.5 border border-rose-200/60 dark:border-rose-800">
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

                {/* BOTTOM SUB-SECTION: Add-ons & Revisi Info */}
                <div className="border-t border-gray-200 dark:border-gray-800 bg-gray-50/60 dark:bg-gray-950/50 p-6 sm:p-8">
                  <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    {/* Sub-Card 1: Domain Premium */}
                    {pkg.domainAddons && pkg.domainAddons.length > 0 ? (
                      <div className="border border-gray-200 dark:border-gray-800 rounded-xl bg-white dark:bg-gray-900 p-4 text-xs">
                        <div className="flex items-center gap-1.5 font-bold text-gray-900 dark:text-white uppercase tracking-wider text-[11px] mb-2">
                          <Globe className="w-3.5 h-3.5 text-[#8B0021] dark:text-rose-400" />
                          <span>Domain Premium (Biaya Tambahan):</span>
                        </div>
                        <div className="grid grid-cols-2 gap-x-2 gap-y-1.5 text-[11px] text-gray-600 dark:text-gray-400">
                          {pkg.domainAddons.map((dom, dIdx) => (
                            <div key={dIdx} className="flex justify-between items-center py-0.5 border-b border-gray-50 dark:border-gray-800">
                              <span className="font-mono text-gray-700 dark:text-gray-300">{dom.name}</span>
                              <span className="font-semibold text-gray-900 dark:text-white">{dom.price}</span>
                            </div>
                          ))}
                        </div>
                      </div>
                    ) : (
                      <div className="border border-gray-200 dark:border-gray-800 rounded-xl bg-white dark:bg-gray-900 p-4 text-xs flex flex-col justify-between">
                        <div>
                          <div className="flex items-center gap-1.5 font-bold text-gray-900 dark:text-white uppercase tracking-wider text-[11px] mb-2">
                            <Globe className="w-3.5 h-3.5 text-[#8B0021] dark:text-rose-400" />
                            <span>Domain &amp; Server Hosting:</span>
                          </div>
                          <p className="text-[11px] text-gray-500 dark:text-gray-400 leading-relaxed mb-2">
                            Sudah termasuk sewa domain standar (.com, .net, .org) &amp; hosting server berkecepatan tinggi selama 1 tahun pertama.
                          </p>
                        </div>
                        <div className="text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200/60 dark:border-emerald-800 px-2 py-1 rounded">
                          ✓ Siap online langsung tanpa biaya setup tambahan
                        </div>
                      </div>
                    )}

                    {/* Sub-Card 2: Layanan Email Profesional */}
                    {pkg.emailAddons && pkg.emailAddons.length > 0 ? (
                      <div className="border border-gray-200 dark:border-gray-800 rounded-xl bg-white dark:bg-gray-900 p-4 text-xs">
                        <div className="flex items-center gap-1.5 font-bold text-gray-900 dark:text-white uppercase tracking-wider text-[11px] mb-2">
                          <Mail className="w-3.5 h-3.5 text-[#8B0021] dark:text-rose-400" />
                          <span>Layanan Email Profesional:</span>
                        </div>
                        <div className="space-y-2 text-[11px]">
                          {pkg.emailAddons.map((em, eIdx) => (
                            <div key={eIdx} className="flex justify-between items-center p-2 rounded bg-gray-50 dark:bg-gray-800/60 border border-gray-100 dark:border-gray-800">
                              <span className="text-gray-700 dark:text-gray-300 font-medium">{em.name}</span>
                              <span className="font-bold text-gray-900 dark:text-white">{em.price}</span>
                            </div>
                          ))}
                        </div>
                      </div>
                    ) : (
                      <div className="border border-gray-200 dark:border-gray-800 rounded-xl bg-white dark:bg-gray-900 p-4 text-xs flex flex-col justify-between">
                        <div>
                          <div className="flex items-center gap-1.5 font-bold text-gray-900 dark:text-white uppercase tracking-wider text-[11px] mb-2">
                            <Mail className="w-3.5 h-3.5 text-[#8B0021] dark:text-rose-400" />
                            <span>Alokasi Email Bisnis:</span>
                          </div>
                          <p className="text-[11px] text-gray-500 dark:text-gray-400 leading-relaxed">
                            {pkg.id === "standard" && "Termasuk 1 akun email bisnis (nama@domain.com) dengan webmail & setup SMTP."}
                            {pkg.id === "premium" && "Termasuk 2 akun email bisnis (nama@domain.com) terkonfigurasi penuh."}
                            {pkg.id === "custom" && "Unlimited akun email bisnis dengan hak akses cPanel penuh."}
                          </p>
                        </div>
                        <div className="text-[10px] text-gray-500 dark:text-gray-400 pt-2 border-t border-gray-100 dark:border-gray-800">
                          *Email tambahan dapat ditambahkan kapan saja (+Rp 50.000/email).
                        </div>
                      </div>
                    )}

                    {/* Sub-Card 3: Tarif Revisi & Ketentuan */}
                    <div className="border border-gray-200 dark:border-gray-800 rounded-xl bg-white dark:bg-gray-900 p-4 text-xs md:col-span-2 lg:col-span-1">
                      <div className="flex items-center gap-1.5 font-bold text-gray-900 dark:text-white uppercase tracking-wider text-[11px] mb-2">
                        <ShieldCheck className="w-3.5 h-3.5 text-[#8B0021] dark:text-rose-400" />
                        <span>Tarif &amp; Ketentuan Revisi:</span>
                      </div>
                      <div className="space-y-1.5 text-[11px] text-gray-600 dark:text-gray-400">
                        <div className="flex items-start gap-1">
                          <span className="text-gray-400">•</span>
                          <div>
                            <strong className="text-gray-800 dark:text-gray-200">Revisi Ringan:</strong> {pkg.revisionRules.light}
                          </div>
                        </div>
                        <div className="flex items-start gap-1">
                          <span className="text-gray-400">•</span>
                          <div>
                            <strong className="text-gray-800 dark:text-gray-200">Revisi Berat:</strong> {pkg.revisionRules.heavy}
                          </div>
                        </div>
                        {pkg.revisionRules.extraPage && (
                          <div className="flex items-start gap-1">
                            <span className="text-gray-400">•</span>
                            <div>
                              <strong className="text-gray-800 dark:text-gray-200">Tambah Halaman:</strong> {pkg.revisionRules.extraPage}
                            </div>
                          </div>
                        )}
                        {pkg.customNote && (
                          <div className="text-[10px] text-[#8B0021] dark:text-rose-400 font-semibold pt-1 border-t border-gray-100 dark:border-gray-800">
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
        <div className="mt-12 border border-gray-200 dark:border-gray-800 rounded-2xl bg-white dark:bg-gray-900 p-5 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-gray-600 dark:text-gray-400 shadow-2xs">
          <div className="flex items-start gap-3">
            <Info className="w-5 h-5 text-[#8B0021] dark:text-rose-400 flex-shrink-0 mt-0.5" />
            <div>
              <strong className="text-gray-900 dark:text-white font-semibold block mb-0.5">
                Garansi Penuh &amp; Ketentuan Transparansi SOLVETA:
              </strong>
              <p className="text-[11px] leading-relaxed text-gray-500 dark:text-gray-400">
                *Biaya perpanjangan tahun berikutnya digunakan untuk sewa domain &amp; hosting aktif. Semua paket website mendapatkan garansi pemeliharaan perbaikan error secara cuma-cuma.
              </p>
            </div>
          </div>

          <motion.a
            whileHover={{ scale: 1.03 }}
            whileTap={{ scale: 0.98 }}
            href={`https://wa.me/${data.contact?.whatsappNumber || "6285719663154"}?text=${encodeURIComponent(
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
