<?php
	
	require('connect.php');

	session_start();

	if (isset($_POST['username']) && isset($_POST['password'])) {

		$user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$login = "SELECT username, password FROM users WHERE username = :username";
		$statement = $db->prepare($login);
		$statement->bindValue(':username', $user);
		$statement->execute();

		if ($statement->rowCount() > 0) {
			$row = $statement->fetch();
			echo $row['password'];
			echo "<br>";
			$hash = password_hash($pass, PASSWORD_DEFAULT);

			if(password_verify($pass, $row['password'])){
			// echo $statement[0];
			// $urnm$_SESSION['username'];
			// setcookie('username', $usrnm, time() + 600); 	//still in progress
				$message = "Login Successful!";
			} else {
				$message = "Wrong password";
			}
		} else {
			$message = "Username and Password is invalid. Please try again.";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign In</title>
</head>
<body>
	<h1>Sign In To MANGAKOPIA!</h1>

	<p> <?= $message ?> </p>

	<form method="POST" action="login.php">
		<label for="username">Username:</label> 
		<input type="text" name="username"> <br> <br>

		<label for="password">Password:</label>
		<input type="password" name="password"> <br> <br>

		<button name="login" type="submit">Sign In</button>
	</form>

	<p> <strong>Not a member yet? </strong><p> <a href="register.php">Register Here!</a>
</body>
</html>