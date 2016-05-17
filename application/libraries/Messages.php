<?php 

class Messages extends Library 
{
	public function get($item, $param = '') 
	{
		return $item;
	}

	public function data($param = '') 
	{
		return [
			'login'	=> [
				'success'	=> 'Login successful! Redirecting...', 
				'error'		=> 'Login failed! Invalid email or password', 
				'welcome'	=> 'Welcome ' . $param,
			],
		];
	}
}
