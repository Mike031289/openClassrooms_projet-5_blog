<?php
<<<<<<< HEAD

declare(strict_types=1);

=======
>>>>>>> debug-branch
namespace App\Manager;

/**
 * Class BaseManager
 *
 * This class provides a base manager for interacting with database tables.
 */
class BaseManager
{
    /**
     * The name of the database table associated with this manager.
     */
    private string $_table;

    /**
     * The name of the object class associated with this manager.
     */
    private string $_object;

    /**
     * @var \PDO the database connection
     */
    protected \PDO $_db;

    /**
     * BaseManager constructor.
     *
     * @param string $table      the name of the database table
     * @param string $object     the name of the object class
     * @param mixed  $dataSource the data source for the manager
     */
    public function __construct(string $table, string $object, mixed $dataSource)
    {
        $this->_table = $table;
        $this->_object = $object;
        $this->_db = DB::getInstance($dataSource);
    }

    /**
     * Retrieve a specific record from the table associated with the current class based on its identifier (ID).
     * It returns the record in the form of an object corresponding to the class of the current object.
     *
     * @param  int        $id the identifier of the record to retrieve
     * @return mixed|null the retrieved object or null if not found
     */
    public function getById(int $id): object
    {
<<<<<<< HEAD
        $req = $this->_db->prepare('SELECT * FROM '.$this->_table.' WHERE id = :id');
=======
        $req = $this->_db->prepare("SELECT * FROM {$this->_table} WHERE id = :id");
>>>>>>> debug-branch
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_object);
<<<<<<< HEAD

        return $req->fetchAll();
=======
        return $req->fetch();
>>>>>>> debug-branch
    }

    /**
     * Retrieve all the rows in the table associated with the current class from the database.
     * It returns an array containing the records in the form of objects corresponding to the class of the current object.
     *
     * @return array the array of retrieved objects
     */
    public function getAll(): array
    {
<<<<<<< HEAD
        $req = $this->_db->prepare('SELECT * FROM '.$this->_table);
=======
        $req = $this->_db->prepare("SELECT * FROM {$this->_table}");
>>>>>>> debug-branch
        $req->execute();

        // Utiliser FETCH_OBJ pour obtenir des objets anonymes
        return $req->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Insert a new record into the table associated with the current class using a specified object.
     *
     * @param  array<string, mixed> $object an associative array containing the data to be inserted in the database
     * @return array<string, mixed> the object after insertion
     */
    public function create(array $object)
    {
        $columns = array_keys($object);
        $columnString = implode(', ', $columns);

        // Create placeholders for the values
        $valuePlaceholders = ':'.implode(', :', $columns);

        $sql = 'INSERT INTO '.$this->_table." ($columnString) VALUES ($valuePlaceholders)";
        $req = $this->_db->prepare($sql);

        // Bind values to parameters
        foreach ($columns as $column) {
            $req->bindValue(':'.$column, $object[$column]);
        }

        // Execute the query after binding parameters
        $req->execute();

        // Return the object after insertion
        return $object;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> debug-branch
