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
    icon: "data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23991B1B'><rect width='24' height='24' rx='6' fill='%23991B1B'/><path d='M7 17L12 7l5 10h-3.5l-1.5-3.5-1.5 3.5H7z' fill='%23FFFFFF'/></svg>",
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="id" className={`${poppins.variable} ${jetbrainsMono.variable} scroll-smooth`}>
      <body className="font-sans antialiased bg-white text-gray-700 min-h-screen relative overflow-x-hidden">
        <Providers>{children}</Providers>
      </body>
    </html>
  );
}
