<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>...</title>
</head>

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



    <div class="container mx-auto px-6 pt-8">
        <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="space-y-3">
                <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
                    <?php 
                        $styles = [
                            'success' => 'bg-emerald-900/30 border-emerald-500 text-emerald-400',
                            'error'   => 'bg-rose-900/30 border-rose-500 text-rose-400',
                            'notice'  => 'bg-amber-900/30 border-amber-500 text-amber-400',
                        ];
                        $style = $styles[$type] ?? 'bg-slate-800 border-slate-500 text-slate-300';
                    ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="<?= $style ?> border-l-4 p-4 rounded-r-lg shadow-md animate-fade-in">
                            <p class="font-semibold text-sm italic"><?= htmlspecialchars($message) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION['messages']); ?>
            </div>
        <?php endif; ?>
    </div>