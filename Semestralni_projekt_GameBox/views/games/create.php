<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-black text-white mb-8">Přidat novou <span class="text-blue-500">hru</span></h1>

    <form action="<?= BASE_URL ?>/index.php?url=game/store" method="POST" enctype="multipart/form-data" class="bg-slate-800 rounded-3xl p-8 border border-slate-700 shadow-2xl space-y-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Název hry</label>
                <input type="text" name="title" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition" placeholder="Např. Bratz: Flaunt Your Fashion">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Kategorie</label>
                <select name="category" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                    <option value="Akční adventura">Akční adventura</option>
                    <option value="RPG">RPG</option>
                    <option value="Střílečka">Střílečka</option>
                    <option value="Sportovní">Sportovní</option>
                    <option value="Horror">Horror</option>
                    <option value="Simulátor">Simulátor / Ostatní</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Platforma</label>
                <select name="platform" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                    <option value="PS4">PlayStation 4</option>
                    <option value="PS5">PlayStation 5</option>
                    <option value="PC">PC</option>
                    <option value="Switch">Nintendo Switch</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Nejlepší získaná trofej ve hře</label>
                <select name="trophy_type" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                    <option value="Bez trofejí">Bez trofejí / Nemá</option>
                    <option value="Platina">Platina 🏆</option>
                    <option value="Zlato">Zlato 🥇</option>
                    <option value="Stříbro">Stříbro 🥈</option>
                    <option value="Bronz">Bronz 🥉</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Odehrané hodiny</label>
                <input type="number" name="playtime_hours" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition" placeholder="0">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Hodnocení (1-5 hvězd)</label>
                <select name="rating_stars" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                    <option value="5">⭐⭐⭐⭐⭐ (Pecka)</option>
                    <option value="4">⭐⭐⭐⭐ (Dobré)</option>
                    <option value="3">⭐⭐⭐ (Průměr)</option>
                    <option value="2">⭐⭐ (Slabé)</option>
                    <option value="1">⭐ (Odpad)</option>
                </select>
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Odkaz na obchod (např. PlayStation Store)</label>
            <input type="url" name="buy_link" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition" placeholder="https://store.playstation.com/...">
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Obal hry (Obrázek)</label>
            <input type="file" name="image_file" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500">
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Co mě na hře nejvíc bavilo?</label>
            <textarea name="favorite_part" rows="4" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition" placeholder="Popiš své zážitky..."></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl transition shadow-lg shadow-blue-500/20 uppercase tracking-widest">Uložit hru do katalogu</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>