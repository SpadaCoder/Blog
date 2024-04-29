<?php
// Inclure le fichier header.php
include ('header.php');
?>

        <!-- Formulaire de connexion -->
        <form action="index.php?action=login" method="post">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="you@exemple.com" required>
            </div>
            <div>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit">Se connecter</button>
            </div>
        </form>
        <p>Vous n'avez pas de compte ? <a href="index.php?action=create_account">Créez un compte</a></p>

        <?php
// Inclure le fichier header.php
include ('footer.php');
?>