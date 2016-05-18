<?php 

class RFS_Migration extends CI_Migration 
{
	public function addField($fields) 
	{
		$this->dbforge->add_field($fields);
	}

	public function addActive() 
	{
		$this->addField([
			'active' => [
				'type'		 => 'TINYINT', 
				'constraint' => 1, 
				'default'	 => 1,
			]
		]);
	}

	public function addTimestamps() 
	{
		$this->addField([
			'created_at' => [
				'type'	 	=> 'TIMESTAMP', 
				'default' 	=> '0000-00-00 00:00:00', 
			],
			'updated_at' => [
				'type'	 	=> 'TIMESTAMP', 
				'default' 	=> '0000-00-00 00:00:00',
			],
		]);
	}

	public function addSoftDeletes() 
	{
		$this->addField([
			'deleted_at' => [
				'type'		=> 'TIMESTAMP', 
				'null'		=> TRUE,
			],
		]);
	}

	public function addUserReference() 
	{
		$this->addField([
			'added_by'	=> [
				'type'		=> 'INT', 
				'unsigned'	=> TRUE,
			],
		]);
	}

	public function addKey($field, $primary = FALSE) 
	{
		$this->dbforge->add_key($field, $primary);
	}

	public function addIndex($table_name, $field) 
	{
		$this->db->query("ALTER TABLE `{$table_name}` ADD INDEX (`{$field}`)");
	}

	public function addForeignKey($table, $foreignKey, $otherTable, $otherKey = null) 
	{
		$otherKey = is_null($otherKey) ? $foreignKey : $otherKey;

		$this->db->query("ALTER TABLE `{$table}` ADD FOREIGN KEY (`{$foreignKey}`) REFERENCES `{$otherTable}`(`{$otherKey}`) ON DELETE RESTRICT ON UPDATE CASCADE;");
	}

	public function createTable($name) 
	{
		$this->dbforge->create_table($name);
	}
}
