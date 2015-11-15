

<html>
<head>
	<title>Register area</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="extra/myCss.css" />
    <script type="text/javascript" src="extra/jquery.js"></script>
	<script type="text/javascript" src="extra/myScript.js"> </script>
</head>
<body>
		<div id='wrapper'>
			<h2>Welcome to <b>Brainster</b> University</h2>
			<h3>Registration area:</h3>
			<form method="POST" action="register.php">
				<fieldset>
					<legend>Personal Info:</legend>
					<table>
						<tr>
							<td><label for="firstName">First name: </label></td>
							<td><input type="text" id='firstName'  name='firstName' /><span>*</span></td>
						</tr>
						<tr>
							<td><label for="lastName">Last name:</label></td>
							<td><input type="text" id='lastLame'  name='lastName' /><span>*</span></td>
						</tr>
						<tr>
							<td><label for="birthYear">Birth year:</label></td>
							<td><input type="text" id='birthYear'   name='birthYear' /><span>*</span></td>
						</tr>
						
					</table>
				</fieldset>

				<fieldset>
					<legend>Account Info:</legend>
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
							<td><label for="passwordConfirm">Confirm password:</label></td>
							<td><input type="password" id='passwordConfirm'   name='passwordConfirm' /><span>*</span></td>
						</tr>
						<tr>
							<td><label for="email">E-mail contact:</label></td>
							<td><input type="text" id='email'   name='email' /><span>*</span></td>
						</tr>
						<tr>
							<td><p>Occupation:</p></td>
							<td>
								<input type='radio' alt='Year of study:' value='student' class='rbtn' name='rbtn' checked >Student</input>
								<input type='radio' alt='Monthly salary:' value='teacher' class='rbtn' name='rbtn'>Teacher</input>
							</td>
						</tr>
						<tr>
							<td><label for="userExtra"><p id='ex'>Year of study:</p></label></td>
							<td><input type="text" id='userExtra'  name='userExtra' /><span>*</span></td>
						</tr>
						<tr>
							<td colspan='2'><input type="submit" value="Register" /></td>
						</tr>
					</table>
				</fieldset>
			</form>

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
				$password = checkVal('password');
				$passwordC = checkVal('passwordConfirm');
				$firstName = checkVal('firstName');
				$lastName = checkVal('lastName');
				$birthYear = checkVal('birthYear');
				$userExtra = checkVal('userExtra');
				$email = checkVal('email');

				if(!preg_match("/^\w+\@\w+\.\w+$/", $email)){
					showError("Invalid e-mail address!");
					$error = true;
				}

				if($password!=$passwordC){
					showError('Password missmatch!');
					$error = true;
				}

				$query = "SELECT * FROM Users WHERE username='$username'";
				$result = mysqli_query($link, $query);
				$user = mysqli_fetch_assoc($result);
				if($user!=false){
					showError("Username already exist!");
					$error = true;
				}

				$query = "SELECT * FROM Users WHERE email='$email'";
				$result = mysqli_query($link, $query);
				$userEmail = mysqli_fetch_assoc($result);
				if($userEmail!=false){
					showError("E-mail address already exist!");
					$error = true;
				}

				if ($error == false) {
					$query = "INSERT INTO Users SET 
							firstName='$firstName', 
							lastName='$lastName', 
							username='$username', 
							email='$email', 
							password='$password',
							birthYear='$birthYear',
							userExtra='$userExtra'";
				
					$success = mysqli_query($link, $query);
					if(!$success){
						alert('Server-side verification failed!');
						showError(mysqli_error($link));
					}else{
						// Do tuka registracijata pominala uspeshno:
						echo "<b style='color:green; margin-left:40%;'>You have successfully registered!</b>";

					}

				}



			}


?>

