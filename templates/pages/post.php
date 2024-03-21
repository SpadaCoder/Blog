<?php
// Inclure le fichier header.php
include('header.php'); 

use App\Controller\PostController;
?>
<section id="post">
    <div class="container">
        <div class="post-all">
            <h1><?php echo $post->getTitle(); ?></h1>
            <p class="post-chapo"><?php echo $post->getChapo(); ?></p>
            <p class="post-content"><?php echo $post->getContent(); ?></p>
            <div class="post-meta">
                <p class="post-author">Ecrit par : <?php echo $post->getAuthor(); ?></p>
                <p class="post-modified">Modifié le : <?php echo $post->getModified(); ?></p>
            </div>
        </div>
    </div>
</section>

<?php
// Inclure le fichier header.php
include('footer.php'); 
?>