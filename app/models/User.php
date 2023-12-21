<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Class User
 */
class User
{
    /**
     * @var int|null the user's unique identifier
     */
    private $id;

    /**
     * @var string|null the user's username
     */
    private $userName;

    /**
     * @var string|null the user's email address
     */
    private $email;

    /**
     * @var string|null the hashed password of the user
     */
    private $passWord;

    /**
     * @var string|null the creation date of the user
     */
    private $createdAt;

    /**
     * Get the value of id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id.
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of userName.
     *
     * @return string|null
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName.
     *
     * @param string $userName
     */
    public function setUserName($userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email.
     *
     * @param string $email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of passWord.
     *
     * @return string|null
     */
    public function getPassWord()
    {
        return $this->passWord;
    }

    /**
     * Set the value of passWord.
     *
     * @param string $passWord
     */
    public function setPassWord($passWord): self
    {
        $this->passWord = $passWord;

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
