"use client";

import React, { useRef } from "react";
import { motion, useInView } from "framer-motion";
import { useSiteData } from "@/context/SiteDataContext";

export const ConsultationCTA: React.FC = () => {
  const { data } = useSiteData();
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });

  return (
    <section id="contact" className="py-16 bg-white">
      <div className="max-w-[1160px] mx-auto px-6">
        <motion.div
          ref={ref}
          initial={{ opacity: 0, scale: 0.98, y: 30 }}
          animate={
            isInView
              ? { opacity: 1, scale: 1, y: 0 }
              : { opacity: 0, scale: 0.98, y: 30 }
          }
          transition={{ duration: 0.6, ease: [0.16, 1, 0.3, 1] }}
          className="bg-gray-50 border border-gray-200 rounded-3xl px-8 py-16 sm:py-20 text-center shadow-xs"
        >
          <h2 className="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-950 tracking-tight mb-4">
            {data.siteCopy.consultationTitle}
          </h2>
          <p className="max-w-[620px] mx-auto text-xs sm:text-sm text-gray-600 leading-relaxed mb-8 whitespace-pre-line">
            {data.siteCopy.consultationDesc}
          </p>

          <motion.a
            whileHover={{ scale: 1.03 }}
            whileTap={{ scale: 0.97 }}
            href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
              "Halo SOLVETA, saya ingin konsultasi gratis mengenai solusi digital bisnis saya."
            )}`}
            target="_blank"
            rel="noopener noreferrer"
            className="inline-flex items-center justify-center px-6 py-3 text-xs sm:text-sm font-semibold text-white bg-brand-800 hover:bg-brand-900 rounded-lg shadow-sm transition-all mb-10"
          >
            Konsultasi Gratis Sekarang
          </motion.a>

          <div className="font-mono text-[11px] font-bold tracking-widest text-gray-700 uppercase">
            TEKNOLOGI YANG BEKERJA UNTUK BISNIS.
          </div>
        </motion.div>
      </div>
    </section>
  );
};
