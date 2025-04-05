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
					$message = "Wrong password. Try Again.";
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
	<link rel="stylesheet" href="css/login.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="login">
	<h1>Sign In To MANGAKOPIA!</h1>

	<p> <?= $message ?> </p>

	<form method="POST" action="login.php">
		<label for="username">Username:</label> 
		<input class="form-control" type="text" name="username"> <br> <br>

		<label for="password">Password:</label>
		<input class="form-control" type="password" name="password"> <br>

		<button class="btn btn-primary" name="login" type="submit">Sign In</button> <br> <br>
	</form>

	<p><strong>Not a member yet? </strong><p> <a href="register.php">Register Here!</a> <br> <br>
	<a href="insert.php">Back to Home</a>
</body>
</html>