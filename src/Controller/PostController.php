<?php

namespace App\Controller;

require_once (__DIR__ . '/../Entity/Post.php');

class PostController {
    public function display() {
        // Appel du contrôleur pour afficher les posts
        $post = new \App\Entity\Post();
        echo $post->getTitle();
        echo $post->getChapo();
        echo $post->getContent();
        include_once(__DIR__ . '/../../templates/pages/home.php');
    }

    public function add() {
        // Appel du contrôleur pour ajouter un post
    }

    public function modify() {
        // Appel du contrôleur pour modifier un post
    }
}