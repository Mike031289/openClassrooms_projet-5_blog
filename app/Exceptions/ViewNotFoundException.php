<?php
namespace App\Exceptions;
use Exception;

class ViewNotFoundException extends Exception {
  public function __construct($message = "No view has been found")
  {
    parent::__construct($message, "0003");
  }
}