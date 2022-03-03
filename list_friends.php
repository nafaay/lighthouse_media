<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/style.css">
	<title>LightHouse Labs Social Media Website</title>
  </head>
    <body>
      <?php 
        session_start();
      	require_once("connexion.php");
        require_once('header.php');
        $id = "";
        $name = "";
        $email_address = "";
        if(isset($_SESSION['user_name'])){
          $name = $_SESSION['user_name'];
        }
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
        }
        if(isset($_SESSION['email_address'])){
          $email_address = $_SESSION['email_address'];
        }
      ?>
      <h2>My Friends</h2>
  		<div class="col-md-12" id="welcome">
      	  <h3>Welcome <span class="name"><?php echo $name ?></span> to Lighthouse Labs Social Media Website</h3>	
			</div>

      <div class="row">
        <div class="col-md-12">
              <div class="col-md-2">
              </div>
              <div class="col-md-2">
                  <b>Friends</b>
              </div>
              <div class="col-md-4">
              </div>
              <div class="col-md-1">
              </div>
              
              <div class="col-md-2">
                  <b><a href="friend_request.php">Request Friendship</a></b>
              </div>
              <div class="col-md-1">
              </div>
            </div>
          </div>
          <br /><br />
        <?php
        $request = $connBD->prepare('SELECT * FROM friendship');
        $request->execute();
        $array_friends = [];
        $array_requests = [];

        while($data = $request->fetch()){
          if($data['status'] == 'A'){
            array_push($array_friends, $data['friend_requestee_id']);
          }
          if($data['status'] == 'R'){
            array_push($array_requests, $data['friend_requestee_id']);
          }
        }
        if(count($array_friends) == 0){
          ?>
          <b>No Friends Yet</b>
          <?php           
        }
        else{
          friends_or_requests($array_friends, $connBD);
        }
        if(count($array_requests) == 0){
          ?>
          <b>No Friends' Requests</b>
          <?php           
        }
        else{
          friends_or_requests($array_requests, $connBD);
        }

        function friends_or_requests($array_to_call, $connBD){
          ?>
          <div class="row">
            <div class="col-md-12">
              <div  class="col-md-2">
              </div>
              <div  class="col-md-8">          
                <table class="table table-stripped table-dark">
                  <thead>
                    <tr>
                      <th scope="col">Email Address</th>
                      <th scope="col">Name</th>
                      <th scope="col">Shared Albums</th>
                      <th scope="col">De-Friend</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php 
                        $email_address = "";
                        $name = "";
                        foreach($array_to_call as $value){
                          $request = $connBD->prepare('SELECT * FROM user_profile WHERE id = :value');
                          $request->bindParam(':value', $value);
                          $request->execute();
                          if($data = $request->fetch()){
                            $email_address = $data['email_address'];
                            $name = $data['user_name'];
                          }
                          
                          ?>
                          <td><?php echo $email_address ?></td>
                          <td><?php echo $name ?></td>
                          <td><?php echo "N" ?></td>
                          <td><input type="checkbox"></td>
                    </tr>
                      <?php
                        }
                      ?>
                  </tbody>
                </table>
              </div>
              <div  class="col-md-2">
              </div>
            </div>
          </div>      
        <?php
        }
          require_once('footer.php');
      ?>
    </body>
</head>  
