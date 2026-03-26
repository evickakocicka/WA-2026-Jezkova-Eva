<?php
//echo "TEST 1 - ZDE JSEM"; die();
// Pro účely výuky a laděn na lokálním serveru (např. xampp)
//je vhodné zapnout kompletní zobrazování chyb
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Načtení třídy routeru, která se postará o zpracování URL
require_once '../core/App.php';

//Inicializace aplikace a spuštění procesu routování
$app = new App();

