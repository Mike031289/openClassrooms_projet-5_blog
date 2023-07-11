<?php

class BaseManager
{
  private $_table;
  private $_object;
  protected $_db;
  
  public function __construct($table, $object, $datasource)
  {
    $this->_table = $table;
    $this->_object = $object;
    $this->_db = DB::getInstance($datasource);
  }
  
  public function getById($id)
  {
    $req = $this->_db->prepare("SELECT * FROM " . $this->_table . " WHERE id=?");
    $req->execute(array($id));
    $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$this->_object);
			return $req->fetch();
  }
  
  public function getAll()
  {
    $req = $this->_db->prepare("SELECT * FROM " . $this->_table);
    $req->execute();
    $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$this->_object);
			return $req->fetch();
  }
  
  public function create($object)
  {
    $paramNumber = count($param);
    $valueArray = array_fill(1,$param_number,"?");
    $valueString = implode($valueArray,", ");
    $sql = "INSERT INTO " . $this->_table . "(" . implode($param,", ") . ") VALUES(" . $valueString . ")";
    $req = $this->_db->prepare($sql);
    $boundParam = array();
			foreach($param as $paramName)
			{
				if(property_exists($object,$paramName))
				{
					$boundParam[$paramName] = $object->$paramName;	
				}
				else
				{
					throw new PropertyNotFoundException($this->_object,$paramName);	
				}
			}
			$req->execute($boundParam);
  }
  
  public function update($object)
  {
    $sql = "UPDATE " . $this->_table . " SET ";
			foreach($param as $paramName)
			{
				$sql = $sql . $paramName . " = ?, ";
			}
			$sql = $sql . " WHERE id = ? ";
			$req = $this->_db->prepare($sql);
			
			$param[] = 'id';
			$boundParam = array();
			foreach($param as $paramName)
			{
				if(property_exists($object,$paramName))
				{
					$boundParam[$paramName] = $object->$paramName;	
				}
				else
				{
					throw new PropertyNotFoundException($this->_object,$paramName);	
				}
			}
			
			$req->execute($boudParam);
  }
  
  public function delete($object)
  {
    if(property_exists($object,"id"))
    {
      $req = $this->_db->prepare("DELETE FROM " . $this->_table . " WHERE id=?");
      return $req->execute(array($object->id));
    }
    else
    {
      throw new PropertyNotFoundException($this->_object,"id");	
    }
  }
}
