<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Invoice Penagihan Resmi — SOLVETA') ?></title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @media print {
            body { background: #ffffff !important; color: #000000 !important; }
            .no-print { display: none !important; }
            .print-shadow { box-shadow: none !important; border: 1px solid #e5e7eb !important; }
            @page { margin: 15mm; size: A4; }
        }
    </style>
</head>
<body class="bg-zinc-100 text-zinc-900 min-h-screen py-8 px-4 flex flex-col items-center justify-start font-sans">

    <!-- Print Control Bar -->
    <div class="no-print w-full max-w-4xl mb-6 flex items-center justify-between p-4 bg-white rounded-2xl shadow-sm border border-zinc-200">
        <a href="/admin#tab-transactions" class="text-xs font-semibold text-zinc-600 hover:text-zinc-900 flex items-center gap-1.5">
            &larr; Kembali ke Dashboard Admin
        </a>
        <div class="flex items-center gap-3">
            <button type="button" onclick="window.print()" 
                    class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-md transition-all">
                Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <!-- Invoice Paper Container (A4 Proportions) -->
    <div class="w-full max-w-4xl bg-white rounded-3xl p-8 sm:p-12 shadow-xl border border-zinc-200 print-shadow text-zinc-800">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-6 pb-8 border-b border-zinc-200">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-red-600 text-white flex items-center justify-center font-bold text-xl font-heading">
                        S
                    </div>
                    <span class="font-heading font-black text-2xl text-zinc-900 tracking-tight">SOLVETA<span class="text-red-600">.</span></span>
                </div>
                <p class="text-xs text-zinc-500 uppercase tracking-widest font-semibold">Technology & Digital Agency</p>
                <p class="text-xs text-zinc-500 mt-2">Website: <?= esc($contact['website_url'] ?? 'www.solveta.asia') ?></p>
                <p class="text-xs text-zinc-500">Email: <?= esc($contact['email'] ?? 'halo@solveta.asia') ?></p>
                <p class="text-xs text-zinc-500">WhatsApp: <?= esc($contact['whatsapp_display'] ?? '+62 857-1966-3154') ?></p>
            </div>

            <div class="text-left sm:text-right">
                <span class="text-xs uppercase tracking-widest text-zinc-400 font-bold block mb-1">INVOICE PENAGIHAN</span>
                <div class="font-heading font-black text-2xl sm:text-3xl text-zinc-900 font-mono tracking-tight">
                    <?= esc($tx['invoice_number']) ?>
                </div>
                <div class="mt-3 space-y-1 text-xs text-zinc-600">
                    <div><strong>Tanggal Terbit:</strong> <?= esc($tx['date']) ?></div>
                    <div>
                        <strong>Status:</strong> 
                        <?php if ($tx['status'] === 'Terlaksana'): ?>
                            <span class="inline-block px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[11px]">LUNAS</span>
                        <?php elseif ($tx['status'] === 'Progress'): ?>
                            <span class="inline-block px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 font-bold text-[11px]">PROGRESS / DP</span>
                        <?php else: ?>
                            <span class="inline-block px-2.5 py-0.5 rounded-full bg-zinc-200 text-zinc-700 font-bold text-[11px]">BATAL</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bill To Info -->
        <div class="py-8 grid grid-cols-1 sm:grid-cols-2 gap-8 border-b border-zinc-200 text-xs">
            <div>
                <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-wider block mb-2">Ditagihkan Kepada:</span>
                <h4 class="font-heading font-bold text-base text-zinc-900"><?= esc($tx['customer_name']) ?></h4>
                <?php if (!empty($tx['website_name'])): ?>
                    <p class="text-zinc-600 font-semibold mt-0.5"><?= esc($tx['website_name']) ?></p>
                <?php endif; ?>
                <p class="text-zinc-500 mt-1">Telepon / WA: <?= esc($tx['phone_number']) ?></p>
            </div>

            <div>
                <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-wider block mb-2">Detail Domain & Proyek:</span>
                <?php if (!empty($tx['website_link'])): ?>
                    <p class="text-zinc-700"><strong>Target Domain:</strong> <a href="<?= esc($tx['website_link']) ?>" class="text-red-600 underline"><?= esc($tx['website_link']) ?></a></p>
                <?php else: ?>
                    <p class="text-zinc-500">Pengembangan Website & Sistem Digital</p>
                <?php endif; ?>
                <?php if (!empty($tx['notes'])): ?>
                    <p class="text-zinc-500 mt-2"><strong>Catatan:</strong> <?= esc($tx['notes']) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Line Items Table -->
        <div class="py-8">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b-2 border-zinc-900 text-zinc-700 uppercase tracking-wider font-bold">
                        <th class="py-3">Deskripsi Komponen Jasa</th>
                        <th class="py-3 text-right">Keterangan</th>
                        <th class="py-3 text-right">Biaya</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    <?php if (!empty($tx['cost_components'])): ?>
                        <?php foreach ($tx['cost_components'] as $comp): ?>
                            <tr>
                                <td class="py-4 font-semibold text-zinc-800">
                                    <?= esc($comp['name'] ?? 'Layanan Website') ?>
                                </td>
                                <td class="py-4 text-right text-zinc-500">
                                    <?= esc($comp['note'] ?? '-') ?>
                                </td>
                                <td class="py-4 text-right font-mono font-bold text-zinc-800">
                                    <?php if (isset($comp['cost']) && $comp['cost'] > 0): ?>
                                        Rp <?= number_format($comp['cost'], 0, ',', '.') ?>
                                    <?php else: ?>
                                        Termasuk
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="py-4 font-semibold text-zinc-800">
                                Pembuatan Website & Sistem Digital Terintegrasi
                            </td>
                            <td class="py-4 text-right text-zinc-500">
                                Termasuk Domain, Cloud Hosting, SSL & Garansi
                            </td>
                            <td class="py-4 text-right font-mono font-bold text-zinc-800">
                                Rp <?= number_format($tx['service_price'], 0, ',', '.') ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-zinc-900 text-sm">
                        <td colspan="2" class="py-4 font-bold text-zinc-900 text-right uppercase">Total Penagihan:</td>
                        <td class="py-4 text-right font-heading font-black text-xl text-red-600 font-mono">
                            Rp <?= number_format($tx['service_price'], 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Payment & Signature Block -->
        <div class="pt-8 border-t border-zinc-200 grid grid-cols-1 sm:grid-cols-2 gap-8 text-xs">
            <div>
                <span class="font-bold text-zinc-800 block mb-2 uppercase tracking-wider">Metode Pembayaran:</span>
                <p class="text-zinc-600 leading-relaxed">
                    Pembayaran dapat ditransfer ke rekening resmi SOLVETA Technology Agency.<br>
                    Harap mencantumkan nomor invoice <strong><?= esc($tx['invoice_number']) ?></strong> pada berita transfer dan konfirmasikan bukti transfer ke WhatsApp <strong><?= esc($contact['whatsapp_display'] ?? '+62 857-1966-3154') ?></strong>.
                </p>
            </div>

            <div class="text-left sm:text-right flex flex-col items-start sm:items-end justify-between">
                <div class="text-zinc-500">
                    Disahkan secara digital oleh,<br>
                    <strong>SOLVETA Technology Agency</strong>
                </div>
                <div class="mt-8 border-t border-zinc-400 pt-2 w-48 text-center text-zinc-700 font-bold">
                    Finance & Project Division
                </div>
            </div>
        </div>

    </div>

</body>
</html>
