import type { Metadata } from "next";
import { Poppins, JetBrains_Mono } from "next/font/google";
import "./globals.css";
import { Providers } from "@/components/Providers";

const poppins = Poppins({
  subsets: ["latin"],
  weight: ["300", "400", "500", "600", "700", "800"],
  variable: "--font-poppins",
  display: "swap",
});

const jetbrainsMono = JetBrains_Mono({
  subsets: ["latin"],
  weight: ["400", "500", "600", "700"],
  variable: "--font-jetbrains",
  display: "swap",
});

export const metadata: Metadata = {
  title: "SOLVETA — Solve Technology Agency | Mengubah Tantangan Bisnis Menjadi Solusi Digital",
  description: "SOLVETA — Solve Technology Agency. Mengubah Tantangan Bisnis Menjadi Solusi Digital melalui website, otomasi, sistem digital, dan integrasi data.",
  keywords: ["technology agency", "digital solution", "website development", "otomasi bisnis", "solveta"],
  authors: [{ name: "SOLVETA" }],
  icons: {
    icon: [
      { url: "./solveta-logo.png", type: "image/png" },
      { url: "./solveta-logo.jpg", type: "image/jpeg" },
    ],
    apple: "./solveta-logo.png",
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="id" className={`${poppins.variable} ${jetbrainsMono.variable} scroll-smooth`}>
      <head>
        <link rel="icon" href="./solveta-logo.png" type="image/png" />
        <link rel="apple-touch-icon" href="./solveta-logo.png" />
      </head>
      <body className="font-sans antialiased bg-white text-gray-700 min-h-screen relative overflow-x-hidden">
        <Providers>{children}</Providers>
      </body>
    </html>
  );
}
