<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Blog - Accueil</title>
    <link rel="stylesheet" href="/../public/assets/styles/styles.css">
</head>
<body>

<header>
    <div class="container">
        <h1>Sandra Spadacini</h1>
        <img src="img/profile-picture.jpg" alt="Sandra Spadacini">
        <p>"Bienvenue dans le royaume de SpadaCoder, où le code devient une œuvre d'expression et les idées prennent vie numériquement."</p>
    </div>
</header>

<nav>
    <div class="container">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="dashboard.php">Tableau de bord</a></li>
            <li><a href="admin.php">Paramètre</a></li>

        </ul>
    </div>
</nav>
<section id="post">
    <div class="container">
        <div class="post-content">
    <h1><?php echo $post->getTitle(); ?></h1>
    <p class="post-chapo"><?php echo $post->getChapo(); ?></p>
    <p class="post-content"><?php echo $post->getContent(); ?></p>
        </div>
    </div>
</section>
<section id="contact">
    <div class="container">
        <h2>Contactez-moi</h2>
        <form action="process_contact.php" method="post">
            <label for="nom_prenom">Nom/Prénom :</label>
            <input type="text" name="nom_prenom" required>

            <label for="email">E-mail de contact :</label>
            <input type="email" name="email" required>

            <label for="message">Message :</label>
            <textarea name="message" rows="4" required></textarea>

            <input type="submit" value="Envoyer">
        </form>
    </div>
</section>

<section id="cv">
    <div class="container">
        <h2>Mon CV</h2>
        <p>Téléchargez mon CV au format PDF : <a href="img/cv.pdf" target="_blank">CV.pdf</a></p>
    </div>
</section>

<section id="reseaux-sociaux">
    <div class="container">
        <h2>Suivez-moi sur les réseaux sociaux</h2>
        <ul>
            <li><a href="https://github.com/SpadaCoder" target="_blank">GitHub</a></li>
            <li><a href="https://www.linkedin.com/in/sandra-spadacini-ab548a66/" target="_blank">LinkedIn</a></li>
        </ul>
    </div>
</section>

<footer>
    <div class="container">
        <p>&copy; 2024 Spadacini Sandra - Tous droits réservés</p>
    </div>
</footer>

</body>
</html>
