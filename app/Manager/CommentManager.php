<?php

declare(strict_types=1);

namespace App\Manager;

use App\Exceptions\ActionNotFoundException;
use App\Models\Comment;

class CommentManager extends BaseManager
{
    public function __construct(object $dataSource)
    {
        parent::__construct('comment', 'Comment', $dataSource);
    }

    /**
     * Create a new comment for a post.
     *
     * @param string $content    the content of the comment
     * @param string $authorName the name of the comment author
     * @param int    $postId     the ID of the post the comment belongs to
     *
     * @return Comment|null returns the created Comment object or null on failure
     */
    public function createComment(string $content, string $authorName, int $postId): ?Comment
    {
        $this->_db->beginTransaction();

        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Europe/Paris')); // Set the timezone if necessary
        $createdAt = $date->format('Y-m-d H:i:s');

        try {
            // Insert the comment into the 'Comment' table
            $sql = 'INSERT INTO Comment (content, authorName, postId, createdAt) VALUES (?, ?, ?, ?)';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $content, \PDO::PARAM_STR);
            $stmt->bindParam(2, $authorName, \PDO::PARAM_STR); // Corrected from PARAM_INT to PARAM_STR
            $stmt->bindParam(3, $postId, \PDO::PARAM_INT);
            $stmt->bindParam(4, $createdAt, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                throw new ActionNotFoundException();
            }

            // Commit the transaction
            $this->_db->commit();

            // Get the ID of the inserted comment
            $id = $this->_db->lastInsertId();

            // Create a new Comment object with the inserted data
            $comment = new Comment();
            $comment->setId((int)$id);
            $comment->setContent(htmlspecialchars($content));
            $comment->setAuthorName(htmlspecialchars($authorName));
            $comment->setPostId((int)$postId);
            $comment->setCreatedAt(new \DateTime($createdAt));

            return $comment;
        } catch (ActionNotFoundException $e) {
            // Handle the error in case of failure and roll back the transaction
            // Redirect to a 500 error page if no matching route is found
            header('Location: 500');
            $this->_db->rollBack();

            return null;
        }
    }

    /**
     * Retrieve comments related to a specific article based on its identifier (postId).
     *
     * @param        $postId The identifier of the article for which to retrieve comments
     * @return array an array of Comment objects representing the comments for the specified article
     */
    public function getCommentsByPostId(int $postId)
    {
        $req = $this->_db->prepare('SELECT * FROM comment WHERE postId = :postId');
        $req->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $req->execute();

        // Assuming you have a Comment model, you can set the fetch mode accordingly:
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class, []);

        // Return an array of Comment objects representing the comments
        return $req->fetchAll();
    }

    /**
     * Retrieves the total number of comments in the 'Comment' table.
     *
     * @return int the total number of comments
     */
    private function getTotalComments(): int
    {
        $sql = 'SELECT COUNT(*) FROM Comment';
        $stmt = $this->_db->query($sql);

        return (int) $stmt->fetchColumn();
    }

    /**
     * Retrieves a paginated list of comments without considering the post ID.
     *
     * @param int $page    the current page number (default is 1)
     * @param int $perPage the number of comments per page (default is 5)
     *
     * @return array an array containing comments and pagination information
     */
    public function getPaginatedComments(int $page, int $perPage): ?array
    {
        if ($page < 1) {
            $page = 1;
        }

        // Calculate the offset based on the page number and items per page
        $offset = ($page - 1) * $perPage;

        try {
            // Retrieve the total number of comments
            $totalComments = $this->getTotalComments();

            // Retrieve comments from the 'Comment' table, ordered by date in descending order, with pagination
            $sql = 'SELECT * FROM comment ORDER BY createdAt DESC LIMIT :offset, :perPage';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
            $stmt->bindParam(':perPage', $perPage, \PDO::PARAM_INT);
            $stmt->execute();

            // Use setFetchMode to specify the class and fetch mode
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class, []);

            $commentsData = $stmt->fetchAll(\PDO::FETCH_OBJ);

            // Convert the data into an array of Comment objects
            foreach ($commentsData as $data) {
                $comment = new Comment();
                $comment->setId($data->id);
                $comment->setContent($data->content);
                $comment->setAuthorName($data->authorName);
                $comment->setPostId($data->postId);
                $comment->setCreatedAt(new \DateTime($data->createdAt));

                $comments[] = $comment;
            }

            // Return an array with comments and pagination information
            return [
                'comments'    => $comments,
                'currentPage' => $page,
                'totalPages'  => ceil($totalComments / $perPage),
            ];
        } catch (ActionNotFoundException $e) {
            // Handle the error in case of failure and roll back the transaction
            header("Location: 500");
        }
    }

    /**
     * Retrieve a Comment object by its ID.
     *
     * @param int $commentId the ID of the comment to retrieve
     *
     * @return Comment|null the Comment object if found, or null if not found
     */
    public function getCommentById(int $commentId): ?Comment
    {
        try {
            // Prepare and execute the SQL query
            $sql = 'SELECT * FROM Comment WHERE id = :commentId ORDER BY createdAt DESC';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':commentId', $commentId, \PDO::PARAM_INT);
            $stmt->execute();

            // Fetch the result as an associative array
            $commentData = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (false === $commentData) {
                // Comment not found
                return null;
            }

            // Use setFetchMode to specify the class and fetch mode
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class, []);

            $commentData = $stmt->fetch();

            $comment = new Comment();
            $comment->setId($commentData->id);
            $comment->setContent($commentData->content);
            $comment->setAuthorName($commentData->authorName);
            $comment->setCreatedAt(new \DateTime($commentData->createdAt));

            return $comment;
        } catch (ActionNotFoundException $e) {
            // Handle the error in case of failure and roll back the transaction
            header("Location: 500");
        }
    }

    /**
     * Delete a comment from the database by its ID.
     *
     * @param $id The ID of the comment to be deleted
     *
     * @return bool true if the comment was successfully deleted, false otherwise
     */
    public function deleteComment(int $id): bool
    {
        try {
            // Prepare and execute a DELETE SQL query to remove the comment by its ID
            $sql = 'DELETE FROM Comment WHERE id = ?';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);

            // Check if the DELETE operation was successful
            if ($stmt->execute()) {
                return true; // Return true if the deletion was successful
            }

            return false; // Return false if the deletion failed
        } catch (ActionNotFoundException $e) {
            // Handle any exceptions, e.g., log the error or return false
            // Redirect to a 500 error page if no matching route is found
            header('Location: 500');

            return false;
        }
    }
}
