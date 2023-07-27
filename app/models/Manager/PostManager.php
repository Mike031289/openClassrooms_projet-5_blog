<?php
use app\Models\Post;

class PostManager extends BaseManager
{

    public function __construct($dataSource)
    {
        parent::__construct("post", "Post", $dataSource);
        

    }

}
