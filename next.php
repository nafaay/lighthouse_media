<?php
		session_start();
		// if (isset($_SESSION['start']))
		// {
		// 	if ($_SESSION['start'] == "MyAlbums")
		// 		header("location:MyAlbums.php");
		// 	if ($_SESSION['start'] == "Upload")	
		// 		header("location:UploadPictures.php");
		// 	if ($_SESSION['start'] == "MyPictures")	
		// 		header("location:MyPictures.php");
		// 	if ($_SESSION['start'] == "MyFriends")
		// 		header("location:MyFriends.php");
		// 	if ($_SESSION['start'] == "Index")
		// 		header("location:index.php");
		// 	exit();
		// }
		// else
		// {
			
			header("location:index.php");
			exit();
		// }
?>