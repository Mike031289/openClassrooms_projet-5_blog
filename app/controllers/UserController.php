<?php
namespace App\Controllers;

use App\Manager\UserManager;
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
    public function creatUser(): void
    {
        // Retrieve data from the form
        $userName        = FormHelper::post('userName');
        $email           = FormHelper::post('email');
        $passWord        = FormHelper::post('passWord');
        $passWordConfirm = FormHelper::post('passWordConfirm');

        $errors = [];

        // Validate the fields using regex patterns
        if (empty($userName)) {
            $errors['userName'] = "Nom d'utilisateur requis";

        } else if (!FormHelper::validateField($userName, FormHelper::USERNAME_REGEX)) {
            $errors['userName'] = "Nom invalide(minimum 3 caractères maximum 20 et pas de caractères spéciaux)";
        }

        // Validate email fields
        if (empty($email)) {
            $errors['email'] = "Adresse email requis";

        } else if (!FormHelper::validateField($email, FormHelper::EMAIL_REGEX)) {
            $errors['email'] = "Email invalide (format requis : email@example.com)";
        }

        // Validate password fields
        if (empty($passWord)) {
            $errors['password'] = "Mot de passe requis";

        } else if (!FormHelper::validateField($passWord, FormHelper::PASSWORD_REGEX)) {
            $errors['password'] = "Mot de passe invalide";
        }

        // Validate password fields
        if (empty($passWordConfirm)) {
            $errors['password2'] = "Confirmez le mot de passe";

        } else if ($passWord !== $passWordConfirm) {
            $errors['password2'] = "Le mot de passe doit correspondre au premier";
        }

        $userEmailExist = $this->getManager(UserManager::class)->getUserByEmail($email);

        // Check if the email already exists in the database
        if ($userEmailExist !== null) {
            $errors['email'] = "Cette adresse email existe déjà";

        }

        $userNameExist = $this->getManager(UserManager::class)->getUserByName($userName);

        // Check if the user name already exists in the database
        if ($userNameExist !== null) {
            $errors['userName'] = "Ce nom d'utilisateur est déjà pris";

        }

        // If there are errors, display the Twig template with the errors
        if (!empty($errors)) {
            // Add the email and password values to the value array so the value will note be clear after submition
            $value['userNameValue']  = $userName;
            $value['emailValue']     = $email;
            $value['passwordValue']  = $passWord;
            $value['passwordValue2'] = $passWordConfirm;
            $this->view('user/register.html.twig', ['errors' => $errors, 'value' => $value]);
        }

        // Use the create method of UserManager to create the User object
        $this->getManager(UserManager::class)->createUserWithRole($userName, $email, $passWord);

        // Redirect to the login page
        $successMessage = "Votre compte a été bien créé ! Connectez vous et commentez nos articles";
        // Définir un cookie avec le message de succès
        setcookie('success', $successMessage, time() + 3600, '/mon-blog/login');
        header('Location: login');

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
        $email    = FormHelper::post('email');
        $passWord = FormHelper::post('passWord');
        $errors   = [];

        // Validate email fields
        if (empty($email)) {
            $errors['email'] = "Adresse email requis";
        } else if (!FormHelper::validateField($email, FormHelper::EMAIL_REGEX)) {
            $errors['email'] = "Email invalide (format requis : email@example.com)";
        }

        // Validate password fields
        if (empty($passWord)) {
            $errors['password'] = "Mot de passe requis";
        } else if (!FormHelper::validateField($passWord, FormHelper::PASSWORD_REGEX)) {
            $errors['password'] = "Mot de passe invalide";
        }

        // If there are errors, display the Twig template with the errors
        if (!empty($errors)) {
            // Add the email and password values to the value array so the value will not be cleared after submission
            $value['emailValue']    = $email;
            $value['passwordValue'] = $passWord;
            $this->view('user/login.html.twig', ['errors' => $errors, 'value' => $value]);
        }

        // Attempt to retrieve the user based on the provided email
        $user     = $this->getManager(UserManager::class)->getUserByEmail($email);
        $userRole = $this->getManager(UserManager::class)->getUserRoleByEmail($email);

        if ($user === null) {
            // User not found
            $error = "Ce compte n'existe pas. Créez un compte pour vous connecter.";
            $this->view('user/login.html.twig', ['error' => $error]);
        }

        if (empty($userRole)) {
            $error = "Votre compte est suspendu. Veuillez contacter l'administrateur";
            $this->view('user/login.html.twig', ['error' => $error]);
        }

        // If the password matches, log in the user
        if (!password_verify($passWord, $user->getPassWord())) {
            // Password is incorrect
            $errors['password']  = "Mot de passe incorrect";
            $value['emailValue'] = $email;
            
            $this->view('user/login.html.twig', ['errors' => $errors]);

        }

        $this->session->connect($user, $userRole);

        if ($userRole === 'Admin') {
            header('Location: adminDashboard');
            exit;
        } else if ($userRole == "Visitor") {
            header('Location: posts');
            exit;
        }

    }

    /**
     * Handle user logout.
     */
    public function logout(): void
    {
        
        $this->session->destroy();

        header('Location: /mon-blog/login');
        exit;
    }

}