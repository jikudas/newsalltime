<?php
include 'config.php';

$page = basename($_SERVER['PHP_SELF']);

switch ($page) {
    case "single.php":
        $post_id = $_GET['id'];
        $sql = "SELECT * FROM post WHERE post.post_id = {$post_id}";
        $result = mysqli_query($conn, $sql) or die('Query Failed: Dynamic Title.');
        $row = mysqli_fetch_assoc($result);
        $page_title = $row['title'];
        break;
    case "category.php":
        $cat_id = $_GET['cid'];
        $sql = "SELECT * FROM category WHERE category.category_id = {$cat_id}";
        $result = mysqli_query($conn, $sql) or die('Query Failed: Dynamic Title.');
        $row = mysqli_fetch_assoc($result);
        $page_title = $row['category_name'];
        break;
    case "author.php":
        $auth_id = $_GET['aid'];
        $sql = "SELECT * FROM user WHERE user.user_id = {$auth_id}";
        $result = mysqli_query($conn, $sql) or die('Query Failed: Dynamic Title.');
        $row = mysqli_fetch_assoc($result);
        $page_title = $row['first_name'] . ' ' . $row['last_name'];
        break;
    case "search.php":
        $page_title = ucwords($_GET['search']);
        break;
    default:
        $page_title = "News All Time";
        break;
}
;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>
            <?= $page_title ?>
        </title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="css/font-awesome.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <!-- HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">   
                    <!-- LOGO -->
                    <div class=" col-md-offset-4 col-md-4">
                        <?php
                        $sql = "SELECT * FROM settings";
                        ?>
                        <a href="index.php" id="logo"><img src="images/news.jpg"></a>
                    </div>
                    <!-- /LOGO -->
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <!-- Menu Bar -->
        <div id="menu-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['cid'])) {
                            $cat_id = $_GET['cid'];
                        }

                        $sql = "SELECT * FROM category WHERE post > 0";
                        $result = mysqli_query($conn, $sql) or die("Query Failed: Category");
                        if (mysqli_num_rows($result) > 0) {
                            $active = "";
                            ?>
                            <ul class='menu'>
                                <li><a href='<?= $hostname ?>'>Home</a></li>";
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if (isset($_GET['cid'])) {
                                        if ($row['category_id'] == $cat_id) {
                                            $active = "active";
                                        } else {
                                            $active = "";
                                        }
                                    }
                                    echo "<li><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                                }
                                ?>
                            </ul>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Menu Bar -->