<?php $title = "Mon Blog - Mes créations"; ?>
<?php ob_start(); ?>

<div class="alert alert-success" role="alert">
    <?php if (isset($_SESSION['user'])): ?>
        Bonjour <?php echo $_SESSION['user']['first_name']; ?> et bienvenue sur le site !
    <?php else: ?>
        Bienvenue sur le site !
    <?php endif; ?>
    
</div>
<section id="post">
    <div class="container">
        <?php foreach ($posts as $post) {
            include __DIR__ . "/../posts/_info.php";
        }
        ?>
    </div>
</section>

<h2><a href="index.php?objet=post&action=displayAll">Accéder à l'ensemble des posts</a></h2>

<section id="contact">
    <div class="container">
        <h2>Contactez-moi</h2>
        <form action="index.php?action=mailto" method="post">
            <label for="nom_prenom">Nom et Prénom :</label>
            <input type="text" class="form-control" name="nom_prenom" required>

            <label for="email">E-mail de contact :</label>
            <input type="email" class="form-control" name="email" required>

            <label for="message">Message :</label>
            <textarea name="message" class="form-control" rows="4" required></textarea>

            <input type="submit" value="Envoyer">
        </form>
    </div>
</section>

<section id="cv">
    <div class="container">
        <h2>Mon CV</h2>
        <p>Téléchargez mon CV au format PDF :</p>
        <a href="/../../../public/assets/fichiers/cv.pdf" target="_blank">
        <img src="/../../../public/assets/images/cv-thumbnail.jpg" alt="CV">
        </a>
    </div>
</section>

<?php $content = ob_get_clean();

// Inclure le fichier layout.php
require ('layout.php');
?>