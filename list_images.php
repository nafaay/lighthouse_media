<!DOCTYPE html>
<html lang="en">
  <head>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="styles/style.css">
		<script
			src="https://code.jquery.com/jquery-3.4.1.js"
			integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
			crossorigin="anonymous"></script>	
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="scripts/script_list_images.js"></script>			
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
        ?>
		  	<div class="col-md-12" id="welcome">
		  	  <h3>Welcome <span class="name"><?php echo $name ?></span> to Lighthouse Labs Social Media Website</h3>	
			  </div>

					<?php
					$request = $connBD->prepare('SELECT * FROM album WHERE owner_id = :id');
					$request->bindParam(':id', $id);
					$request->execute();
					$cpt=0;
					 ?>
					 <div class="col-md-12">
						<div class="col-md-2">
						</div>
						<div class="col-md-4">
							<div class="dropdown">
									<?php
										while($data = $request->fetch()){
											$cpt++;
											$title = $data['title'];
											
											if($cpt == 1){
												?>
												<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" id="access"><?php echo $title; ?>
												<span id="caret" class="caret"></span></button>
												<ul class="dropdown-menu">
											<?php
											}
											?>
												<li class="title"><?php echo $title; ?></li>
									<?php 
								}
								?>
								</ul>
							</div>        
						</div>
					</div>
						<?php
					if($cpt == 0){
						?>
						<b style="color: red";>You have to create album(s) first</b>
					<?php 
					}
					?>
				<div class="col-md-12">
					<div class="col-md-2">
					</div>

					<div class="col-md-10">
						<?php require_once("footer.php") ?>
					</div>
		
				<div class="col-md-2">
				</div>
				</div>
  </body>
</html>