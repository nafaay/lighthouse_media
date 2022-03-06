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
	<script src="scripts/script_new_album.js"></script>			
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>  
	<?php 
		require_once("header.php");
	?> 
		<br /><br /><br />
		<div class="form-group">
			<div class="col-md-12">
				<div class="col-md-2">
					<label for="title">Title:</label>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control" id="title">
				</div>
				<div class="col-md-6">
					<span id="titleMessage"></span>
				</div>
			</div>

			<br /><br /><br />			
			<div class="col-md-12">
				<div class="col-md-2">
					<label  for="accessibility">Accessibility:</label>
				</div>
				<div class="col-md-4">
          <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" id="access">Private
            <span id="caret" class="caret"></span></button>
            <ul class="dropdown-menu">
              <li id="private" style="text-align: center";> Private </li>
              <li id="public" style="text-align: center";> Public </li>
            </ul>
          </div>        
        </div>
			</div>
      <br /><br /><br />
			<div class="col-md-12">				
				<div class="col-md-2">
					<label  for="description">Description:</label>
				</div>
				<div class="col-md-6">					
					<div class="form-group">
						<textarea class="form-control" id="description" cols="60" rows="16">
						</textarea>
					</div>
				</div>
				<div class="col-md-4">
					<span id="descriptionMessage"></span>
				</div>
			</div>
			<br /><br /><br />
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
		<?php require_once("footer.php") ?> 
  </body>
</html>