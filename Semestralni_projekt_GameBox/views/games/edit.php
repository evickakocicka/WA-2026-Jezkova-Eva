<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-black text-white mb-8">Upravit <span class="text-blue-500">hru</span></h1>

    <form action="<?= BASE_URL ?>/index.php?url=game/update/<?= $game['id'] ?>" method="POST" enctype="multipart/form-data" class="bg-slate-800 rounded-3xl p-8 border border-slate-700 shadow-2xl space-y-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Název hry</label>
                <input type="text" name="title" value="<?= htmlspecialchars($game['title']) ?>" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Kategorie</label>
                <select name="category" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                    <option value="Akční adventura" <?= $game['category'] == 'Akční adventura' ? 'selected' : '' ?>>Akční adventura</option>
                    <option value="RPG" <?= $game['category'] == 'RPG' ? 'selected' : '' ?>>RPG</option>
                    <option value="Střílečka" <?= $game['category'] == 'Střílečka' ? 'selected' : '' ?>>Střílečka</option>
                    <option value="Sportovní" <?= $game['category'] == 'Sportovní' ? 'selected' : '' ?>>Sportovní</option>
                    <option value="Horror" <?= $game['category'] == 'Horror' ? 'selected' : '' ?>>Horror</option>
                    <option value="Simulátor" <?= $game['category'] == 'Simulátor' ? 'selected' : '' ?>>Simulátor / Ostatní</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Nejlepší trofej</label>
                <select name="trophy_type" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                    <option value="Bez trofejí" <?= $game['trophy_type'] == 'Bez trofejí' ? 'selected' : '' ?>>Bez trofejí / Nemá</option>
                    <option value="Platina" <?= $game['trophy_type'] == 'Platina' ? 'selected' : '' ?>>Platina 🏆</option>
                    <option value="Zlato" <?= $game['trophy_type'] == 'Zlato' ? 'selected' : '' ?>>Zlato 🥇</option>
                    <option value="Stříbro" <?= $game['trophy_type'] == 'Stříbro' ? 'selected' : '' ?>>Stříbro 🥈</option>
                    <option value="Bronz" <?= $game['trophy_type'] == 'Bronz' ? 'selected' : '' ?>>Bronz 🥉</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Odehrané hodiny</label>
                <input type="number" name="playtime_hours" value="<?= (int)$game['playtime_hours'] ?>" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Hodnocení</label>
                <select name="rating_stars" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                    <option value="5" <?= $game['rating_stars'] == 5 ? 'selected' : '' ?>>⭐⭐⭐⭐⭐ (Pecka)</option>
                    <option value="4" <?= $game['rating_stars'] == 4 ? 'selected' : '' ?>>⭐⭐⭐⭐ (Dobré)</option>
                    <option value="3" <?= $game['rating_stars'] == 3 ? 'selected' : '' ?>>⭐⭐⭐ (Průměr)</option>
                    <option value="2" <?= $game['rating_stars'] == 2 ? 'selected' : '' ?>>⭐⭐ (Slabé)</option>
                    <option value="1" <?= $game['rating_stars'] == 1 ? 'selected' : '' ?>>⭐ (Odpad)</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Platforma</label>
                <select name="platform" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                    <option value="PS4" <?= ($game['platform'] ?? '') == 'PS4' ? 'selected' : '' ?>>PlayStation 4</option>
                    <option value="PS5" <?= ($game['platform'] ?? '') == 'PS5' ? 'selected' : '' ?>>PlayStation 5</option>
                    <option value="PC" <?= ($game['platform'] ?? '') == 'PC' ? 'selected' : '' ?>>PC</option>
                    <option value="Switch" <?= ($game['platform'] ?? '') == 'Switch' ? 'selected' : '' ?>>Switch</option>
                </select>
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Odkaz na obchod (např. PlayStation Store)</label>
            <input type="url" name="buy_link" value="<?= htmlspecialchars($game['buy_link'] ?? '') ?>" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition" placeholder="https://store.playstation.com/...">
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Změnit obal hry (nepovinné)</label>
            <input type="file" name="image_file" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500">
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Co mě na hře nejvíc bavilo?</label>
            <textarea name="favorite_part" rows="4" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition"><?= htmlspecialchars($game['favorite_part'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl transition shadow-lg shadow-blue-500/20 uppercase tracking-widest">Aktualizovat hru</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>