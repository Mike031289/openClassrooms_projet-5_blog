<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Class HttpRequest
 *
 * Represents an HTTP request in your application.
 */
class HttpRequest
{
    private string $_url;
    private string $_method;
    private mixed $_param = [];
    private ?Route $_route = null;

    /**
     * HttpRequest constructor.
     *
     * Initializes the HttpRequest object with the current URL and request method.
     */
    public function __construct()
    {
        $this->_url    = $_SERVER['REQUEST_URI'];
        $this->_method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get the value of _url.
     *
     * @return string The current URL of the HTTP request.
     */
    public function getUrl(): string
    {
        return $this->_url;
    }

    /**
     * Get the value of _method.
     *
     * @return string The HTTP request method (GET, POST, etc.).
     */
    public function getMethod(): string
    {
        return $this->_method;
    }

    /**
     * Get the value of _param.
     *
     * @return array<mixed> An array containing the parameters extracted from the HTTP request.
     */
    public function getParam(): array
    {
        return $this->_param;
    }

    /**
     * Get the value of _route.
     *
     * @return Route|null The matched Route object or null if no route is set.
     */
    public function getRoute(): ?Route
    {
        return $this->_route;
    }

    /**
     * Set the value of _route.
     *
     * @param Route|null $_route The Route object to set for the HTTP request.
     * @return self
     */
    public function setRoute(?Route $_route): self
    {
        $this->_route = $_route;

        return $this;
    }

    /**
     * Bind parameters from the HTTP request to the route.
     *
     * Depending on the HTTP request method, extracts parameters from the URL or form data
     * and binds them to the associated Route object.
     */
    public function bindParam(): void
    {
        switch ($this->_method) {
            case 'GET':
            case 'DELETE':
                // Check if a route is set before trying to access its path
                if ($this->_route && $this->_url && preg_match('#' . $this->_route->getPath() . '#', $this->_url, $matches)) {
                    // Pre-calculate the pattern outside the loop
                    $pattern = '#' . $this->_route->getPath() . '#';

                    for ($i = 1; 
                        $i < count($matches); 
                        ++$i) {
                        $this->_param[] = $matches[$i];
                    }
                }
                break;
            case 'POST':
            case 'PUT':
                // Check if a route is set before trying to access its parameters
                if ($this->_route) {
                    foreach ($this->_route->getParam() as $param) {
                        if (isset($_POST[$param])) {
                            $this->_param[] = $_POST[$param];
                        }
                    }
                }
                break;
        }
    }

    /**
     * Run the route processing configuration settings.
     *
     * @param object $config The application configuration.
     */
    public function run(object $config): void
    {
        if ($this->_route) {
            // Execute the associated controller action for the matched route
            $this->_route->run($this, $config);
        }
    }

}
