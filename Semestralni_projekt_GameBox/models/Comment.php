<?php
class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Uložení komentáře
    public function addComment($gameId, $userId, $text) {
        $sql = "INSERT INTO comments (game_id, user_id, text) VALUES (:game_id, :user_id, :text)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':game_id' => $gameId,
            ':user_id' => $userId,
            ':text' => htmlspecialchars($text)
        ]);
    }

    // Vytažení komentářů k dané hře
    public function getByGameId($gameId) {
        $sql = "SELECT c.*, u.username FROM comments c 
                LEFT JOIN users u ON c.user_id = u.id 
                WHERE c.game_id = :game_id 
                ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':game_id' => $gameId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}