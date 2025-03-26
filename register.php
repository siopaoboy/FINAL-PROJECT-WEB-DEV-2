<?php

	require('connect.php');

	if (!empty($_POST['usernameRegister']) && !empty($_POST['passwordRegister']) && !empty($_POST['passwordConfirmation'])) {

		$username = filter_input(INPUT_POST, 'usernameRegister', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$password = filter_input(INPUT_POST, 'passwordRegister', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$reenter = filter_input(INPUT_POST, 'passwordConfirmation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


		if ($password === $reenter) {

			$hash = password_hash($password, PASSWORD_DEFAULT); 
			
        	$query = "INSERT INTO users (username, password) VALUES (:username, :password)";

        	$statement = $db->prepare($query);
        
        	$statement->bindValue(':username', $username);
        	$statement->bindValue(':password', $hash);
        
        	try {
        		$statement->execute();
        		$message = "Registration successful!";
        	} catch (PDOException $e) {
        		$message = "Error: cannot register your account " . $e -> getMessage();
        	}
       		
    	} else {
    		$message = "The passwords do not match";
    	}  	

	} else {
		$message = "Please enter a username and password";

	} 	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/register.css">
	<title>Register Now!</title>
</head>
<body>
	<h1>Become a member of MANGAKOPIA today!</h1>
 
	<p><?= $message ?></p>

	<form method="POST" action="register.php">
		<label for="usernameRegister">Username:</label>
		<input type="text" name="usernameRegister"> <br> <br>

		<label for="passwordRegister">Password:</label>
		<input type="password" name="passwordRegister"> <br> <br>

		<label for="reenter">Re-Enter Password:</label>
		<input type="password" name="passwordConfirmation"> <br> <br>

		<button name="register" type="submit">Register</button> 
	</form> <br>

	<p><strong> Already a member? </strong><p> <a href="login.php">Login Here!</a>
</body>
</html>