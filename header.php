<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="https://www.lighthouselabs.ca/">
				<img src="images/logo.png" alt="Lighthouse Labs Logo"></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="list_friends.php">My Friends</a></li>
      <li><a href="MyAlbums.php">My Albums</a></li>

  	  <li><a href="MyPictures.php?whereToGo='My'">My Pictures</a></li>
	    <li><a href="UploadPictures.php">Upload Pictures</a></li>
    <?php
        if (!isset($_SESSION['name']))
        {
          ?>			
            <li><a href="login.php">Log In</a></li>	
          <?php
        }
          else
        {
          ?>
            <li><a href="logout.php">Log Out</a></li>	
          <?php
        }
		?>      

    </ul>
  </div>
</nav>

