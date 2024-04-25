<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Manager\CommentManager;

class CommentController
{
    private $commentManager;

    public function __construct(CommentManager $commentManager)
    {
        $this->commentManager = $commentManager;
    }

    
    public function displayComments($postId)
    {
        // Récupérer le $postId
        // Récupérer les commentaires validés pour l'article spécifié
        $comments = $this->commentManager->getValidatedCommentsByPostId($postId);

        // Charger la vue et passer les commentaires à afficher
        include_once (__DIR__ . '/../../templates/pages/comments.php');
    }
}