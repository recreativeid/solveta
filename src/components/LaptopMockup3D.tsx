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
  Pause,
  RotateCcw,
  Maximize2,
} from "lucide-react";

import { getUploadedVideo } from "@/utils/mediaDb";

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
  const [isPlaying, setIsPlaying] = useState(true);
  const [isMobile, setIsMobile] = useState(false);
  const [activeVideoSrc, setActiveVideoSrc] = useState<string>("");

  // Path resolver for GitHub Pages / base paths (Fallback)
  const resolvedVideoSrc = React.useMemo(() => {
    const raw = videoSrc || "/videos/profile.mp4";
    if (raw.startsWith("http") || raw.startsWith("data:") || raw.startsWith("blob:")) return raw;
    const isProd = process.env.NODE_ENV === "production";
    if (isProd && raw.startsWith("/") && !raw.startsWith("/solveta")) {
      return `/solveta${raw}`;
    }
    return raw;
  }, [videoSrc]);

  // Priority 1: Check for uploaded video in local IndexedDB (up to 100MB, 0 latency)
  // Priority 2: Fallback to link URL or default /videos/profile.mp4
  const refreshActiveVideo = React.useCallback(async () => {
    try {
      const uploaded = await getUploadedVideo();
      if (uploaded && uploaded.url) {
        setActiveVideoSrc(uploaded.url);
      } else {
        setActiveVideoSrc(resolvedVideoSrc);
      }
    } catch {
      setActiveVideoSrc(resolvedVideoSrc);
    }
  }, [resolvedVideoSrc]);

  useEffect(() => {
    refreshActiveVideo();

    const handleVideoUpdated = () => {
      refreshActiveVideo();
    };

    window.addEventListener("solveta_video_updated", handleVideoUpdated);
    return () => {
      window.removeEventListener("solveta_video_updated", handleVideoUpdated);
    };
  }, [refreshActiveVideo]);

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

  // Initial immediate playback attempt
  useEffect(() => {
    const video = videoRef.current;
    if (!video || !activeVideoSrc) return;

    video.muted = true;
    video.playsInline = true;
    const playPromise = video.play();
    if (playPromise !== undefined) {
      playPromise
        .then(() => setIsPlaying(true))
        .catch(() => {
          // Autoplay restricted until interaction
        });
    }
  }, [activeVideoSrc]);

  // Smart Viewport Video Control:
  // 1. Plays automatically when scrolled into view (if not manually paused)
  // 2. Pauses automatically when user scrolls away
  // 3. Resumes playing when user scrolls back
  useEffect(() => {
    const container = containerRef.current;
    const video = videoRef.current;
    if (!container || !video) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            if (!userPausedManuallyRef.current && video.paused) {
              const playPromise = video.play();
              if (playPromise !== undefined) {
                playPromise.catch(() => {});
              }
            }
          } else {
            if (!video.paused) {
              video.pause();
            }
          }
        });
      },
      {
        threshold: 0.15,
      }
    );

    observer.observe(container);

    return () => {
      observer.disconnect();
    };
  }, [resolvedVideoSrc]);

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

  // 3D Dynamic Parallax Tilt on Mouse Move
  const handleMouseMove = (e: React.MouseEvent<HTMLDivElement>) => {
    if (isMobile) return;
    const rect = e.currentTarget.getBoundingClientRect();
    const x = (e.clientX - rect.left) / rect.width - 0.5;
    const y = (e.clientY - rect.top) / rect.height - 0.5;
    setMousePos({ x, y });
  };

  const handleMouseLeave = () => {
    setMousePos({ x: 0, y: 0 });
  };

  // Toggle Sound (Mute / Unmute) with explicit volume control
  const toggleSound = (e: React.MouseEvent) => {
    e.stopPropagation();
    const video = videoRef.current;
    if (!video) return;

    if (video.muted) {
      video.muted = false;
      video.volume = 1.0;
      setIsMuted(false);
      // Ensure playing when unmuting
      if (video.paused) {
        userPausedManuallyRef.current = false;
        video.play().catch(() => {});
      }
    } else {
      video.muted = true;
      setIsMuted(true);
    }
  };

  // Toggle Play / Pause
  const togglePlay = (e?: React.MouseEvent) => {
    if (e) e.stopPropagation();
    const video = videoRef.current;
    if (!video) return;

    if (video.paused) {
      userPausedManuallyRef.current = false;
      video.play().then(() => setIsPlaying(true)).catch(() => {});
    } else {
      userPausedManuallyRef.current = true;
      video.pause();
      setIsPlaying(false);
    }
  };

  // Handle Fullscreen Video
  const handleFullscreen = (e: React.MouseEvent) => {
    e.stopPropagation();
    const video = videoRef.current;
    if (!video) return;
    if (video.requestFullscreen) {
      video.requestFullscreen();
    } else if ((video as any).webkitRequestFullscreen) {
      (video as any).webkitRequestFullscreen();
    } else if ((video as any).webkitEnterFullscreen) {
      (video as any).webkitEnterFullscreen();
    } else if ((video as any).msRequestFullscreen) {
      (video as any).msRequestFullscreen();
    }
  };

  // Restart video from beginning
  const handleRestart = (e: React.MouseEvent) => {
    e.stopPropagation();
    const video = videoRef.current;
    if (!video) return;
    video.currentTime = 0;
    userPausedManuallyRef.current = false;
    video.play().catch(() => {});
  };

  return (
    <div
      ref={containerRef}
      onMouseMove={handleMouseMove}
      onMouseLeave={handleMouseLeave}
      className="w-full flex flex-col items-center justify-center relative py-6 [perspective:1400px] select-none"
    >
      {/* Dynamic Futuristic Glow Aura Behind Laptop Screen */}
      <motion.div
        animate={{
          scale: [1, 1.05, 1],
          opacity: isPlaying ? [0.45, 0.65, 0.45] : 0.25,
        }}
        transition={{ duration: 4, repeat: Infinity, ease: "easeInOut" }}
        className="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[720px] h-[340px] bg-gradient-to-r from-[#8B0021]/50 via-rose-600/35 to-sky-500/40 blur-[90px] rounded-full pointer-events-none -z-10"
      />

      {/* 3D ROTATING LAPTOP CHASSIS CONTAINER */}
      <motion.div
        style={{
          rotateX: smoothRotateX,
          scale: smoothScale,
          y: smoothTranslateY,
          transformStyle: "preserve-3d",
        }}
        className="w-full max-w-[940px] px-2 sm:px-4 flex flex-col items-center relative"
      >
        {/* LAPTOP TOP DISPLAY LID (Tilted on hover / mouse movement) */}
        <motion.div
          animate={{
            rotateY: isMobile ? 0 : mousePos.x * 9,
            rotateX: isMobile ? 0 : -mousePos.y * 7,
          }}
          transition={{
            type: "spring",
            stiffness: 280,
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
                src={activeVideoSrc || resolvedVideoSrc}
                poster={posterSrc}
                autoPlay
                loop
                muted={isMuted}
                playsInline
                preload="auto"
                onPlay={() => setIsPlaying(true)}
                onPause={() => setIsPlaying(false)}
                onVolumeChange={() => {
                  if (videoRef.current) {
                    setIsMuted(videoRef.current.muted);
                  }
                }}
                className="w-full h-full object-cover"
              />

              {/* Play / Pause Center Overlay Indicator when paused */}
              <AnimatePresence>
                {!isPlaying && (
                  <motion.div
                    initial={{ opacity: 0, scale: 0.8 }}
                    animate={{ opacity: 1, scale: 1 }}
                    exit={{ opacity: 0, scale: 0.8 }}
                    className="absolute inset-0 bg-black/45 backdrop-blur-[2px] flex items-center justify-center z-10 pointer-events-none"
                  >
                    <div className="w-14 h-14 rounded-full bg-rose-600/90 text-white flex items-center justify-center shadow-[0_0_30px_rgba(225,29,72,0.6)] border border-rose-400/50">
                      <Play className="w-6 h-6 fill-white translate-x-0.5" />
                    </div>
                  </motion.div>
                )}
              </AnimatePresence>

              {/* Interactive Audio, Play/Pause, Replay & Fullscreen Control Buttons */}
              <div className="absolute bottom-2.5 sm:bottom-3 left-2.5 sm:left-3 right-2.5 sm:right-3 flex items-center justify-between pointer-events-none z-20">
                {/* Left: Play/Pause and Replay Buttons */}
                <div className="flex items-center gap-1.5 sm:gap-2">
                  {/* Play / Pause Toggle Button */}
                  <button
                    onClick={togglePlay}
                    className="pointer-events-auto w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-black/70 hover:bg-black/95 backdrop-blur-md text-gray-200 hover:text-white rounded-full border border-white/20 transition-all shadow-md cursor-pointer hover:scale-110 active:scale-95"
                    title={isPlaying ? "Jeda Video (Pause)" : "Putar Video (Play)"}
                  >
                    {isPlaying ? (
                      <Pause className="w-3.5 h-3.5 fill-white" />
                    ) : (
                      <Play className="w-3.5 h-3.5 fill-white translate-x-0.5" />
                    )}
                  </button>

                  {/* Replay Button */}
                  <button
                    onClick={handleRestart}
                    className="pointer-events-auto w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-black/70 hover:bg-black/95 backdrop-blur-md text-gray-200 hover:text-white rounded-full border border-white/20 transition-all shadow-md cursor-pointer hover:scale-110 active:scale-95"
                    title="Ulangi video dari awal"
                  >
                    <RotateCcw className="w-3.5 h-3.5" />
                  </button>
                </div>

                {/* Right: Sound Toggle & Fullscreen Buttons */}
                <div className="flex items-center gap-1.5 sm:gap-2">
                  {/* Sound Toggle Button */}
                  <button
                    onClick={toggleSound}
                    className={`pointer-events-auto w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full backdrop-blur-md transition-all duration-300 shadow-xl border cursor-pointer hover:scale-110 active:scale-95 ${
                      isMuted
                        ? "bg-black/70 hover:bg-black/95 text-gray-300 border-white/20 hover:border-rose-400"
                        : "bg-[#8B0021] hover:bg-[#a30026] text-white border-rose-400/60 shadow-[0_0_15px_rgba(244,63,94,0.5)]"
                    }`}
                    title={isMuted ? "Hidupkan Suara (Unmute)" : "Matikan Suara (Mute)"}
                  >
                    {isMuted ? (
                      <VolumeX className="w-4 h-4 text-rose-300" />
                    ) : (
                      <Volume2 className="w-4 h-4 text-white" />
                    )}
                  </button>

                  {/* Fullscreen Button */}
                  <button
                    onClick={handleFullscreen}
                    className="pointer-events-auto w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-black/70 hover:bg-black/95 backdrop-blur-md text-gray-200 hover:text-white rounded-full border border-white/20 transition-all shadow-md cursor-pointer hover:scale-110 active:scale-95"
                    title="Lihat Layar Penuh (Fullscreen)"
                  >
                    <Maximize2 className="w-3.5 h-3.5" />
                  </button>
                </div>
              </div>
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
