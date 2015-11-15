

<html>
<head>
	<title>Reset your password</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="extra/myCss.css" />
    <script type="text/javascript" src="extra/jquery.js"></script>
	<script type="text/javascript" src="extra/myScript.js"> </script>
</head>
<body>
		<div id='wrapper'>
			<form method="POST" action="resetpass.php">
				<h2>Welcome to <b>Brainster</b> University</h2>
				<h3>Reset your password:</h3>
				<fieldset>
					<legend>Account Info:</legend>
					<table>
						<tr>
							<td><label for="name">Username: </label></td>
							<td><input type="text" id='username'   name='username' /><span>*</span></td>
						</tr>
						<tr>
							<td><label for="email">E-mail:</label></td>
							<td><input type="text" id='email'   name='email' /><span>*</span></td>
						</tr>
						
						<tr>
							<td colspan='2'><input type="submit" value="Send confirmation e-mail" /></td>
						</tr>
					</table>
				</fieldset>
			</form>
			<p>New member?<br/><a href='register.php'>Register!</a></p>
			<p>Already a member?<br/><a href='login.php'>Sign in!</a></p>
		</div>
</body>
</html>

<?php

	include 'dbConnect.php';

	$error = false;

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
				$email = checkVal('email');
		
				if(!preg_match("/^\w+\@\w+\.\w+$/", $email)){
					showError("Invalid e-mail address!");
					$error = true;
				}

				if(!$error){
				$query = "SELECT * FROM Users WHERE username='$username' AND email='$email' ";
				$result = mysqli_query ( $link, $query );
				$user = mysqli_fetch_assoc ( $result );

				if($user == false)
					showError('The user does not exist!');
				else {
					echo "<p style='color:green;'>Confirmation mail has been sent to <b>$email</b>.</p>";
					echo "<h6>Се надевам дека ова требаше да бидам симулација за праќање потврден маил...</h6>";
					echo "<script type='text/javascript'> $(document).ready(function(){ $('#wrapper').hide(); }); </script>";
				
					}
				}

			}


?>

