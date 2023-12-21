<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 * Class ErrorController
 *
 * Controller responsible for handling error-related actions.
 */
class ErrorController extends BaseController
{
    /**
     * Display a 404 error page.
     */
    public function routeNotFound(): void
    {
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        $this->view('errors/404.html.twig', ['user' => $user]);
    }

    /**
     * Display a 500 error page.
     */
    public function actionNotFound(): void
    {
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();
        $this->view('errors/500.html.twig', ['user' => $user]);
    }
}
