<?php 
$nom = "Spadacini";

// si objet = post 
if ('post' === $_GET['objet']) {
    // si action = display
    if ('display' === $_GET['action'])
        //Appel controleur affiche post
        echo 'OK';
    // si action = add
    if ('add' === $_GET['action']) {
        // Appel controleur ajout post
        echo 'OK';
    }
    // si action = modify
    if ('modify' === $_GET['action']) {
        // Appel controleur modifier post
        echo 'OK';
    }
}


echo "Sandra";
echo "<pre>";
print_r($_SERVER);
print_r($_GET);
var_dump($_SERVER);
echo "</pre>";
echo $nom . '$nom' . "$nom";


require_once(__DIR__ . '/../src/Entity/Post.php');
$post = new Post();

echo "<pre>";
print_r($post);
echo "</pre>";
$post->setTitle('Test');

echo "<pre>";
print_r($post);
echo "</pre>";
echo $post->getTitle();
echo $post->getChapo();
include_once(__DIR__ . '/../templates/pages/home.php');


require_once(__DIR__ . '/../data.php' );

try
{
    $mysqlClient = new PDO('mysql:host=' . $dbServer . ';dbname=' . $dbBase . ';charset=utf8', $dbUser, $dbPassword);
    var_dump($mysqlClient);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
