<?php
namespace App\Manager;

class AdminManager extends BaseManager
{

    public function __construct($dataSource)
    {
        parent::__construct("admin", "Admin", $dataSource);
    }

}