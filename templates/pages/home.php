   <?php
// Inclure le fichier header.php
include('header.php'); 
?>
<section id="post">
    <div class="container">
        <?php foreach ($posts as $post): ?>
            <div class="post-all">
                <h1><?php echo $post->getTitle(); ?></h1>
                <p class="post-chapo"><?php echo $post->getChapo(); ?></p>
                <a href="index.php?objet=post&action=display&id=<?php echo $post->getId(); ?>">Voir l'article</a>
            </div>
        <?php endforeach; ?>
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
        <p>Téléchargez mon CV au format PDF : <a href="/../../../public/assets/fichiers/cv.pdf" target="_blank">CV.pdf</a></p>
    </div>
</section>

<?php
// Inclure le fichier header.php
include('footer.php'); 
?>
