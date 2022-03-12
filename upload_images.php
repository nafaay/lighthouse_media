<?php
	session_start();
  require_once('header.php');

  if(isset($_POST['submit'])){
    $file = $_FILES['file'];

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
      if(array_sum($fileSize) > 1000000){
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
            require_once('connexion.php');
            $messageSuccess =  "Image(s) uploaded with Success";
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
				?>
		<div class="col-md-12">
				<div class="col-md-2">
					<label  for="upToAlbum">Upload to Album:</label>
				</div>
				<div class="col-md-4">
				
					<select name="upToAlbum" id="upToAlbum">
					
					<?php
						$userId = $_SESSION['Id'];
						$request = $connBD->prepare('SELECT * FROM album WHERE owner_Id = :userId');
						$request->bindParam(':userId', $id);  
						$request->execute();

						$cpt=0;
						while ($data = $request->fetch())
							{								
									$album_id = $data['id'];
									$title = $data['title'];
									?>
									<option value="<?php echo($id);?>">										
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
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
				<div class="col-md-12">
					<div class="col-md-2">
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="file" name="file[]" class="form-control" multiple>
						</div>
					</div>
					<div class="col-md-6">
					</div>
				</div>
				<br /><br /><br />
				<div class="col-md-12">
					<div class="col-md-2">
						<label  for="description">Description:</label>
					</div>
					<div class="col-md-4">					
						<div class="form-group">
							<textarea class="form-control" name="description" id="description" cols="30" rows="8">
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
          <div class="col-auto" style="color: red";>
            <?php
              echo $messageError;
            ?>
          </div>
          <?php
        }
        else{
          ?>
          <div class="col-auto" style="color: green";>
            <?php
              echo $messageSuccess;
            ?>
          </div>
          <?php
        }
      }
      ?>
				<div class="col-md-12">
					<div class="col-md-2" syle="background-color: red">
					</div>

					<div class="col-md-10">
						<?php require_once("footer.php") ?>
					</div>
		
					<div class="col-md-2" syle="background-color: red">
					</div>
				</div>
  </body>
</html>

