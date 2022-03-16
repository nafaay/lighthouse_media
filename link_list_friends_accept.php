<?php
	session_start();
	if(isset($_POST['email_address1'])){
		// Connexion to Database
		require_once("connexion.php");

		$id_requester = $_SESSION['id'];
		$id_requestee = 0;
		$email_address = $_POST['email_address1'];
		$status = 'A';
		$request = $connBD->prepare('SELECT id  FROM user_profile 
																WHERE email_address = :email_address1');
		$request->bindParam(':email_address1', $email_address);   
		$request->execute();				
		if ($data = $request->fetch()){
			$id_requestee = $data['id'];
		}
	
		$reqAdd = $connBD->prepare('INSERT INTO requests(requester_id, requestee_id, status) 
				VALUES(:requester_id1, :requestee_id1, :status1)');				
		if ($reqAdd){
			$reqAdd->execute(array('requester_id1'=>$id_requester,'requestee_id1'=>$id_requestee,'status1'=>$status));								
			// echo $user_name;
			$reqAdd->closeCursor();
		}


		$reqModif = $connBD->prepare("UPDATE requests 
																	SET status = '$status'
																	WHERE requester_id ='$id_requestee' 
																	AND requestee_id= '$id_requester'
																");																		
		$reqModif->execute();
		$reqModif->closeCursor(); 

}?>
