"use client";

import React, { useState, useEffect } from "react";
import Link from "next/link";
import { motion } from "framer-motion";
import { Search, User, Sun, Moon } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";
import { useTheme } from "@/context/ThemeContext";

interface NavbarProps {
  onOpenSearch?: () => void;
}

export const Navbar: React.FC<NavbarProps> = ({ onOpenSearch }) => {
  const { data } = useSiteData();
  const { theme, toggleTheme } = useTheme();
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 20);
    };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  const logoSrc = data.siteCopy.siteLogo || "./solveta-logo.png";
  const isDark = theme === "dark";

  return (
    <motion.header
      initial={{ y: -20, opacity: 0 }}
      animate={{ y: 0, opacity: 1 }}
      transition={{ duration: 0.5, ease: [0.16, 1, 0.3, 1] }}
      className={`sticky top-0 left-0 right-0 z-50 transition-all duration-300 ${
        scrolled
          ? "py-3 bg-white/95 dark:bg-[#07080E]/95 backdrop-blur-md shadow-2xs border-b border-gray-200/80 dark:border-gray-800"
          : "py-4 bg-white/80 dark:bg-[#07080E]/80 backdrop-blur-sm border-b border-gray-200/40 dark:border-gray-800/60"
      }`}
    >
      <div className="max-w-[1160px] mx-auto px-6 flex items-center justify-between gap-4">
        {/* Brand Logo in Top-Left Navbar */}
        <Link href="#hero" className="flex items-center gap-2.5 group">
          <motion.div
            whileHover={{ scale: 1.08 }}
            whileTap={{ scale: 0.95 }}
            className="h-9 w-9 rounded-xl overflow-hidden flex items-center justify-center bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xs group-hover:border-rose-300 dark:group-hover:border-rose-500 transition-all"
          >
            <img
              src={logoSrc}
              alt="SOLVETA Logo"
              className="h-full w-full object-cover"
            />
          </motion.div>
          <div className="flex flex-col">
            <span className="font-extrabold text-base tracking-tight text-gray-950 dark:text-white group-hover:text-[#7B0B1E] dark:group-hover:text-rose-400 transition-colors leading-none">
              SOLVETA
            </span>
            <span className="text-[9px] font-mono text-gray-400 dark:text-gray-500 font-semibold tracking-wider uppercase mt-0.5">
              SOLUTIONS
            </span>
          </div>
        </Link>

        {/* Center Search Bar with keyboard shortcut */}
        <div
          onClick={onOpenSearch}
          className="hidden md:flex items-center gap-2.5 bg-gray-50/80 dark:bg-gray-900/80 hover:bg-gray-100 dark:hover:bg-gray-850 border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-700 rounded-full px-3.5 py-1.5 w-full max-w-[300px] cursor-pointer transition-all duration-200"
        >
          <Search className="w-3.5 h-3.5 text-gray-400" />
          <span className="text-xs text-gray-400 dark:text-gray-500 font-normal flex-grow">
            Search solutions...
          </span>
          <span className="font-mono text-[10px] font-semibold text-gray-400 dark:text-gray-500 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 px-1.5 py-0.5 rounded">
            ⌘ K
          </span>
        </div>

        {/* Right Links & Actions */}
        <div className="flex items-center gap-3 sm:gap-4">
          <nav className="hidden lg:flex items-center gap-5 text-xs font-semibold text-gray-600 dark:text-gray-300">
            <Link
              href="#services"
              className="hover:text-[#7B0B1E] dark:hover:text-rose-400 transition-colors"
            >
              Services
            </Link>
            <Link
              href="#pricing"
              className="hover:text-[#7B0B1E] dark:hover:text-rose-400 transition-colors"
            >
              Pricing
            </Link>
            <Link
              href="#portfolio"
              className="hover:text-[#7B0B1E] dark:hover:text-rose-400 transition-colors"
            >
              Portofolio
            </Link>
          </nav>

          {/* Theme Toggle Button (Light / Dark Mode Switcher) */}
          <motion.button
            whileHover={{ scale: 1.08 }}
            whileTap={{ scale: 0.92 }}
            onClick={toggleTheme}
            aria-label={isDark ? "Ganti ke Tema Terang" : "Ganti ke Tema Gelap"}
            title={isDark ? "Ganti ke Tema Terang (Light Mode)" : "Ganti ke Tema Gelap (Dark Mode)"}
            className="p-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 text-gray-700 dark:text-amber-300 hover:bg-rose-50/50 dark:hover:bg-gray-800 shadow-2xs transition-all flex items-center justify-center cursor-pointer"
          >
            {isDark ? (
              <Sun className="w-4 h-4 text-amber-400 animate-spin-slow" />
            ) : (
              <Moon className="w-4 h-4 text-gray-700 hover:text-[#7B0B1E]" />
            )}
          </motion.button>

          {/* Direct CTA WhatsApp Button */}
          <motion.a
            whileHover={{ scale: 1.04 }}
            whileTap={{ scale: 0.96 }}
            href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
              "Halo SOLVETA, saya ingin berkonsultasi mengenai solusi digital dan pembuatan website."
            )}`}
            target="_blank"
            rel="noopener noreferrer"
            className="px-3.5 sm:px-4 py-2 text-xs font-bold text-white bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] rounded-lg transition-all shadow-xs flex items-center justify-center"
          >
            Hubungi Kami
          </motion.a>

          {/* Developer Portal Icon */}
          <Link
            href="/admin"
            title="Portal Developer"
            className="w-8 h-8 rounded-lg border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 hover:bg-rose-50/50 dark:hover:bg-gray-800 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-[#7B0B1E] dark:hover:text-rose-400 transition-colors"
          >
            <User className="w-4 h-4" />
          </Link>
        </div>
      </div>
    </motion.header>
  );
};
