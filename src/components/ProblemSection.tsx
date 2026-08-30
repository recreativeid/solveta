"use client";

import React, { useRef } from "react";
import { motion, useInView } from "framer-motion";
import { FileText, MessageCircle, Database, LayoutGrid } from "lucide-react";

interface ProblemItem {
  icon: React.ElementType;
  title: string;
  desc: string;
}

const problems: ProblemItem[] = [
  {
    icon: FileText,
    title: "Proses Manual yang Menguras Waktu",
    desc: "Laporan harian, absensi, atau pembukuan yang masih menggunakan kertas.",
  },
  {
    icon: MessageCircle,
    title: "Komunikasi Pelanggan yang Tercecer",
    desc: "Kesulitan merespons pesan pelanggan dengan cepat dan konsisten.",
  },
  {
    icon: Database,
    title: "Data yang Tidak Terstruktur",
    desc: "Database pelanggan atau inventaris barang yang berantakan dan sulit dicari.",
  },
  {
    icon: LayoutGrid,
    title: "Kebutuhan Sistem Spesifik",
    desc: "Aplikasi pasaran tidak cocok dengan alur kerja (workflow) unik perusahaan Anda.",
  },
];

export const ProblemSection: React.FC = () => {
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });

  return (
    <section id="solutions" className="py-16 bg-white">
      <div className="max-w-[1160px] mx-auto px-6">
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 15 }}
          transition={{ duration: 0.5 }}
          className="mb-8"
        >
          <h2 className="text-sm sm:text-base font-bold uppercase tracking-wider text-gray-900">
            DIGITALISASI UNTUK MASALAH BISNIS YANG NYATA
          </h2>
        </motion.div>

        <div
          ref={ref}
          className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5"
        >
          {problems.map((item, index) => {
            const Icon = item.icon;
            return (
              <motion.div
                key={item.title}
                initial={{ opacity: 0, y: 25 }}
                animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 25 }}
                transition={{
                  duration: 0.5,
                  delay: index * 0.1,
                  ease: [0.16, 1, 0.3, 1],
                }}
                whileHover={{ y: -4, scale: 1.01 }}
                className="bg-white border border-gray-200 hover:border-gray-300 rounded-xl p-6 flex flex-col justify-between shadow-xs hover:shadow-md transition-all duration-200"
              >
                <div>
                  <div className="w-10 h-10 rounded-lg bg-brand-50 border border-brand-100 text-brand-700 flex items-center justify-center mb-5">
                    <Icon className="w-5 h-5" />
                  </div>
                  <h3 className="text-sm font-bold text-gray-900 leading-snug mb-2">
                    {item.title}
                  </h3>
                  <p className="text-xs text-gray-500 leading-relaxed">
                    {item.desc}
                  </p>
                </div>
              </motion.div>
            );
          })}
        </div>
      </div>
    </section>
  );
};
