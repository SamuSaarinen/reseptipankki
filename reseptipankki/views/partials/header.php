<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseptipankki</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="?controller=page&action=home">Etusivu</a></li>
                    <li><a href="?controller=page&action=categories">Kategoriat</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="?controller=recipe">Reseptit</a></li>
                        <li><a href="?controller=page&action=profile">Omat tiedot</a></li>
                    <?php endif; ?>
                    <li><a href="?controller=page&action=contact">Yhteystiedot</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="?controller=auth&action=logout">Kirjaudu ulos</a></li>
                    <?php else: ?>
                        <li><a href="?controller=auth&action=login">Kirjaudu</a></li>
                        <li><a href="?controller=auth&action=register">Rekisteröidy</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">