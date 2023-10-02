<?php
namespace App\Manager;

class CategoryManager extends BaseManager
{

    public function __construct(object $dataSource)
    {
        parent::__construct("category", "Category", $dataSource);
    }

}
