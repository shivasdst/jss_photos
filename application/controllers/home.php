<?php

class home extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function index() {
		
		$this->view('flat/Home/');
	}	

	public function flat() {
		
		$this->view('flat/Home/');
	}
}

?>