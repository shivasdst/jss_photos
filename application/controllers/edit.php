<?php


class edit extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function index() {

	}

	public function photo($albumID, $photoID) {

		$data = $this->model->editPhoto($albumID, $photoID);
		($data) ? $this->view('edit/photo', $data) : $this->view('error/index');
	}

}

?>