"use client";

import React, { useState } from "react";
import { motion } from "framer-motion";
import { MessageSquare, ChevronRight } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";

export const Hero: React.FC = () => {
  const { data } = useSiteData();
  const [query, setQuery] = useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    const text = query.trim() || "Halo SOLVETA, saya ingin berkonsultasi mengenai solusi digital.";
    window.open(
      `https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(text)}`,
      "_blank"
    );
  };

  return (
    <section id="hero" className="pt-20 pb-14 text-center relative overflow-hidden">
      {/* Background ambient lighting */}
      <div className="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-red-100/40 rounded-full blur-[100px] pointer-events-none -z-10" />

      <div className="max-w-[1160px] mx-auto px-6">
        {/* Eyebrow Pill */}
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5, ease: [0.16, 1, 0.3, 1] }}
          className="inline-block"
        >
          <span className="inline-flex items-center font-mono text-[11px] font-semibold uppercase tracking-wider text-gray-700 bg-gray-100 border border-gray-200 px-3.5 py-1.5 rounded-full mb-6 shadow-xs">
            {data.siteCopy.heroEyebrow}
          </span>
        </motion.div>

        {/* Main Headline */}
        <motion.h1
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.1, ease: [0.16, 1, 0.3, 1] }}
          className="text-4xl sm:text-5xl md:text-[3.25rem] font-extrabold text-gray-950 tracking-tight leading-[1.18] mb-5 whitespace-pre-line"
        >
          {data.siteCopy.heroHeadline}
        </motion.h1>

        {/* Narrative Subtitle */}
        <motion.p
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.2, ease: [0.16, 1, 0.3, 1] }}
          className="max-w-[740px] mx-auto text-sm sm:text-base text-gray-600 leading-relaxed mb-10 whitespace-pre-line"
        >
          {data.siteCopy.heroSubtitle}
        </motion.p>

        {/* Interactive Query Input Bar */}
        <motion.form
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.3, ease: [0.16, 1, 0.3, 1] }}
          onSubmit={handleSubmit}
          className="flex items-center max-w-[580px] mx-auto bg-white border border-gray-300 focus-within:border-gray-500 rounded-xl p-1.5 pl-4 shadow-sm focus-within:shadow-md transition-all duration-200"
        >
          <MessageSquare className="w-4 h-4 text-gray-400 mr-3 flex-shrink-0" />
          <input
            type="text"
            value={query}
            onChange={(e) => setQuery(e.target.value)}
            placeholder="Ceritakan tantangan bisnis Anda..."
            className="flex-grow bg-transparent text-sm text-gray-900 placeholder-gray-400 outline-none"
          />
          <motion.button
            whileHover={{ scale: 1.02 }}
            whileTap={{ scale: 0.98 }}
            type="submit"
            className="inline-flex items-center gap-1 text-xs font-semibold text-white bg-brand-800 hover:bg-brand-900 px-4 py-2 rounded-lg transition-colors"
          >
            <span>Kirim</span>
            <ChevronRight className="w-3.5 h-3.5" />
          </motion.button>
        </motion.form>
      </div>
    </section>
  );
};
