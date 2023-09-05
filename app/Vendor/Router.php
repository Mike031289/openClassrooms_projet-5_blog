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
				$url = str_replace($this->baseUrl, "", $httpRequest->getUrl());
				$methode = $httpRequest->getMethod();
				// $routeFound = array_filter($this->listRoute,function($route) use ($url, $methode){
				// 			//The routes are compared using a regular expression to match the URL. The routes that match the URL and the HTTP method are stored in $routeFound 
				// 			return preg_match("#^" . $route->path . "$#", $url) && $route->method == $methode;
				// 		});
				// Utilisation de preg_match pour extraire les variables de chemin (comme l'ID d'article)
				$routeParams = [];
				foreach ($this->listRoute as $route) {
						$pattern = "#^" . preg_replace('/\{([a-zA-Z]+)\}/', '([^/]+)', $route->path) . "$#";
						if (preg_match($pattern, $url, $matches) && $route->method == $methode) {

								$routeParams = array_combine($route->param, array_slice($matches, 1));
								return new Route($route, $routeParams);
						}
				}	
					throw new NoRouteFoundException();
		}

}