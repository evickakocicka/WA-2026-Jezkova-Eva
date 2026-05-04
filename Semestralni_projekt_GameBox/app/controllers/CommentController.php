<?php
require_once '../app/models/Database.php';
require_once '../app/models/Comment.php';

class CommentController {
    
    // Zpracování odeslaného komentáře
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();
            $commentModel = new Comment($db);

            $gameId = (int)$_POST['game_id'];
            $text = trim($_POST['text']);
            
            // Zatím dáváme autora komentáře "natvrdo" jako ID 1 (první uživatel)
            // Až tam dáme login systém, nahradíme to za $_SESSION['user_id']
            $userId = 1; 

            // Pokud text není prázdný, uložíme ho
            if (!empty($text)) {
                $commentModel->addComment($gameId, $userId, $text);
            }

            // Šup zpátky na detail té samé hry!
            header('Location: ' . BASE_URL . '/index.php?url=game/show/' . $gameId);
            exit;
        }
    }
}