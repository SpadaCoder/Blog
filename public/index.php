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
    // Vérifier l'action demandée.
    if (isset($_GET['action']) === TRUE) {
        $loginController = new LoginController();
        $commentController = new CommentController();
        $postController = new PostController();
        $userManager = new UserManager();
        $contactController = new ContactController($userManager);
        // Création du compte.
        if ('create_account' === $_GET['action']) {
            $loginController->createAccount();
        }

        // Login.
        if ('login' === $_GET['action']) {
            $loginController->login();
        }

        // Logout.
        if ('logout' === $_GET['action']) {
            $loginController->logout();
        }

        // Contact.
        if ('mailto' === $_GET['action']) {
            $contactController = new ContactController($userManager);
            $contactController->processContactForm();
        }

        // Affichage des Posts.
        if (isset($_GET['objet']) === TRUE && 'post' === $_GET['objet']) {
            // Tous les Posts.
            if ('displayAll' === $_GET['action']) {
                $postController->displayAll();
            }
            // Affichage d'un Post avec son id.
            if (isset($_GET['id'])) {
                if ('display' === $_GET['action']) {
                    $postController->display($_GET['id']);
                }
            }
        }

        // Administration.
        if (isset($_GET['role']) && 'admin' === $_GET['role']) {
            //Approbation des commentaires.
            if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
                if ('approvecomments' === $_GET['action']) {
                    $commentController->displayCommentsToApprove();
                }
                // Ajout d'un Post.
                if ('add' === $_GET['action'] && isset($_GET['objet']) && 'post' === $_GET['objet']) {
                    $postController->add();
                }
                // Action sur Post existant.
                if (isset($_GET['objet']) && 'post' === $_GET['objet'] && isset($_GET['id'])) {
                    // Modification du Post.
                    if ('update' === $_GET['action']) {
                        $postController->update($_GET['id']);
                    }
                    // Suppression du Post.
                    if ('delete' === $_GET['action']) {
                        $postController->delete($_GET['id']);
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
    if (!isset($_GET['objet'])) {
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