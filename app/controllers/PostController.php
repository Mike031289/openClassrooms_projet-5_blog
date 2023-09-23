<?php
namespace App\Controllers;

use App\Manager\PostManager;
use App\Manager\CommentManager;

class PostController extends BaseController
{
    public function __construct($httpRequest, $config)
    {
        parent::__construct($httpRequest, $config);
    }

    /**
     * Display a list of all articles.
     */
    public function listPosts()
    {
        // Retrieve all articles using the article manager (PostManager)
        $posts = $this->getManager(PostManager::class)->getAll();

        // Pass the article information to your Twig view for display
        $this->view('blog/posts.html.twig', ['posts' => $posts]);
    }

    /**
     * Display a specific article based on its identifier.
     * @param int $id The identifier of the article to display.
     */
    public function showPostWithComments($id)
    {
        // Use the identifier to retrieve article information from your article manager (PostManager)
        $post = $this->getManager(PostManager::class)->getById($id);

        // var_dump($post);
        if (!$post) {
            // Handle the case where the article does not exist (e.g., redirect, display an error, etc.)
            header("Location: /mon-blog/404");
            exit; // Stop execution to prevent displaying page content
        }

        // Utilize the CommentManager to retrieve comments related to the specified article
        $comments = $this->getManager(CommentManager::class)->getCommentsByPostId($id);

        // Pass the article and comments information to your Twig view for display
        $this->view('blog/post.html.twig', ['post' => $post, 'comments' => $comments]);
    }

}
