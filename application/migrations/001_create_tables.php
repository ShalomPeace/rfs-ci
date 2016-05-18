<?php 

class Migration_Create_tables extends RFS_Migration 
{
	private $tables = [
		'department', 
		'role',
		'user',
		'userrole', 
		'classification', 
		'request', 
		'requestexpenditure', 
		'requestattachment',
	];

	public function up() 
	{
		foreach ($this->tables as $table) {
			$method = 'create' . ucfirst($table) . 'Table';

			$this->$method($table);
		}

		$this->addForeignKey('department', 'added_by', 'user', 'user_id');
		$this->addForeignKey('role', 'added_by', 'user', 'user_id');
		$this->addForeignKey('user', 'department_id', 'department');
		$this->addForeignKey('user_role', 'user_id', 'user');
		$this->addForeignKey('user_role', 'role_id', 'role');
		$this->addForeignKey('classification', 'added_by', 'user', 'user_id');
		$this->addForeignKey('request', 'classification_id', 'classification');
		$this->addForeignKey('request', 'department_id', 'department');
		$this->addForeignKey('request', 'added_by', 'user', 'user_id');
		$this->addForeignKey('request_expenditure', 'request_id', 'request');
		$this->addForeignKey('request_attachment', 'request_id', 'request');
	}

	public function down() 
	{
		foreach ($this->table as $table) {
			$this->dbforge->drop_table($table);
		}
	}

	public function createDepartmentTable() 
	{
		$this->addField([
			'department_id' => [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
				'auto_increment'	=> TRUE,
			],
			'code'			=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 10, 
				'unique'			=> TRUE, 
			],
			'name'			=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 100,
			],
		]);

		$this->addActive();
		$this->addTimestamps();
		$this->addUserReference();

		$this->addKey('department_id', TRUE);

		$this->createTable('department');

		$this->addIndex('department', 'added_by');
	}

	public function createRoleTable() 
	{
		$this->addField([
			'role_id'	=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
				'auto_increment'	=> TRUE,
			],
			'name'		=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> '50', 
			],
			'permissions'	=> [
				'type'				=> 'TEXT',
				'default'			=> NULL,
			],
		]);

		$this->addActive();
		$this->addTimestamps();
		$this->addUserReference();

		$this->addKey('role_id', TRUE);

		$this->createTable('role');

		$this->addIndex('role', 'added_by');
	}

	public function createUserTable() 
	{
		$this->addField([
			'user_id'		=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
				'auto_increment'	=> TRUE,
			],
			'first_name'	=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 50, 
			],
			'last_name'		=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 50,
			],
			'email_address'	=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 100, 
				'unique'			=> TRUE, 
			],
			'password'				=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 60, 
			], 
			'department_id'	=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE,
			],
		]);

		$this->addActive();
		$this->addTimestamps();
		$this->addUserReference();

		$this->addKey('user_id', TRUE);

		$this->createTable('user');

		$this->addIndex('user', 'department_id');
		$this->addIndex('user', 'added_by');
	}

	public function createUserroleTable() 
	{
		$this->addField([
			'ur_id'		=> [
				'type'				=> 'INT', 
				'unsinged'			=> TRUE, 
				'auto_increment'	=> TRUE,
			],
			'user_id'	=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
			],
			'role_id'	=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE,
			],
		]);

		$this->addKey('ur_id', TRUE);

		$this->createTable('user_role');

		$this->addIndex('user_role', 'user_id');
		$this->addIndex('user_role', 'role_id');
	} 

	public function createClassificationTable() 
	{
		$this->addField([
			'classification_id'	=> [
				'type' 				=> 'INT', 
				'unsigned'			=> TRUE, 
				'auto_increment'	=> TRUE, 
			], 
			'code'				=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 10, 
			],
			'name'				=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 100,
			], 
			'description'		=> [
				'type'				=> 'TEXT', 
			], 
		]);

		$this->addActive();
		$this->addTimestamps();
		$this->addUserReference();

		$this->addKey('classification_id', TRUE);

		$this->createTable('classification');

		$this->addIndex('classification', 'added_by');
	}

	public function createRequestTable() 
	{
		$this->addField([
			'request_id'	=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
				'auto_increment'	=> TRUE,
			],
			'code'			=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 20, 
				'unique'			=> TRUE, 
			],
			'description'	=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 255,
			],
			'justification'	=> [
				'type'				=> 'TEXT', 
			],
			'classification_id'	=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
			],
			'department_id'		=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE,
			],
			'level'				=> [
				'type'				=> 'TINYINT', 
				'constraint'		=> 1, 
				'default'			=> 0,
			],
			'status'			=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 50, 
			], 
		]);

		$this->addActive();
		$this->addTimestamps();
		$this->addUserReference();

		$this->addKey('request_id', TRUE);

		$this->createTable('request');

		$this->addIndex('request', 'classification_id');
		$this->addIndex('request', 'department_id');
		$this->addIndex('request', 'added_by');
	}

	public function createRequestexpenditureTable() 
	{
		$this->addField([
			'req_exp_id' 		=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
				'auto_increment'	=> TRUE,  
			],
			'description'		=> [
				'type'				=> 'TEXT', 
			],
			'currency'			=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 5, 
			],
			'foreign_amount'	=> [
				'type'				=> 'DECIMAL', 
				'constraint'		=> '10,2', 
				'default'			=> '0.00', 
			],
			'exchange_rate'		=> [
				'type'				=> 'DECIMAL', 
				'constraint'		=> '10,2', 
				'default'			=> '0.00', 
			],
			'total_amount'		=> [
				'type'				=> 'DECIMAL', 
				'constraint'		=> '10,2', 
				'default'			=> '0.00',
			],
			'request_id'		=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE,
			],
		]);

		$this->addTimestamps();

		$this->addKey('req_exp_id', TRUE);

		$this->createTable('request_expenditure');

		$this->addIndex('request_expenditure', 'request_id');
	}

	public function createRequestattachmentTable() 
	{
		$this->addField([
			'req_attach_id'	=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
				'auto_increment'	=> TRUE, 
			],
			'file_name'		=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 50, 
			],
			'request_id'	=> [
				'type' 				=> 'INT', 
				'unsigned'			=> TRUE,
			],
		]);

		$this->addTimestamps();

		$this->addKey('req_attach_id', TRUE);

		$this->createTable('request_attachment');

		$this->addIndex('request_attachment', 'request_id');
	}
}
