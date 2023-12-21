<?php

declare(strict_types=1);

namespace App\Manager;

/**
 * Class AdminManager
 *
 * This class represents the manager for the 'admin' entity.
 */
class AdminManager extends BaseManager
{
    /**
     * AdminManager constructor.
     *
     * @param object $dataSource the data source for the manager
     */
    public function __construct(object $dataSource)
    {
        parent::__construct('user', 'Admin', $dataSource);
    }
}
