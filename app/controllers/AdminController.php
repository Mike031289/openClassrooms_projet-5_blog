<?php
	namespace App\Controllers;
	use App\Manager\AdminManager;
	class AdminController extends BaseController
	{
		
			/**
     * @getAll() function of the AdminManager class is called to retrieve the list of all posts and display them in a twig template
     */

		public function admin()
		{
			$admin = $this->getManager(AdminManager::class)->getAll();
			$this->view("admin/adminDashboard.html.twig", ['admin' => $admin]);	
		}

	}