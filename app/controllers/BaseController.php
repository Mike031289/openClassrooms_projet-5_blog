<?php
class BaseController
{
  private $_param;
  private $_httpRequest;
  private $_twig;
  private $_config;

  public function __construct($httpRequest, $config){
    $this->_httpRequest = $httpRequest;
    $this->_config = $config;
    $_loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/../Views');
    $this->_twig = new Twig\Environment($_loader);
  }

  protected function view($filename, $context = [])
  {
      ob_start();
      extract($this->_param);
      $content = ob_get_clean();
      echo $this->_twig->render($filename, $context);
    
  }

	public function bindManager()
  {
    foreach($this->_httpRequest->getRoute()->manager as $manager)
    {
      $this->$manager = new $manager($this->_config->database);
    }
  }

  public function addParam($name,$value)
  {
    $this->_param[$name] = $value;
  }
}