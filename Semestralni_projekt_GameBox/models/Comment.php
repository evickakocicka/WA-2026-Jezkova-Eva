<?php
class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addComment($gameId, $userId, $text) {
        $sql = "INSERT INTO comments (game_id, user_id, text) VALUES (:game_id, :user_id, :text)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':game_id' => $gameId,
            ':user_id' => $userId,
            ':text' => htmlspecialchars($text)
        ]);
    }

    public function getByGameId($gameId) {
        $sql = "SELECT c.*, u.username, 
                (SELECT COUNT(*) FROM comment_likes WHERE comment_id = c.id) as likes_count
                FROM comments c 
                LEFT JOIN users u ON c.user_id = u.id 
                WHERE c.game_id = :game_id 
                ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':game_id' => $gameId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // NOVÉ: Potřebujeme zjistit autora komentáře, než mu dovolíme dát lajk
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM comments WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function toggleLike($commentId, $userId) {
        $check = "SELECT id FROM comment_likes WHERE comment_id = :cid AND user_id = :uid";
        $stmt = $this->db->prepare($check);
        $stmt->execute([':cid' => $commentId, ':uid' => $userId]);
        
        if ($stmt->fetch()) {
            $sql = "DELETE FROM comment_likes WHERE comment_id = :cid AND user_id = :uid";
        } else {
            $sql = "INSERT INTO comment_likes (comment_id, user_id) VALUES (:cid, :uid)";
        }
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':cid' => $commentId, ':uid' => $userId]);
    }
}