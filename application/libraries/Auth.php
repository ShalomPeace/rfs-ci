<?php 

class Auth extends Library
{
	protected $user;

	public function __construct() 
	{
		parent::__construct();

		$this->ci->load->model('user_model');
		$this->ci->load->library('hash');
	}

	public function check() 
	{
		return $this->ci->session->has('user_id');
	}

	public function user() 
	{
		if ( ! $this->check()) return;

		if ( ! is_null($this->user)) return $this->user;

		$user = $this->ci->user_model->find($this->id());
	
		if ( ! $user) return;

		$this->user = $user;

		return $user;
	}

	public function login(array $credentials) 
	{
		$conditions = array_except($credentials, ['password']);

		foreach ($conditions as $column => $value) {
			$this->ci->user_model->where($column, $value);
		}

		$result = $this->ci->user_model->first();

		if ( ! $result) return false;

		if (!empty($credentials['password'])) 
		{
			if ($this->ci->hash->check($credentials['password'], $result->password)) {
				$this->ci->session->set('user_id', $result->user_id);

				$this->user = $result;

				return true;
			}
		}

		return false;
	}

	public function logout() 
	{
		$this->ci->session->destroy();

		$this->user = null;
	}

	public function id() 
	{
		return $this->ci->session->get('user_id');
	}
}
