<?php

namespace App\Entity;

class Post
{

    private $title; // Le titre de l'article.

    private $chapo; // Le chapô de l'article.

    private $slug; // Le slug de l'article, utilisé pour les URLs conviviales.

    private $content; // Le contenu principal de l'article.

    private $userId; // L'identifiant de l'utilisateur ayant créé l'article.

    private $modified; // La date de dernière modification de l'article.

    private $id; // L'identifiant de l'article.

    private ?User $user = null; // Objet User.

    private ?Comment $comment = null; // Objet Comment.


    /**
     * Met à jour la date de dernière modification de l'article.
     */
    public function updateModified()
    {
        $this->modified = date('Y-m-d H:i:s');
    }


    /**
     * Obtient le titre de l'article.
     *
     * @return string Le titre de l'article.
     */
    public function getTitle(): string
    {
        return $this->title;
    }


    /**
     * Définit le titre de l'article.
     *
     * @param string $title Le titre de l'article.
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    /**
     * Obtient le chapô de l'article.
     *
     * @return string Le chapô de l'article.
     */
    public function getChapo(): string
    {
        return $this->chapo;
    }

    /**
     * Définit le chapô de l'article.
     *
     * @param string $chapo Le chapô de l'article.
     * @return self
     */
    public function setChapo(string $chapo): self
    {
        $this->chapo = $chapo;

        return $this;
    }


    /**
     * Obtient le slug de l'article.
     *
     * @return string Le slug de l'article.
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Définit le slug de l'article.
     *
     * @param string $slug Le slug de l'article.
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Obtient le contenu principal de l'article.
     *
     * @return string Le contenu principal de l'article.
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Définit le contenu principal de l'article.
     *
     * @param string $content Le contenu principal de l'article.
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }


    /**
     * Obtient l'identifiant de l'utilisateur ayant créé l'article.
     *
     * @return string L'identifiant de l'utilisateur.
     */
    public function getUserId(): string
    {
        return $this->userId;
    }


    /**
     * Définit l'identifiant de l'utilisateur ayant créé l'article.
     *
     * @param string $userId L'identifiant de l'utilisateur.
     * @return self
     */
    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }


    /**
     * Obtient la date de dernière modification de l'article.
     *
     * @return string La date de dernière modification.
     */
    public function getModified(): string
    {
        return $this->modified;
    }


    /**
     * Définit la date de dernière modification de l'article.
     *
     * @param string $modified La date de dernière modification.
     * @return self
     */
    public function setModified(string $modified): self
    {
        $this->modified = $modified;

        return $this;
    }


    /**
     * Obtient l'identifiant de l'article.
     *
     * @return string L'identifiant de l'article.
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * Définit l'identifiant de l'article.
     *
     * @param string $id L'identifiant de l'article.
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Récupère l'utilisateur associé à ce commentaire.
     *
     * @return User|null
     */
    public function getUser() 
    {
        return $this->user;
    }


    /**
     * Définit l'utilisateur associé à ce commentaire.
     *
     * @param User|null $user L'utilisateur à définir
     * @return self
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


    /**
     * Récupère le commentaire associé à ce post.
     *
     * @return Comment|null
     */
    public function getComment() 
    {
        return $this->comment;
    }


    /**
     * Définit le commentaire asscoié à ce post.
     *
     * @param Comment|null $post L'article à définir
     * @return self
     */
    public function setComment(?Comment $comment): self
    {
        $this->comment = $comment;

        return $this;
    }


    /**
     * Génère un slug à partir du titre de l'article.
     *
     * @param string $title Le titre de l'article.
     * @return string Le slug généré.
     */
    public function generateSlug($title)
    {
        // Convertir le titre en minuscules.
        $slug = mb_strtolower($title);

        // Convertir les caractères accentués en caractères non accentués.
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);

        // Supprimer les apostrophes
        $slug = str_replace(["'", '`'], '', $slug);
        
        // Remplacer les caractères spéciaux par des tirets.
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);

        // Supprimer les tirets en double.
        $slug = preg_replace('/-+/', '-', $slug);

        // Supprimer les tirets au début et à la fin.
        $slug = trim($slug, '-');

        return $slug;
    }
}
