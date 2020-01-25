<?php
session_start();
include "include/functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php getHeader(); ?>
    <title>Blog Application</title>
</head>
<!-- The scrollable area -->

<body>

<?php getNavigation(); ?>
<?php getPageHeader(); ?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            include "include/db_connect.php";

            $stmt = $Database_con->prepare("SELECT * FROM posts order by postID desc");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo '<div class="panel-info text-danger">Nothing to display!</div>';
                echo '<div class="text-success"><a href="newpost.php">Add New Post</a></div>';
            } else {
                while ($row = $result->fetch_assoc()) {
                    $postID = htmlentities($row['postID']);
                    $visibilityType = htmlentities($row['visibilityType']);
                    $postTitle = htmlentities($row['postTitle']);
                    if ($postTitle == '') {
                        $row['postTitle'] = "[Post without Title!]";
                    }
                    $postContent = htmlentities($row['postContent']);
                    $username = htmlentities($row['username']);
                    $catID = htmlentities($row['catID']);
                    $publishedDateTime = htmlentities($row['publishedDateTime']);
                    $postViews = htmlentities($row['postViews']);
                    if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
                        if ($visibilityType === 'public') { ?>
                            <div class="post-preview">
                                <a href=<?php echo 'view.php?id=' . $postID . '&postedBy=' . $username ?>>
                                    <h2 class="post-title">
                                        <?php echo $row['postTitle'] ?>
                                    </h2>
                                    <h3 class="post-subtitle" style="height: 150px;overflow: hidden">
                                        <?php echo $row['postContent']; ?>
                                    </h3>
                                </a>
                                <p class="post-meta">Posted by
                                    <a href=<?php echo "user.php?id=" . $postID . "&postedBy=" . $username; ?>><span
                                                class="badge badge-primary p-1"><i class="fa fa-user"
                                                                                   aria-hidden="true"></i> <?php echo $username; ?></span></a>
                                    on <?php echo $publishedDateTime; ?></p>
                                <a href=<?php echo 'view.php?id=' . $postID . '&postedBy=' . $username; ?>>Read
                                    more...</a>
                            </div>
                            <hr>
                        <?php }
                    }
                }
            } ?>


            <!-- Pager -->
            <div class="clearfix">
                <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>
        </div>
    </div>
</div>

<hr>
<?php getFooter(); ?>

<!-- Bootstrap core JavaScript -->
<script src="include/vendor/jquery/jquery.min.js"></script>
<script src="include/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for this template -->
<script src="include/js/clean-blog.min.js"></script>

</body>

</html>
