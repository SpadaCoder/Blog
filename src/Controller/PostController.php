<?php

namespace App\Controller;

use App\Entity\Post;
use App\Core\Database;
use App\Manager\PostManager;
use App\Entity\Comment;
use App\Manager\CommentManager;
use App\Controller\LoginController;

class PostController
{

    private $postManager;

    private $commentManager;
    private $postClean;
    
    
    public function __construct()
    {
        // Filtrer les données POST et les stocker dans une propriété.
        $this->postClean = filter_input_array(INPUT_POST);

        // Création d'un nouveau CommentManager et PostManager.
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();

        // End_construct().
    }


    public function displayNumber()
    {

        $posts = $this->postManager->getPost();

        // Envoyer à la vue
        include_once __DIR__ . '/../../templates/pages/home.php';

        exit();

    }

    public function displayAll()
    {

        $posts = $this->postManager->getPostAll();

        // Envoyer à la vue
        include_once __DIR__ . '/../../templates/pages/all_posts.php';

        exit();
    }

    public function display($postId)
    {
        $post = $this->postManager->getOneById($postId);

        // Vérifier si le post existe.
        if ($post === null) {
            throw new \Exception("Le post avec l'ID $postId n'existe pas.");
        }
        // Récupérer les commentaires validés de l'article.
        $comments = $this->commentManager->getValidatedCommentsByPostId($postId);

        if (!empty($this->postClean['content']) && isset($this->postClean['content'])) {
            $contentClean = filter_input(INPUT_POST, 'content');
            // Appeler la méthode addComment de CommentManager pour ajouter le commentaire à la base de données.
            $this->commentManager->add($contentClean, $postId);
        }

        // Envoyer à la vue.
        include __DIR__ . '/../../templates/pages/post.php';

        exit();
    }


    public function add()
    {
        // Afficher le formulaire.
        include_once __DIR__ . '/../../templates/posts/create_post.php';
        
        // Vérifier si le formulaire a été soumis.
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
            $postClean = filter_input_array(INPUT_POST);
            // Hydrater un nouvel objet Post avec les données du formulaire.
            $post = new Post();
            $this->hydrate($post, $postClean);
            //Récupération de la session pour userID et first_name
            $userId = $_SESSION['userId'] ?? null;
            $firstName = $_SESSION['first_name'] ?? 'Auteur inconnu';

            // Envoyer à la BDD.
           $this->postManager->create($post);
            // Redirige vers la page qui affiche l'article
            header("Location: index.php?objet=post&action=display");
            exit();
        }
    }

    public function update($postId)
    {
        $post = $this->postManager->getOneById($postId);

        // Vérifier si le post existe.
        if ($post === null) {
            $errorMessage = htmlspecialchars("Le post avec l'ID $postId n'existe pas.");
            throw new \Exception($errorMessage);
        }

        // Vérifier si GET
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "GET") {
            // Afficher le formulaire.
            include_once __DIR__ . '/../../templates/pages/update_post.php';
        }

        // Vérifier si le formulaire a été soumis.
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
            $postClean = filter_input_array(INPUT_POST);
            //Hydrater notre objet.
            $post = $this->hydrate($post, $postClean);

            //Envoyer à la BDD.
            $this->postManager->update($post);

            header("Location: index.php?objet=post&action=display&id=" . $postId);
            exit();
        }
    }

    public function delete($postId)
    {
        $post = $this->postManager->getOneById($postId);

        // Vérifier si le post existe
        if ($post === null) {
            throw new \Exception("Le post avec l'ID $postId n'existe pas.");
        }
        //Supprimer le post
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
        $post->setPicture($postClean['picture']);
    
    // Vérifier si 'author' existe dans $postClean avant de l'hydrater
    if (isset($postClean['author'])) {
        $post->setAuthor($postClean['author']);
    }

        return $post;
    }
}
