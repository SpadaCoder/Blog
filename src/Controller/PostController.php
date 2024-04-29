<?php

namespace App\Controller;

use App\Entity\Post;
use App\Core\Database;
use App\Manager\PostManager;
use App\Entity\Comment;
use App\Manager\CommentManager;

class PostController
{
    private $postManager;
    private $commentManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    public function displayNumber()
    {

        $posts = $this->postManager->getPost();

        // Envoyer à la vue
        include_once (__DIR__ . '/../../templates/pages/home.php');

        exit();
    }

    public function displayAll()
    {

        $posts = $this->postManager->getPostAll();

        // Envoyer à la vue
        include_once (__DIR__ . '/../../templates/pages/all_posts.php');

        exit();
    }

    public function single($postId)
    {
        $post = $this->postManager->getOneById($postId);

        // Récupérer les commentaires validés de l'article
        $comments = $this->commentManager->getValidatedCommentsByPostId($postId);

        if (isset($_POST['content']) && "" !== $_POST['content']) {
            $contentClean = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
            // Appeler la méthode addComment de CommentManager pour ajouter le commentaire à la base de données
            $this->commentManager->add($contentClean, $postId);
        }

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

            header("Location: index.php?objet=post&action=display");
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

            header("Location: index.php?objet=post&action=display&id=" . $postId);
            exit();
        }
    }

    public function delete($postId)
    {
        $this->postManager->delete($postId);

        header("Location: index.php?objet=post&action=display");
    }

    public function hydrate(Post $post, array $postClean): ?Post
    {
        // Appel de la méthode generateSlug() de la classe Post
        $slug = $post->generateSlug($postClean['title']);

        $post->setTitle($postClean['title']);
        $post->setSlug($slug);
        $post->setChapo($postClean['chapo']);
        $post->setContent($postClean['content']);
        $post->setAuthor($postClean['author']);
        $post->setPicture($postClean['picture']);

        return $post;
    }
}
