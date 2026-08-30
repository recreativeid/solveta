"use client";

import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Search, X, ArrowRight } from "lucide-react";

interface SearchModalProps {
  isOpen: boolean;
  onClose: () => void;
}

interface SearchResult {
  title: string;
  category: string;
  link: string;
}

const allItems: SearchResult[] = [
  { title: "Website & Digital Presence", category: "Services", link: "#services" },
  { title: "Business Digitalization", category: "Services", link: "#services" },
  { title: "Custom Digital Solution", category: "Services", link: "#services" },
  { title: "Database & Integration", category: "Services", link: "#services" },
  { title: "Optimization", category: "Services", link: "#services" },
  { title: "Paket Basic — Rp 299K", category: "Pricing", link: "#pricing" },
  { title: "Paket Standard — Rp 549K (Popular)", category: "Pricing", link: "#pricing" },
  { title: "Paket Premium — Rp 749K", category: "Pricing", link: "#pricing" },
  { title: "Paket Custom — Mulai Rp 1,5 Juta", category: "Pricing", link: "#pricing" },
  { title: "01 Understand & 02 Analyze", category: "Process", link: "#process" },
  { title: "03 Design & 04 Develop", category: "Process", link: "#process" },
  { title: "05 Integrate & 06 Launch", category: "Process", link: "#process" },
  { title: "Konsultasi Gratis Langsung", category: "Contact", link: "#contact" },
];

export const SearchModal: React.FC<SearchModalProps> = ({ isOpen, onClose }) => {
  const [query, setQuery] = useState("");

  useEffect(() => {
    const handleKeyDown = (e: KeyboardEvent) => {
      if ((e.metaKey || e.ctrlKey) && e.key === "k") {
        e.preventDefault();
        if (isOpen) {
          onClose();
        } else {
          // Open
        }
      }
      if (e.key === "Escape" && isOpen) {
        onClose();
      }
    };

    window.addEventListener("keydown", handleKeyDown);
    return () => window.removeEventListener("keydown", handleKeyDown);
  }, [isOpen, onClose]);

  const filtered = query.trim()
    ? allItems.filter(
        (i) =>
          i.title.toLowerCase().includes(query.toLowerCase()) ||
          i.category.toLowerCase().includes(query.toLowerCase())
      )
    : allItems;

  return (
    <AnimatePresence>
      {isOpen && (
        <div className="fixed inset-0 z-50 flex items-start justify-center pt-24 px-4">
          {/* Backdrop */}
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            onClick={onClose}
            className="fixed inset-0 bg-black/40 backdrop-blur-sm"
          />

          {/* Dialog */}
          <motion.div
            initial={{ opacity: 0, scale: 0.95, y: -15 }}
            animate={{ opacity: 1, scale: 1, y: 0 }}
            exit={{ opacity: 0, scale: 0.95, y: -15 }}
            transition={{ duration: 0.2, ease: [0.16, 1, 0.3, 1] }}
            className="bg-white border border-gray-200 rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden relative z-10"
          >
            {/* Input Header */}
            <div className="flex items-center gap-3 px-4 py-3.5 border-b border-gray-100">
              <Search className="w-4 h-4 text-gray-400" />
              <input
                type="text"
                autoFocus
                value={query}
                onChange={(e) => setQuery(e.target.value)}
                placeholder="Cari solusi, paket, atau layanan..."
                className="w-full text-sm text-gray-900 placeholder-gray-400 outline-none bg-transparent"
              />
              <button
                onClick={onClose}
                className="text-gray-400 hover:text-gray-600 p-1 rounded-md"
              >
                <X className="w-4 h-4" />
              </button>
            </div>

            {/* Results List */}
            <div className="max-h-72 overflow-y-auto p-2">
              {filtered.length === 0 ? (
                <div className="py-8 text-center text-xs text-gray-400">
                  Tidak ada hasil untuk &quot;{query}&quot;
                </div>
              ) : (
                filtered.map((item) => (
                  <a
                    key={item.title}
                    href={item.link}
                    onClick={onClose}
                    className="flex items-center justify-between p-2.5 rounded-lg hover:bg-gray-50 transition-colors group"
                  >
                    <div>
                      <div className="text-xs font-semibold text-gray-800 group-hover:text-brand-800">
                        {item.title}
                      </div>
                      <div className="text-[10px] text-gray-400">
                        {item.category}
                      </div>
                    </div>
                    <ArrowRight className="w-3.5 h-3.5 text-gray-300 group-hover:text-brand-800 transition-colors" />
                  </a>
                ))
              )}
            </div>

            {/* Footer */}
            <div className="px-4 py-2 bg-gray-50 border-t border-gray-100 text-[10px] text-gray-400 flex items-center justify-between">
              <span>Navigasi instan SOLVETA</span>
              <span className="font-mono">ESC untuk tutup</span>
            </div>
          </motion.div>
        </div>
      )}
    </AnimatePresence>
  );
};
