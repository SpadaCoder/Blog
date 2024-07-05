<?php

namespace App\Manager;

use App\Entity\Post;
use App\Entity\User;

use App\Core\Database;

class PostManager
{

    private $database; // La connexion à la base de données.


     /**
     * Constructeur de la classe PostManager.
     * Initialise la connexion à la base de données.
     */
    public function __construct()
    {
        $this->database = new Database;

    }


    /**
     * Récupère les 3 derniers posts.
     *
     * @return array Un tableau d'objets Post représentant les 3 derniers posts.
     */
    public function getPost(): array
    {
        // Requête récupère les 3 derniers posts.
        $sql = "
            SELECT post.*
            FROM post
            ORDER BY post.id DESC
            LIMIT 3
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute();

        // Récupérer tous les résultats en une seule fois.
        $rows = $stmt->fetchAll();

        return $this->hydratePost($rows);

    }


    /**
     * Récupère tous les posts.
     *
     * @return array Un tableau d'objets Post représentant tous les posts.
     */
    public function getPostAll(): array
    {
        // Requête récupérer tous les posts.
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


    /**
     * Crée un nouveau post dans la base de données.
     *
     * @param Post $post L'objet Post à insérer.
     * @param int $userId L'identifiant de l'utilisateur créant le post.
     * @param string $author L'auteur du post.
     * @return int L'identifiant (ID) du post inséré.
     */
    public function create(Post $post, $userId, $author)
    {
        // Requête SQL d'insertion d'un nouveau post.
        $sql = "
            INSERT INTO post (title, slug, chapo, content, created, modified, user_id,  author) 
            VALUES (:title, :slug, :chapo, :content, NOW(), NOW(), :user_id, :author)
        ";
        $stmt = $this->database->getConnection()->prepare($sql);

        //Exécution de la requête avec les données du formulaire.
        $stmt->execute(
            [
                ':title' => $post->getTitle(),
                ':slug' => $post->getSlug(),
                ':chapo' => $post->getChapo(),
                ':content' => $post->getContent(),
                ':user_id' => $userId,
                ':author' => $author,
            ]
        );

        // Récupérer et retourner l'ID du post inséré (en tant qu'entier).
        return (int) $this->database->getConnection()->lastInsertId();
    }


    /**
     * Récupère un post par son identifiant.
     *
     * @param int $id L'identifiant du post à récupérer.
     * @return Post|null L'objet Post correspondant à l'identifiant, ou null si non trouvé.
     */
    public function getOneById(int $id): ?Post
    {
        // Requête pour récupérer les détails du post spécifique.
        $sql = "
            SELECT post.*, user.first_name as author
            FROM post
            LEFT JOIN user ON post.user_id = user.id
            WHERE post.id = :id
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute([':id' => $id]);

        // Récupérer le résultat.
        $post = $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Entity\Post");

        // Vérifier si un post a été trouvé.
        if ($post === false) {
            return null;
        }

        return $post[0];
    }


     /**
     * Met à jour les informations d'un post dans la base de données.
     *
     * @param Post $post L'objet Post contenant les nouvelles données du post.
     * @return void
     */
    public function update(Post $post): void
    {

        // Requête de modification.
        $sql = "
            UPDATE post
            SET title = :title, slug = :slug, chapo = :chapo, content = :content, author = :author, modified = NOW()
            WHERE id = :id
        ";
        $stmt = $this->database->getConnection()->prepare($sql);

        // Exécution de la requête avec les données du formulaire.
        $stmt->execute(
            [
                ':title' => $post->getTitle(),
                ':slug' => $post->getSlug(),
                ':chapo' => $post->getChapo(),
                ':content' => $post->getContent(),
                ':author' => $post->getAuthor(),
                ':id' => $post->getId(),
            ]
        );

    }


    /**
     * Supprime un post de la base de données.
     *
     * @param int $postId L'identifiant du post à supprimer.
     * @return void
     */
    public function delete(int $postId): void
    {
        // Requête SQL de suppression.
        $sql = "DELETE FROM post WHERE id = :id";
        $stmt = $this->database->getConnection()->prepare($sql);

        // Exécution de la requête avec l'ID de l'article à supprimer.
        $stmt->execute([':id' => $postId]);
    }


    /**
     * Hydrate un tableau de résultats de requête en un tableau d'objets Post.
     *
     * @param array $rows Les lignes de résultats de la requête SQL.
     * @return array Un tableau d'objets Post hydratés avec les données de la base de données.
     */
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
