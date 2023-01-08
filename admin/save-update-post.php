<?php
include 'config.php';
$errors = array();
if(empty($_FILES['new-image']['name'])) {
    $file_name = $_FILES['old-image'];
} else {
$file_name = $_FILES['new-image']['name'];
$file_size = $_FILES['new-image']['size'];
$file_tmp = $_FILES['new-image']['tmp_name'];
$file_type = $_FILES['new-image']['type'];
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
    move_uploaded_file($file_tmp, 'upload/' . $file_name);
} else {
    print_r($errors);
    die();
}
}

$sql = "UPDATE post SET title = '{$_POST['post_title']}', description = '{$_POST['postdesc']}', category = '{$_POST['category']}', post_img = '{$file_name}' WHERE post_id = {$_POST['post_id']} ";

$result = mysqli_query($conn, $sql);

if($result) {
    header("Location: {$hostname}/admin/post.php");
} else {
    echo "Post could not be updated";
}
?>