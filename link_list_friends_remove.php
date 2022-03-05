<?php
	session_start();
	if(isset($_POST['email_address1'])){
		// Connexion to Database
		require_once("connexion.php");

		$id_requester = $_SESSION['id'];
		$id_requestee = 0;
		$email_address = $_POST['email_address1'];
		$request = $connBD->prepare('SELECT id  FROM user_profile 
																WHERE email_address = :email_address1');
		$request->bindParam(':email_address1', $email_address);   
		$request->execute();				
		if ($data = $request->fetch()){
			$id_requestee = $data['id'];
		}
	
		$sql = "DELETE FROM friendship 
						WHERE friend_requester_id = :id_requester1 
						AND friend_requestee_id = :id_requestee1"; 
		$reqSupp = $connBD->prepare($sql);
		$reqSupp->bindParam(':id_requester1', $id_requester);   
		$reqSupp->bindParam(':id_requestee1', $id_requestee);   
		$reqSupp->execute();
		$reqSupp->closeCursor();	
}?>
