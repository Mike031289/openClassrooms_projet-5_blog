<?php
namespace App\Manager;

/**
 * Class BaseManager
 *
 * This class provides a base manager for interacting with database tables.
 *
 * @package App\Manager
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
     * @var \PDO The database connection.
     */
    protected \PDO $_db;

    /**
     * BaseManager constructor.
     *
     * @param string $table The name of the database table.
     * @param string $object The name of the object class.
     * @param mixed $dataSource The data source for the manager.
     */
    public function __construct(string $table, string $object, mixed $dataSource)
    {
        $this->_table  = $table;
        $this->_object = $object;
        $this->_db     = DB::getInstance($dataSource);
    }

    /**
     * Retrieve a specific record from the table associated with the current class based on its identifier (ID).
     * It returns the record in the form of an object corresponding to the class of the current object.
     *
     * @param int $id The identifier of the record to retrieve.
     * @return mixed|null The retrieved object or null if not found.
     */
    public function getById(int $id): mixed
    {
        $req = $this->_db->prepare("SELECT * FROM " . $this->_table . " WHERE id = :id");
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        // $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_object);
        return $req->fetch();
    }

    /**
     * Retrieve all the rows in the table associated with the current class from the database.
     * It returns an array containing the records in the form of objects corresponding to the class of the current object.
     *
     * @return array The array of retrieved objects.
     */
    public function getAll(): array
    {
        $req = $this->_db->prepare("SELECT * FROM " . $this->_table);
        $req->execute();

        // $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_object);
        return $req->fetchAll();
    }

    /**
     * Insert a new record into the table associated with the current class using a specified object.
     *
     * @param array<string, mixed> $object An associative array containing the data to be inserted in the database.
     * @return array<string, mixed> The object after insertion.
     */
    public function create(array $object)
    {
        $columns      = array_keys($object);
        $columnString = implode(", ", $columns);

        // Create placeholders for the values
        $valuePlaceholders = ":" . implode(", :", $columns);

        $sql = "INSERT INTO " . $this->_table . " ($columnString) VALUES ($valuePlaceholders)";
        $req = $this->_db->prepare($sql);

        // Bind values to parameters
        foreach ($columns as $column) {
            $req->bindValue(":" . $column, $object[$column]);
        }

        // Execute the query after binding parameters
        $req->execute();

        // Return the object after insertion
        return $object;
    }


    /**
     * Update an existing record in the table associated with the current class using data supplied in a specified object.
     * It performs an update by using the SQL UPDATE clause and binding the values of the object's properties to the columns of the table.
     *
     * @param array $object An associative array containing the data to be updated in the database.
     */
    // public function update($object)
    // {
    //     // Implement the update logic here
    // }

    /**
     * Delete a specific record from the table associated with the current class using a specified object.
     * It performs a delete using the SQL DELETE clause with a condition based on the object's id property.
     *
     * @param mixed $object The object to delete.
     * @return bool True if the delete was successful, false otherwise.
     */
    // public function delete($object)
    // {
    //     // Implement the delete logic here
    // }
}