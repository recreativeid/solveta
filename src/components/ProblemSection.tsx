"use client";

import React, { useRef } from "react";
import { motion, useInView } from "framer-motion";
import {
  FileCode2,
  Database,
  Repeat,
  FileSpreadsheet,
  Globe2,
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
    <section id="problems" className="py-20 bg-white dark:bg-[#07080E] border-b border-gray-100 dark:border-gray-800 transition-colors duration-200">
      <div className="max-w-[1080px] mx-auto px-6 text-center">
        {/* Section Header */}
        <motion.div
          ref={ref}
          initial={{ opacity: 0, y: 20 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 20 }}
          transition={{ duration: 0.6, ease: [0.16, 1, 0.3, 1] }}
          className="space-y-3 mb-10"
        >
          <span className="font-mono text-[11px] font-bold tracking-widest text-[#8B0021] dark:text-rose-400 uppercase bg-rose-50 dark:bg-rose-950/60 border border-rose-100 dark:border-rose-800/60 px-4 py-1.5 rounded-full inline-block">
            TANTANGAN BISNIS &bull; SOLUSI TEPAT
          </span>
          <h2 className="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-950 dark:text-white tracking-tight leading-tight">
            Setiap bisnis memiliki tantangan yang berbeda.
          </h2>
          <p className="max-w-2xl mx-auto text-xs sm:text-sm md:text-base text-gray-600 dark:text-gray-300 leading-relaxed font-normal">
            Tidak semua masalah membutuhkan solusi yang kompleks. Yang dibutuhkan adalah <strong className="text-gray-900 dark:text-white font-bold">teknologi yang tepat untuk menyelesaikan masalah yang tepat</strong>.
          </p>
        </motion.div>

        {/* 5 Challenge Point Cards in Responsive Grid */}
        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3.5 mb-12">
          {challengePoints.map((point, index) => {
            const Icon = point.icon;
            return (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 20 }}
                transition={{
                  duration: 0.5,
                  delay: index * 0.08,
                  ease: [0.16, 1, 0.3, 1],
                }}
                whileHover={{ y: -4 }}
                className="p-4 rounded-xl bg-gray-50/70 dark:bg-[#11121C] border border-gray-200/80 dark:border-gray-800 hover:border-rose-300 dark:hover:border-rose-600 hover:bg-white dark:hover:bg-[#151724] shadow-2xs hover:shadow-xs transition-all duration-300 flex flex-col items-center justify-center text-center group"
              >
                <div className="w-10 h-10 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 group-hover:border-rose-300 dark:group-hover:border-rose-500 flex items-center justify-center text-gray-700 dark:text-gray-300 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 transition-all mb-3 shadow-2xs">
                  <Icon className="w-5 h-5 stroke-[1.8]" />
                </div>
                <span className="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                  {point.title}
                </span>
              </motion.div>
            );
          })}
        </div>

        {/* Highlight Banner */}
        <motion.div
          initial={{ opacity: 0, scale: 0.98 }}
          animate={isInView ? { opacity: 1, scale: 1 } : { opacity: 0, scale: 0.98 }}
          transition={{ duration: 0.6, delay: 0.4 }}
          className="max-w-2xl mx-auto p-5 sm:p-6 rounded-2xl bg-gradient-to-r from-rose-50/80 dark:from-rose-950/40 via-red-50/50 dark:via-red-950/20 to-orange-50/80 dark:to-orange-950/30 border border-rose-200/80 dark:border-rose-800/60 shadow-2xs flex items-center justify-center gap-3 text-center"
        >
          <CheckCircle2 className="w-5 h-5 text-[#8B0021] dark:text-rose-400 flex-shrink-0" />
          <p className="text-xs sm:text-sm font-semibold text-gray-900 dark:text-gray-100 leading-snug">
            SOLVETA hadir untuk membantu Anda mengidentifikasi akar masalah dan membangun solusi yang benar-benar Anda butuhkan.
          </p>
        </motion.div>
      </div>
    </section>
  );
};
