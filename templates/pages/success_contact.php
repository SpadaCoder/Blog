<?php $title = "SpadaCoder - Message encoyé"; ?>
<?php ob_start(); ?>

<h1>Merci pour votre message !</h1>
<p>Nous vous répondrons dans les plus brefs délais.</p>

<?php $content = ob_get_clean();

// Inclure le fichier layout.php
require ('layout.php');
?>