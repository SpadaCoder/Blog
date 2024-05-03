<?php
// Inclure le fichier header.php
include ('header.php');
?>
<section id="post">
    <div class="container">
    <?php foreach ($posts as $post) {
            include __DIR__ . "/../posts/_info.php";
        }
        ?>
    </div>
</section>

<?php
// Inclure le fichier header.php
include ('footer.php');
?>