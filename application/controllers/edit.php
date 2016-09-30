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

	public function album($albumID) {

		$data = $this->model->editAlbum($albumID);
		($data) ? $this->view('edit/album', $data) : $this->view('error/index');
	}

}

?>