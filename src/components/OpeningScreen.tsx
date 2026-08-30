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
    // 5 seconds loading interval (progress from 0 to 100)
    const totalDuration = 5000; // 5 seconds
    const intervalTime = 50; // update every 50ms
    const step = 100 / (totalDuration / intervalTime);

    const timer = setInterval(() => {
      setProgress((prev) => {
        const next = prev + step;
        if (next >= 100) {
          clearInterval(timer);
          setTimeout(() => setIsVisible(false), 300);
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
            scale: 1.03,
            filter: "blur(6px)",
            transition: { duration: 0.8, ease: [0.16, 1, 0.3, 1] },
          }}
          className="fixed inset-0 z-[100] bg-white flex flex-col items-center justify-center p-6 select-none overflow-hidden font-sans"
        >
          <div className="flex flex-col items-center max-w-lg w-full text-center">
            {/* Logo Image without shadows, pure white seamless blend, enlarged */}
            <motion.div
              initial={{ opacity: 0, scale: 0.9, y: 15 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }}
              className="mb-8 flex items-center justify-center"
            >
              <img
                src={logoSrc}
                alt="SOLVETA"
                className="w-64 sm:w-80 md:w-96 h-auto object-contain mix-blend-multiply"
              />
            </motion.div>

            {/* Slogan with Poppins font */}
            <motion.div
              initial={{ opacity: 0, y: 10 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.3, ease: "easeOut" }}
              className="space-y-1.5 mb-8 font-sans"
            >
              <div className="text-xs sm:text-sm font-extrabold tracking-[0.2em] text-[#8B0021] uppercase">
                SOLVE TECHNOLOGY AGENCY
              </div>
              <p className="text-xs sm:text-sm text-gray-500 font-medium">
                Mengubah Tantangan Bisnis Menjadi Solusi Digital
              </p>
            </motion.div>

            {/* Loading Progress Bar running smoothly to the right */}
            <div className="w-full max-w-[320px] sm:max-w-[380px] space-y-2.5 font-sans">
              <div className="h-2 w-full bg-gray-100 rounded-full overflow-hidden p-0.5 border border-gray-200/80">
                <motion.div
                  className="h-full bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] rounded-full"
                  style={{ width: `${Math.min(100, progress)}%` }}
                  transition={{ ease: "linear" }}
                />
              </div>

              {/* Status and Percentage in Poppins font */}
              <div className="flex items-center justify-between text-xs font-semibold text-gray-500 px-1">
                <span className="tracking-wider uppercase text-[11px] text-gray-400">
                  MEMUAT SISTEM
                </span>
                <span className="font-bold text-[#8B0021] text-xs">
                  {Math.round(progress)}%
                </span>
              </div>
            </div>
          </div>
        </motion.div>
      )}
    </AnimatePresence>
  );
};
