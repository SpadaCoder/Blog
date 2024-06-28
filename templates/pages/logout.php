<?php $title = "SpadaCoder - Déconnexion"; ?>
<?php ob_start(); ?>
<div class="logout-container">
    <a href="http://localhost/public/index.php?action=logout" class="logout-button">Déconnexion</a>
</div>

<?php $content = ob_get_clean();

// Inclure le fichier layout.php.
require 'layout.php';
