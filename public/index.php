<?php

use App\Controller\PostController;

// autoload des classes
spl_autoload_register(function ($class) {
    $classFile = __DIR__ . "/../src/" . str_replace('App/', '', str_replace('\\', '/', $class)) . ".php";
    require_once $classFile;
});

// si objet = post 
if (isset($_GET['objet']) && 'post' === $_GET['objet']) {
    //Appel controleur affiche tous les posts
    $postController = new PostController();
    // si action = display
    if (isset($_GET['action']) && 'display' === $_GET['action']) {
        // si id        
        if (isset($_GET['id'])) {
            $postController->single($_GET['id']);
        }

        $postController->display();
    }
    //si action = displayAll
    if (isset($_GET['action']) && 'displayAll' === $_GET['action']) {
        // Appel controleur ajout post
        $postController->displayAll();
    }

    // si action = add
    if (isset($_GET['action']) && 'add' === $_GET['action']) {
        // Appel controleur ajout post
        $postController->add();
    }

    // si action = update
    if (isset($_GET['action']) && 'update' === $_GET['action']) {
        // Appel controleur modifier post en fonction de l'ID  
        if (isset($_GET['id'])) {
            $postController->update($_GET['id']);
        } else {
            echo "L'article n'existe pas ou n'est pas renseigné";
        }

    }
    //si action = delete
    if (isset($_GET['action']) && 'delete' === $_GET['action']) {
        if (isset($_GET['id'])) {
            $postController->delete($_GET['id']);
        } else {
            echo "L'article n'existe pas ou n'est pas renseigné";
        }
    }
}