<?php

declare(strict_types=1);

namespace App\Manager;

use App\Exceptions\ActionNotFoundException;
use App\Models\Category;

class CategoryManager extends BaseManager
{
    public function __construct(object $dataSource)
    {
        parent::__construct('category', 'Category', $dataSource);
    }

    public function getCategoryById(int $id): ?Category
    {
        // Prepare the SQL query to retrieve a specific record by ID
        $sql = 'SELECT * FROM Category WHERE id = :id ';

        // Prepare the SQL statement
        $stmt = $this->_db->prepare($sql);

        // Bind the ID parameter
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Set the fetch mode to retrieve the result as an object of the Post class
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Category::class, []);

        // Fetch and return the object or null if not found
        return $stmt->fetchObject(Category::class) ?: null;
    }

    /**
     * Retrieve the ID of a category based on its name.
     *
     * @param  string   $categoryName the name of the category
     * @return int|null the ID of the category or null if not found
     */
    public function getCategoryIdByName(string $categoryName): ?int
    {
        try {
            $sql = 'SELECT id FROM category WHERE name = :name';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindValue(':name', $categoryName, \PDO::PARAM_STR);
            $stmt->execute();

            // Check if a record is found
            if (0 === $stmt->rowCount()) {
                return null; // No record found, return null
            }

            // Fetch the ID as an integer
            $categoryId = (int) $stmt->fetchColumn();

            return $categoryId;
        } catch (ActionNotFoundException $e) {
            // Handle the exception, log the error, or return an appropriate response
            // For example, you might want to redirect to an error page
            header('Location: 500');

            return null;
        }
    }
}
