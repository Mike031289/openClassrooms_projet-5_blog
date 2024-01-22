<?php
require 'vendor/autoload.php';

use App\Core\HttpRequest;
use App\Core\Router;
use App\Exceptions\ActionNotFoundException;
use App\Exceptions\NoRouteFoundException;

/**
 * Front Controller
 *
 * This script serves as the entry point for handling incoming HTTP requests.
 */

// Load application configuration
$configFile = file_get_contents("config/config.json");
$config     = json_decode($configFile);

// Load routes configuration
$configRoutes = file_get_contents('config/routes.json');
$configRoutes = json_decode($configRoutes);

try { 
    // Create an instance of HttpRequest to handle the incoming request
    $httpRequest = new HttpRequest();

    // Create a Router instance with the configured routes and base URL
    $router = new Router($configRoutes, $config->baseUrl);

    // Find and set the route for the HttpRequest
    $httpRequest->setRoute($router->findRoute($httpRequest));

    // Run the HttpRequest to process the request using the configuration
    $httpRequest->run($config);
} 
catch (NoRouteFoundException $e) {
    // Redirect to a 404 error page if no matching route is found
    header("Location: {$config->baseUrl}/404");
}
// A décommenter lors de la production
catch(ActionNotFoundException $e){
    header("Location: {$config->baseUrl}/500");
}
