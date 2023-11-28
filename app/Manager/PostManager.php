<?php
namespace App\Manager;

use App\Models\Post;
use App\Exceptions\ActionNotFoundException;

class PostManager extends BaseManager
{

    public function __construct(object $dataSource)
    {
        parent::__construct("post", "Post", $dataSource);
    }

    /**
     * Create a new post and insert it into the database.
     *
     * @param $title The title of the post.
     * @param $content The content of the post.
     * @param $postImg The image file for the post.
     * @param $categoryId The category ID of the post.
     * @param $authorRole The author ID of the post.
     * @param $postPreview The preview of the post.
     *
     * @return Post|null The created Post object, or null on failure.
     */
    public function createNewPost($title, $content, $postImg, $categoryId, $authorRole, $postPreview): ?Post
    {
        $this->_db->beginTransaction();

        try {
            // Step 1: Check if $postImg is not null before calling uploadImage
            if ($postImg !== null) {
                // Step 1: Move the image to the designated folder
                $imageFileName = $this->uploadImage($postImg);
            } else {
                // Handle the case where $postImg is null (if needed)
                // For example, you might want to set a default image or display an error message.
                $imageFileName = null; // Set a default value or handle the null case accordingly
            }

            // Get the current date
            $createdAt = date('Y-m-d H:i:s');
            $updatedAt  = date('Y-m-d H:i:s');
            // Step 2: Insert the post into the 'Post' table
            $sql  = "INSERT INTO Post (title, content, imageUrl, categoryId, authorRole, createdAt, updatedAt, postpreview) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $title, \PDO::PARAM_STR);
            $stmt->bindParam(2, $content, \PDO::PARAM_STR);
            $stmt->bindParam(3, $imageFileName, \PDO::PARAM_STR);
            $stmt->bindParam(4, $categoryId, \PDO::PARAM_INT);
            $stmt->bindParam(5, $authorRole, \PDO::PARAM_STR);
            $stmt->bindParam(6, $createdAt, \PDO::PARAM_STR);
            $stmt->bindParam(7, $updatedAt, \PDO::PARAM_STR);
            $stmt->bindParam(8, $postPreview, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                throw new ActionNotFoundException;
            }

            // Step 3: Get the ID of the newly created post
            $id = $this->_db->lastInsertId();

            // Commit the transaction
            $this->_db->commit();

            // Create a new Post object with the inserted data
            $post = new Post;
            $post->setId($id);
            $post->setTitle($title);
            $post->setContent($content);
            $post->setImageUrl($imageFileName);
            $post->setCategoryId($categoryId);
            $post->setAuthorRole($authorRole);
            $post->setCreatedAt(new \DateTime($createdAt));
            $post->setUpdatedAt(new \DateTime($updatedAt));
            $post->setPostPreview($postPreview);

            return $post;
        }
        catch (ActionNotFoundException $e) {
            // Handle the error in case of failure and roll back the transaction
            $this->_db->rollBack();
            return null;
        }
    }

    public function getPaginatedPosts(int $page, int $pageSize): array
    {
        $start = ($page - 1) * $pageSize; // Calculation of starting point for pagination

        $sql  = "SELECT * FROM posts ORDER BY createdAt DESC LIMIT :start, :pageSize";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':start', $start, \PDO::PARAM_INT);
        $stmt->bindValue(':pageSize', $pageSize, \PDO::PARAM_INT);
        $stmt->execute();

        $contacts = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Return an array with contacts and pagination information
        return [
            'contacts'    => $contacts,
            'currentPage' => $page,
            'totalPages'  => ceil(count($contacts) / $pageSize),
        ];
    }


    /**
     * Move the uploaded image file to the designated folder.
     *
     * @param array $imageFile The image file information from $_FILES.
     *
     * @return string|null The file name of the uploaded image, or null on failure.
     */
    private function uploadImage(array $imageFile): ?string
    {
        // Specify the upload directory
        $uploadDirectory = "../mon-blog/public/assets/img/postImg/";

        // Get file information
        $fileTmpName   = $imageFile["tmp_name"];
        $fileName      = basename($imageFile["name"]);
        $fileType      = $imageFile["type"];
        $fileSize      = $imageFile["size"];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allowed file extensions
        $allowedExtensions = array("jpeg", "jpg", "png");

        // Check if the file extension is allowed
        if (!in_array($fileExtension, $allowedExtensions)) {
            return null; // File extension not allowed
        }

        // Generate a unique file name to avoid overwriting existing files
        $uniqueFileName = uniqid() . '_' . $fileName;

        // Move the uploaded file to the designated folder
        $imageFilePath = $uploadDirectory . $uniqueFileName;
        move_uploaded_file($fileTmpName, $imageFilePath);

        return $uniqueFileName;
    }

    public function updatePost(int $id, $title, $content, $postImg, $categoryId, $authorRole, $postPreview): ?Post
    {
        $this->_db->beginTransaction();

        try {
            // Step 1: Check if $postImg is not null before calling uploadImage
            if ($postImg !== null) {
                // Step 1: Move the image to the designated folder
                $imageFileName = $this->uploadImage($postImg);
            } else {
                // Handle the case where $postImg is null (if needed)
                // For example, you might want to keep the existing image or display an error message.
                $imageFileName = null; // Set a default value or handle the null case accordingly
            }

            // Get the current date for updating the 'updatedAt' field
            $updatedAt = date('Y-m-d H:i:s');

            // Step 2: Update the post in the 'Post' table
            $sql  = "UPDATE Post SET title = ?, content = ?, imageUrl = ?, categoryId = ?, authorRole = ?, updatedAt = ?, postpreview = ? WHERE id = ?";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $title, \PDO::PARAM_STR);
            $stmt->bindParam(2, $content, \PDO::PARAM_STR);
            $stmt->bindParam(3, $imageFileName, \PDO::PARAM_STR);
            $stmt->bindParam(4, $categoryId, \PDO::PARAM_INT);
            $stmt->bindParam(5, $authorRole, \PDO::PARAM_STR);
            $stmt->bindParam(6, $updatedAt, \PDO::PARAM_STR);
            $stmt->bindParam(7, $postPreview, \PDO::PARAM_STR);
            $stmt->bindParam(8, $id, \PDO::PARAM_INT);

            if (!$stmt->execute()) {
                throw new ActionNotFoundException;
            }

            // Commit the transaction
            $this->_db->commit();

            // Create a new Post object with the updated data
            $post = new Post;
            $post->setId($id);
            $post->setTitle($title);
            $post->setContent($content);
            $post->setImageUrl($imageFileName);
            $post->setCategoryId($categoryId);
            $post->setAuthorRole($authorRole);
            $post->setUpdatedAt(new \DateTime($updatedAt));
            $post->setPostPreview($postPreview);

            return $post;
        }
        catch (ActionNotFoundException $e) {
            // Handle the error in case of failure and roll back the transaction
            $this->_db->rollBack();
            return null;
        }
    }

    /**
     * Delete a post from the database by its ID.
     *
     * @param $id The ID of the post to be deleted.
     *
     * @return bool True if the post was successfully deleted, false otherwise.
     */
    public function deletePost(int $id): bool
    {
        try {
            // Prepare and execute a DELETE SQL query to remove the post by its ID
            $sql  = "DELETE FROM Post WHERE id = ?";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);

            // Check if the DELETE operation was successful
            if ($stmt->execute()) {
                return true; // Return true if the deletion was successful
            } else {
                return false; // Return false if the deletion failed
            }
        }
        catch (ActionNotFoundException $e) {
            // Handle any exceptions, e.g., log the error or return false
            return false;
        }
    }



}
