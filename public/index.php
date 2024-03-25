<?php

use App\Controller\PostController;

// autoload des classes
spl_autoload_register(function ($class) {
    $classFile = __DIR__ . "/../src/" . str_replace('App/', '', str_replace('\\', '/', $class)) . ".php";
    require_once $classFile;
});

// si objet = post 
if (isset ($_GET['objet']) && 'post' === $_GET['objet']) {
    //Appel controleur affiche tous les posts
    $postController = new PostController();
    // si action = display
    if (isset ($_GET['action']) && 'display' === $_GET['action']) {
        // si id        
        if (isset ($_GET['id'])) {
            $postController->single($_GET['id']);
        }

        $postController->display();
    }
    // si action = add
    if (isset ($_GET['action']) && 'add' === $_GET['action']) {
        // Appel controleur ajout post
        $postController->add();
    }

        // si action = store
        if (isset ($_GET['action']) && 'store' === $_GET['action']) {
            // Appel controleur ajout post
            $postController->store();
        }

    // si action = modify
    if (isset ($_GET['action']) && 'modify' === $_GET['action']) {
        // Appel controleur modifier post
        echo 'OK';
    }
}

