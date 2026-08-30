"use client";

import React, { useState, useEffect } from "react";
import Link from "next/link";
import { motion } from "framer-motion";
import { Search, User } from "lucide-react";

interface NavbarProps {
  onOpenSearch?: () => void;
}

export const Navbar: React.FC<NavbarProps> = ({ onOpenSearch }) => {
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 20);
    };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  return (
    <motion.header
      initial={{ y: -20, opacity: 0 }}
      animate={{ y: 0, opacity: 1 }}
      transition={{ duration: 0.5, ease: [0.16, 1, 0.3, 1] }}
      className={`sticky top-0 left-0 right-0 z-50 transition-all duration-300 ${
        scrolled
          ? "py-3 bg-white/90 backdrop-blur-md shadow-sm border-b border-gray-200/80"
          : "py-4 bg-white/70 backdrop-blur-sm border-b border-gray-200/40"
      }`}
    >
      <div className="max-w-[1160px] mx-auto px-6 flex items-center justify-between gap-6">
        {/* Brand Logo */}
        <Link href="#hero" className="flex items-center gap-2.5 group">
          <motion.div
            whileHover={{ scale: 1.08, rotate: 5 }}
            whileTap={{ scale: 0.95 }}
            className="w-8 h-8 rounded-lg bg-brand-800 flex items-center justify-center text-white shadow-sm"
          >
            <svg
              className="w-5 h-5"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2.5"
              strokeLinecap="round"
              strokeLinejoin="round"
            >
              <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
              <polyline points="2 17 12 22 22 17"></polyline>
              <polyline points="2 12 12 17 22 12"></polyline>
            </svg>
          </motion.div>
          <span className="font-extrabold text-lg tracking-tight text-gray-900 group-hover:text-brand-800 transition-colors">
            SOLVETA
          </span>
        </Link>

        {/* Center Search Bar with keyboard shortcut */}
        <div
          onClick={onOpenSearch}
          className="hidden md:flex items-center gap-2.5 bg-gray-50 hover:bg-gray-100/80 border border-gray-200 hover:border-gray-300 rounded-full px-3.5 py-1.5 w-full max-w-[320px] cursor-pointer transition-all duration-200"
        >
          <Search className="w-3.5 h-3.5 text-gray-400" />
          <span className="text-xs text-gray-400 font-normal flex-grow">
            Search solutions...
          </span>
          <span className="font-mono text-[10px] font-semibold text-gray-400 bg-white border border-gray-200 px-1.5 py-0.5 rounded">
            ⌘ K
          </span>
        </div>

        {/* Right Links & Actions */}
        <div className="flex items-center gap-6">
          <nav className="hidden lg:flex items-center gap-5 text-xs font-medium text-gray-600">
            <Link
              href="#services"
              className="hover:text-gray-950 transition-colors"
            >
              Services
            </Link>
            <Link
              href="#pricing"
              className="hover:text-gray-950 transition-colors"
            >
              Pricing
            </Link>
            <Link
              href="#contact"
              className="hover:text-gray-950 transition-colors"
            >
              Contact
            </Link>
          </nav>

          <motion.a
            whileHover={{ scale: 1.03 }}
            whileTap={{ scale: 0.97 }}
            href="https://wa.me/6285719663154"
            target="_blank"
            rel="noopener noreferrer"
            className="px-4 py-2 text-xs font-semibold text-white bg-brand-800 hover:bg-brand-900 rounded-md transition-all shadow-sm flex items-center justify-center"
          >
            Hubungi Kami
          </motion.a>

          <motion.button
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
            aria-label="User Profile"
            className="w-8 h-8 rounded-md border border-gray-200 bg-white hover:bg-gray-50 flex items-center justify-center text-gray-700 transition-colors"
          >
            <User className="w-4 h-4" />
          </motion.button>
        </div>
      </div>
    </motion.header>
  );
};
