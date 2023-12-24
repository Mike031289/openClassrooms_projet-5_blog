<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Functions\FormHelper;
use App\Manager\CategoryManager;
use App\Manager\CommentManager;
use App\Manager\PostManager;

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
     * @param object $httpRequest the HTTP request object
     * @param object $config      the application configuration
     */
    public function __construct(object $httpRequest, object $config)
    {
        parent::__construct($httpRequest, $config);
    }

    /**
     * Display a list of all articles.
     */
    public function listPosts(int $page = 1): void
    {
        // Ensure that $page is an integer
        $page = (int) $page;

        $pageSize = 3; // Set your desired items per page

        $paginationData = $this->getManager(PostManager::class)->getPaginatedPosts($page, $pageSize);

        $categories = $this->getManager(CategoryManager::class)->getAll();

        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        // Pass the pagination data to the Twig template
        $this->view('blog/posts.html.twig', [
            'user'        => $user,
            'categories'  => $categories,
            'posts'       => $paginationData['posts'],
            'currentPage' => $paginationData['currentPage'],
            'totalPages'  => $paginationData['totalPages'],
        ]);
    }

    public function listPostsByCategory(int $categoryId, int $page = 1): void
    {
        $pageSize = 30; // Set your desired items per page

        $paginationData = $this->getManager(PostManager::class)->getPaginatedPostsByCategory($categoryId, $page, $pageSize);

        // Retrieve posts by category, and user information as needed
        $categories = $this->getManager(CategoryManager::class)->getAll();

        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        // Pass the pagination data to the Twig template
        $this->view('blog/posts-by-category.html.twig', [
            'user'        => $user,
            'categories'  => $categories,
            'posts'       => $paginationData['posts'],
            'currentPage' => $paginationData['currentPage'],
            'totalPages'  => $paginationData['totalPages'],
        ]);
    }

    /**
     * Display a specific article based on its identifier.
     *
     * @param $id The identifier of the article to display
     */
    public function showPostWithComments(int $id): void
    {
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        // Retrieve post, comments, and user information as needed
        $post = $this->getManager(PostManager::class)->getPostById($id);

        if (!$post) {
            // Handle the case where the article does not exist (e.g., redirect, display an error, etc.)

            header("Location: 404");
        }

        $comments = $this->getManager(CommentManager::class)->getCommentsByPostId($id);

        $this->view('blog/post.html.twig', ['post' => $post, 'comments' => $comments, 'user' => $user]);
    }

    /**
     * Add a comment to a post and display the post with comments.
     *
     * @param int $postId the ID of the post to add a comment to
     */
    public function addPostComment(int $postId): void
    {
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        // Retrieve data from the form
        $content = FormHelper::post('content');
        $authorName = $user->getUserName();

        // Create a new comment
        $this->getManager(CommentManager::class)->createComment($content, $authorName, $postId);

        // Get all comments for the current post
        $comments = $this->getManager(CommentManager::class)->getCommentsByPostId($postId);

        // Retrieve post, comments, and user information as needed
        $post = $this->getManager(PostManager::class)->getPostById($postId);

        // Display the post with comments
        $this->view('blog/post.html.twig', [
            'post'          => $post,
            'comments'      => $comments,
            'user'          => $user,
        ]);
    }
}
