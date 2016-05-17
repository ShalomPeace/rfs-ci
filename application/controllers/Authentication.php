<?php 

class Authentication extends RFS_Controller 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation');
	}

	public function login() 
	{
		$validator = $this->form_validation->make([
						'email'		=> 'required|valid_email', 
						'password'	=> 'required',
					]);

		if ($validator->fails()) {
			! $this->input->isAjax() ? $this->redirect->with('error', messages('login.error'))
													  ->withErrors($validator)
													  ->to('/')
									 : $this->response->json([
									 		'status'	=> 0, 
									 		'message'	=> messages('login.error'), 
									 		'errors'	=> $validator->messages(),
									 	]);
		}

		$email 		= $this->input->data('email');
		$password 	= $this->input->data('password');
	
		if ($this->auth->login(['email_address' => $email, 'password' => $password])) {
			$user = $this->auth->user();

			! $this->input->isAjax() ? $this->redirect->with('success', messages('login.welcome', $user->first_name))
													  ->to('/')
								     : $this->response->with('success', messages('login.welcome', $user->first_name))
								     				  ->json([
								     				  	'status'	=> 1, 
								     				  	'message'	=> messages('login.success'), 
								     				  	'redirect'	=> route('/'),
								     				  ]);
		}

		! $this->input->isAjax() ? $this->redirect->with('error', messages('login.error'))
												  ->to('/')
								 : $this->response->json([
								 		'status'	=> 0, 
								 		'message'	=> messages('login.error'),
								 	]);
	}

	public function logout() 
	{
		$this->auth->logout();

		$this->redirect->to('/');
	}
}
