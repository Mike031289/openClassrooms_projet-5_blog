<?php
namespace App\Manager;

use App\Core\Functions\FormHelper;

use App\Models\User;

class UserManager extends BaseManager
{
    public function __construct(object $dataSource)
    {
        parent::__construct("user", "User", $dataSource);
    }

    /**
     * Get a user by their email from the database.
     *
     */
    public function getUserByEmail(string $email): ?User
    {
        // SQL query to retrieve the user by email from the database
        $sql = "SELECT * FROM user WHERE email = :email";

        // Prepare the SQL statement
        $stmt = $this->_db->prepare($sql);

        // Bind the email parameter
        $stmt->bindParam(':email', $email);

        // Execute the query
        $stmt->execute();

        // Use setFetchMode to specify the class and fetch mode
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, User::class);

        // Use fetchObject to retrieve the result as an object of the User class
        $user = $stmt->fetchObject(User::class);

        // Return the User object or false if not found
        return $user ? $user : null;
    }

    /**
     * Get a user by their name from the database.
     *
     */
    public function getUserByName(string $userName): ?User
    {
        // SQL query to retrieve the user by name from the database
        $sql = "SELECT * FROM user WHERE userName = :userName";

        // Prepare the SQL statement
        $stmt = $this->_db->prepare($sql);

        // Bind the userName parameter
        $stmt->bindParam(':userName', $userName);

        // Execute the query
        $stmt->execute();

        // Use setFetchMode to specify the class and fetch mode
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, User::class);

        // Use fetchObject to retrieve the result as an object of the User class
        $user = $stmt->fetchObject(User::class);

        // Return the User object or false if not found
        return $user ? $user : null;
    }


    /**
     * Create a new user in the database.
     *
     * @param $userName The username of the new user.
     * @param $email The email address of the new user.
     * @param $passWord The password of the new user (plain text).
     *
     * @return User|null Returns a User object if the user was successfully created, or null on failure.
     */
    public function createUser(string $userName, string $email, string $passWord): ?User
    {
        // Hash the password
        $hashedPassword = password_hash($passWord, PASSWORD_DEFAULT);

        // Get the current date
        $createdAt = date('Y-m-d H:i:s');

        // Use a prepared SQL query to insert data into the database
        $sql  = "INSERT INTO user (userName, email, passWord, createdAt) VALUES (?, ?, ?, ?)";
        $stmt = $this->_db->prepare($sql);

        // Bind values to query parameters
        $stmt->bindParam(1, $userName, \PDO::PARAM_STR);
        $stmt->bindParam(2, $email, \PDO::PARAM_STR);
        $stmt->bindParam(3, $hashedPassword, \PDO::PARAM_STR);
        $stmt->bindParam(4, $createdAt, \PDO::PARAM_STR);

        // Execute the insertion query
        if ($stmt->execute()) {
            // Get the ID of the newly created user
            $userId = $this->_db->lastInsertId();

            // Create a new User object with the inserted data
            $user = new User();
            $user->setId($userId);
            $user->setUserName($userName);
            $user->setEmail($email);
            $user->setPassWord($hashedPassword);
            $user->setCreatedAt($createdAt);

            // Return the User object
            return $user;
        } else {
            // Handle the error in case of failure
            return null;
        }
    }



}