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
		
		$data = $this->model->getGetData();
		
		unset($data['url']);
		
		if(!(isset($data["page"]))){
		
			$data["page"] = 1;
		
		}
		
		$result = $this->model->getAlbums($collection,$data);

		if($data["page"] == 1){
		
			($result) ? $this->view('describe/collection', $result) : $this->view('error/index');
		
		}
		else{
		
			echo json_encode($result);
		
		}
	}
}

?>