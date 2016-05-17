<?php 

class User_repository extends Repository 
{
	protected $modelName = 'user_model';

	public function getUsers() 
	{
		return $this->ci->user_model->where('active', 1)
						            ->getWith(['department', 'addedby']);
	}

	public function find($id) 
	{
		return $this->ci->user_model->find($id);
	}
}
