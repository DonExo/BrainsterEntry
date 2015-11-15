<?php

	$server = "localhost";
	$user = "root";
	$pass = "";
	$db = "brainster";

	$link = mysqli_connect($server, $user, $pass, $db) or die("Error: " . mysqli_error());
	
?>