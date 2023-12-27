<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Functions\FormHelper;
use App\Manager\ContactManager;

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
     * @param object $httpRequest the HTTP request object
     * @param object $config      the application configuration object (JSON decode Object)
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
        $user = $this->session->getUser();

        $this->view('blog/contact.html.twig', ['user' => $user]);
    }

    /**
     * Handle contact sending.
     */
    public function sendMessage(): void
    {
        // Check if the user is logged in and pass the user information to the template
        $user = $this->session->getUser();

        // Retrieve data from the form
        $userName = FormHelper::post('userName');
        $email    = FormHelper::post('email');
        $message  = FormHelper::post('message');

        $errors = [];
        $error  = 'Formulaire non soumit, vérifier vos champs de saisie';

        // Validate the fields if empty
        if (empty($userName)) {
            $errors['userName'] = "Nom d'utilisateur requis";
        }

        // Validate email fields
        if (empty($email)) {
            $errors['email'] = 'Adresse email requis';
        } elseif (!FormHelper::validateField($email, FormHelper::EMAIL_REGEX)) {
            $errors['email'] = 'Email invalide (format requis : email@example.com)';
        }

        // Validate message fields
        if (empty($message)) {
            $errors['message'] = 'Message requis : Vous deviez saisir votre requête afin de soumettre le formulaire';
        } elseif (!FormHelper::validateField($message, FormHelper::TEXTAREA_REGEX)) {
            $errors['message'] = 'Votre message doit contenir au minimum 5 caractères';
        }

        // If there are errors, display the Twig template with the errors
        if (!empty($errors)) {
            // Add the name, email, and message values to the value array so the value will note be clear after submition
            $value['userNameValue'] = $userName;
            $value['emailValue']    = $email;
            $value['messageValue']  = $message;
            $this->view('blog/contact.html.twig', ['user' => $user, 'errors' => $errors, 'value' => $value, 'error' => $error]);
        }

        // Use the create method of ContactManager to send message and mail
        $this->getManager(ContactManager::class)->createContact($userName, $email, $message);

        // Redirect to the contact page with success message
        $success = "Votre message a été transmit.
    Adjoukou AGBELOU vous recontactera très rapidement.
    N'hésitez pas à l'appeler au 0662272975, ou à l'envoyer un mail à mike.agbelou@gmail.com   Merci :)";

        $this->view('blog/contact.html.twig', ['user' => $user, 'success' => $success]);
    }
}
