"use client";

import React from "react";
import { motion } from "framer-motion";
import { useSiteData, ClientBrandItem } from "@/context/SiteDataContext";

export const ClientMarquee: React.FC = () => {
  const { data } = useSiteData();
  const allBrands = data.clientBrands || [];

  if (allBrands.length === 0) return null;

  // Row 1 uses original brand list
  const row1Raw = allBrands;

  // Row 2 contains identical brands, but staggered/offset by half length
  const offset = Math.max(1, Math.floor(allBrands.length / 2));
  const row2Raw = [...allBrands.slice(offset), ...allBrands.slice(0, offset)];

  // Quadruple items to make the infinite loop completely seamless
  const row1Items = [...row1Raw, ...row1Raw, ...row1Raw, ...row1Raw];
  const row2Items = [...row2Raw, ...row2Raw, ...row2Raw, ...row2Raw];

  const speed = data.siteCopy.marqueeSpeed || 35;

  const renderBrandPill = (brand: ClientBrandItem, index: number) => {
    const hasName = Boolean(brand.name && brand.name.trim().length > 0);
    const hasLogo = Boolean(brand.logoImage && brand.logoImage.trim().length > 0);

    // 1. Pure Logo Mode: 1:1 Aspect Ratio Square Card (Adaptif Tema, Grayscale, Brightness Boost di Dark Mode)
    if (hasLogo && !hasName) {
      return (
        <div
          key={`${brand.id || index}-${index}`}
          className="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 aspect-square flex items-center justify-center bg-white/90 dark:bg-[#11121C]/90 backdrop-blur-md border border-gray-200/80 dark:border-gray-800/80 hover:border-[#8B0021]/60 dark:hover:border-rose-400 rounded-2xl p-2.5 sm:p-3.5 shadow-2xs hover:shadow-md transition-all duration-300 cursor-default group flex-shrink-0 overflow-hidden"
        >
          <img
            src={brand.logoImage}
            alt={brand.name || "Client Logo"}
            className="w-full h-full object-contain select-none pointer-events-none filter grayscale opacity-75 contrast-110 dark:brightness-150 dark:contrast-125 dark:opacity-90 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105 group-hover:dark:brightness-125 transition-all duration-300"
          />
        </div>
      );
    }

    // 2. Logo + Name Combined Card
    if (hasLogo && hasName) {
      return (
        <div
          key={`${brand.id || index}-${index}`}
          className="h-16 sm:h-20 md:h-24 flex items-center justify-center gap-3 bg-white/90 dark:bg-[#11121C]/90 backdrop-blur-md border border-gray-200/80 dark:border-gray-800/80 hover:border-[#8B0021]/60 dark:hover:border-rose-400 rounded-2xl px-4 py-2 shadow-2xs hover:shadow-md transition-all duration-300 cursor-default group flex-shrink-0 overflow-hidden"
        >
          <div className="w-10 h-10 sm:w-12 sm:h-12 flex-shrink-0 flex items-center justify-center">
            <img
              src={brand.logoImage}
              alt={brand.name || "Client Logo"}
              className="w-full h-full object-contain filter grayscale opacity-75 contrast-110 dark:brightness-150 dark:contrast-125 dark:opacity-90 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300"
            />
          </div>
          <span className="text-xs font-bold text-gray-700 dark:text-gray-200 group-hover:text-gray-950 dark:group-hover:text-white tracking-tight truncate max-w-[120px]">
            {brand.name}
          </span>
        </div>
      );
    }

    // 3. Text Only Square / Compact Card (Fallback if no logo image uploaded)
    return (
      <div
        key={`${brand.id || index}-${index}`}
        className="w-20 h-16 sm:w-24 sm:h-20 md:w-28 md:h-24 flex flex-col items-center justify-center text-center p-2 bg-white/90 dark:bg-[#11121C]/90 backdrop-blur-md border border-gray-200/80 dark:border-gray-800/80 hover:border-[#8B0021]/50 dark:hover:border-rose-500 rounded-2xl shadow-2xs hover:shadow-md transition-all duration-300 cursor-default group flex-shrink-0"
      >
        <div className="w-2 h-2 rounded-full bg-[#8B0021] dark:bg-rose-500 mb-1 transition-colors flex-shrink-0" />
        <span className="text-xs font-bold text-gray-800 dark:text-gray-200 group-hover:text-gray-950 dark:group-hover:text-white tracking-tight truncate w-full">
          {brand.name || "Partner"}
        </span>
        {brand.label && (
          <span className="text-[9px] text-gray-400 dark:text-gray-500 font-normal truncate w-full">
            {brand.label}
          </span>
        )}
      </div>
    );
  };

  return (
    <section className="py-12 bg-white dark:bg-[#07080E] border-y border-gray-100 dark:border-gray-800 overflow-hidden relative transition-colors duration-200">
      <div className="max-w-[1160px] mx-auto px-6 mb-6 text-center">
        <p className="text-[11px] font-mono font-bold tracking-widest text-gray-400 dark:text-gray-500 uppercase">
          {data.siteCopy.marqueeTitle || "DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG"}
        </p>
      </div>

      {/* Gradient Fades on edges */}
      <div className="absolute top-0 bottom-0 left-0 w-28 bg-gradient-to-r from-white dark:from-[#07080E] to-transparent z-10 pointer-events-none" />
      <div className="absolute top-0 bottom-0 right-0 w-28 bg-gradient-to-l from-white dark:from-[#07080E] to-transparent z-10 pointer-events-none" />

      {/* Dual Row Flowing Marquee: Row 1 flows Right, Row 2 flows Left */}
      <div className="space-y-4">
        {/* ROW 1: Geser ke Kanan */}
        <div className="flex w-max">
          <motion.div
            animate={{ x: ["-50%", "0%"] }}
            transition={{
              x: {
                repeat: Infinity,
                repeatType: "loop",
                duration: speed,
                ease: "linear",
              },
            }}
            className="flex items-center gap-3 sm:gap-4 pr-4"
          >
            {row1Items.map((brand, i) => renderBrandPill(brand, i))}
          </motion.div>
        </div>

        {/* ROW 2: Geser ke Kiri */}
        <div className="flex w-max">
          <motion.div
            animate={{ x: ["0%", "-50%"] }}
            transition={{
              x: {
                repeat: Infinity,
                repeatType: "loop",
                duration: speed,
                ease: "linear",
              },
            }}
            className="flex items-center gap-3 sm:gap-4 pr-4"
          >
            {row2Items.map((brand, i) => renderBrandPill(brand, i + 500))}
          </motion.div>
        </div>
      </div>
    </section>
  );
};
