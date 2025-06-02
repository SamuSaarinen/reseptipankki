<?php require_once '../views/partials/header.php'; ?>

<h1>Reseptit</h1>

<?php if (isset($_SESSION['user_id'])): ?>
    <a href="?controller=recipe&action=create" class="btn">Luo uusi resepti</a>
<?php endif; ?>

<div class="filters">
    <form method="get">
        <input type="hidden" name="controller" value="recipe">
        <select name="category" onchange="this.form.submit()">
            <option value="">Kaikki kategoriat</option>
            <?php foreach ($categories as $key => $name): ?>
                <option value="<?= $key ?>" <?= isset($_GET['category']) && $_GET['category'] === $key ? 'selected' : '' ?>>
                    <?= $name ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="recipe-list">
    <?php if (empty($recipes)): ?>
        <p>Ei reseptejä saatavilla.</p>
    <?php else: ?>
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe-card">
                <h3>
                    <a href="?controller=recipe&action=show&id=<?= $recipe['id'] ?>">
                        <?= htmlspecialchars($recipe['name']) ?>
                    </a>
                </h3>
                <p class="category"><?= $categories[$recipe['category']] ?? $recipe['category'] ?></p>
                <p class="author">Tekijä: <?= htmlspecialchars($recipe['username']) ?></p>
                <p class="date"><?= date('d.m.Y', strtotime($recipe['created_at'])) ?></p>
                <a href="?controller=recipe&action=show&id=<?= $recipe['id'] ?>" class="btn">Lue lisää</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once '../views/partials/footer.php'; ?>