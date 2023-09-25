<?php
namespace App\Controllers;

use App\Manager\PostManager;
use App\Manager\CommentManager;

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
     * @param mixed $config      The application configuration.
     */
    public function __construct($httpRequest, $config)
    {
        parent::__construct($httpRequest, $config);
    }

    /**
     * Display a list of all articles.
     */
    public function listPosts(): void
    {
        $posts  = $this->getManager(PostManager::class)->getAll();

        $this->view('blog/posts.html.twig', ['posts' => $posts]);
    }

    /**
     * Display a specific article based on its identifier.
     *
     * @param int $id The identifier of the article to display.
     */
    public function showPostWithComments(int $id): void
    {
        $post = $this->getManager(PostManager::class)->getById($id);

        if (!$post) {
            // Handle the case where the article does not exist (e.g., redirect, display an error, etc.)
            header("Location: /mon-blog/404");
            exit; // Stop execution to prevent displaying page content
        }

        $comments = $this->getManager(CommentManager::class)->getCommentsByPostId($id);

        $this->view('blog/post.html.twig', ['post' => $post, 'comments' => $comments]);
    }
}
