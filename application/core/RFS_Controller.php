<?php 

class RFS_Controller extends CI_Controller 
{
	protected $data = [];

	protected $title; 

	public function __construct() 
	{
		parent::__construct();
	}

	public function view($view, array $data = array(), $returnAsData = false) 
	{
		$this->data['title'] = 'RFS' . (!empty($this->title) ? " | {$this->title}" : '');

		$view = $this->load->view($view, $this->data, true);

		if ($returnAsData) {
			return $view;
		}

		$this->data['content'] = $view;

		$this->load->view('layout/template', $this->data);
	}
}
