<?php $title = "SpadaCoder - Déconnexion"; ?>
<?php ob_start(); ?>
    <div>
    <a href="http://localhost/public/index.php?action=logout">Déconnexion</a>
</div>

<?php $content = ob_get_clean();

// Inclure le fichier layout.php
require ('layout.php');
?>