<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Manager\CommentManager;

class CommentController
{
    private $commentManager;

    public function __construct()
    {
        $this->commentManager = new CommentManager();
    }


    public function displayComments($postId)
    {
        // Récupérer les commentaires validés pour l'article spécifié
        $comments = $this->commentManager->getValidatedCommentsByPostId($postId);

        // Charger la vue et passer les commentaires à afficher
        include (__DIR__ . '/../../templates/pages/comments.php');
    }

    public function displayCommentsToApprove()
    {
        $commentsToApprove = $this->commentManager->getCommentsToApprove();

        include_once (__DIR__ . '/../../templates/pages/dashboard.php');


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $action = $_POST["action"] ?? null;
            $id = $_POST["comments"] ?? null;
            if (!is_array($id)) {
                $id = [$id];
            }
            if ($action && $id) {
                $this->CommentAction($action, $id);
            }
        }
    }

    public function CommentAction($action, $id)
    {
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