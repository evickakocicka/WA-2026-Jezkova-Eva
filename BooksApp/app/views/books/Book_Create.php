<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Přidat novou knihu</title>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased p-6">
    
    <div class="max-w-2xl mx-auto">
        <a href="/WA-2026-Jezkova-Eva/BooksApp/public/index.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6 font-medium transition">
            &larr; Zpět na seznam knih
        </a>

        <div class="bg-white rounded-t-2xl shadow-sm border border-gray-200 border-b-0 p-8 pb-4">
            <h2 class="text-2xl font-bold text-gray-900">Přidat novou knihu</h2>
            <p class="text-gray-500 mt-1">Vyplňte údaje a uložte knihu do databáze.</p>
        </div>

        <div class="bg-white rounded-b-2xl shadow-sm border border-gray-200 p-8 pt-4">
             <form action="/WA-2026-Jezkova-Eva/BooksApp/public/index.php?url=book/store" method="post" enctype="multipart/form-data" class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Název knihy <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Autor <span class="text-red-500">*</span></label>
                        <input type="text" name="author" id="author" placeholder="Příjmení Jméno" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1">ISBN <span class="text-red-500">*</span></label>
                        <input type="text" name="isbn" id="isbn" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Rok vydání <span class="text-red-500">*</span></label>
                        <input type="number" name="year" id="year" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategorie</label>
                        <input type="text" name="category" id="category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-1">Podkategorie</label>
                        <input type="text" name="subcategory" id="subcategory" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Cena knihy (Kč)</label>
                        <input type="number" name="price" id="price" step="0.05" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label for="link" class="block text-sm font-medium text-gray-700 mb-1">Odkaz na knihu</label>
                        <input type="text" name="link" id="link" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Popis knihy</label>
                    <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Obrázky (můžete nahrát více)</label>
                    <label class="flex flex-col items-center justify-center w-full p-6 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-indigo-500 hover:bg-indigo-50 transition">
                        <span class="text-indigo-600 font-medium">Klikni pro výběr souborů</span>
                        <span class="text-sm text-gray-400 mt-1">JPG / PNG / WebP</span>
                        <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                    </label>
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg shadow transition">
                        💾 Uložit knihu do DB
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>