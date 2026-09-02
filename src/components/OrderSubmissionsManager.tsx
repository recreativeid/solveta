"use client";

import React, { useState, useMemo } from "react";
import {
  Search,
  Download,
  Calendar,
  Eye,
  Trash2,
  Phone,
  CheckCircle2,
  ExternalLink,
  Filter,
  RefreshCw,
  Clock,
  Building2,
  User,
  Layers,
  Globe,
  Palette,
  FileText,
  Copy,
} from "lucide-react";
import { motion, AnimatePresence } from "framer-motion";
import {
  useSiteData,
  CustomerOrderSubmission,
} from "@/context/SiteDataContext";
import { getWhatsAppUrl, cleanWhatsAppNumber } from "@/utils/whatsapp";

export const OrderSubmissionsManager: React.FC<{
  showToast: (msg: string) => void;
}> = ({ showToast }) => {
  const { data, deleteOrderSubmission, updateOrderSubmissionStatus } =
    useSiteData();

  const submissions = data.orderSubmissions || [];

  // Filter & Search States
  const [searchQuery, setSearchQuery] = useState("");
  const [statusFilter, setStatusFilter] = useState<string>("all");
  const [selectedYear, setSelectedYear] = useState<string>("all");
  const [selectedMonth, setSelectedMonth] = useState<string>("all");
  const [selectedDate, setSelectedDate] = useState<string>("");

  // Detail Modal
  const [activeSubmission, setActiveSubmission] =
    useState<CustomerOrderSubmission | null>(null);

  // Available Years in data
  const availableYears = useMemo(() => {
    const years = new Set<string>();
    submissions.forEach((s) => {
      const year = s.timestamp.slice(0, 4);
      if (year && !isNaN(Number(year))) years.add(year);
    });
    return Array.from(years).sort().reverse();
  }, [submissions]);

  // Months list
  const monthNames = [
    { num: "01", name: "Januari" },
    { num: "02", name: "Februari" },
    { num: "03", name: "Maret" },
    { num: "04", name: "April" },
    { num: "05", name: "Mei" },
    { num: "06", name: "Juni" },
    { num: "07", name: "Juli" },
    { num: "08", name: "Agustus" },
    { num: "09", name: "September" },
    { num: "10", name: "Oktober" },
    { num: "11", name: "November" },
    { num: "12", name: "Desember" },
  ];

  // Filtered List
  const filteredSubmissions = useMemo(() => {
    return submissions.filter((s) => {
      // Search
      const q = searchQuery.toLowerCase();
      const matchQuery =
        !q ||
        s.fullName.toLowerCase().includes(q) ||
        s.brandName.toLowerCase().includes(q) ||
        s.whatsappNumber.includes(q) ||
        s.selectedPackage.toLowerCase().includes(q);

      // Status
      const matchStatus =
        statusFilter === "all" || s.status === statusFilter;

      // Year
      const matchYear =
        selectedYear === "all" || s.timestamp.startsWith(selectedYear);

      // Month (format YYYY-MM)
      const matchMonth =
        selectedMonth === "all" ||
        (selectedYear !== "all"
          ? s.timestamp.startsWith(`${selectedYear}-${selectedMonth}`)
          : s.timestamp.includes(`-${selectedMonth}-`));

      // Specific Date (format YYYY-MM-DD)
      const matchDate = !selectedDate || s.timestamp.startsWith(selectedDate);

      return matchQuery && matchStatus && matchYear && matchMonth && matchDate;
    });
  }, [
    submissions,
    searchQuery,
    statusFilter,
    selectedYear,
    selectedMonth,
    selectedDate,
  ]);

  // Export to Excel (CSV UTF-8 with BOM)
  const handleExportExcel = () => {
    if (filteredSubmissions.length === 0) {
      showToast("Tidak ada data orderan untuk diekspor.");
      return;
    }

    const headers = [
      "Timestamp",
      "Nama Lengkap",
      "Nomor WhatsApp yang akan ditampilkan (jika ada)",
      "Nama Usaha / Brand",
      "Deskripsi Singkat Usaha / Kegiatan",
      "Jenis Website yang diinginkan:",
      "Halaman yang ingin ditampilkan",
      "Warna / Nuansa Desain yang Diinginkan",
      "Apakah sudah punya domain?",
      "Apakah sudah punya logo?",
      "Foto produk / usaha (jika ada)",
      "Apakah ada contoh website yang disukai?",
      "Catatan Tambahan / Permintaan Khusus",
      "Nama Website Dan Domain",
      "Paket Yang Dipilih",
      "Profil Usaha Jika ada",
      "Status Follow-up",
    ];

    const cleanField = (val: string | undefined) => {
      if (!val) return '""';
      const escaped = String(val).replace(/"/g, '""').replace(/\r?\n/g, " ");
      return `"${escaped}"`;
    };

    const rows = filteredSubmissions.map((s) => [
      cleanField(s.timestamp),
      cleanField(s.fullName),
      cleanField(s.whatsappNumber),
      cleanField(s.brandName),
      cleanField(s.businessDescription),
      cleanField(s.websiteType),
      cleanField(s.pagesNeeded),
      cleanField(s.designColorTheme),
      cleanField(s.hasDomain),
      cleanField(s.hasLogo),
      cleanField(s.productPhotos),
      cleanField(s.exampleWebsites),
      cleanField(s.specialNotes),
      cleanField(s.websiteAndDomainName),
      cleanField(s.selectedPackage),
      cleanField(s.businessProfile),
      cleanField(s.status || "Baru"),
    ]);

    // Prepend UTF-8 BOM so Excel opens indonesian characters cleanly
    const csvContent =
      "\uFEFF" +
      [headers.join(","), ...rows.map((r) => r.join(","))].join("\r\n");

    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const url = URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.setAttribute("href", url);
    link.setAttribute(
      "download",
      `Rekap_Formulir_Order_Solveta_${new Date().toISOString().slice(0, 10)}.csv`
    );
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
    showToast("Rekap formulir order berhasil diunduh ke Excel!");
  };

  const getFormUrl = () => {
    if (typeof window !== "undefined") {
      const isGitHubPages = window.location.pathname.includes("/solveta");
      const base = isGitHubPages ? "/solveta" : "";
      return `${window.location.origin}${base}/formulir/`;
    }
    return "/formulir/";
  };

  const copyFormLink = () => {
    if (typeof window !== "undefined") {
      const formUrl = getFormUrl();
      navigator.clipboard.writeText(formUrl);
      showToast("Link Formulir Customer berhasil disalin!");
    }
  };

  return (
    <div className="space-y-6 bg-white font-sans text-left">
      {/* Header Card */}
      <div className="bg-white border border-gray-200/80 rounded-xl p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <h2 className="text-base font-semibold text-gray-900">
            Rekap Formulir Kebutuhan Customer
          </h2>
          <p className="text-xs text-gray-400 mt-0.5">
            Semua data isian brief yang dikirimkan klien otomatis tersimpan di sini.
          </p>
        </div>

        <div className="flex items-center gap-2 flex-wrap">
          <button
            type="button"
            onClick={copyFormLink}
            className="px-3 py-1.5 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer"
            title="Salin tautan formulir untuk dibagikan ke calon klien via WhatsApp"
          >
            <Copy className="w-3.5 h-3.5 text-gray-500" />
            <span>Salin Link Form</span>
          </button>

          <a
            href={getFormUrl()}
            target="_blank"
            rel="noopener noreferrer"
            className="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer shadow-xs"
            title="Buka Formulir Kebutuhan Customer di tab baru"
          >
            <ExternalLink className="w-3.5 h-3.5" />
            <span>Buka Form</span>
          </a>

          <button
            type="button"
            onClick={handleExportExcel}
            className="px-3 py-1.5 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer"
          >
            <Download className="w-3.5 h-3.5 text-gray-500" />
            <span>Unduh Excel (.csv)</span>
          </button>
        </div>
      </div>

      {/* KPI Cards */}
      <div className="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
        <div className="p-4 bg-white rounded-xl border border-gray-200/80">
          <div className="text-[11px] font-medium text-gray-400 uppercase tracking-wider">
            Total Brief
          </div>
          <div className="text-xl font-semibold text-gray-900 mt-0.5">
            {submissions.length}
          </div>
        </div>

        <div className="p-4 bg-white rounded-xl border border-gray-200/80">
          <div className="text-[11px] font-medium text-gray-400 uppercase tracking-wider">
            Perlu Dihubungi
          </div>
          <div className="text-xl font-semibold text-amber-600 mt-0.5">
            {submissions.filter((s) => s.status === "Baru").length}
          </div>
        </div>

        <div className="p-4 bg-white rounded-xl border border-gray-200/80">
          <div className="text-[11px] font-medium text-gray-400 uppercase tracking-wider">
            Sudah Dihubungi
          </div>
          <div className="text-xl font-semibold text-blue-600 mt-0.5">
            {submissions.filter((s) => s.status === "Dihubungi").length}
          </div>
        </div>

        <div className="p-4 bg-white rounded-xl border border-gray-200/80">
          <div className="text-[11px] font-medium text-gray-400 uppercase tracking-wider">
            Selesai / Deal
          </div>
          <div className="text-xl font-semibold text-emerald-600 mt-0.5">
            {submissions.filter((s) => s.status === "Selesai").length}
          </div>
        </div>
      </div>

      {/* Filter & Sorting Controls */}
      <div className="bg-white border border-gray-200/80 rounded-xl p-4 space-y-3">
        <div className="flex flex-col md:flex-row md:items-center justify-between gap-3">
          {/* Search bar */}
          <div className="relative flex-1">
            <Search className="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" />
            <input
              type="text"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              placeholder="Cari nama pelanggan, brand, nomor WhatsApp, atau paket..."
              className="w-full text-xs pl-8 pr-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
            />
          </div>

          {/* Status filter pills */}
          <div className="flex items-center gap-1.5 flex-wrap">
            {["all", "Baru", "Dihubungi", "Selesai"].map((st) => (
              <button
                key={st}
                type="button"
                onClick={() => setStatusFilter(st)}
                className={`px-2.5 py-1 text-xs font-medium rounded-lg transition-colors cursor-pointer ${
                  statusFilter === st
                    ? "bg-gray-900 text-white"
                    : "bg-gray-100 text-gray-600 hover:bg-gray-200"
                }`}
              >
                {st === "all" ? "Semua Status" : st}
              </button>
            ))}
          </div>
        </div>

        {/* Date / Month / Year Filters */}
        <div className="flex flex-wrap items-center gap-2 pt-2 border-t border-gray-100 text-xs">
          <div className="flex items-center gap-1.5 text-gray-500 font-medium">
            <Filter className="w-3.5 h-3.5 text-gray-400" />
            <span>Filter Tanggal:</span>
          </div>

          {/* Year Filter */}
          <select
            value={selectedYear}
            onChange={(e) => setSelectedYear(e.target.value)}
            className="p-1.5 rounded-lg border border-gray-200 bg-white text-gray-700 outline-none"
          >
            <option value="all">Semua Tahun</option>
            {availableYears.map((y) => (
              <option key={y} value={y}>
                Tahun {y}
              </option>
            ))}
          </select>

          {/* Month Filter */}
          <select
            value={selectedMonth}
            onChange={(e) => setSelectedMonth(e.target.value)}
            className="p-1.5 rounded-lg border border-gray-200 bg-white text-gray-700 outline-none"
          >
            <option value="all">Semua Bulan</option>
            {monthNames.map((m) => (
              <option key={m.num} value={m.num}>
                {m.name}
              </option>
            ))}
          </select>

          {/* Specific Date Picker */}
          <input
            type="date"
            value={selectedDate}
            onChange={(e) => setSelectedDate(e.target.value)}
            className="p-1.5 rounded-lg border border-gray-200 bg-white text-gray-700 outline-none"
            title="Pilih tanggal spesifik"
          />

          {(selectedYear !== "all" ||
            selectedMonth !== "all" ||
            selectedDate ||
            searchQuery ||
            statusFilter !== "all") && (
            <button
              type="button"
              onClick={() => {
                setSelectedYear("all");
                setSelectedMonth("all");
                setSelectedDate("");
                setSearchQuery("");
                setStatusFilter("all");
              }}
              className="px-2 py-1 text-[11px] text-gray-500 hover:text-gray-900 underline cursor-pointer"
            >
              Reset Filter
            </button>
          )}

          <div className="ml-auto text-[11px] text-gray-400">
            Menampilkan <strong>{filteredSubmissions.length}</strong> dari {submissions.length} brief
          </div>
        </div>
      </div>

      {/* Submissions Table */}
      <div className="bg-white border border-gray-200/80 rounded-xl overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full text-left border-collapse text-xs">
            <thead>
              <tr className="bg-white border-b border-gray-100 text-gray-400 font-medium uppercase text-[11px] tracking-wider">
                <th className="py-3 px-4">Waktu</th>
                <th className="py-3 px-4">Pelanggan</th>
                <th className="py-3 px-4">Brand / Usaha</th>
                <th className="py-3 px-4">WhatsApp</th>
                <th className="py-3 px-4">Paket</th>
                <th className="py-3 px-4">Status</th>
                <th className="py-3 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-100">
              {filteredSubmissions.length === 0 ? (
                <tr>
                  <td colSpan={7} className="py-10 text-center text-gray-400">
                    Belum ada formulir brief customer yang sesuai dengan filter.
                  </td>
                </tr>
              ) : (
                filteredSubmissions.map((sub) => (
                  <tr
                    key={sub.id}
                    className="hover:bg-gray-50/50 transition-colors"
                  >
                    <td className="py-3 px-4 font-mono text-[11px] text-gray-400 whitespace-nowrap">
                      {sub.timestamp}
                    </td>
                    <td className="py-3 px-4 font-medium text-gray-900">
                      {sub.fullName}
                    </td>
                    <td className="py-3 px-4 font-medium text-gray-700">
                      {sub.brandName}
                    </td>
                    <td className="py-3 px-4 font-mono text-gray-600">
                      <a
                        href={getWhatsAppUrl(
                          sub.whatsappNumber,
                          `Halo ${sub.fullName}, kami dari SOLVETA telah membaca brief kebutuhan website Anda untuk ${sub.brandName}.`
                        )}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="text-gray-900 hover:text-emerald-700 hover:underline flex items-center gap-1"
                      >
                        <Phone className="w-3 h-3 text-emerald-600" />
                        <span>{sub.whatsappNumber}</span>
                      </a>
                    </td>
                    <td className="py-3 px-4">
                      <span className="text-[11px] font-medium bg-gray-100 text-gray-800 px-2 py-0.5 rounded">
                        {sub.selectedPackage}
                      </span>
                    </td>
                    <td className="py-3 px-4">
                      <select
                        value={sub.status || "Baru"}
                        onChange={(e) =>
                          updateOrderSubmissionStatus(
                            sub.id,
                            e.target.value as "Baru" | "Dihubungi" | "Selesai"
                          )
                        }
                        className={`text-[11px] font-medium px-2 py-0.5 rounded outline-none border cursor-pointer ${
                          sub.status === "Selesai"
                            ? "bg-emerald-50 text-emerald-700 border-emerald-200"
                            : sub.status === "Dihubungi"
                            ? "bg-blue-50 text-blue-700 border-blue-200"
                            : "bg-amber-50 text-amber-700 border-amber-200"
                        }`}
                      >
                        <option value="Baru">Baru</option>
                        <option value="Dihubungi">Dihubungi</option>
                        <option value="Selesai">Selesai</option>
                      </select>
                    </td>
                    <td className="py-3 px-4 text-right whitespace-nowrap">
                      <div className="flex items-center justify-end gap-1.5">
                        <button
                          type="button"
                          onClick={() => setActiveSubmission(sub)}
                          className="px-2.5 py-1 bg-white hover:bg-gray-100 border border-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors flex items-center gap-1 cursor-pointer"
                        >
                          <Eye className="w-3 h-3" />
                          <span>Detail</span>
                        </button>
                        <button
                          type="button"
                          onClick={() => {
                            if (confirm(`Hapus formulir dari ${sub.fullName}?`)) {
                              deleteOrderSubmission(sub.id);
                              showToast("Data formulir dihapus!");
                            }
                          }}
                          className="p-1 text-gray-400 hover:text-red-600 transition-colors"
                          title="Hapus Brief"
                        >
                          <Trash2 className="w-3.5 h-3.5" />
                        </button>
                      </div>
                    </td>
                  </tr>
                ))
              )}
            </tbody>
          </table>
        </div>
      </div>

      {/* DETAIL MODAL: 16 JAWABAN CUSTOMER */}
      <AnimatePresence>
        {activeSubmission && (
          <div className="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.96, y: 10 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.96, y: 10 }}
              className="bg-white rounded-xl p-6 max-w-2xl w-full max-h-[85vh] overflow-y-auto shadow-xl border border-gray-200/80 font-sans space-y-4"
            >
              <div className="flex items-start justify-between pb-3 border-b border-gray-100">
                <div>
                  <div className="text-[11px] text-gray-400 font-mono">
                    Waktu Kirim: {activeSubmission.timestamp}
                  </div>
                  <h3 className="text-base font-semibold text-gray-900 mt-0.5">
                    {activeSubmission.brandName} — {activeSubmission.fullName}
                  </h3>
                </div>

                <span
                  className={`text-xs px-2.5 py-0.5 rounded font-medium ${
                    activeSubmission.status === "Selesai"
                      ? "bg-emerald-100 text-emerald-800"
                      : activeSubmission.status === "Dihubungi"
                      ? "bg-blue-100 text-blue-800"
                      : "bg-amber-100 text-amber-800"
                  }`}
                >
                  Status: {activeSubmission.status || "Baru"}
                </span>
              </div>

              {/* 16 Fields Breakdown */}
              <div className="space-y-3 text-xs">
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                    <div className="text-[11px] text-gray-400">1. Nama Lengkap</div>
                    <div className="font-semibold text-gray-900 mt-0.5">
                      {activeSubmission.fullName}
                    </div>
                  </div>

                  <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                    <div className="text-[11px] text-gray-400">2. Nomor WhatsApp</div>
                    <div className="font-semibold text-gray-900 mt-0.5 font-mono">
                      {activeSubmission.whatsappNumber}
                    </div>
                  </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                    <div className="text-[11px] text-gray-400">3. Nama Usaha / Brand</div>
                    <div className="font-semibold text-gray-900 mt-0.5">
                      {activeSubmission.brandName}
                    </div>
                  </div>

                  <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                    <div className="text-[11px] text-gray-400">14. Nama Website &amp; Domain</div>
                    <div className="font-semibold text-gray-900 mt-0.5 font-mono">
                      {activeSubmission.websiteAndDomainName || "-"}
                    </div>
                  </div>
                </div>

                <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                  <div className="text-[11px] text-gray-400">4. Deskripsi Singkat Usaha / Kegiatan</div>
                  <div className="text-gray-800 mt-1 leading-relaxed">
                    {activeSubmission.businessDescription}
                  </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                    <div className="text-[11px] text-gray-400">15. Paket Yang Dipilih</div>
                    <div className="font-semibold text-gray-900 mt-0.5">
                      {activeSubmission.selectedPackage}
                    </div>
                  </div>

                  <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                    <div className="text-[11px] text-gray-400">6. Jenis Website</div>
                    <div className="font-semibold text-gray-900 mt-0.5">
                      {activeSubmission.websiteType}
                    </div>
                  </div>
                </div>

                <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                  <div className="text-[11px] text-gray-400">7. Halaman yang Ingin Ditampilkan</div>
                  <div className="font-medium text-gray-800 mt-1">
                    {activeSubmission.pagesNeeded}
                  </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                    <div className="text-[11px] text-gray-400">8. Warna / Nuansa Desain</div>
                    <div className="font-medium text-gray-800 mt-0.5">
                      {activeSubmission.designColorTheme}
                    </div>
                  </div>

                  <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                    <div className="text-[11px] text-gray-400">9. Status Domain</div>
                    <div className="font-medium text-gray-800 mt-0.5">
                      {activeSubmission.hasDomain}
                    </div>
                  </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                    <div className="text-[11px] text-gray-400">10. Status Logo</div>
                    <div className="font-medium text-gray-800 mt-0.5">
                      {activeSubmission.hasLogo}
                    </div>
                  </div>

                  <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                    <div className="text-[11px] text-gray-400">11. Foto Produk / Usaha</div>
                    <div className="font-medium text-gray-800 mt-0.5 truncate">
                      {activeSubmission.productPhotos}
                    </div>
                  </div>
                </div>

                <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                  <div className="text-[11px] text-gray-400">12. Contoh Website yang Disukai</div>
                  <div className="font-medium text-gray-800 mt-1 font-mono">
                    {activeSubmission.exampleWebsites}
                  </div>
                </div>

                <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                  <div className="text-[11px] text-gray-400">13. Catatan Tambahan / Permintaan Khusus</div>
                  <div className="text-gray-800 mt-1 leading-relaxed">
                    {activeSubmission.specialNotes}
                  </div>
                </div>

                <div className="p-3 bg-gray-50/70 rounded-lg border border-gray-100">
                  <div className="text-[11px] text-gray-400">16. Profil Usaha / Dokumen</div>
                  <div className="text-gray-800 mt-1 leading-relaxed">
                    {activeSubmission.businessProfile}
                  </div>
                </div>
              </div>

              {/* Modal Actions */}
              <div className="flex flex-col sm:flex-row items-center justify-between gap-3 pt-3 border-t border-gray-100">
                <a
                  href={getWhatsAppUrl(
                    activeSubmission.whatsappNumber,
                    `Halo ${activeSubmission.fullName}, kami dari SOLVETA telah meninjau brief kebutuhan website untuk ${activeSubmission.brandName} (${activeSubmission.selectedPackage}). Kami siap mendiskusikan proses pengerjaannya.`
                  )}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="w-full sm:w-auto px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded-lg transition-colors flex items-center justify-center gap-1.5"
                >
                  <Phone className="w-3.5 h-3.5" />
                  <span>Hubungi Klien di WhatsApp</span>
                </a>

                <button
                  type="button"
                  onClick={() => setActiveSubmission(null)}
                  className="w-full sm:w-auto px-4 py-2 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors cursor-pointer"
                >
                  Tutup
                </button>
              </div>
            </motion.div>
          </div>
        )}
      </AnimatePresence>
    </div>
  );
};
