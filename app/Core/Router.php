<?php

namespace App\Core;

use App\Exceptions\NoRouteFoundException;

/**
 * Class Router
 *
 * This class is responsible for routing incoming HTTP requests to the appropriate controller action.
 */
class Router
{
    /**
     * @var array the list of configured routes
     */
    private array $_listRoute;

    /**
     * @var string the base URL for the application
     */
    private string $_baseUrl;

    /**
     * Router constructor.
     *
     * @param array  $configRoutes an array containing the list of configured routes
     * @param string $_baseUrl     the base URL for the application
     */
    public function __construct(array $configRoutes, string $_baseUrl)
    {
        $this->_listRoute = $configRoutes;
        $this->_baseUrl = $_baseUrl;
    }

    /**
     * Find the appropriate route for a specific URL and HTTP method.
     *
     * If only one matching route is found, it returns it. If no route is found, or if multiple routes match,
     * it generates the appropriate exceptions to signal routing problems.
     *
     * @param  HttpRequest           $httpRequest the HTTP request object
     * @throws NoRouteFoundException if no matching route is found
     * @return Route                 the matched route
     */
    public function findRoute(object $httpRequest): Route
    {
        // Extract the URL portion after the base URL
        $url = str_replace($this->_baseUrl, '', $httpRequest->getUrl());

        // Get the HTTP method (GET, POST, etc.) used in the request
        $method = $httpRequest->getMethod();

        // Initialize an array to store route parameters
        $routeParams = [];

        // Loop through each route in the list of routes
        foreach ($this->_listRoute as $route) {
            // Define a regular expression pattern to match the route path
            // Replace dynamic parts in curly braces with a regular expression that matches them
            $pattern = '#^'.preg_replace('/\{([a-zA-Z0-9_-]+)\}/', '([^/]+)', $route->path).'$#';

            // Attempt to match the current URL with the pattern and check if the HTTP method matches
            if (preg_match($pattern, $url, $matches) && $route->method === $method) {
                // Combine route parameter names with captured values to create an associative array
                $routeParams = array_combine($route->param, \array_slice($matches, 1));

                // Create a new Route object with matched route and parameters
                return new Route($route, $routeParams);
            }
        }

        // If no matching route is found, throw a NoRouteFoundException
        throw new NoRouteFoundException();
    }
}
