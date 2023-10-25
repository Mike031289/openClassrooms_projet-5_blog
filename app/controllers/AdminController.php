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

    // Ajoutez ici les actions spécifiques à l'administrateur
    // Par exemple, si AdminController a une action "adminDashboard", vous pouvez l'ajouter ici.
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


}
