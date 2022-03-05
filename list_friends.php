<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/style.css">
  	<script
		src="https://code.jquery.com/jquery-3.4.1.js"
		integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
		crossorigin="anonymous">
	</script>	

  <script src="scripts/script_list_friends.js"></script>			

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
        ?>
  		  <div class="col-md-12" id="welcome">
		  	  <h3>Welcome <span class="name"><?php echo $name ?></span> to Lighthouse Labs Social Media Website</h3>	
			  </div>
        <?php
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
        }
        if(isset($_SESSION['email_address'])){
          $email_address = $_SESSION['email_address'];
        }
        else{
          return;
        }
        ?>

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
          <br />
        <?php
        $request = $connBD->prepare('SELECT * FROM friendship');
        $request->execute();
        $array_friends = [];
        $array_received_requests = [];
        $array_sent_requests = [];
        $what = "";

        while($data = $request->fetch()){
          if($data['status'] == 'A' AND $data['friend_requester_id'] == $id){
            array_push($array_friends, $data['friend_requestee_id']);
          }
          // if($data['status'] == 'A' AND $data['friend_requestee_id'] == $id){
          //   array_push($array_friends, $data['friend_requester_id']);
          // }

          if($data['status'] == 'R' AND $data['friend_requestee_id'] == $id){
            array_push($array_received_requests, $data['friend_requester_id']);
          }
          if($data['status'] == 'R' AND $data['friend_requester_id'] == $id){
            array_push($array_sent_requests, $data['friend_requestee_id']);
          }
        }
        if(count($array_friends) == 0){
          ?>
          <b style="color: red">No Friends Yet</b><br />
          <?php           
        }
        else{
          $what = "F";
          friends_or_requests($array_friends, $connBD, $what);
        }
        if(count($array_sent_requests) == 0){
          ?>
          <b style="color: red">No Requests Sent</b> <br />
          <?php           
        }
        else{
          ?>
          <br />
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-2">
              </div>
              <div class="col-md-2">
                  <b>Requests Sent</b>
              </div>
              <div class="col-md-8">
              </div>
            </div>
          </div>
          <br />
          <?php
          $what = "S";
          friends_or_requests($array_sent_requests, $connBD, $what);
        }

        if(count($array_received_requests) == 0){
          ?>
          <b style="color: red">No Requests Received</b><br />
          <?php           
        }
        else{
          ?>
          <br />
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-2">
              </div>
              <div class="col-md-2">
                  <b>Requests Received</b>
              </div>
              <div class="col-md-8">
              </div>
            </div>
          </div>
          <br />
          <?php
          $what = "R";
          friends_or_requests($array_received_requests, $connBD, $what);
        }

        function friends_or_requests($array_to_call, $connBD, $what){
          ?>
          <div class="row">
            <div class="col-md-12">
              <div  class="col-md-2">
              </div>
              <div  class="col-md-8">          
                <table class="table table-stripped table-dark" id="<?php echo"table$what" ?>">
                  <thead>
                    <tr>
                      <th scope="col">Email Address</th>
                      <th scope="col">Name</th>
                      <?php 
                    if( $what == "F"){ ?>
                      <th scope="col">Shared Albums</th>
                      <th scope="col">De-Friend</th>
                      <?php
                      }
                    if( $what == "R"){ ?>
                      <th scope="col">Accept Or Deny</th>
                    <?php  
                      }
                       
                        if( $what == "S"){ ?>
                      <th scope="col">Remove</th>
                      <?php  
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php 
                        $email_address = "";
                        $name = "";
                        $cpt = 0;
                        foreach($array_to_call as $value){
                          $cpt++;
                          $request = $connBD->prepare('SELECT * FROM user_profile WHERE id = :value');
                          $request->bindParam(':value', $value);
                          $request->execute();
                          if($data = $request->fetch()){
                            $email_address = $data['email_address'];
                            $name = $data['user_name'];
                          }
                          
                          ?>
                          <td id="<?php echo "td$what$cpt" ?>"><?php echo $email_address ?></td>
                          <td><?php echo $name ?></td>
                          <?php if($what == "F"){
                            ?>
                          <td><?php echo "N" ?></td>
                          <?php
                          }
                        ?>
                          <td><input type="checkbox" id="<?php echo "ch$what$cpt" ?>"   value="<?php echo"ch$what$cpt" ?>"    "></td>
                    </tr>
                      <?php
                        }
                      ?>
                  </tbody>
                </table>
              </div>
              <div  class="col-md-2">
                <?php 
                if($what == "F"){ ?>
                	<button type="submit" id="defriend" class="btn btn-primary">Defriend</button>
                <?php
                }
                if($what == "R"){ ?>
                	<button type="submit" id="accept" class="btn btn-primary">Accept</button>
                	<button type="submit" id="deny" class="btn btn-primary">Deny</button>
                <?php
                }
                if($what == "S"){ ?>
                	<button type="submit" id="remove" class="btn btn-primary">Remove</button>
                <?php
                }
                ?>
              </div>
            </div>
          </div>      
        <?php
        }
          require_once('footer.php');
      ?>
    </body>
</head>  
