<?php
namespace App\Controllers;
use App\Manager\CommentManager;
class CommentController extends BaseController
{
    public function __construct($httpRequest, $config)
    {
        parent::__construct($httpRequest, $config);

    }

    /**
     * @function displayComment() calls the getById($id) function of the PostManager"who extends BaseManager Class" to retrieve the specifique post from all posts and display the content in a twig template
     * @param $id
     */
    public function showComment()
    {
        // Utilisez l'identifiant pour récupérer les informations de l'article depuis votre gestionnaire d'articles (ArticleManager)
        $comment = $this->getManager(CommentManager::class)->getAll();
        var_dump($comment); die;
        // Passez les informations de l'article à votre vue Twig pour l'affichage
        $this->view('blog/post.html.twig', ['comment' => $comment]);
    }
}
