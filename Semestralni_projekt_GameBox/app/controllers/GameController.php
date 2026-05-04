<?php
// Jdeme o 2 složky ven, protože models máš mimo app
require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../models/Game.php';

class GameController {
    
    public function index() {
        $database = new Database();
        $db = $database->getConnection();
        
        $gameModel = new Game($db);
        $games = $gameModel->getAll();
        
        require_once __DIR__ . '/../../views/games/list.php';
    }

    public function create() {
        require_once __DIR__ . '/../../views/games/create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();
            $gameModel = new Game($db);

            $data = [
                ':title' => htmlspecialchars($_POST['title']),
                ':category' => $_POST['category'],
                ':playtime_hours' => (int)$_POST['playtime_hours'],
                ':trophy_type' => $_POST['trophy_type'],
                ':rating_stars' => (int)$_POST['rating_stars'],
                ':recommend' => isset($_POST['recommend']) ? 1 : 0,
                ':favorite_part' => htmlspecialchars($_POST['favorite_part']),
                ':author_id' => 1 
            ];

            if ($gameModel->save($data)) {
                header('Location: ' . BASE_URL . '/index.php?url=game/index');
                exit;
            }
        }
    }

    public function show($id) {
        $database = new Database();
        $db = $database->getConnection();
        
        $gameModel = new Game($db);
        $game = $gameModel->getById($id);

        if (!$game) {
            header('Location: ' . BASE_URL . '/index.php?url=game/index');
            exit;
        }

        require_once __DIR__ . '/../../models/Comment.php';
        $commentModel = new Comment($db);
        $comments = $commentModel->getByGameId($id);

        require_once __DIR__ . '/../../views/games/show.php';
    }
}