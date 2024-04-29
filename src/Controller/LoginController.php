<?php
namespace App\Controller;
use App\Manager\UserManager;

class LoginController
{
    private $userManager;
    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function login()
    {
        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $email = $_POST['email'];
            $password = $_POST['password'];
            $first_name = $_POST['$first_name'];
            $last_name = $_POST['last_name'];

            // Effectuer les vérifications nécessaires
            if ($this->isValidUser($email, $password)) {
                // L'utilisateur est valide, redirection vers la page d'accueil
                header("Location: index.php?objet=post&action=display");
                exit();
            } else {
                // L'utilisateur n'est pas valide, affichez un message d'erreur par exemple
                echo "Identifiants incorrects. Veuillez réessayer.";
            }
        }
        include_once (__DIR__ . '/../../templates/pages/login.php');
    }

    public function createAccount() 
    {
        include_once (__DIR__ . '/../../templates/pages/registration.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $userData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Créer un nouveau compte utilisateur
            $this->userManager->createUser($userData);
        }
    }

    private function isValidUser($email, $password)
    {
    }
}