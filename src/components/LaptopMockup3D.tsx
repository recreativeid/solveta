"use client";

import React, { useState } from "react";
import { motion } from "framer-motion";
import {
  Code2,
  Terminal,
  Layers,
  Sparkles,
  CheckCircle2,
  FolderTree,
  FileCode,
  Globe,
  Cpu,
} from "lucide-react";

export const LaptopMockup3D: React.FC = () => {
  const [activeTab, setActiveTab] = useState<"code" | "preview">("code");
  const [mousePos, setMousePos] = useState({ x: 0, y: 0 });

  const handleMouseMove = (e: React.MouseEvent<HTMLDivElement>) => {
    const rect = e.currentTarget.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width - 0.5) * 12; // tilt max 6deg
    const y = ((e.clientY - rect.top) / rect.height - 0.5) * -12;
    setMousePos({ x, y });
  };

  const handleMouseLeave = () => {
    setMousePos({ x: 0, y: 0 });
  };

  return (
    <motion.div
      initial={{ opacity: 0, y: 40, scale: 0.95 }}
      animate={{ opacity: 1, y: 0, scale: 1 }}
      transition={{ duration: 0.8, delay: 0.4, ease: [0.16, 1, 0.3, 1] }}
      className="mt-14 max-w-[940px] mx-auto px-2 select-none"
      onMouseMove={handleMouseMove}
      onMouseLeave={handleMouseLeave}
      style={{ perspective: 1400 }}
    >
      {/* 3D Floating & Interactive Tilt Container */}
      <motion.div
        animate={{
          rotateX: mousePos.y,
          rotateY: mousePos.x,
          y: [0, -8, 0],
        }}
        transition={{
          rotateX: { type: "spring", stiffness: 120, damping: 15 },
          rotateY: { type: "spring", stiffness: 120, damping: 15 },
          y: { duration: 5, repeat: Infinity, ease: "easeInOut" },
        }}
        className="relative flex flex-col items-center"
      >
        {/* Soft Ambient Maroon Glow Behind Laptop */}
        <div className="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[280px] bg-gradient-to-r from-[#8B0021]/15 via-rose-400/10 to-[#50000F]/15 rounded-full blur-[90px] pointer-events-none -z-10" />

        {/* LAPTOP SCREEN (LID) */}
        <div className="w-full max-w-[840px] bg-[#1a1b26] rounded-t-[18px] sm:rounded-t-[22px] p-2.5 sm:p-3.5 border-[3px] border-[#2e303e] shadow-[0_25px_60px_-15px_rgba(0,0,0,0.4)] relative">
          {/* Top Webcam Notch */}
          <div className="absolute top-1.5 left-1/2 -translate-x-1/2 flex items-center gap-1.5">
            <div className="w-1.5 h-1.5 rounded-full bg-[#3b3e52]" />
            <div className="w-1 h-1 rounded-full bg-emerald-500/80 animate-pulse" />
          </div>

          {/* INNER DISPLAY */}
          <div className="w-full aspect-[16/10] bg-[#12131a] rounded-[10px] sm:rounded-[14px] overflow-hidden flex flex-col text-left border border-[#2a2c3d] shadow-inner font-mono text-xs">
            {/* IDE Window Title Bar */}
            <div className="h-8 bg-[#181924] border-b border-[#252839] flex items-center justify-between px-3.5 flex-shrink-0">
              {/* Window Controls */}
              <div className="flex items-center gap-1.5">
                <div className="w-2.5 h-2.5 rounded-full bg-[#ff5f56]" />
                <div className="w-2.5 h-2.5 rounded-full bg-[#ffbd2e]" />
                <div className="w-2.5 h-2.5 rounded-full bg-[#27c93f]" />
                <span className="text-[10px] text-gray-500 font-sans ml-2 hidden sm:inline font-semibold">
                  SOLVETA Developer Studio — Web Architecture
                </span>
              </div>

              {/* IDE Editor Tabs */}
              <div className="flex items-center gap-1 text-[10px]">
                <button
                  type="button"
                  onClick={() => setActiveTab("code")}
                  className={`px-3 py-1 rounded-md transition-all flex items-center gap-1.5 ${
                    activeTab === "code"
                      ? "bg-[#202231] text-rose-300 font-bold border border-rose-500/30"
                      : "text-gray-400 hover:text-gray-200"
                  }`}
                >
                  <FileCode className="w-3 h-3 text-[#ff7597]" />
                  <span>solveta-engine.ts</span>
                </button>
                <button
                  type="button"
                  onClick={() => setActiveTab("preview")}
                  className={`px-3 py-1 rounded-md transition-all flex items-center gap-1.5 ${
                    activeTab === "preview"
                      ? "bg-[#202231] text-rose-300 font-bold border border-rose-500/30"
                      : "text-gray-400 hover:text-gray-200"
                  }`}
                >
                  <Globe className="w-3 h-3 text-emerald-400" />
                  <span>Live App &bull; 3000</span>
                </button>
              </div>
            </div>

            {/* IDE Main Body: Split View (Sidebar + Code Editor or Live Preview) */}
            <div className="flex-grow flex overflow-hidden">
              {/* File Explorer Sidebar */}
              <div className="w-44 bg-[#141520] border-r border-[#222436] p-3 hidden md:flex flex-col justify-between text-[11px] text-gray-400 font-sans">
                <div className="space-y-2">
                  <div className="text-[10px] font-bold tracking-wider uppercase text-gray-500 flex items-center gap-1.5">
                    <FolderTree className="w-3 h-3 text-[#ff7597]" />
                    <span>WORKSPACE</span>
                  </div>
                  <div className="space-y-1 pl-1">
                    <div className="flex items-center gap-1.5 text-gray-300">
                      <span className="text-gray-500">📁</span>
                      <span>src / components</span>
                    </div>
                    <div className="flex items-center gap-1.5 text-gray-300">
                      <span className="text-gray-500">📁</span>
                      <span>api / cloud-db</span>
                    </div>
                    <div className="flex items-center gap-1.5 text-rose-400 font-semibold bg-[#222436]/60 px-1.5 py-0.5 rounded">
                      <span className="text-rose-400">⚡</span>
                      <span>solveta-engine.ts</span>
                    </div>
                    <div className="flex items-center gap-1.5 text-gray-400">
                      <span className="text-gray-500">📄</span>
                      <span>supabase.config.ts</span>
                    </div>
                    <div className="flex items-center gap-1.5 text-gray-400">
                      <span className="text-gray-500">📄</span>
                      <span>portfolio-data.json</span>
                    </div>
                  </div>
                </div>

                <div className="p-2 rounded-lg bg-[#1b1d2c] border border-[#2b2e44] text-[10px] text-gray-300 flex items-center gap-2">
                  <span className="w-2 h-2 rounded-full bg-emerald-400 animate-ping" />
                  <span className="truncate">Supabase Cloud 24/7</span>
                </div>
              </div>

              {/* Editor Workspace Content */}
              {activeTab === "code" ? (
                <div className="flex-grow p-3 sm:p-5 overflow-hidden flex flex-col justify-between bg-[#12131a]">
                  <div className="space-y-1.5 text-[11px] sm:text-xs leading-relaxed overflow-x-auto">
                    <div className="text-gray-500 italic">
                      // SOLVETA — Next.js 14 &amp; Supabase High-Performance Digital Architecture
                    </div>
                    <div>
                      <span className="text-[#ff7597]">import</span> &#123;{" "}
                      <span className="text-[#82aaff]">createDigitalSolution</span>,{" "}
                      <span className="text-[#82aaff]">cloudSync247</span> &#125;{" "}
                      <span className="text-[#ff7597]">from</span>{" "}
                      <span className="text-[#c3e88d]">&quot;@solveta/engine&quot;</span>;
                    </div>
                    <br />
                    <div>
                      <span className="text-[#ff7597]">export async function</span>{" "}
                      <span className="text-[#82aaff]">buildBusinessPlatform</span>() &#123;
                    </div>
                    <div className="pl-4">
                      <span className="text-[#ff7597]">const</span>{" "}
                      <span className="text-[#ffcb6b]">architecture</span> ={" "}
                      <span className="text-[#ff7597]">await</span>{" "}
                      <span className="text-[#82aaff]">createDigitalSolution</span>(&#123;
                    </div>
                    <div className="pl-8 text-gray-300">
                      <span className="text-[#f78c6c]">client</span>:{" "}
                      <span className="text-[#c3e88d]">&quot;Enterprise Growth&quot;</span>,
                    </div>
                    <div className="pl-8 text-gray-300">
                      <span className="text-[#f78c6c]">database</span>:{" "}
                      <span className="text-[#c3e88d]">&quot;Supabase Cloud 24/7&quot;</span>,
                    </div>
                    <div className="pl-8 text-gray-300">
                      <span className="text-[#f78c6c]">speedScore</span>:{" "}
                      <span className="text-[#ff5370]">100</span>, <span className="text-gray-500">// Ultra-Fast Load</span>
                    </div>
                    <div className="pl-8 text-gray-300">
                      <span className="text-[#f78c6c]">status</span>:{" "}
                      <span className="text-[#c3e88d]">&quot;Ready for Scaling&quot;</span>,
                    </div>
                    <div className="pl-4">&#125;);</div>
                    <br />
                    <div className="pl-4">
                      <span className="text-[#ff7597]">return</span>{" "}
                      <span className="text-[#ffcb6b]">architecture</span>.
                      <span className="text-[#82aaff]">deployLive</span>();
                    </div>
                    <div>&#125;</div>
                  </div>

                  {/* Built-in Interactive Terminal Bar */}
                  <div className="mt-3 pt-2.5 border-t border-[#252839] flex items-center justify-between text-[10px] text-gray-400">
                    <div className="flex items-center gap-2">
                      <Terminal className="w-3 h-3 text-rose-400" />
                      <span className="text-emerald-400 font-bold">✓ Ready</span>
                      <span className="hidden sm:inline text-gray-500">
                        — compiled successfully in 12ms
                      </span>
                    </div>
                    <div className="flex items-center gap-2">
                      <span className="text-gray-500">TypeScript 5.0</span>
                      <span className="text-rose-400 font-bold">SOLVETA OS</span>
                    </div>
                  </div>
                </div>
              ) : (
                /* LIVE APP PREVIEW TAB */
                <div className="flex-grow p-4 sm:p-6 bg-gradient-to-br from-[#181a26] to-[#0f1017] flex flex-col justify-between">
                  <div className="space-y-4">
                    <div className="flex items-center justify-between pb-3 border-b border-gray-800">
                      <div className="flex items-center gap-2">
                        <div className="w-6 h-6 rounded-md bg-gradient-to-br from-[#8B0021] to-[#50000F] flex items-center justify-center text-white text-[10px] font-bold">
                          S
                        </div>
                        <span className="font-bold text-white text-xs font-sans">
                          SOLVETA Digital Hub
                        </span>
                      </div>
                      <span className="text-[10px] font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/30 px-2 py-0.5 rounded-full flex items-center gap-1">
                        <span className="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse" />
                        Live Staging
                      </span>
                    </div>

                    <div className="grid grid-cols-2 sm:grid-cols-3 gap-3">
                      <div className="p-3 rounded-xl bg-[#1e2030] border border-[#2e324b] text-left">
                        <div className="text-[10px] text-gray-400">Total Solusi</div>
                        <div className="text-base font-extrabold text-white">100%</div>
                        <div className="text-[9px] text-emerald-400">Terstruktur &amp; Otomatis</div>
                      </div>
                      <div className="p-3 rounded-xl bg-[#1e2030] border border-[#2e324b] text-left">
                        <div className="text-[10px] text-gray-400">Database Cloud</div>
                        <div className="text-base font-extrabold text-rose-300">24/7</div>
                        <div className="text-[9px] text-gray-400">Supabase Connected</div>
                      </div>
                      <div className="p-3 rounded-xl bg-[#1e2030] border border-[#2e324b] text-left col-span-2 sm:col-span-1">
                        <div className="text-[10px] text-gray-400">Performa Web</div>
                        <div className="text-base font-extrabold text-emerald-400">99.9%</div>
                        <div className="text-[9px] text-gray-400">Ultra-Fast Response</div>
                      </div>
                    </div>
                  </div>

                  <div className="text-[10px] text-gray-400 flex items-center justify-between pt-2">
                    <span>⚡ Realtime Digital Transformation</span>
                    <button
                      onClick={() => setActiveTab("code")}
                      className="text-rose-400 hover:underline"
                    >
                      Kembali ke Kode Editor &rarr;
                    </button>
                  </div>
                </div>
              )}
            </div>
          </div>
        </div>

        {/* LAPTOP BOTTOM BASE & HINGE */}
        <div className="w-full max-w-[920px] h-3.5 sm:h-4 bg-gradient-to-b from-[#d1d5db] via-[#9ca3af] to-[#6b7280] rounded-b-[14px] sm:rounded-b-[18px] shadow-[0_15px_30px_rgba(0,0,0,0.35)] relative flex items-center justify-center">
          {/* Thumb Notch */}
          <div className="w-24 sm:w-32 h-1.5 bg-[#4b5563] rounded-b-md" />
        </div>

        {/* Base Table Reflection Shadow */}
        <div className="w-[85%] h-5 bg-gradient-to-r from-transparent via-black/20 to-transparent blur-md rounded-full mt-1 pointer-events-none" />
      </motion.div>
    </motion.div>
  );
};
