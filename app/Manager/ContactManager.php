<?php
namespace App\Manager;

class ContactManager extends BaseManager
{

    public function __construct(object $dataSource)
    {
        parent::__construct("contact", "Contact", $dataSource);
    }
}