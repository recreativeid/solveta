"use client";

import React, { useState, useEffect } from "react";
import Link from "next/link";
import { motion } from "framer-motion";
import { Search, User } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";

interface NavbarProps {
  onOpenSearch?: () => void;
}

export const Navbar: React.FC<NavbarProps> = ({ onOpenSearch }) => {
  const { data } = useSiteData();
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 20);
    };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  const logoSrc = data.siteCopy.siteLogo || "./solveta-logo.png";

  return (
    <motion.header
      initial={{ y: -20, opacity: 0 }}
      animate={{ y: 0, opacity: 1 }}
      transition={{ duration: 0.5, ease: [0.16, 1, 0.3, 1] }}
      className={`sticky top-0 left-0 right-0 z-50 transition-all duration-300 ${
        scrolled
          ? "py-3 bg-white/95 backdrop-blur-md shadow-2xs border-b border-gray-200/80"
          : "py-4 bg-white/80 backdrop-blur-sm border-b border-gray-200/40"
      }`}
    >
      <div className="max-w-[1160px] mx-auto px-6 flex items-center justify-between gap-6">
        {/* Brand Logo in Top-Left Navbar */}
        <Link href="#hero" className="flex items-center gap-2.5 group">
          <motion.div
            whileHover={{ scale: 1.08 }}
            whileTap={{ scale: 0.95 }}
            className="h-9 w-9 rounded-xl overflow-hidden flex items-center justify-center bg-white border border-gray-200 shadow-2xs group-hover:border-rose-300 transition-all"
          >
            <img
              src={logoSrc}
              alt="SOLVETA Logo"
              className="h-full w-full object-cover"
            />
          </motion.div>
          <div className="flex flex-col">
            <span className="font-extrabold text-base tracking-tight text-gray-950 group-hover:text-[#7B0B1E] transition-colors leading-none">
              SOLVETA
            </span>
            <span className="text-[9px] font-mono text-gray-400 font-semibold tracking-wider uppercase mt-0.5">
              SOLUTIONS
            </span>
          </div>
        </Link>

        {/* Center Search Bar with keyboard shortcut */}
        <div
          onClick={onOpenSearch}
          className="hidden md:flex items-center gap-2.5 bg-gray-50/80 hover:bg-gray-100 border border-gray-200 hover:border-gray-300 rounded-full px-3.5 py-1.5 w-full max-w-[320px] cursor-pointer transition-all duration-200"
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
        <div className="flex items-center gap-5">
          <nav className="hidden lg:flex items-center gap-5 text-xs font-semibold text-gray-600">
            <Link
              href="#services"
              className="hover:text-[#7B0B1E] transition-colors"
            >
              Services
            </Link>
            <Link
              href="#pricing"
              className="hover:text-[#7B0B1E] transition-colors"
            >
              Pricing
            </Link>
            <Link
              href="#contact"
              className="hover:text-[#7B0B1E] transition-colors"
            >
              Contact
            </Link>
          </nav>

          <motion.a
            whileHover={{ scale: 1.04 }}
            whileTap={{ scale: 0.96 }}
            href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
              "Halo SOLVETA, saya ingin berkonsultasi mengenai solusi digital dan pembuatan website."
            )}`}
            target="_blank"
            rel="noopener noreferrer"
            className="px-4 py-2 text-xs font-bold text-white bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] rounded-lg transition-all shadow-xs flex items-center justify-center"
          >
            Hubungi Kami
          </motion.a>

          <Link
            href="/admin"
            title="Portal Developer"
            className="w-8 h-8 rounded-lg border border-gray-200 bg-white hover:bg-rose-50/50 hover:border-rose-200 flex items-center justify-center text-gray-700 hover:text-[#7B0B1E] transition-colors"
          >
            <User className="w-4 h-4" />
          </Link>
        </div>
      </div>
    </motion.header>
  );
};
