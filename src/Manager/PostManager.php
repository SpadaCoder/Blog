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
            SELECT post.*
            FROM post
            ORDER BY post.id DESC
            LIMIT 3
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute();

        // Récupérer tous les résultats en une seule fois
        $rows = $stmt->fetchAll();

        return $this->hydratePost($rows);

    }

    public function getPostAll(): array
    {
        // Requête 
        $sql = "
            SELECT post.*
            FROM post
            ORDER BY post.id DESC
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $this->hydratePost($rows);

    }

    public function create($post)
    {
        // Récupérer l'ID et le prénom de l'utilisateur depuis la session
        if (!isset($_SESSION['user'])) {
            throw new \Exception("L'utilisateur n'est pas connecté."); // Gérer le cas où l'utilisateur n'est pas connecté
        }
        $userId = $_SESSION['user']['id'];
        $author = $_SESSION['user']['first_name'];

        // Requête SQL d'insertion
        $sql = "
            INSERT INTO post (title, slug, chapo, content, picture, created, modified, user_id,  author) 
            VALUES (:title, :slug, :chapo, :content, :picture, NOW(), NOW(), :user_id, :author)
        ";
        $stmt = $this->database->getConnection()->prepare($sql);

        //Exécution de la requête avec les données du formulaire
        $stmt->execute([
            ':title' => $post->getTitle(),
            ':slug' => $post->getSlug(),
            ':chapo' => $post->getChapo(),
            ':content' => $post->getContent(),
            ':picture' => $post->getPicture(),
            ':user_id' => $userId,
            ':author' => $author,
        ]);
    }

    public function getOneById(int $id): ?Post
    {
        // Requête pour récupérer les détails du post spécifique
        $sql = "
            SELECT post.*
            FROM post
            WHERE post.id = :id
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute([':id' => $id]);

        // Récupérer le résultat 
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Entity\Post");

        // Vérifier si un post a été trouvé
        if (count($result) === 0) {
            return null;
        }

        return $result[0];
    }

    public function update(Post $post): void
    {

        // Requête de modification
        $sql = "
            UPDATE post
            SET title = :title, slug = :slug, chapo = :chapo, content = :content, author = :author, picture = :picture, modified = NOW()
            WHERE id = :id
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        //Exécution de la requête avec les données du formulaire
        $stmt->execute([
            ':title' => $post->getTitle(),
            ':slug' => $post->getSlug(),
            ':chapo' => $post->getChapo(),
            ':content' => $post->getContent(),
            ':author' => $post->getAuthor(),
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

    private function hydratePost(array $rows): array
    {
        $posts = [];

        foreach ($rows as $row) {
            $post = new Post();
            $post->setTitle($row['title']);
            $post->setChapo($row['chapo']);
            $post->setContent($row['content']);
            $post->setAuthor($row['author']);
            $post->setModified($row['modified']);
            $post->setId($row['id']);

            $posts[] = $post;
        }

        return $posts;
    }

}