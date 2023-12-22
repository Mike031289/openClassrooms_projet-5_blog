<?php

declare(strict_types=1);

namespace App\Manager;

use App\Exceptions\ActionNotFoundException;
use App\Models\Post;

class PostManager extends BaseManager
{
    public function __construct(object $dataSource)
    {
        parent::__construct('post', 'Post', $dataSource);
    }

    /**
     * Create a new post and insert it into the database.
     *
<<<<<<< HEAD
     * @param $title       The title of the post
     * @param $content     The content of the post
     * @param $postImg     The image file for the post
     * @param $categoryId  The category ID of the post
     * @param $authorRole  The author ID of the post
     * @param $postPreview The preview of the post
=======
     * @param $title The title of the post.
     * @param $content The content of the post.
     * @param $postImg The image file for the post. Null if no image.
     * @param $categoryId The category ID of the post.
     * @param $authorRole The author role of the post.
     * @param $postPreview The preview of the post.
>>>>>>> debug-branch
     *
     * @return Post|null the created Post object, or null on failure
     */
    public function createNewPost(string $title, string $content, ?array $postImg, int $categoryId, string $authorRole, string $postPreview): ?Post
    {
        $this->_db->beginTransaction();

        try {
            // Step 1: Check if $postImg is not null before calling uploadImage
            if (null !== $postImg) {
                // Step 1: Move the image to the designated folder
                $imageFileName = $this->uploadImage($postImg);
            } else {
                // Handle the case where $postImg is null (if needed)
                // For example, you might want to set a default image or display an error message.
                $imageFileName = null; // Set a default value or handle the null case accordingly
            }

            // Get the current date
            $date = new \DateTime();
            $date->setTimezone(new \DateTimeZone('Europe/Paris')); // Set the timezone if necessary
            $createdAt = $date->format('Y-m-d H:i:s');
            $updatedAt = $date->format('Y-m-d H:i:s');

            // Step 2: Insert the post into the 'Post' table
            $sql = 'INSERT INTO post (title, content, imageUrl, categoryId, authorRole, createdAt, updatedAt, postpreview) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
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
                throw new ActionNotFoundException();
            }

            // Step 3: Get the ID of the newly created post
            $id = $this->_db->lastInsertId();

            // Commit the transaction
            $this->_db->commit();

            // Create a new Post object with the inserted data
            $post = new Post();
            $post->setId($id);
            $post->setTitle(htmlspecialchars($title));
            $post->setContent(htmlspecialchars($content));
            $post->setImageUrl(htmlspecialchars($imageFileName));
            $post->setCategoryId(htmlspecialchars($categoryId));
            $post->setAuthorRole(htmlspecialchars($authorRole));
            $post->setCreatedAt(new \DateTime($createdAt));
            $post->setUpdatedAt(new \DateTime($updatedAt));
            $post->setPostPreview(htmlspecialchars($postPreview));

            return $post;
        } catch (ActionNotFoundException $e) {
            // Handle the error in case of failure and roll back the transaction
            // Redirect to a 500 error page if no matching route is found
            header('Location: 500');
            $this->_db->rollBack();

            return null;
        }
    }

    /**
     * Retrieve a specific record from the table associated with the current class based on its identifier (ID).
     * It returns the record in the form of an object corresponding to the class of the current object.
     *
     * @param  int       $id the identifier of the record to retrieve
     * @return Post|null the retrieved object or null if not found
     */
    public function getPostById(int $id): ?Post
    {
        // Prepare the SQL query to retrieve a specific record by ID
        $sql = 'SELECT * FROM Post WHERE id = :id ORDER BY createdAt DESC LIMIT 1';

        // Prepare the SQL statement
        $stmt = $this->_db->prepare($sql);

        // Bind the ID parameter
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Set the fetch mode to retrieve the result as an object of the Post class
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Post::class);

        // Fetch and return the object or null if not found
        return $stmt->fetchObject(Post::class) ?: null;
    }

    /**
     * Retrieves the total number of posts in the 'Post' table.
     *
     * @return int the total number of posts
     */
    public function getTotalPosts(): int
    {
        // Retrieve the total number of posts
        $sql = 'SELECT COUNT(*) FROM Post';
        $stmt = $this->_db->query($sql);

        return $stmt->fetchColumn();
    }

    /**
     * Retrieves the total number of posts in the 'Post' table by category.
     *
     * @param  int $categoryId the ID of the category
     * @return int the total number of posts by category
     */
    public function getTotalPostsByCategory(int $categoryId): ?int
    {
        try {
            // Prepare the SQL query
            $sql = 'SELECT COUNT(*) FROM Post WHERE categoryId = :categoryId';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':categoryId', $categoryId, \PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Fetch the result
            $totalPostsByCategory = $stmt->fetchColumn();

            return $totalPostsByCategory;
        } catch (ActionNotFoundException $e) {
            // Handle exceptions, log errors, or return an empty array
            // Redirect to an admin 500 error page if an exception occurs
<<<<<<< HEAD
            header('Location: 500');
            exit;
=======
            header("Location: 500");
>>>>>>> debug-branch
        }
    }

    /**
     * Retrieves a paginated list of posts by category.
     *
     * @param $page The current page number (default is 1)
     *
     * @return array an array containing posts and pagination information
     */
    public function getPaginatedPostsByCategory(int $categoryId, int $page, int $pageSize): ?array
    {
        if ($page < 1) {
            $page = 1;
        }

        $start = ($page - 1) * $pageSize; // Calculation of starting point for pagination

        try {
            // Retrieve the total number of posts by category
            $totalPostsByCategory = $this->getTotalPostsByCategory($categoryId);

            // Prepare the SQL query
            $sql = 'SELECT * FROM Post WHERE categoryId = :categoryId ORDER BY createdAt DESC LIMIT :start, :pageSize';

            $stmt = $this->_db->prepare($sql);
            $stmt->bindValue(':start', $start, \PDO::PARAM_INT);
            $stmt->bindParam(':categoryId', $categoryId, \PDO::PARAM_INT);
            $stmt->bindParam(':pageSize', $pageSize, \PDO::PARAM_INT);
            // Execute the query
            $stmt->execute();

            // Use setFetchMode to specify the class and fetch mode
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Post::class);

            $postsData = $stmt->fetchAll(\PDO::FETCH_OBJ);

            foreach ($postsData as $data) {
                $post = new Post();
                $post->setId($data->id);
                $post->setTitle($data->title);
                $post->setContent($data->content);
                $post->setImageUrl($data->imageUrl);
                $post->setCategoryId($data->categoryId);
                $post->setAuthorRole($data->authorRole);
                $post->setCreatedAt(new \DateTime($data->createdAt));
                $post->setUpdatedAt(new \DateTime($data->updatedAt));
                $post->setPostPreview($data->postpreview);

                $posts[] = $post;
            }

            // Return an array with contacts and pagination information
            return [
                'posts'       => $posts,
                'currentPage' => $page,
                'totalPages'  => ceil($totalPostsByCategory / $pageSize),
            ];
        } catch (ActionNotFoundException $e) {
            // Handle exceptions, log errors, or return an empty array
            // Redirect to an admin 500 error page if an exception occurs
<<<<<<< HEAD
            header('Location: 500');
            exit;
=======
            header("Location: 500");
>>>>>>> debug-branch
        }
    }

    /**
     * Retrieves a paginated list of posts.
     *
     * @param int $page     the current page number (default is 1)
     * @param int $pageSize the number of posts per page
     *
     * @return array an array containing posts and pagination information
     */
    public function getPaginatedPosts(int $page, int $pageSize): ?array
    {
        if ($page < 1) {
            $page = 1;
        }

        $start = ($page - 1) * $pageSize; // Calculation of starting point for pagination

        try {
            // Retrieve the total number of posts
            $totalPosts = $this->getTotalPosts();

            $sql = 'SELECT * FROM post ORDER BY createdAt DESC LIMIT :start, :pageSize';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindValue(':start', $start, \PDO::PARAM_INT);
            $stmt->bindValue(':pageSize', $pageSize, \PDO::PARAM_INT);
            $stmt->execute();

            // Use setFetchMode to specify the class and fetch mode
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Post::class);

            $postsData = $stmt->fetchAll(\PDO::FETCH_OBJ);

            foreach ($postsData as $data) {
                $post = new Post();
                $post->setId($data->id);
                $post->setTitle($data->title);
                $post->setContent($data->content);
                $post->setImageUrl($data->imageUrl);
                $post->setCategoryId($data->categoryId);
                $post->setAuthorRole($data->authorRole);
                $post->setCreatedAt(new \DateTime($data->createdAt));
                $post->setUpdatedAt(new \DateTime($data->updatedAt));
                $post->setPostPreview($data->postpreview);

                $posts[] = $post;
            }

            // Return an array with posts and pagination information
            return [
                'posts'       => $posts,
                'currentPage' => $page,
                'totalPages'  => ceil($totalPosts / $pageSize),
            ];
        } catch (ActionNotFoundException $e) {
            // Handle exceptions, log errors, or return an empty array
            // Redirect to an admin 500 error page if an exception occurs
<<<<<<< HEAD
            header('Location: 500');
            exit;
=======
            header("Location: 500");
>>>>>>> debug-branch
        }
    }

    /**
     * Move the uploaded image file to the designated folder.
     *
     * @param array $imageFile the image file information from $_FILES
     *
     * @return string|null the file name of the uploaded image, or null on failure
     */
    private function uploadImage(array $imageFile): ?string
    {
        // Specify the upload directory
        $uploadDirectory = '../mon-blog/public/assets/img/postImg/';

        // Get file information
        $fileTmpName = $imageFile['tmp_name'];
        $fileName = basename($imageFile['name']);
        $fileType = $imageFile['type'];
        $fileSize = $imageFile['size'];
        $fileExtension = strtolower(pathinfo($fileName, \PATHINFO_EXTENSION));

        // Allowed file extensions
        $allowedExtensions = ['jpeg', 'jpg', 'png'];

        // Check if the file extension is allowed
        if (!\in_array($fileExtension, $allowedExtensions, true)) {
            return null; // File extension not allowed
        }

        // Generate a unique file name to avoid overwriting existing files
        $uniqueFileName = uniqid().'_'.$fileName;

        // Move the uploaded file to the designated folder
        $imageFilePath = $uploadDirectory.$uniqueFileName;
        move_uploaded_file($fileTmpName, $imageFilePath);

        return $uniqueFileName;
    }

    /**
     * Update a post in the database.
     *
<<<<<<< HEAD
     * @param $id          the ID of the post to update
     * @param $title       the updated title
     * @param $content     The updated content
     * @param $postImg     The updated image file. Pass null if no update is needed.
     * @param $categoryId  The updated category ID
     * @param $authorRole  The updated author role
     * @param $postPreview The updated post preview
=======
     * @param $id The ID of the post to update.
     * @param $title The updated title.
     * @param $content The updated content.
     * @param $postImg The updated image file. Pass null if no update is needed.
     * @param $categoryId The updated category ID.
     * @param $authorRole The updated author role.
     * @param $postPreview The updated post preview.
>>>>>>> debug-branch
     *
     * @return Post|null the updated Post object or null on failure
     */
    public function updatePost(int $id, string $title, string $content, ?array $postImg, int $categoryId, string $authorRole, string $postPreview): ?Post
    {
        $this->_db->beginTransaction();
<<<<<<< HEAD
        // Get the current date
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Europe/Paris')); // Set the timezone if necessary
        $updatedAt = $date->format('Y-m-d H:i:s');
=======
>>>>>>> debug-branch

        try {
            // Step 1: Check if $postImg is not null before calling uploadImage
            if (null !== $postImg) {
                // Step 1: Move the image to the designated folder
                $imageFileName = $this->uploadImage($postImg);
            } else {
                // Handle the case where $postImg is null (if needed)
                // For example, you might want to keep the existing image or display an error message.
                $imageFileName = null; // Set a default value or handle the null case accordingly
            }

            // Get the current date
            $date = new \DateTime();
            $date->setTimezone(new \DateTimeZone('Europe/Paris')); // Set the timezone if necessary
            $updatedAt = $date->format('Y-m-d H:i:s');

            // Step 2: Update the post in the 'Post' table
            $sql = 'UPDATE Post SET title = ?, content = ?, imageUrl = ?, categoryId = ?, authorRole = ?, updatedAt = ?, postpreview = ? WHERE id = ?';
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
                throw new ActionNotFoundException();
            }

            // Commit the transaction
            $this->_db->commit();

            // Create a new Post object with the updated data
            $post = new Post();
            $post->setId($id);
            $post->setTitle(htmlspecialchars($title));
            $post->setContent(htmlspecialchars($content));
            $post->setImageUrl(htmlspecialchars($imageFileName));
            $post->setCategoryId($categoryId);
            $post->setAuthorRole(htmlspecialchars($authorRole));
            $post->setUpdatedAt(new \DateTime($updatedAt));
            $post->setPostPreview(htmlspecialchars($postPreview));

            return $post;
        } catch (ActionNotFoundException $e) {
            // Handle the error in case of failure and roll back the transaction
            // Redirect to a 500 error page if no matching route is found
            header('Location: 500');
            $this->_db->rollBack();

            return null;
        }
    }

    /**
     * Delete a post from the database by its ID.
     *
     * @param $id The ID of the post to be deleted
     *
     * @return bool true if the post was successfully deleted, false otherwise
     */
    public function deletePost(int $id): bool
    {
        try {
            // Prepare and execute a DELETE SQL query to remove the post by its ID
            $sql = 'DELETE FROM Post WHERE id = ?';
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
