<?php

namespace App\Entity;

class Post
{
    private $title = 'titre';

    private $chapo = 'chapo';

    private $slug = 'slug';

    private $content = 'content';

    private $author = 'author';

    private $created = '2024-03-01 13:38:28';

    private $modified = '2024-03-01 13:38:28';

    private $id = 'id';

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
}

