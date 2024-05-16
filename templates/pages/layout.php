<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/../public/assets/styles/styles.css">
</head>



<body>
    <?php
    // Inclure le fichier header.php
    include ('header.php');
    ?>
    
    <?= $content ?>

    <?php
    // Inclure le fichier header.php
    include ('footer.php');
    ?>
</body>

</html>