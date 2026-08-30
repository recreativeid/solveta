"use client";

import React, { useRef } from "react";
import { motion, useInView } from "framer-motion";
import { ArrowRight, Sparkles } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";

export const PhilosophySection: React.FC = () => {
  const { data } = useSiteData();
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-60px" });

  return (
    <section id="philosophy" className="py-24 bg-white border-t border-gray-100">
      <div className="max-w-[840px] mx-auto px-6 text-center">
        <motion.div
          ref={ref}
          initial={{ opacity: 0, y: 25 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 25 }}
          transition={{ duration: 0.6, ease: [0.16, 1, 0.3, 1] }}
          className="space-y-8"
        >
          {/* Paragraph 1: Business Challenges */}
          <p className="text-sm sm:text-base md:text-lg text-gray-700 leading-relaxed font-normal">
            Setiap bisnis memiliki tantangan yang berbeda. Proses yang masih manual. Informasi yang belum terstruktur. Pekerjaan yang berulang. Data yang sulit dikelola. Atau kebutuhan untuk membangun kehadiran digital yang lebih profesional. Tidak semua masalah membutuhkan solusi yang kompleks. Yang dibutuhkan adalah teknologi yang tepat untuk menyelesaikan masalah yang tepat.
          </p>

          {/* Paragraph 2: Core Proposition */}
          <p className="text-base sm:text-lg md:text-xl font-bold text-gray-950 leading-relaxed">
            SOLVETA membantu bisnis melakukan digitalisasi dengan pendekatan yang terarah.
          </p>

          {/* Paragraph 3: Approach */}
          <p className="text-sm sm:text-base md:text-lg text-gray-700 leading-relaxed">
            Kami memahami kebutuhan bisnis, merancang solusi, dan membangun teknologi yang dapat membantu proses bisnis menjadi lebih terstruktur, efisien, dan siap berkembang.
          </p>

          {/* Slogan in Merah Maroon Premium Gradasi */}
          <div className="pt-4 pb-2">
            <div className="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight leading-snug">
              <span className="bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] bg-clip-text text-transparent">
                Bukan sekadar membangun teknologi.
              </span>
              <br />
              <span className="text-gray-950">Kami membangun solusi.</span>
            </div>
          </div>

          {/* WhatsApp CTA Button with Maroon Gradient */}
          <div className="pt-2">
            <motion.a
              whileHover={{ scale: 1.04, y: -2 }}
              whileTap={{ scale: 0.97 }}
              href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
                "Halo SOLVETA, saya ingin berkonsultasi mengenai kebutuhan solusi digital dan teknologi untuk bisnis saya."
              )}`}
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-2.5 px-8 py-3.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white text-xs sm:text-sm font-bold rounded-xl shadow-md hover:shadow-xl transition-all duration-300"
            >
              <span>Konsultasikan Kebutuhan Anda</span>
              <ArrowRight className="w-4 h-4 text-rose-200" />
            </motion.a>
          </div>
        </motion.div>
      </div>
    </section>
  );
};
