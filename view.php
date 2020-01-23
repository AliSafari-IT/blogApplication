<?php
session_start();
$id = (INT)$_GET['id'];
$loggedUser = $_GET['loggedUser'];

if ($id < 1) {
    header("location: index.php");
}
include "include/functions.php";
?>

<html lang="en">

<head>
    <?php getHeader(); ?>
</head>

<body>

<?php getNavigation(); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <hr><hr>
        <div class="panel-info">
            <?php
            include "include/db_connect.php";
            $updateViewStatement = "UPDATE posts SET postViews = postViews +1 WHERE postID = '$id'";
            mysqli_query($Database_con, $updateViewStatement);

            $stmt = $Database_con->prepare("SELECT * FROM posts where postID = '$id'");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {?>
                <div class="panel">
                    <h1 class="text-danger">Warning!</h1>
                    <hr>
                    <div class="text-center h5">You are not allowed to modify this post. If you are the author of this post
                        then you most login first.
                    </div>
                </div>
            <?php
            } else {
                echo "<hr>";
                $row = $result->fetch_assoc();
                $postID = htmlentities($row['postID']);
                $visibilityType = htmlentities($row['visibilityType']);
                $postTitle = htmlentities($row['postTitle']);
                $postTitle = htmlentities($row['postTitle']);
                $postContent = htmlentities($row['postContent']);
                $username = htmlentities($row['username']);
                $catID = htmlentities($row['catID']);
                $publishedDateTime = htmlentities($row['publishedDateTime']);
                $postViews = htmlentities($row['postViews']);
                if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
                    if ($visibilityType === 'public') {
                        echo "<hr>";
                        echo '<div class="panel-info">';
                        echo "<h3>".$row['postTitle']."</h3>";
                        echo '</div> <div class="text-warning text-">';
                        echo "<p>$publishedDateTime (Posted by <span class='badge badge-secondary'>$username</span>)</p></div>";
                        echo '<div class="input-field">';
                        echo $row['postContent'];
                        echo '</div><div class="text-warning">';
                        echo '<div class="w3-text-grey">';
                        echo "Page views: " . $postViews . "<br>";
                        echo "$publishedDateTime</div>";
                        echo "<hr></div>";
                    }
                } else {
                    echo "<hr>";
                    if ($username === $_SESSION["username"] || $visibilityType === 'public') {
                        echo '<div class="panel-info">';
                        echo "<h3>".$row['postTitle']."</h3>";
                        echo '</div> <div class="text-warning text-">';
                        echo "<p>$publishedDateTime (Posted by <span class='badge badge-secondary'>$username</span>)</p></div>";
                        echo '<div class="input-field">';
                        echo $row['postContent'];
                        echo '</div><div class="text-warning">';
                        echo '<div class="glyphicon-text-color">';
                        echo "Page views: " . $postViews . "<br>";
                        echo "$publishedDateTime</div>";
                        echo "<hr></div>";
                    }
                }
            }
            ?>
        </div>
        <?php
        if (isset($_SESSION['username']) && $loggedUser ==$_SESSION['username'] ) {
            ?>
            <div class="row">
                <div class="col-md-1 text-center">

                    <button style='font-size:24px' >
                        <a href="editPost.php?id=<?php echo $id; ?>" >
                            <i class='fas fa-edit' style='font-size:48px;color:green'></i>
                        </a>
                    </button>
                </div>
                <div class="col-md-1 text-center">
                    <button style='font-size:24px'>
                        <a onclick="return confirm('Are you sure you want to delete this post?');"
                           href="deletePost.php?id=<?php echo $id; ?>">
                            <i class='fas fa-eraser' style='font-size:48px;color:red'></i>
                        </a>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 text-center">
                    [Edit]
                </div>
                <div class="col-md-1 text-center">
                    [Delete]
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php getFooter(); ?>

</body>

</html>
