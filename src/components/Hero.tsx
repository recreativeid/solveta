"use client";

import React from "react";
import { motion } from "framer-motion";
import { ArrowRight, ArrowDown, MessageCircle, Sparkles } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";
import { useTheme } from "@/context/ThemeContext";
import { LaptopMockup3D } from "@/components/LaptopMockup3D";
import { getWhatsAppUrl } from "@/utils/whatsapp";

export const Hero: React.FC = () => {
  const { data } = useSiteData();
  const { theme } = useTheme();
  const isDark = theme === "dark";

  const handleOrderWhatsApp = () => {
    const url = getWhatsAppUrl(
      data.contact?.whatsappNumber,
      "Halo SOLVETA, saya ingin memesan pembuatan website / konsultasi solusi digital untuk bisnis saya."
    );
    window.open(url, "_blank", "noopener,noreferrer");
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
    <section
      id="hero"
      className="pt-24 pb-20 text-center relative overflow-hidden bg-white dark:bg-[#07080E] text-gray-900 dark:text-white transition-colors duration-300 select-none"
    >
      {/* ========================================================================= */}
      {/* 1. PLANET EARTH HORIZON CURVATURE (CLEAN WHITE BASE IN LIGHT MODE) */}
      {/* ========================================================================= */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none -z-0 flex items-center justify-center">
        {/* Subtle Constellation Starfield & Grid */}
        <div className="absolute inset-0 bg-[radial-gradient(#94a3b8_1px,transparent_1px)] dark:bg-[radial-gradient(white_1px,transparent_1px)] [background-size:28px_28px] opacity-20 dark:opacity-20" />

        {/* Ambient Top Light Beam */}
        <div className="absolute -top-28 left-1/2 -translate-x-1/2 w-[850px] h-[400px] bg-gradient-to-b from-sky-100/30 dark:from-rose-600/20 via-sky-50/15 dark:via-sky-600/15 to-transparent blur-[110px] rounded-full pointer-events-none" />

        {/* SOLAR SUNRISE FLARE ON THE HORIZON (LOWERED BELOW BUTTONS) */}
        <div className="absolute top-[48%] sm:top-[46%] left-1/2 -translate-x-1/2 w-[420px] sm:w-[620px] h-[150px] bg-gradient-to-b from-sky-400/35 dark:from-sky-300/40 via-sky-200/15 to-transparent blur-[45px] rounded-full pointer-events-none" />
        <div className="absolute top-[49%] sm:top-[47%] left-1/2 -translate-x-1/2 w-[200px] sm:w-[280px] h-[55px] bg-white/90 dark:bg-white/60 blur-[24px] rounded-full pointer-events-none" />

        {/* GIGANTIC PROMINENT EARTH HORIZON ARC */}
        <div className="absolute top-[48%] sm:top-[46%] left-1/2 -translate-x-1/2 w-[1450px] sm:w-[1750px] lg:w-[2150px] aspect-square rounded-full border-t-[3.5px] border-sky-400 dark:border-sky-300 shadow-[0_-12px_65px_rgba(14,165,233,0.35)] dark:shadow-[0_-15px_80px_rgba(56,189,248,0.7),0_-40px_160px_rgba(244,63,94,0.4)] pointer-events-none overflow-hidden">
          {/* Glowing Earth Horizon Atmospheric Ring */}
          <div className="absolute top-0 left-0 right-0 h-44 bg-gradient-to-b from-sky-400/30 dark:from-sky-400/40 via-sky-300/10 to-transparent blur-md" />
          <div className="absolute top-0 left-0 right-0 h-80 bg-gradient-to-b from-sky-400/10 dark:from-rose-500/25 via-blue-800/10 dark:via-blue-900/30 to-transparent blur-2xl" />

          {/* Earth Body Spherical Gradient: Pure Clean White Base */}
          <div className="absolute inset-0 bg-gradient-to-b from-sky-50/30 dark:from-[#0b172a] via-white dark:via-[#070b14] to-white dark:to-[#04060a]" />

          {/* Earth Continents & Ocean Texture Curved Longitude/Latitude Arcs */}
          <div className="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[800px] opacity-35 dark:opacity-40">
            <svg
              className="w-full h-full"
              viewBox="0 0 1400 800"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              {/* Latitude Rings */}
              <ellipse cx="700" cy="40" rx="680" ry="110" stroke="url(#earthHeroNeonLight)" strokeWidth="1.5" strokeDasharray="6 8" />
              <ellipse cx="700" cy="160" rx="640" ry="160" stroke="url(#earthHeroNeonLight)" strokeWidth="1.2" strokeDasharray="5 7" />
              <ellipse cx="700" cy="300" rx="580" ry="210" stroke="url(#earthHeroNeonLight)" strokeWidth="1" strokeDasharray="4 6" />
              <ellipse cx="700" cy="460" rx="500" ry="260" stroke="url(#earthHeroNeonLight)" strokeWidth="1" strokeDasharray="4 6" />

              {/* Longitude Curved Lines */}
              <path d="M 700 0 C 700 250, 700 550, 700 800" stroke="url(#earthHeroNeonLight)" strokeWidth="1.5" strokeDasharray="5 7" />
              <path d="M 480 0 C 540 250, 560 550, 600 800" stroke="url(#earthHeroNeonLight)" strokeWidth="1.2" strokeDasharray="5 7" />
              <path d="M 920 0 C 860 250, 840 550, 800 800" stroke="url(#earthHeroNeonLight)" strokeWidth="1.2" strokeDasharray="5 7" />
              <path d="M 280 0 C 390 250, 430 550, 500 800" stroke="url(#earthHeroNeonLight)" strokeWidth="1" strokeDasharray="4 6" />
              <path d="M 1120 0 C 1010 250, 970 550, 900 800" stroke="url(#earthHeroNeonLight)" strokeWidth="1" strokeDasharray="4 6" />

              {/* Glowing Coordinate Intersections */}
              <circle cx="700" cy="40" r="3.5" fill="#0284c7" className="animate-ping" />
              <circle cx="480" cy="40" r="3" fill="#0284c7" />
              <circle cx="920" cy="40" r="3" fill="#0284c7" />
              <circle cx="700" cy="160" r="3" fill="#0284c7" />
              <circle cx="540" cy="160" r="3" fill="#0284c7" />
              <circle cx="860" cy="160" r="3" fill="#0284c7" />

              <defs>
                <linearGradient id="earthHeroNeonLight" x1="0%" y1="0%" x2="100%" y2="0%">
                  <stop offset="0%" stopColor="#0284c7" stopOpacity="0" />
                  <stop offset="20%" stopColor="#0284c7" stopOpacity="0.7" />
                  <stop offset="50%" stopColor="#0284c7" stopOpacity="0.8" />
                  <stop offset="80%" stopColor="#0284c7" stopOpacity="0.7" />
                  <stop offset="100%" stopColor="#0284c7" stopOpacity="0" />
                </linearGradient>
              </defs>
            </svg>
          </div>
        </div>

        {/* Smooth Bottom Horizon Blend */}
        <div className="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-white dark:from-[#07080E] via-white/80 dark:via-[#07080E]/60 to-transparent pointer-events-none z-10" />
      </div>

      {/* ========================================================================= */}
      {/* 2. HERO CONTENT CONTAINER (CLEAN & LEGIBLE WITH PLENTY OF BREATHING ROOM) */}
      {/* ========================================================================= */}
      <div className="max-w-[1160px] mx-auto px-6 relative z-20">
        {/* Eyebrow Pill */}
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5, ease: [0.16, 1, 0.3, 1] }}
          className="inline-block"
        >
          <span className="inline-flex items-center gap-1.5 font-mono text-[11px] font-bold uppercase tracking-wider text-[#7B0B1E] dark:text-rose-300 bg-rose-50/90 dark:bg-rose-950/60 backdrop-blur-md border border-rose-200/80 dark:border-rose-500/30 px-4 py-1.5 rounded-full mb-6 shadow-2xs">
            <span className="w-1.5 h-1.5 rounded-full bg-[#8B0021] dark:bg-rose-400 animate-pulse" />
            {data.siteCopy.heroEyebrow}
          </span>
        </motion.div>

        {/* Main Headline */}
        <motion.h1
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.1, ease: [0.16, 1, 0.3, 1] }}
          className="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-gray-950 dark:text-white tracking-tight uppercase leading-[1.12] mb-6 max-w-4xl mx-auto font-sans"
        >
          {data.siteCopy.heroHeadline}
        </motion.h1>

        {/* Narrative Subtitle */}
        <motion.p
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.2, ease: [0.16, 1, 0.3, 1] }}
          className="max-w-[740px] mx-auto text-sm sm:text-base text-gray-600 dark:text-gray-300 leading-relaxed mb-10 whitespace-pre-line font-sans"
        >
          {data.siteCopy.heroSubtitle}
        </motion.p>

        {/* Action Buttons: "Pesan Sekarang" & "Pelajari Selengkapnya" */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.3, ease: [0.16, 1, 0.3, 1] }}
          className="flex flex-col sm:flex-row items-center justify-center gap-3.5 max-w-md mx-auto mb-6"
        >
          {/* 1. Tombol Pesan Sekarang */}
          <motion.button
            whileHover={{ scale: 1.04, y: -2 }}
            whileTap={{ scale: 0.97 }}
            onClick={handleOrderWhatsApp}
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:via-[#85001D] hover:to-[#5E0013] text-white text-sm font-bold rounded-xl shadow-md hover:shadow-xl transition-all duration-300 group cursor-pointer border border-rose-800/30 font-sans"
          >
            <MessageCircle className="w-4 h-4 text-rose-200 group-hover:scale-110 transition-transform" />
            <span>Pesan Sekarang</span>
            <ArrowRight className="w-4 h-4 text-rose-200 group-hover:translate-x-1 transition-transform" />
          </motion.button>

          {/* 2. Tombol Pelajari Selengkapnya */}
          <motion.button
            whileHover={{ scale: 1.03, y: -1 }}
            whileTap={{ scale: 0.98 }}
            onClick={handleScrollToDetails}
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white dark:bg-white/10 hover:bg-gray-50 dark:hover:bg-white/20 backdrop-blur-md border border-gray-200 dark:border-white/20 hover:border-gray-300 dark:hover:border-white/40 text-gray-800 dark:text-white text-sm font-bold rounded-xl shadow-2xs hover:shadow-xs transition-all duration-300 cursor-pointer font-sans"
          >
            <span>Pelajari Selengkapnya</span>
            <ArrowDown className="w-4 h-4 text-gray-400 dark:text-rose-300 animate-bounce" />
          </motion.button>
        </motion.div>

        {/* 3D Animated Laptop Mockup */}
        <div className="relative z-20">
          <LaptopMockup3D videoSrc={data.siteCopy.profileVideo || "/videos/profile.mp4"} />
        </div>
      </div>
    </section>
  );
};
