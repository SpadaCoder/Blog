<?php

namespace App\Manager;

use App\Entity\Comment;
use App\Core\Database;
use App\Entity\User;

class CommentManager
{

    private $database; // La connexion à la base de données.


    /**
     * Constructeur de la classe CommentManager.
     * Initialise la connexion à la base de données.
     */
    public function __construct()
    {
        $this->database = new Database;

    }


    /**
     * Ajoute un nouveau commentaire dans la base de données.
     *
     * @param string $content Le contenu du commentaire.
     * @param int $postId L'identifiant de l'article auquel le commentaire est associé.
     * @param array $sessionClean Les données de session contenant l'utilisateur actuel.
     * @return void
     */
    public function add(string $content, int $postId, array $sessionClean): void
    {
        $userId = $sessionClean['user']['id'];
        $sql = "
            INSERT INTO comment (postId, content, userId, created, modified, moderate) 
            VALUES (:postId, :content, :userId, NOW(), NOW(), false)
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute(
            [
                ':postId' => $postId,
                ':content' => $content,
                ':userId' => $userId,
            ]
        );
    }


    /**
     * Récupère les commentaires validés pour un article spécifique.
     *
     * @param int $postId L'identifiant de l'article.
     * @return array Un tableau d'objets Comment contenant les commentaires validés.
     */
    public function getValidatedCommentsByPostId($postId): array
    {
        // Requête pour récupérer les commentaires validés d'un article spécifique.
        $sql = "SELECT * FROM comment WHERE postId = :postId AND moderate = 1";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute([':postId' => $postId]);
        $rows = $stmt->fetchAll();

        $comments = [];
        foreach ($rows as $row) {
            $comment = new Comment();
            // Hydrate l'objet Comment avec les données de la base de données.
            $comment->setId($row['id']);
            $comment->setContent($row['content']);
            $comment->setUserId($row['userId']);

            // Utilisation de la fonction utilitaire pour récupérer et associer l'utilisateur.
            $this->getUserForComment($comment);

            $comments[] = $comment;
        }

        return $comments;
    }


    /**
     * Récupère tous les commentaires en attente de modération.
     *
     * @return array Un tableau d'objets Comment contenant les commentaires à modérer.
     */
    public function getCommentsToApprove()
    {
        // Requête pour récupérer les commentaires non validés.
        $sql = "
            SELECT comment.*
            FROM comment
            WHERE moderate = 0
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute();

        // Récupérer le résultat.
        $comments = $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Entity\Comment");

        $usermanager = new UserManager();
        $postmanager = new PostManager();

        // Pour chaque commentaire, associer l'utilisateur et le post
        foreach ($comments as $comment) {
            // Utilisation de la fonction utilitaire pour récupérer et associer l'utilisateur.
            $this->getUserForComment($comment);
            $post = $postmanager->getOneById($comment->getPostId());
            $comment->setPost($post);
        }

        return $comments;
    }


    /**
     * Valide les commentaires spécifiés en modifiant leur statut à 'moderate = 1'.
     *
     * @param array $commentsIds Un tableau d'identifiants de commentaires à valider.
     * @return void
     */
    public function validateComments($commentsIds)
    {
        // Valider les commentaires en mettant moderate à 1.
        $sql = "UPDATE comment SET moderate = 1 WHERE id IN (".implode(',', $commentsIds) . ")";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute();
    }


    /**
     * Supprime les commentaires spécifiés de la base de données.
     *
     * @param array $commentsIds Un tableau d'identifiants de commentaires à supprimer.
     * @return void
     */
    public function deleteComments($commentsIds)
    {
        // Supprimer les commentaires de la table.
        $sql = "DELETE FROM comment WHERE id IN (".implode(',', $commentsIds) . ")";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute();
    }


    /**
    * Récupère l'utilisateur associé à un commentaire donné.
    *
    * @param Comment $comment Le commentaire pour lequel récupérer l'utilisateur
    * @return void
    */
    private function getUserForComment(Comment $comment)
    {
        $userManager = new UserManager(); 
        $user = $userManager->getUserById($comment->getUserId());
        
        // Associe l'utilisateur au commentaire.
        $comment->setUser($user);
    }
}
