<?php

class BaseManager
{
  private $_table;
  private $_object;
  protected $_db;
  
  public function __construct($table, $object, $dataSource)
  {
    $this->_table = $table;
    $this->_object = $object;
    $this->_db = DB::getInstance($dataSource);
  }
  
  /**
   * @getById retrieve a specific record from the table associated with the current class based on its identifier (ID). It returns the record in the form of an object corresponding to the class of the current object
   */
  public function getById($id)
  {
    $req = $this->_db->prepare("SELECT * FROM " . $this->_table . " WHERE id=?");
    $req->execute(array($id));
    // We're going to define how the results of the query ($req) are to be retrieved:
    // PDO::FETCH_CLASS indicates that the results are to be returned as instances of the specified class.
    // PDO::FETCH_PROPS_LATE means that the object's properties will be assigned after the call to the class constructor.
    // $this->_object represents the current object
    $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$this->_object);
			return $req->fetch();
  }
  
  /**
   * @getAll() retrieve all the rows in the table associated(_table) with the current class from the database. It returns an array containing the records in the form of objects corresponding to the class of the current object ($this->_object)
   */
  public function getAll()
  {
    $req = $this->_db->prepare("SELECT * FROM " . $this->_table);
    $req->execute();
    $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$this->_object);
    return $req->fetchAll();
  }

  /**
   * @create is used to insert a new record into the table associated with the current class using a specified object. It takes an object containing the data to be inserted in the database
   */
  public function create($object)
  {
    $paramNumber = count($param);
    $valueArray = array_fill(1,$paramNumber,"?");
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
  
  /**
   * @update is used to update an existing record in the table associated with the current class using data supplied in a specified object. It performs an update by using the SQL UPDATE clause and binding the values of the object's properties to the columns of the table
   */
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
  
  /**
   * @delete is used to delete a specific record from the table associated with the current class using a specified object. It performs a delete using the SQL DELETE clause with a condition based on the object's id property
   */
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
