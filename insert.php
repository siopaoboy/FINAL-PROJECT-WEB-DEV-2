<?php

	require('connect.php');

	$review = "SELECT review_id, u.user_id, title, content, updated_at, u.username FROM reviews AS r JOIN users AS u ON u.user_id = r.user_id ORDER BY updated_at DESC";

	$statement = $db->prepare($review);

	$statement->execute();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/insert.css">


	<title>MANGAKOPIA ~ Winnipeg's Go-To Shop For Anything Manga!</title>
	<link rel="stylesheet" type="text/css" href="css/insert.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="insert">
	
	<a href="login.php">Login </a> <br>
	<a href="logout.php">Logout</a> <br>
	<a href="register.php">Become a MANGAKOPIA Member!</a> <br>

	<?= include('nav.php'); ?> <br>

	<a href="adminLogin.php">Admin</a>

	<div class="manga">
		<h2>Welcome to MANGAKOPIA</h2> <br>
		<h3><i>What is MANGAKOPIA?</i></h3>
		<p><i>MANGAKOPIA</i> is a </p> <br> <br>

		<h3><i>Here's what the people have to say about our shop!</i></h3> <br>
		<div class="review">
			<ul>
        		<?php while($row = $statement->fetch()): ?>

        		<li><h6>Posted By: <?=$row['username']?></h6></li>
            	<li><h4><b><?= $row['title'] ?></b></h4></li>
            	<li><?= $row['content'] ?></li>
            	<li><p>Updated: <?= date("F d, Y h:i a", strtotime($row['updated_at'])) ?><p></li>
            	<a href="reviewEdit.php?id=<?= $row['review_id'] ?>">Edit</a> <br>

        		<?php endwhile?> <br>
    		</ul> 
    	</div> 
    </div>
</body>
</html>