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
        $id = "";
        $name = "";
        $email_address = "";
        require_once("header.php");
        if(isset($_SESSION['user_name'])){
          $name = $_SESSION['user_name'];
        }
      ?>
    	<div class="row">
	  		<div class="col-md-12" id="welcome">
          <?php  

          if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
          }
          require_once('connexion.php');
          $request = $connBD->prepare('SELECT * FROM albums WHERE user_id = :id');
				  $request->bindParam(':id', $id);
				  $request->execute();
				  if($data = $request->fetch()){
            $_SESSION['albums'] = 'created';
          }
          else{
          }


          if(isset($_SESSION['email_address'])){
            $email_address = $_SESSION['email_address'];
          }
          if(trim($name) == ""){
            ?>
            <h3>Welcome to Lighthouse Labs Social Media Website</h3>	
            <p class="lead">If you have never used this before, you have to <a href="signup.php">Sign Up </a>first.</p>
            <p class="lead">If you have already Signed Up, you can <a href="Login.php">Log In </a>now.</p>
          <?php
          }
          else{
            ?>
            <h3>Welcome <span class="name"><?php echo $name ?></span> to Lighthouse Labs Social Media Website</h3>	
          <?php
          }
          ?>
			  </div>
		  </div>
      <?php
        require_once('footer.php');
      ?>

  </body>
</html>