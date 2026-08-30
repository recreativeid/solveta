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
            scale: 1.04,
            filter: "blur(8px)",
            transition: { duration: 0.8, ease: [0.16, 1, 0.3, 1] },
          }}
          className="fixed inset-0 z-[100] bg-white flex flex-col items-center justify-center p-6 select-none overflow-hidden"
        >
          {/* Ambient maroon glow */}
          <div className="absolute w-[500px] h-[500px] bg-gradient-to-br from-rose-100/60 via-red-50/40 to-transparent rounded-full blur-[120px] pointer-events-none" />

          <div className="relative z-10 flex flex-col items-center max-w-sm w-full text-center">
            {/* Logo Image with soft gentle entry */}
            <motion.div
              initial={{ opacity: 0, scale: 0.88, y: 15 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }}
              className="mb-8"
            >
              <div className="relative flex items-center justify-center">
                <img
                  src={logoSrc}
                  alt="SOLVETA Logo"
                  className="w-36 sm:w-44 h-auto object-contain drop-shadow-md"
                />
              </div>
            </motion.div>

            {/* Slogan */}
            <motion.div
              initial={{ opacity: 0, y: 10 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.4, ease: "easeOut" }}
              className="space-y-1 mb-8"
            >
              <div className="text-[11px] font-mono font-bold tracking-[0.25em] text-[#7B0B1E] uppercase">
                SOLVE TECHNOLOGY AGENCY
              </div>
              <p className="text-[11px] text-gray-400 font-medium">
                Mengubah Tantangan Bisnis Menjadi Solusi Digital
              </p>
            </motion.div>

            {/* Loading Progress Bar running smoothly to the right */}
            <div className="w-full max-w-[280px] space-y-2">
              <div className="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden p-0.5 border border-gray-200/60 shadow-2xs">
                <motion.div
                  className="h-full bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] rounded-full"
                  style={{ width: `${Math.min(100, progress)}%` }}
                  transition={{ ease: "linear" }}
                />
              </div>

              {/* Percentage Counter */}
              <div className="flex items-center justify-between text-[10px] font-mono text-gray-400 px-0.5">
                <span className="uppercase tracking-wider">Memuat Sistem</span>
                <span className="font-bold text-[#7B0B1E]">{Math.round(progress)}%</span>
              </div>
            </div>
          </div>
        </motion.div>
      )}
    </AnimatePresence>
  );
};
