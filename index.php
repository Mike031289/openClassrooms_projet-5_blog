<?php
require 'vendor/autoload.php';
use App\Vendor\HttpRequest;
use App\Vendor\Router;
use App\Exceptions\NoRouteFoundException;

// Loading Class files, Inclusion of application configuration and startup files
$configFile = file_get_contents("config/config.json");
$config = json_decode($configFile);
$configRoutes = file_get_contents('config/routes.json');
$configRoutes = json_decode($configRoutes);
try 
	{
		$httpRequest = new HttpRequest();
		$router = new Router($configRoutes, $config->baseUrl);
		$httpRequest->setRoute($router->findRoute($httpRequest));
		$httpRequest->run($config);
	}
	catch(NoRouteFoundException $e)
	{
		header("Location: {$config->baseUrl}/404");
	}
