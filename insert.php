<?php
session_start();
include "koneksi.php";

if (isset($_POST['submit'])) {
    // Escape input values to prevent SQL injection
    $title = mysqli_real_escape_string($koneksi, $_POST['title']);
    $description = mysqli_real_escape_string($koneksi, $_POST['description']);

    // File upload handling
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['file']['name'])));

    $extensions = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be less than 2 MB';
    }

    // If no errors, insert data into database
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
        $query = "INSERT INTO articles (title, description, image) VALUES ('$title', '$description', '$file_name')";
        mysqli_query($koneksi, $query);
        header('location:index.php');
        exit();
    } else {
        print_r($errors);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Insert Text and Image</title>
</head>

<body>
    <h1>Insert Text and Image</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Title:</label><br>
        <input type="text" name="title"><br><br>
        <label>Description:</label><br>
        <textarea name="description"></textarea><br><br>
        <label>Image:</label><br>
        <input type="file" name="file"><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>