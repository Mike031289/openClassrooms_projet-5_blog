<?php
namespace App\Controllers;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\CategoryManager;

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
        session_start();
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

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
        session_start();
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        $comments = $this->getManager(CommentManager::class)->getCommentsByPostId($id);

        $this->view('blog/post.html.twig', ['post' => $post, 'comments' => $comments, 'user' => $user]);
    }

}
