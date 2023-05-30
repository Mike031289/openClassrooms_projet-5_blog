<?php
	class NoRouteFoundException extends Exception
	{
		public function __construct($message = "No route has been found")
		{
			parent::__construct($message, "0002");
		}
	}