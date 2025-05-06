<?php
// Määritä absoluuttinen polku
define('ROOT_PATH', dirname(__DIR__));

// Ota virheilmoitukset käyttöön
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Tarkista tarvittavien tiedostojen olemassaolo
$required_files = [
    ROOT_PATH . '/includes/config.php',
    ROOT_PATH . '/includes/db.php',
    ROOT_PATH . '/includes/header.php',
    ROOT_PATH . '/includes/footer.php'
];

foreach ($required_files as $file) {
    if (!file_exists($file)) {
        die("Vaadittu tiedosto puuttuu: " . $file);
    }
}

// Sisällytä tarvittavat tiedostot
require_once ROOT_PATH . '/includes/config.php';
require_once ROOT_PATH . '/includes/db.php';
?>