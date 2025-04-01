<?php

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Add Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
	<h2>Add Page</h2> <br>

	<form method="POST" action="">
		<label for="name">Name:</label>
		<input class="form-control" type="text" name="name" placeholder="Add a name"> <br> 

		<label for="title">Title:</label> 
		<input class="form-control" type="text" name="title" placeholder="Add a title"> <br>

		<label for="content">Content:</label>
		<textarea class="form-control" rows="8" name="content" placeholder="Add content to your page"></textarea> <br>

		<button class="btn btn-primary" name="submit" type="submit">Create Page</button>
	</form>

</body>
</html>