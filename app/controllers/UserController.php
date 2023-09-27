<?php
namespace App\Controllers;

use App\Manager\UserManager;
use App\Models\PostData; // Include the PostData class
use App\Models\User; // Include the User class

/**
 * Class UserController
 *
 * Controller responsible for handling user-related actions.
 */
class UserController extends BaseController
{
    /**
     * UserController constructor.
     *
     * @param object $httpRequest The HTTP request object.
     * @param object $config      The application configuration.
     */
    public function __construct(object $httpRequest, object $config)
    {
        parent::__construct($httpRequest, $config);
    }

    /**
     * Display the user registration form.
     */
    public function displayRegisterForm(): void
    {
        $this->view('user/register.html.twig', []);
    }

    /**
     * Handle user registration.
     */
    public function register(): void
    {

        if ($this->httpRequest->getMethod() === 'POST') {

            $postData = new PostData(); // Create an instance of PostData

            // Retrieve and validate data from the form
            $userName        = $postData->getFilteredAndValidated('userName', FILTER_SANITIZE_STRING, User::NAME_FORMAT);
            $email           = $postData->getFilteredAndValidated('email', FILTER_SANITIZE_EMAIL, User::EMAIL_FORMAT);
            $passWord        = $postData->getFilteredAndValidated('passWord', null, User::PASSWORD_FORMAT);
            $passWordConfirm = $postData->get('passWordConfirm'); // No need to validate again

            // Check if fields are not empty and passwords match
            if (empty($userName) || empty($email) || empty($passWord) || empty($passWordConfirm) || $passWord !== $passWordConfirm) {
                $errorMessage = "Veuillez vérifier les champs du formulaire ou assurez-vous que les mots de passe correspondent";
                $this->view('user/register.html.twig', ['error' => $errorMessage]);
                return;
            }

            $hashedPassword = password_hash($passWord, PASSWORD_DEFAULT);
            $createdAt      = date('Y-m-d H:i:s');

            $userData = [
                'userName'  => $userName,
                'email'     => $email,
                'passWord'  => $hashedPassword,
                'createdAt' => $createdAt,
            ];

            $this->getManager(UserManager::class)->create($userData);

            $successMessage = "Votre compte a été bien créé";
            header('Location: /mon-blog/login');
            exit;
        }
    }


    /**
     * Display the user login form.
     */
    public function displayLoginForm(): void
    {
        $this->view('user/login.html.twig', []);
    }

    /**
     * Handle user login.
     */
    public function login(): void
    {
        $postData = new PostData();

        if ($this->httpRequest->getMethod() === 'POST') {
            $email    = $postData->getFilteredAndValidated('email', FILTER_SANITIZE_EMAIL, '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/');
            $passWord = $postData->get('passWord');

            if ($email === null) {
                // Invalid email format
                $errorMessage = "Format d'email invalide";
                $this->view('user/login.html.twig', ['error' => $errorMessage]);
                exit;
            }

            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
            if ($user) {
                if (password_verify($passWord, $user->getPassWord())) {
                    session_start();
                    // $_SESSION['id'] = $userId;
                    header('Location: /mon-blog/posts');
                    exit;
                } else {
                    $errorMessage = "Mot de passe incorrect";
                    $this->view('user/login.html.twig', ['error' => $errorMessage]);
                    exit;
                }
            } else {
                $errorMessage = "Ce compte n'existe pas";
                $this->view('user/login.html.twig', ['error' => $errorMessage]);
                exit;
            }
        }
    }


    /**
     * Handle user logout.
     */
    public function logout(): void
    {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /mon-blog/login');
        exit;
    }
}