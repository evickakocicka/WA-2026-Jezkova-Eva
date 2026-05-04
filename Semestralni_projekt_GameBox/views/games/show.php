<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <!-- Horní navigace zpět -->
    <div class="mb-6">
        <a href="<?= BASE_URL ?>/index.php?url=game/index" class="text-blue-400 hover:text-blue-300 flex items-center gap-2 transition font-medium">
            ← Zpět do knihovny
        </a>
    </div>

    <div class="bg-slate-800 rounded-3xl shadow-2xl border border-slate-700 overflow-hidden">
        <!-- Hlavní info o hře -->
        <div class="p-8 border-b border-slate-700 bg-slate-700/30">
            <div class="flex justify-between items-start mb-4">
                <span class="bg-blue-600 text-white text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-widest">
                    <?= htmlspecialchars($game['category']) ?>
                </span>
                <span class="text-4xl">
                    <?php 
                        if ($game['trophy_type'] == 'Bronz') echo '🥉';
                        elseif ($game['trophy_type'] == 'Stříbro') echo '🥈';
                        elseif ($game['trophy_type'] == 'Zlato') echo '🥇';
                        elseif ($game['trophy_type'] == 'Platina') echo '🏆';
                    ?>
                </span>
            </div>
            <h1 class="text-5xl font-black text-white mb-2"><?= htmlspecialchars($game['title']) ?></h1>
            <p class="text-slate-400">Recenzi napsal(a): <span class="text-blue-400 font-bold"><?= htmlspecialchars($game['username'] ?? 'Neznámý hráč') ?></span></p>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Statistiky -->
            <div class="space-y-6">
                <div class="bg-slate-900/50 p-4 rounded-2xl border border-slate-700">
                    <p class="text-slate-500 text-xs uppercase font-bold mb-1">Herní doba</p>
                    <p class="text-2xl font-bold text-white">⏱️ <?= htmlspecialchars($game['playtime_hours']) ?> hodin</p>
                </div>
                <div class="bg-slate-900/50 p-4 rounded-2xl border border-slate-700">
                    <p class="text-slate-500 text-xs uppercase font-bold mb-1">Moje hodnocení</p>
                    <p class="text-2xl text-yellow-400"><?= str_repeat('⭐', $game['rating_stars']) ?></p>
                </div>
                <div class="bg-slate-900/50 p-4 rounded-2xl border border-slate-700">
                    <p class="text-slate-500 text-xs uppercase font-bold mb-1">Doporučení</p>
                    <p class="text-xl font-bold <?= $game['recommend'] ? 'text-green-400' : 'text-red-400' ?>">
                        <?= $game['recommend'] ? '✅ Rozhodně doporučuji!' : '❌ Tentokrát spíše ne.' ?>
                    </p>
                </div>
            </div>

            <!-- Co mě bavilo -->
            <div class="bg-blue-600/5 p-6 rounded-3xl border border-blue-500/20">
                <h3 class="text-blue-400 font-bold uppercase text-sm mb-4 tracking-widest">Co mě na hře nejvíc bavilo?</h3>
                <p class="text-slate-200 leading-relaxed italic">
                    "<?= nl2br(htmlspecialchars($game['favorite_part'])) ?>"
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>