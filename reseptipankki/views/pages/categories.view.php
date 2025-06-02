<?php require_once '../views/partials/header.php'; ?>

<h1>Reseptikategoriat</h1>

<div class="categories">
    <?php foreach ($categories as $key => $name): ?>
        <div class="category-card">
            <h3><a href="?controller=recipe&category=<?= $key ?>"><?= $name ?></a></h3>
            <p><?= count(Recipe::getByCategory($key)) ?> reseptiä</p>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once '../views/partials/footer.php'; ?>