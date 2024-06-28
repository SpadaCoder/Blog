<?php $title = "SpadaCoder - Tous les articles"; ?>
<?php ob_start(); ?>

<section id="post">
    <div class="container">
        <?php foreach ($posts as $post) {
            include __DIR__."/../posts/_info.php";
        }
        ?>
    </div>
</section>

<?php $content = ob_get_clean();

// Inclure le fichier layout.php.
require 'layout.php';
