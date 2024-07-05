<?php
namespace App\Controller;

use App\Manager\UserManager;
use App\Entity\User;

class LoginController
{
    private $userManager; // Instance de la classe UserManager pour gérer les opérations utilisateur.

    private $postClean; // Tableau contenant les données nettoyées provenant de $_POST.


    /**
     * Constructeur de la classe LoginController.
     * Initialise les données POST nettoyées et crée une instance de UserManager.
     */
    public function __construct()
    {
        // Filtrer les données POST et les stocker dans une propriété.
        $this->postClean = filter_input_array(INPUT_POST);

        // Création d'un nouveau UserManager.
        $this->userManager = new UserManager();

    }


    /**
     * Nettoie un tableau de session en utilisant htmlspecialchars pour éviter les attaques XSS.
     *
     * @param array $session Le tableau de session à nettoyer.
     * @return array Le tableau de session nettoyé.
     */
    public function cleanSession(array $session)
    {
        $sessionClean = [];
        foreach ($session as $key => $value) {
            if (is_array($value) === TRUE) {
                $sessionClean[$key] = $this->cleanSession($value);
            } else {
                $sessionClean[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
        }

        return $sessionClean;
    }


    /**
     * Gère le processus de connexion utilisateur.
     *
     * @param array $serverClean Le tableau nettoyé des données du serveur.
     * @param array $sessionClean Le tableau nettoyé des données de session.
     * @throws \Exception Si les identifiants de connexion sont incorrects.
     */
    public function login(array $serverClean, array $sessionClean)
    {
        if (isset($sessionClean['user']) === TRUE && !empty($sessionClean['user'])) {
            include_once __DIR__.'/../../templates/pages/logout.php';
            exit();
        }

        // Vérifier si le formulaire a été soumis.
        if (isset($serverClean["REQUEST_METHOD"]) === TRUE && $serverClean["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire.
            if (isset($this->postClean['email']) === TRUE && isset($this->postClean['password']))
                $email = $this->postClean['email'];
            $password = $this->postClean['password'];

            // Effectuer les vérifications nécessaires.
            $user = $this->userManager->isValidUser($email, $password);

            if ($user !== false) {
                // L'utilisateur est valide, enregistrer la session et rediriger vers la page d'accueil.
                $_SESSION['user'] = $user;
                unset($_SESSION['user']['password']);

                // Rediriger vers la page d'accueil après la connexion réussie.
                header("Location: index.php?");
                return;
            } 
                // L'utilisateur n'est pas valide, lever une exception.
                throw new \Exception("Identifiants incorrects. Veuillez réessayer.");

            // End if.
        }

        // Inclure le formulaire de connexion si le formulaire n'a pas été soumis.
        include_once __DIR__.'/../../templates/pages/login.php';
        exit();
    }


    /**
     * Affiche le formulaire d'inscription et traite sa soumission.
     *
     * @param array $serverClean Le tableau nettoyé des données du serveur.
     */
    public function createAccount($serverClean)
    {
        include __DIR__.'/../../templates/pages/registration.php';

        if (isset($serverClean["REQUEST_METHOD"]) && $serverClean["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire.
            $userData = $this->postClean;

            // Créer un nouveau compte utilisateur.
            $this->userManager->createUser($userData);

            header("Location: index.php?action=login");
        }
        exit();
    }


    /**
     * Déconnecte l'utilisateur en détruisant les données de session.
     */
    public function logout()
    {
        // Détruire les données de la session.
        session_destroy();
        // Redirige vers une page après la déconnexion.
        header("Location: index.php");
        exit();
    }
}
