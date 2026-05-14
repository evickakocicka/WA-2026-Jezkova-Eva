<?php
require_once __DIR__ . '/../../models/Database.php';

class AuthController {
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();
            
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            
            $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role']; // DŮLEŽITÉ: Uložíme roli (user/admin)
                header('Location: ' . BASE_URL . '/index.php?url=game/index');
                exit;
            } else {
                $error = "Špatné jméno nebo heslo! ❌";
            }
        }
        require_once __DIR__ . '/../../views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();
            
            $username = trim($_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // Registrace vždy s rolí 'user'
            $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, 'user')");
            if ($stmt->execute([':username' => $username, ':password' => $password])) {
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
                exit;
            }
        }
        require_once __DIR__ . '/../../views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . '/index.php?url=auth/login');
        exit;
    }

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $database = new Database();
        $db = $database->getConnection();
        $userId = $_SESSION['user_id'];

        $stmtGames = $db->prepare("SELECT COUNT(id) as total_games, SUM(playtime_hours) as total_hours FROM games WHERE author_id = :uid");
        $stmtGames->execute([':uid' => $userId]);
        $gameStats = $stmtGames->fetch(PDO::FETCH_ASSOC);

        $totalGames = $gameStats['total_games'] ?? 0;
        $totalHours = $gameStats['total_hours'] ?? 0;

        $stmtLikes = $db->prepare("SELECT COUNT(cl.id) as total_likes FROM comment_likes cl JOIN comments c ON cl.comment_id = c.id WHERE c.user_id = :uid");
        $stmtLikes->execute([':uid' => $userId]);
        $likeStats = $stmtLikes->fetch(PDO::FETCH_ASSOC);
        $totalLikes = $likeStats['total_likes'] ?? 0;

        // Pokud je ADMIN, načteme seznam všech uživatelů pro správu
        $allUsers = [];
        if ($_SESSION['role'] === 'admin') {
            $stmtAll = $db->query("SELECT id, username, role FROM users WHERE id != $userId");
            $allUsers = $stmtAll->fetchAll(PDO::FETCH_ASSOC);
        }

        require_once __DIR__ . '/../../views/auth/profile.php';
    }

    // NOVÉ: Úprava jména nebo hesla
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $database = new Database();
            $db = $database->getConnection();
            
            $newUsername = trim($_POST['username']);
            $userId = $_SESSION['user_id'];

            if (!empty($_POST['password'])) {
                $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt = $db->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");
                $stmt->execute([':username' => $newUsername, ':password' => $newPassword, ':id' => $userId]);
            } else {
                $stmt = $db->prepare("UPDATE users SET username = :username WHERE id = :id");
                $stmt->execute([':username' => $newUsername, ':id' => $userId]);
            }

            $_SESSION['username'] = $newUsername;
            header('Location: ' . BASE_URL . '/index.php?url=auth/profile');
            exit;
        }
    }

    // NOVÉ: Smazání vlastního účtu
    public function deleteSelf() {
        if (isset($_SESSION['user_id'])) {
            $database = new Database();
            $db = $database->getConnection();
            $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([':id' => $_SESSION['user_id']]);
            
            session_destroy();
            header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            exit;
        }
    }

    // NOVÉ: Admin maže jiného uživatele
    public function adminDeleteUser($id) {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            $database = new Database();
            $db = $database->getConnection();
            $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);
        }
        header('Location: ' . BASE_URL . '/index.php?url=auth/profile');
        exit;
    }
}