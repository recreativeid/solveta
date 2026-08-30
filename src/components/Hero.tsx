"use client";

import React from "react";
import { motion } from "framer-motion";
import { ArrowRight, ArrowDown, MessageCircle } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";
import { LaptopMockup3D } from "@/components/LaptopMockup3D";

export const Hero: React.FC = () => {
  const { data } = useSiteData();

  const handleOrderWhatsApp = () => {
    const waText = encodeURIComponent(
      "Halo SOLVETA, saya ingin memesan pembuatan website / konsultasi solusi digital untuk bisnis saya."
    );
    window.open(`https://wa.me/${data.contact.whatsappNumber}?text=${waText}`, "_blank");
  };

  const handleScrollToDetails = () => {
    const target = document.getElementById("problems") || document.getElementById("services") || document.getElementById("portfolio");
    if (target) {
      target.scrollIntoView({ behavior: "smooth" });
    }
  };

  return (
    <section id="hero" className="pt-24 pb-16 text-center relative overflow-hidden bg-white">
      {/* Background ambient lighting in premium maroon glow */}
      <div className="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[650px] h-[320px] bg-gradient-to-br from-red-100/50 via-rose-50/40 to-transparent rounded-full blur-[110px] pointer-events-none -z-10" />

      <div className="max-w-[1160px] mx-auto px-6">
        {/* Eyebrow Pill */}
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5, ease: [0.16, 1, 0.3, 1] }}
          className="inline-block"
        >
          <span className="inline-flex items-center gap-1.5 font-mono text-[11px] font-bold uppercase tracking-wider text-[#7B0B1E] bg-rose-50/80 border border-rose-100 px-4 py-1.5 rounded-full mb-6 shadow-2xs">
            <span className="w-1.5 h-1.5 rounded-full bg-[#8B0021] animate-pulse" />
            {data.siteCopy.heroEyebrow}
          </span>
        </motion.div>

        {/* Main Headline */}
        <motion.h1
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.1, ease: [0.16, 1, 0.3, 1] }}
          className="text-4xl sm:text-5xl md:text-[3.35rem] font-extrabold text-gray-950 tracking-tight leading-[1.18] mb-5 whitespace-pre-line"
        >
          {data.siteCopy.heroHeadline}
        </motion.h1>

        {/* Narrative Subtitle */}
        <motion.p
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.2, ease: [0.16, 1, 0.3, 1] }}
          className="max-w-[740px] mx-auto text-sm sm:text-base text-gray-600 leading-relaxed mb-10 whitespace-pre-line"
        >
          {data.siteCopy.heroSubtitle}
        </motion.p>

        {/* Action Buttons: "Pesan Sekarang" & "Pelajari Selengkapnya" */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.3, ease: [0.16, 1, 0.3, 1] }}
          className="flex flex-col sm:flex-row items-center justify-center gap-3.5 max-w-md mx-auto"
        >
          {/* 1. Tombol Pesan Sekarang (Merah Maroon Premium Gradasi) */}
          <motion.button
            whileHover={{ scale: 1.04, y: -2 }}
            whileTap={{ scale: 0.97 }}
            onClick={handleOrderWhatsApp}
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:via-[#85001D] hover:to-[#5E0013] text-white text-sm font-bold rounded-xl shadow-md hover:shadow-xl transition-all duration-300 group cursor-pointer"
          >
            <MessageCircle className="w-4 h-4 text-rose-200 group-hover:scale-110 transition-transform" />
            <span>Pesan Sekarang</span>
            <ArrowRight className="w-4 h-4 text-rose-200 group-hover:translate-x-1 transition-transform" />
          </motion.button>

          {/* 2. Tombol Pelajari Selengkapnya (Scroll ke Bagian Bawah) */}
          <motion.button
            whileHover={{ scale: 1.03, y: -1 }}
            whileTap={{ scale: 0.98 }}
            onClick={handleScrollToDetails}
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white hover:bg-rose-50/40 border border-gray-300 hover:border-[#8B0021]/50 text-gray-800 hover:text-[#7B0B1E] text-sm font-bold rounded-xl shadow-2xs hover:shadow-xs transition-all duration-300 cursor-pointer"
          >
            <span>Pelajari Selengkapnya</span>
            <ArrowDown className="w-4 h-4 text-gray-400 group-hover:text-[#7B0B1E] animate-bounce" />
          </motion.button>
        </motion.div>

        {/* 3D Animated Laptop Mockup (Facing Forward with Developer Code View & Live Preview) */}
        <LaptopMockup3D />
      </div>
    </section>
  );
};
