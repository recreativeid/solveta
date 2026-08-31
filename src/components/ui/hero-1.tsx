"use client";

import React from "react";
import { motion } from "framer-motion";
import { ArrowRight, Sparkles, MessageCircle, ArrowDown } from "lucide-react";

export interface HeroProps {
  title?: string;
  subtitle?: string;
  eyebrow?: string;
  ctaLabel?: string;
  ctaHref?: string;
  secondaryCtaLabel?: string;
  secondaryCtaHref?: string;
  onCtaClick?: () => void;
  children?: React.ReactNode;
}

export function Hero({
  title = "Build smarter tools for modern teams",
  subtitle = "Streamline your workflow and boost productivity with intuitive solutions. Security, speed, and simplicity—all in one platform.",
  eyebrow = "Next-Gen Productivity",
  ctaLabel = "Get Started",
  ctaHref = "#",
  secondaryCtaLabel,
  secondaryCtaHref,
  onCtaClick,
  children,
}: HeroProps) {
  return (
    <section className="relative pt-24 pb-20 text-center overflow-hidden bg-[#FDFBF9] dark:bg-[#07080E] text-gray-900 dark:text-white transition-colors duration-300 min-h-[700px] flex flex-col justify-between select-none">
      {/* 1. PLANET EARTH HORIZON CURVATURE (LOWERED TO SIT CLEANLY UNDER TEXT & BEHIND LAPTOP) */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none -z-0 flex items-center justify-center">
        {/* Subtle Constellation Starfield & Grid */}
        <div className="absolute inset-0 bg-[radial-gradient(#94a3b8_1px,transparent_1px)] dark:bg-[radial-gradient(white_1px,transparent_1px)] [background-size:28px_28px] opacity-25 dark:opacity-20" />

        {/* Ambient Top Light Beam */}
        <div className="absolute -top-28 left-1/2 -translate-x-1/2 w-[850px] h-[400px] bg-gradient-to-b from-rose-200/40 dark:from-rose-600/20 via-sky-200/25 dark:via-sky-600/15 to-transparent blur-[110px] rounded-full pointer-events-none" />

        {/* SOLAR SUNRISE FLARE ON THE HORIZON (LOWERED BELOW BUTTONS) */}
        <div className="absolute top-[48%] sm:top-[46%] left-1/2 -translate-x-1/2 w-[420px] sm:w-[620px] h-[150px] bg-gradient-to-b from-sky-400/50 dark:from-sky-300/40 via-rose-400/30 to-transparent blur-[45px] rounded-full pointer-events-none" />
        <div className="absolute top-[49%] sm:top-[47%] left-1/2 -translate-x-1/2 w-[200px] sm:w-[280px] h-[55px] bg-white/80 dark:bg-white/60 blur-[24px] rounded-full pointer-events-none" />

        {/* GIGANTIC PROMINENT EARTH HORIZON ARC (LOWERED: DOES NOT OVERLAP TEXT) */}
        <div className="absolute top-[48%] sm:top-[46%] left-1/2 -translate-x-1/2 w-[1450px] sm:w-[1750px] lg:w-[2150px] aspect-square rounded-full border-t-[3.5px] border-sky-400 dark:border-sky-300 shadow-[0_-12px_65px_rgba(14,165,233,0.55),0_-35px_130px_rgba(244,63,94,0.3)] dark:shadow-[0_-15px_80px_rgba(56,189,248,0.7),0_-40px_160px_rgba(244,63,94,0.4)] pointer-events-none overflow-hidden">
          {/* Glowing Earth Horizon Atmospheric Ring */}
          <div className="absolute top-0 left-0 right-0 h-44 bg-gradient-to-b from-sky-400/35 dark:from-sky-400/40 via-sky-300/15 to-transparent blur-md" />
          <div className="absolute top-0 left-0 right-0 h-80 bg-gradient-to-b from-rose-400/20 dark:from-rose-500/25 via-blue-800/15 dark:via-blue-900/30 to-transparent blur-2xl" />

          {/* Earth Body Spherical Gradient */}
          <div className="absolute inset-0 bg-gradient-to-b from-sky-100/40 dark:from-[#0b172a] via-rose-50/20 dark:via-[#070b14] to-[#FDFBF9] dark:to-[#04060a]" />

          {/* Earth Continents & Ocean Texture Curved Longitude/Latitude Arcs */}
          <div className="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[800px] opacity-45 dark:opacity-40">
            <svg
              className="w-full h-full"
              viewBox="0 0 1400 800"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <ellipse cx="700" cy="40" rx="680" ry="110" stroke="url(#earthHeroNeonLight)" strokeWidth="1.5" strokeDasharray="6 8" />
              <ellipse cx="700" cy="160" rx="640" ry="160" stroke="url(#earthHeroNeonLight)" strokeWidth="1.2" strokeDasharray="5 7" />
              <ellipse cx="700" cy="300" rx="580" ry="210" stroke="url(#earthHeroNeonLight)" strokeWidth="1" strokeDasharray="4 6" />
              <ellipse cx="700" cy="460" rx="500" ry="260" stroke="url(#earthHeroNeonLight)" strokeWidth="1" strokeDasharray="4 6" />

              <path d="M 700 0 C 700 250, 700 550, 700 800" stroke="url(#earthHeroNeonLight)" strokeWidth="1.5" strokeDasharray="5 7" />
              <path d="M 480 0 C 540 250, 560 550, 600 800" stroke="url(#earthHeroNeonLight)" strokeWidth="1.2" strokeDasharray="5 7" />
              <path d="M 920 0 C 860 250, 840 550, 800 800" stroke="url(#earthHeroNeonLight)" strokeWidth="1.2" strokeDasharray="5 7" />
              <path d="M 280 0 C 390 250, 430 550, 500 800" stroke="url(#earthHeroNeonLight)" strokeWidth="1.2" strokeDasharray="4 6" />
              <path d="M 1120 0 C 1010 250, 970 550, 900 800" stroke="url(#earthHeroNeonLight)" strokeWidth="1.2" strokeDasharray="4 6" />

              <circle cx="700" cy="40" r="3.5" fill="#0284c7" className="animate-ping" />
              <circle cx="480" cy="40" r="3" fill="#e11d48" />
              <circle cx="920" cy="40" r="3" fill="#0284c7" />

              <defs>
                <linearGradient id="earthHeroNeonLight" x1="0%" y1="0%" x2="100%" y2="0%">
                  <stop offset="0%" stopColor="#0284c7" stopOpacity="0" />
                  <stop offset="20%" stopColor="#0284c7" stopOpacity="0.7" />
                  <stop offset="50%" stopColor="#e11d48" stopOpacity="0.8" />
                  <stop offset="80%" stopColor="#0284c7" stopOpacity="0.7" />
                  <stop offset="100%" stopColor="#0284c7" stopOpacity="0" />
                </linearGradient>
              </defs>
            </svg>
          </div>
        </div>

        <div className="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-[#FDFBF9] dark:from-[#07080E] via-[#FDFBF9]/80 dark:via-[#07080E]/60 to-transparent pointer-events-none z-10" />
      </div>

      {/* 2. HERO CONTENT CONTAINER */}
      <div className="max-w-[1160px] mx-auto px-6 relative z-20">
        {eyebrow && (
          <motion.div
            initial={{ opacity: 0, y: 15 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5, ease: [0.16, 1, 0.3, 1] }}
            className="inline-block"
          >
            <span className="inline-flex items-center gap-1.5 font-mono text-[11px] font-bold uppercase tracking-wider text-[#7B0B1E] dark:text-rose-300 bg-rose-50/90 dark:bg-rose-950/60 backdrop-blur-md border border-rose-200/80 dark:border-rose-500/30 px-4 py-1.5 rounded-full mb-6 shadow-2xs">
              <span className="w-1.5 h-1.5 rounded-full bg-[#8B0021] dark:bg-rose-400 animate-pulse" />
              {eyebrow}
            </span>
          </motion.div>
        )}

        <motion.h1
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.1, ease: [0.16, 1, 0.3, 1] }}
          className="text-4xl sm:text-5xl md:text-[3.35rem] font-extrabold text-gray-950 dark:text-white tracking-tight leading-[1.18] mb-5 whitespace-pre-line"
        >
          {title}
        </motion.h1>

        <motion.p
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.2, ease: [0.16, 1, 0.3, 1] }}
          className="max-w-[740px] mx-auto text-sm sm:text-base text-gray-600 dark:text-gray-300 leading-relaxed mb-10 whitespace-pre-line"
        >
          {subtitle}
        </motion.p>

        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.3, ease: [0.16, 1, 0.3, 1] }}
          className="flex flex-col sm:flex-row items-center justify-center gap-3.5 max-w-md mx-auto mb-6"
        >
          <motion.a
            whileHover={{ scale: 1.04, y: -2 }}
            whileTap={{ scale: 0.97 }}
            href={ctaHref}
            onClick={onCtaClick}
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:via-[#85001D] hover:to-[#5E0013] text-white text-sm font-bold rounded-xl shadow-md hover:shadow-xl transition-all duration-300 group cursor-pointer border border-rose-800/30"
          >
            <span>{ctaLabel}</span>
            <ArrowRight className="w-4 h-4 text-rose-200 group-hover:translate-x-1 transition-transform" />
          </motion.a>

          {secondaryCtaLabel && (
            <motion.a
              whileHover={{ scale: 1.03, y: -1 }}
              whileTap={{ scale: 0.98 }}
              href={secondaryCtaHref || "#"}
              className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white/95 dark:bg-white/10 hover:bg-rose-50/50 dark:hover:bg-white/20 backdrop-blur-md border border-gray-300 dark:border-white/20 hover:border-[#8B0021]/50 dark:hover:border-white/40 text-gray-800 dark:text-white text-sm font-bold rounded-xl shadow-2xs hover:shadow-xs transition-all duration-300 cursor-pointer"
            >
              <span>{secondaryCtaLabel}</span>
            </motion.a>
          )}
        </motion.div>

        {children}
      </div>
    </section>
  );
}

export default Hero;
