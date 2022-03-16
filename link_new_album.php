<?php
session_start();
if (isset($_POST['title1']))
	{
		date_default_timezone_set("America/Toronto");
		// Connexion to Database
		require_once("connexion.php");
		$title 	     = $_POST['title1'];
		$shared      = $_POST['shared1'];	
		$description = $_POST['description1'];
		$date 			= date('Y-m-d');
		$id 		= $_SESSION['id'];

		$reqAdd = $connBD->prepare('INSERT INTO albums(user_id, album_title, album_date, album_description, album_shared) 
					VALUES(:user_id1, :title1, :date_updated1, :description1, :shared1)');				
			if ($reqAdd)
			{				
				$reqAdd->execute(array('user_id1'=>$id, 'title1'=>$title, 'date_updated1'=>$date, 
										'description1'=>$description, 'shared1' =>$shared));					
			
				echo 'Done';
				$_SESSION['albums'] = 'created';
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

