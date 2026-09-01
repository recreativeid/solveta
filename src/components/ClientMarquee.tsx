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
  const logoHeight = data.siteCopy.marqueeLogoHeight || 46;
  const logoSpacing = data.siteCopy.marqueeLogoSpacing || 36;
  const logoScalePercent = (data.siteCopy.marqueeLogoScale || 100) / 100;
  const logoMaxWidth = data.siteCopy.marqueeLogoMaxWidth || 240;

  const renderBrandPill = (brand: ClientBrandItem, index: number) => {
    const hasName = Boolean(brand.name && brand.name.trim().length > 0);
    const hasLogo = Boolean(brand.logoImage && brand.logoImage.trim().length > 0);
    const individualScale = brand.scale || 1.0;
    const effectiveScale = logoScalePercent * individualScale;
    const finalHeight = Math.round(logoHeight * effectiveScale);
    const finalMaxWidth = Math.round(logoMaxWidth * effectiveScale);

    // 1. Logo Mode (Dynamic Custom Height, Scale & Spacing, Invert to Pure Crisp White in Dark Mode)
    if (hasLogo) {
      return (
        <div
          key={`${brand.id || index}-${index}`}
          style={{ paddingLeft: `${logoSpacing}px`, paddingRight: `${logoSpacing}px` }}
          className="flex items-center justify-center py-2 flex-shrink-0 group cursor-default transition-all duration-300"
        >
          <img
            src={brand.logoImage}
            alt={brand.name || "Client Logo"}
            style={{
              height: `${finalHeight}px`,
              maxHeight: `${Math.round(finalHeight * 1.35)}px`,
              maxWidth: `${finalMaxWidth}px`,
            }}
            className="w-auto object-contain select-none pointer-events-none filter grayscale opacity-80 contrast-125 dark:invert dark:opacity-95 dark:contrast-125 group-hover:grayscale-0 group-hover:dark:invert-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300"
          />
        </div>
      );
    }

    // 2. Pure Typography / Brand Name Mode
    return (
      <div
        key={`${brand.id || index}-${index}`}
        style={{ paddingLeft: `${logoSpacing}px`, paddingRight: `${logoSpacing}px` }}
        className="flex items-center justify-center py-2 flex-shrink-0 group cursor-default transition-all duration-300"
      >
        <span
          style={{ fontSize: `${Math.max(14, Math.round(finalHeight * 0.42))}px` }}
          className="font-black font-sans tracking-tight text-gray-800 dark:text-white/90 group-hover:text-black dark:group-hover:text-white group-hover:scale-105 transition-all duration-300 select-none whitespace-nowrap"
        >
          {brand.name || "Partner"}
        </span>
      </div>
    );
  };

  return (
    <section className="py-12 sm:py-14 bg-white dark:bg-[#07080E] border-y border-gray-100 dark:border-gray-800 overflow-hidden relative transition-colors duration-200">
      <div className="max-w-[1160px] mx-auto px-6 mb-7 text-center">
        <p className="text-[11px] sm:text-xs font-mono font-bold tracking-widest text-gray-400 dark:text-gray-500 uppercase">
          {data.siteCopy.marqueeTitle || "DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG"}
        </p>
      </div>

      {/* Gradient Fades on edges */}
      <div className="absolute top-0 bottom-0 left-0 w-28 sm:w-40 bg-gradient-to-r from-white dark:from-[#07080E] to-transparent z-10 pointer-events-none" />
      <div className="absolute top-0 bottom-0 right-0 w-28 sm:w-40 bg-gradient-to-l from-white dark:from-[#07080E] to-transparent z-10 pointer-events-none" />

      {/* Dual Row Flowing Marquee: Row 1 flows Right, Row 2 flows Left */}
      <div className="space-y-5">
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
