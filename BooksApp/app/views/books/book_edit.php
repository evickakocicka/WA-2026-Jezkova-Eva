<?php require_once '../app/views/layout/header.php'; ?>

<div class="max-w-2xl mx-auto">
    <p class="mb-6">
        <a href="<?= BASE_URL ?>/index.php" class="inline-flex items-center text-pink-400 hover:text-pink-600 font-medium transition">&larr; Zpět na seznam knih</a>
    </p>

    <div class="bg-white rounded-t-3xl shadow-sm border border-pink-100 border-b-0 p-8 pb-4 flex justify-between items-start">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Upravit knihu ✏️</h2>
            <p class="text-pink-400 mt-1">Data pro: <strong class="text-pink-500"><?= htmlspecialchars($book['title'] ?? '') ?></strong></p>
        </div>
        <span class="bg-pink-50 text-pink-400 text-xs font-bold px-3 py-1 rounded-full border border-pink-100">ID: <?= htmlspecialchars($book['id'] ?? '') ?></span>
    </div>
    
    <div class="bg-white rounded-b-3xl shadow-sm border border-pink-100 p-8 pt-4">
        <form action="<?= BASE_URL ?>/index.php?url=book/update/<?= htmlspecialchars($book['id']) ?>" method="post" enctype="multipart/form-data" class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-600 mb-1">Název knihy <span class="text-rose-400">*</span></label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title'] ?? '') ?>" required class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-600 mb-1">Autor <span class="text-rose-400">*</span></label>
                    <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author'] ?? '') ?>" required class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="isbn" class="block text-sm font-medium text-gray-600 mb-1">ISBN <span class="text-rose-400">*</span></label>
                    <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($book['isbn'] ?? '') ?>" class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-600 mb-1">Rok vydání <span class="text-rose-400">*</span></label>
                    <input type="number" id="year" name="year" value="<?= htmlspecialchars($book['year'] ?? '') ?>" required class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-600 mb-1">Kategorie</label>
                    <input type="text" id="category" name="category" value="<?= htmlspecialchars($book['category'] ?? '') ?>" class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="subcategory" class="block text-sm font-medium text-gray-600 mb-1">Podkategorie</label>
                    <input type="text" id="subcategory" name="subcategory" value="<?= htmlspecialchars($book['subcategory'] ?? '') ?>" class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-600 mb-1">Cena knihy (Kč)</label>
                    <input type="number" id="price" name="price" step="0.5" value="<?= htmlspecialchars($book['price'] ?? '') ?>" class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="link" class="block text-sm font-medium text-gray-600 mb-1">Odkaz</label>
                    <input type="text" id="link" name="link" value="<?= htmlspecialchars($book['link'] ?? '') ?>" class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-600 mb-1">Popis knihy</label>
                <textarea id="description" name="description" rows="4" class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition"><?= htmlspecialchars($book['description'] ?? '') ?></textarea>
            </div>    
            
            <div class="pt-4 border-t border-pink-50">
                <button type="submit" class="w-full bg-amber-300 hover:bg-amber-400 text-amber-900 font-bold py-3 px-4 rounded-xl shadow transition">
                    ✨ Uložit změny
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>