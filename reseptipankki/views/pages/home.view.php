<?php require_once '../views/partials/header.php'; ?>

<h1>Tervetuloa Reseptipankkiin!</h1>

<p>Täällä voit selata, lisätä ja hallita reseptejä.</p>

<?php if (!isset($_SESSION['user_id'])): ?>
    <p>Kirjaudu sisään tai rekisteröidy aloittaaksesi.</p>
<?php else: ?>
    <p>Aloita <a href="?controller=recipe">selaamalla reseptejä</a> tai <a href="?controller=recipe&action=create">lisäämällä uuden reseptin</a>.</p>
<?php endif; ?>

<?php require_once '../views/partials/footer.php'; ?>