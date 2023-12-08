<?php
namespace App\Controllers;

use App\Manager\UserManager;
use App\Manager\ContactManager;
use App\Core\Functions\FormHelper;
use App\Manager\PostManager;
use App\Manager\CategoryManager;
use App\Manager\CommentManager;

/**
 * Class AdminController
 *
 * Controller responsible for handling admin-related actions.
 */

class AdminController extends BaseController
{
    /**
     * Constructor for AdminController.
     *
     * @param $httpRequest The HTTP request object.
     * @param $config The configuration object.
     */
    public function __construct(object $httpRequest, object $config)
    {
        parent::__construct($httpRequest, $config);
    }

    /**
     * Admin dashboard action.
     *
     * @return void
     */
    public function adminDashboard(): void
    {
        // Retrieve User from the session
        $user = $this->session->getUser();

        // Retrieve User Role from the session
        $userRole = $this->session->getUserRole();

        // Check if the user is not logged in, or the user does not have the 'Admin' role, redirect to the login page
        if ((!$user) || ($userRole !== 'Admin')) {
            header('Location: login');
            exit;
        }

        // User is logged in and has the 'Admin' role, proceed to the admin dashboard
        $posts      = $this->getManager(PostManager::class)->getAll();
        $categories = $this->getManager(CategoryManager::class)->getAll();

        // Render the admin dashboard view
        $this->view('admin/dashboard.html.twig', ['posts' => $posts, 'categories' => $categories, 'user' => $user]);
    }

    /**
     * Post form action.
     *
     * @return void
     */
    public function postForm(): void
    {
        // Retrieve User from the session
        $user = $this->session->getUser();

        // Retrieve User Role from the session
        $userRole = $this->session->getUserRole();

        // Check if the user is not logged in, or the user does not have the 'Admin' role, redirect to the login page
        if ((!$user) || ($userRole !== 'Admin')) {
            header('Location: login');
            exit;
        }

        // User is logged in and has the 'Admin' role, proceed to the post form
        $categories = $this->getManager(CategoryManager::class)->getAll();

        $this->view('admin/blog-management-create-post.html.twig', ['categories' => $categories, 'user' => $user]);
    }

    /**
     * Create post action.
     *
     * @return void
     */
    public function createPost(): void
    {
        // Retrieve data from the form
        $title       = htmlspecialchars(FormHelper::post('title'));
        $content     = htmlspecialchars(FormHelper::post('content'));
        $postImg     = FormHelper::files('postImage');
        $categoryId  = htmlspecialchars(FormHelper::post('category'));
        $postPreview = htmlspecialchars(FormHelper::post('postPreview'));


        // Retrieve User from the session
        $user = $this->session->getUser();

        // Retrieve User Role from the session
        $userRole = $this->session->getUserRole();

        // Check if the user is not logged in, or the user does not have the 'Admin' role, redirect to the login page
        if ((!$user) || ($userRole !== 'Admin')) {
            header('Location: login');
            exit;
        }

        // User is logged in and has the 'Admin' role, proceed to create the new post
        $authorRole = $this->getManager(UserManager::class)->getAuthorRoleById($user->getId());
        $this->getManager(PostManager::class)->createNewPost($title, $content, $postImg, $categoryId, $authorRole, $postPreview);

        $success = "Merci, l'ajout du Poste Réussi !";

        $this->view('admin/blog-management-create-post.html.twig', ['user' => $user, 'success' => $success]);
    }

    /**
     * Edit a post with the specified ID.
     *
     * @param $id The ID of the post to edit.
     */
    public function editPost(int $id): void
    {
        // Retrieve User from the session
        $user = $this->session->getUser();

        // Retrive User Role frome the session
        $userRole = $this->session->getUserRole();

        // Check if the user is not logged in, or the user does not have the 'Admin' role redirect to the login page
        if ((!$user) || ($userRole !== 'Admin')) {
            header('Location: login');
            exit;
        }

        // User is logged in and has the 'Admin' role, proceed to the admin dashboard
        // Retrieve post, comments, and user information as needed
        $post = $this->getManager(PostManager::class)->getById($id);

        $categories = $this->getManager(CategoryManager::class)->getAll();

        $this->view('admin/blog-management-edit-post.html.twig', ['post' => $post, 'categories' => $categories, 'user' => $user]);
    }

    /**
     * Edit a post with the specified ID.
     *
     * @param $id The ID of the post to edit.
     */
    public function updatePost(int $id): void
    {
        // Retrieve data from the form
        $title       = FormHelper::post('title');
        $content     = FormHelper::post('content');
        $postImg     = FormHelper::files('postImage');
        $categoryId  = FormHelper::post('category');
        $postPreview = FormHelper::post('postPreview');

        // Retrieve User from the session
        $user = $this->session->getUser();

        // Retrive User Role frome the session
        $userRole = $this->session->getUserRole();

        // Check if the user is not logged in, or the user does not have the 'Admin' role redirect to the login page
        if ((!$user) || ($userRole !== 'Admin')) {
            header('Location: login');
            exit;
        }

        $authorRole = $this->getManager(UserManager::class)->getAuthorRoleById($user->getId());
        $this->getManager(PostManager::class)->updatePost($id, $title, $content, $postImg, $categoryId, $authorRole, $postPreview);
        $success = "Poste Modifié avec succès !";
        $this->view('admin/blog-management-edit-post.html.twig', ['user' => $user, 'success' => $success]);
    }

    /**
     * getin a post for Deletion with the specified ID.
     *
     * @param $id The ID of the post to delete.
     */
    public function showPostToDelete(int $id): void
    {
        // Retrieve User from the session
        $user = $this->session->getUser();

        // Retrive User Role frome the session
        $userRole = $this->session->getUserRole();

        // Check if the user is not logged in, or the user does not have the 'Admin' role redirect to the login page
        if ((!$user) || ($userRole !== 'Admin')) {
            header('Location: login');
            exit;
        }

        // User is logged in and has the 'Admin' role, proceed to the admin dashboard
        // Retrieve post, comments, and user information as needed
        $post = $this->getManager(PostManager::class)->getById($id);

        $categories = $this->getManager(CategoryManager::class)->getAll();

        $this->view('admin/dashboard-delete-post.html.twig', ['post' => $post, 'categories' => $categories, 'user' => $user]);
    }

    /**
     * Delete a post with the specified ID.
     *
     * @param $id The ID of the post to delete.
     */
    public function deletePost(int $id): void
    {
        // Retrieve User from the session
        $user = $this->session->getUser();

        // Retrive User Role frome the session
        $userRole = $this->session->getUserRole();

        // Check if the user is not logged in, or the user does not have the 'Admin' role redirect to the login page
        if ((!$user) || ($userRole !== 'Admin')) {
            header('Location: login');
            exit;
        }

        $this->getManager(PostManager::class)->deletePost($id);
        $success = "Poste supprimé avec succès !";
        $this->view('admin/dashboard-delete-post.html.twig', ['user' => $user, 'success' => $success]);
    }

    /**
     * Displays a paginated list of contacts for the admin.
     *
     * @param $page The current page number (default is 1).
     *
     * @return void
     */
    public function showContacts(int $page = 1): void
    {
        // Retrieve User from the session
        $user = $this->session->getUser();

        // Retrieve User Role from the session
        $userRole = $this->session->getUserRole();

        // Check if the user is not logged in, or the user does not have the 'Admin' role redirect to the login page
        if ((!$user) || ($userRole !== 'Admin')) {
            header('Location: login');
            exit;
        }

        $perPage = 3;  // Set your desired items per page

        // Use the getContacts method of ContactManager to retrieve contacts in the admin side
        $paginationData = $this->getManager(ContactManager::class)->getPaginatedContacts($page, $perPage);

        // Pass the pagination data to the Twig template
        $this->view("admin/contacts.html.twig", [
            'user'        => $user,
            'contacts'    => $paginationData['contacts'],
            'currentPage' => $paginationData['currentPage'],
            'totalPages'  => $paginationData['totalPages'],
        ]);
    }

    public function listComments(int $page = 1): void
    {
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        // Retrieve User Role from the session
        $userRole = $this->session->getUserRole();

        // Check if the user is not logged in, or the user does not have the 'Admin' role redirect to the login page
        if ((!$user) || ($userRole !== 'Admin')) {
            header('Location: login');
            exit;
        }

        $perPage = 3;  // Set your desired items per page

        // Use the getComment method of CommentManager to retrieve coments in the admin side
        $paginationData = $this->getManager(CommentManager::class)->getPaginatedComments($page, $perPage);

        // Pass the pagination data to the Twig template
        $this->view("admin/comments.html.twig", [
            'user'        => $user,
            'comments'    => $paginationData['comments'],
            'currentPage' => $paginationData['currentPage'],
            'totalPages'  => $paginationData['totalPages'],
        ]);

    }

    /**
     * Delete a comment with the specified ID.
     *
     * @param $id The ID of the comment to delete.
     */
    public function deleteComment(int $id): void
    {
        // Retrieve User from the session
        $user = $this->session->getUser();

        // Retrive User Role frome the session
        $userRole = $this->session->getUserRole();

        // Check if the user is not logged in, or the user does not have the 'Admin' role redirect to the login page
        if ((!$user) || ($userRole !== 'Admin')) {
            header('Location: login');
            exit;
        }

        $this->getManager(CommentManager::class)->deleteComment($id);
        $success = "Commentaire retiré avec succès !";

        $this->view("admin/comments.html.twig", [ 'user' => $user, 'success'=> $success
        ]);
    }



}
