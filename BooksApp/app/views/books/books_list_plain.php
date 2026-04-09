<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <title>Knihovna - seznam knih</title>
</head>
<body>
    <header>
        <h1>Aplikace Knihovna</h1>

        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>/index.php">Seznam knih (Domů)</a></li>
                <li><a href="<?= BASE_URL ?>/index.php?url=book/create">Přidat novou knihu</a></li>

            </ul>

        </nav>

        </header>

    <main>
        <h2>Dostupné knihy</h2>
        
        <?php if (!empty($books)): ?>
            <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px; width: 100%; text-align: left;">
                <tr style="background-color: #f2f2f2;">
                    <th>Název</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Rok vydání</th>
                </tr>
                
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                    <td><?php echo htmlspecialchars($book['author']); ?></td>
                    <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                    <td><?php echo htmlspecialchars($book['year']); ?></td>
                </tr>
                
                <td>
                    <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>">Detail</a> | 
                    <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>">Upravit</a> | 
                    <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')">Smazat</a>
                </td>

                <?php endforeach; ?>
                
            </table>
        <?php else: ?>
            <p>Zatím tu nejsou žádné knihy. Běž nějakou přidat!</p>
        <?php endif; ?>
        
        </main>

    <footer>
        <p>&copy; WA 2026 - Výukový projekt</p>
    </footer>
</body>
</html>