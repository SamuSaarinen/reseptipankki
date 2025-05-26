<?php
// Käytä absoluuttista polkua header.php:lle
require_once __DIR__ . '../public/header.php';
?>

<h1>Kaikki reseptit</h1>

<div class="recipes">
    <?php
    $recipes = query("SELECT * FROM recipes ORDER BY added_date DESC");
    if ($recipes) {
        foreach ($recipes as $recipe):
    ?>
        <div class="recipe-card">
            <h3><?= htmlspecialchars($recipe['name']) ?></h3>
            <p>Kategoria: <?= ucfirst($recipe['category']) ?></p>
            <a href="index.php?action=view&id=<?= $recipe['id'] ?>">Katso resepti</a>
        </div>
    <?php 
        endforeach;
    } else {
        echo "<p>Reseptejä ei löytynyt.</p>";
    }
    ?>
</div>

<?php
// Käytä absoluuttista polkua footer.php:lle
require_once __DIR__ . '../public/footer.php';
?>