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
        require_once("header.php");
      ?>
    	<div class="row">
	  		<div class="col-md-12" id="welcome">
		  	  <h3>Welcome to Lighthouse Labs Social Media Website</h3>	
				  <p class="lead">If you have never used this before, you have to <a href="signup.php">Sign Up </a>first.</p>
				  <p class="lead">If you have already Signed Up, you can <a href="Login.php">Log In </a>now.</p>
			  </div>
		  </div>
      <?php
        require_once('footer.php');
      ?>

  </body>
</html>