<?php require_once '../views/partials/header.php'; ?>

<h1>Luo uusi resepti</h1>

<?php if (!empty($errors)): ?>
    <div class="error">
        <?php foreach ($errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <div>
        <label for="name">Reseptin nimi:</label>
        <input type="text" id="name" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
    </div>
    <div>
        <label for="category">Kategoria:</label>
        <select id="category" name="category" required>
            <option value="">Valitse kategoria</option>
            <option value="aamiainen" <?= ($_POST['category'] ?? '') === 'aamiainen' ? 'selected' : '' ?>>Aamiainen</option>
            <option value="pääruoka" <?= ($_POST['category'] ?? '') === 'pääruoka' ? 'selected' : '' ?>>Pääruoka</option>
            <option value="välipala" <?= ($_POST['category'] ?? '') === 'välipala' ? 'selected' : '' ?>>Välipala</option>
            <option value="jälkiruoka" <?= ($_POST['category'] ?? '') === 'jälkiruoka' ? 'selected' : '' ?>>Jälkiruoka</option>
            <option value="muu" <?= ($_POST['category'] ?? '') === 'muu' ? 'selected' : '' ?>>Muu</option>
        </select>
    </div>
    <div>
        <label for="ingredients">Ainesosat:</label>
        <textarea id="ingredients" name="ingredients" rows="5" required><?= htmlspecialchars($_POST['ingredients'] ?? '') ?></textarea>
    </div>
    <div>
        <label for="instructions">Valmistusohjeet:</label>
        <textarea id="instructions" name="instructions" rows="10" required><?= htmlspecialchars($_POST['instructions'] ?? '') ?></textarea>
    </div>
    <button type="submit" class="btn">Tallenna resepti</button>
</form>

<?php require_once '../views/partials/footer.php'; ?>