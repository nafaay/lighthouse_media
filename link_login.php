<?php
	session_start();
	if (isset($_POST['email_address1']) && isset($_POST['password1']))
	{
		// Connexion to Database
		require_once("connexion.php");
		
		$email_address = $_POST['email_address1'];
		$password      = $_POST['password1'];	
		$password 	 = trim(md5($password));
		$request = $connBD->prepare
					('SELECT id, email_address, name FROM users WHERE email_address = :email_address1 AND password = :password1');
		$request->bindParam(':email_address1', $email_address);   
		$request->bindParam(':password1' , $password);   
		$request->execute();					
		if ($data = $request->fetch()){
			$_SESSION['user_name'] = $data['name'];
			$_SESSION['email_address'] = $data['email_address'];
			$_SESSION['id'] = $data['id'];
			echo "Found";	
			$_SESSION['name'] = 'x';
		
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

