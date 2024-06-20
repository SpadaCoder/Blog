<?php
namespace App\Controller;

use App\Manager\UserManager;
use App\Entity\User;

class LoginController
{
    // Une instance de la classe UserManager pour gérer les opérations utilisateur.
    private $userManager;


    public function __construct()
    {
        // Création d'un nouveau UserManager.
        $this->userManager = new UserManager();
    }


    public function login()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            include_once __DIR__.'/../../templates/pages/logout.php';
            exit();
        }
    
         // Vérifier si le formulaire a été soumis.
         if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire.
            if(isset($_POST['email']) && isset($_POST['password']))
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Effectuer les vérifications nécessaires.
            $user = $this->userManager->isValidUser($email, $password);

            if ($user !== false) {
                // L'utilisateur est valide, enregistrer la session et rediriger vers la page d'accueil.
                $_SESSION['user'] = $user;
                unset($_SESSION['user']['password']);
                header("index.php");
                return;
            } else {
                // L'utilisateur n'est pas valide, lever une exception.
                throw new \Exception("Identifiants incorrects. Veuillez réessayer.");
            }
        }

        // Inclure le formulaire de connexion si le formulaire n'a pas été soumis.
        include_once __DIR__.'/../../templates/pages/login.php';
        exit();
    }


    public function createAccount()
    {
        include_once __DIR__.'/../../templates/pages/registration.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire.
            $userData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Créer un nouveau compte utilisateur.
            $this->userManager->createUser($userData);

            header("Location: index.php?");
        }
    }


    public function logout()
    {
        // Détruire les données de la session.
        session_destroy();
        // Redirige vers une page après la déconnexion.
        header("Location: index.php");
        exit();
    }
}
