<?php require_once '../views/partials/header.php'; ?>

<div class="recipe-detail">
    <h1><?= htmlspecialchars($recipe['name']) ?></h1>
    
    <div class="meta">
        <span class="category"><?= $categories[$recipe['category']] ?? $recipe['category'] ?></span>
        <span class="author">Tekijä: <?= htmlspecialchars($recipe['username']) ?></span>
        <span class="date"><?= date('d.m.Y', strtotime($recipe['created_at'])) ?></span>
    </div>
    
    <div class="actions">
        <button onclick="window.print()" class="btn">Tulosta resepti</button>
        
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $recipe['user_id']): ?>
            <a href="?controller=recipe&action=edit&id=<?= $recipe['id'] ?>" class="btn">Muokkaa</a>
            <a href="?controller=recipe&action=delete&id=<?= $recipe['id'] ?>" class="btn danger" 
               onclick="return confirm('Haluatko varmasti poistaa tämän reseptin?')">Poista</a>
        <?php endif; ?>
    </div>
    
    <div class="ingredients">
        <h2>Ainesosat</h2>
        <pre><?= htmlspecialchars($recipe['ingredients']) ?></pre>
    </div>
    
    <div class="instructions">
        <h2>Valmistusohjeet</h2>
        <pre><?= htmlspecialchars($recipe['instructions']) ?></pre>
    </div>
</div>

<?php require_once '../views/partials/footer.php'; ?>