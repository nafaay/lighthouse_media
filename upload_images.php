<?php
	session_start();
  require_once('header.php');
	$title_images = "";
	$description = "";
  if(isset($_POST['submit'])){
		$upload_to_album = $_POST['upload_to_album'];
    $file = $_FILES['file'];
		$title_images = $_POST['title_images'];
		$description = $_POST['description'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExtension = [];
    foreach($fileName as $name){
      $exp = explode('.', $name);
      $ext = strtolower(end($exp));
      array_push($fileExtension, $ext);
    }
    $errorEmpty = false;
    $errorType  = false;
    $errorSize  = false;
    $errorError = false;
    $messageError = "";
    $messageSuccess = "";

    if(strlen($fileName[0]) == 0){
      $errorEmpty = true;
    }

    if($errorEmpty == true){
      $messageError = "You have to upload at least one image";
    }
    else{

      foreach($fileExtension as $ext){
        if($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'gif'){
          $errorType = true;
        }
      }
      if(array_sum($fileSize) > 1000000000){				
        $errorSize = true;
      }
      foreach($fileError as $error){
        if($error != 0){
          $errorError = true;
          break;
        }
      }
      
      if($errorType === true){
        $messageError =  "This type of file is not allowed";
      }
      else{
        if($errorSize === true){
          $messageError =  "Size too big";
        }
        else{
          if($errorError === true){
            $messageError =  "Issue uploading file(s)";
          }
          else{
						if(trim($title_images) == ""){
							$messageError = "Title is required";
						}
						else{
							if(trim($description) == ""){
								$messageError = "Give some description to this Album";
							}
						else{
							$file_to_upload = "";
							$local_image = "images/albums/";

							$nbPictures = count($_FILES['file']['name']);		
							for ($i=0; $i<$nbPictures; $i++){
								$name_file= $_FILES['file']['name'][$i];
								$tmp_name = $_FILES['file']['tmp_name'][$i];
								$file_to_upload .= $name_file;
								move_uploaded_file($tmp_name, $local_image.$name_file);	
								if ($i<$nbPictures - 1)
										$file_to_upload .= ",";
							}
	            require_once('connexion.php');

							date_default_timezone_set("America/Toronto");
							$date 			= date('Y-m-d');

							$reqAdd = $connBD->prepare('INSERT INTO image(album_Id, fileName, title, description, date_added) 
							VALUES(:upload_to_album1, :file_to_upload1, :title_images1, :description1, :date1)');				
							if ($reqAdd){
								$reqAdd->execute(array('upload_to_album1'=>$upload_to_album, 
								'file_to_upload1'=>$file_to_upload, 
								'title_images1'=>$title_images, 
								'description1'=>$description, 
								'date1'=>$date
								));					
								$reqAdd->closeCursor(); 
								echo '';
							}
							else
								echo 'Fail Creation';
							}
							$messageSuccess =  "Image(s) uploaded with Success";
						}
          }
        }
      }
    }
	}
?>
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
    <link rel="stylesheet" href="styles/style.css">

  </head>
  <body>
		<?php
		require_once("connexion.php");
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
				<?php if(trim($name) == ""){
					return;
				}

				if(!isset($_SESSION['albums'])){
					?>
			  	<div class="col-md-12" id="welcome">
			  	  <h3 style="color: red">You have No  Album Created Yet</h3>	
				  </div>
					<?php
					return;
				}
				?>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
		<div class="col-md-12">
				<div class="col-md-2">
					<label  for="upload_to_album">Upload to Album:</label>
				</div>
				<div class="col-md-4">
				
					<select name="upload_to_album" id="upload_to_album">

					<?php
						$user_id = $_SESSION['id'];
						$request = $connBD->prepare('SELECT * FROM album WHERE owner_id = :user_id');
						$request->bindParam(':user_id', $id);  
						$request->execute();

						$cpt=0;
						while ($data = $request->fetch())
							{								
									$album_id = $data['id'];
									$title = $data['title'];
									?>
									<option value="<?php echo($album_id);?>">										
										<?php echo($title);?></option>
									<?php		
							}
													
							?>
					</select>
				</div>
				<div class="col-md-6">
					<h6>Accepted picture types: JPG(JPEG), GIF and PNG</h6>
					<h6>You can upload multiple pictures at a time by pressing the shift key while selecting pictures</h6>
					<h6>When uploading multiple pictures, the title and description fields will be applied to all pictures </h6>
				</div>
			</div>
			<br /><br /><br />
				<div class="col-md-12">
					<div class="col-md-2">
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="file" name="file[]" class="form-control" multiple>
						</div>
					</div>
					<div class="col-md-4">
					</div>
				</div>
				<br /><br /><br />
				<div class="col-md-12">
					<div class="col-md-2">
						<label  for="title_images">Title:</label>
					</div>
					<div class="col-md-6">
						<input type="text" name="title_images" class="form-control" id="title_images" value="<?php echo $title_images;?>">
					</div>
					<div class="col-md-4">
						<span id="title_message"></span>
					</div>
				</div>
				<br><br><br>
				<div class="col-md-12">
					<div class="col-md-2">
						<br />
						<label  for="description">Description:</label>
					</div>
					<div class="col-md-6">
						<br />					
						<div class="form-group">
							<textarea class="form-control" name="description" id="description" cols="30" rows="8">
								<?php echo $description;?>
							</textarea>
						</div>
					</div>
					<div class="col-md-4">
						<span id="descriptionMessage"></span>
					</div>
				</div>
			<div class="col-md-12">
				<div class="col-md-2">

				</div>
				<div class="col-md-4">
					<p><input type="submit" name="submit" class="btn btn-primary" value="Upload Images"></p>
				</div>
				
				<div class="col-md-6">
				</div>
			</div>
		</form>

  
			<?php
      if(isset($_POST['submit'])){
        if($messageError != ""){
          ?>
          <div class="col-auto" style="color: red; font-weight: bold; font-size: 16">
            <?php
              echo $messageError;
            ?>
          </div>
          <?php
        }
        else{
          ?>
            <div class="col-auto" style="color: green; font-weight: bold; font-size: 16">

            <?php
              echo $messageSuccess;
            ?>
          </div>
          <?php
        }
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

