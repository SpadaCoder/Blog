<?php
namespace App\Controller;

use App\Manager\UserManager;

class ContactController
{

    private $userManager;
    private $postClean;


    public function __construct(UserManager $userManager)
    {
        // Filtrer les données POST et les stocker dans une propriété.
        $this->postClean = filter_input_array(INPUT_POST);

        // Création d'un UserManager.
        $this->userManager = $userManager;

        // end__construct().
    }


    private function sanitizeInput($data)
    {
        // Convertir les caractères spéciaux en entités HTML.
        $data = htmlspecialchars($data);
        return $data;
    }

    public function processContactForm()
    {
        // Récupérer et nettoyer les données du formulaire.
        $nomPrenom = $this->postClean['nom_prenom'];
        $email = $this->postClean['email'];
        $message = $this->postClean['message'];

        // Récupérer les adresses e-mail des admins via UserManager.
        $adminEmails = $this->userManager->getAdminEmails();
        $to = implode(',', $adminEmails);

        // Sujet de l'email.
        $subject = "Nouveau message de $nomPrenom";

        // Corps de l'email.
        $email_message = "Nom et Prénom: $nomPrenom\n";
        $email_message .= "E-mail: $email\n";
        $email_message .= "Message: \n$message\n";

        // En-têtes de l'email.
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Envoi de l'email.
        mail($to, $subject, $email_message, $headers);

        require_once (__DIR__ . '/../../templates/pages/success_contact.php');

    }

}
