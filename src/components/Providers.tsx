"use client";

import React from "react";
import { SiteDataProvider } from "@/context/SiteDataContext";

export const Providers: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  return <SiteDataProvider>{children}</SiteDataProvider>;
};
