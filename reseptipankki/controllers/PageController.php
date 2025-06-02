<?php
class PageController {
    public function home() {
        require_once '../views/pages/home.view.php';
    }
    
    public function categories() {
        $categories = [
            'aamiainen' => 'Aamiaiset',
            'pääruoka' => 'Pääruoat',
            'välipala' => 'Välipalat',
            'jälkiruoka' => 'Jälkiruoat',
            'muu' => 'Muut'
        ];
        require_once '../views/pages/categories.view.php';
    }
    
    public function contact() {
        require_once '../views/pages/contact.view.php';
    }
    
    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?controller=auth&action=login');
            exit;
        }
        $user = User::getById($_SESSION['user_id']);
        require_once '../views/pages/profile.view.php';
    }
}
?>