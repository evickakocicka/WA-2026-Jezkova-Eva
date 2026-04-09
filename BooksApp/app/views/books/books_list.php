<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Knihovna - seznam knih</title>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">
    
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-600">📚 Aplikace Knihovna</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="<?= BASE_URL ?>/index.php" class="text-gray-600 hover:text-indigo-600 font-medium transition">Seznam knih</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?url=book/create" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium shadow-sm">Přidat novou knihu</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="mb-6 space-y-3">
                <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
                    <?php
                        // Nastavení barev Tailwindu podle typu zprávy
                        $bgClass = 'bg-gray-100';
                        $textClass = 'text-gray-800';
                        $borderClass = 'border-gray-300';

                        if ($type === 'success') {
                            $bgClass = 'bg-green-50';
                            $textClass = 'text-green-800';
                            $borderClass = 'border-green-200';
                        } elseif ($type === 'error') {
                            $bgClass = 'bg-red-50';
                            $textClass = 'text-red-800';
                            $borderClass = 'border-red-200';
                        } elseif ($type === 'notice') {
                            $bgClass = 'bg-yellow-50';
                            $textClass = 'text-yellow-800';
                            $borderClass = 'border-yellow-200';
                        }
                    ?>
                    
                    <?php foreach ($messages as $message): ?>
                        <div class="p-4 rounded-lg border <?= $bgClass ?> <?= $textClass ?> <?= $borderClass ?> shadow-sm">
                            <strong><?= htmlspecialchars($message) ?></strong>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
            
            <?php 
                // ZÁSADNÍ KROK: Vymazání zpráv po zobrazení
                unset($_SESSION['messages']); 
            ?>
        <?php endif; ?>
        <div class="mb-6">
            <h2 class="text-3xl font-extrabold text-gray-900">Dostupné knihy</h2>
            <p class="text-gray-500 mt-2">Přehled všech knih uložených v databázi.</p>
        </div>
        
        <?php if (!empty($books)): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-4 uppercase tracking-wider">Název</th>
                                <th class="px-6 py-4 uppercase tracking-wider">Autor</th>
                                <th class="px-6 py-4 uppercase tracking-wider">ISBN</th>
                                <th class="px-6 py-4 uppercase tracking-wider">Rok</th>
                                <th class="px-6 py-4 uppercase tracking-wider text-right">Akce</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <?php foreach ($books as $book): ?>
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 font-semibold text-gray-900"><?php echo htmlspecialchars($book['title']); ?></td>
                                <td class="px-6 py-4 text-gray-600"><?php echo htmlspecialchars($book['author']); ?></td>
                                <td class="px-6 py-4 text-gray-500"><?php echo htmlspecialchars($book['isbn']); ?></td>
                                <td class="px-6 py-4 text-gray-500"><?php echo htmlspecialchars($book['year']); ?></td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" class="text-indigo-600 hover:text-indigo-900 font-medium">Detail</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="text-amber-500 hover:text-amber-700 font-medium">Upravit</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')" class="text-red-500 hover:text-red-700 font-medium">Smazat</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-10 text-center">
                <span class="text-4xl">📖</span>
                <p class="mt-4 text-lg text-gray-600 font-medium">Zatím tu nejsou žádné knihy.</p>
                <a href="<?= BASE_URL ?>/index.php?url=book/create" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-semibold">Běž nějakou přidat &rarr;</a>
            </div>
        <?php endif; ?>
    </main>

    <footer class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 border-t border-gray-200 text-center text-gray-500 text-sm mt-10">
        <p>&copy; WA 2026 - Výukový projekt (Nastylováno Tailwindem ✨)</p>
    </footer>
</body>
</html>