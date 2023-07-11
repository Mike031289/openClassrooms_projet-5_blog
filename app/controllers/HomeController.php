<?php

	class HomeController extends BaseController{

		public function Home()
		{
			$this->view("blog/home.html.twig", ['content'=>'Toto']);	
		}

	}



