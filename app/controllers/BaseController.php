<?php

declare(strict_types=1);

namespace App\Controllers;

<<<<<<< HEAD
=======
use App\Manager\UserManager;
use LDAP\Result;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Core\Session;
>>>>>>> debug-branch
use App\Core\HttpRequest;
use App\Core\Session;
use App\Manager\UserManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class BaseController
 *
 * Base controller for handling common functionality in controllers.
 */
class BaseController
{
    private array $_param = [];
    protected HttpRequest $httpRequest;
    private Environment $_twig;
    private object $config;
    protected array $_managers = [];

    protected Session $session;

    // Declare a property for SessionManager
    // private object $sessionManager;

    /**
     * BaseController constructor.
     *
     * @param object $httpRequest the HTTP request object
     * @param object $config      the application configuration object (JSON decode Object)
     */
    public function __construct(HttpRequest $httpRequest, object $config)
    {
        $this->httpRequest = $httpRequest;
        $this->config = $config;
        $loader = new FilesystemLoader(__DIR__.'/../Views');
        $this->_twig = new Environment($loader);
        $this->bindManager();
        $this->session = new Session(new UserManager($config->database)); // Initialize the session manager
    }

    /**
     * Render a view.
     *
     * @param string $fileName    the name of the Twig template file
     * @param array  $viewContent an associative array of data to pass to the view
     */
    protected function view(string $fileName, array $viewContent = []): void
    {
        ob_start();
        extract($this->_param);
        ob_get_clean();
        echo $this->_twig->render($fileName, $viewContent);
<<<<<<< HEAD
        exit;
=======
        exit ;
>>>>>>> debug-branch
    }

    /**
     * Bind managers based on the route configuration.
     */
    private function bindManager(): void
    {
        foreach ($this->httpRequest->getRoute()->getManagers() as $manager) {
            $this->_managers[$manager] = new $manager($this->config->database);
        }
    }

    /**
     * Get a manager instance.
     *
     * @param string $className the class name of the manager
     *
     * @return mixed the manager instance
     */
    protected function getManager(string $className)
    {
        return $this->_managers[$className];
    }
}
