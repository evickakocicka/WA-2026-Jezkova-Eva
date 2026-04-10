<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PinkLib - Aplikace Knihovna 🌸</title>
</head>
<body class="bg-pink-50 text-gray-800 font-sans antialiased">
    
    <header class="bg-white shadow-sm border-b-2 border-[#F472B6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            
            <a href="<?= BASE_URL ?>/index.php" class="flex items-center gap-3 group">
                <img src="images/logo.png" alt="PinkLib Logo" class="h-10 w-auto transition-transform group-hover:scale-110">
                <span class="text-2xl font-bold text-[#F472B6]">PinkLib</span>
            </a>

            <nav>
                <ul class="flex space-x-6 items-center">
                    <li><a href="<?= BASE_URL ?>/index.php" class="text-gray-500 hover:text-[#F472B6] font-medium transition">Seznam knih</a></li>
                    <li>
                        <a href="<?= BASE_URL ?>/index.php?url=book/create" 
                           class="bg-[#F472B6] text-white px-5 py-2 rounded-full hover:opacity-90 transition font-medium shadow-sm flex items-center gap-2">
                           ➕ <span class="hidden sm:inline">Přidat knihu</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="mb-6 space-y-3">
                <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
                    <?php
                        $bgClass = 'bg-white';
                        $textClass = 'text-gray-800';
                        $borderClass = 'border-pink-200';

                        if ($type === 'success') {
                            $bgClass = 'bg-green-50';
                            $textClass = 'text-green-600';
                            $borderClass = 'border-green-200';
                        } elseif ($type === 'error') {
                            $bgClass = 'bg-rose-50';
                            $textClass = 'text-rose-600';
                            $borderClass = 'border-rose-200';
                        } elseif ($type === 'notice') {
                            $bgClass = 'bg-amber-50';
                            $textClass = 'text-amber-600';
                            $borderClass = 'border-amber-200';
                        }
                    ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="p-4 rounded-2xl border <?= $bgClass ?> <?= $textClass ?> <?= $borderClass ?> shadow-sm flex items-center">
                            <strong><?= htmlspecialchars($message) ?></strong>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
            <?php unset($_SESSION['messages']); ?>
        <?php endif; ?>