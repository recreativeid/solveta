"use client";

import React from "react";
import { motion } from "framer-motion";
import { ArrowRight, Sparkles, MessageCircle } from "lucide-react";

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
    <section className="relative pt-24 pb-16 text-center overflow-hidden bg-white min-h-[700px] flex flex-col justify-between">
      {/* 1. EARTH / PLANET CURVATURE ATMOSPHERE BACKGROUND */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none -z-10 flex items-center justify-center">
        {/* Subtle Starfield & Ambient Glow */}
        <div className="absolute inset-0 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:24px_24px] opacity-40" />

        {/* Ambient Top Light Beam */}
        <div className="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[350px] bg-gradient-to-b from-rose-100/40 via-red-50/20 to-transparent blur-[90px] rounded-full" />

        {/* GIGANTIC EARTH / PLANET SPHERE CURVATURE (BEHIND CONTENT & LAPTOP) */}
        <div className="absolute top-[38%] left-1/2 -translate-x-1/2 w-[1200px] sm:w-[1500px] lg:w-[1800px] aspect-square rounded-full border border-sky-400/20 pointer-events-none">
          {/* Earth Atmosphere Outer Aura Glow */}
          <div className="absolute inset-0 rounded-full bg-gradient-to-b from-sky-400/15 via-rose-500/10 to-transparent blur-[60px]" />

          {/* Earth Horizon Razor Edge Ring Glow */}
          <div className="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-transparent via-sky-300 via-50% via-rose-400 to-transparent shadow-[0_0_35px_rgba(56,189,248,0.7),0_0_70px_rgba(244,63,94,0.4)]" />

          {/* Inner Celestial Surface Lighting */}
          <div className="absolute inset-0 rounded-full bg-gradient-to-b from-sky-100/30 via-slate-50/20 to-transparent shadow-inner" />

          {/* Earth Grid Longitude & Latitude Curved Lines */}
          <svg
            className="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[600px] opacity-25"
            viewBox="0 0 1200 600"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            {/* Latitude arcs */}
            <ellipse cx="600" cy="50" rx="580" ry="120" stroke="url(#earthGrid)" strokeWidth="1" strokeDasharray="4 6" />
            <ellipse cx="600" cy="180" rx="550" ry="180" stroke="url(#earthGrid)" strokeWidth="1" strokeDasharray="6 8" />
            <ellipse cx="600" cy="340" rx="500" ry="240" stroke="url(#earthGrid)" strokeWidth="1" strokeDasharray="5 7" />

            {/* Longitude lines */}
            <path d="M 600 0 C 600 200, 600 400, 600 600" stroke="url(#earthGrid)" strokeWidth="1" strokeDasharray="4 6" />
            <path d="M 400 0 C 460 200, 480 400, 500 600" stroke="url(#earthGrid)" strokeWidth="1" strokeDasharray="4 6" />
            <path d="M 800 0 C 740 200, 720 400, 700 600" stroke="url(#earthGrid)" strokeWidth="1" strokeDasharray="4 6" />
            <path d="M 220 0 C 320 200, 360 400, 400 600" stroke="url(#earthGrid)" strokeWidth="1" strokeDasharray="4 6" />
            <path d="M 980 0 C 880 200, 840 400, 800 600" stroke="url(#earthGrid)" strokeWidth="1" strokeDasharray="4 6" />

            <defs>
              <linearGradient id="earthGrid" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stopColor="#38bdf8" stopOpacity="0" />
                <stop offset="25%" stopColor="#38bdf8" stopOpacity="0.4" />
                <stop offset="50%" stopColor="#f43f5e" stopOpacity="0.6" />
                <stop offset="75%" stopColor="#38bdf8" stopOpacity="0.4" />
                <stop offset="100%" stopColor="#38bdf8" stopOpacity="0" />
              </linearGradient>
            </defs>
          </svg>
        </div>

        {/* Ambient Maroon Base Light */}
        <div className="absolute bottom-0 left-1/2 -translate-x-1/2 w-[900px] h-[300px] bg-gradient-to-t from-white via-transparent to-transparent pointer-events-none" />
      </div>

      <div className="max-w-[1160px] mx-auto px-6 relative z-10">
        {/* Eyebrow Pill */}
        {eyebrow && (
          <motion.div
            initial={{ opacity: 0, y: 15 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5, ease: [0.16, 1, 0.3, 1] }}
            className="inline-block"
          >
            <span className="inline-flex items-center gap-1.5 font-mono text-[11px] font-bold uppercase tracking-wider text-[#7B0B1E] bg-white/90 backdrop-blur-md border border-rose-100 px-4 py-1.5 rounded-full mb-6 shadow-2xs">
              <span className="w-1.5 h-1.5 rounded-full bg-[#8B0021] animate-pulse" />
              {eyebrow}
            </span>
          </motion.div>
        )}

        {/* Main Headline */}
        <motion.h1
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.1, ease: [0.16, 1, 0.3, 1] }}
          className="text-4xl sm:text-5xl md:text-[3.35rem] font-extrabold text-gray-950 tracking-tight leading-[1.18] mb-5 whitespace-pre-line"
        >
          {title}
        </motion.h1>

        {/* Narrative Subtitle */}
        <motion.p
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.2, ease: [0.16, 1, 0.3, 1] }}
          className="max-w-[740px] mx-auto text-sm sm:text-base text-gray-600 leading-relaxed mb-10 whitespace-pre-line"
        >
          {subtitle}
        </motion.p>

        {/* Action CTA Buttons */}
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
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:via-[#85001D] hover:to-[#5E0013] text-white text-sm font-bold rounded-xl shadow-md hover:shadow-xl transition-all duration-300 group cursor-pointer"
          >
            <span>{ctaLabel}</span>
            <ArrowRight className="w-4 h-4 text-rose-200 group-hover:translate-x-1 transition-transform" />
          </motion.a>

          {secondaryCtaLabel && (
            <motion.a
              whileHover={{ scale: 1.03, y: -1 }}
              whileTap={{ scale: 0.98 }}
              href={secondaryCtaHref || "#"}
              className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white/90 backdrop-blur-md hover:bg-rose-50/50 border border-gray-300 hover:border-[#8B0021]/50 text-gray-800 hover:text-[#7B0B1E] text-sm font-bold rounded-xl shadow-2xs hover:shadow-xs transition-all duration-300 cursor-pointer"
            >
              <span>{secondaryCtaLabel}</span>
            </motion.a>
          )}
        </motion.div>

        {/* Children (e.g. Laptop Mockup 3D) */}
        {children}
      </div>
    </section>
  );
}

export default Hero;
