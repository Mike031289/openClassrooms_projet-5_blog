<?php
namespace App\Manager;

class UserManager extends BaseManager
{

    public function __construct($dataSource)
    {
        parent::__construct("user", "User", $dataSource);
    }

}
