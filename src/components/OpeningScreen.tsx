"use client";

import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { useSiteData } from "@/context/SiteDataContext";

export const OpeningScreen: React.FC = () => {
  const { data } = useSiteData();
  const [isVisible, setIsVisible] = useState(true);
  const [progress, setProgress] = useState(0);

  // Logo source: uploaded siteLogo, or public official solveta-logo.png
  const logoSrc = data.siteCopy.siteLogo || "./solveta-logo.png";

  useEffect(() => {
    // Smooth loading interval (progress from 0 to 100)
    const totalDuration = 4200; // ~4.2 seconds
    const intervalTime = 40; // update every 40ms
    const step = 100 / (totalDuration / intervalTime);

    const timer = setInterval(() => {
      setProgress((prev) => {
        const next = prev + step;
        if (next >= 100) {
          clearInterval(timer);
          setTimeout(() => setIsVisible(false), 200);
          return 100;
        }
        return next;
      });
    }, intervalTime);

    return () => clearInterval(timer);
  }, []);

  return (
    <AnimatePresence>
      {isVisible && (
        <motion.div
          initial={{ opacity: 1 }}
          exit={{
            opacity: 0,
            scale: 1.04,
            filter: "blur(24px)",
            transition: {
              duration: 1.0,
              ease: [0.22, 1, 0.36, 1], // Soft luxury cubic-bezier easing
            },
          }}
          className="fixed inset-0 z-[100] bg-white flex flex-col items-center justify-center p-6 select-none overflow-hidden font-sans"
        >
          {/* Inner Content (Dissolves with Soft Blur on exit) */}
          <motion.div
            initial={{ opacity: 1, y: 0 }}
            exit={{
              opacity: 0,
              y: -18,
              scale: 0.96,
              filter: "blur(14px)",
              transition: { duration: 0.8, ease: [0.22, 1, 0.36, 1] },
            }}
            className="flex flex-col items-center max-w-lg w-full text-center relative z-10"
          >
            {/* Logo Image - 100% Pure White Seamless Blend without Box */}
            <motion.div
              initial={{ opacity: 0, scale: 0.9, y: 12 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              transition={{ duration: 1.0, ease: [0.16, 1, 0.3, 1] }}
              className="mb-4 flex items-center justify-center bg-transparent"
            >
              <img
                src={logoSrc}
                alt="SOLVETA"
                className="w-64 sm:w-80 md:w-96 h-auto object-contain bg-transparent"
              />
            </motion.div>

            {/* Loading Progress Bar */}
            <motion.div
              initial={{ opacity: 0, y: 10 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.2, ease: "easeOut" }}
              className="w-full max-w-[280px] sm:max-w-[340px] space-y-2.5 font-sans mt-2"
            >
              <div className="h-1.5 sm:h-2 w-full bg-gray-100 rounded-full overflow-hidden p-0.5 border border-gray-200 shadow-inner">
                <motion.div
                  className="h-full bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] rounded-full shadow-sm"
                  style={{ width: `${Math.min(100, progress)}%` }}
                  transition={{ ease: "linear" }}
                />
              </div>

              {/* Status and Percentage */}
              <div className="flex items-center justify-between text-xs font-semibold text-gray-500 px-1">
                <span className="tracking-wider uppercase text-[10px] sm:text-[11px] text-gray-400 font-medium flex items-center gap-1.5">
                  <span className="w-1.5 h-1.5 rounded-full bg-[#8B0021] animate-ping" />
                  <span>MEMUAT SISTEM</span>
                </span>
                <span className="font-bold text-[#8B0021] text-xs font-mono">
                  {Math.round(progress)}%
                </span>
              </div>
            </motion.div>
          </motion.div>
        </motion.div>
      )}
    </AnimatePresence>
  );
};
