"use client";

import React, {
  useState,
  useEffect,
  useCallback,
  useRef,
  useLayoutEffect,
} from "react";
import { ArrowRight, ChevronLeft, ChevronRight, Globe } from "lucide-react";
import { cn } from "@/lib/utils";

const useIsoLayoutEffect =
  typeof window !== "undefined" ? useLayoutEffect : useEffect;

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
  const count = items.length;

  const frameRef = useRef<HTMLDivElement>(null);
  const cardRefs = useRef<(HTMLDivElement | null)[]>([]);
  const bannerRefs = useRef<(HTMLDivElement | null)[]>([]);
  
  // Continuous fractional position - source of truth
  const posRef = useRef(0);
  const targetRef = useRef(0);
  const widthRef = useRef(0);
  const rafRef = useRef<number | null>(null);
  const dragRef = useRef<{
    id: number;
    x: number;
    pos: number;
    v: number;
    t: number;
  } | null>(null);

  const [selected, setSelected] = useState(0);
  const [isHovered, setIsHovered] = useState(false);

  // Constants for 3D physics coverflow rake
  const rotate = 32; // degrees tilt for neighbours
  const depth = 0.55; // depth factor
  const falloff = 0.62; // distance damping
  const gap = 0.08; // gap ratio

  // Nearest whole card, folded back into 0..count-1
  const indexAt = useCallback(
    (pos: number) => ((Math.round(pos) % count) + count) % count,
    [count]
  );

  // Fast direct DOM paint for 60fps/120fps gesture smoothness
  const paint = useCallback(() => {
    const width = widthRef.current;
    if (!width || count === 0) return;
    const pitch = width * (1 + gap);
    const pos = posRef.current;

    cardRefs.current.forEach((card, index) => {
      if (!card) return;

      // Fold distance into the shortest way round the ring
      let offset = index - pos;
      offset = ((offset % count) + count) % count;
      if (offset > count / 2) offset -= count;

      const distance = Math.abs(offset);
      const isCenter = distance < 0.45;

      // 3D physics ramp calculations
      const ramp = Math.pow(distance, falloff);
      const tilt = Math.min(rotate * ramp, 65) * Math.sign(offset);

      // Apply transform & 3D perspective
      card.style.transform = `translateX(calc(-50% + ${offset * pitch}px)) translateZ(${-depth * width * ramp}px) rotateY(${-tilt}deg)`;

      // Dynamic opacity & z-index
      const edge = Math.min(1, Math.max(0, count / 2 - distance));
      const baseOpacity = Math.max(0, 1 - 0.15 * distance) * edge;
      card.style.opacity = String(baseOpacity);
      card.style.zIndex = String(100 - Math.round(distance * 10));

      // Visual styling for center vs side cards
      if (isCenter) {
        card.style.borderColor = isLightMode ? "#8B0021" : "#f43f5e";
        card.style.boxShadow = isLightMode
          ? "0 25px 50px -12px rgba(139,0,33,0.3), 0 0 20px rgba(139,0,33,0.15)"
          : "0 25px 60px rgba(0,0,0,0.9), 0 0 30px rgba(244,63,94,0.3)";
        card.style.filter = "brightness(1)";
        card.style.cursor = "default";
      } else {
        card.style.borderColor = isLightMode
          ? "rgba(0, 0, 0, 0.15)"
          : "rgba(255, 255, 255, 0.15)";
        card.style.boxShadow = isLightMode
          ? "0 12px 25px rgba(0,0,0,0.08)"
          : "0 15px 35px rgba(0,0,0,0.6)";
        card.style.filter = isLightMode
          ? `brightness(${Math.max(0.75, 1 - distance * 0.1)})`
          : `brightness(${Math.max(0.45, 0.9 - distance * 0.2)})`;
        card.style.cursor = "pointer";
      }

      // Smoothly reveal/hide bottom glass banner based on closeness to center
      const banner = bannerRefs.current[index];
      if (banner) {
        const bannerOpacity = Math.max(0, 1 - distance * 2.2);
        banner.style.opacity = String(bannerOpacity);
        banner.style.transform = `translateY(${(1 - bannerOpacity) * 16}px)`;
        banner.style.pointerEvents = isCenter ? "auto" : "none";
      }
    });
  }, [count, depth, falloff, gap, isLightMode, rotate]);

  // Smooth exponential ease-out settle animation
  const settle = useCallback(
    (target: number) => {
      if (rafRef.current !== null) cancelAnimationFrame(rafRef.current);
      targetRef.current = target;
      setSelected(indexAt(target));

      const step = () => {
        const remaining = target - posRef.current;
        if (Math.abs(remaining) < 0.0004) {
          posRef.current = target;
          paint();
          rafRef.current = null;
          return;
        }
        // Exponential ease-out physics
        posRef.current += remaining * 0.16;
        paint();
        rafRef.current = requestAnimationFrame(step);
      };
      rafRef.current = requestAnimationFrame(step);
    },
    [indexAt, paint]
  );

  const goTo = useCallback(
    (index: number) => {
      const target =
        index + Math.round((targetRef.current - index) / count) * count;
      settle(target);
    },
    [count, settle]
  );

  const nudge = useCallback(
    (by: number) => {
      settle(Math.round(targetRef.current) + by);
    },
    [settle]
  );

  // Interactive Pointer Down (Start dragging)
  const onPointerDown = (event: React.PointerEvent<HTMLDivElement>) => {
    if (rafRef.current !== null) {
      cancelAnimationFrame(rafRef.current);
      rafRef.current = null;
    }
    event.currentTarget.setPointerCapture(event.pointerId);
    targetRef.current = posRef.current;
    dragRef.current = {
      id: event.pointerId,
      x: event.clientX,
      pos: posRef.current,
      v: 0,
      t: performance.now(),
    };
  };

  // Interactive Pointer Move (Dragging with 60fps/120fps direct DOM response)
  const onPointerMove = (event: React.PointerEvent<HTMLDivElement>) => {
    const drag = dragRef.current;
    if (!drag || drag.id !== event.pointerId) return;

    const pitch = widthRef.current * (1 + gap);
    if (!pitch) return;

    const now = performance.now();
    const previous = posRef.current;
    posRef.current = drag.pos - (event.clientX - drag.x) / pitch;
    // Calculate velocity for kinetic throw
    drag.v = ((posRef.current - previous) / Math.max(now - drag.t, 1)) * 1000;
    drag.t = now;

    const index = indexAt(posRef.current);
    if (index !== selected) setSelected(index);
    paint();
  };

  // Interactive Pointer Up (Release & Kinetic Settle)
  const endDrag = (event: React.PointerEvent<HTMLDivElement>) => {
    const drag = dragRef.current;
    if (!drag || drag.id !== event.pointerId) return;
    dragRef.current = null;
    // Kinetic flick throw (max 2 cards carry)
    const carried = Math.max(-2, Math.min(2, drag.v * 0.18));
    settle(Math.round(posRef.current + carried));
  };

  // Measure card width for 100% responsive rake & perspective
  useIsoLayoutEffect(() => {
    const frame = frameRef.current;
    if (!frame) return;

    const measure = () => {
      const card = cardRefs.current[0];
      if (!card) return;
      widthRef.current = card.offsetWidth;
      paint();
    };

    measure();
    const observer = new ResizeObserver(measure);
    observer.observe(frame);
    return () => observer.disconnect();
  }, [paint]);

  // Autoplay loop
  useEffect(() => {
    if (!autoplay || isHovered || dragRef.current !== null || count <= 1) return;
    const interval = setInterval(() => {
      nudge(1);
    }, autoplayDelay);
    return () => clearInterval(interval);
  }, [autoplay, autoplayDelay, count, isHovered, nudge]);

  // Cleanup RAF
  useEffect(() => {
    return () => {
      if (rafRef.current !== null) cancelAnimationFrame(rafRef.current);
    };
  }, []);

  if (!items || items.length === 0) return null;

  return (
    <section
      className={cn(
        "relative w-full min-h-[480px] sm:min-h-[540px] flex items-center justify-center overflow-hidden py-4 select-none font-sans",
        className
      )}
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
    >
      {/* Background Subtle Ambient Glow */}
      <div className="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <img
          src={items[selected % count]?.img}
          alt="ambience background"
          className="w-full h-full object-cover blur-[60px] opacity-15 dark:opacity-20 scale-125 transition-all duration-1000"
        />
        <div className="absolute inset-0 bg-radial from-transparent via-[#FDFBF9]/80 dark:via-[#07080E]/80 to-[#FDFBF9] dark:to-[#07080E]" />
      </div>

      {/* Side Fade Masks */}
      <div className="absolute top-0 bottom-0 left-0 w-12 sm:w-20 md:w-28 bg-gradient-to-r from-[#FDFBF9] dark:from-[#07080E] to-transparent pointer-events-none z-35" />
      <div className="absolute top-0 bottom-0 right-0 w-12 sm:w-20 md:w-28 bg-gradient-to-l from-[#FDFBF9] dark:from-[#07080E] to-transparent pointer-events-none z-35" />

      <div className="relative w-full z-10 flex flex-col items-center">
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

        {/* 3D Coverflow Container with Preserved 3D & Gesture Touch Drag */}
        <div
          ref={frameRef}
          tabIndex={0}
          onPointerDown={onPointerDown}
          onPointerMove={onPointerMove}
          onPointerUp={endDrag}
          onPointerCancel={endDrag}
          onKeyDown={(event) => {
            if (event.key === "ArrowLeft") {
              event.preventDefault();
              nudge(-1);
            } else if (event.key === "ArrowRight") {
              event.preventDefault();
              nudge(1);
            }
          }}
          className="relative w-full h-[360px] sm:h-[420px] md:h-[460px] flex justify-center items-center mb-4 overflow-visible cursor-grab active:cursor-grabbing outline-none"
          style={{
            perspective: "1600px",
            touchAction: "pan-y",
          }}
        >
          <div
            className="relative w-full h-full flex items-center justify-center select-none"
            style={{
              transformStyle: "preserve-3d",
            }}
          >
            {items.map((item, index) => {
              return (
                <div
                  key={item.id || `card-${index}-${item.titleLine1}`}
                  ref={(node) => {
                    cardRefs.current[index] = node;
                  }}
                  onClick={() => {
                    if (index !== selected) {
                      goTo(index);
                    }
                  }}
                  style={{
                    position: "absolute",
                    left: "50%",
                    width: "min(560px, 70vw)",
                    height: "min(340px, 42vw)",
                    minHeight: "220px",
                    borderRadius: "16px",
                    overflow: "hidden",
                    backgroundColor: "#0d0e14",
                    borderWidth: "2.5px",
                    borderStyle: "solid",
                    transformOrigin: "center center",
                    willChange: "transform, opacity",
                  }}
                  className="group font-sans transition-shadow duration-300"
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
                      <span className="truncate max-w-[130px] sm:max-w-[200px]">
                        solveta.site/showcase/
                        {item.titleLine1.toLowerCase().replace(/\s+/g, "-")}
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
                    draggable={false}
                    className="absolute inset-0 pt-7 sm:pt-8 w-full h-full object-cover object-top select-none pointer-events-none"
                  />

                  {/* Subtle Top & Bottom Gradient Overlay */}
                  <div className="absolute inset-0 pt-7 sm:pt-8 bg-gradient-to-t from-black/90 via-black/35 to-transparent pointer-events-none z-10" />

                  {/* 3. WIDESCREEN FROSTED GLASS BOTTOM BANNER OVERLAY */}
                  <div
                    ref={(node) => {
                      bannerRefs.current[index] = node;
                    }}
                    style={{
                      transition: "opacity 350ms ease, transform 350ms ease",
                    }}
                    className="absolute bottom-0 left-0 right-0 p-3 sm:p-4 bg-gradient-to-t from-black/95 via-black/85 to-transparent backdrop-blur-xs border-t border-white/10 z-20 flex flex-col sm:flex-row items-start sm:items-end justify-between gap-2 sm:gap-4 text-left"
                  >
                    <div className="space-y-1 max-w-md">
                      {/* Category Tag (Mobile fallback) */}
                      <div className="sm:hidden">
                        <span className="text-[9px] font-bold font-mono px-2 py-0.5 rounded-full bg-rose-950/80 border border-rose-500/40 text-rose-300 uppercase">
                          {item.tag || "Portofolio"}
                        </span>
                      </div>

                      {/* Main Title */}
                      <h4 className="text-sm sm:text-base md:text-lg font-extrabold text-white tracking-tight uppercase leading-tight font-sans drop-shadow-md">
                        {item.titleLine1}{" "}
                        {item.titleLine2 && (
                          <span className="text-rose-300 font-semibold">
                            {item.titleLine2}
                          </span>
                        )}
                      </h4>

                      {/* Description */}
                      {item.desc && (
                        <p className="text-[10px] sm:text-xs text-gray-300 line-clamp-2 leading-relaxed font-sans max-w-sm">
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
                      className="flex-shrink-0 inline-flex items-center gap-1.5 px-4 py-2 sm:px-4.5 sm:py-2.5 rounded-xl bg-gradient-to-r from-[#8B0021] via-[#a30026] to-[#50000F] hover:from-[#b8002b] hover:to-[#5E0013] text-white text-[11px] sm:text-xs font-bold font-sans tracking-wide uppercase shadow-lg shadow-rose-950/50 hover:scale-105 transition-all cursor-pointer border border-rose-500/30"
                    >
                      <span>{item.ctaText || "Lihat Selengkapnya"}</span>
                      <ArrowRight className="w-3.5 h-3.5 text-rose-200" />
                    </a>
                  </div>
                </div>
              );
            })}
          </div>
        </div>

        {/* Navigation Arrows */}
        <button
          type="button"
          onClick={() => nudge(-1)}
          aria-label="Previous portfolio"
          className="absolute left-2 sm:left-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/90 dark:bg-gray-900/90 border border-gray-200 dark:border-gray-800 text-[#8B0021] dark:text-rose-400 hover:scale-110 flex items-center justify-center backdrop-blur-md shadow-md hover:shadow-xl cursor-pointer z-40 transition-all"
        >
          <ChevronLeft className="w-5 h-5" />
        </button>

        <button
          type="button"
          onClick={() => nudge(1)}
          aria-label="Next portfolio"
          className="absolute right-2 sm:right-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/90 dark:bg-gray-900/90 border border-gray-200 dark:border-gray-800 text-[#8B0021] dark:text-rose-400 hover:scale-110 flex items-center justify-center backdrop-blur-md shadow-md hover:shadow-xl cursor-pointer z-40 transition-all"
        >
          <ChevronRight className="w-5 h-5" />
        </button>

        {/* Pagination Dots */}
        <div className="flex items-center justify-center gap-2 z-30 mt-2">
          {items.map((_, idx) => (
            <button
              key={idx}
              type="button"
              onClick={() => goTo(idx)}
              aria-label={`Go to slide ${idx + 1}`}
              className={`h-2 rounded-full transition-all duration-300 cursor-pointer ${
                idx === selected
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
