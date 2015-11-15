<?php

	$server = "localhost";
	$user = "root";
	$pass = "";

	$link = mysqli_connect($server, $user, $pass) or die('Error: ' . mysqli_error);

	$dbSql = "CREATE DATABASE IF NOT EXISTS Brainster
				DEFAULT CHARACTER SET = 'utf8' DEFAULT COLLATE 'utf8_general_ci'";

	if(!mysqli_query( $link, $dbSql )){
		echo "Error".mysqli_error();
	}

	$tblSql = "CREATE TABLE IF NOT EXISTS Users(
				userId int NOT NULL AUTO_INCREMENT,
				username varchar(50) NOT NULL,
				password varchar(50) NOT NULL,
				firstName varchar(50) NOT NULL,
				lastName varchar(50) NOT NULL,
				email varchar(50) NOT NULL,
				birthYear varchar(50) NOT NULL,
				userExtra varchar(20) NOT NULL,
				PRIMARY KEY(userId)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ";

	$link = mysqli_connect($server, $user, $pass, 'brainster') or die('Error: ' . mysqli_error);

	if(!mysqli_query($link, $tblSql)){
		echo "Error: ".mysqli_error($link);
	}

	$tblInserts = "
				INSERT INTO `Users` (`userId`,`username`,`password`,`firstName`, `lastName`, `email`, `birthYear`, `userExtra`) VALUES
				(NULL, 'johndoe','John123','John','Doe','john@doe.com','1990','4'),
				(NULL, 'janedoe','Jane000','Jane','Doe','jane@doe.com','1991','3'),
				(NULL, 'teacher1','profesor123','Marko','San','markosan@gmail.com','1970','25000')
	";

	$run = mysqli_query($link, $tblInserts) or die('Error'.mysqli_error($link));

	echo "Success";

	mysqli_close($link);


?>