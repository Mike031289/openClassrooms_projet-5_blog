<?php
namespace App\Manager;

class UserManager extends BaseManager
{

    public function __construct($dataSource)
    {
        parent::__construct("user", "User", $dataSource);
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
