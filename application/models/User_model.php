<?php 

class User_Model extends RFS_Model 
{
	protected $table = 'user'; 

	protected $primaryKey = 'user_id';

	protected $hidden = ['password'];

	public function department() 
	{
		return [
			'model'		=> 'department_model', 
			'foreign'	=> 'department_id', 
			'local'		=> 'department_id',
		];
	}

	public function addedby() 
	{
		return [
			'model'		=> 'user_model', 
			'foreign'	=> 'user_id', 
			'local'		=> 'added_by',
		];
	}
}
