<?php

    require('connect.php');

    session_start();

    if (!$_SESSION['user_id']) {
        header('location: login.php');
        exit();
    }

    $invalidrequest = false;

    if ($_POST && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['review_id'])) {

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = $_POST['content'];
        $review_id = filter_input(INPUT_POST, 'review_id', FILTER_SANITIZE_NUMBER_INT);
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);

    $query = "UPDATE reviews SET title = :title, content = :content WHERE review_id = :review_id AND user_id = :user_id";

    $statement = $db->prepare($query);

    $statement->bindValue(':title', $title);
    $statement->bindValue(':content', $content);
    $statement->bindValue(':review_id', $review_id);
    $statement->bindValue(':user_id', $_SESSION['user_id']);

    $statement->execute();

    header("location: index.php");

    $message = "Review has been updated.";
 
    } else if (isset($_GET['review_id'])) {
        $review_id = filter_input(INPUT_GET, 'review_id', FILTER_SANITIZE_NUMBER_INT);
 
        
        $query = "SELECT * FROM reviews WHERE review_id = :review_id AND user_id = :user_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':review_id', $review_id);
        $statement->bindValue('user_id', $_SESSION['user_id']);
        
        $statement->execute();

        $update = $statement->fetch();

        if(!$update) {
            $invalidrequest = true; 
        }

    } else {
        $invalidrequest = true; 
     }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Your Review</title>
    <link rel="stylesheet" href="reviewEdit.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="/WEBD2/PROJECT-WEB-DEV-2/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
</head>

<body>
    <?php if($invalidrequest): ?>
        <div class="alert alert-danger">
            You do not have access to this review. Please <a href="login.php">login</a> to the correct account in order to edit.
        </div>

    <?php else: ?>
    <form method="post" action="reviewEdit.php">
        <input type="hidden" name="review_id" value="<?= $update['review_id'] ?>">

        <label for="title">Title:</label>
        <input type="text" name="title" value="<?= $update['title'] ?>"> <br> <br>

        <label for="content">Content:</label> <br>
        <textarea id="mytextarea" name="content" rows="5" cols="50"><?= $update['content'] ?></textarea> <br> <br>

        <input class="btn btn-primary" type="submit" name="update" value="Update"/> <br> <br>
        <a href="index.php">Back to Home</a>
    </form>
<?php endif; ?>
</body>
</html>