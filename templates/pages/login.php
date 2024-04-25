<?php
// Inclure le fichier header.php
include('header.php'); 
?>


<h2>Connexion</h2>
    <form action="" method="post">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
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
    </form>