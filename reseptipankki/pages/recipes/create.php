<?php 
require_once 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
?>

<h1>Luo uusi resepti</h1>

<form action="process_recipe.php" method="post">
    <input type="hidden" name="action" value="create">
    
    <div>
        <label for="name">Reseptin nimi:</label>
        <input type="text" id="name" name="name" required>
    </div>
    
    <div>
    <select id="category" name="category" required>
    <option value="aamiainen">Aamiainen</option>
    <option value="paaruoka">Pääruoka</option>
    <option value="valipala">Välipala</option>
    <option value="jalkiruoka">Jälkiruoka</option>
    <option value="muu">Muu</option>
</select>
    </div>
    
    <div>
        <label for="ingredients">Ainesosat:</label>
        <textarea id="ingredients" name="ingredients" required></textarea>
    </div>
    
    <div>
        <label for="instructions">Ohjeet:</label>
        <textarea id="instructions" name="instructions" required></textarea>
    </div>
    
    <button type="submit">Tallenna resepti</button>
</form>

<?php require_once 'includes/footer.php'; ?>