<?php

namespace App\Controller;

use App\Entity\Post;
use App\Core\Database;
use App\Manager\PostManager;

class PostController
{
    private $postManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
    }

    public function display()
    {

       $posts =  $this->postManager->getPost();

        // Envoyer à la vue
        include_once (__DIR__ . '/../../templates/pages/home.php');
    }

    public function single($postId)
    {
        $post = $this->postManager->getOneById($postId);

        // Envoyer à la vue
        include_once (__DIR__ . '/../../templates/pages/post.php');

        exit();
    }


    public function add()
    {
        // Afficher le formulaire
        include_once (__DIR__ . '/../../templates/pages/create_post.php');

        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $postClean = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Hydrater un nouvel objet Post avec les données du formulaire
            $post = new Post();
            $this->hydrate($post, $postClean);
            //Envoyer à la BDD
            $this->postManager->create($post);

            header("Location: http://localhost/public/index.php?objet=post&action=display");
            exit();
        }
    }

    public function update($postId)
    {
        $post = $this->postManager->getOneById($postId);
        // Vérifier si GET
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Afficher le formulaire
            include_once (__DIR__ . '/../../templates/pages/update_post.php');
        }

        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Récupérer les données utilisateur
            //Nettoyer les données
            $postClean = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //Hydrater notre objet
            $post = $this->hydrate($post, $postClean);

            //Envoyer à la BDD
            $this->postManager->update($post);

            header("Location: http://localhost/public/index.php?objet=post&action=display&id=" . $postId); //mettre lien index et enlever localhost
            exit();
        }
    }

    public function delete($postId)
    {
        $this->postManager->delete($postId);
    }

    public function hydrate(Post $post, array $postClean): ?Post
    {
        // Appel de la méthode generateSlug() de la classe Post
        $slug = $post->generateSlug($postClean['title']);

        $post->setTitle($postClean['title']);
        $post->setSlug($slug);
        $post->setChapo($postClean['chapo']);
        $post->setContent($postClean['content']);
        $post->setPicture($postClean['picture']);

        return $post;
    }
}
