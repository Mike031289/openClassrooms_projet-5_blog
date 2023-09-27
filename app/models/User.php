<?php
namespace App\Models;

class User
{
    const PASSWORD_FORMAT = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/';
    const EMAIL_FORMAT = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    const NAME_FORMAT = '/^[a-zA-Z0-9_-]{3,20}$/';
    private $id;
    private $userName;
    private $email;
    private $passWord;
    private $createdAt; 


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
     * Get the value of userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     */
    public function setUserName($userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of passWord
     */
    public function getPassWord() 
    {
        return $this->passWord;
    }

    /**
     * Set the value of passWord
     */
    public function setPassWord($passWord): self
    {
        $this->passWord = $passWord;

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     */
    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}