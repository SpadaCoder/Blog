<?php
namespace App\Controller;

use App\Manager\UserManager;

class ContactController
{
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }
    private function sanitizeInput($data)
    {
        // Supprimer les antislashes
        $data = stripslashes($data);
        // Convertir les caractères spéciaux en entités HTML
        $data = htmlspecialchars($data);
        return $data;
    }
    public function processContactForm()
    {
        // Récupérer et nettoyer les données du formulaire
        $nomPrenom = $this->sanitizeInput($_POST['nom_prenom']);
        $email = $this->sanitizeInput($_POST['email']);
        $message = $this->sanitizeInput($_POST['message']);

        // Récupérer les adresses e-mail des admins via UserManager
        $adminEmails = $this->userManager->getAdminEmails();
        $to = implode(',', $adminEmails);

        // Sujet de l'email
        $subject = "Nouveau message de $nomPrenom";

        // Corps de l'email
        $email_message = "Nom et Prénom: $nomPrenom\n";
        $email_message .= "E-mail: $email\n";
        $email_message .= "Message: \n$message\n";

        // En-têtes de l'email
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Envoi de l'email
        $mail = mail($to, $subject, $email_message, $headers);
        if ($mail) {
            $_SESSION['message'] = 'Merci, votre message a été envoyé.';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Désolé, une erreur s\'est produite lors de l\'envoi de votre message. Veuillez réessayer plus tard.';
            $_SESSION['message_type'] = 'error';
        }

       // require_once (__DIR__ . '/../../templates/pages/success_contact.php');
        exit();
    }

}