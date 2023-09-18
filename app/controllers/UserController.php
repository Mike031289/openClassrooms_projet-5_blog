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

            // Utilisez la méthode create de UserManager pour créer l'objet User
            $user = $this->getManager(UserManager::class)->create( $userData);
// var_dump($user); die;
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $passWord = $_POST['passWord'];
    
            // Utilisez la méthode getUserByEmail de UserManager pour obtenir l'utilisateur par email
            $user = $this->getManager(UserManager::class)->getUserByEmail($email);

            if ($user) {
                var_dump($user);

                // Vérifiez le mot de passe en utilisant password_verify
                if (password_verify($passWord, $user->getPassWord())) {
                    // Mot de passe correct, connectez l'utilisateur
                    session_start();
                    $_SESSION['user'] = $user;
                    echo "salut mike"; die;
                    // Rediriger vers une page protégée (par exemple, le tableau de bord)
                    header('Location: ' . $this->_config->baseUrl . '/mon-blog/dashboard');
                    exit;
                } else {
                    // Mot de passe incorrect, afficher une erreur
                    $errorMessage = "Mot de passe incorrect.";
                    $this->view('user/login.html.twig', ['error' => $errorMessage]);
                    exit;
                }
            } else {
                // Utilisateur non trouvé, afficher une erreur
                $errorMessage = "Ce compte n'existe pas";
                $this->view('user/login.html.twig', ['error' => $errorMessage]);
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