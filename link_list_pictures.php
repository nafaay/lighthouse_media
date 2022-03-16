<?php
	session_start();
	if (isset($_POST['album_id1'])){

		// Connexion to Database
		require_once("connexion.php");
		$album_id = $_POST['album_id1'];
		$request = $connBD->prepare
					('SELECT * FROM pictures WHERE album_id = :album_id1');
		$request->bindParam(':album_id1', $album_id);   
		$request->execute();
		$array_pictures = [];
		$pictures = '';					
		while ($data = $request->fetch()){
			$filename = $data['filename'];
			array_push($array_pictures, $filename);		
		}
		$pictures = implode(',', $array_pictures);
		$_SESSION['pictures'] = $pictures;
		
		echo $pictures;
}	

