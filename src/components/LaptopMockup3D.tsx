"use client";

import React, { useState, useRef, useEffect } from "react";
import {
  motion,
  AnimatePresence,
  useScroll,
  useTransform,
  useSpring,
} from "framer-motion";
import {
  Volume2,
  VolumeX,
  Play,
  Sparkles,
  Film,
  RotateCcw,
} from "lucide-react";

interface LaptopMockup3DProps {
  videoSrc?: string;
  posterSrc?: string;
}

export const LaptopMockup3D: React.FC<LaptopMockup3DProps> = ({
  videoSrc = "/videos/profile.mp4",
  posterSrc,
}) => {
  const containerRef = useRef<HTMLDivElement>(null);
  const videoRef = useRef<HTMLVideoElement>(null);

  const [mousePos, setMousePos] = useState({ x: 0, y: 0 });
  const [isMuted, setIsMuted] = useState(true);
  const [isPlaying, setIsPlaying] = useState(false);
  const [hasError, setHasError] = useState(false);
  const [isMobile, setIsMobile] = useState(false);

  const hasStartedRef = useRef(false);
  const userPausedManuallyRef = useRef(false);

  useEffect(() => {
    const checkMobile = () => {
      setIsMobile(window.innerWidth <= 768);
    };
    checkMobile();
    window.addEventListener("resize", checkMobile);
    return () => {
      window.removeEventListener("resize", checkMobile);
    };
  }, []);

  // Smart Viewport Video Control:
  // 1. Starts from 00:00 when first scrolled into view (not running in background)
  // 2. Pauses automatically when user scrolls away
  // 3. Resumes playing when user scrolls back
  useEffect(() => {
    const container = containerRef.current;
    const video = videoRef.current;
    if (!container || !video) return;

    // Reset started state when videoSrc changes
    hasStartedRef.current = false;
    userPausedManuallyRef.current = false;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            // First time entering viewport: ensure starts from the very beginning (00:00)
            if (!hasStartedRef.current) {
              video.currentTime = 0;
              hasStartedRef.current = true;
            }

            // Only auto-play if the user didn't explicitly pause manually
            if (!userPausedManuallyRef.current) {
              video
                .play()
                .then(() => setIsPlaying(true))
                .catch(() => {
                  // If browser restricts unmuted autoplay, mute and retry
                  video.muted = true;
                  setIsMuted(true);
                  video
                    .play()
                    .then(() => setIsPlaying(true))
                    .catch(() => {});
                });
            }
          } else {
            // User scrolled away from laptop: pause video to save resources & pause playback
            if (!video.paused) {
              video.pause();
              setIsPlaying(false);
            }
          }
        });
      },
      {
        threshold: 0.25, // Trigger when 25% of laptop is in screen view
      }
    );

    observer.observe(container);

    return () => {
      observer.disconnect();
    };
  }, [videoSrc]);

  // 3D Scroll-driven Rotation Animation (Aceternity style Container Scroll)
  const { scrollYProgress } = useScroll({
    target: containerRef,
    offset: ["start end", "center center"],
  });

  const rawRotateX = useTransform(scrollYProgress, [0, 1], [22, 0]);
  const rawScale = useTransform(
    scrollYProgress,
    [0, 1],
    isMobile ? [0.88, 1] : [0.94, 1.02]
  );
  const rawTranslateY = useTransform(scrollYProgress, [0, 1], [50, 0]);

  // Smooth springs for buttery smooth 3D physics
  const smoothRotateX = useSpring(rawRotateX, { stiffness: 120, damping: 20 });
  const smoothScale = useSpring(rawScale, { stiffness: 120, damping: 20 });
  const smoothTranslateY = useSpring(rawTranslateY, { stiffness: 120, damping: 20 });

  const handleMouseMove = (e: React.MouseEvent<HTMLDivElement>) => {
    const rect = e.currentTarget.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width - 0.5) * 8;
    const y = ((e.clientY - rect.top) / rect.height - 0.5) * -8;
    setMousePos({ x, y });
  };

  const handleMouseLeave = () => {
    setMousePos({ x: 0, y: 0 });
  };

  // Toggle Sound (Mute / Unmute)
  const toggleSound = (e: React.MouseEvent) => {
    e.stopPropagation();
    if (videoRef.current) {
      const nextMuted = !isMuted;
      videoRef.current.muted = nextMuted;
      setIsMuted(nextMuted);

      if (videoRef.current.paused) {
        userPausedManuallyRef.current = false;
        videoRef.current.play().catch(() => {});
        setIsPlaying(true);
      }
    }
  };

  // Toggle Play / Pause on screen click
  const togglePlay = () => {
    if (!videoRef.current || hasError) return;
    if (videoRef.current.paused) {
      userPausedManuallyRef.current = false;
      videoRef.current.play().catch(() => {});
      setIsPlaying(true);
    } else {
      userPausedManuallyRef.current = true;
      videoRef.current.pause();
      setIsPlaying(false);
    }
  };

  const handleRestart = (e: React.MouseEvent) => {
    e.stopPropagation();
    if (videoRef.current) {
      userPausedManuallyRef.current = false;
      videoRef.current.currentTime = 0;
      videoRef.current.play().catch(() => {});
      setIsPlaying(true);
    }
  };

  return (
    <div
      ref={containerRef}
      className="mt-6 md:mt-10 max-w-[1000px] mx-auto px-2 select-none"
      onMouseMove={handleMouseMove}
      onMouseLeave={handleMouseLeave}
      style={{ perspective: 1400 }}
    >
      {/* 3D Scroll-Animated & Interactive Tilt Container */}
      <motion.div
        style={{
          rotateX: smoothRotateX,
          scale: smoothScale,
          y: smoothTranslateY,
        }}
        className="relative flex flex-col items-center"
      >
        {/* Soft Ambient Maroon Glow Behind Laptop */}
        <div className="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[780px] h-[320px] bg-gradient-to-r from-[#8B0021]/25 via-rose-500/20 to-[#50000F]/25 rounded-full blur-[100px] pointer-events-none -z-10" />

        {/* LAPTOP SCREEN CHASSIS (LID) */}
        <motion.div
          animate={{
            rotateX: mousePos.y * 0.6,
            rotateY: mousePos.x * 0.6,
          }}
          transition={{
            type: "spring",
            stiffness: 150,
            damping: 18,
          }}
          className="w-full max-w-[880px] bg-[#1a1b24] rounded-t-[18px] sm:rounded-t-[24px] p-2.5 sm:p-3.5 border-[3px] border-[#2c2d3a] shadow-[0_35px_80px_-15px_rgba(0,0,0,0.65)] relative"
        >
          {/* Top Webcam Notch */}
          <div className="absolute top-1.5 left-1/2 -translate-x-1/2 flex items-center gap-1.5 z-20">
            <div className="w-1.5 h-1.5 rounded-full bg-[#3b3e52]" />
            <div className="w-1 h-1 rounded-full bg-emerald-500/90 animate-pulse" />
          </div>

          {/* INNER DISPLAY: VIDEO PLAYER CONTAINER */}
          <div
            onClick={togglePlay}
            className="w-full aspect-[16/10] bg-[#0c0d12] rounded-[10px] sm:rounded-[14px] overflow-hidden flex flex-col text-left border border-[#232533] shadow-inner font-sans relative cursor-pointer group"
          >
            {/* Window Header Bar (Clean macOS Dots) */}
            <div className="h-6 sm:h-7 bg-[#14151e]/90 backdrop-blur-md border-b border-[#202230] flex items-center px-3 sm:px-4 flex-shrink-0 z-20">
              <div className="flex items-center gap-1.5">
                <div className="w-2.5 h-2.5 rounded-full bg-[#ff5f56]" />
                <div className="w-2.5 h-2.5 rounded-full bg-[#ffbd2e]" />
                <div className="w-2.5 h-2.5 rounded-full bg-[#27c93f]" />
              </div>
            </div>

            {/* MAIN VIDEO AREA */}
            <div className="relative flex-grow w-full h-full bg-[#07080d] overflow-hidden flex items-center justify-center">
              {/* HTML5 Video Tag */}
              <video
                ref={videoRef}
                src={videoSrc}
                poster={posterSrc}
                loop
                muted={isMuted}
                playsInline
                preload="auto"
                onPlay={() => setIsPlaying(true)}
                onPause={() => setIsPlaying(false)}
                onError={() => setHasError(true)}
                className="w-full h-full object-cover"
              />

              {/* Fallback View if Video File Not Yet Uploaded */}
              {hasError && (
                <div className="absolute inset-0 bg-gradient-to-b from-[#141624] via-[#0d0e17] to-[#08080d] flex flex-col items-center justify-center p-6 text-center z-10 space-y-3">
                  <div className="w-12 h-12 rounded-2xl bg-rose-950/60 border border-rose-500/30 flex items-center justify-center text-rose-400 shadow-[0_0_20px_rgba(244,63,94,0.2)]">
                    <Film className="w-6 h-6 animate-pulse" />
                  </div>
                  <div className="space-y-1 max-w-sm">
                    <h3 className="text-sm font-bold text-white tracking-wide">
                      Video Profil Solveta Siap Diputar
                    </h3>
                    <p className="text-[11px] text-gray-400 leading-relaxed">
                      Upload video via menu Developer di{" "}
                      <code className="text-rose-300 bg-rose-950/50 px-1.5 py-0.5 rounded text-[10px] font-mono border border-rose-800/40">
                        /admin
                      </code>{" "}
                      atau taruh di{" "}
                      <code className="text-rose-300 bg-rose-950/50 px-1.5 py-0.5 rounded text-[10px] font-mono border border-rose-800/40">
                        public/videos/profile.mp4
                      </code>
                    </p>
                  </div>
                  <div className="flex items-center gap-1.5 text-[10px] text-rose-400/90 bg-white/5 px-3 py-1 rounded-full border border-white/10">
                    <Sparkles className="w-3 h-3 text-rose-400" />
                    <span>3D Container Scroll • Autoplay • Audio Toggle</span>
                  </div>
                </div>
              )}

              {/* Play / Pause Center Overlay Indicator */}
              <AnimatePresence>
                {!isPlaying && !hasError && (
                  <motion.div
                    initial={{ opacity: 0, scale: 0.8 }}
                    animate={{ opacity: 1, scale: 1 }}
                    exit={{ opacity: 0, scale: 0.8 }}
                    className="absolute inset-0 bg-black/40 backdrop-blur-[2px] flex items-center justify-center z-10"
                  >
                    <div className="w-14 h-14 rounded-full bg-rose-600/90 text-white flex items-center justify-center shadow-[0_0_30px_rgba(225,29,72,0.6)] border border-rose-400/50">
                      <Play className="w-6 h-6 fill-white translate-x-0.5" />
                    </div>
                  </motion.div>
                )}
              </AnimatePresence>

              {/* Interactive Audio & Control Badges */}
              {!hasError && (
                <div className="absolute bottom-3 left-3 right-3 flex items-center justify-between pointer-events-none z-20">
                  {/* Left: Replay Button */}
                  <button
                    onClick={handleRestart}
                    className="pointer-events-auto flex items-center gap-1.5 px-2.5 py-1.5 bg-black/60 hover:bg-black/80 backdrop-blur-md text-gray-300 hover:text-white rounded-lg text-[10px] font-medium border border-white/10 transition-all shadow-md cursor-pointer"
                    title="Ulangi video dari awal"
                  >
                    <RotateCcw className="w-3 h-3" />
                    <span className="hidden sm:inline">Ulangi</span>
                  </button>

                  {/* Right: Sound Toggle Button with Equalizer Soundwaves */}
                  <button
                    onClick={toggleSound}
                    className={`pointer-events-auto flex items-center gap-2 px-3 sm:px-3.5 py-1.5 sm:py-2 rounded-full text-xs font-semibold backdrop-blur-md transition-all duration-300 shadow-xl border cursor-pointer ${
                      isMuted
                        ? "bg-black/75 hover:bg-black/90 text-gray-200 border-white/20 hover:border-rose-500/50"
                        : "bg-gradient-to-r from-[#8B0021]/90 to-rose-600/90 text-white border-rose-400/60 shadow-[0_0_20px_rgba(244,63,94,0.4)]"
                    }`}
                  >
                    {isMuted ? (
                      <>
                        <div className="relative flex items-center justify-center w-4 h-4">
                          <VolumeX className="w-4 h-4 text-rose-400" />
                        </div>
                        <span className="text-[11px] font-medium tracking-wide">
                          Nyalakan Suara
                        </span>
                        <span className="w-1.5 h-1.5 rounded-full bg-rose-500 animate-ping" />
                      </>
                    ) : (
                      <>
                        <Volume2 className="w-4 h-4 text-white" />
                        <span className="text-[11px] font-medium tracking-wide">
                          Audio Aktif
                        </span>
                        {/* Animated Equalizer Wave Bars */}
                        <div className="flex items-center gap-0.5 h-3">
                          <span className="w-0.5 h-full bg-white rounded-full animate-bounce [animation-delay:-0.3s]" />
                          <span className="w-0.5 h-3/4 bg-white rounded-full animate-bounce [animation-delay:-0.15s]" />
                          <span className="w-0.5 h-full bg-white rounded-full animate-bounce [animation-delay:-0.45s]" />
                          <span className="w-0.5 h-2/3 bg-white rounded-full animate-bounce" />
                        </div>
                      </>
                    )}
                  </button>
                </div>
              )}
            </div>
          </div>
        </motion.div>

        {/* LAPTOP BOTTOM BASE & HINGE */}
        <div className="w-full max-w-[960px] h-3.5 sm:h-4 bg-gradient-to-b from-[#d1d5db] via-[#9ca3af] to-[#6b7280] rounded-b-[14px] sm:rounded-b-[18px] shadow-[0_18px_35px_rgba(0,0,0,0.35)] relative flex items-center justify-center">
          {/* Thumb Notch */}
          <div className="w-24 sm:w-32 h-1.5 bg-[#4b5563] rounded-b-md" />
        </div>

        {/* Base Table Reflection Shadow */}
        <div className="w-[85%] h-5 bg-gradient-to-r from-transparent via-black/25 to-transparent blur-md rounded-full mt-1 pointer-events-none" />
      </motion.div>
    </div>
  );
};
