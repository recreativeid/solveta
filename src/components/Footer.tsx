"use client";

import React, { useState } from "react";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { Phone, Globe, Lock } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";

export const Footer: React.FC = () => {
  const { data } = useSiteData();
  const router = useRouter();
  const [clickCount, setClickCount] = useState(0);

  const handleSecretClick = () => {
    const nextCount = clickCount + 1;
    setClickCount(nextCount);
    if (nextCount >= 3) {
      router.push("/admin");
    }
  };

  return (
    <footer className="border-t border-gray-200 dark:border-gray-800 pt-16 pb-10 bg-white dark:bg-[#07080E] text-gray-700 dark:text-gray-300 relative transition-colors duration-200">
      <div className="max-w-[1160px] mx-auto px-6">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-14">
          {/* Col 1: Brand & Contact */}
          <div className="flex flex-col gap-2.5">
            <div className="flex items-center gap-2">
              <div className="w-6 h-6 rounded-md bg-[#8B0021] flex items-center justify-center text-white">
                <svg
                  className="w-4 h-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2.5"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                >
                  <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                  <polyline points="2 17 12 22 22 17"></polyline>
                  <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
              </div>
              <span className="font-extrabold text-base tracking-tight text-gray-900 dark:text-white">
                SOLVETA
              </span>
            </div>
            <div className="text-xs text-gray-500 dark:text-gray-400 mb-2">
              Solve Technology Agency
            </div>
            <div className="flex flex-col gap-1.5 text-xs text-gray-600 dark:text-gray-400">
              <a
                href={`https://wa.me/${data.contact.whatsappNumber}`}
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-center gap-2 hover:text-[#8B0021] dark:hover:text-rose-400 transition-colors"
              >
                <Phone className="w-3.5 h-3.5 text-gray-400" />
                <span>{data.contact.whatsappDisplay}</span>
              </a>
              <a
                href={`https://${data.contact.websiteUrl}`}
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-center gap-2 hover:text-[#8B0021] dark:hover:text-rose-400 transition-colors"
              >
                <Globe className="w-3.5 h-3.5 text-gray-400" />
                <span>{data.contact.websiteUrl}</span>
              </a>
            </div>
          </div>

          {/* Col 2: Services */}
          <div>
            <h4 className="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-3.5">
              Services
            </h4>
            <ul className="flex flex-col gap-2 text-xs text-gray-500 dark:text-gray-400">
              <li>
                <Link
                  href="#services"
                  className="hover:text-gray-900 dark:hover:text-white transition-colors"
                >
                  Process Development
                </Link>
              </li>
              <li>
                <Link
                  href="#services"
                  className="hover:text-gray-900 dark:hover:text-white transition-colors"
                >
                  Business Digitalization
                </Link>
              </li>
            </ul>
          </div>

          {/* Col 3: Company */}
          <div>
            <h4 className="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-3.5">
              Company
            </h4>
            <ul className="flex flex-col gap-2 text-xs text-gray-500 dark:text-gray-400">
              <li>
                <Link
                  href="#hero"
                  className="hover:text-gray-900 dark:hover:text-white transition-colors"
                >
                  About
                </Link>
              </li>
              <li>
                <Link
                  href="#hero"
                  className="hover:text-gray-900 dark:hover:text-white transition-colors"
                >
                  Careers
                </Link>
              </li>
            </ul>
          </div>

          {/* Col 4: Legal */}
          <div>
            <h4 className="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-3.5">
              Legal
            </h4>
            <ul className="flex flex-col gap-2 text-xs text-gray-500 dark:text-gray-400">
              <li>
                <Link
                  href="#"
                  className="hover:text-gray-900 dark:hover:text-white transition-colors"
                >
                  Privacy Policy
                </Link>
              </li>
              <li>
                <Link
                  href="#"
                  className="hover:text-gray-900 dark:hover:text-white transition-colors"
                >
                  Terms of Service
                </Link>
              </li>
            </ul>
          </div>
        </div>

        {/* Bottom Bar with Hidden Developer Portal Trigger */}
        <div className="border-t border-gray-100 dark:border-gray-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-gray-400 dark:text-gray-500">
          <span
            onClick={handleSecretClick}
            className="cursor-pointer hover:text-gray-600 dark:hover:text-gray-300 transition-colors select-none"
            title="Klik 3x untuk Developer Portal"
          >
            © 2026 SOLVETA. All rights reserved.
          </span>

          <Link
            href="/admin"
            className="opacity-40 hover:opacity-100 transition-opacity flex items-center gap-1 text-[10px] text-gray-400 hover:text-[#8B0021] dark:hover:text-rose-400"
            title="Developer Portal Access"
          >
            <Lock className="w-2.5 h-2.5" />
            <span>Dev Access</span>
          </Link>
        </div>
      </div>
    </footer>
  );
};
