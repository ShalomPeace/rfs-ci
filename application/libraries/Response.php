<?php 

class Response extends Library 
{
	public function json($data, $return = false) 
	{
		$json = json_encode($data);

		if (! $return) {
			echo $json; exit;
		}

		return $json;
	}
}
