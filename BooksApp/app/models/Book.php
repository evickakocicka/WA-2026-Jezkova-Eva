<?php

class Book {
    private $db;

    // Konstruktor přijme hotové připojení k databázi
    public function __construct($database_connection) {
        $this->db = $database_connection;
    }

    // Metoda pro uložení do databáze
    public function save($title, $author, $isbn, $year) {
        // TADY JSEM TO OPRAVIL: místo published_year píšu jen year
        $sql = "INSERT INTO books (title, author, isbn, year) VALUES (:title, :author, :isbn, :year)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':title' => $title,
            ':author' => $author,
            ':isbn' => $isbn,
            ':year' => $year
        ]);
    }

    // Metoda pro získání všech knih ze seznamu
    public function getAllBooks() {
        $query = "SELECT * FROM books";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}