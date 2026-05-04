<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameBox Knihovna</title>
    <!-- Načtení Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen text-slate-200 selection:bg-blue-500 selection:text-white">
    
    <!-- HORNÍ NAVIGAČNÍ LIŠTA (Trochu světlejší než pozadí pro lepší kontrast) -->
    <nav class="bg-slate-800 border-b border-slate-700 sticky top-0 z-50 shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            
            <!-- Logo a název vlevo -->
            <a href="<?= BASE_URL ?>/index.php?url=game/index" class="flex items-center gap-3 hover:opacity-80 transition">
                <!-- ÚPRAVA: Přidán bílý podklad (bg-white/95), aby logo krásně svítilo -->
                <div class="bg-white/95 p-1.5 rounded-xl shadow-sm border border-slate-600">
                    <img src="<?= BASE_URL ?>/images/images.png" alt="GameBox Logo" class="h-8 w-auto object-contain">
                </div>
                <span class="text-2xl font-black text-white tracking-wide drop-shadow-md">GAMEBOX</span>
            </a>

            <!-- Ovládání profilu vpravo -->
            <div class="flex items-center gap-4">
                <!-- OPRAVA CHYBY: Přidán otazníkový operátor (?? 'Neznámý hráč') pro případ chybějícího jména -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="hidden sm:block text-sm text-slate-400 font-medium bg-slate-900 px-4 py-2 rounded-xl border border-slate-700">
                        Hráč: <span class="text-blue-400 font-bold"><?= htmlspecialchars($_SESSION['username'] ?? 'Neznámý hráč') ?></span>
                    </div>
                    <a href="<?= BASE_URL ?>/index.php?url=auth/logout" class="bg-slate-900 hover:bg-red-500/20 hover:text-red-400 hover:border-red-500/50 border border-slate-700 text-slate-300 px-4 py-2 rounded-xl transition text-sm font-semibold shadow-sm">
                        Odhlásit se
                    </a>
                <?php else: ?>
                    <!-- Pokud uživatel NENÍ přihlášený -->
                    <a href="<?= BASE_URL ?>/index.php?url=auth/login" class="text-slate-300 hover:text-blue-400 font-semibold transition text-sm">
                        Přihlášení
                    </a>
                    <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2 rounded-xl transition text-sm font-bold shadow-lg shadow-blue-500/30 border border-blue-500">
                        Registrace
                    </a>
                <?php endif; ?>
            </div>
            
        </div>
    </nav>

    <!-- Hlavní kontejner pro zbytek stránky -->
    <div class="max-w-6xl mx-auto px-4 py-10">