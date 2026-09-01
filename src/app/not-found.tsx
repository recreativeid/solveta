"use client";

import React, { useEffect } from "react";
import Link from "next/link";
import { ArrowLeft } from "lucide-react";

export default function NotFound() {
  // Auto redirect to homepage if accessed directly or via GitHub Pages 404
  useEffect(() => {
    if (typeof window !== "undefined") {
      const path = window.location.pathname;
      if (path.includes("/solveta") && !path.endsWith("/solveta/") && !path.includes("/admin")) {
        window.location.replace("/solveta/");
      }
    }
  }, []);

  return (
    <div className="min-h-screen bg-white dark:bg-[#07080E] flex items-center justify-center p-6 text-center">
      <div className="max-w-md w-full space-y-6">
        <div className="w-16 h-16 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-100 dark:border-rose-900/50 text-[#8B0021] dark:text-rose-400 flex items-center justify-center mx-auto text-2xl font-black">
          404
        </div>
        <div className="space-y-2">
          <h1 className="text-xl font-bold text-gray-900 dark:text-white">
            Halaman Tidak Ditemukan
          </h1>
          <p className="text-xs text-gray-500 dark:text-gray-400">
            Halaman yang Anda cari tidak tersedia atau sedang diperbarui.
          </p>
        </div>
        <Link
          href="/"
          className="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#8B0021] hover:bg-[#a30026] text-white font-bold text-xs rounded-xl shadow-xs transition-all"
        >
          <ArrowLeft className="w-4 h-4" />
          <span>Kembali ke Beranda SOLVETA</span>
        </Link>
      </div>
    </div>
  );
}
