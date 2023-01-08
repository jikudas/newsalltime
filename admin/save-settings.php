<?php
include 'config.php';
session_start();


if (isset($_FILES['web_logo']['name'])) {
    $errors = array();
    $file_name = $_FILES['web_logo']['name'];
    $file_size = $_FILES['web_logo']['size'];
    $file_tmp = $_FILES['web_logo']['tmp_name'];
    $file_type = $_FILES['web_logo']['type'];
    $explode = explode('.', $file_name);
    $file_ext = strtolower(end($explode));

    $extensions = array('jpeg', 'jpg', 'png');

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = 'The extension file is not allowed. Please choose a JPG or PNG file.';
    }

    if ($file_size > 2097152) {
        $errors[] = "File size must be 2mb or lower";
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, 'images/' . $file_name);
    } else {
        print_r($errors);
        die();
    }
}

$title = mysqli_real_escape_string($conn, $_POST['web_name']);
$description = mysqli_real_escape_string($conn, $_POST['footerdesc']);

$sql = "INSERT INTO settings(web_name, logo, footer_desc) 
        VALUES('{$title}', '{$file_name}', '{$description}');";

if (mysqli_multi_query($conn, $sql)) {
    header("Location: {$hostname}/admin/settings.php");
} else {
    echo "<div class='alert alert-danger'>Query Failed.</div>";
}
?>