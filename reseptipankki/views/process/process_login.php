<?php
require_once __DIR__ . './public/config.php';
require_once __DIR__ . './public/db.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$user = query("SELECT * FROM users WHERE username = ?", [$username])->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    header('Location: index.php?action=myaccount');
} else {
    header('Location: index.php?action=login&error=1');
}
exit;
?>