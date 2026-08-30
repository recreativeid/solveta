"use client";

import React, { useRef } from "react";
import { motion, useInView } from "framer-motion";
import { Check } from "lucide-react";
import { useSiteData } from "@/context/SiteDataContext";

export const PricingSection: React.FC = () => {
  const { data } = useSiteData();
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });

  return (
    <section id="pricing" className="py-16 bg-white">
      <div className="max-w-[1160px] mx-auto px-6">
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 15 }}
          transition={{ duration: 0.5 }}
          className="text-center mb-12"
        >
          <h2 className="text-base sm:text-lg font-bold uppercase tracking-wider text-gray-900 mb-1.5">
            PILIH SOLUSI SESUAI KEBUTUHAN
          </h2>
          <p className="text-xs sm:text-sm text-gray-500">
            Solusi yang transparan dan dapat disesuaikan dengan skala bisnis Anda.
          </p>
        </motion.div>

        <div
          ref={ref}
          className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 items-stretch"
        >
          {data.pricing.map((tier, index) => {
            return (
              <motion.div
                key={tier.id || tier.name}
                initial={{ opacity: 0, y: 30 }}
                animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 30 }}
                transition={{
                  duration: 0.5,
                  delay: index * 0.1,
                  ease: [0.16, 1, 0.3, 1],
                }}
                whileHover={{ y: -5 }}
                className={`bg-white rounded-xl p-6 flex flex-col justify-between relative shadow-xs hover:shadow-md transition-all duration-200 ${
                  tier.popular
                    ? "border-2 border-brand-600 shadow-sm"
                    : "border border-gray-200 hover:border-gray-300"
                }`}
              >
                {tier.popular && (
                  <span className="absolute -top-3 left-1/2 -translate-x-1/2 bg-brand-800 text-white font-mono text-[10px] font-bold uppercase tracking-widest px-2.5 py-0.5 rounded-full shadow-xs">
                    POPULAR
                  </span>
                )}

                <div>
                  <div className="text-sm font-extrabold text-gray-900 tracking-tight uppercase mb-1">
                    {tier.name}
                  </div>

                  {tier.pricePrefix && (
                    <div className="text-xs text-gray-500 -mb-1">
                      {tier.pricePrefix}
                    </div>
                  )}

                  <div className="text-2xl font-extrabold text-gray-950 tracking-tight leading-tight mb-5">
                    {tier.price}
                  </div>

                  <div className="flex flex-col gap-2.5 mb-6">
                    {tier.features.map((feature, fIndex) => (
                      <div
                        key={fIndex}
                        className="flex items-start gap-2 text-xs text-gray-600 leading-snug"
                      >
                        <Check className="w-3.5 h-3.5 text-brand-600 flex-shrink-0 mt-0.5 stroke-[2.5]" />
                        <span>{feature}</span>
                      </div>
                    ))}
                  </div>
                </div>

                <div>
                  <div className="border-t border-gray-100 pt-3.5 mb-5">
                    <div className="text-[11px] font-semibold text-gray-700 mb-1">
                      Cocok untuk:
                    </div>
                    <div className="text-[11px] text-gray-500 leading-relaxed">
                      {tier.suitability}
                    </div>
                  </div>

                  <motion.a
                    whileHover={{ scale: 1.02 }}
                    whileTap={{ scale: 0.98 }}
                    href={`https://wa.me/${data.contact.whatsappNumber}?text=${encodeURIComponent(
                      tier.waMessage || `Halo SOLVETA, saya tertarik dengan paket ${tier.name}`
                    )}`}
                    target="_blank"
                    rel="noopener noreferrer"
                    className={`w-full py-2 text-xs font-semibold rounded-md flex items-center justify-center transition-all ${
                      tier.buttonVariant === "red"
                        ? "bg-brand-800 hover:bg-brand-900 text-white shadow-xs"
                        : "bg-white hover:bg-gray-50 text-gray-800 border border-gray-300 hover:border-gray-400"
                    }`}
                  >
                    {tier.buttonLabel}
                  </motion.a>
                </div>
              </motion.div>
            );
          })}
        </div>
      </div>
    </section>
  );
};
