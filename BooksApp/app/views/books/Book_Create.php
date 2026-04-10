<?php require_once '../app/views/layout/header.php'; ?>

<div class="max-w-2xl mx-auto">
    <a href="<?= BASE_URL ?>/index.php" class="inline-flex items-center text-pink-400 hover:text-pink-600 mb-6 font-medium transition">
        &larr; Zpět na seznam knih
    </a>

    <div class="bg-white rounded-t-3xl shadow-sm border border-pink-100 border-b-0 p-8 pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Přidat novou knihu 🎀</h2>
        <p class="text-pink-400 mt-1">Vyplň údaje a ulož knihu do své sbírky.</p>
    </div>

    <div class="bg-white rounded-b-3xl shadow-sm border border-pink-100 p-8 pt-4">
         <form action="<?= BASE_URL ?>/index.php?url=book/store" method="post" enctype="multipart/form-data" class="space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-600 mb-1">Název knihy <span class="text-rose-400">*</span></label>
                    <input type="text" name="title" id="title" required class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-600 mb-1">Autor <span class="text-rose-400">*</span></label>
                    <input type="text" name="author" id="author" placeholder="Příjmení Jméno" required class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="isbn" class="block text-sm font-medium text-gray-600 mb-1">ISBN <span class="text-rose-400">*</span></label>
                    <input type="text" name="isbn" id="isbn" required class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-600 mb-1">Rok vydání <span class="text-rose-400">*</span></label>
                    <input type="number" name="year" id="year" required class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-600 mb-1">Kategorie</label>
                    <input type="text" name="category" id="category" class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="subcategory" class="block text-sm font-medium text-gray-600 mb-1">Podkategorie</label>
                    <input type="text" name="subcategory" id="subcategory" class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-600 mb-1">Cena knihy (Kč)</label>
                    <input type="number" name="price" id="price" step="0.05" required class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
                <div>
                    <label for="link" class="block text-sm font-medium text-gray-600 mb-1">Odkaz na knihu</label>
                    <input type="text" name="link" id="link" class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-600 mb-1">Popis knihy</label>
                <textarea name="description" id="description" rows="4" class="w-full border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:border-pink-300 outline-none transition"></textarea>
            </div>

            <div>
                <label