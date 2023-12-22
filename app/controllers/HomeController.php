<?php

declare(strict_types=1);

namespace App\Controllers;

<<<<<<< HEAD
use App\Manager\CategoryManager;
use App\Manager\PostManager;

=======
>>>>>>> debug-branch
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
     * and displays them in a Twig template.
     */
    public function home(): void
    {
<<<<<<< HEAD
        $posts = $this->getManager(PostManager::class)->getAll();
        $categories = $this->getManager(CategoryManager::class)->getAll();
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();
=======
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();
        
        $this->view("blog/home.html.twig", ['user' => $user]);
    }
>>>>>>> debug-branch

        $this->view('blog/home.html.twig', ['posts' => $posts, 'categories' => $categories, 'user' => $user]);
    }
}
