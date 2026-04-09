<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Upravit knihu</title>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased p-6">
    
    <div class="max-w-2xl mx-auto">
        <p class="mb-6">
            <a href="<?= BASE_URL ?>/index.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium transition">&larr; Zpět na seznam knih</a>
        </p>

        <div class="bg-white rounded-t-2xl shadow-sm border border-gray-200 border-b-0 p-8 pb-4 flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Upravit knihu</h2>
                <p class="text-gray-500 mt-1">Data pro: <strong class="text-indigo-600"><?= htmlspecialchars($book['title'] ?? '') ?></strong></p>
            </div>
            <span class="bg-gray-100 text-gray-500 text-xs font-bold px-3 py-1 rounded-full border border-gray-200">ID: <?= htmlspecialchars($book['id'] ?? '') ?></span>
        </div>
        
        <div class="bg-white rounded-b-2xl shadow-sm border border-gray-200 p-8 pt-4">
            <form action="<?= BASE_URL ?>/index.php?url=book/update/<?= htmlspecialchars($book['id']) ?>" method="post" enctype="multipart/form-data" class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Název knihy <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title'] ?? '') ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Autor <span class="text-red-500">*</span></label>
                        <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author'] ?? '') ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1">ISBN <span class="text-red-500">*</span></label>
                        <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($book['isbn'] ?? '') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Rok vydání <span class="text-red-500">*</span></label>
                        <input type="number" id="year" name="year" value="<?= htmlspecialchars($book['year'] ?? '') ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategorie</label>
                        <input type="text" id="category" name="category" value="<?= htmlspecialchars($book['category'] ?? '') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-1">Podkategorie</label>
                        <input type="text" id="subcategory" name="subcategory" value="<?= htmlspecialchars($book['subcategory'] ?? '') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Cena knihy (Kč)</label>
                        <input type="number" id="price" name="price" step="0.5" value="<?= htmlspecialchars($book['price'] ?? '') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="link" class="block text-sm font-medium text-gray-700 mb-1">Odkaz</label>
                        <input type="text" id="link" name="link" value="<?= htmlspecialchars($book['link'] ?? '') ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Popis knihy</label>
                    <textarea id="description" name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"><?= htmlspecialchars($book['description'] ?? '') ?></textarea>
                </div>    

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Obrázky (zatím neřešíme)</label>
                    <label class="flex flex-col items-center justify-center w-full p-4 border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 cursor-not-allowed">
                        <span class="text-gray-400 font-medium">Nahrávání obrázků není aktivní</span>
                        <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden" disabled>
                    </label>
                </div>
                
                <div class="pt-4 border-t border-gray-100">
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-4 rounded-lg shadow transition">
                        ✏️ Uložit změny do DB
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>