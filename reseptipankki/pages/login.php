<?php require_once 'includes/header.php'; ?>

<h1>Kirjaudu sisään</h1>

<?php if(isset($_GET['error'])): ?>
    <p class="error">Virheellinen käyttäjätunnus tai salasana</p>
<?php endif; ?>

<form action="process_login.php" method="post">
    <div>
        <label for="username">Käyttäjätunnus:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Salasana:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Kirjaudu</button>
</form>

<p>Eikö sinulla ole tiliä? <a href="index.php?action=register">Rekisteröidy</a></p>

<?php require_once 'includes/footer.php'; ?>