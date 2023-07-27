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
    $this->bindManager();
  }

  /**
   * @view is used to display a Twig template by rendering the corresponding HTML content
   */
  protected function view($fileName, $viewContent = [])
  {
      ob_start();
      //we're going to extract the variables defined in the $this->_param property. This makes the variables available directly in the Twig template for easy access
      extract($this->_param);
      //we retrieve the content captured in the output buffer ob_start(); and store it in the variable $content
      $content = ob_get_clean();
      //to render the Twig template specified by $fileName using the data in the $viewContent array. The generated HTML result is stored in a variable. It displays the rendered content using echo
      echo $this->_twig->render($fileName, $viewContent);
  }

  /**
   * @bindManagers function allows us to bind instances of database handlers to properties of the current object. Once the handlers have been bound, they can be used to interact with the database throughout the execution of the application
   */
	private function bindManager()
  {
    foreach($this->_httpRequest->getRoute()->getManagers() as $manager)
    {
      $this->$manager = new $manager($this->_config->database);
    }
  }

  /**
   * @addParam stores parameters with specific keys in the _param table of the current object. These parameters can be used later in other parts of the object, in particular when rendering a view or managing a request, to pass data to templates or to facilitate the object's internal communication
   */
  public function addParam($name,$value)
  {
    $this->_param[$name] = $value;
  }
}