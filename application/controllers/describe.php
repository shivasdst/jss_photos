<?php

class describe extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function index() {

		$this->photo();
	}

	public function photo($albumID = DEFAULT_ALBUM, $id = '') {

		$data = $this->model->getPhotoDetails($albumID, $id);
		$data->neighbours = $this->model->getNeighbourhood($albumID, $id);
		
		($data) ? $this->view('describe/photo', $data) : $this->view('error/index');
	}

	public function collection($collection = DEFAULT_COLLECTION) {

		$data = $this->model->getAlbums($collection);
		($data) ? $this->view('describe/collection', $data) : $this->view('error/index');		
	}

}

?>