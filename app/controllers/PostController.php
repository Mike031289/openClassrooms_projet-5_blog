<?php
namespace App\Controllers;
use App\Manager\PostManager;
class PostController extends BaseController
{
    public function __construct($httpRequest, $config)
    {
        parent::__construct($httpRequest, $config);

    }

    /**
     * @ListPosts calls the getAll() function of the PostManager class to retrieve the list of all posts and display them in a twig template
     */
    public function listPosts()
    {
        $posts = $this->getManager(PostManager::class)->getAll();
        $this->view('blog/posts.html.twig', ['posts' => $posts]);
    }

    /**
     * @function showPost() calls the getById($id) function of the PostManager"who extends BaseManager Class" to retrieve the specifique post from all posts and display the content in a twig template
     * @param $id
     */
    public function showPost($id)
    {
        // Utilisez l'identifiant pour récupérer les informations de l'article depuis votre gestionnaire d'articles (ArticleManager)
        $post = $this->getManager(PostManager::class)->getById($id);
        // var_dump($post);
        // Passez les informations de l'article à votre vue Twig pour l'affichage
        $this->view('blog/post.html.twig', ['post' => $post]);
    }
}
