<?php
namespace App\Manager;

	class DB
	{
		private $_db;
		private static $_instance;

		// this function instantiates the DB object (with DB connection parameters) in order to connect to dataBase
		private function __construct($dataSource)
		{
			$this->_db = new \PDO('mysql:dbname=' . $dataSource->dbname . ';host=' . $dataSource->host, $dataSource->user,$dataSource->password);
		}
		
		// this static method allows us to keep the instance of our DB object, so that we can call the DB connection from wherever we wish to connect, without having to reinstantiate the DB object before connecting to our DB
		/**
		 * @
		 */
		public static function getInstance($dataSource)
		{
			if(empty(self::$_instance))
			{
				self::$_instance = new DB($dataSource);
			}
			return self::$_instance->_db;
		}

    public function getDb()
		{
			return $this->_db;
		}
	}