<article class="post-all">
    <h1><?php echo $post->getTitle(); ?></h1>
    <p class="post-chapo"><?php echo $post->getChapo(); ?></p>
    <p class="post-modified">Modifié le :<?php echo $post->getModified(); ?></p>
    <div class="post-options">
        <a href="index.php?objet=post&action=display&id=<?php echo $post->getId(); ?>">Voir l'article</a>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role']==='admin'): ?>
            <a href="index.php?objet=post&action=update&id=<?php echo $post->getId(); ?>">Modifier l'article</a>
            <a href="index.php?objet=post&action=delete&id=<?php echo $post->getId(); ?>">Supprimer l'article</a>
        <?php endif; ?>
    </div>
</article>






