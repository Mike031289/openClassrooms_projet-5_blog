<?php

namespace App\Models;

/**
 * Class Comment
 *
 * Represents a comment entity.
 */
class Comment
{
    /** @var int The unique identifier for the comment. */
    private int $id;

    /** @var string The content of the comment. */
    private string $content;

    /** @var string The name of the author of the comment. */
    private string $authorName;

    /** @var int The ID of the post associated with the comment. */
    private int $postId;

    /** @var string The creation date and time of the comment. */
    private string $createdAt;

    /**
     * Get the value of id.
     *
     * @return int The comment ID.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id.
     *
     * @param int $id The comment ID.
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of content.
     *
     * @return string The content of the comment.
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content.
     *
     * @param string $content The content of the comment.
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get the value of authorName.
     *
     * @return string The name of the author of the comment.
     */
    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    /**
     * Set the value of authorName.
     *
     * @param string $authorName The name of the author of the comment.
     *
     * @return self
     */
    public function setAuthorName(string $authorName): self
    {
        $this->authorName = $authorName;
        return $this;
    }

    /**
     * Get the value of postId.
     *
     * @return int The ID of the post associated with the comment.
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * Set the value of postId.
     *
     * @param int $postId The ID of the post associated with the comment.
     *
     * @return self
     */
    public function setPostId(int $postId): self
    {
        $this->postId = $postId;
        return $this;
    }

    /**
     * Get the formatted value of createdAt.
     *
     * @return string The formatted creation date and time of the comment.
     */
    public function getCreatedAt(): string
    {
        $formattedDate = new \DateTime($this->createdAt);

        return $formattedDate->format('d/m/Y H:i');
    }

    /**
     * Set the value of createdAt.
     *
     * @param \DateTime $createdAt The creation date and time of the comment.
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt->format('Y-m-d H:i:s');

        return $this;
    }
}
