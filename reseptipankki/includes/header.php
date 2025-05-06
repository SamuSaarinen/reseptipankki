<!DOCTYPE html>
<html>
<head>
    <title>Reseptipankki</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Etusivu</a>
            <a href="index.php?action=categories">Kategoriat</a>
            <a href="index.php?action=contact">Yhteystiedot</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="index.php?action=myaccount">Omat tiedot</a>
                <a href="index.php?action=logout">Kirjaudu ulos</a>
            <?php else: ?>
                <a href="index.php?action=login">Kirjaudu</a>
                <a href="index.php?action=register">Rekisteröidy</a>
            <?php endif; ?>
        </nav>
    </header>
    <main></main>