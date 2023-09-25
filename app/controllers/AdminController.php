<?php
namespace App\Controllers;

use App\Manager\AdminManager;

/**
 * Class AdminController
 *
 * Controller responsible for handling admin-related actions.
 */
class AdminController extends BaseController
{
    /**
     * Display the admin dashboard.
     *
     * Uses the getAll() function of the AdminManager class to retrieve the list of all posts
     * and displays them in a Twig template.
     */
    public function admin(): void
    {
        /** @var AdminManager $adminManager */
        $adminManager = $this->getManager(AdminManager::class);
        $admin = $adminManager->getAll();
        
        $this->view("admin/adminDashboard.html.twig", ['admin' => $admin]);
    }
}
