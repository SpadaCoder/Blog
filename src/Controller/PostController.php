<?php

namespace App\Controller;

require_once (__DIR__ . '/../Entity/Post.php');

class PostController 
{
    public function display() 
    {   
        // Connexion à la base de données
        require_once (__DIR__ . '/../Database/db.php');
        
        // Requête 
        $sql = "
        SELECT post.*, user.first_name AS author
        FROM post
        JOIN user ON post.user_id = user.id
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Récupérer tous les résultats en une seule fois
        $rows = $stmt->fetchAll();
        
        // Boucler sur les résultats et hydrater les objets Post
        foreach ($rows as $row) {
            $post = new \App\Entity\Post();
            $post->setTitle($row['title']); 
            $post->setChapo($row['chapo']);
            $post->setContent($row['content']);
            $post->setAuthor($row['author']);
            $post->setModified($row['modified']);
            
        }

        // Envoyer à la vue
        include_once(__DIR__ . '/../../templates/pages/home.php');
    }

    public function add() 
    {
        // Appel du contrôleur pour ajouter un post
    }

    public function modify() 
    {
        // Appel du contrôleur pour modifier un post
    }
}