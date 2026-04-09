<?php

class Book {
    private $db;

    // Konstruktor
    public function __construct($database_connection) {
        $this->db = $database_connection;
    }

    // 1. ULOŽENÍ (save) - TADY JE TA ZMĚNA! Nyní ukládá ÚPLNĚ VŠE.
    public function save($title, $author, $category, $subcategory, $year, $price, $isbn, $description, $link, $images = []) {
        $sql = "INSERT INTO books (title, author, category, subcategory, year, price, isbn, description, link, images) 
                VALUES (:title, :author, :category, :subcategory, :year, :price, :isbn, :description, :link, :images)";
        
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
            ':images' => json_encode($images)
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

    // 4. ÚPRAVA (update)
    public function update($id, $title, $author, $category, $subcategory, $year, $price, $isbn, $description, $link, $images = []) {
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
                    images = :images 
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
            ':images' => json_encode($images)
        ]);
    }

    // 5. SMAZÁNÍ (delete)
    public function delete($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}