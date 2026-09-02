"use client";

import React, { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import {
  DollarSign,
  TrendingUp,
  Plus,
  Trash2,
  Edit3,
  Edit,
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
  AddonServiceItem,
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
    updateAddonServices,
    addAddonService,
    editAddonService,
    deleteAddonService,
  } = useSiteData();

  const analyses: ServiceProfitAnalysis[] =
    data.profitAnalysis && data.profitAnalysis.length > 0
      ? data.profitAnalysis
      : [];

  const addonList: AddonServiceItem[] =
    data.addonServices && data.addonServices.length > 0
      ? data.addonServices
      : [];

  // Modal State for Addon Services
  const [addonModalOpen, setAddonModalOpen] = useState(false);
  const [editingAddonId, setEditingAddonId] = useState<string | null>(null);
  const [addonName, setAddonName] = useState("");
  const [addonPrice, setAddonPrice] = useState("");
  const [addonThirdParty, setAddonThirdParty] = useState("-");
  const [addonCategory, setAddonCategory] = useState("Layanan");

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

  const handleSaveAddon = (e: React.FormEvent) => {
    e.preventDefault();
    if (!addonName.trim() || !addonPrice.trim()) {
      showToast("Nama dan tarif layanan tambahan wajib diisi.");
      return;
    }

    if (editingAddonId) {
      editAddonService(editingAddonId, {
        name: addonName.trim(),
        priceDescription: addonPrice.trim(),
        thirdPartyCost: addonThirdParty.trim() || "-",
        category: addonCategory.trim(),
      });
      showToast("Layanan tambahan berhasil diperbarui!");
    } else {
      addAddonService({
        name: addonName.trim(),
        priceDescription: addonPrice.trim(),
        thirdPartyCost: addonThirdParty.trim() || "-",
        category: addonCategory.trim(),
      });
      showToast("Layanan tambahan baru berhasil ditambahkan!");
    }

    setAddonModalOpen(false);
    setEditingAddonId(null);
  };

  return (
    <div className="space-y-6 bg-white font-sans text-left">
      {/* 1. FINANCIAL EXECUTIVE SUMMARY CARDS (CLEAN MINIMALIST SAAS) */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {/* Metric 1: Estimasi Omset Bulanan */}
        <div className="p-5 bg-white rounded-xl border border-gray-200/80 shadow-none hover:border-gray-300 transition-colors">
          <div className="text-[11px] font-medium uppercase tracking-wider text-gray-500 mb-1.5">
            Estimasi Omset / Bulan
          </div>
          <div className="text-2xl font-semibold text-gray-900 tracking-tight">
            {formatIDR(summary.totalMonthlyRevenue)}
          </div>
          <p className="text-[11px] text-gray-400 mt-1">
            Akumulasi target seluruh paket layanan
          </p>
        </div>

        {/* Metric 2: Total Beban Pokok & Operasional */}
        <div className="p-5 bg-white rounded-xl border border-gray-200/80 shadow-none hover:border-gray-300 transition-colors">
          <div className="text-[11px] font-medium uppercase tracking-wider text-gray-500 mb-1.5">
            Total Beban / HPP Bulan Ini
          </div>
          <div className="text-2xl font-semibold text-gray-900 tracking-tight">
            {formatIDR(summary.totalMonthlyCosts)}
          </div>
          <p className="text-[11px] text-gray-400 mt-1">
            Domain, server, tools &amp; tenaga kerja
          </p>
        </div>

        {/* Metric 3: Total Laba Bersih Bulanan */}
        <div className="p-5 bg-white rounded-xl border border-gray-200/80 shadow-none hover:border-gray-300 transition-colors">
          <div className="text-[11px] font-medium uppercase tracking-wider text-gray-500 mb-1.5">
            Proyeksi Laba Bersih
          </div>
          <div className="text-2xl font-semibold text-gray-900 tracking-tight">
            {formatIDR(summary.totalMonthlyNetProfit)}
          </div>
          <p className="text-[11px] text-gray-400 mt-1">
            Estimasi laba bersih masuk kas bisnis
          </p>
        </div>

        {/* Metric 4: Rata-Rata Margin Keuntungan */}
        <div className="p-5 bg-white rounded-xl border border-gray-200/80 shadow-none hover:border-gray-300 transition-colors">
          <div className="text-[11px] font-medium uppercase tracking-wider text-gray-500 mb-1.5">
            Rata-rata Margin Bersih
          </div>
          <div className="text-2xl font-semibold text-gray-900 tracking-tight flex items-center gap-2">
            <span>{averageMargin}%</span>
            <span className="text-[11px] font-medium text-gray-500 bg-gray-100 px-2 py-0.5 rounded">
              {averageMargin >= 40 ? "Sehat" : averageMargin >= 20 ? "Normal" : "Rendah"}
            </span>
          </div>
          <p className="text-[11px] text-gray-400 mt-1">
            Persentase keuntungan bersih rata-rata
          </p>
        </div>
      </div>

      {/* 2. TABEL PERHITUNGAN LABA RUGI & RINCIAN KOMPONEN BEBAN */}
      <div className="bg-white border border-gray-200/80 rounded-xl overflow-hidden">
        {/* Table Header Bar */}
        <div className="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
          <div>
            <h2 className="text-sm font-semibold text-gray-900">
              Rincian Komponen Biaya &amp; Margin Tiap Layanan
            </h2>
            <p className="text-xs text-gray-400 mt-0.5">
              Klik baris layanan untuk membuka rincian beban atau menambahkan biaya baru.
            </p>
          </div>

          <div className="flex items-center gap-2 flex-wrap">
            <button
              type="button"
              onClick={handleExportCSV}
              className="px-3 py-1.5 bg-white hover:bg-gray-50 text-gray-700 text-xs font-medium rounded-lg border border-gray-200 shadow-none flex items-center gap-1.5 transition-colors cursor-pointer"
            >
              <Download className="w-3.5 h-3.5 text-gray-500" />
              <span>Ekspor CSV</span>
            </button>

            <button
              type="button"
              onClick={() => setServiceModalOpen(true)}
              className="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg shadow-none flex items-center gap-1.5 transition-colors cursor-pointer"
            >
              <Plus className="w-3.5 h-3.5" />
              <span>Tambah Layanan</span>
            </button>
          </div>
        </div>

        {/* Table Body */}
        <div className="overflow-x-auto">
          <table className="w-full text-left text-xs border-collapse font-sans">
            <thead>
              <tr className="border-b border-gray-100 bg-white text-gray-400 font-medium uppercase tracking-wider text-[11px]">
                <th className="py-3 px-4">Nama Layanan</th>
                <th className="py-3 px-4 text-right">Harga Jual</th>
                <th className="py-3 px-4 text-right">Total Beban (HPP)</th>
                <th className="py-3 px-4 text-right">Laba Bersih</th>
                <th className="py-3 px-4 text-center">Margin</th>
                <th className="py-3 px-4 text-center">Estimasi Order/Bln</th>
                <th className="py-3 px-4 text-right">Proyeksi Laba/Bln</th>
                <th className="py-3 px-4 text-center">Rincian</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-100 text-gray-700">
              {analyses.map((service) => {
                const metrics = calculateServiceMetrics(service);
                const isExpanded = expandedServiceId === service.id;

                return (
                  <React.Fragment key={service.id}>
                    <tr
                      onClick={() =>
                        setExpandedServiceId(isExpanded ? null : service.id)
                      }
                      className={`hover:bg-gray-50/70 transition-colors cursor-pointer ${
                        isExpanded ? "bg-gray-50/40" : ""
                      }`}
                    >
                      {/* 1. Nama Layanan */}
                      <td className="py-3.5 px-4">
                        <div>
                          <span className="font-semibold text-gray-900 text-xs block">
                            {service.serviceName}
                          </span>
                          {service.notes && (
                            <span className="text-[11px] text-gray-400 block line-clamp-1 mt-0.5">
                              {service.notes}
                            </span>
                          )}
                        </div>
                      </td>

                      {/* 2. Harga Jual */}
                      <td className="py-3.5 px-4 text-right font-medium text-gray-900">
                        {formatIDR(service.sellingPrice)}
                      </td>

                      {/* 3. Total Beban HPP */}
                      <td className="py-3.5 px-4 text-right text-gray-600 font-medium">
                        {formatIDR(metrics.totalCosts)}
                      </td>

                      {/* 4. Laba Bersih */}
                      <td className="py-3.5 px-4 text-right font-semibold text-gray-900">
                        {formatIDR(metrics.netProfit)}
                      </td>

                      {/* 5. Margin Badge */}
                      <td className="py-3.5 px-4 text-center">
                        <span className="inline-block px-2 py-0.5 rounded text-[11px] font-medium bg-gray-100 text-gray-700">
                          {metrics.marginPercent}%
                        </span>
                      </td>

                      {/* 6. Estimasi Order / Bulan */}
                      <td className="py-3.5 px-4 text-center text-gray-600">
                        {metrics.monthlyOrders} proyek
                      </td>

                      {/* 7. Proyeksi Laba Bulanan */}
                      <td className="py-3.5 px-4 text-right font-semibold text-gray-900">
                        {formatIDR(metrics.monthlyNetProfit)}
                      </td>

                      {/* 8. Accordion Toggle */}
                      <td className="py-3.5 px-4 text-center">
                        <button
                          type="button"
                          className="p-1 text-gray-400 hover:text-gray-700 rounded transition-colors"
                        >
                          {isExpanded ? (
                            <ChevronUp className="w-4 h-4" />
                          ) : (
                            <ChevronDown className="w-4 h-4" />
                          )}
                        </button>
                      </td>
                    </tr>

                    {/* EXPANDED ACCORDION: DETAIL KOMPONEN BEBAN & EDITING */}
                    {isExpanded && (
                      <tr className="bg-gray-50/40 border-b border-gray-100">
                        <td colSpan={8} className="p-5">
                          <div className="space-y-4 max-w-4xl">
                            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-gray-200/60 pb-3">
                              <div>
                                <h3 className="text-xs font-semibold text-gray-900">
                                  Komponen Beban: {service.serviceName}
                                </h3>
                                <p className="text-[11px] text-gray-400 mt-0.5">
                                  Kelola rincian biaya infrastruktur, lisensi, dan fee tenaga kerja.
                                </p>
                              </div>

                              <div className="flex items-center gap-2">
                                <button
                                  type="button"
                                  onClick={() => handleOpenAddCost(service.id)}
                                  className="px-3 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg flex items-center gap-1 transition-colors cursor-pointer"
                                >
                                  <Plus className="w-3.5 h-3.5" />
                                  <span>Tambah Biaya</span>
                                </button>

                                <button
                                  type="button"
                                  onClick={() => {
                                    if (confirm(`Hapus layanan "${service.serviceName}" dari analisis laba rugi?`)) {
                                      deleteServiceProfitItem(service.id);
                                      showToast("Layanan berhasil dihapus dari analisis!");
                                    }
                                  }}
                                  className="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-white border border-transparent hover:border-gray-200 transition-colors cursor-pointer"
                                  title="Hapus Layanan Ini"
                                >
                                  <Trash2 className="w-3.5 h-3.5" />
                                </button>
                              </div>
                            </div>

                            {/* Quick Editor for Selling Price & Monthly Target */}
                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-white p-4 rounded-xl border border-gray-200/70">
                              <div>
                                <label className="block text-[11px] font-medium text-gray-600 mb-1">
                                  Harga Jual Layanan (Rp)
                                </label>
                                <input
                                  type="number"
                                  value={service.sellingPrice}
                                  onChange={(e) =>
                                    editServiceProfitItem(service.id, {
                                      sellingPrice: Number(e.target.value) || 0,
                                    })
                                  }
                                  className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                                />
                              </div>

                              <div>
                                <label className="block text-[11px] font-medium text-gray-600 mb-1">
                                  Estimasi Order per Bulan (Proyek)
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
                                  className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                                />
                              </div>
                            </div>

                            {/* List of Cost Items */}
                            <div className="space-y-2">
                              {(!service.costs || service.costs.length === 0) && (
                                <p className="text-xs text-gray-400 italic py-2">
                                  Belum ada komponen beban untuk paket ini. Klik tombol "+ Tambah Biaya" di atas.
                                </p>
                              )}

                              {service.costs?.map((cost) => {
                                const catInfo = getCategoryInfo(cost.category);

                                return (
                                  <div
                                    key={cost.id}
                                    className="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200/70 hover:border-gray-300 transition-colors"
                                  >
                                    <div>
                                      <span className="font-medium text-xs text-gray-900 block">
                                        {cost.name}
                                      </span>
                                      <span className="text-[10px] text-gray-400 block">
                                        {catInfo.label}
                                      </span>
                                    </div>

                                    <div className="flex items-center gap-4">
                                      <span className="font-medium text-xs text-gray-800">
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

      {/* 2.5 TABEL LAYANAN TAMBAHAN (ADD-ONS & PAY-AS-YOU-GO) */}
      <div className="bg-white border border-gray-200/80 rounded-xl overflow-hidden">
        <div className="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
          <div>
            <h2 className="text-sm font-semibold text-gray-900">
              5. Layanan Tambahan (Add-ons &amp; Pay-as-you-go)
            </h2>
            <p className="text-xs text-gray-400 mt-0.5">
              Rincian tarif layanan add-on, integrasi API, dan biaya platform pihak ketiga.
            </p>
          </div>

          <button
            type="button"
            onClick={() => {
              setEditingAddonId(null);
              setAddonName("");
              setAddonPrice("");
              setAddonThirdParty("-");
              setAddonCategory("Layanan");
              setAddonModalOpen(true);
            }}
            className="px-3.5 py-1.5 bg-gray-900 hover:bg-black text-white text-xs font-medium rounded-lg shadow-none flex items-center gap-1.5 transition-colors cursor-pointer"
          >
            <Plus className="w-3.5 h-3.5" />
            <span>Tambah Layanan Tambahan</span>
          </button>
        </div>

        <div className="overflow-x-auto">
          <table className="w-full text-left border-collapse text-xs">
            <thead>
              <tr className="bg-white border-b border-gray-100 text-gray-400 font-medium uppercase text-[11px] tracking-wider">
                <th className="py-3 px-5">Layanan Tambahan</th>
                <th className="py-3 px-5">Harga / Pay-as-you-go</th>
                <th className="py-3 px-5">Biaya Platform / Pihak Ketiga</th>
                <th className="py-3 px-5">Kategori</th>
                <th className="py-3 px-5 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-100 font-sans">
              {addonList.map((addon) => (
                <tr key={addon.id} className="hover:bg-gray-50/50 transition-colors">
                  <td className="py-3.5 px-5 font-medium text-gray-900">{addon.name}</td>
                  <td className="py-3.5 px-5 text-gray-900 font-semibold">{addon.priceDescription}</td>
                  <td className="py-3.5 px-5 text-gray-500">{addon.thirdPartyCost}</td>
                  <td className="py-3.5 px-5">
                    <span className="text-[11px] bg-gray-100 text-gray-600 px-2 py-0.5 rounded">
                      {addon.category || "Layanan"}
                    </span>
                  </td>
                  <td className="py-3.5 px-5 text-right">
                    <div className="flex items-center justify-end gap-1.5">
                      <button
                        type="button"
                        onClick={() => {
                          setEditingAddonId(addon.id);
                          setAddonName(addon.name);
                          setAddonPrice(addon.priceDescription);
                          setAddonThirdParty(addon.thirdPartyCost);
                          setAddonCategory(addon.category || "Layanan");
                          setAddonModalOpen(true);
                        }}
                        className="p-1 hover:bg-gray-100 text-gray-400 hover:text-gray-700 rounded transition-colors"
                        title="Edit Layanan Tambahan"
                      >
                        <Edit className="w-3.5 h-3.5" />
                      </button>
                      <button
                        type="button"
                        onClick={() => {
                          if (confirm(`Hapus layanan tambahan "${addon.name}"?`)) {
                            deleteAddonService(addon.id);
                            showToast("Layanan tambahan berhasil dihapus!");
                          }
                        }}
                        className="p-1 hover:bg-red-50 text-gray-400 hover:text-red-600 rounded transition-colors"
                        title="Hapus Layanan Tambahan"
                      >
                        <Trash2 className="w-3.5 h-3.5" />
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

      {/* 3. MODAL: TAMBAH KOMPONEN BEBAN BIAYA BARU */}
      <AnimatePresence>
        {costModalOpen && (
          <div className="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.96, y: 10 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.96, y: 10 }}
              className="bg-white rounded-xl p-6 max-w-md w-full shadow-xl border border-gray-200/80 font-sans"
            >
              <h3 className="text-sm font-semibold text-gray-900 mb-0.5">
                Tambah Komponen Beban Biaya
              </h3>
              <p className="text-xs text-gray-400 mb-4">
                Tambahkan beban modal, domain, server, atau fee ke layanan ini.
              </p>

              <form onSubmit={handleSaveCost} className="space-y-3.5 text-xs">
                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Nama Komponen Biaya
                  </label>
                  <input
                    type="text"
                    required
                    value={costName}
                    onChange={(e) => setCostName(e.target.value)}
                    placeholder="Contoh: Domain .com 1 Tahun, Fee Developer"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Kategori Beban
                  </label>
                  <select
                    value={costCategory}
                    onChange={(e) =>
                      setCostCategory(e.target.value as ServiceCostItem["category"])
                    }
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  >
                    <option value="infrastruktur">Infrastruktur (Domain, Hosting, SSL)</option>
                    <option value="tenaga_kerja">Tenaga Kerja / Fee Eksekusi</option>
                    <option value="lisensi_tools">Lisensi Tools &amp; Aset</option>
                    <option value="operasional">Operasional &amp; Maintenance</option>
                    <option value="lainnya">Lain-lain</option>
                  </select>
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Nominal Biaya (Rp)
                  </label>
                  <input
                    type="number"
                    required
                    min="0"
                    step="1000"
                    value={costAmount}
                    onChange={(e) => setCostAmount(Number(e.target.value))}
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Keterangan (Opsional)
                  </label>
                  <input
                    type="text"
                    value={costNotes}
                    onChange={(e) => setCostNotes(e.target.value)}
                    placeholder="Contoh: Langganan tahunan"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div className="flex items-center justify-end gap-2 pt-3 border-t border-gray-100">
                  <button
                    type="button"
                    onClick={() => setCostModalOpen(false)}
                    className="px-3.5 py-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 font-medium text-xs rounded-lg transition-colors cursor-pointer"
                  >
                    Batal
                  </button>
                  <button
                    type="submit"
                    className="px-4 py-2 bg-gray-900 hover:bg-black text-white font-medium text-xs rounded-lg transition-colors cursor-pointer"
                  >
                    Simpan Biaya
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
          <div className="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.96, y: 10 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.96, y: 10 }}
              className="bg-white rounded-xl p-6 max-w-md w-full shadow-xl border border-gray-200/80 font-sans"
            >
              <h3 className="text-sm font-semibold text-gray-900 mb-0.5">
                Tambah Layanan Baru
              </h3>
              <p className="text-xs text-gray-400 mb-4">
                Buat skema perhitungan laba rugi dan HPP untuk layanan baru.
              </p>

              <form onSubmit={handleSaveNewService} className="space-y-3.5 text-xs">
                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Nama Layanan / Paket
                  </label>
                  <input
                    type="text"
                    required
                    value={newServiceName}
                    onChange={(e) => setNewServiceName(e.target.value)}
                    placeholder="Contoh: Paket E-Commerce & Payment Gateway"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div className="grid grid-cols-2 gap-3">
                  <div>
                    <label className="block font-medium text-gray-700 mb-1">
                      Harga Jual (Rp)
                    </label>
                    <input
                      type="number"
                      required
                      min="0"
                      step="10000"
                      value={newSellingPrice}
                      onChange={(e) => setNewSellingPrice(Number(e.target.value))}
                      className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                    />
                  </div>

                  <div>
                    <label className="block font-medium text-gray-700 mb-1">
                      Target Order / Bln
                    </label>
                    <input
                      type="number"
                      min="1"
                      max="100"
                      value={newEstimatedOrders}
                      onChange={(e) => setNewEstimatedOrders(Number(e.target.value))}
                      className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                    />
                  </div>
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Estimasi Fee Tenaga Kerja / Eksekusi (Rp)
                  </label>
                  <input
                    type="number"
                    min="0"
                    step="10000"
                    value={newLaborFee}
                    onChange={(e) => setNewLaborFee(Number(e.target.value))}
                    placeholder="Contoh: 300000"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Catatan Layanan (Opsional)
                  </label>
                  <input
                    type="text"
                    value={newServiceNotes}
                    onChange={(e) => setNewServiceNotes(e.target.value)}
                    placeholder="Keterangan singkat target klien..."
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div className="flex items-center justify-end gap-2 pt-3 border-t border-gray-100">
                  <button
                    type="button"
                    onClick={() => setServiceModalOpen(false)}
                    className="px-3.5 py-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 font-medium text-xs rounded-lg transition-colors cursor-pointer"
                  >
                    Batal
                  </button>
                  <button
                    type="submit"
                    className="px-4 py-2 bg-gray-900 hover:bg-black text-white font-medium text-xs rounded-lg transition-colors cursor-pointer"
                  >
                    Tambah Layanan
                  </button>
                </div>
              </form>
            </motion.div>
          </div>
        )}
      </AnimatePresence>

      {/* 5. MODAL: TAMBAH / EDIT LAYANAN TAMBAHAN */}
      <AnimatePresence>
        {addonModalOpen && (
          <div className="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4">
            <motion.div
              initial={{ opacity: 0, scale: 0.96, y: 10 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.96, y: 10 }}
              className="bg-white rounded-xl p-6 max-w-md w-full shadow-xl border border-gray-200/80 font-sans"
            >
              <h3 className="text-sm font-semibold text-gray-900 mb-0.5">
                {editingAddonId ? "Edit Layanan Tambahan" : "Tambah Layanan Tambahan Baru"}
              </h3>
              <p className="text-xs text-gray-400 mb-4">
                Tentukan skema tarif add-on dan estimasi biaya platform / pihak ketiga.
              </p>

              <form onSubmit={handleSaveAddon} className="space-y-3.5 text-xs">
                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Nama Layanan Tambahan
                  </label>
                  <input
                    type="text"
                    required
                    value={addonName}
                    onChange={(e) => setAddonName(e.target.value)}
                    placeholder="Contoh: WhatsApp Business API, Tambah 1 Halaman"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Harga / Pay-as-you-go (Label Tampilan)
                  </label>
                  <input
                    type="text"
                    required
                    value={addonPrice}
                    onChange={(e) => setAddonPrice(e.target.value)}
                    placeholder="Contoh: Rp30K / revisi, Mulai Rp150K"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-mono"
                  />
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Biaya Platform / Pihak Ketiga (HPP Pihak Luar)
                  </label>
                  <input
                    type="text"
                    value={addonThirdParty}
                    onChange={(e) => setAddonThirdParty(e.target.value)}
                    placeholder="Contoh: - atau Sesuai tarif Meta/provider & penggunaan"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div>
                  <label className="block font-medium text-gray-700 mb-1">
                    Kategori Layanan
                  </label>
                  <input
                    type="text"
                    value={addonCategory}
                    onChange={(e) => setAddonCategory(e.target.value)}
                    placeholder="Contoh: Integrasi API, Revisi, Halaman, AI"
                    className="w-full text-xs font-medium text-gray-900 p-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white"
                  />
                </div>

                <div className="flex items-center justify-end gap-2 pt-3 border-t border-gray-100">
                  <button
                    type="button"
                    onClick={() => {
                      setAddonModalOpen(false);
                      setEditingAddonId(null);
                    }}
                    className="px-3.5 py-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 font-medium text-xs rounded-lg transition-colors cursor-pointer"
                  >
                    Batal
                  </button>
                  <button
                    type="submit"
                    className="px-4 py-2 bg-gray-900 hover:bg-black text-white font-medium text-xs rounded-lg transition-colors cursor-pointer"
                  >
                    Simpan Layanan Tambahan
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
