<?php
	
	require('connect.php');

	  session_start();
    $message = "";

    if ($_POST && !empty($_POST['title']) && !empty($_POST['content'])) {

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = $_POST['content'];

        if (empty($_SESSION['username']) || empty($_SESSION['admin_id'])) {

            $message = "You must be logged in.";

        } else {

        $query = "INSERT INTO pages (admin_id, title, content) VALUES (:admin_id, :title, :content)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':admin_id', $_SESSION['admin_id']);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        
        $statement->execute();

        $message = "Page has been created";
        }

    } else {

        $message = "Either title or content is left empty. Type something down on both fields.";

    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Add Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="/WEBD2/PROJECT-WEB-DEV-2/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
</head>
<body>
	<h2>Add Page</h2> <br>

	<p><?= $message ?></p>

	<form method="POST" action="add.php">
		<label for="title">Title:</label> 
		<input class="form-control" type="text" name="title" placeholder="Add a title"> <br>

		<label for="content">Content:</label>
		<textarea id="mytextarea" rows="8" name="content" placeholder="Add content to your page"></textarea> <br>

		<button class="btn btn-primary" name="submit" type="submit">Create Page</button> <br> 

		<a href="pages.php">Back</a>
	</form>

</body>
</html>