<?php

namespace App\Entity;

class Comment
{
    private $created;

    private $modified;

    private $id;

    private $userId;

    private $content;

    private $postId;

    private $moderate;

    public function getUserId(): string
    {
        return $this->userId;
    }
    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
    public function getPostId(): string
    {
        return $this->postId;
    }
    public function setPostId(string $postId): self
    {
        $this->postId = $postId;

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

    public function getCreated(): string
    {
        return $this->created;
    }
    public function setCreated(string $created): self
    {
        $this->created = $created;

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
    public function getModerate(string $moderate): self
    {
        $this->moderate = $moderate;

        return $this;
    }

    public function setModerate(string $moderate): self
    {
        $this->moderate = $moderate;

        return $this;
    }
}