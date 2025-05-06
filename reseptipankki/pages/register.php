<?php require_once 'includes/header.php'; ?>

<h1>Rekisteröidy</h1>

<?php if(isset($_GET['error'])): ?>
    <p class="error"><?= htmlspecialchars($_GET['error']) ?></p>
<?php endif; ?>

<form action="process_register.php" method="post">
    <div>
        <label for="username">Käyttäjätunnus:</label>
        <input type="text" id="username" name="username" required>
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
        <label for="birth_year">Syntymävuosi:</label>
        <input type="number" id="birth_year" name="birth_year" required min="1900" max="<?= date('Y')-15 ?>">
    </div>
    <button type="submit">Rekisteröidy</button>
</form>

<p>Onko sinulla jo tili? <a href="index.php?action=login">Kirjaudu sisään</a></p>

<?php require_once 'includes/footer.php'; ?>