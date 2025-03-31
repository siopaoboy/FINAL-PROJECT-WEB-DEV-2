<?php    
    require('connect.php');

    session_start();

    if ($_POST && !empty($_POST['title']) && !empty($_POST['content'])) {

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $query = "INSERT INTO reviews (user_id, title, content) VALUES (:user_id, :title, :content)";
        $statement = $db->prepare($query);
        
        $statement->bindValue('user_id', $_SESSION['user_id']);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        
        $statement->execute();

        header("Location: insert.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>My Review</title>
</head>

<body>
    <form method="post" action="reviews.php">
        <label for="title">Title:</label>
        <input id="title" name="title" placeholder="Add a title to your review"> <br> <br>

        <label for="content">Content:</label> <br>
        <textarea name="content" rows="5" cols="50" placeholder="What do you think of MANGAKOPIA?"></textarea> <br> <br>

        <input type="submit" value="Submit Post">
    </form> <br>

    <a href="insert.php">Back to Home</a> 

</body>
</html>