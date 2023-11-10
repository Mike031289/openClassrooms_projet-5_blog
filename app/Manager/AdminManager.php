<?php
namespace App\Manager;

/**
 * Class AdminManager
 *
 * This class represents the manager for the 'admin' entity.
 *
 * @package App\Manager
 */
class AdminManager extends BaseManager
{
    /**
     * AdminManager constructor.
     *
     * @param object $dataSource The data source for the manager.
     */
    public function __construct(object $dataSource)
    {
        parent::__construct("user", "Admin", $dataSource);

    }
  
}
