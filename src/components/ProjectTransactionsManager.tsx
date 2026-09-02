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
} from "@/context/SiteDataContext";
import { getWhatsAppUrl } from "@/utils/whatsapp";

export const ProjectTransactionsManager: React.FC<{
  showToast: (msg: string) => void;
}> = ({ showToast }) => {
  const {
    data,
    addProjectTransaction,
    editProjectTransaction,
    deleteProjectTransaction,
  } = useSiteData();

  const transactions = data.projectTransactions || [];

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
  const [formServicePrice, setFormServicePrice] = useState<number>(0);
  const [formWebsiteName, setFormWebsiteName] = useState("");
  const [formWebsiteLink, setFormWebsiteLink] = useState("");
  const [formStatus, setFormStatus] = useState<"Terlaksana" | "Progress" | "Batal">("Progress");
  const [formNotes, setFormNotes] = useState("");
  const [selectedSubmissionId, setSelectedSubmissionId] = useState<string>("");
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

  // Select customer brief submission to auto-fill project transaction
  const handleSelectCustomerSubmission = (subId: string) => {
    setSelectedSubmissionId(subId);
    if (!subId) return;

    const sub = (data.orderSubmissions || []).find((s) => s.id === subId);
    if (!sub) return;

    setFormCustomerName(`${sub.fullName} (${sub.brandName})`);
    setFormPhoneNumber(sub.whatsappNumber);
    const domainOrBrand = sub.websiteAndDomainName || sub.brandName;
    setFormWebsiteName(domainOrBrand);
    const link = domainOrBrand.startsWith("http")
      ? domainOrBrand
      : `https://${domainOrBrand.toLowerCase().replace(/\s+/g, "")}`;
    setFormWebsiteLink(link);
    setFormNotes(`[Formulir Customer] Paket: ${sub.selectedPackage} | Kebutuhan: ${sub.websiteType} (${sub.pagesNeeded})`);
    
    // Sesuai permintaan user: harga layanan dibiarkan kosong (0) agar developer sendiri yang mengisi & memerhitungkan!
    setFormServicePrice(0);
    showToast(`Data ${sub.fullName} berhasil ditarik. Silakan tentukan harga layanan.`);
  };

  // Cost component helpers
  const handleAddCostComponentRow = () => {
    setFormCostComponents((prev) => [
      ...prev,
      { id: `comp-${Date.now()}`, name: "", amount: 0, notes: "" },
    ]);
  };

  const handleUpdateCostComponent = (index: number, field: keyof ProjectCostComponent, value: any) => {
    setFormCostComponents((prev) => {
      const updated = [...prev];
      updated[index] = { ...updated[index], [field]: value };
      return updated;
    });
  };

  const handleRemoveCostComponentRow = (index: number) => {
    setFormCostComponents((prev) => prev.filter((_, i) => i !== index));
  };

  const applyCostTemplate = (pkg: "basic" | "standard" | "premium") => {
    if (pkg === "basic") {
      setFormCostComponents([
        { id: `c-${Date.now()}-1`, name: "Domain .my.id / Subdomain 1 Tahun", amount: 30000, notes: "DNS Aktif" },
        { id: `c-${Date.now()}-2`, name: "Hosting Server Cloud 1 Tahun", amount: 60000, notes: "SSD NVMe + SSL" },
        { id: `c-${Date.now()}-3`, name: "Jasa Pembuatan Landing Page & Mobile Responsive", amount: 75000, notes: "1 Halaman" },
        { id: `c-${Date.now()}-4`, name: "Support Teknis & Integrasi WhatsApp", amount: 15000 },
      ]);
    } else if (pkg === "standard") {
      setFormCostComponents([
        { id: `c-${Date.now()}-1`, name: "Domain .com / .id Resmi 1 Tahun", amount: 50000, notes: "Full Control" },
        { id: `c-${Date.now()}-2`, name: "Cloud Server Hosting Dedicated 1 Tahun", amount: 100000, notes: "High Speed SSD" },
        { id: `c-${Date.now()}-3`, name: "Pengembangan Website Hingga 5 Halaman & SEO", amount: 199000 },
        { id: `c-${Date.now()}-4`, name: "1 Akun Email Bisnis (nama@domain.com)", amount: 20000 },
        { id: `c-${Date.now()}-5`, name: "Customer Service & Pendampingan Konten", amount: 20000 },
      ]);
    } else if (pkg === "premium") {
      setFormCostComponents([
        { id: `c-${Date.now()}-1`, name: "Domain Internasional / Nasional TLD 1 Tahun", amount: 50000 },
        { id: `c-${Date.now()}-2`, name: "Cloud VPS Server High Traffic 1 Tahun", amount: 150000 },
        { id: `c-${Date.now()}-3`, name: "Pengembangan Website Kompleks / Custom Web Apps", amount: 405000 },
        { id: `c-${Date.now()}-4`, name: "Optimasi Kecepatan 3x & Integrasi API WhatsApp", amount: 25000 },
        { id: `c-${Date.now()}-5`, name: "Full Garansi Pemeliharaan & Backup Mingguan", amount: 50000 },
      ]);
    }
  };

  // Open Create Modal
  const handleOpenCreate = () => {
    setEditingTxId(null);
    setFormDate(new Date().toISOString().slice(0, 10));
    setFormCustomerName("");
    setFormPhoneNumber("");
    setFormServicePrice(0); // Kosong / 0 agar developer mengisi sendiri!
    setFormWebsiteName("");
    setFormWebsiteLink("");
    setFormStatus("Progress");
    setFormNotes("");
    setSelectedSubmissionId("");
    setFormCostComponents([]);
    setTxModalOpen(true);
  };

  // Open Edit Modal
  const handleOpenEdit = (t: ProjectTransactionRecord) => {
    setEditingTxId(t.id);
    setFormDate(t.date);
    setFormCustomerName(t.customerName);
    setFormPhoneNumber(t.phoneNumber);
    setFormServicePrice(t.servicePrice || 0);
    setFormWebsiteName(t.websiteName);
    setFormWebsiteLink(t.websiteLink);
    setFormStatus(t.status);
    setFormNotes(t.notes || "");
    setSelectedSubmissionId(t.submissionId || "");
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

    // Filter cost components with valid name
    const validCostComponents = formCostComponents.filter((c) => c.name.trim().length > 0);

    if (editingTxId) {
      editProjectTransaction(editingTxId, {
        date: formDate,
        customerName: formCustomerName.trim(),
        phoneNumber: formPhoneNumber.trim(),
        servicePrice: Number(formServicePrice) || 0,
        websiteName: formWebsiteName.trim(),
        websiteLink: formWebsiteLink.trim(),
        status: formStatus,
        notes: formNotes.trim(),
        costComponents: validCostComponents,
        submissionId: selectedSubmissionId || undefined,
      });
      showToast("Data proyek berhasil diperbarui!");
    } else {
      addProjectTransaction({
        date: formDate,
        customerName: formCustomerName.trim(),
        phoneNumber: formPhoneNumber.trim(),
        servicePrice: Number(formServicePrice) || 0,
        websiteName: formWebsiteName.trim(),
        websiteLink: formWebsiteLink.trim() || `https://${formWebsiteName.toLowerCase().replace(/\s+/g, "")}.solveta.site`,
        status: formStatus,
        notes: formNotes.trim(),
        invoiceNumber: generatedInvoiceNumber,
        costComponents: validCostComponents,
        submissionId: selectedSubmissionId || undefined,
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

  const logoSrc = data.siteCopy.siteLogo || "/images/logo.png";

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
                    <td className="py-3 px-4 whitespace-nowrap">
                      {tx.servicePrice > 0 ? (
                        <div>
                          <span className="font-semibold text-gray-900 font-mono">
                            {formatIDR(tx.servicePrice)}
                          </span>
                          {tx.costComponents && tx.costComponents.length > 0 && (
                            <span className="block text-[10px] text-gray-400 font-normal">
                              {tx.costComponents.length} rincian komponen
                            </span>
                          )}
                        </div>
                      ) : (
                        <button
                          type="button"
                          onClick={() => handleOpenEdit(tx)}
                          className="px-2 py-0.5 rounded text-[10px] font-semibold bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100 transition-colors flex items-center gap-1 cursor-pointer"
                          title="Klik untuk mengisi harga layanan & rincian biaya"
                        >
                          <Edit className="w-2.5 h-2.5" />
                          <span>Isi Harga (Rp 0)</span>
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
                        <option value="Progress">Progress</option>
                        <option value="Terlaksana">Terlaksana</option>
                        <option value="Batal">Batal</option>
                      </select>
                    </td>
                    <td className="py-3 px-4 text-gray-500 max-w-[200px] truncate text-[11px]">
                      {tx.notes || "-"}
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
              className="bg-white rounded-xl p-6 max-w-lg w-full max-h-[90vh] overflow-y-auto shadow-xl border border-gray-200/80 font-sans"
            >
              <h3 className="text-sm font-semibold text-gray-900 mb-0.5">
                {editingTxId ? "Edit Transaksi Proyek" : "Catat Transaksi Proyek Baru"}
              </h3>
              <p className="text-xs text-gray-400 mb-4">
                Lengkapi rincian tanggal, nama pelanggan, website, harga layanan, dan rincian komponen biaya.
              </p>

              <form onSubmit={handleSaveTx} className="space-y-3.5 text-xs">
                {/* 1. Tarik Otomatis dari Formulir Customer */}
                {(data.orderSubmissions || []).length > 0 && !editingTxId && (
                  <div className="p-3 bg-gray-50 rounded-lg border border-gray-200/80 space-y-1.5">
                    <label className="block text-[11px] font-semibold text-gray-700">
                      Tarik Otomatis dari Formulir Customer (Khusus Pelanggan Terkait)
                    </label>
                    <select
                      value={selectedSubmissionId}
                      onChange={(e) => handleSelectCustomerSubmission(e.target.value)}
                      className="w-full text-xs p-2 rounded-md border border-gray-200 bg-white font-medium text-gray-900 outline-none"
                    >
                      <option value="">-- Pilih Data Formulir Customer (Opsional) --</option>
                      {(data.orderSubmissions || []).map((s) => (
                        <option key={s.id} value={s.id}>
                          {s.fullName} — {s.brandName} ({s.selectedPackage})
                        </option>
                      ))}
                    </select>
                    <p className="text-[10px] text-gray-400">
                      * Identitas &amp; nama web terisi otomatis. Harga layanan sengaja dikosongkan agar Anda dapat mengisi sendiri.
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
                      className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-mono"
                    />
                  </div>

                  <div>
                    <label className="block font-medium text-gray-700 mb-1">
                      Harga Layanan (Rp)
                    </label>
                    <input
                      type="number"
                      min="0"
                      step="1000"
                      value={formServicePrice === 0 ? "" : formServicePrice}
                      onChange={(e) => setFormServicePrice(Number(e.target.value) || 0)}
                      placeholder="0 (Diisi oleh developer)"
                      className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-mono"
                    />
                    <span className="text-[10px] text-gray-400 block mt-0.5">
                      {formServicePrice > 0 ? formatIDR(formServicePrice) : "Kosongkan/0 jika belum fix"}
                    </span>
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

                {/* 2. RINCIAN KOMPONEN BIAYA (OPSIONAL UNTUK NOTA / INVOICE) */}
                <div className="pt-3 border-t border-gray-100 space-y-2.5">
                  <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5">
                    <div>
                      <div className="font-semibold text-gray-900 text-xs">
                        Rincian Komponen Biaya (Opsional)
                      </div>
                      <p className="text-[10px] text-gray-400">
                        Isi manual rincian biaya yang include agar di nota pelanggan tahu mencakup apa saja. Boleh dikosongkan.
                      </p>
                    </div>
                    <button
                      type="button"
                      onClick={handleAddCostComponentRow}
                      className="px-2.5 py-1 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 text-xs font-medium rounded-md transition-colors flex items-center gap-1 cursor-pointer flex-shrink-0 self-start sm:self-auto"
                    >
                      <Plus className="w-3 h-3" />
                      <span>+ Tambah Biaya</span>
                    </button>
                  </div>

                  {/* Template Cepat */}
                  <div className="flex flex-wrap items-center gap-1.5 text-[10px] bg-gray-50 p-2 rounded-lg border border-gray-100">
                    <span className="text-gray-500 font-medium">Template Cepat:</span>
                    <button
                      type="button"
                      onClick={() => applyCostTemplate("basic")}
                      className="px-2 py-0.5 bg-white border border-gray-200 hover:border-gray-900 text-gray-700 rounded transition-colors cursor-pointer"
                    >
                      Paket Basic
                    </button>
                    <button
                      type="button"
                      onClick={() => applyCostTemplate("standard")}
                      className="px-2 py-0.5 bg-white border border-gray-200 hover:border-gray-900 text-gray-700 rounded transition-colors cursor-pointer"
                    >
                      Paket Standard
                    </button>
                    <button
                      type="button"
                      onClick={() => applyCostTemplate("premium")}
                      className="px-2 py-0.5 bg-white border border-gray-200 hover:border-gray-900 text-gray-700 rounded transition-colors cursor-pointer"
                    >
                      Paket Premium
                    </button>
                  </div>

                  {/* Component Rows */}
                  {formCostComponents.length === 0 ? (
                    <div className="p-2.5 text-center text-gray-400 border border-dashed border-gray-200 rounded-lg text-[11px]">
                      Belum ada rincian komponen biaya. (Dikosongi pun tidak apa-apa, nota akan menampilkan ringkasan all-in).
                    </div>
                  ) : (
                    <div className="space-y-1.5 max-h-48 overflow-y-auto pr-1">
                      {formCostComponents.map((comp, idx) => (
                        <div key={comp.id || idx} className="flex items-center gap-2">
                          <input
                            type="text"
                            value={comp.name}
                            onChange={(e) => handleUpdateCostComponent(idx, "name", e.target.value)}
                            placeholder="Komponen (cth: Hosting Cloud NVMe 1 Th)"
                            className="flex-1 text-xs p-2 rounded-lg border border-gray-200 bg-white"
                          />
                          <input
                            type="number"
                            value={comp.amount ? comp.amount : ""}
                            onChange={(e) => handleUpdateCostComponent(idx, "amount", Number(e.target.value) || 0)}
                            placeholder="Biaya Rp (opsional)"
                            className="w-28 text-xs p-2 rounded-lg border border-gray-200 bg-white font-mono"
                          />
                          <button
                            type="button"
                            onClick={() => handleRemoveCostComponentRow(idx)}
                            className="p-1.5 text-gray-400 hover:text-red-600 rounded hover:bg-red-50 transition-colors cursor-pointer"
                            title="Hapus baris"
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
                      <th className="py-2.5 px-4 text-center">Durasi / Status</th>
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
                      <td className="py-3 px-4 text-right font-bold text-gray-900 font-mono">
                        {invoiceTx.servicePrice > 0 ? formatIDR(invoiceTx.servicePrice) : "Sesuai Kesepakatan"}
                      </td>
                    </tr>

                    {/* Rincian Komponen Biaya (Jika diisi oleh developer) */}
                    {invoiceTx.costComponents && invoiceTx.costComponents.length > 0 ? (
                      <>
                        <tr className="bg-gray-50/70">
                          <td colSpan={3} className="py-2 px-4 text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                            Rincian Komponen Biaya yang Termasuk (Include dalam Layanan):
                          </td>
                        </tr>
                        {invoiceTx.costComponents.map((comp, cIdx) => (
                          <tr key={comp.id || cIdx} className="text-gray-700 bg-white">
                            <td className="py-2.5 px-4 pl-6">
                              <div className="flex items-center gap-2">
                                <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 flex-shrink-0"></span>
                                <span className="font-medium text-gray-800">{comp.name}</span>
                              </div>
                              {comp.notes && (
                                <div className="text-[10px] text-gray-400 pl-3.5 mt-0.5">
                                  {comp.notes}
                                </div>
                              )}
                            </td>
                            <td className="py-2.5 px-4 text-center text-emerald-600 font-medium text-[11px]">
                              Termasuk
                            </td>
                            <td className="py-2.5 px-4 text-right font-mono text-gray-600 text-xs">
                              {comp.amount && comp.amount > 0 ? formatIDR(comp.amount) : "Include"}
                            </td>
                          </tr>
                        ))}
                      </>
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
                        {invoiceTx.servicePrice > 0 ? formatIDR(invoiceTx.servicePrice) : "Sesuai Kesepakatan"}
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
