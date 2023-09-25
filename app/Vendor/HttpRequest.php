<?php
namespace App\Vendor;

/**
 * Class HttpRequest
 *
 * Represents an HTTP request in your application.
 */
class HttpRequest
{
    private string $_url;
    private string $_method;
    private array $_param = [];
    private ?Route $_route = null;

    /**
     * HttpRequest constructor.
     */
    public function __construct()
    {
        $this->_url = $_SERVER['REQUEST_URI'];
        $this->_method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get the value of _url.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->_url;
    }

    /**
     * Get the value of _method.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->_method;
    }

    /**
     * Get the value of _param.
     *
     * @return array
     */
    public function getParam(): array
    {
        return $this->_param;
    }

    /**
     * Get the value of _route.
     *
     * @return Route|null
     */
    public function getRoute(): ?Route
    {
        return $this->_route;
    }

    /**
     * Set the value of _route.
     *
     * @param Route|null $_route
     *
     * @return self
     */
    public function setRoute(?Route $_route): self
    {
        $this->_route = $_route;
        return $this;
    }

    /**
     * Bind parameters from the HTTP request to the route.
     */
    public function bindParam(): void
    {
        switch ($this->_method) {
            case "GET":
            case "DELETE":
                // Search for a match between the route path ($this->_route->getPath()) and the current URL ($this->_url)
                if (preg_match("#" . $this->_route->getPath() . "#", $this->_url, $matches)) {
                    for ($i = 1; $i < count($matches) - 1; $i++) {
                        $this->_param[] = $matches[$i];
                    }
                }
                break;
            case "POST":
            case "PUT":
                foreach ($this->_route->getParam() as $param) {
                    if (isset($_POST[$param])) {
                        $this->_param[] = $_POST[$param];
                    }
                }
                break;
        }
    }

    /**
     * Run the route processing configuration settings.
     *
     * @param mixed $config The application configuration.
     */
    public function run($config): void
    {
        if ($this->_route) {
            $this->_route->run($this, $config);
        }
    }
}
