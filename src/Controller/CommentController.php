<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Manager\CommentManager;
use App\Controller\LoginController;


class CommentController
{

    private $commentManager;
    private $postClean;

    public function __construct()
    {
        // Filtrer les données POST et les stocker dans une propriété.
        $this->postClean = filter_input_array(INPUT_POST);

        // Création d'un nouveau CommentManager.
        $this->commentManager = new CommentManager();

        // end__construct().
    }

    public function displayComments($postId)
    {
        // Récupérer les commentaires validés pour l'article spécifié.
        $comments = $this->commentManager->getValidatedCommentsByPostId($postId);

        // Charger la vue et passer les commentaires à afficher.
        include __DIR__ . '/../../templates/pages/comments.php';
    }


    public function displayCommentsToApprove()
    {
        // Récupérer les commentaires en attente de modération.
        $commentsToApprove = $this->commentManager->getCommentsToApprove();

        // Charger la vue et passer les commentaires à valider.
        include_once __DIR__ . '/../../templates/pages/dashboard.php';

        // Récupération de l'action et de l'id du commentaire pour modération.
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
            // Vérifiez si l'action et les commentaires ont été soumis
            if (isset($this->postClean["action"]) && isset($this->postClean["comments"])) {
                $action = $this->postClean["action"] ?? null;
                $commentsIds = $this->postClean["comments"] ?? null;

                // Vérifiez que $commentsIds est un tableau d'IDs
                if (!is_array($commentsIds)) {
                    $commentsIds = [$commentsIds];
                }

                // Appelez la méthode CommentAction du contrôleur
                $this->CommentAction($action, $commentsIds);

                header("Location: index.php?role=admin&action=approvecomments");

            }
        }
        exit();
    }


    public function CommentAction($action, $commentsIds)
    {
        // Gestion des coches de modération des commentaires.
        switch ($action) {
            case 'valider':
                $this->commentManager->validateComments($commentsIds);
                break;
            case 'supprimer':
                $this->commentManager->deleteComments($commentsIds);
                break;
        }
    }
}
