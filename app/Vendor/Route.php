<?php
namespace App\Vendor;
use App\Exceptions\ActionNotFoundException;
use App\Exceptions\ControllerNotFoundException;

	class Route
	{
		private $_path;
		private $_controller;
		private $_action;
		private $_method;
		private $_param;
		private $_managers;
		
		public function __construct($route,  $routeParams)
		{
			$this->_path = $route->path;
			$this->_controller = $route->controller;
			$this->_action = $route->action;
			$this->_method = $route->method;
			$this->_param =  $routeParams;
			$this->_managers = $route->managers;
		}

		/**
		 * Get the value of _path
		 */
		public function getPath()
		{
				return $this->_path;
		}

		/**
		 * Get the value of _controller
		 */
		public function getController()
		{
				return $this->_controller;
		}

		/**
		 * Get the value of _action
		 */
		public function getAction()
		{
				return $this->_action;
		}

		/**
		 * Get the value of _method
		 */
		public function getMethod()
		{
				return $this->_method;
		}

		/**
		 * Get the value of _param
		 */
		public function getParam()
		{
				return $this->_param;
		}

		/**
		 * Get the value of _managers
		 */
		public function getManagers()
		{
				return $this->_managers;
		}
		
		/**
		 * @run function manages incoming HTTP requests and associates them with the corresponding controllers and actions: It manages the routing and execution of controller actions for incoming HTTP requests.
		 * $config contains data from the config file (config.json)
		 * $httpRequest contains data from the HttpResquest class
		 */
		public function run($httpRequest, $config)
    {
        $controller = null;
        $controllerName = $this->_controller;

        // Vérifie si la classe du contrôleur existe
        if (class_exists($controllerName)) {
            $controller = new $controllerName($httpRequest, $config);

            // Vérifie si la méthode (action) existe dans le contrôleur
            if (method_exists($controller, $this->_action)) {
                $params = array_values($this->_param);

                // Appelle l'action du contrôleur avec les paramètres appropriés
                $controller->{$this->_action}(...$params);
            } else {
                throw new ActionNotFoundException();
            }
        } else {
            throw new ControllerNotFoundException();
        }
    }

	}