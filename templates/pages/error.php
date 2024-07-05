<?php $title = "SpadaCoder - Erreur de page";
?>

<?php ob_start(); ?>

<h1>Erreur de page</h1>
<p><?= htmlspecialchars($error_message) ?></p>

<?php $content = ob_get_clean();

// Inclure le fichier layout.php.
require 'layout.php';
