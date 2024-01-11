<?php

declare(strict_types=1);

namespace App\Manager;

use App\Exceptions\ActionNotFoundException;

/**
 * Database management class.
 */
class DB
{
    /**
     * @var \PDO $_db Instance of PDO representing the database connection.
     */
    private \PDO $_db;

    /**
     * @var DB $_instance Singleton instance of the DB class.
     */
    private static DB $_instance;

    /**
     * Database constructor.
     *
     * @param object $dataSource An object containing the properties dbname (string), host (string), user (string), and password (string).
     */
    private function __construct(object $dataSource)
    {
        // Check if the required properties exist in $dataSource
        if (!property_exists($dataSource, 'dbname') || !property_exists($dataSource, 'host') || !property_exists($dataSource, 'user') || !property_exists($dataSource, 'password')) {
            throw new ActionNotFoundException();
        }

        $this->_db = new \PDO('mysql:dbname=' . $dataSource->dbname . ';host=' . $dataSource->host, $dataSource->user, $dataSource->password);
    }

    /**
     * Get the singleton instance of the DB class.
     *
     * @param object $dataSource An object containing the properties dbname (string), host (string), user (string), and password (string).
     *
     * @return \PDO $_db The PDO instance representing the database connection.
     */
    public static function getInstance(object $dataSource): \PDO
    {
        if (empty(self::$_instance)) {
            self::$_instance = new DB($dataSource);
        }

        return self::$_instance->_db;
    }

    /**
     * Get the PDO instance representing the database connection.
     *
     * @return \PDO $_db The PDO instance.
     */
    public function getDb(): \PDO
    {
        return $this->_db;
    }
    
}
