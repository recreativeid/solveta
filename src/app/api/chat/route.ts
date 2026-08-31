import { NextRequest, NextResponse } from "next/server";

const SYSTEM_PROMPT = `
Kamu adalah SOLVETA AI Assistant, perwakilan resmi dan asisten cerdas dari SOLVETA (Solve Technology Agency).
Website resmi: www.solveta.site | WhatsApp CS: +62 857-1966-3154.

Tugasmu adalah:
1. Menjelaskan secara ramah, profesional, ringkas, dan jelas dalam Bahasa Indonesia tentang layanan, paket harga, dan metodologi SOLVETA.
2. Informasi Paket Harga SOLVETA:
   - BASIC (Rp 299K): 1 Halaman, Free Domain .my.id, Free Hosting, WA Button, Revisi 2x, Pengerjaan 1-2 hari.
   - STANDARD (Rp 549K - POPULAR): Maks 5 Halaman, Free Domain .com, 1 Email Bisnis, Google Maps & Sosmed, Pengerjaan 3-5 hari.
   - PREMIUM (Rp 749K): Maks 7 Halaman, Free Domain .com, 2 Email Bisnis, Katalog Produk/Portofolio, Filter & Search, Form Order WA, SEO Friendly.
   - CUSTOM (Mulai Rp 1,5 Juta): Sistem Database Custom, Dashboard Admin, Integrasi API, Keamanan Tingkat Lanjut.
3. Layanan Kami: Website & Digital Presence, Business Digitalization, Custom Digital Solution, Database & Integration, Optimization.
4. Metodologi 6 Langkah: Understand, Analyze, Design, Develop, Integrate, Launch.
5. PENTING: Jika pertanyaan klien di luar lingkup layanan SOLVETA, atau menanyakan negosiasi khusus, diskon proyek skala besar, atau masalah teknis mendalam yang membutuhkan diskusi langsung, arahkan klien dengan sopan untuk menghubungi Admin/CS langsung via WhatsApp di +62 857-1966-3154.
`;

export async function POST(req: NextRequest) {
  try {
    const body = await req.json();
    const { message, history, apiKey, customContact } = body;

    const contactNumber = customContact?.whatsappNumber || "6285719663154";
    const contactDisplay = customContact?.whatsappDisplay || "+62 857-1966-3154";

    const effectiveApiKey = apiKey || process.env.GEMINI_API_KEY;

    // If Gemini API Key is available, call Gemini API
    if (effectiveApiKey && effectiveApiKey.trim().length > 10) {
      try {
        const response = await fetch(
          `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=${effectiveApiKey.trim()}`,
          {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              contents: [
                {
                  role: "user",
                  parts: [
                    {
                      text: `${SYSTEM_PROMPT}\n(Gunakan nomor WhatsApp ${contactDisplay} jika perlu mengarahkan ke CS).\n\nPertanyaan Klien:\n${message}`,
                    },
                  ],
                },
              ],
              generationConfig: {
                temperature: 0.7,
                maxOutputTokens: 500,
              },
            }),
          }
        );

        if (response.ok) {
          const data = await response.json();
          const reply =
            data.candidates?.[0]?.content?.parts?.[0]?.text ||
            "Maaf, saya tidak dapat memproses jawaban saat ini. Silakan hubungi CS kami via WhatsApp.";
          return NextResponse.json({ reply });
        }
      } catch (geminiError) {
        console.error("Gemini API call failed, falling back to smart engine", geminiError);
      }
    }

    // Intelligent Built-in Fallback NLP Engine (No API key needed)
    const lower = message.toLowerCase();
    let reply = "";
    let escalateToCS = false;

    if (lower.includes("harga") || lower.includes("biaya") || lower.includes("paket") || lower.includes("pric")) {
      reply = `SOLVETA menyediakan 4 pilihan paket transparan:\n\n1. **BASIC (Rp 299K)**: 1 Halaman, Landing Page cepat, Free Domain .my.id, Free Hosting.\n2. **STANDARD (Rp 549K - Paling Populer)**: Multi-halaman (Home, About, Services, Contact), Free Domain .com, 1 Email Bisnis.\n3. **PREMIUM (Rp 749K)**: Katalog Produk/Portofolio, Filter & Pencarian, Form Order WhatsApp, Free Domain .com.\n4. **CUSTOM (Mulai Rp 1,5 Juta)**: Sistem database custom (gudang/karyawan), dashboard admin, otomasi alur kerja.\n\nApakah ada paket yang sesuai dengan kebutuhan Anda?`;
    } else if (lower.includes("custom") || lower.includes("database") || lower.includes("aplikasi") || lower.includes("sistem")) {
      reply = `Untuk solusi sistem custom atau database terintegrasi (seperti inventaris gudang, sistem kasir, manajemen klinik, tracking armada), biayanya mulai dari **Rp 1,5 Juta** disesuaikan dengan alur kerja (workflow) unik Anda.\n\nAnda tidak perlu tahu istilah teknisnya, cukup ceritakan masalah dan tujuan bisnis Anda, kami akan bantu rancang solusinya!`;
    } else if (lower.includes("berapa lama") || lower.includes("durasi") || lower.includes("pengerjaan") || lower.includes("waktu")) {
      reply = `Estimasi waktu pengerjaan:\n• **Paket Basic**: 1–2 hari kerja.\n• **Paket Standard & Premium**: 3–5 hari kerja.\n• **Paket Custom / Sistem**: Tergantung kompleksitas fitur (umumnya 1–3 minggu).\n\nKami selalu mengutamakan kecepatan dan kualitas teruji sebelum peluncuran.`;
    } else if (lower.includes("domain") || lower.includes("hosting") || lower.includes("server")) {
      reply = `Semua paket pembuatan website di SOLVETA sudah **termasuk Free Domain dan Free Hosting** selama 1 tahun pertama, serta sertifikat keamanan SSL dan setup Google Analytics gratis!`;
    } else if (lower.includes("cara order") || lower.includes("cara pesan") || lower.includes("mulai") || lower.includes("konsultasi")) {
      reply = `Cara mulainya sangat mudah:\n1. Klik tombol **Konsultasi Gratis** atau chat kami langsung via WhatsApp.\n2. Ceritakan kendala atau kebutuhan bisnis Anda.\n3. Tim SOLVETA akan memberikan rekomendasi solusi & mockup desain awal secara gratis!`;
    } else {
      // General or out-of-scope inquiry -> provide friendly answer and CS handoff
      reply = `Terima kasih atas pertanyaannya! Di SOLVETA, kami berfokus membantu bisnis menyelesaikan masalah operasional dan digitalisasi melalui website, sistem database, dan otomasi.\n\nUntuk pertanyaan atau kebutuhan khusus Anda yang lebih mendalam, tim konsultan kami siap berdiskusi langsung secara gratis.`;
      escalateToCS = true;
    }

    return NextResponse.json({
      reply,
      escalateToCS,
      csNumber: contactNumber,
      csDisplay: contactDisplay,
    });
  } catch (error) {
    return NextResponse.json(
      { error: "Internal server error" },
      { status: 500 }
    );
  }
}
