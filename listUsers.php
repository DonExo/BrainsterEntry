
<html>
<head>
	<title>Home area</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="extra/myCss.css" />
    <script type="text/javascript" src="extra/jquery.js"></script>
	<script type="text/javascript" src="extra/myScript.js"> </script>
</head>
<body>
		
</body>
</html>

<?php

	include 'dbConnect.php';
	session_start ();
	if (isset ( $_SESSION ["isLogged"] ) && $_SESSION ["isLogged"] == true) {
		$query = "SELECT * FROM Users";
		$result = mysqli_query ( $link, $query );
		$users = Array ();
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			$users [] = $row;
		}
	
		echo "<div id='wrapper'>";
		?>
		<h2>Welcome to <b>Brainster</b> University</h2>
				<h3>Listing all users</h3>
		<table border="1" id='listUsersTable' style='margin:5px auto;'>
	<tr style="background-color:gray; color:white;">
		<td>First name</td>
		<td>Last name</td>
		<td>Username</td>
		<td>Role</td>
	</tr>
	<?php 
		foreach ($users as $user){
			$role='Student';
			if($user['userExtra']>10)
				$role='<b>Teacher</b>';
			echo"
			<tr>
				<td>$user[firstName]</td>
				<td>$user[lastName]</td>
				<td>$user[username]</td>	
				<td>$role</td>			
			</tr>";
		}
	


		echo "</div>";

}else{
	echo "<h1>You have to be logged in first!</h1>";
}