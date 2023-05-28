<?php
	class HttpRequest
	{
		private $url;
		private $method;
		private $param;
		
		public function __construct()
		{
			$this->_url = $_SERVER['REQUEST_URI'];
			$this->_method = $_SERVER['REQUEST_METHOD'];
		}

		public function getUrl()
		{
			return $this->url;	
		}
		
		public function getMethod()
		{
			return $this->method;	
		}
		
		public function getParams()
		{
			return $this->params;	
		}
	}