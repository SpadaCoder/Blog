<?php

namespace App\Manager;

use App\Entity\Post;
use App\Core\Database;

class PostManager
{
    private $database;
    public function __construct()
    {
        $this->database = new Database;
    }

    public function getPost(): array
    {
        // Requête 
        $sql = "
                SELECT post.*, user.first_name AS author
                FROM post
                JOIN user ON post.user_id = user.id
                ORDER BY post.id DESC
                LIMIT 3
                ";
        $stmt = $this->database->getConnection()->prepare($sql);
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

            // Retourner les posts
            return $posts;
        
    }


    public function create($post)
    {
        // Requête SQL d'insertion
        $sql = "INSERT INTO post (title, slug, chapo, content, picture, created, modified, user_id) 
                    VALUES (:title, :slug, :chapo, :content, :picture, NOW(), NOW(), 1)";
        $stmt = $this->database->getConnection()->prepare($sql);

        //Exécution de la requête avec les données du formulaire
        $stmt->execute([
            ':title' => $post->getTitle(),
            ':slug' => $post->getSlug(),
            ':chapo' => $post->getChapo(),
            ':content' => $post->getContent(),
            ':picture' => $post->getPicture(),
        ]);
    }
    public function getOneById(int $id): ?Post
    {
        // Requête pour récupérer les détails du post spécifique
        $sql = "
                      SELECT post.*, user.first_name AS author
                      FROM post
                      JOIN user ON post.user_id = user.id
                      WHERE post.id = :id
                  ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute([':id' => $id]);

        // Récupérer le résultat 
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Entity\Post");

        return $result[0];
    }

    public function update(Post $post): void
    {
        // Requête de modification
        $sql = "
  UPDATE post
  SET title = :title, slug = :slug, chapo = :chapo, content = :content, picture = :picture, modified = NOW()
  WHERE id = :id
  ";
        $stmt = $this->database->getConnection()->prepare($sql);
        //Exécution de la requête avec les données du formulaire
        $stmt->execute([
            ':title' => $post->getTitle(),
            ':slug' => $post->getSlug(),
            ':chapo' => $post->getChapo(),
            ':content' => $post->getContent(),
            ':picture' => $post->getPicture(),
            ':id' => $post->getId(),
        ]);

    }

    public function delete(int $postId): void
    {
        // Requête SQL de suppression
        $sql = "DELETE FROM post WHERE id = :id";
        $stmt = $this->database->getConnection()->prepare($sql);

        // Exécution de la requête avec l'ID de l'article à supprimer
        $stmt->execute([':id' => $postId]);
    }


}