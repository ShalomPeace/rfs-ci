<?php 

class Hash 
{
	private $options = [
		'cost'	=> 10,
	];

	public function make($string, $options = [])
	{
		$options = array_merge($this->options, $options);

		return password_hash($string, PASSWORD_DEFAULT, $options);
	}

	public function check($string, $hash) 
	{
		return password_verify($string, $hash);
	}
}
