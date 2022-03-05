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
	
		// $reqAdd = $connBD->prepare('INSERT INTO friendship(friend_requester_id, friend_requestee_id, status) 
		// 		VALUES(:friend_requester_id1, :friend_requestee_id1, :status1)');				
		// if ($reqAdd){
		// 	$reqAdd->execute(array('friend_requester_id1'=>$id_requester,'friend_requestee_id1'=>$id_requestee,'status1'=>$status));								
		// 	// echo $user_name;
		// 	$reqAdd->closeCursor();
		// }


		$sql = "DELETE FROM friendship 
						WHERE friend_requester_id = :id_requestee1 
						AND friend_requestee_id = :id_requester1"; 
		$reqSupp = $connBD->prepare($sql);
		$reqSupp->bindParam(':id_requester1', $id_requester);   
		$reqSupp->bindParam(':id_requestee1', $id_requestee);   
		$reqSupp->execute();
		$reqSupp->closeCursor();
}?>
