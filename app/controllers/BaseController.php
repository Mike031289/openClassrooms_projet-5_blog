<?php
Class BaseController
{
  private $_param;
  private $_httpRequest;

  public function __construct($httpRequest){
    $this->_httpRequest = $httpRequest;
  }

  public function view($filename){
    if(file_exists('View/' . $filename . 'html.twig'))
    {
      ob_start();
      extract($this->_param);
      include("View/" . $filename . "html.twig");
      $content = ob_get_clean();
      include("View/layout.html.twig");
    }
    else
    {
      throw new ViewNotFoundException();	
    }
  }

  public function bindManager(){

  }

  public function addParam($name,$value)
		{
			$this->_param[$name] = $value;
		}
}