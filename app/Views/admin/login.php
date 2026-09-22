<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login Developer Portal — SOLVETA') ?></title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Google Fonts: Poppins & JetBrains Mono (Identical to Next.js) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        maroon: {
                            50: '#fdf2f4', 100: '#fce7ea', 200: '#f9d2d8',
                            300: '#f4adb8', 400: '#ec7d90', 500: '#e04f6b',
                            600: '#cb2d54', 700: '#aa2046', 800: '#8B0021',
                            900: '#750019', 950: '#50000F',
                        }
                    }
                }
            }
        };
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* ===== Next.js-identical Opening Screen Aesthetics ===== */
        .login-bg {
            background: #07080E;
            background-image: 
                radial-gradient(ellipse 80% 50% at 50% -10%, rgba(139,0,33,0.15), transparent),
                radial-gradient(ellipse 60% 40% at 80% 100%, rgba(117,0,25,0.08), transparent);
        }

        .glass-card {
            background: rgba(15, 17, 25, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .input-field {
            background: rgba(15, 17, 25, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-field:focus {
            border-color: rgba(139, 0, 33, 0.6);
            box-shadow: 0 0 0 3px rgba(139, 0, 33, 0.15);
            background: rgba(15, 17, 25, 0.8);
        }

        .btn-login {
            background: linear-gradient(135deg, #8B0021 0%, #750019 50%, #50000F 100%);
            box-shadow: 0 4px 20px rgba(139, 0, 33, 0.35);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-login:hover {
            box-shadow: 0 6px 30px rgba(139, 0, 33, 0.5);
            transform: translateY(-1px);
        }
        .btn-login:active {
            transform: translateY(0);
        }

        /* Floating particles */
        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(139, 0, 33, 0.3);
            border-radius: 50%;
            animation: float-up linear infinite;
        }
        @keyframes float-up {
            0%   { transform: translateY(0) scale(1); opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 0.3; }
            100% { transform: translateY(-100vh) scale(0.3); opacity: 0; }
        }

        /* Grid pattern */
        .grid-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(139,0,33,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(139,0,33,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 50% 50% at 50% 50%, black 40%, transparent 100%);
        }

        /* Logo shimmer */
        .logo-glow {
            box-shadow: 0 0 40px rgba(139, 0, 33, 0.2), 0 0 80px rgba(139, 0, 33, 0.08);
        }
    </style>
</head>
<body class="login-bg grid-bg text-gray-200 min-h-screen flex items-center justify-center p-4 relative overflow-hidden font-sans">

    <!-- Floating particles -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
        <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="particle" style="left: <?= rand(5, 95) ?>%; animation-duration: <?= rand(8, 20) ?>s; animation-delay: <?= rand(0, 10) ?>s;"></div>
        <?php endfor; ?>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3 group mb-5">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-maroon-800 via-maroon-900 to-maroon-950 p-[1.5px] logo-glow">
                    <div class="w-full h-full bg-[#07080E] rounded-[14px] flex items-center justify-center">
                        <span class="font-sans font-extrabold text-2xl bg-gradient-to-br from-maroon-400 to-maroon-700 bg-clip-text text-transparent">S</span>
                    </div>
                </div>
            </a>
            <h1 class="font-sans font-bold text-[1.65rem] text-white tracking-tight leading-tight">
                Developer Portal
            </h1>
            <p class="text-[0.8rem] text-gray-500 mt-2 font-light tracking-wide">
                Sistem Manajemen Konten & Transaksi <span class="text-maroon-500 font-medium">SOLVETA</span>
            </p>
        </div>

        <!-- Login Card -->
        <div class="rounded-3xl glass-card p-8 shadow-2xl">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 p-3.5 rounded-xl bg-red-950/50 border border-red-800/40 text-red-300 text-xs flex items-center gap-2.5">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-red-500 shrink-0"></i>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 p-3.5 rounded-xl bg-emerald-950/50 border border-emerald-800/40 text-emerald-300 text-xs flex items-center gap-2.5">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0"></i>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <form action="/admin/login" method="POST" class="space-y-5">
                <?= csrf_field() ?>

                <div>
                    <label class="block text-[0.7rem] font-semibold text-gray-400 uppercase tracking-[0.15em] mb-2.5">Username</label>
                    <div class="relative">
                        <i data-lucide="user" class="w-[18px] h-[18px] text-gray-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input type="text" name="username" required placeholder="developer"
                               value="<?= old('username') ?>"
                               class="input-field w-full pl-12 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 text-sm focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[0.7rem] font-semibold text-gray-400 uppercase tracking-[0.15em] mb-2.5">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="w-[18px] h-[18px] text-gray-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input type="password" name="password" required placeholder="••••••••"
                               class="input-field w-full pl-12 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 text-sm focus:outline-none">
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" 
                            class="btn-login w-full py-3.5 rounded-xl text-white font-semibold text-sm flex items-center justify-center gap-2.5">
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        <span>Masuk ke Dashboard</span>
                    </button>
                </div>

                <div class="text-center pt-1">
                    <a href="/" class="text-xs text-gray-600 hover:text-gray-400 transition-colors duration-300">
                        &larr; Kembali ke Website Publik
                    </a>
                </div>
            </form>
        </div>

        <div class="text-center mt-7 text-[0.65rem] text-gray-700 font-mono tracking-wider">
            SOLVETA CMS v4.2 &bull; CodeIgniter 4 &bull; MySQL
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
