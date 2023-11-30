<?php
namespace App\Controllers;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\CategoryManager;
use App\Core\Functions\FormHelper;

/**
 * Class PostController
 *
 * Controller responsible for handling post-related actions.
 */
class PostController extends BaseController
{
    /**
     * PostController constructor.
     *
     * @param object $httpRequest The HTTP request object.
     * @param object $config      The application configuration.
     */
    public function __construct(object $httpRequest, object $config)
    {
        parent::__construct($httpRequest, $config);
    }

    /**
     * Display a list of all articles.
     */
    public function listPosts(): void
    {
        $posts  = $this->getManager(PostManager::class)->getAll();
        $categories = $this->getManager(CategoryManager::class)->getAll();

        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        $this->view('blog/posts.html.twig', ['posts' => $posts, 'categories' => $categories, 'user' => $user]);
    }

    /**
     * Display a specific article based on its identifier.
     *
     * @param $id The identifier of the article to display.
     */
    public function showPostWithComments(int $id): void
    {
        // Retrieve post, comments, and user information as needed
        $post = $this->getManager(PostManager::class)->getById($id);

        if (!$post) {
            // Handle the case where the article does not exist (e.g., redirect, display an error, etc.)
            header("Location: /mon-blog/404");
            exit; // Stop execution to prevent displaying page content
        }

        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        $comments = $this->getManager(CommentManager::class)->getCommentsByPostId($id);

        $this->view('blog/post.html.twig', ['post' => $post, 'comments' => $comments, 'user' => $user]);
    }

    /**
     * Add a comment to a post and display the post with comments.
     *
     * @param int $postId The ID of the post to add a comment to.
     *
     * @return void
     */
    public function addPostComment(int $postId): void
    {
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        // Retrieve data from the form
        $content  = htmlspecialchars(FormHelper::post('content'));
        $authorName = $user->getUserName();

        // Create a new comment
        $this->getManager(CommentManager::class)->createComment($content, $authorName, $postId);

        // Get all comments for the current post
        $comments = $this->getManager(CommentManager::class)->getCommentsByPostId($postId);

        // Retrieve post, comments, and user information as needed
        $post = $this->getManager(PostManager::class)->getById($postId);

        // Get the number of all comment for a spécific Post
        // $commentNumber = $this->getManager(CommentManager::class)->getTotalCommentsForPost($postId);

        // Display the post with comments
        $this->view('blog/post.html.twig', [
            'post'          => $post,
            'comments'      => $comments,
            // 'commentNumber' => $commentNumber,
            'user'          => $user
        ]);
    }

}
