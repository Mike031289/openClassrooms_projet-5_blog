<?php
namespace App\Models;

/**
 * Class Post
 *
 * Represents a post in your application.
 */
class Post
{
    private int $id;
    private string $title;
    private string $postPreview;
    private string $content;
    private ?string $imageUrl;
    private int $categoryId; 
    private string $authorRole;
    private string $createdAt;
    private string $updatedAt;

    /**
     * Get the ID of the post.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the ID of the post.
     *
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the title of the post.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the title of the post.
     *
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the content of the post.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the content of the post.
     *
     * @param string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get the image URL of the post.
     *
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * Set the image URL of the post.
     *
     * @param string|null $imageUrl
     * @return self
     */
    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * Get the category ID of the post.
     *
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * Set the category ID of the post.
     *
     * @param int $categoryId
     * @return self
     */
    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * Get the author ID of the post.
     *
     * @return string
     */
    public function getAuthorRole(): string
    {
        return $this->authorRole;
    }

    /**
     * Set the author ID of the post.
     *
     * @param string $authorRole
     * @return self
     */
    public function setAuthorRole(string $authorRole): self
    {
        $this->authorRole = $authorRole;
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
    public function setCreatedAt(string $createdAt): self
    {
        // Make sure that $createdAt is a string in the format "Y-m-d H:i:s".
        $dateTime = new \DateTime($createdAt);
        $this->createdAt = $dateTime->format('Y-m-d H:i:s');

        return $this;
    }

    // /**
    //  * Get the last update date and time of the post.
    //  *
    //  */
    // public function getUpdatedAt(): \DateTime
    // {
    //     return $this->updatedAt;
    // }

    // /**
    //  * Set the last update date and time of the post.
    //  *
    //  */
    // public function setUpdatedAt(\DateTime $updatedAt): self
    // {
    //     $this->updatedAt = $updatedAt;
    //     return $this;
    // }

    /**
     * Get the value of postPreview
     */
    public function getPostPreview(): string
    {
        return $this->postPreview;
    }

    /**
     * Set the value of postPreview
     */
    public function setPostPreview(string $postPreview): self
    {
        $this->postPreview = $postPreview;

        return $this;
    }
}
