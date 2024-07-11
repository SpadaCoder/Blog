<?php

namespace App\Entity;

class Comment
{

    private $created; // Date de création du commentaire au format datetime.

    private $modified; // Date de dernière modification du commentaire au format datetime. *

    private $id; // Identifiant du commentaire.

    private $userId; // Identifiant de l'utilisateur ayant créé le commentaire.

    private $content; // Contenu textuel du commentaire.

    private $postId; // Identifiant du post auquel le commentaire est associé.

    private $moderate; // Statut de modération du commentaire.

    private ?User $user = null; // Objet User.

    private ?Post $post = null; // Objet Post.


    /**
     * Obtient l'identifiant de l'utilisateur ayant créé le commentaire.
     *
     * @return int Identifiant de l'utilisateur.
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    
    /**
     * Définit l'identifiant de l'utilisateur ayant créé le commentaire.
     *
     * @param int $userId Identifiant de l'utilisateur.
     * @return self
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }


    /**
     * Obtient l'identifiant du post auquel le commentaire est associé.
     *
     * @return string Identifiant du post.
     */
    public function getPostId(): string
    {
        return $this->postId;
    }


    /**
     * Définit l'identifiant du post auquel le commentaire est associé.
     *
     * @param string $postId Identifiant du post.
     * @return self
     */
    public function setPostId(string $postId): self
    {
        $this->postId = $postId;

        return $this;
    }


    /**
     * Obtient le contenu textuel du commentaire.
     *
     * @return string Contenu textuel du commentaire.
     */
    public function getContent(): string
    {
        return $this->content;
    }


    /**
     * Définit le contenu textuel du commentaire.
     *
     * @param string $content Contenu textuel du commentaire.
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }


    /**
     * Obtient la date de création du commentaire.
     *
     * @return string Date de création du commentaire.
     */
    public function getCreated(): string
    {
        return $this->created;
    }


    /**
     * Définit la date de création du commentaire.
     *
     * @param string $created Date de création du commentaire.
     * @return self
     */
    public function setCreated(string $created): self
    {
        $this->created = $created;

        return $this;
    }


    /**
    * Obtient la date de dernière modification du commentaire.
    *
    * @return string Date de dernière modification du commentaire.
    */
    public function getModified(): string
    {
        return $this->modified;
    }
    

    /**
     * Définit la date de dernière modification du commentaire.
     *
     * @param string $modified Date de dernière modification du commentaire.
     * @return self
     */
    public function setModified(string $modified): self
    {
        $this->modified = $modified;

        return $this;
    }


    /**
     * Obtient l'identifiant du commentaire.
     *
     * @return int Identifiant du commentaire.
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * Définit l'identifiant du commentaire.
     *
     * @param int $id Identifiant du commentaire.
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Obtient le statut de modération du commentaire.
     *
     * @return string Statut de modération du commentaire.
     */
    public function getModerate(string $moderate): self
    {
        $this->moderate = $moderate;

        return $this;
    }


    /**
     * Définit le statut de modération du commentaire.
     *
     * @param string $moderate Statut de modération du commentaire.
     * @return self
     */
    public function setModerate(string $moderate): self
    {
        $this->moderate = $moderate;

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
     * Récupère l'article associé à ce commentaire.
     *
     * @return Post|null
     */
    public function getPost() 
    {
        return $this->post;
    }


    /**
     * Définit l'article associé à ce commentaire.
     *
     * @param Post|null $post L'article à définir
     * @return self
     */
    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }
}
