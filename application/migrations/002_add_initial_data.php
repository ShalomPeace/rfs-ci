<?php 

class Migration_Add_initial_data extends CI_Migration 
{
	public function up() 
	{
		$this->load->library('hash');

		$timestamp = date('Y-m-d h:m:s');

		// Add superuser
		$this->db->insert('user', [
			'first_name'	=> 'Super', 
			'last_name'		=> 'User', 
			'email_address'	=> 'superuser@mullenlowe.com', 
			'password'		=> $this->hash->make('mullenlowe'), 
			'department_id'	=> 1, 
			'active'		=> 1, 
			'created_at'	=> $timestamp,
			'updated_at'	=> $timestamp,
			'added_by'		=> 1,
		]);

		// Add department
		$this->db->insert('department', [
			'code'			=> 'ADM', 
			'name'			=> 'Administration', 
			'active'		=> 1, 
			'created_at'	=> $timestamp, 
			'updated_at'	=> $timestamp, 
			'added_by'		=> $this->db->insert_id(),	
		]);
	}

	public function down() 
	{
		$this->db->where('email_address', 'superuser@mullenlowe.com')
				 ->delete('user');

		$this->db->where('code', 'ADM')
				 ->delete('department');
	}
}
