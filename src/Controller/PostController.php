<?php

namespace App\Controller;

use App\Entity\Post;
use App\Core\Database;


class PostController 
{
    public function display() 
    {   
            // Connexion à la base de données
            $database = new Database();

        // Requête 
        $sql = "
        SELECT post.*, user.first_name AS author
        FROM post
        JOIN user ON post.user_id = user.id
        ORDER BY post.id DESC
        LIMIT 3
        ";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->execute();

        // Récupérer tous les résultats en une seule fois
        $rows = $stmt->fetchAll();

        // Créer un tableau pour stocker les objets Post
        $posts = [];

        // Boucler sur les résultats et hydrater les objets Post
        foreach ($rows as $row) {
            $post = new Post();
            $post->setTitle($row['title']); 
            $post->setChapo($row['chapo']);
            $post->setContent($row['content']);
            $post->setAuthor($row['author']);
            $post->setModified($row['modified']);
            $post->setId($row['id']);

        // Ajouter le post au tableau
        $posts[] = $post;

        }
                // Envoyer à la vue
                include_once(__DIR__ . '/../../templates/pages/home.php');
            }

    public function single($postId) 
            {   
                // Connexion à la base de données
                $database = new Database();
        
                // Requête pour récupérer les détails du post spécifique
                $sql = "
                    SELECT post.*, user.first_name AS author
                    FROM post
                    JOIN user ON post.user_id = user.id
                    WHERE post.id = :post_id
                ";
                $stmt = $database->getConnection()->prepare($sql);
                $stmt->execute([':post_id' => $postId]);
        
                // Récupérer le résultat (un seul post)
                $result = $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Entity\Post");
                $post = $result[0];
        
                // Envoyer à la vue
                include_once (__DIR__ . '/../../templates/pages/post.php');

                exit();
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