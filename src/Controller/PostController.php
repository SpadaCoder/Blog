<?php

namespace App\Controller;

use App\Entity\Post;
use App\Manager\PostManager;
use App\Entity\Comment;
use App\Manager\CommentManager;
use App\Controller\LoginController;

class PostController
{

    private $postManager; // Instance du gestionnaire de posts.

    private $commentManager; // Instance du gestionnaire de commentaires.

    private $postClean; // Tableau contenant les données nettoyées provenant de $_POST.

    private $serverClean; // Tableau contenant les données nettoyées provenant de $_SERVER.


    /**
     * Constructeur de la classe PostController.
     * Initialise les données POST et SERVER nettoyées, ainsi que les instances de PostManager et CommentManager.
     */
    public function __construct()
    {
        // Filtrer les données POST et les stocker dans une propriété.
        $this->postClean = filter_input_array(INPUT_POST);

        // Filtrer les données SERVER et les stocker dans une propriété.
        $this->serverClean = filter_input_array(INPUT_SERVER);

        // Création d'un nouveau CommentManager et PostManager.
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();

    }


    /**
     * Affiche les derniers posts.
     *
     * @param array $sessionClean Tableau nettoyé des données de session.
     */
    public function displayLastPosts(array $sessionClean)
    {

        $posts = $this->postManager->getPost();

        // Envoyer à la vue.
        include_once __DIR__ . '/../../templates/pages/home.php';

        exit();

    }


    /**
     * Affiche tous les posts.
     */
    public function displayAll()
    {

        $posts = $this->postManager->getPostAll();

        // Envoyer à la vue
        include_once __DIR__ . '/../../templates/pages/all_posts.php';

        exit();
    }


    /**
     * Affiche un post spécifique.
     *
     * @param int $postId Identifiant du post à afficher.
     * @param array $sessionClean Tableau nettoyé des données de session.
     * @throws \Exception Si le post avec l'ID spécifié n'existe pas.
     */
    public function displayPost(int $postId, array $sessionClean)
    {
        $post = $this->postManager->getOneById($postId);

        // Vérifier si le post existe.
        if ($post === null) {
            throw new \Exception("Le post avec l'ID spécifié n'existe pas.");
        }

        // Récupérer les commentaires validés de l'article.
        $comments = $this->commentManager->getValidatedCommentsByPostId($postId);

        if (!empty($this->postClean['content']) === TRUE && isset($this->postClean['content'])) {

            // Appeler la méthode addComment de CommentManager pour ajouter le commentaire à la base de données.
            $this->commentManager->add($this->postClean['content'], $postId, $sessionClean);
        }

        // Envoyer à la vue.
        include __DIR__ . '/../../templates/pages/post.php';

        exit();
    }


    /**
     * Affiche le formulaire de création de post et traite sa soumission.
     *
     * @param array $serverClean Tableau nettoyé des données du serveur.
     * @param array $sessionClean Tableau nettoyé des données de session.
     * @throws \Exception Si l'utilisateur n'est pas connecté.
     */
    public function add(array $serverClean, array $sessionClean)
    {
        // Afficher le formulaire.
        include_once __DIR__ . '/../../templates/posts/create_post.php';

        // Vérifier si le formulaire a été soumis.
        if ($serverClean["REQUEST_METHOD"] === "POST") {
            $postClean = filter_input_array(INPUT_POST);

            // Vérifier si l'utilisateur est connecté.
            if (isset($sessionClean['user']) === false) {
                throw new \Exception("L'utilisateur n'est pas connecté.");
            }

            // Récupérer l'ID et le prénom de l'utilisateur depuis la session.
            $userId = $sessionClean['user']['id'] ?? null;
          
            // Hydrater un nouvel objet Post avec les données du formulaire.
            $post = new Post();
            $this->hydrate($post, $postClean);

            // Envoyer à la BDD.
            $postId = $this->postManager->create($post, $userId);

            // Afficher le post créé.
            header("Location: index.php?objet=post&action=display&id=".$postId);

            // End if.
        }
    }


    /**
     * Met à jour un post existant.
     *
     * @param int $postId Identifiant du post à mettre à jour.
     * @param array $serverClean Tableau nettoyé des données du serveur.
     * @throws \Exception Si le post avec l'ID spécifié n'existe pas.
     */
    public function update(int $postId, array $serverClean)
    {
        $post = $this->postManager->getOneById($postId);

        // Vérifier si le post existe.
        if ($post === null) {
            $errorMessage = htmlspecialchars("Le post avec l'ID spécifié n'existe pas.");
            throw new \Exception($errorMessage);
        }

        // Vérifier si GET.
        if (isset($serverClean["REQUEST_METHOD"]) === TRUE && $serverClean["REQUEST_METHOD"] === "GET") {
            // Afficher le formulaire.
            include_once __DIR__.'/../../templates/pages/update_post.php';
        }

        // Vérifier si le formulaire a été soumis.
        if (isset($serverClean["REQUEST_METHOD"]) && $serverClean["REQUEST_METHOD"] === "POST") {
            $postClean = filter_input_array(INPUT_POST);
            // Hydrater notre objet.
            $post = $this->hydrate($post, $postClean);

            // Envoyer à la BDD.
            $this->postManager->update($post);

            header("Location: index.php?objet=post&action=display&id=".$postId);
            exit();
        }
    }


    /**
     * Supprime un post.
     *
     * @param int $postId Identifiant du post à supprimer.
     * @throws \Exception Si le post avec l'ID spécifié n'existe pas.
     */
    public function delete(int $postId)
    {
        $post = $this->postManager->getOneById($postId);

        // Vérifier si le post existe.
        if ($post === null) {
            throw new \Exception("Le post avec l'ID spécifié n'existe pas.");
        }
        // Supprimer le post.
        $this->postManager->delete($postId);

        header("Location: index.php?objet=post&action=display");
    }


    public function hydrate(Post $post, array $postClean): ?Post
    {
        // Appel de la méthode generateSlug() de la classe Post.
        $slug = $post->generateSlug($postClean['title']);

        $post->setTitle($postClean['title']);
        $post->setSlug($slug);
        $post->setChapo($postClean['chapo']);
        $post->setContent($postClean['content']);

        return $post;
    }
}
