<?php
// Načtení potřebných souborů
require_once '../app/models/Database.php';
require_once '../app/models/Book.php';

class BookController {

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

    public function create() {
        require_once '../app/views/books/Book_Create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();
            
            if (!$db) {
                $this->addErrorMessage('Nepodařilo se připojit k databázi.');
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            }

            $bookModel = new Book($db);
            
            // TADY JE TA ZMĚNA: Chytáme ÚPLNĚ VŠE z formuláře
            $title = htmlspecialchars($_POST['title'] ?? "");
            $author = htmlspecialchars($_POST['author'] ?? "");
            $isbn = htmlspecialchars($_POST['isbn'] ?? "");
            $category = htmlspecialchars($_POST['category'] ?? "");
            $subcategory = htmlspecialchars($_POST['subcategory'] ?? "");
            $year = (int)($_POST['year'] ?? 0);
            $price = (float)($_POST['price'] ?? 0);
            $link = htmlspecialchars($_POST['link'] ?? "");
            $description = htmlspecialchars($_POST['description'] ?? "");
            $uploadedImages = [];

            // A tady to všechno bezpečně předáme do modelu k uložení
            if ($bookModel->save($title, $author, $category, $subcategory, $year, $price, $isbn, $description, $link, $uploadedImages)) {
                $this->addSuccessMessage('Kniha byla úspěšně přidána do knihovny! 🎀');
            } else {
                $this->addErrorMessage('Došlo k chybě při ukládání do databáze.');
            }
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }
    }

    public function delete($id = null) {
        if (!is_numeric($id) && isset($_GET['url'])) {
            $urlParts = explode('/', rtrim($_GET['url'], '/'));
            $id = end($urlParts);
        }

        if (!$id || !is_numeric($id)) {
            $this->addErrorMessage('Nebylo zadáno platné ID knihy ke smazání.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $database = new Database();
        $db = $database->getConnection();

        if ($db) {
            $bookModel = new Book($db);
            if ($bookModel->delete($id)) {
                $this->addSuccessMessage('Kniha byla trvale smazána. 🗑️');
            } else {
                $this->addErrorMessage('Knihu se nepodařilo smazat.');
            }
        }
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    public function edit($id = null) {
        if (!is_numeric($id) && isset($_GET['url'])) {
            $urlParts = explode('/', rtrim($_GET['url'], '/'));
            $id = end($urlParts);
        }

        if (!$id || !is_numeric($id)) {
            $this->addErrorMessage('Nebylo zadáno platné ID knihy k úpravě.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $database = new Database();
        $db = $database->getConnection();
        $bookModel = new Book($db);
        $book = $bookModel->getById($id);

        if (!$book) {
            $this->addErrorMessage('Kniha nebyla v databázi nalezena.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }
        require_once '../app/views/books/book_edit.php';
    }

    public function update($id = null) {
        if (!is_numeric($id) && isset($_GET['url'])) {
            $urlParts = explode('/', rtrim($_GET['url'], '/'));
            $id = end($urlParts);
        }

        if (!$id || !is_numeric($id)) {
            $this->addErrorMessage('Nebylo zadáno platné ID knihy k aktualizaci.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title'] ?? "");
            $author = htmlspecialchars($_POST['author'] ?? "");
            $isbn = htmlspecialchars($_POST['isbn'] ?? "");
            $category = htmlspecialchars($_POST['category'] ?? "");
            $subcategory = htmlspecialchars($_POST['subcategory'] ?? "");
            $year = (int)($_POST['year'] ?? 0);
            $price = (float)($_POST['price'] ?? 0);
            $link = htmlspecialchars($_POST['link'] ?? "");
            $description = htmlspecialchars($_POST['description'] ?? "");
            $uploadedImages = [];

            $database = new Database();
            $db = $database->getConnection();

            if ($db) {
                $bookModel = new Book($db);
                if ($bookModel->update($id, $title, $author, $category, $subcategory, $year, $price, $isbn, $description, $link, $uploadedImages)) {
                    $this->addSuccessMessage('Údaje o knize byly úspěšně upraveny. ✨');
                } else {
                    $this->addErrorMessage('Změny se nepodařilo uložit.');
                }
            }
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }
    }

    public function show($id = null) {
        if (!is_numeric($id) && isset($_GET['url'])) {
            $urlParts = explode('/', rtrim($_GET['url'], '/'));
            $id = end($urlParts);
        }

        if (!$id || !is_numeric($id)) {
            $this->addErrorMessage('Nebylo zadáno platné ID knihy k zobrazení.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $database = new Database();
        $db = $database->getConnection();

        if ($db) {
            $bookModel = new Book($db);
            $book = $bookModel->getById($id);

            if (!$book) {
                $this->addErrorMessage('Kniha nebyla v databázi nalezena.');
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            }
            require_once '../app/views/books/book_show.php';
        }
    }

    protected function addSuccessMessage($message) {
        $_SESSION['messages']['success'][] = $message;
    }
    protected function addNoticeMessage($message) {
        $_SESSION['messages']['notice'][] = $message;
    }
    protected function addErrorMessage($message) {
        $_SESSION['messages']['error'][] = $message;
    }
}