<?php $title = "SpadaCoder - Créer un compte"; ?>
<?php ob_start(); ?>

<!-- Formulaire de création de compte -->
<form action="index.php?action=create_account" method="post">
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="you@exemple.com" required>
    </div>
    <div>
        <label for="first_name">Prénom:</label>
        <input type="text" id="first_name" name="first_name" required>
    </div>
    <div>
        <label for="last_name">Nom:</label>
        <input type="text" id="last_name" name="last_name" required>
    </div>
    <div>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="submit">Créer un compte</button>
    </div>
    <input type="hidden" name="create_account" value="1">
</form>
<p>Vous avez déjà un compte ? <a href="index.php?action=login">Connectez-vous</a></p>

<?php $content = ob_get_clean();

// Inclure le fichier layout.php
require ('layout.php');
?>