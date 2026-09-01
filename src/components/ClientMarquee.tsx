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

    // 1. Pure Logo Mode (Styled like shadcnblocks logos3 - frameless, clean, monochrome)
    if (hasLogo && !hasName) {
      return (
        <div
          key={`${brand.id || index}-${index}`}
          className="flex items-center justify-center px-6 sm:px-8 py-2 h-14 sm:h-16 flex-shrink-0 group cursor-default transition-all duration-300"
        >
          <img
            src={brand.logoImage}
            alt={brand.name || "Client Logo"}
            className="h-8 sm:h-10 md:h-12 w-auto max-w-[150px] sm:max-w-[190px] object-contain filter grayscale opacity-60 contrast-125 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300 select-none pointer-events-none"
          />
        </div>
      );
    }

    // 2. Logo + Name Combined Pill
    if (hasLogo && hasName) {
      return (
        <div
          key={`${brand.id || index}-${index}`}
          className="flex items-center justify-center gap-2.5 bg-white/80 dark:bg-[#11121C]/80 backdrop-blur-xs border border-gray-200/80 dark:border-gray-800 hover:border-[#8B0021]/50 dark:hover:border-rose-500 rounded-full px-3 py-1.5 shadow-2xs hover:shadow-sm transition-all duration-300 cursor-default group flex-shrink-0 h-11 sm:h-12"
        >
          <img
            src={brand.logoImage}
            alt={brand.name || "Client Logo"}
            className="h-7 sm:h-8 w-auto max-w-[120px] object-contain filter grayscale opacity-65 contrast-125 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300"
          />
          <span className="text-xs font-semibold text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white tracking-tight transition-colors pr-2">
            {brand.name}
          </span>
        </div>
      );
    }

    // 3. Text Only Pill (Fallback if no logo image uploaded)
    return (
      <div
        key={`${brand.id || index}-${index}`}
        className="flex items-center justify-center gap-2 bg-white/80 dark:bg-[#11121C]/80 backdrop-blur-xs border border-gray-200/80 dark:border-gray-800 hover:border-[#8B0021]/50 dark:hover:border-rose-500 rounded-full px-4.5 py-2 shadow-2xs hover:shadow-sm transition-all duration-300 cursor-default group flex-shrink-0 h-10 sm:h-11"
      >
        <div className="w-1.5 h-1.5 rounded-full bg-gray-400 dark:bg-gray-600 group-hover:bg-[#8B0021] dark:group-hover:bg-rose-500 transition-colors flex-shrink-0" />
        <span className="text-xs font-semibold text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white tracking-tight transition-colors whitespace-nowrap">
          {brand.name || "Client Partner"}
        </span>
        {brand.label && (
          <span className="text-[10px] text-gray-400 dark:text-gray-500 font-normal whitespace-nowrap">
            &bull; {brand.label}
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
            className="flex items-center gap-4 sm:gap-6 pr-6"
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
            className="flex items-center gap-4 sm:gap-6 pr-6"
          >
            {row2Items.map((brand, i) => renderBrandPill(brand, i + 500))}
          </motion.div>
        </div>
      </div>
    </section>
  );
};
