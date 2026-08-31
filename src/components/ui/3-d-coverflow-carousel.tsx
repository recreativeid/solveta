"use client";

import React, { useState, useEffect, useCallback, useRef } from "react";

// Inline Icons (Zero external dependencies)
const ChevronLeftIcon = () => (
  <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2.5}>
    <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
  </svg>
);

const ChevronRightIcon = () => (
  <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2.5}>
    <path strokeLinecap="round" strokeLinejoin="round" d="M9 5l7 7-7 7" />
  </svg>
);

const ArrowRightIcon = () => (
  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2.5}>
    <path strokeLinecap="round" strokeLinejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
  </svg>
);

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
    img: "https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&auto=format&fit=crop&q=80",
    ctaText: "Konsultasi Solusi Ini",
    ctaUrl: "#",
  },
  {
    tag: "Web Application",
    titleLine1: "NUSANTARA LOGISTICS",
    titleLine2: "– TRACKING PORTAL",
    desc: "Platform pelacakan kargo real-time dengan integrasi WhatsApp notification gateway.",
    img: "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80",
    ctaText: "Konsultasi Solusi Ini",
    ctaUrl: "#",
  },
  {
    tag: "Website & Presence",
    titleLine1: "URBANVIBE PROPERTY",
    titleLine2: "– KATALOG PROPERTI",
    desc: "Website interaktif listing properti dengan virtual tour dan pemesanan WhatsApp.",
    img: "https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&auto=format&fit=crop&q=80",
    ctaText: "Konsultasi Solusi Ini",
    ctaUrl: "#",
  },
  {
    tag: "E-Commerce",
    titleLine1: "KOPI NUSANTARA",
    titleLine2: "– POS & INVENTORY",
    desc: "Sinkronisasi otomatis antara stok toko offline dan pesanan online multi-channel.",
    img: "https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&auto=format&fit=crop&q=80",
    ctaText: "Konsultasi Solusi Ini",
    ctaUrl: "#",
  },
  {
    tag: "Corporate Profile",
    titleLine1: "ARTHA FINANSIAL",
    titleLine2: "– CORPORATE PORTAL",
    desc: "Company profile modern ultra-fast dengan portal pengajuan konsultasi otomatis.",
    img: "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&auto=format&fit=crop&q=80",
    ctaText: "Konsultasi Solusi Ini",
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
      className={`relative w-full min-h-[640px] flex items-center justify-center overflow-hidden py-8 select-none ${className}`}
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
      onTouchStart={handleTouchStart}
      onTouchEnd={handleTouchEnd}
    >
      {/* Background Ambience (Bright & Clean Aesthetic) */}
      {isLightMode ? (
        <div className="absolute inset-0 overflow-hidden pointer-events-none z-0">
          <img
            src={items[currentIndex]?.img}
            alt="ambience background"
            style={{
              width: "100%",
              height: "100%",
              objectFit: "cover",
              filter: "brightness(1.1) blur(45px) opacity(0.12)",
              transform: "scale(1.2)",
              transition: "opacity 1000ms ease, filter 1000ms ease",
            }}
          />
          <div
            className="absolute inset-0"
            style={{
              background:
                "radial-gradient(circle at center, rgba(255,255,255,0.7) 0%, rgba(253,251,249,0.98) 100%)",
            }}
          />
        </div>
      ) : (
        <div className="absolute inset-0 overflow-hidden pointer-events-none z-0">
          <img
            src={items[currentIndex]?.img}
            alt="ambience background"
            style={{
              width: "100%",
              height: "100%",
              objectFit: "cover",
              filter: "brightness(0.22) blur(32px)",
              transform: "scale(1.15)",
              transition: "opacity 1000ms ease, filter 1000ms ease",
            }}
          />
          <div
            className="absolute inset-0"
            style={{
              background:
                "radial-gradient(circle at center, rgba(12,10,9,0.3) 0%, rgba(12,10,9,0.92) 100%)",
            }}
          />
        </div>
      )}

      <div className="relative w-full max-w-6xl mx-auto px-4 z-10 flex flex-col items-center">
        {/* Eyebrow */}
        {sectionLabel && (
          <div className="flex items-center gap-3 mb-6">
            <span
              style={{
                width: "36px",
                height: "1px",
                background: isLightMode
                  ? "linear-gradient(90deg, transparent, #8B0021)"
                  : "linear-gradient(90deg, transparent, #c5a880)",
              }}
            />
            <h3
              style={{
                fontSize: "0.75rem",
                fontWeight: 700,
                letterSpacing: "0.25em",
                textTransform: "uppercase",
                color: isLightMode ? "#8B0021" : "#c5a880",
                margin: 0,
                fontFamily: "monospace",
              }}
            >
              {sectionLabel}
            </h3>
            <span
              style={{
                width: "36px",
                height: "1px",
                background: isLightMode
                  ? "linear-gradient(90deg, #8B0021, transparent)"
                  : "linear-gradient(90deg, #c5a880, transparent)",
              }}
            />
          </div>
        )}

        {/* 3D Coverflow Stage */}
        <div
          className="relative w-full h-[490px] sm:h-[520px] flex justify-center items-center mb-6"
          style={{ perspective: "1400px" }}
        >
          {items.map((item, idx) => {
            const offset = (idx - currentIndex + total) % total;

            let transform = "translateX(0px) scale(0.4) rotateY(0deg)";
            let opacity = 0;
            let zIndex = 0;
            let filter = isLightMode ? "brightness(0.85) blur(2px)" : "brightness(0.4) blur(2px)";
            let isCenter = false;

            if (offset === 0) {
              isCenter = true;
              transform = "translateX(0px) scale(1) rotateY(0deg)";
              opacity = 1;
              zIndex = 30;
              filter = "brightness(1)";
            } else if (offset === 1) {
              transform = "translateX(270px) scale(0.84) rotateY(-22deg)";
              opacity = 0.72;
              zIndex = 20;
              filter = isLightMode ? "brightness(0.92)" : "brightness(0.75)";
            } else if (offset === 2) {
              transform = "translateX(480px) scale(0.68) rotateY(-36deg)";
              opacity = 0.42;
              zIndex = 10;
              filter = isLightMode ? "brightness(0.88) blur(1px)" : "brightness(0.55) blur(1px)";
            } else if (offset === total - 1) {
              transform = "translateX(-270px) scale(0.84) rotateY(22deg)";
              opacity = 0.72;
              zIndex = 20;
              filter = isLightMode ? "brightness(0.92)" : "brightness(0.75)";
            } else if (offset === total - 2) {
              transform = "translateX(-480px) scale(0.68) rotateY(36deg)";
              opacity = 0.42;
              zIndex = 10;
              filter = isLightMode ? "brightness(0.88) blur(1px)" : "brightness(0.55) blur(1px)";
            }

            return (
              <div
                key={item.id || idx}
                onClick={() => !isCenter && goToSlide(idx)}
                style={{
                  position: "absolute",
                  width: "320px",
                  height: "480px",
                  borderRadius: "20px",
                  overflow: "hidden",
                  backgroundColor: "#ffffff",
                  border: isLightMode
                    ? isCenter
                      ? "2px solid #8B0021"
                      : "1px solid rgba(0, 0, 0, 0.12)"
                    : "1px solid rgba(255, 255, 255, 0.12)",
                  transform,
                  opacity,
                  zIndex,
                  filter,
                  transformOrigin: "center center",
                  transition: "all 750ms cubic-bezier(0.25, 1, 0.5, 1)",
                  boxShadow: isCenter
                    ? isLightMode
                      ? "0 25px 60px -15px rgba(139,0,33,0.22), 0 0 25px rgba(139,0,33,0.12)"
                      : "0 25px 60px rgba(0,0,0,0.9), 0 0 35px rgba(197,168,128,0.25)"
                    : isLightMode
                    ? "0 12px 30px rgba(0,0,0,0.08)"
                    : "0 15px 35px rgba(0,0,0,0.5)",
                  cursor: isCenter ? "default" : "pointer",
                }}
              >
                {/* Photo */}
                <img
                  src={item.img}
                  alt={item.titleLine1}
                  style={{
                    position: "absolute",
                    inset: 0,
                    width: "100%",
                    height: "100%",
                    objectFit: "cover",
                  }}
                />

                {/* Vignette Overlay */}
                <div
                  style={{
                    position: "absolute",
                    inset: 0,
                    background:
                      "linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.05) 30%, rgba(0,0,0,0.65) 65%, rgba(0,0,0,0.96) 100%)",
                    pointerEvents: "none",
                    zIndex: 10,
                  }}
                />

                {/* Content Overlay */}
                <div
                  style={{
                    position: "relative",
                    width: "100%",
                    height: "100%",
                    padding: "20px 18px 22px",
                    display: "flex",
                    flexDirection: "column",
                    justifyContent: "space-between",
                    textAlign: "center",
                    zIndex: 20,
                    opacity: isCenter ? 1 : 0,
                    transform: isCenter ? "translateY(0px)" : "translateY(16px)",
                    transition: "opacity 500ms ease, transform 500ms ease",
                    pointerEvents: isCenter ? "auto" : "none",
                  }}
                >
                  {/* Category Tag Badge */}
                  <div style={{ textAlign: "left", width: "100%" }}>
                    <span
                      style={{
                        display: "inline-block",
                        fontSize: "0.72rem",
                        fontWeight: 700,
                        letterSpacing: "0.06em",
                        textTransform: "uppercase",
                        backgroundColor: "rgba(255, 255, 255, 0.95)",
                        color: "#8B0021",
                        padding: "3px 10px",
                        borderRadius: "9999px",
                        boxShadow: "0 2px 8px rgba(0,0,0,0.3)",
                      }}
                    >
                      {item.tag || "Portofolio"}
                    </span>
                  </div>

                  {/* Body Content */}
                  <div
                    style={{
                      display: "flex",
                      flexDirection: "column",
                      alignItems: "center",
                      gap: "3px",
                      marginTop: "auto",
                      paddingBottom: "4px",
                    }}
                  >
                    <h2
                      style={{
                        fontSize: "1.45rem",
                        fontWeight: 900,
                        textTransform: "uppercase",
                        letterSpacing: "0.02em",
                        color: "#ffffff",
                        margin: 0,
                        lineHeight: 1.15,
                        textShadow: "0 3px 12px rgba(0,0,0,0.95)",
                      }}
                    >
                      {item.titleLine1}
                    </h2>

                    {item.titleLine2 && (
                      <span
                        style={{
                          fontSize: "0.95rem",
                          fontWeight: 700,
                          textTransform: "uppercase",
                          letterSpacing: "0.04em",
                          color: "#fce7ea",
                          lineHeight: 1.2,
                          textShadow: "0 2px 8px rgba(0,0,0,0.9)",
                        }}
                      >
                        {item.titleLine2}
                      </span>
                    )}

                    <div
                      style={{
                        width: "36px",
                        height: "2px",
                        backgroundColor: "#8B0021",
                        borderRadius: "2px",
                        margin: "6px auto 5px",
                        boxShadow: "0 0 10px rgba(225,29,72,0.8)",
                      }}
                    />

                    {item.desc && (
                      <p
                        style={{
                          fontSize: "0.8rem",
                          color: "rgba(255,255,255,0.92)",
                          maxWidth: "280px",
                          margin: "0 0 12px",
                          lineHeight: 1.35,
                          textShadow: "0 2px 8px rgba(0,0,0,0.9)",
                        }}
                      >
                        {item.desc}
                      </p>
                    )}

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
                      style={{
                        display: "inline-flex",
                        alignItems: "center",
                        gap: "6px",
                        padding: "8px 18px",
                        borderRadius: "9999px",
                        background: "linear-gradient(135deg, #8B0021 0%, #50000F 100%)",
                        color: "#ffffff",
                        fontSize: "0.72rem",
                        fontWeight: 800,
                        letterSpacing: "0.12em",
                        textTransform: "uppercase",
                        textDecoration: "none",
                        boxShadow: "0 4px 14px rgba(139,0,33,0.4), 0 0 15px rgba(139,0,33,0.3)",
                        cursor: "pointer",
                        transition: "transform 200ms ease, box-shadow 200ms ease",
                      }}
                    >
                      <span>{item.ctaText || "Konsultasi Solusi Ini"}</span>
                      <ArrowRightIcon />
                    </a>
                  </div>
                </div>
              </div>
            );
          })}
        </div>

        {/* Navigation Arrows */}
        <button
          onClick={prevSlide}
          aria-label="Previous portfolio"
          style={{
            position: "absolute",
            left: "16px",
            top: "50%",
            transform: "translateY(-50%)",
            width: "44px",
            height: "44px",
            borderRadius: "50%",
            backgroundColor: isLightMode ? "rgba(255,255,255,0.92)" : "rgba(0,0,0,0.55)",
            border: isLightMode ? "1px solid rgba(0,0,0,0.12)" : "1px solid rgba(255,255,255,0.2)",
            color: isLightMode ? "#8B0021" : "#ffffff",
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
            backdropFilter: "blur(8px)",
            cursor: "pointer",
            boxShadow: isLightMode
              ? "0 8px 20px rgba(0,0,0,0.12)"
              : "0 8px 24px rgba(0,0,0,0.4)",
            zIndex: 40,
            transition: "all 200ms ease",
          }}
        >
          <ChevronLeftIcon />
        </button>

        <button
          onClick={nextSlide}
          aria-label="Next portfolio"
          style={{
            position: "absolute",
            right: "16px",
            top: "50%",
            transform: "translateY(-50%)",
            width: "44px",
            height: "44px",
            borderRadius: "50%",
            backgroundColor: isLightMode ? "rgba(255,255,255,0.92)" : "rgba(0,0,0,0.55)",
            border: isLightMode ? "1px solid rgba(0,0,0,0.12)" : "1px solid rgba(255,255,255,0.2)",
            color: isLightMode ? "#8B0021" : "#ffffff",
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
            backdropFilter: "blur(8px)",
            cursor: "pointer",
            boxShadow: isLightMode
              ? "0 8px 20px rgba(0,0,0,0.12)"
              : "0 8px 24px rgba(0,0,0,0.4)",
            zIndex: 40,
            transition: "all 200ms ease",
          }}
        >
          <ChevronRightIcon />
        </button>

        {/* Pagination Dots */}
        <div style={{ display: "flex", alignItems: "center", justifyContent: "center", gap: "8px", zIndex: 30 }}>
          {items.map((_, idx) => (
            <button
              key={idx}
              onClick={() => goToSlide(idx)}
              aria-label={`Go to slide ${idx + 1}`}
              style={{
                height: "8px",
                width: idx === currentIndex ? "28px" : "8px",
                borderRadius: "9999px",
                backgroundColor:
                  idx === currentIndex
                    ? isLightMode
                      ? "#8B0021"
                      : "#c5a880"
                    : isLightMode
                    ? "rgba(0,0,0,0.2)"
                    : "rgba(255,255,255,0.25)",
                border: "none",
                cursor: "pointer",
                boxShadow:
                  idx === currentIndex
                    ? isLightMode
                      ? "0 0 10px rgba(139,0,33,0.5)"
                      : "0 0 10px rgba(197,168,128,0.7)"
                    : "none",
                transition: "all 300ms ease",
              }}
            />
          ))}
        </div>
      </div>
    </section>
  );
}

export const Component = CoverFlowCarousel;
export default CoverFlowCarousel;
