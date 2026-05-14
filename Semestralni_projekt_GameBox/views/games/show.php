<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-5xl mx-auto pb-20">
    <div class="mb-8 flex items-center justify-between">
        <a href="<?= BASE_URL ?>/index.php?url=game/index" class="text-slate-400 hover:text-white flex items-center gap-2 transition font-medium">
            ← Zpět do katalogu
        </a>
        
        <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $game['author_id'] || (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'))): ?>
            <div class="flex gap-3">
                <a href="<?= BASE_URL ?>/index.php?url=game/edit/<?= $game['id'] ?>" class="bg-slate-700 hover:bg-slate-600 text-white px-5 py-2 rounded-xl text-sm font-bold transition">Upravit</a>
                <a href="<?= BASE_URL ?>/index.php?url=game/delete/<?= $game['id'] ?>" onclick="return confirm('Opravdu smazat?')" class="bg-red-600/20 hover:bg-red-600 text-red-500 hover:text-white px-5 py-2 rounded-xl text-sm font-bold transition">Smazat</a>
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-slate-800 rounded-3xl shadow-2xl border border-slate-700 overflow-hidden mb-12">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 bg-slate-900 flex items-center justify-center p-6 border-r border-slate-700">
                <?php if ($game['image_url']): ?>
                    <img src="<?= BASE_URL ?>/<?= htmlspecialchars($game['image_url']) ?>" 
                         class="max-h-80 w-auto object-contain shadow-2xl rounded-lg" 
                         alt="Obal hry">
                <?php else: ?>
                    <div class="text-8xl">🎮</div>
                <?php endif; ?>
            </div>

            <div class="md:w-2/3 p-10 flex flex-col justify-center">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <span class="bg-blue-600 text-white text-xs font-black uppercase px-3 py-1 rounded-full"><?= htmlspecialchars($game['category']) ?></span>
                        <span class="text-slate-500 font-bold">•</span>
                        <span class="text-slate-400 font-bold"><?= htmlspecialchars($game['platform'] ?? 'Nezadáno') ?></span>
                    </div>
                    <div class="flex items-center gap-2 text-pink-500 font-bold bg-pink-500/10 px-4 py-2 rounded-2xl border border-pink-500/20">
                        ❤️ <?= $game['likes_count'] ?? 0 ?>
                    </div>
                </div>
                
                <h1 class="text-5xl font-black text-white mb-4 leading-tight"><?= htmlspecialchars($game['title']) ?></h1>
                <p class="text-slate-500 mb-8 italic">Přidal(a) hráč: <span class="text-blue-400 font-bold"><?= htmlspecialchars($game['username'] ?? 'Neznámý') ?></span></p>

                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="bg-slate-900/40 p-4 rounded-2xl border border-slate-700/50 text-center">
                        <p class="text-slate-500 text-[10px] font-bold uppercase mb-1 tracking-widest">Doba hraní</p>
                        <p class="text-xl font-black text-white"><?= (int)$game['playtime_hours'] ?> h</p>
                    </div>
                    <div class="bg-slate-900/40 p-4 rounded-2xl border border-slate-700/50 text-center">
                        <p class="text-slate-500 text-[10px] font-bold uppercase mb-1 tracking-widest">Nejlepší trofej</p>
                        <?php 
                            $trophy = trim($game['trophy_type'] ?? '');
                            $noTrophyKeywords = ['zadna', 'žádná', 'není', 'neni', '---', '-', '0', 'bez trofejí'];
                            $isNoTrophy = empty($trophy) || in_array(mb_strtolower($trophy), $noTrophyKeywords);
                        ?>
                        <p class="text-xl font-black <?= $isNoTrophy ? 'text-slate-500' : 'text-yellow-500' ?>">
                            <?= $isNoTrophy ? 'Bez trofejí' : htmlspecialchars($trophy) ?>
                        </p>
                    </div>
                </div>

                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $game['author_id']): ?>
                    <a href="<?= BASE_URL ?>/index.php?url=game/like/<?= $game['id'] ?>" class="inline-flex items-center gap-2 bg-pink-600 hover:bg-pink-500 text-white px-8 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-pink-500/30 w-fit">
                        ❤️ Dát lajk hře
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="p-10 bg-slate-800/50 border-t border-slate-700 grid grid-cols-1 md:grid-cols-2 gap-10">
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase mb-3 tracking-widest">Moje hodnocení</p>
                <div class="text-3xl text-yellow-500 flex gap-1">
                    <?= str_repeat('⭐', (int)$game['rating_stars']) ?>
                </div>
            </div>
            <div class="bg-blue-600/5 p-6 rounded-3xl border border-blue-500/20">
                <h3 class="text-blue-400 font-bold uppercase text-xs mb-3 tracking-widest">Co mě na hře nejvíc bavilo?</h3>
                <p class="text-slate-200 leading-relaxed italic">"<?= nl2br(htmlspecialchars($game['favorite_part'] ?? '')) ?>"</p>
            </div>
        </div>
    </div>

    <div class="bg-slate-800 rounded-3xl shadow-xl border border-slate-700 p-8">
        <h2 class="text-2xl font-extrabold text-white mb-6">💬 Komentáře</h2>
        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="<?= BASE_URL ?>/index.php?url=game/addComment/<?= $game['id'] ?>" method="POST" class="mb-8">
                <textarea name="text" rows="3" required class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white mb-3 focus:border-blue-500 outline-none transition" placeholder="Přidej svůj názor..."></textarea>
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-6 rounded-xl transition">Odeslat komentář</button>
            </form>
        <?php endif; ?>
        
        <div class="space-y-4">
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="bg-slate-900 p-5 rounded-2xl border border-slate-700 flex justify-between items-start">
                        <div>
                            <span class="font-bold text-blue-400"><?= htmlspecialchars($comment['username']) ?></span>
                            <p class="text-slate-300 mt-1"><?= nl2br(htmlspecialchars($comment['text'])) ?></p>
                        </div>
                        
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $comment['user_id']): ?>
                            <a href="<?= BASE_URL ?>/index.php?url=game/likeComment/<?= $comment['id'] ?>" class="text-pink-500 bg-pink-500/10 px-3 py-1 rounded-full text-sm font-bold flex items-center gap-2 border border-pink-500/20 hover:bg-pink-500/20 transition-all">
                                ❤️ <?= $comment['likes_count'] ?>
                            </a>
                        <?php else: ?>
                            <span class="text-slate-500 bg-slate-500/5 px-3 py-1 rounded-full text-sm font-bold flex items-center gap-2 border border-slate-700">
                                ❤️ <?= $comment['likes_count'] ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-slate-500 italic text-center py-4 text-sm">Zatím žádné komentáře.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>