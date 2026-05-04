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
            
            $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
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
}