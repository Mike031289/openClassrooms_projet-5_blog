<?php
Class BaseController
{
  private $_param;
  private $_httpRequest;

  public function __construct($httpRequest){
    $this->httpRequest = $httpRequest;
  }

  public function view($filename){

  }

  public function bindManager(){

  }
}