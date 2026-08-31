"use client";

import React from "react";
import { motion } from "framer-motion";
import { ArrowRight, ArrowDown, MessageCircle, Sparkles } from "lucide-react";
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
    const target =
      document.getElementById("pricing") ||
      document.getElementById("portfolio") ||
      document.getElementById("services");
    if (target) {
      target.scrollIntoView({ behavior: "smooth" });
    }
  };

  return (
    <section id="hero" className="pt-24 pb-16 text-center relative overflow-hidden bg-[#FDFBF9]">
      {/* ========================================================================= */}
      {/* 1. PLANET EARTH ATMOSPHERIC CURVATURE & HORIZON GLOW (BEHIND HERO & LAPTOP) */}
      {/* ========================================================================= */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none -z-10 flex items-center justify-center">
        {/* Subtle Starfield & Ambient Constellation Grid */}
        <div className="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:28px_28px] opacity-35" />

        {/* Top Sunlight / Aurora Flare */}
        <div className="absolute top-0 left-1/2 -translate-x-1/2 w-[850px] h-[360px] bg-gradient-to-b from-rose-100/50 via-red-50/25 to-transparent blur-[100px] rounded-full" />

        {/* GIGANTIC PLANET EARTH SPHERE CURVATURE ARC */}
        <div className="absolute top-[32%] sm:top-[34%] left-1/2 -translate-x-1/2 w-[1300px] sm:w-[1600px] lg:w-[1950px] aspect-square rounded-full border border-sky-400/25 shadow-[0_0_90px_rgba(56,189,248,0.25)] pointer-events-none">
          {/* Earth Atmosphere Outer Aura Radiant Glow */}
          <div className="absolute inset-0 rounded-full bg-gradient-to-b from-sky-400/20 via-rose-500/12 to-transparent blur-[65px]" />

          {/* Earth Horizon Razor Edge Ring Glow (Atmospheric Scattering) */}
          <div className="absolute top-0 left-0 right-0 h-[3.5px] bg-gradient-to-r from-transparent via-sky-300 via-50% via-rose-400 to-transparent shadow-[0_0_40px_rgba(56,189,248,0.85),0_0_80px_rgba(244,63,94,0.5)]" />

          {/* Inner Celestial Earth Surface Lighting */}
          <div className="absolute inset-0 rounded-full bg-gradient-to-b from-sky-100/40 via-rose-50/20 to-transparent shadow-inner" />

          {/* Earth Grid Longitude & Latitude Curved Vector Lines */}
          <svg
            className="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[650px] opacity-30"
            viewBox="0 0 1200 650"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            {/* Latitude arcs */}
            <ellipse cx="600" cy="50" rx="580" ry="120" stroke="url(#earthHeroGrid)" strokeWidth="1" strokeDasharray="4 6" />
            <ellipse cx="600" cy="180" rx="550" ry="180" stroke="url(#earthHeroGrid)" strokeWidth="1" strokeDasharray="6 8" />
            <ellipse cx="600" cy="340" rx="500" ry="240" stroke="url(#earthHeroGrid)" strokeWidth="1" strokeDasharray="5 7" />

            {/* Longitude lines */}
            <path d="M 600 0 C 600 200, 600 420, 600 650" stroke="url(#earthHeroGrid)" strokeWidth="1" strokeDasharray="4 6" />
            <path d="M 400 0 C 460 200, 480 420, 500 650" stroke="url(#earthHeroGrid)" strokeWidth="1" strokeDasharray="4 6" />
            <path d="M 800 0 C 740 200, 720 420, 700 650" stroke="url(#earthHeroGrid)" strokeWidth="1" strokeDasharray="4 6" />
            <path d="M 220 0 C 320 200, 360 420, 400 650" stroke="url(#earthHeroGrid)" strokeWidth="1" strokeDasharray="4 6" />
            <path d="M 980 0 C 880 200, 840 420, 800 650" stroke="url(#earthHeroGrid)" strokeWidth="1" strokeDasharray="4 6" />

            <defs>
              <linearGradient id="earthHeroGrid" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stopColor="#38bdf8" stopOpacity="0" />
                <stop offset="25%" stopColor="#38bdf8" stopOpacity="0.5" />
                <stop offset="50%" stopColor="#f43f5e" stopOpacity="0.7" />
                <stop offset="75%" stopColor="#38bdf8" stopOpacity="0.5" />
                <stop offset="100%" stopColor="#38bdf8" stopOpacity="0" />
              </linearGradient>
            </defs>
          </svg>
        </div>

        {/* Seamless Smooth Bottom Light Blend */}
        <div className="absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-t from-[#FDFBF9] via-[#FDFBF9]/80 to-transparent pointer-events-none" />
      </div>

      {/* ========================================================================= */}
      {/* 2. HERO CONTENT CONTAINER (PRESERVED 100% WITH ENHANCED CONTRAST) */}
      {/* ========================================================================= */}
      <div className="max-w-[1160px] mx-auto px-6 relative z-10">
        {/* Eyebrow Pill */}
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5, ease: [0.16, 1, 0.3, 1] }}
          className="inline-block"
        >
          <span className="inline-flex items-center gap-1.5 font-mono text-[11px] font-bold uppercase tracking-wider text-[#7B0B1E] bg-white/95 backdrop-blur-md border border-rose-100 px-4 py-1.5 rounded-full mb-6 shadow-2xs">
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
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white/95 backdrop-blur-md hover:bg-rose-50/40 border border-gray-300 hover:border-[#8B0021]/50 text-gray-800 hover:text-[#7B0B1E] text-sm font-bold rounded-xl shadow-2xs hover:shadow-xs transition-all duration-300 cursor-pointer"
          >
            <span>Pelajari Selengkapnya</span>
            <ArrowDown className="w-4 h-4 text-gray-400 group-hover:text-[#7B0B1E] animate-bounce" />
          </motion.button>
        </motion.div>

        {/* 3D Animated Laptop Mockup (Facing Forward with Solveta Ecosystem) */}
        <LaptopMockup3D />
      </div>
    </section>
  );
};
