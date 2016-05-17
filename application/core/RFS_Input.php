<?php 

class RFS_Input extends CI_Input 
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function data($index = '', $default = null, $xss_clean = TRUE) 
	{
		return $this->get_post($index, $xss_clean) ?: $default;
	}

	public function isAjax() 
	{
		return $this->is_ajax_request();
	}

	public function isCli() 
	{
		return $this->is_cli_request();
	}
}
