"use client";

import React, { useState, useRef } from "react";
import { motion, useInView, AnimatePresence } from "framer-motion";
import { ExternalLink, ArrowUpRight, Sparkles } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";

export const PortfolioSection: React.FC = () => {
  const { data } = useSiteData();
  const [selectedCategory, setSelectedCategory] = useState("Semua");
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });

  // Extract unique, non-empty categories from active portfolio items & config
  const activeCategories = Array.from(
    new Set(
      data.portfolio
        .map((p) => p.category?.trim())
        .filter((c): c is string => Boolean(c && c.length > 0))
    )
  );

  const hasCategories = activeCategories.length > 0;
  const filterList = hasCategories ? ["Semua", ...activeCategories] : [];

  const filteredProjects =
    !hasCategories || selectedCategory === "Semua"
      ? data.portfolio
      : data.portfolio.filter((p) => p.category === selectedCategory);

  return (
    <section id="portfolio" className="py-20 bg-white">
      <div className="max-w-[1160px] mx-auto px-6">
        {/* Centered Header */}
        <div className="text-center max-w-2xl mx-auto mb-12">
          <motion.div
            initial={{ opacity: 0, y: 15 }}
            animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 15 }}
            transition={{ duration: 0.5 }}
            className="flex flex-col items-center"
          >
            <span className="font-mono text-[11px] font-bold tracking-widest text-[#8B0021] uppercase bg-rose-50 border border-rose-100 px-4 py-1.5 rounded-full inline-block mb-3">
              KARYA &amp; PORTOFOLIO
            </span>
            <h2 className="text-2xl sm:text-3xl font-extrabold text-gray-950 tracking-tight leading-tight">
              {data.siteCopy.portfolioTitle || "Portofolio Proyek Website Yang Telah Kami Bangun"}
            </h2>
            {data.siteCopy.portfolioSubtitle && (
              <p className="text-xs sm:text-sm text-gray-500 mt-2">
                {data.siteCopy.portfolioSubtitle}
              </p>
            )}
          </motion.div>

          {/* Centered Category Filter Pills */}
          {hasCategories && (
            <motion.div
              initial={{ opacity: 0, y: 10 }}
              animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 10 }}
              transition={{ duration: 0.5, delay: 0.1 }}
              className="flex flex-wrap items-center justify-center gap-2 mt-6"
            >
              {filterList.map((cat) => (
                <button
                  key={cat}
                  onClick={() => setSelectedCategory(cat)}
                  className={`text-xs font-semibold px-4 py-1.5 rounded-full transition-all duration-200 cursor-pointer ${
                    selectedCategory === cat
                      ? "bg-gradient-to-r from-[#8B0021] to-[#50000F] text-white shadow-xs"
                      : "bg-gray-100 text-gray-700 hover:bg-rose-50 hover:text-[#7B0B1E] border border-transparent hover:border-rose-200"
                  }`}
                >
                  {cat}
                </button>
              ))}
            </motion.div>
          )}
        </div>

        {/* Portfolio Cards Grid with Animated Mockup Images */}
        <motion.div
          ref={ref}
          layout
          className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
        >
          <AnimatePresence>
            {filteredProjects.map((project, index) => (
              <motion.div
                key={project.id}
                layout
                initial={{ opacity: 0, y: 35, scale: 0.95 }}
                animate={{ opacity: 1, y: 0, scale: 1 }}
                exit={{ opacity: 0, scale: 0.9 }}
                transition={{
                  duration: 0.55,
                  delay: index * 0.08,
                  ease: [0.16, 1, 0.3, 1],
                }}
                whileHover={{ y: -7 }}
                className="bg-white border border-gray-200 hover:border-rose-300 rounded-2xl overflow-hidden shadow-2xs hover:shadow-xl transition-all duration-300 flex flex-col group relative"
              >
                {/* Preview Image Container with Cinematic Image Animations */}
                <div className="relative aspect-[16/10] overflow-hidden bg-gray-100">
                  <motion.img
                    src={project.image}
                    alt={project.title}
                    className="w-full h-full object-cover transition-all duration-700 ease-out group-hover:scale-108 group-hover:rotate-[0.5deg]"
                    loading="lazy"
                  />

                  {/* Shimmer Light Sweep on Hover */}
                  <div className="absolute inset-0 opacity-0 group-hover:opacity-100 bg-gradient-to-tr from-transparent via-white/15 to-transparent transition-opacity duration-500 pointer-events-none" />

                  {/* Dark Gradient Overlay with Quick Action Button */}
                  <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-between p-4">
                    <span className="text-xs font-bold text-white inline-flex items-center gap-1.5 bg-black/40 backdrop-blur-md px-3 py-1.5 rounded-lg border border-white/20">
                      <span>Lihat Detail Solusi</span>
                      <ArrowUpRight className="w-3.5 h-3.5 text-rose-200" />
                    </span>
                  </div>

                  {project.category && project.category.trim().length > 0 && (
                    <div className="absolute top-3 left-3 bg-white/95 backdrop-blur-md px-2.5 py-1 rounded-md text-[10px] font-bold text-[#8B0021] uppercase tracking-wide border border-rose-100 shadow-2xs">
                      {project.category}
                    </div>
                  )}
                </div>

                {/* Content */}
                <div className="p-5 flex flex-col justify-between flex-grow">
                  <div>
                    <h3 className="text-sm font-bold text-gray-900 group-hover:text-[#7B0B1E] transition-colors leading-snug mb-2">
                      {project.title}
                    </h3>
                    <p className="text-xs text-gray-500 leading-relaxed mb-4">
                      {project.description}
                    </p>
                  </div>

                  <div>
                    {/* Tags */}
                    {project.tags && project.tags.length > 0 && (
                      <div className="flex flex-wrap gap-1.5 mb-4">
                        {project.tags.map((tag) => (
                          <span
                            key={tag}
                            className="text-[10px] font-medium text-gray-600 bg-gray-50 border border-gray-200 px-2 py-0.5 rounded-md"
                          >
                            {tag}
                          </span>
                        ))}
                      </div>
                    )}

                    {/* Action CTA with WhatsApp link */}
                    <a
                      href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
                        `Halo SOLVETA, saya tertarik dengan studi kasus/portofolio: ${project.title}`
                      )}`}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="w-full py-2.5 text-xs font-bold rounded-xl text-gray-800 bg-gray-50 hover:bg-rose-50 hover:text-[#7B0B1E] border border-gray-200 hover:border-rose-200 transition-all flex items-center justify-center gap-1.5 shadow-2xs"
                    >
                      <span>Konsultasikan Solusi Mirip</span>
                      <ExternalLink className="w-3.5 h-3.5" />
                    </a>
                  </div>
                </div>
              </motion.div>
            ))}
          </AnimatePresence>
        </motion.div>
      </div>
    </section>
  );
};
