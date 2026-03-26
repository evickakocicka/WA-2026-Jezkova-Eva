<?php

class BookController {

    // 0. Výchozí metoda pro zobrazení úvodní stránky
    public function index(){
        // V dalších krocích se zde přídá komunikace s modelem pro načtení dat z databáze a zobrazení pomocí view
        //(např. načtení všech uložených knih)

        //Nyní se pouze načte (vloží) připravený soubor s HTML strukturou pro zobrazení úvodní stránky
        require_once '../app/views/books/books_list.php';
    }
}

