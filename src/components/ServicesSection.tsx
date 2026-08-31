"use client";

import React, { useRef } from "react";
import { motion, useInView } from "framer-motion";
import { Globe, ArrowLeftRight, Monitor, Layers, Clock } from "lucide-react";

interface ServiceItem {
  icon: React.ElementType;
  name: string;
}

const services: ServiceItem[] = [
  { icon: Globe, name: "Website & Digital Presence" },
  { icon: ArrowLeftRight, name: "Business Digitalization" },
  { icon: Monitor, name: "Custom Digital Solution" },
  { icon: Layers, name: "Database & Integration" },
  { icon: Clock, name: "Optimization" },
];

export const ServicesSection: React.FC = () => {
  const ref = useRef<HTMLDivElement>(null);
  const isInView = useInView(ref, { once: true, margin: "-80px" });

  return (
    <section id="services" className="py-16 bg-white dark:bg-[#07080E] border-t border-gray-100 dark:border-gray-800 transition-colors duration-200">
      <div className="max-w-[1160px] mx-auto px-6">
        <motion.div
          initial={{ opacity: 0, y: 15 }}
          animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 15 }}
          transition={{ duration: 0.5 }}
          className="mb-8"
        >
          <h2 className="text-sm sm:text-base font-bold uppercase tracking-wider text-gray-900 dark:text-white">
            APA YANG DAPAT SOLVETA BANTU?
          </h2>
        </motion.div>

        <div
          ref={ref}
          className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4"
        >
          {services.map((item, index) => {
            const Icon = item.icon;
            return (
              <motion.div
                key={item.name}
                initial={{ opacity: 0, y: 25 }}
                animate={isInView ? { opacity: 1, y: 0 } : { opacity: 0, y: 25 }}
                transition={{
                  duration: 0.5,
                  delay: index * 0.08,
                  ease: [0.16, 1, 0.3, 1],
                }}
                whileHover={{ y: -4, scale: 1.02 }}
                className="bg-white dark:bg-[#11121C] border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-rose-600 rounded-xl p-8 text-center flex flex-col items-center justify-center gap-4 shadow-xs hover:shadow-md transition-all duration-200 cursor-pointer group"
              >
                <div className="w-10 h-10 text-gray-800 dark:text-gray-200 group-hover:text-brand-800 dark:group-hover:text-rose-400 flex items-center justify-center transition-colors">
                  <Icon className="w-7 h-7 stroke-[1.75]" />
                </div>
                <h3 className="text-xs font-semibold text-gray-800 dark:text-gray-200 leading-snug">
                  {item.name}
                </h3>
              </motion.div>
            );
          })}
        </div>
      </div>
    </section>
  );
};
