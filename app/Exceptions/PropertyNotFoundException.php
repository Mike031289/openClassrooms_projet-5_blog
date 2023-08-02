<?php
namespace App\Exceptions;
use Exception;

class PropertyNotFoundException extends Exception
{
	private $_className;
	private $_property;

		public function __construct($className,$property,$message = "Property missing")
		{
			$this->_className = $className;
			$this->_property = $property;
			parent::__construct($message,'0004');
		}

		public function getMoreDetail()
		{
				return "Property " . $this->_property . " does not exist in class " . $this->_className;
		}
}