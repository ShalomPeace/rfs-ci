<?php 

class RFS_Form_validation extends CI_Form_validation 
{
	protected $validations;

	public function __construct() 
	{
		parent::__construct();
	}

	public function make($validations) 
	{
		$this->validations = $validations;

		foreach ($this->validations as $name => $rules) {
			$label = ucfirst($name);
			$this->set_rules($name, $label, $rules);
		}

		return $this;
	}

	public function passed() 
	{
		return $this->run();
	}

	public function fails() 
	{
		return ! $this->passed();
	}

	public function messages() 
	{
		$messages = [];

		foreach ($this->validations as $name => $rules) {
			$messages[$name] = $this->error($name, null, null);
		}

		return $messages;
	}
}
