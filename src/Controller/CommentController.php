<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Manager\CommentManager;
use App\Controller\LoginController;


class CommentController
{

    private $commentManager;


    public function __construct()
    {
        // Création d'un nouveau CommentManager.
        $this->commentManager = new CommentManager();

        // end__construct().
    }

    public function displayComments($postId)
    {
        // Récupérer les commentaires validés pour l'article spécifié.
        $comments = $this->commentManager->getValidatedCommentsByPostId($postId);

        // Charger la vue et passer les commentaires à afficher.
        include __DIR__.'/../../templates/pages/comments.php';
    }


    public function displayCommentsToApprove()
    {
        // Récupérer les commentaires en attente de modération.
        $commentsToApprove = $this->commentManager->getCommentsToApprove();

        // Charger la vue et passer les commentaires à valider.
        include_once __DIR__.'/../../templates/pages/dashboard.php';

        // Récupération de l'action et de l'id du commentaire pour modération.
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
            $action = [$_POST["action"] ?? null];
            $id = [$_POST["comments"] ?? null];
            if (is_array($id) === FALSE) {
                $id = [$id];
            }

            if ($action === TRUE && $id === TRUE) {
                $this->CommentAction($action, $id);
            }
        }
        exit();
    }


    public function CommentAction($action, $id)
    {
        // Gestion des coches de modération des commentaires.
        switch ($action) {
            case 'valider':
                $this->commentManager->validateComments($id);
                break;
            case 'supprimer':
                $this->commentManager->deleteComments($id);
                break;
        }
    }
}
