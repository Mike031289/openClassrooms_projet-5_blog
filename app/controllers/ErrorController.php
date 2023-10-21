<?php
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
        $this->view('errors/404.html.twig');
    }

    /**
     * Display a 500 error page.
     */
    public function actionNotFound(): void
    {
        $this->view('errors/500.html.twig');
    }
}
