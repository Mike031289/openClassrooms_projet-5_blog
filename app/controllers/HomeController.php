<?php
namespace App\Controllers;

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
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();
        
        $this->view("blog/home.html.twig", ['user' => $user]);
    }

}