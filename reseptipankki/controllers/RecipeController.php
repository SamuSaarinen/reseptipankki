<?php
require_once '../models/Recipe.php';

class RecipeController {
    public function index() {
        $category = $_GET['category'] ?? null;
        $recipes = $category ? Recipe::getByCategory($category) : Recipe::getAll();
        require_once '../views/recipes/list.view.php';
    }
    
    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        require_once '../views/recipes/create.view.php';
    }
    
    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        
        $errors = [];
        $name = trim($_POST['name'] ?? '');
        $category = $_POST['category'] ?? '';
        $ingredients = trim($_POST['ingredients'] ?? '');
        $instructions = trim($_POST['instructions'] ?? '');
        
        if (empty($name)) $errors[] = "Nimi on pakollinen";
        if (empty($category)) $errors[] = "Kategoria on pakollinen";
        if (empty($ingredients)) $errors[] = "Ainesosat ovat pakollisia";
        if (empty($instructions)) $errors[] = "Ohjeet ovat pakollisia";
        
        if (empty($errors)) {
            $recipeId = Recipe::create(
                $_SESSION['user_id'],
                $name,
                $category,
                $ingredients,
                $instructions
            );
            
            if ($recipeId) {
                header("Location: ?controller=recipe&action=show&id=$recipeId");
                exit;
            } else {
                $errors[] = "Reseptin luominen epäonnistui";
            }
        }
        
        require_once '../views/recipes/create.view.php';
    }
    
    public function show($id) {
        $recipe = Recipe::getById($id);
        if (!$recipe) {
            header('Location: ?controller=recipe');
            exit;
        }
        require_once '../views/recipes/show.view.php';
    }
    
    public function edit($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        
        $recipe = Recipe::getById($id);
        if (!$recipe || $recipe['user_id'] != $_SESSION['user_id']) {
            header('Location: ?controller=recipe');
            exit;
        }
        
        require_once '../views/recipes/edit.view.php';
    }
    
    public function update($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        
        $recipe = Recipe::getById($id);
        if (!$recipe || $recipe['user_id'] != $_SESSION['user_id']) {
            header('Location: ?controller=recipe');
            exit;
        }
        
        $errors = [];
        $name = trim($_POST['name'] ?? '');
        $category = $_POST['category'] ?? '';
        $ingredients = trim($_POST['ingredients'] ?? '');
        $instructions = trim($_POST['instructions'] ?? '');
        
        if (empty($name)) $errors[] = "Nimi on pakollinen";
        if (empty($category)) $errors[] = "Kategoria on pakollinen";
        if (empty($ingredients)) $errors[] = "Ainesosat ovat pakollisia";
        if (empty($instructions)) $errors[] = "Ohjeet ovat pakollisia";
        
        if (empty($errors)) {
            if (Recipe::update($id, $name, $category, $ingredients, $instructions)) {
                header("Location: ?controller=recipe&action=show&id=$id");
                exit;
            } else {
                $errors[] = "Reseptin päivitys epäonnistui";
            }
        }
        
        require_once '../views/recipes/edit.view.php';
    }
    
    public function delete($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        
        $recipe = Recipe::getById($id);
        if ($recipe && $recipe['user_id'] == $_SESSION['user_id']) {
            Recipe::delete($id);
        }
        
        header('Location: ?controller=recipe');
        exit;
    }
}
?>