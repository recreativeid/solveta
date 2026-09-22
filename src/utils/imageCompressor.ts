/**
 * Utilitas kompresi gambar otomatis sisi klien (Browser-side Image Compressor)
 * Menggunakan HTML5 Canvas API murni tanpa dependensi eksternal.
 * Menjamin file foto dari kamera/laptop (2MB - 10MB) dikompres menjadi
 * format WebP / JPEG ringan (~30KB - 80KB) dengan resolusi tajam.
 * Menghindari QuotaExceededError di localStorage dan timeout di Supabase.
 */

export interface CompressOptions {
  maxWidth?: number;
  maxHeight?: number;
  quality?: number; // 0.1 - 1.0
}

export async function compressImage(
  fileOrBase64: File | Blob | string,
  options: CompressOptions = {}
): Promise<string> {
  const { maxWidth = 1000, maxHeight = 700, quality = 0.8 } = options;

  return new Promise((resolve, reject) => {
    if (typeof window === "undefined") {
      resolve(typeof fileOrBase64 === "string" ? fileOrBase64 : "");
      return;
    }

    const img = new Image();
    img.crossOrigin = "anonymous";

    img.onload = () => {
      try {
        let { width, height } = img;

        // Hitung rasio aspek proporsional
        if (width > maxWidth || height > maxHeight) {
          const ratio = Math.min(maxWidth / width, maxHeight / height);
          width = Math.max(1, Math.round(width * ratio));
          height = Math.max(1, Math.round(height * ratio));
        }

        const canvas = document.createElement("canvas");
        canvas.width = width;
        canvas.height = height;

        const ctx = canvas.getContext("2d");
        if (!ctx) {
          resolve(typeof fileOrBase64 === "string" ? fileOrBase64 : "");
          return;
        }

        ctx.imageSmoothingEnabled = true;
        ctx.imageSmoothingQuality = "high";
        ctx.drawImage(img, 0, 0, width, height);

        // Prioritaskan WebP, fallback ke JPEG
        let dataUrl = canvas.toDataURL("image/webp", quality);
        if (!dataUrl.startsWith("data:image/webp")) {
          dataUrl = canvas.toDataURL("image/jpeg", quality);
        }

        resolve(dataUrl);
      } catch (err) {
        console.warn("Canvas compression failed, falling back:", err);
        if (typeof fileOrBase64 === "string") {
          resolve(fileOrBase64);
        } else {
          reject(err);
        }
      }
    };

    img.onerror = (err) => {
      console.warn("Failed to load image for compression:", err);
      if (typeof fileOrBase64 === "string") {
        resolve(fileOrBase64);
      } else {
        reject(err);
      }
    };

    if (typeof fileOrBase64 === "string") {
      img.src = fileOrBase64;
    } else {
      const reader = new FileReader();
      reader.onload = (e) => {
        img.src = (e.target?.result as string) || "";
      };
      reader.onerror = reject;
      reader.readAsDataURL(fileOrBase64);
    }
  });
}
