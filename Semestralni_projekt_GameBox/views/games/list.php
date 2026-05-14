<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
    <div class="flex flex-col md:flex-row items-center gap-6">
        <h1 class="text-4xl font-black text-white tracking-tight">Herní <span class="text-blue-500">Svět</span></h1>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="<?= BASE_URL ?>/index.php?url=game/create" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-2xl transition shadow-lg shadow-blue-500/30 flex items-center gap-2 font-bold text-sm">
                <span class="text-xl leading-none">+</span> Přidat hru
            </a>
        <?php endif; ?>
    </div>
    
    <form action="index.php" method="GET" class="relative w-full md:w-80">
        <input type="hidden" name="url" value="game/index">
        <input type="text" name="search" value="<?= htmlspecialchars($search ?? '') ?>" 
               placeholder="Hledat hru..." 
               class="w-full bg-slate-800 border border-slate-700 rounded-2xl py-3 px-5 pl-12 text-white outline-none focus:border-blue-500 transition-all shadow-lg">
        <span class="absolute left-4 top-3.5 text-slate-500">🔍</span>
    </form>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
    <?php if (!empty($games)): ?>
        <?php foreach ($games as $game): ?>
            <div class="bg-slate-800 rounded-3xl overflow-hidden border border-slate-700 hover:border-blue-500/50 transition-all hover:-translate-y-2 hover:shadow-2xl group">
                
                <a href="<?= BASE_URL ?>/index.php?url=game/show/<?= $game['id'] ?>">
                    <div class="h-56 w-full bg-slate-900 flex items-center justify-center border-b border-slate-700">
                        <?php if (!empty($game['image_url'])): ?>
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($game['image_url']) ?>" 
                                 class="h-56 max-w-full object-contain transition-transform duration-500 group-hover:scale-105" 
                                 alt="Obal hry">
                        <?php else: ?>
                            <div class="text-slate-700 text-4xl italic">🎮</div>
                        <?php endif; ?>
                    </div>
                </a>

                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs font-bold text-blue-400 uppercase tracking-widest"><?= htmlspecialchars($game['category']) ?></span>
                        <div class="flex text-yellow-500 text-xs">
                            <?= str_repeat('⭐', (int)$game['rating_stars']) ?>
                        </div>
                    </div>
                    
                    <h2 class="text-xl font-bold text-white mb-1 line-clamp-1">
                        <a href="<?= BASE_URL ?>/index.php?url=game/show/<?= $game['id'] ?>" class="hover:text-blue-400 transition">
                            <?= htmlspecialchars($game['title']) ?>
                        </a>
                    </h2>
                    
                    <p class="text-slate-500 text-[10px] mb-4">Hráč: <span class="text-slate-300 font-bold"><?= htmlspecialchars($game['username'] ?? 'Neznámý') ?></span></p>

                    <div class="flex items-center justify-between pt-4 border-t border-slate-700/50">
                        <span class="text-slate-400 text-sm font-medium italic">⏱️ <?= (int)$game['playtime_hours'] ?>h</span>
                        <a href="<?= BASE_URL ?>/index.php?url=game/show/<?= $game['id'] ?>" 
                           class="text-blue-500 hover:text-blue-400 text-sm font-bold flex items-center gap-1 group">
                            Detail <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full py-20 text-center bg-slate-800/50 rounded-3xl border-2 border-dashed border-slate-700">
            <p class="text-slate-500 text-lg italic mb-4 text-center">Zatím tu není žádná hra.</p>
            <a href="<?= BASE_URL ?>/index.php?url=game/create" class="text-blue-500 font-bold hover:underline">Přidej první kousek! 🎮</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>