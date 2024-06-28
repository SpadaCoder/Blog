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
   
    // Envoi de l'email
    mail($to, $subject, $email_message, $headers);

}