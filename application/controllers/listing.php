<?php


class listing extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function index() {

		$this->albums();
	}


	public function albums() {
		
		$data = $this->model->getGetData();
		
		unset($data['url']);
		
		if(!(isset($data["page"]))){
		
			$data["page"] = 1;
		
		}
		
		$result = $this->model->listAlbums($data);
		
		if($data["page"] == 1){
		
			($result) ? $this->view('listing/albums', $result) : $this->view('error/index');
		
		}
		else{
		
			echo json_encode($result);
		
		}
	}

	public function photos($album = DEFAULT_ALBUM) {
		
		$data = $this->model->getGetData();
		
		unset($data['url']);
		
		if(!(isset($data["page"]))){
		
			$data["page"] = 1;
		
		}
	
		$result = $this->model->listPhotos($album,$data);

		if($data["page"] == 1){
		
			($result) ? $this->view('listing/photos', $result) : $this->view('error/index');
			// var_dump($result);	
		}
		else{
			
			echo json_encode($result);			
		}
	}

	public function collections() {
		
		$data = $this->model->getGetData();
		
		unset($data['url']);
		
		if(!(isset($data["page"]))){
		
			$data["page"] = 1;
		
		}
	
		$result = $this->model->listCollections($data);
		// var_dump($result);
		if($data["page"] == 1){
		
			($result) ? $this->view('pinterest/collections', $result) : $this->view('error/index');
		
		}
		else{
			
			echo json_encode($result);			
		}
	}

}

?>