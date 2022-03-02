
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/style.css">
	<script
		src="https://code.jquery.com/jquery-3.4.1.js"
		integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
		crossorigin="anonymous">
	</script>	
	<script src="scripts/script_friend_request.js"></script>			
</head>  
<body>
    <?php
      session_start();
      $name = "";
      require_once("header.php");
      if(isset($_SESSION['user_name'])){
        $name = $_SESSION['user_name'];
      }
    ?>
    <div class="row">
	  	<div class="col-md-12" id="welcome">
		  	<h3>Welcome <span class="name"><?php echo $name ?></span> to Lighthouse Labs Social Media Website</h3>	
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<div class="col-md-2">
					<label for="email_address">Email Address:</label>
				</div>
				<div class="col-md-4" id="myForm1">
					<input type="text" class="form-control" id="email_address" value = "" placeholder="Enter Email Address">
				</div>
				<div class="col-md-6" id="myForm2">
					<span id="email_address_message"></span><br />
					<span id="email_address_message2"></span><br />
					<span id="email_address_message3"></span>
					
				</div>
			</div>
			<br /><br />
			<div class="col-md-12">
				<div class="col-md-2">
				</div>
				<div class="col-md-4">
					<button type="submit" id="submit" class="btn btn-primary">Send Friend Request</button>
				</div>
				<div class="col-md-6">					
				</div>
			</div>
		</div>
    <?php require_once("footer.php") ?> 
  </body>
</html>