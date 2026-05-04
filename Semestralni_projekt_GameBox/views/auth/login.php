<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-md mx-auto bg-slate-800 rounded-2xl shadow-2xl border border-slate-700 p-8 mt-10">
    <h2 class="text-3xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500 mb-6 drop-shadow-md">
        Přihlášení hráče 🎮
    </h2>

    <?php if (isset($error)): ?>
        <div class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-3 rounded-lg mb-6 text-center font-medium">
            <?= $error ?>
        </div>
    <?php endif; ?>
    
    <form action="<?= BASE_URL ?>/index.php?url=auth/login" method="POST" class="space-y-5">
        <div>
            <label class="block text-sm font-semibold text-blue-400 mb-1">Přezdívka (Username)</label>
            <input type="text" name="username" required class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
        </div>
        <div>
            <label class="block text-sm font-semibold text-blue-400 mb-1">Heslo</label>
            <input type="password" name="password" required class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl transition duration-300 shadow-lg shadow-blue-500/30 hover:shadow-blue-400/50 mt-4">
            Vstoupit do GameBoxu 🚀
        </button>
    </form>

    <div class="mt-6 text-center text-slate-400">
        Nemáš ještě účet? <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="text-blue-400 hover:text-blue-300 font-bold transition">Zaregistruj se!</a>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>