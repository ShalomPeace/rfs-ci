<?php 

class User extends RFS_Controller 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->model('repositories/user_repository');
	}

	public function index() 
	{
		$this->data['users'] = $this->user_repository->getUsers();

		$this->view('users/index');
	}

	public function profile($user_id) 
	{
		$this->data['user'] = $this->user_repository->find($user_id);

		$this->view('users/profile');
	}

	public function edit($user_id) 
	{
		$this->view('users/d');
	}

	public function add() 
	{
		$this->data['departments'] = $this->department_repository->getActive();

		$this->view('users/add');
	}
}
