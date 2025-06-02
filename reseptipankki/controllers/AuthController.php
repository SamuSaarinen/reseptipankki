<?php
require_once '../models/User.php';

class AuthController {
    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            
            $user = User::authenticate($username, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ?controller=page&action=home');
                exit;
            } else {
                $error = "Väärä käyttäjätunnus tai salasana";
            }
        }
        require_once '../views/auth/login.view.php';
    }
    
    public function register() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $birthyear = (int)$_POST['birthyear'];
            
            if (strlen($username) < 3) $errors[] = "Käyttäjänimi liian lyhyt (min 3 merkkiä)";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Virheellinen sähköposti";
            if (strlen($password) < 6) $errors[] = "Salasana liian lyhyt (min 6 merkkiä)";
            if ((date('Y') - $birthyear) < 15) $errors[] = "Sinun täytyy olla vähintään 15-vuotias";
            
            if (empty($errors)) {
                if (User::create($username, $email, $password, $birthyear)) {
                    header('Location: ?controller=auth&action=login');
                    exit;
                } else {
                    $errors[] = "Käyttäjänimi tai sähköposti on jo käytössä";
                }
            }
        }
        require_once '../views/auth/register.view.php';
    }
    
    public function logout() {
        session_destroy();
        header('Location: ?controller=page&action=home');
        exit;
    }
}
?>