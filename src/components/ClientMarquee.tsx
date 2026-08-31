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
    if (brand.logoImage) {
      return (
        <div
          key={`${brand.id || index}-${index}`}
          className="flex items-center justify-center bg-white dark:bg-[#11121C] border border-gray-200 dark:border-gray-800 hover:border-brand-600 dark:hover:border-rose-500 rounded-full overflow-hidden shadow-2xs hover:shadow-sm transition-all duration-300 cursor-default group flex-shrink-0 h-10 sm:h-11"
        >
          <img
            src={brand.logoImage}
            alt={brand.name || "Client Logo"}
            className="h-full w-auto max-w-[160px] object-cover rounded-full transition-transform duration-300 group-hover:scale-105"
          />
          {brand.name && brand.name.trim().length > 0 && (
            <span className="text-xs font-bold text-gray-800 dark:text-gray-200 group-hover:text-brand-900 dark:group-hover:text-rose-300 tracking-tight transition-colors px-3.5">
              {brand.name}
            </span>
          )}
        </div>
      );
    }

    return (
      <div
        key={`${brand.id || index}-${index}`}
        className="flex items-center justify-center gap-2 bg-white dark:bg-[#11121C] border border-gray-200 dark:border-gray-800 hover:border-brand-600 dark:hover:border-rose-500 rounded-full px-5 py-2 shadow-2xs hover:shadow-sm transition-all duration-300 cursor-default group flex-shrink-0 h-10 sm:h-11"
      >
        <div className="w-2 h-2 rounded-full bg-brand-700 dark:bg-rose-500 group-hover:scale-125 transition-transform flex-shrink-0" />
        <span className="text-xs font-bold text-gray-800 dark:text-gray-200 group-hover:text-brand-900 dark:group-hover:text-rose-300 tracking-tight transition-colors whitespace-nowrap">
          {brand.name}
        </span>
        {brand.label && (
          <span className="text-[10px] text-gray-400 dark:text-gray-500 font-medium whitespace-nowrap">
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

      {/* Dual Row Flowing Marquee */}
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
            className="flex items-center gap-4 pr-4"
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
            className="flex items-center gap-4 pr-4"
          >
            {row2Items.map((brand, i) => renderBrandPill(brand, i + 500))}
          </motion.div>
        </div>
      </div>
    </section>
  );
};
