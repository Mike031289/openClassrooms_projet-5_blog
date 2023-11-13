<?php
namespace App\Controllers;

use App\Manager\UserManager;
use App\Manager\AdminManager;
use App\Core\Functions\FormHelper;
use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\CategoryManager;

/**
 * Class AdminController
 *
 * Controller responsible for handling admin-related actions.
 */

class AdminController extends BaseController
{
    public function __construct(object $httpRequest, object $config)
    {
        parent::__construct($httpRequest, $config);
    }

    // Add administrathor-specific actions here
    // For example, if AdminController has an "adminDashboard" action, you can add it here.
    public function adminDashboard(): void
    {
        // Start the session
        session_start();

        // Check if the user is not logged in, redirect to the login page
        if (!isset($_SESSION['userEmail'])) {
            header('Location: login');
            exit;
        }

        // Check if the user does not have the 'Admin' role, redirect to a restricted page
        if ($_SESSION['userRole'] !== 'Admin') {
            header('Location: login'); // Replace 'restricted-page' with the actual URL
            exit;
        }

        // User is logged in and has the 'Admin' role, proceed to the admin dashboard
        $posts      = $this->getManager(PostManager::class)->getAll();
        $categories = $this->getManager(CategoryManager::class)->getAll();

        // Retrieve user information from the session
        $email = $_SESSION['userEmail'] ?? null;
        $user  = null;
        if ($email !== null) {
            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
        }

        // Render the admin dashboard view
        $this->view('admin/dashboard.html.twig', ['posts' => $posts, 'categories' => $categories, 'user' => $user]);
    }

    public function postForm(): void
    {
        // Start the session
        session_start();

        // Check if the user is not logged in, redirect to the login page
        if (!isset($_SESSION['userEmail'])) {
            header('Location: login');
            exit;
        }

        // Check if the user does not have the 'Admin' role, redirect to a restricted page
        if ($_SESSION['userRole'] !== 'Admin') {
            header('Location: login'); // Replace 'restricted-page' with the actual URL
            exit;
        }

        // User is logged in and has the 'Admin' role, proceed to the admin dashboard
        // $posts      = $this->getManager(PostManager::class)->getAll();
        $categories = $this->getManager(CategoryManager::class)->getAll();

        // Retrieve user information from the session
        $email = $_SESSION['userEmail'] ?? null;
        $user  = null;
        if ($email !== null) {
            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
        }
        $this->view('admin/blog-management-create-post.html.twig', ['categories' => $categories, 'user' => $user]);
    }

    public function creatPost(): void
    {
        // Retrieve data from the form
        $title       = FormHelper::post('title');
        $content     = FormHelper::post('content');
        $postImg     = FormHelper::files('postImage');
        $categoryId  = FormHelper::post('category');
        $postPreview = FormHelper::post('postPreview');

        // Start the session
        session_start();

        // Check if the user is not logged in, redirect to the login page
        if (!isset($_SESSION['userEmail'])) {
            header('Location: login');
            exit;
        }

        // Check if the user does not have the 'Admin' role, redirect to a restricted page
        if ($_SESSION['userRole'] !== 'Admin') {
            header('Location: login'); // Replace 'restricted-page' with the actual URL
            exit;
        }

        // Retrieve user information from the session
        $email = $_SESSION['userEmail'] ?? null;
        $user  = null;
        if ($email !== null) {
            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
        }
            $authorRole = $this->getManager(UserManager::class)->getAuthorRoleById($user->getId());
            $this->getManager(PostManager::class)->createNewPost($title, $content, $postImg, $categoryId, $authorRole, $postPreview);

            $success = "Poste ajouté avec succès";

            $this->view('admin/blog-management-create-post.html.twig', ['user' => $user, 'success' => $success]);
            exit;

    }

    /**
     * Edit a post with the specified ID.
     *
     * @param $id The ID of the post to edit.
     */
    public function editPost(int $id): void
    {
        // Start the session
        session_start();

        // Check if the user is not logged in, redirect to the login page
        if (!isset($_SESSION['userEmail'])) {
            header('Location: login');
            exit;
        }

        // Check if the user does not have the 'Admin' role, redirect to a restricted page
        if ($_SESSION['userRole'] !== 'Admin') {
            header('Location: login'); // Replace 'restricted-page' with the actual URL
            exit;
        }

        // User is logged in and has the 'Admin' role, proceed to the admin dashboard
        // Retrieve post, comments, and user information as needed
        $post = $this->getManager(PostManager::class)->getById($id);

        $categories = $this->getManager(CategoryManager::class)->getAll();

        // Retrieve user information from the session
        $email = $_SESSION['userEmail'] ?? null;
        $user  = null;
        if ($email !== null) {
            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
        }

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

        // Start the session
        session_start();

        // Check if the user is not logged in, redirect to the login page
        if (!isset($_SESSION['userEmail'])) {
            header('Location: login');
            exit;
        }

        // Check if the user does not have the 'Admin' role, redirect to a restricted page
        if ($_SESSION['userRole'] !== 'Admin') {
            header('Location: login'); // Replace 'restricted-page' with the actual URL
            exit;
        }

        // Retrieve user information from the session
        $email = $_SESSION['userEmail'] ?? null;
        $user  = null;
        if ($email !== null) {
            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
        }
        $authorRole = $this->getManager(UserManager::class)->getAuthorRoleById($user->getId());
        $this->getManager(PostManager::class)->updatePost($id, $title, $content, $postImg, $categoryId, $authorRole, $postPreview);
        $success = "Poste Modifié avec succès !";
        $this->view('admin/blog-management-edit-post.html.twig', ['user' => $user, 'success' => $success]);
    }



}
