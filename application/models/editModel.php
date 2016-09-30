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

	public function editAlbum($albumID) {

		$dbh = $this->db->connect(DB_NAME);
		if(is_null($dbh))return null;
		
		$sth = $dbh->prepare('SELECT * FROM ' . METADATA_TABLE_L2 . ' WHERE albumID = :albumID ORDER BY id');
		$sth->bindParam(':albumID', $albumID);

		$sth->execute();
		$data = array();
		
		while($result = $sth->fetch(PDO::FETCH_OBJ)) {

			array_push($data, $result);
		}

		$dbh = null;
		$data['albumDetails'] = $this->getAlbumDetails($albumID);
		return $data;


		// $file = PHY_PHOTO_URL . $albumID . ".json";
		// $albumDetails = file_get_contents($file);
		// $data = (object)json_decode($albumDetails, true);
		// return $data;
	}
}

?>