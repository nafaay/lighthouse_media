
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="Styles/Style.css">
	<script
		src="https://code.jquery.com/jquery-3.4.1.js"
		integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
		crossorigin="anonymous"></script>	
	<script src="scripts/login.js"></script>			
</head>  
<body>

	<?php
		$_SESSION['start'] = "index";
		require_once("header.php") 
	?> 
			<h3 class="login">Log In</h3>
		<h4 class="signup">You need to <a href="signup.php">Sign Up </a>If you are a new User</h4>
		<br /><br />
		
		<div class="form-group">
			<div class="col-md-12">
				<div class="col-md-2">
					<label for="email_address">Email Address:</label>
				</div>
				<div class="col-md-4" id="myForm1">
					<input type="text" class="form-control" id="email_address" placeholder="Enter Email Address">
				</div>
				<div class="col-md-6" id="myForm2">
					<span id="email_address_message"></span>
				</div>
			</div>
			<br /><br /><br />
			<div class="col-md-12">
				<div class="col-md-2">
					<label  for="password">Password:</label>
				</div>
				<div class="col-md-4">
					<input type="password" class="form-control" id="password" value = "" placeholder="Enter Password">
				</div>
				<div class="col-md-6">
					<span id="password_message"></span>
				</div>
			</div>
			<br /><br /><br />
			<div class="col-md-12">
				<div class="col-md-2">

				</div>
				<div class="col-md-4">
					<button type="submit" id="submit" class="btn btn-primary">Submit</button>
					<button type="submit" class="btn btn-primary">Clear</button>
				</div>
				<div class="col-md-6">
					
				</div>
			</div>
		</div>
    <?php require_once("footer.php") ?> 
  </body>
</html>