import { createClient } from "@supabase/supabase-js";

// Official SOLVETA Supabase Cloud Configuration (24/7 Online)
export const DEFAULT_SUPABASE_URL =
  process.env.NEXT_PUBLIC_SUPABASE_URL ||
  "https://ymaqdrsomailsnqkgmag.supabase.co";

export const DEFAULT_SUPABASE_KEY =
  process.env.NEXT_PUBLIC_SUPABASE_ANON_KEY ||
  "sb_publishable_6MVHJX_Yy2romiVJ13pnEQ_hSr92REe";

// Get active Supabase URL (from env, storage, or default)
export const getSupabaseUrl = (): string => {
  if (typeof window !== "undefined") {
    const customUrl = localStorage.getItem("solveta_supabase_url");
    if (customUrl && customUrl.startsWith("http")) return customUrl.trim();
  }
  return DEFAULT_SUPABASE_URL;
};

// Get active Supabase Key (from env, storage, or default)
export const getSupabaseKey = (): string => {
  if (typeof window !== "undefined") {
    const customKey = localStorage.getItem("solveta_supabase_key");
    if (customKey && customKey.trim().length > 0) return customKey.trim();
  }
  return DEFAULT_SUPABASE_KEY;
};

export const isSupabaseConfigured = () => {
  const url = getSupabaseUrl();
  const key = getSupabaseKey();
  return (
    Boolean(url) &&
    Boolean(key) &&
    url.startsWith("http") &&
    url !== "https://xyzcompany.supabase.co"
  );
};

export const getSupabaseClient = () => {
  return createClient(getSupabaseUrl(), getSupabaseKey());
};

export const supabase = createClient(DEFAULT_SUPABASE_URL, DEFAULT_SUPABASE_KEY);
