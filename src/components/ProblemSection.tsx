"use client";

import React, { useRef } from "react";
import { motion, useInView } from "framer-motion";
import {
  FileCode2,
  Database,
  Repeat,
  FileSpreadsheet,
  Globe2,
  Sparkles,
  CheckCircle2,
} from "lucide-react";

const challengePoints = [
  {
    icon: FileSpreadsheet,
    title: "Proses yang Masih Manual",
  },
  {
    icon: FileCode2,
    title: "Informasi yang Belum Terstruktur",
  },
  {
    icon: Repeat,
    title: "Pekerjaan yang Berulang",
  },
  {
    icon: Database,
    title: "Data yang Sulit Dikelola",
  },
  {
    icon: Globe2,
    title: "Kebutuhan Kehadiran Digital Profesional",
  },
];

export const ProblemSection: React.FC = () => {
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-60px" });

  return (
    <section id="problems" className="py-20 bg-white border-b border-gray-100">
      <div className="max-w-[1080px] mx-auto px-6 text-center">
        {/* Section Header */}
        <motion.div
          ref={ref}
          initial={{ opacity: 0, y: 20 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 20 }}
          transition={{ duration: 0.6, ease: [0.16, 1, 0.3, 1] }}
          className="space-y-3 mb-10"
        >
          <span className="font-mono text-[11px] font-bold tracking-widest text-[#8B0021] uppercase bg-rose-50 border border-rose-100 px-4 py-1.5 rounded-full inline-block">
            TANTANGAN BISNIS &bull; SOLUSI TEPAT
          </span>
          <h2 className="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-950 tracking-tight leading-tight">
            Setiap bisnis memiliki tantangan yang berbeda.
          </h2>
          <p className="max-w-2xl mx-auto text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed font-normal">
            Tidak semua masalah membutuhkan solusi yang kompleks. Yang dibutuhkan adalah <strong className="text-gray-900 font-bold">teknologi yang tepat untuk menyelesaikan masalah yang tepat</strong>.
          </p>
        </motion.div>

        {/* Poin-Poin Kotak Oval Panjang dengan Stroke Garis */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 20 }}
          transition={{ duration: 0.6, delay: 0.15, ease: [0.16, 1, 0.3, 1] }}
          className="flex flex-wrap items-center justify-center gap-3.5 max-w-4xl mx-auto mb-12"
        >
          {challengePoints.map((item, idx) => {
            const Icon = item.icon;
            return (
              <motion.div
                key={item.title}
                initial={{ opacity: 0, scale: 0.92 }}
                animate={isInView ? { opacity: 1, scale: 1 } : { opacity: 0, scale: 0.92 }}
                transition={{ duration: 0.4, delay: 0.1 + idx * 0.07 }}
                whileHover={{ scale: 1.04, y: -2 }}
                className="inline-flex items-center gap-2.5 bg-white hover:bg-rose-50/40 border-2 border-gray-200 hover:border-[#8B0021] rounded-full px-5 py-2.5 shadow-2xs hover:shadow-sm transition-all duration-300 cursor-default group"
              >
                <div className="w-6 h-6 rounded-full bg-rose-50 group-hover:bg-[#8B0021] text-[#8B0021] group-hover:text-white flex items-center justify-center transition-colors flex-shrink-0">
                  <Icon className="w-3.5 h-3.5" />
                </div>
                <span className="text-xs sm:text-sm font-bold text-gray-800 group-hover:text-[#7B0B1E] tracking-tight transition-colors whitespace-nowrap">
                  {item.title}
                </span>
              </motion.div>
            );
          })}
        </motion.div>

        {/* Deskripsi Panjang Penjelasan Pendekatan SOLVETA */}
        <motion.div
          initial={{ opacity: 0, y: 25 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 25 }}
          transition={{ duration: 0.6, delay: 0.3, ease: [0.16, 1, 0.3, 1] }}
          className="max-w-3xl mx-auto p-8 rounded-2xl bg-white border border-gray-200/90 shadow-xs hover:border-rose-200 transition-colors text-center space-y-4"
        >
          <div className="inline-flex items-center gap-1.5 text-xs font-bold text-[#8B0021] uppercase tracking-wider">
            <CheckCircle2 className="w-4 h-4" />
            <span>Pendekatan Terarah SOLVETA</span>
          </div>

          <h3 className="text-lg sm:text-xl md:text-2xl font-extrabold text-gray-950 leading-snug">
            SOLVETA membantu bisnis melakukan digitalisasi dengan pendekatan yang terarah.
          </h3>

          <p className="text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed max-w-2xl mx-auto">
            Kami memahami kebutuhan bisnis, merancang solusi, dan membangun teknologi yang dapat membantu proses bisnis menjadi lebih terstruktur, efisien, dan siap berkembang.
          </p>
        </motion.div>
      </div>
    </section>
  );
};
