<?php
require_once __DIR__ . './public/config.php';
require_once __DIR__ . './public/db.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$birth_year = (int)$_POST['birth_year'];

// Tarkista ikä (vähintään 15 vuotta)
if ((date('Y') - $birth_year) < 15) {
    header('Location: index.php?action=register&error=' . urlencode('Sinun täytyy olla vähintään 15-vuotias'));
    exit;
}

// Tarkista onko käyttäjätunnus tai sähköposti varattu
$existing = query("SELECT id FROM users WHERE username = ? OR email = ?", [$username, $email])->fetch();
if ($existing) {
    header('Location: index.php?action=register&error=' . urlencode('Käyttäjätunnus tai sähköposti on jo käytössä'));
    exit;
}

// Luo uusi käyttäjä
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
query("INSERT INTO users (username, email, password, birth_year) VALUES (?, ?, ?, ?)", 
    [$username, $email, $hashed_password, $birth_year]);

// Kirjaudu sisään automaattisesti
$user_id = $pdo->lastInsertId();
session_start();
$_SESSION['user_id'] = $user_id;

header('Location: ../index.php?action=myaccount');
exit;
?>