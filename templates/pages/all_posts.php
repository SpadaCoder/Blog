<?php
// Inclure le fichier header.php
include ('header.php');
?>
<section id="post">
    <div class="container">
        <?php foreach ($posts as $post): ?>
            <div class="post-all">
                <h1>
                    <?php echo $post->getTitle(); ?>
                </h1>
                <p class="post-chapo">
                    <?php echo $post->getChapo(); ?>
                </p>
                <div class="post-meta">
                    <p class="post-modified">Modifié le :
                        <?php echo $post->getModified(); ?>
                    </p>
                </div>
                <div class="post-options">
                    <a href="index.php?objet=post&action=display&id=<?php echo $post->getId(); ?>">Voir l'article</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// Inclure le fichier header.php
include ('footer.php');
?>