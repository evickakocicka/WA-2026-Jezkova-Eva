<?php
// Načtení potřebných souborů
require_once '../app/models/Database.php';
require_once '../app/models/Book.php';

class BookController {

    // Zobrazení seznamu knih
    public function index() {
        $database = new Database();
        $db = $database->getConnection();
        $books = [];

        if ($db) {
            $bookModel = new Book($db);
            $books = $bookModel->getAllBooks(); 
        }

        require_once '../app/views/books/books_list.php';
    }

    // Zobrazení formuláře pro novou knihu
    public function create() {
        require_once '../app/views/books/Book_Create.php';
    }

    // Zpracování formuláře a uložení do DB
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();
            
            if (!$db) {
                die("Nepodařilo se připojit k databázi.");
            }

            $bookModel = new Book($db);
            
            $title = $_POST['title'] ?? '';
            $author = $_POST['author'] ?? '';
            $isbn = $_POST['isbn'] ?? '';
            $year = $_POST['year'] ?? '';

            if ($bookModel->save($title, $author, $isbn, $year)) {
                header('Location: /WA-2026-Jezkova-Eva/BooksApp/public/index.php');
                exit;
            } else {
                echo "Došlo k chybě při ukládání do databáze.";
            }
        }
    }

    // --- Smazání knihy ---
    public function delete($id = null) {
        if (!$id) {
            header('Location: /WA-2026-Jezkova-Eva/BooksApp/public/index.php');
            exit;
        }

        $database = new Database();
        $db = $database->getConnection();

        if ($db) {
            $bookModel = new Book($db);
            $bookModel->delete($id);
        }

        header('Location: /WA-2026-Jezkova-Eva/BooksApp/public/index.php');
        exit;
    }

    // --- NOVÁ METODA: Zobrazení formuláře pro editaci ---
    public function edit($id = null) {
        // Kontrola, zda máme ID
        if (!$id) {
            header('Location: /WA-2026-Jezkova-Eva/BooksApp/public/index.php');
            exit;
        }

        // Připojení k databázi
        $database = new Database();
        $db = $database->getConnection();
        
        if (!$db) {
            die("Nepodařilo se připojit k databázi.");
        }

        // Získání dat o knize z modelu
        $bookModel = new Book($db);
        $book = $bookModel->getById($id);

        // Pokud kniha neexistuje, návrat na hlavní stránku
        if (!$book) {
            header('Location: /WA-2026-Jezkova-Eva/BooksApp/public/index.php');
            exit;
        }

        // Načtení šablony pro úpravu (ta zatím pravděpodobně neexistuje)
        require_once '../app/views/books/book_edit.php';
    }
}