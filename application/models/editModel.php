<?php


class editModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function editPhoto($albumID,$photoID) {

		$file = PHY_PHOTO_URL . $albumID . "/" . $photoID . ".json";
		$photoDetails = file_get_contents($file);
		$data = (object)json_decode($photoDetails, true);
		$data->albumID = $albumID;
		return $data;
	}
}

?>