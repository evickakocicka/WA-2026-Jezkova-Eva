<?php
class Database {
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Tady si to bere údaje z tvého config.php
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            // Nastavení kódování, aby se správně zobrazovala česká diakritika (háčky, čárky) a emoji
            $this->conn->exec("set names utf8mb4");
        } catch(PDOException $exception) {
            echo "<div style='background: #1e293b; color: #ef4444; padding: 20px; border-radius: 10px; text-align: center; font-family: sans-serif;'>";
            echo "<h2>Kritická chyba: Nelze se připojit k databázi! ❌</h2>";
            echo "<p>" . $exception->getMessage() . "</p>";
            echo "</div>";
            exit;
        }
        return $this->conn;
    }
}