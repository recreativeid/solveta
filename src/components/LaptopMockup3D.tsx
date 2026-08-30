"use client";

import React, { useState } from "react";
import { motion } from "framer-motion";
import {
  Sparkles,
  TrendingUp,
  Layout,
  Compass,
  BarChart3,
  ArrowRight,
  ShieldCheck,
  Zap,
} from "lucide-react";

export const LaptopMockup3D: React.FC = () => {
  const [mousePos, setMousePos] = useState({ x: 0, y: 0 });

  const handleMouseMove = (e: React.MouseEvent<HTMLDivElement>) => {
    const rect = e.currentTarget.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width - 0.5) * 10;
    const y = ((e.clientY - rect.top) / rect.height - 0.5) * -10;
    setMousePos({ x, y });
  };

  const handleMouseLeave = () => {
    setMousePos({ x: 0, y: 0 });
  };

  return (
    <motion.div
      initial={{ opacity: 0, y: 40, scale: 0.96 }}
      animate={{ opacity: 1, y: 0, scale: 1 }}
      transition={{ duration: 0.8, delay: 0.4, ease: [0.16, 1, 0.3, 1] }}
      className="mt-14 max-w-[960px] mx-auto px-2 select-none"
      onMouseMove={handleMouseMove}
      onMouseLeave={handleMouseLeave}
      style={{ perspective: 1400 }}
    >
      {/* 3D Floating & Interactive Tilt Container */}
      <motion.div
        animate={{
          rotateX: mousePos.y,
          rotateY: mousePos.x,
          y: [0, -8, 0],
        }}
        transition={{
          rotateX: { type: "spring", stiffness: 120, damping: 15 },
          rotateY: { type: "spring", stiffness: 120, damping: 15 },
          y: { duration: 5, repeat: Infinity, ease: "easeInOut" },
        }}
        className="relative flex flex-col items-center"
      >
        {/* Soft Ambient Maroon Glow Behind Laptop */}
        <div className="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[740px] h-[300px] bg-gradient-to-r from-[#8B0021]/15 via-rose-500/10 to-[#50000F]/15 rounded-full blur-[95px] pointer-events-none -z-10" />

        {/* LAPTOP SCREEN CHASSIS (LID) */}
        <div className="w-full max-w-[880px] bg-[#1a1b24] rounded-t-[18px] sm:rounded-t-[24px] p-2.5 sm:p-3.5 border-[3px] border-[#2c2d3a] shadow-[0_30px_70px_-15px_rgba(0,0,0,0.45)] relative">
          {/* Top Webcam Notch */}
          <div className="absolute top-1.5 left-1/2 -translate-x-1/2 flex items-center gap-1.5">
            <div className="w-1.5 h-1.5 rounded-full bg-[#3b3e52]" />
            <div className="w-1 h-1 rounded-full bg-emerald-500/90 animate-pulse" />
          </div>

          {/* INNER DISPLAY: LUXURY DIGITAL AGENCY WEBSITE SHOWCASE */}
          <div className="w-full aspect-[16/10] bg-[#0c0d12] rounded-[10px] sm:rounded-[14px] overflow-hidden flex flex-col text-left border border-[#232533] shadow-inner font-sans relative">
            {/* Browser Navigation Bar */}
            <div className="h-8 bg-[#14151e] border-b border-[#202230] flex items-center justify-between px-3 sm:px-4 flex-shrink-0">
              {/* Window Controls */}
              <div className="flex items-center gap-1.5">
                <div className="w-2.5 h-2.5 rounded-full bg-[#ff5f56]" />
                <div className="w-2.5 h-2.5 rounded-full bg-[#ffbd2e]" />
                <div className="w-2.5 h-2.5 rounded-full bg-[#27c93f]" />
              </div>

              {/* URL Address Bar */}
              <div className="hidden sm:flex items-center gap-1.5 px-3 py-0.5 bg-[#0e0f16] border border-[#232535] rounded-full text-[10px] text-gray-400 font-mono w-64 justify-center">
                <ShieldCheck className="w-3 h-3 text-emerald-400" />
                <span className="text-gray-300">https://www.digitalagency.design</span>
              </div>

              {/* Status Badge */}
              <div className="flex items-center gap-1 text-[10px] text-rose-300 font-mono font-semibold">
                <span className="w-1.5 h-1.5 rounded-full bg-[#8B0021] animate-ping" />
                <span>LIVE PREVIEW</span>
              </div>
            </div>

            {/* WEBSITE CONTENT: MODERN HIGH-CONVERTING HERO & SERVICES */}
            <div className="flex-grow overflow-y-auto bg-gradient-to-b from-[#10121a] via-[#0c0d12] to-[#08080c] p-4 sm:p-6 text-white flex flex-col justify-between relative">
              {/* Subtle Ambient Red Flare */}
              <div className="absolute top-0 right-1/4 w-48 h-48 bg-[#8B0021]/20 rounded-full blur-[60px] pointer-events-none" />

              {/* 1. Website Header / Navbar */}
              <div className="flex items-center justify-between pb-4 border-b border-white/5 relative z-10">
                <div className="flex items-center gap-2">
                  <div className="w-6 h-6 rounded-lg bg-gradient-to-br from-[#8B0021] to-[#50000F] flex items-center justify-center font-black text-xs text-white shadow-xs">
                    ✦
                  </div>
                  <span className="font-extrabold text-xs tracking-wider text-white uppercase font-mono">
                    MEDIAURA DIGITAL
                  </span>
                </div>

                <div className="hidden md:flex items-center gap-4 text-[10px] text-gray-300 font-medium">
                  <span className="text-white hover:text-rose-300 cursor-pointer">About Us</span>
                  <span className="hover:text-rose-300 cursor-pointer">Services</span>
                  <span className="hover:text-rose-300 cursor-pointer">Case Studies</span>
                  <span className="hover:text-rose-300 cursor-pointer">Insights</span>
                  <span className="hover:text-rose-300 cursor-pointer">Contact</span>
                </div>

                <div className="px-3 py-1 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white text-[10px] font-bold rounded-lg shadow-xs cursor-pointer">
                  Get in Touch
                </div>
              </div>

              {/* 2. Website Hero Content */}
              <div className="text-center my-auto py-3 sm:py-5 max-w-lg mx-auto relative z-10 space-y-2.5">
                <div className="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-300 text-[10px] font-semibold tracking-wide">
                  <Sparkles className="w-3 h-3 text-rose-400" />
                  <span>Expert Digital &amp; Technology Agency</span>
                </div>

                <h2 className="text-base sm:text-xl md:text-2xl font-black text-white tracking-tight leading-snug">
                  Scale Your Business with Next-Gen Digital Systems
                </h2>

                <p className="text-[10px] sm:text-xs text-gray-400 leading-relaxed max-w-md mx-auto">
                  We build high-performance web applications, intelligent automation, and modern brand experiences that drive measurable growth.
                </p>

                {/* Hero CTA Buttons */}
                <div className="flex items-center justify-center gap-2.5 pt-1">
                  <div className="px-4 py-1.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] text-white text-[11px] font-bold rounded-lg shadow-sm cursor-pointer hover:scale-105 transition-transform flex items-center gap-1">
                    <span>Explore Solutions</span>
                    <ArrowRight className="w-3 h-3" />
                  </div>
                  <div className="px-4 py-1.5 bg-white/5 hover:bg-white/10 border border-white/10 text-gray-200 text-[11px] font-bold rounded-lg cursor-pointer transition-colors">
                    View Portfolio
                  </div>
                </div>
              </div>

              {/* 3. Services / Capabilities 4-Card Grid (Matching User Reference Image) */}
              <div className="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-2.5 pt-3 border-t border-white/5 relative z-10">
                {/* Card 1 */}
                <div className="p-2 sm:p-2.5 rounded-xl bg-[#141622]/80 border border-[#27293a] hover:border-rose-500/40 transition-all text-left group">
                  <div className="w-6 h-6 rounded-lg bg-rose-950/60 border border-rose-800/40 flex items-center justify-center text-rose-400 mb-1.5 group-hover:scale-110 transition-transform">
                    <TrendingUp className="w-3.5 h-3.5" />
                  </div>
                  <div className="text-[10px] font-bold text-white group-hover:text-rose-300 transition-colors">
                    Lead Generation
                  </div>
                  <div className="text-[9px] text-gray-400 line-clamp-1">
                    Automated conversion funnels
                  </div>
                </div>

                {/* Card 2 */}
                <div className="p-2 sm:p-2.5 rounded-xl bg-[#141622]/80 border border-[#27293a] hover:border-rose-500/40 transition-all text-left group">
                  <div className="w-6 h-6 rounded-lg bg-rose-950/60 border border-rose-800/40 flex items-center justify-center text-rose-400 mb-1.5 group-hover:scale-110 transition-transform">
                    <Layout className="w-3.5 h-3.5" />
                  </div>
                  <div className="text-[10px] font-bold text-white group-hover:text-rose-300 transition-colors">
                    Design &amp; Development
                  </div>
                  <div className="text-[9px] text-gray-400 line-clamp-1">
                    Modern high-speed web apps
                  </div>
                </div>

                {/* Card 3 */}
                <div className="p-2 sm:p-2.5 rounded-xl bg-[#141622]/80 border border-[#27293a] hover:border-rose-500/40 transition-all text-left group">
                  <div className="w-6 h-6 rounded-lg bg-rose-950/60 border border-rose-800/40 flex items-center justify-center text-rose-400 mb-1.5 group-hover:scale-110 transition-transform">
                    <Compass className="w-3.5 h-3.5" />
                  </div>
                  <div className="text-[10px] font-bold text-white group-hover:text-rose-300 transition-colors">
                    Strategy &amp; Roadmap
                  </div>
                  <div className="text-[9px] text-gray-400 line-clamp-1">
                    Enterprise digital structure
                  </div>
                </div>

                {/* Card 4 */}
                <div className="p-2 sm:p-2.5 rounded-xl bg-[#141622]/80 border border-[#27293a] hover:border-rose-500/40 transition-all text-left group">
                  <div className="w-6 h-6 rounded-lg bg-rose-950/60 border border-rose-800/40 flex items-center justify-center text-rose-400 mb-1.5 group-hover:scale-110 transition-transform">
                    <BarChart3 className="w-3.5 h-3.5" />
                  </div>
                  <div className="text-[10px] font-bold text-white group-hover:text-rose-300 transition-colors">
                    Tracking &amp; Analytics
                  </div>
                  <div className="text-[9px] text-gray-400 line-clamp-1">
                    Real-time performance data
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* LAPTOP BOTTOM BASE & HINGE */}
        <div className="w-full max-w-[960px] h-3.5 sm:h-4 bg-gradient-to-b from-[#d1d5db] via-[#9ca3af] to-[#6b7280] rounded-b-[14px] sm:rounded-b-[18px] shadow-[0_18px_35px_rgba(0,0,0,0.35)] relative flex items-center justify-center">
          {/* Thumb Notch */}
          <div className="w-24 sm:w-32 h-1.5 bg-[#4b5563] rounded-b-md" />
        </div>

        {/* Base Table Reflection Shadow */}
        <div className="w-[85%] h-5 bg-gradient-to-r from-transparent via-black/25 to-transparent blur-md rounded-full mt-1 pointer-events-none" />
      </motion.div>
    </motion.div>
  );
};
