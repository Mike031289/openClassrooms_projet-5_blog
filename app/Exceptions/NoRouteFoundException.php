<?php
namespace App\Exceptions;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Exception;
use App\Controllers\BaseController;

class NoRouteFoundException extends Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message, "404");
        
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $twig = new Environment($loader);
        
        // Rendre le modèle Twig avec les données
        echo $twig->render('errors/404.html.twig', ['errorMessage' => $message]);
    }
}