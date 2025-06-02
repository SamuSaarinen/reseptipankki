<?php require_once '../views/partials/header.php'; ?>

<h1>Rekisteröidy</h1>

<?php if (!empty($errors)): ?>
    <div class="error">
        <?php foreach ($errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <div>
        <label for="username">Käyttäjätunnus:</label>
        <input type="text" id="username" name="username" required minlength="3">
    </div>
    <div>
        <label for="email">Sähköposti:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Salasana:</label>
        <input type="password" id="password" name="password" required minlength="6">
    </div>
    <div>
        <label for="birthyear">Syntymävuosi:</label>
        <input type="number" id="birthyear" name="birthyear" required 
               min="<?= date('Y') - 100 ?>" max="<?= date('Y') - 15 ?>">
    </div>
    <button type="submit" class="btn">Rekisteröidy</button>
</form>

<p>Onko sinulla jo tili? <a href="?controller=auth&action=login">Kirjaudu</a></p>

<?php require_once '../views/partials/footer.php'; ?>