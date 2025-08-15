<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    // Handle image upload
    $image = null;
    if ($_FILES['image']['name']) {
        $target_dir = "uploads/news/";
        $image = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $query = "INSERT INTO news_updates (title, content, image) VALUES ('$title', '$content', '$image')";
    mysqli_query($conn, $query);
    echo "News added successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name ="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Forgot Pasword</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
    <div class="wrapper">
        <form method="POST" enctype="multipart/form-data">
            <h2>News and Updates</h2>
            <div class="input-box">
              <input type="text" placeholder="Title" name="title" required>
            </div>
            <div class="input-box">
              <input type="textarea" placeholder="Content" name="content" required>
            </div>
            <div class="upload-container">
             <input type="file" accept="image/*">
            </div>
            <button type="submit" class="btn">Add News</button>
        </form>
    </div>    
</body>
</html>
