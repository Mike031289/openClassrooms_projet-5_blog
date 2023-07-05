<?php

class Post
{
    private $id;
    private $title;
    private $summary;
    private $images;
    private $publicationDate;
    private $updateDate;
    private $userId;

    public function __construct($id, $title, $summary, $images, $publicationDate, $updateDate, $userId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->summary = $summary;
        $this->images = $images;
        $this->publicationDate = $publicationDate;
        $this->updateDate = $updateDate;
        $this->userId = $userId;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}


