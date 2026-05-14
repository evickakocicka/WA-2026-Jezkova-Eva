<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-4xl mx-auto pb-10">
    <div class="mb-6">
        <a href="<?= BASE_URL ?>/index.php?url=game/index" class="text-blue-400 hover:text-blue-300 flex items-center gap-2 transition font-medium">
            ← Zpět do knihovny
        </a>
    </div>

    <div class="bg-slate-800 rounded-3xl shadow-2xl border border-slate-700 overflow-hidden text-center p-10 mb-10">
        <div class="inline-block bg-blue-600 p-6 rounded-full shadow-lg shadow-blue-500/50 mb-6">
            <span class="text-6xl">👾</span>
        </div>
        <h1 class="text-5xl font-black text-white mb-2"><?= htmlspecialchars($_SESSION['username']) ?></h1>
        <p class="text-blue-400 font-bold uppercase tracking-widest text-sm mb-10">
            <?= (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') ? '🛡️ Administrátor systému' : 'Herní karta hráče' ?>
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-slate-900/80 p-8 rounded-3xl border border-slate-700">
                <h3 class="text-slate-400 text-xs font-bold uppercase mb-2">Dohrané hry</h3>
                <p class="text-5xl font-black text-white"><?= $totalGames ?></p>
            </div>
            <div class="bg-slate-900/80 p-8 rounded-3xl border border-slate-700">
                <h3 class="text-slate-400 text-xs font-bold uppercase mb-2">Nahrané hodiny</h3>
                <p class="text-5xl font-black text-purple-400"><?= $totalHours ?></p>
            </div>
            <div class="bg-slate-900/80 p-8 rounded-3xl border border-slate-700">
                <h3 class="text-slate-400 text-xs font-bold uppercase mb-2">Získané lajky</h3>
                <p class="text-5xl font-black text-red-400"><?= $totalLikes ?></p>
            </div>
        </div>

        <div class="bg-slate-900/50 p-8 rounded-3xl border border-slate-700 text-left max-w-lg mx-auto">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">🛠️ Nastavení účtu</h3>
            <form action="<?= BASE_URL ?>/index.php?url=auth/update" method="POST" class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase">Uživatelské jméno</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($_SESSION['username']) ?>" class="w-full bg-slate-800 border border-slate-600 rounded-xl px-4 py-2 text-white outline-none focus:border-blue-500 transition">
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase">Nové heslo (nechte prázdné pro zachování)</label>
                    <input type="password" name="password" class="w-full bg-slate-800 border border-slate-600 rounded-xl px-4 py-2 text-white outline-none focus:border-blue-500 transition">
                </div>
                <button type="submit" class="w-full bg-slate-700 hover:bg-blue-600 text-white font-bold py-3 rounded-xl transition">Uložit změny</button>
            </form>
            <div class="mt-6 pt-6 border-t border-slate-700">
                <a href="<?= BASE_URL ?>/index.php?url=auth/deleteSelf" onclick="return confirm('Opravdu chceš smazat svůj účet? Všechny tvé hry budou pryč!')" class="text-red-500 hover:text-red-400 text-sm font-bold transition">Smazat můj účet 🗑️</a>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <div class="bg-red-900/10 border border-red-500/30 rounded-3xl p-8 shadow-xl">
            <h2 class="text-2xl font-black text-red-400 mb-6 flex items-center gap-2">🛡️ Administrační panel</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-500 text-xs uppercase border-b border-red-500/20">
                            <th class="pb-4">ID</th>
                            <th class="pb-4">Uživatel</th>
                            <th class="pb-4">Role</th>
                            <th class="pb-4 text-right">Akce</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-300">
                        <?php foreach ($allUsers as $u): ?>
                            <tr class="border-b border-slate-800">
                                <td class="py-4"><?= $u['id'] ?></td>
                                <td class="py-4 font-bold text-white"><?= htmlspecialchars($u['username']) ?></td>
                                <td class="py-4 uppercase text-xs"><?= $u['role'] ?></td>
                                <td class="py-4 text-right">
                                    <a href="<?= BASE_URL ?>/index.php?url=auth/adminDeleteUser/<?= $u['id'] ?>" onclick="return confirm('Smazat tohoto uživatele?')" class="bg-red-600 hover:bg-red-500 text-white text-xs font-bold py-1 px-3 rounded-lg transition">Smazat 🗑️</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>