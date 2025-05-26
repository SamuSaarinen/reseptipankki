<?php
require_once __DIR__ . 'reseptipankki\public\header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit;
}

$recipe = query("SELECT * FROM recipes WHERE id = ?", [$_GET['id']])->fetch();

if (!$recipe || $recipe['user_id'] != $_SESSION['user_id']) {
    header('Location: index.php?action=recipes');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = $_POST['category'];
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);
    
    if (empty($name) || empty($ingredients) || empty($instructions)) {
        $error = "Kaikki kentät ovat pakollisia";
    } else {
        query("UPDATE recipes SET name = ?, category = ?, ingredients = ?, instructions = ? WHERE id = ?", 
             [$name, $category, $ingredients, $instructions, $_GET['id']]);
        header("Location: index.php?action=view&id=" . $_GET['id']);
        exit;
    }
}
?>

<h1>Muokkaa reseptiä</h1>

<?php if (isset($error)): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<form method="post">
    <div>
        <label for="name">Reseptin nimi:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($recipe['name']) ?>" required>
    </div>
    <div>
        <label for="category">Kategoria:</label>
        <select id="category" name="category" required>
            <option value="breakfast" <?= $recipe['category'] === 'breakfast' ? 'selected' : '' ?>>Aamiainen</option>
            <option value="main" <?= $recipe['category'] === 'main' ? 'selected' : '' ?>>Pääruoka</option>
            <option value="snack" <?= $recipe['category'] === 'snack' ? 'selected' : '' ?>>Välipala</option>
            <option value="dessert" <?= $recipe['category'] === 'dessert' ? 'selected' : '' ?>>Jälkiruoka</option>
            <option value="other" <?= $recipe['category'] === 'other' ? 'selected' : '' ?>>Muu</option>
        </select>
    </div>
    <div>
        <label for="ingredients">Ainesosat:</label>
        <textarea id="ingredients" name="ingredients" required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>
    </div>
    <div>
        <label for="instructions">Ohjeet:</label>
        <textarea id="instructions" name="instructions" required><?= htmlspecialchars($recipe['instructions']) ?></textarea>
    </div>
    <button type="submit" class="button">Tallenna muutokset</button>
</form>

<?php require_once __DIR__ . 'reseptipankki\public\footer.php'; ?>