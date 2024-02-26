<?php 
$nom = "Spadacini";

// si objet = post 
if (isset($_GET['objet']) && 'post' === $_GET['objet']) {
    // si action = display
    if (isset($_GET['action']) && 'display' === $_GET['action'])
        //Appel controleur affiche post
        require_once (__DIR__ . '/../src/Controller/PostController.php');
        $postController = new \App\Controller\PostController();
        $postController->display();
    // si action = add
    if (isset($_GET['action']) && 'add' === $_GET['action']) {
        // Appel controleur ajout post
        echo 'OK';
    }
    // si action = modify
    if (isset($_GET['action']) && 'modify' === $_GET['action']) {
        // Appel controleur modifier post
        echo 'OK';
    }
}
