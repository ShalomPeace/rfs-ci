<?php 

class Repository 
{
	protected $ci;

	protected $modelName;

	public function __construct() 
	{
		$this->ci =& get_instance();

		if ( ! is_null($this->modelName)) {
			$this->ci->load->model($this->modelName);
		}
	}
}
