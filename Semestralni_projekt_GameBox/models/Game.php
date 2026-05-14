<?php
class Game {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll($search = '') {
        $sql = "SELECT g.*, u.username,
                (SELECT COUNT(*) FROM game_likes WHERE game_id = g.id) as likes_count
                FROM games g 
                LEFT JOIN users u ON g.author_id = u.id ";
        
        if (!empty($search)) {
            $sql .= " WHERE g.title LIKE :search OR g.category LIKE :search ";
        }
        
        $sql .= " ORDER BY g.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        
        if (!empty($search)) {
            $stmt->execute([':search' => '%' . $search . '%']);
        } else {
            $stmt->execute();
        }
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($data) {
        $sql = "INSERT INTO games (
            title, category, playtime_hours, trophy_type, 
            rating_stars, recommend, favorite_part, author_id,
            image_url, buy_link, platform
        ) VALUES (
            :title, :category, :playtime_hours, :trophy_type, 
            :rating_stars, :recommend, :favorite_part, :author_id,
            :image_url, :buy_link, :platform
        )";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE games SET 
            title = :title, category = :category, playtime_hours = :playtime_hours, 
            trophy_type = :trophy_type, rating_stars = :rating_stars, 
            recommend = :recommend, favorite_part = :favorite_part, 
            image_url = :image_url, buy_link = :buy_link, platform = :platform
            WHERE id = :id AND author_id = :author_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function getById($id) {
        $sql = "SELECT g.*, u.username,
                (SELECT COUNT(*) FROM game_likes WHERE game_id = g.id) as likes_count
                FROM games g 
                LEFT JOIN users u ON g.author_id = u.id 
                WHERE g.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM games WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function toggleLike($gameId, $userId) {
        $check = "SELECT id FROM game_likes WHERE game_id = :gid AND user_id = :uid";
        $stmt = $this->db->prepare($check);
        $stmt->execute([':gid' => $gameId, ':uid' => $userId]);
        
        if ($stmt->fetch()) {
            $sql = "DELETE FROM game_likes WHERE game_id = :gid AND user_id = :uid";
        } else {
            $sql = "INSERT INTO game_likes (game_id, user_id) VALUES (:gid, :uid)";
        }
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':gid' => $gameId, ':uid' => $userId]);
    }
}