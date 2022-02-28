<?php
if (isset($_POST['$user_name1']) && isset($_POST['$email_address1']) && 
	 isset($_POST['$password1'])	&& isset($_POST['$password_again1']))
	{
		// Connexion to Database
		require_once("connexion.php");
		
		$user_name     = $_POST['$user_name1'];
    $email_address = $_POST['$email_address1'];
		$password      = $_POST['$password1'];	
		// $password      = md5($password);
		$request = $connBD->prepare
					('SELECT email_address FROM user_profile WHERE email_address = :email_address1');
		$request->bindParam(':email_address1', $email_address);   
		$request->execute();					
		if ($data = $request->fetch())
			echo "Created";
		else
		{
			$reqAdd = $connBD->prepare('INSERT INTO user_profile(user_name, email_address, password) 
						VALUES(:user_name1, :email_address1, :password1)');				
			if ($reqAdd)
			{				
				$reqAdd->execute(array('user_name1'=>$user_name,'email_address1'=>$email_address, 'password1'=>$password ));					
			
				echo 'Done';
				$reqAdd->closeCursor();
			}
			else
				echo 'Fail Creation';
			// Create userID 
			
		}
	}
	else
	{
		echo 'Fail';
	}	
?>

