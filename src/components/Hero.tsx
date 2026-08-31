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
    <section
      id="hero"
      className="pt-24 pb-20 text-center relative overflow-hidden bg-[#07080E] text-white select-none"
    >
      {/* ========================================================================= */}
      {/* 1. CINEMATIC PLANET EARTH HORIZON & COSMIC ATMOSPHERE BACKGROUND */}
      {/* ========================================================================= */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none -z-0 flex items-center justify-center">
        {/* Deep Cosmic Starfield & Stars */}
        <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-sky-900/20 via-[#07080e]/80 to-[#07080e]" />
        <div className="absolute inset-0 bg-[radial-gradient(white_1px,transparent_1px)] [background-size:32px_32px] opacity-25" />

        {/* Ambient Top Nebula Glow */}
        <div className="absolute -top-32 left-1/2 -translate-x-1/2 w-[900px] h-[450px] bg-gradient-to-b from-rose-600/20 via-sky-600/15 to-transparent blur-[120px] rounded-full pointer-events-none" />

        {/* SOLAR SUNRISE FLARE ON THE EARTH HORIZON CREST */}
        <div className="absolute top-[28%] sm:top-[26%] left-1/2 -translate-x-1/2 w-[450px] sm:w-[650px] h-[180px] bg-gradient-to-b from-sky-300/40 via-rose-400/30 to-transparent blur-[50px] rounded-full pointer-events-none" />
        <div className="absolute top-[29%] sm:top-[27%] left-1/2 -translate-x-1/2 w-[220px] sm:w-[320px] h-[70px] bg-white/60 blur-[28px] rounded-full pointer-events-none" />

        {/* GIGANTIC PROMINENT PLANET EARTH SPHERE CURVATURE */}
        <div className="absolute top-[28%] sm:top-[26%] left-1/2 -translate-x-1/2 w-[1400px] sm:w-[1700px] lg:w-[2100px] aspect-square rounded-full border-t-[3px] border-sky-300 shadow-[0_-15px_80px_rgba(56,189,248,0.7),0_-40px_160px_rgba(244,63,94,0.4)] pointer-events-none overflow-hidden">
          {/* Glowing Earth Horizon Atmospheric Ring (Cyan + Rose Scattering) */}
          <div className="absolute top-0 left-0 right-0 h-48 bg-gradient-to-b from-sky-400/40 via-sky-500/15 to-transparent blur-md" />
          <div className="absolute top-0 left-0 right-0 h-96 bg-gradient-to-b from-rose-500/25 via-blue-900/30 to-transparent blur-2xl" />

          {/* Earth Body Spherical Gradient */}
          <div className="absolute inset-0 bg-gradient-to-b from-[#0b172a] via-[#070b14] to-[#04060a]" />

          {/* Earth Continents & Ocean Texture Glow Simulation */}
          <div className="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[800px] opacity-40">
            {/* Curved Latitude/Longitude Vector Arcs */}
            <svg
              className="w-full h-full"
              viewBox="0 0 1400 800"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              {/* Latitude Rings */}
              <ellipse cx="700" cy="40" rx="680" ry="110" stroke="url(#earthHeroNeon)" strokeWidth="1.5" strokeDasharray="6 8" />
              <ellipse cx="700" cy="160" rx="640" ry="160" stroke="url(#earthHeroNeon)" strokeWidth="1.2" strokeDasharray="5 7" />
              <ellipse cx="700" cy="300" rx="580" ry="210" stroke="url(#earthHeroNeon)" strokeWidth="1" strokeDasharray="4 6" />
              <ellipse cx="700" cy="460" rx="500" ry="260" stroke="url(#earthHeroNeon)" strokeWidth="1" strokeDasharray="4 6" />

              {/* Longitude Curved Lines */}
              <path d="M 700 0 C 700 250, 700 550, 700 800" stroke="url(#earthHeroNeon)" strokeWidth="1.5" strokeDasharray="5 7" />
              <path d="M 480 0 C 540 250, 560 550, 600 800" stroke="url(#earthHeroNeon)" strokeWidth="1.2" strokeDasharray="5 7" />
              <path d="M 920 0 C 860 250, 840 550, 800 800" stroke="url(#earthHeroNeon)" strokeWidth="1.2" strokeDasharray="5 7" />
              <path d="M 280 0 C 390 250, 430 550, 500 800" stroke="url(#earthHeroNeon)" strokeWidth="1" strokeDasharray="4 6" />
              <path d="M 1120 0 C 1010 250, 970 550, 900 800" stroke="url(#earthHeroNeon)" strokeWidth="1" strokeDasharray="4 6" />

              {/* Glowing Coordinate Intersections */}
              <circle cx="700" cy="40" r="3.5" fill="#38bdf8" className="animate-ping" />
              <circle cx="480" cy="40" r="3" fill="#f43f5e" />
              <circle cx="920" cy="40" r="3" fill="#38bdf8" />
              <circle cx="700" cy="160" r="3" fill="#38bdf8" />
              <circle cx="540" cy="160" r="3" fill="#f43f5e" />
              <circle cx="860" cy="160" r="3" fill="#38bdf8" />

              <defs>
                <linearGradient id="earthHeroNeon" x1="0%" y1="0%" x2="100%" y2="0%">
                  <stop offset="0%" stopColor="#38bdf8" stopOpacity="0" />
                  <stop offset="20%" stopColor="#38bdf8" stopOpacity="0.6" />
                  <stop offset="50%" stopColor="#f43f5e" stopOpacity="0.8" />
                  <stop offset="80%" stopColor="#38bdf8" stopOpacity="0.6" />
                  <stop offset="100%" stopColor="#38bdf8" stopOpacity="0" />
                </linearGradient>
              </defs>
            </svg>
          </div>
        </div>

        {/* Smooth Bottom Horizon Blend into White Page */}
        <div className="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-[#FDFBF9] via-[#FDFBF9]/40 to-transparent pointer-events-none z-10" />
      </div>

      {/* ========================================================================= */}
      {/* 2. HERO CONTENT CONTAINER (PRESERVED WITH ULTRA-HIGH CONTRAST) */}
      {/* ========================================================================= */}
      <div className="max-w-[1160px] mx-auto px-6 relative z-20">
        {/* Eyebrow Pill */}
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5, ease: [0.16, 1, 0.3, 1] }}
          className="inline-block"
        >
          <span className="inline-flex items-center gap-1.5 font-mono text-[11px] font-bold uppercase tracking-wider text-rose-300 bg-rose-950/60 backdrop-blur-md border border-rose-500/30 px-4 py-1.5 rounded-full mb-6 shadow-lg shadow-rose-950/50">
            <span className="w-1.5 h-1.5 rounded-full bg-rose-400 animate-pulse" />
            {data.siteCopy.heroEyebrow}
          </span>
        </motion.div>

        {/* Main Headline */}
        <motion.h1
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.1, ease: [0.16, 1, 0.3, 1] }}
          className="text-4xl sm:text-5xl md:text-[3.35rem] font-extrabold text-white tracking-tight leading-[1.18] mb-5 whitespace-pre-line drop-shadow-[0_4px_24px_rgba(0,0,0,0.8)]"
        >
          {data.siteCopy.heroHeadline}
        </motion.h1>

        {/* Narrative Subtitle */}
        <motion.p
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.2, ease: [0.16, 1, 0.3, 1] }}
          className="max-w-[740px] mx-auto text-sm sm:text-base text-gray-300 leading-relaxed mb-10 whitespace-pre-line drop-shadow-md"
        >
          {data.siteCopy.heroSubtitle}
        </motion.p>

        {/* Action Buttons: "Pesan Sekarang" & "Pelajari Selengkapnya" */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.3, ease: [0.16, 1, 0.3, 1] }}
          className="flex flex-col sm:flex-row items-center justify-center gap-3.5 max-w-md mx-auto mb-4"
        >
          {/* 1. Tombol Pesan Sekarang (Merah Maroon Premium Gradasi) */}
          <motion.button
            whileHover={{ scale: 1.04, y: -2 }}
            whileTap={{ scale: 0.97 }}
            onClick={handleOrderWhatsApp}
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 bg-gradient-to-r from-[#8B0021] via-[#a30026] to-[#50000F] hover:from-[#b8002b] hover:via-[#85001D] hover:to-[#5E0013] text-white text-sm font-bold rounded-xl shadow-lg shadow-rose-950/60 hover:shadow-2xl transition-all duration-300 group cursor-pointer border border-rose-500/40"
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
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 hover:border-white/40 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer"
          >
            <span>Pelajari Selengkapnya</span>
            <ArrowDown className="w-4 h-4 text-rose-300 animate-bounce" />
          </motion.button>
        </motion.div>

        {/* 3D Animated Laptop Mockup (Floating directly on the glowing Earth Horizon) */}
        <div className="relative z-20">
          <LaptopMockup3D />
        </div>
      </div>
    </section>
  );
};
