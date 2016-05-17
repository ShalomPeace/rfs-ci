<?php 

class Migrate extends RFS_Controller 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->library('migration');
	}

	public function version($version) 
	{
		if ($this->migration->version($version)) {
			echo 'Done!';	
		} else {
			show_error($this->migration->error_string());
		}
	} 

	public function current() 
	{
		if ( ! $this->migration->current()) {
			show_error($this->migration->error_string());
		}
	}
}
