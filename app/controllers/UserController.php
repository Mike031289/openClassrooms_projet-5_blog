<?php
namespace App\Controllers;

use App\Manager\UserManager;

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

            // Retrieve data from the form
            $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $passWord = $_POST['passWord'];
            $passWordConfirm = $_POST['passWordConfirm'];

            // Check if fields are not empty and passwords match
            if (empty($userName) || empty($email) || empty($passWord) || empty($passWordConfirm) || $passWord !== $passWordConfirm) {
                // Handle the error, for example, display a message to the user
                $errorMessage = "Veuillez vérifier les champs du formulaire";
                $this->view('user/register.html.twig', ['error' => $errorMessage]);
                return; // Stop processing if fields are empty or passwords do not match
            }

            // Hash the password
            $hashedPassword = password_hash($passWord, PASSWORD_DEFAULT);

            // Get the current date
            $createdAt = date('Y-m-d H:i:s');

            // Create an associative array of user data
            $userData = [
                'userName' => $userName,
                'email' => $email,
                'passWord' => $hashedPassword,
                'createdAt' => $createdAt,
            ];

            // Use the create method of UserManager to create the User object
            $user = $this->getManager(UserManager::class)->create($userData);

            // Save the user to the database (your implementation here)

            // Redirect to the login page
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
        if ($this->httpRequest->getMethod() === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $passWord = $_POST['passWord'];

            // Use the getUserByEmail method of UserManager to get the user by email
            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
            if ($user) {
                // Check the password using password_verify
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
