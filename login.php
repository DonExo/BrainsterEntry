

<html>
<head>
	<title>Login area</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="extra/myCss.css" />
    <script type="text/javascript" src="extra/jquery.js"></script>
	<script type="text/javascript" src="extra/myScript.js"> </script>
</head>
<body>
		<div id='wrapper'>
			<form method="POST" action="login.php">
				<h2>Welcome to <b>Brainster</b> University</h2>
				<h3>Login area:</h3>
				<fieldset>
					<legend>Login Info:</legend>
					<table>
						<tr>
							<td><label for="name">Username: </label></td>
							<td><input type="text" id='username'   name='username' /><span>*</span></td>
						</tr>
						<tr>
							<td><label for="password">Password:</label></td>
							<td><input type="password" id='password'   name='password' /><span>*</span></td>
						</tr>
						<tr>
							<td>I'm a:</td>
							<td>
								<input type='radio' alt='Year of study:' value='student' class='rbtn' name='rbtn' checked >Student</input>
								<input type='radio' alt='Monthly salary:' value='teacher' class='rbtn' name='rbtn'>Teacher</input>
							</td>
						</tr>
						<tr>
							<td colspan='2'><input type="submit" value="Log in" /></td>
						</tr>
					</table>
				</fieldset>
			</form>
			<p>New member?<br/><a href='register.php'>Register!</a></p>
			<p>Forgot your password?<br/><a href='resetpass.php'>Reset your password!</a></p>
		</div>
</body>
</html>

<?php

	include 'dbConnect.php';

	$error = false;

	session_start();
	$_SESSION['isLogged'] = false;

	function checkVal($param){
		global $error;
		if ( isset($_POST[$param]) && $_POST[$param] != "" ) {
			$value = trim ( $_POST[$param] );
			$value = htmlspecialchars($value);
			return $value;
		}else{
			showError ( "$param is required!" );
			$error = true;
		}
	}

	function showError($message) {
		global $error;
		$error = true;
		echo "<p style='color:red;'>$message</p>";
	}

			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				$username = checkVal('username');
				$password = checkVal('password');
				$occupation = checkVal('rbtn');
		

				$query = "SELECT * FROM Users WHERE username='$username' AND password='$password' ";
				$result = mysqli_query ( $link, $query );
				$user = mysqli_fetch_assoc ( $result );

				//ako e teacher, userExtra treba da bide pogolema od 10 (simulacija za plata (vo mkd))
				//ako e student, userExtra treba da bide pomala od 10 (simulacija za godina na studii)
				if ( ($occupation=='teacher' && $user['userExtra']<10) || 
					 ($occupation=='student' && $user['userExtra']>10) || 
					  $user == false) {
					showError ( "Cannot login with given info." );
				}else{
					
					$_SESSION['isLogged'] = true;
					echo "Welcome $username.<br/>You are currently logged as <b>$occupation</b>.";
					echo "<br/><input type='button' value='Log out!' onClick=\"location.href='login.php'\" />";
					echo "<br/><a href='ListUsers.php'>View a list of registered users</a>";
					echo "<script type='text/javascript'> $(document).ready(function(){ $('#wrapper').hide(); }); </script>";
				}



			}


?>

