<?php
namespace App\Controllers;

use App\Manager\UserManager;
use App\Models\PostData;
use App\Core\Functions\FormHelper;

/**
 * UserController - Controller responsible for handling user-related actions.
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
            // $postData = new PostData(); // Create an instance of PostData

            // Retrieve data from the form
            $userName = FormHelper::post('userName');
            $email = FormHelper::post('email');
            $passWord = FormHelper::post('passWord');
            $passWordConfirm = FormHelper::post('passWordConfirm');

            // Validate the fields using regex patterns
            if (!FormHelper::validateField($userName, FormHelper::USERNAME_REGEX)) {
                $errorMessage = "Nom d'utilisateur invalide";
                $this->view('user/register.html.twig', ['error' => $errorMessage]);
                return;
            }

            if (!FormHelper::validateField($email, FormHelper::EMAIL_REGEX)) {
                $errorMessage = "Email invalide";
                $this->view('user/register.html.twig', ['error' => $errorMessage]);
                return;
            }

            if (!FormHelper::validateField($passWord, FormHelper::PASSWORD_REGEX)) {
                $errorMessage = "Mot de passe invalide";
                $this->view('user/register.html.twig', ['error' => $errorMessage]);
                return;
            }

            if ($passWord !== $passWordConfirm) {
                $errorMessage = "Les mots de passe ne correspondent pas";
                $this->view('user/register.html.twig', ['error' => $errorMessage]);
                return;
            }

            // Hash the password
            $hashedPassword = password_hash($passWord, PASSWORD_DEFAULT);

            // Get the current date
            $createdAt = date('Y-m-d H:i:s');

            // Create an associative array of user data
            $userData = [
                'userName'  => $userName,
                'email'     => $email,
                'passWord'  => $hashedPassword,
                'createdAt' => $createdAt,
            ];

            // Use the create method of UserManager to create the User object
            $this->getManager(UserManager::class)->create($userData);

            // Redirect to the login page
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
            $email = FormHelper::post('email');
            $passWord = FormHelper::post('passWord');

            if (!FormHelper::validateField($email, FormHelper::EMAIL_REGEX)) {
                // Invalid email format
                $errorMessage = "Format d'email invalide";
                $this->view('user/login.html.twig', ['error' => $errorMessage]);
                exit;
            }

            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
            if ($user) {
                if (password_verify($passWord, $user->getPassWord())) {
                    // Correct password, log in the user
                    session_start();
                    $_SESSION['user'] = $user;

                    // Redirect to a protected page (e.g., dashboard)
                    header('Location: /mon-blog/posts');
                    exit;
                } else {
                    // Incorrect password, display an error
                    $errorMessage = "Mot de passe incorrect";
                    $this->view('user/login.html.twig', ['error' => $errorMessage]);
                    exit;
                }
            } else {
                // User not found, display an error
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
