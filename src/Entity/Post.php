<?php

namespace App\Entity;

class Post
{
    private $title;

    private $chapo;

    private $slug;

    private $content;

    private $author;

    private $userId;

    private $picture;

    private $created;

    private $modified;

    private $id;

    // Méthode : MAJ date de modification
    public function updateModified()
    {
        $this->modified = date('Y-m-d H:i:s');
    }


    // Méthode : getter et setter
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getChapo(): string
    {
        return $this->chapo;
    }

    public function setChapo(string $chapo): self
    {
        $this->chapo = $chapo;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }
    public function getUserId(): string
    {
        return $this->userId;
    }
    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
    public function getPicture(): string
    {
        return $this->picture;
    }
    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getModified(): string
    {
        return $this->modified;
    }
    public function setModified(string $modified): self
    {
        $this->modified = $modified;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function generateSlug($title)
    {
        // Convertir le titre en minuscules
        $slug = mb_strtolower($title);
        // Convertir les caractères accentués en caractères non accentués
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
        // Supprimer les apostrophes
        $slug = str_replace(["'", '`'], '', $slug);
        // Remplacer les caractères spéciaux par des tirets
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        
        // Supprimer les tirets en double
        $slug = preg_replace('/-+/', '-', $slug);

        // Supprimer les tirets au début et à la fin
        $slug = trim($slug, '-');

        return $slug;
    }
}

