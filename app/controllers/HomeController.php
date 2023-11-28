<?php
namespace App\Controllers;

use App\Manager\PostManager;
use App\Manager\CategoryManager;

/**
 * Class HomeController
 *
 * Controller responsible for handling home-related actions.
 */
class HomeController extends BaseController
{
    /**
     * Display the home page.
     *
     * Uses the getAll() function of the PostManager class to retrieve the list of all posts
     * and displays them in a Twig template.
     */
    public function home(): void
    {
        $posts      = $this->getManager(PostManager::class)->getAll();
        $categories = $this->getManager(CategoryManager::class)->getAll();
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();
        
        $this->view("blog/home.html.twig", ['posts' => $posts, 'categories' => $categories, 'user' => $user]);
    }

}