<?php
session_start();
// Načtení základního nastavení
require_once '../config/config.php';

// Získání URL adresy (pokud není žádná zadána, jdeme na game/index)
$url = isset($_GET['url']) ? $_GET['url'] : 'game/index';
$urlParts = explode('/', rtrim($url, '/'));

// Zjistíme, jaký controller a jakou metodu chceme zavolat
$controllerName = ucfirst($urlParts[0]) . 'Controller';
$methodName = isset($urlParts[1]) ? $urlParts[1] : 'index';
$param = isset($urlParts[2]) ? $urlParts[2] : null;

// Cesta k souboru s controllerem
$controllerFile = '../app/controllers/' . $controllerName . '.php';

// Spuštění správného controlleru
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();
    
    if (method_exists($controller, $methodName)) {
        if ($param !== null) {
            $controller->$methodName($param);
        } else {
            $controller->$methodName();
        }
    } else {
        echo "<h1 style='color:white; text-align:center;'>Chyba 404: Akce nenalezena.</h1>";
    }
} else {
    echo "<h1 style='color:white; text-align:center;'>Chyba 404: Stránka nenalezena.</h1>";
}