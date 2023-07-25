<?php
class PostController extends BaseController
{
    public function __construct($httpRequest, $config)
    {
        parent::__construct($httpRequest, $config);

    }
    /**
     * @ListPosts calls the getAll() function of the PostManager class to retrieve the list of all posts and display them in a twig template
     */
    public function ListPosts()
    {
        $posts = $this->PostManager->getAll();
        $this->view('blog/post.html.twig', ['posts' => $posts]);
    }
   
}
