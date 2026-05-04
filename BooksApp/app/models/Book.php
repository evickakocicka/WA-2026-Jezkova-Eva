<?php

class Book {
    private $db;

    // Konstruktor
    public function __construct($database_connection) {
        $this->db = $database_connection;
    }

    // 1. ULOŽENÍ (save) - !!! ZMĚNA: Přidáno $userId a sloupec created_by
    public function save($title, $author, $category, $subcategory, $year, $price, $isbn, $description, $link, $images = [], $userId = null) {
        $sql = "INSERT INTO books (title, author, category, subcategory, year, price, isbn, description, link, images, created_by) 
                VALUES (:title, :author, :category, :subcategory, :year, :price, :isbn, :description, :link, :images, :created_by)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':title' => $title,
            ':author' => $author,
            ':category' => $category,
            ':subcategory' => $subcategory,
            ':year' => $year,
            ':price' => $price,
            ':isbn' => $isbn,
            ':description' => $description,
            ':link' => $link,
            ':images' => json_encode($images),
            ':created_by' => $userId // !!! ZMĚNA: Předání ID do databáze
        ]);
    }

    // 2. VÝPIS VŠECH (getAllBooks)
    public function getAllBooks() {
        $query = "SELECT * FROM books";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. NAJÍT JEDNU PODLE ID (getById)
    public function getById($id) {
        $sql = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. ÚPRAVA (update) - !!! ZMĚNA: Přidáno $userId a sloupec updated_by
    public function update($id, $title, $author, $category, $subcategory, $year, $price, $isbn, $description, $link, $images = [], $userId = null) {
        $sql = "UPDATE books 
                SET title = :title, 
                    author = :author, 
                    category = :category, 
                    subcategory = :subcategory, 
                    year = :year, 
                    price = :price, 
                    isbn = :isbn, 
                    description = :description, 
                    link = :link, 
                    images = :images,
                    updated_by = :updated_by 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':author' => $author,
            ':category' => $category,
            ':subcategory' => $subcategory,
            ':year' => $year,
            ':price' => $price,
            ':isbn' => $isbn,
            ':description' => $description,
            ':link' => $link,
            ':images' => json_encode($images),
            ':updated_by' => $userId // !!! ZMĚNA: Předání ID pro auditní stopu
        ]);
    }

    // 5. SMAZÁNÍ (delete)
    public function delete($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}