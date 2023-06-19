<?php
// Inclusion of the Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

$loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/app/views/templates');
$twig = new Twig\Environment($loader);

// Loading Class files, Inclusion of application configuration and startup files
$configFile = file_get_contents("config/config.json");
$config = json_decode($configFile);

spl_autoload_register(function($class) use($config)
{
    foreach($config->autoloadFolder as $folder)
    {
        if(file_exists($folder . '/' . $class . '.php'))
        {
            require_once($folder . '/' . $class . '.php');
            break;
        }
    }
});
try
	{
		$httpRequest = new HttpRequest();
		$router = new Router($config->baseUrl);
		$httpRequest->setRoute($router->findRoute($httpRequest));
	}
	catch(Exception $e)
	{
		echo "Une erreur s'est produite : " . $e->getMessage();
	}
