<?php

use App\Controller\PostController;
use App\Controller\LoginController;

// autoload des classes
spl_autoload_register(function ($class) {
    $classFile = __DIR__ . "/../src/" . str_replace('App/', '', str_replace('\\', '/', $class)) . ".php";
    require_once $classFile;
});

session_start();

// Vérifier l'action demandée
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $loginController = new LoginController();
    switch ($action) {
        case 'create_account':
            $loginController->createAccount();
            break;
        case 'login':
            $loginController->login();
            break;
        case 'logout':
            $loginController->logout();
            break;
    }
}

// Vérifier si aucun objet n'est spécifié
if (!isset($_GET['objet']) && !isset($_GET['action'])) {
    // Créer une instance de PostController
    $postController = new PostController();
    // Appeler la méthode displayNumber par défaut
    $postController->displayNumber();
}

// si objet = post 
if (isset($_GET['objet']) && 'post' === $_GET['objet']) {
    //Appel controleur affiche tous les posts
    $postController = new PostController();
    // si action = display
    if (
        isset($_GET['action']) &&
        'display' === $_GET['action']
    ) {
        // si id        
        if (isset($_GET['id'])) {
            $postController->display($_GET['id']);
        }
    }
    //si action = displayAll
    if (
        isset($_GET['action']) &&
        'displayAll' === $_GET['action']
    ) {
        // Appel controleur ajout post
        $postController->displayAll();
    }

    // si action = add
    if (
        isset($_GET['action']) &&
        'add' === $_GET['action']
    ) {
        // Appel controleur ajout post
        $postController->add();
    }

    // si action = update
    if (
        isset($_GET['action']) &&
        'update' === $_GET['action'] &&
        isset($_GET['id'])
    ) {
        $postController->update($_GET['id']);
    }

    //si action = delete
    if (
        isset($_GET['action']) &&
        'delete' === $_GET['action'] &&
        isset($_GET['id'])
    ) {
        $postController->delete($_GET['id']);
    }
}