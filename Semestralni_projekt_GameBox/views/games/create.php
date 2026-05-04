<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-2xl mx-auto bg-slate-800 rounded-3xl shadow-2xl border border-slate-700 overflow-hidden">
    <!-- Header formuláře -->
    <div class="bg-slate-700/50 p-6 border-b border-slate-600">
        <h2 class="text-2xl font-bold text-white flex items-center gap-3">
            <span class="bg-blue-600 p-2 rounded-lg text-xl">➕</span>
            Přidat novou hru
        </h2>
        <p class="text-slate-400 text-sm mt-1">Zapiš si další pokořený titul do své sbírky.</p>
    </div>

    <!-- Formulář -->
    <form action="<?= BASE_URL ?>/index.php?url=game/store" method="POST" class="p-8 space-y-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Název hry -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-blue-400 mb-2 uppercase tracking-wider">Název hry</label>
                <input type="text" name="title" required placeholder="Např. The Last of Us Part II" 
                    class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
            </div>

            <!-- Kategorie -->
            <div>
                <label class="block text-sm font-semibold text-blue-400 mb-2 uppercase tracking-wider">Kategorie / Žánr</label>
                <select name="category" class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                    <option value="RPG">RPG</option>
                    <option value="Akční adventura">Akční adventura</option>
                    <option value="Střílečka">Střílečka</option>
                    <option value="Sportovní">Sportovní</option>
                    <option value="Závodní">Závodní</option>
                    <option value="Horror">Horror</option>
                </select>
            </div>

            <!-- Herní doba -->
            <div>
                <label class="block text-sm font-semibold text-blue-400 mb-2 uppercase tracking-wider">Herní doba (hodiny)</label>
                <input type="number" name="playtime_hours" required placeholder="40" 
                    class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
            </div>

            <!-- Trofej -->
            <div>
                <label class="block text-sm font-semibold text-blue-400 mb-2 uppercase tracking-wider">Získaná trofej</label>
                <select name="trophy_type" class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                    <option value="Bronz">🥉 Bronzová</option>
                    <option value="Stříbro">🥈 Stříbrná</option>
                    <option value="Zlato">🥇 Zlatá</option>
                    <option value="Platina">🏆 Platinová</option>
                </select>
            </div>

            <!-- Hodnocení -->
            <div>
                <label class="block text-sm font-semibold text-blue-400 mb-2 uppercase tracking-wider">Hodnocení (1-5 hvězd)</label>
                <input type="number" name="rating_stars" min="1" max="5" value="5" 
                    class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition">
            </div>
        </div>

        <!-- Co tě nejvíc bavilo -->
        <div>
            <label class="block text-sm font-semibold text-blue-400 mb-2 uppercase tracking-wider">Co tě na hře nejvíc bavilo?</label>
            <textarea name="favorite_part" rows="3" placeholder="Příběh, grafika, soubojový systém..." 
                class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 transition"></textarea>
        </div>

        <!-- Doporučení -->
        <div class="flex items-center gap-3 bg-slate-900/50 p-4 rounded-xl border border-slate-700">
            <input type="checkbox" name="recommend" value="1" id="recommend" class="w-5 h-5 accent-blue-500">
            <label for="recommend" class="text-slate-300 font-medium cursor-pointer">Doporučil(a) bys hru ostatním?</label>
        </div>

        <!-- Tlačítka -->
        <div class="flex gap-4 pt-4">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-blue-500/20">
                Uložit hru do sbírky
            </button>
            <a href="<?= BASE_URL ?>/index.php?url=game/index" class="px-8 bg-slate-700 hover:bg-slate-600 text-white font-bold py-4 rounded-xl transition text-center">
                Zpět
            </a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>