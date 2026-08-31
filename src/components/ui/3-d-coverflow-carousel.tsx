"use client";

import React, { useState, useEffect, useCallback, useRef } from "react";
import { ArrowRight, ChevronLeft, ChevronRight, Globe, Sparkles } from "lucide-react";

export interface CarouselItem {
  id?: string;
  tag?: string;
  titleLine1: string;
  titleLine2?: string;
  desc?: string;
  img: string;
  tags?: string[];
  ctaText?: string;
  ctaUrl?: string;
}

export interface CoverFlowCarouselProps {
  items?: CarouselItem[];
  sectionLabel?: string;
  autoplay?: boolean;
  autoplayDelay?: number;
  className?: string;
  isLightMode?: boolean;
  onCtaClick?: (item: CarouselItem) => void;
}

export const defaultProjects: CarouselItem[] = [
  {
    tag: "Custom System",
    titleLine1: "MEDIKACARE",
    titleLine2: "– KLINIK & REKAM MEDIS",
    desc: "Digitalisasi rekam medis pasien, antrean online WhatsApp, dan sistem kasir klinik terpadu.",
    img: "https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200&auto=format&fit=crop&q=80",
    ctaText: "Lihat Selengkapnya",
    ctaUrl: "#",
  },
  {
    tag: "Web Application",
    titleLine1: "NUSANTARA LOGISTICS",
    titleLine2: "– TRACKING PORTAL",
    desc: "Platform pelacakan kargo real-time dengan integrasi WhatsApp notification gateway.",
    img: "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1200&auto=format&fit=crop&q=80",
    ctaText: "Lihat Selengkapnya",
    ctaUrl: "#",
  },
  {
    tag: "Website & Presence",
    titleLine1: "URBANVIBE PROPERTY",
    titleLine2: "– KATALOG PROPERTI",
    desc: "Website interaktif listing properti dengan virtual tour dan pemesanan WhatsApp.",
    img: "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&auto=format&fit=crop&q=80",
    ctaText: "Lihat Selengkapnya",
    ctaUrl: "#",
  },
  {
    tag: "E-Commerce",
    titleLine1: "KOPI NUSANTARA",
    titleLine2: "– POS & INVENTORY",
    desc: "Sinkronisasi otomatis antara stok toko offline dan pesanan online multi-channel.",
    img: "https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1200&auto=format&fit=crop&q=80",
    ctaText: "Lihat Selengkapnya",
    ctaUrl: "#",
  },
  {
    tag: "Corporate Profile",
    titleLine1: "ARTHA FINANSIAL",
    titleLine2: "– CORPORATE PORTAL",
    desc: "Company profile modern ultra-fast dengan portal pengajuan konsultasi keuangan otomatis.",
    img: "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1200&auto=format&fit=crop&q=80",
    ctaText: "Lihat Selengkapnya",
    ctaUrl: "#",
  },
];

export function CoverFlowCarousel({
  items = defaultProjects,
  sectionLabel = "PORTOFOLIO KARYA TERBARU",
  autoplay = true,
  autoplayDelay = 4500,
  className = "",
  isLightMode = true,
  onCtaClick,
}: CoverFlowCarouselProps) {
  const [currentIndex, setCurrentIndex] = useState(0);
  const [isHovered, setIsHovered] = useState(false);
  const touchStartX = useRef(0);
  const total = items.length;

  const nextSlide = useCallback(() => {
    if (total <= 1) return;
    setCurrentIndex((prev) => (prev + 1) % total);
  }, [total]);

  const prevSlide = useCallback(() => {
    if (total <= 1) return;
    setCurrentIndex((prev) => (prev - 1 + total) % total);
  }, [total]);

  const goToSlide = (idx: number) => {
    if (total <= 0) return;
    setCurrentIndex(idx % total);
  };

  useEffect(() => {
    if (!autoplay || isHovered || total <= 1) return;
    const interval = setInterval(nextSlide, autoplayDelay);
    return () => clearInterval(interval);
  }, [autoplay, autoplayDelay, isHovered, nextSlide, total]);

  useEffect(() => {
    const handleKeyDown = (e: KeyboardEvent) => {
      if (e.key === "ArrowLeft") prevSlide();
      if (e.key === "ArrowRight") nextSlide();
    };
    window.addEventListener("keydown", handleKeyDown);
    return () => window.removeEventListener("keydown", handleKeyDown);
  }, [nextSlide, prevSlide]);

  const handleTouchStart = (e: React.TouchEvent) => {
    touchStartX.current = e.touches[0].clientX;
  };

  const handleTouchEnd = (e: React.TouchEvent) => {
    const diff = e.changedTouches[0].clientX - touchStartX.current;
    if (Math.abs(diff) > 45) {
      if (diff < 0) nextSlide();
      else prevSlide();
    }
  };

  if (!items || items.length === 0) return null;

  return (
    <section
      className={`relative w-full min-h-[520px] sm:min-h-[560px] flex items-center justify-center overflow-hidden py-6 select-none font-sans ${className}`}
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
      onTouchStart={handleTouchStart}
      onTouchEnd={handleTouchEnd}
    >
      {/* Background Subtle Ambient Glow */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <img
          src={items[currentIndex]?.img}
          alt="ambience background"
          className="w-full h-full object-cover blur-[50px] opacity-10 dark:opacity-15 scale-125 transition-all duration-1000"
        />
        <div className="absolute inset-0 bg-radial from-transparent via-[#FDFBF9]/80 dark:via-[#07080E]/80 to-[#FDFBF9] dark:to-[#07080E]" />
      </div>

      <div className="relative w-full max-w-7xl mx-auto px-2 sm:px-4 z-10 flex flex-col items-center">
        {/* Eyebrow Label */}
        {sectionLabel && (
          <div className="flex items-center gap-3 mb-6">
            <span className="w-9 h-[1px] bg-gradient-to-r from-transparent to-[#8B0021] dark:to-rose-400" />
            <h3 className="font-mono text-[11px] font-bold tracking-widest uppercase text-[#8B0021] dark:text-rose-400">
              {sectionLabel}
            </h3>
            <span className="w-9 h-[1px] bg-gradient-to-r from-[#8B0021] dark:from-rose-400 to-transparent" />
          </div>
        )}

        {/* 3D Coverflow Stage (Widescreen Landscape Laptop Screens) */}
        <div
          className="relative w-full h-[370px] sm:h-[430px] md:h-[470px] flex justify-center items-center mb-6"
          style={{ perspective: "1500px" }}
        >
          {items.map((item, idx) => {
            const offset = (idx - currentIndex + total) % total;

            let transform = "translateX(0px) scale(0.4) rotateY(0deg)";
            let opacity = 0;
            let zIndex = 0;
            let filter = isLightMode ? "brightness(0.9) blur(1.5px)" : "brightness(0.4) blur(1.5px)";
            let isCenter = false;

            if (offset === 0) {
              isCenter = true;
              transform = "translateX(0px) scale(1) rotateY(0deg)";
              opacity = 1;
              zIndex = 30;
              filter = "brightness(1)";
            } else if (offset === 1) {
              transform = "translateX(min(360px, 46vw)) scale(0.82) rotateY(-22deg)";
              opacity = 0.75;
              zIndex = 20;
              filter = isLightMode ? "brightness(0.92)" : "brightness(0.7)";
            } else if (offset === 2) {
              transform = "translateX(min(620px, 78vw)) scale(0.66) rotateY(-34deg)";
              opacity = 0.4;
              zIndex = 10;
              filter = isLightMode ? "brightness(0.88) blur(1px)" : "brightness(0.5) blur(1px)";
            } else if (offset === total - 1) {
              transform = "translateX(-min(360px, 46vw)) scale(0.82) rotateY(22deg)";
              opacity = 0.75;
              zIndex = 20;
              filter = isLightMode ? "brightness(0.92)" : "brightness(0.7)";
            } else if (offset === total - 2) {
              transform = "translateX(-min(620px, 78vw)) scale(0.66) rotateY(34deg)";
              opacity = 0.4;
              zIndex = 10;
              filter = isLightMode ? "brightness(0.88) blur(1px)" : "brightness(0.5) blur(1px)";
            }

            return (
              <div
                key={item.id || idx}
                onClick={() => !isCenter && goToSlide(idx)}
                style={{
                  position: "absolute",
                  width: "min(680px, 88vw)",
                  height: "min(400px, 54vw)",
                  minHeight: "260px",
                  borderRadius: "18px",
                  overflow: "hidden",
                  backgroundColor: "#0d0e14",
                  border: isCenter
                    ? isLightMode
                      ? "2.5px solid #8B0021"
                      : "2.5px solid #f43f5e"
                    : isLightMode
                    ? "1px solid rgba(0, 0, 0, 0.15)"
                    : "1px solid rgba(255, 255, 255, 0.15)",
                  transform,
                  opacity,
                  zIndex,
                  filter,
                  transformOrigin: "center center",
                  transition: "all 750ms cubic-bezier(0.25, 1, 0.5, 1)",
                  boxShadow: isCenter
                    ? isLightMode
                      ? "0 25px 50px -12px rgba(139,0,33,0.3), 0 0 20px rgba(139,0,33,0.15)"
                      : "0 25px 60px rgba(0,0,0,0.9), 0 0 30px rgba(244,63,94,0.3)"
                    : isLightMode
                    ? "0 12px 25px rgba(0,0,0,0.08)"
                    : "0 15px 35px rgba(0,0,0,0.6)",
                  cursor: isCenter ? "default" : "pointer",
                }}
                className="group font-sans"
              >
                {/* 1. LAPTOP SCREEN TOP BROWSER BAR */}
                <div className="absolute top-0 left-0 right-0 h-7 sm:h-8 bg-[#181924]/90 backdrop-blur-md border-b border-white/10 px-3 sm:px-4 flex items-center justify-between z-30 pointer-events-none">
                  {/* macOS Window Controls */}
                  <div className="flex items-center gap-1.5">
                    <span className="w-2.5 h-2.5 rounded-full bg-red-500/80" />
                    <span className="w-2.5 h-2.5 rounded-full bg-amber-500/80" />
                    <span className="w-2.5 h-2.5 rounded-full bg-emerald-500/80" />
                  </div>

                  {/* Browser URL Tab Pill */}
                  <div className="flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-black/40 border border-white/10 text-[9px] sm:text-[10px] text-gray-300 font-mono">
                    <Globe className="w-2.5 h-2.5 text-rose-400" />
                    <span className="truncate max-w-[140px] sm:max-w-[220px]">
                      solveta.site/showcase/{item.titleLine1.toLowerCase().replace(/\s+/g, "-")}
                    </span>
                  </div>

                  {/* Category Pill on Right */}
                  <span className="text-[9px] sm:text-[10px] font-bold font-mono text-rose-300 uppercase tracking-wider hidden sm:inline-block">
                    {item.tag || "Portofolio"}
                  </span>
                </div>

                {/* 2. FULL WIDESCREEN PREVIEW IMAGE */}
                <img
                  src={item.img}
                  alt={item.titleLine1}
                  className="absolute inset-0 pt-7 sm:pt-8 w-full h-full object-cover object-top"
                />

                {/* Subtle Top & Bottom Gradient Overlay */}
                <div className="absolute inset-0 pt-7 sm:pt-8 bg-gradient-to-t from-black/90 via-black/35 to-transparent pointer-events-none z-10" />

                {/* 3. WIDESCREEN FROSTED GLASS BOTTOM BANNER OVERLAY */}
                <div
                  style={{
                    opacity: isCenter ? 1 : 0,
                    transform: isCenter ? "translateY(0px)" : "translateY(16px)",
                    transition: "opacity 500ms ease, transform 500ms ease",
                    pointerEvents: isCenter ? "auto" : "none",
                  }}
                  className="absolute bottom-0 left-0 right-0 p-3 sm:p-5 bg-gradient-to-t from-black/95 via-black/85 to-transparent backdrop-blur-xs border-t border-white/10 z-20 flex flex-col sm:flex-row items-start sm:items-end justify-between gap-2 sm:gap-4 text-left"
                >
                  <div className="space-y-1 max-w-lg">
                    {/* Category Tag (Mobile fallback) */}
                    <div className="sm:hidden">
                      <span className="text-[9px] font-bold font-mono px-2 py-0.5 rounded-full bg-rose-950/80 border border-rose-500/40 text-rose-300 uppercase">
                        {item.tag || "Portofolio"}
                      </span>
                    </div>

                    {/* Main Title (Poppins Bold) */}
                    <h4 className="text-sm sm:text-lg md:text-xl font-extrabold text-white tracking-tight uppercase leading-tight font-sans drop-shadow-md">
                      {item.titleLine1} {item.titleLine2 && <span className="text-rose-300 font-semibold">{item.titleLine2}</span>}
                    </h4>

                    {/* Description */}
                    {item.desc && (
                      <p className="text-[10px] sm:text-xs text-gray-300 line-clamp-2 leading-relaxed font-sans max-w-md">
                        {item.desc}
                      </p>
                    )}
                  </div>

                  {/* CTA Button: "Lihat Selengkapnya →" */}
                  <a
                    href={item.ctaUrl || "#"}
                    onClick={(e) => {
                      if (onCtaClick) {
                        e.preventDefault();
                        onCtaClick(item);
                      }
                    }}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="flex-shrink-0 inline-flex items-center gap-1.5 px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl bg-gradient-to-r from-[#8B0021] via-[#a30026] to-[#50000F] hover:from-[#b8002b] hover:to-[#5E0013] text-white text-[11px] sm:text-xs font-bold font-sans tracking-wide uppercase shadow-lg shadow-rose-950/50 hover:scale-105 transition-all cursor-pointer border border-rose-500/30"
                  >
                    <span>{item.ctaText || "Lihat Selengkapnya"}</span>
                    <ArrowRight className="w-3.5 h-3.5 text-rose-200" />
                  </a>
                </div>
              </div>
            );
          })}
        </div>

        {/* Navigation Arrows */}
        <button
          onClick={prevSlide}
          aria-label="Previous portfolio"
          className="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/90 dark:bg-gray-900/90 border border-gray-200 dark:border-gray-800 text-[#8B0021] dark:text-rose-400 hover:scale-110 flex items-center justify-center backdrop-blur-md shadow-md hover:shadow-xl cursor-pointer z-40 transition-all"
        >
          <ChevronLeft className="w-5 h-5" />
        </button>

        <button
          onClick={nextSlide}
          aria-label="Next portfolio"
          className="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/90 dark:bg-gray-900/90 border border-gray-200 dark:border-gray-800 text-[#8B0021] dark:text-rose-400 hover:scale-110 flex items-center justify-center backdrop-blur-md shadow-md hover:shadow-xl cursor-pointer z-40 transition-all"
        >
          <ChevronRight className="w-5 h-5" />
        </button>

        {/* Pagination Dots */}
        <div className="flex items-center justify-center gap-2 z-30 mt-2">
          {items.map((_, idx) => (
            <button
              key={idx}
              onClick={() => goToSlide(idx)}
              aria-label={`Go to slide ${idx + 1}`}
              className={`h-2 rounded-full transition-all duration-300 cursor-pointer ${
                idx === currentIndex
                  ? "w-7 bg-[#8B0021] dark:bg-rose-500 shadow-[0_0_10px_rgba(139,0,33,0.6)]"
                  : "w-2 bg-gray-300 dark:bg-gray-700 hover:bg-gray-400"
              }`}
            />
          ))}
        </div>
      </div>
    </section>
  );
}

export const Component = CoverFlowCarousel;
export default CoverFlowCarousel;
