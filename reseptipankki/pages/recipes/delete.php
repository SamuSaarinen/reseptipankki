<?php
// /reseptipankki/pages/recipes/delete.php
session_start();
require_once __DIR__ . 'reseptipankki\includes\config.php';
require_once __DIR__ . 'reseptipankki\includes\db.php';
require_once __DIR__ . 'reseptipankki\includes\header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_PATH . '/index.php?action=login');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: ' . BASE_PATH . '/index.php?action=myaccount');
    exit;
}

// Tarkista että resepti on käyttäjän omistama
$recipe = query("SELECT user_id FROM recipes WHERE id = ?", [$_GET['id']])->fetch();

if ($recipe && $recipe['user_id'] == $_SESSION['user_id']) {
    query("DELETE FROM recipes WHERE id = ?", [$_GET['id']]);
    $_SESSION['message'] = "Resepti poistettiin onnistuneesti";
} else {
    $_SESSION['error'] = "Reseptin poistaminen epäonnistui";
}

header('Location: ' . BASE_PATH . '/index.php?action=myaccount');
exit;
?>