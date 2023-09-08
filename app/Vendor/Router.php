<?php
namespace App\Vendor;
use App\Exceptions\MultipleRouteFoundException;
use App\Exceptions\NoRouteFoundException;

	class Router
	{
		private $_listRoute;
		private $_baseUrl;
		
		public function __construct($_baseUrl)
		{
			$stringRoute = file_get_contents('config/routes.json');
			$this->listRoute = json_decode($stringRoute);
			$this->baseUrl = $_baseUrl;
		}
		
		/**
		 * @findRoute($httpRequest) is responsible for finding the appropriate route for a specific URL and HTTP method. If only one matching route is found, it returns it. If no route is found, or if multiple routes match, it generates the appropriate exceptions to signal routing problems
		 */
		public function findRoute($httpRequest)
{
    // Extract the URL portion after the base URL
    $url = str_replace($this->baseUrl, "", $httpRequest->getUrl());

    // Get the HTTP method (GET, POST, etc.) used in the request
    $method = $httpRequest->getMethod();

    // Initialize an array to store route parameters
    $routeParams = [];

    // Loop through each route in the list of routes
    foreach ($this->listRoute as $route) {
        // Define a regular expression pattern to match the route path
        // Replace dynamic parts in curly braces with a regular expression that matches them
        $pattern = "#^" . preg_replace('/\{([a-zA-Z]+)\}/', '([^/]+)', $route->path) . "$#";

        // Attempt to match the current URL with the pattern and check if the HTTP method matches
        if (preg_match($pattern, $url, $matches) && $route->method == $method) {
            // Combine route parameter names with captured values to create an associative array
            $routeParams = array_combine($route->param, array_slice($matches, 1));

            // Create a new Route object with matched route and parameters
            return new Route($route, $routeParams);
        }
    }

    // If no matching route is found, throw a NoRouteFoundException
    throw new NoRouteFoundException();
}


}