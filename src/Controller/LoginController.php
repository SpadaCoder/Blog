<?php
namespace App\Controller;

class LoginController
{
    public function __construct()
    {

    }

    public function login()
    {
        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $email = $_POST['email'];
            $password = $_POST['password'];

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
    }
    private function isValidUser($email, $password)
    {
    }
}