<?php

declare(strict_types=1);

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use App\Manager\UserManager;
use App\Core\HttpRequest;
use App\Core\Session;
use Twig\Environment;

/**
 * Class BaseController
 *
 * Base controller for handling common functionality in controllers.
 */
class BaseController
{
    protected HttpRequest $httpRequest;
    protected array $_managers = [];
    private array $_param = [];
    private Environment $_twig;
    protected Session $session;
    private object $config;

    /**
     * BaseController constructor.
     *
     * @param HttpRequest $httpRequest the HTTP request object
     * @param object $config      the application configuration object (JSON decode Object)
     */
    public function __construct(HttpRequest $httpRequest, object $config)
    {
        $this->httpRequest = $httpRequest;
        $this->config      = $config;
        $loader            = new FilesystemLoader(__DIR__ . '/../Views');
        $this->_twig       = new Environment($loader);
        $this->bindManager();
        $this->session = new Session(new UserManager($this->config->database ?? null)); // Initialize the session manager
    }

    /**
     * Render a view.
     *
     * @param string $fileName    the name of the Twig template file
     * @param array<mixed> $viewContent an associative array of data to pass to the view
     */
    protected function view(string $fileName, array $viewContent = []): void
    {
        ob_start();
        extract($this->_param);
        ob_get_clean();
        echo $this->_twig->render($fileName, $viewContent);
        exit;
    }

    /**
     * Bind managers based on the route configuration.
     */
    private function bindManager(): void
    {
        $route = $this->httpRequest->getRoute();
        if ($route) {
            foreach ($route->getManagers() as $manager) {
                $this->_managers[$manager] = new $manager($this->config->database ?? null);
            }
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
        return $this->_managers[$className] ?? null;
    }
}
