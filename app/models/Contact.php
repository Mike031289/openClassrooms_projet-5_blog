<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Class Contact
 *
 * Represents a contact in your application.
 */
class Contact
{
    private int $id;

    /**
     * @var string|null the userName of the contact
     */
    private string $userName;

    /**
     * @var string|null the user's email address
     */
    private string $email;

    /**
     * @var string|null the contact message
     */
    private string $message;

    private string $createdAt;

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id the contact's ID
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the userName of the contact.
     */
    public function getuserName(): string
    {
        return $this->userName;
    }

    /**
     * Set the userName of the contact.
     *
     * @param string $userName the userName of the contact
     */
    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the user's email address.
     *
     * @return string|null the user's email address
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the user's email address.
     *
     * @param string|null $email the user's email address
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of message
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param string $message the contact message
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

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
