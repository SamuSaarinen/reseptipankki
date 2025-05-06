<?php
require_once __DIR__ . '..\..\includes\header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit;
}

$user = query("SELECT id, username, email, birth_year FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch();
$recipes = query("SELECT * FROM recipes WHERE user_id = ? ORDER BY added_date DESC", [$_SESSION['user_id']]);
?>

<h1>Omat tiedot</h1>

<div class="user-info">
    <p><strong>Käyttäjänimi:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Sähköposti:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Syntymävuosi:</strong> <?= $user['birth_year'] ?></p>
</div>

<h2>Omat reseptit</h2>
<div class="recipes">
    <?php foreach ($recipes as $recipe): ?>
        <div class="recipe-card">
            <h3><?= htmlspecialchars($recipe['name']) ?></h3>
            <p>Kategoria: <?= ucfirst($recipe['category']) ?></p>
            <a href="index.php?action=view&id=<?= $recipe['id'] ?>">Katso resepti</a>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>