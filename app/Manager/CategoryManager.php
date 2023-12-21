<?php

declare(strict_types=1);

namespace App\Manager;

class CategoryManager extends BaseManager
{
    public function __construct(object $dataSource)
    {
        parent::__construct('category', 'Category', $dataSource);
    }
}
