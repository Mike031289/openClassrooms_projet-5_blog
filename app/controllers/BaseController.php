<?php
class BaseController
{
  private $_param;
  private $_httpRequest;
  private $_twig;

  public function __construct($httpRequest){
    $this->_httpRequest = $httpRequest;
    $_loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/app/views/templates');
    $this->_twig = new Twig\Environment($_loader);
  }

  protected function view($filename)
  {
    if(file_exists('../Views/' . $filename . '.html.twig'))
    {
      ob_start();
      extract($this->_param);
      $content = ob_get_clean();
      $this->_twig->render("Views/layout.html.twig");
    }
    else
    {
      throw new ViewNotFoundException();	
    }
  }

  public function bindManager()
  {

  }

  public function addParam($name,$value)
  {
    $this->_param[$name] = $value;
  }
}