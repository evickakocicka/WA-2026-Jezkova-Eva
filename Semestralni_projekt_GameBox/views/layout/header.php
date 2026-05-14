<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameBox Knihovna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen text-slate-200 selection:bg-blue-500 selection:text-white">
    
    <nav class="bg-slate-100 sticky top-0 z-50 shadow-2xl shadow-black/50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            
            <a href="<?= BASE_URL ?>/index.php?url=game/index" class="flex items-center gap-3 hover:scale-105 transition transform">
                <img src="<?= BASE_URL ?>/images/images.png" alt="GameBox Logo" class="h-12 w-auto object-contain">
                <span class="text-2xl font-black text-slate-800 tracking-widest drop-shadow-sm">GAMEBOX</span>
            </a>

            <div class="flex items-center gap-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="hidden sm:block text-sm text-slate-600 font-medium bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                        Hráč: <span class="text-blue-700 font-black"><?= htmlspecialchars($_SESSION['username'] ?? 'Neznámý hráč') ?></span>
                    </div>
                    
                    <a href="<?= BASE_URL ?>/index.php?url=auth/profile" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-xl transition text-sm font-bold shadow-md shadow-blue-500/30 flex items-center gap-2">
                        Můj profil 👤
                    </a>

                    <a href="<?= BASE_URL ?>/index.php?url=auth/logout" class="bg-white hover:bg-red-50 hover:text-red-600 hover:border-red-300 border border-slate-200 text-slate-600 px-4 py-2 rounded-xl transition text-sm font-bold shadow-sm">
                        Odhlásit se
                    </a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>/index.php?url=auth/login" class="text-slate-600 hover:text-blue-700 font-bold transition text-sm">
                        Přihlášení
                    </a>
                    <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2 rounded-xl transition text-sm font-bold shadow-md shadow-blue-500/30">
                        Registrace
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-10">