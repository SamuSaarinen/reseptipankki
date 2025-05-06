<?php
// Use forward slashes for cross-platform compatibility
require_once __DIR__ . '/../../includes/header.php';

// Validate recipe ID
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

// Get recipe details with user information
$recipe = query(
    "SELECT r.*, u.username 
     FROM recipes r 
     JOIN users u ON r.user_id = u.id 
     WHERE r.id = ?", 
    [$_GET['id']]
)->fetch();

// Redirect if recipe not found
if (!$recipe) {
    header('Location: ../index.php');
    exit;
}

// Check if current user can edit this recipe
$can_edit = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $recipe['user_id'];
?>

<div class="recipe-view">
    <h1><?= htmlspecialchars($recipe['name']) ?></h1>
    <div class="recipe-meta">
        <p>Lisännyt: <?= htmlspecialchars($recipe['username']) ?></p>
        <p>Kategoria: <?= ucfirst($recipe['category']) ?></p>
        <p>Lisätty: <?= date('d.m.Y', strtotime($recipe['added_date'])) ?></p>
    </div>

    <div class="recipe-section">
        <h2>Ainesosat</h2>
        <div class="recipe-content"><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></div>
    </div>

    <div class="recipe-section">
        <h2>Ohjeet</h2>
        <div class="recipe-content"><?= nl2br(htmlspecialchars($recipe['instructions'])) ?></div>
    </div>

    <div class="recipe-actions">
        <?php if ($can_edit): ?>
            <a href="index.php?action=edit&id=<?= $recipe['id'] ?>" class="button">Muokkaa</a>
            <a href="index.php?action=delete&id=<?= $recipe['id'] ?>" class="button danger" 
               onclick="return confirm('Haluatko varmasti poistaa tämän reseptin?')">Poista</a>
        <?php endif; ?>
        <a href="index.php?action=pdf&id=<?= $recipe['id'] ?>" class="button">Lataa PDF</a>
        <a href="index.php?action=recipes" class="button secondary">Takaisin listaukseen</a>
    </div>
</div>

<?php 
// Use absolute path for footer
require_once __DIR__ . '/../../includes/footer.php'; 
?>