<?php
require 'vendor/autoload.php';
use App\Vendor\HttpRequest;
use App\Vendor\Router;

// Loading Class files, Inclusion of application configuration and startup files
$configFile = file_get_contents("config/config.json");
$config = json_decode($configFile);

try 
	{
		$httpRequest = new HttpRequest();
		$router = new Router($config->baseUrl);
		$httpRequest->setRoute($router->findRoute($httpRequest));
		$httpRequest->run($config);
	}
	catch(Exception $e)
	{
		echo "Une erreur s'est produite : " . $e->getMessage();
	}
