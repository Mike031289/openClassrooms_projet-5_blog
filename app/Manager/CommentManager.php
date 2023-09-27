<?php
namespace App\Manager;

class CommentManager extends BaseManager
{

    public function __construct($dataSource)
    {
        parent::__construct("comment", "Comment", $dataSource);
    }

    /**
     * Retrieve comments related to a specific article based on its identifier (postId).
     *
     * @param int $postId The identifier of the article for which to retrieve comments.
     * @return array An array of Comment objects representing the comments for the specified article.
     */
    public function getCommentsByPostId($postId)
    {
        $req = $this->_db->prepare("SELECT * FROM comment WHERE postId = :postId");
        $req->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $req->execute();
    
        // Assuming you have a Comment model, you can set the fetch mode accordingly:
        // $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class);
    
        // Return an array of Comment objects representing the comments
        return $req->fetchAll();
    }

}
