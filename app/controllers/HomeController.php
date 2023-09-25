<?php
namespace App\Controllers;

use App\Manager\PostManager;

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
			$posts = $this->getManager(PostManager::class)->getAll();
			
			$this->view("blog/home.html.twig", ['posts' => $posts]);
    }
}






