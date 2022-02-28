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
	<script src="scripts/signup.js"></script>			
  </head>
  <body>  
	<?php 
		require_once("header.php");
	?> 
		<br /><br /><br />
		<div class="form-group">
			<div class="col-md-12">
				<div class="col-md-2">
					<label for="user_name">User Name:</label>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control" id="user_name" placeholder="Enter User user_name">
				</div>
				<div class="col-md-6">
					<span id="user_name_message"></span>
				</div>
			</div>

			<br /><br /><br />			
			<div class="col-md-12">
				<div class="col-md-2">
					<label  for="email_address">Email Address:</label>
				</div>
				<div class="col-md-4">
					<input type="email" class="form-control" id="email_address" placeholder="Enter User Email Address">
				</div>
				<div class="col-md-6">
					<span id="email_address_message"></span>
				</div>
			</div>
			<br /><br /><br />
			<div class="col-md-12">
				<div class="col-md-2">
					<label  for="password">Password:</label>
				</div>
				<div class="col-md-4">
					<input type="password" class="form-control" id="password" placeholder="Enter Password">
				</div>
				<div class="col-md-6">
					<span id="password_message"></span>
				</div>
			</div>
			<br /><br /><br />
			<div class="col-md-12">
				<div class="col-md-2">
					<label  for="password_again">Password Again:</label>
				</div>
				<div class="col-md-4">
					<input type="password" class="form-control" id="password_again" placeholder="ReEnter Password">
				</div>
				<div class="col-md-6">
					<span id="password_again_message"></span>
				</div>
			</div>
			<br /><br /><br />
			<div class="col-md-12">
				<div class="col-md-2">

				</div>
				<div class="col-md-4">
					<button type="submit" id="submit" class="btn btn-primary">Submit</button>
					<button type="submit" class="btn btn-primary">
						<a class="clear" href="signup.php">Clear</a>
					</button>
				</div>
				<div class="col-md-6">
					
				</div>
			</div>
		</div>
		<?php require_once("footer.php") ?> 
  </body>
</html>