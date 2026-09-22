<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'SOLVETA Developer — Login') ?></title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Google Fonts: Poppins (Identical to Next.js) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        };
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-white flex items-center justify-center p-4 font-sans text-left text-gray-900 antialiased">

    <!-- Developer Login Card (Clean Minimalist SaaS - 1:1 Next.js) -->
    <div class="bg-white border border-gray-200/80 rounded-xl p-6 sm:p-8 max-w-sm w-full shadow-none text-left">
        <!-- Lock Icon Box -->
        <div class="w-9 h-9 rounded-lg bg-gray-100 text-gray-700 flex items-center justify-center mb-4">
            <i data-lucide="lock" class="w-4 h-4"></i>
        </div>

        <h1 class="text-base font-semibold text-gray-900 mb-1">
            SOLVETA Developer
        </h1>
        <p class="text-xs text-gray-400 mb-6">
            Masuk untuk mengelola konten, harga, dan HPP.
        </p>

        <!-- Flash error message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-3.5 p-2.5 rounded-lg bg-red-50 border border-red-100 text-[11px] text-red-600 font-medium flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-3.5 h-3.5 shrink-0 text-red-500"></i>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <form action="/admin/login" method="POST" class="space-y-3.5 text-left">
            <?= csrf_field() ?>
            <div>
                <input
                    type="text"
                    name="username"
                    required
                    value="<?= esc(old('username') ?? '') ?>"
                    placeholder="Masukkan username"
                    class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium text-gray-900 transition-colors"
                    autofocus
                />
            </div>

            <div>
                <input
                    type="password"
                    name="password"
                    required
                    placeholder="Masukkan password"
                    class="w-full text-xs px-3 py-2.5 rounded-lg border border-gray-200 focus:border-gray-900 outline-none bg-white font-medium text-gray-900 transition-colors"
                />
            </div>

            <button
                type="submit"
                class="w-full mt-2 py-2 bg-gray-900 hover:bg-black text-white font-medium text-xs rounded-lg transition-colors cursor-pointer"
            >
                Masuk
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-gray-100 text-center">
            <a
                href="/"
                class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-gray-900 transition-colors"
            >
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Website</span>
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
