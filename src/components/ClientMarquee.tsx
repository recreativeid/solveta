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

    // 1. Logo Mode (Extremely Prominent, Large, Clean, Invert to Pure Crisp White in Dark Mode)
    if (hasLogo) {
      return (
        <div
          key={`${brand.id || index}-${index}`}
          className="flex items-center justify-center px-8 sm:px-12 md:px-16 py-3 flex-shrink-0 group cursor-default transition-all duration-300"
        >
          <img
            src={brand.logoImage}
            alt={brand.name || "Client Logo"}
            className="h-12 sm:h-16 md:h-20 lg:h-24 w-auto max-w-[200px] sm:max-w-[280px] md:max-w-[360px] object-contain select-none pointer-events-none filter grayscale opacity-80 contrast-125 dark:invert dark:opacity-95 dark:contrast-125 group-hover:grayscale-0 group-hover:dark:invert-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300"
          />
        </div>
      );
    }

    // 2. Pure Typography / Brand Name Mode (Large, Crisp & Bold)
    return (
      <div
        key={`${brand.id || index}-${index}`}
        className="flex items-center justify-center px-8 sm:px-12 md:px-16 py-3 flex-shrink-0 group cursor-default transition-all duration-300"
      >
        <span className="text-xl sm:text-2xl md:text-3xl font-black font-sans tracking-tight text-gray-800 dark:text-white/90 group-hover:text-black dark:group-hover:text-white group-hover:scale-105 transition-all duration-300 select-none whitespace-nowrap">
          {brand.name || "Partner"}
        </span>
      </div>
    );
  };

  return (
    <section className="py-14 sm:py-16 bg-white dark:bg-[#07080E] border-y border-gray-100 dark:border-gray-800 overflow-hidden relative transition-colors duration-200">
      <div className="max-w-[1160px] mx-auto px-6 mb-8 text-center">
        <p className="text-[11px] sm:text-xs font-mono font-bold tracking-widest text-gray-400 dark:text-gray-500 uppercase">
          {data.siteCopy.marqueeTitle || "DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG"}
        </p>
      </div>

      {/* Gradient Fades on edges */}
      <div className="absolute top-0 bottom-0 left-0 w-32 sm:w-44 bg-gradient-to-r from-white dark:from-[#07080E] to-transparent z-10 pointer-events-none" />
      <div className="absolute top-0 bottom-0 right-0 w-32 sm:w-44 bg-gradient-to-l from-white dark:from-[#07080E] to-transparent z-10 pointer-events-none" />

      {/* Dual Row Flowing Marquee: Row 1 flows Right, Row 2 flows Left */}
      <div className="space-y-6">
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
            className="flex items-center pr-6"
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
            className="flex items-center pr-6"
          >
            {row2Items.map((brand, i) => renderBrandPill(brand, i + 500))}
          </motion.div>
        </div>
      </div>
    </section>
  );
};
