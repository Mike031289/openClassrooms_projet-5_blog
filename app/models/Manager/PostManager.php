<?php
use app\Models\Post;

class PostManager extends BaseManager
{

    public function __construct($datasource)
    {
        parent::__construct("post", "Post", $datasource);
        

    }

}
