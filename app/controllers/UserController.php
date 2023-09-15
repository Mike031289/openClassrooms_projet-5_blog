<?php
namespace App\Controllers;

use App\Manager\UserManager;

  class UserController extends BaseController
{
    public function __construct($httpRequest, $config)
    {
        parent::__construct($httpRequest, $config);
    }

    // User registration
    public function register() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupérer les données du formulaire
            $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $passWord = $_POST['passWord'];
            $passWordConfirm = $_POST['passWordConfirm'];

            // Vérifier si les champs ne sont pas vides et si les mots de passe correspondent
            if (empty($userName) || empty($email) || empty($passWord) || empty($passWordConfirm) || $passWord !== $passWordConfirm) {
                // Gérer l'erreur, par exemple, afficher un message à l'utilisateur
                $errorMessage = "Veuillez vérifier les champs du formulaire.";
                $this->view('user/register.html.twig', ['error' => $errorMessage]);
                return; // Arrêter le traitement si des champs sont vides ou si les mots de passe ne correspondent pas
            }

            // Hacher le mot de passe
            $hashedPassword = password_hash($passWord, PASSWORD_DEFAULT);

            // Obtenir la date actuelle
            $createdAt = date('Y-m-d H:i:s');

            // Créer un tableau associatif des données de l'utilisateur
            $userData = [
                'userName' => $userName,
                'email' => $email,
                'passWord' => $hashedPassword,
                'createdAt' => $createdAt,
            ];
            // var_dump($userData);die;

            // Utilisez la méthode create de UserManager pour créer l'objet User
            $user = $this->getManager(UserManager::class)->create( $userData);

            // var_dump($user);die;
            // Enregistrez l'utilisateur dans la base de données (votre mise en œuvre ici)

            // Rediriger vers la page de connexion
            header('Location: ' . $this->baseUrl . '/mon-blog/login');
            exit;
        }

        // Afficher le formulaire d'inscription
        $this->view('user/register.html.twig', []);
    }

    // User login
    public function login() {
         // $users = $this->getManager(UserManager::class)->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $passWord = $_POST['passWord'];

            // Retrieve user from the database by email (your implementation here)

            if ($user && passWord_verify($passWord, $user->getPassWord())) {
                // Start a session and log the user in
                session_start();
                $_SESSION['user'] = $user;

                // Redirect to a protected page
                // header('Location: {$config->baseUrl} /dashboard');
                echo "espace Admin";
                exit;
            } else {
                // Invalid credentials, show error
                $error = 'Invalid email or passWord';
                $this->view('user/login.html.twig', []);

                exit;
            }
        }

        $this->view('user/login.html.twig', []);

    }

    // User logout
    public function logout() {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
        header('Location: {$config->baseUrl}/login');
        exit;
    }
}