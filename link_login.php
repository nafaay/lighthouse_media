<?php
	session_start();
	if (isset($_POST['email_address1']) && isset($_POST['password1']))
	{
		// Connexion to Database
		require_once("connexion.php");
		
		$email_address = $_POST['email_address1'];
		$password      = $_POST['password1'];	
		$password 	   = trim($password);
		
		$request = $connBD->prepare
					('SELECT email_address, user_name FROM user_profile WHERE email_address = :email_address1 AND password = :password1');
		$request->bindParam(':email_address1', $email_address);   
		$request->bindParam(':password1' , $password);   
		$request->execute();					
		if ($data = $request->fetch()){
			$_SESSION['user_name'] = $data['user_name'];
			echo "Found";			
		}
		else
		{
			echo "NotFound";
		}
	}
	else
	{
		echo 'Fail';
	}	
	$request->closeCursor();
	
?>

