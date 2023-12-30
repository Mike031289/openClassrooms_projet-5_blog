<?php

declare(strict_types=1);

namespace App\Manager;

/**
 * Database management class.
 */
class DB
{
    /**
     * @var \PDO Instance of PDO representing the database connection.
     */
    private \PDO $_db;

    /**
     * @var DB Singleton instance of the DB class.
     */
    private static DB $_instance;

    /**
     * Database constructor.
     *
     * @param object $dataSource An object containing the properties dbname (string), host (string), user (string), and password (string).
     */
    private function __construct(object $dataSource)
    {
        $this->_db = new \PDO('mysql:dbname=' . $dataSource->dbname . ';host=' . $dataSource->host, $dataSource->user, $dataSource->password);
    }

    /**
     * Get the singleton instance of the DB class.
     *
     * @param object $dataSource An object containing the properties dbname (string), host (string), user (string), and password (string).
     *
     * @return \PDO The PDO instance representing the database connection.
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
     * @return \PDO The PDO instance.
     */
    public function getDb(): \PDO
    {
        return $this->_db;
    }
}
