/**
 * Utility Pembersih Nomor WhatsApp & Pembuat Link Valid 100%
 * Mengatasi error "Nomor telepon tidak valid / link tidak bisa dibuka"
 * saat nomor mengandung spasi, tanda +, strip (-), atau berawalan 08.
 */

export const cleanWhatsAppNumber = (rawPhone?: string): string => {
  if (!rawPhone) return "6285719663154";

  // Hapus semua karakter selain angka (+, -, spasi, tanda kurung, dll)
  let cleaned = String(rawPhone).replace(/\D/g, "");

  // Jika nomor berawalan 08 (misal: 085719663154), ubah jadi 628
  if (cleaned.startsWith("08")) {
    cleaned = "628" + cleaned.slice(2);
  }
  // Jika nomor berawalan 8 (misal: 85719663154), tambahkan 62 di depan
  else if (cleaned.startsWith("8")) {
    cleaned = "62" + cleaned;
  }
  // Jika nomor berawalan 0 lainnya, ubah jadi 62
  else if (cleaned.startsWith("0")) {
    cleaned = "62" + cleaned.slice(1);
  }

  // Jika kosong atau terlalu pendek, gunakan default yang valid
  if (!cleaned || cleaned.length < 8) {
    return "6285719663154";
  }

  return cleaned;
};

export const getWhatsAppUrl = (rawPhone?: string, message?: string): string => {
  const number = cleanWhatsAppNumber(rawPhone);
  if (message && message.trim()) {
    return `https://wa.me/${number}?text=${encodeURIComponent(message.trim())}`;
  }
  return `https://wa.me/${number}`;
};
