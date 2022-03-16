<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/style.css">
	<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
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
		
		<div class="form-group">
			<div class="col-md-12">
				<div class="col-md-4">					
				</div>
  		  <div class="col-md-12" id="welcome">
		  	  <h3>Welcome <span class="name"><?php echo $name ?></span> to Lighthouse Labs Social Media Website</h3>	
			  </div>
				<div class="col-md-4">
					<span id="msg"></span>
				</div>
			</div>
			
			<br /><br /><br />
			<div class="col-md-12" class="newAlbum">
				<div class="col-md-6">					
					
				</div>
				<div class="col-md-4">
					<?php if(trim($name) != ""){
					?>
						<a href="new_album.php">Create New Album</a>
					<?php
					}
					?>
				</div>
				<div class="col-md-2">
				</div>
			</div>
			<?php
			  if(isset($_SESSION['email_address'])){
          $email_address = $_SESSION['email_address'];
        }
        else{
					require_once("footer.php");
          return;
        }
				$cpt = 0;
				$request = $connBD->prepare('SELECT * FROM albums WHERE user_id = :id');
				$request->bindParam(':id', $id);
				$request->execute();
				while($data = $request->fetch()){
					$nbreOfPictures = 0;
					$cpt++;
					$album_id = $data['id'];
					$title = $data['album_title'];
					$description = $data['album_description'];
					$date_updated = $data['album_date'];
					$shared = $data['album_shared'];

					$request_pictures = $connBD->prepare('SELECT * FROM pictures WHERE album_id = :album_id1');
					$request_pictures->bindParam(':album_id1', $album_id);
					$request_pictures->execute();
					while($data_pictures = $request_pictures->fetch()){
						$filename = $data_pictures['filename'];
						$nbreOfPictures += count(explode(',', $filename));
					}
					?>
					<br /><br />
					<?php
						if($cpt == 1){
					?>
					<div class="row">
								<div class="col-md-12">
									<div  class="col-md-2">
									</div>
									<div  class="col-md-8">          
										<table class="table table-stripped table-dark">
											<thead>
												<tr>
													<th scope="col" style="text-align: center;">Title</th>
													<th scope="col" style="text-align: center;">Description</th>
													<th scope="col" style="text-align: center;">Date</th>
													<th scope="col" style="text-align: center;">Number Of pictures</th>
													<th scope="col" style="text-align: center;">Accessibility</th>
												</tr>
											</thead>
											<tbody>
							<?php
								}
							?>

										<tr>
                      <td><?php echo $title; ?></td>
                      <td><?php echo $description; ?></td>
                      <td style="text-align: center;"><?php echo $date_updated; ?></td>
											<td style="text-align: center;"><?php echo $nbreOfPictures; ?></td>
											<td style="text-align: center;"><?php echo ($shared == 'O' ? 'Public': 'Private'); ?></td>
                    </tr>
										<?php 
							}
							if($cpt > 0){
								$_SESSION['albums'] = 'created';

							?>
                  </tbody>
                </table>
              </div>
          </div> 
					<?php 
					}
					else{
					?>
						<b style="color: red; font-size: 16px";>No album created yet</b>
					<?php
						return;
					}
					?>     
			<div class="col-md-12">
				<div class="col-md-1">
				</div>

				<div class="col-md-10">
					<?php require_once("footer.php") ?>
				</div>
		
				<div class="col-md-1">
				</div>
			</div>
		</div>
  </body>
</html>