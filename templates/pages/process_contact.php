<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_prenom = htmlspecialchars($_POST['nom_prenom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
 
    // Adresse email de l'admin
    $to = 'spadacinisandra@gmail.com'; // TO DO
    
    // Sujet de l'email
    $subject = "Nouveau message de $nom_prenom";
    
    // Corps de l'email
    $email_message = "Nom et Prénom: $nom_prenom\n";
    $email_message .= "E-mail: $email\n";
    $email_message .= "Message: \n$message\n";
    
    // En-têtes de l'email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
   // $mail = mail($to, $subject, $email_message, $headers);
   echo "<pre>";
    var_dump(mail($to, $subject, $email_message, $headers));
    echo "</pre>";
die();

    // Envoi de l'email
    if ($mail) {
        $_SESSION['message'] = 'Merci, votre message a été envoyé.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Désolé, une erreur s\'est produite lors de l\'envoi de votre message. Veuillez réessayer plus tard.';
        $_SESSION['message_type'] = 'error';
    }
}
