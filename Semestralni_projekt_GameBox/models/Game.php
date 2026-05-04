<?php
class Game {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Vytažení úplně všech her pro hlavní stránku
    public function getAll() {
        $sql = "SELECT g.*, u.username FROM games g 
                LEFT JOIN users u ON g.author_id = u.id 
                ORDER BY g.created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Uložení nové hry do databáze
    public function save($data) {
        $sql = "INSERT INTO games (
            title, category, playtime_hours, trophy_type, 
            rating_stars, recommend, favorite_part, author_id
        ) VALUES (
            :title, :category, :playtime_hours, :trophy_type, 
            :rating_stars, :recommend, :favorite_part, :author_id
        )";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Vytažení detailu jedné hry podle ID
    public function getById($id) {
        $sql = "SELECT g.*, u.username FROM games g 
                LEFT JOIN users u ON g.author_id = u.id 
                WHERE g.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}