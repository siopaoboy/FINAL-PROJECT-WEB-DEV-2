<?php
	
	require('connect.php');

	$message = "";

	session_start();

	if (isset($_POST['username']) && isset($_POST['password'])) {

		$user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		if (empty($user) || empty($pass)) {

			$message = "Please enter both username and password";

		} else {

		$login = "SELECT username, password, user_id FROM users WHERE username = :username";
		$statement = $db->prepare($login);
		$statement->bindValue(':username', $user);
		$statement->execute();

			if ($statement->rowCount() > 0) {

				$row = $statement->fetch();

				$hash = password_hash($pass, PASSWORD_DEFAULT);

				if(password_verify($pass, $hash)){
					$_SESSION['username'] = $row['username'];
					$_SESSION['user_id'] = $row['user_id'];

					$message = "Login Successful!";

					header("Location: insert.php");
					exit();

				} else {
					$message = "Wrong password";
				}

			} else {
				$message = "Username and Password is invalid. Please try again.";
			}
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