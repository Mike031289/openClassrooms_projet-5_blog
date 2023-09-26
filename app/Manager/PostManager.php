<?php
namespace App\Manager;

class PostManager extends BaseManager
{

    public function __construct(object $dataSource)
    {
        parent::__construct("post", "Post", $dataSource);
    }

}
