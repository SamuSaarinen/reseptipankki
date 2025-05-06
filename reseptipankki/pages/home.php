<?php require_once 'includes/header.php'; ?>

<h1>Tervetuloa Reseptipankkiin</h1>

<?php if(isset($_SESSION['user_id'])): ?>
    <a href="index.php?action=create" class="button">Luo uusi resepti</a>
<?php endif; ?>

<h2>Viimeisimmät reseptit</h2>

<?php
$recipes = query("SELECT * FROM recipes ORDER BY added_date DESC LIMIT 5")->fetchAll();
foreach ($recipes as $recipe): ?>
    <div class="recipe">
        <h3><?= htmlspecialchars($recipe['name']) ?></h3>
        <p>Kategoria: <?= $recipe['category'] ?></p>
        <a href="index.php?action=view&id=<?= $recipe['id'] ?>">Katso resepti</a>
    </div>
<?php endforeach; ?>

<?php require_once 'includes/footer.php'; ?>