"use client";

import React, { useState } from "react";
import { SiteDataProvider } from "@/context/SiteDataContext";
import { Navbar } from "@/components/Navbar";
import { Hero } from "@/components/Hero";
import { ClientMarquee } from "@/components/ClientMarquee";
import { ProblemSection } from "@/components/ProblemSection";
import { ServicesSection } from "@/components/ServicesSection";
import { PortfolioSection } from "@/components/PortfolioSection";
import { PricingSection } from "@/components/PricingSection";
import { ProcessSection } from "@/components/ProcessSection";
import { PhilosophySection } from "@/components/PhilosophySection";
import { ConsultationCTA } from "@/components/ConsultationCTA";
import { Footer } from "@/components/Footer";
import { SearchModal } from "@/components/SearchModal";

export default function Home() {
  const [isSearchOpen, setIsSearchOpen] = useState(false);

  return (
    <SiteDataProvider>
      <Navbar onOpenSearch={() => setIsSearchOpen(true)} />
      <main>
        <Hero />
        <ClientMarquee />
        <ProblemSection />
        <ServicesSection />
        <PortfolioSection />
        <PricingSection />
        <ProcessSection />
        <PhilosophySection />
        <ConsultationCTA />
      </main>
      <Footer />
      <SearchModal
        isOpen={isSearchOpen}
        onClose={() => setIsSearchOpen(false)}
      />
    </SiteDataProvider>
  );
}
