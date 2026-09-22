<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login Admin Portal — SOLVETA') ?></title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-[#09090b] text-zinc-100 min-h-screen flex items-center justify-center p-4 relative">

    <div class="fixed inset-0 bg-grid-pattern opacity-30 pointer-events-none"></div>
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-red-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3 group mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-600 to-red-950 p-[1px] shadow-lg shadow-red-900/40">
                    <div class="w-full h-full bg-[#09090b] rounded-[11px] flex items-center justify-center">
                        <span class="font-heading font-black text-2xl text-red-500">S</span>
                    </div>
                </div>
            </a>
            <h1 class="font-heading font-extrabold text-2xl text-white tracking-tight">Admin & Developer Portal</h1>
            <p class="text-xs text-zinc-400 mt-1">Sistem Manajemen Konten & Transaksi SOLVETA</p>
        </div>

        <!-- Login Card -->
        <div class="rounded-3xl glass-panel p-8 border border-white/[0.08] shadow-2xl">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 p-3.5 rounded-xl bg-red-950/70 border border-red-800/60 text-red-300 text-xs flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-red-500 shrink-0"></i>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 p-3.5 rounded-xl bg-emerald-950/70 border border-emerald-800/60 text-emerald-300 text-xs flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0"></i>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <form action="/admin/login" method="POST" class="space-y-5">
                <?= csrf_field() ?>

                <div>
                    <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Username</label>
                    <div class="relative">
                        <i data-lucide="user" class="w-4 h-4 text-zinc-500 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input type="text" name="username" required placeholder="admin"
                               value="<?= old('username') ?>"
                               class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-red-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-300 uppercase tracking-wider mb-2">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="w-4 h-4 text-zinc-500 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input type="password" name="password" required placeholder="••••••••"
                               class="w-full pl-10 pr-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700/80 text-white placeholder-zinc-500 text-sm focus:outline-none focus:border-red-500">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="w-full py-3.5 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white font-bold text-sm shadow-xl shadow-red-700/40 flex items-center justify-center gap-2 transition-all">
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        <span>Masuk ke Dashboard</span>
                    </button>
                </div>

                <div class="text-center pt-2">
                    <a href="/" class="text-xs text-zinc-500 hover:text-zinc-300 transition-colors">
                        &larr; Kembali ke Website Publik
                    </a>
                </div>
            </form>
        </div>

        <div class="text-center mt-6 text-xs text-zinc-600">
            SOLVETA CMS Engine v4.2 &bull; CodeIgniter 4 &bull; MySQL Localhost
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
