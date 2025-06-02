<?php
session_start();

// Muuta nämä cPanel-tietojesi mukaan
define('DB_HOST', 'samsaa24.treok.io'); // Yleensä localhost
define('DB_USER', 'samsaa24_reseptipankki_user'); // cPanel-käyttäjätunnus
define('DB_PASS', 'Kirkko2007'); // cPanel-salasanasi
define('DB_NAME', 'samsaa24_reseptipankki'); // Tietokannan nimi cPanel:ssä

function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8mb4");
    return $conn;
}
?>