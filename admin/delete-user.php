<?php
include "config.php";

if ($_SESSION['role'] == '0') {
    header("Location: {$hostname}/admin/post.php");
}

$user_id = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = '{$user_id }' ";

if(mysqli_query($conn, $sql)) {
    header("Location: {$hostname}/admin/users.php");
} else {
    echo "<p style='color: red; text-align: center; margin: 10px 0;'>Could not delete the user</p>";
}

mysqli_close($conn);
?>