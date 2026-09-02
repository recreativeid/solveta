/**
 * Helper to ensure assets (images, logos, videos) load correctly
 * both in local development (/) and on GitHub Pages (/solveta/)
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

  const isProd = process.env.NODE_ENV === "production";
  const cleanPath = path.startsWith("./")
    ? path.slice(1)
    : path.startsWith("/")
    ? path
    : `/${path}`;

  if (isProd && !cleanPath.startsWith("/solveta")) {
    return `/solveta${cleanPath}`;
  }
  return cleanPath;
};
