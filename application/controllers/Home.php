<?php 

class Home extends RFS_Controller 
{
	public function index() 
	{
		if ( ! $this->auth->check()) {
			$this->getLogin();
		} else {
			$this->getDashboard();
		}
	}

	public function getLogin() 
	{
		$this->view('auth/login');
	}

	public function getDashboard() 
	{
		$this->view('home/dashboard');
	}
}
