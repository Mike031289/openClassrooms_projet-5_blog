<?php
namespace App\Controllers;
use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;

class UserController extends BaseController
{
    public function __construct($httpRequest, $config)
    {
        parent::__construct($httpRequest, $config);
    }

    public function login(){
      // $users = $this->getManager(UserManager::class)->getAll();

      $this->view('user/login.html.twig', []);
    }

    public function register(){
      if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
      } else {
          // Handle the case where required fields are missing
          // echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          //         <strong>Oupsss!</strong> Veuillez remplir correctement les champs
          //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          //       </div>';
      }
      // $user = $this->getManager(UserManager::class)->getById();

      // Pass the article information to your Twig view for display
      $this->view('user/register.html.twig', []);
    }
}