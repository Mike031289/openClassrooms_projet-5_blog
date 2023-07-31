<?php
	namespace App\Controllers;
	use App\Manager\PostManager;
	class HomeController extends BaseController{
		
			/**
     * @ListPosts calls the getAll() function of the PostManager class to retrieve the list of all posts and display them in a twig template
     */
    // public function ListPosts()
    // {
    //     $posts = $this->getManager(PostManager::class)->getAll();
    //     $this->view('blog/post.html.twig', ['posts' => $posts]);
    // }
		public function Home()
		{
		// 	$this->view("blog/home.html.twig", ['content'=>'Toto']);
			$posts = $this->getManager(PostManager::class)->getAll();
			$this->view("blog/home.html.twig", ['posts' => $posts]);	
		}

	}



