<?php
namespace App\Controllers;

use App\Manager\UserManager;
use App\Core\Functions\FormHelper;
use App\Models\User;

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

            // Retrieve data from the form
            $userName        = FormHelper::post('userName');
            $email           = FormHelper::post('email');
            $passWord        = FormHelper::post('passWord');
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

            $userEmail = $this->getManager(UserManager::class)->getUserByEmail($email);

            // Check if the email already exists in the database
            if ($userEmail !== null) {
                $errorMessage = "Cette adresse mail existe déjà";
                $this->view('user/register.html.twig', ['error' => $errorMessage]);
                return;
            }

            $user = $this->getManager(UserManager::class)->getUserByName($userName);

            // Check if the user name already exists in the database
            if ($user !== null) {
                $errorMessage = "Ce nom d'utilisateur est déjà pris";
                $this->view('user/register.html.twig', ['error' => $errorMessage]);
                return;
            }

            // // Check if the email already exists in the database
            // $userManager = $this->getManager(UserManager::class);
            // if ($userManager->emailExists($email)) {
            //     $errorMessage = "Cet email est déjà enregistré";
            //     $this->view('user/register.html.twig', ['error' => $errorMessage]);
            //     return;
            // }

            // // Check if the user name already exists in the database
            // if ($userManager->userNameExists($userName)) {
            //     $errorMessage = "Ce nom d'utilisateur est déjà pris";
            //     $this->view('user/register.html.twig', ['error' => $errorMessage]);
            //     return;
            // }

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
            $successMessage = "Votre compte a été bien créé ! Connectez vous et commentez nos articles";
            // Définir un cookie avec le message de succès
            setcookie('success', $successMessage, time() + 3600, '/mon-blog/login');
            header('Location: /mon-blog/login');
            exit;

        }
    }

    /**
     * Display the user login form.
     */
    public function displayLoginForm(): void
    {
        if (isset($_COOKIE['success'])) {
            $successMessage = $_COOKIE['success'];
            // Delete the cookie so that it is not displayed again
            setcookie('success', '', time() - 3600, '/mon-blog/login');
            // Pass on the message of success to Twig
            $this->view('user/login.html.twig', ['success' => $successMessage]);
        } else {
            $this->view('user/login.html.twig', []); // default display : No success message to display
        }
    }


    /**
     * Handle user login.
     */
    public function login(): void
    {
        if ($this->httpRequest->getMethod() === 'POST') {
            $email    = FormHelper::post('email');
            $passWord = FormHelper::post('passWord');

            if (empty($email) || !FormHelper::validateField($email, FormHelper::EMAIL_REGEX)) {
                $emailError = "Ce champ est obligatoir (format email@exemple.com)";
                $this->view('user/login.html.twig', ['emailError' => $emailError]);
                exit;
            }
            if (empty($passWord) || !FormHelper::validateField($passWord, FormHelper::PASSWORD_REGEX)) {
                $passwordError = "Mot de passe invalide";
                $this->view('user/login.html.twig', ['passwordError' => $passwordError]);
                exit;
            }


            // if (!FormHelper::validateField($email, FormHelper::EMAIL_REGEX)) {
            //     // Invalid email format
            //     $errorMessage = "Format d'email invalide";
            //     $this->view('user/login.html.twig', ['error' => $errorMessage]);
            //     exit;
            // }

            $user = $this->getManager(UserManager::class)->getUserByEmail($email);
            if ($user) {
                if (password_verify($passWord, $user->getPassWord())) {
                    $user = New User;
                    var_dump($user);
                    die;
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