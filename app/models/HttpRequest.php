<?php
		class HttpRequest
		{
			private $_url;
			private $_method;
			private $_param;
			private $_route;
			
			public function __construct()
			{
				$this->_url = $_SERVER['REQUEST_URI'];
				$this->_method = $_SERVER['REQUEST_METHOD'];
			}
			
			public function getUrl()
			{
				return $this->_url;	
			}
			
			public function getMethod()
			{
				return $this->_method;	
			}
			
			public function getParams()
			{
				return $this->_params;	
			}
			
			public function setRoute($route)
			{
				$this->_route = $route;	
			}

			// This method will help us to  identify the type of method by which the request is being transmitted, so that we can better process it.
			public function bindParam()
			{
				switch($this->_method)
				{
					case "GET":
					case "DELETE":
						if(preg_match("#" . $this->_route->path . "#",$this->_url,$matches))
						{
							for($i=1;$i<count($matches)-1;$i++)
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
		}