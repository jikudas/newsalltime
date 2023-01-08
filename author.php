<?php
include 'header.php';
include 'config.php';
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    if (isset($_GET['aid'])) {
                        $author_id = $_GET['aid'];
                    }
                    
                    $sql1 = "SELECT * FROM post JOIN user 
                    ON post.author = user.user_id 
                    WHERE post.author = {$author_id}";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
                    $row1 = mysqli_fetch_assoc($result1);
                    ?>
                    <h2 class="page-heading"><?= $row1['username'] ?></h2>
                    <?php
                    $limit = 3;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;
                    $sql = "SELECT post.post_id, post.title, post.description, post.post_date, post.author, post.category, post.post_img, category.category_name, user.username FROM post 
                            LEFT JOIN category ON post.category = category.category_id
                            LEFT JOIN user ON post.author = user.user_id
                            WHERE post.author = {$author_id}
                            ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";

                    $result = mysqli_query($conn, $sql) or die("Query Failed!");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php"><img src="admin/upload/<?= $row['post_img']?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?= $row['post_id'] ?>'><?= $row['title'] ?></a>
                                            </h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?= $row['category'] ?>   '><?= $row['category_name'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?aid=<?= $row['author'] ?>'><?= $row['username'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?= $row['post_date'] ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?= substr($row['description'], 0, 130) ?>....
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?= $row['post_id'] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    if (mysqli_num_rows($result1) > 0) {
                        $total_records = mysqli_num_rows($result1);
                        $total_page = ceil($total_records / $limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo "<li><a href='author.php?aid={$author_id}&page=" . ($page - 1) . "'>Prev</a></li>";
                        }

                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = '';
                            }

                            echo "<li class = {$active}><a href = 'author.php?aid={$author_id}&page={$i}'>" . $i . "</a></li>";
                        }
                        if ($total_page > $page) {
                            echo "<li><a href='author.php?aid={$author_id}&page=" . ($page + 1) . "'>Next</a></li>";
                        }
                        echo "</ul>";
                    }
                    ?>
                </div>
                <!-- author-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>