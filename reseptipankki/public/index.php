<?php
require_once '../config/database.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/PageController.php';
require_once '../controllers/RecipeController.php';

$controller = $_GET['controller'] ?? 'page';
$action = $_GET['action'] ?? 'home';

switch ($controller) {
    case 'auth':
        $authController = new AuthController();
        switch ($action) {
            case 'login': $authController->login(); break;
            case 'register': $authController->register(); break;
            case 'logout': $authController->logout(); break;
            default: header('Location: ?controller=page&action=home'); exit;
        }
        break;
        
    case 'recipe':
        $recipeController = new RecipeController();
        switch ($action) {
            case 'create': $recipeController->create(); break;
            case 'store': $recipeController->store(); break;
            case 'edit': 
                if (isset($_GET['id'])) $recipeController->edit($_GET['id']); 
                else header('Location: ?controller=recipe'); 
                break;
            case 'update': 
                if (isset($_GET['id'])) $recipeController->update($_GET['id']); 
                else header('Location: ?controller=recipe'); 
                break;
            case 'delete': 
                if (isset($_GET['id'])) $recipeController->delete($_GET['id']); 
                else header('Location: ?controller=recipe'); 
                break;
            case 'show': 
                if (isset($_GET['id'])) $recipeController->show($_GET['id']); 
                else header('Location: ?controller=recipe'); 
                break;
            default: $recipeController->index();
        }
        break;
        
    default:
        $pageController = new PageController();
        switch ($action) {
            case 'home': $pageController->home(); break;
            case 'categories': $pageController->categories(); break;
            case 'contact': $pageController->contact(); break;
            case 'profile': $pageController->profile(); break;
            default: $pageController->home();
        }
}
?>