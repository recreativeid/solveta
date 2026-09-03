"use client";

import React, { useState, useMemo } from "react";
import {
  Plus,
  Search,
  Download,
  Calendar,
  Filter,
  FileText,
  Printer,
  CheckCircle2,
  Clock,
  XCircle,
  ExternalLink,
  Edit,
  Trash2,
  Phone,
  Building2,
  DollarSign,
  ArrowUpDown,
  Share2,
} from "lucide-react";
import { motion, AnimatePresence } from "framer-motion";
import {
  useSiteData,
  ProjectTransactionRecord,
  ProjectCostComponent,
  CustomerOrderSubmission,
} from "@/context/SiteDataContext";
import { getWhatsAppUrl } from "@/utils/whatsapp";

export const ProjectTransactionsManager: React.FC<{
  showToast: (msg: string) => void;
  initialSubmission?: CustomerOrderSubmission | null;
  onClearInitialSubmission?: () => void;
}> = ({ showToast, initialSubmission, onClearInitialSubmission }) => {
  const {
    data,
    addProjectTransaction,
    editProjectTransaction,
    deleteProjectTransaction,
  } = useSiteData();

  const transactions = data.projectTransactions || [];
  const logoSrc = data.siteCopy?.siteLogo || "/images/logo.png";

  // Filter & Search states
  const [searchQuery, setSearchQuery] = useState("");
  const [statusFilter, setStatusFilter] = useState<string>("all");
  const [selectedYear, setSelectedYear] = useState<string>("all");
  const [selectedMonth, setSelectedMonth] = useState<string>("all");
  const [sortOrder, setSortOrder] = useState<"newest" | "oldest">("newest");

  // Transaction Modal State (Add / Edit)
  const [txModalOpen, setTxModalOpen] = useState(false);
  const [editingTxId, setEditingTxId] = useState<string | null>(null);
  const [formDate, setFormDate] = useState(new Date().toISOString().slice(0, 10));
  const [formCustomerName, setFormCustomerName] = useState("");
  const [formPhoneNumber, setFormPhoneNumber] = useState("");
  const [formServicePrice, setFormServicePrice] = useState<number | string>("");
  const [formWebsiteName, setFormWebsiteName] = useState("");
  const [formWebsiteLink, setFormWebsiteLink] = useState("");
  const [formStatus, setFormStatus] = useState<"Terlaksana" | "Progress" | "Batal">("Progress");
  const [formNotes, setFormNotes] = useState("");
  const [formCostComponents, setFormCostComponents] = useState<ProjectCostComponent[]>([]);

  // Invoice Modal State
  const [invoiceTx, setInvoiceTx] = useState<ProjectTransactionRecord | null>(null);

  // Formatting helpers
  const formatIDR = (val: number) => {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      maximumFractionDigits: 0,
    }).format(val);
  };

  const formatDateIndo = (dateStr: string) => {
    if (!dateStr) return "-";
    try {
      const d = new Date(dateStr);
      return new Intl.DateTimeFormat("id-ID", {
        day: "numeric",
        month: "long",
        year: "numeric",
      }).format(d);
    } catch {
      return dateStr;
    }
  };

  // Available Years
  const availableYears = useMemo(() => {
    const years = new Set<string>();
    transactions.forEach((t) => {
      const year = t.date.slice(0, 4);
      if (year && !isNaN(Number(year))) years.add(year);
    });
    return Array.from(years).sort().reverse();
  }, [transactions]);

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

  // Filtered & Sorted List
  const filteredTransactions = useMemo(() => {
    return transactions
      .filter((t) => {
        const q = searchQuery.toLowerCase();
        const matchQuery =
          !q ||
          t.customerName.toLowerCase().includes(q) ||
          t.websiteName.toLowerCase().includes(q) ||
          t.phoneNumber.includes(q) ||
          t.notes.toLowerCase().includes(q) ||
          t.invoiceNumber.toLowerCase().includes(q);

        const matchStatus = statusFilter === "all" || t.status === statusFilter;

        const matchYear =
          selectedYear === "all" || t.date.startsWith(selectedYear);

        const matchMonth =
          selectedMonth === "all" ||
          (selectedYear !== "all"
            ? t.date.startsWith(`${selectedYear}-${selectedMonth}`)
            : t.date.includes(`-${selectedMonth}-`));

        return matchQuery && matchStatus && matchYear && matchMonth;
      })
      .sort((a, b) => {
        if (sortOrder === "newest") {
          return new Date(b.date).getTime() - new Date(a.date).getTime();
        }
        return new Date(a.date).getTime() - new Date(b.date).getTime();
      });
  }, [
    transactions,
    searchQuery,
    statusFilter,
    selectedYear,
    selectedMonth,
    sortOrder,
  ]);

  // Financial summary
  const summary = useMemo(() => {
    const totalDoneRevenue = transactions
      .filter((t) => t.status === "Terlaksana")
      .reduce((sum, t) => sum + (t.servicePrice || 0), 0);

    const countDone = transactions.filter((t) => t.status === "Terlaksana").length;
    const countProgress = transactions.filter((t) => t.status === "Progress").length;
    const countBatal = transactions.filter((t) => t.status === "Batal").length;

    return { totalDoneRevenue, countDone, countProgress, countBatal };
  }, [transactions]);

  // Handle auto-populate from a selected customer order submission
  const handleSelectCustomerSubmission = (submissionId: string) => {
    const sub = (data.orderSubmissions || []).find((s) => s.id === submissionId);
    if (!sub) return;

    // User requirement: otomatis terisi hanya seputar Tanggal, Pelanggan, Nama Website.
    // Yang lain developer isi manual sendiri, Tanda Status default Progress, Keterangan belum ada perubahan.
    setFormDate(sub.timestamp ? sub.timestamp.slice(0, 10) : new Date().toISOString().slice(0, 10));
    setFormCustomerName(sub.fullName || "");
    setFormPhoneNumber(sub.whatsappNumber || "");
    setFormWebsiteName(sub.brandName || sub.websiteAndDomainName || "");
    setFormWebsiteLink(""); // Developer isi manual sendiri
    setFormServicePrice(""); // Developer isi manual sendiri
    setFormStatus("Progress"); // Tanda Status default
    setFormNotes(""); // Keterangan awal belum ada perubahan (developer isi manual)
    setFormCostComponents([]);
    showToast(`Data formulir ${sub.fullName} dimuat! Tanggal, Pelanggan, & Nama Website terisi.`);
  };

  // React to initialSubmission passed from outside (e.g. OrderSubmissionsManager)
  React.useEffect(() => {
    if (initialSubmission) {
      setEditingTxId(null);
      setFormDate(
        initialSubmission.timestamp
          ? initialSubmission.timestamp.slice(0, 10)
          : new Date().toISOString().slice(0, 10)
      );
      setFormCustomerName(initialSubmission.fullName || "");
      setFormPhoneNumber(initialSubmission.whatsappNumber || "");
      setFormWebsiteName(initialSubmission.brandName || initialSubmission.websiteAndDomainName || "");
      setFormWebsiteLink(""); // Developer isi manual sendiri
      setFormServicePrice(""); // Developer isi manual sendiri
      setFormStatus("Progress"); // Tanda Status default
      setFormNotes(""); // Keterangan awal belum ada perubahan (developer isi manual)
      setFormCostComponents([]);
      setTxModalOpen(true);
      if (onClearInitialSubmission) onClearInitialSubmission();
      showToast(`Data ${initialSubmission.fullName} ditarik! Silakan lengkapi harga layanan & keterangan.`);
    }
  }, [initialSubmission, onClearInitialSubmission, showToast]);

  // Open Create Modal
  const handleOpenCreate = () => {
    setEditingTxId(null);
    setFormDate(new Date().toISOString().slice(0, 10));
    setFormCustomerName("");
    setFormPhoneNumber("");
    setFormServicePrice(""); // Dikosongkan agar developer mengisi sendiri
    setFormWebsiteName("");
    setFormWebsiteLink("");
    setFormStatus("Progress");
    setFormNotes("");
    setFormCostComponents([]);
    setTxModalOpen(true);
  };

  // Open Edit Modal
  const handleOpenEdit = (t: ProjectTransactionRecord) => {
    setEditingTxId(t.id);
    setFormDate(t.date);
    setFormCustomerName(t.customerName);
    setFormPhoneNumber(t.phoneNumber);
    setFormServicePrice(t.servicePrice);
    setFormWebsiteName(t.websiteName);
    setFormWebsiteLink(t.websiteLink);
    setFormStatus(t.status);
    setFormNotes(t.notes || "");
    setFormCostComponents(t.costComponents || []);
    setTxModalOpen(true);
  };

  // Save Transaction
  const handleSaveTx = (e: React.FormEvent) => {
    e.preventDefault();
    if (!formCustomerName.trim() || !formWebsiteName.trim()) {
      showToast("Nama pelanggan dan nama website wajib diisi.");
      return;
    }

    const dateFormatted = formDate.replace(/-/g, "");
    const randomSuffix = Math.floor(100 + Math.random() * 900);
    const generatedInvoiceNumber = `INV-${dateFormatted}-${randomSuffix}`;
    const parsedPrice = typeof formServicePrice === "number" ? formServicePrice : Number(formServicePrice) || 0;

    // Filter cost components
    const validCostComponents: ProjectCostComponent[] = formCostComponents
      .filter((c) => c.name.trim().length > 0)
      .map((c) => ({
        id: c.id || `c-${Date.now()}-${Math.random()}`,
        name: c.name.trim(),
        cost: c.cost ? Number(c.cost) : undefined,
        note: c.note?.trim() || undefined,
      }));

    if (editingTxId) {
      editProjectTransaction(editingTxId, {
        date: formDate,
        customerName: formCustomerName.trim(),
        phoneNumber: formPhoneNumber.trim(),
        servicePrice: parsedPrice,
        websiteName: formWebsiteName.trim(),
        websiteLink: formWebsiteLink.trim(),
        status: formStatus,
        notes: formNotes.trim(),
        costComponents: validCostComponents,
      });
      showToast("Data proyek berhasil diperbarui!");
    } else {
      addProjectTransaction({
        date: formDate,
        customerName: formCustomerName.trim(),
        phoneNumber: formPhoneNumber.trim(),
        servicePrice: parsedPrice,
        websiteName: formWebsiteName.trim(),
        websiteLink: formWebsiteLink.trim() || `https://${formWebsiteName.toLowerCase().replace(/\s+/g, "")}.solveta.site`,
        status: formStatus,
        notes: formNotes.trim(),
        invoiceNumber: generatedInvoiceNumber,
        costComponents: validCostComponents,
      });
      showToast("Transaksi proyek baru berhasil dicatat!");
    }

    setTxModalOpen(false);
  };

  // Export to Excel (CSV UTF-8 BOM)
  const handleExportExcel = () => {
    if (filteredTransactions.length === 0) {
      showToast("Tidak ada data transaksi untuk diekspor.");
      return;
    }

    const headers = [
      "No Invoice",
      "Tanggal",
      "Atas Nama Pelanggan",
      "Nomor HP / WhatsApp",
      "Harga Layanan (Rp)",
      "Nama Website",
      "Link Website",
      "Tanda Status",
      "Keterangan",
    ];

    const cleanField = (val: string | number | undefined) => {
      if (val === undefined || val === null) return '""';
      const str = String(val).replace(/"/g, '""').replace(/\r?\n/g, " ");
      return `"${str}"`;
    };

    const rows = filteredTransactions.map((t) => [
      cleanField(t.invoiceNumber),
      cleanField(t.date),
      cleanField(t.customerName),
      cleanField(t.phoneNumber),
      t.servicePrice,
      cleanField(t.websiteName),
      cleanField(t.websiteLink),
      cleanField(t.status),
      cleanField(t.notes),
    ]);

    const csvContent =
      "\uFEFF" +
      [headers.join(","), ...rows.map((r) => r.join(","))].join("\r\n");

    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const url = URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.setAttribute("href", url);
    link.setAttribute(
      "download",
      `Pencatatan_Proyek_Solveta_${new Date().toISOString().slice(0, 10)}.csv`
    );
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
    showToast("Data pencatatan proyek berhasil diunduh ke Excel!");
  };

  // Print Invoice
  const handlePrintInvoice = () => {
    window.print();
  };

  return (
    <div className="space-y-6 bg-white font-sans text-left">
      {/* Header Bar */}
      <div className="bg-white border border-gray-200/80 rounded-xl p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <h2 className="text-base font-semibold text-gray-900">
            Pencatatan Proyek, Transaksi &amp; Invoice
          </h2>
          <p className="text-xs text-gray-400 mt-0.5">
            Kelola status pengerjaan website pelanggan, riwayat harga, dan unduh bukti invoice resmi.
          </p>
        </div>

        <div className="flex items-center gap-2 flex-wrap">
          <button
            type="button"
            onClick={handleExportExcel}
            className="px-3 py-1.5 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer"
          >
            <Download className="w-3.5 h-3.5 text-gray-500" />
            <span>Unduh Excel</span>
          </button>

          <button
            type="button"
            onClick={handleOpenCreate}
            className="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer"
          >
            <Plus className="w-3.5 h-3.5" />
            <span>+ Catat Transaksi Baru</span>
          </button>
        </div>
      </div>

      {/* KPI Cards */}
      <div className="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
        <div className="p-4 bg-white rounded-xl border border-gray-200/80">
          <div className="text-[11px] font-medium text-gray-400 uppercase tracking-wider">
            Omset Terlaksana
          </div>
          <div className="text-xl font-semibold text-gray-900 mt-0.5">
            {formatIDR(summary.totalDoneRevenue)}
          </div>
        </div>

        <div className="p-4 bg-white rounded-xl border border-gray-200/80">
          <div className="text-[11px] font-medium text-gray-400 uppercase tracking-wider">
            Proyek Terlaksana
          </div>
          <div className="text-xl font-semibold text-emerald-600 mt-0.5 flex items-center gap-1.5">
            <CheckCircle2 className="w-4 h-4" />
            <span>{summary.countDone} Web</span>
          </div>
        </div>

        <div className="p-4 bg-white rounded-xl border border-gray-200/80">
          <div className="text-[11px] font-medium text-gray-400 uppercase tracking-wider">
            Sedang Progress
          </div>
          <div className="text-xl font-semibold text-blue-600 mt-0.5 flex items-center gap-1.5">
            <Clock className="w-4 h-4" />
            <span>{summary.countProgress} Web</span>
          </div>
        </div>

        <div className="p-4 bg-white rounded-xl border border-gray-200/80">
          <div className="text-[11px] font-medium text-gray-400 uppercase tracking-wider">
            Proyek Batal
          </div>
          <div className="text-xl font-semibold text-gray-400 mt-0.5 flex items-center gap-1.5">
            <XCircle className="w-4 h-4 text-gray-400" />
            <span>{summary.countBatal}</span>
          </div>
        </div>
      </div>

      {/* Filters & Sorting */}
      <div className="bg-white border border-gray-200/80 rounded-xl p-4 space-y-3">
        <div className="flex flex-col md:flex-row md:items-center justify-between gap-3">
          <div className="relative flex-1">
            <Search className="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" />
            <input
              type="text"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              placeholder="Cari pelanggan, website, nomor HP, invoice, atau keterangan..."
              className="w-full text-xs pl-8 pr-3 py-2 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
            />
          </div>

          <div className="flex items-center gap-1.5 flex-wrap">
            {["all", "Terlaksana", "Progress", "Batal"].map((st) => (
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

        {/* Date Filter & Sort */}
        <div className="flex flex-wrap items-center gap-2 pt-2 border-t border-gray-100 text-xs">
          <div className="flex items-center gap-1.5 text-gray-500 font-medium">
            <Calendar className="w-3.5 h-3.5 text-gray-400" />
            <span>Periode:</span>
          </div>

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

          <button
            type="button"
            onClick={() =>
              setSortOrder(sortOrder === "newest" ? "oldest" : "newest")
            }
            className="p-1.5 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg text-gray-700 flex items-center gap-1 cursor-pointer"
            title="Ubah urutan tanggal"
          >
            <ArrowUpDown className="w-3 h-3 text-gray-500" />
            <span>{sortOrder === "newest" ? "Terbaru" : "Terlama"}</span>
          </button>

          {(selectedYear !== "all" ||
            selectedMonth !== "all" ||
            searchQuery ||
            statusFilter !== "all") && (
            <button
              type="button"
              onClick={() => {
                setSelectedYear("all");
                setSelectedMonth("all");
                setSearchQuery("");
                setStatusFilter("all");
              }}
              className="px-2 py-1 text-[11px] text-gray-500 hover:text-gray-900 underline cursor-pointer"
            >
              Reset
            </button>
          )}

          <div className="ml-auto text-[11px] text-gray-400">
            Menampilkan <strong>{filteredTransactions.length}</strong> transaksi
          </div>
        </div>
      </div>

      {/* Transactions Table */}
      <div className="bg-white border border-gray-200/80 rounded-xl overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full text-left border-collapse text-xs">
            <thead>
              <tr className="bg-white border-b border-gray-100 text-gray-400 font-medium uppercase text-[11px] tracking-wider">
                <th className="py-3 px-4">Tanggal</th>
                <th className="py-3 px-4">Pelanggan</th>
                <th className="py-3 px-4">Nama Website</th>
                <th className="py-3 px-4">Harga Layanan</th>
                <th className="py-3 px-4">Tanda Status</th>
                <th className="py-3 px-4">Keterangan</th>
                <th className="py-3 px-4 text-right">Aksi &amp; Invoice</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-100 font-sans">
              {filteredTransactions.length === 0 ? (
                <tr>
                  <td colSpan={7} className="py-10 text-center text-gray-400">
                    Belum ada transaksi proyek yang tercatat sesuai filter.
                  </td>
                </tr>
              ) : (
                filteredTransactions.map((tx) => (
                  <tr key={tx.id} className="hover:bg-gray-50/50 transition-colors">
                    <td className="py-3 px-4 font-mono text-[11px] text-gray-500 whitespace-nowrap">
                      {tx.date}
                    </td>
                    <td className="py-3 px-4">
                      <div className="font-semibold text-gray-900">
                        {tx.customerName}
                      </div>
                      <div className="text-[11px] text-gray-400 font-mono flex items-center gap-1">
                        <Phone className="w-3 h-3 text-gray-400" />
                        <span>{tx.phoneNumber || "-"}</span>
                      </div>
                    </td>
                    <td className="py-3 px-4">
                      <div className="font-medium text-gray-800">
                        {tx.websiteName}
                      </div>
                      {tx.websiteLink && (
                        <a
                          href={tx.websiteLink}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="text-[11px] text-gray-400 hover:text-gray-900 font-mono hover:underline flex items-center gap-0.5 truncate max-w-[160px]"
                        >
                          <span>{tx.websiteLink.replace(/^https?:\/\//, "")}</span>
                          <ExternalLink className="w-2.5 h-2.5" />
                        </a>
                      )}
                    </td>
                    <td className="py-3 px-4 font-semibold text-gray-900 whitespace-nowrap">
                      {tx.servicePrice > 0 ? (
                        formatIDR(tx.servicePrice)
                      ) : (
                        <button
                          type="button"
                          onClick={() => handleOpenEdit(tx)}
                          className="inline-flex items-center gap-1 text-[11px] font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 px-2 py-0.5 rounded cursor-pointer transition-colors"
                          title="Klik untuk mengisi harga layanan manual"
                        >
                          <span>Rp 0 (Isi Manual)</span>
                          <Edit className="w-2.5 h-2.5 text-amber-600" />
                        </button>
                      )}
                    </td>
                    <td className="py-3 px-4 whitespace-nowrap">
                      <select
                        value={tx.status}
                        onChange={(e) =>
                          editProjectTransaction(tx.id, {
                            status: e.target.value as
                              | "Terlaksana"
                              | "Progress"
                              | "Batal",
                          })
                        }
                        className={`text-[11px] font-medium px-2 py-0.5 rounded outline-none border cursor-pointer ${
                          tx.status === "Terlaksana"
                            ? "bg-emerald-50 text-emerald-700 border-emerald-200"
                            : tx.status === "Progress"
                            ? "bg-blue-50 text-blue-700 border-blue-200"
                            : "bg-gray-100 text-gray-600 border-gray-200"
                        }`}
                      >
                        <option value="Terlaksana">Terlaksana</option>
                        <option value="Progress">Progress</option>
                        <option value="Batal">Batal</option>
                      </select>
                    </td>
                    <td className="py-3 px-4 text-gray-500 max-w-[200px] truncate text-[11px]">
                      {tx.notes ? (
                        <span title={tx.notes}>{tx.notes}</span>
                      ) : (
                        <span className="text-gray-400 italic">Belum ada keterangan</span>
                      )}
                    </td>
                    <td className="py-3 px-4 text-right whitespace-nowrap">
                      <div className="flex items-center justify-end gap-1.5">
                        <button
                          type="button"
                          onClick={() => setInvoiceTx(tx)}
                          className="px-2.5 py-1 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1 cursor-pointer shadow-none"
                          title="Lihat & Cetak Invoice Resmi"
                        >
                          <FileText className="w-3 h-3" />
                          <span>Invoice</span>
                        </button>

                        <button
                          type="button"
                          onClick={() => handleOpenEdit(tx)}
                          className="p-1 hover:bg-gray-100 text-gray-400 hover:text-gray-700 rounded transition-colors"
                          title="Edit Catatan Proyek"
                        >
                          <Edit className="w-3.5 h-3.5" />
                        </button>

                        <button
                          type="button"
                          onClick={() => {
                            if (confirm(`Hapus catatan proyek untuk ${tx.customerName}?`)) {
                              deleteProjectTransaction(tx.id);
                              showToast("Catatan proyek berhasil dihapus!");
                            }
                          }}
                          className="p-1 hover:bg-red-50 text-gray-400 hover:text-red-600 rounded transition-colors"
                          title="Hapus Proyek"
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

      {/* MODAL: INPUT / EDIT PROYEK & TRANSAKSI */}
      <AnimatePresence>
        {txModalOpen && (
          <div className="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.96, y: 10 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.96, y: 10 }}
              className="bg-white rounded-2xl p-6 max-w-lg w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-gray-200 font-sans"
            >
              <h3 className="text-sm font-semibold text-gray-900 mb-0.5">
                {editingTxId ? "Edit Transaksi Proyek" : "Catat Transaksi Proyek Baru"}
              </h3>
              <p className="text-xs text-gray-400 mb-4">
                Lengkapi rincian tanggal, nama pelanggan, website, dan harga layanan.
              </p>

              <form onSubmit={handleSaveTx} className="space-y-3 text-xs">
                {/* Auto-fill from Customer Submission */}
                {!editingTxId && (
                  <div className="p-3 bg-gray-50 rounded-xl border border-gray-200/80 mb-2">
                    <label className="block text-[11px] font-semibold text-gray-800 mb-1 flex items-center gap-1.5">
                      <ClipboardList className="w-3.5 h-3.5 text-gray-600" />
                      <span>Tarik Data Otomatis dari Formulir Customer (Opsional):</span>
                    </label>
                    <select
                      onChange={(e) => {
                        if (e.target.value) handleSelectCustomerSubmission(e.target.value);
                      }}
                      defaultValue=""
                      className="w-full text-xs font-medium text-gray-900 p-2 rounded-lg border border-gray-300 bg-white cursor-pointer"
                    >
                      <option value="">-- Pilih Formulir Orderan Pelanggan --</option>
                      {(data.orderSubmissions || []).map((s) => (
                        <option key={s.id} value={s.id}>
                          {s.fullName} — {s.brandName} ({s.selectedPackage} | {s.timestamp.slice(0, 10)})
                        </option>
                      ))}
                    </select>
                    <p className="text-[10px] text-gray-400 mt-1">
                      Nama, nomor WhatsApp, brand, dan detail paket terisi otomatis. Harga layanan dikosongkan agar developer dapat menentukan sendiri.
                    </p>
                  </div>
                )}

                <div className="grid grid-cols-2 gap-3">
                  <div>
                    <label className="block font-medium text-gray-700 mb-1">
                      Tanggal
                    </label>
                    <input
                      type="date"
                      required
                      value={formDate}
                      onChange={(e) => setFormDate(e.target.value)}
                      className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                    />
                  </div>

                  <div>
                    <label className="block font-medium text-gray-700 mb-1">
                      Tanda Status
                    </label>
                    <select
                      value={formStatus}
                      onChange={(e) =>
                        setFormStatus(e.target.value as "Terlaksana" | "Progress" | "Batal")
                      }
                      className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                    >
                      <option value="Progress">Progress (Dalam Proses)</option>
                      <option value="Terlaksana">Terlaksana (Selesai &amp; Lunas)</option>
                      <option value="Batal">Batal</option>
                    </select>
                  </div>
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Atas Nama Pelanggan
                  </label>
                  <input
                    type="text"
                    required
                    value={formCustomerName}
                    onChange={(e) => setFormCustomerName(e.target.value)}
                    placeholder="Contoh: Budi Santoso"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div className="grid grid-cols-2 gap-3">
                  <div>
                    <label className="block font-medium text-gray-700 mb-1">
                      Nomor HP / WhatsApp
                    </label>
                    <input
                      type="text"
                      value={formPhoneNumber}
                      onChange={(e) => setFormPhoneNumber(e.target.value)}
                      placeholder="Contoh: 081234567890"
                      className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                    />
                  </div>

                  <div>
                    <label className="block font-medium text-gray-700 mb-1">
                      Harga Layanan (Rp)
                    </label>
                    <input
                      type="number"
                      required
                      step="1000"
                      placeholder="Tentukan harga layanan..."
                      value={formServicePrice === "" ? "" : formServicePrice}
                      onChange={(e) =>
                        setFormServicePrice(
                          e.target.value === "" ? "" : Number(e.target.value)
                        )
                      }
                      className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-mono"
                    />
                  </div>
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Nama Website
                  </label>
                  <input
                    type="text"
                    required
                    value={formWebsiteName}
                    onChange={(e) => setFormWebsiteName(e.target.value)}
                    placeholder="Contoh: Kopi Senja Nusantara"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Link Website (URL)
                  </label>
                  <input
                    type="text"
                    value={formWebsiteLink}
                    onChange={(e) => setFormWebsiteLink(e.target.value)}
                    placeholder="Contoh: https://kopisenjanusantara.com"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-mono"
                  />
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Keterangan (Catatan Tambahan)
                  </label>
                  <textarea
                    rows={2}
                    value={formNotes}
                    onChange={(e) => setFormNotes(e.target.value)}
                    placeholder="Contoh: Termasuk integrasi checkout WhatsApp, hosting aktif 1 tahun..."
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                {/* Rincian Komponen Biaya (Opsional) */}
                <div className="pt-3 border-t border-gray-100 space-y-2">
                  <div className="flex items-center justify-between">
                    <div>
                      <label className="text-xs font-semibold text-gray-800 block">
                        Rincian Komponen Biaya (Opsional untuk Nota)
                      </label>
                      <p className="text-[10px] text-gray-400">
                        Boleh dikosongkan. Rincikan deliverable agar pada invoice klien dapat melihat apa saja yang dicakup.
                      </p>
                    </div>
                    <button
                      type="button"
                      onClick={() =>
                        setFormCostComponents([
                          ...formCostComponents,
                          {
                            id: `comp-${Date.now()}-${Math.random()}`,
                            name: "",
                            cost: undefined,
                            note: "Termasuk",
                          },
                        ])
                      }
                      className="px-2.5 py-1 text-[11px] font-medium bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg flex items-center gap-1 transition-colors cursor-pointer"
                    >
                      <Plus className="w-3 h-3" />
                      <span>Tambah Item Biaya</span>
                    </button>
                  </div>

                  {formCostComponents.length > 0 && (
                    <div className="space-y-2 mt-2">
                      {formCostComponents.map((comp, idx) => (
                        <div
                          key={comp.id || idx}
                          className="flex items-center gap-2 p-2 bg-gray-50 rounded-lg border border-gray-200 text-xs"
                        >
                          <input
                            type="text"
                            placeholder="Komponen (mis: Cloud Hosting 1 Tahun, Setup Domain)"
                            value={comp.name}
                            onChange={(e) => {
                              const updated = [...formCostComponents];
                              updated[idx].name = e.target.value;
                              setFormCostComponents(updated);
                            }}
                            className="flex-1 p-1.5 bg-white border border-gray-200 rounded text-xs"
                          />
                          <input
                            type="text"
                            placeholder="Keterangan / Biaya (mis: Termasuk)"
                            value={
                              comp.note !== undefined
                                ? comp.note
                                : comp.cost !== undefined
                                ? String(comp.cost)
                                : ""
                            }
                            onChange={(e) => {
                              const updated = [...formCostComponents];
                              const val = e.target.value;
                              if (/^\d+$/.test(val)) {
                                updated[idx].cost = Number(val);
                                updated[idx].note = undefined;
                              } else {
                                updated[idx].note = val;
                                updated[idx].cost = undefined;
                              }
                              setFormCostComponents(updated);
                            }}
                            className="w-36 p-1.5 bg-white border border-gray-200 rounded text-xs font-mono"
                          />
                          <button
                            type="button"
                            onClick={() =>
                              setFormCostComponents(
                                formCostComponents.filter((_, i) => i !== idx)
                              )
                            }
                            className="p-1 text-gray-400 hover:text-red-600 rounded transition-colors"
                            title="Hapus item biaya"
                          >
                            <Trash2 className="w-3.5 h-3.5" />
                          </button>
                        </div>
                      ))}
                    </div>
                  )}
                </div>

                <div className="flex items-center justify-end gap-2 pt-3 border-t border-gray-100">
                  <button
                    type="button"
                    onClick={() => setTxModalOpen(false)}
                    className="px-3.5 py-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 font-medium text-xs rounded-lg transition-colors cursor-pointer"
                  >
                    Batal
                  </button>
                  <button
                    type="submit"
                    className="px-4 py-2 bg-gray-900 hover:bg-black text-white font-medium text-xs rounded-lg transition-colors cursor-pointer"
                  >
                    {editingTxId ? "Simpan Perubahan" : "Simpan Transaksi"}
                  </button>
                </div>
              </form>
            </motion.div>
          </div>
        )}
      </AnimatePresence>

      {/* MODAL: DESIGN INVOICE PROFESIONAL RESMI */}
      <AnimatePresence>
        {invoiceTx && (
          <div className="fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center p-4 print:p-0 print:bg-white print:fixed print:inset-0">
            <motion.div
              initial={{ opacity: 0, scale: 0.96 }}
              animate={{ opacity: 1, scale: 1 }}
              exit={{ opacity: 0, scale: 0.96 }}
              className="bg-white rounded-2xl p-6 sm:p-10 max-w-2xl w-full max-h-[92vh] overflow-y-auto shadow-2xl border border-gray-200 font-sans print:shadow-none print:border-none print:max-w-none print:max-h-none print:p-8"
            >
              {/* Invoice Header */}
              <div className="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-gray-200 gap-4">
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 rounded-xl overflow-hidden border border-gray-200 bg-white flex items-center justify-center flex-shrink-0">
                    <img
                      src={logoSrc}
                      alt="SOLVETA Logo"
                      className="w-full h-full object-contain p-0.5"
                    />
                  </div>
                  <div>
                    <h1 className="text-base font-bold tracking-tight text-gray-950">
                      SOLVETA
                    </h1>
                    <p className="text-[11px] text-gray-500">
                      Solve Technology Agency • www.solveta.site
                    </p>
                  </div>
                </div>

                <div className="text-left sm:text-right">
                  <div className="text-xs uppercase tracking-widest font-extrabold text-gray-400">
                    Official Invoice
                  </div>
                  <div className="font-mono text-sm font-bold text-gray-900 mt-0.5">
                    {invoiceTx.invoiceNumber}
                  </div>
                  <div className="text-[11px] text-gray-500">
                    Tanggal: {formatDateIndo(invoiceTx.date)}
                  </div>
                </div>
              </div>

              {/* Status Stamp Watermark Banner */}
              <div className="my-5 p-4 bg-emerald-50/70 border border-emerald-200 rounded-xl flex items-center justify-between">
                <div className="flex items-center gap-2.5">
                  <div className="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold">
                    ✓
                  </div>
                  <div>
                    <div className="text-xs font-bold text-emerald-950 uppercase tracking-wide">
                      Tanda Pembayaran Lunas &amp; Website Selesai
                    </div>
                    <div className="text-[11px] text-emerald-700">
                      Status Proyek: <strong>{invoiceTx.status.toUpperCase()}</strong> • Seluruh modul siap digunakan
                    </div>
                  </div>
                </div>

                <span className="hidden sm:inline text-xs font-mono font-extrabold text-emerald-800 uppercase px-3 py-1 bg-emerald-100 rounded-lg border border-emerald-300">
                  PAID / LUNAS
                </span>
              </div>

              {/* Client & Project Info */}
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 py-4 text-xs">
                <div className="space-y-1">
                  <div className="text-[11px] font-semibold uppercase text-gray-400 tracking-wider">
                    Ditagihkan Kepada:
                  </div>
                  <div className="font-bold text-gray-950 text-sm">
                    {invoiceTx.customerName}
                  </div>
                  {invoiceTx.phoneNumber && (
                    <div className="text-gray-600 font-mono">
                      WhatsApp: {invoiceTx.phoneNumber}
                    </div>
                  )}
                </div>

                <div className="space-y-1 sm:text-right">
                  <div className="text-[11px] font-semibold uppercase text-gray-400 tracking-wider">
                    Rincian Aset Digital:
                  </div>
                  <div className="font-bold text-gray-900 text-sm">
                    {invoiceTx.websiteName}
                  </div>
                  {invoiceTx.websiteLink && (
                    <div className="font-mono text-gray-600 truncate">
                      {invoiceTx.websiteLink}
                    </div>
                  )}
                </div>
              </div>

              {/* Items Breakdown Table */}
              <div className="mt-4 border border-gray-200 rounded-xl overflow-hidden">
                <table className="w-full text-left border-collapse text-xs">
                  <thead>
                    <tr className="bg-gray-50 border-b border-gray-200 text-gray-500 font-semibold uppercase text-[10px] tracking-wider">
                      <th className="py-2.5 px-4">Deskripsi Layanan &amp; Deliverables</th>
                      <th className="py-2.5 px-4 text-center">Durasi</th>
                      <th className="py-2.5 px-4 text-right">Jumlah (IDR)</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-gray-100">
                    <tr>
                      <td className="py-3 px-4">
                        <div className="font-bold text-gray-900">
                          Jasa Pengembangan Website: {invoiceTx.websiteName}
                        </div>
                        <div className="text-[11px] text-gray-500 mt-0.5">
                          {invoiceTx.notes || "Desain responsif, optimasi performa tinggi, dan integrasi WhatsApp."}
                        </div>
                      </td>
                      <td className="py-3 px-4 text-center text-gray-600">
                        1 Tahun
                      </td>
                      <td className="py-3 px-4 text-right font-bold text-gray-900">
                        {formatIDR(invoiceTx.servicePrice)}
                      </td>
                    </tr>

                    {invoiceTx.costComponents && invoiceTx.costComponents.length > 0 ? (
                      invoiceTx.costComponents.map((comp, idx) => (
                        <tr key={comp.id || idx}>
                          <td className="py-2.5 px-4 text-gray-700">
                            <span className="font-medium">{comp.name}</span>
                            {comp.note && comp.note !== "Termasuk" && (
                              <span className="text-[10px] text-gray-400 block">{comp.note}</span>
                            )}
                          </td>
                          <td className="py-2.5 px-4 text-center text-gray-600">
                            {comp.note && comp.note !== "Termasuk" ? comp.note : "Termasuk"}
                          </td>
                          <td className="py-2.5 px-4 text-right text-emerald-600 font-medium font-mono">
                            {comp.cost && comp.cost > 0 ? formatIDR(comp.cost) : "Termasuk"}
                          </td>
                        </tr>
                      ))
                    ) : (
                      <>
                        <tr>
                          <td className="py-2.5 px-4 text-gray-600">
                            Penyediaan Cloud Server Hosting &amp; SSL Security
                          </td>
                          <td className="py-2.5 px-4 text-center text-gray-600">
                            1 Tahun
                          </td>
                          <td className="py-2.5 px-4 text-right text-emerald-600 font-medium">
                            Termasuk
                          </td>
                        </tr>
                        <tr>
                          <td className="py-2.5 px-4 text-gray-600">
                            Setup Konfigurasi Domain &amp; Garansi Pemeliharaan
                          </td>
                          <td className="py-2.5 px-4 text-center text-gray-600">
                            Aktif
                          </td>
                          <td className="py-2.5 px-4 text-right text-emerald-600 font-medium">
                            Termasuk
                          </td>
                        </tr>
                      </>
                    )}
                  </tbody>
                  <tfoot>
                    <tr className="bg-gray-50 border-t-2 border-gray-200 font-bold text-xs">
                      <td colSpan={2} className="py-3 px-4 text-gray-900 uppercase">
                        Total Pembayaran Resmi
                      </td>
                      <td className="py-3 px-4 text-right text-gray-950 text-sm font-mono font-extrabold">
                        {formatIDR(invoiceTx.servicePrice)}
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>

              {/* Bottom Sign & Verification */}
              <div className="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 text-xs text-gray-500">
                <div>
                  <div className="font-semibold text-gray-800">Catatan &amp; Garansi:</div>
                  <div className="text-[11px] text-gray-500 mt-0.5 max-w-sm">
                    Dokumen ini merupakan bukti sah transaksi pemesanan website di SOLVETA Agency. Layanan mencakup garansi fungsionalitas dan pemeliharaan teknis.
                  </div>
                </div>

                <div className="text-center sm:text-right">
                  <div className="text-[11px] text-gray-400 uppercase tracking-wider">
                    Otorisasi SOLVETA
                  </div>
                  <div className="font-bold text-gray-900 text-xs mt-1">
                    Direktur Operasional Teknis
                  </div>
                  <div className="font-mono text-[10px] text-emerald-700 font-extrabold mt-0.5">
                    [DIGITALLY SIGNED &amp; VERIFIED]
                  </div>
                </div>
              </div>

              {/* Action Buttons (Hidden when printing) */}
              <div className="mt-8 pt-4 border-t border-gray-100 flex items-center justify-between gap-3 print:hidden">
                <a
                  href={getWhatsAppUrl(
                    invoiceTx.phoneNumber,
                    `Halo ${invoiceTx.customerName}, berikut adalah bukti Invoice Resmi ${invoiceTx.invoiceNumber} untuk website ${invoiceTx.websiteName} senilai ${formatIDR(invoiceTx.servicePrice)}. Status: LUNAS & WEBSITE SELESAI. Terima kasih telah mempercayakan proyek kepada SOLVETA!`
                  )}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer"
                >
                  <Share2 className="w-3.5 h-3.5" />
                  <span>Kirim ke WhatsApp Klien</span>
                </a>

                <div className="flex items-center gap-2">
                  <button
                    type="button"
                    onClick={handlePrintInvoice}
                    className="px-4 py-2 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer"
                  >
                    <Printer className="w-3.5 h-3.5" />
                    <span>Cetak / Unduh PDF</span>
                  </button>

                  <button
                    type="button"
                    onClick={() => setInvoiceTx(null)}
                    className="px-3.5 py-2 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-xs font-medium rounded-lg transition-colors cursor-pointer"
                  >
                    Tutup
                  </button>
                </div>
              </div>
            </motion.div>
          </div>
        )}
      </AnimatePresence>
    </div>
  );
};
