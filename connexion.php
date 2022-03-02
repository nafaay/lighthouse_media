<?php
	require_once('hide_connect.php');
  $port = $_SESSION['port'];
  $database_name = $_SESSION['database_name'];
  $user = $_SESSION['user'];
  $password  =   $_SESSION['password'];

	$connBD = new PDO("mysql:host=$port; dbname=$database_name", $user, $password
				,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			
	$connBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
?>
