<?php

	require('connect.php');

	session_start();
	error_reporting(0);

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
	<?php
	 if($_SESSION['username']) {

	?>
	<p>Welcome back <b><?= $_SESSION['username'] ?></b>!</p>
	<a href="logout.php" onclick="return confirm('Are you sure you want to logout from your account?')">Logout</a> <br>
	
	<?php

	}

	else {

	?>

	<a href="login.php">Login </a> <br>
	<a href="register.php">Become a MANGAKOPIA Member!</a> <br>

	<?php

	}

	?>

	<?= include('nav.php'); ?> <br>

	<a href="adminLogin.php">Admin</a>

	<div class="manga">
		<h2>Welcome to MANGAKOPIA</h2> <br>
		<h3><i>What is MANGAKOPIA?</i></h3>
		<p><i>MANGAKOPIA</i> is a shop that caters to manga collectors and lovers alike.</p> <br>
		<h6><b>LOOKING FOR A NEW SERIES TO READ?</b></h6>
		 <p>Well I have great news for you! This shop offers a variety genres from heavy shonen action to the relaxing and chill slice of life.</p>
		 <p>Come to our shop and check out all the manga we have.</p> <br>

		<h3><i>Here's what the people have to say about our shop!</i></h3> <br>
		<div class="review">
			<ul>
        		<?php while($row = $statement->fetch()): ?>

        		<li><h6>Posted By: <?=$row['username']?></h6></li>
            	<li><h4><b><?= $row['title'] ?></b></h4></li>
            	<li><?= $row['content'] ?></li>
            	<li><p>Updated: <?= date("F d, Y h:i a", strtotime($row['updated_at'])) ?><p></li>
            		
            	<a href="reviewEdit.php?review_id=<?= $row['review_id'] ?>">Edit</a>

            <form method="post" action="reviewDelete.php">
            	<a href="reviewDelete.php?review_id=<?= $row['review_id'] ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a> <br> <br>
            </form>

        		<?php endwhile?> <br>
    		</ul> 

    		<h6> Have something to say about our shop? Write your review <a href="reviews.php">here</a>
    	</div> 
    </div>
</body>
</html>