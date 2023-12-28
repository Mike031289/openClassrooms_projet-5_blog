<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Class User
 *
 * Represents a user in the system.
 */
class User
{
    /**
     * @var int|null The user's unique identifier.
     */
    private ?int $id;

    /**
     * @var string|null The user's username.
     */
    private ?string $userName;

    /**
     * @var string|null The user's email address.
     */
    private ?string $email;

    /**
     * @var string|null The hashed password of the user.
     */
    private ?string $passWord;

    /**
     * @var string The creation date of the user in the format 'Y-m-d H:i:s'.
     */
    private string $createdAt;

    /**
     * Get the value of id.
     *
     * @return int|null The user's unique identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id.
     *
     * @param int $id The user's unique identifier.
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of userName.
     *
     * @return string|null The user's username.
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * Set the value of userName.
     *
     * @param string $userName The user's username.
     *
     * @return self
     */
    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of email.
     *
     * @return string|null The user's email address.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email.
     *
     * @param string $email The user's email address.
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of passWord.
     *
     * @return string|null The hashed password of the user.
     */
    public function getPassWord(): ?string
    {
        return $this->passWord;
    }

    /**
     * Set the value of passWord.
     *
     * @param string $passWord The hashed password of the user.
     *
     * @return self
     */
    public function setPassWord(string $passWord): self
    {
        $this->passWord = $passWord;

        return $this;
    }

    /**
     * Get the formatted value of createdAt.
     *
     * @return string The formatted creation date of the user in the format 'd/m/Y H:i'.
     */
    public function getCreatedAt(): string
    {
        $formattedDate = new \DateTime($this->createdAt);

        return $formattedDate->format('d/m/Y H:i');
    }

    /**
     * Set the value of createdAt.
     *
     * @param \DateTime $createdAt The creation date of the user.
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt->format('Y-m-d H:i:s');

        return $this;
    }
}
