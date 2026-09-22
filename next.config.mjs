/** @type {import('next').NextConfig} */
// Hanya gunakan subpath /solveta jika sedang di-build oleh GitHub Actions untuk GitHub Pages
const isGitHubPages =
  process.env.GITHUB_ACTIONS === "true" ||
  process.env.NEXT_PUBLIC_GH_PAGES === "true";

const nextConfig = {
  output: "export",
  basePath: isGitHubPages ? "/solveta" : "",
  images: {
    unoptimized: true,
  },
  trailingSlash: true,
  typescript: {
    ignoreBuildErrors: true,
  },
  eslint: {
    ignoreDuringBuilds: true,
  },
};

export default nextConfig;
