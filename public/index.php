<?php

use App\Controller\PostController;
use App\Controller\LoginController;
use App\Controller\CommentController;
use App\Controller\ContactController;
use App\Manager\UserManager;


// Autoload des classes.
spl_autoload_register(function ($class) {
        $classFile = __DIR__."/../src/".str_replace('App/', '', str_replace('\\', '/', $class)).".php";
        include_once $classFile;
    }
);

session_start();

try {
    $getClean = filter_input_array(INPUT_GET);
    $postClean = filter_input_array(INPUT_POST);
    // Vérifier l'action demandée.
    if (isset($getClean['action']) === true) {
        $loginController = new LoginController();
        $commentController = new CommentController();
        $postController = new PostController();
        $userManager = new UserManager();
        $contactController = new ContactController($userManager);
        // Création du compte.
        if ('create_account' === $getClean['action']) {
            $loginController->createAccount();
        }

        // Login.
        if ('login' === $getClean['action']) {
            $loginController->login();
        }

        // Logout.
        if ('logout' === $getClean['action']) {
            $loginController->logout();
        }

        // Contact.
        if ('mailto' === $getClean['action']) {
            $contactController = new ContactController($userManager);
            $contactController->processContactForm();
            exit();
        }

        // Affichage des Posts.
        if (isset($getClean['objet']) === TRUE && 'post' === $getClean['objet']) {
            // Tous les Posts.
            if ('displayAll' === $getClean['action']) {
                $postController->displayAll();
            }
            // Affichage d'un Post avec son id.
            if (isset($getClean['id'])) {
                if ('display' === $getClean['action']) {
                    $postController->display($getClean['id']);
                }
            }
        }

        // Administration.
        if (isset($getClean['role']) && 'admin' === $getClean['role']) {
            //Approbation des commentaires.
            if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
                if ('approvecomments' === $getClean['action']) {
                    $commentController->displayCommentsToApprove();
                }
                // Ajout d'un Post.
                if ('add' === $getClean['action'] && isset($getClean['objet']) && 'post' === $getClean['objet']) {
                    $postController->add();
                }
                // Action sur Post existant.
                if (isset($getClean['objet']) && 'post' === $getClean['objet'] && isset($getClean['id'])) {
                    // Modification du Post.
                    if ('update' === $getClean['action']) {
                        $postController->update($getClean['id']);
                    }
                    // Suppression du Post.
                    if ('delete' === $getClean['action']) {
                        $postController->delete($getClean['id']);
                    }
                }
                // Message d'erreur non admin.
            } else {
                $error_message = "Vous n'avez pas les autorisations nécessaires pour accéder à cette page veuillez vous connecter en tant qu'admin";
                require (__DIR__ . '/../templates/pages/error.php');
                exit;
            }
        } else {
            $postController->displayNumber();
        }
        // end if
    }

    // Vérifier si aucun objet n'est spécifié.
    if (!isset($getClean['objet'])) {
        // Créer une instance de PostController.
        $postController = new PostController();
        // Appeler la méthode displayNumber par défaut.
        $postController->displayNumber();
    }
} catch (\Exception $e) {
    // Gérer toutes les autres exceptions.
    $error_message = 'Erreur : ' . $e->getMessage();
    require (__DIR__ . '/../templates/pages/error.php');
}