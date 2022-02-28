<?php
	$connBD = new PDO('mysql:host=localhost; dbname=db_lighthouse_media', 'root', ''
				,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			
	$connBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
?>