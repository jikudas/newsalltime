<?php
include "header.php";
include 'config.php';
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Website Settings</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                $sql = "SELECT * FROM settings";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <!-- Form -->
                        <form action="save-settings.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="post_title">Website Name</label>
                                <input type="text" class="form-control" autocomplete="off" name="web_name" value='<?= $row['web_name'] ?>'>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Logo</label>
                                <input type="file" name="web_logo">
                                <img src="images/<?= $row['logo'] ?>" alt="">
                                <input type="hidden" name="old_logo" value='<?= $row['logo'] ?>'>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Footer Description</label>
                                <textarea name="footerdesc" class="form-control" rows="5">
                                    <?= $row['footer_desc'] ?>
                                </textarea>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                        </form>
                        <!--/Form -->
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>