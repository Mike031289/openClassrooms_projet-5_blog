<?php
namespace App\Controllers;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\CategoryManager;
use App\Manager\UserManager;


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
    // public function listPosts(): void
    // {
    //     $posts  = $this->getManager(PostManager::class)->getAll();
    //     $categories = $this->getManager(CategoryManager::class)->getAll();

    //     // Check if the user is logged in and pass the user information to the template
    //       session_start();
    //     $email = $_SESSION['userEmail'] ?? null;
    //     $user = null;
    //     if($email !== null){
    //         $user = $this->getManager(UserManager::class)->getUserByEmail($email);
    //     }

    //     $this->view('blog/posts.html.twig', ['posts' => $posts, 'categories' => $categories, 'user' => $user]);
    // }

    public function listPosts(): void
    {
        // Paramètres de pagination
        $page     = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $pageSize = 10; // Nombre d'articles par page

        // Récupérer les articles paginés
        $posts      = $this->getManager(PostManager::class)->getPaginatedPosts($page, $pageSize);
        $categories = $this->getManager(CategoryManager::class)->getAll();

        // Check if the user is logged in and pass the user information to the template
        session_start();
        $email = $_SESSION['userEmail'] ?? null;
        $user  = null;
        if ($email !== null) {
            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
        }

        // Passer les données à la vue Twig
        $this->view('blog/posts.html.twig', ['posts' => $posts, 'categories' => $categories, 'user' => $user, 'page' => $page]);

        // ...
    }

    /**
     * Display a specific article based on its identifier.
     *
     * @param $id The identifier of the article to display.
     */
    // public function showPostWithComments(int $id): void
    // {
    //     // Retrieve post, comments, and user information as needed
    //     $post = $this->getManager(PostManager::class)->getById($id);

    //     if (!$post) {
    //         // Handle the case where the article does not exist (e.g., redirect, display an error, etc.)
    //         header("Location: /mon-blog/404");
    //         exit; // Stop execution to prevent displaying page content
    //     }

    //     // Check if the user is logged in and pass the user information to the template
    //     $user = $this->session->getUser();

    //     $comments = $this->getManager(CommentManager::class)->getCommentsByPostId($id);

    //     $this->view('blog/post.html.twig', ['post' => $post, 'comments' => $comments, 'user' => $user]);
    // }

    public function showPostWithComments(int $id): void
    {
        // ...

        // Paramètres de pagination
        $page     = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $pageSize = 10; // Nombre de commentaires par page

        // Récupérer les commentaires paginés
        $comments = $this->getManager(CommentManager::class)->getCommentsByPostId($id, $page, $pageSize);

        // Passer les données à la vue Twig
        $this->view('blog/post.html.twig', ['post' => $post, 'comments' => $comments, 'user' => $user, 'page' => $page]);

        // ...
    }

}
