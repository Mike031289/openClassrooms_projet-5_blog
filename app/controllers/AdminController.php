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
        /**
         * Handle Admin Dashboard.
         */
        $posts      = $this->getManager(PostManager::class)->getAll();
        $categories = $this->getManager(CategoryManager::class)->getAll();

        // Check if the user is logged in and pass the user information to the template
        session_start();
        $email = $_SESSION['userEmail'] ?? null;
        $user  = null;
        if ($email !== null) {
            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
        }

        $this->view('admin/dashboard.html.twig', ['posts' => $posts, 'categories' => $categories, 'user' => $user]);
    }
}
