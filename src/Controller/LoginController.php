<?php
namespace App\Controller;

use App\Manager\UserManager;
use App\Entity\User;

class LoginController
{
    private $userManager;
    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            include_once (__DIR__ . '/../../templates/pages/logout.php');
        } else {
            // Vérifier si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupérer les données du formulaire
                $email = $_POST['email'];
                $password = $_POST['password'];
                // Effectuer les vérifications nécessaires
                $user = $this->userManager->isValidUser($email, $password);
                if ($user !== false) {
                    // L'utilisateur est valide, enregister la session et redirection vers la page d'accueil
                    $_SESSION['user'] = $user;
                    unset($_SESSION['user']['password']);
                    header("Location: index.php?");
                    exit();
                } else {
                    // L'utilisateur n'est pas valide, affichez un message d'erreur par exemple
                    echo "Identifiants incorrects. Veuillez réessayer.";
                }
            }
            include_once (__DIR__ . '/../../templates/pages/login.php');
        }
    }

    public function createAccount()
    {
        include_once (__DIR__ . '/../../templates/pages/registration.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $userData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Créer un nouveau compte utilisateur
            $this->userManager->createUser($userData);

            header("Location: index.php?");
        }
    }

    public function logout()
    {
        //Détruire les données de la session
        session_unset();
        session_destroy();
        // Redirige vers une page après la déconnexion
        header("Location: index.php");
        exit();
    }
}