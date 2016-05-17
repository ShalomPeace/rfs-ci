<?php 

class Error extends Library 
{
	public function has($name) 
	{
		return ! is_null($this->ci->session->getFlash($name));
	}

	public function get($name, $default = null) 
	{
		return $this->ci->session->getFlash($name) ?: $default;
	}
}
