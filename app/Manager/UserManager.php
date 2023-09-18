<?php
namespace App\Manager;
use App\Models\User;
class UserManager extends BaseManager
{

    public function __construct($dataSource)
    {
        parent::__construct("user", "User", $dataSource);
    }

    /**
     * Get a user by their email from the database.
     *
     * @param string $email The email address of the user to retrieve.
     *
     * @return User|false An instance of the User class representing the user, or false if not found.
     */
    public function getUserByEmail($email) {
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
        return $user ? $user : false;
    }


    // public function create($object)
    // {
    //     // Utilisez une requête SQL préparée pour insérer les données dans la base de données
    //     $sql = "INSERT INTO {$this->_table} (userName, email, passWord, createdAt) VALUES (?, ?, ?, ?)";
    //     $stmt = $this->_db->prepare($sql);

    //     // Associez les valeurs aux paramètres de la requête
    //     $stmt->bindParam(1, $object->getUserName(), \PDO::PARAM_STR);
    //     $stmt->bindParam(2, $object->getEmail(), \PDO::PARAM_STR);
    //     $stmt->bindParam(3, $object->getPassWord(), \PDO::PARAM_STR);
    //     $stmt->bindParam(4, $object->getCreatedAt(), \PDO::PARAM_STR);

    //     // Exécutez la requête d'insertion
    //     if ($stmt->execute()) {
    //         // Si l'insertion est réussie, retournez l'objet User
    //         return $object;
    //     } else {
    //         // En cas d'échec, vous pouvez gérer l'erreur ici
    //         return null;
    //     }
    // }
    
    
}
