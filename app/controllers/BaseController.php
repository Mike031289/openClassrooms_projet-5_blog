<?php

namespace App\Controllers;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;

class BaseController
{
    private $_param;
    private $_httpRequest;
    private $_twig;
    private $_config;
    protected $_managers = [];

    public function __construct($httpRequest, $config){
        $this->_httpRequest = $httpRequest;
        $this->_config = $config;
        $_loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->_twig = new Environment($_loader);
        $this->bindManager();

        // Ajouter la fonction path à l'environnement Twig
        // $this->_twig->addFunction(new TwigFunction('path', function ($routeName, $parameters = []) {
        //     $path = '';
        //     // Associer le nom de la route à l'URL correspondante
        //     switch ($routeName) {
        //         case 'home':
        //             $path = '/';
        //             break;
        //         case 'listPosts':
        //             $path = '/posts';
        //             break;
        //         case 'showPost':
        //             // Vérifier si l'ID est fourni dans les paramètres
        //             if (isset($parameters['id'])) {
        //                 $path = '/post/' . $parameters['id'];
        //             }
        //             break;
        //         // Ajouter d'autres cas pour les autres routes
        //         default:
        //             // Gérer les cas inconnus
        //             break;
        //     }
        //     return $path;
        // }));
    }

    // ... Autres méthodes ...

    protected function view($fileName, $viewContent = [])
    {
        ob_start();
        extract($this->_param);
        $content = ob_get_clean();
        echo $this->_twig->render($fileName, $viewContent);
    }

    private function bindManager()
    {
        foreach($this->_httpRequest->getRoute()->getManagers() as $manager)
        {
            $this->_managers[$manager] = new $manager($this->_config->database);
        }
    }

    protected function getManager(string $className){
        return $this->_managers[$className];
    }
}
