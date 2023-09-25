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
    public function notFound(): void
    {
        $this->view('errors/404.html.twig');
    }
}
