<?php
require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../models/Game.php';

class GameController {
    
    public function index() {
        $database = new Database();
        $db = $database->getConnection();
        
        $gameModel = new Game($db);
        
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $games = $gameModel->getAll($search);
        
        require_once __DIR__ . '/../../views/games/list.php';
    }

    public function create() {
        require_once __DIR__ . '/../../views/games/create.php';
    }

    private function uploadImage() {
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES['image_file']['name']);
            $targetFilePath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $targetFilePath)) {
                return 'uploads/' . $fileName;
            }
        }
        return null;
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
                exit;
            }

            $database = new Database();
            $db = $database->getConnection();
            $gameModel = new Game($db);

            $imagePath = $this->uploadImage();

            $data = [
                ':title' => htmlspecialchars($_POST['title']),
                ':category' => $_POST['category'],
                ':playtime_hours' => (int)$_POST['playtime_hours'],
                ':trophy_type' => $_POST['trophy_type'],
                ':rating_stars' => (int)$_POST['rating_stars'],
                ':recommend' => isset($_POST['recommend']) ? 1 : 0,
                ':favorite_part' => htmlspecialchars($_POST['favorite_part']),
                ':author_id' => $_SESSION['user_id'],
                ':image_url' => $imagePath,
                ':buy_link' => !empty($_POST['buy_link']) ? trim($_POST['buy_link']) : null,
                ':platform' => !empty($_POST['platform']) ? $_POST['platform'] : 'Nezadáno'
            ];

            if ($gameModel->save($data)) {
                header('Location: ' . BASE_URL . '/index.php?url=game/index');
                exit;
            }
        }
    }

    public function edit($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $database = new Database();
        $db = $database->getConnection();
        $gameModel = new Game($db);
        $game = $gameModel->getById($id);

        if (!$game || $game['author_id'] != $_SESSION['user_id']) {
            header('Location: ' . BASE_URL . '/index.php?url=game/index');
            exit;
        }

        require_once __DIR__ . '/../../views/games/edit.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
                exit;
            }

            $database = new Database();
            $db = $database->getConnection();
            $gameModel = new Game($db);
            
            $existingGame = $gameModel->getById($id);
            if (!$existingGame || $existingGame['author_id'] != $_SESSION['user_id']) {
                header('Location: ' . BASE_URL . '/index.php?url=game/index');
                exit;
            }

            $imagePath = $this->uploadImage();
            if (!$imagePath) {
                $imagePath = $existingGame['image_url']; 
            }

            $data = [
                ':id' => $id,
                ':title' => htmlspecialchars($_POST['title']),
                ':category' => $_POST['category'],
                ':playtime_hours' => (int)$_POST['playtime_hours'],
                ':trophy_type' => $_POST['trophy_type'],
                ':rating_stars' => (int)$_POST['rating_stars'],
                ':recommend' => isset($_POST['recommend']) ? 1 : 0,
                ':favorite_part' => htmlspecialchars($_POST['favorite_part']),
                ':author_id' => $_SESSION['user_id'],
                ':image_url' => $imagePath,
                ':buy_link' => !empty($_POST['buy_link']) ? trim($_POST['buy_link']) : null,
                ':platform' => !empty($_POST['platform']) ? $_POST['platform'] : 'Nezadáno'
            ];

            if ($gameModel->update($data)) {
                header('Location: ' . BASE_URL . '/index.php?url=game/show/' . $id);
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

    public function delete($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $database = new Database();
        $db = $database->getConnection();
        $gameModel = new Game($db);
        $game = $gameModel->getById($id);

        if ($game && ($game['author_id'] == $_SESSION['user_id'] || (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'))) {
            $gameModel->delete($id);
        }

        header('Location: ' . BASE_URL . '/index.php?url=game/index');
        exit;
    }

    public function addComment($gameId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
                exit;
            }

            $text = trim($_POST['text']);
            if (!empty($text)) {
                $database = new Database();
                $db = $database->getConnection();
                require_once __DIR__ . '/../../models/Comment.php';
                $commentModel = new Comment($db);
                $commentModel->addComment($gameId, $_SESSION['user_id'], $text);
            }
        }
        header('Location: ' . BASE_URL . '/index.php?url=game/show/' . $gameId);
        exit;
    }

    public function likeComment($commentId) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $database = new Database();
        $db = $database->getConnection();
        require_once __DIR__ . '/../../models/Comment.php';
        $commentModel = new Comment($db);

        $comment = $commentModel->getById($commentId);
        
        if ($comment && $comment['user_id'] != $_SESSION['user_id']) {
            $commentModel->toggleLike($commentId, $_SESSION['user_id']);
        }
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function like($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $database = new Database();
        $db = $database->getConnection();
        $gameModel = new Game($db);

        $game = $gameModel->getById($id);
        
        if ($game && $game['author_id'] != $_SESSION['user_id']) {
            $gameModel->toggleLike($id, $_SESSION['user_id']);
        }
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}