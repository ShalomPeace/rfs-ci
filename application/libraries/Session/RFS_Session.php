<?php 

class RFS_Session extends CI_Session 
{
	public function get($item, $default = null) 
	{
		return $this->userdata($item) ?: $default;
	}

	public function has($item) 
	{
		$data = $this->get($item);

		return $data ? true : false;
	}

	public function all(array $except = []) 
	{
		$data = $this->all_userdata();

		foreach ($except as $item) {
			if (isset($data[$item])) {
				unset($data[$item]);
			}
		}

		return $data;
	}

	public function set($items = [], $value = null) 
	{
		return $this->set_userdata($items, $value);
	}

	public function delete($item) 
	{
		$this->unset_userdata($item);
	}	

	public function getFlash($item = '') 
	{
		return $this->flashdata($item);
	}

	public function setFlash($item = [], $value = null) 
	{
		$this->set_flashdata($item, $value);
	}

	public function keepFlash($item) 
	{
		return $this->keep_flashdata($item);
	}

	public function destroy() 
	{
		$this->sess_destroy();
	}
}
