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
				<?php if(trim($name) == "" || !isset($_SESSION['new_album'])){
					?>
			  	<div class="col-md-12" id="welcome">
			  	  <h3 style="color: red">You have No  Album Created Yet</h3>	
				  </div>
					<?php
					return;
				}
				?>
						<div class="col-md-6">
						<select name="album" id="album">
						<?php
							$request = $connBD->prepare('SELECT * FROM album WHERE owner_id = :id');
							$request->bindParam(':id', $id);
							$request->execute();
							$cpt = 0;
							while ($data = $request->fetch())
								{
									$cpt++;
									$album_id = $data['id'];
									$owner_id = $data['owner_id'];
									$title = $data['title'];
									?>
										<option value="<?php echo($album_id);?>">										
										<?php echo($title);?>
										</option>
									<?php
								}
								?>
						</select>
				</div>
				<?php
					if($cpt == 0 AND trim($name) != ""){
						?>
						<b style="color: red";>You have to create album(s) first</b>

					<?php
					 return; 
					}?>

				<div class="col-md-12">
					<div class="col-md-2">
						<p id="images"></p>
					</div>

					<div class="col-md-10">
						<?php require_once("footer.php") ?>
					</div>
		
					<div class="col-md-2">
					</div>
				</div>
  </body>
</html>