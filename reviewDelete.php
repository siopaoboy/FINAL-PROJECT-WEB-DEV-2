<?php

	require('connect.php');

	session_start();

	$message = "";

    if (!$_SESSION['user_id']) {
        header('location: login.php');
        exit();
    }

    if (isset($_GET['review_id'])) {
        $review_id = filter_input(INPUT_GET, 'review_id', FILTER_SANITIZE_NUMBER_INT);
        $user_id = $_SESSION['user_id'];


        $query = "DELETE FROM reviews WHERE review_id = :review_id AND user_id = :user_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':review_id', $review_id, PDO::PARAM_INT);
        $statement->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $statement->execute();

        header("location: index.php");
        exit();

        if ($statement->rowCount() > 0) {
        	$message = "Review has been deleted.";
        }

    } else {
    	$message = "Review is not detected.";
    }
?>
