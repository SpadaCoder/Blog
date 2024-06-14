<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/../public/assets/styles/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">

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