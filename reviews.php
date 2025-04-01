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

    <title>My Review</title>
    <link rel="stylesheet" href="reviews.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="/WEBD2/PROJECT-WEB-DEV-2/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
</head>

<body>
    <h2>My Review</h2> <br>
    <form method="post" action="reviews.php">
        <h5><label for="title">Title:</label></h5>
        <input id="title" name="title" placeholder="Add a title"> <br> <br>

        <h4><label for="content">Content:</label></h4> 
        <textarea id="mytextarea" name="content" rows="5" cols="50" placeholder="What do you think of MANGAKOPIA?"></textarea> <br> <br>

        <input class="btn btn-primary" type="submit" value="Post Review">
    </form> <br>

    <a href="insert.php">Back to Home</a> 

</body>
</html>