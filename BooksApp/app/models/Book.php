<?php

class Book {
    private $db;

    // Konstruktor
    public function __construct($database_connection) {
        $this->db = $database_connection;
    }

    // 1. ULOŽENÍ (save)
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
            ':created_by' => $userId 
        ]);
    }

    // 2. VÝPIS VŠECH (getAllBooks) - 🎀 ZMĚNA: Přidán LEFT JOIN pro získání názvů kategorií
    public function getAllBooks() {
        $query = "SELECT b.*, c.name AS category_name, s.name AS subcategory_name 
                  FROM books b 
                  LEFT JOIN categories c ON b.category = c.id 
                  LEFT JOIN subcategories s ON b.subcategory = s.id";
        
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. NAJÍT JEDNU PODLE ID (getById) - 🎀 ZMĚNA: Přidán LEFT JOIN pro získání názvů kategorií
    public function getById($id) {
        $sql = "SELECT b.*, c.name AS category_name, s.name AS subcategory_name 
                FROM books b 
                LEFT JOIN categories c ON b.category = c.id 
                LEFT JOIN subcategories s ON b.subcategory = s.id 
                WHERE b.id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. ÚPRAVA (update)
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
            ':updated_by' => $userId 
        ]);
    }

    // 5. SMAZÁNÍ (delete)
    public function delete($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}