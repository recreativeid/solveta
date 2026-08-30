"use client";

import React, { useState, useRef } from "react";
import { motion, useInView, AnimatePresence } from "framer-motion";
import { ExternalLink, ArrowUpRight } from "lucide-react";
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
        <div className="text-center max-w-2xl mx-auto mb-10">
          <motion.div
            initial={{ opacity: 0, y: 15 }}
            animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 15 }}
            transition={{ duration: 0.5 }}
            className="flex flex-col items-center"
          >
            <span className="font-mono text-[11px] font-bold tracking-widest text-brand-700 uppercase bg-brand-50 border border-brand-100 px-3.5 py-1 rounded-full inline-block mb-3">
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

          {/* Centered Category Filter Pills (Only shown if categories exist) */}
          {hasCategories && (
            <motion.div
              initial={{ opacity: 0, y: 10 }}
              animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 10 }}
              transition={{ duration: 0.5, delay: 0.1 }}
              className="flex flex-wrap items-center justify-center gap-1.5 mt-6"
            >
              {filterList.map((cat) => (
                <button
                  key={cat}
                  onClick={() => setSelectedCategory(cat)}
                  className={`text-xs font-semibold px-3.5 py-1.5 rounded-full transition-all duration-200 ${
                    selectedCategory === cat
                      ? "bg-gray-900 text-white shadow-xs"
                      : "bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-900"
                  }`}
                >
                  {cat}
                </button>
              ))}
            </motion.div>
          )}
        </div>

        {/* Portfolio Cards Grid */}
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
                initial={{ opacity: 0, y: 25 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0, scale: 0.95 }}
                transition={{
                  duration: 0.45,
                  delay: index * 0.08,
                  ease: [0.16, 1, 0.3, 1],
                }}
                whileHover={{ y: -6 }}
                className="bg-white border border-gray-200 hover:border-gray-300 rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col group"
              >
                {/* Preview Image Container */}
                <div className="relative aspect-[16/10] overflow-hidden bg-gray-100">
                  <img
                    src={project.image}
                    alt={project.title}
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                    loading="lazy"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                    <span className="text-xs font-semibold text-white inline-flex items-center gap-1">
                      <span>Lihat Solusi</span>
                      <ArrowUpRight className="w-3.5 h-3.5" />
                    </span>
                  </div>
                  {project.category && project.category.trim().length > 0 && (
                    <div className="absolute top-3 left-3 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-md text-[10px] font-bold text-gray-800 uppercase tracking-wide border border-white/60 shadow-xs">
                      {project.category}
                    </div>
                  )}
                </div>

                {/* Content */}
                <div className="p-5 flex flex-col justify-between flex-grow">
                  <div>
                    <h3 className="text-sm font-bold text-gray-900 group-hover:text-brand-800 transition-colors leading-snug mb-2">
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
                            className="text-[10px] font-medium text-gray-500 bg-gray-50 border border-gray-200 px-2 py-0.5 rounded"
                          >
                            {tag}
                          </span>
                        ))}
                      </div>
                    )}

                    {/* Action CTA */}
                    <a
                      href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
                        `Halo SOLVETA, saya tertarik dengan studi kasus/portofolio: ${project.title}`
                      )}`}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="w-full py-2 text-xs font-semibold rounded-lg text-gray-800 bg-gray-50 hover:bg-brand-50 hover:text-brand-800 border border-gray-200 hover:border-brand-200 transition-all flex items-center justify-center gap-1.5"
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
