<?php
require_once __DIR__ . '../includes/config.php';
require_once __DIR__ . '../includes/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
   
}
$allowed = ['aamiainen', 'paaruoka', 'valipala', 'jalkiruoka', 'muu'];
if (!in_array($_POST['category'], $allowed)) {
    die("Virheellinen kategoria");
}
$action = $_POST['action'];

switch ($action) {
    case 'create':
        $name = $_POST['name'];
        $category = $_POST['category'];
        $ingredients = $_POST['ingredients'];
        $instructions = $_POST['instructions'];
        
        query("INSERT INTO recipes (name, category, ingredients, instructions, user_id) 
              VALUES (?, ?, ?, ?, ?)", 
              [$name, $category, $ingredients, $instructions, $_SESSION['user_id']]);
        
        header('Location: ../index.php?action=recipes');
        break;
        
    case 'edit':
        $id = $_POST['id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $ingredients = $_POST['ingredients'];
        $instructions = $_POST['instructions'];
        
        // Tarkista että resepti kuuluu kirjautuneelle käyttäjälle
        $recipe = query("SELECT user_id FROM recipes WHERE id = ?", [$id])->fetch();
        if ($recipe && $recipe['user_id'] == $_SESSION['user_id']) {
            query("UPDATE recipes SET name = ?, category = ?, ingredients = ?, instructions = ? 
                  WHERE id = ?", 
                  [$name, $category, $ingredients, $instructions, $id]);
        }
        
        header('Location: ../index.php?action=view&id=' . $id);
        break;
}

exit;
?>