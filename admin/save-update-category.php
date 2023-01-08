<?php
include 'config.php';

$sql = "UPDATE category SET category_name = '{$_POST['cat_name']}' WHERE category_id = {$_POST['cat_id']}";
$result = mysqli_query($conn, $sql);

if($result) {
    header("Location: {$hostname}/admin/category.php");
} else {
    echo "Category could not update";
}
?>