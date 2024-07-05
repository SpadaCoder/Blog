<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Manager\CommentManager;
use App\Controller\LoginController;


class CommentController
{

    private $commentManager; // Instance du gestionnaire de commentaires.

    private $postClean; // Tableau contenant les données nettoyées provenant de $_POST.

    private $serverClean; // Tableau contenant les données nettoyées provenant de $_SERVER.


    /**
     * Constructeur de la classe CommentController.
     * Initialise les données POST et SERVER nettoyées, ainsi que l'instance de CommentManager.
     */
    public function __construct()
    {
        // Filtrer les données POST et les stocker dans une propriété.
        $this->postClean = filter_input_array(INPUT_POST);

        // Filtrer les données SERVER et les stocker dans une propriété.
        $this->serverClean = filter_input_array(INPUT_SERVER);

        // Création d'un nouveau CommentManager.
        $this->commentManager = new CommentManager();

        // End__construct().

    }


    /**
     * Affiche les commentaires validés pour un article spécifié.
     *
     * @param int $postId Identifiant de l'article pour lequel afficher les commentaires.
     */
    public function displayComments(int $postId)
    {
        // Récupérer les commentaires validés pour l'article spécifié.
        $comments = $this->commentManager->getValidatedCommentsByPostId($postId);

        // Charger la vue et passer les commentaires à afficher.
        include __DIR__.'/../../templates/pages/comments.php';
    }


    /**
     * Affiche les commentaires en attente de modération.
     * Traite également les actions de modération des commentaires.
     */
    public function displayCommentsToApprove()
    {
        // Récupérer les commentaires en attente de modération.
        $commentsToApprove = $this->commentManager->getCommentsToApprove();

        // Charger la vue et passer les commentaires à valider.
        include_once __DIR__.'/../../templates/pages/dashboard.php';

        // Récupération de l'action et de l'id du commentaire pour modération.
        if (isset($this->serverClean["REQUEST_METHOD"]) && $this->serverClean["REQUEST_METHOD"] === "POST") {
            // Vérifiez si l'action et les commentaires ont été soumis.
            if (isset($this->postClean["action"]) === TRUE && isset($this->postClean["comments"])) {
                $action = $this->postClean["action"] ?? null;
                $commentsIds = $this->postClean["comments"] ?? null;

                // Vérifiez que $commentsIds est un tableau d'IDs.
                if (!is_array($commentsIds)) {
                    $commentsIds = [$commentsIds];
                }

                // Appelez la méthode CommentAction du contrôleur.
                $this->CommentAction($action, $commentsIds);

                header("Location: index.php?role=admin&action=approvecomments");

            }
        }
        exit();
    }


    /**
     * Traite une action sur les commentaires (valider, supprimer, etc.).
     *
     * @param string $action Action à effectuer sur les commentaires (valider, supprimer, etc.).
     * @param array $commentsIds Tableau d'identifiants de commentaires sur lesquels appliquer l'action.
     */
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
