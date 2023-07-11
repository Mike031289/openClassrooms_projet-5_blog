<?php

class Post
{
    private $_id;
    private $_title;
    private $_summary;
    private $_images;
    private $_publicationDate;
    private $_updateDate;
    private $_userId;

    public function __construct($id, $title, $summary, $images, $publicationDate, $updateDate, $userId)
    {
        $this->_id = $id;
        $this->_title = $title;
        $this->_summary = $summary;
        $this->_images = $images;
        $this->_publicationDate = $publicationDate;
        $this->_updateDate = $updateDate;
        $this->_userId = $userId;
    }

    // Getters
    public function getId()
    {
        return $this->_id;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getSummary()
    {
        return $this->_summary;
    }

    public function getImages()
    {
        return $this->_images;
    }

    public function getPublicationDate()
    {
        return $this->_publicationDate;
    }

    public function getUpdateDate()
    {
        return $this->_updateDate;
    }

    public function getUserId()
    {
        return $this->_userId;
    }
}


