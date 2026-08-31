"use client";

import React, { useState, useRef } from "react";
import { motion, useInView } from "framer-motion";
import { Sparkles, Layers, ArrowRight } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";
import { useTheme } from "@/context/ThemeContext";
import { CoverFlowCarousel, CarouselItem } from "@/components/ui/3-d-coverflow-carousel";

export const PortfolioSection: React.FC = () => {
  const { data } = useSiteData();
  const { theme } = useTheme();
  const [selectedCategory, setSelectedCategory] = useState("Semua");
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });

  const isLight = theme !== "dark";

  // Extract unique categories
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

  // Convert to CarouselItems format (Landscape Widescreen Display)
  const carouselItems: CarouselItem[] = filteredProjects.map((p) => {
    let titleLine1 = p.title;
    let titleLine2: string | undefined = undefined;

    if (p.title.includes("—")) {
      const parts = p.title.split("—");
      titleLine1 = parts[0].trim();
      titleLine2 = `– ${parts.slice(1).join("—").trim()}`;
    } else if (p.title.includes("-")) {
      const parts = p.title.split("-");
      titleLine1 = parts[0].trim();
      titleLine2 = `– ${parts.slice(1).join("-").trim()}`;
    }

    return {
      id: p.id,
      tag: p.category || "Portofolio",
      titleLine1,
      titleLine2,
      desc: p.description,
      img: p.image,
      tags: p.tags,
      ctaText: "Lihat Selengkapnya",
      ctaUrl: `https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
        `Halo SOLVETA, saya ingin melihat detail dan konsultasi mengenai portofolio: ${p.title}`
      )}`,
    };
  });

  return (
    <section id="portfolio" className="py-20 bg-gradient-to-b from-white dark:from-[#07080E] via-[#FDFBF9] dark:via-[#090A12] to-white dark:to-[#07080E] border-t border-gray-100 dark:border-gray-800 relative overflow-hidden transition-colors duration-200">
      <div className="max-w-[1240px] mx-auto px-4 sm:px-6">
        {/* Centered Header */}
        <div className="text-center max-w-2xl mx-auto mb-6">
          <motion.div
            initial={{ opacity: 0, y: 15 }}
            animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 15 }}
            transition={{ duration: 0.5 }}
            className="flex flex-col items-center"
          >
            <span className="font-mono text-[11px] font-bold tracking-widest text-[#8B0021] dark:text-rose-400 uppercase bg-rose-50 dark:bg-rose-950/60 border border-rose-100 dark:border-rose-800/60 px-4 py-1.5 rounded-full inline-block mb-3">
              KARYA &amp; PORTOFOLIO NYATA
            </span>
            <h2 className="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-950 dark:text-white tracking-tight leading-tight uppercase font-sans">
              {data.siteCopy.portfolioTitle || "Portofolio Proyek Website Yang Telah Kami Bangun"}
            </h2>
            <p className="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-2.5 max-w-xl mx-auto leading-relaxed font-sans">
              Jelajahi karya solusi digital dan website yang telah kami bangun dalam format tampilan layar laptop 3D interaktif. Klik tombol untuk melihat rincian.
            </p>
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
                  className={`text-xs font-semibold font-sans px-4 py-1.5 rounded-full transition-all duration-200 cursor-pointer border ${
                    selectedCategory === cat
                      ? "bg-gradient-to-r from-[#8B0021] to-[#50000F] text-white border-[#8B0021] shadow-xs"
                      : "bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 hover:bg-rose-50 dark:hover:bg-gray-800 hover:text-[#7B0B1E] dark:hover:text-rose-300 border-gray-200 dark:border-gray-800 hover:border-rose-200 dark:hover:border-rose-700"
                  }`}
                >
                  {cat}
                </button>
              ))}
            </motion.div>
          )}
        </div>

        {/* 3D Coverflow Interactive Carousel Stage (Landscape Laptop Layout) */}
        <div ref={ref} className="w-full">
          <CoverFlowCarousel
            key={`${selectedCategory}-${theme}`}
            items={carouselItems}
            sectionLabel="SOLVETA SHOWCASE"
            isLightMode={isLight}
            autoplay={true}
            autoplayDelay={5000}
            onCtaClick={(item) => {
              if (item.ctaUrl) {
                window.open(item.ctaUrl, "_blank");
              }
            }}
          />
        </div>

        {/* Bottom Consultation Link */}
        <div className="mt-8 text-center">
          <a
            href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
              "Halo SOLVETA, saya ingin konsultasi mengenai pembuatan sistem atau website custom."
            )}`}
            target="_blank"
            rel="noopener noreferrer"
            className="inline-flex items-center gap-2 text-xs font-bold font-sans text-[#8B0021] dark:text-rose-400 bg-rose-50 dark:bg-rose-950/60 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200/80 dark:border-rose-800/80 px-5 py-2.5 rounded-full transition-colors shadow-2xs"
          >
            <span>Punya Kebutuhan Sistem / Website Serupa? Diskusikan dengan Kami</span>
            <ArrowRight className="w-3.5 h-3.5" />
          </a>
        </div>
      </div>
    </section>
  );
};
