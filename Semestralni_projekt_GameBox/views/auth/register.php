<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-md mx-auto bg-slate-800 rounded-2xl shadow-2xl border border-slate-700 p-8 mt-10">
    <h2 class="text-3xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500 mb-6 drop-shadow-md">
        Nová registrace 🏆
    </h2>
    
    <form action="<?= BASE_URL ?>/index.php?url=auth/register" method="POST" class="space-y-5">
        <div>
            <label class="block text-sm font-semibold text-blue-400 mb-1">Přezdívka (Username)</label>
            <input type="text" name="username" required class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
        </div>
        <div>
            <label class="block text-sm font-semibold text-blue-400 mb-1">Tvoje tajné heslo</label>
            <input type="password" name="password" required class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
        </div>
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-4 rounded-xl transition duration-300 shadow-lg shadow-indigo-500/30 hover:shadow-indigo-400/50 mt-4">
            Vytvořit účet ✨
        </button>
    </form>

    <div class="mt-6 text-center text-slate-400">
        Už máš účet? <a href="<?= BASE_URL ?>/index.php?url=auth/login" class="text-blue-400 hover:text-blue-300 font-bold transition">Přihlas se!</a>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>