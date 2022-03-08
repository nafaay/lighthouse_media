<?php
session_start();

if (isset($_POST['album_id1'])){
		date_default_timezone_set("America/Toronto");
		$date = date('Y-m-d');
		// Connexion to Database
		require_once("connexion.php");
		$album_id = $_POST['album_id1'];
    $title= $_POST['title1'];
    $description= $_POST['description1'];
    $filename= $_POST['filename1'];
		$reqAdd = $connBD->prepare('INSERT INTO image(album_id, filename, title, description, date_added ) 
					VALUES(:album_id1, :filename1, :title1, :description1, :date_added1)');				
			if ($reqAdd)
			{				
				$reqAdd->execute(array(
					'album_id1'=>$album_id, 
					'filename1'=>$filename, 
					'title1'=>$title, 
					'description1'=>$description, 
					'date_added1' =>$date));					
			
				echo 'Done';
				$reqAdd->closeCursor();
			}
			else
				echo 'Fail Creation';
	}
	else
	{
		echo 'Fail';
	}	

?>
