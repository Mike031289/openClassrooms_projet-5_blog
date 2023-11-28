<?php
namespace App\Manager;

use App\Models\Comment;
use App\Exceptions\ActionNotFoundException;

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

    /**
     * Create a new comment for a post.
     *
     * @param $content The content of the comment.
     * @param $authorId The ID of the comment author.
     * @param $postId The ID of the post the comment belongs to.
     * @param $createdAt The creation date and time of the comment.
     * @return Comment|null Returns the created Comment object or null on failure.
     */
    public function createComment(string $content, int $authorId, int $postId, string $createdAt): ?Comment
    {
        $this->_db->beginTransaction();

        try {
            // Step 2: Insert the comment into the 'Comment' table
            $sql  = "INSERT INTO Comment (content, authorId, postId, createdAt) VALUES (?, ?, ?, ?)";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $content, \PDO::PARAM_STR);
            $stmt->bindParam(2, $authorId, \PDO::PARAM_INT);
            $stmt->bindParam(3, $postId, \PDO::PARAM_INT);
            $stmt->bindParam(4, $createdAt, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                throw new ActionNotFoundException;
            }

            // Commit the transaction
            $this->_db->commit();

            // Get the ID of the inserted comment
            $id = $this->_db->lastInsertId();

            // Create a new Comment object with the inserted data
            $comment = new Comment;
            $comment->setId($id);
            $comment->setContent($content);
            $comment->setAuthorId($authorId);
            $comment->setPostId($postId);
            $comment->setCreatedAt(new \DateTime($createdAt));

            return $comment;
        }
        catch (ActionNotFoundException $e) {
            // Handle the error in case of failure and roll back the transaction
            $this->_db->rollBack();
            return null;
        }
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