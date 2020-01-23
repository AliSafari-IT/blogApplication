<?php
session_start();
include "include/functions.php";
?>

<html lang="en">
<head>
    <?php getHeader(); ?>
    <title>Simple Blog Application</title>
</head>
<!-- The scrollable area -->
<body>
<?php getNavigation(); ?>
<hr class='mb-5'>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <p class="p-1"></p>
        <h1>Blog Project in PHP using MySQL</h1>
        <div>
            <p>This is a simple blog project for my PHP end project.</p>
            <ul>User type: user
                <li>login: user</li>
                <li>password: user</li>
            </ul>
            <ul>User type: moderator
                <li>login: moderator</li>
                <li>password: moderator</li>
            </ul>
            <ul>User type: admin
                <li>login: admin</li>
                <li>password: admin</li>
            </ul>
        </div>

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
                $postContent = htmlentities($row['postContent']);
                $username = htmlentities($row['username']);
                $catID = htmlentities($row['catID']);
                $publishedDateTime = htmlentities($row['publishedDateTime']);
                $postViews = htmlentities($row['postViews']);
                if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
                    if ($visibilityType === 'public') {
                        echo "<hr>";
                        echo '<div class="panel-info">';
                        echo "<h3><a href='view.php?id=$postID&loggedUser=$username'>" . $row['postTitle'] . "</a></h3>";
                        echo '</div> <div class="text-warning text-">';
                        echo "<p>$publishedDateTime (Posted by <span class='badge badge-secondary'>$username</span>)</p></div>";
                        echo '<div style="height: 150px;overflow: hidden">';

                        echo $row['postContent'];

                        echo '</div><div class="text-warning">';
                        echo "<a href='view.php?id=$postID&loggedUser=$username'>Read more...</a>";

                        echo "<hr></div>";
                    }
                } else {
                    if ($username === $_SESSION["username"] || $visibilityType === 'public') {
                        echo '<div class="panel-info">';
                        echo "<h3><a href='view.php?id=$postID&loggedUser=$username'>" . $row['postTitle'] . "</a>";
                        if ($visibilityType === 'private') {
                            echo '<i class="material-icons" style="font-size:36px;color:red" data-toggle="tooltip" title="private post">lock</i></h3>';
                        }

                        echo '</div> <div class="text-warning text-">';
                        echo "<p>$publishedDateTime (Posted by <span class='badge badge-secondary'>$username</span>)</p></div>";

//                        echo substr($postContent, 0, 200) . "...";
                        echo '<div style="height: 150px;overflow: hidden">';

                        echo $row['postContent'];

                        echo '</div><div class="text-warning">';
                        echo "<a href='view.php?id=$postID&loggedUser=$username'>Read more...</a>";

                        echo "<hr></div>";

                    }
                }
            }
        }
        ?>
    </div> <!--    /container-->
</div> <!-- /jumbotron-->
</body>
</html>