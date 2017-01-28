<?php

class dataModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function listFiles($path, $type) {

		return glob($path . '*.' . $type);
	}

	public function insertAlbums($albums, $dbh) {

		foreach ($albums as $album) {
			
			$data['albumID'] = preg_replace('/.*\/(.*)\.json/', "$1", $album);
			$data['description'] = $this->getJsonFromFile($album);
			
			$this->db->insertData(METADATA_TABLE_L1, $dbh, $data);
		}
	}

	public function insertPhotos($photos, $dbh) {

		foreach ($photos as $photo) {
			
			$data['id'] = preg_replace('/.*\/(.*)\.json/', "$1", $photo);
			$data['albumID'] = preg_replace('/.*\/(.*)\/.*\.json/', "$1", $photo);
			$data['id'] = $data['albumID'] . "__" . $data['id'];
			$albumDescription = $this->getAlbumDetails($data['albumID']);
			$albumDescription = $albumDescription->description;
			$photoDescription = $this->getJsonFromFile($photo);
			
			$data['description'] = json_encode(array_merge(json_decode($photoDescription, true), json_decode($albumDescription, true)),JSON_UNESCAPED_UNICODE);

			$this->db->insertData(METADATA_TABLE_L2, $dbh, $data);
		}
	}

	public function getJsonFromFile($path) {

		return file_get_contents($path);
	}

	public function getChangesFromGit($repo) {

		// Get status in porcelain mode
		$status = (string) $repo->status();

		// Replace '??' with A which means untracked files which are to be added
		$status = str_replace('??', 'A', $status);
		$status = preg_replace('/\h+/m', ' ', $status);
		$status = preg_replace('/^\h/m', '', $status);

		$lines = preg_split("/\n/", $status);

		
		$files['A'] = $files['M'] = $files['D'] = array();

		foreach ($lines as $file) {
			
			// Extract files into three bins - A->Added, M->Modified and D->Deleted. 
			if((preg_match('/^([AMD])\s(.*)/', $file, $matches)) && (preg_match('/public\/Photos/', $file))) {

				array_push($files[$matches[1]], $matches[2]);
			}
		}

		return $files;
	}

	public function gitProcess($repo, $files, $operation, $message, $user) {

		if(($operation == 'addAll')&&(is_array($files))) {

			$path = preg_replace('/(.*)\/.*/' , "$1", $files[0]);
			$repo->run('add --all ' . $path);
		}
		else{

			foreach ($files as $file) {
				
				$repo->{$operation}($file);
			}
		}

		// $message = str_replace(':journal', $journal, $message);
		$repo->run('-c "user.name=' . $user['name'] . '" -c "user.email=' . $user['email'] . '" commit -m "' . escapeshellarg($message) . '"');
	}

	public function formatStatus($statements) {

		$status = '<ul>';
		foreach ($statements as $statement) {
	
			$status .= '<li>' . $statement . '</li>';
		}
		$status .= '</ul>';
		return $status;
	}

}

?>
