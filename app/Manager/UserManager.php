<?php

declare(strict_types=1);

namespace App\Manager;

use App\Exceptions\ActionNotFoundException;
use App\Models\User;

/**
 * Class UserManager
 *
 * Manages user-related operations.
 */
class UserManager extends BaseManager
{
    /**
     * UserManager constructor.
     *
     * @param object $dataSource The data source object.
     */
    public function __construct(object $dataSource)
    {
        parent::__construct('user', 'User', $dataSource);
    }

    /**
     * Get a user by their email from the database.
     *
     * @param string $email The email of the user.
     *
     * @return User|null The User object if found, or null otherwise.
     */
    public function getUserByEmail(string $email): ?User
    {
        // SQL query to retrieve the user by email from the database
        $sql = 'SELECT * FROM user WHERE email = ?';

        // Prepare the SQL statement
        $stmt = $this->_db->prepare($sql);

        // Bind the email parameter
        $stmt->bindParam(1, $email, \PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Use setFetchMode to specify the class and fetch mode
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, User::class, []);

        // Use fetchObject to retrieve the result as an object of the User class
        $user = $stmt->fetchObject(User::class);

        // Return the User object or null if not found
        return $user ?: null;
    }

    /**
     * Get a user by their name from the database.
     *
     * @param string $userName The username of the user.
     *
     * @return User|null The User object if found, or null otherwise.
     */
    public function getUserByName(string $userName): ?User
    {
        // SQL query to retrieve the user by name from the database
        $sql = 'SELECT * FROM user WHERE userName = ?';

        // Prepare the SQL statement
        $stmt = $this->_db->prepare($sql);

        // Bind the userName parameter
        $stmt->bindParam(1, $userName, \PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Use setFetchMode to specify the class and fetch mode
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, User::class, []);

        // Use fetchObject to retrieve the result as an object of the User class
        $user = $stmt->fetchObject(User::class);

        // Return the User object or null if not found
        return $user ?: null;
    }

    /**
     * Create a new user in the database.
     *
     * @param string $userName The username of the new user.
     * @param string $email The email address of the new user.
     * @param string $passWord The password of the new user (plain text).
     *
     * @return User|null The User object if the user was successfully created, or null on failure.
     */
    public function createUserWithRole(string $userName, string $email, string $passWord): ?User
    {
        // Hash the password
        $hashedPassword = password_hash($passWord, \PASSWORD_DEFAULT);

        // Use a transaction to ensure data consistency
        $this->_db->beginTransaction();

        try {
            // Step 1: Insert the user into the 'user' table
            $sql  = 'INSERT INTO user (userName, email, passWord, createdAt) VALUES (?, ?, ?, NOW())';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $userName, \PDO::PARAM_STR);
            $stmt->bindParam(2, $email, \PDO::PARAM_STR);
            $stmt->bindParam(3, $hashedPassword, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                throw new ActionNotFoundException();
            }

            // Step 2: Get the ID of the newly created user
            $id = $this->_db->lastInsertId();

            // Step 3: Retrieve the roleId from the 'role' table (adjust the SQL query as needed)
            $roleName = 'Visitor'; // Replace with the actual role name
            $sql      = 'SELECT roleId FROM role WHERE roleName = ?';
            $stmt     = $this->_db->prepare($sql);
            $stmt->bindParam(1, $roleName, \PDO::PARAM_STR);

            if ($stmt->execute()) {
                $roleId = $stmt->fetchColumn();
                if (!$roleId) {
                    throw new ActionNotFoundException();
                }
            } else {
                throw new ActionNotFoundException();
            }

            // Step 4: Insert the user ID and role into the 'userrole' table
            $sql  = 'INSERT INTO userrole (userId, roleId) VALUES (?, ?)';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->bindParam(2, $roleId, \PDO::PARAM_INT);

            if (!$stmt->execute()) {
                throw new ActionNotFoundException();
            }

            // Commit the transaction
            $this->_db->commit();

            // Create a new User object with the inserted data
            $user = new User();
            $user->setId((int) $id);
            $user->setUserName(htmlspecialchars($userName));
            $user->setEmail(htmlspecialchars($email));
            $user->setPassWord(htmlspecialchars($hashedPassword));
            $user->setCreatedAt(new \DateTime());

            // Return the User object
            return $user;
        }
        catch (ActionNotFoundException $e) {
            // Handle the error in case of failure and roll back the transaction
            $this->_db->rollBack();

            return null;
        }
    }

    /**
     * Retrieve the role of a user by their email.
     *
     * @param string $email The email of the user.
     *
     * @return string|null The user's role or null if not found.
     */
    public function getUserRoleByEmail(string $email): ?string
    {
        $sql = 'SELECT r.roleName
        FROM user AS u
        JOIN userrole AS ur ON u.id = ur.userId
        JOIN role AS r ON ur.roleId = r.roleId
        WHERE u.email = :email';

        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        // Utiliser fetchColumn pour obtenir directement la valeur de 'roleName'
        $roleName = $stmt->fetchColumn();

        return ($roleName !== false) ? (string) $roleName : null;
    }

    /**
     * Retrieve the role of a user by their id.
     *
     * @param int $id The ID of the user.
     *
     * @return string|null The user's role or null if not found.
     */
    public function getAuthorRoleById(int $id): ?string
    {
        $sql = 'SELECT r.roleName
        FROM user AS u
        JOIN userrole AS ur ON u.id = ur.userId
        JOIN role AS r ON ur.roleId = r.roleId
        WHERE u.id = :id';

        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        // Utiliser fetchColumn pour obtenir directement la valeur de 'roleName'
        $roleName = $stmt->fetchColumn();

        return ($roleName !== false) ? (string) $roleName : null;
    }

}
