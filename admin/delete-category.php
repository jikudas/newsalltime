<?php
include 'config.php';

$cat_id = $_GET['id'];

$sql = "DELETE FROM category WHERE category_id = '{$cat_id}' ";
$result = mysqli_query($conn, $sql) or die("Query Failed.");

if($result) {
    header("Location: {$hostname}/admin/category.php");
} else {
    echo "Category could not update";
}
?>