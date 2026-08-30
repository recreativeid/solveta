"use client";

import React, { useRef } from "react";
import { motion, useInView } from "framer-motion";

interface StepItem {
  number: number;
  title: string;
  sub: string;
}

const steps: StepItem[] = [
  { number: 1, title: "Understand", sub: "Memahami kebutuhan" },
  { number: 2, title: "Analyze", sub: "Analisis masalah" },
  { number: 3, title: "Design", sub: "Merancang solusi" },
  { number: 4, title: "Develop", sub: "Membangun sistem" },
  { number: 5, title: "Integrate", sub: "Integrasi data" },
  { number: 6, title: "Launch", sub: "Implementasi akhir" },
];

export const ProcessSection: React.FC = () => {
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });

  return (
    <section id="process" className="py-16 bg-white">
      <div className="max-w-[1160px] mx-auto px-6">
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 15 }}
          transition={{ duration: 0.5 }}
          className="text-center mb-12"
        >
          <h2 className="text-base sm:text-lg font-bold uppercase tracking-wider text-gray-900">
            BAGAIMANA SOLVETA BEKERJA?
          </h2>
        </motion.div>

        <div
          ref={ref}
          className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 text-center"
        >
          {steps.map((step, index) => {
            return (
              <motion.div
                key={step.title}
                initial={{ opacity: 0, y: 25 }}
                animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 25 }}
                transition={{
                  duration: 0.45,
                  delay: index * 0.08,
                  ease: [0.16, 1, 0.3, 1],
                }}
                className="flex flex-col items-center group"
              >
                <motion.div
                  whileHover={{ scale: 1.08, y: -2 }}
                  className="w-12 h-12 rounded-xl bg-brand-50 border border-brand-100 text-brand-800 flex items-center justify-center font-extrabold text-base mb-3.5 shadow-xs group-hover:bg-brand-800 group-hover:text-white transition-colors duration-200"
                >
                  {step.number}
                </motion.div>
                <h3 className="text-xs font-bold text-gray-900 mb-1">
                  {step.title}
                </h3>
                <p className="text-[11px] text-gray-500 leading-tight">
                  {step.sub}
                </p>
              </motion.div>
            );
          })}
        </div>
      </div>
    </section>
  );
};
