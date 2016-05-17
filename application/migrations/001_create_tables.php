<?php 

class Migration_Create_tables extends RFS_Migration 
{
	private $tables = [
		'department', 
		'user', 
		'classification', 
		'charge', 
		'costcenter',
		'request', 
		'requestexpenditure', 
		'requestattachment',
		'requestcostcenter',

	];

	public function up() 
	{
		foreach ($this->tables as $table) {
			$method = 'create' . ucfirst($table) . 'Table';

			$this->$method($table);
		}
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

	public function createChargeTable() 
	{
		$this->addField([
			'charge_id'		=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
				'auto_increment'	=> TRUE,
			], 
			'name'			=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 50, 
			],
		]);

		$this->addActive();
		$this->addTimestamps();
		$this->addUserReference();

		$this->addKey('charge_id', TRUE);

		$this->createTable('charge');

		$this->addIndex('charge', 'added_by');
	}

	public function createCostcenterTable() 
	{
		$this->addField([
			'cc_id' 		=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
				'auto_increment'	=> TRUE,
			], 
			'department_id'	=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
			],
		]);

		$this->addTimestamps();
		$this->addUserReference();

		$this->addKey('cc_id', TRUE);

		$this->createTable('cost_center');

		$this->addIndex('cost_center', 'department_id');
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
			'charge_id'			=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE, 
			],
			'status'			=> [
				'type'				=> 'VARCHAR', 
				'constraint'		=> 50, 
			], 
			'department_id'		=> [
				'type'				=> 'INT', 
				'unsigned'			=> TRUE,
			],
		]);

		$this->addActive();
		$this->addTimestamps();
		$this->addUserReference();

		$this->addKey('request_id', TRUE);

		$this->createTable('request');

		$this->addIndex('request', 'classification_id');
		$this->addIndex('request', 'charge_id');
		$this->addIndex('request', 'department_id');
		$this->addIndex('request', 'added_by');
	}

	public function createRequestexpenditureTable() 
	{

	}

	public function createRequestattachmentTable() 
	{

	}

	public function createRequestcostcenterTable() 
	{

	}
}
