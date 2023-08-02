<?php
namespace App\Exceptions;
use Exception;

class ActionNotFoundException extends Exception {
  public function __construct($message = "No action has been found")
  {
    parent::__construct($message, "0006");
  }
}