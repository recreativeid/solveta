"use client";

import React, { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import {
  DollarSign,
  TrendingUp,
  Plus,
  Trash2,
  Edit3,
  Check,
  ChevronDown,
  ChevronUp,
  AlertCircle,
  HelpCircle,
  Download,
  Server,
  Code2,
  Wrench,
  ShieldCheck,
  Zap,
  Tag,
  ArrowUpRight,
  Info,
  Layers,
} from "lucide-react";
import {
  useSiteData,
  ServiceProfitAnalysis,
  ServiceCostItem,
} from "@/context/SiteDataContext";

export const ProfitLossManager: React.FC<{ showToast: (msg: string) => void }> = ({
  showToast,
}) => {
  const {
    data,
    updateProfitAnalysis,
    addServiceProfitItem,
    editServiceProfitItem,
    deleteServiceProfitItem,
    addCostToService,
    removeCostFromService,
    editCostInService,
  } = useSiteData();

  const analyses: ServiceProfitAnalysis[] =
    data.profitAnalysis && data.profitAnalysis.length > 0
      ? data.profitAnalysis
      : [];

  // Expanded row for accordion cost details
  const [expandedServiceId, setExpandedServiceId] = useState<string | null>(
    analyses.length > 0 ? analyses[0].id : null
  );

  // Modal State for Adding / Editing Cost Item
  const [costModalOpen, setCostModalOpen] = useState(false);
  const [selectedServiceId, setSelectedServiceId] = useState<string | null>(null);
  const [costName, setCostName] = useState("");
  const [costCategory, setCostCategory] = useState<ServiceCostItem["category"]>(
    "infrastruktur"
  );
  const [costAmount, setCostAmount] = useState<number>(50000);
  const [costNotes, setCostNotes] = useState("");

  // Modal State for Adding New Service Package to Profit Analysis
  const [serviceModalOpen, setServiceModalOpen] = useState(false);
  const [newServiceName, setNewServiceName] = useState("");
  const [newSellingPrice, setNewSellingPrice] = useState<number>(999000);
  const [newLaborFee, setNewLaborFee] = useState<number>(250000);
  const [newEstimatedOrders, setNewEstimatedOrders] = useState<number>(5);
  const [newServiceNotes, setNewServiceNotes] = useState("");

  // Formatting Helpers
  const formatIDR = (val: number) => {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      maximumFractionDigits: 0,
    }).format(val || 0);
  };

  // Calculations for an individual service
  const calculateServiceMetrics = (service: ServiceProfitAnalysis) => {
    const totalCosts = (service.costs || []).reduce((acc, c) => acc + (c.amount || 0), 0);
    const netProfit = (service.sellingPrice || 0) - totalCosts;
    const marginPercent =
      service.sellingPrice > 0
        ? Math.round((netProfit / service.sellingPrice) * 100)
        : 0;
    const monthlyOrders = service.estimatedMonthlyOrders || 1;
    const monthlyRevenue = (service.sellingPrice || 0) * monthlyOrders;
    const monthlyCosts = totalCosts * monthlyOrders;
    const monthlyNetProfit = netProfit * monthlyOrders;

    return {
      totalCosts,
      netProfit,
      marginPercent,
      monthlyOrders,
      monthlyRevenue,
      monthlyCosts,
      monthlyNetProfit,
    };
  };

  // Global Executive Summary Totals
  const summary = analyses.reduce(
    (acc, curr) => {
      const metrics = calculateServiceMetrics(curr);
      acc.totalMonthlyRevenue += metrics.monthlyRevenue;
      acc.totalMonthlyCosts += metrics.monthlyCosts;
      acc.totalMonthlyNetProfit += metrics.monthlyNetProfit;
      return acc;
    },
    { totalMonthlyRevenue: 0, totalMonthlyCosts: 0, totalMonthlyNetProfit: 0 }
  );

  const averageMargin =
    summary.totalMonthlyRevenue > 0
      ? Math.round(
          (summary.totalMonthlyNetProfit / summary.totalMonthlyRevenue) * 100
        )
      : 0;

  // Category Icon & Label Helper
  const getCategoryInfo = (cat: ServiceCostItem["category"]) => {
    switch (cat) {
      case "infrastruktur":
        return { label: "Infrastruktur & Server", icon: Server, color: "text-blue-600 bg-blue-50 border-blue-200" };
      case "tenaga_kerja":
        return { label: "Tenaga Kerja / Fee Dev", icon: Code2, color: "text-purple-600 bg-purple-50 border-purple-200" };
      case "lisensi_tools":
        return { label: "Lisensi Tools & Aset", icon: Wrench, color: "text-amber-600 bg-amber-50 border-amber-200" };
      case "operasional":
        return { label: "Operasional & Support", icon: ShieldCheck, color: "text-emerald-600 bg-emerald-50 border-emerald-200" };
      default:
        return { label: "Biaya Lainnya", icon: Layers, color: "text-gray-600 bg-gray-50 border-gray-200" };
    }
  };

  // Handle Quick Add Cost
  const handleOpenAddCost = (serviceId: string) => {
    setSelectedServiceId(serviceId);
    setCostName("");
    setCostCategory("infrastruktur");
    setCostAmount(50000);
    setCostNotes("");
    setCostModalOpen(true);
  };

  const handleSaveCost = (e: React.FormEvent) => {
    e.preventDefault();
    if (!selectedServiceId || !costName.trim()) {
      alert("Masukkan nama komponen beban biaya!");
      return;
    }

    addCostToService(selectedServiceId, {
      name: costName.trim(),
      category: costCategory,
      amount: Number(costAmount) || 0,
      notes: costNotes.trim() || undefined,
    });

    setCostModalOpen(false);
    showToast(`Komponen beban "${costName}" berhasil ditambahkan!`);
  };

  // Handle Create New Service Analysis
  const handleSaveNewService = (e: React.FormEvent) => {
    e.preventDefault();
    if (!newServiceName.trim()) {
      alert("Masukkan nama layanan / paket!");
      return;
    }

    addServiceProfitItem({
      serviceName: newServiceName.trim(),
      sellingPrice: Number(newSellingPrice) || 0,
      laborFee: Number(newLaborFee) || 0,
      estimatedMonthlyOrders: Number(newEstimatedOrders) || 1,
      notes: newServiceNotes.trim() || undefined,
      costs: [
        {
          id: `c-${Date.now()}-1`,
          name: "Domain & Server Cloud",
          category: "infrastruktur",
          amount: Math.round(newSellingPrice * 0.15),
        },
        {
          id: `c-${Date.now()}-2`,
          name: "Biaya Tenaga Kerja / Fee",
          category: "tenaga_kerja",
          amount: Number(newLaborFee) || Math.round(newSellingPrice * 0.25),
        },
      ],
    });

    setServiceModalOpen(false);
    setNewServiceName("");
    setNewSellingPrice(999000);
    setNewLaborFee(250000);
    showToast(`Layanan "${newServiceName}" berhasil ditambahkan ke kalkulator!`);
  };

  // Export Financial Summary to CSV
  const handleExportCSV = () => {
    const headers = [
      "Nama Layanan",
      "Harga Jual (Rp)",
      "Total Beban HPP (Rp)",
      "Laba Bersih (Rp)",
      "Margin (%)",
      "Estimasi Order/Bulan",
      "Proyeksi Laba Bulanan (Rp)",
    ];

    const rows = analyses.map((s) => {
      const m = calculateServiceMetrics(s);
      return [
        `"${s.serviceName}"`,
        s.sellingPrice,
        m.totalCosts,
        m.netProfit,
        `${m.marginPercent}%`,
        m.monthlyOrders,
        m.monthlyNetProfit,
      ].join(",");
    });

    const csvContent = "data:text/csv;charset=utf-8," + [headers.join(","), ...rows].join("\n");
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", `Laporan_Laba_Rugi_Solveta_${new Date().toISOString().slice(0, 10)}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    showToast("Laporan Laba Rugi berhasil diekspor ke CSV!");
  };

  return (
    <div className="space-y-6 bg-white">
      {/* 1. FINANCIAL EXECUTIVE SUMMARY CARDS */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {/* Metric 1: Estimasi Omset Bulanan */}
        <div className="p-5 bg-gradient-to-br from-gray-900 to-gray-800 text-white rounded-2xl shadow-sm border border-gray-700 relative overflow-hidden">
          <div className="flex items-center justify-between text-gray-400 mb-2">
            <span className="text-xs font-semibold uppercase tracking-wider">
              Estimasi Omset / Bulan
            </span>
            <div className="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-emerald-400">
              <TrendingUp className="w-4 h-4" />
            </div>
          </div>
          <div className="text-xl sm:text-2xl font-black text-white tracking-tight">
            {formatIDR(summary.totalMonthlyRevenue)}
          </div>
          <p className="text-[11px] text-gray-400 mt-2">
            Akumulasi target seluruh paket layanan
          </p>
        </div>

        {/* Metric 2: Total Beban Pokok & Operasional */}
        <div className="p-5 bg-white rounded-2xl shadow-xs border border-gray-200">
          <div className="flex items-center justify-between text-gray-500 mb-2">
            <span className="text-xs font-semibold uppercase tracking-wider">
              Total Beban / HPP Bulan Ini
            </span>
            <div className="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center text-[#8B0021]">
              <DollarSign className="w-4 h-4" />
            </div>
          </div>
          <div className="text-xl sm:text-2xl font-black text-gray-900 tracking-tight">
            {formatIDR(summary.totalMonthlyCosts)}
          </div>
          <p className="text-[11px] text-gray-500 mt-2">
            Domain, server, tools &amp; tenaga kerja
          </p>
        </div>

        {/* Metric 3: Total Laba Bersih Bulanan */}
        <div className="p-5 bg-emerald-50/70 border border-emerald-200 rounded-2xl shadow-xs">
          <div className="flex items-center justify-between text-emerald-800 mb-2">
            <span className="text-xs font-bold uppercase tracking-wider">
              Proyeksi Laba Bersih (Net Profit)
            </span>
            <div className="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center shadow-xs">
              <Zap className="w-4 h-4" />
            </div>
          </div>
          <div className="text-xl sm:text-2xl font-black text-emerald-950 tracking-tight">
            {formatIDR(summary.totalMonthlyNetProfit)}
          </div>
          <p className="text-[11px] text-emerald-700 font-medium mt-2">
            Uang bersih yang masuk ke kas bisnis
          </p>
        </div>

        {/* Metric 4: Rata-Rata Margin Keuntungan */}
        <div className="p-5 bg-white rounded-2xl shadow-xs border border-gray-200">
          <div className="flex items-center justify-between text-gray-500 mb-2">
            <span className="text-xs font-semibold uppercase tracking-wider">
              Rata-rata Margin Bersih
            </span>
            <div className="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600">
              <ArrowUpRight className="w-4 h-4" />
            </div>
          </div>
          <div className="text-xl sm:text-2xl font-black text-gray-900 tracking-tight flex items-center gap-2">
            <span>{averageMargin}%</span>
            <span
              className={`text-xs px-2 py-0.5 rounded-full font-bold ${
                averageMargin >= 40
                  ? "bg-emerald-100 text-emerald-800"
                  : averageMargin >= 20
                  ? "bg-amber-100 text-amber-800"
                  : "bg-rose-100 text-rose-800"
              }`}
            >
              {averageMargin >= 40 ? "Sangat Sehat" : averageMargin >= 20 ? "Standar" : "Perlu Optimasi"}
            </span>
          </div>
          <p className="text-[11px] text-gray-500 mt-2">
            Persentase keuntungan bersih rata-rata
          </p>
        </div>
      </div>

      {/* 2. TABEL PERHITUNGAN LABA RUGI & RINCIAN KOMPONEN BEBAN */}
      <div className="bg-white border border-gray-200 rounded-2xl shadow-xs overflow-hidden">
        {/* Table Header Bar */}
        <div className="p-5 sm:p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-50/50">
          <div>
            <h2 className="text-sm sm:text-base font-extrabold text-gray-950 flex items-center gap-2">
              <DollarSign className="w-5 h-5 text-[#8B0021]" />
              <span>Tabel Rincian Komponen Biaya &amp; Margin Bersih Tiap Layanan</span>
            </h2>
            <p className="text-xs text-gray-500 mt-1">
              Klik pada baris paket untuk membuka rincian komponen beban atau menambahkan biaya kustom baru.
            </p>
          </div>

          <div className="flex items-center gap-2 flex-wrap">
            <button
              type="button"
              onClick={handleExportCSV}
              className="px-3 py-2 bg-white hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-xl border border-gray-300 shadow-2xs flex items-center gap-1.5 transition-colors cursor-pointer"
            >
              <Download className="w-3.5 h-3.5" />
              <span>Ekspor CSV</span>
            </button>

            <button
              type="button"
              onClick={() => setServiceModalOpen(true)}
              className="px-4 py-2 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white text-xs font-bold rounded-xl shadow-xs flex items-center gap-1.5 transition-all cursor-pointer"
            >
              <Plus className="w-4 h-4" />
              <span>+ Tambah Layanan Baru</span>
            </button>
          </div>
        </div>

        {/* Table Body */}
        <div className="overflow-x-auto">
          <table className="w-full text-left text-xs border-collapse">
            <thead>
              <tr className="border-b border-gray-200 bg-gray-100/70 text-gray-600 font-bold uppercase tracking-wider text-[11px]">
                <th className="py-3.5 px-4">Nama Layanan / Paket</th>
                <th className="py-3.5 px-4 text-right">Harga Jual (Revenue)</th>
                <th className="py-3.5 px-4 text-right">Total Beban (HPP)</th>
                <th className="py-3.5 px-4 text-right">Laba Bersih / Unit</th>
                <th className="py-3.5 px-4 text-center">Margin (%)</th>
                <th className="py-3.5 px-4 text-center">Estimasi Order/Bln</th>
                <th className="py-3.5 px-4 text-right">Proyeksi Laba/Bln</th>
                <th className="py-3.5 px-4 text-center">Rincian Beban</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-100 font-medium">
              {analyses.map((service) => {
                const metrics = calculateServiceMetrics(service);
                const isExpanded = expandedServiceId === service.id;

                return (
                  <React.Fragment key={service.id}>
                    <tr
                      onClick={() =>
                        setExpandedServiceId(isExpanded ? null : service.id)
                      }
                      className={`hover:bg-rose-50/40 transition-colors cursor-pointer ${
                        isExpanded ? "bg-rose-50/30" : ""
                      }`}
                    >
                      {/* 1. Nama Layanan */}
                      <td className="py-4 px-4">
                        <div className="flex items-center gap-2">
                          <div className="w-2 h-2 rounded-full bg-[#8B0021]" />
                          <div>
                            <span className="font-extrabold text-gray-950 text-sm block">
                              {service.serviceName}
                            </span>
                            {service.notes && (
                              <span className="text-[11px] text-gray-400 block line-clamp-1">
                                {service.notes}
                              </span>
                            )}
                          </div>
                        </div>
                      </td>

                      {/* 2. Harga Jual */}
                      <td className="py-4 px-4 text-right font-bold text-gray-900">
                        {formatIDR(service.sellingPrice)}
                      </td>

                      {/* 3. Total Beban HPP */}
                      <td className="py-4 px-4 text-right font-bold text-rose-600">
                        {formatIDR(metrics.totalCosts)}
                      </td>

                      {/* 4. Laba Bersih */}
                      <td className="py-4 px-4 text-right font-extrabold text-emerald-600">
                        {formatIDR(metrics.netProfit)}
                      </td>

                      {/* 5. Margin Badge */}
                      <td className="py-4 px-4 text-center">
                        <span
                          className={`inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-extrabold ${
                            metrics.marginPercent >= 45
                              ? "bg-emerald-100 text-emerald-800 border border-emerald-200"
                              : metrics.marginPercent >= 20
                              ? "bg-amber-100 text-amber-800 border border-amber-200"
                              : "bg-rose-100 text-rose-800 border border-rose-200"
                          }`}
                        >
                          {metrics.marginPercent}%
                        </span>
                      </td>

                      {/* 6. Estimasi Order / Bulan */}
                      <td className="py-4 px-4 text-center font-mono font-bold text-gray-700">
                        {metrics.monthlyOrders} proyek
                      </td>

                      {/* 7. Proyeksi Laba Bulanan */}
                      <td className="py-4 px-4 text-right font-black text-gray-950">
                        {formatIDR(metrics.monthlyNetProfit)}
                      </td>

                      {/* 8. Accordion Toggle */}
                      <td className="py-4 px-4 text-center">
                        <button
                          type="button"
                          className="p-1 text-gray-400 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition-colors"
                        >
                          {isExpanded ? (
                            <ChevronUp className="w-4 h-4 text-[#8B0021]" />
                          ) : (
                            <ChevronDown className="w-4 h-4" />
                          )}
                        </button>
                      </td>
                    </tr>

                    {/* EXPANDED ACCORDION: DETAIL KOMPONEN BEBAN & EDITING */}
                    {isExpanded && (
                      <tr className="bg-gray-50/90 border-b border-gray-200">
                        <td colSpan={8} className="p-5 sm:p-6">
                          <div className="space-y-4 max-w-4xl">
                            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-gray-200 pb-3">
                              <div>
                                <h3 className="text-xs font-bold text-gray-900 uppercase tracking-wider flex items-center gap-1.5">
                                  <span>📦 Komponen Beban Biaya:</span>
                                  <span className="text-[#8B0021]">{service.serviceName}</span>
                                </h3>
                                <p className="text-[11px] text-gray-500">
                                  Tambahkan atau sesuaikan beban infrastruktur, lisensi, dan biaya tenaga kerja untuk paket ini.
                                </p>
                              </div>

                              <div className="flex items-center gap-2">
                                <button
                                  type="button"
                                  onClick={() => handleOpenAddCost(service.id)}
                                  className="px-3 py-1.5 bg-[#8B0021] hover:bg-[#a30026] text-white text-xs font-bold rounded-lg shadow-2xs flex items-center gap-1 transition-colors cursor-pointer"
                                >
                                  <Plus className="w-3.5 h-3.5" />
                                  <span>+ Tambah Komponen Beban</span>
                                </button>

                                <button
                                  type="button"
                                  onClick={() => {
                                    if (confirm(`Hapus layanan "${service.serviceName}" dari analisis laba rugi?`)) {
                                      deleteServiceProfitItem(service.id);
                                      showToast("Layanan berhasil dihapus dari analisis!");
                                    }
                                  }}
                                  className="p-1.5 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-white border border-transparent hover:border-gray-200 transition-colors cursor-pointer"
                                  title="Hapus Layanan Ini"
                                >
                                  <Trash2 className="w-3.5 h-3.5" />
                                </button>
                              </div>
                            </div>

                            {/* Quick Editor for Selling Price & Monthly Target */}
                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-white p-4 rounded-xl border border-gray-200 shadow-2xs">
                              <div>
                                <label className="block text-[11px] font-bold text-gray-700 mb-1">
                                  💵 Harga Jual Layanan (Rp):
                                </label>
                                <input
                                  type="number"
                                  value={service.sellingPrice}
                                  onChange={(e) =>
                                    editServiceProfitItem(service.id, {
                                      sellingPrice: Number(e.target.value) || 0,
                                    })
                                  }
                                  className="w-full text-xs font-bold text-gray-900 p-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none"
                                />
                              </div>

                              <div>
                                <label className="block text-[11px] font-bold text-gray-700 mb-1">
                                  🎯 Estimasi Order per Bulan (Proyek):
                                </label>
                                <input
                                  type="number"
                                  min="1"
                                  max="100"
                                  value={service.estimatedMonthlyOrders || 1}
                                  onChange={(e) =>
                                    editServiceProfitItem(service.id, {
                                      estimatedMonthlyOrders: Number(e.target.value) || 1,
                                    })
                                  }
                                  className="w-full text-xs font-bold text-gray-900 p-2.5 rounded-lg border border-gray-300 focus:border-[#7B0B1E] outline-none"
                                />
                              </div>
                            </div>

                            {/* List of Cost Items */}
                            <div className="space-y-2">
                              {(!service.costs || service.costs.length === 0) && (
                                <p className="text-xs text-gray-400 italic py-2">
                                  Belum ada komponen beban untuk paket ini. Klik tombol "+ Tambah Komponen Beban" di atas.
                                </p>
                              )}

                              {service.costs?.map((cost) => {
                                const catInfo = getCategoryInfo(cost.category);
                                const CatIcon = catInfo.icon;

                                return (
                                  <div
                                    key={cost.id}
                                    className="flex items-center justify-between p-3 bg-white rounded-xl border border-gray-200 hover:border-gray-300 transition-all shadow-2xs"
                                  >
                                    <div className="flex items-center gap-3">
                                      <div className={`w-7 h-7 rounded-lg flex items-center justify-center border ${catInfo.color}`}>
                                        <CatIcon className="w-3.5 h-3.5" />
                                      </div>
                                      <div>
                                        <span className="font-bold text-xs text-gray-900 block">
                                          {cost.name}
                                        </span>
                                        <span className="text-[10px] text-gray-400 block font-mono">
                                          {catInfo.label}
                                        </span>
                                      </div>
                                    </div>

                                    <div className="flex items-center gap-4">
                                      <span className="font-mono font-bold text-xs text-rose-600">
                                        {formatIDR(cost.amount)}
                                      </span>

                                      <button
                                        type="button"
                                        onClick={() => {
                                          removeCostFromService(service.id, cost.id);
                                          showToast(`Komponen beban "${cost.name}" berhasil dihapus.`);
                                        }}
                                        className="p-1 text-gray-400 hover:text-rose-600 rounded-md hover:bg-gray-100 transition-colors"
                                        title="Hapus Beban"
                                      >
                                        <Trash2 className="w-3.5 h-3.5" />
                                      </button>
                                    </div>
                                  </div>
                                );
                              })}
                            </div>

                            {/* Subtotal Calculation Card inside Accordion */}
                            <div className="p-3.5 bg-rose-50/70 border border-rose-100 rounded-xl flex items-center justify-between text-xs">
                              <div>
                                <span className="font-bold text-[#8B0021] block">
                                  💡 Ringkasan Margin Paket Ini:
                                </span>
                                <span className="text-[11px] text-gray-600">
                                  Harga: <strong>{formatIDR(service.sellingPrice)}</strong> - Total Beban: <strong>{formatIDR(metrics.totalCosts)}</strong>
                                </span>
                              </div>
                              <div className="text-right font-black">
                                <span className="text-emerald-700 text-sm block">
                                  + {formatIDR(metrics.netProfit)} / Proyek
                                </span>
                                <span className="text-[11px] text-gray-500 font-mono">
                                  Margin Keuntungan Bersih: <strong>{metrics.marginPercent}%</strong>
                                </span>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    )}
                  </React.Fragment>
                );
              })}
            </tbody>
          </table>
        </div>
      </div>

      {/* 3. MODAL: TAMBAH KOMPONEN BEBAN BIAYA BARU */}
      <AnimatePresence>
        {costModalOpen && (
          <div className="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.95, y: 15 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.95, y: 15 }}
              className="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl border border-gray-200"
            >
              <h3 className="text-sm font-extrabold text-gray-950 mb-1 flex items-center gap-2">
                <Plus className="w-4 h-4 text-[#8B0021]" />
                <span>Tambah Komponen Beban Biaya</span>
              </h3>
              <p className="text-xs text-gray-500 mb-4">
                Masukkan biaya modal, domain, server, atau fee tenaga kerja untuk layanan ini.
              </p>

              <form onSubmit={handleSaveCost} className="space-y-4 text-xs">
                <div>
                  <label className="block font-bold text-gray-800 mb-1">
                    Nama Komponen Biaya:
                  </label>
                  <input
                    type="text"
                    required
                    value={costName}
                    onChange={(e) => setCostName(e.target.value)}
                    placeholder="Contoh: Domain .com 1 Tahun, Fee Freelance Developer"
                    className="w-full text-xs font-bold text-gray-900 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] outline-none"
                  />
                </div>

                <div>
                  <label className="block font-bold text-gray-800 mb-1">
                    Kategori Beban:
                  </label>
                  <select
                    value={costCategory}
                    onChange={(e) =>
                      setCostCategory(e.target.value as ServiceCostItem["category"])
                    }
                    className="w-full text-xs font-bold text-gray-900 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] outline-none bg-white"
                  >
                    <option value="infrastruktur">🌐 Infrastruktur (Domain, Hosting, SSL, CDN)</option>
                    <option value="tenaga_kerja">⚡ Tenaga Kerja / Fee Developer / Desainer</option>
                    <option value="lisensi_tools">🎨 Lisensi Tools, Aset 3D &amp; Font</option>
                    <option value="operasional">🛡️ Operasional, QA &amp; CS Buffer</option>
                    <option value="lainnya">📦 Lain-lain</option>
                  </select>
                </div>

                <div>
                  <label className="block font-bold text-gray-800 mb-1">
                    Nominal Biaya (Rp):
                  </label>
                  <input
                    type="number"
                    required
                    min="0"
                    step="1000"
                    value={costAmount}
                    onChange={(e) => setCostAmount(Number(e.target.value))}
                    className="w-full text-xs font-bold text-gray-900 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] outline-none font-mono"
                  />
                </div>

                <div>
                  <label className="block font-bold text-gray-800 mb-1">
                    Catatan / Keterangan (Opsional):
                  </label>
                  <input
                    type="text"
                    value={costNotes}
                    onChange={(e) => setCostNotes(e.target.value)}
                    placeholder="Contoh: Berlangganan tahunan di Namecheap"
                    className="w-full text-xs font-medium text-gray-900 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] outline-none"
                  />
                </div>

                <div className="flex items-center gap-2 pt-3 border-t border-gray-100">
                  <button
                    type="submit"
                    className="flex-1 py-2.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white font-bold text-xs rounded-xl shadow-xs transition-all cursor-pointer flex items-center justify-center gap-1"
                  >
                    <Check className="w-4 h-4" />
                    <span>Simpan Komponen Biaya</span>
                  </button>
                  <button
                    type="button"
                    onClick={() => setCostModalOpen(false)}
                    className="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs rounded-xl transition-colors cursor-pointer"
                  >
                    Batal
                  </button>
                </div>
              </form>
            </motion.div>
          </div>
        )}
      </AnimatePresence>

      {/* 4. MODAL: TAMBAH LAYANAN BARU KE KALKULATOR */}
      <AnimatePresence>
        {serviceModalOpen && (
          <div className="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.95, y: 15 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.95, y: 15 }}
              className="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl border border-gray-200"
            >
              <h3 className="text-sm font-extrabold text-gray-950 mb-1 flex items-center gap-2">
                <Plus className="w-4 h-4 text-[#8B0021]" />
                <span>Tambah Layanan / Paket Baru</span>
              </h3>
              <p className="text-xs text-gray-500 mb-4">
                Buat skema perhitungan laba rugi untuk layanan atau proyek baru Anda.
              </p>

              <form onSubmit={handleSaveNewService} className="space-y-4 text-xs">
                <div>
                  <label className="block font-bold text-gray-800 mb-1">
                    Nama Layanan:
                  </label>
                  <input
                    type="text"
                    required
                    value={newServiceName}
                    onChange={(e) => setNewServiceName(e.target.value)}
                    placeholder="Contoh: Paket Website E-Commerce & Payment"
                    className="w-full text-xs font-bold text-gray-900 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] outline-none"
                  />
                </div>

                <div className="grid grid-cols-2 gap-3">
                  <div>
                    <label className="block font-bold text-gray-800 mb-1">
                      Harga Jual (Rp):
                    </label>
                    <input
                      type="number"
                      required
                      min="0"
                      step="10000"
                      value={newSellingPrice}
                      onChange={(e) => setNewSellingPrice(Number(e.target.value))}
                      className="w-full text-xs font-bold text-gray-900 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] outline-none font-mono"
                    />
                  </div>

                  <div>
                    <label className="block font-bold text-gray-800 mb-1">
                      Target Order/Bln:
                    </label>
                    <input
                      type="number"
                      min="1"
                      max="100"
                      value={newEstimatedOrders}
                      onChange={(e) => setNewEstimatedOrders(Number(e.target.value))}
                      className="w-full text-xs font-bold text-gray-900 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] outline-none font-mono"
                    />
                  </div>
                </div>

                <div>
                  <label className="block font-bold text-gray-800 mb-1">
                    Alokasi Fee Tenaga Kerja / Eksekusi (Rp):
                  </label>
                  <input
                    type="number"
                    min="0"
                    step="10000"
                    value={newLaborFee}
                    onChange={(e) => setNewLaborFee(Number(e.target.value))}
                    className="w-full text-xs font-bold text-gray-900 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] outline-none font-mono"
                  />
                </div>

                <div>
                  <label className="block font-bold text-gray-800 mb-1">
                    Deskripsi / Catatan (Opsional):
                  </label>
                  <input
                    type="text"
                    value={newServiceNotes}
                    onChange={(e) => setNewServiceNotes(e.target.value)}
                    placeholder="Contoh: Termasuk integrasi payment gateway Midtrans"
                    className="w-full text-xs font-medium text-gray-900 p-3 rounded-xl border border-gray-300 focus:border-[#7B0B1E] outline-none"
                  />
                </div>

                <div className="flex items-center gap-2 pt-3 border-t border-gray-100">
                  <button
                    type="submit"
                    className="flex-1 py-2.5 bg-gradient-to-r from-[#8B0021] via-[#750019] to-[#50000F] hover:from-[#9E0026] hover:to-[#5E0013] text-white font-bold text-xs rounded-xl shadow-xs transition-all cursor-pointer flex items-center justify-center gap-1"
                  >
                    <Check className="w-4 h-4" />
                    <span>Tambahkan Layanan</span>
                  </button>
                  <button
                    type="button"
                    onClick={() => setServiceModalOpen(false)}
                    className="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs rounded-xl transition-colors cursor-pointer"
                  >
                    Batal
                  </button>
                </div>
              </form>
            </motion.div>
          </div>
        )}
      </AnimatePresence>
    </div>
  );
};
