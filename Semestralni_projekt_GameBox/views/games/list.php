<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="mb-10 flex justify-between items-end border-b border-slate-800 pb-8">
    <div>
        <h2 class="text-4xl font-extrabold text-white drop-shadow-md">
            Vítej zpět v akci! 🚀
        </h2>
        <p class="text-blue-400 mt-2 font-medium tracking-wide uppercase text-sm">
            Tvoje osobní síň slávy a dohraných her
        </p>
    </div>
    
    <a href="<?= BASE_URL ?>/index.php?url=game/create" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-2xl shadow-lg shadow-blue-500/40 transition-all transform hover:scale-105 active:scale-95">
        + Přidat hru
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (!empty($games)): ?>
        <?php foreach ($games as $game): ?>
            <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 p-6 flex flex-col h-full hover:border-blue-500/50 hover:shadow-blue-500/20 transition duration-300">
                <div class="flex justify-between items-start mb-4">
                    <span class="bg-blue-900/50 text-blue-400 text-xs font-bold px-3 py-1 rounded-full border border-blue-800/50 uppercase tracking-wide">
                        <?= htmlspecialchars($game['category']) ?>
                    </span>
                    <span class="text-2xl drop-shadow-md">
                        <?php 
                            if ($game['trophy_type'] == 'Bronz') echo '🥉';
                            elseif ($game['trophy_type'] == 'Stříbro') echo '🥈';
                            elseif ($game['trophy_type'] == 'Zlato') echo '🥇';
                            elseif ($game['trophy_type'] == 'Platina') echo '🏆';
                            else echo '❌';
                        ?>
                    </span>
                </div>
                
                <h3 class="text-xl font-bold text-slate-100 mb-1"><?= htmlspecialchars($game['title']) ?></h3>
                <p class="text-sm text-slate-400 mb-4">Přidal(a): <span class="font-medium text-blue-400"><?= htmlspecialchars($game['username'] ?? 'Neznámý hráč') ?></span></p>
                
                <div class="mt-auto pt-4 border-t border-slate-700 flex justify-between items-center text-sm text-slate-300">
                    <span class="font-medium bg-slate-900 px-3 py-1 rounded-lg border border-slate-700">⏱️ <?= htmlspecialchars($game['playtime_hours']) ?> hod</span>
                    <span class="text-yellow-400 tracking-widest text-lg drop-shadow-sm">
                        <?= str_repeat('⭐', $game['rating_stars']) ?>
                    </span>
                </div>
                
                <a href="<?= BASE_URL ?>/index.php?url=game/show/<?= $game['id'] ?>" class="mt-5 block text-center bg-slate-700 hover:bg-blue-600 text-white font-semibold py-2 rounded-xl transition duration-300">
                    Detail & Diskuze 💬
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full bg-slate-800 rounded-2xl border border-slate-700 p-12 text-center text-slate-400">
            Zatím tu není žádná hra. Přidej první kousek do sbírky! 🎮
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>