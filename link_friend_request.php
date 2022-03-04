<?php
	session_start();
	if (isset($_POST['email_address1'])){

		// Connexion to Database
		require_once("connexion.php");
		$email_address = $_POST['email_address1'];
		$request = $connBD->prepare
					('SELECT * FROM user_profile WHERE email_address = :email_address1');
		$request->bindParam(':email_address1', $email_address);   
		$request->execute();					
		if ($data = $request->fetch()){
			$id_requester = $_SESSION['id'];
			$id_requestee = $data['id'];
			$user_name = $data['user_name'];
			if($id_requester == $id_requestee){
				echo "Same";
				return;
			}
		}
		else{
			echo "NotFound";
			return;
		}

		$request = $connBD->prepare
					('SELECT * FROM friendship 
										 WHERE friend_requester_id = :id_requester1 
										 AND friend_requestee_id = :id_requestee1');
		$request->bindParam(':id_requester1', $id_requester);   
		$request->bindParam(':id_requestee1', $id_requestee);   

		$request->execute();					
		if ($data = $request->fetch()){
			if($data['status'] == 'R'){
				echo "FoundRequest";
			}
			else{
				if($data['status'] == 'A'){
					echo "FoundFriend";
				}
			}
		}
		else{
			$status = 'R';
			$reqAdd = $connBD->prepare('INSERT INTO friendship(friend_requester_id, friend_requestee_id, status) 
					VALUES(:friend_requester_id1, :friend_requestee_id1, :status1)');				
			if ($reqAdd){
				$reqAdd->execute(array('friend_requester_id1'=>$id_requester,'friend_requestee_id1'=>$id_requestee,'status1'=>$status));								
				echo $user_name;
				$reqAdd->closeCursor();
				}
			else{
				echo "NotFound";
			}
		}
	$request->closeCursor();
}	
?>

