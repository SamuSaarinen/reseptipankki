<?php require_once '../views/partials/header.php'; ?>

<h1>Kirjaudu sisään</h1>

<?php if (!empty($error)): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>

<form method="post">
    <div>
        <label for="username">Käyttäjätunnus:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Salasana:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit" class="btn">Kirjaudu</button>
</form>

<p>Eikö sinulla ole tiliä? <a href="?controller=auth&action=register">Rekisteröidy</a></p>

<?php require_once '../views/partials/footer.php'; ?>