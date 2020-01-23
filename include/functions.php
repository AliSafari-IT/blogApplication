<?php

function getHeader()
{
    include "header.php";
}

function getFooter()
{
    include "footer.php";
}

function getNavigation()
{
    include "navigation.php";
}

function loginUser($emailUsername, $password)
{
    include "db_connect.php";
    if (strpos($emailUsername, '@')) {
        $email = strtolower($emailUsername);
        $stmt = $Database_con->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
    } else {
        $username = strtolower($emailUsername);
        $stmt = $Database_con->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        session_start();
        $_SESSION["loggedin"] = false;
        session_destroy();
        return false;
    } else {
        while ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["userID"] = $row['userID'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["username"] = $row['username'];
                $_SESSION["firstname"] = $row['firstname'];
                $_SESSION["lastname"] = $row['lastname'];
                $_SESSION["userType"] = $row['userType'];
                return true;
            } else {
                session_start();
                $_SESSION["loggedin"] = false;
                session_destroy();
                return false;
            }
        }
    }
    $stmt->close();
}

function registerUser($firstname, $lastname, $email, $username, $password)
{

    include "db_connect.php";

    $firstname = ucwords($firstname);
    $lastname = ucwords($lastname);
    $email = strtolower($email);
    $username = strtolower($username);

    $stmt = $Database_con->prepare("SELECT * FROM users WHERE email = ? or username=?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {

        $stmt = $Database_con->
        prepare("INSERT INTO users (firstname,lastname,email,username,password,userType) VALUES(?,?,?,?,?,DEFAULT)");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $username, $password);
        $stmt->execute();
        $stmt->close();

        return true;

    } else {
        $stmt->close();
        return false;
    }
}

function getUsers()
{

    include "db_connect.php";

    $stmt = $Database_con->prepare("SELECT userID as 'ID', CONCAT(firstname, ' ', lastname) as 'Full Name', username as 'Username', email as 'E-mail', userType as 'User Type' FROM users order by userID asc");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return false;
    } else {
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            $users[$count] = $row;
            $count++;
        }
    }
    $stmt->close();

    return $users;
}

function getUser($id)
{

    include "db_connect.php";

    $stmt = $Database_con->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return false;
    } else {
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
    }
    $stmt->close();

}

function logincheck()
{
    session_start();

    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
        header("location: login.php");
        die();
    }
}

function getPosts()
{

    return getAllSql("*", "posts");

}

function getPost($id)
{

    include "db_connect.php";

    $stmt = $Database_con->prepare("SELECT posts.*, users.email FROM posts INNER JOIN users ON posts.id_user = users.id WHERE posts.id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return false;
    } else {
        while ($row = $result->fetch_assoc()) {
            return $row;
        }
    }
    $stmt->close();

}

function deletePost($id)
{

    include "db_connect.php";

    $stmt = $Database_con->prepare("DELETE FROM posts WHERE postID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->close();

    return true;

}

function newPost($username, $visibility, $newPostTitleInput, $newPostContentInput)
{
    $visibilityType = 'public';
    if ($visibility == 1) {
        $visibilityType = 'private';
    }
    include "db_connect.php";

    $stmt = $Database_con->prepare("INSERT INTO posts (visibilityType,postTitle,postContent,username,catID,publishedDateTime,postViews) 
VALUES(?,?,?,?,DEFAULT,DEFAULT,DEFAULT)");
    $stmt->bind_param("ssss", $visibilityType, $newPostTitleInput,$newPostContentInput,$username);
    $stmt->execute();
    $stmt->close();
    return true;

}

function updatePost($id, $postTitle, $postContent)
{
    include "db_connect.php";
    $stmt = $Database_con->prepare("UPDATE posts SET postTitle =?, postContent=? WHERE postID = '$id'");
    $stmt->bind_param("ss", $postTitle, $postContent);
    $stmt->execute();
    $stmt->close();

//    $updateThisPost = "UPDATE posts SET postTitle = '$postTitle', postContent='$postContent' WHERE postID = '$id'";
//    mysqli_query($Database_con, $updateThisPost);

    return true;
}

function getAllSql($columns, $table)
{

    include "db_connect.php";

    $stmt = $Database_con->prepare("SELECT $columns FROM $table ORDER BY time_created DESC");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return false;
    } else {
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            $data[$count] = $row;
            $count++;
        }
    }
    $stmt->close();

    return $data;
}