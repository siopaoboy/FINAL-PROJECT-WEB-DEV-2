<?php
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Edit Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="/WEBD2/PROJECT-WEB-DEV-2/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
</head>
<body>
	<h2>Edit Page</h2> <br>

	<form method="POST" action="">
		<label for="name">Name:</label>
		<input class="form-control" type="text" name="name" value="<?php echo $_POST['name']; ?>" placeholder="Add a name"> <br> 

		<label for="title">Title:</label> 
		<input class="form-control" type="text" name="title" value="<?php echo $_POST['title']; ?>" placeholder="Add a title"> <br>

		<label for="content">Content:</label>
		<textarea id="mytextarea"> class="form-control" rows="8" name="content" value="<?php echo $_POST['content']; ?>" placeholder="Add content to your page"></textarea> <br>

		<button class="btn btn-primary" name="submit" type="submit">Create Page</button>
	</form>

</body>
</html>