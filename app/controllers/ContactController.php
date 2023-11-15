<?php
namespace App\Controllers;

use App\Manager\UserManager;
use App\Core\Functions\FormHelper;

/**
 * Class ContactController
 *
 * Controller responsible for handling Contacts-related actions.
 */
class ContactController extends BaseController
{
  /**
   * ContactController constructor.
   *
   * @param object $httpRequest The HTTP request object.
   * @param object  $config      The application configuration object (JSON decode Object).
   */
  public function __construct(object $httpRequest, object $config)
  {
    parent::__construct($httpRequest, $config);
  }

  public function contactForm(): void
  {
    // Check if the user is logged in and pass the user information to the template
    session_start();
    $email = $_SESSION['userEmail'] ?? null;
    $user  = null;
    if ($email !== null) {
      $user = $this->getManager(UserManager::class)->getUserByEmail($email);
    }

    $this->view("blog/contact.html.twig", ['user' => $user]);
  }
  public function sendMessage(): void
  {
    echo "Contact";
    die;
    // Check if the user is logged in and pass the user information to the template
    session_start();
    $email = $_SESSION['userEmail'] ?? null;
    $user  = null;
    if ($email !== null) {
      $user = $this->getManager(UserManager::class)->getUserByEmail($email);
    }

    $this->view("blog/contact.html.twig", ['user' => $user]);
  }
}
