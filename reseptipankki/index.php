<?php
session_start();
require_once __DIR__ .'../includes/config.php';
require_once __DIR__ .'../includes/db.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        require 'pages/home.php';
        break;
    case 'categories':
        require 'pages/categories.php';
        break;
    case 'contact':
        require 'pages/contact.php';
        break;
    case 'myaccount':
        require 'pages/myaccount.php';
        break;
    case 'login':
        require 'pages/login.php';
        break;
    case 'register':
        require 'pages/register.php';
        break;
    case 'logout':
        session_destroy();
        header('Location: index.php');
        exit;
    case 'recipes':
        require 'pages/recipes/index.php';  // Korjattu: poistettu "../" alusta
        break;
    case 'view':
        require 'pages/recipes/views.php';  // Korjattu: poistettu "/s.." alusta
        break;
    case 'create':
        require 'pages/recipes/create.php';
        break;
    case 'edit':
        require 'pages/recipes/edit.php';
        break;
    case 'delete':
        require 'pages/recipes/delete.php';
        break;
    case 'pdf':
        require 'pages/recipes/pdf.php';
        break;
    default:
        require 'pages/home.php';
}
?>