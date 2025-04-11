<?php

	require('connect.php');

	$pages = "SELECT page_id, u.admin_id, title, content, updated_at, u.username FROM pages AS p JOIN pages AS u ON u.admin_id = p.admin_id ORDER BY updated_at DESC";

	$statement = $db->prepare($review);

	$statement->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h1>Page List</h1>
	<a href="add.php">Create New Page</a>

	<ul>

		<li><a href=""></li>
	</ul>

	<a href="index.php">Back to Main</a>
</body>
</html>