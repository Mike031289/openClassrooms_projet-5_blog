<?php
namespace App\Controllers;

use App\Manager\UserManager;
use App\Manager\ContactManager;
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

  /**
   * Display the contact form.
   */
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

  /**
   * Handle contact sending.
   */
  public function sendMessage(): void
  {
    // Check if the user is logged in and pass the user information to the template
    session_start();
    $email = $_SESSION['userEmail'] ?? null;
    $user  = null;
    if ($email !== null) {
      $user = $this->getManager(UserManager::class)->getUserByEmail($email);
    }

    // Retrieve data from the form
    $userName        = FormHelper::post('userName');
    $email           = FormHelper::post('email');
    $message        = FormHelper::post('message');

    $errors = [];
    $error  = "Formulaire non soumit, vérifier vos champs de saisie";

    // Validate the fields if empty
    if (empty($userName)) {
      $errors['userName'] = "Nom d'utilisateur requis";
      $error;

    }

    // Validate email fields
    if (empty($email)) {
      $errors['email'] = "Adresse email requis";
      $error;
    } else if (!FormHelper::validateField($email, FormHelper::EMAIL_REGEX)) {
      $errors['email'] = "Email invalide (format requis : email@example.com)";
      $error;
    }

    // Validate message fields
    if (empty($message)) {
      $errors['message'] = "Message requis : Vous deviez saisir votre requête afin de soumettre le formulaire";
      $error;

    } else if (!FormHelper::validateField($message, FormHelper::TEXTAREA_REGEX)) {
      $errors['message'] = "Votre message doit contenir au minimum 50 caractères";
      $error;
    }

    // If there are errors, display the Twig template with the errors
    if (!empty($errors)) {
      // Add the name, email, and message values to the value array so the value will note be clear after submition
      $value['userNameValue']  = $userName;
      $value['emailValue']     = $email;
      $value['messageValue']  = $message;
      $this->view('blog/contact.html.twig', ['user' => $user, 'errors' => $errors, 'value' => $value, 'error' => $error]);
      exit;
    }

    // Use the sendMail method of ContactManager to send message and mail
    $this->getManager(ContactManager::class)->sendMail($userName, $email, $message);

    // Redirect to the contact page with success message
    $success = "Votre message a été transmit. 
    Adjoukou AGBELOU vous recontactera très rapidement. 
    N'hésitez pas à l'appeler au 0662272975, ou à l'envoyer un mail à mike.agbelou@gmail.com   Merci :)";

    $this->view("blog/contact.html.twig", ['user' => $user, 'success' => $success,]);
  }
}
