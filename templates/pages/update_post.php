<?php $title = "SpadaCoder - Modifier un article"; ?>
<?php ob_start(); ?>

<body>

    <section id="update-post">

        <div class="container">


            <h1>Modifier un article</h1>
            <form action="" method="POST">
                <div class="title">
                    <label for="title" class="form-label">Titre </label>
                    <input type=text class="form-control" id="title" name="title"
                        value="<?php echo $post->getTitle(); ?>" required>
                </div>
                <div class="chapo">
                    <label for="chapo" class="form-label">Chapo</label>
                    <textarea class="form-control" id="chapo" name="chapo"
                        required><?php echo $post->getChapo(); ?></textarea>
                </div>
                <div class="content">
                    <label for="content" class="form-label">Contenu de l'article</label>
                    <textarea class="form-control" id="content" name="content" rows=5
                        required><?php echo $post->getContent(); ?></textarea><br>
                </div>
                <div class="author">
                <label for="author" class="form-label">Ecrit par</label>
                    <textarea class="form-control" id="author" name="author"
                        required><?php echo $post->getAuthor(); ?></textarea><br>
                </div>
                <div class="picture">
                    <label for="picture" class="form-label">Image</label>
                    <input type="file" class="form-control" id="picture" name="picture" value=<?php echo $post->getPicture(); ?>>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </section>

    <div class="post-options">
        <a href="index.php?objet=post&action=delete&role=admin&id=<?php echo $post->getId(); ?>">Supprimer l'article</a>
    </div>
</body>

<?php $content = ob_get_clean();

// Inclure le fichier layout.php
require ('layout.php');
?>