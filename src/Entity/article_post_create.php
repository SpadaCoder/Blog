<?php
// Connexion à la base de donnée
require_once(__DIR__ . '/../data.php' );

// Fonction de filtrage et validation des données
function filterInput($data) {
    if (is_array($data)) {
        return array_map('filterInput', $data);
    } else {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }
}

// Récupération et sécurisation des données du formulaire
$filteredData = filterInput($_POST);


// Date de création par défaut date du jour
$created = date ('Y-m-d');

// Insertion des données dans la base
$insertPost = $mysqlClient->prepare('INSERT INTO post (title, slug, chapo, content, picture, created) VALUES (:title, :slug, :chapo, :content, :picture, :created)');
$insertPost = execute(array(
    ':title' => $filteredData['title'],
    ':slug' => $filteredData['slug'],
    ':chapo' => $filteredData['chapo'],
    ':content' => $filteredData['content'],
    ':picture' => $filteredData['picture'],
    ':created' => $created,
))

?>