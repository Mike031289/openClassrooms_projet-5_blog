<?php
namespace App\Models;

/**
 * Class User
 * @package App\Models
 */
class User
{

    /**
     * @var int|null The user's unique identifier.
     */
    private $id;

    /**
     * @var string|null The user's username.
     */
    private $userName;

    /**
     * @var string|null The user's email address.
     */
    private $email;

    /**
     * @var string|null The hashed password of the user.
     */
    private $passWord;

    /**
     * @var string|null The creation date of the user.
     */
    private $createdAt;
    
    /**
     * Get the value of id.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id.
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
     * @return self
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
     * @return self
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
     * @return self
     */
    public function setPassWord($passWord): self
    {
        $this->passWord = $passWord;
        return $this;
    }

    /**
     * Get the value of createdAt.
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt.
     *
     * @param string $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

}
