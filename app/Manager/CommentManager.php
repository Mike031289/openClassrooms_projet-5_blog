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
     * @param $postId The identifier of the article for which to retrieve comments.
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
    public function createComment(string $content, int $authorId, int $postId): ?Comment
    {
        $this->_db->beginTransaction();
        $createdAt = date('Y-m-d H:i:s');

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

    /**
     * Get the total number of comments for a specific post.
     *
     * @param $postId The ID of the post.
     *
     * @return int The total number of comments for the post.
     */
    public function getTotalCommentsForPost(int $postId): int
    {
        try {
            // Execute a SQL query to count the total number of comments for the specific post
            $sql  = "SELECT COUNT(*) FROM Comment WHERE postId = :postId";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':postId', $postId, \PDO::PARAM_INT);
            $stmt->execute();

            // Fetch the result
            $totalComments = $stmt->fetchColumn();

            return $totalComments;
        }
        catch (ActionNotFoundException $e) {
            // Handle exceptions, log errors, or return 0 in case of an error
            return 0;
        }
    }

    /**
     * Retrieves a paginated list of comments for a specific post.
     *
     * @param $postId The ID of the post for which to retrieve comments.
     * @param $page The current page number (default is 1).
     * @param $perPage The number of comments per page (default is 5).
     *
     * @return array An array containing comments and pagination information.
     */
    public function getPaginatedCommentsForPost(int $postId, int $page, int $perPage): array
    {
        // Calculate the offset based on the page number and items per page
        $offset = ($page - 1) * $perPage;

        try {
            // Retrieve the total number of comments for the post
            $totalComments = $this->getTotalCommentsForPost($postId);

            // Retrieve comments from the 'Comment' table for the specific post, ordered by date in descending order, with pagination
            $sql  = "SELECT * FROM Comment WHERE postId = :postId ORDER BY createdAt DESC LIMIT :offset, :perPage";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':postId', $postId, \PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
            $stmt->bindParam(':perPage', $perPage, \PDO::PARAM_INT);
            $stmt->execute();

            // Fetch the results as an associative array
            $commentsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Convert the data into an array of Comment objects
            $comments = [];
            foreach ($commentsData as $data) {
                $comment = new Comment;
                $comment->setId($data['id']);
                $comment->setContent($data['content']);
                $comment->setAuthorId($data['authorId']);
                $comment->setPostId($data['postId']);
                $comment->setCreatedAt(new \DateTime($data['createdAt']));
                $comments[] = $comment;
            }

            // Return an array with comments and pagination information
            return [
                'comments'    => $comments,
                'currentPage' => $page,
                'totalPages'  => ceil($totalComments / $perPage),
            ];
        }
        catch (ActionNotFoundException $e) {
            // Handle exceptions, log errors, or return an empty array
            // Redirect to an admin 500 error page if an exception occurs
            header("Location: 500");
            exit;
        }
    }


}