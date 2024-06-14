<?php
    if (isset($_SESSION['message'])) {
        echo '<p>' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    } else {
        echo '<p>Aucun message à afficher.</p>';
    }
    ?>
    <p>Vous serez redirigé vers la page d\'accueil dans quelques secondes.</p>