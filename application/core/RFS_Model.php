<?php 

class RFS_Model extends CI_Model 
{
	protected $connection = 'default'; 

	protected $table;

	protected $primaryKey = 'id';

	protected $attributes = [];

	protected $hidden = [];

	public function __construct($attributes = []) 
	{
		if (count($attributes)) $this->attributes = (array) $attributes;
	}

	public function find($id) 
	{
		return $this->db->where($this->primaryKey, $id)
						->get($this->table)
						->row(0, get_class($this));
	}

	public function select($select = '*', $escape = NULL) 
	{
		$this->db->select($select, $escape);

		return $this;
	}

	public function join($table, $cond, $type = '', $escape = NULL) 
	{
		$this->db->join($table, $cond, $type, $escape);

		return $this;
	}

	public function where($key, $value = NULL, $escape = NULL) 
	{
		$this->db->where($key, $value, $escape);

		return $this;
	}

	public function where_in($key = NULL, $values = NULL, $escape = NULL) 
	{
		$this->db->where_in($key, $values, $escape);

		return $this;
	}

	public function get($table = '', $limit = NULL, $offset = NULL) 
	{
		$table = $this->getTableName($table);

		$results = $this->db->get($table, $limit, $offset)->result();

		$class_name = get_class($this);

		$data = [];

		if (count($results)) {
			foreach ($results as $result) {
				$data[] = new $class_name($result);
			}
		}

		return $data;
	}

	public function getWith(array $relationships = [], $table = '') 
	{
		$results = $this->get($table);

		foreach ($relationships as $relationship) {
			$relative = $this->$relationship();

			$model 		= $relative['model'];
			$foreign 	= $relative['foreign'];
			$local 		= $relative['local'];
		
			$conditions = [];

			foreach ($results as $result) {
				$conditions[] = $result->$local;
			}

			$this->load->model($model);

			$data = $this->$model->where_in($foreign, $conditions)
						         ->get();

			if (count($data)) {
				foreach ($results as $result) {
					foreach ($data as $item) {
						if ($result->$local == $item->$foreign) {
							$result->$relationship = $item;
						}
					}
				}
			}
		}

		return $results;
	}

	public function first($table = '') 
	{
		$table = $this->getTableName($table);

		$result = $this->db->get($table)->row();

		$class_name = get_class($this);

		return new $class_name($result);
	}

	private function getTableName($table = '') 
	{
		return !empty($table) ? $table : $this->table;
	}

	public function createdAt($format = 'm/d/Y') 
	{
		return date($format, strtotime($this->created_at));
	}

	public function __get($key) 
	{
		$ci =& get_instance();

		if (isset($ci->$key)) return $ci->$key;
		if (isset($this->attributes[$key])) return $this->attributes[$key];

		if (method_exists($this, $key)) {
			$relative = $this->$key();

			$model 		= $relative['model'];
			$foreign 	= $relative['foreign'];
			$local   	= $relative['local'];

			$this->load->model($model);

			return $this->$model->where($foreign, $this->$local)
								->first();
		}
	}

	public function __call($method, $args = []) 
	{
		return call_user_func_array([$this->db, $method], $args);
	}

	public function __toString() 
	{
		$data = $this->attributes;

		if (count($this->hidden)) {
			foreach ($data as $key => $value) {
				if (in_array($key, $this->hidden)) {
					unset($data[$key]);
				}
			}
		}

		return json_encode($data);
	}
}
