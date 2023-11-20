<?php
namespace App\Manager;

use App\Models\Comment; 

class CommentManager extends BaseManager
{

    public function __construct(object $dataSource)
    {
        parent::__construct("comment", "Comment", $dataSource);
    }

    /**
     * Retrieve comments related to a specific article based on its identifier (postId).
     *
     * @param int $postId The identifier of the article for which to retrieve comments.
     * @return array An array of Comment objects representing the comments for the specified article.
     */
    public function getCommentsByPostId(int $postId)
    {
        $req = $this->_db->prepare("SELECT * FROM comment WHERE postId = :postId");
        $req->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $req->execute();

        // Assuming you have a Comment model, you can set the fetch mode accordingly:
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class);

        // Return an array of Comment objects representing the comments
        return $req->fetchAll();
    }

    // public function getCommentsByPostId(int $postId, int $page = 1, int $pageSize = 10): array
    // {
    //     $start = ($page - 1) * $pageSize; // Calcul du point de départ pour la pagination

    //     $sql  = "SELECT * FROM comment WHERE postId = :postId ORDER BY createdAt DESC LIMIT :start, :pageSize";
    //     $stmt = $this->_db->prepare($sql);
    //     $stmt->bindValue(':postId', $postId, \PDO::PARAM_INT);
    //     $stmt->bindValue(':start', $start, \PDO::PARAM_INT);
    //     $stmt->bindValue(':pageSize', $pageSize, \PDO::PARAM_INT);
    //     $stmt->execute();

    //     return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    // }

    // public function commentCount($count)
    // {
    //     // Préparez la requête SQL pour vérifier si le nom d'utilisateur existe
    //     $query = "SELECT COUNT(*) FROM comment WHERE comment = :comment";

    //     // Utilisez PDO pour préparer et exécuter la requête
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    //     $stmt->execute();

    //     // Récupérez le résultat de la requête
    //     $count = $stmt->fetchColumn();

    //     // Si le compte est supérieur à zéro, le nom d'utilisateur existe
    //     return $count > 0;
    // }

}