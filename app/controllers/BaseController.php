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
