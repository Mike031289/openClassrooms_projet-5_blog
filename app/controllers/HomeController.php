<?php
	namespace App\Controllers;
	use App\Manager\PostManager;
	class HomeController extends BaseController
	{
		
			/**
     * @getAll() function of the PostManager class is called to retrieve the list of all posts and display them in a twig template
     */

		public function home()
		{
			$posts = $this->getManager(PostManager::class)->getAll();
			$this->view("blog/home.html.twig", ['posts' => $posts]);	
		}

	}



