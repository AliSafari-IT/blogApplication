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

            $postPerPage = 3;    //show 3 posts per page
            // counting total number of posts
            $totalNr_query = "SELECT count(*) as totalPostNrs FROM posts";
            $totalNr_result = mysqli_query($Database_con, $totalNr_query);
            $totalNr_fetch = mysqli_fetch_array($totalNr_result);
            $totalNr = $totalNr_fetch['totalPostNrs'];

            $stmt = $Database_con->prepare("SELECT * FROM posts order by postID desc limit 0,$postPerPage");
            if (!$stmt) {
                echo "Error!<div class='bg-danger text-center' style='height: 100px'>";
                echo "<p class='pt-3'>Prepare failed: (" . $Database_con->errno . ") " . $Database_con->error . "</p><br>";
                echo "</div>";
                die();
            }
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo '<div class="panel-info text-danger my-5">Nothing to display!</div>';
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
                    } else {
                        if ($username === $_SESSION["username"] || $visibilityType === 'public') { ?>
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
                            <?php
                        }
                    }


                } ?>
                <!-- Pager -->
                <div class="clearfix">
                    <h1 id="loadMore" class="btn btn-primary float-right">Load More <i class="fas fa-hand-pointer"
                                                                                       style="font-size:28px; "></i>
                    </h1>
                    <input type="hidden" id="row" value="0">
                    <input type="hidden" id="all" value="<?php echo $totalNr; ?>">
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<hr>
<?php getFooter(); ?>

<script>

    $(document).ready(function () {
        // Load more data
        const LoadMore = $('#loadMore');
        LoadMore.click(function () {
            var row = Number($('#row').val());
            var totalNr = Number($('#all').val());
            var postPerPage = 3;
            row = row + postPerPage;

            if (row <= totalNr) {
                $("#row").val(row);

                $.ajax({
                    url: 'loadMore.php',
                    type: 'post',
                    data: {row: row},
                    beforeSend: function () {
                        $("#loadMore").text("Loading...");
                    },
                    success: function (response) {
                        // Setting little delay while displaying new content
                        setTimeout(function () {
                            // appending posts after last post with class="post"
                            $(".post:last").after(response).show().fadeIn("slow");

                            var rowno = row + postPerPage;

                            // checking row value is greater than totalNr or not
                            if (rowno > totalNr) {

                                // Change the text and background
                                LoadMore.text("Hide");
                                LoadMore.css("background", "darkorchid");
                            } else {
                                LoadMore.text("Load more");
                            }
                        }, 2000);

                    }
                });
            } else {
                LoadMore.text("Loading...");

                // Setting little delay while removing contents
                setTimeout(function () {

                    // When row is greater than totalNr then remove all class='post' element after 3 element
                    $('.post:nth-child(3)').nextAll('.post').remove();

                    // Reset the value of row
                    $("#row").val(0);

                    // Change the text and background
                    LoadMore.text("Load more");
                    LoadMore.css("background", "#15a9ce");

                }, 2000);

            }

        });
    });
</script>

</body>

</html>
