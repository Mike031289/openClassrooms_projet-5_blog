<?php
class PostController extends BaseController
{
    public function __construct($httpRequest, $config)
    {
        parent::__construct($httpRequest, $config);
    }

    public function ListPosts()
    {
        $posts = $this->PostManager->getAll();
         $this->view('post.twig', ['content' => $posts]);

    }

}


        // $homPost = $this->addParam('posts', $posts);
        // var_dump($homPost);
        // $this->view('post.twig', $this->_param);

        

         // Instancier le manager des articles
        //  $postManager = new PostManager($this->_config->database);

         // Récupérer tous les articles
 
         // Passer les articles au template pour l'affichage
