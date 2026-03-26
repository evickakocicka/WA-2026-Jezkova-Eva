<?php
// Načtení potřebných souborů
require_once '../app/models/Database.php';
require_once '../app/models/Book.php';

class BookController {

    // Zobrazení seznamu knih
    public function index() {
        // Připojíme databázi a vytvoříme prázdné pole pro knihy
        $database = new Database();
        $db = $database->getConnection();
        $books = [];

        // Pokud spojení funguje, vytáhneme knihy přes model
        if ($db) {
            $bookModel = new Book($db);
            $books = $bookModel->getAllBooks(); 
        }

        // Tady posíláme knihy (proměnnou $books) na tvůj HTML talíř
        require_once '../app/views/books/books_list.php';
    }
    // Zobrazení formuláře
    public function create() {
        require_once '../app/views/books/Book_Create.php';
    }

    // TADY JE TVŮJ ÚKOL: Zpracování formuláře a uložení do DB
    public function store() {
        // Zkontrolujeme, jestli sem uživatel opravdu odeslal formulář
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // 1. Připojení k databázi
            $database = new Database();
            $db = $database->getConnection();
            
            if (!$db) {
                die("Nepodařilo se připojit k databázi.");
            }

            // 2. Vytvoření modelu, který jsme napsali v předchozím kroku
            $bookModel = new Book($db);
            
            // 3. Natažení dat z políček formuláře
            $title = $_POST['title'] ?? '';
            $author = $_POST['author'] ?? '';
            $isbn = $_POST['isbn'] ?? '';
            $year = $_POST['year'] ?? '';

            // 4. Pokus o uložení do databáze
            if ($bookModel->save($title, $author, $isbn, $year)) {
                // Když se to povede, přesměrujeme tě zpět na hlavní stránku
                header('Location: /WA-2026-Jezkova-Eva/BooksApp/public/index.php');
                exit;
            } else {
                echo "Došlo k chybě při ukládání do databáze.";
            }
        }
    }
}