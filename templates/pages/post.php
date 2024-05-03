<?php
// Inclure le fichier header.php
include ('header.php');

use App\Controller\PostController;

?>
<section id="post">
    <div class="container">
        <div class="post-all">
            <h1>
                <?php echo $post->getTitle(); ?>
            </h1>
            <p class="post-chapo">
                <?php echo $post->getChapo(); ?>
            </p>
            <p class="post-content">
                <?php echo $post->getContent(); ?>
            </p>
            <div class="post-meta">
                <p class="post-author">Ecrit par :
                    <?php echo $post->getAuthor(); ?>
                </p>
                <p class="post-modified">Modifié le :
                    <?php echo $post->getModified(); ?>
                </p>
            </div>
        </div>
    </div>
</section>
<section id="comment">
    <div class="container">
        <div class="display-comment">
            <h3>Commentaires</h3>
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li><?php echo $comment->getContent(); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php if (isset($_SESSION['user'])): ?>
            <div class="add-comment">
                <form action="" method="post">
                    <label for="content" class="form-label">Ajouter un commentaire </label>
                    <textarea class="form-control" id="content" name="content" required></textarea>
                    <button type="submit">Poster</button>
                </form>
            </div>
        <?php else: ?>
            echo 'Veuillez vous connecter pour laisser un commentaire';
        <?php endif; ?>
    </div>
</section>

<?php
// Inclure le fichier header.php
include ('footer.php');
?>