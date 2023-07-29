<?php
namespace App\Vendor;
		class HttpRequest
		{
			private $_url;
			private $_method;
			private $_param = [];
			private $_route;
			
			public function __construct()
			{
				$this->_url = $_SERVER['REQUEST_URI'];
				$this->_method = $_SERVER['REQUEST_METHOD'];
			}
		
			/**
			 * Get the value of _url
			 */
			public function getUrl()
			{
						return $this->_url;
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
			 * Get the value of _route
			 */
			public function getRoute()
			{
						return $this->_route;
			}

			/**
			 * Set the value of _route
			 */
			public function setRoute($_route): self
			{
						$this->_route = $_route;
						return $this;
			}		

			/**
			 * @bindParam identify the type of @method by which the request is being transmitted, so that we can better process it.
			 */
			public function bindParam()
			{
				switch($this->_method)
				{
					case "GET":
					case "DELETE":
						if(preg_match("#" . $this->_route->path . "#",$this->_url, $matches))
						{
							for($i=1; $i<count($matches)-1; $i++)
							{
								$this->_param[] = $matches[$i];	
							}
						}
					case "POST":
					case "PUT":
						foreach($this->_route->getParam() as $param)
						{
							if(isset($_POST[$param]))
							{
								$this->_param[] = $_POST[$param];
							}
						}
				}
			}

			/**
			 * @run the route processing configuration settings
			 */
			public function run($config){
				$this->_route->run($this,$config);
			}

		}