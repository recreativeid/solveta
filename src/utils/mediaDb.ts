/**
 * Solveta IndexedDB Media Manager
 * Digunakan untuk menyimpan video upload ukuran besar (hingga 100 MB)
 * secara aman di disk lokal browser tanpa batasan 5MB localStorage,
 * sehingga video diputar instan tanpa buffering atau macet-macet.
 */

const DB_NAME = "SolvetaMediaDB";
const DB_VERSION = 1;
const STORE_NAME = "videos";
const HERO_VIDEO_KEY = "hero_profile_video";

export interface VideoMetadata {
  blob: Blob;
  name: string;
  size: number;
  sizeMb: string;
  type: string;
  updatedAt: number;
}

const openDB = (): Promise<IDBDatabase> => {
  return new Promise((resolve, reject) => {
    if (typeof window === "undefined" || !window.indexedDB) {
      reject(new Error("IndexedDB is not supported in this environment"));
      return;
    }

    const request = indexedDB.open(DB_NAME, DB_VERSION);

    request.onupgradeneeded = (event) => {
      const db = (event.target as IDBOpenDBRequest).result;
      if (!db.objectStoreNames.contains(STORE_NAME)) {
        db.createObjectStore(STORE_NAME);
      }
    };

    request.onsuccess = (event) => {
      resolve((event.target as IDBOpenDBRequest).result);
    };

    request.onerror = (event) => {
      reject((event.target as IDBOpenDBRequest).error);
    };
  });
};

/**
 * Menyimpan file video yang diupload (maksimal 100MB) ke IndexedDB
 */
export const saveUploadedVideo = async (
  file: Blob | File,
  filename?: string
): Promise<{ success: boolean; sizeMb: string; name: string }> => {
  try {
    const db = await openDB();
    return new Promise((resolve, reject) => {
      const tx = db.transaction(STORE_NAME, "readwrite");
      const store = tx.objectStore(STORE_NAME);

      const sizeMb = (file.size / (1024 * 1024)).toFixed(2);
      const name =
        filename || (file instanceof File ? file.name : "uploaded-video.mp4");

      const record: VideoMetadata = {
        blob: file,
        name,
        size: file.size,
        sizeMb,
        type: file.type || "video/mp4",
        updatedAt: Date.now(),
      };

      const request = store.put(record, HERO_VIDEO_KEY);

      request.onsuccess = () => {
        // Trigger custom event agar komponen video langsung sinkron seketika
        if (typeof window !== "undefined") {
          window.dispatchEvent(
            new CustomEvent("solveta_video_updated", { detail: { hasUploaded: true } })
          );
        }
        resolve({ success: true, sizeMb, name });
      };

      request.onerror = () => {
        reject(new Error("Gagal menyimpan video ke IndexedDB"));
      };
    });
  } catch (err) {
    console.error("Error saving video to IndexedDB:", err);
    throw err;
  }
};

/**
 * Mengambil file video yang diupload dari IndexedDB beserta Blob URL
 */
export const getUploadedVideo = async (): Promise<{
  url: string;
  meta: VideoMetadata;
} | null> => {
  try {
    const db = await openDB();
    return new Promise((resolve) => {
      const tx = db.transaction(STORE_NAME, "readonly");
      const store = tx.objectStore(STORE_NAME);
      const request = store.get(HERO_VIDEO_KEY);

      request.onsuccess = () => {
        const record = request.result as VideoMetadata | undefined;
        if (record && record.blob) {
          const url = URL.createObjectURL(record.blob);
          resolve({ url, meta: record });
        } else {
          resolve(null);
        }
      };

      request.onerror = () => {
        resolve(null);
      };
    });
  } catch (err) {
    console.warn("IndexedDB not accessible, falling back to default URL:", err);
    return null;
  }
};

/**
 * Menghapus file video upload dari IndexedDB
 */
export const deleteUploadedVideo = async (): Promise<boolean> => {
  try {
    const db = await openDB();
    return new Promise((resolve) => {
      const tx = db.transaction(STORE_NAME, "readwrite");
      const store = tx.objectStore(STORE_NAME);
      const request = store.delete(HERO_VIDEO_KEY);

      request.onsuccess = () => {
        if (typeof window !== "undefined") {
          window.dispatchEvent(
            new CustomEvent("solveta_video_updated", { detail: { hasUploaded: false } })
          );
        }
        resolve(true);
      };

      request.onerror = () => {
        resolve(false);
      };
    });
  } catch (err) {
    console.error("Error deleting video from IndexedDB:", err);
    return false;
  }
};

/**
 * Cek apakah user telah mengunggah video kustom di IndexedDB
 */
export const hasUploadedVideo = async (): Promise<boolean> => {
  try {
    const db = await openDB();
    return new Promise((resolve) => {
      const tx = db.transaction(STORE_NAME, "readonly");
      const store = tx.objectStore(STORE_NAME);
      const request = store.count(HERO_VIDEO_KEY);

      request.onsuccess = () => {
        resolve(request.result > 0);
      };

      request.onerror = () => {
        resolve(false);
      };
    });
  } catch {
    return false;
  }
};
