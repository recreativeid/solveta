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
            scale: 1.05,
            filter: "blur(30px)",
            backdropFilter: "blur(45px)",
            transition: {
              duration: 1.15,
              ease: [0.22, 1, 0.36, 1], // Soft, luxurious cubic-bezier easing
            },
          }}
          className="fixed inset-0 z-[100] bg-white/95 backdrop-blur-3xl flex flex-col items-center justify-center p-6 select-none overflow-hidden font-sans"
        >
          {/* Ambient Soft Glassmorphism Flare Glow */}
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={{ opacity: 1, scale: 1 }}
            exit={{ opacity: 0, scale: 1.35, filter: "blur(50px)" }}
            transition={{ duration: 1.2, ease: "easeOut" }}
            className="absolute w-[520px] h-[320px] bg-gradient-to-r from-[#8B0021]/15 via-rose-500/10 to-[#50000F]/15 rounded-full blur-[95px] pointer-events-none -z-10"
          />

          {/* Inner Content Card (Dissolves with Soft Blur & Lift) */}
          <motion.div
            initial={{ opacity: 1, y: 0 }}
            exit={{
              opacity: 0,
              y: -22,
              scale: 0.95,
              filter: "blur(18px)",
              transition: { duration: 0.9, ease: [0.22, 1, 0.36, 1] },
            }}
            className="flex flex-col items-center max-w-lg w-full text-center relative z-10"
          >
            {/* Logo Image */}
            <motion.div
              initial={{ opacity: 0, scale: 0.9, y: 15 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }}
              className="mb-4 flex items-center justify-center"
            >
              <img
                src={logoSrc}
                alt="SOLVETA"
                className="w-64 sm:w-80 md:w-96 h-auto object-contain mix-blend-multiply"
              />
            </motion.div>

            {/* Loading Progress Bar with Frosted Glass styling */}
            <motion.div
              initial={{ opacity: 0, y: 10 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.2, ease: "easeOut" }}
              className="w-full max-w-[280px] sm:max-w-[340px] space-y-2.5 font-sans mt-2"
            >
              <div className="h-1.5 sm:h-2 w-full bg-gray-200/60 backdrop-blur-md rounded-full overflow-hidden p-0.5 border border-gray-300/50 shadow-inner">
                <motion.div
                  className="h-full bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] rounded-full shadow-[0_0_12px_rgba(139,0,33,0.5)]"
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
