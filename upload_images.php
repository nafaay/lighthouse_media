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
			crossorigin="anonymous"></script>	
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="scripts/script_upload_images.js"></script>			
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
		
		<div class="col-md-12">
		  <h3>Welcome <span class="name"><?php echo $name ?></span> to Lighthouse Labs Social Media Website</h3>	
		</div>
    <?php if(trim($name) == ""){
      return;
    }
    ?>
		<h5>Accepted images types: JPG(JPEG), GIF and PNG</h5>
		<h5>You can upload multiple images at a time by pressing the shift key while selecting images</h5>
		<h5>When uploading multiple images, the title and description fields will be applied to all images </h5>
		<form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		
					<?php
					$request = $connBD->prepare('SELECT * FROM album WHERE owner_id = :id');
					$request->bindParam(':id', $id);
					$request->execute();
					$cpt=0;
          $album_id = 0;
					 ?>
           
					 <div class="col-md-12">
						<div class="col-md-2">
              <b>Upload To Album:</b>
						</div>
						<div class="col-md-4">
							<div class="dropdown">
									<?php
										while($data = $request->fetch()){
											$cpt++;
											$title = $data['title'];
                      $album_id = $data['id'];
											if($cpt == 1){
												?>
												<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" id="access" ><?php echo "Album Id: ".$album_id." Title: ".$title; ?>
												<span id="caret" class="caret"></span></button>
												<ul class="dropdown-menu">
											<?php
											}
											?>
												<li class="title" style="padding: 6px" id="album$id"><?php echo "Album Id: ".$album_id." Title: ".$title; ?></li>
									<?php 
								}
								?>
								</ul>
							</div>        
						</div>
					</div>
				</form>
				<br /><br />
			<div class="col-md-12">
				
				<div class="col-md-2">
					<label>Image(s) to Upload:</label>
				</div>
				
				<div class="col-md-4">					
					<div class="form-group">

						<input type="file" name="file[]" id="file_to_upload" multiple />
					</div>
				</div>
				<div class="col-md-6">
					<span id="file_to_uploadMessage"></span>
				</div>
			</div>
			
			<br /><br />
			<div class="col-md-12">
				<div class="col-md-2">
					<label for="title">Title:</label>
				</div>
				<div class="col-md-4">
					<input type="text" name="title" class="form-control" id="title">
				</div>
				<div class="col-md-6">
					<span id="titleMessage"></span>
				</div>
			</div>
			<br /><br /><br />
			<div class="col-md-12">
				
				<div class="col-md-2">
					<label  for="description">Description:</label>
				</div>
				
				<div class="col-md-4">					
					<div class="form-group">
						<textarea class="form-control" name="description" id="description" cols="60" rows="10">
						</textarea>
					</div>
				</div>
				<div class="col-md-6">
					<span id="descriptionMessage"></span>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-2">

				</div>
				<div class="col-md-4">
					<button type="submit" id="submit" class="btn btn-primary">Submit</button>
				</div>
				
				<div class="col-md-6">
				</div>
			</div>
		</div>
		<?php require_once("footer.php");?> 
  </body>
</html>