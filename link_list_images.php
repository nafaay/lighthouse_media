<?php
	session_start();
	if (isset($_POST['album_id1'])){

		// Connexion to Database
		require_once("connexion.php");
		$album_id = $_POST['album_id1'];
		$request = $connBD->prepare
					('SELECT * FROM image WHERE album_id = :album_id1');
		$request->bindParam(':album_id1', $album_id);   
		$request->execute();
		$array_images = [];
		$images = '';					
		while ($data = $request->fetch()){
			$filename = $data['filename'];
			array_push($array_images, $filename);		
		}
		$images = implode(',', $array_images);
		echo $images;

}	
?>

