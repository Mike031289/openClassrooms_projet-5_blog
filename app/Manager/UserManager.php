<?php

declare(strict_types=1);

namespace App\Manager;

use App\Exceptions\ActionNotFoundException;
use App\Models\User;

class UserManager extends BaseManager
{
    public function __construct(object $dataSource)
    {
        parent::__construct('user', 'User', $dataSource);
    }

    /**
     * Get a user by their email from the database.
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

        // Return the User object or false if not found
        return $user ? $user : null;
    }

    /**
     * Get a user by their name from the database.
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

        // Return the User object or false if not found
        return $user ? $user : null;
    }

    /**
     * Create a new user in the database.
     *
     * @param $userName The username of the new user
     * @param $email    The email address of the new user
     * @param $passWord The password of the new user (plain text)
     *
     * @return User|null returns a User object if the user was successfully created, or null on failure
     */
    public function createUserWithRole(string $userName, string $email, string $passWord): ?User
    {
        // Hash the password
        $hashedPassword = password_hash($passWord, \PASSWORD_DEFAULT);

        // Use a transaction to ensure data consistency
        $this->_db->beginTransaction();

        // Get the current date
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Europe/Paris')); // Set the timezone if necessary
        $createdAt = $date->format('Y-m-d H:i:s');

        try {
            // Step 1: Insert the user into the 'user' table
            $sql = 'INSERT INTO user (userName, email, passWord, createdAt) VALUES (?, ?, ?, ?)';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $userName, \PDO::PARAM_STR);
            $stmt->bindParam(2, $email, \PDO::PARAM_STR);
            $stmt->bindParam(3, $hashedPassword, \PDO::PARAM_STR);
            $stmt->bindParam(4, $createdAt, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                throw new ActionNotFoundException();
            }

            // Step 2: Get the ID of the newly created user
            $id = $this->_db->lastInsertId();

            // Step 3: Retrieve the roleId from the 'role' table (adjust the SQL query as needed)
            $roleName = 'Visitor'; // Replace with the actual role name
            $sql = 'SELECT roleId FROM role WHERE roleName = ?';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $roleName, \PDO::PARAM_STR);

            if ($stmt->execute()) {
                $roleRow = $stmt->fetch(\PDO::FETCH_ASSOC);
                if ($roleRow) {
                    $roleId = $roleRow['roleId'];
                } else {
                    throw new ActionNotFoundException();
                }
            } else {
                throw new ActionNotFoundException();
            }

            // Step 4: Insert the user ID and role into the 'userrole' table
            $sql = 'INSERT INTO userrole (userId, roleId) VALUES (?, ?)';
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
            $user->setCreatedAt(new \DateTime($createdAt));

            // Return the User object
            return $user;
        } catch (ActionNotFoundException $e) {
            // Redirect to a 404 error page if no matching route is found
            header('Location: 500');
            // Handle the error in case of failure and roll back the transaction
            $this->_db->rollBack();

            return null;
        }
    }

    /**
     * Retrieve the role of a user by their email.
     *
     * @param              $email The email of the user
     * @return string|null the user's role or null if not found
     */
    public function getUserRoleByEmail(string $email): ?string
    {
        $sql = 'SELECT r.roleName
            FROM user AS u
            JOIN userrole AS ur ON u.id = ur.userId
            JOIN role AS r ON ur.roleId = r.roleId
            WHERE u.email = :email';

        $req = $this->_db->prepare($sql);
        $req->bindValue(':email', $email, \PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetch(\PDO::FETCH_ASSOC);

        return ($result) ? $result['roleName'] : null;
    }

    /**
     * Retrieve the role of a user by their id.
     *
     * @param              $id The id of the user
     * @return string|null the user's role or null if not found
     */
    public function getAuthorRoleById(int $id): ?string
    {
        $sql = 'SELECT r.roleName
            FROM user AS u
            JOIN userrole AS ur ON u.id = ur.userId
            JOIN role AS r ON ur.roleId = r.roleId
            WHERE u.id = :id';

        $req = $this->_db->prepare($sql);
        $req->bindValue(':id', $id, \PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetch(\PDO::FETCH_ASSOC);

        return ($result) ? $result['roleName'] : null;
    }
}
