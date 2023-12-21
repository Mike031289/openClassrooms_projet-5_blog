<?php

declare(strict_types=1);

namespace App\Models;

class Comment
{
    private int $id;
    private string $content;
    private string $authorName;
    private int $postId;
    private string $createdAt;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     */
    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of authorName
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set the value of authorName
     */
    public function setAuthorName($authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * Get the value of postId
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId
     */
    public function setPostId($postId): self
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get the formatted value of createdAt
     */
    public function getCreatedAt(): string
    {
        $formattedDate = new \DateTime($this->createdAt);

        return $formattedDate->format('d/m/Y H:i');
    }

    /**
     * Set the value of createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt->format('Y-m-d H:i:s');

        return $this;
    }
}
