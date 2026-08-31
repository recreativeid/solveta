"use client";

import React, { useEffect } from "react";
import { SiteDataProvider, useSiteData } from "@/context/SiteDataContext";
import { ThemeProvider } from "@/context/ThemeContext";

function FaviconManager() {
  const { data } = useSiteData();

  useEffect(() => {
    const logo = data.siteCopy.siteLogo || "./solveta-logo.png";
    
    // Update or create standard favicon
    let link = document.querySelector("link[rel~='icon']") as HTMLLinkElement | null;
    if (!link) {
      link = document.createElement("link");
      link.rel = "icon";
      document.getElementsByTagName("head")[0].appendChild(link);
    }
    link.href = logo;

    // Update or create apple-touch-icon
    let appleLink = document.querySelector("link[rel='apple-touch-icon']") as HTMLLinkElement | null;
    if (!appleLink) {
      appleLink = document.createElement("link");
      appleLink.rel = "apple-touch-icon";
      document.getElementsByTagName("head")[0].appendChild(appleLink);
    }
    appleLink.href = logo;
  }, [data.siteCopy.siteLogo]);

  return null;
}

export const Providers: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  return (
    <ThemeProvider>
      <SiteDataProvider>
        <FaviconManager />
        {children}
      </SiteDataProvider>
    </ThemeProvider>
  );
};
