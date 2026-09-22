/**
 * Helper to ensure assets (images, logos, videos) load correctly:
 * - On cPanel / custom domain (solveta.asia) -> root (/)
 * - On GitHub Actions Pages -> subpath (/solveta/)
 * - On local development -> root (/)
 */
export const getAssetPath = (path?: string): string => {
  if (!path) return "";
  if (
    path.startsWith("data:") ||
    path.startsWith("blob:") ||
    path.startsWith("http://") ||
    path.startsWith("https://")
  ) {
    return path;
  }

  const isGitHubPages =
    process.env.GITHUB_ACTIONS === "true" ||
    process.env.NEXT_PUBLIC_GH_PAGES === "true";

  const cleanPath = path.startsWith("./")
    ? path.slice(1)
    : path.startsWith("/")
    ? path
    : `/${path}`;

  if (isGitHubPages && !cleanPath.startsWith("/solveta")) {
    return `/solveta${cleanPath}`;
  }
  return cleanPath;
};
