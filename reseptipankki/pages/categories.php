<?php require_once __DIR__ . '/../includes/header.php'; ?>

<h1>Reseptikategoriat</h1>

<div class="category-filters">
    <a href="index.php?action=categories" class="button">Kaikki</a>
    <a href="index.php?action=categories&category=breakfast" class="button">Aamiainen</a>
    <a href="index.php?action=categories&category=main" class="button">Pääruoka</a>
    <a href="index.php?action=categories&category=snack" class="button">Välipala</a>
    <a href="index.php?action=categories&category=dessert" class="button">Jälkiruoka</a>
    <a href="index.php?action=categories&category=other" class="button">Muu</a>
</div>

<div class="recipes">
    <?php
    $category = $_GET['category'] ?? null;
    if ($category) {
        $recipes = query("SELECT * FROM recipes WHERE category = ? ORDER BY added_date DESC", [$category]);
    } else {
        $recipes = query("SELECT * FROM recipes ORDER BY added_date DESC");
    }
    
    foreach ($recipes as $recipe):
    ?>
        <div class="recipe-card">
            <h3><?= htmlspecialchars($recipe['name']) ?></h3>
            <p>Kategoria: <?= ucfirst($recipe['category']) ?></p>
            <a href="index.php?action=view&id=<?= $recipe['id'] ?>">Katso resepti</a>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '..\..\includes\footer.php'; ?>