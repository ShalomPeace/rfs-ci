<?php 

class Redirect extends Library 
{
	public function __construct() 
	{
		parent::__construct(); 

		$this->ci->load->helper('url');
	}

	public function to($uri = '', $method = 'auto', $code = null) 
	{
		redirect($uri, $method, $code);
	}

	public function with($item = [], $value = null) 
	{
		$this->ci->session->setFlash($item, $value);

		return $this;
	}

	public function withErrors(CI_Form_validation $validator) 
	{
		$this->ci->session->setFlash($validator->messages());

		return $this;
	}
}
