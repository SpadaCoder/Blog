<?php

namespace App\Manager;

use App\Entity\Comment;
use App\Core\Database;

class CommentManager
{
private $database;
    public function __construct()
    {
        $this->database = new Database;
    }

    public function add(array $post, int $postId): void
    {
        //Nettoyer $post
        $postClean = $post;
        $userId = 1; // TO DO reprendre de la session
        $sql = "
            INSERT INTO comment (post_id, content, user_id, created, modified, moderate) 
            VALUES (:post_id, :content, :user_id, NOW(), NOW(), false)
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute([
            ':post_id' => $postId,
            ':content' => $postClean['content'],
            ':user_id' => $userId,
        ]);
    }

    public function getValidatedCommentsByPostId($postId): array
    {
        // Requête pour récupérer les commentaires validés d'un article spécifique
        $sql = "SELECT * FROM comment WHERE post_id = :post_id AND moderate = 1";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute([':post_id' => $postId]);
        $rows = $stmt->fetchAll();

        $comments = [];
        foreach ($rows as $row) {
            $comment = new Comment();
            // Hydrate l'objet Comment avec les données de la base de données
            $comment->setId($row['id']);
            $comment->setContent($row['content']);
            $comment->setUserId($row['userId']);

            $comments[] = $comment;
        }

        return $comments;
    }
}

