<?php
	class MultipleRouteFoundException extends Exception
	{
		public function __construct($message = "More than 1 route has been found")
		{
			parent::__construct($message, "0001");
		}
	}