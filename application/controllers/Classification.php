<?php 

class Classification extends RFS_Controller 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->library('repositories/classification_repository', 'classification_repository');
	}

	public function index() 
	{
		$classifications = $this->classification_repository->getAll();

		$this->view('classifications/index', ['classifications' => $classifications]);
	}

	public function show($classification_id) 
	{
		$classification = $this->classification_repository->find($classification_id);

		$this->view('classifications/show', ['classification' => $classification]);
	}

	public function create() 
	{
		$this->view('classifications/create');
	}

	public function store() 
	{
		// 
	}

	public function edit($classification_id) 
	{
		$classification = $this->classification_repository->find($classification_id);

		$this->view('classifications/edit', ['classification' => $classification]);
	}

	public function update($classification_id) 
	{
		//
	}
}
