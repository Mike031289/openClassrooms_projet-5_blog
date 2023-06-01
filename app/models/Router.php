<?php
	class Router
	{
		private $listRoute;
		private $baseUrl;
		
		public function __construct($baseUrl)
		{
			$stringRoute = file_get_contents('config/routes.json');
			$this->listRoute = json_decode($stringRoute);
			$this->baseUrl = $baseUrl;
		}
		
		public function findRoute($httpRequest)
		{
			$url = str_replace($this->baseUrl,"", $httpRequest->getUrl());
			$methode = $httpRequest->getMethod();
      $routeFound = array_filter($this->listRoute,function($route) use ($url, $methode){
				return preg_match("#^" . $route->path . "$#", $url) && $route->method == $methode;
			});
			$numberRoute = count($routeFound);
			if($numberRoute > 1)
			{
				throw new MultipleRouteFoundException();
			}
			else if($numberRoute == 0)
			{
				throw new NoRouteFoundException();
			}
			else
			{
				return new Route(array_shift($routeFound));	
			}
		}
	}